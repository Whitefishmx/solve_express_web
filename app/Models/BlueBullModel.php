<?php
	
	namespace App\Models;
	class BlueBullModel extends BaseModel {
		private array $sandbox = [
			'sandbox' => [
				'url'  => 'https://sad.bluebull.mx/demob/integrador_wsdl.php',
				'user' => 'VATORO.INTEGRADOR',
				'pass' => '#0987#qrte12' ] ];
		private array $live    = [
			'gob' => [
				'url'  => 'https://sad.bluebull.mx/gobsonora/integrador_wsdl.php',
				'user' => 'VATORO.INTEGRADOR',
				'pass' => '#0987#qrte12' ],
			'edu' => [
				'url'  => 'https://sad.bluebull.mx/edusonora/integrador_wsdl.php',
				'user' => 'VATORO.INTEGRADOR',
				'pass' => '#1357#adgji15' ] ];
		/**
		 * Consulta la ficha de un rfc
		 *
		 * @param array       $args [rfc, cartaBase64, extensionImagen]
		 * @param string|NULL $env  Ambiente en el que se va a trabajar
		 *
		 * @return bool|array Devuelve los fichas para consulta de límite
		 */
		public function consultaFichas ( array $args, string $env = NULL ): bool|array {
			$this->environment = $env === NULL ? $this->environment : $env;
			$credentials = strtoupper ( $this->environment ) === 'SANDBOX' ? $this->sandbox : $this->live;
			$endpoint = 'CONSULTAFICHAS';
			$links = [];
			foreach ( $credentials as $value => $row ) {
				$data = "
				<login>{$row['user']}</login>
				<contrasena>{$row['pass']}</contrasena>
				<rfc>{$args['rfc']}</rfc>
                <documento_autorizacion_datos>
                <![CDATA[data:image/{$args['type']};base64,{$args['base64']}]]>
                </documento_autorizacion_datos>";
				$res = $this->sendRequest ( $row[ 'url' ], $data, $endpoint );
				libxml_use_internal_errors ( TRUE );
				$xml = simplexml_load_string ( $res );
				if ( $xml === FALSE ) {
					$links[] = [ FALSE, 'Error al consultar Blue Bull', $value ];
				}
				if ( isset( $xml->transaccion->error ) ) {
					$links[] = [ FALSE, (string)$xml->transaccion->error->descripcion, $value ];
				}
				foreach ( $xml->transaccion->vinculo as $vinculo ) {
					$links[] = [
						'ficha'         => (string)$vinculo->ficha,
						'rfc'           => (string)$vinculo->rfc,
						'nomina'        => (string)$vinculo->nomina,
						'clave'         => (string)$vinculo->clave,
						'nombre'        => (string)$vinculo->nombre,
						'tipo_limite'   => (string)$vinculo->tipo_limite,
						'limite_actual' => (string)$vinculo->limite_actual,
						'puesto'        => (string)$vinculo->puesto,
						'estable'       => (string)$vinculo->estable,
						'nacimiento'    => (string)$vinculo->nacimiento,
						'origen'        => $value,
					];
				}
			}
			$error = array_filter ( $links, function ( $link ) {
				return !isset( $link[ 'rfc' ] );
			} );
			if ( count ( $error ) === count ( $links ) ) {
				return [ FALSE, 'No se encontró el RFC' ];
			}
			$links = array_diff_key ( $links, $error );
			return array_values ( $links );
		}
		/**
		 * Consulta el límite de crédito de una ficha
		 *
		 * @param array       $args [rfc, cartaBase64, extensionImagen]
		 * @param string|NULL $env  Ambiente en el que se va a trabajar
		 *
		 * @return bool|array Devuelve los fichas para consulta de límite
		 */
		public function consultaLimite ( array $args, string $env = NULL ): bool|array {
			$this->environment = $env === NULL ? $this->environment : $env;
			$credentials = strtoupper ( $this->environment ) === 'SANDBOX' ? $this->sandbox : $this->live;
			$endpoint = 'CONSULTALIMITE';
			$data =
				"<login>{$credentials[$args['origen']]['user']}</login>
			<contrasena>{$credentials[$args['origen']]['pass']}</contrasena>
			<ficha>{$args['ficha']}</ficha>
            <rfc>{$args['rfc']}</rfc>
            <nomina>{$args['nomina']}</nomina>
            <clave>{$args['clave']}</clave>";
			$res = $this->sendRequest ( $credentials[ $args[ 'origen' ] ][ 'url' ], $data, $endpoint );
			libxml_use_internal_errors ( TRUE );
			$xml = simplexml_load_string ( $res );
			if ( $xml === FALSE ) {
				return [ FALSE, 'Error al consultar Blue Bull' ];
			}
			$transactionArray = [];
			foreach ( $xml->transaccion->children () as $child ) {
				$transactionArray[ $child->getName () ] = (string)$child;
			}
			return $transactionArray;
		}
		public
		function sendRequest ( string $url, string $data, string $endpoint ): bool|string {
			$curl = curl_init ();
			curl_setopt_array ( $curl, [
				CURLOPT_URL            => $url,
				CURLOPT_RETURNTRANSFER => TRUE,
				CURLOPT_ENCODING       => '',
				CURLOPT_MAXREDIRS      => 10,
				CURLOPT_TIMEOUT        => 0,
				CURLOPT_FOLLOWLOCATION => TRUE,
				CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST  => 'POST',
				CURLOPT_POSTFIELDS     => [
					'transaccion' =>
						"<transacciones>
							<transaccion type='$endpoint'>
								<id>1</id>
								$data
							</transaccion>
							</transacciones>" ], ] );
			$response = curl_exec ( $curl );
			curl_close ( $curl );
			return $response;
		}
	}