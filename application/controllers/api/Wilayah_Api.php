<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Wilayah_Api extends REST_Controller {
    
    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('Wilayah_Model');
        
    }

    // wilayah
    public function index_post()
    {
        try {
            $_POST = json_decode($this->input->raw_input_stream, true);

            $param = array(
                "provinsi" => $this->input->post('provinsi'),
                "kabupaten" => $this->input->post('kabupaten'),
                "kecamatan" => $this->input->post('kecamatan'),
                "kelurahan" => $this->input->post('kelurahan')
            );
            
            $response = $this->Wilayah_Model->wilayah($param)->result();
    
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
        } catch (\Throwable $th) {
            $this->response([
                'status' => false,
                'message' => $th,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
        
    }

     // wilayah
     public function index_v2_post()
     {
         try {
             $_POST = json_decode($this->input->raw_input_stream, true);
 
             $param = array(
                 "provinsi" => $this->input->post('provinsi'),
                 "kabupaten" => $this->input->post('kabupaten'),
                 "kecamatan" => $this->input->post('kecamatan'),
                 "kelurahan" => $this->input->post('kelurahan')
             );
             
             $response = $this->Wilayah_Model->wilayah_v2($param);
     
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
         } catch (\Throwable $th) {
             $this->response([
                 'status' => false,
                 'message' => $th,
                 'data' => []
             ], REST_Controller::HTTP_PARTIAL_CONTENT);
         }
         
     }

    // provinsi
    public function provinsi_get()
    {
        $response = $this->Wilayah_Model->provinsi()->result();

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

    public function provinsi_post()
    {
        $selected = $this->post('provinsi');
        $response = $this->Wilayah_Model->provinsi($selected)->result();

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

    // kabupaten
    public function kabupaten_get($param, $selected = null)
    {
        $response = $this->Wilayah_Model->kabupaten($param, $selected)->result();

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

    // kecamatan
    public function kecamatan_get($param, $selected = null)
    {
        $response = $this->Wilayah_Model->kecamatan($param, $selected)->result();

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

    // kelurahan
    public function kelurahan_get($param, $selected = null)
    {
        $response = $this->Wilayah_Model->kelurahan($param, $selected)->result();

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

    // kode pos
    public function kode_pos_get($param, $selected = null)
    {
        $response = $this->Wilayah_Model->kode_pos($param, $selected)->result();

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

/* End of file Wilayah_Api.php */
