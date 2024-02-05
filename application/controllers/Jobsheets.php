<?php
defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
require_once APPPATH . 'third_party/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;
class Jobsheets extends CI_Controller
{

   public function __construct()
    {
        parent::__construct();
        $this->load->model('jobsheet_model', 'jobsheet');
        $this->load->model('employee_model', 'employee');
        $this->load->model('purchase_model', 'purchase');
        $this->load->model('invoices_model', 'invocies');
        $this->load->model('customers_model', 'customers');        
        $this->load->model('deliveryorder_model', 'deliveryorder');

        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        // if (!$this->aauth->premission(15)&&!$this->aauth->premission(16)&&!$this->aauth->premission(17)) {
        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }
        $this->li_a = 'Jobsheet';
        $c_module = 'Job sheet';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);
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
       if(!empty($data))
       {

        $p_do_id = $data;
        $sql = "SELECT parent_do_id, GROUP_CONCAT(DISTINCT CONCAT(do_id, '#', cr_date) ORDER BY cr_date ASC) AS do_ids_and_dates,GROUP_CONCAT(DISTINCT CONCAT(supplier_do_id) ORDER BY cr_date ASC) AS supplier_do_ids, MAX(type) AS do_type, MAX(cr_date) AS max_cr_date, MAX(po_id) AS max_po_id, MAX(invoice_id) AS max_invoice_id FROM gtg_do_relations WHERE parent_do_id = '$p_do_id' GROUP BY parent_do_id ";
        $result = $this->db->query($sql);
        $parent_delivery_orders = $result->result_array();  

        if($parent_delivery_orders[0]['do_type'] == 'invoice')
        {
            $n_data['invoice'] = $this->invocies->invoice_customer_details($parent_delivery_orders[0]['max_invoice_id']);
        }

        // echo "<pre>"; print_r($n_data); echo "</pre>";
        // exit;

        $input = $parent_delivery_orders[0]['do_ids_and_dates'];
        $segments = explode(',',$input);

        // Take the last segment
        $lastSegment = end($segments);

        // Separate the last segment based on #
        list($id, $date) = explode('#', $lastSegment);

        // Format the date
        $formattedDate = date('Y-m-d H:i:s', strtotime($date));

        // Build the output string
        $output1 = "# ".$id." Delivery Order Date: # ".$formattedDate."";

// Assuming you want to pass this data to a view
        $n_data['do_details'] = $output1;
                
       }
        $this->load->library("custom");
        $n_data['custom_fields_c'] = $this->custom->add_fields(1);
        $this->load->model('customers_model', 'customers');
        $n_data['customergrouplist'] = $this->customers->group_list();
        $n_data['do_orders'] = $this->deliveryorder->get_do_list();

        // echo "<pre>"; print_r($n_data); echo "</pre>";
        // exit;
          $this->load->view('fixed/header', $head);
          $this->load->view('jobsheet/create',$n_data);
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
        $jobPriority=$this->input->post('job_priority');
        if(!empty($this->input->post('ex_do_number')))
        {
            $do_number=$this->input->post('ex_do_number');
        }else if(!empty($this->input->post('no_ex_do_number'))){
            $do_number=$this->input->post('no_ex_do_number');
        }else{
            $do_number=NULL;
        }
        


        $cid=$this->input->post('cid');
        $cname=$this->input->post('cname');
        $location=$this->input->post('location');
        $date=$this->input->post('date');
        $time=$this->input->post('time');
        $invoice=0;
        // if(isset($_POST['invoice'])){
        // $invoice=1;
        // }
        $create_user=$this->aauth->get_user()->id;
        $uploaddoc=false;
        $created_at=date("Y-m-d")." ".date("H:i:s");
        $jobid=$this->jobsheet->addtask($title, $description, $timeFrame, $create_user, $created_at, $cid, $cname, $location, $date, $time, $invoice,$jobPriority, $do_number);
        $message="";
        if( $jobid>0) {
            $attach = $_FILES['userfile']['name'];
            if ($attach){
                    $config['upload_path'] = './userfiles/documents';
                    $config['allowed_types'] = 'docx|docs|txt|pdf|xls|xlsx|png|jpg|jpeg|gif';
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
        $jobPriority=$this->input->post('job_priority');

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
        $created_at=date("Y-m-d")." ".date("H:i:s");
        $jobid=$this->jobsheet->edittask($job_id, $title, $description, $timeFrame, $create_user, $created_at, $cid, $cname, $location, $date, $time, $invoice, $jobPriority);
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

        // echo $this->db->last_query();
        //exit;
        foreach ($list as $jobsheet) {
            $row = array();
            $no++;
            $row[] = '<input class="form-check" type="checkbox" name="messaging_team_id_selection"  MessagingType="team" fetchUrl="" fetchId="' . $jobsheet->id . '">';;
            $row[] = $no;
            $row[] = '<a href="javascript:void(0);" class="job_sheet_details" job_id="'. $jobsheet->id .'">' . $jobsheet->job_name . '</a>';
            //$row[] = $jobsheet->job_name;
            $row[] = dateformat_time($jobsheet->created_at);
            $row[] = $jobsheet->job_priority;
            
            $job_status = '';
            $temp = '';
            if($jobsheet->status==1){
                $job_status.="Completed";
                $statusClass = 'status-completed';
            }elseif($jobsheet->status==2){
                $job_status.="Pending";
                $statusClass = 'status-pending';
            }
            elseif($jobsheet->status==3){
               $job_status.='<a class="btn btn-danger btn-xs assign-object" style="display: inline-block; padding:6px; margin-left:1px;" href="#" data-object-id="' . $jobsheet->id . '"> <i class="fa fa-pencil-square-o "></i> Assign</a>';
               $statusClass = 'status-unassigned';
            }elseif($jobsheet->status==4){
                $job_status.="Work In Progress";
                $statusClass = 'status-work-in-progress';
            }elseif($jobsheet->status==5){
                $job_status.="Closed";
                $statusClass = 'status-close';
            }elseif($jobsheet->status==6){
                $job_status.="Re-Open";
                $statusClass = 'status-reopen';
            }elseif($jobsheet->status==7){
                $job_status.="Re-Assign";
                $statusClass = 'status-reassign';
            }

           // $temp = '<span class="st-' . $jobsheet->status . ' ''">';
            $temp .= $job_status;
           // $temp .='</span>';
            $row[]=$temp;


            if(!empty($jobsheet->completed_time))
            {
                $completed_date = date('Y-m-d H:i:s',strtotime($jobsheet->completed_time));
            }else{
                $completed_date = date('Y-m-d H:i:s');
            }
                
            $given_hours = $jobsheet->man_days;
            $completed_date = date('Y-m-d H:i:s',strtotime($completed_date));
            $job_given_date = date('Y-m-d H:i:s',strtotime($jobsheet->cdate." ".$jobsheet->ctime));
            $estimated_completed_date = date('d-m-Y H:i:s', strtotime($job_given_date . '+'.$given_hours.' hours'));

            $completed_date = strtotime($completed_date);
            $job_given_date = strtotime($job_given_date);
           
            $row[] = $jobsheet->assigned_name;
            $row[]= $estimated_completed_date;
            
            $diffInSeconds = $completed_date - $job_given_date;
            $hours = floor($diffInSeconds / 3600);

    
            $currentTimestamp = time();
            $estimated_completed_date = strtotime($estimated_completed_date);
            // Calculate the percentage completion
            // $percentage = (($current_time - strtotime($job_given_date)) / (strtotime($estimated_completed_date) - strtotime($job_given_date))) * 100;
            // $percentage = max(0, min(100, $percentage)); // Ensure percentage is between 0 and 100
        
        
           
            
            $work_in_progress_start_time = strtotime(date('Y-m-d H:i:s',strtotime($jobsheet->work_in_progress_start_time)));
            
            if(!empty($work_in_progress_start_time))
            {
                $timeDifference = $estimated_completed_date - $work_in_progress_start_time;

            }else{
                $timeDifference = 0;

            }
            
            // Calculate the elapsed time from the start to the current time
            $elapsedTime = $currentTimestamp - $job_given_date;

            // Calculate the percentage completion
            if($timeDifference > 0)
            {
                $percentage = ($elapsedTime / $timeDifference) * 100;
            }else{
                $percentage = 0;
            }
            

            // Ensure percentage is between 0 and 100
            $percentage = max(0, min(100, $percentage));

            // $row[] = '<div id="statusBar" class="progress">
            //             <div id="progressBar" class="progress-bar" role="progressbar" style="width:' . $percentage . '%;" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100"></div>
            //             </div>';
            $row_data = '<div id="statusBar" class="progress">
                <div id="progressBar" class="progress-bar" role="progressbar" style="width:' . $percentage . '%;';

            // Change progress bar color based on percentage ranges
            if ($percentage <= 20) {
                $row_data .= 'background-color: orange;';
            } elseif ($percentage <= 80) {
                $row_data .= 'background-color: green;';
            } else {
                $row_data .= 'background-color: red;';
            }

            $row_data .= '" aria-valuenow="' . $percentage . '" aria-valuemin="0" aria-valuemax="100"></div>
                </div>';

            $row[] = $row_data;
            

          

            // $temp = '<a href="' . base_url('jobsheets/thread/?id=' . $jobsheet->id) . '" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> ' . $this->lang->line('View') . '</a>';
            $temp = '<a href="' . base_url('jobsheets/thread/?id=' . $jobsheet->id) . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>';

            if($jobsheet->status==2 || $jobsheet->status==3){
            //$temp .= '<a href="' . base_url('jobsheets/edit/?id=' . $jobsheet->id) . '" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> ' . $this->lang->line('Edit') . ' </a>';
            $temp .= '<a href="' . base_url('jobsheets/edit/?id=' . $jobsheet->id) . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>';

            }
            $temp .= '<a class="btn btn-danger btn-xs delete-object" style="display: inline-block; padding:6px; margin-left:1px;" href="#" data-object-id="' . $jobsheet->id . '"> <i class="fa fa-trash "></i> </a>';
            if ($this->aauth->premission(23)&&($jobsheet->cinvoice==1)) {
                if($jobsheet->status==1){
            // $temp .='<form action="' . base_url('invoices/create').'" method="post"><a href="' . base_url('invoices/create/?cid=' . $jobsheet->cid) . '" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i> ' . $this->lang->line('Create Invoice') . '</a>';
            $temp .= '<a class="btn btn-success btn-xs " style="display: inline-block;  padding:6px; margin-left:1px;" href="' . base_url('invoices/create/?cid=' . $jobsheet->cid) . '"> <i class="fa fa-pencil "></i> </a>';
        
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

        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;
        $output = array(
           "draw" => $_POST['draw'],
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

         $data['job_images'] = $this->jobsheet->thread_jobsheet_images_info($thread_id);
         
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
            $time_stamp = date('Y-m-d H:i:s');
            $this->db->set('compl   eted_time', $time_stamp);
            
        }elseif($status==2){
            $temp="Pending";
        }
        elseif($status==3){
            $temp="unassigned";
        }
        elseif($status==4){

            $temp = "Work In Progress";
            $time_stamp = date('Y-m-d H:i:s');
            $this->db->set('work_in_progress_start_time', $time_stamp);

        }elseif($status==5){

            $temp = "Closed";
        }elseif($status==6){

            //$temp = "ReOpen";
            $temp="Pending";
        }elseif($status==7){

            $temp = "Re-Assign";
        }

        if(!empty($remarks))
        {
            $this->db->set('remarks', $remarks);
        }


        if($status == 1)
        {
            if ($this->aauth->premission(205)) {
            
                if($this->db->where('job_id',$jid)->get('gtg_job_images')->num_rows() > 0)
                {
                    $this->db->set('status', $status);
                    $this->db->where('id', $jid);
                    $this->db->update('gtg_job');       
                    echo json_encode(array('status' => 'Success', 'message' =>
                    $this->lang->line('UPDATED'), 'pstatus' => $temp));
                }else{
                    
                    echo json_encode(array('status' => 'Error', 'message' =>
                    $this->lang->line('Please Update atleast 1 DO Image')));
                }
                
            
            } else{

                    $this->db->set('status', $status);
                    $this->db->where('id', $jid);
                    $this->db->update('gtg_job');       
                    echo json_encode(array('status' => 'Success', 'message' =>
                    $this->lang->line('UPDATED'), 'pstatus' => $temp));
            }
        }else{
            $this->db->set('status', $status);
            $this->db->where('id', $jid);
            $this->db->update('gtg_job');
            echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('UPDATED'), 'pstatus' => $temp));
        }
        
        
    }

    public function job_update_status()
    {
        $jid = $this->input->post('jid');
        $status = $this->input->post('status');
        $remarks = $this->input->post('remarks');
        $time_stamp = '';
        
        
        if($status==1){
            $temp="Completed";
            $time_stamp = date('Y-m-d H:i:s');
            $this->db->set('completed_time', $time_stamp);
            
        }elseif($status==2){
            $temp="Pending";
        }
        elseif($status==3){
            $temp="unassigned";
        }
        elseif($status==4){

            $temp = "Work In Progress";
            $time_stamp = date('Y-m-d H:i:s');
            $this->db->set('work_in_progress_start_time', $time_stamp);

        }elseif($status==5){

            $temp = "Closed";
        }elseif($status==6){

            //$temp = "ReOpen";
            $temp="Pending";
        }elseif($status==7){

            $temp = "Re-Assign";
        }

        if(!empty($remarks))
        {
            $this->db->set('remarks', $remarks);
        }

        $this->db->set('updated_at', $time_stamp);
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
        $vehicle=$this->input->post('vehicle');        
        $assign_by=$this->aauth->get_user()->id;
        $result=$this->jobsheet->assigntask($empid, $jobid, $assign_by, $jobtype,$vehicle);
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
                $temp.='Work In Progress';
                   // $temp.="unassigned";
            }elseif($jobsheet->status==5){
                $temp.='Closed';
                    // $temp.="unassigned";
            }elseif($jobsheet->status==6){
                $temp.='Re-Open';
                        // $temp.="unassigned";
            }elseif($jobsheet->status==7){
                $temp.='Re-Assign';
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
                $disable_status = '';
            }else{
                $disable_status = 'disabled-link';
            }

            $row[] = '<a href="' . base_url('jobsheets/mythread/?id=' . $jobsheet->id) . '" class="btn btn-success btn-xs  '.$disable_status.'" style="display: inline-block; padding:6px; margin-left:1px;"><i class="fa fa-eye"></i> ' . $this->lang->line('View') . '</a>';

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
            "recordsTotal" => $this->jobsheet->jobsheet_my_count_all_my($filt),
            "recordsFiltered" => $this->jobsheet->jobsheet_my_count_filtered_my($filt),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function mythread()
    {
        $this->load->helper(array('form'));
        $thread_id = $this->input->get('id');

        // echo "<pre>"; print_r($_POST); echo "</pre>";
        // exit;

        $data['response'] = 3;
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Jobsheet Update';

        $this->load->view('fixed/header', $head);
        $data['job_images'] = $this->jobsheet->thread_jobsheet_images_info($thread_id);
        $data['doc']=$this->jobsheet->thread_doc_info($thread_id);
        if ($this->input->post('content') || $this->input->post('signature_image')) {

            $message = $this->input->post('content');
            if(!empty($_FILES['userfile']['name']))
            {

                $attach = $_FILES['userfile']['name'];
            }else{
                
                $attach = '';
            }
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

            $signature_image = $this->input->post('signature_image');
            if(!empty($signature_image))
            {
                $sign_data['signature'] = $signature_image;
                $sign_data['signature_date'] = date('d-m-Y h:i:s');
                $this->db->where('id', $thread_id);
                $this->db->update('gtg_job', $sign_data);
                $data['response'] = 1;
                $data['responsetext'] = 'Signature Saved Successfully';
            }

            // echo "<pre>"; print_r($_POST); echo "</pre>";
            // exit;

            



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

    public function signature_upload(){

        $thread_id = $this->input->post('job_id');
        $signature_image = $this->input->post('signature_image');
        if(!empty($signature_image)){

                $sign_data['signature'] = $signature_image;
                $sign_data['signature_date'] = date('d-m-Y h:i:s');
                $this->db->where('id', $thread_id);
                $this->db->update('gtg_job', $sign_data);
                $data['success'] = true;

        }else {

            $data['success'] = false;
            
        }

        echo json_encode($data);
    }


    
    public function conversation_attachment_upload(){

            $message = $this->input->post('content');
            $thread_id = $this->input->post('job_id');
            if(!empty($_FILES['userfile']['name']))
            {

                $attach = $_FILES['userfile']['name'];
            }else{
                
                $attach = '';
            }

            if ($attach) {
                $config['upload_path'] = './userfiles/support';
                $config['allowed_types'] = 'docx|docs|txt|pdf|xls|png|jpg|gif';
                $config['max_size'] = 3000;
                $config['file_name'] = time() . $attach;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('userfile')) {
                    $data['success'] = false;
                    $data['responsetext'] = $this->lang->line('File upload error');
                } else {
                    $data['success'] = true;
                    $data['responsetext'] = $this->lang->line('Reply success');
                    $filename = $this->upload->data()['file_name'];
                    $this->jobsheet->addjobsheetreply($thread_id, $message, $filename);
                }
            } else {
                if(!empty($message))
                {
                    $this->jobsheet->addjobsheetreply($thread_id, $message, '');
                    $data['success'] = true;
                    $data['responsetext'] = $this->lang->line('Reply success');
                }else{
                    $data['success'] = false;
                    $data['responsetext'] = $this->lang->line("Reply Shouldn't be Empty");
                }
                
            }

            echo json_encode($data);

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
    
        public function job_clock_in_details()
    {
       
        if(!empty($_POST)){
        // Handle the uploaded image
        $imageData = $this->input->post('image');
        $decodedImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
        $imageName = uniqid('image_') . '.png';
        $imagePath = FCPATH . 'userfiles/job_clock_in_photos/' . $imageName;
        file_put_contents($imagePath, $decodedImageData);

        // Get location details
        $data['job_clock_in_photo'] = $imageName;
        $data['job_clock_in_latitude'] = $this->input->post('latitude_details');
        $data['job_clock_in_longitude'] = $this->input->post('longitude_details');
        $data['job_clock_in_location'] = $this->input->post('Location_details');
        $data['job_id'] = $this->input->post('job_id');
    
        if($this->db->insert('gtg_job_images',$data))
        {
            $response['success'] = true;
                
        }else{
            $response['success'] = false;
        }

        $this->session->set_flashdata('messagePr', 'Capture Details Updated Successfully!..');
        echo json_encode($response);       
        }else{
            //echo "ddd";
        }
    }

    public function job_sheet_profile_download(){


        $id = intval($this->input->get('id'));
        $data['job_details'] = $this->jobsheet->all_jobsheet_list();

        //$data = array();        
        $html = $this->load->view('jobsheet/job_sheet_detailed_information', $data, true);

        // echo $html;
        // exit;
        $this->load->library('pdf');

        // Create an instance of Mpdf
        $mpdf = new Mpdf();
        //$mpdf->showImageErrors = true;
        // Set margins
        //$mpdf->SetMargins(40, 40, 40);

        // Add a new page
        $mpdf->AddPage();

        // Write HTML content to the page
        $mpdf->WriteHTML($html);

        // If you want to force a download
        $mpdf->Output('job_sheet_detailed_information.pdf', 'D');

        // If you want to display in the browser
        // $mpdf->Output('employee_profile.pdf', 'I');

    }

    public function get_job_sheet_details(){

        $id = intval($this->input->post('job_id'));
        $data['job_details'] = $this->jobsheet->thread_jobsheet_info($id);
        $data['job_images'] = $this->jobsheet->thread_jobsheet_images_info($id);
        $data['system_data'] = $this->db->get('gtg_system')->row_array();

        //$data = array();      
        $resp_data['status'] = '200';
        $resp_data['html'] = $this->load->view('jobsheet/job_sheet_detailed_information_view', $data, true);
        echo json_encode($resp_data);

    }

    public function tasks_load_list_report()
    {
        $filt = $this->input->get('stat');
        $status = $this->input->post('status');
        $employee = $this->input->post('employee');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        $list = $this->jobsheet->jobsheet_datatables_report($filt,$status,$employee,$start_date,$end_date);
        $data = array();
        $no = $this->input->post('start');

        foreach ($list as $jobsheet) {
            $row = array();
            $no++;
            $row[] = '<input class="form-check" type="checkbox" name="messaging_team_id_selection"  MessagingType="team" fetchUrl="" fetchId="' . $jobsheet->id . '">';;
           // $row[] = $no;
            $row[] = '<a href="javascript:void(0);" class="job_sheet_details" job_id="'. $jobsheet->id .'">' . $jobsheet->job_name . '</a>';
            $row[] = dateformat_time($jobsheet->created_at);
            $row[] = $jobsheet->job_priority;
            
           // $temp = '<span class="st-' . $jobsheet->status . '">';
            $temp ='';
            if($jobsheet->status==1){
                $temp.="Completed";
            }elseif($jobsheet->status==2){
                $temp.="Pending";
            }
            elseif($jobsheet->status==3){
               //$temp.='<a class="btn btn-danger btn-xs assign-object" style="display: inline-block; padding:6px; margin-left:1px;" href="#" data-object-id="' . $jobsheet->id . '"> <i class="fa fa-pencil-square-o "></i> Assign</a>';
               $temp.="Unassigned";
            }elseif($jobsheet->status==4){
                $temp.="Work In Progress";
            }elseif($jobsheet->status==5){
                $temp.="Closed";
            }elseif($jobsheet->status==6){
                $temp.="Re-Open";
            }elseif($jobsheet->status==7){
                $temp.="Re-Assign";
            }


            //$temp.='</span>';
            $row[]=$temp;


            $temp = '<a href="' . base_url('jobsheets/thread/?id=' . $jobsheet->id) . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>';

            if($jobsheet->status==2 || $jobsheet->status==3){
            //$temp .= '<a href="' . base_url('jobsheets/edit/?id=' . $jobsheet->id) . '" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> ' . $this->lang->line('Edit') . ' </a>';
            $temp .= '<a href="' . base_url('jobsheets/edit/?id=' . $jobsheet->id) . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>';

            }
            $temp .= '<a class="btn btn-danger btn-xs delete-object" style="display: inline-block; padding:6px; margin-left:1px;" href="#" data-object-id="' . $jobsheet->id . '"> <i class="fa fa-trash "></i> </a>';
            if ($this->aauth->premission(23)&&($jobsheet->cinvoice==1)) {
                if($jobsheet->status==1){
            // $temp .='<form action="' . base_url('invoices/create').'" method="post"><a href="' . base_url('invoices/create/?cid=' . $jobsheet->cid) . '" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i> ' . $this->lang->line('Create Invoice') . '</a>';
            $temp .= '<a class="btn btn-success btn-xs" style="display: inline-block;  padding:6px; margin-left:1px;" href="' . base_url('invoices/create/?cid=' . $jobsheet->cid) . '"> <i class="fa fa-pencil "></i> </a>';
        
            }
            }
            $row[]=$temp;

            $data[] = $row;
        }

        $output = array(
           // "draw" => $_POST['draw'],
            "recordsTotal" => $this->jobsheet->jobsheet_count_all_report($filt,$status,$employee,$start_date,$end_date),
            "recordsFiltered" => $this->jobsheet->jobsheet_count_filtered_report($filt,$status,$employee,$start_date,$end_date),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function delete_document_image()
    {
        $ds_id = $this->input->post('deleteid');
        $this->jobsheet->delete_document_image($ds_id);
        //redirect('contract');
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Document Image Deleted')));
    }

    public function jobsheet_report_new()
    {
        if(!empty($_POST))
        {

            // echo "<pre>"; print_r($_POST); echo "</pre>";
            // exit;

            $cid = $this->input->post('employee');
            $job_id = $this->input->post('job_id');
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer');

            $data['emp_list'] = $this->employee->list_employee();
            $data['from_date'] = $from_date;
            $data['to_date'] = $to_date;
            // print
            $list = $this->jobsheet->jobsheet_report_new($cid, $job_id, $from_date, $to_date, $customer_id);

            if(!empty($list))
            {
                foreach ($list as $row) {
                    $userId = $row['userid'];
                
                    // Check if cid is empty, move it to the end
                    if (empty($userId)) {
                        $categorizedResult['empty_user_id']['entries'][] = $row;
                    } else {
                        // Create a new entry for emp if it doesn't exist
                        if (!isset($categorizedResult[$userId])) {
                            $categorizedResult[$userId] = array(
                                'userid' => $userId,
                                'entries' => array(),
                            );
                        }
                
                        // Add the row to the entries array
                        $categorizedResult[$userId]['entries'][] = $row;
                    }
                }
            }
            

            // echo "<pre>"; print_r($categorizedResult); echo "</pre>";
            // exit;

              
        $table = '';
        $n_data = array();
        $nn_data = array();
        if(!empty($categorizedResult))
        {
            foreach ($categorizedResult as $jobData) {

                $data = array();
                if(!empty($jobData['userid']))
                {
                    $empId = $jobData['userid'];
                }else{
                    $empId = 'Not Assigned';
                }
                
                $entries = $jobData['entries'];
            
                // Initialize variables to calculate totals
                $total_assigned_tasks = count($entries);
                $total_completed_tasks = 0;
                $total_pending_tasks = 0;
                $total_work_in_progress_tasks = 0;
                $working_seconds = 0;
               

                foreach ($entries as $entry) {
                    $job_status = '';
                    $given_hours = $entry['man_days'];
                    if(!empty($entry['work_in_progress_start_time']))
                    {
                        $work_in_progress_start_time = date('Y-m-d H:i:s',strtotime($entry['work_in_progress_start_time']));
                        $estimated_completed_date = date('d-m-Y H:i:s', strtotime($work_in_progress_start_time . '+'.$given_hours.' hours'));
        
                    }else{
                        $job_given_date = date('Y-m-d H:i:s',strtotime($entry['cdate']." ".$entry['ctime']));
                        $estimated_completed_date = date('d-m-Y H:i:s', strtotime($job_given_date . '+'.$given_hours.' hours'));
        
                    }
                    
                    switch ($entry['status']) {
                        case 1:
                            $job_status .= "Completed";
                            $total_completed_tasks++;
                            break;
                        case 2:
                            $job_status .= "Pending";
                            $total_pending_tasks++;
                            break;
                        case 3:
                            $job_status .= "UnAssigned";
                            break;
                        case 4:
                            $job_status .= "Work In Progress";
                            $total_work_in_progress_tasks++;
                            break;
                        case 5:
                            $job_status .= "Closed";
                            break;
                        case 6:
                            $job_status .= "Re-Open";
                            $total_work_in_progress_tasks++;
                            break;
                        case 7:
                            $job_status .= "Re-Assign";
                            break;
                        default:
                            $job_status .= "---";
                            break;
                    }
                    
                    $wp_time = date('Y-m-d H:i:s', strtotime($entry['work_in_progress_start_time']));
                    $c_time = date('Y-m-d H:i:s', strtotime($entry['completed_time']));
                    if(!empty($wp_time) && !empty($c_time))
                    {                    
                        $working_seconds += (strtotime($wp_time) - strtotime($wp_time));
                    }
                    
                    $data['cid'] = $entry['userid'];
                    $data['assigned_employee_name'] = $entry['assigned_employee_name'];
                    $data['created_date_time'] = date('d-m-Y H:i:s', strtotime($entry['created_at']));
                    $data['estimated_completed_date'] = $estimated_completed_date;
                    $data['status'] = $job_status;
                    $data['assigned_hours'] = $entry['man_days'];
                    $data['client_name'] = $entry['cname'];
                    $data['duration'] = 'NA';
                    $data['remarks'] = $entry['remarks'];
                    $data['total_assigned_tasks'] = '';
                    $data['total_completed_tasks'] = '';
                    $data['total_pending_tasks'] = '';
                    $data['total_work_in_progress_and_reopen'] = '';
                    $data['total_working_duration'] = '';
                    $data['kpi_indication'] = '';
                    $n_data[] = $data;
                
                }
            
                $workingHours = floor($working_seconds / 3600);
                $workingMinutes = floor(($working_seconds % 3600) / 60);

                if ($workingHours > 0) {
                    $working_final_hours = $workingHours." hrs,".$workingMinutes." mins";
                } else if ($workingMinutes > 0){
                    $working_final_hours = $workingMinutes." mins";
                } else {
                    $working_final_hours = "0 mins";
                }
                

                $data1['cid'] = '';
                $data1['assigned_employee_name'] = '';
                $data1['created_date_time'] = '';
                $data1['estimated_completed_date'] = '';
                $data1['status'] = '';
                $data1['assigned_hours'] = '';
                $data1['client_name'] = '';
                $data1['duration'] = '';
                $data1['remarks'] = '';
                $data1['total_assigned_tasks'] = $total_assigned_tasks;
                $data1['total_completed_tasks'] = $total_completed_tasks; // Assuming the name 
                $data1['total_pending_tasks'] = $total_pending_tasks;
                $data1['total_work_in_progress_and_reopen'] = $total_work_in_progress_tasks;
                $data1['total_working_duration'] = $working_final_hours;
                $kpi_indication = '';
                $data1['kpi_indication'] = $kpi_indication;
                $n_data[] = $data1;

                //$nn_data[] = $n_data;
            }
        }
        // echo "<pre>"; print_r($n_data); echo "</pre>";

        // exit;
        $data['jobsheet_report'] = $n_data;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'JobSheet Report';
        $this->load->view('fixed/header', $head);
        $this->load->view('jobsheet/jobsheet_report_new', $data);
        $this->load->view('fixed/footer');

        //echo "<pre>"; print_r($n_data); echo "</pre>";

        }else{

            $data['report'] = '';
            $data['from_date'] = '';
            $data['to_date'] = '';
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'JobSheet Report';
            $data['emp_list'] = $this->employee->list_employee();
            $data['cust_list'] = $this->customers->list_customers();
            $data['job_list'] = $this->jobsheet->list_job_ids();
            //  echo "<pre>"; print_r($data); echo "</pre>";
            //  exit;
            $this->load->view('fixed/header', $head);
            $this->load->view('jobsheet/jobsheet_report_new', $data);
            $this->load->view('fixed/footer');

        }
                
    }
}