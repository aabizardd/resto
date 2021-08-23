<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class About extends MY_Controller {

	public function index()
	{
		$data = $this->data;
		$data['judul']				= "About";
		$data['admincontent']		= "page/about";
		$this->load->view('admin_template', $data);
	}

}

/* End of file About.php */
/* Location: ./application/controllers/About.php */