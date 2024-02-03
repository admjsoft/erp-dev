<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Officeforms_model extends CI_Model
{
    var $table = 'gtg_office_forms';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_office_forms()
    {
       
        $query = $this->db->query("SELECT * FROM gtg_office_forms WHERE status = 1");    
        return $query->result_array();

    }

    public function get_office_from_by_id($office_form_id)
    {
        $query = $this->db->get_where('gtg_office_forms', array('id' => $office_form_id));
        return $query->row_array();
    }



    // Function to update contract details
    public function update_contract($contract_id, $contract_data)
    {
        $this->db->where('contract_id', $contract_id);
        $this->db->update('gtg_contract', $contract_data);
    }

    public function add_office_form($data)
    {
        $this->db->insert('gtg_office_forms', $data);
        return ($this->db->affected_rows() > 0) ? $this->db->insert_id() : false;
    }

    

    public function delete_office_form($of_id)
    {
        $data['status'] = 0;
        $this->db->where('id', $of_id);
        $this->db->update('gtg_office_forms',$data);
    }
}

