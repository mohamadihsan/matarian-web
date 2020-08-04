<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class KTP_Model extends CI_Model {

    // get
    public function get($param = null)
    {
        
        $this->db->select('id, nik, nama, tempat_lahir, tgl_lahir, alamat, rt, rw, kelurahan, kecamatan, kabupaten, provinsi, kodepos, jenis_kelamin, golongan_darah, status_perkawinan, agama, pekerjaan, kewarganegaraan');
        $this->db->where('deleted_at', null);
        $this->db->order_by('nama', 'asc');

        if ($param != null) {
            $this->db->where('id', $param);
        }
        
        return $this->db->get('tbl_master_ktp');
    }

    // num row
    public function count($param = null)
    {
        
        $this->db->where('deleted_at', null);
        if ($param != null) {
            $this->db->where('id', $param);
        }
        
        return $this->db->get('tbl_master_ktp')->num_rows();
    }

    // last update
    public function last_update()
    {
        $this->db->select_max('created_at');
        $this->db->where('deleted_at', null);

        return $this->db->get('tbl_master_ktp');
    }

    // pagination
    public function pagination($page, $per_page, $search = null)
    {
        $this->db->select('id, nik, nama, tempat_lahir, tgl_lahir, alamat, rt, rw, kelurahan, kecamatan, kabupaten, provinsi, kodepos, jenis_kelamin, golongan_darah, status_perkawinan, agama, pekerjaan, kewarganegaraan');
        if ($search != null) {
            $this->db->like('nik', $search);
            $this->db->or_like('nama', $search);
        }
        $this->db->where('deleted_at', null);
        $this->db->order_by('nama', 'asc');
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }
        
        return $this->db->get('tbl_master_ktp');
    }

    // count pagination
    public function count_pagination($search = null)
    {
        $this->db->select('id, nik, nama, tempat_lahir, tgl_lahir, alamat, rt, rw, kelurahan, kecamatan, kabupaten, provinsi, kodepos, jenis_kelamin, golongan_darah, status_perkawinan, agama, pekerjaan, kewarganegaraan');
        if ($search != null) {
            $this->db->like('nik', $search);
            $this->db->or_like('nama', $search);
        }
        $this->db->where('deleted_at', null);
        $this->db->order_by('nama', 'asc');
        
        return $this->db->get('tbl_master_ktp')->num_rows();
    }

    // insert new data
    public function insert($data)
    {
        $this->db->insert('tbl_master_ktp', $data);
        return $this->db->insert_id();
    }

    // update
    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_master_ktp', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
    }

    // delete
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_master_ktp');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
    }

}

/* End of file KTP_Model.php */
