<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function __construct()
{
	parent::__construct();
	$this->id_login   			= $this->session->userdata("id_user");
	$this->inilogin 			= $this->MLogin->dataloginku($this->id_login)->row();

	if ($this->inilogin->level == "Admin") {
		redirect(base_url('admin/dashboard'));
	} else if ($this->inilogin->level == "Pelayan") {
		redirect(base_url('pelayan/dashboard'));
	} else if ($this->inilogin->level == "Koki") {
		redirect(base_url('koki/dashboard'));
	} else if ($this->inilogin->level == "Kasir") {
		redirect(base_url('kasir/dashboard'));
	} ;
}

/* End of file session_helper.php */
/* Location: ./application/helpers/session_helper.php */