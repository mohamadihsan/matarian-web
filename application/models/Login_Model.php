<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_Model extends CI_Model {

    public function create_log($data)
    {
        $this->db->insert('tbl_login', $data);
        return $this->db->insert_id();
    }

}

/* End of file Login_Model.php */
