<?php
	
	namespace App\Controllers;
	
	use App\Models\BlueBullModel;
	use CodeIgniter\HTTP\RedirectResponse;
	use CodeIgniter\HTTP\ResponseInterface;
	
	class BlueBullController extends BaseController {
		public function index (): string|RedirectResponse {
			if ( $this->validateSession () ) {
				$data = [ 'main' => view ( 'bluebull', [ 'session' => TRUE ] ) ];
				return view ( 'plantilla', $data );
			}
			return redirect ()->route ( 'signin' );
		}
		/**
		 * Permite obtener el límite de crédito de un RFC ingresado
		 * @return ResponseInterface|bool
		 */
		public function searchRfc (): ResponseInterface|bool {
			$this->input = $this->getRequestInput ( $this->request );
			if ( !$this->validateSession () ) {
				$this->redirectLogIn ();
				$this->logResponse ( 2 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			if ( $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				$this->logResponse ( 2 );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$data = $this->prepareData ();
			$bBull = new BlueBullModel();
			$fichas = $bBull->consultaFichas ( $data, $this->env );
			if ( !$fichas[ 0 ] ) {
				$this->serverError ( 'Error con el RFC ingresado', $fichas[ 1 ] );
				$this->logResponse ( 2, $data );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$limite = array_map ( function ( $value ) use ( $bBull ) {
				return $bBull->consultaLimite ( $value, $this->env );
			}, $fichas );
			if ( count ( $limite ) === 1 && !$limite[ 0 ] ) {
				$this->serverError ( 'Error con el RFC ingresado.', $limite[ 1 ] );
				$this->logResponse ( 2, $fichas );
				return $this->getResponse ( $this->responseBody, $this->errCode );
			}
			$this->logResponse ( 2, $data, $limite );
			return $this->getResponse ( $limite );
		}
		/**
		 * Prepara la información para buscar los rfc en Blue Bull
		 * @return array
		 */
		private function prepareData (): array {
			if ( !isset( $_FILES[ 'letter' ] ) || $_FILES[ 'letter' ][ 'error' ] !== UPLOAD_ERR_OK ) {
				return [ 'rfc' => $this->input[ 'rfc' ], 'base64' => '', 'type' => 'jpeg', ];
			}
			$uploadedFile = $_FILES[ 'letter' ];
			$base64 = base64_encode ( file_get_contents ( $uploadedFile[ 'tmp_name' ] ) );
			return [
				'rfc'    => $this->input[ 'rfc' ],
				'base64' => $base64,
				'type'   => explode ( '/', $uploadedFile[ 'type' ] )[ 1 ], ];
		}
	}