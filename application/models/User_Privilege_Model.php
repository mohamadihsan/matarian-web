<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_Privilege_Model extends CI_Model
{

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
        // reset   
        $this->db->set('create_access', false);
        $this->db->set('read_access', false);
        $this->db->set('update_access', false);
        $this->db->set('delete_access', false);
        $this->db->set('approve_access', false);
        $this->db->set('reject_access', false);
        $this->db->set('print_access', false);
        $this->db->set('export_to_excel_access', false);
        $this->db->set('export_to_csv_access', false);
        $this->db->set('export_to_pdf_access', false);
        $this->db->where('id_user_group', $id);
        $this->db->update('tbl_user_privilege');

        $create_access = $data['create_access'];
        if (count($create_access) > 0) {
            for ($i = 0; $i < count($create_access); $i++) {
                $this->db->set('create_access', true);
                $this->db->where('id_menu', $create_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $read_access = $data['read_access'];
        if (count($read_access) > 0) {
            for ($i = 0; $i < count($read_access); $i++) {
                $this->db->set('read_access', true);
                $this->db->where('id_menu', $read_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $update_access = $data['update_access'];
        if (count($update_access) > 0) {
            for ($i = 0; $i < count($update_access); $i++) {
                $this->db->set('update_access', true);
                $this->db->where('id_menu', $update_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $delete_access = $data['delete_access'];
        if (count($delete_access) > 0) {
            for ($i = 0; $i < count($delete_access); $i++) {
                $this->db->set('delete_access', true);
                $this->db->where('id_menu', $delete_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $approve_access = $data['approve_access'];
        if (count($approve_access) > 0) {
            for ($i = 0; $i < count($approve_access); $i++) {
                $this->db->set('approve_access', true);
                $this->db->where('id_menu', $approve_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $reject_access = $data['reject_access'];
        if (count($reject_access) > 0) {
            for ($i = 0; $i < count($reject_access); $i++) {
                $this->db->set('reject_access', true);
                $this->db->where('id_menu', $reject_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $print_access = $data['print_access'];
        if (count($print_access) > 0) {
            for ($i = 0; $i < count($print_access); $i++) {
                $this->db->set('print_access', true);
                $this->db->where('id_menu', $print_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $export_to_excel_access = $data['export_to_excel_access'];
        if (count($export_to_excel_access) > 0) {
            for ($i = 0; $i < count($export_to_excel_access); $i++) {
                $this->db->set('export_to_excel_access', true);
                $this->db->where('id_menu', $export_to_excel_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $export_to_csv_access = $data['export_to_csv_access'];
        if (count($export_to_csv_access) > 0) {
            for ($i = 0; $i < count($export_to_csv_access); $i++) {
                $this->db->set('export_to_csv_access', true);
                $this->db->where('id_menu', $export_to_csv_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $export_to_pdf_access = $data['export_to_pdf_access'];
        if (count($export_to_pdf_access) > 0) {
            for ($i = 0; $i < count($export_to_pdf_access); $i++) {
                $this->db->set('export_to_pdf_access', true);
                $this->db->where('id_menu', $export_to_pdf_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        return true;
    }

    // update
    public function update2($data, $id)
    {
        $create_access = $data['create_access'];
        if (count($create_access > 0)) {
            $this->db->set('create_access', false);
            $this->db->where('id_user_group', $id);
            $this->db->update('tbl_user_privilege');
            for ($i = 0; $i < $create_access; $i++) {
                $this->db->set('create_access', true);
                $this->db->where('id_menu', $create_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $read_access = $data['read_access'];
        if (count($read_access > 0)) {
            $this->db->set('read_access', false);
            $this->db->where('id_user_group', $id);
            $this->db->update('tbl_user_privilege');
            for ($i = 0; $i < $read_access; $i++) {
                $this->db->set('read_access', true);
                $this->db->where('id_menu', $read_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $update_access = $data['update_access'];
        if (count($update_access > 0)) {
            $this->db->set('update_access', false);
            $this->db->where('id_user_group', $id);
            $this->db->update('tbl_user_privilege');
            for ($i = 0; $i < $update_access; $i++) {
                $this->db->set('update_access', true);
                $this->db->where('id_menu', $update_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $delete_access = $data['delete_access'];
        if (count($delete_access > 0)) {
            $this->db->set('delete_access', false);
            $this->db->where('id_user_group', $id);
            $this->db->update('tbl_user_privilege');
            for ($i = 0; $i < $delete_access; $i++) {
                $this->db->set('delete_access', true);
                $this->db->where('id_menu', $delete_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $approve_access = $data['approve_access'];
        if (count($approve_access > 0)) {
            $this->db->set('approve_access', false);
            $this->db->where('id_user_group', $id);
            $this->db->update('tbl_user_privilege');
            for ($i = 0; $i < $approve_access; $i++) {
                $this->db->set('approve_access', true);
                $this->db->where('id_menu', $approve_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $reject_access = $data['reject_access'];
        if (count($reject_access > 0)) {
            $this->db->set('reject_access', false);
            $this->db->where('id_user_group', $id);
            $this->db->update('tbl_user_privilege');
            for ($i = 0; $i < $reject_access; $i++) {
                $this->db->set('reject_access', true);
                $this->db->where('id_menu', $reject_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $print_access = $data['print_access'];
        if (count($print_access > 0)) {
            $this->db->set('print_access', false);
            $this->db->where('id_user_group', $id);
            $this->db->update('tbl_user_privilege');
            for ($i = 0; $i < $print_access; $i++) {
                $this->db->set('print_access', true);
                $this->db->where('id_menu', $print_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $export_to_excel_access = $data['export_to_excel_access'];
        if (count($export_to_excel_access > 0)) {
            $this->db->set('export_to_excel_access', false);
            $this->db->where('id_user_group', $id);
            $this->db->update('tbl_user_privilege');
            for ($i = 0; $i < $export_to_excel_access; $i++) {
                $this->db->set('export_to_excel_access', true);
                $this->db->where('id_menu', $export_to_excel_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $export_to_csv_access = $data['export_to_csv_access'];
        if (count($export_to_csv_access > 0)) {
            $this->db->set('export_to_csv_access', false);
            $this->db->where('id_user_group', $id);
            $this->db->update('tbl_user_privilege');
            for ($i = 0; $i < $export_to_csv_access; $i++) {
                $this->db->set('export_to_csv_access', true);
                $this->db->where('id_menu', $export_to_csv_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        $export_to_pdf_access = $data['export_to_pdf_access'];
        if (count($export_to_pdf_access > 0)) {
            $this->db->set('export_to_pdf_access', false);
            $this->db->where('id_user_group', $id);
            $this->db->update('tbl_user_privilege');
            for ($i = 0; $i < $export_to_pdf_access; $i++) {
                $this->db->set('export_to_pdf_access', true);
                $this->db->where('id_menu', $export_to_pdf_access[$i]);
                $this->db->where('id_user_group', $id);
                $this->db->update('tbl_user_privilege');
            }
        }

        return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
    }

    public function generateRole($user_group_id)
    {
        $this->db->query("INSERT INTO tbl_user_privilege (id_user_group, id_menu, create_access, read_access, update_access, delete_access, approve_access, reject_access, print_access, export_to_excel_access, export_to_csv_access, export_to_pdf_access)
                            SELECT 
                                $user_group_id as id_user_group, 
                                id as id_menu, 
                                false as create_access,
                                CASE 
                                    WHEN id IN (1,2,3,4,5) THEN true
                                    ELSE false 
                                END read_access,
                                false as update_access,
                                false as delete_access,
                                false as approve_access,
                                false as reject_access,
                                false as print_access,
                                false as export_to_excel_access,
                                false as export_to_csv_access,
                                false as export_to_pdf_access
                            FROM tbl_menu ORDER BY id ASC");

        return true;
    }
}

/* End of file User_Privilege_Model.php */
