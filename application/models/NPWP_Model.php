<?php

defined('BASEPATH') or exit('No direct script access allowed');

class NPWP_Model extends CI_Model
{

    // get
    public function get($param = null)
    {

        $this->db->select('id, npwp, new_npwp, nik, nama, alamat, nomor, blok, rt, rw, kelurahan, kecamatan, kabupaten, provinsi, kodepos, nomor_telepon, created_by, created_at, updated_by, updated_at, created_by_user, updated_by_user');
        $this->db->where('deleted_at', null);
        $this->db->order_by('nama', 'asc');
        if ($param != null) {
            $this->db->where('id', $param);
        }

        return $this->db->get('tbl_master_npwp_new');
    }

    // num row
    public function count($param = null)
    {

        $this->db->where('deleted_at', null);
        if ($param != null) {
            $this->db->where('id', $param);
        }

        return $this->db->get('tbl_master_npwp_new')->num_rows();
    }

    // last update
    public function last_update()
    {
        $this->db->select_max('created_at');
        $this->db->where('deleted_at', null);

        return $this->db->get('tbl_master_npwp_new');
    }

    // pagination
    public function pagination($page, $per_page, $search = null)
    {
        $this->db->select('id, npwp, new_npwp, nik, nama, alamat, nomor, blok, rt, rw, kelurahan, kecamatan, kabupaten, provinsi, kodepos, nomor_telepon, created_by, created_at, updated_by, updated_at, created_by_user, updated_by_user');
        if ($search != null) {
            $this->db->like('npwp', $search);
            $this->db->or_like('nama', $search);
            $this->db->or_like('nik', $search);
        }
        $this->db->where('deleted_at', null);
        $this->db->order_by('nama', 'asc');
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }

        return $this->db->get('tbl_master_npwp_new');
    }

    // count pagination
    public function count_pagination($search = null)
    {
        $this->db->select('id, npwp, new_npwp, nik, nama, alamat, nomor, blok, rt, rw, kelurahan, kecamatan, kabupaten, provinsi, kodepos, nomor_telepon, created_by, created_at, updated_by, updated_at, created_by_user, updated_by_user');
        if ($search != null) {
            $this->db->like('npwp', $search);
            $this->db->or_like('nama', $search);
            $this->db->or_like('nik', $search);
        }
        $this->db->where('deleted_at', null);
        $this->db->order_by('nama', 'asc');

        return $this->db->get('tbl_master_npwp_new')->num_rows();
    }

    // insert new data
    public function insert($data)
    {
        $this->db->insert('tbl_master_npwp_new', $data);
        return $this->db->insert_id();
    }

    // update
    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_master_npwp_new', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    // delete
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_master_npwp_new');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }
}

/* End of file NPWP_Model.php */
