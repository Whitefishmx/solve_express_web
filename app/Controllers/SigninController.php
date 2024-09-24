<?php
	
	namespace App\Controllers;
	
	use App\Models\UserModel;
	use CodeIgniter\HTTP\RedirectResponse;
	use CodeIgniter\HTTP\ResponseInterface;
	
	class SigninController extends BaseController {
		public function index (): string|RedirectResponse {
			if ( $this->validateSession () ) {
				return redirect ( '/' );
			}
			$data = [ 'main' => view ( 'signin' ), 'session' => FALSE  ];
			return view ( 'plantilla', $data );
		}
		public function signIn (): ResponseInterface|bool {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$user = new UserModel();
			helper ( 'crypt_helper' );
			$res = $user->validateAccess ( $this->input[ 'email' ], $this->input[ 'password' ] = ( passwordEncrypt (
				$this->input[ 'password' ] )
			), $this->env );
			if ( !$res[ 0 ] ) {
				$this->errDataSuplied ( 'Las credenciales ingresadas son incorrectas' );
				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$session = session ();
			$session->set ( 'logged_in', TRUE );
			$session->set ( 'user', $res[ 1 ] );
			$this->errCode = 200;
			$this->responseBody = [
				'error'       => 0,
				'description' => 'Datos de petición correcto',
				'reason'      => 'Inicio de sesión exitoso' ];
			$this->logResponse ( 1 );
			return $this->getResponse ( $this->responseBody );
		}
	}
