<?php
	
	namespace App\Controllers;
	
	use CodeIgniter\HTTP\RedirectResponse;
	
	class Home extends BaseController {
		public function index (): string|RedirectResponse {
			if ( !$this->validateSession () ) {
				return redirect ( 'signIn' );
			}
			$session = session ();
			$permissions = json_decode (json_encode ($session->get ( 'user' )['permissions'][0]), true);;
//			var_dump ($permissions['name'] === 'main');
//			die();
			if ($permissions['name'] === 'main'){
				$data = [ 'main' => view ( 'main' ), 'session' => FALSE ];
				return view ( 'plantilla', $data );
			}
			return view ( 'Company/main' );
		}
	}
