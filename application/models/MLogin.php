<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MLogin extends CI_Model {

	var $table = 'tb_login';

	public function login($table, $where)
	{
		return $this->db->get_where($table, $where);
	}

	public function dataloginku($id_login) {
		$this->db->select('*');
		$this->db->from('tb_login');    
		$this->db->where('id_user', $id_login);
		$query = $this->db->get();
		return $query;
	}

	public function dataloginkaryawan($id_login) {

		$this->db->select('*');    
		$this->db->from('tb_login');
		$this->db->join('tb_karyawan', 'tb_login.id_user_detail_karyawan = tb_karyawan.id_karyawan');
		$this->db->where('id_user', $id_login);
		$query = $this->db->get();
		return $query;
	}

	public function simpan($data) {
        return $this->db->insert($this->table, $data);
    }

}

/* End of file MLogin.php */
/* Location: ./application/models/MLogin.php */