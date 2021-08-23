<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forbidden extends MY_Controller {

	public function index()
	{
		$data = $this->data;
		$data['judul']				= "Akses Ditolak";
		$data['admincontent']		= "page/forbidden";
		$this->load->view('admin_template', $data);
	}
}

/* End of file Forbidden.php */
/* Location: ./application/controllers/Forbidden.php */