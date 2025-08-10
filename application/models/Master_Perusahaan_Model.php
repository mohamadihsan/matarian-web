<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Master_Perusahaan_Model extends CI_Model
{

    // get
    public function get($param = null)
    {

        $this->db->select('tbl_master_perusahaan.*');
        $this->db->order_by('tbl_master_perusahaan.nama', 'asc');
        if ($param != null) {
            $this->db->where('tbl_master_perusahaan.id', $param);
        }

        return $this->db->get('tbl_master_perusahaan');
    }
}

/* End of file Master_Perusahaan_Model.php */
