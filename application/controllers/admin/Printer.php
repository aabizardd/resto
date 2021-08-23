<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Printer extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        if ($this->inilogin->level != "Admin") {
            redirect(base_url('forbidden'));
        }
    }

	public function index()
	{
		$data               = $this->data;
        $data['judul']      = "Pengaturan Printer Thermal";

            $data['printer'] = $this->db->get_where('tb_printer')->row();
            $data['admincontent'] = "$this->url1/$this->url2/index";
            $data['data']= $this->db->get('tb_printer');
            $this->load->view('admin_template', $data);
        
	}

    public function create(){
        if ($this->input->post()) {

            $a = $this->input->post('ip_printer');
            $b = $this->input->post('port_printer');
            $c = $this->input->post('cetak_ke');

            $objek = array(
                'ip_printer' => $a,
                'port_printer' => $b,
                'cetak_ke'=>$c
                 );
           $save =  $this->db->insert('tb_printer', $objek);


                $this->session->set_flashdata('berhasil_simpan','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
        }
        else{
        $data               = $this->data;
        $data['judul']      = "Pengaturan Printer Thermal";

            $data['printer'] = $this->db->get_where('tb_printer')->row();
            $data['admincontent'] = "$this->url1/$this->url2/create";
            $this->load->view('admin_template', $data);            
        }


    }

    public function hapus($id){
   $delete=     $this->db->delete('tb_printer',['id_printer'=>$id]);
    if ($delete) {

                $this->session->set_flashdata('berhasil_hapus','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
    }
    else{

                $this->session->set_flashdata('gagal_hapus','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
    }
    }

}

/* End of file Printer.php */
/* Location: ./application/controllers/admin/Printer.php */