<?php
namespace App\Models;
use CodeIgniter\Model;

class ItemModel extends Model
	{
		protected $table='menuitems';
		protected $allowedFields=['Rest_Id','Item_Id','Item_Type','Item_Name','Item_Cost','Rest_Name'];

		public function getMenuItems($slug=null)
			{
				if($slug===null)
				{
					return $this->findAll();
				}
			}
		

	}

