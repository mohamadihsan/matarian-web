<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ErrorPage extends CI_Controller {

    public function index()
    {
        $data['title'] = 'Error Page';


        $this->load->view('_layout/auth-header', $data);
        $this->load->view('pages/404', $data);
        $this->load->view('_layout/auth-footers', $data);
    }

}

/* End of file ErrorPage.php */
