<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contract_model extends CI_Model
{
    var $table = 'gtg_contract';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_contracts()
    {
        $query = $this->db->get('gtg_contract');
        return $query->result_array();
    }

    public function get_contract_by_id($contract_id)
    {
        $query = $this->db->get_where('gtg_contract', array('id' => $contract_id));
        return $query->row_array();
    }


/*
    // Function to get contract details by ID
    public function get_contract_by_id($contract_id)
    {
        $this->db->select('c.*, u.*'); // Select relevant fields from both tables
        $this->db->from('gtg_contract c');
        $this->db->join('gtg_uploads u', 'c.contract_id = u.contract_id', 'left'); // Left join to get uploads
        $this->db->where('c.contract_id', $contract_id);
        $query = $this->db->get();

        return $query->result_array(); // Return the contract details with uploads
    }
*/

    // Function to update contract details
    public function update_contract($contract_id, $contract_data)
    {
        $this->db->where('contract_id', $contract_id);
        $this->db->update('gtg_contract', $contract_data);
    }

    public function add_contract($data)
    {
        $this->db->insert('gtg_contract', $data);
        return ($this->db->affected_rows() > 0) ? $this->db->insert_id() : false;
    }

    public function add_contract_file($file_data)
    {
        $this->db->insert('gtg_uploads', $file_data);
        return ($this->db->affected_rows() > 0);
    }


    public function delete_contract($contract_id)
    {
        $this->db->where('id', $contract_id);
        $this->db->delete('gtg_contract');
    }
}

