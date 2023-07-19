<?php

defined("BASEPATH") or exit("No direct script access allowed");

class Asset_history extends CI_Model
{
    var $table = 'asset_history';
    var $column_order = array(null,'asset_history.assign_asset_employee', 'asset_history.action', 'asset_history.created_at');
    var $column_search = array('asset_history.assign_asset_employee', 'asset_history.action', 	'asset_history.created_at');
    var $order = array('asset_history.id' => 'desc');

    public function __construct()
    {
        parent::__construct();
    }


    private function _get_datatables_query()
    {

        $this->db->select('*');
        $this->db->from($this->table);


        $i = 0;

        foreach ($this->column_search as $item) // loop column
        {
            if ($this->input->post('search')['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
			//print_r($order);
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($eid)
    {
        $this->_get_datatables_query($eid);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($eid)
    {
        $this->_get_datatables_query($eid);
       
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all($eid)
    {
        $this->db->select('gtg_quotes.id');
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }


}
