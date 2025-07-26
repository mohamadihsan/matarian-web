<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ACCARDAT extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // check token
        $this->token = AUTHORIZATION::validateTokenOnPage();
        $this->load->model('Global_Model');

        $this->time_server = $this->Global_Model->time_server()->result()[0]->time_server;

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

    public function index()
    {
        $data['title'] = 'Tagihan';
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
        $this->load->view('pages/tagihan_klik2', $data);
        $this->load->view('_layout/footer');
    }

    public function detail($kode_langganan, $sales_ar, $from_date, $end_date)
    {
        $data['title'] = 'Detail Tagihan Langganan';
        $data['token'] = $this->token;
        $data['from_date'] = $from_date;
        $data['end_date'] = $end_date;
        $data['sales_ar'] = $sales_ar;
        $data['kode_langganan'] = $kode_langganan;

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
        $this->load->view('pages/tagihan_klik3', $data);
        $this->load->view('_layout/footer');
    }

    public function nota($nomor_nota)
    {
        $data['title'] = 'Detail Tagihan Nota';
        $data['token'] = $this->token;
        $data['nomor_nota'] = $nomor_nota;

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
        $this->load->view('pages/tagihan_klik4', $data);
        $this->load->view('_layout/footer');
    }

    function export_pdf_klik2($from_date = null, $end_date = null, $kode_ar = null, $sales_ar = null)
    {
        // load library
        $this->load->library('Pdf');
        $this->load->model('User_Model');
        $this->load->model('ACCARDAT_Model');

        // $from_date = '2020-07-01';
        // $end_date = date('Y-m-d');
        $sales_ar = $sales_ar == null || $sales_ar == 'null' ? null : $sales_ar;
        $kode_ar = $kode_ar == null || $kode_ar == 'null' ? '' : $kode_ar;

        if ($sales_ar == 'custom') {
            $get = $this->User_Model->getPermissionSalesAR($this->user_id);
            $sales_ar = [];
            $sales_ar[] = $this->sales_ar;
            foreach ($get as $g) {
                $sales_ar[] = $g->sales_ar;
            }

            if (count($sales_ar) < 1) {
                $sales_ar = 'KATAPANDA';
            }
        }

        $tagihan = $this->ACCARDAT_Model->get_tagihan_klik2_custom_export($from_date, $end_date, $sales_ar, $kode_ar)->result();

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetPrintHeader(false);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->SetFont('helvetica', '', $pdf->pixelsToUnits('25'));
        $pdf->SetTitle('Tagihan-' . date('d-m-Y', strtotime($end_date)));
        $pdf->SetTopMargin(15);
        // $pdf->setFooterMargin(20);
        // $pdf->SetAutoPageBreak(true);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(255, 255, 255);
        $pdf->SetLineWidth(0);
        $pdf->SetAuthor('Katapanda');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->AddPage();

        $pdf->SetFont('helvetica', 'B', $pdf->pixelsToUnits('27'));
        $header = array('No.Nota', 'Tgl.Nota', 'Jenis Nota', 'Sales', 'Hari', 'Jumlah', 'Jenis', 'Catatan');
        $w = array(15, 30, 25, 15, 15, 20, 25, 40);

        // $num_headers = count($header);
        // for ($i = 0; $i < $num_headers; ++$i) {
        //     $pdf->Cell($w[$i], 2, $header[$i], 1, 0, 'C', 1);
        // }
        $pdf->Cell(130, 2, 'Perincian Tagihan - Mesin', 1, 0, 'L', 1);
        $pdf->Cell(50, 2, 'Periode : ' . date('d/m/Y', strtotime($from_date)) . ' - ' . date('d/m/Y', strtotime($end_date)), 1, 0, 'L', 1);
        $pdf->Ln();
        $pdf->Cell(130, 2, 'Berdasarkan Langganan', 1, 0, 'L', 1);
        $pdf->Ln();
        $pdf->Ln();
        // $pdf->SetFillColor(224, 235, 255);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $fill = 0;
        $x = 0;
        $total = 0;
        $jml = count($tagihan);
        foreach ($tagihan as $data) {

            if ($x == 0) {
                $pdf->SetFont('helvetica', 'B', $pdf->pixelsToUnits('27'));
                $pdf->Cell(100, 2, $data->kode_langganan . '       ' . $data->nama_langganan . '       ' . $data->nomor_telepon, 1, 0, 'L', 1);
                $pdf->Ln();
                $pdf->Cell($w[0], 2, $header[0], 1, 0, 'C', 1);
                $pdf->Cell($w[1], 2, $header[1], 1, 0, 'C', 1);
                $pdf->Cell($w[2], 2, $header[2], 1, 0, 'C', 1);
                $pdf->Cell($w[3], 2, $header[3], 1, 0, 'C', 1);
                $pdf->Cell($w[4], 2, $header[4], 1, 0, 'C', 1);
                $pdf->Cell($w[5], 2, $header[5], 1, 0, 'R', 1);
                $pdf->Cell($w[6], 2, $header[6], 1, 0, 'C', 1);
                $pdf->Cell($w[7], 2, $header[7], 1, 0, 'C', 1);
                $pdf->Ln();
            }

            if ($x > 0) {
                if ($tagihan[$x]->kode_langganan != $tagihan[$x - 1]->kode_langganan) {
                    $pdf->SetFont('helvetica', 'B', $pdf->pixelsToUnits('27'));
                    $pdf->Cell(100, 6, '', 'LR', 0, 'C', $fill);
                    $pdf->Cell(20, 6, number_format($total, 0, ',', '.'), 'LR', 0, 'R', $fill);
                    $pdf->Ln();
                    $pdf->Cell(100, 2, $data->kode_langganan . '       ' . $data->nama_langganan . '       ' . $data->nomor_telepon, 1, 0, 'L', 1);
                    $pdf->Ln();
                    $pdf->Cell($w[0], 2, $header[0], 1, 0, 'C', 1);
                    $pdf->Cell($w[1], 2, $header[1], 1, 0, 'C', 1);
                    $pdf->Cell($w[2], 2, $header[2], 1, 0, 'C', 1);
                    $pdf->Cell($w[3], 2, $header[3], 1, 0, 'C', 1);
                    $pdf->Cell($w[4], 2, $header[4], 1, 0, 'C', 1);
                    $pdf->Cell($w[5], 2, $header[5], 1, 0, 'R', 1);
                    $pdf->Cell($w[6], 2, $header[6], 1, 0, 'C', 1);
                    $pdf->Cell($w[7], 2, $header[7], 1, 0, 'C', 1);
                    $pdf->Ln();

                    $total = 0;
                }
            }

            // $hari = date_diff(date_create($data->tanggal_nota), date_create($end_date));
            $hari = date_diff(date_create($data->tanggal_nota), date_create(date('Y-m-d')));

            $pdf->SetFont('helvetica', '', $pdf->pixelsToUnits('25'));
            $pdf->Cell($w[0], 6, $data->nomor_nota, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[1], 6, date('d/m/Y', strtotime($data->tanggal_nota)), 'LR', 0, 'C', $fill);
            $pdf->Cell($w[2], 6, $data->jenis_nota, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[3], 6, $data->sales_ar, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[4], 6, $hari->format("%r%a"), 'LR', 0, 'C', $fill);
            $pdf->Cell($w[5], 6, number_format($data->jumlah, 0, ',', '.'), 'LR', 0, 'R', $fill);
            $pdf->Cell($w[6], 6, $data->waktu_ar == 7 ? 'CASH NETTO' : 'HUTANG', 'LR', 0, 'C', $fill);
            $pdf->Cell($w[7], 6, '', 'LR', 0, 'C', $fill);
            $pdf->Ln();
            $fill = !$fill;

            $total = $total + $data->jumlah;

            if ($x == $jml - 1) {
                $pdf->SetFont('helvetica', 'B', $pdf->pixelsToUnits('27'));
                $pdf->Cell(100, 6, '', 'LR', 0, 'C', $fill);
                $pdf->Cell(20, 6, number_format($total, 0, ',', '.'), 'LR', 0, 'R', $fill);
            }

            $x++;
        }

        // $pdf->writeHTML($html, true, false, false, false, '');
        $pdf->Output('Tagihan-' . date('d-m-Y', strtotime($end_date)) . '.pdf', 'I');
    }

    function export_pdf_klik3($kode_ar = null, $sales_ar = null, $from_date = null, $end_date = null)
    {
        // load library
        $this->load->library('Pdf');
        $this->load->model('User_Model');
        $this->load->model('ACCARDAT_Model');
        $this->load->model('ACCDLGN_Model');

        $langganan = $this->ACCDLGN_Model->get($kode_ar)->row();
        $tagihan = $this->ACCARDAT_Model->get_tagihan_klik3_custom_export($kode_ar, $sales_ar, $from_date, $end_date)->result();

        // Tentukan subject nama perusahaan dari kode langganan
        $code = substr($kode_ar, -1);
        if ($code == '0') {
            $subject = 'CAHAYA MATAHARI';
        } else if ($code == '2') {
            $subject = 'PT. CAHAYA MATAHARI PRIMA';
        } else if ($code == '3' || $code == '4' || $code == '5') {
            $subject = 'PT. KARYA LOGISTIK';
        } else {
            $subject = 'PT. CAHAYA MATAHARI PRIMA';
        }

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Katapanda');
        $pdf->SetTitle('Tanda Terima-' . $kode_ar);
        $pdf->SetSubject($subject);
        $pdf->SetKeywords('Tanda Terima, PDF, Detail, Langganan');

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetPrintHeader(false);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->SetFont('courier', '', $pdf->pixelsToUnits('25'));
        $pdf->SetTopMargin(15);
        // $pdf->setFooterMargin(20);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $pdf->SetDrawColor(255, 255, 255);
        $pdf->SetLineWidth(0);
        $pdf->SetDisplayMode('real', 'default');
        $pdf->AddPage('P', 'A4');

        // =============================== START HEADER ================================
        // get current vertical position
        $y = $pdf->getY();

        // Tentukan header nama perusahaan dari kode langganan
        if ($code == '0') {
            $data_perusahaan = '<b style="font-size: 15px">CAHAYA MATAHARI</b><br/>
            Jalan Sukarjowiryopranoto NO 5<br/>
            Jakarta Barat, 11160';
        } else if ($code == '2') {
            $data_perusahaan = '<b style="font-size: 15px">PT. CAHAYA MATAHARI PRIMA</b><br/>
            No. NPWP : 02.860.734.9-032-000<br/>
            No. PKP : 02.860.734.9-032-000<br/>
            No. Pengukuhan : PEM-00014/WPJ.05/KP.0303/2009<br/>
            Tanggal : 05 Januari 2009';
        } else if ($code == '3' || $code == '4' || $code == '5') {
            $data_perusahaan = '<b style="font-size: 15px">PT. KARYA LOGISTIK</b><br/>
            No. NPWP : 02.423.630.9.415.000<br/>
            No. PKP : 02.423.630.9.415.000<br/>
            No. Pengukuhan : PEM-00276/WPJ.08/KP.0703/2013<br/>
            Tanggal : 12 Febuari 2013';
        } else {
            $data_perusahaan = '<b style="font-size: 15px">PT. CAHAYA MATAHARI PRIMA</b><br/>
            No. NPWP : 02.860.734.9-032-000<br/>
            No. PKP : 02.860.734.9-032-000<br/>
            No. Pengukuhan : PEM-00014/WPJ.05/KP.0303/2009<br/>
            Tanggal : 05 Januari 2009';
        }

        $data_langganan = '<b style="font-size: 12px">Nomor : _______________________</b><br/>
        <font size="10px">Kepada Yth :<br/>
        <b>' . strtoupper($langganan->nama_toko) . '<br/>
        ' . strtoupper($langganan->alamat) . '<br/>
        ' . strtoupper($langganan->kota) . '<br/>
        ' . strtoupper($langganan->telepon) . '
        </b></font>';

        // write the first column
        $pdf->writeHTMLCell(100, '', '', $y, $data_perusahaan, 1, 0, 1, true, 'L', true);

        // write the second column
        $pdf->writeHTMLCell(100, '', '', '', $data_langganan, 1, 1, 1, true, 'J', true);

        // reset pointer to the last page
        $pdf->lastPage();

        // =============================== END HEADER ================================

        // =============================== START CONTENT ==============================
        // $pdf->Ln();
        $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('43'));
        $pdf->Cell(180, 2, 'TANDA TERIMA', 1, 0, 'C', 1);

        $pdf->SetFont('courier', '', $pdf->pixelsToUnits('25'));
        $pdf->Ln();
        $pdf->Cell(180, 2, 'Bersama dengan ini kami lampirkan nota-nota untuk diperiksa dan diproses sebagai pembayaran', 1, 0, 'C', 1);
        $pdf->Ln();

        $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
        $line = '______________________________________________________________________________________<br/>';
        $pdf->writeHTML($line, true, false, false, false, '');
        $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('28'));
        $header = array('No.', 'Tanggal', '', 'Nomor Faktur', '', 'Jumlah', 'Keterangan');
        $w = array(10, 35, 10, 30, 5, 30, 40);
        $num_headers = count($header);
        for ($i = 0; $i < $num_headers; ++$i) {
            $pdf->Cell($w[$i], 2, $header[$i], 1, 0, 'C', 1);
        }
        $pdf->Ln();
        $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
        $pdf->writeHTML($line, true, false, false, false, '');

        // $pdf->SetFillColor(224, 235, 255);
        $pdf->SetFillColor(255, 255, 255);
        $pdf->SetTextColor(0);
        $fill = 0;
        $point = 1;;
        $x = 0;
        $total = 0;
        $jml = count($tagihan);
        foreach ($tagihan as $data) {

            $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
            $pdf->Cell($w[0], 6, $x + 1, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[1], 6, $this->tgl_indo($data->tanggal_nota), 'LR', 0, 'C', $fill);
            $pdf->Cell($w[2], 6, 'Nota', 'LR', 0, 'R', $fill);
            $pdf->Cell($w[3], 6, $data->nomor_nota, 'LR', 0, 'C', $fill);
            $pdf->Cell($w[4], 6, 'Rp', 'LR', 0, 'C', $fill);
            $pdf->Cell($w[5], 6, number_format($data->nilai_nota, 0, ',', '.'), 'LR', 0, 'R', $fill);
            $pdf->Cell($w[6], 6, '', 'LR', 0, 'C', $fill);
            $pdf->Ln();
            $fill = !$fill;

            $total = $total + $data->nilai_nota;

            if ($x == $jml - 1) {
                $pdf->writeHTML($line, true, false, false, false, '');
                $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('30'));
                $pdf->Cell(85, 6, 'Total :', 'LR', 0, 'R', $fill);
                $pdf->Cell(5, 6, 'Rp', 'LR', 0, 'C', $fill);
                $pdf->Cell(30, 6, number_format($total, 0, ',', '.'), 'LR', 0, 'R', $fill);
            }

            if ($x == (21 * $point)) {
                $point++;
                // ============================ START FOOTER ====================================
                $y1 = $pdf->SetY(-90);
                $w1 = array(50, 75, 50);
                $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('25'));
                $pdf->Cell(180, 6, 'Keterangan', 'LR', $y1, 'L', '');
                $pdf->Ln();
                $pdf->SetFont('courier', '', $pdf->pixelsToUnits('25'));
                $pdf->Cell(180, 6, '1. Pembayaran tagihan dengan cash maksimal Rp.1.000.000,-');
                $pdf->Ln();
                $pdf->Cell(180, 6, '2. Faktur Asli akan kami kirimkan setelah pembayaran efektif masuk dalam rekening kami.', 'LR', $y1, 'L', '');
                $pdf->Ln();
                $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('28'));
                $pdf->Cell(180, 6, 'Tanggal ' . $this->tgl_indo_full(date('Y-m-d', strtotime($this->time_server))), 'LR', $y1, 'R', '');
                $pdf->Ln();
                $pdf->Cell($w1[0], 6, 'Diterima Oleh,', 'LR', $y1, 'C', '');
                $pdf->Cell($w1[1], 6, 'Pembayaran Via Transfer :', 'LR', $y1, 'C', '');
                $pdf->Cell($w1[2], 6, 'Hormat Kami,', 'LR', $y1, 'C', '');
                $pdf->Ln();

                // Tentukan footer nama perusahaan dari kode langganan
                if ($code == '0') {
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, 'DIVISI MESIN', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Ln();
                    $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, 'BANK BCA, Cab. Pecenongan', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Ln();
                    $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('28'));
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, '589-020-1212', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Ln();
                    $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, 'PT. Cahaya Matahari Prima', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                } else if ($code == '2') {
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, 'DIVISI MESIN', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Ln();
                    $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, 'BANK BCA, Cab. Sawah Besar', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Ln();
                    $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('28'));
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, '284-000-8811', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Ln();
                    $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, 'PT. Cahaya Matahari Prima', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                } else if ($code == '3' || $code == '4' || $code == '5') {
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, 'DIVISI MESIN', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Ln();
                    $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, 'BANK BCA, Cab. Sawah Besar', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Ln();
                    $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('28'));
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, '284-300-7660', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Ln();
                    $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, 'PT. Karya Logistik', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                } else {
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, 'DIVISI SPAREPARTS', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Ln();
                    $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, 'BANK BCA, Cab. Sawah Besar', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Ln();
                    $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('28'));
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, '284-000-8811', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Ln();
                    $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
                    $pdf->Cell($w1[0], 6, '', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[1], 6, 'PT. Cahaya Matahari Prima', 'LR', $y1, 'C', '');
                    $pdf->Cell($w1[2], 6, '', 'LR', $y1, 'C', '');
                }

                $pdf->Ln();
                $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('28'));
                $pdf->Cell($w1[0], 6, '____________________', 'LR', $y1, 'C', '');
                $pdf->Cell($w1[1], 6, '', 'LR', $y1, 'C', '');
                $pdf->Cell($w1[2], 6, '____________________', 'LR', $y1, 'C', '');
                $pdf->Ln();

                // ============================ END FOOTER =========================
                for ($z = 0; $z < (30 - $x); $z++) {
                    $pdf->Ln();
                }
                $pdf->SetFont('courier', '', $pdf->pixelsToUnits('25'));
                // write the first column
                $pdf->writeHTMLCell(100, '', '', '', $data_perusahaan, 1, 0, 1, true, 'L', true);

                // write the second column
                $pdf->writeHTMLCell(100, '', '', '', $data_langganan, 1, 1, 1, true, 'J', true);
                $pdf->lastPage();

                $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('43'));
                $pdf->SetFont('courier', '', $pdf->pixelsToUnits('25'));
                $pdf->Cell(180, 2, '', 1, 0, 'C', 1);
                $pdf->Ln();
                $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('43'));
                $pdf->Cell(180, 2, 'TANDA TERIMA', 1, 0, 'C', 1);

                $pdf->SetFont('courier', '', $pdf->pixelsToUnits('25'));
                $pdf->Ln();
                $pdf->Cell(180, 2, 'Bersama dengan ini kami lampirkan nota-nota untuk diperiksa dan diproses sebagai pembayaran', 1, 0, 'C', 1);
                $pdf->Ln();


                $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
                $line = '______________________________________________________________________________________<br/>';
                $pdf->writeHTML($line, true, false, false, false, '');
                $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('28'));
                for ($v = 0; $v < $num_headers; ++$v) {
                    $pdf->Cell($w[$v], 2, $header[$v], 1, 0, 'C', 1);
                }
                $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
                $pdf->writeHTML($line, true, false, false, false, '');
            }

            // if ($x == 19) {
            //     $pdf->Ln();
            //     $pdf->Ln();
            //     $pdf->Ln();
            //     $pdf->Ln();
            //     $pdf->Ln();
            // }

            $x++;
        }
        // =============================== END CONTENT ================================

        // =============================== START FOOTER ================================
        $y = $pdf->SetY(-90);

        $w = array(50, 75, 50);
        $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('25'));
        $pdf->Cell(180, 6, 'Keterangan', 'LR', $y, 'L', '');
        $pdf->Ln();
        $pdf->SetFont('courier', '', $pdf->pixelsToUnits('25'));
        $pdf->Cell(180, 6, '1. Pembayaran tagihan dengan cash maksimal Rp.1.000.000,-');
        $pdf->Ln();
        $pdf->Cell(180, 6, '2. Faktur Asli akan kami kirimkan setelah pembayaran efektif masuk dalam rekening kami.', 'LR', $y, 'L', '');

        $pdf->Ln();
        $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('28'));
        $pdf->Cell(180, 6, 'Tanggal ' . $this->tgl_indo_full(date('Y-m-d', strtotime($this->time_server))), 'LR', $y, 'R', '');
        $pdf->Ln();
        $pdf->Cell($w[0], 6, 'Diterima Oleh,', 'LR', $y, 'C', '');
        $pdf->Cell($w[1], 6, 'Pembayaran Via Transfer :', 'LR', $y, 'C', '');
        $pdf->Cell($w[2], 6, 'Hormat Kami,', 'LR', $y, 'C', '');
        $pdf->Ln();

        // Tentukan footer nama perusahaan dari kode langganan
        if ($code == '0') {
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, 'DIVISI MESIN', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
            $pdf->Ln();
            $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, 'BANK BCA, Cab. Pecenongan', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
            $pdf->Ln();
            $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('28'));
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, '589-020-1212', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
            $pdf->Ln();
            $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, 'PT. Cahaya Matahari Prima', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
        } else if ($code == '2') {
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, 'DIVISI MESIN', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
            $pdf->Ln();
            $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, 'BANK BCA, Cab. Sawah Besar', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
            $pdf->Ln();
            $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('28'));
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, '284-000-8811', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
            $pdf->Ln();
            $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, 'PT. Cahaya Matahari Prima', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
        } else if ($code == '3' || $code == '4' || $code == '5') {
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, 'DIVISI MESIN', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
            $pdf->Ln();
            $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, 'BANK BCA, Cab. Sawah Besar', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
            $pdf->Ln();
            $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('28'));
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, '284-300-7660', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
            $pdf->Ln();
            $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, 'PT. Karya Logistik', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
        } else {
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, 'DIVISI SPAREPARTS', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
            $pdf->Ln();
            $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, 'BANK BCA, Cab. Sawah Besar', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
            $pdf->Ln();
            $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('28'));
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, '284-000-8811', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
            $pdf->Ln();
            $pdf->SetFont('courier', '', $pdf->pixelsToUnits('28'));
            $pdf->Cell($w[0], 6, '', 'LR', $y, 'C', '');
            $pdf->Cell($w[1], 6, 'PT. Cahaya Matahari Prima', 'LR', $y, 'C', '');
            $pdf->Cell($w[2], 6, '', 'LR', $y, 'C', '');
        }

        $pdf->Ln();
        $pdf->SetFont('courier', 'B', $pdf->pixelsToUnits('28'));
        $pdf->Cell($w[0], 6, '____________________', 'LR', $y, 'C', '');
        $pdf->Cell($w[1], 6, '', 'LR', $y, 'C', '');
        $pdf->Cell($w[2], 6, '____________________', 'LR', $y, 'C', '');
        $pdf->Ln();

        // =============================== END FOOTER ================================

        $pdf->Output('Tanda Terima-' . $kode_ar . '.pdf', 'I');
    }

    function export_pdf_klik21($from_date = null, $end_date = null, $sales_ar = null, $kode_ar = null)
    {
        // load library
        $this->load->library('Pdf');
        $this->load->model('User_Model');
        $this->load->model('ACCARDAT_Model');

        // $from_date = '2020-07-01';
        // $end_date = '2020-09-16';
        $sales_ar = $sales_ar == null || $sales_ar == 'null' ? null : $sales_ar;
        $kode_ar = $kode_ar == null || $kode_ar == 'null' ? '' : $kode_ar;

        if ($sales_ar == 'custom') {
            $get = $this->User_Model->getPermissionSalesAR($this->user_id);
            $sales_ar = [];
            $sales_ar[] = $this->sales_ar;
            foreach ($get as $g) {
                $sales_ar[] = $g->sales_ar;
            }

            if (count($sales_ar) < 1) {
                $sales_ar = 'KATAPANDA';
            }
        }

        $tagihan = $this->ACCARDAT_Model->get_tagihan_klik2_custom_export($from_date, $end_date, $sales_ar, $kode_ar)->result();

        $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set header and footer fonts
        $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
        $pdf->SetPrintHeader(false);
        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        $pdf->SetFont('helvetica', '', $pdf->pixelsToUnits('25'));
        $pdf->SetTitle('Contoh');
        $pdf->SetTopMargin(20);
        // $pdf->setFooterMargin(20);
        // $pdf->SetAutoPageBreak(true);
        $pdf->SetAuthor('Katapanda');
        $pdf->SetDisplayMode('real', 'default');
        $pdf->AddPage();

        // $html = '<h3>Daftar Produk</h3>
        // <table cellspacing="1" bgcolor="#666666" cellpadding="2">
        //     <tr bgcolor="#ffffff">
        //         <th width="5%" align="center">No</th>
        //         <th width="35%" align="center">Nama Produk</th>
        //         <th width="45%" align="center">Deskripsi</th>
        //         <th width="15%" align="center">Harga</th>
        //     </tr>';
        $html = '<table cellspacing="0" cellpadding="1" border="0">
        <tr style="font-weight: bolder; font-size: 9px; margin-bottom: 50px">
            <th align="left" colspan="2">Perincian Tagihan - Mesin Berdasarkan Langganan</th>
            <th align="left" colspan="3"></th>
            <th align="left" colspan="2">Periode : ' . date('d-m-Y', strtotime($from_date)) . ' - ' . date('d-m-Y', strtotime($end_date)) . '</th>
        </tr>
        <tr bgcolor="#ffffff"><th colspan="7"></th></tr>';
        $i = 0;
        foreach ($tagihan as $data) {

            if ($i == 0) {
                $html .= '<tr style="font-weight: bolder; border-top: 1px black solid">
                        <th align="left" colspan="7">' . $data->kode_langganan . ' ' . $data->nama_langganan . ' ' . $data->nomor_telepon . '</th>
                    </tr>';
                $html .= '<tr style="font-weight: bolder">
                            <th align="left" width="14%">No.Nota</th>
                            <th align="left" width="14%">Tgl.Nota</th>
                            <th align="center" width="14%">Jenis Nota</th>
                            <th align="center" width="7%">Sales</th>
                            <th align="center" width="7%">Hari</th>
                            <th align="right" width="14%">Jumlah</th>
                            <th align="center" width="30%">Catatan</th>
                        </tr>';
            } else {
                if ($tagihan[$i]->kode_langganan != $tagihan[$i - 1]->kode_langganan) {

                    $html .= '<tr style="font-weight: bolder;">
                    <th align="left" colspan="7">' . $data->kode_langganan . ' (' . $data->nama_langganan . ' ' . $data->nomor_telepon . ')</th>
                    </tr>';

                    $html .= '<tr style="font-weight: bolder">
                            <th align="left" width="14%">No.Nota</th>
                            <th align="left" width="14%">Tgl.Nota</th>
                            <th align="center" width="14%">Jenis Nota</th>
                            <th align="center" width="7%">Sales</th>
                            <th align="center" width="7%">Hari</th>
                            <th align="right" width="14%">Jumlah</th>
                            <th align="center" width="30%">Catatan</th>
                        </tr>';
                }
            }

            $html .= '<tr bgcolor="#ffffff">
                        <td align="left">' . $data->nomor_nota . '</td>
                        <td align="left">' . date('d-m-Y', strtotime($data->tanggal_nota)) . '</td>
                        <td align="center">' . $data->jenis_nota . '</td>
                        <td align="center">' . $data->sales_ar . '</td>
                        <td align="center">' . $data->hari . '</td>
                        <td align="right">' . number_format($data->jumlah, 0, ',', '.')  . '</td>
                        <td align="center"></td>
                    </tr>';

            $i++;
        }

        $html .= '</table>';

        $pdf->writeHTML($html, true, false, false, false, '');
        $pdf->Output('contoh1.pdf', 'I');
    }

    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . '-' . $bulan[(int)$pecahkan[1]] . '-' . $pecahkan[0];
    }

    function tgl_indo_full($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
    }
}

/* End of file ACCARDAT.php */
