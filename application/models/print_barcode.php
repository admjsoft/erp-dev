<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Print_Barcode extends CI_Model
{
	var $column_order = array('id', 'asset_id', 'assign_employee', 'action','created_at');
    var $column_search = array('id', 'name', 'description', 'action','created_at');
    var $order = array('id' => 'desc');
    var $opt = '';

	  private function _get_datatables_query()
    {
        $this->db->select('*');
        $this->db->from('asset_history');
         $this->db->join('asset_management','asset_management.id=asset_history.asset_id'); 
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        }

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
			//print_r($this->column_order[$_POST['order']['0']['column']);
			//die;
			   //$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
		 
       function get_datatables($opt = 'all')
    {
        $this->opt = $opt;
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 // expenses filtered
    function count_filtered()
    {
        $this->db->from('asset_history');
        $query = $this->db->get();
        return $query->num_rows();
    }
    // expense count function
    public function count_all()
    {
        $this->db->from('asset_history');
        return $this->db->count_all_results();
    }
   
 
 

}
