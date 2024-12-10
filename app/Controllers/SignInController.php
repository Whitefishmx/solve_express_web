<?php
	
	namespace App\Controllers;
	
	use App\Models\DataModel;
	use CodeIgniter\HTTP\RedirectResponse;
	use CodeIgniter\HTTP\ResponseInterface;
	
	class SignInController extends BaseController {
		public function index (): string|RedirectResponse {
			if ( $this->validateSession () ) {
				return redirect ( '/' );
			}
			$data = [ 'session' => FALSE ];
			return view ( 'signInB', $data );
		}
		public function signIn (): ResponseInterface|bool {
			
			$this->input = $this->getRequestInput ( $this->request );
			if ( $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$user = new DataModel();
			$res = json_decode ( $user->signIn ( $this->input[ 'curp' ], $this->input[ 'password' ] ), TRUE );
			//			var_dump ($res );
			//			die();
			if ( $res[ 'error' ] != 0 ) {
				$this->errDataSuplied ( 'Las credenciales ingresadas son incorrectas' );
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			//			die( var_dump ( $res ) );
			$session = session ();
			$session->set ( 'logged_in', TRUE );
			$session->set ( 'user', $res[ 'user' ] );
			$session->set ( 'token', $res[ 'access_token' ][ 'token' ] );
			$this->errCode = 200;
			$this->responseBody = [
				'error'       => 0,
				'description' => 'Datos de petición correcto',
				'reason'      => 'Inicio de sesión exitoso' ];
			return $this->getResponse ( $this->responseBody );
		}
		public function validarCurp (): string {
			return view ( 'validateEmployee' );
		}
		public function validateIdentity (): string {
			return view ( 'validateIdentity' );
		}
	}
