<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ACCARBON_Model extends CI_Model
{

    // get
    public function get($param = null)
    {

        $this->db->select('id, nik, nama, tempat_lahir, tgl_lahir, alamat, rt, rw, kelurahan, kecamatan, kabupaten, provinsi, kodepos, jenis_kelamin, golongan_darah, status_perkawinan, agama, pekerjaan, kewarganegaraan');
        $this->db->where('deleted_at', null);
        $this->db->order_by('nama', 'asc');

        if ($param != null) {
            $this->db->where('id', $param);
        }

        return $this->db->get('tbl_accarbon');
    }

    // num row
    public function count($param = null)
    {
        if ($param != null) {
            $this->db->where('id', $param);
        }

        return $this->db->get('tbl_accarbon')->num_rows();
    }

    public function count_pagination($from_date, $end_date, $kode_langganan, $kode_barang, $sales_ar)
    {
        if ($from_date != '' && $end_date != '') {
            if ($from_date == $end_date) {
                $this->db->where('tbl_accarbon.tanggal_bon', $from_date);
            } else {
                $this->db->where("tbl_accarbon.tanggal_bon BETWEEN '" . $from_date . "' AND '" . $end_date . "'");
            }
        }
        if ($kode_langganan != '') {
            $this->db->where('tbl_accarbon.kode_langganan', $kode_langganan);
        }
        if ($kode_barang != '') {
            $this->db->where('tbl_accarbon.kode_barang', $kode_barang);
        }
        if ($sales_ar != null) {
            $this->db->where('tbl_accardat.sales_ar', $sales_ar);
        }

        $this->db->join('tbl_accardat', 'tbl_accardat.nomor_nota = tbl_accarbon.nomor_bon', 'left');
        return $this->db->get('tbl_accarbon')->num_rows();
    }

    // last update
    public function last_update()
    {
        $this->db->select_max('created_at');

        return $this->db->get('tbl_accarbon');
    }

    // pagination
    public function pagination($year, $month, $page, $per_page)
    {
        if ($year != null && $month != null) {
            $date = $year . '-' . $month;
            $this->db->where("DATE_FORMAT(tanggal_bon,'%Y-%m')", $date);
        } else if ($year != null && $month == null) {
            $this->db->where("DATE_FORMAT(tanggal_bon,'%Y')", $year);
        } else if ($year == null && $month != null) {
            $this->db->where("DATE_FORMAT(tanggal_bon,'%m')", $month);
        }

        $this->db->select('ta.tanggal_bon, ta.nomor_bon, ta.kode_langganan, lgn.nama_toko, ta.kode_barang, br.nama_barang, ta.banyak_barang, ta.prf_barang, ta.ppn, ta.ppn, ta.nomor_od');
        $this->db->join('tbl_accdbrg br', 'br.kode_barang = ta.kode_barang', 'left');
        $this->db->join('tbl_accdlgn lgn', 'lgn.kode_langganan = ta.kode_langganan', 'left');

        $this->db->group_by('ta.kode_barang');
        $this->db->order_by('tanggal_bon', 'desc');
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }

        return $this->db->get('tbl_accarbon ta');
    }

    // get sales
    public function get_sales($from_date, $end_date, $kode_langganan, $kode_barang, $sales_ar)
    {
        if ($from_date != '' && $end_date != '') {
            if ($from_date == $end_date) {
                $this->db->where('tbl_accarbon.tanggal_bon', $from_date);
            } else {
                $this->db->where("tbl_accarbon.tanggal_bon BETWEEN '" . $from_date . "' AND '" . $end_date . "'");
            }
        }
        if ($kode_langganan != '') {
            $this->db->where('tbl_accarbon.kode_langganan', $kode_langganan);
        }
        if ($kode_barang != '') {
            $this->db->where('tbl_accarbon.kode_barang', $kode_barang);
        }
        if ($sales_ar != null) {
            // $this->db->where_in('tbl_accardat.sales_ar', $sales_ar);
        }
        $this->db->group_by('tbl_accarbon.nomor_bon, tbl_accarbon.tanggal_bon, tbl_accdlgn.kode_langganan, tbl_accarbon.kode_barang');
        // $this->db->select('GROUP_CONCAT(tbl_accarbon.nomor_bon) as nomor_nota, tbl_accarbon.tanggal_bon as tanggal_nota, tbl_accdlgn.kode_langganan, tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.npwp_langganan, tbl_accdbrg.kode_barang, tbl_accdbrg.nama_barang, tbl_accdbrg.satuan, COUNT(tbl_accdbrg.kode_barang) as jumlah_transaksi, SUM(tbl_accarbon.banyak_barang) as quantity, tbl_accarbon.harga_barang as harga_satuan, (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang) as total');
        $this->db->select('tbl_accarbon.nomor_bon as nomor_nota, tbl_accarbon.tanggal_bon as tanggal_nota, tbl_accdlgn.kode_langganan, tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.npwp_langganan, tbl_accdbrg.kode_barang, tbl_accdbrg.nama_barang, tbl_accdbrg.satuan, COUNT(tbl_accdbrg.kode_barang) as jumlah_transaksi, SUM(tbl_accarbon.banyak_barang) as quantity, tbl_accarbon.harga_barang as harga_satuan, (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang) as total');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accarbon.kode_langganan', 'left');
        $this->db->join('tbl_accdbrg', 'tbl_accdbrg.kode_barang = tbl_accarbon.kode_barang', 'left');
        $this->db->join('tbl_accardat', 'tbl_accardat.nomor_nota = tbl_accarbon.nomor_bon', 'left');
        $this->db->order_by('tbl_accarbon.tanggal_bon', 'asc');
        $this->db->order_by('SUBSTRING(tbl_accarbon.nomor_bon, 3,6)', FALSE, 'asc');
        return $this->db->get('tbl_accarbon');
    }

    // get sales by sales ar
    public function get_sales_by_sales_ar($from_date, $end_date, $sales_ar)
    {
        if ($from_date != '' && $end_date != '') {
            if ($from_date == $end_date) {
                $this->db->where('tbl_accarbon.tanggal_bon', $from_date);
            } else {
                $this->db->where("tbl_accarbon.tanggal_bon BETWEEN '" . $from_date . "' AND '" . $end_date . "'");
            }
        }
        if ($sales_ar != null) {
            $this->db->where_in('tbl_accardat.sales_ar', $sales_ar);
        }
        $this->db->where('tbl_accardat.sales_ar IS NOT NULL');
        $this->db->group_by('tbl_accardat.sales_ar, tbl_accdlgn.kode_langganan, tbl_accdlgn.nama_toko, tbl_accdlgn.kota, tbl_accarbon.nomor_bon, tbl_accarbon.tanggal_bon');
        // $this->db->select('tbl_accardat.sales_ar, tbl_accdlgn.kode_langganan, tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.kota, tbl_accarbon.nomor_bon as nomor_nota, tbl_accarbon.tanggal_bon as tanggal, CONVERT(SUM(tbl_accarbon.banyak_barang*tbl_accarbon.harga_barang) + (SUM(tbl_accarbon.banyak_barang*tbl_accarbon.harga_barang)*0.1), SIGNED) as nilai_faktur');
        $this->db->select('tbl_accardat.sales_ar, tbl_accdlgn.kode_langganan, tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.kota, tbl_accarbon.nomor_bon as nomor_nota, tbl_accarbon.tanggal_bon as tanggal, CONVERT(SUM(tbl_accarbon.banyak_barang*tbl_accarbon.harga_barang), SIGNED) as nilai_faktur');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accarbon.kode_langganan', 'left');
        $this->db->join('tbl_accdbrg', 'tbl_accdbrg.kode_barang = tbl_accarbon.kode_barang', 'left');
        $this->db->join('tbl_accardat', 'tbl_accardat.nomor_nota = tbl_accarbon.nomor_bon', 'left');
        $this->db->order_by('tbl_accarbon.tanggal_bon', 'asc');
        $this->db->order_by('SUBSTRING(tbl_accarbon.nomor_bon, 3,6)', FALSE, 'asc');

        return $this->db->get('tbl_accarbon');
    }

    // get sales
    public function get_sales_pagination($from_date, $end_date, $kode_langganan, $kode_barang, $page, $per_page, $sales_ar)
    {
        if ($from_date != '' && $end_date != '') {
            if ($from_date == $end_date) {
                $this->db->where('tbl_accarbon.tanggal_bon', $from_date);
            } else {
                $this->db->where("tbl_accarbon.tanggal_bon BETWEEN '" . $from_date . "' AND '" . $end_date . "'");
            }
        }
        if ($kode_langganan != '') {
            $this->db->where('tbl_accarbon.kode_langganan', $kode_langganan);
        }
        if ($kode_barang != '') {
            $this->db->where('tbl_accarbon.kode_barang', $kode_barang);
        }
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }
        if ($sales_ar != null) {
            $this->db->where('tbl_accardat.sales_ar', $sales_ar);
        }
        $this->db->group_by('tbl_accarbon.kode_barang, tbl_accarbon.kode_langganan');
        $this->db->select('GROUP_CONCAT(tbl_accarbon.nomor_bon) as nomor_nota, tbl_accarbon.tanggal_bon as tanggal_nota, tbl_accdlgn.kode_langganan, tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.npwp_langganan, tbl_accdbrg.kode_barang, tbl_accdbrg.nama_barang, tbl_accdbrg.satuan, COUNT(tbl_accdbrg.kode_barang) as jumlah_transaksi, SUM(tbl_accarbon.banyak_barang) as quantity, tbl_accarbon.harga_barang as harga_satuan, (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang) as total');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accarbon.kode_langganan', 'left');
        $this->db->join('tbl_accdbrg', 'tbl_accdbrg.kode_barang = tbl_accarbon.kode_barang', 'left');
        $this->db->join('tbl_accardat', 'tbl_accardat.nomor_nota = tbl_accarbon.nomor_bon', 'left');
        $this->db->order_by('SUBSTRING(tbl_accarbon.nomor_bon, 3,6)', FALSE, 'asc');
        return $this->db->get('tbl_accarbon');
    }

    // search langganan
    public function search_langganan_pagination($from_date, $end_date, $page, $per_page, $search)
    {
        if ($from_date != '' && $end_date != '') {
            if ($from_date == $end_date) {
                // $this->db->having('tbl_accarbon.tanggal_bon', $from_date);
                $this->db->where('tbl_accarbon.tanggal_bon', $from_date);
            } else {
                // $this->db->having("tbl_accarbon.tanggal_bon BETWEEN '".$from_date."' AND '".$end_date."'");
                $this->db->where("tbl_accarbon.tanggal_bon BETWEEN '" . $from_date . "' AND '" . $end_date . "'");
            }
        }
        if ($search != '') {
            $this->db->like('tbl_accdlgn.kode_langganan', $search);
            $this->db->or_like('tbl_accdlgn.nama_toko', $search);
        }
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }
        $this->db->group_by('tbl_accdlgn.kode_langganan');
        // $this->db->group_by('tbl_accarbon.nomor_bon, tbl_accarbon.tanggal_bon, tbl_accdlgn.kode_langganan, tbl_accarbon.kode_barang');
        $this->db->select('tbl_accarbon.tanggal_bon, tbl_accdlgn.kode_langganan, tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.npwp_langganan, tbl_accdlgn.kota, tbl_accarbon.harga_barang as harga_satuan, SUM(tbl_accarbon.banyak_barang) as quantity, (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang) as nilai_nota, CONVERT(SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang*0.1, SIGNED) as ppn, (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang + CONVERT(SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang*0.1, SIGNED)) as total');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accarbon.kode_langganan', 'left');
        $this->db->join('tbl_accdbrg', 'tbl_accdbrg.kode_barang = tbl_accarbon.kode_barang', 'left');
        $this->db->join('tbl_accardat', 'tbl_accardat.nomor_nota = tbl_accarbon.nomor_bon', 'left');
        $this->db->order_by('tbl_accdlgn.kode_langganan', 'asc');

        return $this->db->get('tbl_accarbon');
    }

    // count search langganan
    public function count_search_langganan($from_date, $end_date, $search)
    {
        if ($from_date != '' && $end_date != '') {
            if ($from_date == $end_date) {
                // $this->db->having('tbl_accarbon.tanggal_bon', $from_date);
                $this->db->where('tbl_accarbon.tanggal_bon', $from_date);
            } else {
                // $this->db->having("tbl_accarbon.tanggal_bon BETWEEN '".$from_date."' AND '".$end_date."'");
                $this->db->where("tbl_accarbon.tanggal_bon BETWEEN '" . $from_date . "' AND '" . $end_date . "'");
            }
        }
        if ($search != '') {
            $this->db->like('tbl_accdlgn.kode_langganan', $search);
            $this->db->or_like('tbl_accdlgn.nama_toko', $search);
        }
        $this->db->group_by('tbl_accdlgn.kode_langganan');
        // $this->db->group_by('tbl_accarbon.nomor_bon, tbl_accarbon.tanggal_bon, tbl_accdlgn.kode_langganan, tbl_accarbon.kode_barang');
        $this->db->select('tbl_accarbon.tanggal_bon, tbl_accdlgn.kode_langganan, tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.npwp_langganan, tbl_accarbon.harga_barang as harga_satuan, SUM(tbl_accarbon.banyak_barang) as quantity, (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang) as nilai_nota, CONVERT(SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang*0.1, SIGNED) as ppn, (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang + CONVERT(SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang*0.1, SIGNED)) as total');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accarbon.kode_langganan', 'left');
        $this->db->join('tbl_accdbrg', 'tbl_accdbrg.kode_barang = tbl_accarbon.kode_barang', 'left');
        $this->db->join('tbl_accardat', 'tbl_accardat.nomor_nota = tbl_accarbon.nomor_bon', 'left');
        $this->db->order_by('tbl_accdlgn.kode_langganan', 'asc');

        return $this->db->get('tbl_accarbon')->num_rows();
    }

    // search langganan
    public function search_langganan_detail_pagination($from_date, $end_date, $page, $per_page, $search, $kode_langganan)
    {
        if ($from_date != '' && $end_date != '') {
            if ($from_date == $end_date) {
                $this->db->having('tbl_accarbon.tanggal_bon', $from_date);
            } else {
                $this->db->having("tbl_accarbon.tanggal_bon BETWEEN '" . $from_date . "' AND '" . $end_date . "'");
            }
        }
        if ($search != '') {
            $this->db->like('tbl_accarbon.nomor_bon', $search);
            $this->db->or_like('tbl_accdbrg.kode_barang', $search);
            $this->db->or_like('tbl_accdbrg.nama_barang', $search);
        }
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }
        if ($kode_langganan != '') {
            $this->db->where('tbl_accarbon.kode_langganan', $kode_langganan);
        }
        $this->db->group_by('tbl_accarbon.nomor_bon, tbl_accarbon.tanggal_bon, tbl_accdlgn.kode_langganan, tbl_accarbon.kode_barang');
        $this->db->select('tbl_accarbon.nomor_bon as nomor_nota, tbl_accarbon.tanggal_bon as tanggal_nota, tbl_accdlgn.kode_langganan, tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.npwp_langganan, tbl_accdlgn.kota, tbl_accdbrg.kode_barang, tbl_accdbrg.nama_barang, tbl_accdbrg.satuan, SUM(tbl_accarbon.banyak_barang) as quantity, tbl_accarbon.harga_barang as harga_satuan, (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang) as nilai_nota, CONVERT(SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang*0.1, SIGNED) as ppn, CONVERT((SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang) + (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang*0.1), SIGNED) as total');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accarbon.kode_langganan', 'left');
        $this->db->join('tbl_accdbrg', 'tbl_accdbrg.kode_barang = tbl_accarbon.kode_barang', 'left');
        $this->db->join('tbl_accardat', 'tbl_accardat.nomor_nota = tbl_accarbon.nomor_bon', 'left');
        $this->db->order_by('tbl_accdbrg.kode_barang', 'asc');
        $this->db->order_by('SUBSTRING(tbl_accarbon.nomor_bon, 3,6)', FALSE, 'asc');

        return $this->db->get('tbl_accarbon');
    }

    // count search langganan
    public function count_search_langganan_detail($from_date, $end_date, $search, $kode_langganan)
    {
        if ($from_date != '' && $end_date != '') {
            if ($from_date == $end_date) {
                $this->db->having('tbl_accarbon.tanggal_bon', $from_date);
            } else {
                $this->db->having("tbl_accarbon.tanggal_bon BETWEEN '" . $from_date . "' AND '" . $end_date . "'");
            }
        }
        if ($search != '') {
            $this->db->like('tbl_accarbon.nomor_bon', $search);
            $this->db->or_like('tbl_accdbrg.kode_barang', $search);
            $this->db->or_like('tbl_accdbrg.nama_barang', $search);
        }
        if ($kode_langganan != '') {
            $this->db->where('tbl_accarbon.kode_langganan', $kode_langganan);
        }
        $this->db->group_by('tbl_accarbon.nomor_bon, tbl_accarbon.tanggal_bon, tbl_accdlgn.kode_langganan, tbl_accarbon.kode_barang');
        $this->db->select('tbl_accarbon.nomor_bon as nomor_nota, tbl_accarbon.tanggal_bon as tanggal_nota, tbl_accdlgn.kode_langganan, tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.npwp_langganan, tbl_accdlgn.kota, tbl_accdbrg.kode_barang, tbl_accdbrg.nama_barang, tbl_accdbrg.satuan, SUM(tbl_accarbon.banyak_barang) as quantity, tbl_accarbon.harga_barang as harga_satuan, (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang) as total');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accarbon.kode_langganan', 'left');
        $this->db->join('tbl_accdbrg', 'tbl_accdbrg.kode_barang = tbl_accarbon.kode_barang', 'left');
        $this->db->join('tbl_accardat', 'tbl_accardat.nomor_nota = tbl_accarbon.nomor_bon', 'left');
        $this->db->order_by('tbl_accdbrg.kode_barang', 'asc');
        $this->db->order_by('SUBSTRING(tbl_accarbon.nomor_bon, 3,6)', FALSE, 'asc');

        return $this->db->get('tbl_accarbon')->num_rows();
    }

    // search barang
    public function search_barang_pagination($from_date, $end_date, $page, $per_page, $search)
    {
        if ($from_date != '' && $end_date != '') {
            if ($from_date == $end_date) {
                // $this->db->having('tbl_accarbon.tanggal_bon', $from_date);
                $this->db->where('tbl_accarbon.tanggal_bon', $from_date);
            } else {
                // $this->db->having("tbl_accarbon.tanggal_bon BETWEEN '".$from_date."' AND '".$end_date."'");
                $this->db->where("tbl_accarbon.tanggal_bon BETWEEN '" . $from_date . "' AND '" . $end_date . "'");
            }
        }
        if ($search != '') {
            $this->db->like('tbl_accdbrg.kode_barang', $search);
            $this->db->or_like('tbl_accdbrg.nama_barang', $search);
        }
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }
        $this->db->group_by('tbl_accarbon.kode_barang');
        // $this->db->group_by('tbl_accarbon.nomor_bon, tbl_accarbon.tanggal_bon, tbl_accdlgn.kode_langganan, tbl_accarbon.kode_barang');
        $this->db->select('tbl_accarbon.tanggal_bon, tbl_accdbrg.kode_barang, tbl_accdbrg.nama_barang, tbl_accdbrg.satuan, SUM(tbl_accarbon.banyak_barang) as quantity, tbl_accarbon.harga_barang as harga_satuan, (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang) as nilai_nota, CONVERT(SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang*0.1, SIGNED) as ppn, SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang + CONVERT(SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang*0.1, SIGNED) as total');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accarbon.kode_langganan', 'left');
        $this->db->join('tbl_accdbrg', 'tbl_accdbrg.kode_barang = tbl_accarbon.kode_barang', 'left');
        $this->db->join('tbl_accardat', 'tbl_accardat.nomor_nota = tbl_accarbon.nomor_bon', 'left');
        $this->db->order_by('tbl_accdbrg.kode_barang', 'asc');

        return $this->db->get('tbl_accarbon');
    }

    // count search barang
    public function count_search_barang($from_date, $end_date, $search)
    {
        if ($from_date != '' && $end_date != '') {
            if ($from_date == $end_date) {
                // $this->db->having('tbl_accarbon.tanggal_bon', $from_date);
                $this->db->where('tbl_accarbon.tanggal_bon', $from_date);
            } else {
                // $this->db->having("tbl_accarbon.tanggal_bon BETWEEN '".$from_date."' AND '".$end_date."'");
                $this->db->where("tbl_accarbon.tanggal_bon BETWEEN '" . $from_date . "' AND '" . $end_date . "'");
            }
        }
        if ($search != '') {
            $this->db->like('tbl_accdbrg.kode_barang', $search);
            $this->db->or_like('tbl_accdbrg.nama_barang', $search);
        }

        $this->db->group_by('tbl_accarbon.kode_barang');
        // $this->db->group_by('tbl_accarbon.nomor_bon, tbl_accarbon.tanggal_bon, tbl_accdlgn.kode_langganan, tbl_accarbon.kode_barang');
        $this->db->select('tbl_accarbon.tanggal_bon, tbl_accdbrg.kode_barang, tbl_accdbrg.nama_barang, tbl_accdbrg.satuan, SUM(tbl_accarbon.banyak_barang) as quantity, tbl_accarbon.harga_barang as harga_satuan, (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang) as nilai_nota, CONVERT(SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang*0.1, SIGNED) as ppn, SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang + CONVERT(SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang*0.1, SIGNED) as total');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accarbon.kode_langganan', 'left');
        $this->db->join('tbl_accdbrg', 'tbl_accdbrg.kode_barang = tbl_accarbon.kode_barang', 'left');
        $this->db->join('tbl_accardat', 'tbl_accardat.nomor_nota = tbl_accarbon.nomor_bon', 'left');
        $this->db->order_by('tbl_accdbrg.kode_barang', 'asc');

        return $this->db->get('tbl_accarbon')->num_rows();
    }

    public function search_barang_detail_pagination($from_date, $end_date, $page, $per_page, $search, $kode_barang)
    {
        if ($from_date != '' && $end_date != '') {
            if ($from_date == $end_date) {
                $this->db->having('tbl_accarbon.tanggal_bon', $from_date);
            } else {
                $this->db->having("tbl_accarbon.tanggal_bon BETWEEN '" . $from_date . "' AND '" . $end_date . "'");
            }
        }
        if ($search != '') {
            $this->db->like('tbl_accdlgn.kode_langganan', $search);
            $this->db->or_like('tbl_accdlgn.nama_toko', $search);
        }
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }
        if ($kode_barang != '') {
            $this->db->where('tbl_accdbrg.kode_barang', $kode_barang);
        }
        $this->db->group_by('tbl_accarbon.nomor_bon, tbl_accarbon.tanggal_bon, tbl_accdlgn.kode_langganan, tbl_accarbon.kode_barang');
        $this->db->select('tbl_accarbon.nomor_bon as nomor_nota, tbl_accarbon.tanggal_bon as tanggal_nota, tbl_accdlgn.kode_langganan, tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.npwp_langganan, tbl_accdbrg.kode_barang, tbl_accdbrg.nama_barang, tbl_accdbrg.satuan, SUM(tbl_accarbon.banyak_barang) as quantity, tbl_accarbon.harga_barang as harga_satuan, (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang) as nilai_nota, CONVERT(SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang*0.1, SIGNED) as ppn, (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang) +  CONVERT(SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang*0.1, SIGNED) as total');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accarbon.kode_langganan', 'left');
        $this->db->join('tbl_accdbrg', 'tbl_accdbrg.kode_barang = tbl_accarbon.kode_barang', 'left');
        $this->db->join('tbl_accardat', 'tbl_accardat.nomor_nota = tbl_accarbon.nomor_bon', 'left');
        $this->db->order_by('tbl_accdlgn.kode_langganan', 'asc');
        $this->db->order_by('SUBSTRING(tbl_accarbon.nomor_bon, 3,6)', FALSE, 'asc');

        return $this->db->get('tbl_accarbon');
    }

    // count search barang
    public function count_search_barang_detail($from_date, $end_date, $search, $kode_barang)
    {
        if ($from_date != '' && $end_date != '') {
            if ($from_date == $end_date) {
                $this->db->having('tbl_accarbon.tanggal_bon', $from_date);
            } else {
                $this->db->having("tbl_accarbon.tanggal_bon BETWEEN '" . $from_date . "' AND '" . $end_date . "'");
            }
        }
        if ($search != '') {
            $this->db->like('tbl_accdlgn.kode_langganan', $search);
            $this->db->or_like('tbl_accdlgn.nama_toko', $search);
        }
        if ($kode_barang != '') {
            $this->db->where('tbl_accdbrg.kode_barang', $kode_barang);
        }
        $this->db->group_by('tbl_accarbon.nomor_bon, tbl_accarbon.tanggal_bon, tbl_accdlgn.kode_langganan, tbl_accarbon.kode_barang');
        $this->db->select('tbl_accarbon.nomor_bon as nomor_nota, tbl_accarbon.tanggal_bon as tanggal_nota, tbl_accdlgn.kode_langganan, tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.npwp_langganan, tbl_accdbrg.kode_barang, tbl_accdbrg.nama_barang, tbl_accdbrg.satuan, COUNT(tbl_accdbrg.kode_barang) as jumlah_transaksi, SUM(tbl_accarbon.banyak_barang) as quantity, tbl_accarbon.harga_barang as harga_satuan, (SUM(tbl_accarbon.banyak_barang)*tbl_accarbon.harga_barang) as total');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accarbon.kode_langganan', 'left');
        $this->db->join('tbl_accdbrg', 'tbl_accdbrg.kode_barang = tbl_accarbon.kode_barang', 'left');
        $this->db->join('tbl_accardat', 'tbl_accardat.nomor_nota = tbl_accarbon.nomor_bon', 'left');
        $this->db->order_by('tbl_accdlgn.kode_langganan', 'asc');
        $this->db->order_by('SUBSTRING(tbl_accarbon.nomor_bon, 3,6)', FALSE, 'asc');

        return $this->db->get('tbl_accarbon')->num_rows();
    }
}

/* End of file ACCARBON_Model.php */
