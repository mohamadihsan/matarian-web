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
            $perusahaan = $this->input->get('perusahaan');

            $start = sprintf('%04d-%02d-01', $tahun_awal, $bulan_awal); 
            $end   = date("Y-m-t", strtotime(sprintf('%04d-%02d-01', $tahun_akhir, $bulan_akhir)));
        
            // $nama_bulan = $this->get_nama_bulan($bulan_awal);
            $nama_bulan_pengkreditkan = $this->get_nama_bulan($bulan_pengkreditkan);

            $query = $this->PPN_Model->get_ppn_report($perusahaan, $start, $end, $nama_bulan_pengkreditkan, $tahun_pengkreditkan, $status_faktur, $jenis_dokumen);
            $data = $query->result();

            // Load PHPExcel
            $this->load->library('excel');
            $objPHPExcel = new PHPExcel();

            $sheet = $objPHPExcel->setActiveSheetIndex(0);
            $sheet->setCellValue('A1', 'Nama Penjual')
                ->setCellValue('B1', 'Cek')
                ->setCellValue('C1', 'Nomor Faktur Pajak')
                ->setCellValue('D1', 'Tgl Faktur Pajak')
                ->setCellValue('E1', 'Masa Pajak')
                ->setCellValue('F1', 'Tahun')
                ->setCellValue('G1', 'Status Faktur')
                ->setCellValue('H1', 'Harga Jual')
                ->setCellValue('I1', 'DPP Nilai Lain')
                ->setCellValue('J1', 'PPN')
                ->setCellValue('K1', 'Dikreditkan')
                ->setCellValue('K2', 'B1')
                ->setCellValue('L2', 'B2')
                ->setCellValue('M2', 'B3');

            // ===================== MERGE CELLS =====================
            // A–J merge row 1 & 2
            $sheet->mergeCells('A1:A2');
            $sheet->mergeCells('B1:B2');
            $sheet->mergeCells('C1:C2');
            $sheet->mergeCells('D1:D2');
            $sheet->mergeCells('E1:E2');
            $sheet->mergeCells('F1:F2');
            $sheet->mergeCells('G1:G2');
            $sheet->mergeCells('H1:H2');
            $sheet->mergeCells('I1:I2');
            $sheet->mergeCells('J1:J2');

            // K–M merge row 1
            $sheet->mergeCells('K1:M1');

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

            // Apply style to header rows (A1:M2)
            $sheet->getStyle('A1:M2')->applyFromArray($styleHeader);

            // ===================== ISI DATA =====================
            $row = 3;
            foreach ($data as $item) {
                $sheet->setCellValue('A' . $row, $item->nama_penjual);
                $sheet->setCellValue('B' . $row, $item->cek);

                // Kolom C & F -> Format TEXT
                $sheet->setCellValueExplicit('C' . $row, $item->nomor_faktur_pajak, PHPExcel_Cell_DataType::TYPE_STRING);
                $sheet->setCellValue('D' . $row, PHPExcel_Shared_Date::PHPToExcel(strtotime($item->tanggal_faktur_pajak)));
                $sheet->setCellValue('E' . $row, $item->masa_pajak);
                $sheet->setCellValueExplicit('F' . $row, $item->tahun_pajak, PHPExcel_Cell_DataType::TYPE_STRING);

                $sheet->setCellValue('G' . $row, $item->status_faktur_pajak);

                // Kolom H–M -> Number format dengan ribuan
                $sheet->setCellValue('H' . $row, $item->harga_jual);
                $sheet->setCellValue('I' . $row, $item->dpp_nilai_lain);
                $sheet->setCellValue('J' . $row, $item->ppn);
                $sheet->setCellValue('K' . $row, $item->b1);
                $sheet->setCellValue('L' . $row, $item->b2);
                $sheet->setCellValue('M' . $row, $item->b3);

                $row++;
            }

            // ===================== TOTAL =====================
            $lastRow  = $row - 1;     // baris terakhir data
            $totalRow = $row;         // baris untuk total

            $sheet->setCellValue('I' . $totalRow, 'TOTAL');
            $sheet->setCellValue("J{$totalRow}", "=SUM(J3:J{$lastRow})");
            $sheet->setCellValue("K{$totalRow}", "=SUM(K3:K{$lastRow})");
            $sheet->setCellValue("L{$totalRow}", "=SUM(L3:L{$lastRow})");
            $sheet->setCellValue("M{$totalRow}", "=SUM(M3:M{$lastRow})");

            // Bold + border atas untuk baris total
            $sheet->getStyle("I{$totalRow}:M{$totalRow}")->applyFromArray([
                'font' => ['bold' => true],
                'borders' => [
                    'top' => ['style' => PHPExcel_Style_Border::BORDER_THIN]
                ]
            ]);

            // ===================== STYLE ISI =====================
            // Border isi table
            $sheet->getStyle('A1:M' . $totalRow)->applyFromArray([
                'borders' => [
                    'allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]
                ]
            ]);

            // Format kolom tanggal (D)
            $sheet->getStyle("D3:D{$lastRow}")
                ->getNumberFormat()
                ->setFormatCode('DD/MM/YYYY');

            // Format number ribuan untuk H–M (termasuk total)
            $sheet->getStyle("H3:M{$totalRow}")
                ->getNumberFormat()
                ->setFormatCode('#,##0');

            // ===================== AUTO WIDTH =====================
            foreach (range('A', 'M') as $col) {
                $sheet->getColumnDimension($col)->setAutoSize(true);
            }

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
