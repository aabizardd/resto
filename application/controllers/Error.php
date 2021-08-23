<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Error extends CI_Controller {

	var $data;

	public function __construct()
	{
		parent::__construct();
		// $this->load->model('MArtikel');
		$this->data = array(
            'web' => $this->MWeb->tampil()->row()
        );
	}

	public function index()
	{
		$data = $this->data;
		$this->load->view('page/error', $data);
	}

}

/* End of file Error.php */
/* Location: ./application/controllers/Error.php */