<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Logout_Api extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        // load model
        $this->load->model('Global_Model');
        $this->load->model('User_Model');
        $this->load->model('Logout_Model');
        
        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
        
    }

    // login
    public function logout_post()
    {
        try {
            
            $_POST = json_decode($this->input->raw_input_stream, true);

            // get data login
            $get = $this->Logout_Model->get_login($_SESSION['auth']['token'])->result();
            if ($get) {
                $date = new DateTime();
                // create log logout
                $this->Logout_Model->create_log(array('logout_at' => $date->format('Y-m-d H:i:s')), $get[0]->id);
            }

            // session destroy
            session_destroy();
            
            //response
            $this->response([
                'status' => true,
                'message' => 'Logout successfully...',
                'data' => []
            ], REST_Controller::HTTP_OK);
             
        } catch (\Throwable $th) {
            // response failed
            $this->response([
                'status' => false,
                'message' => $th,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }
}

/* End of file Logout_Api.php */
