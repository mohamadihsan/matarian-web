<?php

defined('BASEPATH') or exit('No direct script access allowed');

class News_Model extends CI_Model
{
    // get
    public function get($id = null)
    {
        $this->db->order_by('created_at', 'desc');
        if ($id != null) {
            $this->db->where('id', $id);
        }

        return $this->db->get('tbl_news');
    }

    // num row
    public function count($param = null)
    {
        if ($param != null) {
            $this->db->where('id', $param);
        }

        return $this->db->get('tbl_news')->num_rows();
    }

    // insert new data
    public function insert($data)
    {
        $this->db->insert('tbl_news', $data);
        return $this->db->insert_id();
    }

    // update
    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_news', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    // delete
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_news');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    public function pagination($page, $per_page, $search = null)
    {
        $this->db->select('id, title, cover, created_at as posting_date, content');
        if ($search != null) {
            $this->db->like('title', $search);
        };
        $this->db->order_by('created_at', 'desc');
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }

        return $this->db->get('tbl_news');
    }
}

/* End of file News_Model.php */
