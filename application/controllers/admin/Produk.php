<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $this->load->model('MProduk','tb_produk');
        $this->load->model('MProdukkategori');
        $this->load->library('form_validation');

        if ($this->inilogin->level != "Admin") {
            redirect(base_url('forbidden'));
        }
	}
	
	public function index()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Data Produk";
		$data['admincontent']		= "$this->url1/$this->url2/tampil";
		$this->load->view('admin_template', $data);
	}

	public function data_json()
    {
        $list = $this->tb_produk->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $tb_produk) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $tb_produk->id_produk;
            $row[] = $tb_produk->nama_produk;
            $row[] = $tb_produk->produk_kategori;
            $row[] = $tb_produk->harga_produk;
            $row[] = $tb_produk->keterangan_produk;
            $row[] = $tb_produk->diskon;
            $row[] = "<img src='".base_url('assets/images/produk/'."$tb_produk->foto_produk")."' width='100px'>";
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => @$_POST['draw'],
                        "recordsTotal" => $this->tb_produk->count_all(),
                        "recordsFiltered" => $this->tb_produk->count_filtered(),
                        "data" => $data,

                );
        //output to json format
        echo json_encode($output);
    }
 

	public function tambah()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Tambah Kategori Produk";
        $data['dataprodukkategori'] = $this->MProdukkategori->tampil()->result_array();

		if ($this->input->post('submit')) {

            $this->form_validation->set_rules('id_produk','ID Produk','is_unique[tb_produk.id_produk]');
            
            if ($this->form_validation->run() === FALSE) {
                 $data['admincontent'] = "$this->url1/$this->url2/tambah";
                 $this->load->view('admin_template', $data); 
            } else {
                $a = $this->input->post('produk_kategori');
                $b = $this->input->post('produk_kategori_keterangan');

                $config['upload_path']          = './assets/images/produk/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('foto_produk'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    $this->session->set_flashdata('gagal_upload','Gagal' , $error);
                    redirect(base_url("$this->url1/$this->url2"));
                }
                else
                {
                    $data = array('upload_data' => $this->upload->data());
                    $x = $this->upload->data();
                    $a = $this->input->post('id_produk_kategori');
                    $b = $this->input->post('nama_produk');
                    $c = $this->input->post('harga_produk');
                    $d = $this->input->post('keterangan_produk');
                    $e = $this->input->post('diskon');

                    $objek = array(
                        'id_produk_kategori' => $a,
                        'nama_produk' => $b,
                        'harga_produk' => $c,
                        'keterangan_produk' => $d,
                        'diskon' => $e,
                        'foto_produk' => $x['file_name'] );

                    $query = $this->tb_produk->simpan($objek);

                    $this->session->set_flashdata('berhasil_upload','Berhasil' );
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
        $data['judul']      = "Edit Produk";
        $data['dataprodukkategori'] = $this->MProdukkategori->tampil()->result_array();
       
        if ($this->input->post('submit')) {

            $a = $this->input->post('id_produk_kategori');
            $b = $this->input->post('nama_produk');
            $c = $this->input->post('harga_produk');
            $d = $this->input->post('keterangan_produk');
            $e = $this->input->post('diskon');

            $objek = array(
                'id_produk_kategori' => $a,
                'nama_produk' => $b,
                'harga_produk' => $c,
                'keterangan_produk' => $d,
                'diskon' => $e,

                 );


            $this->db->where('id_produk', $id);
            $this->db->update('tb_produk', $objek);
            
            if ($this->db->affected_rows()) {   
                $this->session->set_flashdata('berhasil_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            } else {
                $this->session->set_flashdata('gagal_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            }

        }   else if ($this->input->post('updatefotoproduk')) {

            $config['upload_path']          = './assets/images/produk/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            
            if ( ! $this->upload->do_upload('foto_produk'))
            {
                $this->session->set_flashdata('gagal_upload','Gagal' );
                redirect(base_url("$this->url1/$this->url2"));
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                $x = $this->upload->data();

                $objek = array(
                    'foto_produk' => $x['file_name'] );

                $this->db->where('id_produk', $id);
                $this->db->update('tb_produk', $objek);

                $this->session->set_flashdata('berhasil_upload','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            }
        } else {
            $data['editdata'] = $this->tb_produk->detail($id)->row();
            $data['admincontent'] = "$this->url1/$this->url2/edit";
            $this->load->view('admin_template', $data);
        }
    }

    public function hapus()
    {
        $this->session->set_flashdata('berhasil_hapus','Berhasil' );
        $dataku=$this->input->post('dataku');
        $detail=$this->tb_produk->cek($dataku)->result();
        $this->tb_produk->hapus($dataku);
    }

}

/* End of file Produk.php */
/* Location: ./application/controllers/admin/Produk.php */