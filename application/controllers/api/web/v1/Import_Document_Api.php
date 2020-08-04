<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
// require APPPATH . '../vendor/autoload.php';
 
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Reader\Csv;
// use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Import_Document_Api extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateToken();
        // load model
        $this->load->model('Import_Document_Model');
        $this->load->library('Excel'); //load librari excel
        $this->load->model('Global_Model');
        
        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
        
    }

    // provinsi
    public function show_all_get()
    {
        $response = $this->Import_Document_Model->get()->result();

        if($response){
            //response success with data
            $this->response([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $response
            ], REST_Controller::HTTP_OK);
        }else{
            // response not found data
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
        $response['row_data'] = $this->Import_Document_Model->count();
        $response['last_update'] = $this->Import_Document_Model->last_update()->result()[0]->created_at;

        if($response){
            //response success with data
            $this->response([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $response
            ], REST_Controller::HTTP_OK);
        }else{
            // response not found data
            $this->response([
                'status' => false,
                'message' => 'Data tidak ditemukan',
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
    }

    public function create_post()
    {   
        ini_set('memory_limit', '512M');  
        // ini_set('max_execution_time', '7200');
        $created_by = $this->token->data->username;
        $type_document = $this->input->post('type_document');
        $index = null;
        $post = array();

        try {
            
            $_POST = json_decode($this->input->raw_input_stream, true);
            $data = $this->input->post('data');
            $type_document = $this->input->post('type_document');
            $index = $this->input->post('index');
            
            if ($type_document == 'ACCDBRG') {
                
                if ($data[0]['KODEBARANG'] != null || $data[0]['KODEBARANG'] != '') {
                    
                    foreach ($data as $d) {
                        
                        $post[] = array(
                            "kode_barang" => !empty($d['KODEBARANG']) ? $d['KODEBARANG'] : null,
                            "golongan" => !empty($d['GOLONGAN']) ? $d['GOLONGAN'] : null,
                            "nama_barang" => !empty($d['NAMABARANG']) ? $d['NAMABARANG'] : null,
                            "pabrik" => !empty($d['PABRIK']) ? $d['PABRIK'] : null,
                            "satuan" => !empty($d['SATUAN']) ? $d['SATUAN'] : null,
                            "packing" => !empty($d['PACKING']) ? $d['PACKING'] : null,
                            "satuan_per_pak" => !empty($d['STNPERPAK']) ? $d['STNPERPAK'] : null,
                            "harga_satuan" => !empty($d['HRGSATUAN']) ? $d['HRGSATUAN'] : null,
                            "harga_pokok" => !empty($d['HRGPOKOK']) ? $d['HRGPOKOK'] : null,
                            "harga_beli" => !empty($d['HRGBELI']) ? $d['HRGBELI'] : null,
                            "keterangan_barang" => !empty($d['KETBARANG']) ? $d['KETBARANG'] : null,
                            "gudang_a" => !empty($d['GUDANGA']) ? $d['GUDANGA'] : null,
                            "gudang_b" => !empty($d['GUDANGB']) ? $d['GUDANGB'] : null,
                            "gudang_c" => !empty($d['GUDANGC']) ? $d['GUDANGC'] : null,
                            "gudang_d" => !empty($d['GUDANGD']) ? $d['GUDANGD'] : null,
                            "gudang_e" => !empty($d['GUDANGE']) ? $d['GUDANGE'] : null,
                            "gudang_f" => !empty($d['GUDANGF']) ? $d['GUDANGF'] : null,
                            "jumlah_stok" => !empty($d['JMLSTOCK']) ? $d['JMLSTOCK'] : null,
                            "minimum" => !empty($d['MINIMUM']) ? $d['MINIMUM'] : null,
                            "created_by" => $created_by
                        );
                    }
                }
            }

            if ($type_document == 'ACCDLGN') {
                
                if ($data[0]['KODELGN'] != null || $data[0]['KODELGN'] != '') {
                    
                    foreach ($data as $d) {
                        
                        $post[] = array(
                            "kode_langganan"=> !empty($d['KODELGN']) ? $d['KODELGN'] : null,
                            "nama_toko"=> !empty($d['NAMATOKO']) ? $d['NAMATOKO'] : null,
                            "nama"=> !empty($d['NAMA']) ? $d['NAMA'] : null,
                            "alamat"=> !empty($d['ALAMAT']) ? $d['ALAMAT'] : null,
                            "kota"=> !empty($d['KOTA']) ? $d['KOTA'] : null,
                            "telepon"=> !empty($d['TELEPON']) ? $d['TELEPON'] : null,
                            "limit_int"=> !empty($d['LIMIT']) ? $d['LIMIT'] : null,
                            "diskon_1"=> !empty($d['DISC1_LGN']) ? $d['DISC1_LGN'] : null,
                            "diskon_2"=> !empty($d['DISC2_LGN']) ? $d['DISC2_LGN'] : null,
                            "diskon_3"=> !empty($d['DISC3_LGN']) ? $d['DISC3_LGN'] : null,
                            "keterangan_langganan"=> !empty($d['KETLGN']) ? $d['KETLGN'] : null,
                            "saldo"=> !empty($d['SALDO']) ? $d['SALDO'] : null,
                            "cek_langganan"=> !empty($d['CEK_LGN']) ? $d['CEK_LGN'] : null,
                            "npwp_langganan"=> !empty($d['NPWP_LGN']) ? $d['NPWP_LGN'] : null,
                            "nama_pjk"=> !empty($d['NAMAPJK']) ? $d['NAMAPJK'] : null,
                            "created_by" => $created_by
                        );
                    }
                }
            }

            if ($type_document == 'ACCARBON') {
                
                if ($data[0]['NO_BON'] != null || $data[0]['NO_BON'] != '') {

                    // Sesuaikan key array dengan nama kolom di database    
                    $tahun_sekarang = date('Y', strtotime($this->time_server));
                    $tahun_limit = date('Y', strtotime($tahun_sekarang. ' -3 years'));
                    
                    foreach ($data as $d) {
                        // $tanggal_bon = !empty($d['tanggal_bon']) ? date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($d['tanggal_bon'])) : null;
                        $tanggal_bon = !empty($d['TGL_BON']) ? date('Y-m-d', strtotime($d['TGL_BON'])) : null;


                        if ($tanggal_bon >= $tahun_limit) {
                        
                            $post[] = array(
                                "tanggal_bon" => $tanggal_bon,
                                "nomor_bon" => !empty($d['NO_BON']) ? $d['NO_BON'] : null,
                                "kode_langganan" => !empty($d['KODE_LGN']) ? $d['KODE_LGN'] : null,
                                "banyak_barang" => !empty($d['BYK_BRG']) ? $d['BYK_BRG'] : null,
                                "kode_barang" => !empty($d['KODE_BRG']) ? $d['KODE_BRG'] : null,
                                "harga_barang" => !empty($d['HRG_BRG']) ? $d['HRG_BRG'] : null,
                                "diskon_1" => !empty($d['DISC1']) ? $d['DISC1'] : null,
                                "diskon_2" => !empty($d['DISC2']) ? $d['DISC2'] : null,
                                "diskon_3" => !empty($d['DISC3']) ? $d['DISC3'] : null,
                                "prf_barang" => !empty($d['PRF_BRG']) ? $d['PRF_BRG'] : null,
                                "ppn" => !empty($d['PPN']) ? $d['PPN'] : null,
                                "nomor_od" => !empty($d['NO_OD']) ? $d['NO_OD'] : null,
                                "created_by" => $created_by
                            );
                        }
                    }
                }
            }
            
            if ($type_document == 'ACCARDAT') {
                
                if ($data[0]['NO_NOTA'] != null || $data[0]['NO_NOTA'] != '') {
                    
                    // Sesuaikan key array dengan nama kolom di database    
                    $tahun_sekarang = date('Y', strtotime($this->time_server));
                    $tahun_limit = date('Y', strtotime($tahun_sekarang. ' -3 years'));
                    
                    foreach ($data as $d) {
                        // $tanggal_lunas = !empty($d['TGL_LUNAS']) ? date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($d['TGL_LUNAS'])) : null;
                        // $tanggal_ar = !empty($d['TGL_AR']) ? date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($d['TGL_AR'])) : null;
                        // $tanggal_od = !empty($d['TGL_OD']) ? date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($d['TGL_OD'])) : null;
                        
                        $tanggal_lunas = !empty($d['TGL_LUNAS']) ? date('Y-m-d', strtotime($d['TGL_LUNAS'])) : null;
                        $tanggal_ar = !empty($d['TGL_AR']) ? date('Y-m-d', strtotime($d['TGL_AR'])) : null;
                        $tanggal_od = !empty($d['TGL_OD']) ? date('Y-m-d', strtotime($d['TGL_OD'])) : null;
                        
                        if ($tanggal_ar >= $tahun_limit) {
                        
                            $post[] = array(
                                "ref_ar" => !empty($d['REF_AR']) ? $d['REF_AR'] : null,
                                "nomor_nota" => !empty($d['NO_NOTA']) ? $d['NO_NOTA'] : null,
                                "tanggal_ar" => $tanggal_ar,
                                "nomor_od" => !empty($d['NO_OD']) ? $d['NO_OD'] : null,
                                "tanggal_od" => $tanggal_od,
                                "kode_ar" => !empty($d['KODE_AR']) ? $d['KODE_AR'] : null,
                                "keterangan_ar" => !empty($d['KET_AR']) ? $d['KET_AR'] : null,
                                "cara_diskon" => !empty($d['CARADISC']) ? $d['CARADISC'] : null,
                                "nilai_diskon" => !empty($d['DISCNILAI']) ? $d['DISCNILAI'] : null,
                                "potongan" => !empty($d['POTONGAN']) ? $d['POTONGAN'] : null,
                                "sales_ar" => !empty($d['SALES_AR']) ? $d['SALES_AR'] : null,
                                "jumlah_ar" => !empty($d['JML_AR']) ? $d['JML_AR'] : null,
                                "prof_ar" => !empty($d['PROF_AR']) ? $d['PROF_AR'] : null,
                                "sisa_ar" => !empty($d['SISA_AR']) ? $d['SISA_AR'] : null,
                                "klmp_ar" => !empty($d['KLMP_AR']) ? $d['KLMP_AR'] : null,
                                "waktu_ar" => !empty($d['WAKTU_AR']) ? $d['WAKTU_AR'] : null,
                                "tanggal_lunas" => $tanggal_lunas,
                                "nomor_bayar_ar" => !empty($d['NOBYR_AR']) ? $d['NOBYR_AR'] : null,
                                "nomor_transaksi_ar" => !empty($d['NOTRAN_AR']) ? $d['NOTRAN_AR'] : null,
                                "user_ar" => !empty($d['USER_AR']) ? $d['USER_AR'] : null,
                                "created_by" => $created_by
                            );
                        }
                    }
                }
            }

            if(count($post) > 0) {
                
                $insert = $this->Import_Document_Model->import($type_document, $post, $index);
                
                if ($insert) {
                    //response success with data
                    $this->response([
                        'status' => true,
                        'message' => 'Upload successfully...',
                        'data' => $post   
                    ], REST_Controller::HTTP_OK);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'Upload failed...',
                        'data' => []
                    ], REST_Controller::HTTP_OK);
                }
                
            } else {
                // response not found data
                $this->response([
                    'status' => false,
                    'message' => 'Tidak ada data yang disimpan!',
                    'data' => []
                ], REST_Controller::HTTP_PARTIAL_CONTENT);
            }
            
        } catch(Exception $e) {
            // die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
            // response not found data
            $this->response([
                'status' => false,
                'message' => $e->getMessage(),
                'data' => []
            ], REST_Controller::HTTP_PARTIAL_CONTENT);
        }
        
    }

}

/* End of file Import_Document_Api.php */
