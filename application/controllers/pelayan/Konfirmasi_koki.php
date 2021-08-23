<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfirmasi_koki extends MY_Controller {

	public function __construct()
    {
        parent::__construct();
        $this->load->model('MTransaksi','tb_transaksi');
        $this->load->model('MTransaksidetail','tb_transaksi_detail');
        $this->load->model('MPrinter','tb_printer');
 if ($this->inilogin->level != "Pelayan" ) {
            if ($this->inilogin->level !="Admin") {
                # code...
                            redirect(base_url('forbidden'));

            }
        }
    }

	public function index()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Pemesanan Konfirmasi Koki";
		$data['admincontent']		= "$this->url1/$this->url2/tampil";
		$this->load->view('admin_template', $data);
	}

	public function data_json()
    {
        $list = $this->tb_transaksi->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $tb_transaksi) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $tb_transaksi->id_transaksi_penjualan;
            $row[] = date("d-m-Y", strtotime($tb_transaksi->tanggal_transaksi));
            $row[] = $tb_transaksi->nama_meja;
            $row[] = $tb_transaksi->status_konfirmasi_koki;
            $row[] = $tb_transaksi->status_pembayaran_transaksi;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => @$_POST['draw'],
                        "recordsTotal" => $this->tb_transaksi->count_all(),
                        "recordsFiltered" => $this->tb_transaksi->count_filtered(),
                        "data" => $data,

                );
        //output to json format
        echo json_encode($output);
    }

    public function detail($id){
        $data                       = $this->data;
        $data['id_detail']          = $id;
        $data['judul']              = "Detail Transaksi Penjualan";
        $data['detailtransaksi']    = $this->tb_transaksi->detail_edit($id)->row();
        $data['datadetailtransaksi']  = $this->tb_transaksi->datadetailtransaksikoki($id)->result_array();

        $data['admincontent'] = "$this->url1/$this->url2/detail";
        $this->load->view('admin_template', $data); 
    }


    public function updatestatus($id){

        $i=1;
        while(isset($_POST['status_transaksi'.$i]) AND isset($_POST['id_transaksi_penjualan_detail'.$i]) AND isset($_POST['catatan_status_detail'.$i]))
        {
            $status = $_POST['status_transaksi'.$i];
            $id_transaksi_penjualan_detail = $_POST['id_transaksi_penjualan_detail'.$i];
            $catatan = $_POST['catatan_status_detail'.$i];
            // var_dump($answer);
            $query = $this->tb_transaksi_detail->updateStatusTransaksi($id, $status, $id_transaksi_penjualan_detail, $catatan);

            $i++;            
        }
        $this->tb_transaksi->updateStatusKonfirmasiKoki($id);
        $this->session->set_flashdata('berhasil_simpan', 'sukses');
        redirect(base_url("$this->url1/$this->url2"));
    }

    public function printstruk($id)
    {
        try {
            $this->load->library('ReceiptPrintPelayan');
            $this->receiptprintpelayan->connect(''.$this->tb_printer->dataprinter()->row()->ip_printer.'', $this->tb_printer->dataprinter()->row()->port_printer);
            $this->receiptprintpelayan->print_test_receipt($id);
            echo "<script>setTimeout('window.close()');</script>"; 
             
        } catch (Exception $e) {
          log_message("error", "Error: Could not print. Message ".$e->getMessage());
          $this->receiptprintpelayan->close_after_exception();
        }                     
    }

    

}

/* End of file Konfirmasi_koki.php */
/* Location: ./application/controllers/pelayan/Konfirmasi_koki.php */