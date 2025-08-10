<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Import_Document_Model extends CI_Model {

    // insert new data
    public function import($type_document, $data, $index = null)
    {
        if ($type_document == 'ACCDBRG') {
            $table = 'tbl_accdbrg';
        } else if ($type_document == 'ACCDLGN') {
            $table = 'tbl_accdlgn';
        } else if ($type_document == 'ACCARBON') {
            $table = 'tbl_accarbon';
        } else if ($type_document == 'ACCARDAT') {
            $table = 'tbl_accardat';
        } else if ($type_document == 'KODEOBJEKPAJAK') {
            $table = 'tbl_unifikasi_kode_objek_pajak';
        } else if ($type_document == 'KODEFASILITAS') {
            $table = 'tbl_unifikasi_kode_fasilitas';
        } else if ($type_document == 'KODEPEMBAYARAN') {
            $table = 'tbl_unifikasi_kode_pembayaran';
        } else if ($type_document == 'KODEDOKUMEN') {
            $table = 'tbl_unifikasi_kode_dokumen';
        }  else if ($type_document == 'PPNMASUKKAN') {
            $table = 'tbl_upload_dokumen_pajak';
        }  else if ($type_document == 'DOKUMENLAIN') {
            $table = 'tbl_upload_dokumen_pajak';
        }  

        // transaction
        // $this->db->trans_begin();

        if ($type_document != 'PPNMASUKKAN' && ($type_document != 'DOKUMENLAIN')) {
            if ($index == 0 || $index == "0" || $index == null) {
                $this->db->truncate($table);
            }
        }
        
        $this->db->insert_batch($table, $data);
        return true;

        // if ($this->db->trans_status() === FALSE) {
        //     // $this->db->trans_rollback();
        //     return false;
        // } else {
        //     // $this->db->trans_commit();
        //     return true;
        // } 
    }

    public function get_vendor_by_npwp($npwp)
    {
        $this->db->select("*");
        $this->db->limit(1);
        $this->db->where('new_npwp', $npwp);
        
        return $this->db->get('tbl_master_vendor')->row();
    }

    public function get_perusahaan_by_npwp($npwp)
    {
        $this->db->select("*");
        $this->db->limit(1);
        $this->db->where('new_npwp', $npwp);
        
        return $this->db->get('tbl_master_perusahaan')->row();
    }

}

/* End of file Import_Document_Model.php */
