<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        if ($this->inilogin->level != "Admin") {
            redirect(base_url('forbidden'));
        }
    }

    public function index()
    {
        redirect(base_url("admin/dashboard"));
    }

    public function setting()
    {
        $this->load->view('admin_template');

    }

}

/* End of file Admin.php */
/* Location: ./application/controllers/admin/Admin.php */