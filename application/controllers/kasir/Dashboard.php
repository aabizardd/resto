<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	 if ($this->inilogin->level != "Kasir" ) {
            if ($this->inilogin->level !="Admin") {
                # code...
                            redirect(base_url('forbidden'));

            }
        }
	}

	public function index()
	{
		$data = $this->data;
		$data['judul']			= "Dashboard";
		$data['admincontent']	= "admin_content";
		$this->load->view('admin_template', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/kasir/Dashboard.php */