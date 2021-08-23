<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MTransaksidetail extends CI_Model {

	public function updateStatusTransaksi($id, $status, $id_transaksi_penjualan_detail, $catatan){

	    $data = array(
	        'status_transaksi' => $status,
	        'catatan_status_detail' => $catatan
	    );

	    $data_transaksi_penjualan_detail = array(
	    	'id_transaksi_penjualan_detail' => $id_transaksi_penjualan_detail
	    );

	    // $this->db->set('tgl_jawab', 'NOW()', FALSE);
	    // $this->db->insert('jawab_kuis', $data);

	    $this->db->where('id_transaksi_penjualan', $id);
	    $this->db->where($data_transaksi_penjualan_detail);
        $this->db->update('tb_transaksi_penjualan_detail', $data);
	}


	public function detailtransaksi($id_transaksi){
        $this->db->select('*');
        $this->db->from('tb_transaksi_penjualan_detail');
        $this->db->join('tb_produk', 'tb_produk.id_produk = tb_transaksi_penjualan_detail.id_produk');
        $this->db->where('tb_transaksi_penjualan_detail.id_transaksi_penjualan', $id_transaksi);
        $query = $this->db->get();
        return $query;
    }

    public function simpan($data) {
        return $this->db->insert('tb_transaksi_penjualan_detail', $data);
    }

    public function hapus($dataku){
        $this->db->where('id_transaksi_penjualan_detail',$dataku);
        $this->db->delete('tb_transaksi_penjualan_detail');
    }

    public function cek_id_produk($id_produk,$id_user){
        $this->db->select('*');
        $this->db->from('tb_transaksi_penjualan_detail');
        $this->db->where('id_produk',$id_produk);
        $query = $this->db->get();
        return $query;
    }

    public function cek_id_produk_edit($id_produk,$id_transaksi_penjualan){
        $this->db->select('*');
        $this->db->from('tb_transaksi_penjualan_detail');
        $this->db->where('id_produk',$id_produk);
        $this->db->where('id_transaksi_penjualan',$id_transaksi_penjualan);
        $query = $this->db->get();
        return $query;
    }

    public function sum_produk($id){
        $this->db->select_sum('total_transaksi');
        $this->db->from('tb_transaksi_penjualan_detail');
        $this->db->where('id_transaksi_penjualan',$id);
        $query = $this->db->get();
        return $query->row()->total_transaksi;
    }

    public function cek_total_transaksi_per_produk($id_produk){
        $this->db->select_sum('total_transaksi');
        $this->db->from('tb_transaksi_penjualan_detail');
        $this->db->where('id_transaksi_penjualan_detail',$id_produk);
        $query = $this->db->get();
        return $query->row()->total_transaksi;
    }

}

/* End of file MTransaksidetail.php */
/* Location: ./application/models/MTransaksidetail.php */