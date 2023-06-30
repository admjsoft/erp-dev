<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Jobsheets extends CI_Controller
{

   public function __construct()
    {
        parent::__construct();
        $this->load->model('jobsheet_model', 'jobsheet');
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if (!$this->aauth->premission(15)&&!$this->aauth->premission(16)&&!$this->aauth->premission(17)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $this->li_a = 'crm';
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

    public function tasks_load_list()
    {
        $filt = $this->input->get('stat');
        $list = $this->jobsheet->jobsheet_datatables($filt);
        $data = array();
        $no = $this->input->post('start');

        foreach ($list as $jobsheet) {
            $row = array();
            $no++;
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
               // $temp.="unassigned";
            }


            $temp.='</span>';
            $row[]=$temp;

            $temp = '<a href="' . base_url('jobsheets/thread/?id=' . $jobsheet->id) . '" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> ' . $this->lang->line('View') . '</a> <a class="btn btn-danger btn-xs delete-object" href="#" data-object-id="' . $jobsheet->id . '"> <i class="fa fa-trash "></i> </a>';
            if ($this->aauth->premission(23)&&($jobsheet->cinvoice==1)) {
                if($jobsheet->status==1){
            $temp .='<form action="' . base_url('invoices/create').'" method="post"><a href="' . base_url('invoices/create/?cid=' . $jobsheet->cid) . '" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i> ' . $this->lang->line('Create Invoice') . '</a>';
                }
            }
            $row[]=$temp;

            $data[] = $row;
        }

        $output = array(
           // "draw" => $_POST['draw'],
            "recordsTotal" => $this->jobsheet->jobsheet_count_all($filt),
            "recordsFiltered" => $this->jobsheet->jobsheet_count_filtered($filt),
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

        
        if($status==1){
            $temp="Completed";
            
        }elseif($status==2){
            $temp="Pending";
        }
        elseif($status==3){
            $temp="unassigned";
        }
        elseif($status==4){

            $temp = "WorkInProgress";
        }

        if(!empty($remarks))
        {
            $this->db->set('remarks', $remarks);
        }

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
        $list = $this->jobsheet->jobsheet_my_datatables($filt);
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
            $temp.=$this->lang->line('Assign');
               // $temp.="unassigned";
            }
            elseif($jobsheet->status==4){
                $temp.='WorkInProgress';
                   // $temp.="unassigned";
                }

            $temp.='</span>';
            $row[]=$temp;

            $row[] = '<a href="' . base_url('jobsheets/mythread/?id=' . $jobsheet->id) . '" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> ' . $this->lang->line('View') . '</a>';


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

}
