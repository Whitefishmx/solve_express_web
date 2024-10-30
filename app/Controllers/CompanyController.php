<?php
	
	namespace App\Controllers;
	use App\Controllers\BaseController;
	
	class CompanyController extends BaseController {
		public function index(): string {
			return view ( 'Company/main' );
		}
	}