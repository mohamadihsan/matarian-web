<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // check token
        $this->token = AUTHORIZATION::validateTokenOnPage();
        
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['token'] = $this->token;


        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('_layout/topbar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('_layout/footer');
    }
}
