<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function todayInvoice($today)
    {
        $where = "DATE(invoicedate) ='$today'";
        $this->db->where($where);
        $this->db->from('gtg_invoices');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        return $this->db->count_all_results();
    }

    public function todaySales($today)
    {

        $where = "DATE(invoicedate) ='$today'";
        $this->db->select_sum('total');
        $this->db->from('gtg_invoices');
        $this->db->where($where);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $query = $this->db->get();
        return $query->row()->total;
    }

    public function todayInexp($today)
    {
        $this->db->select('SUM(debit) as debit,SUM(credit) as credit', FALSE);
        $this->db->where("DATE(date) ='$today'");
        $this->db->where("type!='Transfer'");
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $this->db->from('gtg_transactions');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function recent_payments()
    {
        $this->db->limit(13);
        $this->db->order_by('id', 'DESC');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $this->db->from('gtg_transactions');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function stock()
    {
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' AND (gtg_warehouse.loc=' . $this->aauth->get_user()->loc . ')';
        } elseif (!BDATA) {
            $whr = ' AND (gtg_warehouse.loc=0)';
        }

        $query = $this->db->query("SELECT gtg_products.*,gtg_warehouse.title FROM gtg_products LEFT JOIN gtg_warehouse ON gtg_products.warehouse=gtg_warehouse.id  WHERE (gtg_products.qty<=gtg_products.alert) $whr ORDER BY gtg_products.product_name ASC LIMIT 10");
        return $query->result_array();
    }

    public function todayItems($today)
    {
        $where = "DATE(invoicedate) ='$today'";
        $this->db->select_sum('items');
        $this->db->from('gtg_invoices');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row()->items;
    }

    public function todayProfit($today)
    {
        $where = "DATE(gtg_metadata.d_date) ='$today'";
        $this->db->select_sum('gtg_metadata.col1');
        $this->db->from('gtg_metadata');
        $this->db->join('gtg_invoices', 'gtg_metadata.rid=gtg_invoices.id', 'left');
        $this->db->where($where);
        $this->db->where('gtg_metadata.type', 9);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('gtg_invoices.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('gtg_invoices.loc', 0);
        }
        $query = $this->db->get();
        return $query->row()->col1;
    }

    public function incomeChart($today, $month, $year)
    {
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' AND (loc=' . $this->aauth->get_user()->loc . ')';
        } elseif (!BDATA) {
            $whr = ' AND (loc=0)';
        }
        $query = $this->db->query("SELECT SUM(credit) AS total,date FROM gtg_transactions WHERE ((DATE(date) BETWEEN DATE('$year-$month-01') AND '$today') AND type='Income')  $whr GROUP BY date ORDER BY date DESC");
        return $query->result_array();
    }

    public function expenseChart($today, $month, $year)
    {
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' AND (loc=' . $this->aauth->get_user()->loc . ')';
        } elseif (!BDATA) {
            $whr = ' AND (loc=0)';
        }
        $query = $this->db->query("SELECT SUM(debit) AS total,date FROM gtg_transactions WHERE ((DATE(date) BETWEEN DATE('$year-$month-01') AND '$today') AND type='Expense')  $whr GROUP BY date ORDER BY date DESC");
        return $query->result_array();
    }

    public function countmonthlyChart()
    {
        $today = date('Y-m-d');
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' AND (loc=' . $this->aauth->get_user()->loc . ')';
        } elseif (!BDATA) {
            $whr = ' AND (loc=0)';
        }
        $query = $this->db->query("SELECT COUNT(id) AS ttlid,SUM(total) AS total,DATE(invoicedate) as date FROM gtg_invoices WHERE (DATE(invoicedate) BETWEEN '$today' - INTERVAL 30 DAY AND '$today')  $whr GROUP BY DATE(invoicedate) ORDER BY date DESC");
        return $query->result_array();
    }


    public function monthlyInvoice($month, $year)
    {
        $today = date('Y-m-d');
        $days = date("t", strtotime($today));
        $where = "DATE(invoicedate) BETWEEN '$year-$month-01' AND '$year-$month-$days'";
        $this->db->where($where);
        $this->db->from('gtg_invoices');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        return $this->db->count_all_results();
    }
	  public function getExpiryPassport()
	  {
		  $currentdate=date("Y-m-d");
		  $this->db->select('*');
          $this->db->from('gtg_employees');
		$this->db->where('employee_type',"foreign");
	  
          $this->db->where('passport_expiry<',$currentdate);
          $query = $this->db->get();

        return $query->num_rows();
		  
	  }
	public function getExpiryPermit()
	  {
		  $currentdate=date("Y-m-d");
		  $this->db->select('*');
          $this->db->from('gtg_employees');
          $this->db->where('permit_expiry<',$currentdate);
		$this->db->where('employee_type',"foreign");
  
          $query = $this->db->get();

        return $query->num_rows();
		  
	  }
	  public function getActivePassport()
	  {
		 $currentdate=date("Y-m-d");
		  $this->db->select('*');
          $this->db->from('gtg_employees');
          $this->db->where('passport_expiry>=',$currentdate);
		 $this->db->where('employee_type',"foreign");

          $query = $this->db->get();
           return $query->num_rows();  
}
  public function getActivePermit()
	  {
		 $currentdate=date("Y-m-d");
		$this->db->select('*');
        $this->db->from('gtg_employees');
        $this->db->where('permit_expiry>=',$currentdate);
		        $this->db->where('employee_type',"foreign");

        $query = $this->db->get();
        return $query->num_rows();  
}

