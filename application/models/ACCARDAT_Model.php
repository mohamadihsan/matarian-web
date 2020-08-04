<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class ACCARDAT_Model extends CI_Model {

    // get all
    public function get($user = null, $id = null)
    {
        $this->db->order_by('tanggal_ar', 'asc');
        
        if ($user != null) {
            $this->db->where('sales_ar', $user);
        }
        if ($id != null) {
            $this->db->where('id', $id);
        }
        
        return $this->db->get('tbl_accardat');
    }

    // count all
    public function count($user = null, $id = null)
    {   
        if ($user != null) {
            $this->db->where('sales_ar', $user);
        }
        if ($id != null) {
            $this->db->where('id', $id);
        }
        
        return $this->db->get('tbl_accardat')->num_rows();
    }

    // last update
    public function last_update()
    {
        $this->db->select_max('created_at');

        return $this->db->get('tbl_accardat');
    }

    // data tagihan
    public function get_tagihan($user, $id)
    {
        $this->db->where('tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        // $this->db->where('sales_ar IS NOT NULL');
        $this->db->order_by('tanggal_ar', 'asc');
        
        if ($user != null) {
            $this->db->where('sales_ar', $user);
        }
        if ($id != null) {
            $this->db->where('id', $id);
        }
        
        return $this->db->get('tbl_accardat');
    }

    // data tagihan klik 2
    public function get_tagihan_klik2($from_date, $end_date, $sales_ar, $kode_ar)
    {
        $this->db->where('tbl_accardat.tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        if ($from_date != '' && $end_date != '') {
            $this->db->where("tbl_accardat.tanggal_ar BETWEEN '".$from_date."' AND '".$end_date."'");
        }
        if ($sales_ar != '') {
            $this->db->where('tbl_accardat.sales_ar', $sales_ar);
        }
        if ($kode_ar != '') {
            $this->db->where('tbl_accardat.kode_ar', $kode_ar);
        }
        // $this->db->where('tbl_accardat.sales_ar IS NOT NULL');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accardat.kode_ar', 'left');
        $this->db->select('tbl_accardat.kode_ar, tbl_accdlgn.nama_toko, tbl_accdlgn.kota, COUNT(tbl_accardat.kode_ar) as jumlah_nota, SUM(tbl_accardat.sisa_ar*-1) as total_tagihan');
        $this->db->group_by('tbl_accardat.kode_ar');
        
        $this->db->order_by('tbl_accardat.kode_ar', 'asc');
        $this->db->order_by('tbl_accardat.tanggal_ar', 'asc');
        
        return $this->db->get('tbl_accardat');
    }

    // data tagihan klik 2 pagination
    public function get_tagihan_klik2_pagination($from_date, $end_date, $sales_ar, $kode_ar, $search, $page, $per_page)
    {
        $this->db->where('tbl_accardat.tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        if ($from_date != '' && $end_date != '') {
            $this->db->where("tbl_accardat.tanggal_ar BETWEEN '".$from_date."' AND '".$end_date."'");
        }
        if ($sales_ar != '') {
            $this->db->where('tbl_accardat.sales_ar', $sales_ar);
        }
        if ($kode_ar != '') {
            $this->db->where('tbl_accardat.kode_ar', $kode_ar);
        }
        if ($search != '') {
            $this->db->where("(tbl_accardat.kode_ar LIKE '%$search%' OR tbl_accdlgn.nama_toko LIKE '%$search%' OR tbl_accdlgn.kota LIKE '%$search%') AND tbl_accardat.tanggal_lunas = '1980/01/01' AND tbl_accardat.ref_ar IN ('JUAL', 'BAYAR', 'LEBIH')");
            
            // $this->db->like('tbl_accardat.kode_ar', $search);
            // $this->db->or_like('tbl_accdlgn.nama_toko', $search);
            // $this->db->or_like('tbl_accdlgn.kota', $search);
        }
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }
        // $this->db->where('tbl_accardat.sales_ar IS NOT NULL');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accardat.kode_ar', 'left');
        $this->db->select('tbl_accardat.kode_ar, tbl_accdlgn.nama_toko, tbl_accdlgn.kota, COUNT(tbl_accardat.kode_ar) as jumlah_nota, SUM(tbl_accardat.sisa_ar*-1) as total_tagihan');
        $this->db->group_by('tbl_accardat.kode_ar');
        
        $this->db->order_by('tbl_accardat.kode_ar', 'asc');
        $this->db->order_by('tbl_accardat.tanggal_ar', 'asc');
        
        return $this->db->get('tbl_accardat');
    }

    // count data tagihan klik 2 pagination
    public function count_get_tagihan_klik2_pagination($from_date, $end_date, $sales_ar, $kode_ar, $search)
    {
        $this->db->where('tbl_accardat.tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        if ($from_date != '' && $end_date != '') {
            $this->db->where("tbl_accardat.tanggal_ar BETWEEN '".$from_date."' AND '".$end_date."'");
        }
        if ($sales_ar != '') {
            $this->db->where('tbl_accardat.sales_ar', $sales_ar);
        }
        if ($kode_ar != '') {
            $this->db->where('tbl_accardat.kode_ar', $kode_ar);
        }
        if ($search != '') {
            $this->db->where("(tbl_accardat.kode_ar LIKE '%$search%' OR tbl_accdlgn.nama_toko LIKE '%$search%' OR tbl_accdlgn.kota LIKE '%$search%') AND tbl_accardat.tanggal_lunas = '1980/01/01' AND tbl_accardat.ref_ar IN ('JUAL', 'BAYAR', 'LEBIH')");

            // $this->db->like('tbl_accardat.kode_ar', $search);
            // $this->db->or_like('tbl_accdlgn.nama_toko', $search);
            // $this->db->or_like('tbl_accdlgn.kota', $search);
        }
        // $this->db->where('tbl_accardat.sales_ar IS NOT NULL');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accardat.kode_ar', 'left');
        $this->db->select('tbl_accardat.kode_ar, tbl_accdlgn.nama_toko, tbl_accdlgn.kota, COUNT(tbl_accardat.kode_ar) as jumlah_nota, SUM(tbl_accardat.sisa_ar*-1) as total_tagihan');
        $this->db->group_by('tbl_accardat.kode_ar');
        
        $this->db->order_by('tbl_accardat.kode_ar', 'asc');
        $this->db->order_by('tbl_accardat.tanggal_ar', 'asc');
        
        return $this->db->get('tbl_accardat')->num_rows();
    }

    // data tagihan klik 3
    public function get_tagihan_klik3($from_date, $end_date, $kode_ar, $sales_ar)
    {
        $this->db->where('tbl_accardat.tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        if ($from_date != '' && $end_date != '') {
            $this->db->where("tbl_accardat.tanggal_ar BETWEEN '".$from_date."' AND '".$end_date."'");
        }
        if ($kode_ar != '') {
            $this->db->where('tbl_accardat.kode_ar', $kode_ar);
        }
        if ($sales_ar != 'ALL') {
            $this->db->where('tbl_accardat.sales_ar', $sales_ar);
        }
        // $this->db->where('tbl_accardat.sales_ar IS NOT NULL');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accardat.kode_ar', 'left');
        $this->db->select('tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.kota as alamat_langganan, tbl_accardat.tanggal_ar as tanggal_nota, tbl_accardat.nomor_nota, CAST((tbl_accardat.jumlah_ar/1.1*-1) AS UNSIGNED) as dpp, CAST((tbl_accardat.jumlah_ar/1.1*-1)*0.1 AS UNSIGNED) as ppn, (jumlah_ar*-1) as nilai_nota');
        $this->db->order_by('tbl_accardat.tanggal_ar', 'asc');
        $this->db->order_by('SUBSTRING(tbl_accardat.nomor_nota, 3,6)', FALSE, 'asc');
        
        return $this->db->get('tbl_accardat');
    }

    // data tagihan klik 3
    public function get_tagihan_klik3_pagination($from_date, $end_date, $kode_ar, $search, $page, $per_page)
    {
        $this->db->where('tbl_accardat.tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        if ($from_date != '' && $end_date != '') {
            $this->db->where("tbl_accardat.tanggal_ar BETWEEN '".$from_date."' AND '".$end_date."'");
        }
        if ($kode_ar != '') {
            $this->db->where('tbl_accardat.kode_ar', $kode_ar);
        }
        if ($search != '') {
            $this->db->where("(tbl_accardat.nomor_nota LIKE '%$search%' OR tbl_accardat.tanggal_ar LIKE '%$search%') AND tbl_accardat.tanggal_lunas = '1980/01/01' AND tbl_accardat.ref_ar IN ('JUAL', 'BAYAR', 'LEBIH')");

            // $this->db->like('tbl_accardat.nomor_nota', $search);
            // $this->db->or_like('tbl_accardat.tanggal_ar', $search);
        }
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }
        // $this->db->where('tbl_accardat.sales_ar IS NOT NULL');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accardat.kode_ar', 'left');
        $this->db->select('tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.kota as alamat_langganan, tbl_accardat.tanggal_ar as tanggal_nota, tbl_accardat.nomor_nota, CAST((tbl_accardat.jumlah_ar/1.1*-1) AS UNSIGNED) as dpp, CAST((tbl_accardat.jumlah_ar/1.1*-1)*0.1  AS UNSIGNED) as ppn, (jumlah_ar*-1) as nilai_nota');
        $this->db->order_by('SUBSTRING(tbl_accardat.nomor_nota, 3,6)', FALSE, 'asc');
        
        return $this->db->get('tbl_accardat');
    }

    // count data tagihan klik 3
    public function count_get_tagihan_klik3_pagination($from_date, $end_date, $kode_ar, $search)
    {
        $this->db->where('tbl_accardat.tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        if ($from_date != '' && $end_date != '') {
            $this->db->where("tbl_accardat.tanggal_ar BETWEEN '".$from_date."' AND '".$end_date."'");
        }
        if ($kode_ar != '') {
            $this->db->where('tbl_accardat.kode_ar', $kode_ar);
        }
        if ($search != '') {
            $this->db->where("(tbl_accardat.nomor_nota LIKE '%$search%' OR tbl_accardat.tanggal_ar LIKE '%$search%') AND tbl_accardat.tanggal_lunas = '1980/01/01' AND tbl_accardat.ref_ar IN ('JUAL', 'BAYAR', 'LEBIH')");

            // $this->db->like('tbl_accardat.nomor_nota', $search);
            // $this->db->or_like('tbl_accardat.tanggal_ar', $search);
        }
        // $this->db->where('tbl_accardat.sales_ar IS NOT NULL');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accardat.kode_ar', 'left');
        $this->db->select('tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.kota as alamat_langganan, tbl_accardat.tanggal_ar as tanggal_nota, tbl_accardat.nomor_nota, CAST((tbl_accardat.jumlah_ar/1.1*-1) AS UNSIGNED) as dpp, CAST((tbl_accardat.jumlah_ar/1.1*-1)*0.1  AS UNSIGNED) as ppn, (jumlah_ar*-1) as nilai_nota');
        $this->db->order_by('tbl_accardat.tanggal_ar', 'asc');
        
        return $this->db->get('tbl_accardat')->num_rows();
    }

    // data tagihan klik 4
    public function get_tagihan_klik4($nomor_nota)
    {
        $this->db->where('tbl_accardat.tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        if ($nomor_nota != '') {
            $this->db->where('tbl_accarbon.nomor_bon', $nomor_nota);
        }
        $this->db->where('tbl_accardat.sales_ar IS NOT NULL');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accardat.kode_ar', 'left');
        $this->db->join('tbl_accarbon', 'tbl_accarbon.nomor_bon = tbl_accardat.nomor_nota', 'left');
        $this->db->join('tbl_accdbrg', 'tbl_accdbrg.kode_barang = tbl_accarbon.kode_barang', 'left');
        $this->db->select('tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.npwp_langganan, tbl_accdlgn.kota as alamat_langganan, tbl_accarbon.nomor_bon as nomor_nota, tbl_accarbon.tanggal_bon as tanggal_nota, tbl_accdbrg.kode_barang, tbl_accdbrg.nama_barang, tbl_accarbon.banyak_barang as quantity, tbl_accarbon.harga_barang as harga_satuan, (tbl_accarbon.banyak_barang * tbl_accarbon.harga_barang) as jumlah');
        $this->db->order_by('tbl_accardat.tanggal_ar', 'desc');
        
        return $this->db->get('tbl_accardat');
    }

    // data tagihan klik 4
    public function get_tagihan_klik4_pagination($nomor_nota, $search, $page, $per_page)
    {
        $this->db->where('tbl_accardat.tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        if ($nomor_nota != '') {
            $this->db->where('tbl_accarbon.nomor_bon', $nomor_nota);
        }
        if ($search != '') {
            $this->db->like('tbl_accdbrg.nama_barang', $search);
        }
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }
        $this->db->where('tbl_accardat.sales_ar IS NOT NULL');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accardat.kode_ar', 'left');
        $this->db->join('tbl_accarbon', 'tbl_accarbon.nomor_bon = tbl_accardat.nomor_nota', 'left');
        $this->db->join('tbl_accdbrg', 'tbl_accdbrg.kode_barang = tbl_accarbon.kode_barang', 'left');
        $this->db->select('tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.npwp_langganan, tbl_accdlgn.kota as alamat_langganan, tbl_accarbon.nomor_bon as nomor_nota, tbl_accarbon.tanggal_bon as tanggal_nota, tbl_accdbrg.kode_barang, tbl_accdbrg.nama_barang, tbl_accarbon.banyak_barang as quantity, tbl_accarbon.harga_barang as harga_satuan, (tbl_accarbon.banyak_barang * tbl_accarbon.harga_barang) as jumlah');
        $this->db->order_by('tbl_accardat.tanggal_ar', 'desc');
        
        return $this->db->get('tbl_accardat');
    }

    // count data tagihan klik 4
    public function count_get_tagihan_klik4_pagination($nomor_nota, $search)
    {
        $this->db->where('tbl_accardat.tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        if ($nomor_nota != '') {
            $this->db->where('tbl_accarbon.nomor_bon', $nomor_nota);
        }
        if ($search != '') {
            $this->db->like('tbl_accdbrg.nama_barang', $search);
        }
        $this->db->where('tbl_accardat.sales_ar IS NOT NULL');
        $this->db->join('tbl_accdlgn', 'tbl_accdlgn.kode_langganan = tbl_accardat.kode_ar', 'left');
        $this->db->join('tbl_accarbon', 'tbl_accarbon.nomor_bon = tbl_accardat.nomor_nota', 'left');
        $this->db->join('tbl_accdbrg', 'tbl_accdbrg.kode_barang = tbl_accarbon.kode_barang', 'left');
        $this->db->select('tbl_accdlgn.nama_toko as nama_langganan, tbl_accdlgn.npwp_langganan, tbl_accdlgn.kota as alamat_langganan, tbl_accarbon.nomor_bon as nomor_nota, tbl_accarbon.tanggal_bon as tanggal_nota, tbl_accdbrg.kode_barang, tbl_accdbrg.nama_barang, tbl_accarbon.banyak_barang as quantity, tbl_accarbon.harga_barang as harga_satuan, (tbl_accarbon.banyak_barang * tbl_accarbon.harga_barang) as jumlah');
        $this->db->order_by('tbl_accardat.tanggal_ar', 'desc');
        
        return $this->db->get('tbl_accardat')->num_rows();
    }

    // data tagihan user
    public function get_tagihan_user($sales_ar)
    {
        $this->db->where('tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        // $this->db->where('sales_ar IS NOT NULL');
        $this->db->select('id, kode_ar, sales_ar');
        
        // $this->db->select('sales_ar');
        $this->db->group_by('sales_ar');
        $this->db->order_by('sales_ar', 'asc');
        
        if ($sales_ar != null || $sales_ar != '') {
            $this->db->where('sales_ar', $sales_ar);
        }
        
        return $this->db->get('tbl_accardat');
    }

    // pagination
    public function pagination($page, $per_page)
    {
        $this->db->order_by('tanggal_ar', 'asc');
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }
        
        return $this->db->get('tbl_accardat');
    }

    // pagination
    public function tagihan_pagination($page, $per_page, $sales_ar, $search)
    {
        $this->db->where('tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        $this->db->order_by('tanggal_ar', 'asc');
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }
        if ($sales_ar != null || $sales_ar != '') {
            $this->db->where('sales_ar', $sales_ar);
        }
        if ($search != '') {
            $this->db->where("(tbl_accardat.kode_ar LIKE '%$search%' OR tbl_accdlgn.nama_toko LIKE '%$search%' OR tbl_accdlgn.kota LIKE '%$search%') AND tbl_accardat.tanggal_lunas = '1980/01/01' AND tbl_accardat.ref_ar IN ('JUAL', 'BAYAR', 'LEBIH')");

            // $this->db->like('tbl_accardat.kode_ar', $search);
            // $this->db->or_like('tbl_accdlgn.nama_toko', $search);
            // $this->db->or_like('tbl_accdlgn.kota', $search);
        }
        
        return $this->db->get('tbl_accardat');
    }

    // count tagihan
    public function count_tagihan($user = null, $id = null)
    {
        $this->db->where('tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        
        if ($user != null) {
            $this->db->where('sales_ar', $user);
        }
        if ($id != null) {
            $this->db->where('id', $id);
        }
        
        return $this->db->get('tbl_accardat')->num_rows();
    }

    // total tagihan
    public function total_tagihan($user = null, $id = null)
    {
        $this->db->where('tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        $this->db->select_sum('sisa_ar');

        if ($user != null) {
            $this->db->where('sales_ar', $user);
        }
        if ($id != null) {
            $this->db->where('id', $id);
        }
        
        return $this->db->get('tbl_accardat');
    }


}

/* End of file ACCARDAT_Model.php */
