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
        $this->load->model('PPN_Model');
        $this->load->library('Excel'); //load librari excel
        $this->load->model('Global_Model');
        
        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;
        
    }

    function extractMonthAndYear($tanggal)
    {
        $formats = [
            'd/m/Y', 'Y-m-d', 'm/d/Y', 'd-m-Y', 'Y/m/d',
            DateTime::ATOM,         // 'Y-m-d\TH:i:sP'
            'Y-m-d\TH:i:s',         // '2025-04-17T00:00:00'
            'Y-m-d\TH:i:s.u'        // '2025-04-17T00:00:00.000000' (jika ada)
        ];

        foreach ($formats as $format) {
            $date = DateTime::createFromFormat($format, $tanggal);
            $errors = DateTime::getLastErrors();

            if ($date && $errors['warning_count'] == 0 && $errors['error_count'] == 0) {
                return [
                    'bulan' => $date->format('m'), // bulan format 2 digit
                    'tahun' => $date->format('Y')  // tahun 4 digit
                ];
            }
        }

        return false; // jika tidak ada format yg cocok
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
            $data = $this->input->post('element');
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

            if ($type_document == 'KODEOBJEKPAJAK') {
                
                if ($data[0]['Kode Objek Pajak'] != null || $data[0]['Kode Objek Pajak'] != '') {
                    
                    foreach ($data as $d) {
                        
                        $post[] = array(
                            "kode" => !empty($d['Kode Objek Pajak']) ? $d['Kode Objek Pajak'] : null,
                            "nama" => !empty($d['Nama Objek Pajak']) ? $d['Nama Objek Pajak'] : null,
                            "tarif" => !empty($d['Tarif']) ? $d['Tarif'] : null
                        );
                    }
                }
            }

            if ($type_document == 'KODEFASILITAS') {
                
                if ($data[0]['Kode Fasilitas'] != null || $data[0]['Kode Fasilitas'] != '') {
                    
                    foreach ($data as $d) {
                        
                        $post[] = array(
                            "kode" => !empty($d['Kode Fasilitas']) ? $d['Kode Fasilitas'] : null,
                            "nama" => !empty($d['Nama Fasilitas']) ? $d['Nama Fasilitas'] : null
                        );
                    }
                }
            }

            if ($type_document == 'KODEPEMBAYARAN') {
                
                if ($data[0]['Kode Pembayaran IP'] != null || $data[0]['Kode Pembayaran IP'] != '') {
                    
                    foreach ($data as $d) {
                        
                        $post[] = array(
                            "kode" => !empty($d['Kode Pembayaran IP']) ? $d['Kode Pembayaran IP'] : null,
                            "nama" => !empty($d['Nama Pembayaran IP']) ? $d['Nama Pembayaran IP'] : null
                        );
                    }
                }
            }

            if ($type_document == 'KODEDOKUMEN') {
                
                if ($data[0]['Kode Dokumen'] != null || $data[0]['Kode Dokumen'] != '') {
                    
                    foreach ($data as $d) {
                        
                        $post[] = array(
                            "kode" => !empty($d['Kode Dokumen']) ? $d['Kode Dokumen'] : null,
                            "nama" => !empty($d['Nama Dokumen Referensi']) ? $d['Nama Dokumen Referensi'] : null
                        );
                    }
                }
            }

            if ($type_document == 'PPNMASUKKAN') {

                // cek filename terlebih dahulu, substring nama file untuk mengecek berdasarkan NPWP Perusahaan
                $parts = explode('_', $this->input->post('filename'));
                $npwp_perusahaan = $parts[0];

                $perusahaan = $this->Import_Document_Model->get_perusahaan_by_npwp($npwp_perusahaan);
                if (empty($perusahaan)) {
                    $this->response([
                        'status' => false,
                        'message' => 'Data perusahaan tidak sesuai dengan file yang diupload',
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                }
            
                if ($data[0]['NPWP Penjual'] == "" || $data[0]['Nama Penjual'] == '' || $data[0]['Nomor Faktur Pajak'] == '' || $data[0]['Tanggal Faktur Pajak'] == '' || $data[0]['Masa Pajak'] == '' || $data[0]['Tahun'] == '' || $data[0]['Status Faktur'] == '' || $data[0]['Harga Jual/Penggantian/DPP'] == '' || $data[0]['DPP Nilai Lain/DPP'] == '' || $data[0]['PPN'] == '' || $data[0]['PPnBM'] == '' || $data[0]['Perekam'] == '' || $data[0]['Valid'] == '' || $data[0]['Dilaporkan'] == '' || $data[0]['Dilaporkan oleh Penjual'] == '') {
                    $this->response([
                        'status' => false,
                        'message' => 'Format dokumen yang diupload tidak sesuai. Silakan unduh tempate dokumen terlebih dahulu!',
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                } else {
                    $i = 0;
                    $duplicate_data = 0;
                    
                    $periode = $data[0]['Tanggal Faktur Pajak'];
                    $extract_periode = $this->extractMonthAndYear($periode);
                    $bulan = $extract_periode['bulan'];
                    $tahun = $extract_periode['tahun'];

                    foreach ($data as $d) {
                        // get vendor
                        $npwpUpload[$i] = $d['NPWP Penjual'];
                        if ($i == 0 && !empty($d['NPWP Penjual'])) {
                            $vendor = $this->Import_Document_Model->get_vendor_by_npwp($d['NPWP Penjual']);
                            if (empty($vendor)) {
                                $this->response([
                                    'status' => false,
                                    'message' => 'Vendor dengan NPWP '.$d['NPWP Penjual'].' tidak ditemukan. Silakan buatkan master datanya terlebih dahulu!',
                                    'data' => []
                                ], REST_Controller::HTTP_PARTIAL_CONTENT);
                            }
                        } else if ($i > 0 && !empty($d['NPWP Penjual'])) {
                            if ($npwpUpload[$i-1] != $d['NPWP Penjual']) {
                                $vendor = $this->Import_Document_Model->get_vendor_by_npwp($d['NPWP Penjual']);
                                if (empty($vendor)) {
                                    $this->response([
                                        'status' => false,
                                        'message' => 'Vendor dengan NPWP '.$d['NPWP Penjual'].' tidak ditemukan. Silakan buatkan master datanya terlebih dahulu!',
                                        'data' => []
                                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                                }
                            }
                        } else {
                            $this->response([
                                'status' => false,
                                'message' => 'NPWP Penjual line '.($i+1).' kosong',
                                'data' => []
                            ], REST_Controller::HTTP_PARTIAL_CONTENT);
                        }

                        // cek waktu periode pajak
                        $periode = $d['Tanggal Faktur Pajak'];
                        $extract_periode = $this->extractMonthAndYear($periode);
                        if ($extract_periode == false) {
                            $this->response([
                                'status' => false,
                                'message' => 'Tanggal Faktur Pajak tidak valid',
                                'data' => []
                            ], REST_Controller::HTTP_PARTIAL_CONTENT);
                        } else {
                            // $bulan_detail = $extract_periode['bulan'];
                            // $tahun_detail = $extract_periode['tahun'];

                            // if ($bulan_detail != $bulan || $tahun_detail != $tahun) {
                            //     $this->response([
                            //         'status' => false,
                            //         'message' => 'Terdapat multiple periode. Periode '.$bulan_detail.'-'.$tahun_detail.' tidak dapat di upload bersamaan di Periode '.$bulan.'-'.$tahun,
                            //         'data' => []
                            //     ], REST_Controller::HTTP_PARTIAL_CONTENT);
                            // }
                        }

                        if (is_numeric($d['Harga Jual/Penggantian/DPP'])) {
                            $harga_jual = (int) $d['Harga Jual/Penggantian/DPP']; // atau gunakan intval($nilai);
                        } else {
                            $this->response([
                                'status' => false,
                                'message' => 'Nilai Harga Jual/Penggantian/DPP tidak valid',
                                'data' => []
                            ], REST_Controller::HTTP_PARTIAL_CONTENT);
                        }

                        if (is_numeric($d['DPP Nilai Lain/DPP'])) {
                            $dpp_nilai_lain = (int) $d['DPP Nilai Lain/DPP']; // atau gunakan intval($nilai);
                        } else {
                            $this->response([
                                'status' => false,
                                'message' => 'Nilai DPP Nilai Lain/DPP tidak valid',
                                'data' => []
                            ], REST_Controller::HTTP_PARTIAL_CONTENT);
                        }

                        if (is_numeric($d['PPN'])) {
                            $ppn = (int) $d['PPN']; // atau gunakan intval($nilai);
                        } else {
                            $this->response([
                                'status' => false,
                                'message' => 'Nilai PPN tidak valid',
                                'data' => []
                            ], REST_Controller::HTTP_PARTIAL_CONTENT);
                        }
                            
                        $i++;

                        if (!empty($d['Nomor Faktur Pajak'])) {
                            // cek nomor faktur pajak, jika sudah ada maka skip tidak usah di insert
                            $faktur = $this->PPN_Model->get_document_by_nomor_faktur($d['Nomor Faktur Pajak']);
                            if (!$faktur) {
                                $post[] = array(
                                    "master_perusahaan_id" => $perusahaan->id,
                                    "master_vendor_id" => $vendor->id,
                                    'ppn_persentase' => !empty($this->input->post('ppn_persentase')) ? $this->input->post('ppn_persentase') : null,
                                    'jenis_dokumen' => 'PPN MASUKKAN',            
                                    "npwp_penjual" => !empty($d['NPWP Penjual']) ? $d['NPWP Penjual'] : null,
                                    "nama_penjual" => !empty($d['Nama Penjual']) ? $d['Nama Penjual'] : null,
                                    "Cek" => $vendor->cek,
                                    "nomor_faktur_pajak" => !empty($d['Nomor Faktur Pajak']) ? $d['Nomor Faktur Pajak'] : null,
                                    "tanggal_faktur_pajak" => !empty($d['Tanggal Faktur Pajak']) ? $d['Tanggal Faktur Pajak'] : null,
                                    "masa_pajak" => !empty($d['Masa Pajak']) ? $d['Masa Pajak'] : null,
                                    "tahun_pajak" => !empty($d['Tahun']) ? $d['Tahun'] : null,
                                    "masa_pajak_pengkreditkan" => !empty($d['Masa Pajak Pengkreditkan']) ? $d['Masa Pajak Pengkreditkan'] : null,
                                    "tahun_pajak_pengkreditkan" => !empty($d['Tahun Pajak Pengkreditan']) ? $d['Tahun Pajak Pengkreditan'] : null,
                                    "status_faktur_pajak" => !empty($d['Status Faktur']) ? $d['Status Faktur'] : null,
                                    "harga_jual" => $harga_jual,
                                    "dpp_nilai_lain" => $dpp_nilai_lain,
                                    "ppn" => $ppn,
                                    "ppnbm" => !empty($d['PPnBM']) ? $d['PPnBM'] : null,
                                    "perekam" => !empty($d['Perekam']) ? $d['Perekam'] : null,
                                    "nomor_sp2d" => !empty($d['Nomor SP2D']) ? $d['Nomor SP2D'] : null,
                                    "valid" => !empty($d['Valid']) ? $d['Valid'] : null,
                                    "dilaporkan" => !empty($d['Dilaporkan']) ? $d['Dilaporkan'] : null,
                                    "dilaporkan_oleh_penjual" => !empty($d['Dilaporkan oleh Penjual']) ? $d['Dilaporkan oleh Penjual'] : null,
                                    "unifikasi_kode_objek_pajak_id" => $vendor->unifikasi_kode_objek_pajak_id,
                                    "created_at" => $this->time_server,
                                    "created_by" => $this->token->data->username
                                );
                            } else {
                                $duplicate_data++;
                            }
                        }
                    }
                }
            }

            if ($type_document == 'DOKUMENLAIN') {

                // cek filename terlebih dahulu, substring nama file untuk mengecek berdasarkan NPWP Perusahaan
                $parts = explode('_', $this->input->post('filename'));
                $npwp_perusahaan = $parts[0];

                $perusahaan = $this->Import_Document_Model->get_perusahaan_by_npwp($npwp_perusahaan);
                if (empty($perusahaan)) {
                    $this->response([
                        'status' => false,
                        'message' => 'Data perusahaan tidak sesuai dengan file yang diupload',
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                }
            
                if ($data[0]['NPWP Penjual'] == "" || $data[0]['Nama Penjual'] == '' || $data[0]['Nomor Dokumen'] == '' || $data[0]['Tanggal Dokumen'] == '' || $data[0]['Jenis Transaksi'] == '' || $data[0]['Masa Pajak'] == '' || $data[0]['Tahun'] == '' || $data[0]['DPP'] == '' || $data[0]['PPN'] == '' || $data[0]['PPnBM'] == '' || $data[0]['Status'] == '' || $data[0]['Valid'] == '' || $data[0]['Dilaporkan'] == '' || $data[0]['Uraian'] == '' || $data[0]['Perekam'] == '') {
                    $this->response([
                        'status' => false,
                        'message' => 'Format dokumen yang diupload tidak sesuai. Silakan unduh tempate dokumen terlebih dahulu!',
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                } else {
                    $i = 0;
                    $duplicate_data = 0;
                    
                    $periode = $data[0]['Tanggal Dokumen'];
                    $extract_periode = $this->extractMonthAndYear($periode);
                    $bulan = $extract_periode['bulan'];
                    $tahun = $extract_periode['tahun'];

                    foreach ($data as $d) {
                        // get vendor
                        $npwpUpload[$i] = $d['NPWP Penjual'];
                        if ($i == 0 && !empty($d['NPWP Penjual'])) {
                            $vendor = $this->Import_Document_Model->get_vendor_by_npwp($d['NPWP Penjual']);
                            if (empty($vendor)) {
                                $this->response([
                                    'status' => false,
                                    'message' => 'Vendor dengan NPWP '.$d['NPWP Penjual'].' tidak ditemukan. Silakan buatkan master datanya terlebih dahulu!',
                                    'data' => []
                                ], REST_Controller::HTTP_PARTIAL_CONTENT);
                            }
                        } else if ($i > 0 && !empty($d['NPWP Penjual'])) {
                            if ($npwpUpload[$i-1] != $d['NPWP Penjual']) {
                                $vendor = $this->Import_Document_Model->get_vendor_by_npwp($d['NPWP Penjual']);
                                if (empty($vendor)) {
                                    $this->response([
                                        'status' => false,
                                        'message' => 'Vendor dengan NPWP '.$d['NPWP Penjual'].' tidak ditemukan. Silakan buatkan master datanya terlebih dahulu!',
                                        'data' => []
                                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                                }
                            }
                        } else {
                            $this->response([
                                'status' => false,
                                'message' => 'NPWP Penjual line '.($i+1).' kosong',
                                'data' => []
                            ], REST_Controller::HTTP_PARTIAL_CONTENT);
                        }

                        // cek waktu periode pajak
                        $periode = $d['Tanggal Dokumen'];
                        $extract_periode = $this->extractMonthAndYear($periode);
                        if ($extract_periode == false) {
                            $this->response([
                                'status' => false,
                                'message' => 'Tanggal Dokumen tidak valid',
                                'data' => []
                            ], REST_Controller::HTTP_PARTIAL_CONTENT);
                        } else {
                            // $bulan_detail = $extract_periode['bulan'];
                            // $tahun_detail = $extract_periode['tahun'];

                            // if ($bulan_detail != $bulan || $tahun_detail != $tahun) {
                            //     $this->response([
                            //         'status' => false,
                            //         'message' => 'Terdapat multiple periode. Periode '.$bulan_detail.'-'.$tahun_detail.' tidak dapat di upload bersamaan di Periode '.$bulan.'-'.$tahun,
                            //         'data' => []
                            //     ], REST_Controller::HTTP_PARTIAL_CONTENT);
                            // }
                        }

                        if (is_numeric($d['DPP'])) {
                            $dpp_nilai_lain = (int) $d['DPP']; // atau gunakan intval($nilai);
                        } else {
                            $this->response([
                                'status' => false,
                                'message' => 'Nilai DPP tidak valid',
                                'data' => []
                            ], REST_Controller::HTTP_PARTIAL_CONTENT);
                        }

                        if (is_numeric($d['PPN'])) {
                            $ppn = (int) $d['PPN']; // atau gunakan intval($nilai);
                        } else {
                            $this->response([
                                'status' => false,
                                'message' => 'Nilai PPN tidak valid',
                                'data' => []
                            ], REST_Controller::HTTP_PARTIAL_CONTENT);
                        }
                            
                        $i++;
                        
                        if (!empty($d['Nomor Dokumen'])) {
                            // cek nomor faktur pajak, jika sudah ada maka skip tidak usah di insert
                            $faktur = $this->PPN_Model->get_document_by_nomor_faktur($d['Nomor Dokumen']);
                            if (!$faktur) {
                                $post[] = array(
                                    "master_perusahaan_id" => $perusahaan->id,
                                    "master_vendor_id" => $vendor->id,
                                    'ppn_persentase' => !empty($this->input->post('ppn_persentase')) ? $this->input->post('ppn_persentase') : null,
                                    'jenis_dokumen' => 'DOKUMEN LAIN',
                                    "npwp_penjual" => !empty($d['NPWP Penjual']) ? $d['NPWP Penjual'] : null,
                                    "nama_penjual" => !empty($d['Nama Penjual']) ? $d['Nama Penjual'] : null,
                                    "cek" => $vendor->cek,
                                    "nomor_faktur_pajak" => !empty($d['Nomor Dokumen']) ? $d['Nomor Dokumen'] : null,
                                    "tanggal_faktur_pajak" => !empty($d['Tanggal Dokumen']) ? $d['Tanggal Dokumen'] : null,
                                    "jenis_transaksi" => !empty($d['Jenis Transaksi']) ? $d['Jenis Transaksi'] : null,
                                    "masa_pajak" => !empty($d['Masa Pajak']) ? $d['Masa Pajak'] : null,
                                    "tahun_pajak" => !empty($d['Tahun']) ? $d['Tahun'] : null,
                                    "masa_pajak_pengkreditkan" => !empty($d['Masa Pajak Pengkreditkan']) ? $d['Masa Pajak Pengkreditkan'] : null,
                                    "tahun_pajak_pengkreditkan" => !empty($d['Tahun Pajak Pengkreditan']) ? $d['Tahun Pajak Pengkreditan'] : null,
                                    "status_faktur_pajak" => !empty($d['Status']) ? $d['Status'] : null,
                                    "dpp_nilai_lain" => $dpp_nilai_lain,
                                    "ppn" => $ppn,
                                    "ppnbm" => !empty($d['PPnBM']) ? $d['PPnBM'] : null,
                                    "perekam" => !empty($d['Perekam']) ? $d['Perekam'] : null,
                                    "valid" => !empty($d['Valid']) ? $d['Valid'] : null,
                                    "dilaporkan" => !empty($d['Dilaporkan']) ? $d['Dilaporkan'] : null,
                                    "uraian" => !empty($d['Uraian']) ? $d['Uraian'] : null,
                                    "unifikasi_kode_objek_pajak_id" => $vendor->unifikasi_kode_objek_pajak_id,
                                    "created_at" => $this->time_server,
                                    "created_by" => !empty($d['Dibuat Oleh']) ? $d['Dibuat Oleh'] : null
                                );
                            } else {
                                $duplicate_data++;
                            }
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
				if ($type_document == 'ACCARBON' || $type_document == 'ACCARDAT') {
                    $this->Import_Document_Model->import($type_document, $post, $index);
                } else if ($type_document == 'PPNMASUKKAN' || $type_document == 'DOKUMENLAIN') {
                    if ($i > 0) {
                        // response not found data
                        $this->response([
                            'status' => false,
                            'message' => 'Tidak ada data yang disimpan! Terdapat '.($duplicate_data).' nomor faktur pajak yang duplikat.',
                            'data' => []
                        ], REST_Controller::HTTP_PARTIAL_CONTENT);
                    } else {
                        // response not found data
                        $this->response([
                            'status' => false,
                            'message' => 'Tidak ada data yang disimpan!',
                            'data' => []
                        ], REST_Controller::HTTP_PARTIAL_CONTENT);
                    }
                } else {
                    // response not found data
                    $this->response([
                        'status' => false,
                        'message' => 'Tidak ada data yang disimpan!',
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                }
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
