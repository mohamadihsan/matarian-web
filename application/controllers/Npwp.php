<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Npwp extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Identity Card : NPWP';

        // role
        $data['action_create'] = true;
        $data['action_update'] = true;
        $data['action_delete'] = true;
        $data['action_approval'] = true;
        $data['action_export_to_excel'] = true;
        $data['action_export_to_csv'] = true;
        $data['action_export_to_pdf'] = true;

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('_layout/topbar', $data);
        $this->load->view('pages/npwp', $data);
        $this->load->view('_layout/footer');
    }

}

/* End of file Npwp.php */
