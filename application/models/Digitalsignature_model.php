<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Digitalsignature_model extends CI_Model
{
    var $table = 'gtg_digital_signatures';
    
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get_all_digital_signatures()
    {
       
        $query = $this->db->query("SELECT
        gc.*,
        COUNT(gcs.id) AS signings_count
        FROM
            gtg_digital_signatures gc
        LEFT JOIN
            gtg_digital_signature_signings gcs ON gc.id = CAST(gcs.ds_id AS SIGNED)
        GROUP BY
            gc.id
        ORDER BY
            gc.cr_date DESC;
        ");    
        return $query->result_array();

    }

    public function get_digital_signature_by_id($digital_signature_id)
    {
        $query = $this->db->get_where('gtg_digital_signatures', array('id' => $digital_signature_id));
        return $query->row_array();
    }



    // Function to update contract details
    public function update_contract($contract_id, $contract_data)
    {
        $this->db->where('contract_id', $contract_id);
        $this->db->update('gtg_contract', $contract_data);
    }

    public function add_digital_signature($data)
    {
        $this->db->insert('gtg_digital_signatures', $data);
        return ($this->db->affected_rows() > 0) ? $this->db->insert_id() : false;
    }

    

    public function delete_digital_signature($ds_id)
    {
        $this->db->where('id', $ds_id);
        $this->db->delete('gtg_digital_signatures');
    }
}

