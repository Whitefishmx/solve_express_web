<?php
	
	namespace App\Models;
	class DataModel extends BaseModel {
		private string $url;
		public function __construct () {
			parent::__construct ();
						if ( ENVIRONMENT === 'development' ) {
							$this->url = 'https://api-solve.local/';
						} else if ( ENVIRONMENT === 'production' ) {
							$this->url = 'https://api-solve.local/';
						} else {
							$this->url = 'https://api-solve.local/';
						}
//			if ( ENVIRONMENT === 'development' ) {
//				$this->url = 'https://sandbox.solvegcm.mx/';
//			} else if ( ENVIRONMENT === 'production' ) {
//				$this->url = 'https://sandbox.solvegcm.mx/';
//			} else {
//				$this->url = 'https://sandbox.solvegcm.mx/';
//			}
		}
		private function SendRequest ( string $endpoint, array $data, ?string $method, ?string $dataType, ?string $token = NULL ): string|bool {
			$method = !empty( $method ) ? strtoupper ( $method ) : 'POST';
			$resp = [ 'error' => 500, 'error_description' => 'SolveAPITransport' ];
			$headers = [];
			if ( strtoupper ( $dataType ) === 'JSON' && $method != 'GET' ) {
				$data = json_encode ( $data );
				$headers[] = 'Content-Type: application/json';
			} else if ( $method === 'GET' ) {
				$query = http_build_query ( $data );
				$endpoint .= '?'.$query;
				$data = NULL; // No enviamos cuerpo en GET
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
				if ( $method === 'POST' ) {
					curl_setopt ( $ch, CURLOPT_POST, TRUE );
					curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
				} else if ( $method === 'GET' ) {
					curl_setopt ( $ch, CURLOPT_HTTPGET, TRUE );
				} else {
					curl_setopt ( $ch, CURLOPT_CUSTOMREQUEST, $method );
					if ( $data ) {
						curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
					}
				}
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
					$resp = [ 'error' => $error, 'error_description' => 'SAPLocalTransport' ];
					$response = json_encode ( $resp );
				}
				curl_close ( $ch );
//												var_dump ( $headers);echo PHP_EOL;
//												var_dump ( "$this->url$endpoint/" );echo PHP_EOL;
//												var_dump ( curl_getinfo ( $ch, CURLINFO_HEADER_OUT ) );echo PHP_EOL;
//												var_dump ( json_encode ( $data ) );echo PHP_EOL;
//												var_dump ( $response );echo PHP_EOL;
//												die();
				return $response;
			} else {
				$resp[ 'reason' ] = 'No se pudo inicializar cURL';
				$response = json_encode ( $resp );
			}
			return $response;
		}
		public function setUser ( string $nickname, string $email, string $password, string $password2, mixed $user, ?string $phone = NULL ): bool|string {
			$endPoint = 'setUser';
			$data = [
				'user'        => $user,
				'nickName'    => $nickname,
				"email"       => $email,
				'contraseña'  => $password,
				'contraseña2' => $password2,
			];
			if ( $phone !== NULL ) {
				$data[ 'phone' ] = $phone;
			}
			return $this->SendRequest ( $endPoint, $data, 'PATCH', 'JSON' );
		}
		public function getReportCompany ( array $args, $company, $token ): bool|string {
			$endPoint = 'sExpressReportCompany';
			$data = [
				'company'  => $company,
				'initDate' => $args[ 'date1' ],
				'endDate'  => $args[ 'date2' ],
				'period'   => $args[ 'period' ],
				'rfc'      => $args[ 'rfc' ],
				'curp'     => $args[ 'curp' ],
				'name'     => $args[ 'name' ],
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON', $token );
		}
		public function validateCurp ( string $curp, string $fingerprint ): bool|string {
			$endPoint = 'sExpressVerifyCurp';
			$data = [
				'curp'        => $curp,
				'fingerprint' => $fingerprint,
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON' );
		}
		public function requestPay ( int $user, $amount, string $token ): bool|string {
			$endPoint = 'sExpressRequest';
			$data = [
				'user'   => $user,
				"amount" => $amount,
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON', $token );
		}
		public function getPeriods ( int $company, string $token ): bool|string {
			$endPoint = 'sExpressPeriods';
			$data = [
				'company' => $company,
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON', $token );
		}
		public function getDashboard ( int $user, string $token ): bool|string {
			$endPoint = 'sExpressDashboard';
			$data = [
				'user' => $user,
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON', $token );
			//			return $this->sendRequestToken ();
		}
		public function signIn ( string $curp, string $password ): bool|string {
			$endPoint = 'toSignIn';
			$data = [
				'email'    => $curp,
				'password' => $password,
				'platform' => 6,
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON' );
		}
		public function getReport ( int $user, string $token ): bool|string {
			$endPoint = 'sExpressReport';
			$data = [
				'user' => $user,
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON', $token );
		}
		public function getPayments ( int $company, string $token ): bool|string {
			$endPoint = 'sExpressPayments';
			$data = [
				'company' => $company,
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON', $token );
		}
		public function getEmployees ( array $args, $company, $token ): bool|string {
			$endPoint = 'sExpressEmployees';
			$data = [
				'company'    => $company,
				'hiringDate' => $args[ 'hiringDate' ],
				'fireDate'   => $args[ 'fireDate' ],
				'rfc'        => $args[ 'rfcFire' ],
				'curp'       => $args[ 'curpFire' ],
				'name'       => $args[ 'nameFire' ],
				'fire'       => $args[ 'fire' ],
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON', $token );
		}
		public function getProfile ( int $user, string $token ): bool|string {
			$endPoint = 'sExpressProfile';
			$data = [
				'user' => $user,
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON', $token );
		}
		public function getLaws ( string $type ): bool|string {
			$endPoint = 'getLawsText';
			$data = [
				'type'     => $type,
				'platform' => 6,
			];
			return $this->SendRequest ( $endPoint, $data, 'GET', NULL );
		}
		public function fireEmployee ( $employee, $company, $token ): bool|string {
			$endPoint = 'sExpressFireOne';
			$data = [
				'employee' => $employee,
				'company'  => $company,
			];
			return $this->SendRequest ( $endPoint, $data, 'DELETE', 'JSON', $token );
		}
		public function initRecovery ( string $curp ): bool|string {
			$endPoint = 'sExpressInitRecovery';
			$data = [
				'email' => $curp,
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON' );
		}
		public function verifyCode ( string $code, string $user ): bool|string {
			$endPoint = 'sExpressValidateCode';
			$data = [
				'code' => $code,
				'user' => $user,
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON' );
		}
		public function reportDetail ( $company, $period, $token ): bool|string {
			$endPoint = 'sExpressPaymentDetail';
			$data = [
				'company' => $company,
				'period'  => $period,
			];
			return $this->SendRequest ( $endPoint, $data, 'POST', 'JSON', $token );
		}
		public function resetPassword ( mixed $user, string $code, string $password, string $password2 ): bool|string {
			$endPoint = 'resetPassword';
			$data = [
				'user'      => $user,
				"code"      => $code,
				'password'  => $password,
				'password2' => $password2,
			];
			return $this->SendRequest ( $endPoint, $data, 'PATCH', 'JSON' );
		}
		public function getBenefits ( string $token ): bool|string {
			$endPoint = 'sExpressGetBenefits';
			$data = [];
			return $this->SendRequest ( $endPoint, $data, 'POST', NULL, $token );
		}
		public function verifyBenefits ( string $token ): bool|string {
			$endPoint = 'sExpressValidateBenefits';
			$data = [];
			return $this->SendRequest ( $endPoint, $data, 'POST', NULL, $token );
		}
		public function getCerts ( string $token ): bool|string {
			$endPoint = 'sExpressGetCerts';
			$data = [];
			return $this->SendRequest ( $endPoint, $data, 'POST', NULL, $token );
		}
		public function getNotifications ( string $token ): bool|string {
			$endPoint = 'getNotifications';
			$data = [];
			return $this->SendRequest ( $endPoint, $data, 'POST', NULL, $token );
		}
		public function readNotifications ( int $id, string $token ): bool|string {
			$endPoint = 'readNotifications';
			$data = [ "id" => $id ];
			return $this->SendRequest ( $endPoint, $data, 'POST', NULL, $token );
		}
		public function readAllNotifications ($ids, string $token ): bool|string {
			$endPoint = 'readNotifications';
			return $this->SendRequest  ( $endPoint, $ids, 'POST', 'JSON' , $token );
		}
		public function deleteAllNotifications ($ids, string $token ): bool|string {
			$endPoint = 'deleteNotifications';
			return $this->SendRequest  ( $endPoint, $ids, 'POST', 'JSON' , $token );
		}
		public function deleteNotifications ( int $id, string $token ): bool|string {
			$endPoint = 'deleteNotifications';
			$data = [ "id" => $id ];
			return $this->SendRequest ( $endPoint, $data, 'POST', NULL, $token );
		}
	}