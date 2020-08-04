<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Report_Api extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('Global_Model');
        $this->load->model('ACCDBRG_Model');
        $this->load->model('ACCARBON_Model');
        
        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
        $this->sales_ar = $this->token->data->sales_ar;

        ini_set("memory_limit", "-1");
        set_time_limit(0);
    }

    // all sales
    public function sales_post()
    {
        try {
            $_POST = json_decode($this->input->raw_input_stream, true);

            $from_date = $this->input->post('from_date');
            $end_date = $this->input->post('end_date');
            $sales_ar = $this->input->post('sales_ar');
            if ($this->sales_ar != null) {
                $sales_ar = $this->sales_ar;
            }

            // die('tes - '.$kode_langganan);
            $response = $this->ACCARBON_Model->get_sales_by_sales_ar($from_date, $end_date, $sales_ar)->result();
            $total_rows = count($response);

            $total = 0;
            foreach ($response as $res) {
                $total += $res->nilai_faktur;
            }

            if($response){
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'total_rows' => $total_rows,
                    'total' => $total,
                    'data' => $response
                ], REST_Controller::HTTP_OK);
            }else{
                // response success not found data
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                    'total_rows' => 0,
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }

        } catch (\Throwable $th) {
            // response success not found data
            $this->response([
                'status' => false,
                'message' => $th,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
        
    }

    // all sales
    public function by_sales_langganan_post()
    {
        try {
            $_POST = json_decode($this->input->raw_input_stream, true);

            $from_date = $this->input->post('from_date');
            $end_date = $this->input->post('end_date');
            $kode_langganan = $this->input->post('kode_langganan');
            $kode_barang = $this->input->post('kode_barang');

            // die('tes - '.$kode_langganan);
            $response = $this->ACCARBON_Model->get_sales($from_date, $end_date, $kode_langganan, $kode_barang, $this->sales_ar)->result();
            $total_rows = count($response);

            $total = 0;
            foreach ($response as $res) {
                $total += $res->total;
            }

            if($response){
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'total_rows' => $total_rows,
                    'total' => $total,
                    'data' => $response
                ], REST_Controller::HTTP_OK);
            }else{
                // response success not found data
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                    'total_rows' => 0,
                    'total' => 0,
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }

        } catch (\Throwable $th) {
            // response success not found data
            $this->response([
                'status' => false,
                'message' => $th,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
        
    }
    
    // all stock
    public function stock_post()
    {
        try {
            $_POST = json_decode($this->input->raw_input_stream, true);

            $kode_barang = $this->input->post('kode_barang');

            // die('tes - '.$kode_langganan);
            $response = $this->ACCDBRG_Model->get_stock($kode_barang)->result();
            $total_rows = count($response);

            if($response){
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'total_rows' => $total_rows,
                    'data' => $response
                ], REST_Controller::HTTP_OK);
            }else{
                // response success not found data
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                    'total_rows' => 0,
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }

        } catch (\Throwable $th) {
            // response success not found data
            $this->response([
                'status' => false,
                'message' => $th,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
        
    }

    // count
    public function count_get()
    {
        $response['total_rows'] = $this->ACCARBON_Model->count();
        $response['last_update'] = $this->ACCARBON_Model->last_update()->result()[0]->created_at;

        if($response){
            //response success with data
            $this->response([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $response
            ], REST_Controller::HTTP_OK);
        }else{
            // response success not found data
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }
    
    // tagihan with pagination
    public function tagihan_pagination_get($page, $per_page)
    {
        $response = $this->ACCARBON_Model->tagihan_pagination($page, $per_page, $this->sales_ar)->result();
        
        $total_rows = $this->ACCARBON_Model->count_tagihan();
        $total_page = 1;
        $last_page = 1;
        $path = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
        $path .= "://" . $_SERVER['HTTP_HOST'];
        $path .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
        $path .= 'api/mobile/v1/accardat/tagihan/pagination/page';

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

/* End of file Report_Api.php */
