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
        $c_module = 'dashboard';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);

    }

    public function jobsheet()
    {
        $this->load->model('jobsheet_model', 'jobsheet');

        $status = $this->input->get('status');

        if ($status == "Assign") {
            $data['assign'] = $this->jobsheet->jobsheet_count_filtered('Assign');

        } else if ($status == "Pending") {
            $data['pending'] = $this->jobsheet->jobsheet_count_filtered('Pending');

        } else if ($status == "Completed") {
            $data['completed'] = $this->jobsheet->jobsheet_count_filtered('Completed');

        } else {
            $data['totalt'] = $this->jobsheet->jobsheet_count_filtered('');

        }

        // $data['totalt'] = $this->jobsheet->jobsheet_count_filtered('');
        //  $data['pending']= $this->jobsheet->jobsheet_count_filtered('Pending');
        //  $data['completed']= $this->jobsheet->jobsheet_count_filtered('Completed');
        $head['title'] = 'Jobsheet';

        // print_r($data);
        $this->load->view('fixed/header', $head);
        $this->load->view('jobs', $data);
        $this->load->view('fixed/footer');

    }
    public function index()
    {
        $today = date("Y-m-d");
        $month = date("m");
        $year = date("Y");

        if ($this->aauth->premission(1) || $this->aauth->premission(160) || $this->aauth->premission(161) || $this->aauth->premission(162) || $this->aauth->premission(163)) {

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
            $this->load->model('jobsheet_model', 'jobsheet');

            $data['totalt'] = $this->jobsheet->jobsheet_count_filtered('');

            $data['assign'] = $this->jobsheet->jobsheet_count_filtered('Assign');
            $data['pending'] = $this->jobsheet->jobsheet_count_filtered('Pending');
            $data['completed'] = $this->jobsheet->jobsheet_count_filtered('Completed');
            $data['passport_expiry_ninety'] = $this->dashboard_model->getninetydaysDaysExpiryPassport();
            $data['permit_expiry_thirthy'] = $this->dashboard_model->getthirtyDaysExpiryPermit();
            $data['permit_expiry_sixty'] = $this->dashboard_model->getsixtyDaysExpiryPermit();
            $data['permit_expiry_ninety'] = $this->dashboard_model->getninetydaysDaysExpiryPermit();
            $head['usernm'] = $this->aauth->get_user()->username;
            $data['year_list'] = $this->dashboard_model->fetch_year();
            //$this->load->model('jobsheet_model', 'jobsheet');
            //$data['pendingList'] = $this->dashboard_model->jobsheet_Pending();

            // $data['closeList'] = $this->dashboard_model->jobsheet_Close();
            //$data['completedList'] = $this->dashboard_model->jobsheet_Completed();
            //$data['inprogressList'] = $this->dashboard_model->jobsheet_Inprogress();

            $head['title'] = 'Dashboard';
            $this->load->view('fixed/header', $head);
            $this->load->view('dashboard', $data);
            $this->load->view('fixed/footer');
        } else {
            
            $role = $this->session->userdata('s_role');
            $this->db->select('*');
            $this->db->where($role,1);
            $this->db->where('module_type', 'Landing Page');
            $this->db->order_by('id', 'ASC');
            $this->db->limit(1);
            $query = $this->db->get('sidebaritems');

            // echo $this->db->last_query();
            // exit;

            $out = $query->row_array();
            $url = $out['url'];

            $this->session->set_flashdata('messagePr', $this->session->flashdata("messagePr"));

            
            if(!empty($url))
            {
                redirect($url);
            }
        }

        //     $this->load->model('projects_model', 'projects');
        //     $head['usernm'] = $this->aauth->get_user()->username;
        //     $head['title'] = 'Project List';
        //     $data['totalt'] = $this->projects->project_count_all();

        //     $this->load->view('fixed/header', $head);
        //     $this->load->view('projects/index', $data);
        //     $this->load->view('fixed/footer');
        // } else if ($this->aauth->get_user()->roleid == 1) {

        //     $head['title'] = "Products";
        //     $head['usernm'] = $this->aauth->get_user()->username;
        //     $this->load->view('fixed/header', $head);
        //     $this->load->view('products/products');
        //     $this->load->view('fixed/footer');
        // } else {

        //     $head['title'] = "Manage Invoices";
        //     $head['usernm'] = $this->aauth->get_user()->username;
        //     $this->load->view('fixed/header', $head);
        //     $this->load->view('invoices/invoices');
        //     $this->load->view('fixed/footer');
        // }
    }
    public function fetch_data()
    {
        if ($this->input->post('year')) {
            $chart_data = $this->dashboard_model->fetch_chart_data($this->input->post('year'));
            // print_r($chart_data);

            if (!empty($chart_data)) {
                foreach ($chart_data as $row) {
                    $output[] = array(
                        'month' => $row["monthText"],
                        'expense' => floatval($row["amount"]),
                    );
                }
                echo json_encode($output);

            } else {
                $value = '[{"month":"January","expense":0},{"month":"February","expense":0},{"month":"March","expense":0},{"month":"April","expense":0},
	 {"month":"May","expense":0},{"month":"June","expense":0},{"month":"July","expense":0}]';
                $output[] = array(
                    'month' => '',
                    'expense' => '',
                );
                echo $value;

            }
            //print_r($output);
        }
    }
    public function clock_in()
    {
        if(!empty($_POST)){


              // Handle the uploaded image
              $imageData = $this->input->post('image');
              $decodedImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
              $imageName = uniqid('image_') . '.png';
              $imagePath = FCPATH . 'userfiles/clock_in_photos/' . $imageName;
              file_put_contents($imagePath, $decodedImageData);
  
              // Get location details
              $data['clock_in_photo'] = $imageName;
              $data['clock_in_latitude'] = $this->input->post('latitude_details');
              $data['clock_in_longitude'] = $this->input->post('longitude_details');
              $data['clock_in_location'] = $this->input->post('Location_details');
            
            //   echo "<pre>"; print_r($data); echo "</pre>";
            //   exit;
              // You can now use $imageName, $latitude, $longitude, $locationDetails as needed
              // For example, you might want to save this information in the database.
  
              // Respond with a success message
            //   $response = array('status' => 'success', 'message' => 'Image uploaded successfully');
            //   echo json_encode($response);
            // } else {
            //     // Handle non-POST requests accordingly
            //     show_error('Invalid request method.');
            // }

            $id = $this->aauth->get_user()->id;
            if ($this->aauth->auto_attend()) {
                $this->dashboard_model->clockin($id,$data);
            }

            //redirect('dashboard');
            $response['success'] = true;
            $response['redirect_url'] = site_url('dashboard');
            $this->session->set_flashdata('messagePr', 'Clock In Details Updated Successfully!..');
            echo json_encode($response);
            
        }else{
            
            $head['title'] = 'Attendance Clock In';
            $this->load->view('fixed/header', $head);
            $this->load->view('employee/attendance_clock_in');
            $this->load->view('fixed/footer');
        }
        
    }

    public function clock_out()
    {
    if(!empty($_POST)){
        $linkid = $this->input->get('id');
        if (isset($linkid)) {
            $id = $linkid;
        } else {

            $id = $this->aauth->get_user()->id;

        }

        $imageData = $this->input->post('image');
        $decodedImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
        $imageName = uniqid('image_') . '.png';
        $imagePath = FCPATH . 'userfiles/clock_out_photos/' . $imageName;
        file_put_contents($imagePath, $decodedImageData);

        // Get location details
        $data['clock_out_photo'] = $imageName;
        $data['clock_out_latitude'] = $this->input->post('latitude_details');
        $data['clock_out_longitude'] = $this->input->post('longitude_details');
        $data['clock_out_location'] = $this->input->post('Location_details');
      
     

        if ($this->aauth->auto_attend()) {
            $this->dashboard_model->clockout($id,$data);
        }
        
        $response['success'] = true;
        $response['redirect_url'] = site_url('dashboard');
        $this->session->set_flashdata('messagePr', 'Clock Out Details Updated Successfully!..');
        echo json_encode($response);

    }else{
            
        $head['title'] = 'Attendance Clock Out';
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/attendance_clock_out');
        $this->load->view('fixed/footer');
    }
    }
    public function break_in()
    {
        $code = $this->input->get('bt');
        $linkid = $this->input->get('id');
        if (isset($linkid)) {
            $id = $linkid;
        } else {

            $id = $this->aauth->get_user()->id;

        }
        if ($this->aauth->auto_attend()) {
            $this->dashboard_model->breakin($id, $code);
        }
        redirect('employee/attendview?id=' . $id);
    }

    public function break_out()
    {
        $id = $this->aauth->get_user()->id;

        if ($this->aauth->auto_attend()) {
            $this->dashboard_model->breakout($id);
        }
        redirect('employee/attendview?id=' . $id);
    }

    public function settings()
    {
        //$this->load->model('employee_model', 'employee');
        $c_module = 'settings';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);
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
        $c_module = 'settings';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);
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

            if ($this->input->post($name1)) {
                $val1 = 1;
            }

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
        $selectoption1 = $this->input->post('dashboardsettings_36');
        $selectoption2 = $this->input->post('dashboardsettings_40'); //    foreach($selectoption as $select)
        $selectoption3 = $this->input->post('dashboardsettings_41'); //    foreach($selectoption as $select)

        //    foreach($selectoption as $select)
        //{
        //    print_r($select);
        if (isset($selectoption) && empty($selectoption1)) {
            $data = array(
                'r_5' => 1,
            );
            // $this->db->set($data);
            $this->db->where('id', $selectoption);
            $this->db->update('gtg_premissions', $data);
            $data = array(
                'r_5' => 0,
            );
            // $this->db->set($data);
            $this->db->where('id', 36);
            $this->db->update('gtg_premissions', $data);

        } else if (isset($selectoption1) && empty($selectoption)) {
            $data = array(
                'r_5' => 1,
            );
            // $this->db->set($data);
            $this->db->where('id', $selectoption1);
            $this->db->update('gtg_premissions', $data);
            $data = array(
                'r_5' => 0,
            );
            // $this->db->set($data);
            $this->db->where('id', 35);
            $this->db->update('gtg_premissions', $data);

        } else if (isset($selectoption1) && isset($selectoption)) {
            $data = array(
                'r_5' => 1,
            );
            // $this->db->set($data);
            $this->db->where('id', $selectoption1);
            $this->db->update('gtg_premissions', $data);
            $data = array(
                'r_5' => 1,
            );
            // $this->db->set($data);
            $this->db->where('id', $selectoption);
            $this->db->update('gtg_premissions', $data);

        } else {

            $data = array(
                'r_5' => 0,
            );
            // $this->db->set($data);
            $this->db->where('id', 35);
            $this->db->update('gtg_premissions', $data);
            $data = array(
                'r_5' => 0,
            );
            // $this->db->set($data);
            $this->db->where('id', 36);
            $this->db->update('gtg_premissions', $data);

        }

        if (isset($selectoption2) && empty($selectoption3)) {

            $data = array(
                'r_5' => 1,
            );
            // $this->db->set($data);
            $this->db->where('id', $selectoption2);
            $this->db->update('gtg_premissions', $data);
            $data = array(
                'r_5' => 0,
            );
            // $this->db->set($data);
            $this->db->where('id', 41);
            $this->db->update('gtg_premissions', $data);

        } else if (isset($selectoption3) && empty($selectoption2)) {

            $data = array(
                'r_5' => 1,
            );
            // $this->db->set($data);
            $this->db->where('id', $selectoption3);
            $this->db->update('gtg_premissions', $data);
            $data = array(
                'r_5' => 0,
            );
            // $this->db->set($data);
            $this->db->where('id', 40);
            $this->db->update('gtg_premissions', $data);

        } else if (isset($selectoption3) && isset($selectoption2)) {
            $data = array(
                'r_5' => 1,
            );
            // $this->db->set($data);
            $this->db->where('id', $selectoption3);
            $this->db->update('gtg_premissions', $data);
            $data = array(
                'r_5' => 1,
            );
            // $this->db->set($data);
            $this->db->where('id', $selectoption2);
            $this->db->update('gtg_premissions', $data);

        } else {

            $data = array(
                'r_5' => 0,
            );
            // $this->db->set($data);
            $this->db->where('id', 40);
            $this->db->update('gtg_premissions', $data);
            $data = array(
                'r_5' => 0,
            );
            // $this->db->set($data);
            $this->db->where('id', 41);
            $this->db->update('gtg_premissions', $data);

        }

        redirect('dashboard/settings');

    }

    public function referralList()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Referral List';
        //$data['permission'] = $this->dashboard_model->subscribe_permissions();
        $this->load->view('fixed/header', $head);
        $this->load->view('referralList');
        $this->load->view('fixed/footer');

    }
    public function getReferrerList()
    {

        $ttype = $this->input->get('type');
        $list = $this->dashboard_model->get_datatables();
        $data = array();
        // $no = $_POST['start'];
        $temp = '';
        $type = '';
        $no = $this->input->post('start');
        foreach ($list as $obj) {
            if ($obj->status == 0) {
                $status = "Pending";
            } else if ($obj->status == 1) {
                $status = "In Progress";
            } else {
                $status = "Success";

            }
            $html = ' <a href="' . base_url() . 'dashboard/referenceEdit?id=' . $obj->id . '"  class="btn btn-primary btn-sm"><span class="fa fa-edit"></span>  ' . $this->lang->line('Edit') . '</a>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $obj->referral_name;
            $row[] = '<a href="#" class="" onclick="viewReferral(' . $obj->id . ');"> ' . $obj->company_name . '</a>';
            $row[] = $obj->created_at;
            $row[] = $obj->reffered_by;
            $row[] = $status . $html;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->dashboard_model->count_all(),
            "recordsFiltered" => $this->dashboard_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }

    public function getreferences()
    {
        $id = $this->input->post('id');
        $list = $this->dashboard_model->get_references($id);
        $html = '                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                       for="name">Referral Name</label>
                                <div class="col-sm-4">
                                  ' . $list->referral_name . '
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-sm-3 col-form-label"
                                       for="phone">Company Name</label>

                                <div class="col-sm-4">

                                   ' . $list->company_name . '

                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-3 col-form-label"
                                       for="phone">Contact Number</label>

                                <div class="col-sm-4">

                                   ' . $list->contact_no . '

                                </div>
                            </div>
                               <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                       for="phone">Email Id<span style="color:red"></span></label>

                                <div class="col-sm-4">

                                   ' . $list->emailid . '
                                </div>
                            </div>
							  <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                       for="phone">Remarks</label>

                                <div class="col-sm-4">

                                     ' . $list->remarks . '
                                </div>
                            </div>
                                </div>

                                </div>';

        echo json_encode($html);

    }
    public function referenceEdit()
    {

        $id = $this->input->get('id');
        $this->load->library("Common");
        $data['langs'] = $this->common->languages();
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['status'] = $this->dashboard_model->get_reference_status($id);
        // $data['categories'] = $this->asset->get_all_categories();
        //die;
        // $data['custom_fields'] = $this->custom->add_fields(1);
        $head['title'] = 'Update Status';
        $this->load->view('fixed/header', $head);
        $this->load->view('referenceStatus', $data);
        $this->load->view('fixed/footer');

    }
    public function UpdateReferralStatus()
    {

        $id = $this->input->post('statusid');
        $status = $this->input->post('status');
        $sub = $this->input->post('sub');
        $startdate = $this->input->post('startdate');
        $endate = $this->input->post('enddate');
        $remarks = $this->input->post('remarks');
        $update = $this->dashboard_model->update_referral_status($id, $status, $sub, $startdate, $endate, $remarks);
        if ($update) {

            $data['status'] = 'success';
            $data['message'] = $this->lang->line('UPDATED');

        } else {
            $data['status'] = 'danger';
            $data['message'] = $this->lang->line('ERROR');

        }
        $_SESSION['status'] = $data['status'];
        $_SESSION['message'] = $data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');
        redirect('dashboard/referralList', 'refresh');

    }
    public function ApprovedReferralList()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Referral List';
        //$data['permission'] = $this->dashboard_model->subscribe_permissions();
        $this->load->view('fixed/header', $head);
        $this->load->view('ApprovedreferralList');
        $this->load->view('fixed/footer');

    }

    public function getAprrovedReferrerList()
    {

        $ttype = $this->input->get('type');
        $list = $this->dashboard_model->get_datatables();
        $data = array();
        // $no = $_POST['start'];
        $temp = '';
        $type = '';
        $no = $this->input->post('start');
        foreach ($list as $obj) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $obj->created_at;
            $row[] = $obj->referral_name;
            $row[] = '<a href="#" class="" onclick="viewReferral(' . $obj->id . ');"> ' . $obj->company_name . '</a>';
            $row[] = $obj->subscription . "%";
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->dashboard_model->count_all(),
            "recordsFiltered" => $this->dashboard_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }

    public function getApprovedreferences()
    {
        $id = $this->input->post('id');
        $list = $this->dashboard_model->get_approved_references($id);
        // $date= date('Y-m-d',strtotime($list->created_at));
        ///  $newDate = date('Y-m-d', strtotime($date. ' + 1 years'));
        //$percent="15%";
        $html = '                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label"
                                       for="name">Start Date</label>
                                <div class="col-sm-4">
                                  ' . $list->start_date . '
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-sm-3 col-form-label"
                                       for="phone">End Date</label>

                                <div class="col-sm-4">

                                   ' . $list->end_date . '

                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-3 col-form-label"
                                       for="phone">Percentage</label>

                                <div class="col-sm-4">

                                   ' . $list->subscription . '

                                </div>
                            </div>


                                </div>

                                </div>';

        echo json_encode($html);

    }

}
