<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class ResetPassword extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Global_Model');
        
        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
    }

    public function index()
    {
        $data['title'] = 'Reset Password';

        $this->load->view('_layout/auth-header', $data);
        $this->load->view('pages/reset_password', $data);
        $this->load->view('_layout/auth-footers', $data);
    }

    public function confirm($token)
    {
        $data['title'] = 'Reset Password';

        try {
            $token_decode = JWT::decode($token, $this->config->item('jwt_key'), array('HS256'));
            
            if ($token_decode) {
                $start_date = date('Y-m-d', strtotime($token_decode->start_date));
                $expired_date = date('Y-m-d', strtotime($token_decode->expired_date));
                $currentDate = date('Y-m-d', strtotime($this->time_server));

                if (($currentDate >= $start_date) && ($currentDate <= $expired_date)){
                    $data['id'] = $token_decode->id;

                    $this->load->view('_layout/auth-header', $data);
                    $this->load->view('pages/reset_password_confirm', $data);
                    $this->load->view('_layout/auth-footers', $data);
                } else {
                    echo "<b><h3><center>Link Reset has been expired!</center><h3></b>";
                }
            } else {
                $this->load->view('_layout/auth-header');
                $this->load->view('pages/404');
                $this->load->view('_layout/auth-footers');
            }
            
            
        } catch (\Throwable $th) {
            $this->load->view('_layout/auth-header');
            $this->load->view('pages/404');
            $this->load->view('_layout/auth-footers');
        }
        
    }

}

/* End of file ResetPassword.php */
