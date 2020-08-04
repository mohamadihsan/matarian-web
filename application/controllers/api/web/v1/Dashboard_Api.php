<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Dashboard_Api extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('Global_Model');
        $this->load->model('Dashboard_Model');
        
        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
        $this->user = $this->token->data->user_id;
        $this->sales_ar = $this->token->data->sales_ar;
    }

    // index with one request
    public function index_get()
    {
        try {
            
            $data['penjualan'] = array(
                'total_rows' =>  1, 
                'total_penjualan_bulan_ini' => abs($this->Dashboard_Model->total_penjualan(date('Y-m', strtotime($this->time_server)))->result()[0]->prf_barang),
                'last_update' => $this->Dashboard_Model->last_update_accarbon()->result()[0]->created_at
            );
            
            $data['tagihan'] = array(
                'total_rows' =>  $this->Dashboard_Model->count_tagihan($this->user, $this->sales_ar), 
                'total_tagihan' => abs($this->Dashboard_Model->total_tagihan($this->user, $this->sales_ar)->result()[0]->sisa_ar),
                'last_update' => $this->Dashboard_Model->last_update_tagihan()->result()[0]->created_at
            );

            $data['ktp'] = array(
                'total_rows' =>  $this->Dashboard_Model->count_ktp(), 
                'last_update' => $this->Dashboard_Model->last_update_ktp()->result()[0]->created_at
            );
    
            $data['npwp'] = array(
                'total_rows' =>  $this->Dashboard_Model->count_npwp(), 
                'last_update' => $this->Dashboard_Model->last_update_npwp()->result()[0]->created_at
            );
    
            $data['accdbrg'] = array(
                'total_rows' =>  $this->Dashboard_Model->count_accdbrg(), 
                'last_update' => $this->Dashboard_Model->last_update_accdbrg()->result()[0]->created_at
            );
    
            $data['accdlgn'] = array(
                'total_rows' =>  $this->Dashboard_Model->count_accdlgn(), 
                'last_update' => $this->Dashboard_Model->last_update_accdlgn()->result()[0]->created_at
            );
    
            $data['accarbon'] = array(
                'total_rows' =>  $this->Dashboard_Model->count_accarbon(), 
                'last_update' => $this->Dashboard_Model->last_update_accarbon()->result()[0]->created_at
            );
    
            $data['accardat'] = array(
                'total_rows' =>  $this->Dashboard_Model->count_accardat(), 
                'last_update' => $this->Dashboard_Model->last_update_accardat()->result()[0]->created_at
            );
            
            $data['pending_activation'] = array(
                'total_rows' =>  $this->Dashboard_Model->count_pending_activation(), 
                'last_update' => $this->Dashboard_Model->last_update_pending_activation()->result()[0]->created_at
            );

            //response success with data
            $this->response([
                'status' => true,
                'message' => 'Data Dashboard',
                'data' => $data
            ], REST_Controller::HTTP_OK);

        } catch (\Throwable $th) {

            // response success not found data
            $this->response([
                'status' => false,
                'message' => $th,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);

        }
        
    }

    // tagihan
    public function show_all_tagihan_get()
    {
        $response = $this->Dashboard_Model->get_tagihan()->result();

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

    // count tagihan
    public function count_tagihan_get()
    {
        $response['total_rows'] = $this->Dashboard_Model->count_tagihan($this->user);
        $response['total_tagihan'] = abs($this->Dashboard_Model->total_tagihan($this->user)->result()[0]->sisa_ar);
        $response['last_update'] = $this->Dashboard_Model->last_update_tagihan()->result()[0]->created_at;

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

    // best_buyer
    public function best_buyer_get($year, $month, $limit)
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

        $response = $this->Dashboard_Model->best_buyer($year, $month, $limit, $this->sales_ar)->result();

        if($response){
            //response success with data
            $this->response([
                'status' => true,
                'message' => 'Data'.$message.' ditemukan',
                'data' => $response
            ], REST_Controller::HTTP_OK);
        }else{
            // response success not found data
            $this->response([
                'status' => false,
                'message' => 'Data'.$message.' tidak ditemukan',
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }

    // best seller
    public function best_seller_get($year, $month, $limit)
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

        $response = $this->Dashboard_Model->best_seller($year, $month, $limit, $this->sales_ar)->result();

        if($response){
            //response success with data
            $this->response([
                'status' => true,
                'message' => 'Data'.$message.' ditemukan',
                'data' => $response
            ], REST_Controller::HTTP_OK);
        }else{
            // response success not found data
            $this->response([
                'status' => false,
                'message' => 'Data'.$message.' tidak ditemukan',
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }

    // user login today
    public function user_login_get($limit = null)
    {
        $response = $this->Dashboard_Model->user_login($limit)->result();

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

    // count KTP
    public function count_ktp_get()
    {
        $response['total_rows'] = $this->Dashboard_Model->count_ktp();
        $response['last_update'] = $this->Dashboard_Model->last_update_ktp()->result()[0]->created_at;

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

    // count npwp
    public function count_npwp_get()
    {
        $response['total_rows'] = $this->Dashboard_Model->count_npwp();
        $response['last_update'] = $this->Dashboard_Model->last_update_npwp()->result()[0]->created_at;

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

    // count accdbrg
    public function count_accdbrg_get()
    {
        $response['total_rows'] = $this->Dashboard_Model->count_accdbrg();
        $response['last_update'] = $this->Dashboard_Model->last_update_accdbrg()->result()[0]->created_at;

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

    // count accdlgn
    public function count_accdlgn_get()
    {
        $response['total_rows'] = $this->Dashboard_Model->count_accdlgn();
        $response['last_update'] = $this->Dashboard_Model->last_update_accdlgn()->result()[0]->created_at;

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

    // count accarbon
    public function count_accarbon_get()
    {
        $response['total_rows'] = $this->Dashboard_Model->count_accarbon();
        $response['last_update'] = $this->Dashboard_Model->last_update_accarbon()->result()[0]->created_at;

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

    // count accardat
    public function count_accardat_get()
    {
        $response['total_rows'] = $this->Dashboard_Model->count_accardat();
        $response['last_update'] = $this->Dashboard_Model->last_update_accardat()->result()[0]->created_at;

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
}

/* End of file Dashboard_Api.php */
