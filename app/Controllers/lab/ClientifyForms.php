<?php
	
	namespace App\Controllers\lab;
	
	use App\Controllers\BaseController;
	use CodeIgniter\HTTP\RedirectResponse;
	
	class ClientifyForms extends BaseController {
		public function index (): string|RedirectResponse {
			if ( $this->validateSession () ) {
				$data = [ 'main' => view ( 'formularios', [ 'session' => TRUE ] ), 'title' => 'LabCForms'  ];
				return view ( 'plantilla', $data );
			}
			return redirect ()->route ( 'signin' );
		}
	}