<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{	
		$this->load->view('registeruser');
	}
	
	public function signin()
	{	
		$this->load->view('loginuser');
	}
	
	public function login()
	{	
		//print_r($session_data);die;
	  	$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		
	  	//echo $num_rows;die;
		if ($this->form_validation->run() == FALSE)
		{
				$data['error']='<font color=red>Please provide all details</font>';
				$this->load->view('loginuser',$data);
		}
		else
		{	
			//echo $name;die;
			$this->load->model('User_model');
			$user_info=$this->User_model->login();
			
			if($user_info != '0')
			{
				$this->load->library('session');				//Session set
				 
				$session_data = array(
					   'userid'  =>$user_info[0]['ID'],
					   'name'=>$user_info[0]['username'],
					   'logged_in' => TRUE
				   );
				//print_r($session_data);
				$this->session->set_userdata($session_data);
				$this->load->view('header');
				$this->load->view('home');
				$this->load->view('footer');
			} 
			else {
			$data['error']='<font color=red>Wrong Email or Password.</font>';
			$this->load->view('loginuser',$data);
			}
				
		}	
	}
	
	public function register()
	{	
		
	  	$this->form_validation->set_rules('fname', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('email', 'Email', 'valid_email');
		
	  	//echo $num_rows;die;
		if ($this->form_validation->run() == FALSE)
		{
				$data['error']='<font color=red>Please provide all details</font>';
				$this->load->view('registeruser',$data);
		}
		else
		{	
			$name=$this->input->post('fname');
			//echo $name;die;
			$this->load->model('User_model');
			$user_info=$this->User_model->register();
			
			if($user_info != '0')
			{
				
				 
				$session_data = array(
					   'userid'  =>$user_info,
					   'name'=>$name,
					   'logged_in' => TRUE
				   );
				//print_r($session_data);
				$this->session->set_userdata($session_data);
				$this->load->view('home');
			} 
			else {
			$data['error']='<font color=red>An account with this email already exists.</font>';
			$this->load->view('registeruser',$data);
			}
				
		}	
	}
	public function profile()
	{
		$this->load->model('User_model');
		$user_info=$this->User_model->user_profile();
		$this->parser->parse('profile', $user_info);
	}
	
	public function ui_handler()
	{
		$this->load->library('UI');
		$return=UI::handle_UI('users','dropdown');
		
	}
	
	public function logout()
	{
		$session_data = array(
					   'userid'  =>'',
					   'name'=>'',
					   'logged_in' => FALSE
				   );
		$this->session->unset_userdata($session_data);
		$this->load->view('loginuser');
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */