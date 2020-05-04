<?php
namespace App\Models;
use CodeIgniter\Model;

class RestModel extends Model
	{
		protected $table='rest_detail';
		protected $allowedFields=['Rest_Id','Name','Email','Pass','Address'];

		public function getCustDetail($slug=null)
			{
				if($slug===null)
				{
					return $this->findAll();
				}
			}
		

	}

