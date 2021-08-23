<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MPkaryawan extends CI_Model {

	var $table = 'tb_login';
    var $idtable = 'id_user';
    var $column_order = array('','id_user','id_user_detail_karyawan','nama_karyawan','status','level',''); //set column field database for datatable orderable
    var $column_search = array('id_user','id_user_detail_karyawan','nama_karyawan','status','level'); //set column field database for datatable searchable 
    var $order = array('id_user' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->join('tb_karyawan', 'tb_login.id_user_detail_karyawan = tb_karyawan.id_karyawan');
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

    public function detail($id){
        $this->db->select('*');    
        $this->db->from('tb_login');
        $this->db->join('tb_karyawan', 'tb_login.id_user_detail_karyawan = tb_karyawan.id_karyawan');
        $this->db->where('tb_login.id_user', $id);
        $query = $this->db->get();
        return $query;
    }

    public function simpan($data) {
        return $this->db->insert($this->table, $data);
    }

    public function cek($dataku){
        $this->db->where($this->idtable,$dataku);
        $query=$this->db->get($this->table);
        
        return $query;
    }
    
    public function hapus($dataku){
        $this->db->where($this->idtable,$dataku);
        $this->db->delete($this->table);
    }


}

/* End of file MPadmin.php */
/* Location: ./application/models/MPadmin.php */