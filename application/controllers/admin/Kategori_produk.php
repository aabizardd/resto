<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kategori_produk extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('MProdukkategori','tb_produk_kategori');
        $this->load->library('form_validation');

        if ($this->inilogin->level != "Admin") {
            redirect(base_url('forbidden'));
        }
	}
	
	public function index()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Data Kategori Produk";
		$data['admincontent']		= "$this->url1/$this->url2/tampil";
		$this->load->view('admin_template', $data);
	}

	public function data_json()
    {
        $list = $this->tb_produk_kategori->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $tb_produk_kategori) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $tb_produk_kategori->id_produk_kategori;
            $row[] = $tb_produk_kategori->produk_kategori;
            $row[] = $tb_produk_kategori->produk_kategori_keterangan;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => @$_POST['draw'],
                        "recordsTotal" => $this->tb_produk_kategori->count_all(),
                        "recordsFiltered" => $this->tb_produk_kategori->count_filtered(),
                        "data" => $data,

                );
        //output to json format
        echo json_encode($output);
    }
 

	public function tambah()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Tambah Kategori Produk";

		if ($this->input->post('submit')) {

            $this->form_validation->set_rules('id_produk_kategori','ID produk Kategori','is_unique[tb_produk_kategori.id_produk_kategori]');
            
            if ($this->form_validation->run() === FALSE) {
                 $data['admincontent'] = "$this->url1/$this->url2/tambah";
                 $this->load->view('admin_template', $data); 
            } else {
                $a = $this->input->post('produk_kategori');
                $b = $this->input->post('produk_kategori_keterangan');

                $objek = array(
                    'produk_kategori' => $a,
                    'produk_kategori_keterangan' => $b );

                $query = $this->tb_produk_kategori->simpan($objek);

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
        $data['judul']      = "Edit Kategori Produk";
       
        if ($this->input->post('submit')) {

            $a = $this->input->post('produk_kategori');
            $b = $this->input->post('produk_kategori_keterangan');

            $objek = array(
                'produk_kategori' => $a,
                'produk_kategori_keterangan' => $b );

            $this->db->where('id_produk_kategori', $id);
            $this->db->update('tb_produk_kategori', $objek);
            
            if ($this->db->affected_rows()) {   
                $this->session->set_flashdata('berhasil_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            } else {
                $this->session->set_flashdata('gagal_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            }
        }
        else {
            $data['editdata'] = $this->db->get_where('tb_produk_kategori', array('id_produk_kategori' => $id))->row();
            $data['admincontent'] = "$this->url1/$this->url2/edit";
            $this->load->view('admin_template', $data);
        }
    }

    public function hapus()
    {
        $this->session->set_flashdata('berhasil_hapus','Berhasil' );
        $dataku=$this->input->post('dataku');
        $detail=$this->tb_produk_kategori->cek($dataku)->result();
        $this->tb_produk_kategori->hapus($dataku);
    }

}

/* End of file Kategori-produk.php */
/* Location: ./application/controllers/admin/Kategori-produk.php */