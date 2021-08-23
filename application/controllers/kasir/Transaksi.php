<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Controller {

	public function __construct()
	{

                date_default_timezone_set( 'Asia/Jakarta' );

		parent::__construct();
        $this->load->model('MTransaksi','tb_transaksi');
        $this->load->model('MTransaksisementara', 'tb_transaksi_sementara');
        $this->load->model('MMeja','tb_meja');
        $this->load->model('MPrinter','tb_printer');
        $this->load->model('MProduk','tb_produk');
        $this->load->model('MProduktransaksi','tb_produktransaksi');
        $this->load->library('form_validation');

        if ($this->inilogin->level != "Kasir" ) {
            if ($this->inilogin->level !="Admin") {
                # code...
                            redirect(base_url('forbidden'));

            }
        }
	}
	
	public function index()
	{
		$data 						= $this->data;
		$data['judul'] 				= "Data Transaksi Penjualan";
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
        $data['judul']              = "Detail Transaksi Penjualan";
        $data['detailtransaksi']    = $this->tb_transaksi->detail_edit($id)->row();
        $data['datadetailtransaksi']  = $this->tb_transaksi->datadetailtransaksi($id)->result_array();
        $data['datatotaltransaksisementara']  = $this->tb_transaksi->sum_produk_kasir_fix($id);
        $data['admincontent'] = "$this->url1/$this->url2/detail";
                $data['pembayaran_detail'] = $this->db->get_where('tb_penjualan_pembayaran',['id_penjualan'=>$id]);

        $this->load->view('admin_template', $data); 
    }

    public function bayar($id){
        $data                       = $this->data;
        $data['judul']              = "Pembayaran Transaksi Penjualan";
        $data['detailtransaksi']    = $this->tb_transaksi->detail($id)->row();
        $data['datadetailtransaksi']  = $this->tb_transaksi->datadetailtransaksi($id)->result_array();
        $data['datatotaltransaksisementara']  = $this->tb_transaksi->sum_produk_kasir_fix($id);
        $data['pembayaran_detail'] = $this->db->get_where('tb_penjualan_pembayaran',['id_penjualan'=>$id]);


        if ($this->input->post('submit')) {

            $this->form_validation->set_rules('id_produk_kategori','ID produk Kategori','is_unique[tb_transaksi.id_produk_kategori]');
            
            if ($this->form_validation->run() === FALSE) {
                 $data['admincontent'] = "$this->url1/$this->url2/tambah";
                 $this->load->view('admin_template', $data); 
            } else {

                $a = $this->input->post('id_user');
                $b = str_replace('.', '', $this->input->post('bayar_transaksi'));
                $c = str_replace('.', '', $this->input->post('kembalian_transaksi'));

                $objek = array(
                    'id_kasir' => $a,
                    'bayar_transaksi' => $b,
                    'kembalian_transaksi' => $c,
                    'status_pembayaran_transaksi' => 'Sudah Bayar' );

                $this->db->where('id_transaksi_penjualan', $id);
                $this->db->update('tb_transaksi_penjualan', $objek);
                
                if ($this->db->affected_rows()) {   
                    $this->session->set_flashdata('berhasil_transaksi','Berhasil' );
                    redirect(base_url("$this->url1/$this->url2"));
                } else {
                    $this->session->set_flashdata('gagal_transaksi','Gagal' );
                    redirect(base_url("$this->url1/$this->url2"));
                }
            }
        }



        if ($this->input->post('bayarcetak')) {
            $this->form_validation->set_rules('id_produk_kategori','ID produk Kategori','is_unique[tb_transaksi.id_produk_kategori]');

            if ($this->form_validation->run() === FALSE) {
                 $data['admincontent'] = "$this->url1/$this->url2/tambah";
                 $this->load->view('admin_template', $data); 
            } else {

                $a = $this->input->post('id_user');
                $b = str_replace('.', '', $this->input->post('bayar_transaksi'));
                $c = str_replace('.', '', $this->input->post('kembalian_transaksi'));

                $objek = array(
                    'id_kasir' => $a,
                    'bayar_transaksi' => $b,
                    'kembalian_transaksi' => $c,
                    'status_pembayaran_transaksi' => 'Sudah Bayar' );

                $this->db->where('id_transaksi_penjualan', $id);
                $this->db->update('tb_transaksi_penjualan', $objek);
                
                if ($this->db->affected_rows()) {   
                    $this->session->set_flashdata('berhasil_transaksi','Berhasil' );
                    $this->printstruk($id);
                    redirect(base_url("$this->url1/$this->url2"));
                } else {
                    $this->session->set_flashdata('gagal_transaksi','Gagal' );
                    redirect(base_url("$this->url1/$this->url2"));
                }
            }

        } else {
            $data['admincontent'] = "$this->url1/$this->url2/bayar";
            $this->load->view('admin_template', $data); 
        }
    }

    public function printstruk($id)
    {

        // echo $id;
        // try {
            $this->load->library('ReceiptPrint');
        //     $this->receiptprint->connect(''.$this->tb_printer->dataprinter()->row()->ip_printer.'', $this->tb_printer->dataprinter()->row()->port_printer);
            $this->receiptprint->print_test_receipt($id);
        //     echo "<script>setTimeout('window.close()');</script>"; 
             
        // } catch (Exception $e) {
        //   log_message("error", "Error: Could not print. Message ".$e->getMessage());
        //   $this->receiptprint->close_after_exception();
        // }                     
    }

    public function cetak_nota($id){
    $datadetailtransaksi  = $this->tb_transaksi->datadetailtransaksi($id);
    $pembayaran_detail = $this->db->get_where('tb_penjualan_pembayaran',['id_penjualan'=>$id]);
    $detailtransaksi   = $this->tb_transaksi->detail($id)->row();


 // print_r($datadetailtransaksi->result_array());
    $web = $this->db->get_where('tb_web',['id_web'=>'1'])->row();
// exit();
       $this->load->view('kasir/transaksi/cetak-nota',compact('datadetailtransaksi','pembayaran_detail','detailtransaksi','web'));
    }

    public function  billing_note($id){


    $datadetailtransaksi  = $this->tb_transaksi->datadetailtransaksi($id);
    $pembayaran_detail = $this->db->get_where('tb_penjualan_pembayaran',['id_penjualan'=>$id]);
    $detailtransaksi   = $this->tb_transaksi->detail($id)->row();
    $web = $this->db->get_where('tb_web',['id_web'=>'1'])->row();


// print_r($datadetailtransaksi->result_array());
    // $web = $this->db->get_where('tb_web',['id_web'=>'1'])->row();
// exit();

       $this->load->view('kasir/transaksi/billing-note',compact('datadetailtransaksi','pembayaran_detail','detailtransaksi','web'));

    }
    
    public function  kitchen_slip($id){
    $web = $this->db->get_where('tb_web',['id_web'=>'1'])->row();

    $datadetailtransaksi  = $this->tb_transaksi->datadetailtransaksi($id);
    $pembayaran_detail = $this->db->get_where('tb_penjualan_pembayaran',['id_penjualan'=>$id]);
    $detailtransaksi   = $this->tb_transaksi->detail($id)->row();


 // print_r($datadetailtransaksi->result_array());
    $web = $this->db->get_where('tb_web',['id_web'=>'1'])->row();
// exit();
       $this->load->view('kasir/transaksi/kitchen-slip',compact('datadetailtransaksi','pembayaran_detail','detailtransaksi','web'));

    }


    public function update($id){

        // foreach ($this->input->post() as $key => $value) {
        //     # code...
        //     echo $key."<br>";
        // }

$this->load->library('user_agent');

$total_diskon = $this->input->post('total_diskon');
$service_fee_angka = $this->input->post('service_fee_angka');
$pajak_angka = $this->input->post('pajak_angka');
$total_transaksi = $this->input->post('total_transaksi');
$total_semua = $this->input->post('total_semua');
$tunai = $this->input->post('tunai');
$dp = $this->input->post('dp');
$voucher = $this->input->post('voucher');
$card = $this->input->post('card');
$kredit = $this->input->post('kredit');
    $status_transaksi = $this->input->post('status_transaksi');
$kembalian = str_replace('-','', $this->input->post('kembalian'));


$terima = $this->input->post('terima');
    $data = $this->db->get_where('tb_penjualan_pembayaran',['id_penjualan'=>$id]);


$upd = [
'status_pembayaran_transaksi'=>$status_transaksi
];

if (!empty($terima)) {

if ($terima=='1') {
    $this->db->update('tb_transaksi_penjualan_detail',['status_transaksi'=>'Terima'],['id_transaksi_penjualan'=>$id]);
}
else{
    $this->db->update('tb_transaksi_penjualan_detail',['status_transaksi'=>'Tolak'],['id_transaksi_penjualan'=>$id]);

}

}
$this->db->update('tb_transaksi_penjualan',$upd,['id_transaksi_penjualan'=>$id]);

    if ($data->num_rows()>0) {
        $update = [
            'diskon_total'=>$total_diskon,
            'total_semua'=>$total_semua,
            'total'=>$total_transaksi,
            'service_fee_angka'=>$service_fee_angka,
            'pajak_angka'=>$pajak_angka,
            'tunai'=>$tunai,
            'dp'=>$dp,
            'voucher'=>$voucher,
            'card'=>$card,
            'kredit'=>$kredit,
            'kembali'=>$kembalian
        ];

        $this->db->update('tb_penjualan_pembayaran',$update,['id_penjualan'=>$id]);


                    $this->session->set_flashdata('berhasil_simpan','Berhasil Menyimpan' );
                    redirect($this->agent->referrer());

    }
    else{

                    $this->session->set_flashdata('berhasil_simpan','Gagal Menyimpan' );
                    redirect($this->agent->referrer());
    }


    }
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/kasir/Transaksi.php */