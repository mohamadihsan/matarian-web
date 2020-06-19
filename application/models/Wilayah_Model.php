<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Wilayah_Model extends CI_Model {

    // get provinsi
    public function provinsi()
    {
        return $this->db->get('tbl_provinsi');
    }

    // get kabupaten
    public function kabupaten($param)
    {
        $this->db->select('id, kabupaten_kota, ibukota, k_bsni');
        $this->db->where('provinsi_id', $param);
        return $this->db->get('tbl_kabkot');
    }
    
    // get kecamatan
    public function kecamatan($param)
    {
        $this->db->select('id, kecamatan');
        $this->db->where('kabkot_id', $param);
        return $this->db->get('tbl_kecamatan');
    }
    
    // get kelurahan
    public function kelurahan($param)
    {
        $this->db->select('id, kelurahan');
        $this->db->where('kecamatan_id', $param);
        return $this->db->get('tbl_kelurahan');
    }
    
    // get kode_pos
    public function kode_pos($param)
    {
        $this->db->select('kd_pos');
        $this->db->where('id', $param);
        return $this->db->get('tbl_kelurahan');
    }

}

/* End of file Wilayah_Model.php */
