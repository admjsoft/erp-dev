<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Scheduler extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Scheduler_model', 'scheduler_model');

        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if (!$this->aauth->premission(9)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $this->li_a = 'emp';
    }
   
	public function schedule()
	{
        $head['title'] = "Add chedule";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
		$data['modules']=$this->scheduler_model->get_all_modules();
	    
        $this->load->view('scheduler/create',$data);
        $this->load->view('fixed/footer');
		
		
	}
	public function scheduleList()
	{
        $head['title'] = "Schedule List";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
		//$data['modules']=$this->scheduler_model->get_all_modules();
        $this->load->view('scheduler/index');
        $this->load->view('fixed/footer');
		
	}
	public function getSchedulelist()
	{
			     $ttype = $this->input->get('type');

        $list = $this->scheduler_model->get_datatables($ttype);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $prd) {
            $no++;
			$scheduler=explode(",",$prd->scheduler_on);
		    $sccheduleron="passport-permit";
		
            $row = array();
            $pid = $prd->id;
		    $row[] = "yes";
            $row[] = $prd->name;
            $row[] = $sccheduleron;
			$row[] = $prd->days;
			$row[] = $prd->created_at;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->scheduler_model->count_all(),
            "recordsFiltered" => $this->scheduler_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);		
    }		
	
	public function create()
	{
			$option = $this->input->post('option');
			$days = $this->input->post('days');
			$module = $this->input->post('module');
			$schedule_on = $this->input->post('schedule_on');
			
			$schdeuleno_days = $this->input->post('Schdeuleno_days');
			$month = $this->input->post('month');
			$minutes = $this->input->post('minutes');
		    $hours = $this->input->post('hours');
			$day = $this->input->post('day');
			$elements = array();
			
foreach($schedule_on as $schedule) {
    //do something
    $elements[] =$schedule;
}
$implodevalues= implode(',', $elements);
$insert= $this->scheduler_model->insert($option,$days,$module,$implodevalues);
	if(!$insert){
                    $data['status'] = 'danger';
                    $data['message'] = $this->lang->line('Schedule Add error');
                    }
					
					else{
                    $data['status'] = 'success';
                    $data['message'] = $this->lang->line('Schedule Added Successfully');
}
	     $_SESSION['status']=$data['status'];
        $_SESSION['message']=$data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');
		 redirect('scheduler/schedule', 'refresh');
        exit();

			
		
		
	}
	
	
	
	
}
