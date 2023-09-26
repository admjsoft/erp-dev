<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SidebarItemModel extends CI_Model {

    public function getSidebarHierarchy() {
        $query = $this->db->query("
            SELECT si.id, si.title, si.type, sh.parent_id
            FROM SidebarItems si
            LEFT JOIN SidebarHierarchy sh ON si.id = sh.child_id
            ORDER BY sh.parent_id, si.display_order
        ");
        return $query->result();
    }
}
