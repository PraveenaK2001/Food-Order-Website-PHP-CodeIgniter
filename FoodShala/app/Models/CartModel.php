<?php
namespace App\Models;
use CodeIgniter\Model;

class CartModel extends Model
	{
		protected $table='cart';
		protected $allowedFields=['Rest_Id','Item_Id','Item_Type','Item_Name','Item_Cost','Status','Cust_Id'];

		public function getCartItems($slug=null)
			{
				if($slug===null)
				{
					return $this->findAll();
				}
			}
		

	}

