<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Employee_model extends CI_Model
{


   
   
    var $acolumn_order = array(null, 'gtg_attendance.emp', 'gtg_attendance.adate', null, null);
    var $acolumn_search = array('gtg_employees.name', 'gtg_attendance.adate');

	function employee_datatables()
    {
        $this->employee_datatables_query();
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }



public function employee_datatables_query()
    {
		
            $cid = $this->input->post('cid');
        $this->db->select('gtg_employees.id,gtg_employees.name,gtg_employees.passport,
		gtg_employees.delete_status,gtg_employees.passport_document,gtg_employees.visa_document,gtg_employees.passport_expiry,gtg_employees.permit_expiry,
		gtg_employees.permit,gtg_customers.company as cname');
        $this->db->from('gtg_employees');
	$this->db->join('gtg_customers', 'gtg_customers.id=gtg_employees.company');
        $this->db->where('employee_type',"foreign");
     if(!empty($cid) && isset($cid))
	 {
	 $this->db->where('gtg_employees.company',$cid);
	 }



        $i = 0;

        foreach ($this->acolumn_search as $item) // loop column
        {
            $search = $this->input->post('search');
            if($search){
            $value = $search['value'];
            }else{$value = 0;}
            if ($value) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->acolumn_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->acolumn_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->acolumn_order)) {
            $order = $this->acolumn_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

  public  function employee_count_filtered()
    {
        $this->employee_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function employee_count_all()
    {
        $this->employee_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }


public function get_client_list()
	{
		$this->db->select('*');
        $this->db->from('gtg_customers');
                $this->db->where('customer_type', "foreign");

		$query = $this->db->get();
        return $query->result_array();
		
	}

public function employee_foreign_details($id)
    {
        $this->db->select('*');
        $this->db->from('gtg_employees');
        $this->db->where('gtg_employees.id', $id);
		$this->db->where('gtg_employees.employee_type',"foreign");

        $query = $this->db->get();
        return $query->row();
    }

public function get_employee_list($id)
{
	
	 $this->db->select('*');
        $this->db->from('gtg_employees');
        $this->db->where('gtg_employees.company', $id);
		$this->db->where('gtg_employees.employee_type',"foreign");

        $query = $this->db->get();
        return $query->result_array();
	
	
}




	function employee_report_datatables()
    {
        $this->employee_report_datatables_query();
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
   
   }



public function updateInternational($id,$emp_name,$email,$passport,$permit,$country,$company,$type,$passport_expiry,$permit_expiry,$filename)
{ 
$type="foreign";
	 $data = array(
                'username' => $emp_name,
				'email' => $email,
                'name' => $emp_name,
                'country' => $country,
                'company' => $company,
                'passport' => $passport,
                'permit' => $permit,
				'permit_expiry'=>$permit_expiry,
				'passport_expiry'=>$passport_expiry,
				'employee_type'=>$type,
				'document'=>$filename);
$this->db->where('id', $id);
            return $this->db->update('gtg_employees',$data);

}


public function employee_report_datatables_query()
    {
	   $company = $this->input->post('company');
       $expiry = $this->input->post('expiry');
       $employee = $this->input->post('employee');
        $this->db->select('gtg_employees.*,gtg_countries.country_name');
        $this->db->from('gtg_employees');
        $this->db->join('gtg_countries', 'gtg_countries.id=gtg_employees.company', 'left');

		if(empty($expiry) && !empty($employee))
		{
        $this->db->where('id',$employee);
		$this->db->where('employee_type',"foreign");
		$this->db->where('company',$company);

		}
		else if(!empty($expiry) && !empty($employee))
		{
			if($expiry==1)
			{
				$thirtydays=date('Y-m-d',strtotime('+30 days'));
        $this->db->where('id',$employee);
		$this->db->where('company',$company);

				    $this->db->where('passport_expiry',$thirtydays);
				$this->db->where('permit_expiry',$thirtydays);

		$this->db->where('employee_type',"foreign");
				
			}
			
			else if($expiry==2)
			{
				$sixtydays=date('Y-m-d',strtotime('+60 days'));
   $this->db->where('id',$employee);
		$this->db->where('company',$company);
				    $this->db->where('passport_expiry',$sixtydays);
									$this->db->where('permit_expiry',$sixtydays);

		$this->db->where('employee_type',"foreign");
				
			}
			else{
				
				$ninentydays=date('Y-m-d',strtotime('+90 days'));
   $this->db->where('id',$employee);
		$this->db->where('company',$company);
				    $this->db->where('passport_expiry',$ninentydays);
		$this->db->where('employee_type',"foreign");
			$this->db->where('permit_expiry',$ninentydays);

			}
		

		}
		else{
		 $this->db->where('employee_type',"foreign");
		$this->db->where('company',$company);

		}
		
        $i = 0;

        foreach ($this->acolumn_search as $item) // loop column
        {
            $search = $this->input->post('search');
            if($search){
            $value = $search['value'];
            }else{$value = 0;}
            if ($value) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->acolumn_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->acolumn_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->acolumn_order)) {
            $order = $this->acolumn_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

  public  function employee_report_count_filtered()
    {
        $this->employee_report_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function employee_report_count_all()
    {
        $this->employee_report_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

  public function details_by_username($username)
    {
        $this->db->select('*');
        $this->db->from('gtg_employees');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row_array();
    }
	
public function demo()
{
	echo"check";
	
	
	

}

}
