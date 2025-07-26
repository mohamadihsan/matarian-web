<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class User_Group_Api extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('Global_Model');
        $this->load->model('User_Group_Model');
        $this->load->model('User_Privilege_Model');

        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
    }

    // provinsi
    public function show_all_get()
    {
        $response = $this->User_Group_Model->get()->result();

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
    }

    // count
    public function count_get()
    {
        $response['total_rows'] = $this->User_Group_Model->count();
        $response['last_update'] = $this->User_Group_Model->last_update()->result()[0]->created_at;

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
    }

    public function show_by_id_get()
    {
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

            $save = $this->User_Group_Model->insert($post);
            $new_id = $save;
            if ($save) {
                // add role / privilege
                $this->User_Privilege_Model->generateRole($new_id);

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

            $user_group_name = $this->input->post('user_group_name');
            $user_group_desc = $this->input->post('user_group_desc');
            $updated_at =  $this->time_server;
            $updated_by = $this->token->data->username;

            $post = array(
                'user_group_name' => $user_group_name,
                'user_group_desc' => $user_group_desc,
                'updated_at' => $updated_at,
                'updated_by' => $updated_by
            );

            $update = $this->User_Group_Model->update($post, $id);
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

    public function destroy_delete($id)
    {
        try {

            $deleted_at =  $this->time_server;
            $deleted_by = $this->token->data->username;

            $post = array(
                'deleted_at' => $deleted_at,
                'deleted_by' => $deleted_by
            );

            $delete = $this->User_Group_Model->delete($id);
            if ($delete) {
                    
                $delete = $this->User_Privilege_Model->delete($id);
                
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data berhasil dihapus',
                    'data' => $delete
                ], REST_Controller::HTTP_OK);
            } else {
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

/* End of file User_Group_Api.php */
