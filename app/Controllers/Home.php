<?php
	
	namespace App\Controllers;
	
	use CodeIgniter\HTTP\RedirectResponse;
	
	class Home extends BaseController {
		public function index (): string|RedirectResponse {
//			die();
//			if ( $this->validateSession () ) {
			$data = [ 'main' => view ( 'main' ), 'session' => FALSE  ];
			return view ( 'plantilla', $data );
//			}
//			return redirect ( 'signin' );
		}
	}
