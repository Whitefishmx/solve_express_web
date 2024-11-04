<?php
	
	namespace App\Controllers;
	
	use App\Models\DataModel;
	use CodeIgniter\HTTP\RedirectResponse;
	
	class Home extends BaseController {
		public function index (): string|RedirectResponse {
			if ( !$this->validateSession () ) {
				return redirect ( 'signIn' );
			}
			$session = session ();
			$permissions = json_decode ( json_encode ( $session->get ( 'user' )[ 'permissions' ][ 0 ] ), TRUE );;
			//			var_dump ($permissions['name'] === 'main');
			//			die();
			if ( $permissions[ 'name' ] === 'main' ) {
				$data = [ 'main' => view ( 'main' ), 'session' => FALSE ];
				return view ( 'plantilla', $data );
			}
			$data = [ 'title' => 'SoveExpress | Empresas' ];
			return view ( 'Company/main', $data );
		}
		public function getLaws(){
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$res = json_decode ( $data->getLaws ($this->input['type']), TRUE );
			if ( $res[ 'error' ] != 200 ) {
				$this->serverError ($res[ 'description' ], $res[ 'reason' ]) ;
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->errCode = 200;
			$this->responseBody = [
				'error'       => $this->errCode,
				'description' => 'Solicitud procesada',
				'response'      => $res['response']];
			return $this->getResponse ( $this->responseBody );
		}
	}
