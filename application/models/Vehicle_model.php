<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vehicle_model extends CI_Model
{
    var $table = 'gtg_vehicles';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_vehicles()
    {
       
        // $query = $this->db->query("SELECT * FROM gtg_vehicles WHERE delete_status = 0");
        // return $query->result_array();
        $this->db->select('gtg_vehicles.*, gtg_employees.name as employee_name');
        $this->db->from('gtg_vehicles');
        $this->db->join('gtg_employees', 'gtg_employees.id = gtg_vehicles.emp_id');
        $this->db->where('gtg_vehicles.delete_status', 0);
        $query = $this->db->get();
        return $query->result_array();


    }

    public function get_vehicle_by_id($vehicle_id)
    {
        // $query = $this->db->get_where('gtg_vehicles', array('id' => $vehicle_id));
        // return $query->row_array();
        $this->db->select('gtg_vehicles.*, gtg_employees.name as employee_name');
        $this->db->from('gtg_vehicles');
        $this->db->join('gtg_employees', 'gtg_employees.id = gtg_vehicles.emp_id');
        $this->db->where('gtg_vehicles.id', $vehicle_id);
        $query = $this->db->get();
        return $query->row_array();

    }



    // Function to update contract details
    public function update_vehicle($vehcle_id, $vehicle_data)
    {
        $this->db->where('id', $vehcle_id);
        $this->db->update('gtg_vehicles', $vehicle_data);
        return true;
    }

    public function add_vehicle($data)
    {
        $this->db->insert('gtg_vehicles', $data);
        return ($this->db->affected_rows() > 0) ? $this->db->insert_id() : false;
    }


    public function get_drivers_based_on_user_role(){

        $this->db->select('gtg_employees.name,gtg_employees.id');
        $this->db->from('gtg_users');
        $this->db->join('gtg_role', 'gtg_users.roleid = gtg_role.id');
        $this->db->join('gtg_employees', 'gtg_users.id = gtg_employees.id');
        $this->db->where_in('LOWER(gtg_role.role_name)', array('driver', 'drivers'));
        $query = $this->db->get();
        return $query->result_array();

    }

    public function delete_vehicle($vehicle_id)
    {   
        $data['delete_status'] = 1;
        $this->db->where('id', $vehicle_id);
        $this->db->update('gtg_vehicles',$data);
    }
}

