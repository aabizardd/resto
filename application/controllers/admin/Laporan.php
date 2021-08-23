<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
        $id_login  = $this->session->userdata("id_user");

        $this->load->library('form_validation');

        // if ($this->inilogin->level != "Admin") {
        //     redirect(base_url('forbidden'));
        // }
	}

	public function laporan_detail(){


		
		$sampai = $this->input->get('sampai');
		$kasir = $this->input->get('kasir');
		$dari = $this->input->get('dari');

		$data 						= $this->data;
		$data['judul'] 				= "Laporan Detail";

		$data['kasir']   			= $this->db->get('tb_login');

		$kategori = $this->db->get("tb_produk_kategori");

		if ($kategori->num_rows()>0) {
			$kat = [];
			foreach ($kategori->result() as $k) {
				// print_r($k);
				$kid = $k->id_produk_kategori;
				// echo $kid;

				if (!empty($dari)) {


					if (!empty($kasir)) {
						$sql ="SELECT *,sum(jumlah_transaksi) as jumlah_transaksine,sum(a.total_transaksi) as total_transaksine  FROM tb_transaksi_penjualan_detail a inner JOIN tb_produk b on a.id_produk = b.id_produk
inner join tb_transaksi_penjualan c on a.id_transaksi_penjualan = c.id_transaksi_penjualan
WHERE b.id_produk_kategori ='".$kid."' AND c.id_user='$kasir' AND c.tanggal_transaksi BETWEEN '$dari' AND '$sampai'   GROUP by a.id_produk ";
					}
					else{
							$sql ="SELECT *,sum(jumlah_transaksi) as jumlah_transaksine,sum(a.total_transaksi) as total_transaksine  FROM tb_transaksi_penjualan_detail a inner JOIN tb_produk b on a.id_produk = b.id_produk
inner join tb_transaksi_penjualan c on a.id_transaksi_penjualan = c.id_transaksi_penjualan
WHERE b.id_produk_kategori ='".$kid."' AND c.tanggal_transaksi BETWEEN '$dari' AND '$sampai'   GROUP by a.id_produk ";
					}
			

				}
				else{

			if (!empty($kasir)) {
		$sql ="SELECT *,sum(jumlah_transaksi) as jumlah_transaksine,sum(a.total_transaksi) as total_transaksine  FROM tb_transaksi_penjualan_detail a inner JOIN tb_produk b on a.id_produk = b.id_produk
inner join tb_transaksi_penjualan c on a.id_transaksi_penjualan = c.id_transaksi_penjualan
WHERE b.id_produk_kategori ='".$kid."' AND c.id_user='$kasir' GROUP by a.id_produk

";
			}
			else{
						$sql ="SELECT *,sum(jumlah_transaksi) as jumlah_transaksine,sum(a.total_transaksi) as total_transaksine  FROM tb_transaksi_penjualan_detail a inner JOIN tb_produk b on a.id_produk = b.id_produk
inner join tb_transaksi_penjualan c on a.id_transaksi_penjualan = c.id_transaksi_penjualan
WHERE b.id_produk_kategori ='".$kid."' GROUP by a.id_produk

";
			}

				}


				// echo $sql;

				// echo $sql."<br>";
				$datane = $this->db->query($sql);

				// print_r($k);

				if ($datane->num_rows()>0) {
				$dtt=[];	
					foreach ($datane->result() as $dt ) {
						// print_r($dt);
						$dtt[] = [
							'nama_produk'=>$dt->nama_produk,
							'jumlah_transaksi'=>$dt->jumlah_transaksine,
							'total_transaksi'=>$dt->total_transaksine
							// 'kategori'=>$
						];
						// print_r($dt);
					}
				}
				else{
					$dtt=null;
				}


				$kat[] = [
					'produk_kategori'=>$k->produk_kategori,
					'data'=>$dtt
				];
				// print_r($data);

				// echo $kid;
			}

			// print_r($kat);
		}
		else{
			$kat=null;
		}

		$data['kat'] = $kat;

		if (!empty($this->input->get('print'))) {
			# code...

		
		$data['kat'] = $this->session->userdata('ddd');
		$data['kasir'] = $this->session->userdata('kasir');
				$data['tanggal']  = $this->session->userdata('tanggal');
		$this->load->view('admin/laporan/cetak_detail', $data);

		}
		else{

		$this->session->set_userdata(['ddd'=>$kat]);
		$this->session->set_userdata(['kasir'=>$kasir]);
		$this->session->set_userdata(['tanggal'=>$dari.' - '.$sampai]);
					$data['admincontent']		= "$this->url1/$this->url2/laporan_detail";

		$this->load->view('admin_template', $data);

		}


	}

	public function laporan_penjualan(){

		
		$sampai = $this->input->get('sampai');
		$kasir = $this->input->get('kasir');
		$dari = $this->input->get('dari');


		$data 						= $this->data;
		$data['judul'] 				= "Laporan Penjualan";
		$data['admincontent']		= "$this->url1/$this->url2/laporan_penjualan";
		$data['kasir']   			= $this->db->get('tb_login');





		if (!empty($this->input->get('print'))) {
			# code...

		

		$qs = $this->session->userdata('q');
		// echo $qs;
		$q=$this->db->query($qs);

		$data['datane'] = $q;

		$data['tanggal']  = $this->session->userdata('tanggal');
		$data['kasir'] = $this->session->userdata('kasir');
		$this->load->view('admin/laporan/cetak_penjualan', $data);

		}
		else{

$q = "SELECT a.*,b.id_transaksi_penjualan FROM tb_penjualan_pembayaran a inner join tb_transaksi_penjualan b on a.id_penjualan = b.id_transaksi_penjualan WHERE b.tanggal_transaksi BETWEEN '$dari' AND '$sampai' " ;


if (!empty($kasir)) {
$q = "SELECT a.*,b.id_transaksi_penjualan FROM tb_penjualan_pembayaran a inner join tb_transaksi_penjualan b on a.id_penjualan = b.id_transaksi_penjualan  WHERE b.id_user='".$kasir."' AND b.tanggal_transaksi BETWEEN '$dari' AND '$sampai'  " ;

}
else{
$q = "SELECT a.*,b.id_transaksi_penjualan FROM tb_penjualan_pembayaran a inner join tb_transaksi_penjualan b on a.id_penjualan = b.id_transaksi_penjualan WHERE b.tanggal_transaksi BETWEEN '$dari' AND '$sampai' " ;

}
		$this->session->set_userdata(['q'=>$q]);
		$this->session->set_userdata(['kasir'=>$kasir]);
		$this->session->set_userdata(['tanggal'=>$dari.' - '.$sampai]);

	$q=$this->db->query($q);

		$data['datane'] = $q;
		$this->load->view('admin_template', $data);
		}

	}

	public function laporan_ringkasan(){

		
		$sampai = $this->input->get('sampai');
		$kasir = $this->input->get('kasir');
		$dari = $this->input->get('dari');

	
		$data 						= $this->data;
		$data['judul'] 				= "Laporan Penjualan";
		$data['admincontent']		= "$this->url1/$this->url2/laporan_ringkasan";
		$data['kasir']   			= $this->db->get('tb_login');






		if (!empty($this->input->get('print'))) {
			# code...

		

		$qs = $this->session->userdata('q');
		// echo $qs;
		// $q=$this->db->query($qs);


		$data['satu']  = $this->db->query($qs)->row();
		$data['kasir'] = $this->session->userdata('kasir');
		$data['tanggal']  = $this->session->userdata('tanggal');
		$this->load->view('admin/laporan/cetak_ringkasan', $data);

		}
		else{
			if (!empty($kasir)) {

		$sql = "SELECT sum(total_semua) as nilai_penjualan,sum(diskon_total) as total_diskon,count(*) as jumlah_nota, sum(service_fee_angka) as service_fee,sum(pajak_angka) as pajak, sum(total) as total,sum(tunai) as tunai,sum(dp) as dp, sum(voucher) as voucher, sum(card) as card, sum(kredit) as kredit, sum(tunai) + sum(dp) + sum(voucher) + sum(card) + sum(kredit) as totalsemua,sum(kembali) as kembali from tb_penjualan_pembayaran inner join tb_transaksi_penjualan b on tb_penjualan_pembayaran.id_penjualan = b.id_transaksi_penjualan WHERE id_user='".$kasir."' AND date(created_at) BETWEEN '$dari' AND '$sampai'";
			}
			else{

		$sql = "SELECT sum(total_semua) as nilai_penjualan,sum(diskon_total) as total_diskon,count(*) as jumlah_nota, sum(service_fee_angka) as service_fee,sum(pajak_angka) as pajak, sum(total) as total,sum(tunai) as tunai,sum(dp) as dp, sum(voucher) as voucher, sum(card) as card, sum(kredit) as kredit, sum(tunai) + sum(dp) + sum(voucher) + sum(card) + sum(kredit) as totalsemua,sum(kembali) as kembali from tb_penjualan_pembayaran inner join tb_transaksi_penjualan b on tb_penjualan_pembayaran.id_penjualan = b.id_transaksi_penjualan WHERE date(created_at) BETWEEN '$dari' AND '$sampai'";
			}
			
		$qs = $this->session->set_userdata('q',$sql);
		$this->session->set_userdata(['kasir'=>$kasir]);
		$this->session->set_userdata(['tanggal'=>$dari.' - '.$sampai]);

		$data['satu']  = $this->db->query($sql)->row();

		$this->load->view('admin_template', $data);

}	

	}

}
	

