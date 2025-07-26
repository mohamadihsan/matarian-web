<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Wilayah_Model extends CI_Model
{

    // get wilayah
    public function wilayah($param)
    {
        $this->db->limit(1);
        $this->db->where('LOWER(tbl_provinsi.provinsi)', strtolower($param['provinsi']));

        // if ($param['kabupaten']) {
        $this->db->where('LOWER(tbl_kabkot.kabupaten_kota)', strtolower($param['kabupaten']));
        // }
        // if ($param['kecamatan']) {
        $this->db->where('LOWER(tbl_kecamatan.kecamatan)', strtolower($param['kecamatan']));
        // }
        // if ($param['kelurahan']) {
        $this->db->where('LOWER(tbl_kelurahan.kelurahan)', strtolower($param['kelurahan']));
        // }

        $this->db->select('tbl_provinsi.id as id_provinsi, tbl_kabkot.id as id_kabupaten, tbl_kecamatan.id as id_kecamatan, tbl_kelurahan.id as id_kelurahan, tbl_kelurahan.kd_pos as kode_pos');

        $this->db->join('tbl_kabkot', 'tbl_kabkot.provinsi_id = tbl_provinsi.id', 'left');
        $this->db->join('tbl_kecamatan', 'tbl_kecamatan.kabkot_id = tbl_kabkot.id', 'left');
        $this->db->join('tbl_kelurahan', 'tbl_kelurahan.kecamatan_id = tbl_kecamatan.id', 'left');

        return $this->db->get('tbl_provinsi');
    }

    public function wilayah_v2($param)
    {
        $this->db->where('LOWER(tbl_provinsi.provinsi)', strtolower($param['provinsi']));
        $provinsi = $this->db->get('tbl_provinsi')->result();
        
        $this->db->where('LOWER(tbl_kabkot.kabupaten_kota)', strtolower($param['kabupaten']));
        $kabupaten = $this->db->get('tbl_kabkot')->result();
        
        $this->db->where('LOWER(tbl_kecamatan.kecamatan)', strtolower($param['kecamatan']));
        $kecamatan = $this->db->get('tbl_kecamatan')->result();
        
        $this->db->where('LOWER(tbl_kelurahan.kelurahan)', strtolower($param['kelurahan']));
        $kelurahan = $this->db->get('tbl_kelurahan')->result();

        $data = array(
            'provinsi' => $provinsi,
            'kabupaten' => $kabupaten,
            'kecamatan' => $kecamatan,
            'kelurahan' => $kelurahan
        );

        return $data;
    }

    // get provinsi
    public function provinsi($selected = null)
    {
        if ($selected != null) {
            $this->db->where('provinsi', $selected);
        }
        $this->db->order_by('provinsi', 'asc');

        return $this->db->get('tbl_provinsi');
    }

    // get kabupaten
    public function kabupaten($param, $selected)
    {
        $this->db->select('id, kabupaten_kota, ibukota, k_bsni');
        $this->db->group_by('id, kabupaten_kota, ibukota, k_bsni');
        $this->db->order_by('kabupaten_kota', 'asc');

        $this->db->where('provinsi_id', $param);
        if ($selected != null) {
            $this->db->where('id', $selected);
        }
        return $this->db->get('tbl_kabkot');
    }

    // get kecamatan
    public function kecamatan($param, $selected)
    {
        $this->db->select('id, kecamatan');
        $this->db->where('kabkot_id', $param);
        $this->db->order_by('kecamatan', 'asc');
        if ($selected != null) {
            $this->db->where('id', $selected);
        }
        return $this->db->get('tbl_kecamatan');
    }

    // get kelurahan
    public function kelurahan($param, $selected)
    {
        $this->db->select('id, kelurahan');
        $this->db->where('kecamatan_id', $param);
        $this->db->order_by('kelurahan', 'asc');
        if ($selected != null) {
            $this->db->where('id', $selected);
        }
        return $this->db->get('tbl_kelurahan');
    }

    // get kode_pos
    public function kode_pos($param, $selected)
    {
        $this->db->select('kd_pos');
        $this->db->where('id', $param);
        if ($selected != null) {
            $this->db->where('kd_pos', $selected);
        }
        return $this->db->get('tbl_kelurahan');
    }
}

/* End of file Wilayah_Model.php */
