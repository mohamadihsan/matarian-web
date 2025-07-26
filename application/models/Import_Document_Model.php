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
        } 

        // transaction
        // $this->db->trans_begin();
        if ($index == 0 || $index == "0" || $index == null) {
            $this->db->truncate($table);
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

}

/* End of file Import_Document_Model.php */
