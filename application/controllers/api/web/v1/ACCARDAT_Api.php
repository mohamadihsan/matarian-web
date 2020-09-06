<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class ACCARDAT_Api extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('Global_Model');
        $this->load->model('ACCARDAT_Model');

        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
        $this->user = $this->token->data->user_id;
        $this->sales_ar = $this->token->data->sales_ar;
    }

    // all
    public function show_all_get()
    {
        ini_set("memory_limit", -1);
        $response = $this->ACCARDAT_Model->get()->result();

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

    // all with pagination
    public function show_all_pagination_get($page, $per_page)
    {
        $response = $this->ACCARDAT_Model->pagination($page, $per_page)->result();
        $total_rows = $this->ACCARDAT_Model->count();
        $total_page = 1;
        $last_page = 1;
        $path = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
        $path .= "://" . $_SERVER['HTTP_HOST'];
        $path .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
        $path .= 'api/mobile/v1/accardat/pagination/page';

        if ($page > 0 && $per_page > 0) {
            $total_page = ceil($total_rows / $per_page);
            $last_page = $total_page;
        } else {
            $per_page = $total_rows;
        }

        if ($response) {
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
                'data' => $response
            ], REST_Controller::HTTP_OK);
        } else {
            // response success not found data
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
    }


    // count
    public function count_get()
    {
        $response['total_rows'] = $this->ACCARDAT_Model->count();
        $response['last_update'] = $this->ACCARDAT_Model->last_update()->result()[0]->created_at;

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

    public function tagihan_klik2_post()
    {
        try {

            $_POST = json_decode($this->input->raw_input_stream, true);

            $from_date = $this->input->post('from_date');
            $end_date = $this->input->post('end_date');
            $sales_ar = $this->input->post('sales_ar');
            $kode_ar = $this->input->post('kode_ar');
            // if ($this->sales_ar != '') {
            //     $sales_ar = $this->sales_ar;
            // }

            // die($sales_ar);
            $response = $this->ACCARDAT_Model->get_tagihan_klik2($from_date, $end_date, $sales_ar, $kode_ar)->result();
            $total_rows = count($response);

            $total = 0;
            foreach ($response as $res) {
                $total += $res->total_tagihan;
            }

            if ($response) {
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'total_rows' => $total_rows,
                    'total' => $total,
                    'data' => $response
                ], REST_Controller::HTTP_OK);
            } else {
                // response success not found data
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                    'total_rows' => null,
                    'total' => 0,
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

    public function tagihan_klik2_pagination_post($page, $per_page)
    {
        try {

            $_POST = json_decode($this->input->raw_input_stream, true);

            $from_date = $this->input->post('from_date');
            $end_date = $this->input->post('end_date');
            $sales_ar = $this->input->post('sales_ar');
            $kode_ar = $this->input->post('kode_ar');
            $search = $this->input->post('search');

            // die($sales_ar);
            $response = $this->ACCARDAT_Model->get_tagihan_klik2_pagination($from_date, $end_date, $sales_ar, $kode_ar, $search, $page, $per_page)->result();
            $total_rows = count($response);
            $total_page = 1;
            $last_page = 1;
            $path = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $path .= "://" . $_SERVER['HTTP_HOST'];
            $path .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
            $path .= 'api/mobile/v1/accardat/tagihan/pagination/page';

            if ($page > 0 && $per_page > 0) {
                $total_page = ceil($total_rows / $per_page);
                $last_page = $total_page;
            } else {
                $per_page = $total_rows;
            }

            if ($response) {
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
                    'data' => $response
                ], REST_Controller::HTTP_OK);
            } else {
                // response success not found data
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
            // response failed
            $this->response([
                'status' => false,
                'message' => $th,
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

    public function tagihan_klik3_post()
    {
        try {

            $_POST = json_decode($this->input->raw_input_stream, true);

            $from_date = $this->input->post('from_date');
            $end_date = $this->input->post('end_date');
            $sales_ar = $this->input->post('sales_ar');
            $kode_ar = $this->input->post('kode_ar');

            // die($sales_ar);
            $response = $this->ACCARDAT_Model->get_tagihan_klik3($from_date, $end_date, $kode_ar, $sales_ar)->result();
            $total_rows = count($response);

            $total = 0;
            foreach ($response as $res) {
                $total += $res->nilai_nota;
            }

            $res = array();

            if ($response) {
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'total_rows' => $total_rows,
                    'nama_langganan' => $response[0]->nama_langganan,
                    'alamat_langganan' => $response[0]->alamat_langganan,
                    'total' => $total,
                    'data' => $response
                ], REST_Controller::HTTP_OK);
            } else {
                // response success not found data
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                    'total_rows' => null,
                    'nama_langganan' => null,
                    'alamat_langganan' => null,
                    'total' => null,
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
        } catch (\Throwable $th) {
            // response failed
            $this->response([
                'status' => false,
                'message' => $th,
                'total_rows' => null,
                'nama_langganan' => null,
                'alamat_langganan' => null,
                'total' => null,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }

    public function tagihan_klik3_pagination_post($page, $per_page)
    {
        try {

            $_POST = json_decode($this->input->raw_input_stream, true);

            $kode_ar = $this->input->post('kode_ar');
            $search = $this->input->post('search');

            // die($sales_ar);
            $response = $this->ACCARDAT_Model->get_tagihan_klik3_pagination($kode_ar, $search, $page, $per_page)->result();
            $total_rows = count($response);
            $total_page = 1;
            $last_page = 1;
            $path = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $path .= "://" . $_SERVER['HTTP_HOST'];
            $path .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
            $path .= 'api/mobile/v1/accardat/tagihan/nota/pagination/page';

            if ($page > 0 && $per_page > 0) {
                $total_page = ceil($total_rows / $per_page);
                $last_page = $total_page;
            } else {
                $per_page = $total_rows;
            }

            $total = 0;
            foreach ($response as $res) {
                $total += $res->nilai_nota;
            }

            $res = array(
                'nama_langganan' => $response[0]->nama_langganan,
                'alamat_langganan' => $response[0]->alamat_langganan,
                'total' => abs($total),
                'detail' => $response
            );

            if ($response) {
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
                    'data' => $res
                ], REST_Controller::HTTP_OK);
            } else {
                // response success not found data
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
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
            // response failed
            $this->response([
                'status' => false,
                'message' => $th,
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

    public function tagihan_klik4_post()
    {
        try {

            $_POST = json_decode($this->input->raw_input_stream, true);

            $nomor_nota = $this->input->post('nomor_nota');

            // die($sales_ar);
            $response = $this->ACCARDAT_Model->get_tagihan_klik4($nomor_nota)->result();
            $total_rows = count($response);

            $dpp = 0;
            foreach ($response as $res) {
                $dpp += $res->jumlah;
            }
            $ppn = $dpp * 0.1;
            $total = $dpp + $ppn;

            if ($response) {
                //response success with data
                $this->response([
                    'status' => true,
                    'message' => 'Data ditemukan',
                    'total_rows' => $total_rows,
                    'nama_langganan' => $response[0]->nama_langganan,
                    'npwp_langganan' => $response[0]->npwp_langganan,
                    'alamat_langganan' => $response[0]->alamat_langganan,
                    'dpp' => $dpp,
                    'ppn' => $ppn,
                    'total' => $total,
                    'data' => $response
                ], REST_Controller::HTTP_OK);
            } else {
                // response success not found data
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
                    'total_rows' => null,
                    'nama_langganan' => null,
                    'npwp_langganan' => null,
                    'alamat_langganan' => null,
                    'dpp' => null,
                    'ppn' => null,
                    'total' => null,
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
        } catch (\Throwable $th) {
            // response failed
            $this->response([
                'status' => false,
                'message' => $th,
                'nama_langganan' => null,
                'npwp_langganan' => null,
                'alamat_langganan' => null,
                'dpp' => null,
                'ppn' => null,
                'total' => null,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }

    public function tagihan_klik4_pagination_post($page, $per_page)
    {
        try {

            $_POST = json_decode($this->input->raw_input_stream, true);

            $nomor_nota = $this->input->post('nomor_nota');
            $search = $this->input->post('search');

            // die($sales_ar);
            $response = $this->ACCARDAT_Model->get_tagihan_klik4_pagination($nomor_nota, $search, $page, $per_page)->result();
            $total_rows = count($response);
            $total_page = 1;
            $last_page = 1;
            $path = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $path .= "://" . $_SERVER['HTTP_HOST'];
            $path .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
            $path .= 'api/mobile/v1/accardat/tagihan/nota/detail/pagination/page';

            if ($page > 0 && $per_page > 0) {
                $total_page = ceil($total_rows / $per_page);
                $last_page = $total_page;
            } else {
                $per_page = $total_rows;
            }

            $dpp = 0;
            foreach ($response as $res) {
                $dpp += $res->jumlah;
            }
            $ppn = $dpp * 0.1;
            $total = $dpp + $ppn;
            $res = array(
                'nama_langganan' => $response[0]->nama_langganan,
                'npwp_langganan' => $response[0]->npwp_langganan,
                'alamat_langganan' => $response[0]->alamat_langganan,
                'dpp' => abs($dpp),
                'ppn' => abs($ppn),
                'total' => abs($total),
                'detail' => $response
            );

            if ($response) {
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
                    'data' => $res
                ], REST_Controller::HTTP_OK);
            } else {
                // response success not found data
                $this->response([
                    'status' => false,
                    'message' => 'Data tidak ditemukan',
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
            // response failed
            $this->response([
                'status' => false,
                'message' => $th,
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

    public function detail_tagihan_get($sales_ar)
    {
        $response = $this->ACCARDAT_Model->get_tagihan($sales_ar, null)->result();
        $total_rows = count($response);

        if ($response) {
            //response success with data
            $this->response([
                'status' => true,
                'message' => 'Data ditemukan',
                'total_rows' => $total_rows,
                'data' => $response
            ], REST_Controller::HTTP_OK);
        } else {
            // response success not found data
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'total_rows' => null,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }

    // list user tagihan
    public function tagihan_user_get()
    {
        $response = $this->ACCARDAT_Model->get_tagihan_user($this->user)->result();
        $total_rows = count($response);

        if ($response) {
            //response success with data
            $this->response([
                'status' => true,
                'message' => 'Data ditemukan',
                'total_rows' => $total_rows,
                'data' => $response
            ], REST_Controller::HTTP_OK);
        } else {
            // response success not found data
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'total_rows' => null,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }

    // tagihan with pagination
    public function tagihan_pagination_get($page, $per_page)
    {
        $response = $this->ACCARDAT_Model->tagihan_pagination($page, $per_page, $this->user)->result();

        $total_rows = $this->ACCARDAT_Model->count_tagihan();
        $total_page = 1;
        $last_page = 1;
        $path = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
        $path .= "://" . $_SERVER['HTTP_HOST'];
        $path .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
        $path .= 'api/mobile/v1/accardat/tagihan/pagination/page';

        if ($page > 0 && $per_page > 0) {
            $total_page = ceil($total_rows / $per_page);
            $last_page = $total_page;
        } else {
            $per_page = $total_rows;
        }

        if ($response) {
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
                'data' => $response
            ], REST_Controller::HTTP_OK);
        } else {
            // response success not found data
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
    }
}

/* End of file ACCARDAT_Api.php */
