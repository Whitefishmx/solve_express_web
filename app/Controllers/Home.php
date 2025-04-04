<?php
	
	namespace App\Controllers;
	
	use App\Models\DataModel;
	use CodeIgniter\HTTP\RedirectResponse;
	use CodeIgniter\HTTP\ResponseInterface;
	
	class Home extends BaseController {
		public function index (): string|RedirectResponse|ResponseInterface {
			if ( !$this->validateSession () ) {
				return redirect ( 'signIn' );
			}
			$session = session ();
			$permissions = json_decode ( json_encode ( $session->get ( 'user' )[ 'permissions' ] ), TRUE );
			$found = array_filter ( (array)$permissions, function ( $item ) {
				return isset( $item[ 'name' ] ) && $item[ 'name' ] === 'benefits';
			} );
			$vigencia = FALSE;
			if ( !empty( $found ) ) {
				$dataM = new DataModel();
				$validated = json_decode ( $dataM->verifyBenefits ( $session->get ( 'token' ) ), TRUE );
				$vigencia = $validated[ 'error' ] === 200 ? TRUE : FALSE;
			}
			$user = $session->get ( 'user' )[ 'data' ];
			$name = $user[ 'name' ].' '.$user[ 'last_name' ];
			$initials = substr ( $user[ 'name' ], 0, 1 ).substr ( $user[ 'last_name' ], 0, 1 );
			$data[ 'iniciales' ] = $initials;
			$data[ 'name' ] = $name;
			$data[ 'company' ] = $user[ 'short_name' ];
			$data[ 'session' ] = TRUE;
			$found = array_filter ( $permissions, function ( $item ) {
				return isset( $item[ 'name' ] ) && $item[ 'name' ] === 'main';
			} );
			if ( !empty( $found ) ) {
				$data = [ 'title' => 'SolveExpress | Adelanta Sueldo' ];
				$data[ 'main' ] = view ( 'main', [ 'permissions' => $permissions, 'bValidated' => $vigencia ] );
				if ( str_contains ( service ( 'request' )->getHeaderLine ( 'Accept-Encoding' ), 'gzip' ) ) {
					$this->response->setHeader ( 'Content-Encoding', 'gzip' );
					$this->response->setBody ( gzencode ( view ( 'plantilla', $data ) ) );
					return $this->response;
				}
				return view ( 'plantilla', $data );
			}
			$data [ 'title' ] = 'SolveExpress | Empresas';
			if ( str_contains ( service ( 'request' )->getHeaderLine ( 'Accept-Encoding' ), 'gzip' ) ) {
				$this->response->setHeader ( 'Content-Encoding', 'gzip' );
				$this->response->setBody ( gzencode ( view ( 'Company/main', $data ) ) );
				return $this->response;
			}
			return view ( 'Company/main', $data );
		}
		public function getLaws () {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$res = json_decode ( $data->getLaws ( $this->input[ 'type' ] ), TRUE );
			if ( $res[ 'error' ] != 200 ) {
				$this->serverError ( $res[ 'description' ], $res[ 'reason' ] );
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->errCode = 200;
			$this->responseBody = [
				'error'       => $this->errCode,
				'description' => 'Solicitud procesada',
				'response'    => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody );
		}
	}
