<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout_Model extends CI_Model {

    public function create_log($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_login', $data);
        return $this->db->insert_id();
    }

    public function get_login($token)
    {
        $this->db->where('token_var', $token);
        return $this->db->get('tbl_login');
    }

}

/* End of file Logout_Model.php */
