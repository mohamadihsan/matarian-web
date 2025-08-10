<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Unifikasi_Kode_Objek_Pajak_Model extends CI_Model
{

    // get
    public function get($param = null)
    {

        $this->db->select('tbl_unifikasi_kode_objek_pajak.id, tbl_unifikasi_kode_objek_pajak.kode, tbl_unifikasi_kode_objek_pajak.nama, tbl_unifikasi_kode_objek_pajak.tarif');
        $this->db->order_by('tbl_unifikasi_kode_objek_pajak.kode', 'asc');
        if ($param != null) {
            $this->db->where('tbl_unifikasi_kode_objek_pajak.id', $param);
        }

        return $this->db->get('tbl_unifikasi_kode_objek_pajak');
    }
}

/* End of file Unifikasi_Kode_Objek_Pajak_Model.php */
