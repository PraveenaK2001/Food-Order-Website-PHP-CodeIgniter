<?php namespace App\Controllers;

use App\Models\CustomerModel;
use App\Models\RestModel;
use App\Models\ItemModel;

class UserController extends BaseController
{
	//Menu Page - Default Home Page
	public function index()
	{
		$nmodel=new ItemModel();
				$data['allitems']=$nmodel->getMenuItems();
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
	//Add Customer
	public function addCustomer()
	{
		
		if($this->request->getMethod()!=='post')
		{
		return view('users/cus-registration.php');	
		}
	

		$fields=[
			'cname' => 'required',
			'email' => 'required',
			'pass' => 'required',
			'address' => 'required',


			];

		$validated=$this->validate($fields);
		if(!$validated)
			{
				return view('users/cus-registration.php');
			}
			
		$model=new CustomerModel();
		$insert=$model->insert([
			'Name' => $this->request->getPost('cname'),
			'Email' => $this->request->getPost('email'),
			'Pass' => $this->request->getPost('pass'),
			'Address' => $this->request->getPost('address'),
			'fprefer' => $this->request->getPost('fprefer'),
		]);
		if($insert)
			{
					return redirect()->to('/FoodShala/public/');
			
			}
		else{
			return view('users/cus-registration.php');
		
		}	

	}


	//Restaurant Registration
	public function restaurantRegistration()
	{
		return view('users/res-registration.php');
	}
	
	//Add Restaurant
	public function addRest()
	{
		
		if($this->request->getMethod()!=='post')
		{
		return view('users/res-registration.php');	
		}
	

		$fields=[
			'cname' => 'required',
			'email' => 'required',
			'pass' => 'required',
			'address' => 'required',

			];

		$validated=$this->validate($fields);
		if(!$validated)
			{
				return view('users/res-registration.php');
			}
			
		$model=new RestModel();
		$insert=$model->insert([
			'Name' => $this->request->getPost('cname'),
			'Email' => $this->request->getPost('email'),
			'Pass' => $this->request->getPost('pass'),
			'Address' => $this->request->getPost('address'),
		]);
		if($insert)
			{
					return redirect()->to('/FoodShala/public/');
			
			}
		else{
			return view('users/res-registration.php');
		
		}	

	}
//UserAuthenticate
	public function userAuthenticate()
	{
		$email=$this->request->getPost('email');
		$pass=$this->request->getPost('pass');
		
		$db = \Config\Database::connect();
		//Check in customer table
		$sql = "SELECT * FROM customer_detail WHERE Email = ? and Pass = ?";
		$query2 = $db->query($sql, [$email, $pass]);
		$row = $query2->getRow();
		if($row)
			{
				$nmodel=new ItemModel();
				$data['allitems']=$nmodel->getMenuItems();
			
				$mySession=session();
				$sessiondata = [
        			'uid' => $row->Cust_Id,
        			'utype' => 'customer'
					];

				$mySession->set($sessiondata);
			
				return view('pages/home.php',$data);
				
			}
		else
			{
				//Check in restaurant table
				$sql = "SELECT * FROM rest_detail WHERE Email = ? and Pass = ?";
				$query2 = $db->query($sql, [$email, $pass]);
				$row = $query2->getRow();
				if($row)
					{
						$mySession=session();
						$sessiondata = [
        						'uid' => $row->Rest_Id,
        						'utype' => 'restaurant'
								];
						$mySession->set($sessiondata);
						
						$session = \Config\Services::session();
						$uid=$session->get('uid');

						$db = \Config\Database::connect();
						$sql = "SELECT * FROM order_detail WHERE RestId = ? and status = 0";
						$query = $db->query($sql, [$uid]);
						$data1['allitems']=$query->getResultArray();
						return view('pages/res-dashboard.php',$data1);

						
					}
				else
					{
						
						return view('users/user-login.php');		
					}
				
			}
		
	}
//User Logout
	//UserAuthenticate
	public function userLogout()
	{
		$session = \Config\Services::session();
		$array_items = ['uid', 'utype'];
		$session->remove($array_items);
		
		$nmodel=new ItemModel();
		$data['allitems']=$nmodel->getMenuItems();
		return view('pages/home.php',$data);
	}
	
	//--------------------------------------------------------------------

}
