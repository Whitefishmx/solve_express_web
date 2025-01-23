<?php
	
	namespace App\Controllers;
	
	use App\Models\DataModel;
	use CodeIgniter\HTTP\ResponseInterface;
	
	class CompanyController extends BaseController {
		private DataModel $data;
		public function __construct () {
			parent::__construct ();
			$this->data = new DataModel();
		}
		public function getPeriods (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$session = session ();
			$company = $session->get ( 'user' );
			$token = $session->get ( 'token' );
			//			var_dump ( $company);die ();
			$res = json_decode ( $this->data->getPeriods ( $company[ 'data' ][ 'company_id' ], $token ), TRUE );
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
		public function reportCompany (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$session = session ();
			$company = $session->get ( 'company' );
			$token = $session->get ( 'token' );
			$res = json_decode ( $this->data->getReportCompany ( $this->input, $company, $token ), TRUE );
			//			var_dump ($res);die();
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
		public function getInfo (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$session = session ();
			$company = $session->get ( 'user' );
			$token = $session->get ( 'token' );
			return $this->getResponse ( [ "u" => $company[ 'data' ][ 'id' ], "c" => $company[ 'data' ][ 'company_id' ], "t" => $token ], 200 );
		}
		public function getEmployees (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$session = session ();
			$company = $session->get ( 'user' );
			$token = $session->get ( 'token' );
			$res = json_decode ( $this->data->getEmployees ( $this->input, $company[ 'data' ][ 'company_id' ], $token ), TRUE );
			//						var_dump ( $res );die();
			$this->responseBody = [
				'error'       => $this->errCode = $res[ 'error' ],
				'description' => 'Reporte generado correctamente',
				'response'    => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
		public function getPayments (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$session = session ();
			$company = $session->get ( 'user' );
			$token = $session->get ( 'token' );
			$res = json_decode ( $this->data->getPayments ( $company[ 'data' ][ 'company_id' ], $token ), TRUE );
			//						var_dump ( $res );die();
			$this->responseBody = [
				'error'       => $this->errCode = $res[ 'error' ],
				'description' => 'Reporte generado correctamente',
				'response'    => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
		public function fireEmployee (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $this->verifyRules ( 'DELETE', $this->request, NULL ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$session = session ();
			$company = $session->get ( 'user' );
			$token = $session->get ( 'token' );
			$res = json_decode ( $this->data->fireEmployee ( $this->input[ 'employee' ], $company[ 'data' ][ 'company_id' ], $token ), TRUE );
			//			var_dump ( $res );die();
			$this->responseBody = [
				'error'       => $this->errCode = $res[ 'error' ],
				'description' => 'Reporte generado correctamente',
				'response'    => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
		public function getPaymentsDetails (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$session = session ();
			$company = $session->get ( 'user' );
			$token = $session->get ( 'token' );
			$res = json_decode ( $this->data->reportDetail ( $company[ 'data' ][ 'company_id' ], $this->input[ 'period' ], $token ), TRUE );
			$this->responseBody = [
				'error'       => $this->errCode = $res[ 'error' ],
				'description' => 'Reporte generado correctamente',
				'response'    => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
	}