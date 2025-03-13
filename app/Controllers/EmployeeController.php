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
			$res = json_decode ( $data->getReport ( intval ( $user[ 'data' ][ 'id' ] ), $token ), TRUE );
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
			$res = json_decode ( $data->getDashboard ( intval ( $user[ 'data' ][ 'id' ] ), $token ), TRUE );
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
			$res = json_decode ( $data->requestPay ( intval ( $user[ 'data' ][ 'id' ] ), $this->input[ 'amount' ], $token ), TRUE );
			if ( $res[ 'error' ] != 200 ) {
				$this->serverError ( $res[ 'description' ], $res[ 'reason' ] );
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->errCode = 200;
			$this->responseBody = [
				'error'       => $this->errCode,
				'description' => 'Solicitud procesada',
				'response'    => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody );
		}
		public function validarCurp () {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$session = session ();
			$token = $session->get ( 'token' );
			$res = json_decode ( $data->validateCurp ( $this->input[ 'curp' ], $this->input[ 'fingerprint' ] ), TRUE );
			//			var_dump ($res);die();
			if ( $res[ 'error' ] === 500 || $res[ 'error' ] === 404 ) {
				$this->serverError ( $res[ 'description' ], $res[ 'reason' ] );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->errCode = $res[ 'error' ];
			$this->responseBody = [ 'description' => $res[ 'description' ], 'response' => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
		public function setUser () {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, 'JSON' ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$phone = isset( $this->input[ 'phone' ] ) && $this->input[ 'phone' ] !== '' ? $this->input[ 'phone' ] : NULL;
			$res = json_decode ( $data->setUser ( $this->input[ 'nickName' ], $this->input[ 'email' ], $this->input[ 'password' ], $this->input[ 'password2' ],
				$this->input[ 'user' ], $phone ), TRUE );
			if ( intval ( $res[ 'error' ] ) !== 200 ) {
				$this->responseBody = [
					"error"       => $this->errCode = $res[ 'error' ],
					"description" => $res[ 'description' ],
					"reason"      => $res[ 'reason' ],
				];
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->errCode = $res[ 'error' ];
			$this->responseBody = [ 'description' => $res[ 'description' ], 'response' => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
		public function getLaws () {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				//				$this->logResponse ( 1 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$res = json_decode ( $data->getLaws ( $this->input[ 'type' ] ), TRUE );
			//			var_dump ($res);die();
			if ( $res[ 'error' ] === 500 || $res[ 'error' ] === 404 ) {
				$this->responseBody = [ 'error' => $this->errCode = $res[ 'error' ], 'description' => $res[ 'description' ], 'reason' => $res[ 'reason' ] ];
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			//			var_dump ($res);die ( );
			$this->responseBody = [ 'error' => $this->errCode = $res[ 'error' ], 'description' => $res[ 'description' ], 'response' => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
		public function getBenefits () {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$session = session ();
			$token = $session->get ( 'token' );
			$res = json_decode ( $data->getBenefits ( $token ), TRUE );
			if ( $res[ 'error' ] === 500 || $res[ 'error' ] === 404 ) {
				$this->responseBody = [ 'error' => $this->errCode = $res[ 'error' ], 'description' => $res[ 'description' ], 'reason' => $res[ 'reason' ] ];
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->responseBody = [ 'error' => $this->errCode = $res[ 'error' ], 'description' => $res[ 'description' ], 'response' => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
		public function getCerts () {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$session = session ();
			$token = $session->get ( 'token' );
			$res = json_decode ( $data->getCerts ( $token ), TRUE );
			if ( $res[ 'error' ] === 500 || $res[ 'error' ] === 404 ) {
				$this->responseBody = [ 'error' => $this->errCode = $res[ 'error' ], 'description' => $res[ 'description' ], 'reason' => $res[ 'reason' ] ];
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->responseBody = [ 'error' => $this->errCode = $res[ 'error' ], 'description' => $res[ 'description' ], 'response' => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
	}