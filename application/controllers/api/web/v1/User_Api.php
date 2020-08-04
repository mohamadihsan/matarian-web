<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class User_Api extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        
        require APPPATH.'libraries/phpmailer/src/Exception.php';
        require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH.'libraries/phpmailer/src/SMTP.php';
        
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('Global_Model');
        $this->load->model('User_Model');
        
        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
        $this->user_id = $this->token->data->user_id;
        $this->sales_ar = $this->token->data->sales_ar;
    }

    // show
    public function show_all_get()
    {
        $response = $this->User_Model->get()->result();

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

    // show user sales
    public function user_sales_get()
    {
        $response = $this->User_Model->get_user_sales($this->sales_ar)->result();

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

    // count
    public function count_get()
    {
        $response['total_rows'] = $this->User_Model->count();
        $response['last_update'] = $this->User_Model->last_update()->result()[0]->created_at;

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

    // count reject
    public function count_reject_get()
    {
        $response['total_rows'] = $this->User_Model->count_reject();
        $response['last_update'] = $this->User_Model->last_update()->result()[0]->created_at;

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

    // count verify
    public function count_verify_get()
    {
        $response['total_rows'] = $this->User_Model->count_verify();
        $response['last_update'] = $this->User_Model->last_update()->result()[0]->created_at;

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

    // show pending
    public function show_pending_activation_get()
    {
        $response = $this->User_Model->get_pending_activation()->result();

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

    // count pending activation
    public function count_pending_activation_get()
    {
        $response['total_rows'] = $this->User_Model->count_pending_activation();
        $response['last_update'] = $this->User_Model->last_update()->result()[0]->created_at;

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
        
    }
    
    public function create_post()
    {   
        try {
            
            $_POST = json_decode($this->input->raw_input_stream, true);

            $fullname = $this->input->post('fullname');
            $nomor_telepon = $this->input->post('nomor_telepon');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $id_user_group = $this->input->post('id_user_group');
            $sales_ar = $this->input->post('sales_ar');
            $created_by = $this->token->data->username;

            $post = array(
                'fullname' => $fullname,
                'nomor_telepon' => $nomor_telepon,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'id_user_group' => $id_user_group,
                'sales_ar' => $sales_ar,
                'created_by' => $created_by
            ); 

            $save = $this->User_Model->insert($post);
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

            $fullname = $this->input->post('fullname');
            $nomor_telepon = $this->input->post('nomor_telepon');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $id_user_group = $this->input->post('id_user_group');
            $sales_ar = $this->input->post('sales_ar');
            $updated_at =  $this->time_server;
            $updated_by = $this->token->data->username;

            $post['fullname'] = $fullname;
            $post['nomor_telepon'] = $nomor_telepon;
            $post['username'] = $username;
            $post['email'] = $email;
            $post['sales_ar'] = $sales_ar;
            $post['updated_at'] = $updated_at;
            $post['updated_by'] = $updated_by;  
            
            if ($password != '') {
                $post['password'] = password_hash($password, PASSWORD_BCRYPT);
            }
            if ($id_user_group != '') {
                $post['id_user_group'] = $id_user_group;
            }
            if ($sales_ar != '') {
                $post['sales_ar'] = $sales_ar;
            }

            $update = $this->User_Model->update($post, $id);
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

    public function approve_put($id)
    {   
        try {
            $_POST = json_decode($this->input->raw_input_stream, true);

            $id_user_group = $this->input->post('id_user_group');
            $sales_ar = $this->input->post('sales_ar');
            $activation_status = true;
            $activation_at =  $this->time_server;
            $activation_by = $this->token->data->username;

            $post = array(
                'id_user_group' => $id_user_group,
                'sales_ar' => $sales_ar,
                'activation_status' => $activation_status,
                'activation_at' => $activation_at,
                'activation_by' => $activation_by
            ); 

            $check = $this->User_Model->get($id)->result();

            if ($check) {

                $approve = $this->User_Model->update($post, $id);

                if($approve){

                    // PHPMailer object
                    $response = false;
                    $mail = new PHPMailer();
            
                    // SMTP configuration
                    $mail->isSMTP();
                    $mail->Host     = 'mail.katapanda.com'; //sesuaikan sesuai nama domain hosting/server yang digunakan
                    $mail->SMTPAuth = true;
                    $mail->Username = 'matarian@katapanda.com'; // user email
                    $mail->Password = 'matarian2020'; // password email
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port     = 465;
            
                    $mail->setFrom('matarian@katapanda.com', 'Registration - Success Verified'); // user email
                    $mail->addReplyTo('matarian@katapanda.com', 'Matarian Reply'); //user email
            
                    // Add a recipient
                    $mail->addAddress($check[0]->email); //email tujuan pengiriman email
            
                    // Email subject
                    $mail->Subject = '[Verified Account] - Matarian'; //subject email
            
                    // Set email format to HTML
                    $mail->isHTML(true);
            
                    // Email body content
                    $app_name = SITE_NAME;
                    $user_group_name = $check[0]->user_group_name;
                    $mailContent = "<h1>Verified Account</h1>
                        <p>Your account has been verified by Admin. You can login to ".$app_name." App as a <b>".$user_group_name."</b>.</p>"; // isi email
                    $mail->Body = $mailContent;
            
                    // Send email
                    if(!$mail->send()){
                        $this->response([
                            'status' => false,
                            'message' => 'Data berhasil diaktivasi. Failed send to email. Error: ' .$this->email->print_debugger(),
                            'data' => []
                        ], REST_Controller::HTTP_PARTIAL_CONTENT);
                    }

                    //response success with data
                    $this->response([
                        'status' => true,
                        'message' => 'Data berhasil diaktivasi',
                        'data' => $approve
                    ], REST_Controller::HTTP_OK);
                }else{
                    // response failed
                    $this->response([
                        'status' => false,
                        'message' => 'Data gagal diaktivasi',
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'User not Found...',
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

    public function reject_put($id)
    {   
        try {
            $activation_status = false;
            $activation_at =  $this->time_server;
            $activation_by = $this->token->data->username;

            $post = array(
                'activation_status' => $activation_status,
                'activation_at' => $activation_at,
                'activation_by' => $activation_by
            ); 

            $check = $this->User_Model->get($id)->result();
            
            if ($check) {

                $approve = $this->User_Model->update($post, $id);
                
                if($approve){

                    // PHPMailer object
                    $response = false;
                    $mail = new PHPMailer();
            
                    // SMTP configuration
                    $mail->isSMTP();
                    $mail->Host     = 'mail.katapanda.com'; //sesuaikan sesuai nama domain hosting/server yang digunakan
                    $mail->SMTPAuth = true;
                    $mail->Username = 'matarian@katapanda.com'; // user email
                    $mail->Password = 'matarian2020'; // password email
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port     = 465;
            
                    $mail->setFrom('matarian@katapanda.com', 'Registration - Rejected'); // user email
                    $mail->addReplyTo('matarian@katapanda.com', 'Matarian Reply'); //user email
            
                    // Add a recipient
                    $mail->addAddress($check[0]->email); //email tujuan pengiriman email
            
                    // Email subject
                    $mail->Subject = '[Verified Account] - Matarian'; //subject email
            
                    // Set email format to HTML
                    $mail->isHTML(true);
            
                    // Email body content
                    $mailContent = "<h1>Rejected Account</h1>
                        <p>Your account has been rejected by Admin. Please call admin!"; // isi email
                    $mail->Body = $mailContent;
            
                    // Send email
                    if(!$mail->send()){
                        $this->response([
                            'status' => false,
                            'message' => 'Data berhasil direject. Failed send to email. Error: ' .$this->email->print_debugger(),
                            'data' => []
                        ], REST_Controller::HTTP_PARTIAL_CONTENT);
                    }

                    //response success with data
                    $this->response([
                        'status' => true,
                        'message' => 'Data berhasil direject',
                        'data' => $approve
                    ], REST_Controller::HTTP_OK);
                }else{
                    // response failed
                    $this->response([
                        'status' => false,
                        'message' => 'Data gagal direject',
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'User not Found...',
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

            $delete = $this->User_Model->delete($id);
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

    public function profile_get()
    {
        $response = $this->User_Model->profile($this->user_id)->result();

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

    public function profile_update_put()
    {   
        try {
            
            $_POST = json_decode($this->input->raw_input_stream, true);

            $username = $this->input->post('username');
            $fullname = $this->input->post('fullname');
            $nomor_telepon = $this->input->post('nomor_telepon');
            $email = $this->input->post('email');
            $updated_at =  $this->time_server;
            $updated_by = $this->token->data->username;

            $post['fullname'] = $fullname;
            $post['nomor_telepon'] = $nomor_telepon;
            $post['email'] = $email;
            $post['updated_at'] = $updated_at;
            $post['updated_by'] = $updated_by;  

            $check = $this->User_Model->check_username($username)->result();
            if ($check) {
                // check activation status
                if ($check[0]->activation_status == true) {

                    $update = $this->User_Model->update($post, $check[0]->id);
                    if($update){
                        //response success with data
                        $this->response([
                            'status' => true,
                            'message' => 'Data Profile berhasil diperbaharui',
                            'data' => $update
                        ], REST_Controller::HTTP_OK);
                    }else{
                        // response failed
                        $this->response([
                            'status' => false,
                            'message' => 'Data Profile gagal diperbaharui',
                            'data' => []
                        ], REST_Controller::HTTP_PARTIAL_CONTENT);
                    }
                } else {
                    //response failed with data
                    $this->response([
                        'status' => false,
                        'message' => 'Your account has not been activated. Please contact admin...',
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT); 
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'User not register',
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

    public function profile_change_password_put()
    {   
        try {
            
            $_POST = json_decode($this->input->raw_input_stream, true);

            $username = $this->input->post('username');
            $old_password = $this->input->post('old_password');
            $password = $this->input->post('password');
            $updated_at =  $this->time_server;
            $updated_by = $this->token->data->username;

            $post = array(
                'password' => password_hash($password, PASSWORD_BCRYPT),
            ); 

            $check = $this->User_Model->check_username($username)->result();
            if ($check) {
                // check activation status
                if ($check[0]->activation_status == true) {
                    // check password
                    if (password_verify($old_password, $check[0]->password)) {

                        $update = $this->User_Model->update($post, $check[0]->id);
                        if($update){
                            //response success with data
                            $this->response([
                                'status' => true,
                                'message' => 'Data Profile berhasil diperbaharui',
                                'data' => $update
                            ], REST_Controller::HTTP_OK);
                        }else{
                            // response failed
                            $this->response([
                                'status' => false,
                                'message' => 'Data Profile gagal diperbaharui',
                                'data' => []
                            ], REST_Controller::HTTP_PARTIAL_CONTENT);
                        }
                    } else {
                        // password wrong
                        $this->response([
                            'status' => false,
                            'message' => 'Current Password Incorect...',
                            'data' => []
                        ], REST_Controller::HTTP_OK);  
                    }
                } else {
                    //response failed with data
                    $this->response([
                        'status' => false,
                        'message' => 'Your account has not been activated. Please contact admin...',
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT); 
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'User not register',
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

/* End of file User_Api.php */
