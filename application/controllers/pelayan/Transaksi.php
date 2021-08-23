<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Transaksi extends MY_Controller {

	public function __construct()
	{

                        date_default_timezone_set( 'Asia/Jakarta' );

		parent::__construct();
        $this->load->model('MTransaksi','tb_transaksi');
        $this->load->model('MTransaksidetail','tb_transaksi_detail');
        $this->load->model('MTransaksisementara', 'tb_transaksi_sementara');
        $this->load->model('MMeja','tb_meja');
        $this->load->model('MProduk','tb_produk');
        $this->load->model('MProduktransaksi','tb_produktransaksi');
        $this->load->library('form_validation');

 if ($this->inilogin->level != "Pelayan" ) {
            if ($this->inilogin->level !="Admin" ) {
                # code...
                if ($this->inilogin->level !="Kasir") {
                    # code...
                            redirect(base_url('forbidden'));
                }

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
            $row[] = 'Rp. '.number_format($tb_transaksi->total_transaksi, 0, ',', '.').',00 ';
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

    public function produk_data_json()
    {
        $list = $this->tb_produktransaksi->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $tb_produktransaksi) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $tb_produktransaksi->id_produk;
            $row[] = $tb_produktransaksi->nama_produk;
            $row[] = $tb_produktransaksi->harga_produk;
            $row[] = $tb_produktransaksi->keterangan_produk;
            
            $data[] = $row;
        }
 
        $output = array(
                "draw" => @$_POST['draw'],
                "recordsTotal" => $this->tb_produktransaksi->count_all(),
                "recordsFiltered" => $this->tb_produktransaksi->count_filtered(),
                "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function produk_json()
    {
        $id_produk = $this->input->get('id_produk', TRUE);
        $query = $this->tb_produk->get_semua_produk($id_produk)->row();
        
        $data       =  array(
            'id_produk'     => @$query->id_produk,
            'nama_produk'   => @$query->nama_produk,
            'harga_produk'  => @$query->harga_produk,
            'diskon_produk'  => @$query->diskon
        );
        echo json_encode($data);
    }
 
 

	public function tambah()
	{

		$data 						= $this->data;
		$data['judul'] 				= "Tambah Transaksi Penjualan";
        $data['kodeotomatis'] = $this->tb_transaksi->kode_otomatis();
        $data['datameja']         = $this->tb_meja->tersedia()->result_array();
        $data['dataproduk']         = $this->tb_produk->tampil()->result_array();
        $data['datatransaksisementara']  = $this->tb_transaksi_sementara->tampil($this->datalogin->id_user)->result_array();

        $data['kategori'] = $this->db->get('tb_produk_kategori');
        $data['datatotaltransaksisementara']  = $this->tb_transaksi_sementara->sum_produk($this->datalogin->id_user);

        if ($this->input->post('simpan')) {

            $this->form_validation->set_rules('id_transaksi_penjualan','ID Transaksi','is_unique[tb_transaksi_penjualan.id_transaksi_penjualan]');
            $this->form_validation->set_rules('id_meja','ID Meja','required');
            $this->form_validation->set_rules('tanggal_transaksi','Tanggal Transaksi','required');
            $this->form_validation->set_rules('total_transaksi','Pemesanan','required');
            
            if ($this->form_validation->run() === FALSE) {
                 $data['admincontent'] = "$this->url1/$this->url2/tambah";
                 $this->load->view('admin_template', $data); 
            } else {


                $a = $this->input->post('id_transaksi_penjualan');
                $b = date('Y-m-d', strtotime($this->input->post('tanggal_transaksi')));
                $c = $this->input->post('id_meja');
                $d = $this->input->post('total_transaksi');
                $e = $this->input->post('id_user');
                $f = $this->input->post('diskon_produk');
                $g = $this->input->post('diskon_angka');

                $objek = array(
                    'id_transaksi_penjualan' => $a,
                    'tanggal_transaksi' => $b,
                    'id_meja' => $c,
                    'total_transaksi' => $d,
                    'id_user' => $e,

                     );

                $query = $this->tb_transaksi->simpan($objek);

                $this->tb_transaksi->copydata($this->datalogin->id_user);
                $this->tb_transaksi->truncatedata($this->datalogin->id_user);

                if ($query) {
                    $this->session->set_flashdata('berhasil_simpan', 'sukses');
                    redirect(base_url("$this->url1/$this->url2"));
                }
            }

        } else if ($this->input->post('submit')) {

            $this->form_validation->set_rules('id_produk_kategori','ID produk Kategori','is_unique[tb_transaksi.id_produk_kategori]');
            
            if ($this->form_validation->run() === FALSE) {
                 $data['admincontent'] = "$this->url1/$this->url2/tambah";
                 $this->load->view('admin_template', $data); 
            } else {




                $query = null;

                $a = $this->input->post('id_transaksi_penjualan');
                $b = $this->input->post('id_produk');
                $c = $this->input->post('jumlah_transaksi');
                $d = str_replace('.', '', $this->input->post('total_transaksi'));
                $e = $this->input->post('id_user');
                $f = str_replace('.', '', $this->input->post('harga_produk'));

                $g = $this->input->post('diskon_produk');
                $h = $this->input->post('diskon_angka');

                $i = $this->input->post('total_diskon');
                $j = $this->input->post('total_semua');

                $query = $this->db->get_where('tb_transaksi_penjualan_detail_sementara', array(//making selection
                    'id_produk' => $b,
                    'id_user'=>$e
                ));

                $count = $query->num_rows(); //counting result from query

                // print_r($count);
                // exit(); 

                          $cek = $this->tb_transaksi_sementara->cek_id_produk($b,$e)->row();

                // print_r($cek);
                // exit();
                $jumlah_transaksi = empty($cek) ? $c :  $c + $cek->jumlah_transaksi;
                $total_transaksi = empty($cek) ? $d:$d + $cek->total_transaksi;
                $total_diskon = empty($cek) ? $i: $i+$cek->diskon_angka;
                $total_semua = empty($cek) ? $j: $j+$cek->total_semua;

                // echo $count;
                // exit();
                if ($count > 0) {


                $object = array(
                    'jumlah_transaksi' => $jumlah_transaksi,
                    'total_transaksi' => $total_transaksi,
                    'diskon_angka' => $total_diskon,
                    'total_semua' => $total_semua,

                     );
                    $this->db->where('id_produk', $b);
                    $this->db->where('id_user', $e);
                    $this->db->update('tb_transaksi_penjualan_detail_sementara', $object);
                    $this->session->set_flashdata('berhasil_simpan', 'sukses');
                    redirect(base_url("$this->url1/$this->url2/tambah"));

                } else {


                $objek = array(
                    'id_transaksi_penjualan' => $a,
                    'id_produk' => $b,
                    'jumlah_transaksi' => $c,
                    'total_transaksi' => $d,
                    'id_user' => $e,
                    'harga_transaksi' => $f,
                    'diskon_persen'=>$g,
                    'diskon_angka' => $total_diskon,
                    'total_semua' => $total_semua,

                     );

                    $query1 = $this->tb_transaksi_sementara->simpan($objek);
                    $this->session->set_flashdata('berhasil_simpan', 'sukses');
                    redirect(base_url("$this->url1/$this->url2/tambah"));
                }
            }

        } else {
            $data['admincontent'] = "$this->url1/$this->url2/tambah";
            $this->load->view('admin_template', $data); 
        }
	}

    public function detail($id){
        $data                       = $this->data;
        $data['judul']              = "Detail Transaksi Penjualan";
        $data['detailtransaksi']    = $this->tb_transaksi->detail_edit($id)->row();
        $data['datadetailtransaksipelayan']  = $this->tb_transaksi->datadetailtransaksipelayan($id)->result_array();
        $data['datatotaltransaksisementara']  = $this->tb_transaksi->sum_produk($id);
        $data['admincontent'] = "$this->url1/$this->url2/detail";
        $data['pembayaran_detail'] = $this->db->get_where('tb_penjualan_pembayaran',['id_penjualan'=>$id]);
        $this->load->view('admin_template', $data);
    }

    public function hapus_transaksi($id)
    {
        $query = $this->tb_transaksi_sementara->hapus($id);
        $this->session->set_flashdata('berhasil_hapus', 'sukses');
        redirect(base_url("$this->url1/$this->url2/tambah"));
    }

    public function hapus_transaksi_edit($id,$id_produk)
    {
        $total_sebelumnya = $this->tb_transaksi->sum_produk($id);
        $cek_total_sebelumnya = $this->tb_transaksi_detail->cek_total_transaksi_per_produk($id_produk);
        $total_transaksi_update = $total_sebelumnya - $cek_total_sebelumnya;

        $object_update_total = array(
                    'total_transaksi' => $total_transaksi_update );

        $this->db->where('id_transaksi_penjualan', $id);
        $this->db->update('tb_transaksi_penjualan', $object_update_total);

        $query = $this->tb_transaksi_detail->hapus($id_produk);
        $this->session->set_flashdata('berhasil_hapus', 'sukses');
        redirect(base_url("$this->url1/$this->url2/edit/".$id));
    }

    public function hapus()
    {
        $this->session->set_flashdata('berhasil_hapus','Berhasil' );
        $dataku=$this->input->post('dataku');
        $detail=$this->tb_transaksi->cek($dataku)->result();
        $this->tb_transaksi->hapus($dataku);
    }

    public function edit($id){
        $data                       = $this->data;
        $data['judul']              = "Edit Transaksi Penjualan";
        $data['kodeotomatis']       = $this->tb_transaksi->kode_otomatis();
        $data['datameja']           = $this->tb_meja->tersedia()->result_array();
        $data['dataproduk']         = $this->tb_produk->tampil()->result_array();
        $data['datatransaksisementara']     = $this->tb_transaksi_sementara->tampil($this->datalogin->id_user)->result_array();
        $data['datatotaltransaksidetail']   = $this->tb_transaksi_detail->sum_produk($id);
        $data['kategori'] = $this->db->get('tb_produk_kategori');
        $data['pembayaran_detail'] = $this->db->get_where('tb_penjualan_pembayaran',['id_penjualan'=>$id]);


        if ($this->input->post('simpan')) {

            $this->form_validation->set_rules('id_transaksi_penjualan','ID Transaksi','required');
            $this->form_validation->set_rules('id_meja','ID Meja','required');
            $this->form_validation->set_rules('tanggal_transaksi','Tanggal Transaksi','required');
            
            if ($this->form_validation->run() === FALSE) {
                 $data['admincontent'] = "$this->url1/$this->url2/edit";
                 $this->load->view('admin_template', $data); 
            } else {

                $a = $this->input->post('id_transaksi_penjualan');
                $b = date('Y-m-d', strtotime($this->input->post('tanggal_transaksi')));
                $c = $this->input->post('id_meja');

                $objek = array(
                    'tanggal_transaksi' => $b,
                    'id_meja' => $c );

                $this->db->where('id_transaksi_penjualan', $id);
                $this->db->update('tb_transaksi_penjualan', $objek);

                if ($this->db->affected_rows()) {
                    $this->session->set_flashdata('berhasil_simpan', 'sukses');
                    redirect(base_url("$this->url1/$this->url2"));
                } else {
                    $this->session->set_flashdata('berhasil_simpan', 'berhasil');
                    redirect(base_url("$this->url1/$this->url2"));
                }
            }

        } else if ($this->input->post('submit')) {

            $this->form_validation->set_rules('id_produk_kategori','ID produk Kategori','is_unique[tb_transaksi.id_produk_kategori]');
            
            if ($this->form_validation->run() === FALSE) {
                 $data['admincontent'] = "$this->url1/$this->url2/tambah";
                 $this->load->view('admin_template', $data); 
            } else {



// print_r($this->input->post());
// exit();
                $query = null;

                $a = $this->input->post('id_transaksi_penjualan');
                // echo $a;
                // exit();
                $b = $this->input->post('id_produk');
                $c = $this->input->post('jumlah_transaksi');
                $d = str_replace('.', '', $this->input->post('total_transaksi'));
                $f = str_replace('.', '', $this->input->post('harga_produk'));
                $g = str_replace('.', '', $this->input->post('total_transaksi'));




                $query = $this->db->get_where('tb_transaksi_penjualan_detail', array(//making selection
                    'id_produk' => $b,
                    'id_transaksi_penjualan' => $a
                ));

                $count = $query->num_rows(); //counting result from query

                $ck = $this->tb_transaksi_detail->cek_id_produk_edit($b,$a);
                $cek = $this->tb_transaksi_detail->cek_id_produk_edit($b,$a)->row();

                $cek_total_sebelumnya = $this->tb_transaksi->sum_produk($id);

                if ($ck->num_rows()>0) {
                    # code...

                $jumlah_transaksi = $c + $cek->jumlah_transaksi;
                $total_transaksi = $d + $cek->total_transaksi;
                }
                else{

                $jumlah_transaksi = $c ;
                $total_transaksi = $d;
                }


                $total_transaksi_keseluruhan = $d + $cek_total_sebelumnya;

                $h = $this->input->post('diskon_produk');
                $i = $this->input->post('diskon_angka');
                $total_semua = $this->input->post('total_semua');
                $total_diskon = $this->input->post('total_diskon');


                $objek = array(
                    'id_transaksi_penjualan' => $a,
                    'id_produk' => $b,
                    'jumlah_transaksi' => $c,
                    'total_transaksi' => $d,
                    'harga_transaksi' => $f ,
                    'diskon_persen'=>$h,
                    'diskon_angka' => $total_diskon,
                    'total_semua' => $total_semua,
                );




                    // 'id_transaksi_penjualan' => $a,
                    // 'id_produk' => $b,
                    // 'jumlah_transaksi' => $c,
                    // 'total_transaksi' => $d,
                    // 'id_user' => $e,


                $object = array(
                    'jumlah_transaksi' => $jumlah_transaksi,
                    'total_transaksi' => $total_transaksi );

                $object_total = array(
                    'total_transaksi' => $total_transaksi_keseluruhan 

                );

                if ($count > 0) {   
                    $this->db->where('id_transaksi_penjualan', $id);
                    $this->db->where('id_produk', $b);
                    $this->db->update('tb_transaksi_penjualan_detail', $object);
                    $this->db->where('id_transaksi_penjualan', $id);
                    $this->db->update('tb_transaksi_penjualan', $object_total);
                    $this->session->set_flashdata('berhasil_simpan', 'sukses');
                    redirect(base_url("$this->url1/$this->url2/edit/".$id));

                } else {
                    $this->db->where('id_transaksi_penjualan', $id);
                    $this->db->update('tb_transaksi_penjualan', $object_total);
                    $query1 = $this->tb_transaksi_detail->simpan($objek);
                    $this->session->set_flashdata('berhasil_simpan', 'sukses');
                    redirect(base_url("$this->url1/$this->url2/edit/".$id));
                }
            }

        } else {
            $data['editdatatransaksi'] = $this->tb_transaksi->detail_edit($id)->row();
            $data['editdatatransaksidetail'] = $this->tb_transaksi_detail->detailtransaksi($id)->result_array();
            $data['admincontent'] = "$this->url1/$this->url2/edit";
            $this->load->view('admin_template', $data); 
        }
    }

    public function getPage($id){
        // echo $id;
        // echo "string";

        $data['dataproduk']         = $this->db->get_where('tb_produk',['id_produk_kategori'=>$id]);
        $this->load->view('pelayan/transaksi/getProduk', $data); 



    }


    public function cart(){

        $datatransaksisementara= $this->tb_transaksi_sementara->tampil($this->datalogin->id_user)->result_array();

         $datatotaltransaksisementara =  $this->tb_transaksi_sementara->sum_produk($this->datalogin->id_user);

         $userid= $this->datalogin->id_user;

         $sum_total = $this->db->query("SELECT sum(total_transaksi) +sum(diskon_angka) as total from tb_transaksi_penjualan_detail_sementara WHERE id_user='$userid'")->result();
         $sum_diskon = $this->db->query("SELECT sum(diskon_angka) as diskon from tb_transaksi_penjualan_detail_sementara WHERE id_user='$userid'")->result();

         // print_r($sum_total->row());


         $servv = $this->db->get_where('tb_setting',['nama'=>'service_fee'])->row()->nilai;
        $pajkk =  $this->db->get_where('tb_setting',['nama'=>'pajak'])->row()->nilai;

         $serv = $servv;
         $pjk =$pajkk;
         $serviceFee= $serv/100;
         $pajak = $pjk/100;

         $totale = $datatotaltransaksisementara;

         $keServiceFee = $totale*$serviceFee;
         $kePajak = $totale * $pajak;

         $totalSemua = $totale + $keServiceFee + $kePajak;

        $kodeotomatis = $this->tb_transaksi->kode_otomatis();
        $datameja         = $this->tb_meja->tersedia()->result_array();



        $this->load->view('pelayan/transaksi/cart',compact('datatransaksisementara','datatotaltransaksisementara','sum_total','sum_diskon','keServiceFee','kePajak','totalSemua','serv','pjk','kodeotomatis','datameja'));
    }



public function bayar_langsung(){


$type =  $this->input->post('type');

     $a = $this->input->post('id_transaksi_penjualan');
                $b = date('Y-m-d', strtotime($this->input->post('tanggal_transaksi')));
                $c = $this->input->post('id_meja');
                $d = $this->input->post('total_transaksi');
                $e = $this->input->post('id_user');


    $post = $this->input->post();

    $total_semua  = $this->input->post('total_semua');
    $diskon_total  = $this->input->post('diskon_total');
    $total  = $this->input->post('total');
    $service_fee_angka  = $this->input->post('service_fee_angka');
    $service_fee_persen  = $this->input->post('service_fee_persen');
    $pajak_angka  = $this->input->post('pajak_angka');
    $pajak_persen  = $this->input->post('pajak_persen');
    $tunai  = $this->input->post('tunai');
    $dp  = $this->input->post('dp');
    $voucher  = $this->input->post('voucher');
    $card  = $this->input->post('card');
    $kredit  = $this->input->post('kredit');
    $totall = $this->input->post('totall');

                $h= $this->input->post('pelanggan');

$kembalian = str_replace('-', '', $this->input->post('kembalian'));
// print_r($this->input->post());
//                 exit();
    $status_transaksi = $this->input->post('status_transaksi');
    // echo $a;
    // exit();


if ($type=="bayar") {
 $objek = array(
                    'id_transaksi_penjualan' => $a,
                    'tanggal_transaksi' => $b,
                    'id_meja' => $c,
                    'total_transaksi' => $totall,
                    'id_user' => $e,
                    'status_pembayaran_transaksi'=>"Sudah Bayar",
                    "pelanggan"=>$h


     );

}
else{
     $objek = array(
                    'id_transaksi_penjualan' => $a,
                    'tanggal_transaksi' => $b,
                    'id_meja' => $c,
                    'total_transaksi' => $totall,
                    'id_user' => $e,
                    'pelanggan'=>$h


     );

}

// print_r($objek);
// exit();
    
                $query = $this->tb_transaksi->simpan($objek);

            if ($type=="bayar") {

                $this->tb_transaksi->copydatabayar($this->datalogin->id_user);
                $this->tb_transaksi->truncatedata($this->datalogin->id_user);

                $st = "bayar";
            }
            else{

                                    $this->tb_transaksi->copydata($this->datalogin->id_user);
                $this->tb_transaksi->truncatedata($this->datalogin->id_user);
                $st ="simpan";
            }

// exit();

                $dt = array(
"total_semua"=>$total_semua,
"diskon_total"=>$diskon_total,
"total"=>$totall,
"service_fee_angka"=>$service_fee_angka,
"service_fee_persen"=>$service_fee_persen,
"pajak_angka"=>$pajak_angka,
"pajak_persen"=>$pajak_persen,
"tunai"=>$tunai,
"dp"=>$dp,
"voucher"=>$voucher,
"card"=>$card,
"kredit"=>$kredit,
'id_penjualan'=>$a,
'kembali'=>$kembalian


                );

                $save= $this->db->insert('tb_penjualan_pembayaran',$dt);
                if ($save) {
                    # code...

                    $status =1;
                }
                else{
                    $status=0;
                }

echo json_encode([
'status'=>$status,
'id_penjualan'=>$a,
'statuse'=>$st
]);
}


public function tutup(){
    // if ($this->input->post()) {
        echo "x";
        $this->tb_transaksi->truncatedata($this->datalogin->id_user);

    // }
}

}

/* End of file Transaksi.php */
/* Location: ./application/controllers/pelayan/Transaksi.php */