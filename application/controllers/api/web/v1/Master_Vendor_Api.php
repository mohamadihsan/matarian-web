<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';

class Master_Vendor_Api extends REST_Controller
{

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('Master_Vendor_Model');
        $this->load->model('Global_Model');

        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
    }

    // provinsi
    public function show_all_get()
    {
        $response = $this->Master_Vendor_Model->get()->result();

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
        $response['total_rows'] = $this->Master_Vendor_Model->count();
        $response['last_update'] = $this->Master_Vendor_Model->last_update()->result()[0]->created_at;

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

            $npwp = $this->input->post('npwp');
            $new_npwp = $this->input->post('new_npwp');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $nitku = $this->input->post('nitku');
            $nitku_digit = $this->input->post('nitku_digit');
            $provinsi = $this->input->post('provinsi');
            $kabupaten = $this->input->post('kabupaten');
            $kecamatan = $this->input->post('kecamatan');
            $kelurahan = $this->input->post('kelurahan');
            $kodepos = $this->input->post('kodepos');
            $alamat = $this->input->post('jalan');
            $blok = $this->input->post('blok');
            $nomor = $this->input->post('nomor');
            $rt = $this->input->post('rt');
            $rw = $this->input->post('rw');
            $unifikasi_kode_objek_pajak_id = !empty($this->input->post('unifikasi_kode_objek_pajak_id')) ? $this->input->post('unifikasi_kode_objek_pajak_id') : null;
            $cek = $this->input->post('cek');
            $created_by = $this->token->data->username;

            // cek apakah npwp16 sudah terdaftar atau belum
            if ($new_npwp == "0000000000000000") {
                $cek_npwp = $this->Master_Vendor_Model->check_npwp($new_npwp, strtoupper($nama));
                if (!empty($cek_npwp)) {
                    $this->response([
                        'status' => false,
                        'message' => 'Data vendor '.$nama.' ('.$new_npwp.') sudah terdaftar',
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                }
            } else {
                $cek_npwp = $this->Master_Vendor_Model->check_npwp($new_npwp);
                if (!empty($cek_npwp)) {
                    $this->response([
                        'status' => false,
                        'message' => 'Data vendor dengan '.$new_npwp.' sudah terdaftar',
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                }
            }

            $post = array(
                'npwp' => $npwp,
                'new_npwp' => $new_npwp,
                'nama' => $nama,
                'email' => $email,
                'nitku' => $nitku,
                'nitku_digit' => $nitku_digit,
                'provinsi' => $provinsi,
                'kabupaten' => $kabupaten,
                'kecamatan' => $kecamatan,
                'kelurahan' => $kelurahan,
                'kodepos' => $kodepos,
                'alamat' => $alamat,
                'blok' => $blok,
                'nomor' => $nomor,
                'rt' => $rt,
                'rw' => $rw,
                'unifikasi_kode_objek_pajak_id' => $unifikasi_kode_objek_pajak_id,
                'cek' => $cek,
                'created_by' => $created_by
            );

            $save = $this->Master_Vendor_Model->insert($post);

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

            $npwp = $this->input->post('npwp');
            $new_npwp = $this->input->post('new_npwp');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');
            $nitku = $this->input->post('nitku');
            $nitku_digit = $this->input->post('nitku_digit');
            $provinsi = $this->input->post('provinsi');
            $kabupaten = $this->input->post('kabupaten');
            $kecamatan = $this->input->post('kecamatan');
            $kelurahan = $this->input->post('kelurahan');
            $kodepos = $this->input->post('kodepos');
            $alamat = $this->input->post('jalan');
            $blok = $this->input->post('blok');
            $nomor = $this->input->post('nomor');
            $rt = $this->input->post('rt');
            $rw = $this->input->post('rw');
            $unifikasi_kode_objek_pajak_id = $this->input->post('unifikasi_kode_objek_pajak_id');
            $cek = $this->input->post('cek');
            $updated_at =  $this->time_server;
            $updated_by = $this->token->data->username;

            $post = array(
                'npwp' => $npwp,
                'new_npwp' => $new_npwp,
                'nama' => $nama,
                'email' => $email,
                'nitku' => $nitku,
                'nitku_digit' => $nitku_digit,
                'provinsi' => $provinsi,
                'kabupaten' => $kabupaten,
                'kecamatan' => $kecamatan,
                'kelurahan' => $kelurahan,
                'kodepos' => $kodepos,
                'alamat' => $alamat,
                'blok' => $blok,
                'nomor' => $nomor,
                'rt' => $rt,
                'rw' => $rw,
                'unifikasi_kode_objek_pajak_id' => $unifikasi_kode_objek_pajak_id,
                'cek' => $cek,
                'updated_at' => $updated_at,
                'updated_by' => $updated_by
            );

            $update = $this->Master_Vendor_Model->update($post, $id);
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

            $delete = $this->Master_Vendor_Model->delete($id);
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

/* End of file Master_Vendor_Api.php */
