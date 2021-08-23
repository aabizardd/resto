<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pkaryawan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        // $id_login  = $this->session->userdata("id_user");

        $this->load->model('MPkaryawan','tb_pkaryawan');
        $this->load->model('MKaryawan');

        $this->load->library('form_validation');

        if ($this->inilogin->level != "Admin") {
            redirect(base_url('forbidden'));
        }
	}
	
	public function index()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Data Pengguna";
		$data['admincontent']		= "$this->url1/$this->url2/tampil";
		$this->load->view('admin_template', $data);
	}

	public function data_json()
    {
        $list = $this->tb_pkaryawan->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $tb_pkaryawan) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $tb_pkaryawan->id_user;
            $row[] = $tb_pkaryawan->id_karyawan;
            $row[] = $tb_pkaryawan->nama_karyawan;
            $row[] = $tb_pkaryawan->status;
            $row[] = $tb_pkaryawan->level; 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => @$_POST['draw'],
                        "recordsTotal" => $this->tb_pkaryawan->count_all(),
                        "recordsFiltered" => $this->tb_pkaryawan->count_filtered(),
                        "data" => $data,

                );
        //output to json format
        echo json_encode($output);
    }
 

	public function tambah()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Tambah Data Pengguna";
		$data['datakaryawan']			= $this->MKaryawan->tampil()->result_array();
		if ($this->input->post('submit')) {

            $this->form_validation->set_rules('id_user','ID User','is_unique[tb_login.id_user]');
            $this->form_validation->set_rules('id_user_detail_karyawan','ID karyawan','is_unique[tb_login.id_user_detail_karyawan]');
            $this->form_validation->set_rules('password', 'Password', 'required');
            
            if ($this->form_validation->run() === FALSE) {
                 $data['admincontent'] = "$this->url1/$this->url2/tambah";
                 $this->load->view('admin_template', $data); 
            } else {
                $a = $this->input->post('id_user');
                $b = $this->input->post('password');
                $c = $this->input->post('id_user_detail_karyawan');
                $d = $this->input->post('status');
                $e = $this->input->post('level');
                
                $objek = array(
                    'id_user' => $a,
                    'password' => md5($b),
                    'id_user_detail_karyawan' => $c,
                    'status' => $d,
                    'level' => $e );

                $query = $this->tb_pkaryawan->simpan($objek);

                if ($query) {
                    $this->session->set_flashdata('berhasil_simpan', 'sukses');
                    redirect(base_url("$this->url1/$this->url2"));
                }
            }

        } else {
            $data['admincontent'] = "$this->url1/$this->url2/tambah";
            $this->load->view('admin_template', $data); 
        }
	}

    public function edit($id)
    {
        $data               = $this->data;
        $data['judul']      = "Edit Data Pengguna";
        $data['datakaryawan']           = $this->MKaryawan->tampil()->result_array();

        if ($this->input->post('submit')) {

            $a = $this->input->post('id_user');
            $c = $this->input->post('id_user_detail_karyawan');
            $d = $this->input->post('status');
            $e = $this->input->post('level');
            
            $objek = array(
                'id_user' => $a,
                'id_user_detail_karyawan' => $c,
                'status' => $d,
                'level' => $e );

            $this->db->where('id_user', $id);
            $this->db->update('tb_login', $objek);
            
            if ($this->db->affected_rows()) {   
                $this->session->set_flashdata('berhasil_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            } else {
                $this->session->set_flashdata('gagal_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            }
        } else if ($this->input->post('updatepassword')) {

            $f = $this->input->post('password');
            
            $objek = array(
                'password' => $f );

            $this->db->where('id_user', $id);
            $this->db->update('tb_login', $objek);
            
            if ($this->db->affected_rows()) {   
                $this->session->set_flashdata('berhasil_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            } else {
                $this->session->set_flashdata('gagal_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            }
        } else {
            $data['editdata'] = $this->tb_pkaryawan->detail($id)->row();
            $data['admincontent'] = "$this->url1/$this->url2/edit";
            $this->load->view('admin_template', $data);
        }
    }

    public function hapus()
    {
        $this->session->set_flashdata('berhasil_hapus','Berhasil' );
        $dataku=$this->input->post('dataku');
        $detail=$this->tb_pkaryawan->cek($dataku)->result();
        $this->tb_pkaryawan->hapus($dataku);
    }

}

/* End of file Pkaryawan.php */
/* Location: ./application/controllers/admin/Pkaryawan.php */