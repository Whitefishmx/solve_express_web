<?php
	
	namespace App\Models;
	
	use CodeIgniter\Model;
	use Config\Database;
	
	class UserModel extends Model {
		protected $db;
		private string $environment = '';
		private string $dbsandbox = '';
		private string $dbprod = '';
		private string $base;
		public function __construct () {
			parent::__construct ();
			require 'conf.php';
			$this->base = $this->environment === 'SANDBOX' ? $this->dbsandbox : $this->dbprod;
			$this->db = Database::connect ( 'default' );
		}
		/**
		 * Inserta un nuevo usuario y persona
		 *
		 * @param array       $args Datos de la persona y de usuario
		 * @param string|NULL $env  Ambiente en el que se va a trabajar
		 *
		 * @return array
		 */
		public function signUp ( array $args, string $env = NULL ): array {
			//Se declara el ambiente a utilizar
			$this->environment = $env === NULL ? $this->environment : $env;
			$this->base = strtoupper ( $this->environment ) === 'SANDBOX' ? $this->dbsandbox : $this->dbprod;
			helper ( 'crypt_helper' );
			$password = passwordEncrypt ( $args[ 'password' ] );
			$query = "INSERT INTO $this->base.users (nickname, email, password, active)
VALUES ('{$args['nickname']}', '{$args['email']}', '$password', 1)";
			$this->db->transBegin ();
			$this->db->query ( $query );
			if ( $this->db->transStatus () === FALSE ) {
				$this->db->transRollback ();
				return [ FALSE, 0 ];
			}
			$inserted = $this->db->insertID ();
			$birthdate = date ( 'Y-m-d', strtotime ( $args[ 'birthday' ] ) );
			$query2 = "INSERT INTO $this->base.person (user_id, name, last_name, sure_name, gender, birthday, address, phone, active)
VALUES ($inserted, '{$args['name']}', '{$args['lastName']}', ";
			$query2 .= isset( $args[ 'sureName' ] ) ? "'{$args['sureName']}'" : NULL;
			$query2 .= ", '{$args['gender']}', '$birthdate', null, ";
			$query2 .= isset( $args[ 'phone' ] ) ? "'{$args['phone']}'" : NULL;
			$query2 .= ", 1)";
			$this->db->query ( $query2 );
			if ( $this->db->transStatus () === FALSE ) {
				$this->db->transRollback ();
				return [ FALSE, 1 ];
			}
			$this->db->transCommit ();
			return [ TRUE, $this->db->insertID () ];
		}
		/**
		 * Devuelve TRUE en caso de que se pueda insertar el nickname buscado
		 *
		 * @param string      $nickname Nickname que se quiere ingresar
		 * @param string|NULL $env      Ambiente en el que se va a trabajar
		 *
		 * @return array Resultados
		 */
		public function searchNickname ( string $nickname, string $env = NULL ): array {
			//Se declara el ambiente a utilizar
			$this->environment = $env === NULL ? $this->environment : $env;
			$this->base = strtoupper ( $this->environment ) === 'SANDBOX' ? $this->dbsandbox : $this->dbprod;
			$query = "SELECT nickname FROM $this->base.users WHERE nickname = '$nickname'";
			$res = $this->db->query ( $query );
			if ( $res->getNumRows () === 0 ) {
				return [ TRUE, 0 ];
			}
			return [ FALSE, $res->getNumRows () ];
		}
		/**
		 * Valida si las credenciales ingresadas pertenecen a un usuario
		 *
		 * @param string      $login    Alias o correo
		 * @param string      $password Contraseña
		 * @param string|NULL $env      Ambiente en el que se va a trabajar
		 *
		 * @return array En caso de ser verdadero devuelve su ID para guardar en la sesión
		 */
		public function validateAccess ( string $login, string $password, string $env = NULL ): array {
			//Se declara el ambiente a utilizar
			$this->environment = $env === NULL ? $this->environment : $env;
			$this->base = strtoupper ( $this->environment ) === 'SANDBOX' ? $this->dbsandbox : $this->dbprod;
			$query = "SELECT id FROM $this->base.users WHERE (nickname = '$login' AND password = '$password') OR (email = '$login' AND password = '$password')";
			$res = $this->db->query ( $query );
			if ( $res->getNumRows () > 0 ) {
				return [ TRUE, $res->getRow ('id') ];
			}
			return [ FALSE, $res->getNumRows () ];
		}
	}