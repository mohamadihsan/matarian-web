<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class User_Privilege_Model extends CI_Model {

    // get privilege
    public function get($id_user_group)
    {
        $this->db->where('tbl_user_privilege.deleted_at', null);
        $this->db->where('tbl_user_group.id', $id_user_group);
        $this->db->select('tbl_menu.id,
            tbl_user_group.user_group_name,
            tbl_menu.menu_name, 
            tbl_user_privilege.create_access, 
            tbl_user_privilege.read_access, 
            tbl_user_privilege.update_access, 
            tbl_user_privilege.delete_access, 
            tbl_user_privilege.approve_access, 
            tbl_user_privilege.reject_access, 
            tbl_user_privilege.print_access, 
            tbl_user_privilege.export_to_excel_access, 
            tbl_user_privilege.export_to_csv_access, 
            tbl_user_privilege.export_to_pdf_access 
        ');
        $this->db->join('tbl_user_privilege', 'tbl_menu.id = tbl_user_privilege.id_menu', 'left');
        $this->db->join('tbl_user_group', 'tbl_user_group.id = tbl_user_privilege.id_user_group', 'left');
        $this->db->order_by('tbl_user_group.user_group_name', 'asc');
        $this->db->order_by('tbl_menu.menu_name', 'asc');
        
        return $this->db->get('tbl_menu');
    }

    // check privilege when access menu
    public function check_privilege($id_user_group, $segment)
    {
        $this->db->where('tbl_user_privilege.deleted_at', null);
        $this->db->where('tbl_user_group.id', $id_user_group);
        $this->db->where('tbl_menu.segment_name', $segment);
        $this->db->select('tbl_menu.id,
            tbl_user_group.user_group_name,
            tbl_menu.menu_name, 
            tbl_user_privilege.create_access, 
            tbl_user_privilege.read_access, 
            tbl_user_privilege.update_access, 
            tbl_user_privilege.delete_access, 
            tbl_user_privilege.approve_access, 
            tbl_user_privilege.reject_access, 
            tbl_user_privilege.print_access, 
            tbl_user_privilege.export_to_excel_access, 
            tbl_user_privilege.export_to_csv_access, 
            tbl_user_privilege.export_to_pdf_access 
        ');
        $this->db->join('tbl_menu', 'tbl_menu.id = tbl_user_privilege.id_menu', 'left');
        $this->db->join('tbl_user_group', 'tbl_user_group.id = tbl_user_privilege.id_user_group', 'left');
        $this->db->order_by('tbl_user_group.user_group_name', 'asc');
        $this->db->order_by('tbl_menu.menu_name', 'asc');
        
        return $this->db->get('tbl_user_privilege')->row();
    }

    // get menu privilege
    public function get_menu()
    {
        $this->db->where('tbl_user_privilege.deleted_at', null);
        $this->db->select('tbl_menu.id,
            tbl_user_group.user_group_name,
            tbl_menu.menu_name, 
            tbl_user_privilege.create_access, 
            tbl_user_privilege.read_access, 
            tbl_user_privilege.update_access, 
            tbl_user_privilege.delete_access, 
            tbl_user_privilege.approve_access, 
            tbl_user_privilege.reject_access, 
            tbl_user_privilege.print_access, 
            tbl_user_privilege.export_to_excel_access, 
            tbl_user_privilege.export_to_csv_access, 
            tbl_user_privilege.export_to_pdf_access 
        ');
        $this->db->join('tbl_user_privilege', 'tbl_menu.id = tbl_user_privilege.id_menu', 'left');
        $this->db->join('tbl_user_group', 'tbl_user_group.id = tbl_user_privilege.id_user_group', 'left');
        $this->db->order_by('tbl_menu.menu_name', 'asc');
        
        return $this->db->get('tbl_menu');
    }

    // insert new data
    public function insert($data)
    {
        $this->db->insert('tbl_user_privilege', $data);
        return $this->db->insert_id();
    }

    // update
    public function update($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_user_privilege', $data);
        return ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
    }
}

/* End of file User_Privilege_Model.php */
