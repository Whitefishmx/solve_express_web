<?php
	
	namespace App\Controllers;
	use App\Controllers\BaseController;
	use CodeIgniter\HTTP\RedirectResponse;
	use CodeIgniter\HTTP\ResponseInterface;
	
	class FaqsController extends BaseController {
		public function index (): string|RedirectResponse|ResponseInterface {
			if ( !$this->validateSession () ) {
				return redirect ( 'signIn' );
			}
			$session = session ();
			$user = $session->get ( 'user' )[ 'data' ];
			$name = $user[ 'name' ].' '.$user[ 'last_name' ];
			$initials = substr ( $user[ 'name' ], 0, 1 ).substr ( $user[ 'last_name' ], 0, 1 );
			$data[ 'iniciales' ] = $initials;
			$data[ 'name' ] = $name;
			$data[ 'company' ] = $user[ 'short_name' ];
			$data[ 'session' ] = TRUE;
			$data [ 'title' ] = 'SolveExpress | Perfil';
			if ( str_contains ( service ( 'request' )->getHeaderLine ( 'Accept-Encoding' ), 'gzip' ) ) {
				$this->response->setHeader('Content-Encoding', 'gzip');
				$this->response->setBody(gzencode(view('Company/tutorials', $data )));
				return $this->response;
			}
			return view ( 'Company/tutorials' );
		}
	}