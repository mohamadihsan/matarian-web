<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class ACCDBRG_Model extends CI_Model {

    // get
    public function get()
    {
        $this->db->order_by('nama_barang', 'asc');
        return $this->db->get('tbl_accdbrg');
    }

    // get stock
    public function get_stock($kode_barang)
    {
        if ($kode_barang != '') {
            $this->db->where('tbl_accdbrg.kode_barang', $kode_barang);
        }
        $this->db->order_by('tbl_accdbrg.kode_barang', 'asc');        
        return $this->db->get('tbl_accdbrg');
    }

    // get stock
    public function get_stock_pagination($kode_barang, $page, $per_page, $search)
    {
        if ($kode_barang != '') {
            $this->db->where('tbl_accdbrg.kode_barang', $kode_barang);
        }
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }
        if ($search != '') {
            $this->db->like('kode_barang', $search);
            $this->db->or_like('nama_barang', $search);
            $this->db->or_like('satuan', $search);
        }
        $this->db->select('id, kode_barang, golongan, nama_barang, pabrik, satuan, packing, satuan_per_pak, harga_satuan, harga_pokok, harga_beli, keterangan_barang, COALESCE(gudang_a, 0) as gudang_a, COALESCE(gudang_b, 0) as gudang_b, COALESCE(gudang_c, 0) as gudang_c, COALESCE(gudang_d, 0) as gudang_d, COALESCE(gudang_e, 0) as gudang_e, COALESCE(gudang_f, 0) as gudang_f, jumlah_stok, minimum, created_at, created_by');
        
        $this->db->order_by('tbl_accdbrg.kode_barang', 'asc');        
        return $this->db->get('tbl_accdbrg');
    }

    public function count_get_stock_pagination($kode_barang, $search)
    {
        if ($kode_barang != '') {
            $this->db->where('tbl_accdbrg.kode_barang', $kode_barang);
        }
        if ($search != '') {
            $this->db->like('kode_barang', $search);
            $this->db->or_like('nama_barang', $search);
            $this->db->or_like('satuan', $search);
        }
        
        return $this->db->get('tbl_accdbrg')->num_rows();
    }

    // num row
    public function count($param = null)
    {
        if ($param != null) {
            $this->db->where('id', $param);
        }
        
        return $this->db->get('tbl_accdbrg')->num_rows();
    }

    // last update
    public function last_update()
    {
        $this->db->select_max('created_at');
        return $this->db->get('tbl_accdbrg');
    }

}

/* End of file ACCDBRG_Model.php */
