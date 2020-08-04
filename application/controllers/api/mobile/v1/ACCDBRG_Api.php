<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class ACCDBRG_Api extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('Global_Model');
        $this->load->model('ACCDBRG_Model');
        
        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
        
    }

    // provinsi
    public function show_all_get()
    {
        $response = $this->ACCDBRG_Model->get()->result();
        $total_rows = count($response);
        $last_update = $this->ACCDBRG_Model->last_update()->result()[0]->created_at;

        if($response){
            //response success with data
            $this->response([
                'status' => true,
                'message' => 'Data ditemukan',
                'last_update' => $last_update,
                'total_rows' => $total_rows,
                'data' => $response
            ], REST_Controller::HTTP_OK);
        }else{
            // response success not found data
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'last_update' => null,
                'total_rows' => 0,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }
}

/* End of file ACCDBRG_Api.php */
