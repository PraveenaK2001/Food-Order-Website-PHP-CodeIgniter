<?php namespace App\Controllers;

use App\Models\ItemModel;

class Home extends BaseController
{
	//Menu Page - Default Home Page

	public function index($page='home')
	{
		
		$this->model=new ItemModel();
		$data['allitems']=$this->model->getMenuItems();
		
		return view('pages/home.php',$data);	
		
		


	}
	//userLogin Page
	public function userLogin()
	{
		return view('users/user-login.php');
	}
	//User Registration
	public function userRegistration()
	{
		return view('users/user-registration.php');
	}
	//Customer Registration
	public function customerRegistration()
	{
		return view('users/cus-registration.php');
	}
	//Restaurant Registration
	public function restaurantRegistration()
	{
		return view('users/res-registration.php');
	}
	//Restaurant Dashboard
	public function resDashboard()
	{
		$session = \Config\Services::session();
		if($session->get('utype')!=="restaurant")
			return view('users/user-login.php');
		
		$uid=$session->get('uid');

		$db = \Config\Database::connect();
		$sql = "SELECT * FROM order_detail WHERE RestId = ? and status = 0";
		$query = $db->query($sql, [$uid]);
		$data1['allitems']=$query->getResultArray();
		return view('pages/res-dashboard.php',$data1);
	}
	//My Restaurant Menu
	public function myResMenu()
	{
		$session = \Config\Services::session();
		if($session->get('utype')!=="restaurant")
			return view('users/user-login.php');
		$uid=$session->get('uid');

		$db = \Config\Database::connect();
		$sql = "SELECT * FROM menuitems WHERE Rest_Id = ?";
		$query2 = $db->query($sql, [$uid]);
		$data['allitems']=$query2->getResultArray();

		return view('pages/my-res-menu.php',$data);
	}


	//--------------------------------------------------------------------

}
