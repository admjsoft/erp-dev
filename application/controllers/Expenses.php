<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Expenses extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
        $this->load->model('expenses_model', 'expenses');
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        $this->load->library("Custom");
        $this->li_a = 'expenses';
        $c_module = 'expenses';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);
    }
    // expenses update function
    public function update_i()
    {
        // if (!$this->aauth->premission(22)) {

        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }
        $id = $this->input->post('id');
        $remarks = $this->input->post('remarks');
        $status = $this->input->post('status');
        $res=$this->expenses->expenses_update($id, $remarks, $status);
            if($res){
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Expense update success')));
            $data=$this->expenses->get_expense($id);
            $emp_id=$data[0]->eid;
            $emp_name=$data[0]->name;
            $title=$data[0]->title;
            $emp=$this->expenses->get_expense_user_by_id($emp_id);
            $tempStatus='';
            if($status==0){
                $tempStatus=$this->lang->line('Pending');;
            }elseif($status==1){
                 $tempStatus=$this->lang->line('Approved');;
            }
            elseif($status==2){
                 $tempStatus=$this->lang->line('On Hold');;
            }
            $alert = $this->custom->api_config(66);
                if ($alert['key1'] == 1) {
                    $this->load->model('communication_model');
                    $subject = $emp_name . ' ' . $this->lang->line('Expense request');
                    $body = $subject . '<br> Title:' . $title . '<br>'.$this->lang->line('Expense change').': '.$tempStatus."<br><br>".$this->lang->line('For Info Login')."".base_url();
                    $out = $this->communication_model->send_corn_email($alert['url'], $alert['url'], $subject, $body, false, '');
                    $out1 = $this->communication_model->send_corn_email($emp[0]->email, $emp_name, $subject, $body, false, '');
                }
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('Expense update fail')));
            }
    }
    // expenses delete function
    public function delete_i()
    {
        //if (!$this->aauth->premission(21)) {

        //    exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        //}

        $id = $this->input->post('deleteid');
        $data=$this->expenses->get_expense($id);
        $emp_id=$data[0]->eid;
        $emp_name=$data[0]->name;
        $title=$data[0]->title;

        if ($id) {
            echo json_encode($this->expenses->delt($id));
            // email notification
            $emp=$this->expenses->get_expense_user_by_id($emp_id);
            $alert = $this->custom->api_config(66);
                if ($alert['key1'] == 1) {
                    $this->load->model('communication_model');
                    $subject = $emp_name . ' ' . $this->lang->line('Expense request');
                    $body = $subject . '<br> Title:' . $title . '<br>'.$this->lang->line('Expense delete')."<br><br>".$this->lang->line('For info contact admin');
                    $out = $this->communication_model->send_corn_email($alert['url'], $alert['url'], $subject, $body, false, '');
                    $out1 = $this->communication_model->send_corn_email($emp[0]->email, $emp_name, $subject, $body, false, '');

                }
        } else {
            echo json_encode(array('status' => 'Error', 'message' => 'Error! expense'));
        }
    }

    // view pdf expenses
    public function print_t()
    {
        if (!$this->aauth->premission(21)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $head['title'] = "View ";
        $head['usernm'] = $this->aauth->get_user()->username;
        $id = $this->input->get('id');
        $data['trans'] = $this->expenses->view($id);
        print_r($data['trans']);

        if ($data['trans']['eid'] > 0) {
            $data['cdata'] = $this->expenses->cview($data['trans']['eid']);
        } else {
            $data['cdata'] = array('address' => $this->lang->line('Not registered'), 'city' => '', 'phone' => '', 'email' => '');
        }

        ini_set('memory_limit', '128M');

        $html = $this->load->view('expenses/view-print', $data, true);


        //PDF Rendering
        $this->load->library('pdf');

        $pdf = $this->pdf->load_en();

        $pdf->SetHTMLFooter('<table width="100%" style="vertical-align: bottom; font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;"><tr><td width="33%"></td><td width="33%" align="center" style="font-weight: bold; font-style: italic;">{PAGENO}/{nbpg}</td><td width="33%" style="text-align: right; ">#' . $id . '</td></tr></table>');

        if ($data['trans']['id']) $pdf->WriteHTML($html);

        if ($this->input->get('d')) {

            $pdf->Output('Trans_#' . $id . '.pdf', 'D');
        } else {
            $pdf->Output('Trans_#' . $id . '.pdf', 'I');
        }
    }



    // Category
    public function categories()
    {
        //$this->li_a = 'misc_settings';
       // if (!$this->aauth->premission(22)) {

        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }

        $data['catlist'] = $this->expenses->categories();
        $head['title'] = "Category";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('expenses/cat', $data);
        $this->load->view('fixed/footer');
    }
