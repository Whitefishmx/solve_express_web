<?php
	
	namespace App\Models;
	
	use CodeIgniter\Model;
	use Config\Database;
	
	class BaseModel extends Model {
	
		public function __construct () {
			parent::__construct ();
		
		}
	
	}