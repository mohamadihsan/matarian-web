<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_Model extends CI_Model {

    // data tagihan
    public function get_tagihan($param = null)
    {
        $this->db->where('tbl_accardat.tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        $this->db->order_by('tanggal_ar', 'asc');
        
        if ($param != null) {
            $this->db->where('id', $param);
        }
        
        return $this->db->get('tbl_accardat');
    }

    // count tagihan
    public function count_tagihan($user, $sales_ar)
    {
        if ($user == "1") {
            $sales_ar = null;
        }
        $this->db->where('tbl_accardat.tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));
        $this->db->select('kode_ar');
        $this->db->group_by('kode_ar');
        
        if ($sales_ar != null || $sales_ar != '') {
            $this->db->where('sales_ar', $sales_ar);
        }
        
        return $this->db->get('tbl_accardat')->num_rows();
    }

    // total tagihan
    public function total_tagihan($user, $sales_ar)
    {
        if ($user == "1") {
            $sales_ar = null;
        }
        $this->db->where('tbl_accardat.tanggal_lunas', '1980/01/01');
        $this->db->where_in('tbl_accardat.ref_ar', array('JUAL', 'BAYAR', 'LEBIH'));    
        $this->db->select_sum('sisa_ar');
        if ($sales_ar != null || $sales_ar != '') {
            $this->db->where('sales_ar', $sales_ar);
        }
        
        return $this->db->get('tbl_accardat');
    }

    // total penjualan
    public function total_penjualan($date)
    {
        $this->db->where("DATE_FORMAT(tanggal_bon,'%Y-%m')", $date);
        $this->db->select_sum('prf_barang');
        
        return $this->db->get('tbl_accarbon');
    }

    // best buyer
    public function best_buyer($year, $month, $limit, $sales_ar)
    {
        if ($year != null && $month != null) {
            $date = $year.'-'.$month;
            $this->db->where("DATE_FORMAT(tanggal_bon,'%Y-%m')", date('Y-m', strtotime($date)));
        } else if ($year != null && $month == null) {
            $this->db->where("DATE_FORMAT(tanggal_bon,'%Y')", date('Y', strtotime($year)));
        } else if ($year == null && $month != null) {
            $this->db->where("DATE_FORMAT(tanggal_bon,'%m')", date('m', strtotime($month)));
        }

        if ($sales_ar != null || $sales_ar != '') {
            $this->db->where('dat.sales_ar', $sales_ar);
        }

        $this->db->select('ta.kode_langganan, lgn.nama_toko, COUNT(ta.kode_langganan) as total_transaction, SUM(prf_barang) as total_purchase');
        $this->db->join('tbl_accdlgn lgn', 'lgn.kode_langganan = ta.kode_langganan', 'left');
        $this->db->join('tbl_accardat dat', 'dat.nomor_nota = ta.nomor_bon', 'left');
        $this->db->group_by('ta.kode_langganan');
        $this->db->having('SUM(prf_barang) >',  0);
        $this->db->order_by('total_purchase', 'desc');
        if ($limit > 0) {
            $this->db->limit($limit);
        }
        
        return $this->db->get('tbl_accarbon ta');
    }

    // best seller
    public function best_seller($year, $month, $limit, $sales_ar)
    {
        if ($year != null && $month != null) {
            $date = $year.'-'.$month;
            $this->db->where("DATE_FORMAT(ta.tanggal_bon,'%Y-%m')", date('Y-m', strtotime($date)));
        } else if ($year != null && $month == null) {
            $this->db->where("DATE_FORMAT(ta.tanggal_bon,'%Y')", date('Y', strtotime($year)));
        } else if ($year == null && $month != null) {
            $this->db->where("DATE_FORMAT(ta.tanggal_bon,'%m')", date('m', strtotime($month)));
        }
        
        if ($sales_ar != null || $sales_ar != '') {
            $this->db->where('dat.sales_ar', $sales_ar);
        }

        $this->db->select('ta.kode_barang, br.nama_barang, COUNT(ta.kode_barang) as quantity, SUM(ta.prf_barang) as total_purchase');
        $this->db->join('tbl_accdbrg br', 'br.kode_barang = ta.kode_barang', 'left');
        $this->db->join('tbl_accardat dat', 'dat.nomor_nota = ta.nomor_bon', 'left');
        $this->db->group_by('ta.kode_barang');
        $this->db->having('SUM(ta.prf_barang) >',  0);
        $this->db->order_by('quantity', 'desc');
        if ($limit > 0) {
            $this->db->limit($limit);
        }
        
        return $this->db->get('tbl_accarbon ta');
    }

    // user login today
    public function user_login($limit)
    {
        $this->db->distinct();
        $this->db->where('CAST(tbl_login.login_at AS DATE) = CAST(now() AS DATE)');
        
        $this->db->where('tbl_login.logout_at', NULL);
        $this->db->select("
            tbl_user.fullname, 
            tbl_user.email, 
            tbl_login.ip_address_var, 
            CASE
                WHEN tbl_login.device_type LIKE '%Mobile%' THEN 'Mobile'
                WHEN tbl_login.device_type LIKE '%Windows%' THEN 'PC, Desktop, Laptop'
                ELSE 'Other Device'
            END as device_type, 
            MAX(tbl_login.login_at) as login_at, 
            tbl_user_group.user_group_name, 
            tbl_login.logout_at"
        );
        $this->db->join('tbl_user', 'tbl_login.user_id = tbl_user.id', 'left');
        $this->db->join('tbl_user_group', 'tbl_user_group.id = tbl_user.id_user_group', 'left');
        $this->db->group_by('tbl_user.fullname, tbl_user.email, device_type, tbl_user_group.user_group_name');
        $this->db->order_by('tbl_login.login_at', 'desc');
        $this->db->order_by('tbl_user.fullname', 'asc');
        if ($limit > 0) {
            $this->db->limit($limit);
        }
        
        return $this->db->get('tbl_login');
    }

    // last update tagihan
    public function last_update_tagihan()
    {
        $this->db->select_max('created_at');
        return $this->db->get('tbl_accardat');
    }

    // count KTP
    public function count_ktp($param = null)
    {
        
        $this->db->where('deleted_at', null);
        if ($param != null) {
            $this->db->where('id', $param);
        }
        
        return $this->db->get('tbl_master_ktp')->num_rows();
    }

    // last update KTP
    public function last_update_ktp()
    {
        $this->db->select_max('created_at');
        $this->db->where('deleted_at', null);

        return $this->db->get('tbl_master_ktp');
    }

    // count NPWP
    public function count_npwp($param = null)
    {
        
        $this->db->where('deleted_at', null);
        if ($param != null) {
            $this->db->where('id', $param);
        }
        
        return $this->db->get('tbl_master_npwp')->num_rows();
    }

    // last update NPWP
    public function last_update_npwp()
    {
        $this->db->select_max('created_at');
        $this->db->where('deleted_at', null);

        return $this->db->get('tbl_master_npwp');
    }

    // count accdbrg
    public function count_accdbrg($param = null)
    {
        if ($param != null) {
            $this->db->where('id', $param);
        }
        
        return $this->db->get('tbl_accdbrg')->num_rows();
    }

    // last update accdbrg
    public function last_update_accdbrg()
    {
        $this->db->select_max('created_at');
        return $this->db->get('tbl_accdbrg');
    }
    
    // count accdlgn
    public function count_accdlgn($param = null)
    {
        if ($param != null) {
            $this->db->where('id', $param);
        }
        
        return $this->db->get('tbl_accdlgn')->num_rows();
    }

    // last update accdlgn
    public function last_update_accdlgn()
    {
        $this->db->select_max('created_at');
        return $this->db->get('tbl_accdlgn');
    }

    // count accarbon
    public function count_accarbon($param = null)
    {
        if ($param != null) {
            $this->db->where('id', $param);
        }
        
        return $this->db->get('tbl_accarbon')->num_rows();
    }

    // last update accarbon
    public function last_update_accarbon()
    {
        $this->db->select_max('created_at');
        return $this->db->get('tbl_accarbon');
    }
    
    // count accardat
    public function count_accardat($param = null)
    {
        if ($param != null) {
            $this->db->where('id', $param);
        }
        
        return $this->db->get('tbl_accardat')->num_rows();
    }

    // last update accardat
    public function last_update_accardat()
    {
        $this->db->select_max('created_at');
        return $this->db->get('tbl_accardat');
    }

    // count pending activation
    public function count_pending_activation($param = null)
    {
        
        $this->db->where('deleted_at', null);
        $this->db->where('activation_status', null);
        if ($param != null) {
            $this->db->where('id', $param);
        }
        
        return $this->db->get('tbl_user')->num_rows();
    }

    // last update
    public function last_update_pending_activation()
    {
        $this->db->select_max('created_at');
        $this->db->where('deleted_at', null);

        return $this->db->get('tbl_user');
    }

}

/* End of file Dashboard_Model.php */
