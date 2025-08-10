<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Unifikasi_Kode_Dokumen_Model extends CI_Model
{

    // get
    public function get($param = null)
    {

        $this->db->select('tbl_unifikasi_kode_dokumen.id, tbl_unifikasi_kode_dokumen.kode, tbl_unifikasi_kode_dokumen.nama');
        $this->db->order_by('tbl_unifikasi_kode_dokumen.kode', 'asc');
        if ($param != null) {
            $this->db->where('tbl_unifikasi_kode_dokumen.id', $param);
        }

        return $this->db->get('tbl_unifikasi_kode_dokumen');
    }
}

/* End of file Unifikasi_Kode_Dokumen_Model.php */
