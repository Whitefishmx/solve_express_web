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
			if ( str_contains ( service ( 'request' )->getHeaderLine ( 'Accept-Encoding' ), 'gzip' ) ) {
				$this->response->setHeader('Content-Encoding', 'gzip');
				$this->response->setBody(gzencode(view('Company/tutorials' )));
				return $this->response;
			}
			return view ( 'Company/tutorials' );
		}
	}