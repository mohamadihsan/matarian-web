<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_Group_Model extends CI_Model {

    // get
    public function get($param = null)
    {
        
        $this->db->select('id, user_group_name, user_group_desc');
        $this->db->where('deleted_at', null);
        $this->db->order_by('user_group_name', 'asc');
        if ($param != null) {
            $this->db->where('id', $param);
        }
        
        return $this->db->get('tbl_user_group');
    }

    // num row
    public function count($param = null)
    {
        
        $this->db->where('deleted_at', null);
        if ($param != null) {
            $this->db->where('id', $param);
        }
        
        return $this->db->get('tbl_user_group')->num_rows();
    }

    // last update
    public function last_update()
    {
        $this->db->select_max('created_at');
        $this->db->where('deleted_at', null);

        return $this->db->get('tbl_user_group');
    }

    // pagination
    public function pagination($page, $per_page)
    {
        $this->db->select('id, user_group_name, user_group_desc');
        $this->db->where('deleted_at', null);
        $this->db->order_by('user_group_name', 'asc');
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }
        
        return $this->db->get('tbl_user_group');
    }

    // insert new data
    public function insert($data)
    {
        $this->db->insert('tbl_user_group', $data);
        return $this->db->insert_id();
    }

    // update
    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_user_group', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
    }

    // delete
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_user_group');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
    }

}

/* End of file User_Group_Model.php */
