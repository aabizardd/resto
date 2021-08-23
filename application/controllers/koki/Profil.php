<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
 if ($this->inilogin->level != "Koki" ) {
            if ($this->inilogin->level !="Admin") {
                # code...
                            redirect(base_url('forbidden'));

            }
        }
    }

	public function index()
	{
		$data               = $this->data;
        $data['judul']      = "Profil Admin";
        $data['judul2']     = "Foto Profil Admin";

        if ($this->input->post('submit')) {

            $a = $this->input->post('id_karyawan');
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

            $this->db->where('id_karyawan', $a);
            $this->db->update('tb_karyawan', $objek);
            
            if ($this->db->affected_rows()) {   
                $this->session->set_flashdata('berhasil_edit','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            } else {
                $this->session->set_flashdata('gagal_edit','Gagal' );
                redirect(base_url("$this->url1/$this->url2"));
            }
        }

        if ($this->input->post('upload')) {

            $config['upload_path']          = './assets/images/profil/';
            $config['allowed_types']        = 'gif|jpg|png';
            $config['max_size']             = 100;
            $config['max_width']            = 1024;
            $config['max_height']           = 768;

            $this->load->library('upload', $config);

            
            if ( ! $this->upload->do_upload('foto_karyawan'))
            {   
                $this->session->set_flashdata('gagal_upload','Gagal' );
                redirect(base_url("$this->url1/$this->url2"));
            }
            else
            {
                $data = array('upload_data' => $this->upload->data());
                $x = $this->upload->data();
                $a = $this->input->post('id_karyawan');

                $objek = array(
                    'foto_karyawan' => $x['file_name'] );

                $this->db->where('id_karyawan', $a);
                $this->db->update('tb_karyawan', $objek);

                $this->session->set_flashdata('berhasil_upload','Berhasil' );
                redirect(base_url("$this->url1/$this->url2"));
            }
        }
        else {
            $data['editdata'] = $this->MLogin->dataloginkaryawan($this->id_login)->row();
            $data['admincontent'] = "admin/karyawan/profil";
            $this->load->view('admin_template', $data);
        }
	}

}

/* End of file Profil.php */
/* Location: ./application/controllers/koki/Profil.php */