<?php
	
	namespace App\Controllers;
	
	use App\Models\DataModel;
	use CodeIgniter\HTTP\RedirectResponse;
	use CodeIgniter\HTTP\ResponseInterface;
	
	class SignInController extends BaseController {
		public function index (): string|RedirectResponse|ResponseInterface {
			if ( $this->validateSession () ) {
				$data = [ 'session' => TRUE ];
				$this->response->setHeader ( 'Content-Encoding', 'gzip' );
				$this->response->setBody ( gzencode ( view ( 'signInB', $data ) ) );
				return redirect ( '/' );
			}
			$data = [ 'session' => FALSE ];
			if ( str_contains ( service ( 'request' )->getHeaderLine ( 'Accept-Encoding' ), 'gzip' ) ) {
				$this->response->setHeader ( 'Content-Encoding', 'gzip' );
				$this->response->setBody ( gzencode ( view ( 'signInB', $data ) ) );
				return $this->response;
			}
			return view ( 'signInB', $data );
		}
		public function signIn (): ResponseInterface|bool {
			
			$this->input = $this->getRequestInput ( $this->request );
			if ( $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$user = new DataModel();
			$res = json_decode ( $user->signIn ( $this->input[ 'curp' ], $this->input[ 'password' ] ), TRUE );
			if ( $res[ 'error' ] != 0 ) {
				$this->errDataSuplied ( 'Las credenciales ingresadas son incorrectas' );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$session = session ();
			$session->set ( 'logged_in', TRUE );
			$session->set ( 'user', $res[ 'user' ] );
			$session->set ( 'company', $res[ 'user' ][ 'data' ][ 'companyId' ] );
			$session->set ( 'token', $res[ 'access_token' ][ 'token' ] );
			$session->set ( 'tokenExpires', $res[ 'access_token' ][ 'expires' ] );
			$this->errCode = 200;
			$this->responseBody = [
				'error'       => 0,
				'description' => 'Datos de petición correcto',
				'reason'      => $res[ 'access_token' ][ 'expires' ] ];
			return $this->getResponse ( $this->responseBody );
		}
		public function validarCurp (): string {
			return view ( 'validateEmployee' );
		}
		public function validateIdentity (): string {
			return view ( 'validateIdentity' );
		}
	}
