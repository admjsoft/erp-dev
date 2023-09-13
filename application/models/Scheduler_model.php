<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Scheduler_model extends CI_Model
{

    var $tcolumn_order = array(null, 'scheduler_on', 'module');
    var $tcolumn_search = array('id', 'scheduler_on');
    var $torder = array('id' => 'asc');
    var $eid = '';

    private function _get_datatables_query()
    {
$this->db->select('scheduler.id,scheduler.run_scheduler_expiry_date,scheduler.module,scheduler.scheduler_on,
scheduler.days,scheduler.email_to,scheduler.status,scheduler.created_at,modules_new.name as name');
        $this->db->from('scheduler');
        //$this->db->where('eid', $this->eid);
        $this->db->join('modules_new', 'modules_new.id=scheduler.module');
        $i = 0;
        foreach ($this->tcolumn_search as $item) // loop column
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

                if (count($this->tcolumn_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->tcolumn_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->torder)) {
            $order = $this->torder;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_datatables($eid)
    {
        $this->eid = $eid;
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered()
    {
        $this->db->from('scheduler');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('scheduler');
        return $this->db->count_all_results();
    }



 public function get_all_modules()
 {
	 
        $this->db->from('modules_new');
        $query = $this->db->get();
	    return $query->result_array();

	 
 }
 
 
 public function insert($option,$days,$module,$implodevalues,$email_to)
 {
	 
	 $create_at=date("Y-m-d");
	 $option="yes";
	// if($option=="yes")
	// {
	 $data = array('run_scheduler_expiry_date' =>$option, 'days' => $days, 'module' => $module,'scheduler_on' => $implodevalues,'email_to'=>$email_to,
	 
	 'created_at'=>$create_at);
	// }
	// else
	// {
	// $data = array('run_scheduler_expiry_date' => $option,'Schdeuleno_days' => $schdeuleno_days,'minutes' => $minutes,
	// 'hours' => $hours,'month' => $month,'day' => $day,'module' => $module,'created_at'=>$create_at);
	// }
    return $this->db->insert('scheduler', $data);
	 
 }	 
 
 public function get_schedule($id)
 {
	 $this->db->from('scheduler');
    $this->db->where('id', $id);
	$query = $this->db->get();
	return $query->row();
	 
	 
 }
 
 
 
 
}
