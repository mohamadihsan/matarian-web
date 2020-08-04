<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Register_Api extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        require APPPATH.'libraries/phpmailer/src/Exception.php';
        require APPPATH.'libraries/phpmailer/src/PHPMailer.php';
        require APPPATH.'libraries/phpmailer/src/SMTP.php';
        
        // load model
        $this->load->model('User_Model');
        $this->load->model('Global_Model');
        
        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
    }

    public function index_post()
    {
        try {

            $_POST = json_decode($this->input->raw_input_stream, true);
            
            // data register
            $fullname = $this->input->post('fullname');
            $nomor_telepon = $this->input->post('nomor_telepon');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $id_user_group = null;
            $created_by = 'web';

            $post = array(
                'fullname' => $fullname,
                'nomor_telepon' => $nomor_telepon,
                'username' => $username,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'email' => $email,
                'id_user_group' => 0,
                'created_by' => $created_by
            ); 

            $save = $this->User_Model->insert($post);
            if($save){

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
        
                $mail->setFrom('matarian@katapanda.com', 'Matarian [Registration]'); // user email
                $mail->addReplyTo('matarian@katapanda.com', 'Matarian Reply'); //user email
        
                // Add a recipient
                $mail->addAddress($email); //email tujuan pengiriman email
        
                // Email subject
                $mail->Subject = '[Registration] - Matarian'; //subject email
        
                // Set email format to HTML
                $mail->isHTML(true);
        
                // Email body content
                $mailContent = "<h1>Registration</h1>
                    <p>Your account has been send to Admin. Please wait, your account must be verified by admin.</p>"; // isi email
                $mail->Body = $mailContent;

                if(!$mail->send()){
                    $this->response([
                        'status' => false,
                        'message' => 'Registration Success. Failed send to email. Error: ' . $mail->ErrorInfo,
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                }
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Registration Success. Please check your email!',
                    'data' => $save
                ], REST_Controller::HTTP_OK);
            }else{
                // response failed
                $this->response([
                    'status' => false,
                    'message' => 'Registration Failed!',
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

    public function reset_password_post()
    {
        try {
            
            $_POST = json_decode($this->input->raw_input_stream, true);

            $email = $this->input->post('email');

            $check = $this->User_Model->check_by_email($email)->result();
            if ($check) {               

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
        
                $mail->setFrom('matarian@katapanda.com', 'Matarian [Reset Password]'); // user email
                $mail->addReplyTo('matarian@katapanda.com', 'Matarian Reply'); //user email
        
                // Add a recipient
                $mail->addAddress($email); //email tujuan pengiriman email
        
                // Email subject
                $mail->Subject = '[Reset Password] - Matarian'; //subject email
        
                // Set email format to HTML
                $mail->isHTML(true);

                $id = $check[0]->id;
                $start_date = date('Y-m-d', strtotime($this->time_server));
                $expired_date = date('Y-m-d', strtotime($start_date . ' +7 day'));

                
                $payload = array(
                    'id' => $id, 
                    'start_date' => $start_date,
                    'expired_date' => $expired_date
                );

                $token = AUTHORIZATION::generateToken($payload);
                
                $link_reset = $this->config->item('base_url').'reset-password/'.$token;
    
                // Email body content
                $mailContent = "<h1>Reset Password</h1>
                    <p>Someone, hopefully you, has requested to reset the password for your Matarian account on https://matarian.katapanda.com.</p>
                    <p>If you did not perform this request, you can safely ignore this email.</p>
                    <p>Otherwise, click the link below to complete the process.</p>
                    <p>Link <b><a href='".$link_reset."'>Reset password</a></b></p>"; // isi email
                $mail->Body = $mailContent;
        
                // Send email
                if(!$mail->send()){
                    $this->response([
                        'status' => false,
                        'message' => 'Mailer Error: ' . $mail->ErrorInfo,
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                }else{
                    $this->response([
                        'status' => true,
                        'message' => 'Link reset has been sent to your email. Please check your email!',
                        'data' => []
                    ], REST_Controller::HTTP_OK);
                }
            
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'Email not register. Please check your email!',
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

    // confirm reset password
    public function confirm_reset_password_post()
    {
        try {
            
            $_POST = json_decode($this->input->raw_input_stream, true);

            $id = $this->input->post('id');
            $password = $this->input->post('password');

            $post = array(
                'password' => password_hash($password, PASSWORD_BCRYPT),
            ); 

            $check = $this->User_Model->check_by_id($id)->result();
            if ($check) {               

                $update = $this->User_Model->update($post, $id);
                if($update){
                    //response success with data
                    $this->response([
                        'status' => true,
                        'message' => 'Password berhasil diperbaharui',
                        'data' => $update
                    ], REST_Controller::HTTP_OK);
                }else{
                    // response failed
                    $this->response([
                        'status' => false,
                        'message' => 'Password gagal diperbaharui',
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                }
            
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'User Not Register. Please call admin!',
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
}

/* End of file Register_Api.php */
