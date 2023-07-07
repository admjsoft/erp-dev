<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{


    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
            exit;
        }

        $this->load->model('dashboard_model');
        $this->load->model('tools_model');
        $this->load->model('employee_model');


    }


    public function index()
    {
        $today = date("Y-m-d");
        $month = date("m");
        $year = date("Y");
        if ($this->aauth->get_user()->roleid > 3) {
            $data['todayin'] = $this->dashboard_model->todayInvoice($today);
            $data['todayprofit'] = $this->dashboard_model->todayProfit($today);
            $data['incomechart'] = $this->dashboard_model->incomeChart($today, $month, $year);
            $data['expensechart'] = $this->dashboard_model->expenseChart($today, $month, $year);
            $data['countmonthlychart'] = $this->dashboard_model->countmonthlyChart();
            $data['monthin'] = $this->dashboard_model->monthlyInvoice($month, $year);
            $data['todaysales'] = $this->dashboard_model->todaySales($today);
            $data['monthsales'] = $this->dashboard_model->monthlySales($month, $year);
            $data['todayinexp'] = $this->dashboard_model->todayInexp($today);
            $data['recent_payments'] = $this->dashboard_model->recent_payments();
            $data['tasks'] = $this->dashboard_model->tasks($this->aauth->get_user()->id);
            $data['recent'] = $this->dashboard_model->recentInvoices();
            $data['recent_buy'] = $this->dashboard_model->recentBuyers();
            $data['goals'] = $this->tools_model->goals(1);
            $data['stock'] = $this->dashboard_model->stock();
			$data['expiry_passport'] = $this->dashboard_model->getExpiryPassport();
			$data['expiry_permit'] = $this->dashboard_model->getExpiryPermit();
            $data['active_passport'] = $this->dashboard_model->getActivePassport();
			$data['active_permit'] = $this->dashboard_model->getActivePermit();
			$data['passport_expiry_thirthy'] = $this->dashboard_model->getthirtyDaysExpiryPassport();
			$data['passport_expiry_sixty'] = $this->dashboard_model->getsixtyDaysExpiryPassport();
			
			$data['passport_expiry_ninety'] = $this->dashboard_model->getninetydaysDaysExpiryPassport();
			$data['permit_expiry_thirthy'] = $this->dashboard_model->getthirtyDaysExpiryPermit();
			$data['permit_expiry_sixty'] = $this->dashboard_model->getsixtyDaysExpiryPermit();
			$data['permit_expiry_ninety'] = $this->dashboard_model->getninetydaysDaysExpiryPermit();
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Dashboard';
            $this->load->view('fixed/header', $head);
            $this->load->view('dashboard', $data);
            $this->load->view('fixed/footer');
        } else if ($this->aauth->premission(4)) {
            $this->load->model('projects_model', 'projects');
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Project List';
            $data['totalt'] = $this->projects->project_count_all();

            $this->load->view('fixed/header', $head);
            $this->load->view('projects/index', $data);
            $this->load->view('fixed/footer');
        } else if ($this->aauth->get_user()->roleid == 1) {
            $head['title'] = "Products";
            $head['usernm'] = $this->aauth->get_user()->username;
            $this->load->view('fixed/header', $head);
            $this->load->view('products/products');
            $this->load->view('fixed/footer');
        } else {
            $head['title'] = "Manage Invoices";
            $head['usernm'] = $this->aauth->get_user()->username;
            $this->load->view('fixed/header', $head);
            $this->load->view('invoices/invoices');
            $this->load->view('fixed/footer');
        }
    }

    public function clock_in()
    {

        $id = $this->aauth->get_user()->id;
        if ($this->aauth->auto_attend()) {
            $this->dashboard_model->clockin($id);
        }

        redirect('dashboard');
    }

    public function clock_out()
    {
         $linkid=$this->input->get('id');
         if(isset($linkid))
         {
        $id = $linkid;
         }
         else{

                    $id = $this->aauth->get_user()->id;

         }
        if ($this->aauth->auto_attend()) {
            $this->dashboard_model->clockout($id);
        }
        redirect('dashboard');
    }
    public function break_in()
    {
        $code = $this->input->get('bt');
          $linkid=$this->input->get('id');
         if(isset($linkid))
         {
        $id = $linkid;
         }
         else{

                    $id = $this->aauth->get_user()->id;

         }
        if ($this->aauth->auto_attend()) {
            $this->dashboard_model->breakin($id,$code);
        }
        redirect('employee/attendview?id='.$id);
    }

    public function break_out()
    {
        $id = $this->aauth->get_user()->id;

        if ($this->aauth->auto_attend()) {
            $this->dashboard_model->breakout($id);
        }
        redirect('employee/attendview?id='.$id);
    }
	
	  public function settings()
    {
        //$this->load->model('employee_model', 'employee');

        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Dashboard Permissions';
       // $data['permission'] = $this->employee->employee_permissions();
	    $data['permission'] = $this->dashboard_model->dashboard_permissions();
        $this->load->view('fixed/header', $head);
        $this->load->view('DashboardSettings', $data);
        $this->load->view('fixed/footer');
    }
	
	 public function subscribeAlert()
	 {
		 $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Dashboard Permissions';
       // $data['permission'] = $this->employee->employee_permissions();
	    $data['permission'] = $this->dashboard_model->dashboard_permissions();
        $this->load->view('fixed/header', $head);
        $this->load->view('subscribAlert', $data);
        $this->load->view('fixed/footer');
		 
	 }
	 
	  public function subscribe()
    {

        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Subscribe Settings';
        $data['permission'] = $this->dashboard_model->subscribe_permissions();
        $this->load->view('fixed/header', $head);
        $this->load->view('subscribeSettings', $data);
        $this->load->view('fixed/footer');
    }
	
	public function updatesubscription()
	{
		
		$head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'subscribe Settings';
        $permission = $this->dashboard_model->subscribe_permissions();
        foreach ($permission as $row) {
            $i = $row['id'];
           $name1 = 'r_' . $i . '_1';
             
            $val1 = 0;
          
            if ($this->input->post($name1)) $val1 = 1;
           
           $data = array('r_1' => $val1);
		   //print_r($data);
		     $this->db->set($data);
             $this->db->where('id', $i);
             $this->db->update('gtg_subscription');
			// print_r($this->db->last_query());
	}
	  echo json_encode(array('status' => 'Success', 'message' =>
        $this->lang->line('UPDATED')));
	}
	
	
	public function dashboardOptions()
	{
		
		
		        $selectoption = $this->input->post('dashboardsettings_35');
			   $selectoption1= $this->input->post('dashboardsettings_36');//	foreach($selectoption as $select)
	//{
	//	print_r($select);
	if(isset($selectoption) && empty($selectoption1))
	{
		$data = array(
                'r_5' => 1
            );
           // $this->db->set($data);
            $this->db->where('id',$selectoption);
            $this->db->update('gtg_premissions',$data); 
				$data = array(
                'r_5' => 0
            );
           // $this->db->set($data);
            $this->db->where('id',36);
            $this->db->update('gtg_premissions',$data); 

	}
	else if(isset($selectoption1) && empty($selectoption))
	{
			$data = array(
                'r_5' => 1
            );
           // $this->db->set($data);
            $this->db->where('id',$selectoption1);
            $this->db->update('gtg_premissions',$data); 
		$data = array(
                'r_5' => 0
            );
           // $this->db->set($data);
            $this->db->where('id',35);
            $this->db->update('gtg_premissions',$data); 
		
		
		
	}
	
	 	else if(isset($selectoption1) && isset($selectoption))
{
		$data = array(
                'r_5' => 1
            );
           // $this->db->set($data);
            $this->db->where('id',$selectoption1);
            $this->db->update('gtg_premissions',$data); 
		$data = array(
                'r_5' => 1
            );
           // $this->db->set($data);
            $this->db->where('id',$selectoption);
            $this->db->update('gtg_premissions',$data); 
		
		
		
		
	}
	
	else{
		
		
	$data = array(
                'r_5' => 0
            );
           // $this->db->set($data);
            $this->db->where('id',35);
            $this->db->update('gtg_premissions',$data); 
		$data = array(
                'r_5' => 0
            );
           // $this->db->set($data);
            $this->db->where('id',36);
            $this->db->update('gtg_premissions',$data); 
			
		
		
	}
	
	
	
		
	//}
		       


			   redirect('dashboard/settings');

	
		
	}
	
	
	
	
	
	
	

}
