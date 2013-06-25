<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
	
	public function index()
	{	
		
	}
	
	public function email()
	{	
		$this->email->from('', 'Your Name');
		$this->email->to(''); 
		$this->email->cc(''); 
		$this->email->bcc(''); 
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');	
		$this->email->send();
	}
	
}

/* End of file email.php */
/* Location: ./application/controllers/email.php */