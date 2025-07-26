<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ACCDLGN_Model extends CI_Model
{

    // get
    public function get($kode_langganan = null)
    {
        if ($kode_langganan != null) {
            $this->db->where('kode_langganan', $kode_langganan);
        }
        $this->db->order_by('kode_langganan', 'asc');
        return $this->db->get('tbl_accdlgn');
    }

    public function pagination($page, $per_page, $search)
    {
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }
        if ($search != '') {
            $this->db->like('kode_langganan', $search);
            $this->db->or_like('nama_toko', $search);
        }
        $this->db->select('id, kode_langganan, nama_toko as nama_langganan, kota, telepon');
        $this->db->order_by('tbl_accdlgn.kode_langganan', 'asc');
        return $this->db->get('tbl_accdlgn');
    }

    // count
    public function count($search)
    {
        if ($search != '') {
            $this->db->like('kode_langganan', $search);
            $this->db->or_like('nama_toko', $search);
        }

        return $this->db->get('tbl_accdlgn')->num_rows();
    }
}

/* End of file ACCDLGN_Model.php */