public function dashboard_permissions()
    {
        $this->db->select('*');
        $this->db->from('gtg_premissions');
        $this->db->order_by('id', 'ASC');
		$this->db->where('settings=',"dashboard");
        $query = $this->db->get();
        return $query->result_array();
    }




public function getthirtyDaysExpiryPassport()
{
			 $current_date=date('Y-m-d');

$thirtydays=date('Y-m-d',strtotime('+30 days'));
	    $this->db->select('*');
        $this->db->from('gtg_employees');
         $this->db->where('permit_expiry<=',$thirtydays);
		 $this->db->where('permit_expiry>=',$current_date);
		$this->db->where('employee_type',"foreign");
		 $this->db->where('delete_status',0);
        $query = $this->db->get();
        return $query->num_rows();  
	
	
}

public function getsixtyDaysExpiryPassport()
{
	$thirtydays=date('Y-m-d',strtotime('+30 days'));

$sixtydays=date('Y-m-d',strtotime('+60 days'));
	    $this->db->select('*');
        $this->db->from('gtg_employees');
 $this->db->where('passport_expiry>',$thirtydays);
		 $this->db->where('passport_expiry<=',$sixtydays);
		 $this->db->where('employee_type',"foreign");
			 		 $this->db->where('delete_status',0);

        $query = $this->db->get();
        return $query->num_rows();  
	
	
}

public function getninetydaysDaysExpiryPassport()
{
	 
		$thirtydays=date('Y-m-d',strtotime('+30 days'));
		$sixtydays=date('Y-m-d',strtotime('+60 days'));
		$ninentydays=date('Y-m-d',strtotime('+90 days'));
         $days=date('Y-m-d',strtotime('+90 days'));
	    $this->db->select('*');
        $this->db->from('gtg_employees');
         $this->db->where('passport_expiry>',$sixtydays);
		 $this->db->where('passport_expiry<=',$ninentydays);
		 $this->db->where('employee_type',"foreign");
		 		 $this->db->where('delete_status',0);

        $query = $this->db->get();
        return $query->num_rows();  
	
	
}



public function getthirtyDaysExpiryPermit()
{
	$current_date=date('Y-m-d');
$thirtydays=date('Y-m-d',strtotime('+30 days'));
	    $this->db->select('*');
        $this->db->from('gtg_employees');
        $this->db->where('permit_expiry<=',$thirtydays);
		 $this->db->where('permit_expiry>=',$current_date);
		 $this->db->where('employee_type',"foreign");
		 $this->db->where('delete_status',0);

        $query = $this->db->get();
	 //print_r($this->db->last_query());
        return $query->num_rows();  
	
	
}

public function getsixtyDaysExpiryPermit()
{
	$thirtydays=date('Y-m-d',strtotime('+30 days'));

$sixtydays=date('Y-m-d',strtotime('+60 days'));
	    $this->db->select('*');
        $this->db->from('gtg_employees');
 $this->db->where('passport_expiry>',$thirtydays);
		 $this->db->where('passport_expiry<=',$sixtydays);
		 $this->db->where('employee_type',"foreign");
		$this->db->where('delete_status',0);
        $query = $this->db->get();
        return $query->num_rows();  
	
	
}

