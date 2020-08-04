<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class KTP_Api extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('KTP_Model');
        $this->load->model('Global_Model');
        
        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
        
    }

    // provinsi
    public function show_all_get()
    {
        $response = $this->KTP_Model->get()->result();

        if($response){
            //response success with data
            $this->response([
                'status' => true,
                'message' => 'Data ditemukan',
                'total_rows' => $this->KTP_Model->count(),
                'last_update' => $this->KTP_Model->last_update()->result()[0]->created_at,
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

    // count
    public function count_get()
    {
        $response['total_rows'] = $this->KTP_Model->count();
        $response['last_update'] = $this->KTP_Model->last_update()->result()[0]->created_at;

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

    public function show_by_id_get()
    {
        $response = $this->KTP_Model->get()->result();

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
    
    public function create_post()
    {   
        try {
            
            $_POST = json_decode($this->input->raw_input_stream, true);

            $nik = $this->input->post('nik');
            $nama = $this->input->post('nama');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $golongan_darah = $this->input->post('golongan_darah');
            $provinsi = $this->input->post('provinsi');
            $kabupaten = $this->input->post('kabupaten');
            $kecamatan = $this->input->post('kecamatan');
            $kelurahan = $this->input->post('kelurahan');
            $kodepos = $this->input->post('kodepos');
            $alamat = $this->input->post('alamat');
            $rt = $this->input->post('rt');
            $rw = $this->input->post('rw');
            $status_perkawinan = $this->input->post('status_perkawinan');
            $agama = $this->input->post('agama');
            $pekerjaan = $this->input->post('pekerjaan');
            $kewarganegaraan = $this->input->post('kewarganegaraan');
            $created_by = $this->token->data->username;

            $post = array(
                'nik' => $nik,
                'nama' => strtoupper($nama),
                'tempat_lahir' => strtoupper($tempat_lahir),
                'tgl_lahir' => $tgl_lahir,
                'jenis_kelamin' => strtoupper($jenis_kelamin),
                'golongan_darah' => strtoupper($golongan_darah),
                'provinsi' => strtoupper($provinsi),
                'kabupaten' => strtoupper($kabupaten),
                'kecamatan' => strtoupper($kecamatan),
                'kelurahan' => strtoupper($kelurahan),
                'kodepos' => strtoupper($kodepos),
                'alamat' => strtoupper($alamat),
                'rt' => $rt,
                'rw' => $rw,
                'status_perkawinan' => strtoupper($status_perkawinan),
                'agama' => strtoupper($agama),
                'pekerjaan' => strtoupper($pekerjaan),
                'kewarganegaraan' => strtoupper($kewarganegaraan),
                'created_by' => $created_by
            ); 

            $save = $this->KTP_Model->insert($post);
            if($save){
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data berhasil ditambahkan',
                    'data' => $save
                ], REST_Controller::HTTP_OK);
            }else{
                // response failed
                $this->response([
                    'status' => false,
                    'message' => 'Data gagal ditambahkan',
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
            
        } catch (\Throwable $th) {
            // response failed
            $this->response([
                'status' => false,
                'message' => $th,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }

    public function update_put($id)
    {   
        try {
            
            $_POST = json_decode($this->input->raw_input_stream, true);

            $nik = $this->input->post('nik');
            $nama = $this->input->post('nama');
            $tempat_lahir = $this->input->post('tempat_lahir');
            $tgl_lahir = $this->input->post('tgl_lahir');
            $jenis_kelamin = $this->input->post('jenis_kelamin');
            $golongan_darah = $this->input->post('golongan_darah');
            $provinsi = $this->input->post('provinsi');
            $kabupaten = $this->input->post('kabupaten');
            $kecamatan = $this->input->post('kecamatan');
            $kelurahan = $this->input->post('kelurahan');
            $kodepos = $this->input->post('kodepos');
            $alamat = $this->input->post('alamat');
            $rt = $this->input->post('rt');
            $rw = $this->input->post('rw');
            $status_perkawinan = $this->input->post('status_perkawinan');
            $agama = $this->input->post('agama');
            $pekerjaan = $this->input->post('pekerjaan');
            $kewarganegaraan = $this->input->post('kewarganegaraan');
            $updated_at =  $this->time_server;
            $updated_by = $this->token->data->username;

            $post = array(
                'nik' => $nik,
                'nama' => strtoupper($nama),
                'tempat_lahir' => strtoupper($tempat_lahir),
                'tgl_lahir' => $tgl_lahir,
                'jenis_kelamin' => strtoupper($jenis_kelamin),
                'golongan_darah' => strtoupper($golongan_darah),
                'provinsi' => strtoupper($provinsi),
                'kabupaten' => strtoupper($kabupaten),
                'kecamatan' => strtoupper($kecamatan),
                'kelurahan' => strtoupper($kelurahan),
                'kodepos' => strtoupper($kodepos),
                'alamat' => strtoupper($alamat),
                'rt' => $rt,
                'rw' => $rw,
                'status_perkawinan' => strtoupper($status_perkawinan),
                'agama' => strtoupper($agama),
                'pekerjaan' => strtoupper($pekerjaan),
                'kewarganegaraan' => strtoupper($kewarganegaraan),
                'updated_at' => $updated_at,
                'updated_by' => $updated_by
            ); 

            $update = $this->KTP_Model->update($post, $id);
            if($update){
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data berhasil diperbaharui',
                    'data' => $update
                ], REST_Controller::HTTP_OK);
            }else{
                // response failed
                $this->response([
                    'status' => false,
                    'message' => 'Data gagal diperbaharui',
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
            
        } catch (\Throwable $th) {
            // response failed
            $this->response([
                'status' => false,
                'message' => $th,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }

    public function destroy_delete($id)
    {
        try {
            
            $deleted_at =  $this->time_server;
            $deleted_by = $this->token->data->username;

            $post = array(
                'deleted_at' => $deleted_at,
                'deleted_by' => $deleted_by
            ); 

            $delete = $this->KTP_Model->delete($id);
            if($delete){
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data berhasil dihapus',
                    'data' => $delete
                ], REST_Controller::HTTP_OK);
            }else{
                // response failed
                $this->response([
                    'status' => false,
                    'message' => 'Data gagal dihapus',
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
            
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

/* End of file KTP_Api.php */
