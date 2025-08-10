<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Unifikasi_Kode_Dokumen_Api extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('Global_Model');
        $this->load->model('Unifikasi_Kode_Dokumen_Model');

        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
    }

    // provinsi
    public function show_all_get()
    {
        $response = $this->Unifikasi_Kode_Dokumen_Model->get()->result();

        if ($response) {
            //response success with data
            $this->response([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $response
            ], REST_Controller::HTTP_OK);
        } else {
            // response success not found data
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }
}

/* End of file Unifikasi_Kode_Dokumen_Api.php */
