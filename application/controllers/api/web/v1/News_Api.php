<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class News_Api extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->helper('form');
        $this->load->helper('url');

        // validate token
        // $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('Global_Model');
        $this->load->model('User_Model');
        $this->load->model('News_Model');

        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
        // $this->user_id = $this->token->data->user_id;
        $this->path = 'assets/upload/news';
    }

    public function show_get($id = null)
    {
        $response = $this->News_Model->get($id)->result();

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

    public function create_post()
    {
        $token = AUTHORIZATION::validateToken();

        try {
            $title = $this->input->post('title');
            $content = $this->input->post('content');
            $cover = isset($_FILES['cover']['name']) ? $_FILES['cover']['name'] : '';
            $created_at =  $this->time_server;
            $created_by = $token->data->username;

            $post['title'] = $title;
            $post['content'] = $content;
            $post['created_at'] = $created_at;
            $post['created_by'] = $created_by;
            $error = '';

            $insert = $this->News_Model->insert($post);
            if ($insert) {

                if ($cover != '') {
                    $file_ext = explode(".", $cover);
                    $ext = end($file_ext);
                    $post2['cover'] = $this->path . '/' . $insert . '.' . $ext;
                    array_map('unlink', glob($this->path . '/' . $insert . '.*'));

                    // update
                    $this->News_Model->update($post2, $insert);
                }
                // upload profile picture
                if ($cover != '') {
                    // $this->_uploadImage();
                    $config['upload_path']          = $this->path;
                    $config['allowed_types']        = 'gif|jpg|jpeg|png';
                    $config['file_name']            = $insert;
                    $config['overwrite']            = true;
                    $config['max_size']             = 5024; // 1MB
                    // $config['max_width']            = 1024;
                    // $config['max_height']           = 768;

                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('cover')) {
                        $error = $this->upload->display_errors();
                    } else {
                        $this->upload->data();
                    }
                }
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'News berhasil diperbaharui. ' . $error,
                    'data' => $insert
                ], REST_Controller::HTTP_OK);
            } else {
                // response failed
                $this->response([
                    'status' => false,
                    'message' => 'News gagal diperbaharui',
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

    public function update_post($id)
    {
        $token = AUTHORIZATION::validateToken();

        try {
            $title = $this->input->post('title');
            $content = $this->input->post('content');
            $cover = isset($_FILES['cover']['name']) ? $_FILES['cover']['name'] : '';
            $updated_at =  $this->time_server;
            $updated_by = $token->data->username;

            $post['title'] = $title;
            $post['content'] = $content;
            $post['updated_at'] = $updated_at;
            $post['updated_by'] = $updated_by;
            $error = '';

            $update = $this->News_Model->update($post, $id);
            if ($update) {

                if ($cover != '') {
                    $file_ext = explode(".", $cover);
                    $ext = end($file_ext);
                    $post2['cover'] = $this->path . '/' . $id . '.' . $ext;
                    array_map('unlink', glob($this->path . '/' . $id . '.*'));

                    // update
                    $this->News_Model->update($post2, $id);
                }
                // upload profile picture
                if ($cover != '') {
                    // $this->_uploadImage();
                    $config['upload_path']          = $this->path;
                    $config['allowed_types']        = 'gif|jpg|jpeg|png';
                    $config['file_name']            = $id;
                    $config['overwrite']            = true;
                    $config['max_size']             = 5024; // 1MB
                    // $config['max_width']            = 1024;
                    // $config['max_height']           = 768;

                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('cover')) {
                        $error = $this->upload->display_errors();
                    } else {
                        $this->upload->data();
                    }
                }
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'News berhasil diperbaharui. ' . $error,
                    'data' => $update
                ], REST_Controller::HTTP_OK);
            } else {
                // response failed
                $this->response([
                    'status' => false,
                    'message' => 'News gagal diperbaharui',
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
        AUTHORIZATION::validateToken();

        try {

            $delete = $this->News_Model->delete($id);
            if ($delete) {
                array_map('unlink', glob($this->path . '/' . $id . '.*'));
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'News berhasil dihapus',
                    'data' => $delete
                ], REST_Controller::HTTP_OK);
            } else {
                // response failed
                $this->response([
                    'status' => false,
                    'message' => 'News gagal dihapus',
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

/* End of file News_Api.php */
