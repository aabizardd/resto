<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Meja extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('MMeja','tb_meja');
        $this->load->library('form_validation');

        if ($this->inilogin->level != "Admin") {
            redirect(base_url('forbidden'));
        }
	}
	
	public function index()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Data Meja";
		$data['admincontent']		= "$this->url1/$this->url2/tampil";
		$this->load->view('admin_template', $data);
	}

	public function data_json()
    {
        $list = $this->tb_meja->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $tb_meja) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $tb_meja->id_meja;
            $row[] = $tb_meja->nama_meja;
            $row[] = $tb_meja->keterangan_meja;
            $row[] = $tb_meja->status_meja;
 
            $data[] = $row;
        }
 
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->tb_meja->count_all(),
            "recordsFiltered" => $this->tb_meja->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
 

	public function tambah()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Tambah Meja";

		if ($this->input->post('submit')) {

            $this->form_validation->set_rules('id_meja','ID Meja','is_unique[tb_meja.id_meja]');
            
            if ($this->form_validation->run() === FALSE) {
                 $data['admincontent'] = "$this->url1/$this->url2/tambah";
                 $this->load->view('admin_template', $data); 
            } else {
                $a = $this->input->post('nama_meja');
                $b = $this->input->post('keterangan_meja');
                $c = $this->input->post('status_meja');

                $objek = array(
                    'nama_meja' => $a,
                    'keterangan_meja' => $b,
                    'status_meja' => $c );

                $query = $this->tb_meja->simpan($objek);

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
        $data['judul']      = "Edit Meja";
       
        if ($this->input->post('submit')) {

            $a = $this->input->post('nama_meja');
            $b = $this->input->post('keterangan_meja');
            $c = $this->input->post('status_meja');

            $objek = array(
                    'nama_meja' => $a,
                    'keterangan_meja' => $b,
                    'status_meja' => $c );

            $this->db->where('id_meja', $id);
            $this->db->update('tb_meja', $objek);
            
            if ($this->db->affected_rows()) {   
                $this->session->set_flashdata('berhasil_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            } else {
                $this->session->set_flashdata('gagal_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            }
        }
        else {
            $data['editdata'] = $this->db->get_where('tb_meja', array('id_meja' => $id))->row();
            $data['admincontent'] = "$this->url1/$this->url2/edit";
            $this->load->view('admin_template', $data);
        }
    }

    public function hapus()
    {
        $this->session->set_flashdata('berhasil_hapus','Berhasil' );
        $dataku=$this->input->post('dataku');
        $detail=$this->tb_meja->cek($dataku)->result();
        $this->tb_meja->hapus($dataku);
    }

}

/* End of file Kategori-produk.php */
/* Location: ./application/controllers/admin/Kategori-produk.php */