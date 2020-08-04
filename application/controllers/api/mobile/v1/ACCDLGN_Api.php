<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class ACCDLGN_Api extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('Global_Model');
        $this->load->model('ACCDLGN_Model');
        
        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
        
    }

    // provinsi
    public function show_all_post($page, $per_page)
    {
        try {
            
            $_POST = json_decode($this->input->raw_input_stream, true);
            $search = $this->input->post('search');

            $response = $this->ACCDLGN_Model->pagination($page, $per_page, $search)->result();
            $total_rows = $this->ACCDLGN_Model->count($search);
            $total_page = 1;
            $last_page = 1;
            $path = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $path .= "://" . $_SERVER['HTTP_HOST'];
            $path .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
            $path .= 'api/mobile/v1/accdlgn/pagination/page';

            if ($page > 0 && $per_page > 0) {
                $total_page = ceil($total_rows / $per_page);
                $last_page = $total_page;
            }else{    
                $per_page = $total_rows;
            }

            if($response){
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'total_rows' => $total_rows,
                    'per_page' => $per_page,
                    'current_page' => $page,
                    'last_page' => $last_page,
                    'first_page_url' => $path.'/1/per-page/'.$per_page,
                    'last_page_url' => $path.'/'.$last_page.'/per-page/'.$per_page,
                    'next_page_url' => $page < $last_page ? $path.'/'.($page+1).'/per-page/'.$per_page : null,
                    'prev_page_url' => $page > 1 ? $path.'/'.($page-1).'/per-page/'.$per_page : null,
                    'from' => ($page * $per_page) + 1 - $per_page,
                    'to' => ($page * $per_page),
                    'data' => $response
                ], REST_Controller::HTTP_OK);
            }else{
                // response success not found data
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                    'total_rows' => 0,
                    'per_page' => 0,
                    'current_page' => 0,
                    'last_page' => 0,
                    'first_page_url' => "",
                    'last_page_url' => "",
                    'next_page_url' => "",
                    'prev_page_url' => "",
                    'from' => 0,
                    'to' => 0,
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
        } catch (\Throwable $th) {
            $this->response([
                'status' => false,
                'message' => $th,
                'total_rows' => 0,
                'per_page' => 0,
                'current_page' => 0,
                'last_page' => 0,
                'first_page_url' => "",
                'last_page_url' => "",
                'next_page_url' => "",
                'prev_page_url' => "",
                'from' => 0,
                'to' => 0,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
        
    }
    
}

/* End of file ACCDLGN_Api.php */
