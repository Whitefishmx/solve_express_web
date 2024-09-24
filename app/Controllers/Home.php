<?php
	
	namespace App\Controllers;
	
	use CodeIgniter\HTTP\RedirectResponse;
	
	class Home extends BaseController {
		public function index (): string|RedirectResponse {
			if ( $this->validateSession () ) {
				return view ( 'header' ) . view ( 'main' ) . view ( 'footer' );
			}
			return redirect ( 'http://bluebull.local/signin' );
		}
	}
