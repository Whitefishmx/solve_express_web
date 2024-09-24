<?php
	
	namespace App\Controllers;
	
	use CodeIgniter\HTTP\RedirectResponse;
	
	class SimuladorController extends BaseController {
		private array $formularios = [
			1  => [ 'DURANGO', 'MUNICIPIO DE DURANGO', ],
			9  => [ 'AHOME', 'MUNICIPIO DE AHOME', ],
			11 => [ 'CAZEL', 'INDUSTRIAS CAZEL', ],
			12 => [ 'SEED', 'SEED DURANGO', ],
			16 => [ 'ROO', 'ESTADO DE QUINTANA ROO', ],
			17 => [ 'BIOSINSA', 'BIOSINSA', ],
			20 => [ 'TRANSPORTES', 'TRANSPORTES CAZEL', ],
			21 => [ 'SONORA', 'ESTADO DE SONORA', ],
		];
		public function index (): string|RedirectResponse {
			if ( $this->validateSession () ) {
				return view ( 'simulador', [ 'session' => TRUE, 'title' => 'Simulador' ] );
				/*$data = [ 'main' => view ( 'simulador', [ 'session' => TRUE ] ), 'title' => 'Simulador' ];
				return view ( 'plantilla', $data );*/
			}
			return redirect ()->route ( 'signin' );
		}
		public function biosinsa (): string|RedirectResponse {
			if ( $this->validateSession () ) {
				return view ( 'formularios/BIOSINSA', [ 'session' => TRUE, 'title' => 'BIOSINSA' ] );
			}
			return redirect ()->route ( 'signin' );
		}
		public function displayForm ( $number ): string|RedirectResponse {
			return view ( "formularios/{$this->formularios[$number][0]}", [
				'session' => TRUE,
				'title'   => "{$this->formularios[$number][1]}" ] );
		}
		public function saveFormData (): bool|array|RedirectResponse {
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return ( $data );
			}
			$input = $this->getRequestInput ( $this->request );
			$this->environment ( $input );
			createLog ( "formularios", json_encode ( $input ) );
			return redirect ()->to ( "displayForm/{$input['origen']}", 301, 'location' );
		}
		public function alone (): string|RedirectResponse {
			return view ( 'simuladorAlone', [ 'session' => TRUE, 'title' => 'Simulador' ] );
		}
	}