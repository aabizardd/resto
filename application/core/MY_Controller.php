<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('MLogin');

		if ($this->session->userdata('status_login_scafe') != 'scafe_berhasil') {
            redirect(base_url('auth/login'));

        };

        
        $this->id_login   			= $this->session->userdata("id_user");
		$this->inilogin 			= $this->MLogin->dataloginku($this->id_login)->row();
		

		if ($this->inilogin->level == "Admin") {
			$this->datalogin		= $this->MLogin->dataloginkaryawan($this->id_login)->row();
		} else if ($this->inilogin->level == "Pelayan") {
			$this->datalogin 		= $this->MLogin->dataloginkaryawan($this->id_login)->row();
		} else if ($this->inilogin->level == "Koki") {
			$this->datalogin 		= $this->MLogin->dataloginkaryawan($this->id_login)->row();
		} else if ($this->inilogin->level == "Kasir") {
			$this->datalogin 		= $this->MLogin->dataloginkaryawan($this->id_login)->row();
		};

		
		$this->url1 = $this->uri->segment("1");
		$this->url2 = $this->uri->segment("2");
		$this->url3 = $this->uri->segment("3");
		
		$this->data = array(
            'web' => $this->MWeb->tampil()->row()
        );
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/core/MY_Controller.php */