<?php namespace App\Controllers;

use App\Models\ItemModel;
use App\Models\CartModel;
use App\Models\Order_Record;


class ItemController extends BaseController
{
	//Menu Page - Default Home Page
	public function index($page='home')
	{
		$nmodel=new ItemModel();
				$data['allitems']=$nmodel->getMenuItems();
				return view('pages/home.php',$data);
	}
	//Create new menu item
	public function createMenuItem()
	{
		$session = \Config\Services::session();
		if($session->get('utype')!=="restaurant")
			return view('users/user-login.php');	

		if($this->request->getMethod()!=='post')
		{
		return view('pages/new-menu-item.php');	
		}
	

		$fields=[
			'iname' => 'required',
			'itype' => 'required',
			'icost' => 'required',
			];

		$validated=$this->validate($fields);
		if(!$validated)
			{
				return view('pages/new-menu-item.php');
			}

		$uid=$session->get('uid');


		$db = \Config\Database::connect();
		$sql = "SELECT Name FROM rest_detail WHERE Rest_Id = ?";
		$query2 = $db->query($sql, [$uid]);
		$row   = $query2->getRow();		
		$uname=$row->Name;



		$model=new ItemModel();
		$insert=$model->insert([
			'Item_Name' => $this->request->getPost('iname'),
			'Item_Type' => $this->request->getPost('itype'),
			'Rest_Id' => $uid,
			'Item_Cost' => intval($this->request->getPost('icost')),	
			'Rest_Name' => $uname,
		]);
		if($insert)
			{
					return redirect()->to('/FoodShala/public/my-res-menu');
			
			}
		else{
			return view('pages/new-menu-item.php');
		
		}	
	}
	//Add Item to Cart
	public function addToCart($ItemId)
	{

		$session = \Config\Services::session();
		if($session->get('utype')!=="customer")
			return view('users/user-login.php');		
		$uid=$session->get('uid');
		$db = \Config\Database::connect();

		$q = $db->query('SELECT * FROM menuitems WHERE Item_Id = ?',$ItemId);
		$row   = $q->getRow();		


		$model=new CartModel();
		$insert=$model->insert([
						'Cust_Id' => $uid,
						'Item_Id' => $ItemId,
						'Item_Name' => $row->Item_Name,
						'Item_Cost' => $row->Item_Cost,
						'Item_Type' => $row->Item_Type,
						'Rest_Id' => $row->Rest_Id,
						]);
		
		return redirect()->to('/FoodShala/public/');
      	
	}
	//View  Cart Items
	public function viewCart()
	{
		$session = \Config\Services::session();
		if($session->get('utype')!=="customer")
			return view('users/user-login.php');
		$uid=$session->get('uid');

		$db = \Config\Database::connect();
		$sql = "SELECT * FROM cart WHERE Cust_Id = ? and Status = 0";
		$query2 = $db->query($sql, [$uid]);
		$data['allitems']=$query2->getResultArray();
		
		return view('pages/view-cart.php',$data);
	}
	//Delete Item from Cart
	public function removeFromCart($ItemId)
	{

		$db = \Config\Database::connect();
		$q = $db->query('delete FROM cart WHERE Item_Id = ?',$ItemId);
		return redirect()->to('/FoodShala/public/view-cart');
      	
	}

//Delete Menu Item from Menu
	public function removeFromMenu($ItemId)
	{

		$db = \Config\Database::connect();
		$q = $db->query('delete FROM menuitems WHERE Item_Id = ?',$ItemId);
		return redirect()->to('/FoodShala/public/my-res-menu');
      	
	}
	//Place order for items in cart
	public function placeOrder()
	{

		$session = \Config\Services::session();
		if($session->get('utype')!=="customer")
			return view('users/user-login.php');		
		$uid=$session->get('uid');
		$db = \Config\Database::connect();

		$sql = "SELECT * FROM cart WHERE Cust_Id = ? and Status = 0";
		$query2 = $db->query($sql, [$uid]);
		$data=$query2->getResultArray();
		
		$model=new Order_Record();
		
		foreach($data as $row)

		{
			$model->insert([
						'RestId' =>$row["Rest_Id"],
						'itemId' =>$row["Item_Id"],
						'status' => 0,
						'CustId' => $row["Cust_Id"],
						'IName' => $row["Item_Name"],
						]);
		

		}
			$db->query('update cart set status = 1  WHERE Cust_Id = ?',$uid);				
		
		return redirect()->to('/FoodShala/public/order-placed');
      
	}
//Place order for items in cart
	public function viewOrder()
	{

		$session = \Config\Services::session();
		if($session->get('utype')!=="customer")
			return view('users/user-login.php');		
		$uid=$session->get('uid');

		$db = \Config\Database::connect();

		$sql = "SELECT * FROM order_detail WHERE CustId = ? and status = 0";
		$query2 = $db->query($sql, [$uid]);
		$data['allitems']=$query2->getResultArray();
		
		
		return view('pages/order-placed.php',$data);
      
	}

	//Mark order delivered
	public function markDeliver($order_id)
	{

		$session = \Config\Services::session();
		if($session->get('utype')!=="restaurant")
			return view('users/user-login.php');		
		$uid=$session->get('uid');
		$db = \Config\Database::connect();

		$db->query('update order_detail set status = 1  WHERE  orderid= ?',$order_id);				
		

		$db = \Config\Database::connect();
		$sql = "SELECT * FROM order_detail WHERE RestId = ? and status = 0";
		$query = $db->query($sql, [$uid]);
		$data1['allitems']=$query->getResultArray();
		return view('pages/res-dashboard.php',$data1);
      
	}
	//--------------------------------------------------------------------

}
