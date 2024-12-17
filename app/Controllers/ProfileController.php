<?php
	
	namespace App\Controllers;
	
	use App\Models\UserModel;
	use App\Models\DataModel;
	use CodeIgniter\HTTP\RedirectResponse;
	use CodeIgniter\HTTP\ResponseInterface;
	
	class ProfileController extends BaseController {
		public function index (): string|RedirectResponse {
			if ( !$this->validateSession () ) {
				return redirect ( 'signIn' );
			}
			$session = session ();
			$permissions = json_decode ( json_encode ( $session->get ( 'user' )[ 'permissions' ][ 0 ] ), TRUE );
			$user = $session->get ( 'user' )[ 'data' ];
			$name = $user[ 'name' ].' '.$user[ 'last_name' ];
			$initials = substr ( $user[ 'name' ], 0, 1 ).substr ( $user[ 'last_name' ], 0, 1 );
			$data[ 'iniciales' ] = $initials;
			$data[ 'name' ] = $name;
			$data[ 'company' ] = $user[ 'short_name' ];
			$data[ 'session' ] = TRUE;
			$data [ 'title' ] = 'SolveExpress | Perfil';
			return view ( 'profile', $data );
		}
		public function getProfile (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$session = session ();
			$id = $session->get ( 'user' )[ 'data' ][ 'id' ];
			$token = $session->get ( 'token' );
			$profile = $data->getProfile ( $id, $token );
			//			var_dump ( $profile );  die();
			return $this->getResponse ( json_decode ( $profile, TRUE ), json_decode ( $profile, TRUE )[ 'error' ] );
		}
		/**
		 * Válida si un nickname ya está en uso
		 * @return ResponseInterface
		 */
		public function validateNickname (): ResponseInterface {
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return ( $data );
			}
			$input = $this->getRequestInput ( $this->request );
			$validation = service ( 'validation' );
			$validation->setRules ( [ 'nickname' => 'required|max_length[15]', ],
				[ 'nickname' => [ 'max_length' => 'El nickName no debe tener mas de {param} caracteres' ] ] );
			if ( !$validation->run ( $input ) ) {
				$errors = $validation->getErrors ();
				return $this->errDataSuplied ( $errors );
			}
			$user = new UserModel();
			$res = $user->searchNickname ( $input[ 'nickname' ] );
			if ( $res[ 0 ] ) {
				return $this->getResponse ( [ 'error' => 200, 'description' => 'correcto', 'reason' => 'Nickname disponible' ] );
			}
			return $this->serverError ( 'Nickname invalido', 'El nickname ingresado ya esta en uso' );
		}
		public function resetPassword (): string|RedirectResponse {
			if ( $this->validateSession () ) {
				return redirect ( 'signIn' );
			}
			return view ( 'resetPassword' );
		}
		public function initRecovery (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$res = json_decode ( $data->initRecovery ( $this->input[ 'curp' ] ), TRUE );
			if ( $res[ 'error' ] !== 200 ) {
				$this->serverError ( $res[ 'description' ], $res[ 'reason' ] );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$session = session ();
			$session->set ( 'userId', $res[ 'response' ] );
			$this->errCode = $res[ 'error' ];
			$this->responseBody = [ 'description' => $res[ 'description' ], 'response' => 'ok' ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
		public function verifyCode (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$session = session ();
			$user = $session->get ( 'userId' );
			$res = json_decode ( $data->verifyCode ( $this->input[ 'code' ], $user ), TRUE );
			if ( $res[ 'error' ] !== 200 ) {
				$this->serverError ( $res[ 'description' ], $res[ 'reason' ] );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$session->set ( 'codePWD', $res[ 'response' ] );
			$this->errCode = $res[ 'error' ];
			$this->responseBody = [ 'description' => $res[ 'description' ], 'response' => 'ok' ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
		public function changePassword (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$session = session ();
			$user = $session->get ( 'userId' );
			$code = $session->get ( 'codePWD' );
			$res = json_decode ( $data->resetPassword ( $user, $code, $this->input[ 'password' ], $this->input[ 'password2' ] ), TRUE );
			if ( $res[ 'error' ] !== 200 ) {
				$this->serverError ( $res[ 'description' ], $res[ 'reason' ] );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$session->set ( 'codePWD', $res[ 'response' ] );
			$this->errCode = $res[ 'error' ];
			$this->responseBody = [ 'description' => $res[ 'description' ], 'response' => 'ok' ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
	}
