<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPrinter extends CI_Model {

	public function dataprinter() {
		return $this->db->get('tb_printer');
		return $query;
	}

}

/* End of file MPrinter.php */
/* Location: ./application/models/MPrinter.php */