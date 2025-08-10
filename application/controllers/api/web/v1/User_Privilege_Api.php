<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class User_Privilege_Api extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('Global_Model');
        $this->load->model('User_Privilege_Model');

        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
    }

    // privilege
    public function show_all_post()
    {
        try {

            $_POST = json_decode($this->input->raw_input_stream, true);

            $id_user_group = $this->input->post('id_user_group');
            if (empty($id_user_group)) {
                $id_user_group = 0;
            }
            $response = $this->User_Privilege_Model->get($id_user_group)->result();

            if ($response) {
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'data' => $response
                ], REST_Controller::HTTP_OK);
            } else {
                // response success not found data
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
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

    // menu privilege
    public function menu_get()
    {
        try {
            $response = $this->User_Privilege_Model->get_menu()->result();

            if ($response) {
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'data' => $response
                ], REST_Controller::HTTP_OK);
            } else {
                // response success not found data
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
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

    public function create_post()
    {
        try {

            $_POST = json_decode($this->input->raw_input_stream, true);

            $user_group_name = $this->input->post('user_group_name');
            $user_group_desc = $this->input->post('user_group_desc');
            $created_by = $this->token->data->username;

            $post = array(
                'user_group_name' => $user_group_name,
                'user_group_desc' => $user_group_desc,
                'created_by' => $created_by
            );

            $save = $this->User_Privilege_Model->insert($post);
            if ($save) {
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data berhasil ditambahkan',
                    'data' => $save
                ], REST_Controller::HTTP_OK);
            } else {
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

            $create_access = $this->input->post('create_access');
            $read_access = $this->input->post('read_access');
            $update_access = $this->input->post('update_access');
            $delete_access = $this->input->post('delete_access');
            $approve_access = $this->input->post('approve_access');
            $reject_access = $this->input->post('reject_access');
            $print_access = $this->input->post('print_access');
            $export_to_excel_access = $this->input->post('export_to_excel_access');
            $export_to_csv_access = $this->input->post('export_to_csv_access');
            $export_to_pdf_access = $this->input->post('export_to_pdf_access');
            $updated_at =  $this->time_server;
            $updated_by = $this->token->data->username;

            $post = array(
                'create_access' => $create_access,
                'read_access' => $read_access,
                'update_access' => $update_access,
                'delete_access' => $delete_access,
                'approve_access' => $approve_access,
                'reject_access' => $reject_access,
                'print_access' => $print_access,
                'export_to_excel_access' => $export_to_excel_access,
                'export_to_csv_access' => $export_to_csv_access,
                'export_to_pdf_access' => $export_to_pdf_access,
                'updated_at' => $updated_at,
                'updated_by' => $updated_by
            );

            $update = $this->User_Privilege_Model->update($post, $id);
            if ($update) {
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data berhasil diperbaharui',
                    'data' => $update
                ], REST_Controller::HTTP_OK);
            } else {
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
}

/* End of file User_Privilege_Api.php */
