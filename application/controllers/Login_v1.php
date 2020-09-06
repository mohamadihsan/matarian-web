<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateTokenOnPage();
    }

    public function index()
    {
        $data['title'] = 'Login';


        $this->load->view('_layout/auth-header', $data);
        $this->load->view('pages/login', $data);
        $this->load->view('_layout/auth-footers', $data);
    }

}

/* End of file Login.php */
