<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modules extends CI_Controller {

    public function __construct() {
        parent::__construct();        
        $this->load->model('employee_model', 'employee');
        $this->load->model('Modules_model','modules');
        $this->load->model('SidebarItemModel');
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        $this->li_a = 'modules';
    }

    public function index() {
       
        $data['sidebar_hierarchy'] = $this->SidebarItemModel->getSidebarHierarchy();
        $this->load->view('sidebar', $data);
    }

    public function module_permissions() {

        $data['roles'] = $this->employee->getRoles();
        $data['sidebar_hierarchy'] = $this->modules->get_modules_hierarchy();
        $head['title'] = "Module Permissions";
        $this->load->view('fixed/header', $head);
        $this->load->view('modules/module_permissions', $data);
        $this->load->view('fixed/footer');
    }

    public function subscriptions() {

        //$data['roles'] = $this->employee->getRoles();
        $data['sidebar_hierarchy'] = $this->modules->get_modules_hierarchy();
        $head['title'] = "Subscription Permissions";
        $this->load->view('fixed/header', $head);
        $this->load->view('modules/subscription_permissions', $data);
        $this->load->view('fixed/footer');
    }


    public function modules_list() {
        $data['modules'] = $this->modules->get_modules_list();
        $head['title'] = "Modules List";
        $this->load->view('fixed/header', $head);
        $this->load->view('modules/modules_list', $data);
        $this->load->view('fixed/footer');
    }

    public function add() {
        
        if(!empty($_POST))
        {
            $data['title'] = $this->input->post('module_name', true);
            $data['url'] = $this->input->post('module_url', true);
            $data['parent_id'] = $this->input->post('module_parent', true);
            $data['type'] = $this->input->post('module_type', true);
            $data['module_type'] = $this->input->post('module_activity_type', true);
            $data['status'] = $this->input->post('module_status', true);
            $data['display_order'] = $this->input->post('module_position', true);
            $data['icon'] = $this->input->post('module_icon', true);
            $data['r_5'] = 1;

            if ($data) {
                $response = $this->modules->add_module($data);
                echo json_encode($response,true);
            }

        }else{
            $data['side_bars'] = $this->modules->get_sidebars();
            $head['title'] = "Add Module";
            $this->load->view('fixed/header', $head);
            $this->load->view('modules/add_module', $data);
            $this->load->view('fixed/footer');
    
        }
       
    }

    public function edit() {
        
        $id = $this->input->get('id');
        if(!empty($id))
        {
            $data['module_details'] = $this->modules->get_module_details($id);
            $data['side_bars'] = $this->modules->get_sidebars();
            $head['title'] = "Edit Module";
            $this->load->view('fixed/header', $head);
            $this->load->view('modules/edit_module', $data);
            $this->load->view('fixed/footer');

        }else{

            $data['side_bars'] = $this->modules->get_sidebars();
            $head['title'] = "Module List";
            $this->load->view('fixed/header', $head);
            $this->load->view('modules/list', $data);
            $this->load->view('fixed/footer');
    
        }
       
    }

    public function update() {
        
        if(!empty($_POST))
        {
            $data['title'] = $this->input->post('module_name', true);
            $data['url'] = $this->input->post('module_url', true);
            $data['parent_id'] = $this->input->post('module_parent', true);
            $data['type'] = $this->input->post('module_type', true);            
            $data['module_type'] = $this->input->post('module_activity_type', true);
            $data['status'] = $this->input->post('module_status', true);
            $data['display_order'] = $this->input->post('module_position', true);
            $data['icon'] = $this->input->post('module_icon', true);
            $module_id = $this->input->post('module_id', true);

            if ($data) {
                $response = $this->modules->update_module($data, $module_id);
                echo json_encode($response,true);
            }

        }else{
            $data['side_bars'] = $this->modules->get_sidebars();
            $head['title'] = "Add Module";
            $this->load->view('fixed/header', $head);
            $this->load->view('modules/modules', $data);
            $this->load->view('fixed/footer');
    
        }
       
    }

    public function delete()
    {
        $id = intval($this->input->post('deleteid'));
        if ($id) {

            if($this->db->where('id',$id)->delete('sidebaritems'))
            {
                $this->db->where('child_id',$id)->or_where('parent_id',$id)->delete('sidebarhierarchy');
                
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Module Deleted Successfully')));        
                
            }else{
                echo json_encode(array('status' => 'Failure', 'message' => $this->lang->line('Module Deleted Failed')));
            }
            
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
        
    }

    public function get_role_module_permissions(){

        $role = $this->input->post('roleid');
        $data['sidebar_hierarchy'] = $this->modules->get_modules_hierarchy();
        $data['role_permissions'] = $this->modules->get_role_module_permissions($role);
        echo $this->load->view('modules/role_module_permissions',$data,TRUE);
    }

    public function update_role_permissions(){
        
        
        $role = $this->input->post('role');
        $selected_modules = $this->input->post('selected_modules');
        $selected_modules = explode(',',$selected_modules);
        $userrole = "r_" . $role; 

        $data1 = array($userrole => 0);
        $this->db->set($data1);
        $this->db->where_not_in('id', $selected_modules);
        $this->db->update('sidebaritems');
        
        $data = array($userrole => 1);        
        $this->db->set($data);
        $this->db->where_in('id', $selected_modules);
        $this->db->update('sidebaritems');
        

        echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('UPDATED')));
    }

    public function update_subscription_permissions(){
        
        
        $role = $this->input->post('role');
        $selected_modules = $this->input->post('selected_modules');
        $selected_modules = explode(',',$selected_modules);
        

        $data1 = array('subscription_status' => 0);
        $this->db->set($data1);
        $this->db->where_not_in('id', $selected_modules);
        $this->db->update('sidebaritems');
        
        $data = array('subscription_status' => 1);        
        $this->db->set($data);
        $this->db->where_in('id', $selected_modules);
        $this->db->update('sidebaritems');
        

        echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('UPDATED')));
    }

}
