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
			$company = $session->get ( 'user' );
			$token = $session->get ( 'token' );
			$res = json_decode ( $user->getPeriods ( $company[ 'data' ][ 'company_id' ], $token ), TRUE );
			if ( $res[ 'error' ] != 200 ) {
				$this->errCode = $res[ 'error' ];
				$this->responseBody = [ 'description' => $res[ 'description' ], 'reason' => $res[ 'reason' ] ];
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->errCode = 200;
			$this->responseBody = [
				'error'       => $this->errCode,
				'description' => 'Reporte generado correctamente',
				'response'    => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody );
		}
	}