public function getninetydaysDaysExpiryPermit()
{
$ninentydays=date('Y-m-d',strtotime('+90 days'));
$sixtydays=date('Y-m-d',strtotime('+60 days'));

	    $this->db->select('*');
        $this->db->from('gtg_employees');
         $this->db->where('passport_expiry>',$sixtydays);
		 $this->db->where('passport_expiry<=',$ninentydays);
		 $this->db->where('employee_type',"foreign");
		 	    $this->db->where('delete_status',0);

        $query = $this->db->get();
        return $query->num_rows();  
	
	
}

    public function monthlySales($month, $year)
    {
        $today = date('Y-m-d');
        $days = date("t", strtotime($today));
        $where = "DATE(invoicedate) BETWEEN '$year-$month-01' AND '$year-$month-$days'";
        $this->db->select_sum('total');
        $this->db->from('gtg_invoices');
        $this->db->where($where);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $query = $this->db->get();
        return $query->row()->total;
    }


    public function recentInvoices()
    {
        $whr = '';

        if ($this->aauth->get_user()->loc) {
            $whr = ' WHERE (i.loc=' . $this->aauth->get_user()->loc . ') ';
        } elseif (!BDATA) {
            $whr = ' WHERE (i.loc=0) ';
        }
        $query = $this->db->query("SELECT i.id,i.tid,i.invoicedate,i.total,i.status,i.i_class,c.name,c.picture,i.csd
FROM gtg_invoices AS i LEFT JOIN gtg_customers AS c ON i.csd=c.id $whr ORDER BY i.id DESC LIMIT 10");
        return $query->result_array();
    }

    public function recentBuyers()
    {
        $this->db->trans_start();
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' WHERE (i.loc=' . $this->aauth->get_user()->loc . ') ';
        } elseif (!BDATA) {
            $whr = ' WHERE (i.loc=0) ';
        }
        $query = $this->db->query("SELECT MAX(i.id) AS iid,i.csd,SUM(i.total) AS total, c.cid,MAX(c.picture) as picture ,MAX(c.name) as name,MAX(i.status) as status FROM gtg_invoices AS i LEFT JOIN (SELECT gtg_customers.id AS cid, gtg_customers.picture AS picture, gtg_customers.name AS name FROM gtg_customers) AS c ON c.cid=i.csd $whr GROUP BY i.csd ORDER BY iid DESC LIMIT 10;");
        $result = $query->result_array();
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            return 'sql';
        } else {
            return $result;
        }
    }

    public function tasks($id)
    {
        $this->db->select('*');
        $this->db->from('gtg_todolist');
        $this->db->where('eid', $id);
        $this->db->limit(10);
        $this->db->order_by('DATE(duedate)', 'ASC');
        $query = $this->db->get();
        $result = $query->result_array();
        return $result;
    }

    public function clockin($id)
    {
        $this->db->select('clock');
        $this->db->where('id', $id);
        $this->db->from('gtg_employees');
        $query = $this->db->get();
        $emp = $query->row_array();
        $today=date('Y-m-d');
        $time=date('H:i:s');
       // print_r($emp);
        if (!$emp['clock']) {
            $data = array(
                'clock' => 1,
                'cdate' => $today,
                'clockin' => strtotime($time),
                'clockout' => 0
            );
           // $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('gtg_employees',$data);
     	 
            $this->aauth->applog("[Employee ClockIn]  ID $id", $this->aauth->get_user()->username);
        }
 
        return true;
    }

    public function clockout($id)
    {

        $this->db->select('clock,clockin');
        $this->db->where('id', $id);
        $this->db->from('gtg_employees');
        $query = $this->db->get();
        $emp = $query->row_array();
        $time=date('H:i:s');
        if ($emp['clock']) {


            // ending all breaks
            $today = date('Y-m-d');
            $this->db->select('*');
            $this->db->where('emp', $id );
            $this->db->where('status',1);
            $this->db->where('bdate', $today);
            $this->db->order_by("clockin","desc");
            $this->db->from('gtg_attend_break');
            $query = $this->db->get();
            $emp_breaks_list = $query->result_array();

            if(!empty($emp_breaks_list)){
                foreach($emp_breaks_list as $emp_b_list){
                    $time=date('H:i:s');
                    // $total_time = time() - $emp['clockin'];
                    $total_time = strtotime($time) - strtotime($emp_b_list['clockin']);
                    if ((isset($emp_b_list['status']) && ($emp_b_list['status']))) {
                            $emp_b_list_data = array(
                            'status' => 0,
                            'clockout' => $time,
                            'duration'=>date('H:i:s',$total_time)
                        );
            
                        $this->db->set($emp_b_list_data);
                        $this->db->where('id', $emp_b_list['id']);
            
                        $this->db->update('gtg_attend_break');
                        $this->aauth->applog("[Employee ".$emp_b_list['break']." End By System Due to ClockOut]  ID $id", $this->aauth->get_user()->username);
                    }
                }
            }

            
                

            $data = array(
                'clock' => 0,
                'clockin' => 0,
                'clockout' => strtotime($time)
            );
           $total_time = strtotime($time) - $emp['clockin'];
           // $total_time = time() - $emp['clockin'];

            $this->db->set($data);
            $this->db->where('id', $id);

            $this->db->update('gtg_employees');
            $this->aauth->applog("[Employee ClockOut]  ID $id", $this->aauth->get_user()->username);

            $today = date('Y-m-d');

            $this->db->select('id,adate');
            $this->db->where('emp', $id);
            $this->db->where('DATE(adate)', date('Y-m-d'));
            $this->db->from('gtg_attendance');
            $query = $this->db->get();
            $edate = $query->row_array();
            if ($edate['adate']) {


                $this->db->set('actual_hours', "actual_hours+$total_time", FALSE);
                $this->db->set('tto', date('H:i:s'));
                $this->db->where('id', $edate['id']);
                $this->db->update('gtg_attendance');
            } else {
                $data = array(
                    'emp' => $id,
                    'adate' => date('Y-m-d'),
                    'tfrom' => date("H:i:s",$emp['clockin']),
                    'tto' => date('H:i:s'),
                    'note' => 'Self Attendance',
                    'actual_hours' => date("H:i:s",$total_time)
                );


                $this->db->insert('gtg_attendance', $data);
            }
        }
        return true;
    }

    public function breakin($id,$code)
    {
        $today = date('Y-m-d');
        $this->db->select('status,clockin');
        $this->db->where('emp', $id);
        $this->db->where('bdate', $today);
        $this->db->order_by("clockin","desc");
        $this->db->limit(1);
        $this->db->from('gtg_attend_break');
        $query = $this->db->get();
        $emp = $query->row_array();
        $rw=$this->employee_model->get_break_time($code);
        $break='';
            foreach($rw as $br){
                $break=$br['name'];
            }
        $data=array();
        $time=date('H:i:s');
        $temp=array('status' => true,'message' => $break);

        if ((isset($emp['status']) && ($emp['status']))) {
        $temp=array('status' => false,'message' => "end previous break");
        }else{
            echo 'status: '.$emp['status'];
            $data = array(
                'emp' => $id,
                'break'=>$break,
                'code' => $code,
                'bdate' => date('Y-m-d'),
                'status' => 1,
                'clockin' => $time,
                'clockout' => 0,
                'duration'=>0
            );
            $this->db->insert('gtg_attend_break', $data);
            $this->aauth->applog("[Employee ".$break." Start]  ID $id", $this->aauth->get_user()->username);
        }
         return $temp;
         exit();
    }

    public function breakout($id)
    {
        $today = date('Y-m-d');
        $this->db->select('*');
        $this->db->where('emp', $id);
        $this->db->where('bdate', $today);
        $this->db->order_by("clockin","desc");
        $this->db->limit(1);
        $this->db->from('gtg_attend_break');
        $query = $this->db->get();
        $emp = $query->row_array();
        $time=date('H:i:s');
        // $total_time = time() - $emp['clockin'];
         $total_time = strtotime($time) - strtotime($emp['clockin']);
         $temp=array('status' => false,'message' => "Start break found for end");
         if ((isset($emp['status']) && ($emp['status']))) {
                $data = array(
                'status' => 0,
                'clockout' => $time,
                'duration'=>date('H:i:s',$total_time)
            );

            $this->db->set($data);
            $this->db->where('id', $emp['id']);

            $this->db->update('gtg_attend_break');
            $this->aauth->applog("[Employee ".$emp['break']." End]  ID $id", $this->aauth->get_user()->username);

            $temp=array('status' => true,'message' => $emp['break']);

        }
        return $temp;
        exit();
    }


 public function subscribe_permissions()
    {
        $this->db->select('*');
        $this->db->from('gtg_subscription');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

 function fetch_year()
 {
  $this->db->select('year');
  $this->db->from('chart_data');
  $this->db->group_by('year');
  $this->db->order_by('year', 'DESC');
  return $this->db->get();
 }

 function fetch_chart_data($year)
 {
	 
	  $this->db->select('sum(netPay) as amount,monthText');
  $this->db->from('gtg_payslip');
  $this->db->where('year', $year);
  $this->db->group_by('monthText'); 
  $this->db->order_by('year', 'DESC');


   $query=$this->db->get();
          return $query->result_array();

  //$this->db->where('year', $year);
 // $this->db->order_by('year', 'ASC');
 // return $this->db->get('gtg_payslip');
 }

	




}
