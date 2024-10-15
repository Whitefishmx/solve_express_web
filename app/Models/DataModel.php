<?php
	
	namespace App\Models;
	
	use CodeIgniter\Model;
	use Config\Database;
	
	class DataModel extends BaseModel {
		private string $url = '';
		public function __construct () {
			parent::__construct ();
			if ( ENVIRONMENT === 'development' ) {
				$this->url = 'https://api-solve.local/';
			} else if ( ENVIRONMENT === 'production' ) {
				$this->url = 'https://api-solve.local/';
			} else {
				$this->url = 'https://api-solve.local/';
			}
		}
		public function signIn ( string $curp, string $password ) {
			$endPoint = 'toSignIn';
			$data = [
				'email'    => $curp,
				'password' => $password,
				'platform' => 5,
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON' );
		}
		public function getDashboard ( int $user, string $token ) {
			$endPoint = 'sExpressDashboard';
			$data = [
				'user' => $user,
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON', $token );
			//			return $this->sendRequestToken ();
		}
		public function getReport ( int $user, string $token ) {
			$endPoint = 'sExpressReport';
			$data = [
				'user' =>$user,
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON', $token );
		}
		private function SendRequest ( string $endpoint, array $data, ?string $method, ?string $dataType, string $token = NULL ): mixed {
			$method = !empty( $method ) ? strtoupper ( $method ) : 'POST';
			$resp = [ 'error' => 500, 'error_description' => 'OpenPayTransport' ];
			$data = json_encode ( $data );
			$headers = [];
			if ( strtoupper ( $dataType ) === 'JSON' ) {
				$headers[] = 'Content-Type: application/json';
			}
			if ( $token !== NULL ) {
				$headers[] = 'Authorization: Bearer '.trim ( $token );
			}
			if ( ( $ch = curl_init () ) ) {
				curl_setopt ( $ch, CURLOPT_URL, rtrim ( $this->url, '/' ).'/'.ltrim ( $endpoint, '/' ) );
				curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, TRUE );
				curl_setopt ( $ch, CURLOPT_TIMEOUT, 200 );
				curl_setopt ( $ch, CURLOPT_FOLLOWLOCATION, TRUE );
				curl_setopt ( $ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1 );
				if ( $method == 'POST' ) {
					curl_setopt ( $ch, CURLOPT_POST, TRUE );
				} else {
					curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, $method );
				}
				curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
				curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
								curl_setopt ( $ch, CURLINFO_HEADER_OUT, TRUE );
				curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
				curl_setopt ( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
				curl_setopt ( $ch, CURLOPT_SSL_VERIFYSTATUS, FALSE );
				$response = curl_exec ( $ch );
				$code = curl_getinfo ( $ch, CURLINFO_HTTP_CODE );
				if ( $response === FALSE ) {
					$error = 500;
					curl_close ( $ch );
					$resp = [ 'error' => 500, 'error_description' => 'SAPLocalTransport' ];
					$response = json_encode ( $resp );
				}
				curl_close ( $ch );
//								var_dump ( $headers );
//								var_dump ( "$this->url$endpoint/" );
//								var_dump ( curl_getinfo ( $ch, CURLINFO_HEADER_OUT ) );
//								var_dump ( json_encode ( $data ) );
//								var_dump ( $response );
				return $response;
			} else {
				$resp[ 'reason' ] = 'No se pudo inicializar cURL';
				$response = json_encode ( $resp );
			}
			return $response;
		}
	}