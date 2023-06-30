<?php

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
	
 
 
    public function get_user($id)
  {
	  
	    $this->db->select('*');
        $this->db->from('gtg_users');
		$this->db->where('id',$id);
        $query = $this->db->get();
        return $query->row();
	  
	  
  }
}
