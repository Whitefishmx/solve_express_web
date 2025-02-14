<?php /** @noinspection PhpMultipleClassDeclarationsInspection */
	
	namespace App\Controllers;
	
	use CodeIgniter\Validation\Exceptions\ValidationException;
	use CodeIgniter\HTTP\ResponseInterface;
	use CodeIgniter\HTTP\RequestInterface;
	use CodeIgniter\HTTP\IncomingRequest;
	use CodeIgniter\HTTP\CLIRequest;
	use Psr\Log\LoggerInterface;
	use CodeIgniter\Controller;
	use Config\Services;
	use DateTime;
	
	abstract class BaseController extends Controller {
		public string $env          = 'LIVE';
		public int    $user         = 2;
		public int    $errCode      = 200;
		public array  $responseBody = [];
		public mixed  $input        = NULL;
		/**
		 * Instance of the main Request object.
		 *
		 * @var CLIRequest|IncomingRequest
		 */
		protected $request;
		/**
		 * An array of helpers to be loaded automatically upon
		 * class instantiation. These helpers will be available
		 * to all other controllers that extend BaseController.
		 *
		 * @var array
		 */
		protected $helpers = [ 'tools_helper' ];
		public function __construct () {
			$this->responseBody = [
				'error'       => $this->errCode,
				'description' => 'Sesión invalida',
				'reason'      => 'la sesión a caducado, vuelve a iniciar sesión' ];
		}
		/**
		 * @param RequestInterface  $request
		 * @param ResponseInterface $response
		 * @param LoggerInterface   $logger
		 *
		 * @return void
		 * @noinspection PhpMultipleClassDeclarationsInspection
		 */
		public function initController ( RequestInterface $request, ResponseInterface $response, LoggerInterface $logger ): void {
			// Do Not Edit This Line
			parent::initController ( $request, $response, $logger );
			// Preload any models, libraries, etc, here.
			// E.g.: $this->session = \Config\Services::session();
		}
		public function getResponse ( array $responseBody, int $code = ResponseInterface::HTTP_OK ): ResponseInterface {
			//			echo json_encode ( $responseBody );
			return $this->response->setStatusCode ( $code )->setJSON ( $responseBody )
			                      ->setHeader ( 'Access-Control-Allow-Origin', '*' )
			                      ->setHeader ( 'Content-Type', 'application/json' )
			                      ->setContentType ( 'application/json' );
		}
		/**
		 * Obtiene los datos que se reciben en la petición
		 *
		 * @param IncomingRequest $request
		 *
		 * @return array|bool|float|int|mixed|object|string|null
		 * @noinspection PhpDeprecationInspection
		 */
		public function getRequestInput ( IncomingRequest $request ): mixed {
			$method = strtolower ( $request->getMethod () );
			if ( $method === 'post' ) {
				$input = $request->getPost ();
			} else {
				$input = $request->getGet ();
			}
			if ( empty( $input ) ) {
				$input = json_decode ( $request->getBody (), TRUE );
			}
			return $input;
		}
		/**
		 * Decide el ambiente en el que trabajaran las funciones, por defecto SANDBOX
		 *
		 * @param mixed $env Variable con el ambiente a trabajar
		 *
		 * @return void Asigna el valor a la variable global
		 */
		public function environment ( mixed $env ): void {
			$this->env = isset( $env[ 'environment' ] ) ? strtoupper ( $env[ 'environment' ] ) : 'SANDBOX';
		}
		//====================================|| Errores HTTP ||====================================
		public function serverError ( $description, $reason ): array {
			$this->errCode = 500;
			$this->responseBody = [ 'error' => $this->errCode, 'description' => $description, 'reason' => $reason ];
			return $this->responseBody;
		}
		public function dataTypeNotAllowed ( $dataType ): array {
			$this->errCode = 400;
			$this->responseBody = [
				'error'       => $this->errCode,
				'description' => 'Tipo de dato invalido',
				'reason'      => 'Se esperaba contenido en formato ['.$dataType.']' ];
			return $this->responseBody;
		}
		public function methodNotAllowed ( $endpoint ): array {
			$this->errCode = 405;
			$this->responseBody = [
				'error'       => $this->errCode,
				'description' => 'Método no implementado',
				'reason'      => 'El método utilizado no coincide con el que solicita ['.$endpoint.']' ];
			return $this->responseBody;
		}
		public function errDataSuplied ( $reason ): array {
			$this->errCode = 400;
			$this->responseBody = [
				'error'       => $this->errCode,
				'description' => 'Datos de petición incorrectos',
				'reason'      => $reason ];
			return $this->responseBody;
		}
		public function redirectLogIn (): array {
			$this->errCode = 307;
			$this->responseBody = [
				'error'       => $this->errCode,
				'description' => 'Sesión invalida',
				'reason'      => 'la sesión a caducado, vuelve a iniciar sesión' ];
			return $this->responseBody;
		}
		//==========================================================================================
		//====================================|| Validaciones y filtros ||====================================
		/**
		 * Permite validar que el método y tipo de dato sean correctos al que solícita el recurso
		 *
		 * @param string      $method   Verbo requerido
		 * @param mixed       $request  Petición completa
		 * @param string|null $dataType Tipo de dato que se requiere
		 *
		 * @return array|bool
		 */
		public function verifyRules ( string $method, mixed $request, ?string $dataType ): array|bool {
			if ( !$request->is ( $method ) ) {
				return $this->methodNotAllowed ( $request->getPath () );
			}
			if ( !is_null ( $dataType ) ) {
				if ( !$request->is ( $dataType ) ) {
					return $this->dataTypeNotAllowed ( $dataType );
				}
			}
			return FALSE;
		}
		/**
		 * Válida que los datos de una petición cumpla con unas reglas específicas
		 *
		 * @param mixed $input    Petición de entrada
		 * @param mixed $rules    Reglas para la validación
		 * @param array $messages Mensaje de errores
		 *
		 * @return bool
		 */
		public function validateRequest ( mixed $input, mixed $rules, array $messages = [] ): bool {
			$this->validator = Services::validation ()->setRules ( $rules );
			if ( is_string ( $rules ) ) {
				$validation = config ( 'Validation' );
				if ( !isset( $validation->$rules ) ) {
					throw ValidationException::forRuleNotFound ( $rules );
				}
				if ( !$messages ) {
					$errorName = $rules.'_errors';
					$messages = $validation->$errorName ?? [];
				}
				$rules = $validation->$rules;
			}
			return $this->validator->setRules ( $rules, $messages )->run ( $input );
		}
		/**
		 * Preparar las fechas para los filtros
		 *
		 * @param mixed  $input fecha de inicio y término
		 * @param string $from
		 * @param string $to
		 *
		 * @return array
		 */
		public function dateFilter ( mixed $input, string $from, string $to ): array {
			$from = DateTime::createFromFormat ( 'Y-m-d', $input[ $from ] );
			$to = DateTime::createFromFormat ( 'Y-m-d', $input[ $to ] );
			$from = strtotime ( $from->format ( 'm/d/y' ).' -1day' );
			$to = strtotime ( $to->format ( 'm/d/y' ).' +1day' );
			return [ $from, $to ];
		}
		/**
		 * Valida si existe una session activa
		 * @return bool regresa true o false si esta una session activa
		 */
		public function validateSession (): bool {
			$session = session ();
			$login = $session->get ( 'logged_in' ) !== NULL ? $session->get ( 'logged_in' ) : FALSE;
			$session->set ( 'logged_in', $login );
			if ( $login ) {
				//				var_dump ( $session->get ( 'user' ) );
				//				die ();
				$this->user = $session->get ( 'user' )[ 'data' ][ 'id' ];
			} else {
				$this->errCode = 500;
			}
			return $login;
		}
	}
