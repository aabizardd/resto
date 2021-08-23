<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $id_login  = $this->session->userdata("id_user");

        $this->load->model('MKaryawan','tb_karyawan');
        $this->load->model('MLogin');

        $this->load->library('form_validation');

        if ($this->inilogin->level != "Admin") {
            redirect(base_url('forbidden'));
        }
	}
	
	public function index()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Data Karyawan";
		$data['admincontent']		= "$this->url1/$this->url2/tampil";
		$this->load->view('admin_template', $data);
	}

	public function data_json()
    {
        $list = $this->tb_karyawan->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $tb_karyawan) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $tb_karyawan->id_karyawan;
            $row[] = $tb_karyawan->nama_karyawan;
            $row[] = $tb_karyawan->jenis_kelamin_karyawan;
            $row[] = $tb_karyawan->tempat_lahir_karyawan;
            $row[] = $tb_karyawan->tgl_lahir_karyawan;
            $row[] = $tb_karyawan->agama_karyawan;
            $row[] = $tb_karyawan->alamat_karyawan;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => @$_POST['draw'],
                        "recordsTotal" => $this->tb_karyawan->count_all(),
                        "recordsFiltered" => $this->tb_karyawan->count_filtered(),
                        "data" => $data,

                );
        //output to json format
        echo json_encode($output);
    }
 

	public function tambah()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Tambah Data Karyawan";

		if ($this->input->post('submit')) {

            $this->form_validation->set_rules('id_karyawan','ID Karyawan','is_unique[tb_karyawan.id_karyawan]');
            
            if ($this->form_validation->run() === FALSE) {
                 $data['admincontent'] = "$this->url1/$this->url2/tambah";
                 $this->load->view('admin_template', $data); 
            } else {
                $b = $this->input->post('nama_karyawan');
                $d = $this->input->post('jenis_kelamin_karyawan');
                $e = $this->input->post('tempat_lahir_karyawan');
                $f = $this->input->post('tgl_lahir_karyawan');
                $g = $this->input->post('agama_karyawan');
                $h = $this->input->post('alamat_karyawan');

                $objek = array(
                    'nama_karyawan' => $b,
                    'jenis_kelamin_karyawan' => $d,
                    'tempat_lahir_karyawan' => $e,
                    'tgl_lahir_karyawan' => $f,
                    'agama_karyawan' => $g,
                    'alamat_karyawan' => $h,
                    'foto_karyawan' => "user.jpg" );

                $query = $this->tb_karyawan->simpan($objek);

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
        $data['judul']      = "Edit Data karyawan";
       
        if ($this->input->post('submit')) {

                $b = $this->input->post('nama_karyawan');
                $d = $this->input->post('jenis_kelamin_karyawan');
                $e = $this->input->post('tempat_lahir_karyawan');
                $f = $this->input->post('tgl_lahir_karyawan');
                $g = $this->input->post('agama_karyawan');
                $h = $this->input->post('alamat_karyawan');

                $objek = array(
                    'nama_karyawan' => $b,
                    'jenis_kelamin_karyawan' => $d,
                    'tempat_lahir_karyawan' => $e,
                    'tgl_lahir_karyawan' => $f,
                    'agama_karyawan' => $g,
                    'alamat_karyawan' => $h );

            $this->db->where('id_karyawan', $id);
            $this->db->update('tb_karyawan', $objek);
            
            if ($this->db->affected_rows()) {   
                $this->session->set_flashdata('berhasil_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            } else {
                $this->session->set_flashdata('gagal_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            }
        }
        else {
            $data['editdata'] = $this->db->get_where('tb_karyawan', array('id_karyawan' => $id))->row();
            $data['admincontent'] = "$this->url1/$this->url2/edit";
            $this->load->view('admin_template', $data);
        }
    }

    public function hapus()
    {
        $this->session->set_flashdata('berhasil_hapus','Berhasil' );
        $dataku=$this->input->post('dataku');
        $detail=$this->tb_karyawan->cek($dataku)->result();
        $this->tb_karyawan->hapus($dataku);
    }

}

/* End of file karyawan.php */
/* Location: ./application/controllers/karyawan.php */