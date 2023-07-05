<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jobsheets extends CI_Controller
{

   public function __construct()
    {
        parent::__construct();
        $this->load->model('jobsheet_model', 'jobsheet');
        $this->load->model('employee_model', 'employee');
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if (!$this->aauth->premission(15)&&!$this->aauth->premission(16)&&!$this->aauth->premission(17)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $this->li_a = 'Jobsheet';
    }

    public function index()
    {
       // $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Jobsheet';
        $data['totalt'] = $this->jobsheet->jobsheet_count_filtered('');
        $data['assign']= $this->jobsheet->jobsheet_count_filtered('Assign');
        $data['pending']= $this->jobsheet->jobsheet_count_filtered('Pending');
        $data['completed']= $this->jobsheet->jobsheet_count_filtered('Completed');

       // print_r($data);
          $this->load->view('fixed/header', $head);
          $this->load->view('jobsheet/jobs', $data);
          $this->load->view('fixed/footer');
    }

    public function create($data=null)
    {
       // $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Jobsheet - Create Task';
       // $data['totalt'] = $tickets->ticket_count_all('');
       // print_r($data);
        $this->load->library("custom");
        $data['custom_fields_c'] = $this->custom->add_fields(1);
        $this->load->model('customers_model', 'customers');
        $data['customergrouplist'] = $this->customers->group_list();

          $this->load->view('fixed/header', $head);
          $this->load->view('jobsheet/create',$data);
          $this->load->view('fixed/footer');
    }

    public function edit()
    {
        $id = $this->input->get('id');
       // $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Jobsheet - Edit Task';
       // $data['totalt'] = $tickets->ticket_count_all('');
       // print_r($data);
        $this->load->library("custom");
        $data['custom_fields_c'] = $this->custom->add_fields(1);
        $this->load->model('customers_model', 'customers');
        $data['customergrouplist'] = $this->customers->group_list();
        $data['job_details'] = $this->jobsheet->get_job_details_info($id);

        if($data['job_details']['status'] == 2 || $data['job_details']['status'] == 3)
        {
            // echo "<pre>"; print_r($data); echo "</pre>";
            // exit;
            $this->load->view('fixed/header', $head);
            $this->load->view('jobsheet/edit',$data);
            $this->load->view('fixed/footer');
        }else{

            $_SESSION['status']='500';
            $_SESSION['message']= 'Not Allowed';
            $this->session->mark_as_flash('status');
            $this->session->mark_as_flash('message');
            redirect('jobsheets', 'refresh');
        }
       
    }

    public function add_task()
    {
        $data=array();
        $title=$this->input->post('title');
        $description=$this->input->post('description');
        $timeFrame=$this->input->post('timeFrame');


        $cid=$this->input->post('cid');
        $cname=$this->input->post('cname');
        $location=$this->input->post('location');
        $date=$this->input->post('date');
        $time=$this->input->post('time');
        $invoice=0;
        if(isset($_POST['invoice'])){
        $invoice=1;
        }
        $create_user=$this->aauth->get_user()->id;
        $uploaddoc=false;
        $created_at=date("Y-m-d")." ".date("h:i:s");
        $jobid=$this->jobsheet->addtask($title, $description, $timeFrame, $create_user, $created_at, $cid, $cname, $location, $date, $time, $invoice);
        $message="";
        if( $jobid>0) {
            $attach = $_FILES['userfile']['name'];
            if ($attach){
                    $config['upload_path'] = './userfiles/documents';
                    $config['allowed_types'] = 'docx|docs|txt|pdf|xls';
                    $config['file_ext_tolower'] = TRUE;
                    $config['encrypt_name'] = FALSE;
                    $config['max_size'] = 3000;
                    $config['file_name'] = time() . str_replace(' ', '_', $attach);

                    $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                        $data['response'] = 0;
                        $data['responsetext'] = $this->lang->line('File upload error');

                } else {
                        $data['response'] = 1;
                        $data['responsetext'] = $this->lang->line('File upload success').' <a href="documents?id=' . $jobid . '"
                                            class="btn btn-indigo btn-md"><i
                                                        class="icon-folder"></i>
                                            </a>';
                        $filename = $this->upload->data()['file_name'];

                        $uploaddoc=$this->jobsheet->addtaskdocument($title, $filename, $jobid);

                        if(!$uploaddoc){
                        $message=$this->lang->line('File upload error');
                        }
                    }

                if($uploaddoc && ($jobid>0)){
                        $this->aauth->applog("[Jobsheets Added]  TaskId " . $jobid, $this->session->userdata('username'));
                        $data['status'] = 'success';
                        $data['message'] = $this->lang->line('ADDED') . '' . '&nbsp;<a href="' . base_url('jobsheets') . '" class="btn btn-info btn-sm"><span class="icon-eye"></span> ' . $this->lang->line('View') . ' </a>';

                }else{
                        $this->jobsheet->delete($jobid);
                        $data['status'] = 'danger';
                        $data['message']=$this->lang->line('ERROR').". ".$message;
                }
            } else {
                if($jobid>0){
                            $this->aauth->applog("[Jobsheets Added]  TaskId " . $jobid, $this->session->userdata('username'));
                            $data['status'] = 'success';
                            $data['message'] = $this->lang->line('ADDED') . '' . '&nbsp;<a href="' . base_url('jobsheets') . '" class="btn btn-info btn-sm"><span class="icon-eye"></span> ' . $this->lang->line('View') . ' </a>';
                    }else{
                            $this->jobsheet->delete($jobid);
                            $data['status'] = 'danger';
                            $data['message']=$this->lang->line('ERROR').". ".$message;
                 }
            }
        }else{
            $data['status'] = 'danger';
            $data['message']=$this->lang->line('ERROR').". ".$message;

        }
        unset($_POST);
        $_SESSION['status']=$data['status'];
        $_SESSION['message']=$data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');
        redirect('jobsheets/create', 'refresh');
    }


    public function edit_task()
    {
        $data=array();
        $title=$this->input->post('title');
        $description=$this->input->post('description');
        $timeFrame=$this->input->post('timeFrame');

        $job_id=$this->input->post('job_id');
        $cid=$this->input->post('cid');
        $cname=$this->input->post('cname');
        $location=$this->input->post('location');
        $date=$this->input->post('date');
        $time=$this->input->post('time');
        $invoice=0;
        if(isset($_POST['invoice'])){
        $invoice=1;
        }
        $create_user=$this->aauth->get_user()->id;
        $uploaddoc=false;
        $created_at=date("Y-m-d")." ".date("h:i:s");
        $jobid=$this->jobsheet->edittask($job_id, $title, $description, $timeFrame, $create_user, $created_at, $cid, $cname, $location, $date, $time, $invoice);
        $message="";
        if( $jobid>0) {
            $attach = $_FILES['userfile']['name'];
            if ($attach){
                    $config['upload_path'] = './userfiles/documents';
                    $config['allowed_types'] = 'docx|docs|txt|pdf|xls';
                    $config['file_ext_tolower'] = TRUE;
                    $config['encrypt_name'] = FALSE;
                    $config['max_size'] = 3000;
                    $config['file_name'] = time() . str_replace(' ', '_', $attach);

                    $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                        $data['response'] = 0;
                        $data['responsetext'] = $this->lang->line('File upload error');

                } else {
                        $data['response'] = 1;
                        $data['responsetext'] = $this->lang->line('File upload success').' <a href="documents?id=' . $jobid . '"
                                            class="btn btn-indigo btn-md"><i
                                                        class="icon-folder"></i>
                                            </a>';
                        $filename = $this->upload->data()['file_name'];

                        $uploaddoc=$this->jobsheet->addtaskdocument($title, $filename, $jobid);

                        if(!$uploaddoc){
                        $message=$this->lang->line('File upload error');
                        }
                    }

                if($uploaddoc && ($jobid>0)){
                        $this->aauth->applog("[Jobsheets Added]  TaskId " . $jobid, $this->session->userdata('username'));
                        $data['status'] = 'success';
                        $data['message'] = $this->lang->line('UPDATED') . '' . '&nbsp;<a href="' . base_url('jobsheets') . '" class="btn btn-info btn-sm"><span class="icon-eye"></span> ' . $this->lang->line('View') . ' </a>';

                }else{
                        $this->jobsheet->delete($jobid);
                        $data['status'] = 'danger';
                        $data['message']=$this->lang->line('ERROR').". ".$message;
                }
            } else {
                if($jobid>0){
                            $this->aauth->applog("[Jobsheets Added]  TaskId " . $jobid, $this->session->userdata('username'));
                            $data['status'] = 'success';
                            $data['message'] = $this->lang->line('UPDATED') . '' . '&nbsp;<a href="' . base_url('jobsheets') . '" class="btn btn-info btn-sm"><span class="icon-eye"></span> ' . $this->lang->line('View') . ' </a>';
                    }else{
                            $this->jobsheet->delete($jobid);
                            $data['status'] = 'danger';
                            $data['message']=$this->lang->line('ERROR').". ".$message;
                 }
            }
        }else{
            $data['status'] = 'danger';
            $data['message']=$this->lang->line('ERROR').". ".$message;

        }
        unset($_POST);
        $_SESSION['status']=$data['status'];
        $_SESSION['message']=$data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');
        redirect('jobsheets/create', 'refresh');
    }

    public function tasks_load_list()
    {
        $filt = $this->input->get('stat');
        $status = $this->input->post('status');
        $employee = $this->input->post('employee');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $list = $this->jobsheet->jobsheet_datatables($filt,$status,$employee,$start_date,$end_date);
        $data = array();
        $no = $this->input->post('start');

        foreach ($list as $jobsheet) {
            $row = array();
            $no++;
            $row[] = '<input class="form-check" type="checkbox" name="messaging_team_id_selection"  MessagingType="team" fetchUrl="" fetchId="' . $jobsheet->id . '">';;
            $row[] = $no;
            $row[] = $jobsheet->job_name;
            $row[] = dateformat_time($jobsheet->created_at);
            $temp = '<span class="st-' . $jobsheet->status . '">';
            if($jobsheet->status==1){
                $temp.="Completed";
            }elseif($jobsheet->status==2){
                $temp.="Pending";
            }
            elseif($jobsheet->status==3){
               $temp.='<a class="btn btn-danger btn-xs assign-object" href="#" data-object-id="' . $jobsheet->id . '"> <i class="fa fa-pencil-square-o "></i> Assign</a>';
               //$temp.="unassigned";
            }elseif($jobsheet->status==4){
                $temp.="WorkInProgress";
            }elseif($jobsheet->status==5){
                $temp.="Close";
            }elseif($jobsheet->status==6){
                $temp.="ReOpen";
            }elseif($jobsheet->status==7){
                $temp.="ReAssign";
            }


            $temp.='</span>';
            $row[]=$temp;


            if(!empty($jobsheet->completed_time))
            {
                $completed_date = date('Y-m-d h:i:s',strtotime($jobsheet->completed_time));
            }else{
                $completed_date = date('Y-m-d h:i:s');
            }
                
            $given_hours = $jobsheet->man_days;
            $completed_date = date('Y-m-d h:i:s',strtotime($completed_date));
            $job_given_date = date('Y-m-d h:i:s',strtotime($jobsheet->cdate." ".$jobsheet->ctime));
            $estimated_completed_date = date('d-m-Y h:i:s', strtotime($job_given_date . '+'.$given_hours.' hours'));

            $completed_date = strtotime($completed_date);
            $job_given_date = strtotime($job_given_date);

             
            $diffInSeconds = $completed_date - $job_given_date;
            $hours = floor($diffInSeconds / 3600);

    

            $row[] = $jobsheet->assigned_name;
            $row[]= $estimated_completed_date;
          

            $temp = '<a href="' . base_url('jobsheets/thread/?id=' . $jobsheet->id) . '" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> ' . $this->lang->line('View') . '</a>';
            if($jobsheet->status==2 || $jobsheet->status==3){
            $temp .= '<a href="' . base_url('jobsheets/edit/?id=' . $jobsheet->id) . '" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> ' . $this->lang->line('Edit') . ' </a>';
            }
            $temp .= '<a class="btn btn-danger btn-xs delete-object" href="#" data-object-id="' . $jobsheet->id . '"> <i class="fa fa-trash "></i> </a>';
            if ($this->aauth->premission(23)&&($jobsheet->cinvoice==1)) {
                if($jobsheet->status==1){
            $temp .='<form action="' . base_url('invoices/create').'" method="post"><a href="' . base_url('invoices/create/?cid=' . $jobsheet->cid) . '" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i> ' . $this->lang->line('Create Invoice') . '</a>';
                }
            }
            $row[]=$temp;

            

            //echo $hours. "=====". $given_hours;
            if($hours > $given_hours)
            {
                $row[] = '1';
            }else{
                $row[] = '0';
            }
                           
            
            $data[] = $row;
        }

        $output = array(
           // "draw" => $_POST['draw'],
            "recordsTotal" => $this->jobsheet->jobsheet_count_all($filt,$status,$employee,$start_date,$end_date),
            "recordsFiltered" => $this->jobsheet->jobsheet_count_filtered($filt,$status,$employee,$start_date,$end_date),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function thread()
    {
        $this->load->helper(array('form'));
        $thread_id = $this->input->get('id');

        $data['response'] = 3;
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Add Jobsheet Update';

        $this->load->view('fixed/header', $head);

         $data['doc']=$this->jobsheet->thread_doc_info($thread_id);

        if ($this->input->post('content')) {

            $message = $this->input->post('content');
            $attach = $_FILES['userfile']['name'];
            if ($attach) {
                $config['upload_path'] = './userfiles/support';
                $config['allowed_types'] = 'docx|docs|txt|pdf|xls|png|jpg|gif';
                $config['max_size'] = 3000;
                $config['file_name'] = time() . str_replace(' ', '_', $attach);
                $config['file_ext_tolower'] = TRUE;
                $config['encrypt_name'] = FALSE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    $data['response'] = 0;
                    $data['responsetext'] = $this->lang->line('File upload error');
                } else {
                    $data['response'] = 1;
                    $data['responsetext'] = $this->lang->line('Reply success');
                    $filename = $this->upload->data()['file_name'];
                    $this->jobsheet->addjobsheetreply($thread_id, $message, $filename);
                }
            } else {
                $this->jobsheet->addjobsheetreply($thread_id, $message, '');
                $data['response'] = 1;
                $data['responsetext'] = $this->lang->line('Reply success');
            }

            $data['thread_info'] = $this->jobsheet->thread_jobsheet_info($thread_id);
            $data['thread_list'] = $this->jobsheet->thread_jobsheet_list($thread_id);

            $this->load->view('jobsheet/thread', $data);
        } else {

            $data['thread_info'] = $this->jobsheet->thread_jobsheet_info($thread_id);
            $data['thread_list'] = $this->jobsheet->thread_jobsheet_list($thread_id);

            $this->load->view('jobsheet/thread', $data);
        }
        $this->load->view('fixed/footer');
    }

    public function update_status()
    {
        $jid = $this->input->post('jid');
        $status = $this->input->post('status');
        $remarks = $this->input->post('remarks');
        $time_stamp = '';
        
        
        if($status==1){
            $temp="Completed";
            $time_stamp = date('Y-m-d h:i:s');
            
        }elseif($status==2){
            $temp="Pending";
        }
        elseif($status==3){
            $temp="unassigned";
        }
        elseif($status==4){

            $temp = "WorkInProgress";
        }elseif($status==5){

            $temp = "Close";
        }elseif($status==6){

            //$temp = "ReOpen";
            $temp="Pending";
        }elseif($status==7){

            $temp = "ReAssign";
        }

        if(!empty($remarks))
        {
            $this->db->set('remarks', $remarks);
        }

            $this->db->set('completed_time', $time_stamp);
            $this->db->set('status', $status);
            $this->db->where('id', $jid);
            $this->db->update('gtg_job');

        

        echo json_encode(array('status' => 'Success', 'message' =>
        $this->lang->line('UPDATED'), 'pstatus' => $temp));
    }

    public function delete_ticket()
    {
        $id = $this->input->post('deleteid');

        if ($this->jobsheet->deletejobsheetticket($id)) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }

    public function assign(){
        $empid=$this->input->post('employee');
        $jobid=$this->input->post('jobid');
        $jobtype=$this->input->post('jobtype');
        $assign_by=$this->aauth->get_user()->id;
        $result=$this->jobsheet->assigntask($empid, $jobid, $assign_by, $jobtype);
        if($result){
            $data['status'] = 'success';
            //$data['message'] = $this->lang->line('ASSINGED') . 'ASSINGED' . '&nbsp;<a href="' . base_url('jobsheets/view') . '" class="btn btn-info btn-sm"><span class="icon-eye"></span> ' . $this->lang->line('View') . ' </a>';
            $data['message'] = $this->lang->line('Assign successful');

            
        }else{
            $data['status'] = 'danger';
            $data['message']=$this->lang->line('Assign failed');
        }

        unset($_POST);
        $_SESSION['status']=$data['status'];
        $_SESSION['message']=$data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');
        redirect('jobsheets', 'refresh');
    }

    public function multiple_assign(){
        $empid=$this->input->post('employee');
        $jobids=$this->input->post('MultipleTaskAssignIds');
        $jobtype=$this->input->post('jobtype');
        $assign_by=$this->aauth->get_user()->id;
        $result=$this->jobsheet->multiassigntask($empid, $jobids, $assign_by, $jobtype);
        if($result){
            $data['status'] = 'success';
            //$data['message'] = $this->lang->line('ASSINGED') . 'ASSINGED' . '&nbsp;<a href="' . base_url('jobsheets/view') . '" class="btn btn-info btn-sm"><span class="icon-eye"></span> ' . $this->lang->line('View') . ' </a>';
            $data['message'] = $this->lang->line('Assign successful');

            
        }else{
            $data['status'] = 'danger';
            $data['message']=$this->lang->line('Assign failed');
        }

        unset($_POST);
        $_SESSION['status']=$data['status'];
        $_SESSION['message']=$data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');
        redirect('jobsheets', 'refresh');
    }

    public function myjobs()
    {
       // $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Jobsheet - My Task List';
        $data['totalt'] = $this->jobsheet->jobsheet_my_count_filtered('');
        $data['assign']= $this->jobsheet->jobsheet_my_count_filtered('Assign');
        $data['pending']= $this->jobsheet->jobsheet_my_count_filtered('Pending');
        $data['completed']= $this->jobsheet->jobsheet_my_count_filtered('Completed');

       // print_r($data);
          $this->load->view('fixed/header', $head);
          $this->load->view('jobsheet/my-jobs', $data);
          $this->load->view('fixed/footer');
    }

    public function tasks_load_my_list()
    {
        $filt = $this->input->get('stat');
        $status = $this->input->post('status');
        $list = $this->jobsheet->jobsheet_my_datatables($filt,$status);
        $data = array();
        $no = $this->input->post('start');
//print_r($list);
//die();
        foreach ($list as $jobsheet) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $jobsheet->job_name;
            $row[] = dateformat_time($jobsheet->created_at);
            $temp = '<span class="st-' . $jobsheet->status . '">';
            if($jobsheet->status==1){
                $temp.=$this->lang->line('Completed');
            }elseif($jobsheet->status==2){
                $temp.=$this->lang->line('Pending');
            }
            elseif($jobsheet->status==3){
             //$temp.=$this->lang->line('Assign');
                $temp.="unassigned";
            }
            elseif($jobsheet->status==4){
                $temp.='WorkInProgress';
                   // $temp.="unassigned";
            }elseif($jobsheet->status==5){
                $temp.='Close';
                    // $temp.="unassigned";
            }elseif($jobsheet->status==6){
                $temp.='ReOpen';
                        // $temp.="unassigned";
            }elseif($jobsheet->status==7){
                $temp.='ReAssign';
                            // $temp.="unassigned";
            }

            $temp.='</span>';
            $row[]=$temp;

            $today_date = date('Y-m-d h:i:s');
            $job_given_date = date('Y-m-d h:i:s',strtotime($jobsheet->cdate." ".$jobsheet->ctime));
           
            $today_date = strtotime($today_date);
            $job_given_date = strtotime($job_given_date);
             
            if($job_given_date >= $today_date)
            {
                $diable_status = '';
            }else{
                $disable_status = 'disabled-link';
            }

            $row[] = '<a href="' . base_url('jobsheets/mythread/?id=' . $jobsheet->id) . '" class="btn btn-success btn-xs  '.$disable_status.'"><i class="fa fa-eye"></i> ' . $this->lang->line('View') . '</a>';

            if(!empty($jobsheet->completed_time))
            {
                $completed_date = date('Y-m-d h:i:s',strtotime($jobsheet->completed_time));
            }else{
                $completed_date = date('Y-m-d h:i:s');
            }
                
            $given_hours = $jobsheet->man_days;
            $completed_date = date('Y-m-d h:i:s',strtotime($completed_date));
            $job_given_date = date('Y-m-d h:i:s',strtotime($jobsheet->cdate." ".$jobsheet->ctime));
            $completed_date = strtotime($completed_date);
            $job_given_date = strtotime($job_given_date);
            
            $diffInSeconds = $completed_date - $job_given_date;
            $hours = floor($diffInSeconds / 3600);

            //echo $hours. "=====". $given_hours;
            if($hours > $given_hours)
            {
                $row[] = '1';
            }else{
                $row[] = '0';
            }
            
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->jobsheet->jobsheet_my_count_all($filt),
            "recordsFiltered" => $this->jobsheet->jobsheet_my_count_filtered($filt),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function mythread()
    {
        $this->load->helper(array('form'));
        $thread_id = $this->input->get('id');

        $data['response'] = 3;
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Jobsheet Update';

        $this->load->view('fixed/header', $head);

        $data['doc']=$this->jobsheet->thread_doc_info($thread_id);
        if ($this->input->post('content')) {

            $message = $this->input->post('content');
            $attach = $_FILES['userfile']['name'];
            if ($attach) {
                $config['upload_path'] = './userfiles/support';
                $config['allowed_types'] = 'docx|docs|txt|pdf|xls|png|jpg|gif';
                $config['max_size'] = 3000;
                $config['file_name'] = time() . $attach;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    $data['response'] = 0;
                    $data['responsetext'] = $this->lang->line('File upload error');
                } else {
                    $data['response'] = 1;
                    $data['responsetext'] = $this->lang->line('Reply success');
                    $filename = $this->upload->data()['file_name'];
                    $this->jobsheet->addjobsheetreply($thread_id, $message, $filename);
                }
            } else {
                $this->jobsheet->addjobsheetreply($thread_id, $message, '');
                $data['response'] = 1;
                $data['responsetext'] = $this->lang->line('Reply success');
            }

            $data['thread_info'] = $this->jobsheet->thread_jobsheet_info($thread_id);
            $data['thread_list'] = $this->jobsheet->thread_jobsheet_list($thread_id);

            $this->load->view('jobsheet/mythread', $data);
        } else {

            $data['thread_info'] = $this->jobsheet->thread_jobsheet_info($thread_id);
            $data['thread_list'] = $this->jobsheet->thread_jobsheet_list($thread_id);

            $this->load->view('jobsheet/mythread', $data);
        }
        $this->load->view('fixed/footer');
    }

    public function reports()
    {
       // $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Jobsheet Reports';        
        $data['employee'] = $this->employee->list_employee();
       // print_r($data);
          $this->load->view('fixed/header', $head);
          $this->load->view('jobsheet/job_reports', $data);
          $this->load->view('fixed/footer');
    }

    public function GetTaskListDetails()
    {

        $post = $this->input->post();
        $key = $post['key'];

        if (!empty($key)) {
            $tasks_list = $this->db->select('job_name')->like('job_name', $key, 'both')->get('gtg_job')->result_array();
        }

        if (!empty($tasks_list)) {
            $task_names_list = '';
            foreach ($tasks_list as $t_list) {
                $task_names_list .= '<option value="' . $t_list['job_name'] . '" />';
            }
            echo json_encode(array("status" => true, "html" => $task_names_list));
            return true;
        } else {
            echo json_encode(array("status" => false, "message" => "No Task Names Found"));
            return true;
        }

    }

    public function get_job_employee_list(){
        $post = $this->input->post();
        $job_id = $post['job_id'];
        $job_details = $this->jobsheet->thread_jobsheet_info($job_id);
        $list=$this->employee->list_employee();
        $html='';
            foreach($list as $item){
                if($job_details['userid'] != $item['id'])
                {
                    $html.='<option value="'.$item['id'].'">'.$item['name'].'</option>';
                }
            }
        echo $html;
        }
    
}
