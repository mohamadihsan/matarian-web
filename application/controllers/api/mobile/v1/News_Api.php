<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class News_Api extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();

        // validate token
        $this->token = AUTHORIZATION::validateToken();

        // load model
        $this->load->model('Global_Model');
        $this->load->model('News_Model');

        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
        $this->path = 'assets/upload/news';
    }

    public function pagination_post($page, $per_page)
    {
        try {

            $_POST = json_decode($this->input->raw_input_stream, true);
            $search = $this->input->post('search');

            $response = $this->News_Model->pagination($page, $per_page, $search)->result();
            $total_rows = $this->News_Model->pagination($page, $per_page, $search)->num_rows();
            $total_page = 1;
            $last_page = 1;
            $origin_path = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $origin_path .= "://" . $_SERVER['HTTP_HOST'];
            $origin_path .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
            $path = $origin_path . 'api/mobile/v1/news/pagination/page';

            if ($page > 0 && $per_page > 0) {
                $total_page = ceil($total_rows / $per_page);
                $last_page = $total_page;
            } else {
                $per_page = $total_rows;
            }

            if ($response) {
                $data =  [];
                foreach ($response as $res) {
                    $data[] = array(
                        'id' => $res->id,
                        'title' => $res->title,
                        'cover' => $origin_path . '' . $res->cover,
                        // 'cover_base64' => base64_encode(file_get_contents($origin_path . '' . $res->cover)),
                        'posting_date' => date('d-M-Y H:m', strtotime($res->posting_date)),
                        'desc_short' => substr(strip_tags($res->content), 0, 100)
                    );
                }

                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'total_rows' => $total_rows,
                    'per_page' => $per_page,
                    'current_page' => $page,
                    'last_page' => $last_page,
                    'first_page_url' => $path . '/1/per-page/' . $per_page,
                    'last_page_url' => $path . '/' . $last_page . '/per-page/' . $per_page,
                    'next_page_url' => $page < $last_page ? $path . '/' . ($page + 1) . '/per-page/' . $per_page : null,
                    'prev_page_url' => $page > 1 ? $path . '/' . ($page - 1) . '/per-page/' . $per_page : null,
                    'from' => ($page * $per_page) + 1 - $per_page,
                    'to' => ($page * $per_page),
                    'data' => $data
                ], REST_Controller::HTTP_OK);
            } else {
                // response not found data
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                    'total_rows' => 0,
                    'per_page' => 0,
                    'current_page' => null,
                    'last_page' => null,
                    'first_page_url' => null,
                    'last_page_url' => null,
                    'next_page_url' => null,
                    'prev_page_url' => null,
                    'from' => null,
                    'to' => null,
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
        } catch (\Throwable $th) {
            // response not found data
            $this->response([
                'status' => false,
                'message' => $th,
                'total_rows' => 0,
                'per_page' => 0,
                'current_page' => null,
                'last_page' => null,
                'first_page_url' => null,
                'last_page_url' => null,
                'next_page_url' => null,
                'prev_page_url' => null,
                'from' => null,
                'to' => null,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }
}

/* End of file News_Api.php */
