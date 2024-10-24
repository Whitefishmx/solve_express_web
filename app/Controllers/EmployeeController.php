<?php
	
	namespace App\Controllers;
	use App\Models\DataModel;
	use App\Controllers\BaseController;
	use CodeIgniter\HTTP\ResponseInterface;
	
	class EmployeeController extends BaseController {
		public function disposiciones (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$session = session ();
			$user = $session->get ( 'user' );
			$token = $session->get ( 'token' );
			$res = json_decode ( $data->getReport ( intval ($user['data']['id']), $token ), TRUE );
			if ( $res[ 'error' ] != 200 ) {
				$this->errCode = $res[ 'error' ];
				$this->responseBody=['description'=>$res[ 'description' ], 'reason'=>$res[ 'reason' ]];
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->errCode = 200;
			$this->responseBody = [
				'error'       => $this->errCode,
				'description' => 'Reporte generado correctamente',
				'response'      => $res['response']];
			return $this->getResponse ( $this->responseBody );
		}
		public function dashboard (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$session = session ();
			$user = $session->get ( 'user' );
			$token = $session->get ( 'token' );
			$res = json_decode ( $data->getDashboard ( intval ($user['data']['id']), $token ), TRUE );
			if ( $res[ 'error' ] != 200 ) {
				$this->errCode = $res[ 'error' ];
				$this->responseBody=['description'=>$res[ 'description' ], 'reason'=>$res[ 'reason' ]];
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->errCode = 200;
			$this->responseBody = [
				'error'       => $this->errCode,
				'description' => 'Reporte generado correctamente',
				'response'      => $res['response']];
			return $this->getResponse ( $this->responseBody );
		}
		public function requestPay (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$session = session ();
			$user = $session->get ( 'user' );
			$token = $session->get ( 'token' );
			$res = json_decode ( $data->requestPay ( intval ($user['data']['id']), $this->input['amount'],$token ), TRUE );
			if ( $res[ 'error' ] != 200 ) {
				$this->errCode = $res[ 'error' ];
				$this->responseBody=['description'=>$res[ 'description' ], 'reason'=>$res[ 'reason' ]];
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->errCode = 200;
			$this->responseBody = [
				'error'       => $this->errCode,
				'description' => 'Solicitud procesada',
				'response'      => $res['response']];
			return $this->getResponse ( $this->responseBody );
		}
	}