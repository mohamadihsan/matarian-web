<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class ACCARBON_Api extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('ACCARBON_Model');
        
    }

    // pagination
    public function pagination_get($year, $month, $page, $per_page)
    {
        $message = '';
        if ($year == "0000") {
            $year = null;
        } else {
            $message .= ' tahun '.$year;
        }
        if ($month == "0000") {
            $month = null;
        } else {
            $message .= ' bulan '.$month;
        }

        $response = $this->ACCARBON_Model->pagination($year, $month, $page, $per_page)->result();
        $total_rows = $this->ACCARBON_Model->count();
        $total_page = 1;
        $last_page = 1;
        $path = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
        $path .= "://" . $_SERVER['HTTP_HOST'];
        $path .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
        $path .= 'api/mobile/v1/accarbon/pagination/page';

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
                'current_page' => null,
                'last_page' => null,
                'first_page_url' => null,
                'last_page_url' => null,
                'next_page_url' => null,
                'prev_page_url' => null,
                'from' => null,
                'to' => null,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }
}

/* End of file ACCARBON_Api.php */
