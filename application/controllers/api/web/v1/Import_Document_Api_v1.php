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

    public function show_by_id_get()
    {
        
    }
    
    public function create_post()
    {   
        ini_set('memory_limit', '-1');  
        ini_set('max_execution_time', '18000');
        $data = [];

        try {
            
            if (!empty($_FILES)) {

                $type_document = $this->input->post('type_document');
                $post['file'] = $_FILES['file'];
                $created_by = $this->token->data->username;
                
                $inputFileName = $_FILES['file']['tmp_name'];
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);

                $sheet = $objPHPExcel->getSheet(0);
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                if ($type_document == 'ACCDBRG') {
                    
                    for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);   
                            
                        if ($rowData[0][0] != null || $rowData[0][0] != '') {
                            // Sesuaikan key array dengan nama kolom di database                                                         
                            $data[] = array(
                                "kode_barang" => $rowData[0][0],
                                "golongan" => $rowData[0][1],
                                "nama_barang" => $rowData[0][2],
                                "pabrik" => $rowData[0][3],
                                "satuan" => $rowData[0][4],
                                "packing" => $rowData[0][5],
                                "satuan_per_pak" => $rowData[0][6],
                                "harga_satuan" => $rowData[0][7],
                                "harga_pokok" => $rowData[0][8],
                                "harga_beli" => $rowData[0][9],
                                "keterangan_barang" => $rowData[0][10],
                                "gudang_a" => $rowData[0][11],
                                "gudang_b" => $rowData[0][12],
                                "gudang_c" => $rowData[0][13],
                                "gudang_d" => $rowData[0][14],
                                "gudang_e" => $rowData[0][15],
                                "gudang_f" => $rowData[0][16],
                                "jumlah_stok" => $rowData[0][17],
                                "minimum" => $rowData[0][18],
                                "created_by" => $created_by
                            );
                        }
                                
                    }
                    
                }

                if ($type_document == 'ACCDLGN') {
                    
                    for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);   
    
                            // Sesuaikan key array dengan nama kolom di database                                                         
                            $data[] = array(
                            "kode_langganan"=> $rowData[0][0],
                            "nama_toko"=> $rowData[0][1],
                            "nama"=> $rowData[0][2],
                            "alamat"=> $rowData[0][3],
                            "kota"=> $rowData[0][4],
                            "telepon"=> $rowData[0][5],
                            "limit_int"=> $rowData[0][6],
                            "diskon_1"=> $rowData[0][7],
                            "diskon_2"=> $rowData[0][8],
                            "diskon_3"=> $rowData[0][9],
                            "keterangan_langganan"=> $rowData[0][10],
                            "saldo"=> $rowData[0][11],
                            "cek_langganan"=> $rowData[0][12],
                            "npwp_langganan"=> $rowData[0][13],
                            "nama_pjk"=> $rowData[0][14],
                            "created_by" => $created_by
                        );
                                
                    }
                    
                }

                if ($type_document == 'ACCARBON') {
                    for ($row = 2; $row <= $highestRow; $row++){                  
                        
                        //  Read a row of data into an array                 
                        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);   
                            
                        if ($rowData[0][1] != null || $rowData[0][1] != '') {

                            $tahun_sekarang = date('Y', strtotime($this->time_server));
                            $tahun_limit = date('Y', strtotime($tahun_sekarang. ' -3 years'));
                            $tanggal_bon = $rowData[0][0] != null ? date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][0])) : null;
                            
                            // if ($tanggal_bon >= $tahun_limit) {
                                // Sesuaikan key array dengan nama kolom di database                                                         
                                $data[] = array(
                                    "tanggal_bon" => $tanggal_bon,
                                    "nomor_bon" => $rowData[0][1],
                                    "kode_langganan" => $rowData[0][2],
                                    "banyak_barang" => $rowData[0][3],
                                    "kode_barang" => $rowData[0][4],
                                    "harga_barang" => $rowData[0][5],
                                    "diskon_1" => $rowData[0][6],
                                    "diskon_2" => $rowData[0][7],
                                    "diskon_3" => $rowData[0][8],
                                    "prf_barang" => $rowData[0][9],
                                    "ppn" => $rowData[0][10],
                                    "nomor_od" => $rowData[0][11],
                                    "created_by" => $created_by
                                );
                            // }
                        }
                                
                    }
                    
                }
                $this->response([
                    'status' => true,
                    'message' => 'Upload successfully...',
                    'data' => $data   
                ], REST_Controller::HTTP_OK);
                if ($type_document == 'ACCARDAT') {
                    
                    for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                        $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);   

                        if ($rowData[0][1] != null || $rowData[0][1] != '') {
                            // Sesuaikan key array dengan nama kolom di database    
                            $tahun_sekarang = date('Y', strtotime($this->time_server));
                            $tahun_limit = date('Y', strtotime($tahun_sekarang. ' -3 years'));
                            $tanggal_lunas = $rowData[0][16] != null ? date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][16])) : $rowData[0][16];
                            $tanggal_ar = $rowData[0][2] != null ? date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][2])) : $rowData[0][2];
                            $tanggal_od = $rowData[0][4] != null ? date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][4])) : $rowData[0][4];

                            if ($tanggal_ar >= $tahun_limit) {

                                $data[] = array(
                                    "ref_ar" => $rowData[0][0],
                                    "nomor_nota" => $rowData[0][1],
                                    "tanggal_ar" => $tanggal_ar,
                                    "nomor_od" => $rowData[0][3],
                                    "tanggal_od" => $tanggal_od,
                                    "kode_ar" => $rowData[0][5],
                                    "keterangan_ar" => $rowData[0][6],
                                    "cara_diskon" => $rowData[0][7],
                                    "nilai_diskon" => $rowData[0][8],
                                    "potongan" => $rowData[0][9],
                                    "sales_ar" => $rowData[0][10],
                                    "jumlah_ar" => $rowData[0][11],
                                    "prof_ar" => $rowData[0][12],
                                    "sisa_ar" => $rowData[0][13],
                                    "klmp_ar" => $rowData[0][14],
                                    "waktu_ar" => $rowData[0][15],
                                    "tanggal_lunas" => $tanggal_lunas,
                                    "nomor_bayar_ar" => $rowData[0][17],
                                    "nomor_transaksi_ar" => $rowData[0][18],
                                    "user_ar" => $rowData[0][19],
                                    "created_by" => $created_by
                                );
                            }
                        }
                                
                    }
                    
                }

                if(count($data) > 0) {
                    
                    $insert = $this->Import_Document_Model->import($type_document, $data);
                    
                    if ($insert) {
                        //response success with data
                        $this->response([
                            'status' => true,
                            'message' => 'Upload successfully...',
                            'data' => $data   
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
                
            } else {
                // response not found data
                $this->response([
                    'status' => false,
                    'message' => 'File Document tidak ditemukan',
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

    public function create2_post()
    {   
        ini_set('memory_limit', '512M');  
        // ini_set('max_execution_time', '7200');
        $created_by = $this->token->data->username;
        $type_document = $this->input->post('type_document');
        $index = null;
        $post = array();

        try {
            
            if ($type_document == 'ACCDBRG' || $type_document == 'ACCDLGN') {
                
                if (!empty($_FILES)) {
                    
                    $inputFileName = $_FILES['file']['tmp_name'];
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);

                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    $highestColumn = $sheet->getHighestColumn();

                    if ($type_document == 'ACCDBRG') {
                        
                        for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);   
                                
                            if ($rowData[0][0] != null || $rowData[0][0] != '') {
                                
                                // Sesuaikan key array dengan nama kolom di database                                                         
                                $post[] = array(
                                    "kode_barang" => $rowData[0][0],
                                    "golongan" => $rowData[0][1],
                                    "nama_barang" => $rowData[0][2],
                                    "pabrik" => $rowData[0][3],
                                    "satuan" => $rowData[0][4],
                                    "packing" => $rowData[0][5],
                                    "satuan_per_pak" => $rowData[0][6],
                                    "harga_satuan" => $rowData[0][7],
                                    "harga_pokok" => $rowData[0][8],
                                    "harga_beli" => $rowData[0][9],
                                    "keterangan_barang" => $rowData[0][10],
                                    "gudang_a" => $rowData[0][11],
                                    "gudang_b" => $rowData[0][12],
                                    "gudang_c" => $rowData[0][13],
                                    "gudang_d" => $rowData[0][14],
                                    "gudang_e" => $rowData[0][15],
                                    "gudang_f" => $rowData[0][16],
                                    "jumlah_stok" => $rowData[0][17],
                                    "minimum" => $rowData[0][18],
                                    "created_by" => $created_by
                                );
                            }
                                    
                        }
                        //response success with data
                        // $this->response([
                        //     'status' => false,
                        //     'message' => 'XXXX...',
                        //     'data' => $post   
                        // ], REST_Controller::HTTP_OK);
                        
                    }

                    if ($type_document == 'ACCDLGN') {
                        
                        for ($row = 2; $row <= $highestRow; $row++){                  //  Read a row of data into an array                 
                            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row, NULL, TRUE, FALSE);   
        
                                // Sesuaikan key array dengan nama kolom di database                                                         
                                $post[] = array(
                                "kode_langganan"=> $rowData[0][0],
                                "nama_toko"=> $rowData[0][1],
                                "nama"=> $rowData[0][2],
                                "alamat"=> $rowData[0][3],
                                "kota"=> $rowData[0][4],
                                "telepon"=> $rowData[0][5],
                                "limit_int"=> $rowData[0][6],
                                "diskon_1"=> $rowData[0][7],
                                "diskon_2"=> $rowData[0][8],
                                "diskon_3"=> $rowData[0][9],
                                "keterangan_langganan"=> $rowData[0][10],
                                "saldo"=> $rowData[0][11],
                                "cek_langganan"=> $rowData[0][12],
                                "npwp_langganan"=> $rowData[0][13],
                                "nama_pjk"=> $rowData[0][14],
                                "created_by" => $created_by
                            );
                                    
                        }
                    }
                } else {
                    // response not found data
                    $this->response([
                        'status' => false,
                        'message' => 'File Document tidak ditemukan',
                        'data' => []
                    ], REST_Controller::HTTP_PARTIAL_CONTENT);
                }
            } else {

                $_POST = json_decode($this->input->raw_input_stream, true);
                $data = $this->input->post('data');
                $type_document = $this->input->post('type_document');
                $index = $this->input->post('index');
                
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

    public function create3_post()
    {
        ini_set('memory_limit', '-1');  
        ini_set('max_execution_time', '300');

        $inputFileName = $_FILES['file']['tmp_name'];
        $file_mimes = array('application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
 
        if(isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {
        
            $arr_file = explode('.', $_FILES['file']['name']);
            $extension = end($arr_file);
        
            if('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
        
            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
            
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            for($i = 1;$i < count($sheetData);$i++)
            {
                // $data[] = array (
                //     'nama' => $sheetData[$i]['1'],
                //     'kelas' => $sheetData[$i]['2'],
                //     'alamat' => $sheetData[$i]['3']
                // );

                // Sesuaikan key array dengan nama kolom di database                                                         
                $data[] = array(
                    "tanggal_bon" => $sheetData[$i]['0'],
                    "nomor_bon" => $sheetData[$i]['1'],
                    "kode_langganan" => $sheetData[$i]['2'],
                    "banyak_barang" => $sheetData[$i]['3'],
                    "kode_barang" => $sheetData[$i]['4'],
                    "harga_barang" => $sheetData[$i]['5'],
                    "diskon_1" => $sheetData[$i]['6'],
                    "diskon_2" => $sheetData[$i]['7'],
                    "diskon_3" => $sheetData[$i]['8'],
                    "prf_barang" => $sheetData[$i]['9'],
                    "ppn" => $sheetData[$i]['10'],
                    "nomor_od" => $sheetData[$i]['11'],
                    "created_by" => $created_by
                );
                 
                 
                // $nama = $sheetData[$i]['1'];
                // $kelas = $sheetData[$i]['2'];
                // $alamat = $sheetData[$i]['3'];
                // mysqli_query($koneksi,"insert into tb_siswa (id_siswa,nama,kelas,alamat) values ('','$nama','$kelas','$alamat')");
            }
            print_r($data);die();
            // header("Location: form_upload.html"); 
        }

        $this->response([
            'status' => true,
            'message' => 'Upload successfully...',
            'data' => $insert   
        ], REST_Controller::HTTP_OK);
    }

    public function update_put()
    {   
        
    }

    public function destroy_delete()
    {
        
    }
}

/* End of file Import_Document_Api.php */
