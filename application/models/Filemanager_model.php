<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Filemanager_model extends CI_Model
{

    public function getRootFolderId() {
        $query = $this->db->get_where('filemanagemententities', array('parent_entity_id' => NULL, 'entity_type' => 'folder'));
        $result = $query->row_array();
        return ($result) ? $result['entity_id'] : NULL;
    }
    
    public function getRootFolder() {
        return $this->db->get_where('filemanagemententities', array('parent_entity_id' => NULL, 'entity_type' => 'folder'))->row_array();
    }

    public function getFolderById($folder_id) {
        return $this->db->get_where('filemanagemententities', array('entity_id' => $folder_id, 'entity_type' => 'folder'))->row_array();
    }

    public function getContentsByFolderId($folder_id) {
        // return $this->db->get_where('filemanagemententities', array('parent_entity_id' => $folder_id, 'delete_status' => 0))->result_array();
        $this->db->select('fme.*, fl.global_lock, 
                    SUM(CASE WHEN fl.user_type = "customer" THEN 1 ELSE 0 END) AS customer_locks,
                    SUM(CASE WHEN fl.user_type = "employee" THEN 1 ELSE 0 END) AS employee_locks');
        $this->db->from('filemanagemententities fme');
        $this->db->join('file_locks fl', 'fme.entity_id = fl.file_id', 'left');
        $this->db->where('fme.parent_entity_id', $folder_id);
        $this->db->where('fme.delete_status', 0);
        $this->db->group_by('fme.entity_id'); // Group by file ID to aggregate locks
        return $this->db->get()->result_array();

    
    }

    public function getRootContents() {
        // return $this->db->get_where('filemanagemententities', array('parent_entity_id' => NULL,'delete_status' => 0))->result_array();
        $this->db->select('fme.*, fl.global_lock, 
                    SUM(CASE WHEN fl.user_type = "customer" THEN 1 ELSE 0 END) AS customer_locks,
                    SUM(CASE WHEN fl.user_type = "employee" THEN 1 ELSE 0 END) AS employee_locks');
        $this->db->from('filemanagemententities fme');
        $this->db->join('file_locks fl', 'fme.entity_id = fl.file_id', 'left');
        $this->db->where('fme.parent_entity_id', NULL);
        $this->db->where('fme.delete_status', 0);
        $this->db->group_by('fme.entity_id'); // Group by file ID to aggregate locks
        return $this->db->get()->result_array();
    }

    public function getFileById($file_id) {
        return $this->db->get_where('filemanagemententities', array('entity_id' => $file_id))->row_array();
    }

    public function renameFile($file_id, $new_name) {
        $this->db->set('entity_name', $new_name);
        $this->db->where('entity_id', $file_id);
        return $this->db->update('filemanagemententities');
    }

    public function deleteFile($file_id) {
        // Perform the deletion
        $data['delete_status'] = 1;
        $this->db->where('entity_id', $file_id);
        return $this->db->update('filemanagemententities',$data);
    }

    public function getBreadcrumbs($folderId) {
        // Initialize breadcrumbs array
        $breadcrumbs = array();

        // Fetch folder hierarchy recursively
        $this->fetchBreadcrumbs($folderId, $breadcrumbs);

        // Reverse the breadcrumbs array to start from the root folder
        $breadcrumbs = array_reverse($breadcrumbs);

        return $breadcrumbs;
    }

    private function fetchBreadcrumbs($folderId, &$breadcrumbs) {
        // Fetch folder details by ID
        $folder = $this->db->get_where('filemanagemententities', array('entity_id' => $folderId, 'entity_type' => 'folder'))->row_array();

        if ($folder) {
            // Add folder details to breadcrumbs
            $breadcrumbs[] = $folder;

            // If the folder has a parent, recursively fetch its parent's breadcrumbs
            if ($folder['parent_entity_id'] != null) {
                $this->fetchBreadcrumbs($folder['parent_entity_id'], $breadcrumbs);
            }
        }
    }

    public function logOperation($entityId,$operation) {

       
        $userId = $this->aauth->get_user()->id;

        //view
        $data = array(
            'entity_id' => $entityId,
            'user_id' => $userId,
            'operation' => $operation
        );
        $this->db->insert('file_folder_log', $data);
    }

    private function fetchParentFolders($folderId, &$breadcrumbs) {
        // Fetch folder details by ID
        $folder = $this->db->get_where('filemanagemententities', array('entity_id' => $folderId, 'entity_type' => 'folder'))->row_array();

        if ($folder) {
            // Add folder details to breadcrumbs
            $breadcrumbs[] = $folder;

            // If the folder has a parent, recursively fetch its parent's breadcrumbs
            if ($folder['parent_entity_id'] != null) {
                $this->fetchParentFolders($folder['parent_entity_id'], $breadcrumbs);
            }
        }
 
    }

    public function getParentFolders($folderId) {
        // Initialize breadcrumbs array
        $breadcrumbs = array();

        // Fetch folder hierarchy recursively
        $this->fetchParentFolders($folderId, $breadcrumbs);

        // Reverse the breadcrumbs array to start from the root folder
        $breadcrumbs = array_reverse($breadcrumbs);

        return $breadcrumbs;
    }
    

    public function getRootFoldersHeirarichy($parent_id = '') {
        if(empty($parent_id)){ $parent_id = NULL; }
        return $this->db->get_where('filemanagemententities', array('parent_entity_id' => $parent_id,'delete_status' => 0,'entity_type' => 'folder'))->result_array();
    }

    
    public function getEmployeeRootContents() {
        
        $employee_id = $this->aauth->get_user()->id;
        $parent_entity_id = '';
        $this->db->select('
            fme.entity_id,
            fme.parent_entity_id,
            fme.entity_name,
            fme.entity_type,
            fme.entity_path,
            fme.created_at,
            fme.updated_at,
            fme.delete_status,
            IF(fl.lock_id IS NOT NULL, "locked", "unlocked") AS file_lock_status,
            fl.global_lock
        ');
        $this->db->from('filemanagemententities fme');
        $this->db->join('user_folder_access ufa', 'fme.entity_id = ufa.folder_id', 'left');
        $this->db->join('file_locks fl', 'fme.entity_id = fl.file_id AND fl.user_type = "employee" AND fl.user_id = ' . $employee_id, 'left');
        $this->db->where('ufa.type', 'employee');
        $this->db->where('ufa.user_id', $employee_id);
        $this->db->where('(fme.parent_entity_id IS NULL OR EXISTS (SELECT 1 FROM filemanagemententities fmeparent WHERE fmeparent.entity_id = fme.parent_entity_id))');

        // Additional condition based on parent_entity_id
        if ($parent_entity_id) {
            $this->db->where('fme.parent_entity_id', $parent_entity_id);
        }

        $this->db->order_by('fme.parent_entity_id, fme.entity_name','DESC');
        $query = $this->db->get();
        $items = $query->result_array();

        $result = array();

        $grouped_items = array();

        foreach ($items as $item) {
            $parent_id = $item['parent_entity_id'] ?? null;
            $grouped_items[$parent_id][] = $item;
        }
        
        $contents = reset($grouped_items);
    
        return $contents;
    }
    
}
