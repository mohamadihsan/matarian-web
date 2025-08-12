<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Report_Api extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('Global_Model');
        $this->load->model('ACCDBRG_Model');
        $this->load->model('ACCARBON_Model');
        $this->load->model('PPN_Model');
        $this->load->model('User_Model');

        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
        $this->sales_ar = $this->token->data->sales_ar;
        $this->user_id = $this->token->data->user_id;
        $this->id_user_group = $this->token->data->id_user_group;

        ini_set("memory_limit", "-1");
        set_time_limit(0);
    }

    public function get_nama_bulan($bulan) {
        $bulanMap = [
            '01' => 'JANUARI',
            '02' => 'FEBRUARI',
            '03' => 'MARET',
            '04' => 'APRIL',
            '05' => 'MEI',
            '06' => 'JUNI',
            '07' => 'JULI',
            '08' => 'AGUSTUS',
            '09' => 'SEPTEMBER',
            '10' => 'OKTOBER',
            '11' => 'NOVEMBER',
            '12' => 'DESEMBER'
        ];

        $nama_bulan = $bulanMap[$bulan];

        return $nama_bulan;
    }

    // all sales
    public function sales_post()
    {
        try {
            $_POST = json_decode($this->input->raw_input_stream, true);

            $from_date = $this->input->post('from_date');
            $end_date = $this->input->post('end_date');
            $sales_ar = $this->input->post('sales_ar');

            if ($sales_ar == 'custom') {
                $get = $this->User_Model->getPermissionSalesAR($this->user_id);
                $sales_ar = [];
                foreach ($get as $g) {
                    $sales_ar[] = $g->sales_ar;
                }

                if (count($sales_ar) < 1) {
                    $sales_ar = 'KATAPANDA';
                }
            }

            // die('tes - '.$kode_langganan);
            $response = $this->ACCARBON_Model->get_sales_by_sales_ar($from_date, $end_date, $sales_ar)->result();
            $total_rows = count($response);

            $total = 0;
            foreach ($response as $res) {
                $total += $res->nilai_faktur;
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
                    'total_rows' => 0,
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
        } catch (\Throwable $th) {
            // response success not found data
            $this->response([
                'status' => false,
                'message' => $th,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }

    // all sales
    public function by_sales_langganan_post()
    {
        try {
            $_POST = json_decode($this->input->raw_input_stream, true);

            $from_date = $this->input->post('from_date');
            $end_date = $this->input->post('end_date');
            $kode_langganan = $this->input->post('kode_langganan');
            $kode_barang = $this->input->post('kode_barang');
            $sales_ar = $this->sales_ar;

            if ($this->id_user_group != 1 && $this->id_user_group != 4) {
                $get = $this->User_Model->getPermissionSalesAR($this->user_id);
                $sales_ar = [];
                foreach ($get as $g) {
                    $sales_ar[] = $g->sales_ar;
                }

                if (count($sales_ar) < 1) {
                    $sales_ar = 'KATAPANDA';
                }
            }

            // die('tes - '.$kode_langganan);
            $response = $this->ACCARBON_Model->get_sales($from_date, $end_date, $kode_langganan, $kode_barang, $sales_ar)->result();
            $total_rows = count($response);

            $total = 0;
            foreach ($response as $res) {
                $total += $res->total;
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
                    'total_rows' => 0,
                    'total' => 0,
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
        } catch (\Throwable $th) {
            // response success not found data
            $this->response([
                'status' => false,
                'message' => $th,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }

    // all stock
    public function stock_post()
    {
        try {
            $_POST = json_decode($this->input->raw_input_stream, true);

            $kode_barang = $this->input->post('kode_barang');

            // die('tes - '.$kode_langganan);
            $response = $this->ACCDBRG_Model->get_stock($kode_barang)->result();
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
                    'total_rows' => 0,
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
        } catch (\Throwable $th) {
            // response success not found data
            $this->response([
                'status' => false,
                'message' => $th,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }

    // count
    public function count_get()
    {
        $response['total_rows'] = $this->ACCARBON_Model->count();
        $response['last_update'] = $this->ACCARBON_Model->last_update()->result()[0]->created_at;

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

    // tagihan with pagination
    public function tagihan_pagination_get($page, $per_page)
    {
        $response = $this->ACCARBON_Model->tagihan_pagination($page, $per_page, $this->sales_ar)->result();

        $total_rows = $this->ACCARBON_Model->count_tagihan();
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

    public function ppn_post()
    {
        try {
            $_POST = json_decode($this->input->raw_input_stream, true);

            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $bulan_pengkreditkan = $this->input->post('bulan_pengkreditkan');
            $tahun_pengkreditkan = $this->input->post('tahun_pengkreditkan');
            $status_faktur = $this->input->post('status_faktur');
            $perusahaan = $this->input->post('perusahaan');

            $nama_bulan = $this->get_nama_bulan($bulan);
            $nama_bulan_pengkreditkan = $this->get_nama_bulan($bulan_pengkreditkan);

            $response = $this->PPN_Model->get_ppn_report($perusahaan, $nama_bulan, $tahun, $nama_bulan_pengkreditkan, $tahun_pengkreditkan, $status_faktur)->result();
            $total_rows = count($response);

            $total = 0;
            // foreach ($response as $res) {
            //     $total += $res->nilai_faktur;
            // }

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
                    'total_rows' => 0,
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
        } catch (\Throwable $th) {
            // response success not found data
            $this->response([
                'status' => false,
                'message' => $th,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }

    public function unifikasi_post()
    {
        try {
            $_POST = json_decode($this->input->raw_input_stream, true);

            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            $perusahaan = $this->input->post('perusahaan');
            $fasilitas = $this->input->post('fasilitas');
            $kode_objek_pajak = $this->input->post('kode_objek_pajak');
            $kode_dokumen = $this->input->post('kode_dokumen');
            $kode_pembayaran = $this->input->post('kode_pembayaran');

            $nama_bulan = $this->get_nama_bulan($bulan);

            $response = $this->PPN_Model->get_unifikasi_report($perusahaan, $nama_bulan, $tahun, $fasilitas, $kode_objek_pajak, $kode_dokumen, $kode_pembayaran)->result();
            $total_rows = count($response);


            $total = 0;
            // foreach ($response as $res) {
            //     $total += $res->nilai_faktur;
            // }

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
                    'total_rows' => 0,
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
        } catch (\Throwable $th) {
            // response success not found data
            $this->response([
                'status' => false,
                'message' => $th,
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }

    public function destroy_delete($bulan, $tahun, $perusahaan)
    {
        try {

            if ($bulan == '' || $tahun == '' || $perusahaan == '') {
                $this->response([
                    'status' => false,
                    'message' => 'Parameter tidak lengkap. Data tidak dapat dihapus',
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }

            $nama_bulan = $this->get_nama_bulan($bulan);

            $delete = $this->PPN_Model->delete($nama_bulan, $tahun, $perusahaan);
            if ($delete) {
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

    public function destroy_per_row_delete($id)
    {
        try {
            $delete = $this->PPN_Model->delete_row($id);
            if ($delete) {
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

/* End of file Report_Api.php */
