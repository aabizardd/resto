<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	var $data;

	public function __construct()
	{
		parent::__construct();
        $this->load->model('MLogin');
		
		$this->id_login   			= $this->session->userdata("id_user");
		$this->inilogin 			= $this->MLogin->dataloginku($this->id_login)->row();

		if (@$this->inilogin->level == "Admin") {
			redirect(base_url('admin/dashboard'));
		} else if (@$this->inilogin->level == "Pelayan") {
			redirect(base_url('pelayan/dashboard'));
		} else if (@$this->inilogin->level == "Koki") {
			redirect(base_url('koki/dashboard'));
		} else if (@$this->inilogin->level == "Kasir") {
			redirect(base_url('kasir/dashboard'));
		}

		$this->data = array(
            'web' => $this->MWeb->tampil()->row()
        );
	}

	public function index(){
		redirect(base_url('auth/login'));
	}

	public function login()
	{
		$data = $this->data;
		$this->load->view('auth/login', $data);
	}

	public function verification()
	{
		$data = $this->data;
		$id_user = $this->input->post('id_user');
		$password = $this->input->post('password');

		$where = array(
			'id_user' => $id_user,
			'password' => md5($password),
			'status' => "Aktif"
		);

		$query_cek_login	= $this->MLogin->login("tb_login", $where );
		$num_login 			= $query_cek_login->num_rows();

		if ($num_login > 0 ) {

			$data_session = array(
				'id_user' => $id_user,
				'status_login_scafe' => "scafe_berhasil"
			);

			// $this->id_login   			= $this->session->userdata("id_user");
			$this->inilogin 			= $this->MLogin->dataloginku($id_user)->row();

			if ($this->inilogin->level == "Admin") {
				$this->session->set_userdata($data_session);
				redirect(base_url('admin/dashboard'));
			} else if ($this->inilogin->level == "Pelayan") {
				$this->session->set_userdata($data_session);
				redirect(base_url('pelayan/dashboard'));
			} else if ($this->inilogin->level == "Koki") {
				$this->session->set_userdata($data_session);
				redirect(base_url('koki/dashboard'));
			} else if ($this->inilogin->level == "Kasir") {
				$this->session->set_userdata($data_session);
				redirect(base_url('kasir/dashboard'));
			};

			
		} else {
			$this->session->set_flashdata('gagal_login', 'gagal');
			redirect(base_url('auth/login'));
		}
	}

}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */