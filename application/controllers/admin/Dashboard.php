<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{

    public function __construct()
    {
        ini_set('date.timezone', 'Asia/Jakarta');

        parent::__construct();
        if ($this->inilogin->level != "Admin") {
            redirect(base_url('forbidden'));
        }
    }

    public function index()
    {

        $data = $this->data;
        $data['judul'] = "Dashboard";
        $data['jumlahkaryawan'] = $this->db->count_all('tb_karyawan');
        $data['jumlahmeja'] = $this->db->count_all('tb_meja');
        $data['admincontent'] = "admin_content";

        $hariini = date('Y-m-d');

        $trx = $this->db->query("SELECT sum(total_transaksi) as total_trx,count(*) as totale FROM tb_transaksi_penjualan WHERE tanggal_transaksi='" . $hariini . "' AND status_pembayaran_transaksi='Sudah Bayar'");

        $data['total_transaksi'] = $trx->num_rows() > 0 ? $trx->row()->total_trx : 0;

        $data['struk'] = $trx->num_rows() > 0 ? $trx->row()->totale : 0;

        $menu = $this->db->get('tb_produk')->num_rows();
        $data['menu'] = $menu;

        $q_trx = $this->db->order_by('id_transaksi_penjualan', 'desc')->get_where('tb_transaksi_penjualan', ['tanggal_transaksi' => date('Y-m-d'), 'status_pembayaran_transaksi' => 'Sudah Bayar']);

        $data['trx'] = $q_trx;

        $q_menu = $this->db->query("SELECT b.nama_produk, sum(a.jumlah_transaksi) as jml,sum(a.total_transaksi) as total FROM tb_transaksi_penjualan_detail a LEFT JOIN tb_produk b on a.id_produk = b.id_produk LEFT JOIN tb_transaksi_penjualan c on c.id_transaksi_penjualan = a.id_transaksi_penjualan WHERE c.tanggal_transaksi='" . $hariini . "' AND c.status_pembayaran_transaksi='Sudah Bayar' GROUP by a.id_produk
");

        // exit();

        // print_r($trx->result())
        $data['menune'] = $q_menu;
        // $data['']

        // echo $menu->num_rows();
        // echo "SELECT sum(total_transaksi) as total FROM tb_transaksi_penjualan WHERE tanggal_transaksi='".$hariini."'";
        // print_r($total_transaksi);
        $data['admincontent'] = "admin_content";
// echo "SELECT sum(total_transaksi) as total_trx,count(*) as totale FROM tb_transaksi_penjualan WHERE tanggal_transaksi='".$hariini."'";
        $graph_menu_fav = $this->db->query("SELECT MAX(ct) max, nama_produk, MONTHNAME(tanggal_transaksi) bulan FROM v_graph_menu_fav GROUP BY MONTH(tanggal_transaksi)")->result();

        $graph_menu_ct = $this->db->query("SELECT nama_produk, ct FROM v_graph_menu_fav WHERE MONTH(tanggal_transaksi) = MONTH(NOW())")->result();

        // var_dump($data['food_fav_month']);die();

        $data['graph_food_fav'] = $graph_menu_fav;
        $data['graph_food_ct'] = $graph_menu_ct;

        $this->load->view('admin_template', $data);
    }

    public function setting()
    {
        $this->load->library('user_agent');

        if ($this->input->post()) {
            // print_r($this->input->post());
            if (!empty($this->input->post())) {
                # code...
                foreach ($this->input->post() as $key => $value) {
                    $nama = $key;
                    $nilai = $value;
                    // echo $nama."<br>";
                    $cari = $this->db->get_where('tb_setting', array('nama' => $nama));
                    if ($cari->num_rows() > 0) {
                        $id = $cari->row()->id;

                        $this->db->update('tb_setting', ['nilai' => $nilai], ['id' => $id]);

                        // print_r($id);
                    }
                    // $nilai = $this->input->post("$key");

                }
                redirect($this->agent->referrer());
            }
        } else {
            $data = $this->data;
            $data['judul'] = "Pengaturan";
            $data['admincontent'] = "setting";

            $data['data'] = $this->db->get('tb_setting');
            $this->load->view('admin_template', $data);

        }

    }
}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */