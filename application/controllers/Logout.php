<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends CI_Controller {

	public function index()
	{
		$this->session->sess_destroy();
		redirect(base_url('auth/login'));
	}

}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */