<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modules_model extends CI_Model
{

    
    public function get_sidebars()
    {
        $this->db->select();
        $this->db->from('sidebaritems');
        $this->db->where('type','Sidebar');  
        $this->db->or_where('type','Subheading');    
        $this->db->order_by('type');
        $query = $this->db->get();
        return $query->result_array();
    }	

    public function add_module($data)
    {
        if($this->db->insert('sidebaritems',$data))
        {
            $id = $this->db->insert_id();
            if($data['parent_id'
            ] != '0')
            {
                $n_data['parent_id'] = $data['parent_id'];
                $n_data['child_id'] = $id;
    
                if($this->db->insert('sidebarhierarchy',$n_data))
                {
                    $resp['status'] = 'Success';
                    $resp['message'] = 'Module Added Successfully';
                }else{
                    $resp['status'] = 'Failure';
                    $resp['message'] = 'Unable To Add The Module Relation! Please Try Again';
                    $this->db->where('id',$id)->delete('sidebaritems');
                }
            }else{
                    $resp['status'] = 'Success';
                    $resp['message'] = 'Module Added Successfully'; 
            }            

        }else{
            $resp['status'] = 'Failure';
            $resp['message'] = 'Unable To Add The Module! Please Try Again';
        }
        return $resp;
    }
    
    
    public function update_module($data,$module_id)
    {
        if($this->db->where('id',$module_id)->update('sidebaritems',$data))
        {
            $id = $module_id;
            if($data['parent_id'] != '0')
            {
                $n_data['parent_id'] = $data['parent_id'];
                $n_data['child_id'] = $id;
                if($this->db->where('child_id',$id)->get('sidebarhierarchy')->num_rows() > 0)
                {
                    if($this->db->where('child_id',$id)->update('sidebarhierarchy',$n_data))
                    {
                        $resp['status'] = 'Success';
                        $resp['message'] = 'Module Updated Successfully';
                    }else{
                        $resp['status'] = 'Failure';
                        $resp['message'] = 'Unable To Update The Module Relation! Please Try Again';
                        //$this->db->where('id',$id)->delete('sidebaritems');
                    }
                }else{

                    $n_data['parent_id'] = $data['parent_id'];
                    $n_data['child_id'] = $id;
        
                    if($this->db->insert('sidebarhierarchy',$n_data))
                    {
                        $resp['status'] = 'Success';
                        $resp['message'] = 'Module Updated Successfully';
                    }else{
                        $resp['status'] = 'Failure';
                        $resp['message'] = 'Unable To Updated The Module Relation! Please Try Again';
                        //$this->db->where('id',$id)->delete('sidebaritems');
                    }

                }   
                
            }else{
                    $resp['status'] = 'Success';
                    $resp['message'] = 'Module Updated Successfully'; 
            }            

        }else{
            $resp['status'] = 'Failure';
            $resp['message'] = 'Unable To Update The Module! Please Try Again';
        }
        return $resp;
    }

    public function get_module_details($id)
    {
        $sql = "SELECT si.*, sh.parent_id as rel_parent_id FROM sidebaritems si LEFT JOIN sidebarhierarchy sh ON si.id = sh.child_id WHERE si.id = {$id}";
        $query = $this->db->query($sql);
        return $query->result_array();
    }	

    public function get_modules_list()
    {
        $sql = "SELECT si.*, sh.parent_id AS rel_parent_id, sip.title AS rel_parent_title FROM sidebaritems si LEFT JOIN sidebarhierarchy sh ON si.id = sh.child_id LEFT JOIN sidebaritems sip ON sh.parent_id = sip.id order by si.id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    
    
    public function get_modules_hierarchy() {
        $query = $this->db->query("
            SELECT si.id, si.title, si.type,si.subscription_status, sh.parent_id
            FROM sidebaritems si
            LEFT JOIN sidebarhierarchy sh ON si.id = sh.child_id
            ORDER BY si.id, si.display_order
        ");
        return $query->result();
    }

    public function get_role_module_permissions($role){

        $roleuser = "r_" . $role;
        $this->db->select('id');
        $this->db->from('sidebaritems');
        $this->db->where($roleuser, 1);
        $query = $this->db->get();
        return $query->result_array();

    }


    public function get_role_based_sidebar(){

        $query = $this->db->query("
        SELECT si.id, si.title, si.type, sh.parent_id
        FROM sidebaritems si
        LEFT JOIN sidebarhierarchy sh ON si.id = sh.child_id
        ORDER BY sh.parent_id, si.display_order
        ");
        return $query->result();

    }

    public function get_role_personalization_modules($role){

        $this->db->select('id');
        $this->db->from('sidebaritems');
        $this->db->where($role, 1);
        $this->db->where('module_personalization', 1);
        $query = $this->db->get();
        return $query->result_array();

    }

    public function get_modules_personalization_hierarchy($role) {
        $query = $this->db->query("
            SELECT si.id, si.title, si.type,si.subscription_status,si.module_personalization,sh.parent_id
            FROM sidebaritems si
            LEFT JOIN sidebarhierarchy sh ON si.id = sh.child_id
            WHERE si.module_personalization = 1
            AND si.$role = 1
            ORDER BY si.id, si.display_order
        ");
        return $query->result();
    }
	   
    

    public function get_customer_modules_list()
    {
        $sql = "SELECT * FROM customer_sidebaritems order by display_order ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function customer_add_module($data)
    {
        if($this->db->insert('customer_sidebaritems',$data))
        {
            $id = $this->db->insert_id();
            
            $resp['status'] = 'Success';
            $resp['message'] = 'Module Added Successfully'; 
            

        }else{
            $resp['status'] = 'Failure';
            $resp['message'] = 'Unable To Add The Module! Please Try Again';
        }
        return $resp;
    }
    
    public function get_customer_sidebars()
    {
        $this->db->select();
        $this->db->from('customer_sidebaritems');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function get_customer_module_details($id)
    {
        $sql = "SELECT * FROM customer_sidebaritems WHERE id = {$id}";
        $query = $this->db->query($sql);
        return $query->result_array();
    }	

    public function customer_update_module($data,$module_id)
    {
        if($this->db->where('id',$module_id)->update('customer_sidebaritems',$data))
        {
            $id = $module_id;
            
            $resp['status'] = 'Success';
            $resp['message'] = 'Module Updated Successfully'; 
                       

        }else{
            $resp['status'] = 'Failure';
            $resp['message'] = 'Unable To Update The Module! Please Try Again';
        }
        return $resp;
    }

    public function get_customer_module_permissions($customer_id){

        $this->db->select('module_id');
        $this->db->from('customer_sidebaritems_permissions');
        $this->db->where('customer_id',$customer_id);
        $query = $this->db->get();
        $modules = $query->result_array();
        return $modules;

    }

    
}
