<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('encryption');
        // validate token
        $this->token = AUTHORIZATION::validateTokenOnPage();
    }

    public function index()
    {
        $data['title'] = 'Login';

        if(isset($_COOKIE['loginId'])) {
            $key = $this->config->item('encryption_key');
            $data['cookie_username'] = get_cookie('loginId');
            $data['cookie_password'] = $this->encrypt->decode(get_cookie('loginPass'));
        } else {
            $data['cookie_username'] = '';
            $data['cookie_password'] = '';
        }


        $this->load->view('_layout/auth-header', $data);
        $this->load->view('pages/login', $data);
        $this->load->view('_layout/auth-footers', $data);
    }

}

/* End of file Login.php */
