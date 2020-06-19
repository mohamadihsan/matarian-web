<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {

    public function index()
    {
        $data['title'] = 'Register';


        $this->load->view('_layout/auth-header', $data);
        $this->load->view('pages/register', $data);
        $this->load->view('_layout/auth-footers', $data);
    }

}

/* End of file Register.php */
