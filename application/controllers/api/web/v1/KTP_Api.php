<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class KTP_Api extends REST_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('master/Desc_model');
        $this->load->library('Token_Validation');
        
    }

    public function show_all_get()
    {
        // request header authorization
        $token = $this->input->get_request_header('Authorization');
        // jika ada header token
        if($token){
            
            //cek validasi token
            if($this->token_validation->check($token)){
                
                $json = json_decode(file_get_contents('php://input'), true);
                // cara mendeklarasikannya
                // echo $data['n_desc'];
                
                if (!$json) {
                    // $id_card_owner_group_int   = $_POST['id_card_owner_group_int'];
                    // response failed
                    $this->response([
                        'status_boo' => false,
                        'message_var' => 'Format data yang dikirim harus json array'
                    ], REST_Controller::HTTP_NOT_ACCEPTABLE);

                }else{

                    // action untuk data post format json
                    $id_card_owner_group_int   = $json['id_card_owner_group_int'];
                    $data_post = array(
                        'id_card_owner_group_int' => $id_card_owner_group_int 
                    );

                }

                // show data
                if($response = $this->People_model->show_all($id_card_owner_group_int)){

                    if($response[0]->identity_number_var == null){
                        // response success not found data
                        $this->response([
                            'status_boo' => false,
                            'data' => $data_post,
                            'message_var' => 'Data tidak ditemukan'
                        ], REST_Controller::HTTP_PARTIAL_CONTENT);
                    }else{
                        //response success with data
                        $this->response([
                            'status_boo' => true,
                            'data' => $response,
                            'message_var' => 'Data ditemukan'
                        ], REST_Controller::HTTP_OK);
                    }
                    
                }else{
                    // response failed
                    $this->response([
                        'status_boo' => false,
                        'data' => $data_post,
                        'message_var' => 'Data tidak ditemukan'
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                }
                 
            }else{
                // response unauthorized karena token invalid
                $this->response([
                    'status_boo' => false,
                    'message_var' => 'Sesi Telah Habis. Silakan Lakukan CLOSE SHIFT!'
                ], REST_Controller::HTTP_UNAUTHORIZED);
            }
            
        }else{
            // response unauthorized karena token invalid
            $this->response([
                'status_boo' => false,
                'message_var' => 'Sesi Telah Habis. Silakan Lakukan CLOSE SHIFT!'
            ], REST_Controller::HTTP_UNAUTHORIZED);
        }
    }

    public function show_by_id_get()
    {
        // request header authorization
        $token = $this->input->get_request_header('Authorization');
        // jika ada header token
        if($token){
            
            //cek validasi token
            if($this->token_validation->check($token)){
                
                $json = json_decode(file_get_contents('php://input'), true);
                // cara mendeklarasikannya
                // echo $data['n_desc'];
                
                if (!$json) {
                    
                    // response failed
                    $this->response([
                        'status_boo' => false,
                        'message_var' => 'Format data yang dikirim harus json array'
                    ], REST_Controller::HTTP_NOT_ACCEPTABLE);

                }else{

                    // action untuk data post format json
                    $identity_number_var      = $json['identity_number_var'];
                    $id_card_owner_group_int   = $json['id_card_owner_group_int'];
                    $data_post = array(
                        'identity_number_var' => $identity_number_var,
                        'id_card_owner_group_int' => $id_card_owner_group_int 
                    );

                }

                // show data
                if($response = $this->People_model->show($identity_number_var, $id_card_owner_group_int)){

                    $output['identity_number_var']        = $response[0]->identity_number_var;
                    $output['employee_name_var']          = $response[0]->employee_name_var;
                    $output['employee_status_var']        = $response[0]->employee_status_var;
                    $output['station_code_var']           = $response[0]->station_code_var;
                    $output['work_unit_int']              = (int)$response[0]->work_unit_int;
                    $output['work_unit_name_var']         = $response[0]->work_unit_name_var;
                    $output['work_start_date_on_dtm']     = $response[0]->work_start_date_on_dtm;
                    $output['work_end_date_on_dtm']       = $response[0]->work_end_date_on_dtm;
                    $output['id_card_owner_group_int']    = (int)$response[0]->id_card_owner_group_int;
                    $output['card_number_before_var']     = $response[0]->card_number_before_var;
                    $output['card_owner_status_boo']      = $response[0]->card_owner_status_boo;
                    $output['active_boo']                 = $response[0]->active_boo;
                    // $output['note_var']                   = $response[0]->note_var;

                    if ($response[0]->active_boo == 't' AND $response[0]->card_owner_status_boo == 't') {
                        //response success with data
                        $this->response([
                            'status_boo' => true,
                            'data' => $output,
                            'message_var' => $response[0]->note_var
                        ], REST_Controller::HTTP_OK);    
                    }elseif ($response[0]->active_boo == 't' AND $response[0]->card_owner_status_boo == 'f') {
                        //response success with data
                        $this->response([
                            'status_boo' => false,
                            'data' => $output,
                            'message_var' => $response[0]->note_var
                        ], REST_Controller::HTTP_OK);    
                    }else{
                        $this->response([
                            'status_boo' => false,
                            'data' => $output,
                            'message_var' => $response[0]->note_var
                        ], REST_Controller::HTTP_PARTIAL_CONTENT);
                    }
                    
                }else{
                    // response failed
                    $this->response([
                        'status_boo' => false,
                        'data' => $data_post,
                        'message_var' => 'Data tidak ditemukan'
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                }
                 
            }else{
                // response unauthorized karena token invalid
                $this->response([
                    'status_boo' => false,
                    'message_var' => 'Sesi Telah Habis. Silakan Lakukan CLOSE SHIFT!'
                ], REST_Controller::HTTP_UNAUTHORIZED);
            }
            
        }else{
            // response unauthorized karena token invalid
            $this->response([
                'status_boo' => false,
                'message_var' => 'Sesi Telah Habis. Silakan Lakukan CLOSE SHIFT!'
            ], REST_Controller::HTTP_UNAUTHORIZED);
        }
    }
    
    public function create_post()
    {   
        // request header authorization
        $token = $this->input->get_request_header('Authorization');
        // jika ada header token
        if($token){
            
            //cek validasi token
            if($this->token_validation->check($token)){
                
                $json = json_decode(file_get_contents('php://input'), true);
                // cara mendeklarasikannya
                // echo $data['n_desc'];
                
                if (!$json) {
                    
                    // action untuk data post form input
                    // validasi
                    $this->form_validation->set_rules('i_card_type', 'Type Kartu', 'trim');
                    $this->form_validation->set_rules('c_desc', 'Kode Deskripsi', 'trim|required|min_length[1]|max_length[2]');
                    $this->form_validation->set_rules('n_desc', 'Deskripsi', 'trim|min_length[2]|max_length[50]');

                    if ($this->form_validation->run() === false) {
                        
                        // Set response 
                        $this->response([
                            'status' => false,
                            'message' => 'Parameter tidak diisi dengan benar'
                        ], REST_Controller::HTTP_PAYMENT_REQUIRED); // parameter tidak valid

                    }

                    // retrieve data post
                    $data_post = array(
                        'i_card_type'   => $this->input->post('i_card_type'),
                        'c_desc'        => $this->input->post('c_desc'),
                        'n_desc'        => $this->input->post('n_desc')
                    );
                    
                }else{

                    // action untuk data post format json
                    $data_post = array(
                        'i_card_type'   => $json['i_card_type'],
                        'c_desc'        => $json['c_desc'],
                        'n_desc'        => $json['n_desc']
                    );

                }

                // insert data macm.t_m_desc
                if($this->Desc_model->insert($data_post)){
                    //response success
                    $this->response([
                        'status' => true,
                        'data' => [$data_post],
                        'message' => 'Data berhasil disimpan'
                    ], REST_Controller::HTTP_CREATED);

                }else{
                    // response failed
                    $this->response([
                        'status' => false,
                        'data' => [$data_post],
                        'message' => 'Gagal menyimpan data'
                    ], REST_Controller::HTTP_NOT_ACCEPTABLE);
                }
                 
            }else{
                // response unauthorized karena token invalid
                $this->response([
                    'status' => false,
                    'message' => 'Sesi Telah Habis. Silakan Lakukan CLOSE SHIFT!'
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
            
        }else{
            // response unauthorized karena token invalid
            $this->response([
                'status' => false,
                'message' => 'Sesi Telah Habis. Silakan Lakukan CLOSE SHIFT!'
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
        
    }

    public function update_put()
    {   
        
        // request header authorization
        $token = $this->input->get_request_header('Authorization');
        // jika ada header token
        if($token){
            //cek validasi token
            if($this->token_validation->check($token)){

                $json = json_decode(file_get_contents('php://input'), true);
                // cara mendeklarasikannya
                // echo $data['n_desc'];
                
                if (!$json) {
                    
                    // action untuk data post form input
                    // validasi
                    $this->form_validation->set_rules('i_card_type', 'Type Kartu', 'trim');
                    $this->form_validation->set_rules('c_desc', 'Kode Deskripsi', 'trim|required|min_length[1]|max_length[2]');
                    $this->form_validation->set_rules('n_desc', 'Deskripsi', 'trim|min_length[2]|max_length[50]');

                    if ($this->form_validation->run() === false) {
                        
                        // Set response 
                        $this->response([
                            'status' => false,
                            'message' => 'Parameter tidak diisi dengan benar'
                        ], REST_Controller::HTTP_PAYMENT_REQUIRED); // parameter tidak valid

                    }

                    // retrieve data post
                    $data_post = array(
                        'i_card_type'   => $this->input->post('i_card_type'),
                        'c_desc'        => $this->input->post('c_desc'),
                        'n_desc'        => $this->input->post('n_desc')
                    );
                    
                }else{

                    // action untuk data post format json
                    $data_post = array(
                        'i_card_type'   => $json['i_card_type'],
                        'c_desc'        => $json['c_desc'],
                        'n_desc'        => $json['n_desc']
                    );

                }

                //cek id yang akan diupdate
                $id = $this->uri->segment(4);

                if ($id != '' OR $id == null) {
                    
                    // insert data macm.t_m_desc
                    $count_update = $this->Desc_model->update($id, $data_post);

                    return $count_update;
                    if ($count_update > 0) {
                        //response success
                        $this->response([
                            'status' => true,
                            'data' => [$data_post],
                            'message' => 'Data berhasil diupdate'
                        ], REST_Controller::HTTP_OK);

                    }else{
                        // response failed
                        $this->response([
                            'status' => false,
                            'data' => [$data_post],
                            'message' => 'Gagal mengupdate data'
                        ], REST_Controller::HTTP_NOT_MODIFIED);
                    }
                    
                }else{
                    // Set the response and exit
                    $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
                }
                
            }else{
                // response unauthorized karena token invalid
                $this->response([
                    'status' => false,
                    'message' => 'Sesi Telah Habis. Silakan Lakukan CLOSE SHIFT!'
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
            
        }else{
            // response unauthorized karena token invalid
            $this->response([
                'status' => false,
                'message' => 'Sesi Telah Habis. Silakan Lakukan CLOSE SHIFT!'
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        };
        
    }

    public function destroy_delete()
    {
        
        // request header authorization
        $token = $this->input->get_request_header('Authorization');
        // jika ada header token
        if($token){
            //cek validasi token
            if($this->token_validation->check($token)){
                
                //cek id yang akan dihapus
                $id = $this->uri->segment(4);

                if ($id != '' OR $id == null) {
                    
                    //lakukan sof delete
                    $count_delete = $this->Desc_model->soft_delete($id);
                    if ($count_delete > 0) {
                        // data berhasil di soft delete
                        $message = [
                            'status' => true,
                            'id' => $id,
                            'message' => 'Data telah berhasil dihapus'
                        ];
                        $this->set_response($message, REST_Controller::HTTP_OK); 
    
                    }else{
                        // tidak ada data yang di soft delete
                        $message = [
                            'status' => true,
                            'message' => 'data dengan id '.$id.' tidak ditemukan'
                        ];
                        $this->set_response($message, REST_Controller::HTTP_NO_CONTENT); // NO_CONTENT (204) being the HTTP response code
    
                    }

                }else{
                    // Set the response and exit
                    $this->response(NULL, REST_Controller::HTTP_BAD_REQUEST); // BAD_REQUEST (400) being the HTTP response code
                }
            }else{
                // response unauthorized karena token invalid
                $this->response([
                    'status' => false,
                    'message' => 'Sesi Telah Habis. Silakan Lakukan CLOSE SHIFT!'
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }

        }else{
            // response unauthorized karena token invalid
            $this->response([
                'status' => false,
                'message' => 'Sesi Telah Habis. Silakan Lakukan CLOSE SHIFT!'
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }
}

/* End of file KTP_Api.php */
