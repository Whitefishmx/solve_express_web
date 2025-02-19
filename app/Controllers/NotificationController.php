<?php
	
	namespace App\Controllers;
	
	use App\Models\DataModel;
	use CodeIgniter\HTTP\ResponseInterface;
	
	class NotificationController extends BaseController {
		public function getNotifications (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$session = session ();
			$token = $session->get ( 'token' );
			$res = json_decode ( $data->getNotifications ( $token ), TRUE );
			if ( $res[ 'error' ] === 500 || $res[ 'error' ] === 404 ) {
				$this->serverError ( $res[ 'description' ], $res[ 'reason' ] );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->errCode = $res[ 'error' ];
			$this->responseBody = [ 'description' => $res[ 'description' ], 'response' => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
		public function readNotifications (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$session = session ();
			$token = $session->get ( 'token' );
			if ( count ( $this->input ) > 1 ) {
				$res = json_decode ( $data->readAllNotifications ( $this->input, $token ), TRUE );
			} else {
				$res = json_decode ( $data->readNotifications ( $this->input[ 'id' ], $token ), TRUE );
			}
			if ( $res[ 'error' ] === 500 || $res[ 'error' ] === 404 ) {
				$this->serverError ( $res[ 'description' ], $res[ 'reason' ] );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->errCode = $res[ 'error' ];
			$this->responseBody = [ 'description' => $res[ 'description' ], 'response' => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
		public function deleteNotifications (): ResponseInterface {
			$this->input = $this->getRequestInput ( $this->request );
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = new DataModel();
			$session = session ();
			$token = $session->get ( 'token' );
			if ( count ( $this->input ) > 1 ) {
				$res = json_decode ( $data->deleteAllNotifications ( $this->input, $token ), TRUE );
			} else {
				$res = json_decode ( $data->deleteNotifications ( $this->input[ 'id' ], $token ), TRUE );
			}
//			var_dump ($res);die();
			if ( $res[ 'error' ] === 500 || $res[ 'error' ] === 404 ) {
				$this->serverError ( $res[ 'description' ], $res[ 'reason' ] );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->errCode = $res[ 'error' ];
			$this->responseBody = [ 'description' => $res[ 'description' ], 'response' => $res[ 'response' ] ];
			return $this->getResponse ( $this->responseBody, $this->errCode );
		}
	}
