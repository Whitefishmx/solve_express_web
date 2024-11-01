<?php
	
	namespace App\Controllers;
	
	use App\Models\DataModel;
	
	class CompanyController extends BaseController {
		public function getPeriods () {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$user = new DataModel();
			$session = session ();
			$company = $session->get ('user');
			var_dump ($company);
			die();
			$res = $user->getPeriods ($company);
			
		}
	}