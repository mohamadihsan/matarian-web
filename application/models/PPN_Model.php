<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class PPN_Model extends CI_Model {

    public function get_ppn_report($perusahaan, $nama_bulan, $tahun, $nama_bulan_pengkreditkan, $tahun_pengkreditkan, $status_faktur)
    {
        $this->db->select('
            tbl_upload_dokumen_pajak.npwp_penjual,
            tbl_upload_dokumen_pajak.nama_penjual,
            tbl_upload_dokumen_pajak.cek,
            tbl_upload_dokumen_pajak.nomor_faktur_pajak,
            tbl_upload_dokumen_pajak.tanggal_faktur_pajak,
            tbl_upload_dokumen_pajak.masa_pajak,
            tbl_upload_dokumen_pajak.tahun_pajak,
            tbl_upload_dokumen_pajak.masa_pajak_pengkreditkan,
            tbl_upload_dokumen_pajak.tahun_pajak_pengkreditkan,
            tbl_upload_dokumen_pajak.status_faktur_pajak,
            tbl_upload_dokumen_pajak.harga_jual,
            tbl_upload_dokumen_pajak.dpp_nilai_lain,
            tbl_upload_dokumen_pajak.ppn,
            CASE 
                WHEN tbl_upload_dokumen_pajak.status_faktur_pajak IN ("CREDITED", "APPROVED", "UNCREDITED")
                    AND UPPER(tbl_upload_dokumen_pajak.masa_pajak) = UPPER('.$this->db->escape($nama_bulan).')
                    AND tbl_upload_dokumen_pajak.tahun_pajak = '.$this->db->escape($tahun).' 
                THEN tbl_upload_dokumen_pajak.ppn
                ELSE 0
            END AS ppn_condition,
            CASE
                WHEN tbl_upload_dokumen_pajak.cek = "DL1"
                    AND UPPER(tbl_upload_dokumen_pajak.masa_pajak) = UPPER('.$this->db->escape($nama_bulan).')
                    AND tbl_upload_dokumen_pajak.tahun_pajak = '.$this->db->escape($tahun).' 
                THEN 
                    CASE 
                        WHEN tbl_upload_dokumen_pajak.status_faktur_pajak IN ("CREDITED", "APPROVED", "UNCREDITED") THEN tbl_upload_dokumen_pajak.ppn
                        ELSE 0
                    END
                ELSE 0
            END AS b1,
            CASE
                WHEN tbl_upload_dokumen_pajak.cek IN ("FP", "DL2")
                    AND tbl_upload_dokumen_pajak.status_faktur_pajak = "CREDITED"
                THEN 
                    CASE 
                        WHEN tbl_upload_dokumen_pajak.status_faktur_pajak IN ("CREDITED", "APPROVED", "UNCREDITED")
                            AND UPPER(tbl_upload_dokumen_pajak.masa_pajak) = UPPER('.$this->db->escape($nama_bulan).')
                            AND tbl_upload_dokumen_pajak.tahun_pajak = '.$this->db->escape($tahun).' 
                        THEN tbl_upload_dokumen_pajak.ppn
                        ELSE 0
                    END
                ELSE 0
            END AS b2,
            CASE
                WHEN tbl_upload_dokumen_pajak.status_faktur_pajak = "UNCREDITED"
                THEN 
                    CASE 
                        WHEN tbl_upload_dokumen_pajak.status_faktur_pajak IN ("CREDITED", "APPROVED", "UNCREDITED")
                            AND UPPER(tbl_upload_dokumen_pajak.masa_pajak) = UPPER('.$this->db->escape($nama_bulan).')
                            AND tbl_upload_dokumen_pajak.tahun_pajak = '.$this->db->escape($tahun).'
                        THEN tbl_upload_dokumen_pajak.ppn
                        ELSE 0
                    END
                ELSE 0
            END AS b3
        ');

        $this->db->where('UPPER(tbl_upload_dokumen_pajak.masa_pajak)', strtoupper($nama_bulan));
        $this->db->where('tbl_upload_dokumen_pajak.tahun_pajak', $tahun);
        $this->db->where('tbl_upload_dokumen_pajak.master_perusahaan_id', $perusahaan);

        if ($nama_bulan_pengkreditkan != '') {
            $this->db->where('UPPER(tbl_upload_dokumen_pajak.masa_pajak_pengkreditkan)', $nama_bulan_pengkreditkan);
        }

        if ($tahun_pengkreditkan != '') {
            $this->db->where('tbl_upload_dokumen_pajak.tahun_pajak_pengkreditkan', $tahun);
        }

        if ($status_faktur != '') {
            $this->db->where('tbl_upload_dokumen_pajak.status_faktur_pajak', $status_faktur);
        }

        $this->db->join('tbl_master_perusahaan', 'tbl_master_perusahaan.id = tbl_upload_dokumen_pajak.master_perusahaan_id', 'left');
        $this->db->join('tbl_master_vendor', 'tbl_master_vendor.id = tbl_upload_dokumen_pajak.master_vendor_id', 'left');
        $this->db->join('tbl_unifikasi_kode_dokumen', 'tbl_unifikasi_kode_dokumen.id = tbl_upload_dokumen_pajak.unifikasi_kode_dokumen_id', 'left');
        $this->db->join('tbl_unifikasi_kode_fasilitas', 'tbl_unifikasi_kode_fasilitas.id = tbl_upload_dokumen_pajak.unifikasi_kode_fasilitas_id', 'left');
        $this->db->join('tbl_unifikasi_kode_objek_pajak', 'tbl_unifikasi_kode_objek_pajak.id = tbl_upload_dokumen_pajak.unifikasi_kode_objek_pajak_id', 'left');
        $this->db->join('tbl_unifikasi_kode_pembayaran', 'tbl_unifikasi_kode_pembayaran.id = tbl_upload_dokumen_pajak.unifikasi_kode_pembayaran_id', 'left');

        $this->db->order_by('tbl_master_perusahaan.nama', 'asc');
        $this->db->order_by('tbl_upload_dokumen_pajak.tanggal_faktur_pajak', 'desc');

        return $this->db->get('tbl_upload_dokumen_pajak');
    }

    public function get_unifikasi_report($perusahaan, $nama_bulan, $tahun, $fasilitas, $kode_objek_pajak, $kode_dokumen, $kode_pembayaran)
    {
        $this->db->select('
            tbl_upload_dokumen_pajak.masa_pajak,
            tbl_upload_dokumen_pajak.tahun_pajak,
            tbl_upload_dokumen_pajak.npwp_penjual,
            CONCAT(tbl_master_vendor.nitku, tbl_master_vendor.nitku_digit) as id_penerima,
            tbl_unifikasi_kode_fasilitas.kode as fasilitas,
            tbl_unifikasi_kode_objek_pajak.kode as kode_objek_pajak,
            tbl_upload_dokumen_pajak.nominal_jasa as dpp,
            tbl_unifikasi_kode_objek_pajak.tarif,
            tbl_unifikasi_kode_dokumen.kode as kode_dokumen,
            tbl_upload_dokumen_pajak.nomor_faktur_pajak,
            tbl_upload_dokumen_pajak.tanggal_faktur_pajak,
            CONCAT(tbl_master_perusahaan.nitku, tbl_master_perusahaan.nitku_digit) as id_pemotong,
            tbl_unifikasi_kode_pembayaran.kode as kode_pembayaran,
            tbl_upload_dokumen_pajak.nomor_sp2d,
            LAST_DAY(tbl_upload_dokumen_pajak.tanggal_faktur_pajak) as tanggal_pemotongan,
            (tbl_upload_dokumen_pajak.nominal_jasa * tbl_unifikasi_kode_objek_pajak.tarif) as pph
        ');

        $this->db->where('UPPER(tbl_upload_dokumen_pajak.masa_pajak)', strtoupper($nama_bulan));
        $this->db->where('tbl_upload_dokumen_pajak.tahun_pajak', $tahun);
        $this->db->where('tbl_upload_dokumen_pajak.master_perusahaan_id', $perusahaan);

        if (!empty($fasilitas)) {
            $this->db->where('tbl_unifikasi_kode_fasilitas.id', $fasilitas);
        }

        if (!empty($kode_objek_pajak)) {
            $this->db->where('tbl_unifikasi_kode_objek_pajak.id', $kode_objek_pajak);
        }

        if (!empty($kode_dokumen)) {
            $this->db->where('tbl_unifikasi_kode_dokumen.id', $kode_dokumen);
        }

        if (!empty($kode_pembayaran)) {
            $this->db->where('tbl_unifikasi_kode_pembayaran.id', $kode_pembayaran);
        }

        $this->db->join('tbl_master_perusahaan', 'tbl_master_perusahaan.id = tbl_upload_dokumen_pajak.master_perusahaan_id', 'left');
        $this->db->join('tbl_master_vendor', 'tbl_master_vendor.id = tbl_upload_dokumen_pajak.master_vendor_id', 'left');
        $this->db->join('tbl_unifikasi_kode_dokumen', 'tbl_unifikasi_kode_dokumen.id = tbl_upload_dokumen_pajak.unifikasi_kode_dokumen_id', 'left');
        $this->db->join('tbl_unifikasi_kode_fasilitas', 'tbl_unifikasi_kode_fasilitas.id = tbl_upload_dokumen_pajak.unifikasi_kode_fasilitas_id', 'left');
        $this->db->join('tbl_unifikasi_kode_objek_pajak', 'tbl_unifikasi_kode_objek_pajak.id = tbl_upload_dokumen_pajak.unifikasi_kode_objek_pajak_id', 'left');
        $this->db->join('tbl_unifikasi_kode_pembayaran', 'tbl_unifikasi_kode_pembayaran.id = tbl_upload_dokumen_pajak.unifikasi_kode_pembayaran_id', 'left');

        $this->db->order_by('tbl_master_perusahaan.nama', 'asc');
        $this->db->order_by('tbl_upload_dokumen_pajak.tanggal_faktur_pajak', 'desc');

        // echo $this->db->get_compiled_select('tbl_upload_dokumen_pajak'); 
        // exit;

        return $this->db->get('tbl_upload_dokumen_pajak');
    }

    public function delete($nama_bulan, $tahun, $perusahaan)
    {
        $this->db->where('UPPER(tbl_upload_dokumen_pajak.masa_pajak)', $nama_bulan);
        $this->db->where('tbl_upload_dokumen_pajak.tahun_pajak', $tahun);
        $this->db->where('tbl_upload_dokumen_pajak.master_perusahaan_id', $perusahaan);
        $this->db->delete('tbl_upload_dokumen_pajak');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    public function get_document_by_nomor_faktur($nomor_faktur)
    {
        $this->db->select('id, nomor_faktur_pajak');
        $this->db->where('nomor_faktur_pajak', $nomor_faktur);
        $this->db->limit(1);

        return $this->db->get('tbl_upload_dokumen_pajak')->row();
    }
}

/* End of file PPN_Model.php */
