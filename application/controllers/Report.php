<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // validate token
        $this->token = AUTHORIZATION::validateTokenOnPage();

        $this->load->model('PPN_Model');

        // check privilege
        $url = $this->uri->segment(1);
        $url .= $this->uri->segment(2) != '' ? '/' . $this->uri->segment(2) : '';
        $url .= $this->uri->segment(3) != '' ? '/' . $this->uri->segment(3) : '';
        $this->id_user_group = JWT::decode($this->token, $this->config->item('jwt_key'), array('HS256'))->data->id_user_group;
        $this->sales_ar = JWT::decode($this->token, $this->config->item('jwt_key'), array('HS256'))->data->sales_ar;
        $this->user_id = JWT::decode($this->token, $this->config->item('jwt_key'), array('HS256'))->data->user_id;
        $check = $this->User_Privilege->check_privilege($this->id_user_group, $url);
        if (!empty($check)) {
            if ($check->read_access == true) {
                $this->create_access = $check->create_access;
                $this->read_access = $check->read_access;
                $this->update_access = $check->update_access;
                $this->delete_access = $check->delete_access;
                $this->approve_access = $check->approve_access;
                $this->reject_access = $check->reject_access;
                $this->print_access = $check->print_access;
                $this->export_to_excel_access = $check->export_to_excel_access;
                $this->export_to_csv_access = $check->export_to_csv_access;
                $this->export_to_pdf_access = $check->export_to_pdf_access;
            } else {
                redirect('dashboard', 'refresh');
            }
        } else {
            redirect('dashboard', 'refresh');
        }
    }

    public function sales()
    {
        $data['title'] = 'Sales Report';
        $data['token'] = $this->token;
        $data['sales_ar'] = $this->sales_ar;
        $data['user_id'] = $this->user_id;
        $data['id_user_group'] = $this->id_user_group;

        // role
        $data['action_create'] = $this->create_access;
        $data['action_update'] = $this->update_access;
        $data['action_delete'] = $this->delete_access;
        $data['action_approval'] = $this->approve_access;
        $data['action_export_to_excel'] = $this->export_to_excel_access;
        $data['action_export_to_csv'] = $this->export_to_csv_access;
        $data['action_export_to_pdf'] = $this->export_to_pdf_access;


        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('_layout/topbar', $data);
        $this->load->view('pages/report_sales', $data);
        $this->load->view('_layout/footer');
    }

    public function by_barang_langganan()
    {
        $data['title'] = 'Report Berdasarkan Barang & Langganan';
        $data['token'] = $this->token;

        // role
        $data['action_create'] = $this->create_access;
        $data['action_update'] = $this->update_access;
        $data['action_delete'] = $this->delete_access;
        $data['action_approval'] = $this->approve_access;
        $data['action_export_to_excel'] = $this->export_to_excel_access;
        $data['action_export_to_csv'] = $this->export_to_csv_access;
        $data['action_export_to_pdf'] = $this->export_to_pdf_access;


        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('_layout/topbar', $data);
        $this->load->view('pages/report_by_barang_langganan', $data);
        $this->load->view('_layout/footer');
    }

    public function stock()
    {
        $data['title'] = 'Stock Report';
        $data['token'] = $this->token;

        // role
        $data['action_create'] = $this->create_access;
        $data['action_update'] = $this->update_access;
        $data['action_delete'] = $this->delete_access;
        $data['action_approval'] = $this->approve_access;
        $data['action_export_to_excel'] = $this->export_to_excel_access;
        $data['action_export_to_csv'] = $this->export_to_csv_access;
        $data['action_export_to_pdf'] = $this->export_to_pdf_access;

        $this->load->view('_layout/header', $data);
        $this->load->view('_layout/sidebar', $data);
        $this->load->view('_layout/topbar', $data);
        $this->load->view('pages/report_stock', $data);
        $this->load->view('_layout/footer');
    }

    public function ppn()
    {
        $perusahaan = $this->input->get('perusahaan');
        if ($perusahaan && $this->export_to_excel_access) {
            $bulan_awal = $this->input->get('bulan_awal');
            $tahun_awal = $this->input->get('tahun_awal');
            $bulan_akhir = $this->input->get('bulan_akhir');
            $tahun_akhir = $this->input->get('tahun_akhir');
            $bulan_pengkreditkan = $this->input->get('bulan_pengkreditkan');
            $tahun_pengkreditkan = $this->input->get('tahun_pengkreditkan');
            $jenis_dokumen = $this->input->get('jenis_dokumen');
            $status_faktur = $this->input->get('status_faktur');
            $is_jasa = $this->input->get('is_jasa');

            $start = sprintf('%04d-%02d-01', $tahun_awal, $bulan_awal); 
            $end   = date("Y-m-t", strtotime(sprintf('%04d-%02d-01', $tahun_akhir, $bulan_akhir)));
        
            // $nama_bulan = $this->get_nama_bulan($bulan_awal);
            $nama_bulan_pengkreditkan = $this->get_nama_bulan($bulan_pengkreditkan);

            $query = $this->PPN_Model->get_ppn_report($perusahaan, $start, $end, $nama_bulan_pengkreditkan, $tahun_pengkreditkan, $status_faktur, $jenis_dokumen, $is_jasa);
            $data = $query->result();

            // Load PHPExcel
            $this->load->library('excel');
            $objPHPExcel = new PHPExcel();

            $sheet = $objPHPExcel->setActiveSheetIndex(0);

            // Judul utama
            $sheet->setCellValue('A1', 'REKAPITULASI PPN MASUKAN');
            $sheet->mergeCells('A1:O1'); // sesuaikan dengan kolom terakhir datamu
            $sheet->getStyle('A1')->applyFromArray([
                'font' => [
                    'bold' => true,
                    'size' => 14,
                ],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
                ]
            ]);
            $sheet->getRowDimension(1)->setRowHeight(20);

            // Nama perusahaan
            $sheet->setCellValue('A2', 'NAMA PERUSAHAAN');
            $sheet->mergeCells('A2:O2');
            $sheet->getStyle('A2')->applyFromArray([
                'font' => [
                    'bold' => true,
                    'size' => 14
                ],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
                ]
            ]);
            $sheet->getRowDimension(2)->setRowHeight(20);

            // Masa pajak (dari filter)
            $masa = $nama_bulan_pengkreditkan;   // contoh dari filter
            $tahun = $tahun_pengkreditkan;   // contoh dari filter
            $sheet->setCellValue('A3', "MASA: {$masa} {$tahun}");
            $sheet->mergeCells('A3:O3');
            $sheet->getStyle('A3')->applyFromArray([
                'font' => [
                    'bold' => true,
                    'size' => 14
                ],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
                ]
            ]);
            $sheet->getRowDimension(3)->setRowHeight(20);


            $sheet->setCellValue('A4', 'Nama Penjual')
                ->setCellValue('B4', 'Cek')
                ->setCellValue('C4', 'Nomor Faktur Pajak')
                ->setCellValue('D4', 'Tgl Faktur Pajak')
                ->setCellValue('E4', 'Masa Pajak')
                ->setCellValue('F4', 'Tahun')
                ->setCellValue('G4', 'Masa Pajak')
                ->setCellValue('H4', 'Tahun')
                ->setCellValue('I4', 'Status Faktur')
                ->setCellValue('J4', 'Harga Jual')
                ->setCellValue('K4', 'DPP Nilai Lain')
                ->setCellValue('L4', 'PPN')
                ->setCellValue('M4', 'Dikreditkan')
                ->setCellValue('M5', 'B4')
                ->setCellValue('N5', 'B5')
                ->setCellValue('O5', 'B3');

            // ===================== MERGE CELLS =====================
            // A–J merge row 1 & 2
            $sheet->mergeCells('A4:A5');
            $sheet->mergeCells('B4:B5');
            $sheet->mergeCells('C4:C5');
            $sheet->mergeCells('D4:D5');
            $sheet->mergeCells('E4:E5');
            $sheet->mergeCells('F4:F5');
            $sheet->mergeCells('G4:G5');
            $sheet->mergeCells('H4:H5');
            $sheet->mergeCells('I4:I5');
            $sheet->mergeCells('J4:J5');
            $sheet->mergeCells('K4:K5');
            $sheet->mergeCells('L4:L5');

            // K–M merge row 1
            $sheet->mergeCells('M4:O4');

            // ===================== STYLE HEADER =====================
            $styleHeader = [
                'font' => [
                    'bold' => true,
                    'size' => 12
                ],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    ]
                ]
            ];

            // Apply style to header rows (A4:M2)
            $sheet->getStyle('A4:M5')->applyFromArray($styleHeader);

            // ===================== ISI DATA =====================
            $row = 6;
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $item->nama_penjual);
                $sheet->setCellValue('B' . $row, $item->cek);

                // Kolom C & F -> Format TEXT
                $sheet->setCellValueExplicit('C' . $row, $item->nomor_faktur_pajak, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValue('D' . $row, PHPExcel_Shared_Date::PHPToExcel(strtotime($item->tanggal_faktur_pajak)));
                $sheet->setCellValue('E' . $row, $item->masa_pajak);
                $sheet->setCellValueExplicit('F' . $row, $item->tahun_pajak, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValue('G' . $row, $item->masa_pajak_pengkreditkan);
                $sheet->setCellValueExplicit('H' . $row, $item->tahun_pajak_pengkreditkan, PHPExcel_Cell_DataType::TYPE_STRING);

                $sheet->setCellValue('I' . $row, $item->status_faktur_pajak);

                // Kolom H–M -> Number format dengan ribuan
                $sheet->setCellValue('J' . $row, $item->harga_jual);
                $sheet->setCellValue('K' . $row, $item->dpp_nilai_lain);
                $sheet->setCellValue('L' . $row, $item->ppn_condition);
                $sheet->setCellValue('M' . $row, $item->b1);
                $sheet->setCellValue('N' . $row, $item->b2);
                $sheet->setCellValue('O' . $row, $item->b3);

                $row++;
            }

            // ===================== TOTAL =====================
            $lastRow  = $row - 1;     // baris terakhir data
            $totalRow = $row;         // baris untuk total

            $sheet->setCellValue('K' . $totalRow, 'TOTAL');
            $sheet->setCellValue("L{$totalRow}", "=SUM(L3:L{$lastRow})");
            $sheet->setCellValue("M{$totalRow}", "=SUM(M3:M{$lastRow})");
            $sheet->setCellValue("N{$totalRow}", "=SUM(N3:N{$lastRow})");
            $sheet->setCellValue("O{$totalRow}", "=SUM(O3:O{$lastRow})");

            // Bold + border atas untuk baris total
            $sheet->getStyle("K{$totalRow}:O{$totalRow}")->applyFromArray([
                'font' => [
                    'bold' => true,
                    'size' => 12
                ],
                'borders' => [
                    'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN]
                ]
            ]);

            // ===================== STYLE ISI =====================
            // Border isi table
            $sheet->getStyle('A4:O' . $totalRow)->applyFromArray([
                'font' => [
                    'size' => 12
                ],
                'borders' => [
                    'allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]
                ]
            ]);

            $sheet->getDefaultRowDimension()->setRowHeight(20);

            // Format kolom tanggal (D)
            $sheet->getStyle("D3:D{$lastRow}")
                ->getNumberFormat()
                ->setFormatCode('DD/MM/YYYY');

            // Format number ribuan untuk H–M (termasuk total)
            $sheet->getStyle("J3:O{$totalRow}")
                ->getNumberFormat()
                ->setFormatCode('#,##0');

            // ===================== AUTO WIDTH =====================
            foreach (range('A', 'O') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }

            // Tambahkan nomor halaman di footer tengah
            $sheet->getHeaderFooter()->setOddFooter('&CPage &P of &N');

            // Penjelasan:
            // &C  → posisi tengah (Center)
            // &P  → current page (halaman sekarang)
            // &N  → total pages (jumlah total halaman)

            // Jika kamu ingin di kanan, gunakan &R
            // $sheet->getHeaderFooter()->setOddFooter('&RPage &P of &N');

            // Kalau mau juga di halaman genap:
            $sheet->getHeaderFooter()->setEvenFooter('&CPage &P of &N');

            $sheet->getPageSetup()->setRowsToRepeatAtTopByStartAndEnd(1, 5);

            // Nama file
            $filename = "Report_PPN_" . date('YmdHis') . ".xlsx";

            // Header untuk download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $writer->save('php://output');
        } else {
            $data['title'] = 'Rekapitulasi PPN';
            $data['token'] = $this->token;
            $data['user_id'] = $this->user_id;
            $data['id_user_group'] = $this->id_user_group;

            // role
            $data['action_create'] = $this->create_access;
            $data['action_update'] = $this->update_access;
            $data['action_delete'] = $this->delete_access;
            $data['action_approval'] = $this->approve_access;
            $data['action_export_to_excel'] = $this->export_to_excel_access;
            $data['action_export_to_csv'] = $this->export_to_csv_access;
            $data['action_export_to_pdf'] = $this->export_to_pdf_access;


            $this->load->view('_layout/header', $data);
            $this->load->view('_layout/sidebar', $data);
            $this->load->view('_layout/topbar', $data);
            $this->load->view('pages/report_ppn', $data);
            $this->load->view('_layout/footer');
        }
    }

    public function unifikasi()
    {
        $perusahaan = $this->input->get('perusahaan');
        if ($perusahaan && $this->export_to_excel_access) {
            $bulan_awal = $this->input->get('bulan_awal');
            $tahun_awal = $this->input->get('tahun_awal');
            $bulan_akhir = $this->input->get('bulan_akhir');
            $tahun_akhir = $this->input->get('tahun_akhir');

            $start = sprintf('%04d-%02d-01', $tahun_awal, $bulan_awal); 
            $end   = date("Y-m-t", strtotime(sprintf('%04d-%02d-01', $tahun_akhir, $bulan_akhir)));
        
            // $nama_bulan = $this->get_nama_bulan($bulan_awal);
            // $nama_bulan_pengkreditkan = $this->get_nama_bulan($bulan_pengkreditkan);

            $query = $this->PPN_Model->get_unifikasi_report($perusahaan, $start, $end, null, null, null, null);
            $data = $query->result();

            // Load PHPExcel
            $this->load->library('excel');
            $objPHPExcel = new PHPExcel();

            $sheet = $objPHPExcel->setActiveSheetIndex(0);
            $sheet->setCellValue('A1', 'Masa Pajak')
                ->setCellValue('B1', 'Tahun Pajak')
                ->setCellValue('C1', 'NPWP')
                ->setCellValue('D1', 'Nama Vendor')
                ->setCellValue('E1', 'Fasilitas')
                ->setCellValue('F1', 'Kode Objek Pajak')
                ->setCellValue('G1', 'DPP')
                ->setCellValue('H1', 'Tarif')
                ->setCellValue('I1', 'Jenis Dok. Referensi')
                ->setCellValue('J1', 'Nomor Dok. Referensi')
                ->setCellValue('K1', 'Tanggal Dok. Referensi')
                ->setCellValue('L1', 'PPh');

            // ===================== STYLE HEADER =====================
            $styleHeader = [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                    'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER
                ],
                'borders' => [
                    'allborders' => [
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    ]
                ]
            ];

            // Apply style to header rows 
            $sheet->getStyle('A1:L1')->applyFromArray($styleHeader);

            // ===================== ISI DATA =====================
            $row = 2;
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $item->masa_pajak);
                $sheet->setCellValue('B' . $row, $item->tahun_pajak, PHPExcel_Cell_DataType::TYPE_STRING);

                // Kolom C & F -> Format TEXT
                $sheet->setCellValueExplicit('C' . $row, $item->npwp_penjual, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('D' . $row, $item->nama_penjual, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValue('E' . $row, $item->fasilitas, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValueExplicit('F' . $row, $item->kode_objek_pajak, PHPExcel_Cell_DataType::TYPE_STRING);

                $sheet->setCellValue('G' . $row, $item->nominal_jasa);
                $sheet->setCellValue('H' . $row, $item->tarif);

                $sheet->setCellValue('I' . $row, $item->kode_dokumen, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValue('J' . $row, $item->nomor_faktur_pajak, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValue('K' . $row, PHPExcel_Shared_Date::PHPToExcel(strtotime($item->tanggal_faktur_pajak)));
                $sheet->setCellValue('L' . $row, $item->pph);

                $row++;
            }

            // ===================== TOTAL =====================
            $lastRow  = $row - 1;     // baris terakhir data
            $totalRow = $row;         // baris untuk total

            $sheet->setCellValue('K' . $totalRow, 'TOTAL');
            $sheet->setCellValue("L{$totalRow}", "=SUM(L2:L{$lastRow})");

            // Bold + border atas untuk baris total
            $sheet->getStyle("K{$totalRow}:L{$totalRow}")->applyFromArray([
                'font' => ['bold' => true],
                'borders' => [
                    'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN]
                ]
            ]);

            // ===================== STYLE ISI =====================
            // Border isi table
            $sheet->getStyle('A1:L' . $totalRow)->applyFromArray([
                'borders' => [
                    'allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]
                ]
            ]);

            // Format kolom tanggal 
            $sheet->getStyle("K2:K{$lastRow}")
                ->getNumberFormat()
                ->setFormatCode('DD/MM/YYYY');

            // Format number ribuan untuk H–M (termasuk total)
            $sheet->getStyle("G2:H{$totalRow}")
                ->getNumberFormat()
                ->setFormatCode('#,##0');
                
            $sheet->getStyle("L2:L{$totalRow}")
                ->getNumberFormat()
                ->setFormatCode('#,##0');

            // ===================== AUTO WIDTH =====================
            foreach (range('A', 'L') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }

            // Nama file
            $filename = "Report_Unifikasi_" . date('YmdHis') . ".xlsx";

            // Header untuk download
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');

            $writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
            $writer->save('php://output');
        } else {
            $data['title'] = 'Laporan Unifikasi';
            $data['token'] = $this->token;
            $data['user_id'] = $this->user_id;
            $data['id_user_group'] = $this->id_user_group;

            // role
            $data['action_create'] = $this->create_access;
            $data['action_update'] = $this->update_access;
            $data['action_delete'] = $this->delete_access;
            $data['action_approval'] = $this->approve_access;
            $data['action_export_to_excel'] = $this->export_to_excel_access;
            $data['action_export_to_csv'] = $this->export_to_csv_access;
            $data['action_export_to_pdf'] = $this->export_to_pdf_access;


            $this->load->view('_layout/header', $data);
            $this->load->view('_layout/sidebar', $data);
            $this->load->view('_layout/topbar', $data);
            $this->load->view('pages/report_unifikasi', $data);
            $this->load->view('_layout/footer');
        }
    }

    public function get_nama_bulan($bulan)
    {
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
}

/* End of file Report.php */
