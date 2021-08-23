<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MTransaksi extends CI_Model {

    var $table = 'tb_transaksi_penjualan';
    var $idtable = 'id_transaksi_penjualan';
    var $column_order = array('','id_transaksi_penjualan', 'tanggal_transaksi','nama_meja','total_transaksi','status_konfirmasi_koki','status_pembayaran_transaksi',''); //set column field database for datatable orderable
    var $column_search = array('id_transaksi_penjualan', 'tanggal_transaksi','nama_meja','total_transaksi','status_konfirmasi_koki','status_pembayaran_transaksi'); //set column field database for datatable searchable 
    var $order = array('id_transaksi_penjualan' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->join('tb_meja', 'tb_transaksi_penjualan.id_meja = tb_meja.id_meja');
        $this->db->from($this->table);
        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if(@$_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if(@$_POST['length'] != -1)
        $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

	function kode_otomatis(){
        $this->db->select('tb_transaksi_penjualan.id_transaksi_penjualan as kode ',false);
        $this->db->order_by('id_transaksi_penjualan', 'desc');
        $this->db->limit(1);
        $query = $this->db->get('tb_transaksi_penjualan');
        if($query->num_rows()<>0){
            $data = $query->row();
            $kode = intval($data->kode)+1;
        }else{
            $kode = 1;

        }
        $kodemax = str_pad($kode,7,"0",STR_PAD_LEFT); 
        $kodejadi  = $kodemax;
        return $kodejadi;
    }

    public function copydata($id_user){
        $this->db->query('INSERT INTO tb_transaksi_penjualan_detail (id_transaksi_penjualan,id_produk,harga_transaksi,jumlah_transaksi, total_transaksi,diskon_angka,diskon_persen,total_semua) SELECT id_transaksi_penjualan, id_produk, harga_transaksi, jumlah_transaksi, total_transaksi,diskon_angka,diskon_persen,total_semua FROM tb_transaksi_penjualan_detail_sementara WHERE id_user = "'.$id_user.'" ');
    }
    public function copydatabayar($id_user){
        $this->db->query('INSERT INTO tb_transaksi_penjualan_detail (id_transaksi_penjualan,id_produk,harga_transaksi,jumlah_transaksi, total_transaksi,diskon_angka,diskon_persen,total_semua,status_transaksi) SELECT id_transaksi_penjualan, id_produk, harga_transaksi, jumlah_transaksi, total_transaksi,diskon_angka,diskon_persen,total_semua,"Terima" FROM tb_transaksi_penjualan_detail_sementara WHERE id_user = "'.$id_user.'" ');
    }

    public function truncatedata($id_user) {
        $tables = array('tb_transaksi_penjualan_detail_sementara');
        $this->db->where('id_user', $id_user);
        $this->db->delete($tables);
    }

    public function detail($id_transaksi){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_meja', 'tb_transaksi_penjualan.id_meja = tb_meja.id_meja');
        $this->db->join('tb_transaksi_penjualan_detail', 'tb_transaksi_penjualan.id_transaksi_penjualan = tb_transaksi_penjualan_detail.id_transaksi_penjualan');
        $this->db->join('tb_login', 'tb_transaksi_penjualan.id_user = tb_login.id_user');
        $this->db->join('tb_karyawan', 'tb_login.id_user_detail_karyawan = tb_karyawan.id_karyawan');
        $this->db->where('tb_transaksi_penjualan.id_transaksi_penjualan', $id_transaksi);
        $query = $this->db->get();
        return $query;
    }

    public function detail_edit($id_transaksi){
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->join('tb_meja', 'tb_transaksi_penjualan.id_meja = tb_meja.id_meja');
        // $this->db->join('tb_transaksi_penjualan_detail', 'tb_transaksi_penjualan.id_transaksi_penjualan = tb_transaksi_penjualan_detail.id_transaksi_penjualan');
        $this->db->join('tb_login', 'tb_transaksi_penjualan.id_user = tb_login.id_user');
        $this->db->join('tb_karyawan', 'tb_login.id_user_detail_karyawan = tb_karyawan.id_karyawan');
        $this->db->where('tb_transaksi_penjualan.id_transaksi_penjualan', $id_transaksi);
        $query = $this->db->get();
        return $query;
    }

    public function datadetailtransaksipelayan($id)
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi_penjualan_detail');
        $this->db->join('tb_produk', 'tb_transaksi_penjualan_detail.id_produk = tb_produk.id_produk');
        $this->db->where('id_transaksi_penjualan', $id);
        $query = $this->db->get();
        return $query;
    }

    public function datadetailtransaksikoki($id)
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi_penjualan_detail');
        $this->db->join('tb_produk', 'tb_transaksi_penjualan_detail.id_produk = tb_produk.id_produk');
        $this->db->where('id_transaksi_penjualan', $id);
        // $this->db->where('status_transaksi','Terima');
        $query = $this->db->get();
        return $query;
    }

    public function datadetailtransaksipelayanprint($id)
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi_penjualan_detail');
        $this->db->join('tb_produk', 'tb_transaksi_penjualan_detail.id_produk = tb_produk.id_produk');
        $this->db->where('id_transaksi_penjualan', $id);
        $query = $this->db->get();
        return $query;
    }

    public function datadetailtransaksi($id)
    {
        $this->db->select('*');
        $this->db->from('tb_transaksi_penjualan_detail');
        $this->db->join('tb_produk', 'tb_transaksi_penjualan_detail.id_produk = tb_produk.id_produk');
        $this->db->where('id_transaksi_penjualan', $id);
        $this->db->where('status_transaksi','Terima');
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

    public function sum_produk_kasir_fix($id){
        $this->db->select_sum('total_transaksi');
        $this->db->from('tb_transaksi_penjualan_detail');
        $this->db->where('id_transaksi_penjualan',$id);
        $this->db->where('status_transaksi','Terima');
        $query = $this->db->get();
        return $query->row()->total_transaksi;
    }

    public function simpan($data) {
        return $this->db->insert('tb_transaksi_penjualan', $data);
    }

    public function updateStatusKonfirmasiKoki($id){
        
        $objek = array(
                'status_konfirmasi_koki' => 'Konfirmasi' );

        $this->db->where('id_transaksi_penjualan', $id);
        $this->db->update('tb_transaksi_penjualan', $objek);
    }

}

/* End of file MTransaksi.php */
/* Location: ./application/models/MTransaksi.php */