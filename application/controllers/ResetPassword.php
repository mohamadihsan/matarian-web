<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ResetPassword extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Reset Password';


        $this->load->view('_layout/auth-header', $data);
        $this->load->view('pages/reset_password', $data);
        $this->load->view('_layout/auth-footers', $data);
    }

}

/* End of file ResetPassword.php */
