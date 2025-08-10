<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Unifikasi_Kode_Fasilitas_Model extends CI_Model
{

    // get
    public function get($param = null)
    {

        $this->db->select('tbl_unifikasi_kode_fasilitas.id, tbl_unifikasi_kode_fasilitas.kode, tbl_unifikasi_kode_fasilitas.nama');
        $this->db->order_by('tbl_unifikasi_kode_fasilitas.kode', 'asc');
        if ($param != null) {
            $this->db->where('tbl_unifikasi_kode_fasilitas.id', $param);
        }

        return $this->db->get('tbl_unifikasi_kode_fasilitas');
    }
}

/* End of file Unifikasi_Kode_Fasilitas_Model.php */
