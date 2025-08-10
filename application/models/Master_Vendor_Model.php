<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Master_Vendor_Model extends CI_Model
{

    // get
    public function get($param = null)
    {

        $this->db->select('
            tbl_master_vendor.id,
            tbl_master_vendor.nama,
            tbl_master_vendor.new_npwp,
            tbl_master_vendor.npwp,
            tbl_master_vendor.nitku,
            tbl_master_vendor.nitku_digit,
            tbl_master_vendor.email,
            tbl_master_vendor.alamat,
            tbl_master_vendor.nomor,
            tbl_master_vendor.blok,
            tbl_master_vendor.rt,
            tbl_master_vendor.rw,
            tbl_master_vendor.kelurahan,
            tbl_master_vendor.kecamatan,
            tbl_master_vendor.kabupaten,
            tbl_master_vendor.provinsi,
            tbl_master_vendor.kodepos,
            tbl_unifikasi_kode_objek_pajak.id as unifikasi_kode_objek_pajak_id,
            tbl_unifikasi_kode_objek_pajak.kode as unifikasi_kode_objek_pajak_kode,
            tbl_unifikasi_kode_objek_pajak.nama as unifikasi_kode_objek_pajak_nama,
            tbl_master_vendor.cek,
            tbl_master_vendor.status,
            tbl_master_vendor.created_by,
            tbl_master_vendor.created_at,
            tbl_master_vendor.updated_by,
            tbl_master_vendor.updated_at');
        $this->db->join('tbl_unifikasi_kode_objek_pajak', 'tbl_unifikasi_kode_objek_pajak.id = tbl_master_vendor.unifikasi_kode_objek_pajak_id', 'left');
        $this->db->order_by('tbl_master_vendor.nama', 'asc');
        if ($param != null) {
            $this->db->where('tbl_master_vendor.id', $param);
        }

        return $this->db->get('tbl_master_vendor');
    }

    // num row
    public function count($param = null)
    {
        if ($param != null) {
            $this->db->where('id', $param);
        }

        return $this->db->get('tbl_master_vendor')->num_rows();
    }

    // last update
    public function last_update()
    {
        $this->db->select_max('created_at');

        return $this->db->get('tbl_master_vendor');
    }

    // pagination
    public function pagination($page, $per_page, $search = null)
    {
        $this->db->select('
            tbl_master_vendor.id,
            tbl_master_vendor.nama,
            tbl_master_vendor.new_npwp,
            tbl_master_vendor.npwp,
            tbl_master_vendor.nitku,
            tbl_master_vendor.nitku_digit,
            tbl_master_vendor.email,
            tbl_master_vendor.alamat,
            tbl_master_vendor.nomor,
            tbl_master_vendor.blok,
            tbl_master_vendor.rt,
            tbl_master_vendor.rw,
            tbl_master_vendor.kelurahan,
            tbl_master_vendor.kecamatan,
            tbl_master_vendor.kabupaten,
            tbl_master_vendor.provinsi,
            tbl_master_vendor.kodepos,
            tbl_unifikasi_kode_objek_pajak.id as unifikasi_kode_objek_pajak_id,
            tbl_unifikasi_kode_objek_pajak.kode as unifikasi_kode_objek_pajak_kode,
            tbl_unifikasi_kode_objek_pajak.nama as unifikasi_kode_objek_pajak_nama,
            tbl_master_vendor.cek,
            tbl_master_vendor.status,
            tbl_master_vendor.created_by,
            tbl_master_vendor.created_at,
            tbl_master_vendor.updated_by,
            tbl_master_vendor.updated_at');
        $this->db->join('tbl_unifikasi_kode_objek_pajak', 'tbl_unifikasi_kode_objek_pajak.id = tbl_master_vendor.unifikasi_kode_objek_pajak_id', 'left');
        
        if ($search != null) {
            $this->db->like('tbl_master_vendor.new_npwp', $search);
            $this->db->or_like('tbl_master_vendor.npwp', $search);
            $this->db->or_like('tbl_master_vendor.nama', $search);
            $this->db->or_like('tbl_master_vendor.nitku', $search);
            $this->db->or_like('tbl_unifikasi_kode_objek_pajak.kode', $search);
        }
        $this->db->order_by('tbl_master_vendor.nama', 'asc');
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }

        return $this->db->get('tbl_master_vendor');
    }

    // count pagination
    public function count_pagination($search = null)
    {
        $this->db->select('
            tbl_master_vendor.id,
            tbl_master_vendor.nama,
            tbl_master_vendor.new_npwp,
            tbl_master_vendor.npwp,
            tbl_master_vendor.nitku,
            tbl_master_vendor.nitku_digit,
            tbl_master_vendor.email,
            tbl_master_vendor.alamat,
            tbl_master_vendor.nomor,
            tbl_master_vendor.blok,
            tbl_master_vendor.rt,
            tbl_master_vendor.rw,
            tbl_master_vendor.kelurahan,
            tbl_master_vendor.kecamatan,
            tbl_master_vendor.kabupaten,
            tbl_master_vendor.provinsi,
            tbl_master_vendor.kodepos,
            tbl_unifikasi_kode_objek_pajak.id as unifikasi_kode_objek_pajak_id,
            tbl_unifikasi_kode_objek_pajak.kode as unifikasi_kode_objek_pajak_kode,
            tbl_unifikasi_kode_objek_pajak.nama as unifikasi_kode_objek_pajak_nama,
            tbl_master_vendor.cek,
            tbl_master_vendor.status,
            tbl_master_vendor.created_by,
            tbl_master_vendor.created_at,
            tbl_master_vendor.updated_by,
            tbl_master_vendor.updated_at');
        $this->db->join('tbl_unifikasi_kode_objek_pajak', 'tbl_unifikasi_kode_objek_pajak.id = tbl_master_vendor.unifikasi_kode_objek_pajak_id', 'left');

        if ($search != null) {
            $this->db->like('tbl_master_vendor.new_npwp', $search);
            $this->db->or_like('tbl_master_vendor.npwp', $search);
            $this->db->or_like('tbl_master_vendor.nama', $search);
            $this->db->or_like('tbl_master_vendor.nitku', $search);
            $this->db->or_like('tbl_unifikasi_kode_objek_pajak.kode', $search);
        }
        $this->db->order_by('tbl_master_vendor.nama', 'asc');

        return $this->db->get('tbl_master_vendor')->num_rows();
    }

    // insert new data
    public function insert($data)
    {
        $this->db->insert('tbl_master_vendor', $data);
        return $this->db->insert_id();
    }

    // update
    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_master_vendor', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    // delete
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_master_vendor');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    public function check_npwp($npwp, $nama_vendor)
    {
        $this->db->select('
            tbl_master_vendor.id,
            tbl_master_vendor.nama,
            tbl_master_vendor.new_npwp,
            tbl_master_vendor.npwp,
            tbl_master_vendor.nitku,
            tbl_master_vendor.nitku_digit,
            tbl_master_vendor.email,
            tbl_master_vendor.alamat,
            tbl_master_vendor.nomor,
            tbl_master_vendor.blok,
            tbl_master_vendor.rt,
            tbl_master_vendor.rw,
            tbl_master_vendor.kelurahan,
            tbl_master_vendor.kecamatan,
            tbl_master_vendor.kabupaten,
            tbl_master_vendor.provinsi,
            tbl_master_vendor.kodepos,
            tbl_unifikasi_kode_objek_pajak.id as unifikasi_kode_objek_pajak_id,
            tbl_unifikasi_kode_objek_pajak.kode as unifikasi_kode_objek_pajak_kode,
            tbl_unifikasi_kode_objek_pajak.nama as unifikasi_kode_objek_pajak_nama,
            tbl_master_vendor.cek,
            tbl_master_vendor.status,
            tbl_master_vendor.created_by,
            tbl_master_vendor.created_at,
            tbl_master_vendor.updated_by,
            tbl_master_vendor.updated_at');
        $this->db->join('tbl_unifikasi_kode_objek_pajak', 'tbl_unifikasi_kode_objek_pajak.id = tbl_master_vendor.unifikasi_kode_objek_pajak_id', 'left');
        $this->db->order_by('tbl_master_vendor.nama', 'asc');
        $this->db->where('tbl_master_vendor.new_npwp', $npwp);
        if (!empty($nama_vendor)) {
            $this->db->where('UPPER(tbl_master_vendor.nama)', $nama_vendor);
        }

        return $this->db->get('tbl_master_vendor')->row();
    }
}

/* End of file Master_Vendor_Model.php */
