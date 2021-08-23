<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Padmin extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        // $id_login  = $this->session->userdata("id_user");

        $this->load->model('MPadmin','tb_padmin');
        $this->load->model('MGuru');

        $this->load->library('form_validation');

        if ($this->inilogin->level != "Admin") {
            redirect(base_url('forbidden'));
        }
	}
	
	public function index()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Data Pengguna Admin";
		$data['admincontent']		= "$this->url1/$this->url2/tampil";
		$this->load->view('admin_template', $data);
	}

	public function data_json()
    {
        $list = $this->tb_padmin->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $tb_padmin) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $tb_padmin->id_user;
            $row[] = $tb_padmin->id_guru;
            $row[] = $tb_padmin->nama_guru;
            $row[] = $tb_padmin->status;
            $row[] = $tb_padmin->level; 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => @$_POST['draw'],
                        "recordsTotal" => $this->tb_padmin->count_all(),
                        "recordsFiltered" => $this->tb_padmin->count_filtered(),
                        "data" => $data,

                );
        //output to json format
        echo json_encode($output);
    }
 

	public function tambah()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Tambah Data Pengguna Admin";
		$data['dataguru']			= $this->MGuru->tampil()->result_array();
		if ($this->input->post('submit')) {

            $this->form_validation->set_rules('id_user','ID User','is_unique[tb_login.id_user]');
            $this->form_validation->set_rules('id_user_detail_guru','ID Guru','is_unique[tb_login.id_user_detail_guru]');
            
            if ($this->form_validation->run() === FALSE) {
                 $data['admincontent'] = "$this->url1/$this->url2/tambah";
                 $this->load->view('admin_template', $data); 
            } else {
                $a = $this->input->post('id_user');
                $b = $this->input->post('password');
                $c = $this->input->post('id_user_detail_guru');
                $d = $this->input->post('status');
                
                $objek = array(
                    'id_user' => $a,
                    'password' => md5($b),
                    'id_user_detail_guru' => $c,
                    'status' => $d,
                    'level' => 'Admin' );

                $query = $this->tb_padmin->simpan($objek);

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
        $data['judul']      = "Edit Data Pengguna Admin";
        $data['datasiswa']  = $this->MGuru->tampil()->result_array();

        if ($this->input->post('submit')) {

                $b = $this->input->post('password');
                $d = $this->input->post('status');
                
                $objek = array(
                    'password' => md5($b),
                    'status' => $d, );

            $this->db->where('id_user', $id);
            $this->db->update('tb_login', $objek);
            
            if ($this->db->affected_rows()) {   
                $this->session->set_flashdata('berhasil_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            } else {
                $this->session->set_flashdata('gagal_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            }
        }
        else {
            $data['editdata'] = $this->db->get_where('tb_login', array('id_user' => $id))->row();
            $data['admincontent'] = "$this->url1/$this->url2/edit";
            $this->load->view('admin_template', $data);
        }
    }

    public function hapus()
    {
        $this->session->set_flashdata('berhasil_hapus','Berhasil' );
        $dataku=$this->input->post('dataku');
        $detail=$this->tb_padmin->cek($dataku)->result();
        $this->tb_padmin->hapus($dataku);
    }

}

/* End of file Pguru.php */
/* Location: ./application/controllers/admin/Pguru.php */