<?php
	
	namespace App\Models;
	
	use CodeIgniter\Model;
	use Config\Database;
	
	class BaseModel extends Model {
		public         $db;
		public string  $environment = 'SANDBOX';
		public string  $APISandbox  = '';
		public string  $APILive     = '';
		public string  $base        = '';
		private string $dbsandbox   = '';
		private string $dbprod      = '';
		public function __construct () {
			parent::__construct ();
			require 'conf.php';
			$this->base = $this->environment === 'SANDBOX' ? $this->dbsandbox : $this->dbprod;
			$this->db = Database::connect ( 'default' );
		}
		/**
		 * Obtiene el siguiente ID que será insertado
		 *
		 * @param string      $table Tabla de la que se quiere obtener el siguiente ID
		 * @param string|null $env   Ambiente en el que se va a trabajar
		 *
		 * @return int|array Siguiente ID que será insertado
		 * @noinspection DuplicatedCode
		 */
		public function getNexId ( string $table, string $env = NULL ): int|array {
			$this->environment = $env === NULL ? $this->environment : $env;
			$this->base = strtoupper ( $this->environment ) === 'SANDBOX' ? $this->dbsandbox : $this->dbprod;
			$query = "SELECT MAX(id) AS id FROM $this->base.$table";
			if ( !$res = $this->db->query ( $query ) ) {
				return [ FALSE, 'No se encontró información de '.$table ];
			}
			$res = $res->getResultArray ()[ 0 ][ 'id' ];
			return $res === NULL ? 1 : intval ( $res + 1 );
		}
		public function saveLogs ( array $args, string $env = NULL ): bool {
			$this->environment = $env === NULL ? $this->environment : $env;
			$this->base = strtoupper ( $this->environment ) === 'SANDBOX' ? $this->dbsandbox : $this->dbprod;
			$query = "INSERT INTO $this->base.logs ( id_user, task, code, data_in, result )
VALUES ( {$args['user']}, {$args['function']}, {$args['code']}, ";
			$query .= $args[ 'dataIn' ] === NULL ? " NULL, " : " '".( $args[ 'dataIn' ] )."', ";
			$query .= $args[ 'dataOut' ] === NULL ? " NULL ) " : " '".( $args[ 'dataOut' ] )."' ) ";
			$this->db->query ( 'SET NAMES utf8mb4' );
			$this->db->query ( $query );
			if ( $this->db->affectedRows () === 0 ) {
				return FALSE;
			}
			return TRUE;
		}
	}