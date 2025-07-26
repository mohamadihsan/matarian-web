<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Login_Api extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->library('encryption');
        // load model
        $this->load->model('Global_Model');
        $this->load->model('User_Model');
        $this->load->model('Login_Model');

        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
    }

    // login
    public function login_post()
    {
        try {

            $_POST = json_decode($this->input->raw_input_stream, true);

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $remember_me = $this->input->post('remember_me');
            $device_type = $this->input->post('device_type');
            $ip_address = $this->input->post('ip_address');

            // check username
            $check = $this->User_Model->check_username($username)->result();
            if ($check) {
                // check activation status
                if ($check[0]->activation_status == true) {
                    // check password
                    if (password_verify($password, $check[0]->password)) {

                        $date = new DateTime();
                        $time = $date->getTimestamp();
                        // payload
                        $payload = array(
                            'iat' => $time,
                            'exp' => $time + $this->config->item('token_timeout'),
                            'data' => array(
                                'user_id' => $check[0]->id,
                                'username' => $check[0]->username,
                                'id_user_group' => $check[0]->id_user_group,
                                'sales_ar' => $check[0]->sales_ar,
                            )
                        );

                        $token = AUTHORIZATION::generateToken($payload);

                        // log
                        $log = array(
                            'user_id' => $check[0]->id,
                            'ip_address_var' => $ip_address,
                            'device_type' => $device_type,
                            'token_started_on_dtm' => $time,
                            'token_expired_on_dtm' => $time + $this->config->item('token_timeout'),
                            'token_var' => $token
                        );
                        // insert log transaksi
                        $this->Login_Model->create_log($log);

                        $data = array(
                            'fullname' => $check[0]->fullname,
                            'group' => $check[0]->id_user_group,
                            'user_id' => $check[0]->id,
                            'token' => $token
                        );

                        // set token on session
                        $_SESSION['auth'] = $data;

                        // remember me
                        if (!empty($remember_me)) {
                            set_cookie("loginId", $username, time() + (10 * 365 * 24 * 60 * 60));
                            set_cookie("loginPass", $this->encrypt->encode($password),  time() + (10 * 365 * 24 * 60 * 60));
                        } else {
                            set_cookie("loginId", "");
                            set_cookie("loginPass", "");
                        }

                        //response success with data
                        $this->response([
                            'status' => true,
                            'message' => 'Login successfully...',
                            'data' => $data
                        ], REST_Controller::HTTP_OK);
                    } else {
                        // password wrong
                        $this->response([
                            'status' => false,
                            'message' => 'Password wrong...',
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
                //response failed with data
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

/* End of file Login_Api.php */