// create category
    public function createcat()
    {
       // if (!$this->aauth->premission(22)) {

        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }

        $head['title'] = "Category";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('expenses/cat_create');
        $this->load->view('fixed/footer');
    }
    // category edit
    public function editcat()
    {

       // if (!$this->aauth->premission(22)) {

        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }

        $head['title'] = "Category";
        $head['usernm'] = $this->aauth->get_user()->username;

        $id = $this->input->get('id');

        $data['cat'] = $this->expenses->cat_details($id);

        $this->load->view('fixed/header', $head);
        $this->load->view('expenses/cat-edit', $data);
        $this->load->view('fixed/footer');
    }
// category save
    public function save_createcat()
    {

       // if (!$this->aauth->premission(22)) {

        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }

        $name = $this->input->post('catname');

        if ($this->expenses->addcat($name)) {
            echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('ADDED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
            $this->lang->line('ERROR')));
        }
    }
    // category edit save
    public function editcatsave()
    {
       // if (!$this->aauth->premission(22)) {

        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }

        $id = $this->input->post('catid');
        $name = $this->input->post('cat_name');

        if ($this->expenses->cat_update($id, $name)) {

            echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('UPDATED')));
        } else {

            echo json_encode(array('status' => 'Error', 'message' =>
            'Error!'));
        }
    }
    // category delete
    public function delete_cat()
    {
        // if (!$this->aauth->premission(22)){
        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }

        $id = $this->input->post('deleteid');
        if ($id) {
            $this->db->delete('gtg_expenses_cat', array('id' => $id));
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => 'Error!'));
        }
    }


    // expenses list page
    public function index()
    {
       //if (!$this->aauth->premission(21)) {

        //    exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        //}
        $head['title'] = "Expenses";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('expenses/index');
        $this->load->view('fixed/footer');
    }


    // expenses reports page
    public function reports()
    {
       //if (!$this->aauth->premission(21)) {

        //    exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        //}
        $head['title'] = "Expenses";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('expenses/reports');
        $this->load->view('fixed/footer');
    }


    // expenses list
    public function expenseslist()
    {
        // if (!$this->aauth->premission(21)) {
        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }
        $ttype = $this->input->get('type');
        $status = $this->input->post('status');
        $employee = $this->input->post('employee');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        // echo "<pre>"; print_r($ $role_details); echo "</pre>";
        // exit;

        $user_role = $this->aauth->get_user()->roleid;
        $role_details = $this->db->where('id',$user_role)->get('gtg_role')->result_array();
        $all_data_previleges = $role_details[0]['all_data_previleges'];
        // echo "<pre>"; print_r($role_details); echo "</pre>";
        // exit;

        if ($all_data_previleges) {
            $employee = '';
        } else {
            // echo "sssssssss";
            // exit;
            $eid = $this->aauth->get_user()->id;
            //$this->db->where('employeeId',$eid);
            //$this->db->where('employeeId', $_SESSION['id']);
            $employee = $eid;
        }

        $list = $this->expenses->get_datatables($ttype,$status,$employee,$start_date,$end_date);
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        $temp='';
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $pid = $prd->id;
            $row[] = dateformat($prd->created_at);
            $row[] = $prd->name;
            $row[] = $prd->title;
            $row[] = $prd->category;
            $row[] = $prd->receipt_no;
            $row[] = dateformat($prd->receipt_date);
            $row[] = amountExchange($prd->receipt_amount, 0, $this->aauth->get_user()->loc);
            $row[] = amountExchange($prd->tax_amount, 0, $this->aauth->get_user()->loc);
            $temp= '<a  href="#" data-object-id="' . $pid . '" class="btn btn-primary btn-sm update-object"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> &nbsp; &nbsp;</br><a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span>Delete</a>';
            if($prd->status==1){
                $row[] = "Approved";
               $temp= '<a  href="#" data-object-id="' . $pid . '" class="btn btn-primary btn-sm update-object"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a>&nbsp; &nbsp;</br> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print" target="_blank" ><span class="fa fa-print">Print</span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span>Delete</a>';
            }elseif($prd->status==2){
                $row[] = "On Hold";
            }else{
                 $row[]= "Pending";
            }

            $row[] =$temp;
            /*
              $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
              */
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->expenses->count_all($status,$employee,$start_date,$end_date),
            "recordsFiltered" => $this->expenses->count_filtered($status,$employee,$start_date,$end_date),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    // add expenses
    public function add()
    {
       //if (!$this->aauth->premission(21)) {

        //    exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        //}
        $data['dual'] = $this->custom->api_config(65);
        $data['cat'] = $this->expenses->categories();
        $head['title'] = "Add Expenses";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('expenses/create', $data);
        $this->load->view('fixed/footer');
    }

    // save expense
    public function save_expenses()
    {
        //  if (!$this->aauth->premission(21)) {
        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }
                $emp_name = $this->input->post('emp_name', true);

        $explode=explode("-",$emp_name);
        $emp_id=$explode[0];
        $emp_name=$explode[1];
       // $emp_id = $this->input->post('emp_id', true);
        //$emp_name = $this->input->post('emp_name', true);
        $title = $this->input->post('title', true);
        $category = $this->input->post('category', true);
        $receipt_no = $this->input->post('receipt_no', true);
        $receipt_date = $this->input->post('receipt_date', true);
		
        $receipt_amount = numberClean($this->input->post('receipt_amount', true));
        $tax_amount = numberClean($this->input->post('tax_amount', true));
        $reason = $this->input->post('reason', true);
        $remarks = $this->input->post('remarks', true);
        $data=array();

        $attach = $_FILES['doc']['name'];
        $data['status'] = 'danger';
        $data['message'] = $this->lang->line('No file error');
        if ($attach){
            $config['upload_path'] = './userfiles/documents';
            $config['allowed_types'] = 'pdf|png|jpeg|jpg';
            $config['encrypt_name'] = TRUE;
            $config['max_size'] = 3000;
            $config['file_name'] = time() . str_replace(' ', '_', $attach);
            $config['file_ext_tolower'] = TRUE;
            $config['encrypt_name'] = FALSE;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('doc')) {
                    $data['status'] = 'danger';
                    $data['message'] = $this->lang->line('File upload error');
                } else {
                    $filename = $config['file_name'];
                    $uploaddoc=$this->expenses->addexpense($emp_id,$emp_name,$title,$category,$receipt_no,$receipt_date,$receipt_amount,$tax_amount,$reason,$remarks,$filename);
                    if(!$uploaddoc){
                    $data['status'] = 'danger';
                    $data['message'] = $this->lang->line('Expense error');
                    }else{
                    $data['status'] = 'success';
                    $data['message'] = $this->lang->line('Expense added');
                    // email notification
                    $emp=$this->expenses->get_expense_user_by_id($emp_id);
                    $alert = $this->custom->api_config(66);
                        if ($alert['key1'] == 1) {
                            $this->load->model('communication_model');
                            $subject = $emp_name . ' ' . $this->lang->line('Expense request for').$category;
                            $body = $subject . '<br> '.$this->lang->line('Title').':' . $title . '<br> '.$this->lang->line('Category').':' . $category . '<br> '.$this->lang->line('Receipt No').':' . $receipt_no . '<br> '.$this->lang->line('Receipt Date').':' . $receipt_date . '<br> '.$this->lang->line('Amount').':' . $receipt_amount . '<br> '.$this->lang->line('Tax').':' . $tax_amount."<br><br>".$this->lang->line('For Info Login')." ".base_url();
                            $out = $this->communication_model->send_corn_email($alert['url'], $alert['url'], $subject, $body, true, base_url().'userfiles/documents/'.$filename);
                            $out1 = $this->communication_model->send_corn_email($emp[0]->email, $emp_name, $subject, $body, true, base_url().'userfiles/documents/'.$filename);

                        }
                    }
                }
        }

        unset($_POST);
        $_SESSION['status']=$data['status'];
        $_SESSION['message']=$data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');
        redirect('expenses', 'refresh');
        exit();
    }
    // get expense details
    public function employeeExpense(){
        $id = $this->input->post('id');
        $list = $this->expenses->get_expense($id);
        if(is_array($list)){
        echo json_encode($list[0]);}
        else{
            echo '{"status":"-1"}';
        }

    }

    // search expenses
    public function employee_search()
    {
        $result = array();
        $out = array();
        $tbl = 'gtg_employees as e, gtg_users as u';
        $name = $this->input->get('keyword', true);

        $whr = '';


        if ($this->aauth->get_user()->loc) {
            $whr = ' (loc=' . $this->aauth->get_user()->loc . ' OR loc=0) AND ';
            if (!BDATA) $whr = ' (loc=' . $this->aauth->get_user()->loc . ' ) AND ';
        } elseif (!BDATA) {
            $whr = ' (loc=0) AND ';
        }


        if ($name) {
            $query = $this->db->query("SELECT e.id,e.name,e.address,e.city,e.phone,u.email FROM $tbl  WHERE $whr  e.id=u.id AND (UPPER(e.name)  LIKE '%" . strtoupper($name) . "%' OR UPPER(e.phone)  LIKE '" . strtoupper($name) . "%') LIMIT 6");
            $result = $query->result_array();
            echo '<ol>';
            $i = 1;
            foreach ($result as $row) {

                echo "<li onClick=\"selectEmployee('" . $row['id'] . "','" . $row['name'] . " ','" . $row['address'] . "','" . $row['city'] . "','" . $row['phone'] . "','" . $row['email'] . "')\"><span>$i</span><p>" . $row['name'] . " &nbsp; &nbsp  " . $row['phone'] . "</p></li>";
                $i++;
            }
            echo '</ol>';
        }
    }
}
