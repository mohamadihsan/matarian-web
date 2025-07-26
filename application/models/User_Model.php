<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_Model extends CI_Model
{

    // get
    public function get($param = null)
    {

        $this->db->select('tbl_user.id, tbl_user.username, tbl_user.fullname, tbl_user.nomor_telepon, tbl_user.email, tbl_user.activation_status, tbl_user.activation_at, tbl_user.id_user_group, tbl_user.web_group, tbl_user_group.user_group_name, tbl_user.sales_ar');
        $this->db->join('tbl_user_group', 'tbl_user_group.id = tbl_user.id_user_group', 'left');
        $this->db->where('tbl_user.deleted_at', null);
        $this->db->where_in('tbl_user.web_group', array('unit', 'unit sparepart'));
        $this->db->order_by('tbl_user.fullname', 'asc');
        if ($param != null) {
            $this->db->where('tbl_user.id', $param);
        }

        return $this->db->get('tbl_user');
    }

    // get sales
    public function get_user_sales($sales_ar, $user_id = null, $id_user_group = null)
    {
        if ($id_user_group == 1 || $id_user_group == 4) {
            $this->db->select('tbl_user.id, tbl_user.fullname, tbl_user.nomor_telepon, tbl_user.sales_ar');
            $this->db->where('tbl_user.deleted_at', null);
            $this->db->where('tbl_user.id_user_group', 2);
            $this->db->where('tbl_user.activation_status', true);
            $this->db->where_in('tbl_user.web_group', array('unit', 'unit sparepart'));
            $this->db->order_by('tbl_user.fullname', 'asc');

            return $this->db->get('tbl_user')->result();
        } else {
            $query = $this->db->query("SELECT
                tbl_user.id,
                tbl_user.fullname,
                tbl_user.sales_ar
            FROM
                tbl_user
            WHERE
                tbl_user.id = $user_id
            UNION
            SELECT
                tbl_user.id,
                tbl_user.fullname,
                tbl_user.sales_ar
            FROM
                tbl_user_access_to
            LEFT JOIN tbl_user ON
                tbl_user.id = tbl_user_access_to.access_to
            WHERE
                tbl_user_access_to.user_id = $user_id
            ORDER BY
                fullname ASC");

            return $query->result();
        }
        // if ($sales_ar != null) {
        //     $this->db->where('tbl_user.sales_ar', $sales_ar);
        // }
    }

    // num row
    public function count($param = null)
    {

        $this->db->where('deleted_at', null);
        $this->db->where_in('tbl_user.web_group', array('unit', 'unit sparepart'));
        if ($param != null) {
            $this->db->where('id', $param);
        }

        return $this->db->get('tbl_user')->num_rows();
    }

    // num row
    public function count_reject($param = null)
    {

        $this->db->where('deleted_at', null);
        $this->db->where('activation_status', false);
        $this->db->where_in('tbl_user.web_group', array('unit', 'unit sparepart'));
        if ($param != null) {
            $this->db->where('id', $param);
        }

        return $this->db->get('tbl_user')->num_rows();
    }

    // num row
    public function count_verify($param = null)
    {

        $this->db->where('deleted_at', null);
        $this->db->where('activation_status', true);
        $this->db->where_in('tbl_user.web_group', array('unit', 'unit sparepart'));
        if ($param != null) {
            $this->db->where('id', $param);
        }

        return $this->db->get('tbl_user')->num_rows();
    }

    // get pending activation
    public function get_pending_activation($param = null)
    {
        $this->db->select('tbl_user.id, tbl_user.username, tbl_user.fullname, tbl_user.nomor_telepon, tbl_user.email, tbl_user.activation_status, tbl_user.activation_at, tbl_user.id_user_group, tbl_user.web_group, tbl_user.created_at, tbl_user_group.user_group_name,');
        $this->db->join('tbl_user_group', 'tbl_user_group.id = tbl_user.id_user_group', 'left');
        $this->db->where('tbl_user.deleted_at', null);
        $this->db->where('activation_status', null);
        $this->db->where_in('tbl_user.web_group', array('unit', 'unit sparepart'));
        $this->db->order_by('tbl_user.username', 'asc');
        if ($param != null) {
            $this->db->where('tbl_user.id', $param);
        }

        return $this->db->get('tbl_user');
    }

    // count pending activation
    public function count_pending_activation($param = null)
    {

        $this->db->where('deleted_at', null);
        $this->db->where('activation_status', null);
        $this->db->where_in('tbl_user.web_group', array('unit', 'unit sparepart'));
        if ($param != null) {
            $this->db->where('id', $param);
        }

        return $this->db->get('tbl_user')->num_rows();
    }

    // last update
    public function last_update()
    {
        $this->db->select_max('created_at');
        $this->db->where('deleted_at', null);
        $this->db->where_in('tbl_user.web_group', array('unit', 'unit sparepart'));

        return $this->db->get('tbl_user');
    }

    // pagination
    public function pagination($page, $per_page)
    {
        $this->db->select('tbl_user.id, tbl_user.username, tbl_user.fullname, tbl_user.nomor_telepon, tbl_user.email, tbl_user.activation_status, tbl_user.activation_at, tbl_user.id_user_group, tbl_user.web_group, tbl_user_group.user_group_name');
        $this->db->join('tbl_user_group', 'tbl_user_group.id = tbl_user.id_user_group', 'left');
        $this->db->where('tbl_user.deleted_at', null);
        $this->db->where_in('tbl_user.web_group', array('unit', 'unit sparepart'));
        $this->db->order_by('tbl_user.username', 'asc');
        if ($page > 0 && $per_page > 0) {
            $this->db->limit($per_page, ($page * $per_page - $per_page));
        }

        return $this->db->get('tbl_user');
    }

    // insert new data
    public function insert($data)
    {
        $this->db->insert('tbl_user', $data);
        return $this->db->insert_id();
    }

    // update
    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_user', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    // delete
    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_user');
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    // check username
    public function check_username($username, $password = null)
    {
        $this->db->where('username', $username);
        $this->db->where('deleted_at', NULL);
        $this->db->where_in('tbl_user.web_group', array('unit', 'unit sparepart'));
        $this->db->select('id, username, password, fullname, nomor_telepon, email, id_user_group, sales_ar, activation_status');

        return $this->db->get('tbl_user');
    }

    // check by email
    public function check_by_email($email)
    {
        $this->db->where('email', $email);
        $this->db->where('deleted_at', NULL);
        $this->db->select('id, username, fullname, nomor_telepon, email');

        return $this->db->get('tbl_user');
    }

    // check by id
    public function check_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->where('deleted_at', NULL);
        $this->db->select('id, username, fullname, nomor_telepon, email');

        return $this->db->get('tbl_user');
    }

    // profile
    public function profile($user_id)
    {
        $this->db->where('tbl_user.id', $user_id);
        $this->db->select("tbl_user.username, 
        tbl_user.fullname, 
        tbl_user.nomor_telepon, 
        tbl_user.email, 
        tbl_user_group.user_group_name, 
        tbl_user.sales_ar, 
        CASE
            WHEN tbl_user.activation_status = 0 THEN 'Rejected'
            WHEN tbl_user.activation_status = 1 THEN 'Verified'
            ELSE 'Pending'
        END activation_status,     
        tbl_user.activation_at, 
        tbl_user.activation_by, 
        tbl_user.created_at, 
        tbl_user.created_by, 
        tbl_user.updated_at, 
        tbl_user.updated_by, 
        tbl_user.deleted_at, 
        tbl_user.deleted_by");
        $this->db->join('tbl_user_group', 'tbl_user_group.id = tbl_user.id_user_group', 'left');

        return $this->db->get('tbl_user');
    }

    // get 
    public function getAccessData($id_user_group = null, $user_id = null)
    {
        // set static
        $id_user_group = 2;
        $where = '';
        if ($id_user_group != null) {
            $where = " AND tbl_user.id_user_group = $id_user_group ";
        }

        $query = "SELECT * FROM 
        (SELECT tbl_user.id, tbl_user.fullname, tbl_user.sales_ar, tbl_user.profile_picture, tbl_user_group.user_group_name FROM tbl_user LEFT JOIN tbl_user_group ON tbl_user_group.id = tbl_user.id_user_group  WHERE tbl_user.deleted_at IS NULL AND tbl_user.web_group IN ('unit', 'unit sparepart') AND tbl_user.id != $user_id $where ORDER BY tbl_user.fullname ASC) a LEFT JOIN 
        (SELECT tbl_user_access_to.user_id, tbl_user_access_to.access_to FROM tbl_user_access_to WHERE tbl_user_access_to.user_id = $user_id) b ON a.id = b.access_to";

        return $this->db->query($query)->result();
    }

    public function setPermission($data, $id)
    {
        // reset   
        $this->db->where('user_id', $id);
        $this->db->delete('tbl_user_access_to');

        $access_data = $data['access_data'];
        $created_at = $data['created_at'];
        $created_by = $data['created_by'];
        if (count($access_data) > 0) {
            for ($i = 0; $i < count($access_data); $i++) {
                $obj = array(
                    'user_id' => $id,
                    'access_to' => $access_data[$i],
                    'created_at' => $created_at,
                    'created_by' => $created_by,
                );
                $this->db->insert('tbl_user_access_to', $obj);
            }
        }

        return true;
    }

    public function getPermission($user_id = null)
    {
        $this->db->where('user_id', $user_id);
        return $this->db->get('tbl_user_access_to');
    }

    public function getPermissionSalesAR($user_id = null)
    {
        $query = $this->db->query("SELECT tuat.access_to, tu.sales_ar FROM tbl_user_access_to tuat LEFT JOIN tbl_user tu ON tu.id = tuat.access_to WHERE tuat.user_id = $user_id");
        return $query->result();
    }
}

/* End of file User_Model.php */
