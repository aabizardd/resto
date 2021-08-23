<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->inilogin->level != "Admin") {
            redirect(base_url('forbidden'));
        }
    }

	public function index()
	{
		$dataweb = $this->MWeb->tampil()->row();
		$data               = $this->data;
        $data['judul']      = "Pengaturan Aplikasi";
        $data['judul2']      = "Logo Aplikasi";

        if ($this->input->post('submit')) {

                $b = $this->input->post('nama_web');
                $c = $this->input->post('slogan_web');
                $d = $this->input->post('alamat_web');
                $e = $this->input->post('telp_web');
                $f = $this->input->post('fax_web');
                $g = $this->input->post('email_web');
                $h = $this->input->post('author_web');
                $i = $this->input->post('deskripsi_web');
                $j = $this->input->post('keyword_web');
                $k = $this->input->post('tahun_web');
                $l = $this->input->post('kabupaten_web');

                $objek = array(
                    'nama_web' => $b,
                    'slogan_web' => $c,
                    'alamat_web' => $d,
                    'telp_web' => $e,
                    'fax_web' => $f,
                    'email_web' => $g,
                    'author_web' => $h,
                    'deskripsi_web' => $i,
                	'keyword_web' => $j,
                	'tahun_web' => $k,
                    'kabupaten_web' => $l );

            $this->db->where('id_web', $dataweb->id_web);
            $this->db->update('tb_web', $objek);
            
            if ($this->db->affected_rows()) {   
                $this->session->set_flashdata('berhasil_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            } else {
                $this->session->set_flashdata('gagal_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            }

        } else if ($this->input->post('upload')) {
            $config['upload_path']          = './assets/images/logo/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 1024;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            
            if ( ! $this->upload->do_upload('logo_web'))
            {
                $this->session->set_flashdata('gagal_upload','Gagal' );
                redirect(base_url("$this->url1/$this->url2"));
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                $x = $this->upload->data();

                $objek = array(
                    'logo_web' => $x['file_name'] );

                $this->db->where('id_web', $dataweb->id_web);
                $this->db->update('tb_web', $objek);

                $this->session->set_flashdata('berhasil_upload','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            }

        } else {
            $data['admincontent'] = "$this->url1/$this->url2/data";
            $this->load->view('admin_template', $data);
        }


	}

}

/* End of file Pengaturan.php */
/* Location: ./application/controllers/admin/Pengaturan.php */