<?php
namespace App\Models;
use CodeIgniter\Model;

class Order_Record extends Model
	{
		protected $table='order_detail';
		protected $allowedFields=['orderid','RestId','itemId','status','CustId','IName'];

		public function getuOrderDetail($slug=null)
			{
				if($slug===null)
				{
					return $this->findAll();
				}
			}
		

	}

