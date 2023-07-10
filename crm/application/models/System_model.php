<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class System_model extends CI_Model
{
    public function __construct()
    {
        $query = $this->db->query("SELECT * FROM gtg_system WHERE id=1 LIMIT 1");
        $row = $query->row_array();

        $this->config->set_item('ctitle', $row["cname"]);
        $this->config->set_item('address', $row["address"]);
        $this->config->set_item('city', $row["city"]);
        $this->config->set_item('region', $row["region"]);
        $this->config->set_item('country', $row["country"]);
        $this->config->set_item('phone', $row["phone"]);
        $this->config->set_item('email', $row["email"]);
        $this->config->set_item('tax', $row["tax"]);
        $this->config->set_item('taxno', $row["taxid"]);
        $this->config->set_item('currency', $row["currency"]);
        $this->config->set_item('format_curr', $row["currency_format"]);
        $this->config->set_item('prefix', $row["prefix"]);
        // $this->config->set_item('date_f',$row["dfomat"]);
        $this->config->set_item('tzone', $row["zone"]);
        $this->config->set_item('logo', $row["logo"]);


        switch ($row['dformat']) {
            case 1:
                $this->config->set_item('date', date("d-m-Y"));
                $this->config->set_item('dformat', "d-m-Y");
                $this->config->set_item('dformat2', "dd-mm-yy");
                break;
            case 2:
                $this->config->set_item('date', date("Y-m-d"));
                $this->config->set_item('dformat', "Y-m-d");
                $this->config->set_item('dformat2', "yy-mm-dd");
                break;
            case 3:
                $this->config->set_item('date', date("Y-m-d"));
                $this->config->set_item('dformat', "Y-m-d");
                $this->config->set_item('dformat2', "yy-mm-dd");
                break;
        }




    }
    public function get_email_id(){
        $id=1;
        $this->db->select('email');
        $this->db->from('gtg_system');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array()[0]['email'];
    }
}