<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Unifikasi_Kode_Pembayaran_Model extends CI_Model
{

    // get
    public function get($param = null)
    {

        $this->db->select('tbl_unifikasi_kode_pembayaran.id, tbl_unifikasi_kode_pembayaran.kode, tbl_unifikasi_kode_pembayaran.nama');
        $this->db->order_by('tbl_unifikasi_kode_pembayaran.kode', 'asc');
        if ($param != null) {
            $this->db->where('tbl_unifikasi_kode_pembayaran.id', $param);
        }

        return $this->db->get('tbl_unifikasi_kode_pembayaran');
    }
}

/* End of file Unifikasi_Kode_Pembayaran_Model.php */
