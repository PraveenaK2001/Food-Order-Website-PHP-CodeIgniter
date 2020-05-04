<?php
namespace App\Models;
use CodeIgniter\Model;

class CustomerModel extends Model
	{
		protected $table='customer_detail';
		protected $allowedFields=['Cust_Id','Name','Email','Pass','Address','fprefer'];

		public function getCustDetail($slug=null)
			{
				if($slug===null)
				{
					return $this->findAll();
				}
			}
		

	}

