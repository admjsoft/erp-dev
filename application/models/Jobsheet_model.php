<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jobsheet_model extends CI_Model
{
    //documents list

    var $doccolumn_order = array(null, 'job_name', 'created_at', null);
    var $doccolumn_search = array('job_name', 'created_at');


    public function jobs()
    {
        $query = $this->db->get('gtg_job');
        return $query->result_array();
    }

    function addtaskdocument($title, $filename, $complaintid)
    {
        $cid=0;
        $this->db->where('complaintid',$complaintid)->delete('gtg_documents');
        $this->aauth->applog("[Jobsheets Doc Added]  DocId $title ComplaintId " . $complaintid, $this->aauth->get_user()->username);
        $data = array('title' => $title, 'filename' => $filename, 'cdate' => date('Y-m-d'), 'fid' => $cid, 'rid' => 0,'complaintid'=>$complaintid, 'userid' => $this->aauth->get_user()->id);
        return $this->db->insert('gtg_documents', $data);
    }

    function deletetaskdocument($id, $complaintid)
    {   $cid=0;
        $this->db->select('filename');
        $this->db->from('gtg_documents');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
        $this->db->trans_start();
        if ($this->db->delete('gtg_documents', array('id' => $id, 'fid' => $cid, 'rid' => 0))) {
            if (@unlink(FCPATH . 'userfiles/documents/' . $result['filename'])) {
                $this->aauth->applog("[Jobsheets Doc Deleted]  DocId $id CID " . $cid, $this->aauth->get_user()->username);
                $this->db->trans_complete();
                return true;
            } else {
                $this->db->trans_rollback();
                return false;
            }
        } else {
            return false;
        }
    }

    public function addtask($title, $description, $timeFrame, $create_user, $created_at, $cid, $cname, $location, $date, $time, $invoice)
    {
            $data = array(
                'job_name' => $title,
                'job_description' => $description,
                'man_days' => $timeFrame,
                'created_by' => $create_user,
                'updated_at' => $created_at,
                'created_at' => $created_at,
                'cid'=>$cid,
                'cname' => $cname,
                'clocation' => $location,
                'cdate' => $date,
                'ctime'=> $time,
                'cinvoice' => $invoice
            );

            $cid=0;
            if ($this->db->insert('gtg_job', $data)) {
                $cid = $this->db->insert_id();
            }
            return $cid;
    }

    public function edittask($job_id, $title, $description, $timeFrame, $create_user, $created_at, $cid, $cname, $location, $date, $time, $invoice)
    {
            $data = array(
                'job_name' => $title,
                'job_description' => $description,
                'man_days' => $timeFrame,
                'created_by' => $create_user,
                'updated_at' => $created_at,
                'created_at' => $created_at,
                'cid'=>$cid,
                'cname' => $cname,
                'clocation' => $location,
                'cdate' => $date,
                'ctime'=> $time,
                'cinvoice' => $invoice
            );

            $cid=0;
            if ($this->db->where('id',$job_id)->update('gtg_job', $data)) {
                $cid = $job_id;
            }
            return $cid;
    }

    public function delete($id)
        {
            $this->db->delete('gtg_customers', array('id' => $id));
            return true;
        }

    function jobsheet_datatables($filt, $status = '',$employee = '',$start_date = '',$end_date = '')
    {
        $this->jobsheet_datatables_query($filt,$status,$employee,$start_date,$end_date);
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }
    private function jobsheet_datatables_query($filt,$status='',$employee = '',$start_date = '',$end_date = '')
    {

        $this->db->select('gtg_job.*,gtg_employees.name as assigned_name');
        $this->db->from('gtg_job');
        $this->db->join('gtg_employees','gtg_job.userid = gtg_employees.id', 'left');
       
        if ($filt == 'Assign') {
            $this->db->where('status=', '3');
        }else if($filt == 'Pending') {
            $this->db->where('status=', '2');
        }else if($filt == 'Completed') {
            $this->db->where('status=', '1');
        }


        if ($status == 'Assign') {
            $this->db->where('status=', '3');
        }else if($status == 'Pending') {
            $this->db->where('status=', '2');
        }else if($status == 'Completed') {
            $this->db->where('status=', '1');
        }

        if (!empty($employee)) {
            $this->db->where('userid', $employee);
        }

        if (!empty($start_date) && !empty($end_date) ) {
            $this->db->where('DATE(created_at) >=', datefordatabase($start_date));
            $this->db->where('DATE(created_at) <=', datefordatabase($end_date));

        }else if (!empty($start_date) && empty($end_date) ) {
            $this->db->where('DATE(created_at) >=', datefordatabase($start_date));

        }else if (empty($start_date) && !empty($end_date) ) {
            $this->db->where('DATE(created_at) <=', datefordatabase($end_date));

        }

        $i = 0;

        foreach ($this->doccolumn_search as $item) // loop column
        {
            $search = $this->input->post('search');
        $value='';
        if(!empty($search))
        {  $value = $search['value'];}

            if ($value) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->doccolumn_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->doccolumn_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function jobsheet_count_filtered($filt='',$status='',$employee='',$start_date='',$end_date='')
    {
        $this->jobsheet_datatables_query($filt,$status,$employee,$start_date,$end_date);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function jobsheet_count_all($filt='',$status='',$employee='',$start_date='',$end_date='')
    {
        $this->jobsheet_datatables_query($filt,$status,$employee,$start_date,$end_date);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function thread_jobsheet_list($id)
    {
        $this->db->select('gtg_jobsheets_th.*,gtg_users.username AS admin, gtg_employees.name AS emp');
        $this->db->from('gtg_jobsheets_th');
        $this->db->join('gtg_users', 'gtg_jobsheets_th.aid=gtg_users.id', 'left');
        $this->db->join('gtg_employees', 'gtg_jobsheets_th.eid=gtg_employees.id', 'left');
        $this->db->where('gtg_jobsheets_th.jid', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    private function send_jobsheet_email($mailto, $mailtotitle, $subject, $message, $attachmenttrue = false, $attachment = '')
    {
        $this->load->library('ultimatemailer');
        $this->db->select('host,port,auth,auth_type,username,password,sender');
        $this->db->from('gtg_smtp');
        $query = $this->db->get();
        $smtpresult = $query->row_array();
        $host = $smtpresult['host'];
        $port = $smtpresult['port'];
        $auth = $smtpresult['auth'];
        $auth_type = $smtpresult['auth_type'];
        $username = $smtpresult['username'];;
        $password = $smtpresult['password'];
        $mailfrom = $smtpresult['sender'];
        $mailfromtilte = $this->config->item('ctitle');

        $this->ultimatemailer->bin_send($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto, $mailtotitle, $subject, $message, $attachmenttrue, $attachment);
    }

    public function get_job_details_info($id)
    {

        $this->db->select('gtg_job.*,gtg_documents.filename');
        $this->db->from('gtg_job');
        $this->db->join('gtg_documents', 'gtg_job.id=gtg_documents.complaintid', 'left');
        $this->db->where('gtg_job.id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function thread_jobsheet_info($id)
    {

        $this->db->select('gtg_job.*,gtg_employees.username AS assigned_employee_name,gtg_jobtransaction.assign_type as assigned_employee_job_type');
        $this->db->from('gtg_job');
        $this->db->join('gtg_employees', 'gtg_job.userid=gtg_employees.id', 'left');
        $this->db->join('gtg_jobtransaction', 'gtg_job.id=gtg_jobtransaction.jobid', 'left');
        $this->db->where('gtg_job.id', $id);
        $this->db->order_by('gtg_jobtransaction.id', 'DESC');
        $query = $this->db->get();
        return $query->row_array();

        // $this->db->select('*');
        // $this->db->from('gtg_job');
        // $this->db->from('gtg_job');
        // $this->db->where('id', $id);
        // $query = $this->db->get();
        // return $query->row_array();
    }

    public function thread_user_info($id)
    {
        $this->db->select('*');
        $this->db->from('gtg_users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function thread_doc_info($id)
    {
        $this->db->select('filename');
        $this->db->from('gtg_documents');
        $this->db->where('complaintid', $id);
        $query = $this->db->get();
        return $query->row_array();
    }


    public function ticket()
    {
        $this->db->select('*');
        $this->db->from('univarsal_api');
        $this->db->where('id', 3);
        $query = $this->db->get();
        return $query->row();
    }

    function addjobsheetadminreply($thread_id, $message, $filename)
    {
        $data = array('jid' => $thread_id, 'message' => $message, 'cid' => 0, 'eid' => 0 ,'aid'=> $this->aauth->get_user()->id, 'cdate' => date('Y-m-d H:i:s'), 'attach' => $filename);
        if ($this->ticket()->key2) {

            $customer = $this->thread_jobsheet_info($thread_id);
            $email = $this->thread_user_info($customer['userid']);

            $this->send_email($email['email'], $customer['cname'], '[Job Updated] #' . $thread_id, $message . $this->ticket()->other, $attachmenttrue = false, $attachment = '');
        }
        return $this->db->insert('gtg_jobsheets_th', $data);
    }


    private function send_email($mailto, $mailtotitle, $subject, $message, $attachmenttrue = false, $attachment = '')
    {
        $this->load->library('ultimatemailer');
        $this->db->select('host,port,auth,auth_type,username,password,sender');
        $this->db->from('gtg_smtp');
        $query = $this->db->get();
        $smtpresult = $query->row_array();
        $host = $smtpresult['host'];
        $port = $smtpresult['port'];
        $auth = $smtpresult['auth'];
        $auth_type = $smtpresult['auth_type'];
        $username = $smtpresult['username'];;
        $password = $smtpresult['password'];
        $mailfrom = $smtpresult['sender'];
        $mailfromtilte = $this->config->item('ctitle');

        $this->ultimatemailer->bin_send($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto, $mailtotitle, $subject, $message, $attachmenttrue, $attachment);
    }



    function deletejobsheetticket($id)
    {
        $this->db->delete('gtg_job', array('id' => $id));

        $this->db->select('attach');
        $this->db->from('gtg_jobsheets_th');
        $this->db->where('jid', $id);
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $row) {
            if ($row['attach'] != '') {

                unlink(FCPATH . 'userfiles/support/' . $row['attach']);
            }
        }
        $this->db->delete('gtg_jobsheets_th', array('jid' => $id));
        return true;
    }

    public function employee_details($id)
    {
        $this->db->select('gtg_employees.*,gtg_users.email,gtg_users.loc,gtg_users.roleid,');
        $this->db->from('gtg_employees');
        $this->db->where('gtg_employees.id', $id);
        $this->db->join('gtg_users', 'gtg_employees.id = gtg_users.id', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function assigntask($empid, $jobid, $assign_by, $jobtype)
    {
        $status=false;
        $details=$this->thread_jobsheet_info($jobid);
        $created_at=date("Y-m-d")." ".date("h:i:s");
        $data = array('jobid' => $jobid, 'assign_type' => $jobtype, 'assign_by' => $assign_by, 'assign_date' =>$created_at, 'status' => 0, 'staffid'=>$empid, 'updated_at' => $created_at,'created_at'=>$created_at);
        $res= $this->db->insert('gtg_jobtransaction', $data);
            if($res){
                $st=2;
                $jobdata = array(
                'userid'  =>  $empid,
                'status' => $st,
                'updated_at' =>  $created_at,
                'remarks' => ''
                );
                $this->db->where('id', $jobid);
                $result=$this->db->update('gtg_job', $jobdata);
                if($result){
                    $status=true;                    
                    $employee_details = $this->employee_details($empid);
                    $email = $employee_details['email'];
                    $name = $employee_details['name'];
                    $message = "Task has been Assigned";
                    $this->send_email($email, $name, '[Task Assigned] ', $message, $attachmenttrue = false, $attachment = '');
                    
                }else{
                    $this->db->delete('gtg_jobtransaction', array('jobid' => $jobid));
                }
            }
        return $status;
    }

    public function multiassigntask($empid, $jobids, $assign_by, $jobtype)
    {
        // echo $jobids;
        // print_r($jobids);
        // exit;
        $job_ids = explode(',',$jobids);

        if(!empty($job_ids))
        {
            foreach($job_ids as $jobid)
            {
                $status=false;
                $details=$this->thread_jobsheet_info($jobid);
                $created_at=date("Y-m-d")." ".date("h:i:s");
                $data = array('jobid' => $jobid, 'assign_type' => $jobtype, 'assign_by' => $assign_by, 'assign_date' =>$created_at, 'status' => 0, 'staffid'=>$empid, 'updated_at' => $created_at,'created_at'=>$created_at);
                $res= $this->db->insert('gtg_jobtransaction', $data);
                    if($res){
                        $st=2;
                        $jobdata = array(
                        'userid'  =>  $empid,
                        'status' => $st,
                        'updated_at' =>  $created_at
                        );
                        $this->db->where('id', $jobid);
                        $result=$this->db->update('gtg_job', $jobdata);
                        if($result){
                            $status=true;                    
                            $employee_details = $this->employee_details($empid);
                            $email = $employee_details['email'];
                            $name = $employee_details['name'];
                            $message = "Task has been Assigned";
                            $this->send_email($email, $name, '[Task Assigned] ', $message, $attachmenttrue = false, $attachment = '');
                            
                        }else{
                            $this->db->delete('gtg_jobtransaction', array('jobid' => $jobid));
                        }
                    }
        
            }
        }

        return $status;
    }


   function jobsheet_my_datatables($filt,$status='')
    {
        $this->jobsheet_my_datatables_query($filt,$status);
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }
    private function jobsheet_my_datatables_query($filt,$status='')
    {

        $this->db->from('gtg_job');
        $this->db->where('userid=', $this->aauth->get_user()->id);
        if ($filt == 'Assign') {
            $this->db->where('status=', '3');
        }else if($filt == 'Pending') {
            $this->db->where('status=', '2');
        }else if($filt == 'Completed') {
            $this->db->where('status=', '1');
        }else if($filt == 'WorkInProgress') {
            $this->db->where('status=', '4');
        }

        if ($status == 'Assign') {
            $this->db->where('status=', '3');
        }else if($status == 'Pending') {
            $this->db->where('status=', '2');
        }else if($status == 'Completed') {
            $this->db->where('status=', '1');
        }

        $i = 0;

        foreach ($this->doccolumn_search as $item) // loop column
        {

            $search = $this->input->post('search');
        $value='';
        if(!empty($search))
        {  $value = $search['value'];}

            if ($value) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->doccolumn_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->doccolumn_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function jobsheet_my_count_filtered($filt)
    {
        $this->jobsheet_my_datatables_query($filt);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function jobsheet_my_count_all($filt)
    {
        $this->jobsheet_my_datatables_query($filt);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function addjobsheetreply($thread_id, $message, $filename)
    {
               
        if($_SESSION['s_role'] != 'r_5')
        {
            $data = array('jid' => $thread_id, 'message' => $message, 'cid' => 0, 'eid' => $this->aauth->get_user()->id,'aid'=>0, 'cdate' => date('Y-m-d H:i:s'), 'attach' => $filename);
        }else{
            $data = array('jid' => $thread_id, 'message' => $message, 'cid' => 0, 'eid' => 0,'aid'=> $this->aauth->get_user()->id, 'cdate' => date('Y-m-d H:i:s'), 'attach' => $filename);

        }
        
        if ($this->ticket()->key2) {

            $customer = $this->thread_jobsheet_info($thread_id);
            $email = $this->thread_user_info($customer['userid']);

            $this->send_email($email['email'], $customer['cname'], '[Job Updated] #' . $thread_id, $message . $this->ticket()->other, $attachmenttrue = false, $attachment = '');
        }
        return $this->db->insert('gtg_jobsheets_th', $data);
    }
/*
    public function ticket_stats()
    {

        $query = $this->db->query("SELECT
				COUNT(IF( status = 'Waiting', id, NULL)) AS Waiting,
				COUNT(IF( status = 'Processing', id, NULL)) AS Processing,
				COUNT(IF( status = 'Solved', id, NULL)) AS Solved
				FROM gtg_tickets ");
        echo json_encode($query->result_array());
    }


    function ticket_datatables($filt)
    {
        $this->ticket_datatables_query($filt);
        if ($this->input->post('length') != -1)
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        $query = $this->db->get();
        return $query->result();
    }
*/




}
