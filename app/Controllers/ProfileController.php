<?php
	
	namespace App\Controllers;
	
	use App\Models\UserModel;
	use CodeIgniter\HTTP\ResponseInterface;
	
	class ProfileController extends BaseController {
		/**
		 * Válida si un nickname ya está en uso
		 * @return ResponseInterface|bool
		 */
		public function validateNickname (): ResponseInterface|bool {
			if ( $data = $this->verifyRules ( 'POST', $this->request, NULL ) ) {
				return ( $data );
			}
			$input = $this->getRequestInput ( $this->request );
			$validation = service ( 'validation' );
			$validation->setRules ( [ 'nickname' => 'required|max_length[15]', ],
				[ 'nickname' => [ 'max_length' => 'El nickName no debe tener mas de {param} caracteres' ] ] );
			if ( !$validation->run ( $input ) ) {
				$errors = $validation->getErrors ();
				return $this->errDataSuplied ( $errors );
			}
			$user = new UserModel();
			$res = $user->searchNickname ( $input[ 'nickname' ] );
			if ( $res[ 0 ] ) {
				return $this->getResponse ( [ 'error' => 200, 'description' => 'correcto', 'reason' => 'Nickname disponible' ] );
			}
			return $this->serverError ( 'Nickname invalido', 'El nickname ingresado ya esta en uso' );
		}
	}
