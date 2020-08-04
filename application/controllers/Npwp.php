<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class NPWP extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');
        // validate token
        $this->token = AUTHORIZATION::validateTokenOnPage();
        
        // check privilege
        $url = $this->uri->segment(1);
        $url .= $this->uri->segment(2) != '' ? '/'.$this->uri->segment(2) : '';
        $url .= $this->uri->segment(3) != '' ? '/'.$this->uri->segment(3) : '';
        $id_user_group = JWT::decode($this->token, $this->config->item('jwt_key'), array('HS256'))->data->id_user_group;
        $check = $this->User_Privilege->check_privilege($id_user_group ,$url);
        if (!empty($check)) {
            if ($check->read_access == true) {
                $this->create_access = $check->create_access;
                $this->read_access = $check->read_access;
                $this->update_access = $check->update_access;
                $this->delete_access = $check->delete_access;
                $this->approve_access = $check->approve_access;
                $this->reject_access = $check->reject_access;
                $this->print_access = $check->print_access;
                $this->export_to_excel_access = $check->export_to_excel_access;
                $this->export_to_csv_access = $check->export_to_csv_access;
                $this->export_to_pdf_access = $check->export_to_pdf_access;
            } else {    
                redirect('dashboard','refresh');
            }
        } else {
            redirect('dashboard','refresh');
        }
    }

    public function index()
    {
        $data['title'] = 'Identity Card : NPWP';
        $data['token'] = $this->token;

        // role
        $data['action_create'] = $this->create_access;
        $data['action_update'] = $this->update_access;
        $data['action_delete'] = $this->delete_access;
        $data['action_approval'] = $this->approve_access;
        $data['action_export_to_excel'] = $this->export_to_excel_access;
        $data['action_export_to_csv'] = $this->export_to_csv_access;
        $data['action_export_to_pdf'] = $this->export_to_pdf_access;

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('_layout/topbar', $data);
        $this->load->view('pages/npwp', $data);
        $this->load->view('_layout/footer');
    }

}

/* End of file NPWP.php */
