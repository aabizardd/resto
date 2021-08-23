<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mengajar extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        
        $this->load->model('MMengajar','tb_mengajar');
		$this->load->model('MLogin');
		$this->load->model('MGuru');
		$this->load->model('MMapel');

        $this->load->library('form_validation');

        if ($this->inilogin->level != "Admin") {
            redirect(base_url('forbidden'));
        }
	        
	}
	
	public function index()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Data Mengajar";
		$data['admincontent']		= "$this->url1/$this->url2/tampil";
		$this->load->view('admin_template', $data);
	}

	public function data_json()
    {
        $list = $this->tb_mengajar->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $tb_mengajar) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $tb_mengajar->id_mengajar;
            $row[] = $tb_mengajar->nama_guru;
            $row[] = $tb_mengajar->nama_mapel;
            $row[] = $tb_mengajar->semester;
            $row[] = $tb_mengajar->tahun_ajaran;

 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => @$_POST['draw'],
                        "recordsTotal" => $this->tb_mengajar->count_all(),
                        "recordsFiltered" => $this->tb_mengajar->count_filtered(),
                        "data" => $data,

                );
        //output to json format
        echo json_encode($output);
    }
 

	public function tambah()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Tambah Data Mengajar";
		$data['dataguru']			= $this->MGuru->tampil()->result_array();
		$data['datamapel']			= $this->MMapel->tampil()->result_array();
		if ($this->input->post('submit')) {

            $this->form_validation->set_rules('id_mengajar','ID Mengajar','is_unique[tb_mengajar.id_mengajar]');

            if ($this->form_validation->run() === FALSE) {
                 $data['admincontent'] = "$this->url1/$this->url2/tambah";
                 $this->load->view('admin_template', $data); 
            } else {

                $query = null;

                $a = $this->input->post('id_guru');
                $b = $this->input->post('id_mapel');

                $query = $this->db->get_where('tb_mengajar', array(//making selection
                    'id_guru' => $a,
                    'id_mapel' => $b
                ));

                $count = $query->num_rows(); //counting result from query

                $objek = array(
                        'id_guru' => $a,
                        'id_mapel' => $b
                    );

                if ($count > 0) {
                    $this->session->set_flashdata('gagal_simpan', 'gagal');
                    redirect(base_url("admin/mengajar"));
                } else {
                    $query1 = $this->tb_mengajar->simpan($objek);
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
        $data['judul']      = "Edit Data Mengajar";
        $data['dataguru']           = $this->MGuru->tampil()->result_array();
        $data['datamapel']          = $this->MMapel->tampil()->result_array();
       
        if ($this->input->post('submit')) {

            $query = null;

            $a = $this->input->post('id_guru');
            $b = $this->input->post('id_mapel');

            $query = $this->db->get_where('tb_mengajar', array(//making selection
                    'id_guru' => $a,
                    'id_mapel' => $b
                ));

            $count = $query->num_rows(); //counting result from query

            $objek = array(
                'id_guru' => $a,
                'id_mapel' => $b );

            if ($count > 0) {
                $this->session->set_flashdata('gagal_simpan','gagal' );
                redirect(base_url("$this->url1/$this->url2"));
            } else {
                $this->db->where('id_mengajar', $id);
                $this->db->update('tb_mengajar', $objek);
                $this->session->set_flashdata('berhasil_simpan', 'sukses');
                redirect(base_url("$this->url1/$this->url2"));  
            }
        }
        else {
            $data['editdata'] = $this->db->get_where('tb_mengajar', array('id_mengajar' => $id))->row();
            $data['admincontent'] = "$this->url1/$this->url2/edit";
            $this->load->view('admin_template', $data);
        }
    }

    public function hapus()
    {
        $this->session->set_flashdata('berhasil_hapus','Berhasil' );
        $dataku=$this->input->post('dataku');
        $detail=$this->tb_mengajar->cek($dataku)->result();
        $this->tb_mengajar->hapus($dataku);
    }

}

/* End of file Mengajar.php */
/* Location: ./application/controllers/Mengajar.php */