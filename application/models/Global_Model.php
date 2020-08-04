<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Global_Model extends CI_Model {

    // time_server
    public function time_server()
    {
        
        $this->db->select('now() as time_server');
        return $this->db->get();
    }

}

/* End of file Global_Model.php */
