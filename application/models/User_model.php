<?php
class User_model extends CI_Model
{
	function index()
	{	
		//echo "i am in model  PARENT file"; 
		parent::Model();
	}

	/*
	Function    :: Login User
	Description :: Signs in an existing user if already exists.An Email is associated with an account only once.
	Last update :: 18th June 2013
	Module      :: User Management
	*/
	function login()
	{		
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$query=$this->db->query("SELECT password,ID,username FROM  users WHERE email='".$email."'");
			$data = $query->result_array();
			$encrypted_password = $this->encrypt->decode($data[0]['password']);
			if($password==$encrypted_password) {	
			return $data;
			}
			else {
					return '0';
			}
	}
	/*
	Function    :: Register User
	Description :: Creates a new user if no user with email exists.An Email is associated with an account only once.
	Last update :: 18th June 2013
	Module      :: User Management
	*/
	function register()
	{	
			$fname = $this->input->post('fname');
			$password = $this->input->post('password');
			$email = $this->input->post('email');
			$query=$this->db->query("SELECT ID FROM  users WHERE email='".$email."'");
			if($query->num_rows()=='0') {	
			$encrypted_password = $this->encrypt->encode($password);
			$insert_query=$this->db->query("INSERT INTO users (username,password,email,addedOn,userstatus) 
									  VALUES('".$fname."','".$encrypted_password."','".$email."',NOW(),'0')");
			return $this->db->insert_id();
			}
			else {
					return '0';
			}
	}
	/*
	Function    :: Profile User
	Description :: Update user profile by pre-filled data.
	Last update :: 25th June 2013
	Module      :: User Management
	*/
	function user_profile()
	{		
			session_start();
			$query = $this->db->query("SELECT * FROM users WHERE ID='".$this->session->userdata('userid')."'");
			$data = $query->result_array();
			$this->load->library('parser');
			$data = array(
              'username'   => $data[0]['username'],
			  'email'=> $data[0]['email']
            );
			return $data;
	}
	
}
?>