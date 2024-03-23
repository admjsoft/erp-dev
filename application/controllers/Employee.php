<?php

defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';
require_once APPPATH . 'third_party/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Mpdf\Mpdf;
class Employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('employee_model', 'employee');        
        $this->load->model('filemanager_model', 'FileModel'); 
        $this->load->library("Aauth");
        $this->load->library('pdf');

       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }
        // if (!$this->aauth->premission(9) && !$this->aauth->premission(25)) {

        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }
        $this->li_a = 'emp';
        $c_module = 'hrm';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);
    }

    public function index()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Employees List';
        $data['employee'] = $this->employee->list_employee();
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/list', $data);
        $this->load->view('fixed/footer');
    }

    public function salaries()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Employees List';
        $data['employee'] = $this->employee->list_employee();
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/salaries', $data);
        $this->load->view('fixed/footer');
    }

    public function view()
    {
        $id = $this->input->get('id');
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Employee Details';
        $data['employee'] = $this->employee->employee_details($id);
        $data['eid'] = intval($id);
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/view', $data);
        $this->load->view('fixed/footer');
    }

    public function history()
    {
        $id = $this->input->get('id');
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Employee Details';
        $data['employee'] = $this->employee->employee_details($id);
        $data['history'] = $this->employee->salary_history($data['employee']['id']);
        $data['eid'] = intval($id);
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/history', $data);
        $this->load->view('fixed/footer');
    }

    public function add()
    {

        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Add Employee';
        $data['dept'] = $this->employee->department_list(0);
        $data['clients'] = $this->employee->get_client_list();
        $data['role_list'] = $this->employee->role_list();
        $data['country'] = $this->employee->country_list();
        $data['client_list'] = $this->employee->client_list();

        $orgId = $_SESSION['loggedin'];
        // $this->load->model('payroll_model', 'payroll');
        // $data['organization'] =$this->employee->getOrganizationDetails($orgId);

        $this->load->view('fixed/header', $head);
        $this->load->view('employee/add', $data);
        $this->load->view('fixed/footer');
    }

    public function submit_user()
    {

        if ($this->aauth->get_user()->roleid < 4) {
            redirect('/dashboard/', 'refresh');
        }

        $username = $this->input->post('username', true);

        $password = $this->input->post('password', true);
        $roleid = 3;
        if ($this->input->post('roleid')) {
            $roleid = $this->input->post('roleid');
        }

        if ($roleid > 3) {
            if ($this->aauth->get_user()->roleid < 5) {
                die('No! Permission');
            }
        }

        $user_role = $this->input->post('roleid', true);

        $location = $this->input->post('location', true);
        $name = $this->input->post('name', true);
        $phone = $this->input->post('phone', true);

        $email = $this->input->post('email', true);
        $address = $this->input->post('address', true);
        $city = $this->input->post('city', true);
        $region = $this->input->post('region', true);
        $country = $this->input->post('country', true);
        $postbox = $this->input->post('postbox', true);
        $salary = numberClean($this->input->post('salary', true));
        $commission = $this->input->post('commission', true);
        $department = $this->input->post('department', true);

        $gender = $this->input->post('gender', true);
        $socso_number = $this->input->post('socso_number', true);
        $kwsp_number = $this->input->post('kwsp_number', true);
        $pcb_number = $this->input->post('pcb_number', true);
        $join_date = $this->input->post('joined_date', true);
        $employee_job_type = $this->input->post('employee_job_type', true);

        $ic_number = $this->input->post('ic_number', true);
        $bank_name = $this->input->post('bank_name', true);
        $bank_account_number = $this->input->post('bank_account_number', true);

        if (!empty($email) && !empty($password) && !empty($username)) {
            $a = $this->aauth->create_user($email, $password, $username);

            if (!empty($this->aauth->get_user($a)->id)) {
                if ((string) $this->aauth->get_user($a)->id != $this->aauth->get_user()->id) {
                    $nuid = (string) $this->aauth->get_user($a)->id;

                    if ($nuid > 0) {
                        $this->employee->add_employee($nuid, (string) $this->aauth->get_user($a)->username, $name, $roleid, $phone, $address, $city,
                            $region, $country, $postbox, $location, $salary, $commission, $department, $email, $password, $user_role, $gender, $socso_number, $kwsp_number, $pcb_number, $join_date, $employee_job_type, $ic_number, $bank_name, $bank_account_number);
                    }
                } else {
                    echo json_encode(array('status' => 'Error', 'message' =>
                        'There has been an error, please try again.'));}
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $a));
            }

        } else {

            $d_user_id = $this->aauth->create_dummy_user();
            $this->employee->add_employee_new($d_user_id, $name, $roleid, $phone, $address, $city, $region, $country, $postbox, $location, $salary, $commission, $department, $user_role, $join_date,  $employee_job_type, $ic_number, $bank_name, $bank_account_number);

        }

    }

    public function invoices()
    {
        $id = $this->input->get('id');
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Employee Invoices';
        $data['employee'] = $this->employee->employee_details($id);
        $data['eid'] = intval($id);
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/invoices', $data);
        $this->load->view('fixed/footer');
    }

    public function invoices_list()
    {

        $eid = $this->input->post('eid');
        $list = $this->employee->invoice_datatables($eid);
        $data = array();

        $no = $this->input->post('start');

        foreach ($list as $invoices) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $invoices->tid;
            $row[] = $invoices->name;
            $row[] = $invoices->invoicedate;
            $row[] = amountExchange($invoices->total, 0, $this->aauth->get_user()->loc);
            switch ($invoices->status) {
                case "paid":
                    $out = '<span class="label label-success">Paid</span> ';
                    break;
                case "due":
                    $out = '<span class="label label-danger">Due</span> ';
                    break;
                case "canceled":
                    $out = '<span class="label label-warning">Canceled</span> ';
                    break;
                case "partial":
                    $out = '<span class="label label-primary">Partial</span> ';
                    break;
                default:
                    $out = '<span class="label label-info">Pending</span> ';
                    break;
            }
            $row[] = $out;
            $row[] = '<a href="' . base_url("invoices/view?id=$invoices->id") . '" class="btn btn-success btn-xs"><i class="fa fa-eye"></i> View</a> &nbsp; <a href="' . base_url("invoices/printinvoice?id=$invoices->id") . '&d=1" class="btn btn-info btn-xs"  title="Download"><span class="fa fa-download"></span></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->invoicecount_all($eid),
            "recordsFiltered" => $this->employee->invoicecount_filtered($eid),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function transactions()
    {
        $id = $this->input->get('id');
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Employee Transactions';
        $data['employee'] = $this->employee->employee_details($id);
        $data['eid'] = intval($id);
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/transactions', $data);
        $this->load->view('fixed/footer');
    }
    public function addExcel()
    {
        $id = $this->input->get('id');
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Employee Import';
        //$data['employee'] = $this->employee->employee_details($id);
        $data['eid'] = intval($id);
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/import', $data);
        $this->load->view('fixed/footer');
    }

   
    
    public function import()
    {

        // if ($_FILES['file']['name'] != "Employee-Management-Template.xlsx") {
        //     $data['status'] = 'danger';
        //     $data['message'] = $this->lang->line('Employee Template Error Use Jsuite Downloaded Template');
        //     $_SESSION['status'] = $data['status'];
        //     $_SESSION['message'] = $data['message'];
        //     $this->session->mark_as_flash('status');
        //     $this->session->mark_as_flash('message');
        //     redirect('employee/addExcel', 'refresh');

        // }
        $path = "../userfiles/";
        $json = [];
        $this->upload_config($path);
        if (!$this->upload->do_upload('file')) {
            echo $this->upload->display_errors();

        } else {

            $file_data = $this->upload->data();
            $file_name = $path . $file_data['file_name'];
            $arr_file = explode('.', $file_name);
            $extension = end($arr_file);
            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            $spreadsheet = $reader->load($file_name);
            $sheet_data = $spreadsheet->getActiveSheet()->toArray();
            $list = [];

            
            $rolesArray = $this->employee->role_list();
            $countriesArray = $this->employee->country_list();

            foreach ($sheet_data as $key => $val) {

                // if(!empty($val[0]) && !empty($val[1]))
                // {
                if ($key > 1) {
                    $result = '';

                    if ($result) {
                    } else {

                        if(!empty($val[0]) && !empty($val[1]))
                        {
                        $roleNameToFind = $val[15];

                        // Initialize variable to store the found role ID
                        $foundRoleId = null;

                        // Loop through the array to find the role ID
                        foreach ($rolesArray as $role) {
                            // if ($role['role_name'] === $roleNameToFind) {
                            //     $foundRoleId = $role['id'];
                            //     break; // Break the loop once the role is found
                            // }
                            $normalizedRoleName = str_replace(' ', '', strtolower($role['role_name']));
                            $normalizedRoleNameToFind = str_replace(' ', '', strtolower($roleNameToFind));
                            
                            if ($normalizedRoleName === $normalizedRoleNameToFind) {
                                $foundRoleId = $role['id'];
                                break; // Break the loop once the role is found
                            }
                        }

                        if ($foundRoleId !== null) {
                            $role = $foundRoleId;
                        } else {
                            $role = 8;
                        }


                        $countryNameToFind = $val[7];

                        $foundCountryId = null;

                        // Loop through the array to find the role ID
                        foreach ($countriesArray as $country) {
                            // if ($role['role_name'] === $roleNameToFind) {
                            //     $foundRoleId = $role['id'];
                            //     break; // Break the loop once the role is found
                            // }
                            $normalizedCountryName = str_replace(' ', '', strtolower($country->country_name));
                            $normalizedCountryNameToFind = str_replace(' ', '', strtolower($countryNameToFind));
                            
                            if ($normalizedCountryName === $normalizedCountryNameToFind) {
                                $foundCountryId = $country->id;
                                break; // Break the loop once the role is found
                            }
                        }

                        if ($foundCountryId !== null) {
                            $country = $foundCountryId;
                        } else {
                            $country = 134;
                        }

                        if ($val[7] == 'foreign') {
                            $employee_type = 'foreign';
                        } else {
                            $employee_type = '';
                        }


                        $list[] = [
                            'username' => $val[0],
                            'email' => $val[1],
                            'name' => $val[2],
                            'ic_number' => $val[3],
                            'address' => $val[4],
                            'city' => $val[5],
                            'region' => $val[6],
                            'country' => $country,
                            'phone' => $val[8],
                            'employee_type' => $employee_type,
                            'gender' => strtolower($val[10]),
                            'socso_number' => $val[11],
                            'kwsp_number' => $val[12],
                            'pcb_number' => $val[13],
                            'joindate' => $val[14],
                            'degis' => $role,
                            'bank_name' => $val[16],
                            'bank_account_number' => $val[17],

                        ];
                        $list1[] = [
                            'username' => $val[0],
                            'email' => $val[1],
                            'pass' => '123456',
                            'roleid' => $role,

                        ];
                    }
                }
            }
            }


            // echo "<pre>"; print_r($list); echo "</pre>";
            // echo "<pre>"; print_r($list1); echo "</pre>";
            // exit;

            if (file_exists($file_name)) {
                unlink($file_name);
            }

            if (count($list) > 0) {
                $result = $this->employee->add_batch($list, $list1);
                //print_r($result);
                
                if ($result > 0 && $result != 0) {
                    $data['status'] = 'danger';
                    $data['message'] = $result . " Rows Are Duplicate";

                } else {

                    $data['status'] = 'success';
                    $data['message'] = $this->lang->line('UPDATED');
                }

            } else {

            }
        }
        //exit;
        $_SESSION['status'] = $data['status'];
        $_SESSION['message'] = $data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');
        redirect('employee/addExcel', 'refresh');
        exit();
    }

    public function upload_config($path)
    {
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $config['upload_path'] = './' . $path;
        $config['allowed_types'] = 'csv|CSV|xlsx|XLSX|xls|XLS';
        $config['max_filename'] = '255';
        $config['encrypt_name'] = true;
        $config['max_size'] = 4096;
        $this->load->library('upload', $config);
    }

    public function reminder()
    {

        $this->load->model('employee_model', 'employee');

        $exppassportlist = $this->employee->getpassportExpiryList();
        //print_r($exppassportlist);
        $exppassportlistsixty = $this->employee->getpassportExpiryListSixty();
        //  $exppassportlistninenty = $this->employee->getpassportExpiryListNinenty();

        $exppermitlist = $this->employee->getpermitExpiryList();
        $exppermitlistsixty = $this->employee->getpermitExpiryListSixty();
        $exppermitlistninenty = $this->employee->getpermitExpiryListNinenty();

        $schedulefor = $this->employee->getschedulerList();
        $explode = explode(",", $schedulefor->scheduler_on);

        $passport = $explode[0];
        if (count($explode) > 1) {
            $permit = $explode[1];
        } else {
            $permit = '';

        }
        $emailist = $this->employee->getEmailToSend();
        $explodevariable = explode(",", $emailist->email_to);

        if (in_array("1", $explodevariable)) {

            $orgId = $_SESSION['loggedin'];
            // $this->load->model('payroll_model', 'payroll');
            $organization = $this->employee->getOrganizationDetails($orgId);
            $adminemail = $organization->email;
            $elements = array();
            $content = '';
            if ($passport) {
                if (!empty($exppassportlist)) {
                    $message = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Passport</th><th>Expiry Date</th><th>Remaining Date</th></tr>';
                    foreach ($exppassportlist as $exppassport) {
                        //do something
                        $passportemail = $exppassport['email'];
                        $id = $exppassport['id'];

                        $name = $exppassport['name'];
                        $passport = $exppassport['passport'];
                        $passport_expiry = $exppassport['passport_expiry'];
                        $cus_name = $exppassport['cus_name'];
                        $currentdate = date("Y-m-d");
                        $datetime1 = date_create($currentdate);
                        $datetime2 = date_create($passport_expiry);

// Calculates the difference between DateTime objects
                        $interval = date_diff($datetime1, $datetime2);

// Display the result
                        $remainingdate = $interval->format('%R%a days');
                        $content = '';
                        $mailto = $adminemail;
                        $mailtotitle = "";
                        $subject = "List of Employee Expiry Between 16 month";
                        $message .= '
		<tr><td>' . $name . '</td><td>' . $cus_name . '</td><td>' . $passport . '</td><td>' . $passport_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                    }
                    $message .= "</table>";
                    $attachmenttrue = "true";
                    $this->load->library('ultimatemailer');
                    $this->db->select('host,port,auth,auth_type,username,password,sender');
                    $this->db->from('gtg_smtp');
                    $query = $this->db->get();
                    $smtpresult = $query->row_array();
                    $host = $smtpresult['host'];
                    $port = $smtpresult['port'];
                    $auth = $smtpresult['auth'];
                    $auth_type = $smtpresult['auth_type'];
                    $username = $smtpresult['username'];
                    $password = $smtpresult['password'];
                    $mailfrom = $smtpresult['sender'];
                    $mailfromtilte = $this->config->item('ctitle');
                    $mailer = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto,
                        $mailtotitle, $subject, $message, $attachmenttrue, '');
                    if ($mailer) {
                        foreach ($exppassportlist as $exppassport) {
                            $data = array(
                                'passport_email_sent' => 1,
                            );
                            $this->db->set($data);
                            $this->db->where('id', $exppassport['id']);
                            $this->db->update('gtg_employees');
                        }
                    }
                }

                if (!empty($exppassportlistsixty)) {
                    $message = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Passport</th><th>Expiry Date</th><th>Remaining Date</th></tr>';
                    //$employeeidarray=array();
                    foreach ($exppassportlistsixty as $exppassportsixty) {
                        //do something
                        $passportemail = $exppassportsixty['email'];
                        $id = $exppassportsixty['id'];
                        //$employeeidarray[] =$id;

                        $name = $exppassportsixty['name'];
                        $passport = $exppassportsixty['passport'];
                        $passport_expiry = $exppassportsixty['passport_expiry'];
                        $cus_name = $exppassportsixty['cus_name'];
                        $currentdate = date("Y-m-d");
                        $datetime1 = date_create($currentdate);
                        $datetime2 = date_create($passport_expiry);

// Calculates the difference between DateTime objects
                        $interval = date_diff($datetime1, $datetime2);

// Display the result
                        $remainingdate = $interval->format('%R%a days');
                        $content = '';
                        $mailto = $adminemail;
                        $mailtotitle = "";
                        $subject = "List of Employee Expiry Between 19 month";
                        $message .= '
		<tr><td>' . $name . '</td><td>' . $cus_name . '</td><td>' . $passport . '</td><td>' . $passport_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                    }
                    //$imploadedis= implode(',', $employeeidarray);
                    $message .= "</table>";
                    $attachmenttrue = "true";
                    $this->load->library('ultimatemailer');
                    $this->db->select('host,port,auth,auth_type,username,password,sender');
                    $this->db->from('gtg_smtp');
                    $query = $this->db->get();
                    $smtpresult = $query->row_array();
                    $host = $smtpresult['host'];
                    $port = $smtpresult['port'];
                    $auth = $smtpresult['auth'];
                    $auth_type = $smtpresult['auth_type'];
                    $username = $smtpresult['username'];
                    $password = $smtpresult['password'];
                    $mailfrom = $smtpresult['sender'];
                    $mailfromtilte = $this->config->item('ctitle');
                    $mailer = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto,
                        $mailtotitle, $subject, $message, $attachmenttrue, '');
                    if ($mailer) {
                        foreach ($exppassportlistsixty as $exppassportsixty) {
                            $data = array(
                                'passport_email_sent' => 1,
                            );
                            $this->db->set($data);
                            $this->db->where('id', $exppassportsixty['id']);
                            $this->db->update('gtg_employees');
                        }
                    }
                }
                /*
            if(!empty($exppassportlistninenty))
            {
            $message='<table border=1><tr><th>Name</th><th>Company Name</th><th>Passport</th><th>Expiry Date</th><th>Remaining Date</th></tr>';
            //$employeeidarray=array();
            foreach($exppassportlistninenty as $exppassportninety) {
            //do something
            $passportemail =  $exppassportninety['email'];
            $id=$exppassportninety['id'];
            //$employeeidarray[] =$id;

            $name=$exppassportninety['name'];
            $passport=$exppassportninety['passport'];
            $passport_expiry=$exppassportninety['passport_expiry'];
            $cus_name=$exppassportninety['cus_name'];
            $currentdate=date("Y-m-d");
            $datetime1 = date_create($currentdate);
            $datetime2 = date_create($passport_expiry);

            // Calculates the difference between DateTime objects
            $interval = date_diff($datetime1, $datetime2);

            // Display the result
            $remainingdate= $interval->format('%R%a days');
            $content='';
            $mailto=$adminemail;
            $mailtotitle="";
            $subject="List of Employee Expiry Between 31-60 days";
            $message.='<tr><td>'.$name.'</td><td>'.$cus_name.'</td><td>'.$passport.'</td><td>'.$passport_expiry.'</td><td>'.$remainingdate.'</td></tr>';

            }
            //$imploadedis= implode(',', $employeeidarray);
            $message.="</table>";
            $attachmenttrue="true";
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
            $mailer=$this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto,
            $mailtotitle, $subject, $message, $attachmenttrue,'');
            if($mailer)
            {
            foreach($exppassportlistninenty as $exppassportninety) {
            $data = array(
            'passport_email_sent' =>1
            );
            $this->db->set($data);
            $this->db->where('id', $exppassportninety['id']);
            $this->db->update('gtg_employees');
            }
            }
            }

             */

            }
            $content1 = '';
            if ($permit) {

                if (!empty($exppermitlist)) {
                    $permitmessage = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Permit</th><th>Expiry Date</th><th>Remaining Date</th></tr>';

                    foreach ($exppermitlist as $exppermit) {
                        //do something
                        $permitemail = $exppermit['email'];
                        $id = $exppermit['id'];
                        $permitname = $exppermit['name'];
                        $cus_name = $exppermit['cus_name'];

                        $permit = $exppermit['permit'];
                        $permit_expiry = $exppermit['permit_expiry'];
                        $currentdate = date("Y-m-d");
                        $datetime1 = date_create($currentdate);
                        $datetime2 = date_create($permit_expiry);

// Calculates the difference between DateTime objects
                        $interval = date_diff($datetime1, $datetime2);

// Display the result
                        $remainingdate = $interval->format('%R%a days');
                        $permitmessage .= '<tr><td>' . $permitname . '</td><td>' . $cus_name . '</td><td>' . $permit . '</td><td>' . $permit_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                    }
                    $permitmessage .= "</table>";

                    $this->load->library('ultimatemailer');
                    $this->db->select('host,port,auth,auth_type,username,password,sender');
                    $this->db->from('gtg_smtp');
                    $query = $this->db->get();
                    $smtpresult = $query->row_array();
                    $host = $smtpresult['host'];
                    $port = $smtpresult['port'];
                    $auth = $smtpresult['auth'];
                    $auth_type = $smtpresult['auth_type'];
                    $username = $smtpresult['username'];
                    $password = $smtpresult['password'];
                    $mailfrom = $smtpresult['sender'];
                    $mailfromtilte = $this->config->item('ctitle');
                    $mailtotitle = "";

                    $attachmenttrue = "true";
                    $mailto1 = $permitemail;
                    $subject1 = "Permit Reminder";
                    $mailer1 = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto1, $mailtotitle, $subject1, $permitmessage, $attachmenttrue, '');

                    if ($mailer1) {
                        foreach ($exppermitlist as $exppermit) {
                            $data = array(
                                'permit_email_sent' => 1,
                            );
                            $this->db->set($data);
                            $this->db->where('id', $exppermit['id']);
                            $this->db->update('gtg_employees');
                        }
                    }
                }

                if (!empty($exppermitlistsixty)) {
                    $permitmessage = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Permit</th><th>Expiry Date</th><th>Remaining Date</th></tr>';

                    foreach ($exppermitlistsixty as $exppermitsixty) {
                        //do something
                        $permitemail = $exppermitsixty['email'];
                        $id = $exppermitsixty['id'];
                        $permitname = $exppermitsixty['name'];
                        $cus_name = $exppermitsixty['cus_name'];

                        $permit = $exppermitsixty['permit'];
                        $permit_expiry = $exppermit['permit_expiry'];
                        $currentdate = date("Y-m-d");
                        $datetime1 = date_create($currentdate);
                        $datetime2 = date_create($permit_expiry);

// Calculates the difference between DateTime objects
                        $interval = date_diff($datetime1, $datetime2);

// Display the result
                        $remainingdate = $interval->format('%R%a days');
                        $permitmessage .= '<tr><td>' . $permitname . '</td><td>' . $cus_name . '</td><td>' . $permit . '</td><td>' . $permit_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                    }
                    $permitmessage .= "</table>";

                    $this->load->library('ultimatemailer');
                    $this->db->select('host,port,auth,auth_type,username,password,sender');
                    $this->db->from('gtg_smtp');
                    $query = $this->db->get();
                    $smtpresult = $query->row_array();
                    $host = $smtpresult['host'];
                    $port = $smtpresult['port'];
                    $auth = $smtpresult['auth'];
                    $auth_type = $smtpresult['auth_type'];
                    $username = $smtpresult['username'];
                    $password = $smtpresult['password'];
                    $mailfrom = $smtpresult['sender'];
                    $mailfromtilte = $this->config->item('ctitle');
                    $mailtotitle = "";

                    $attachmenttrue = "true";
                    $mailto1 = $permitemail;
                    $subject1 = "Permit Reminder";
                    $mailer1 = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto1, $mailtotitle, $subject1, $permitmessage, $attachmenttrue, '');

                    if ($mailer1) {
                        foreach ($exppermitlistsixty as $exppermitsixty) {
                            $data = array(
                                'permit_email_sent' => 1,
                            );
                            $this->db->set($data);
                            $this->db->where('id', $exppermitsixty['id']);
                            $this->db->update('gtg_employees');
                        }
                    }
                }

                if (!empty($exppermitlistninenty)) {
                    $permitmessage = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Permit</th><th>Expiry Date</th><th>Remaining Date</th></tr>';

                    foreach ($exppermitlistsixty as $exppermitsixty) {
                        //do something
                        $permitemail = $exppermitsixty['email'];
                        $id = $exppermitsixty['id'];
                        $permitname = $exppermitsixty['name'];
                        $cus_name = $exppermitsixty['cus_name'];

                        $permit = $exppermitsixty['permit'];
                        $permit_expiry = $exppermit['permit_expiry'];
                        $currentdate = date("Y-m-d");
                        $datetime1 = date_create($currentdate);
                        $datetime2 = date_create($permit_expiry);

// Calculates the difference between DateTime objects
                        $interval = date_diff($datetime1, $datetime2);

// Display the result
                        $remainingdate = $interval->format('%R%a days');
                        $permitmessage .= '<tr><td>' . $permitname . '</td><td>' . $cus_name . '</td><td>' . $permit . '</td><td>' . $permit_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                    }
                    $permitmessage .= "</table>";

                    $this->load->library('ultimatemailer');
                    $this->db->select('host,port,auth,auth_type,username,password,sender');
                    $this->db->from('gtg_smtp');
                    $query = $this->db->get();
                    $smtpresult = $query->row_array();
                    $host = $smtpresult['host'];
                    $port = $smtpresult['port'];
                    $auth = $smtpresult['auth'];
                    $auth_type = $smtpresult['auth_type'];
                    $username = $smtpresult['username'];
                    $password = $smtpresult['password'];
                    $mailfrom = $smtpresult['sender'];
                    $mailfromtilte = $this->config->item('ctitle');
                    $mailtotitle = "";

                    $attachmenttrue = "true";
                    $mailto1 = $permitemail;
                    $subject1 = "Permit Reminder";
                    $mailer1 = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto1, $mailtotitle, $subject1, $permitmessage, $attachmenttrue, '');

                    if ($mailer1) {
                        foreach ($exppermitlistsixty as $exppermitsixty) {
                            $data = array(
                                'permit_email_sent' => 1,
                            );
                            $this->db->set($data);
                            $this->db->where('id', $exppermitsixty['id']);
                            $this->db->update('gtg_employees');
                        }
                    }
                }

            }

        }

        if (in_array("2", $explodevariable)) {
            $clientlist = $this->employee->getclient();
            foreach ($clientlist as $client) {
                $client_email = $client['cus_email'];

                $elements = array();
                $content = '';
                if ($passport) {
                    if (!empty($exppassportlist)) {
                        $message = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Passport</th><th>Expiry Date</th><th>Remaining Date</th></tr>';
                        $employeeidarray = array();
                        foreach ($exppassportlist as $exppassport) {
                            //do something
                            $passportemail = $exppassport['email'];
                            $id = $exppassport['id'];

                            $name = $exppassport['name'];
                            $passport = $exppassport['passport'];
                            $passport_expiry = $exppassport['passport_expiry'];
                            $cus_name = $exppassport['cus_name'];
                            $currentdate = date("Y-m-d");
                            $datetime1 = date_create($currentdate);
                            $datetime2 = date_create($passport_expiry);

// Calculates the difference between DateTime objects
                            $interval = date_diff($datetime1, $datetime2);

// Display the result
                            $remainingdate = $interval->format('%R%a days');
                            $content = '';
                            $mailto = $client_email;
                            $mailtotitle = "";
                            $subject = "List of Employee Expiry Between 30 days";
                            $message .= '
		<tr><td>' . $name . '</td><td>' . $cus_name . '</td><td>' . $passport . '</td><td>' . $passport_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                        }
                        $message .= "</table>";
                        $attachmenttrue = "true";
                        $this->load->library('ultimatemailer');
                        $this->db->select('host,port,auth,auth_type,username,password,sender');
                        $this->db->from('gtg_smtp');
                        $query = $this->db->get();
                        $smtpresult = $query->row_array();
                        $host = $smtpresult['host'];
                        $port = $smtpresult['port'];
                        $auth = $smtpresult['auth'];
                        $auth_type = $smtpresult['auth_type'];
                        $username = $smtpresult['username'];
                        $password = $smtpresult['password'];
                        $mailfrom = $smtpresult['sender'];
                        $mailfromtilte = $this->config->item('ctitle');
                        $mailer = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto,
                            $mailtotitle, $subject, $message, $attachmenttrue, '');
                        if ($mailer) {
                            foreach ($exppassportlist as $exppassport) {
                                $data = array(
                                    'passport_email_sent' => 1,
                                );
                                $this->db->set($data);
                                $this->db->where('id', $exppassport['id']);
                                $this->db->update('gtg_employees');
                            }
                        }
                    }

                    if (!empty($exppassportlistsixty)) {
                        $message = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Passport</th><th>Expiry Date</th><th>Remaining Date</th></tr>';
                        //$employeeidarray=array();
                        foreach ($exppassportlistsixty as $exppassportsixty) {
                            //do something
                            $passportemail = $exppassportsixty['email'];
                            $id = $exppassportsixty['id'];
                            //$employeeidarray[] =$id;

                            $name = $exppassportsixty['name'];
                            $passport = $exppassportsixty['passport'];
                            $passport_expiry = $exppassportsixty['passport_expiry'];
                            $cus_name = $exppassportsixty['cus_name'];
                            $currentdate = date("Y-m-d");
                            $datetime1 = date_create($currentdate);
                            $datetime2 = date_create($passport_expiry);

// Calculates the difference between DateTime objects
                            $interval = date_diff($datetime1, $datetime2);

// Display the result
                            $remainingdate = $interval->format('%R%a days');
                            $content = '';
                            $mailto = $client_email;
                            $mailtotitle = "";
                            $subject = "List of Employee Expiry Between 31-60 days";
                            $message .= '
		<tr><td>' . $name . '</td><td>' . $cus_name . '</td><td>' . $passport . '</td><td>' . $passport_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                        }
                        //$imploadedis= implode(',', $employeeidarray);
                        $message .= "</table>";
                        $attachmenttrue = "true";
                        $this->load->library('ultimatemailer');
                        $this->db->select('host,port,auth,auth_type,username,password,sender');
                        $this->db->from('gtg_smtp');
                        $query = $this->db->get();
                        $smtpresult = $query->row_array();
                        $host = $smtpresult['host'];
                        $port = $smtpresult['port'];
                        $auth = $smtpresult['auth'];
                        $auth_type = $smtpresult['auth_type'];
                        $username = $smtpresult['username'];
                        $password = $smtpresult['password'];
                        $mailfrom = $smtpresult['sender'];
                        $mailfromtilte = $this->config->item('ctitle');
                        $mailer = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto,
                            $mailtotitle, $subject, $message, $attachmenttrue, '');
                        if ($mailer) {
                            foreach ($exppassportlistsixty as $exppassportsixty) {
                                $data = array(
                                    'passport_email_sent' => 1,
                                );
                                $this->db->set($data);
                                $this->db->where('id', $exppassportsixty['id']);
                                $this->db->update('gtg_employees');
                            }
                        }
                    }

                    if (!empty($exppassportlistninenty)) {
                        $message = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Passport</th><th>Expiry Date</th><th>Remaining Date</th></tr>';
                        //$employeeidarray=array();
                        foreach ($exppassportlistninenty as $exppassportninety) {
                            //do something
                            $passportemail = $exppassportninety['email'];
                            $id = $exppassportninety['id'];
                            //$employeeidarray[] =$id;

                            $name = $exppassportninety['name'];
                            $passport = $exppassportninety['passport'];
                            $passport_expiry = $exppassportninety['passport_expiry'];
                            $cus_name = $exppassportninety['cus_name'];
                            $currentdate = date("Y-m-d");
                            $datetime1 = date_create($currentdate);
                            $datetime2 = date_create($passport_expiry);

// Calculates the difference between DateTime objects
                            $interval = date_diff($datetime1, $datetime2);

// Display the result
                            $remainingdate = $interval->format('%R%a days');
                            $content = '';
                            $mailto = $client_email;
                            $mailtotitle = "";
                            $subject = "List of Employee Expiry Between 31-60 days";
                            $message .= '<tr><td>' . $name . '</td><td>' . $cus_name . '</td><td>' . $passport . '</td><td>' . $passport_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                        }
                        //$imploadedis= implode(',', $employeeidarray);
                        $message .= "</table>";
                        $attachmenttrue = "true";
                        $this->load->library('ultimatemailer');
                        $this->db->select('host,port,auth,auth_type,username,password,sender');
                        $this->db->from('gtg_smtp');
                        $query = $this->db->get();
                        $smtpresult = $query->row_array();
                        $host = $smtpresult['host'];
                        $port = $smtpresult['port'];
                        $auth = $smtpresult['auth'];
                        $auth_type = $smtpresult['auth_type'];
                        $username = $smtpresult['username'];
                        $password = $smtpresult['password'];
                        $mailfrom = $smtpresult['sender'];
                        $mailfromtilte = $this->config->item('ctitle');
                        $mailer = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto,
                            $mailtotitle, $subject, $message, $attachmenttrue, '');
                        if ($mailer) {
                            foreach ($exppassportlistninenty as $exppassportninety) {
                                $data = array(
                                    'passport_email_sent' => 1,
                                );
                                $this->db->set($data);
                                $this->db->where('id', $exppassportninety['id']);
                                $this->db->update('gtg_employees');
                            }
                        }
                    }

                }
                $content1 = '';
                if ($permit) {

                    if (!empty($exppermitlist)) {
                        $permitmessage = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Permit</th><th>Expiry Date</th><th>Remaining Date</th></tr>';

                        foreach ($exppermitlist as $exppermit) {
                            //do something
                            $permitemail = $exppermit['email'];
                            $id = $exppermit['id'];
                            $permitname = $exppermit['name'];
                            $cus_name = $exppermit['cus_name'];

                            $permit = $exppermit['permit'];
                            $permit_expiry = $exppermit['permit_expiry'];
                            $currentdate = date("Y-m-d");
                            $datetime1 = date_create($currentdate);
                            $datetime2 = date_create($permit_expiry);

// Calculates the difference between DateTime objects
                            $interval = date_diff($datetime1, $datetime2);

// Display the result
                            $remainingdate = $interval->format('%R%a days');
                            $permitmessage .= '<tr><td>' . $permitname . '</td><td>' . $cus_name . '</td><td>' . $permit . '</td><td>' . $permit_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                        }
                        $permitmessage .= "</table>";

                        $this->load->library('ultimatemailer');
                        $this->db->select('host,port,auth,auth_type,username,password,sender');
                        $this->db->from('gtg_smtp');
                        $query = $this->db->get();
                        $smtpresult = $query->row_array();
                        $host = $smtpresult['host'];
                        $port = $smtpresult['port'];
                        $auth = $smtpresult['auth'];
                        $auth_type = $smtpresult['auth_type'];
                        $username = $smtpresult['username'];
                        $password = $smtpresult['password'];
                        $mailfrom = $smtpresult['sender'];
                        $mailfromtilte = $this->config->item('ctitle');
                        $mailtotitle = "";

                        $attachmenttrue = "true";
                        $mailto1 = $client_email;
                        $subject1 = "Permit Reminder";
                        $mailer1 = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto1, $mailtotitle, $subject1, $permitmessage, $attachmenttrue, '');

                        if ($mailer1) {
                            foreach ($exppermitlist as $exppermit) {
                                $data = array(
                                    'permit_email_sent' => 1,
                                );
                                $this->db->set($data);
                                $this->db->where('id', $exppermit['id']);
                                $this->db->update('gtg_employees');
                            }
                        }
                    }

                    if (!empty($exppermitlistsixty)) {
                        $permitmessage = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Permit</th><th>Expiry Date</th><th>Remaining Date</th></tr>';

                        foreach ($exppermitlistsixty as $exppermitsixty) {
                            //do something
                            $permitemail = $exppermitsixty['email'];
                            $id = $exppermitsixty['id'];
                            $permitname = $exppermitsixty['name'];
                            $cus_name = $exppermitsixty['cus_name'];

                            $permit = $exppermitsixty['permit'];
                            $permit_expiry = $exppermit['permit_expiry'];
                            $currentdate = date("Y-m-d");
                            $datetime1 = date_create($currentdate);
                            $datetime2 = date_create($permit_expiry);

// Calculates the difference between DateTime objects
                            $interval = date_diff($datetime1, $datetime2);

// Display the result
                            $remainingdate = $interval->format('%R%a days');
                            $permitmessage .= '<tr><td>' . $permitname . '</td><td>' . $cus_name . '</td><td>' . $permit . '</td><td>' . $permit_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                        }
                        $permitmessage .= "</table>";

                        $this->load->library('ultimatemailer');
                        $this->db->select('host,port,auth,auth_type,username,password,sender');
                        $this->db->from('gtg_smtp');
                        $query = $this->db->get();
                        $smtpresult = $query->row_array();
                        $host = $smtpresult['host'];
                        $port = $smtpresult['port'];
                        $auth = $smtpresult['auth'];
                        $auth_type = $smtpresult['auth_type'];
                        $username = $smtpresult['username'];
                        $password = $smtpresult['password'];
                        $mailfrom = $smtpresult['sender'];
                        $mailfromtilte = $this->config->item('ctitle');
                        $mailtotitle = "";

                        $attachmenttrue = "true";
                        $mailto1 = $client_email;
                        $subject1 = "Permit Reminder";
                        $mailer1 = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto1, $mailtotitle, $subject1, $permitmessage, $attachmenttrue, '');

                        if ($mailer1) {
                            foreach ($exppermitlistsixty as $exppermitsixty) {
                                $data = array(
                                    'permit_email_sent' => 1,
                                );
                                $this->db->set($data);
                                $this->db->where('id', $exppermitsixty['id']);
                                $this->db->update('gtg_employees');
                            }
                        }
                    }

                    if (!empty($exppermitlistninenty)) {
                        $permitmessage = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Permit</th><th>Expiry Date</th><th>Remaining Date</th></tr>';

                        foreach ($exppermitlistsixty as $exppermitsixty) {
                            //do something
                            $permitemail = $exppermitsixty['email'];
                            $id = $exppermitsixty['id'];
                            $permitname = $exppermitsixty['name'];
                            $cus_name = $exppermitsixty['cus_name'];

                            $permit = $exppermitsixty['permit'];
                            $permit_expiry = $exppermit['permit_expiry'];
                            $currentdate = date("Y-m-d");
                            $datetime1 = date_create($currentdate);
                            $datetime2 = date_create($permit_expiry);

// Calculates the difference between DateTime objects
                            $interval = date_diff($datetime1, $datetime2);

// Display the result
                            $remainingdate = $interval->format('%R%a days');
                            $permitmessage .= '<tr><td>' . $permitname . '</td><td>' . $cus_name . '</td><td>' . $permit . '</td><td>' . $permit_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                        }
                        $permitmessage .= "</table>";

                        $this->load->library('ultimatemailer');
                        $this->db->select('host,port,auth,auth_type,username,password,sender');
                        $this->db->from('gtg_smtp');
                        $query = $this->db->get();
                        $smtpresult = $query->row_array();
                        $host = $smtpresult['host'];
                        $port = $smtpresult['port'];
                        $auth = $smtpresult['auth'];
                        $auth_type = $smtpresult['auth_type'];
                        $username = $smtpresult['username'];
                        $password = $smtpresult['password'];
                        $mailfrom = $smtpresult['sender'];
                        $mailfromtilte = $this->config->item('ctitle');
                        $mailtotitle = "";

                        $attachmenttrue = "true";
                        $mailto1 = $client_email;
                        $subject1 = "Permit Reminder";
                        $mailer1 = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto1, $mailtotitle, $subject1, $permitmessage, $attachmenttrue, '');

                        if ($mailer1) {
                            foreach ($exppermitlistsixty as $exppermitsixty) {
                                $data = array(
                                    'permit_email_sent' => 1,
                                );
                                $this->db->set($data);
                                $this->db->where('id', $exppermitsixty['id']);
                                $this->db->update('gtg_employees');
                            }
                        }
                    }

                }

            }
        }
        if (in_array("3", $explodevariable)) {
            $elements = array();
            $content = '';
            if ($passport) {
                if (!empty($exppassportlist)) {
                    foreach ($exppassportlist as $exppassport) {
                        //do something
                        $passportemail = $exppassport['email'];
                        $id = $exppassport['id'];
                        $name = $exppassport['name'];
                        $passport = $exppassport['passport'];
                        $passport_expiry = $exppassport['passport_expiry'];

                        $content = '<p>Dear Employee ' . $name . '</p>
	<p>We are reaching out you in regard to the expiry of your passport with the Passport No ' . $passport . ' on ' . $passport_expiry . '</p>
	<p>Kindly proceed for the renewal process. </p></br>
	</br>

Thank you and regards.

<p>
JSOFT SOLUTION SDN BHD,</p>
<p>16-03-C</br></p>
<p>Phone : +0374956282</p>
<p>Email : support@jsoftsolution.com.my</p>';
                        $mailto = $passportemail;
                        $mailtotitle = "";
                        $subject = "Passport Reminder";
                        $message = $content;
                        $attachmenttrue = "true";
                        $this->load->library('ultimatemailer');
                        $this->db->select('host,port,auth,auth_type,username,password,sender');
                        $this->db->from('gtg_smtp');
                        $query = $this->db->get();
                        $smtpresult = $query->row_array();
                        $host = $smtpresult['host'];
                        $port = $smtpresult['port'];
                        $auth = $smtpresult['auth'];
                        $auth_type = $smtpresult['auth_type'];
                        $username = $smtpresult['username'];
                        $password = $smtpresult['password'];
                        $mailfrom = $smtpresult['sender'];
                        $mailfromtilte = $this->config->item('ctitle');
                        $mailer = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto,
                            $mailtotitle, $subject, $message, $attachmenttrue, '');
                        if ($mailer) {
                            $data = array(
                                'passport_email_sent' => 1,
                            );
                            $this->db->set($data);
                            $this->db->where('id', $id);
                            $this->db->update('gtg_employees');
                        }

                    }
                }
            }
            $content1 = '';
            if ($permit) {
                if (!empty($exppermitlist)) {
                    foreach ($exppermitlist as $exppermit) {
                        //do something
                        $permitemail = $exppermit['email'];
                        $id = $exppermit['id'];
                        $permitname = $exppermit['name'];

                        $permit = $exppermit['permit'];
                        $permit_expiry = $exppermit['permit_expiry'];
                        $this->load->library('ultimatemailer');
                        $this->db->select('host,port,auth,auth_type,username,password,sender');
                        $this->db->from('gtg_smtp');
                        $query = $this->db->get();
                        $smtpresult = $query->row_array();
                        $host = $smtpresult['host'];
                        $port = $smtpresult['port'];
                        $auth = $smtpresult['auth'];
                        $auth_type = $smtpresult['auth_type'];
                        $username = $smtpresult['username'];
                        $password = $smtpresult['password'];
                        $mailfrom = $smtpresult['sender'];
                        $mailfromtilte = $this->config->item('ctitle');
                        $content1 = '<p>Dear Employee ' . $permitname . '</p>
	<p>We are reaching out you in regard to the expiry of your permit with the permit No ' . $permit . ' on ' . $permit_expiry . '</p>
	<p>Kindly proceed for the renewal process. </p></br>
	</br>

Thank you and regards.

<p>
JSOFT SOLUTION SDN BHD,</p>
<p>16-03-C</br></p>
<p>Phone : +0374956282</p>
<p>Email : support@jsoftsolution.com.my</p>';
                        $mailtotitle = "";

                        $attachmenttrue = "true";
                        $mailto1 = $permitemail;
                        $subject1 = "Permit Reminder";
                        $message1 = $content1;
                        $mailer1 = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto1, $mailtotitle, $subject1, $message1, $attachmenttrue, '');

                        if ($mailer1) {
                            $data = array(
                                'permit_email_sent' => 1,
                            );
                            $this->db->set($data);
                            $this->db->where('id', $id);
                            $this->db->update('gtg_employees');
                        }
                    }

                }
            }

        }

    }
    public function translist()
    {
        $eid = $this->input->post('eid');
        $list = $this->employee->get_datatables($eid);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $pid = $prd->id;
            $row[] = $prd->date;
            $row[] = $prd->account;
            $row[] = amountExchange($prd->debit, 0, $this->aauth->get_user()->loc);
            $row[] = amountExchange($prd->credit, 0, $this->aauth->get_user()->loc);

            $row[] = $prd->payer;
            $row[] = $prd->method;
            $row[] = '<a href="' . base_url() . 'transactions/view?id=' . $pid . '" class="btn btn-primary btn-xs"><span class="icon-eye"></span> View</a> <a data-object-id="' . $pid . '" class="btn btn-danger btn-xs delete-object"><span class="icon-bin"></span>Delete</a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->count_all(),
            "recordsFiltered" => $this->employee->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function disable_user()
    {
        if (!$this->aauth->get_user()->roleid == 5) {
            redirect('/dashboard/', 'refresh');
        }
        $uid = intval($this->input->post('deleteid'));

        $nuid = intval($this->aauth->get_user()->id);

        if ($nuid == $uid) {
            echo json_encode(array('status' => 'Error', 'message' =>
                'You can not disable yourself!'));
        } else {

            $this->db->select('banned');
            $this->db->from('gtg_users');
            $this->db->where('id', $uid);
            $query = $this->db->get();
            $result = $query->row_array();
            if ($result['banned'] == 0) {
                $this->aauth->ban_user($uid);
            } else {
                $this->aauth->unban_user($uid);
            }

            echo json_encode(array('status' => 'Success', 'message' =>
                'User Profile updated successfully!'));
        }
    }

    public function enable_user()
    {
        if (!$this->aauth->get_user()->roleid == 5) {
            redirect('/dashboard/', 'refresh');
        }
        $uid = intval($this->input->post('deleteid'));

        $nuid = intval($this->aauth->get_user()->id);

        if ($nuid == $uid) {
            echo json_encode(array('status' => 'Error', 'message' =>
                'You can not disable yourself!'));
        } else {

            $a = $this->aauth->unban_user($uid);

            echo json_encode(array('status' => 'Success', 'message' =>
                'User Profile disabled successfully!'));
        }
    }

    public function delete_user()
    {
        if (!$this->aauth->get_user()->roleid == 5) {
            redirect('/dashboard/', 'refresh');
        }
        $uid = intval($this->input->post('empid'));

        $nuid = intval($this->aauth->get_user()->id);

        if ($nuid == $uid) {
            echo json_encode(array('status' => 'Error', 'message' =>
                'You can not delete yourself!'));
        } else {

            // $this->db->delete('gtg_employees', array('id' => $uid));

            // $this->db->delete('gtg_users', array('id' => $uid));
            $d_data['delete_status'] = 1;
            $this->db->where('id',$uid)->update('gtg_employees',$d_data);

            echo json_encode(array('status' => 'Success', 'message' =>
                'User Profile deleted successfully! Please refresh the page!'));
        }
    }

    public function calc_income()
    {
        $eid = $this->input->post('eid');

        if ($this->employee->money_details($eid)) {
            $details = $this->employee->money_details($eid);

            echo json_encode(array('status' => 'Success', 'message' =>
                '<br> Total Income: ' . amountExchange($details['credit'], 0, $this->aauth->get_user()->loc) . '<br> Total Expenses: ' . amountExchange($details['debit'], 0, $this->aauth->get_user()->loc)));
        }
    }

    public function calc_sales()
    {
        $eid = $this->input->post('eid');

        if ($this->employee->sales_details($eid)) {
            $details = $this->employee->sales_details($eid);

            echo json_encode(array('status' => 'Success', 'message' =>
                'Total Sales (Paid Payment):  ' . amountExchange($details['total'], 0, $this->aauth->get_user()->loc)));
        }
    }

    public function update()
    {
       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }

        $id = $this->input->get('id');
        $this->load->model('employee_model', 'employee');
        if ($this->input->post()) {
            $eid = $this->input->post('eid', true);
            $name = $this->input->post('name', true);
            $phone = $this->input->post('phone', true);
            $phonealt = $this->input->post('phonealt', true);
            $address = $this->input->post('address', true);
            $city = $this->input->post('city', true);
            $region = $this->input->post('region', true);
            $country = $this->input->post('country', true);
            $postbox = $this->input->post('postbox', true);
            $location = $this->input->post('location', true);
            $salary = numberClean($this->input->post('salary', true));
            $department = $this->input->post('department', true);
            $commission = $this->input->post('commission', true);
            $roleid = $this->input->post('roleid', true);
            
            $gender = $this->input->post('gender', true);
            $socso_number = $this->input->post('socso_number', true);
            $kwsp_number = $this->input->post('kwsp_number', true);
            $pcb_number = $this->input->post('pcb_number', true);
            $join_date = $this->input->post('joined_date', true);
            $employee_job_type = $this->input->post('employee_job_type', true);
            $ic_number = $this->input->post('ic_number', true);
            $bank_name = $this->input->post('bank_name', true);
            $bank_account_number = $this->input->post('bank_account_number', true);
            $employee_type = $this->input->post('employee_type', true);
            $email = $this->input->post('email', true);
            
            
            $this->employee->update_employee($eid, $name, $phone, $phonealt, $address, $city, $region, $country, $postbox, $location, $salary, $department, $commission, $roleid, $gender, $kwsp_number, $socso_number, $pcb_number, $join_date, $employee_job_type, $ic_number, $bank_name, $bank_account_number, $employee_type,$email);
        } else {
            //$head['usernm'] = $this->aauth->get_user($id)->username;
            // $head['title'] = $head['usernm'] . ' Profile';

            $data['country'] = $this->employee->country_list();
            $data['user'] = $this->employee->employee_details($id);
            $data['dept'] = $this->employee->department_list($id, $this->aauth->get_user()->loc);
            $data['role_list'] = $this->employee->role_list();
            $data['eid'] = intval($id);
            $this->load->view('fixed/header');
            $this->load->view('employee/edit', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function displaypic()
    {

       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }

        $this->load->model('employee_model', 'employee');
        $id = $this->input->get('id');
        $this->load->library("uploadhandler", array(
            'accept_file_types' => '/\.(gif|jpe?g|png)$/i', 'upload_dir' => FCPATH . 'userfiles/employee/',
        ));
        $img = (string) $this->uploadhandler->filenaam();
        if ($img != '') {
            $this->employee->editpicture($id, $img);
        }
    }

    public function user_sign()
    {
       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }

        $this->load->model('employee_model', 'employee');
        $id = $this->input->get('id');
        $this->load->library("uploadhandler", array(
            'accept_file_types' => '/\.(gif|jpe?g|png)$/i', 'upload_dir' => FCPATH . 'userfiles/employee_sign/',
        ));
        $img = (string) $this->uploadhandler->filenaam();
        if ($img != '') {
            $this->employee->editsign($id, $img);
        }
    }

    public function user_signature_upload() {
        // Check if the form is submitted
        // echo "<pre>"; print_r($_POST); echo "</pre>";
        // exit;
        $id = $this->input->post('id');
        $redirect_url = $this->input->post('redirect_url');
        $imageData = $this->input->post('signature_image');
        $decodedImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData));
        $imageName = uniqid('image_') . '.png';
        $imagePath = FCPATH . 'userfiles/employee_sign/' . $imageName;
        file_put_contents($imagePath, $decodedImageData);

        $imagePath = FCPATH . 'userfiles/employee_sign/thumbnail/' . $imageName;
        file_put_contents($imagePath, $decodedImageData);

        // echo $imageName;
        // exit;
        $this->employee->editsign($id,$imageName);
        redirect($redirect_url);
    }

    public function updatepassword()
    {

       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }
        $this->load->library("form_validation");

        $id = $this->input->get('id');
        $this->load->model('employee_model', 'employee');

        if ($this->input->post()) {
            $eid = $this->input->post('eid');
            $this->form_validation->set_rules('newpassword', 'Password', 'required');
            $this->form_validation->set_rules('renewpassword', 'Confirm Password', 'required|matches[newpassword]');
            if ($this->form_validation->run() == false) {
                echo json_encode(array('status' => 'Error', 'message' => '<br>Rules<br> Password length should  be at least 6 [a-z-0-9] allowed!<br>New Password & Re New Password should be same!'));
            } else {

                $newpassword = $this->input->post('newpassword');
                $this->aauth->update_user($eid, false, $newpassword, false);
                echo json_encode(array('status' => 'Success', 'message' => 'Password Updated Successfully!'));
                
            }
        } else {
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = $head['usernm'] . $this->lang->line('Profile');
            $data['user'] = $this->employee->employee_details($id);
            $data['eid'] = intval($id);
            $this->load->view('fixed/header', $head);
            $this->load->view('employee/password', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function permissions()
    {

        $c_module = 'settings';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Employee Permissions';
        $data['permission'] = $this->employee->employee_permissions();
        $data['roles'] = $this->employee->getRoles();

        $this->load->view('fixed/header', $head);
        $this->load->view('employee/permissions', $data);
        $this->load->view('fixed/footer');
    }

    public function getPermission()
    {
        $value = $this->input->get('val');
        $_SESSION['moduleid'] = $value;

        $this->db->select('*');
        $this->db->from('gtg_premissions');
        $this->db->where('id', $value);
        $query = $this->db->get();
        //$values= $query->row();
        $result = $query->result_array();

        foreach ($result as $res) {
            echo json_encode($res);
        }

    }
    public function getSelectedPermission()
    {
        $role = $this->input->get('roleid');

        $checkedvalues = $this->employee->employee_permissions_modules($role);
        $elements = array();

        foreach ($checkedvalues as $check) {
            //print_r($check);
            //    echo json_encode($check);
            $elements[] = $check['id'];
        }
        echo implode(',', $elements);

    }

    public function permissions_update()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Employee Permissions';
        $permission = $this->employee->employee_permissions();
        $role = $this->input->post('role');
        $userrole = "r_" . $role;
        foreach ($permission as $row) {
            $i = $row['id'];
            $name1 = 'r_' . $i . '_1';
            // $name2 = 'r_' . $i . '_2';
            // $name3 = 'r_' . $i . '_3';
            //   $name4 = 'r_' . $i . '_4';
            // $name5 = 'r_' . $i . '_5';
            // $name6 = 'r_' . $i . '_6';
            // $name7 = 'r_' . $i . '_7';
            //  $name8 = 'r_' . $i . '_8';
            $val1 = 0;
            // $val2 = 0;
            // $val3 = 0;
            //  $val4 = 0;
            //  $val5 = 0;
            //  $val6 = 0;
            //  $val7 = 0;
            //  $val8 = 0;
            if ($this->input->post($name1)) {
                $val1 = 1;
            }

            // if ($this->input->post($name2)) $val2 = 1;
            // if ($this->input->post($name3)) $val3 = 1;
            // if ($this->input->post($name4)) $val4 = 1;
            // if ($this->input->post($name5)) $val5 = 1;
            // if ($this->input->post($name6)) $val6 = 1;
            // if ($this->input->post($name7)) $val7 = 1;
            // if ($this->input->post($name8)) $val8 = 1;
            // if ($this->aauth->get_user()->roleid == 5 && $i == 9) $val5 = 1;
            // $data = array('r_1' => $val1, 'r_2' => $val2, 'r_3' => $val3, 'r_4' => $val4, 'r_5' => $val5, 'r_6' => $val6, 'r_7' => $val7,'r_8' => $val8);
            $data = array($userrole => $val1);
            $this->db->set($data);
            $this->db->where('id', $i);
            $this->db->update('gtg_premissions');
        }

        echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('UPDATED')));
    }

    public function holidays()
    {

        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Holidays';
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/holidays');
        $this->load->view('fixed/footer');
    }

    public function hday_list()
    {
        $list = $this->employee->holidays_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $obj) {
            $datetime1 = date_create($obj->val1);
            $datetime2 = date_create($obj->val2);
            $interval = date_diff($datetime1, $datetime2);
            $day = $interval->format('%a days');
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $obj->val1;
            $row[] = $obj->val2;
            $row[] = $day;
            $row[] = $obj->val3;
            $row[] = "<a href='" . base_url("employee/editholiday?id=$obj->id") . "' class='btn btn-blue'><i class='fa fa-pencil'></i> " . $this->lang->line('Edit') . "</a> " . '<a href="#" data-object-id="' . $obj->id . '" class="btn btn-danger delete-object"><span class="fa fa-trash"></span></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->holidays_count_all(),
            "recordsFiltered" => $this->employee->holidays_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function delete_hday()
    {
        $id = $this->input->post('deleteid');

        if ($this->employee->deleteholidays($id)) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }

    public function addhday()
    {

        if ($this->input->post()) {

            $from = datefordatabase($this->input->post('from'));
            $todate = datefordatabase($this->input->post('todate'));
            $note = $this->input->post('note', true);

            $date1 = new DateTime($from);
            $date2 = new DateTime($todate);
            if ($date1 <= $date2) {

                if ($this->employee->addholidays($this->aauth->get_user()->loc, $from, $todate, $note)) {
                    echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . "   <a href='addhday' class='btn btn-indigo btn-lg'><span class='icon-plus-circle' aria-hidden='true'></span>  </a> <a href='holidays' class='btn btn-grey btn-lg'><span class='icon-eye' aria-hidden='true'></span>  </a>"));
                }
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR') . '- Invalid'));
            }
        } else {
            $data['id'] = $this->input->get('id');
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Add Holiday';
            $this->load->view('fixed/header', $head);
            $this->load->view('employee/addholyday', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function editholiday()
    {

        if ($this->input->post()) {

            $id = $this->input->post('did');
            $from = datefordatabase($this->input->post('from'));
            $todate = datefordatabase($this->input->post('todate'));
            $note = $this->input->post('note', true);

            if ($this->employee->edithday($id, $this->aauth->get_user()->loc, $from, $todate, $note)) {
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . "  <a href='addhday' class='btn btn-indigo btn-lg'><span class='icon-plus-circle' aria-hidden='true'></span>  </a> <a href='holidays' class='btn btn-grey btn-lg'><span class='icon-eye' aria-hidden='true'></span>  </a>"));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $data['id'] = $this->input->get('id');
            $data['hday'] = $this->employee->hday_view($data['id'], $this->aauth->get_user()->loc);
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Edit Holiday';
            $this->load->view('fixed/header', $head);
            $this->load->view('employee/edithday', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function departments()
    {

        $head['usernm'] = $this->aauth->get_user()->username;
        $data['department_list'] = $this->employee->department_list($this->aauth->get_user()->loc);
        $head['title'] = 'Departments';
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/departments', $data);
        $this->load->view('fixed/footer');
    }

    public function roles()
    {

        $head['usernm'] = $this->aauth->get_user()->username;
        $data['role_list'] = $this->employee->role_list();
        $head['title'] = 'Roles';
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/roles', $data);
        $this->load->view('fixed/footer');
    }

    public function role()
    {

        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Role';
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/role');
        $this->load->view('fixed/footer');
    }

    public function roleedit()
    {
        $role_id = $this->input->get('id');
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['role_list'] = $this->employee->getRole($role_id);

        $head['title'] = 'Roles';
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/roleedit', $data);
        $this->load->view('fixed/footer');

    }
    public function updaterole()
    {
        $role_name = $this->input->post('role_name');
        $role_id = $this->input->post('role_id');
        $role_status = $this->input->post('role_status');
        $all_data_previleges = $this->input->post('all_data_previleges');
     
        $update = $this->employee->role_update($role_name, $role_id, $role_status, $all_data_previleges);

        if (!$update) {
            $data['status'] = 'danger';
            $data['message'] = $this->lang->line('ERROR');
        } else {
            $data['status'] = 'success';
            $data['message'] = $this->lang->line('UPDATED');
        }
        $_SESSION['status'] = $data['status'];
        $_SESSION['message'] = $data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');
        redirect('employee/roles', 'refresh');
        exit();

    }

    public function createrole()
    {
        $role_name = $this->input->post('role_name');
        $all_data_previleges = $this->input->post('all_data_previleges');
        
        //  $this->db->select('*');
        //  $this->db->from('gtg_role');
        //  $this->db->where('delete_status',0);
        //  $query = $this->db->get();
        //  $count=$query->num_rows();
        // if($count>=8)
        // {
        //      $data['status'] = 'danger';
        //      $data['message'] = $this->lang->line('Please Refer to Administrator For Add More Role');

        //       $_SESSION['status']=$data['status'];
        //     $_SESSION['message']=$data['message'];
        //     $this->session->mark_as_flash('status');
        //     $this->session->mark_as_flash('message');
        //     redirect('employee/role', 'refresh');

        // }

        $this->db->select('*');
        $this->db->from('gtg_role');
        $this->db->where('role_name', $role_name);
        $query = $this->db->get();
        $count = $query->num_rows();
        if ($count >= 1) {
            $data['status'] = 'danger';
            $data['message'] = $this->lang->line('Role Is Existed! Please Enter New Role Name');
            $_SESSION['status'] = $data['status'];
            $_SESSION['message'] = $data['message'];
            $this->session->mark_as_flash('status');
            $this->session->mark_as_flash('message');
            redirect('employee/role', 'refresh');

        }

        $insert = $this->employee->role_create($role_name,$all_data_previleges);

        if (!$insert) {
            $data['status'] = 'danger';
            $data['message'] = $this->lang->line('ERROR');
        } else {
            $data['status'] = 'success';
            $data['message'] = $this->lang->line('ADDED');
        }
        $_SESSION['status'] = $data['status'];
        $_SESSION['message'] = $data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');
        redirect('employee/roles', 'refresh');
        exit();

    }

    public function department()
    {

        $data['id'] = $this->input->get('id');
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['department'] = $this->employee->department_view($data['id'], $this->aauth->get_user()->loc);
        $data['department_list'] = $this->employee->department_elist($data['id']);
        $head['title'] = 'Departments';
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/department', $data);
        $this->load->view('fixed/footer');
    }

    public function delete_dep()
    {

        $id = $this->input->post('deleteid');

        if ($this->employee->deletedepartment($id)) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }

    public function delete_role()
    {
        $id = $this->input->post('deleteid');

        if ($this->employee->deleterole($id)) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }

    public function adddep()
    {

        if ($this->input->post()) {

            $name = $this->input->post('name', true);

            if ($this->employee->adddepartment($this->aauth->get_user()->loc, $name)) {
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . "  <a href='adddep' class='btn btn-indigo btn-lg'><span class='icon-plus-circle' aria-hidden='true'></span>  </a> <a href='departments' class='btn btn-grey btn-lg'><span class='icon-eye' aria-hidden='true'></span>  </a>"));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {

            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Add Department';
            $this->load->view('fixed/header', $head);
            $this->load->view('employee/adddep');
            $this->load->view('fixed/footer');
        }
    }

    public function editdep()
    {

        if ($this->input->post()) {

            $name = $this->input->post('name', true);
            $id = $this->input->post('did');

            if ($this->employee->editdepartment($id, $this->aauth->get_user()->loc, $name)) {
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . "  <a href='adddep' class='btn btn-indigo btn-lg'><span class='icon-plus-circle' aria-hidden='true'></span>  </a> <a href='departments' class='btn btn-grey btn-lg'><span class='icon-eye' aria-hidden='true'></span>  </a>"));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $data['id'] = $this->input->get('id');
            $data['department'] = $this->employee->department_view($data['id'], $this->aauth->get_user()->loc);
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Edit Department';
            $this->load->view('fixed/header', $head);
            $this->load->view('employee/editdep', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function payroll_create()
    {
        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Add Transaction";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/payroll_create', $data);
        $this->load->view('fixed/footer');
    }

    public function emp_search()
    {

        $name = $this->input->get('keyword', true);

        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = ' (gtg_users.loc=' . $this->aauth->get_user()->loc . ') AND ';
        }
        if ($name) {
            $query = $this->db->query("SELECT gtg_employees.* ,gtg_users.email FROM gtg_employees  LEFT JOIN gtg_users ON gtg_users.id=gtg_employees.id  WHERE $whr (UPPER(gtg_employees.name)  LIKE '%" . strtoupper($name) . "%' OR UPPER(gtg_employees.phone)  LIKE '" . strtoupper($name) . "%') LIMIT 6");
            $result = $query->result_array();
            echo '<ol>';
            $i = 1;
            foreach ($result as $row) {

                echo "<li onClick=\"selectPay('" . $row['id'] . "','" . $row['name'] . " ','" . amountFormat_general($row['salary']) . "')\"><span>$i</span><p>" . $row['name'] . " &nbsp; &nbsp  " . $row['phone'] . "</p></li>";
                $i++;
            }
            echo '</ol>';
        }
    }

    public function payroll()
    {

        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Employee Payroll Transactions';

        $this->load->view('fixed/header', $head);
        $this->load->view('employee/payroll');
        $this->load->view('fixed/footer');
    }

    public function payroll_emp()
    {

        $id = $this->input->get('id');
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Employee Payroll Transactions';
        $data['employee'] = $this->employee->employee_details($id);
        $data['eid'] = intval($id);
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/payroll_employee', $data);
        $this->load->view('fixed/footer');
    }
    public function fwmsemplyeeedit()
    {
        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Fwmsemployees";
        $head['usernm'] = $this->aauth->get_user()->username;
        $id = $this->input->get('id');
        $data['clients'] = $this->employee->get_client_list();
        $data['employee'] = $this->employee->employee_foreign_details($id);
        //print_r($data['employee']);
        $data['role_list'] = $this->employee->role_list();
        $data['country'] = $this->employee->country_list();
        //$this->load->model('employee_model', 'employee');
        // $data['payslip']=$this->payroll->getPayslipList();

        $orgId = $_SESSION['loggedin'];
        // $this->load->model('payroll_model', 'payroll');
        $data['organization'] = $this->employee->getOrganizationDetails($orgId);
        $data['client_list'] = $this->employee->client_list();

        $this->load->view('fixed/header', $head);
        $this->load->view('employee/fwmsemployeeedit', $data);
        $this->load->view('fixed/footer');

    }

    public function getcompanyEmployee()
    {
        $companyid = $this->input->post('companyid');
        $list = $this->employee->getcompnayEmployees($companyid);
        ///print_r($list);
        //$listarray='';
        $listarray[] = '<option value="">All</option>';
        foreach ($list as $listvalue) {
            $listarray[] = '<option value="' . $listvalue['id'] . '">' . $listvalue['name'] . '</option>';
        }

        echo json_encode($listarray);

    }
    public function fwmsReportGenerateAjax()
    {

        $company = $this->input->post('company');
        $employee = $this->input->post('employee');

        $ttype = $this->input->get('type');
        $list = $this->employee->employee_report_datatables();

        $data = array();
        // $no = $_POST['start'];
        $temp = '';
        $type = '';
        $no = $this->input->post('start');
        foreach ($list as $obj) {
            if (file_exists(FCPATH . "userfiles/passport/" . $obj->passport_document)) {
                $ps = '<a href="../userfiles/passport/' . $obj->passport_document . '" target=_blank>' . $obj->passport . '</a>';

            } else {

                $ps = $obj->passport;
            }
            if (file_exists(FCPATH . "userfiles/passport/" . $obj->visa_document)) {
                $vs = '<a href="../userfiles/passport/' . $obj->visa_document . '" target=_blank>' . $obj->permit . '</a>';

            } else {
                $vs = $obj->permit;
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $obj->name;
            $row[] = $obj->client;
            $row[] = $obj->country_name;
            if (!empty($obj->passport_document)) {
                $row[] = $ps;
            } else {
                $row[] = $obj->passport;

            }
            $passport_expiry = date_create_from_format("Y-m-d", $obj->passport_expiry)->format("d-m-Y");
            $row[] = $passport_expiry;
            if (!empty($obj->visa_document)) {
                $row[] = $vs;
            } else {
                $row[] = $obj->permit;

            }
            $permit_expiry = date_create_from_format("Y-m-d", $obj->permit_expiry)->format("d-m-Y");
            $row[] = $permit_expiry;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->employee_report_count_all(),
            "recordsFiltered" => $this->employee->employee_report_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }

    public function getRoles()
    {

        $ttype = $this->input->get('type');
        $list = $this->employee->employee_report_datatables();

        $data = array();
        // $no = $_POST['start'];
        $temp = '';
        $type = '';
        $no = $this->input->post('start');
        foreach ($list as $obj) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $obj->name;
            $row[] = $obj->client;
            $row[] = $obj->country_name;
            $row[] = $obj->passport;
            $row[] = $obj->passport_expiry;
            $row[] = $obj->permit;
            $row[] = $obj->permit_expiry;

            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->employee_report_count_all(),
            "recordsFiltered" => $this->employee->employee_report_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }

    public function fwmsreportGenerate()
    {

        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Fws Report";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['clients'] = $this->employee->get_client_list();
        $data['company'] = $this->input->post('company');
        $data['employee'] = $this->input->post('employee');
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/fwmsReportdata', $data);
        $this->load->view('fixed/footer');

    }

    public function editEmployeeFwms()
    {
        $id = $this->input->get('id');
        // $this->employee->getemployee

    }

    public function deleteFwmsEmployee()
    {
        $id = $this->input->post('deleteid');

        //$this->db->delete('gtg_employees', array('id' => $id));

        $data = array(
            'delete_status' => 1);

        $this->db->set($data);
        $this->db->where('id', $id);

        $this->db->update('gtg_employees');
        // $this->db->delete('gtg_users', array('id' => $uid));

        echo json_encode(array('status' => 'Success', 'message' =>
            'Employee deleted successfully'));

    }

    public function getfwmsEmployeesforView()
    {
        $id = $this->input->post('id');

    }
    public function passportExpiredThirty()
    {

        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Active Passport Employee";
        $head['usernm'] = $this->aauth->get_user()->username;
        //$this->load->model('employee_model', 'employee');
        // $data['payslip']=$this->payroll->getPayslipList();
        $data['status'] = "active";
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/passportExpiredThirtyDays', $data);
        $this->load->view('fixed/footer');
    }
    public function passportExpiredSixty()
    {

        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Active Passport Employee";
        $head['usernm'] = $this->aauth->get_user()->username;
        //$this->load->model('employee_model', 'employee');
        // $data['payslip']=$this->payroll->getPayslipList();
        $data['status'] = "active";
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/passportExpiredSixtyDays', $data);
        $this->load->view('fixed/footer');
    }
    public function passportExpiredNinety()
    {

        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Active Passport Employee";
        $head['usernm'] = $this->aauth->get_user()->username;
        //$this->load->model('employee_model', 'employee');
        // $data['payslip']=$this->payroll->getPayslipList();
        $data['status'] = "active";
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/passportExpiredNinetyDays', $data);
        $this->load->view('fixed/footer');
    }
    public function active_passport()
    {

        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Active Passport Employee";
        $head['usernm'] = $this->aauth->get_user()->username;
        //$this->load->model('employee_model', 'employee');
        // $data['payslip']=$this->payroll->getPayslipList();
        $data['status'] = "active";

        $this->load->view('fixed/header', $head);
        $this->load->view('employee/activepassport', $data);
        $this->load->view('fixed/footer');
    }
    public function expiredPassport()
    {

        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Expired Passport Employee";
        $head['usernm'] = $this->aauth->get_user()->username;
        //$this->load->model('employee_model', 'employee');
        // $data['payslip']=$this->payroll->getPayslipList();
        $data['passport_expiry'] = "expiry";
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/expiredpassport', $data);
        $this->load->view('fixed/footer');
    }
    public function expiredPermit()
    {

        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Expired Permit Employee";
        $head['usernm'] = $this->aauth->get_user()->username;
        //$this->load->model('employee_model', 'employee');
        // $data['payslip']=$this->payroll->getPayslipList();
        $data['permit_expiry'] = "expiry";
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/expiredpermit', $data);
        $this->load->view('fixed/footer');
    }
    public function permitExpiredThirty()
    {

        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Expired Permit Employee";
        $head['usernm'] = $this->aauth->get_user()->username;
        //$this->load->model('employee_model', 'employee');
        // $data['payslip']=$this->payroll->getPayslipList();
        $data['permit_expiry'] = "expiry";
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/permitExpiredThirtyDays', $data);
        $this->load->view('fixed/footer');
    }
    public function permitExpiredSixty()
    {

        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Expired Permit Employee";
        $head['usernm'] = $this->aauth->get_user()->username;
        //$this->load->model('employee_model', 'employee');
        // $data['payslip']=$this->payroll->getPayslipList();
        $data['permit_expiry'] = "expiry";
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/permitExpiredSixtyDays', $data);
        $this->load->view('fixed/footer');
    }
    public function permitExpiredNinety()
    {

        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Expired Permit Employee";
        $head['usernm'] = $this->aauth->get_user()->username;
        //$this->load->model('employee_model', 'employee');
        // $data['payslip']=$this->payroll->getPayslipList();
        $data['permit_expiry'] = "expiry";
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/permitExpiredNinetyDays', $data);
        $this->load->view('fixed/footer');
    }

    public function activepermit()
    {

        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Active Permit Employee";
        $head['usernm'] = $this->aauth->get_user()->username;
        //$this->load->model('employee_model', 'employee');
        // $data['payslip']=$this->payroll->getPayslipList();
        $data['permit_status'] = "active";
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/activepermit', $data);
        $this->load->view('fixed/footer');

    }
    public function getfwmsEmployeesPassportActive()
    {

        $ttype = $this->input->get('type');
        $list = $this->employee->employee_datatables();
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        //$active = $this->input->post('active');
        $active = $this->input->post('active');
        $permitactive = $this->input->post('permit_active');
        $passport_expiry = $this->input->post('passport_expiry');
        $permit_expiry = $this->input->post('permit_expiry');
        $temp = '';
        $type = '';
        $current_date = date('Y-m-d');
        foreach ($list as $prd) {
            $no++;
            if (file_exists(FCPATH . "userfiles/passport/" . $prd->passport_document)) {
                $ps = '<a href="../userfiles/passport/' . $prd->passport_document . '" target=_blank>' . $prd->passport . '</a>';

            } else {

                $ps = $prd->passport;
            }

            $row = array();
            /*$status='';
            if($active =="active" || $permitactive=="active")
            {
            $status="Active";
            }
            else if($passport_expiry=="expiry" ||  $permit_expiry=="expiry")
            {
            $status="Expired";

            }*/

            $status1 = '';
            if ($prd->passport_expiry < $current_date) {
                $status = "Expired";
            } else {
                $status = "Active";
            }

            $pid = $prd->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $prd->name;
            $row[] = $prd->cname;
            if (!empty($prd->passport_document)) {
                $row[] = $ps;
            } else {
                $row[] = $prd->passport;

            }

            $passport_expiry_newDate = date("d-m-Y", strtotime($prd->passport_expiry));
            $row[] = '<b style="color:red">' . $passport_expiry_newDate . '</b>';

            $row[] = $status;

            /*if(!empty($status))
            {
            $row[]=$status;
            }
            else{
            $row[]=$status1;

            }*/

            $row[] = '<a href="' . base_url() . 'employee/fwmsemplyeeedit?id=' . $pid . '" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
			<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            //$row[] =$temp;
            /*
            $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
             */
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->employee_count_all(),
            "recordsFiltered" => $this->employee->employee_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function getfwmsEmployeesPassportExpired()
    {

        $ttype = $this->input->get('type');
        $list = $this->employee->employee_datatables();
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        //$active = $this->input->post('active');
        $active = $this->input->post('active');
        $permitactive = $this->input->post('permit_active');
        $passport_expiry = $this->input->post('passport_expiry');
        $permit_expiry = $this->input->post('permit_expiry');
        $temp = '';
        $type = '';
        $current_date = date('Y-m-d');
        foreach ($list as $prd) {
            $no++;
            if (file_exists(FCPATH . "userfiles/passport/" . $prd->passport_document)) {
                $ps = '<a href="../userfiles/passport/' . $prd->passport_document . '" target=_blank>' . $prd->passport . '</a>';

            } else {

                $ps = $prd->passport;
            }

            $row = array();
            /*$status='';
            if($active =="active" || $permitactive=="active")
            {
            $status="Active";
            }
            else if($passport_expiry=="expiry" ||  $permit_expiry=="expiry")
            {
            $status="Expired";

            }*/

            $status1 = '';
            if ($prd->passport_expiry < $current_date) {
                $status = "Expired";
            } else {
                $status = "Active";
            }

            $pid = $prd->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $prd->name;
            $row[] = $prd->cname;
            if (!empty($prd->passport_document)) {
                $row[] = $ps;
            } else {
                $row[] = $prd->passport;

            }
            $passport_expiry_newDate = date("d-m-Y", strtotime($prd->passport_expiry));
            $row[] = '<b style="color:red">' . $passport_expiry_newDate . '</b>';

            $row[] = $status;

            /*if(!empty($status))
            {
            $row[]=$status;
            }
            else{
            $row[]=$status1;

            }*/

            $row[] = '<a href="' . base_url() . 'employee/fwmsemplyeeedit?id=' . $pid . '" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
			<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            //$row[] =$temp;
            /*
            $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
             */
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->employee_count_all(),
            "recordsFiltered" => $this->employee->employee_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function PassportExpiredInThirtyDays()
    {

        $ttype = $this->input->get('type');
        $list = $this->employee->employee_datatables();
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        //$active = $this->input->post('active');
        $active = $this->input->post('active');

        $permitactive = $this->input->post('permit_active');
        $passport_expiry = $this->input->post('passport_expiry');
        $permit_expiry = $this->input->post('permit_expiry');
        $temp = '';
        $type = '';
        $current_date = date('Y-m-d');
        foreach ($list as $prd) {
            $no++;
            if (file_exists(FCPATH . "userfiles/passport/" . $prd->passport_document)) {
                $ps = '<a href="../userfiles/passport/' . $prd->passport_document . '" target=_blank>' . $prd->passport . '</a>';

            } else {

                $ps = $prd->passport;
            }

            $row = array();
            /*$status='';
            if($active =="active" || $permitactive=="active")
            {
            $status="Active";
            }
            else if($passport_expiry=="expiry" ||  $permit_expiry=="expiry")
            {
            $status="Expired";

            }*/

            $status1 = '';
            if ($prd->passport_expiry < $current_date) {
                $status = "Expired";
            } else {
                $status = "Active";
            }

            $pid = $prd->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $prd->name;
            $row[] = $prd->cname;
            if (!empty($prd->passport_document)) {
                $row[] = $ps;
            } else {
                $row[] = $prd->passport;

            }
            $passport_expiry_newDate = date("d-m-Y", strtotime($prd->passport_expiry));
            $row[] = '<b style="color:red">' . $passport_expiry_newDate . '</b>';

            $row[] = $status;

            /*if(!empty($status))
            {
            $row[]=$status;
            }
            else{
            $row[]=$status1;

            }*/

            $row[] = '<a href="' . base_url() . 'employee/fwmsemplyeeedit?id=' . $pid . '" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
			<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            //$row[] =$temp;
            /*
            $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
             */
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->employee_count_all(),
            "recordsFiltered" => $this->employee->employee_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function PassportExpiredInSixtyDays()
    {

        $ttype = $this->input->get('type');
        $list = $this->employee->employee_datatables();
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        //$active = $this->input->post('active');
        $active = $this->input->post('active');

        $permitactive = $this->input->post('permit_active');
        $passport_expiry = $this->input->post('passport_expiry');
        $permit_expiry = $this->input->post('permit_expiry');
        $temp = '';
        $type = '';
        $current_date = date('Y-m-d');
        foreach ($list as $prd) {
            $no++;
            if (file_exists(FCPATH . "userfiles/passport/" . $prd->passport_document)) {
                $ps = '<a href="../userfiles/passport/' . $prd->passport_document . '" target=_blank>' . $prd->passport . '</a>';

            } else {

                $ps = $prd->passport;
            }

            $row = array();
            /*$status='';
            if($active =="active" || $permitactive=="active")
            {
            $status="Active";
            }
            else if($passport_expiry=="expiry" ||  $permit_expiry=="expiry")
            {
            $status="Expired";

            }*/

            $status1 = '';
            if ($prd->passport_expiry < $current_date) {
                $status = "Expired";
            } else {
                $status = "Active";
            }

            $pid = $prd->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $prd->name;
            $row[] = $prd->cname;
            if (!empty($prd->passport_document)) {
                $row[] = $ps;
            } else {
                $row[] = $prd->passport;

            }
            $passport_expiry_newDate = date("d-m-Y", strtotime($prd->passport_expiry));
            $row[] = '<b style="color:red">' . $passport_expiry_newDate . '</b>';

            $row[] = $status;

            /*if(!empty($status))
            {
            $row[]=$status;
            }
            else{
            $row[]=$status1;

            }*/

            $row[] = '<a href="' . base_url() . 'employee/fwmsemplyeeedit?id=' . $pid . '" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
			<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            //$row[] =$temp;
            /*
            $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
             */
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->employee_count_all(),
            "recordsFiltered" => $this->employee->employee_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function PassportExpiredInNinetyDays()
    {

        $ttype = $this->input->get('type');
        $list = $this->employee->employee_datatables();
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        //$active = $this->input->post('active');
        $active = $this->input->post('active');

        $permitactive = $this->input->post('permit_active');
        $passport_expiry = $this->input->post('passport_expiry');
        $permit_expiry = $this->input->post('permit_expiry');
        $temp = '';
        $type = '';
        $current_date = date('Y-m-d');
        foreach ($list as $prd) {
            $no++;
            if (file_exists(FCPATH . "userfiles/passport/" . $prd->passport_document)) {
                $ps = '<a href="../userfiles/passport/' . $prd->passport_document . '" target=_blank>' . $prd->passport . '</a>';

            } else {

                $ps = $prd->passport;
            }

            $row = array();
            /*$status='';
            if($active =="active" || $permitactive=="active")
            {
            $status="Active";
            }
            else if($passport_expiry=="expiry" ||  $permit_expiry=="expiry")
            {
            $status="Expired";

            }*/

            $status1 = '';
            if ($prd->passport_expiry < $current_date) {
                $status = "Expired";
            } else {
                $status = "Active";
            }

            $pid = $prd->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $prd->name;
            $row[] = $prd->cname;
            if (!empty($prd->passport_document)) {
                $row[] = $ps;
            } else {
                $row[] = $prd->passport;

            }
            $passport_expiry_newDate = date("d-m-Y", strtotime($prd->passport_expiry));
            $row[] = '<b style="color:red">' . $passport_expiry_newDate . '</b>';

            $row[] = $status;

            /*if(!empty($status))
            {
            $row[]=$status;
            }
            else{
            $row[]=$status1;

            }*/

            $row[] = '<a href="' . base_url() . 'employee/fwmsemplyeeedit?id=' . $pid . '" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
			<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            //$row[] =$temp;
            /*
            $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
             */
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->employee_count_all(),
            "recordsFiltered" => $this->employee->employee_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function getfwmsEmployeesPermitActive()
    {

        $ttype = $this->input->get('type');
        $list = $this->employee->employee_datatables();
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        //$active = $this->input->post('active');
        $active = $this->input->post('active');
        $permitactive = $this->input->post('permit_active');
        $passport_expiry = $this->input->post('passport_expiry');
        $permit_expiry = $this->input->post('permit_expiry');
        $temp = '';
        $type = '';
        $current_date = date('Y-m-d');
        foreach ($list as $prd) {
            $no++;
            if (file_exists(FCPATH . "userfiles/passport/" . $prd->visa_document)) {
                $vs = '<a href="../userfiles/passport/' . $prd->visa_document . '" target=_blank>' . $prd->permit . '</a>';

            } else {
                $vs = $prd->permit;
            }

            $row = array();
            /*$status='';
            if($active =="active" || $permitactive=="active")
            {
            $status="Active";
            }
            else if($passport_expiry=="expiry" ||  $permit_expiry=="expiry")
            {
            $status="Expired";

            }*/

            $status1 = '';
            if ($prd->permit_expiry < $current_date) {
                $status = "Expired";
            } else {
                $status = "Active";
            }

            $pid = $prd->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $prd->name;
            $row[] = $prd->cname;
            if (!empty($prd->visa_document)) {
                $row[] = $vs;
            } else {
                $row[] = $prd->permit;

            }
            $permit_expiry_newDate = date("d-m-Y", strtotime($prd->permit_expiry));
            $row[] = '<b style="color:red">' . $permit_expiry_newDate . '</b>';

            $row[] = $status;

            /*if(!empty($status))
            {
            $row[]=$status;
            }
            else{
            $row[]=$status1;

            }*/

            $row[] = '<a href="' . base_url() . 'employee/fwmsemplyeeedit?id=' . $pid . '" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
			<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            //$row[] =$temp;
            /*
            $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
             */
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->employee_count_all(),
            "recordsFiltered" => $this->employee->employee_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function getfwmsEmployeesPermitExpired()
    {

        $ttype = $this->input->get('type');
        $list = $this->employee->employee_datatables();
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        //$active = $this->input->post('active');
        $active = $this->input->post('active');
        $permitactive = $this->input->post('permit_active');
        $passport_expiry = $this->input->post('passport_expiry');
        $permit_expiry = $this->input->post('permit_expiry');
        $temp = '';
        $type = '';
        $current_date = date('Y-m-d');
        foreach ($list as $prd) {
            $no++;
            if (file_exists(FCPATH . "userfiles/passport/" . $prd->visa_document)) {
                $vs = '<a href="../userfiles/passport/' . $prd->visa_document . '" target=_blank>' . $prd->permit . '</a>';

            } else {
                $vs = $prd->permit;
            }

            $row = array();
            /*$status='';
            if($active =="active" || $permitactive=="active")
            {
            $status="Active";
            }
            else if($passport_expiry=="expiry" ||  $permit_expiry=="expiry")
            {
            $status="Expired";

            }*/

            $status1 = '';
            if ($prd->permit_expiry < $current_date) {
                $status = "Expired";
            } else {
                $status = "Active";
            }

            $pid = $prd->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $prd->name;
            $row[] = $prd->cname;
            if (!empty($prd->visa_document)) {
                $row[] = $vs;
            } else {
                $row[] = $prd->permit;

            }
            $permit_expiry_newDate = date("d-m-Y", strtotime($prd->permit_expiry));
            $row[] = '<b style="color:red">' . $permit_expiry_newDate . '</b>';

            $row[] = $status;

            /*if(!empty($status))
            {
            $row[]=$status;
            }
            else{
            $row[]=$status1;

            }*/

            $row[] = '<a href="' . base_url() . 'employee/fwmsemplyeeedit?id=' . $pid . '" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
			<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            //$row[] =$temp;
            /*
            $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
             */
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->employee_count_all(),
            "recordsFiltered" => $this->employee->employee_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function PermitExpiredInThirtyDays()
    {

        $ttype = $this->input->get('type');
        $list = $this->employee->employee_datatables();
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        //$active = $this->input->post('active');
        $active = $this->input->post('active');
        $permitactive = $this->input->post('permit_active');
        $passport_expiry = $this->input->post('passport_expiry');
        $permit_expiry = $this->input->post('permit_expiry');
        $temp = '';
        $type = '';
        $current_date = date('Y-m-d');
        foreach ($list as $prd) {
            $no++;
            if (file_exists(FCPATH . "userfiles/passport/" . $prd->visa_document)) {
                $vs = '<a href="../userfiles/passport/' . $prd->visa_document . '" target=_blank>' . $prd->permit . '</a>';

            } else {
                $vs = $prd->permit;
            }

            $row = array();
            /*$status='';
            if($active =="active" || $permitactive=="active")
            {
            $status="Active";
            }
            else if($passport_expiry=="expiry" ||  $permit_expiry=="expiry")
            {
            $status="Expired";

            }*/

            $status1 = '';
            if ($prd->permit_expiry < $current_date) {
                $status = "Expired";
            } else {
                $status = "Active";
            }

            $pid = $prd->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $prd->name;
            $row[] = $prd->cname;
            if (!empty($prd->visa_document)) {
                $row[] = $vs;
            } else {
                $row[] = $prd->permit;

            }
            $permit_expiry_newDate = date("d-m-Y", strtotime($prd->permit_expiry));
            $row[] = '<b style="color:red">' . $permit_expiry_newDate . '</b>';

            $row[] = $status;

            /*if(!empty($status))
            {
            $row[]=$status;
            }
            else{
            $row[]=$status1;

            }*/

            $row[] = '<a href="' . base_url() . 'employee/fwmsemplyeeedit?id=' . $pid . '" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
			<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            //$row[] =$temp;
            /*
            $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
             */
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->employee_count_all(),
            "recordsFiltered" => $this->employee->employee_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function PermitExpiredInSixtyDays()
    {

        $ttype = $this->input->get('type');
        $list = $this->employee->employee_datatables();
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        //$active = $this->input->post('active');
        $active = $this->input->post('active');
        $permitactive = $this->input->post('permit_active');
        $passport_expiry = $this->input->post('passport_expiry');
        $permit_expiry = $this->input->post('permit_expiry');
        $temp = '';
        $type = '';
        $current_date = date('Y-m-d');
        foreach ($list as $prd) {
            $no++;
            if (file_exists(FCPATH . "userfiles/passport/" . $prd->visa_document)) {
                $vs = '<a href="../userfiles/passport/' . $prd->visa_document . '" target=_blank>' . $prd->permit . '</a>';

            } else {
                $vs = $prd->permit;
            }

            $row = array();
            /*$status='';
            if($active =="active" || $permitactive=="active")
            {
            $status="Active";
            }
            else if($passport_expiry=="expiry" ||  $permit_expiry=="expiry")
            {
            $status="Expired";

            }*/

            $status1 = '';
            if ($prd->permit_expiry < $current_date) {
                $status = "Expired";
            } else {
                $status = "Active";
            }

            $pid = $prd->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $prd->name;
            $row[] = $prd->cname;
            if (!empty($prd->visa_document)) {
                $row[] = $vs;
            } else {
                $row[] = $prd->permit;

            }
            $permit_expiry_newDate = date("d-m-Y", strtotime($prd->permit_expiry));
            $row[] = '<b style="color:red">' . $permit_expiry_newDate . '</b>';

            $row[] = $status;

            /*if(!empty($status))
            {
            $row[]=$status;
            }
            else{
            $row[]=$status1;

            }*/

            $row[] = '<a href="' . base_url() . 'employee/fwmsemplyeeedit?id=' . $pid . '" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
			<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            //$row[] =$temp;
            /*
            $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
             */
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->employee_count_all(),
            "recordsFiltered" => $this->employee->employee_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function PermitExpiredInNinetyDays()
    {

        $ttype = $this->input->get('type');
        $list = $this->employee->employee_datatables();
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        //$active = $this->input->post('active');
        $active = $this->input->post('active');
        $permitactive = $this->input->post('permit_active');
        $passport_expiry = $this->input->post('passport_expiry');
        $permit_expiry = $this->input->post('permit_expiry');
        $temp = '';
        $type = '';
        $current_date = date('Y-m-d');
        foreach ($list as $prd) {
            $no++;
            if (file_exists(FCPATH . "userfiles/passport/" . $prd->visa_document)) {
                $vs = '<a href="../userfiles/passport/' . $prd->visa_document . '" target=_blank>' . $prd->permit . '</a>';

            } else {
                $vs = $prd->permit;
            }

            $row = array();
            /*$status='';
            if($active =="active" || $permitactive=="active")
            {
            $status="Active";
            }
            else if($passport_expiry=="expiry" ||  $permit_expiry=="expiry")
            {
            $status="Expired";

            }*/

            $status1 = '';
            if ($prd->permit_expiry < $current_date) {
                $status = "Expired";
            } else {
                $status = "Active";
            }

            $pid = $prd->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $prd->name;
            $row[] = $prd->cname;
            if (!empty($prd->visa_document)) {
                $row[] = $vs;
            } else {
                $row[] = $prd->permit;

            }
            $permit_expiry_newDate = date("d-m-Y", strtotime($prd->permit_expiry));
            $row[] = '<b style="color:red">' . $permit_expiry_newDate . '</b>';

            $row[] = $status;

            /*if(!empty($status))
            {
            $row[]=$status;
            }
            else{
            $row[]=$status1;

            }*/

            $row[] = '<a href="' . base_url() . 'employee/fwmsemplyeeedit?id=' . $pid . '" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
			<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            //$row[] =$temp;
            /*
            $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
             */
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->employee_count_all(),
            "recordsFiltered" => $this->employee->employee_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function getfwmsEmployees()
    {

        $ttype = $this->input->get('type');
        $list = $this->employee->employee_datatables();
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        //$active = $this->input->post('active');
        $active = $this->input->post('active');
        $permitactive = $this->input->post('permit_active');
        $passport_expiry = $this->input->post('passport_expiry');
        $permit_expiry = $this->input->post('permit_expiry');

        $temp = '';
        $type = '';
        $current_date = date('Y-m-d');
        foreach ($list as $prd) {
            $no++;

            $passport_expiry_newDate = date("d-m-Y", strtotime($prd->passport_expiry));
            $permit_expiry_newDate = date("d-m-Y", strtotime($prd->permit_expiry));

            if (file_exists(FCPATH . "userfiles/passport/" . $prd->passport_document)) {
                $ps = '<a href="../userfiles/passport/' . $prd->passport_document . '" target=_blank>' . $prd->passport . '</a>';

            } else {

                $ps = $prd->passport;
            }
            if (file_exists(FCPATH . "userfiles/passport/" . $prd->visa_document)) {
                $vs = '<a href="../userfiles/passport/' . $prd->visa_document . '" target=_blank>' . $prd->permit . '</a>';

            } else {
                $vs = $prd->permit;
            }
            $row = array();
            /*$status='';
            if($active =="active" || $permitactive=="active")
            {
            $status="Active";
            }
            else if($passport_expiry=="expiry" ||  $permit_expiry=="expiry")
            {
            $status="Expired";

            }*/

            $status1 = '';
            if ($prd->passport_expiry < $current_date) {
                $status = "Expired";
            } else {
                $status = "Active";
            }
            if ($prd->permit_expiry < $current_date) {
                $status1 = "Expired";
            } else {
                $status1 = "Active";
            }

            $pid = $prd->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $prd->name;
            $row[] = $prd->cname;
            if (!empty($prd->passport_document)) {
                $row[] = $ps;
            } else {
                $row[] = $prd->passport;

            }
            $row[] = '<b style="color:red">' . $passport_expiry_newDate . '</b>';
            if (!empty($prd->visa_document)) {
                $row[] = $vs;
            } else {
                $row[] = $prd->permit;

            }
            $row[] = '<b style="color:red">' . $permit_expiry_newDate . '';
            $row[] = $status;
            $row[] = $status1;

            /*if(!empty($status))
            {
            $row[]=$status;
            }
            else{
            $row[]=$status1;

            }*/

            $row[] = '<a href="' . base_url() . 'employee/fwmsemplyeeedit?id=' . $pid . '" class="btn btn-success btn-sm" title="Edit"><i class="fa fa-edit"></i></a>&nbsp;
			<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            //$row[] =$temp;
            /*
            $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
             */
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->employee_count_all(),
            "recordsFiltered" => $this->employee->employee_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function saveInternational()
    {
        
        $type = $this->input->post('chooseradio');
        $emp_name = $this->input->post('emp_name');
        $passport = $this->input->post('passport');
        $permit = $this->input->post('permit');
        $country = $this->input->post('country');
        $company = $this->input->post('company');        
        // $passport_expiry = date('Y-m-d',strtotime($this->input->post('passport_expiry')));
        // $permit_expiry = date('Y-m-d',strtotime($this->input->post('permit_expiry')));
        // if (empty($company)) {
        //     $company = ' ';
        // }

        $gender = $this->input->post('gender');
        $socso_number = $this->input->post('socso_number');
        $kwsp_number = $this->input->post('kwsp_number');
        $pcb_number = $this->input->post('pcb_number');
        $join_date = $this->input->post('f_joined_date');
        $employee_job_type = $this->input->post('f_employee_job_type');
        $ic_number = $this->input->post('ic_number');
        $bank_name = $this->input->post('bank_name');
        $bank_account_number = $this->input->post('bank_account_number');

        $passport_expiry = date_create_from_format("d-m-Y", $this->input->post('passport_expiry'))->format("Y-m-d");
        $permit_expiry = date_create_from_format("d-m-Y", $this->input->post('permit_expiry'))->format("Y-m-d");


        // echo $passport_expiry;
        // echo $permit_expiry;
        // exit;

        $username = $this->input->post('user_name', true);
        // $attach = $_FILES['image']['name'];
        $email = $this->input->post('user_email');
        $role_id = $this->input->post('roleid');

        $password = $this->input->post('user_password', true);
        $roleid = 3;
        if ($this->input->post('roleid')) {
            $roleid = $this->input->post('roleid');
        }

        if ($roleid > 3) {
            if ($this->aauth->get_user()->roleid < 5) {
                die('No! Permission');
            }
        }

        // if(!empty($email))
        // {
        //     $existing_details = $this->db->where('email', $email)->where('delete_status',0)->or_where('passport', $passport)->or_where('permit', $permit)->get('gtg_employees')->result_array();

        // }else{
        //     $existing_details = $this->db->where('delete_status',0)->where('passport', $passport)->or_where('permit', $permit)->get('gtg_employees')->result_array();

        // }

        if(!empty($email))
        {
            $existing_details = $this->db->where('delete_status',0)
            ->group_start()
            ->where('email', $email)            
            ->or_where('passport', $passport)
            ->or_where('permit', $permit)
            ->group_end()
            ->get('gtg_employees')
            ->result_array();


        }else{
            $existing_details = $this->db->where('delete_status',0)
            ->group_start()
            //->where('email', $email)            
            ->where('passport', $passport)
            ->or_where('permit', $permit)
            ->group_end()
            ->get('gtg_employees')
            ->result_array();

        }
                // echo "<pre>";  print_r($existing_details); echo "</pre>";
        // echo count($existing_details);
        // echo $this->db->last_query();
        //exit;
        if (count($existing_details) <= 0) {
            // $a = $this->aauth->create_user($email, $password, $username);

            // echo $a;
            // exit;
            //print_r($insert);
            //die;
            $attach = $_FILES['passportfile']['name'];
            $attach1 = $_FILES['visafile']['name'];

            $data['status'] = 'danger';
            $data['message'] = $this->lang->line('No file error');
            $config['upload_path'] = './userfiles/passport/';
            $config['allowed_types'] = 'png|jpeg|jpg|JPEG|pdf';
            $config['encrypt_name'] = true;
            $config['max_size'] = 2669881;
            $config['file_name'] = time() . str_replace(' ', '_', $attach);
            $config['file_ext_tolower'] = true;
            $config['encrypt_name'] = false;
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('passportfile')) {
                // $error = array('status' => 'file', 'error' => $this->upload->display_errors());
                // echo json_encode($error);
                $passport_filename = '';

            } else {
                $data = array('upload_data' => $this->upload->data());
                $passport_filename = $data['upload_data']['file_name'];
            }

            $data['status'] = 'danger';
            $data['message'] = $this->lang->line('No file error');
            $config['upload_path'] = './userfiles/passport/';
            $config['allowed_types'] = 'png|jpeg|jpg|JPEG|pdf';
            $config['max_size'] = 2669881;
            $config['file_name'] = time() . str_replace(' ', '_', $attach1);
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('visafile')) {
                //  $error = array('status' => 'file', 'error' => $this->upload->display_errors());
                // echo json_encode($error);
                $visa_filename = '';
            } else {
                $data = array('upload_data' => $this->upload->data());
                $visa_filename = $data['upload_data']['file_name'];
            }

            if (!empty($username) && !empty($password) && !empty($email)) {
                $a = $this->aauth->create_user($email, $password, $username);
                if ((string) $this->aauth->get_user($a)->id != $this->aauth->get_user()->id) {
                    $nuid = (string) $this->aauth->get_user($a)->id;

                    if ($nuid > 0) {
                        $insert = $this->employee->addInternational($nuid,
                            (string) $this->aauth->get_user($a)->username,
                            $emp_name, $email, $roleid, $passport, $permit,
                            $country, $company, $type, $passport_expiry, $permit_expiry,
                            $passport_filename, $visa_filename, $role_id, $gender, $socso_number, $kwsp_number, $pcb_number,$join_date, $employee_job_type, $bank_name, $bank_account_number);

                    }
                } else {

                    echo json_encode(array('status' => 'Error', 'message' =>
                        'There has been an error, please try again.'));
                }
            } else {

                $d_user_id = $this->aauth->create_dummy_user();
                $insert = $this->employee->addInternational_new($d_user_id,
                    $emp_name, $roleid, $passport, $permit,
                    $country, $company, $type, $passport_expiry, $permit_expiry,
                    $passport_filename, $visa_filename, $role_id, $gender, $socso_number, $kwsp_number, $pcb_number, $join_date, $employee_job_type, $bank_name, $bank_account_number);

            }

            if (!$insert) {
                $data['status'] = 'danger';
                $data['message'] = $this->lang->line('Employee Add error');
            } else {
                $data['status'] = 'success';
                $data['message'] = $this->lang->line('Employee Created Successfully');
            }
            $_SESSION['status'] = $data['status'];
            $_SESSION['message'] = $data['message'];
            $this->session->mark_as_flash('status');
            $this->session->mark_as_flash('message');
            redirect('employee/add', 'refresh');
            exit();
        } else {

            // echo "<pre>";
            // print_r($existing_details);
            // echo "</pre>";
            // echo count($existing_details);
            //exit;

            if(!empty($emails))
            {
                $emails = array_column($existing_details, 'email');

            }else{
                $emails = array();

            }
            $passports = array_column($existing_details, 'passport');
            $permits = array_column($existing_details, 'permit');

            if (in_array($email, $emails)) {
                $data['message'] = $this->lang->line('Email Id Existed');

            } else if (in_array($passport, $passports)) {
                $data['message'] = $this->lang->line("Passport Details Existed");

            } else if (in_array($permit, $permits)) {
                $data['message'] = $this->lang->line('Permit Details Existed');

            } else {
                $data['message'] = $this->lang->line('Employee Details Adding Error');
            }

            $data['status'] = 'danger';

            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            $_SESSION['status'] = $data['status'];
            $_SESSION['message'] = $data['message'];
            $this->session->mark_as_flash('status');
            $this->session->mark_as_flash('message');
            redirect('employee/add', 'refresh');
            exit();

        }

    }

    public function importFile()
    {

        if ($this->input->post('submit')) {

            $path = 'uploads/';
            require_once APPPATH . "/third_party/PHPExcel.php";
            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|csv';
            $config['remove_spaces'] = true;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('uploadFile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }
            if (empty($error)) {
                if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;

                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i = 0;
                    foreach ($allDataInSheet as $value) {
                        if ($flag) {
                            $flag = false;
                            continue;
                        }
                        $inserdata[$i]['first_name'] = $value['A'];
                        $inserdata[$i]['last_name'] = $value['B'];
                        $inserdata[$i]['email'] = $value['C'];
                        $inserdata[$i]['contact_no'] = $value['D'];
                        $i++;
                    }
                    $result = $this->employee->insert_excel($inserdata);
                    if ($result) {
                        echo "Imported successfully";
                    } else {
                        echo "ERROR !";
                    }

                } catch (Exception $e) {
                    die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
                }
            } else {
                echo $error['error'];
            }

        }
        // $this->load->view('import');
    }

    public function updateInternational()
    {
        $id = $this->input->post('update_id');

        $type = $this->input->post('chooseradio');
        $emp_name = $this->input->post('emp_name');
        $passport = $this->input->post('passport');
        $permit = $this->input->post('permit');
        $country = $this->input->post('country');
        $company = $this->input->post('company');

        $gender = $this->input->post('gender');
        $socso_number = $this->input->post('socso_number');
        $kwsp_number = $this->input->post('kwsp_number');
        $pcb_number = $this->input->post('pcb_number');
        $join_date = $this->input->post('f_joined_date');
        $employee_job_type = $this->input->post('f_employee_job_type');
        $bank_name = $this->input->post('bank_name');
        $bank_account_number = $this->input->post('bank_account_number');
        $employee_type = $this->input->post('employee_type');
        // $passport_expiry = $this->input->post('passport_expiry');
        // $permit_expiry = $this->input->post('permit_expiry');
        $passport_expiry = date_create_from_format("d-m-Y", $this->input->post('passport_expiry'))->format("Y-m-d");
        $permit_expiry = date_create_from_format("d-m-Y", $this->input->post('permit_expiry'))->format("Y-m-d");

        $username = $this->input->post('user_name', true);
        // $attach = $_FILES['image']['name'];
        $email = $this->input->post('user_email');

        $password = $this->input->post('user_password', true);
        $roleid = 3;
        if ($this->input->post('roleid')) {
            $roleid = $this->input->post('roleid');
        }

        if ($roleid > 3) {
            if ($this->aauth->get_user()->roleid < 5) {
                die('No! Permission');
            }
        }

        //$existing_details = $this->db->where('id !=',$id)->where('email',$email)->or_where('passport',$passport)->or_where('permit',$permit)->get('gtg_employees')->result_array();
        if(!empty($email))
        {
            $existing_details = $this->db->where('id !=', $id)
            ->where('delete_status',0)
            ->group_start()
            ->where('email', $email)
            ->or_where('passport', $passport)
            ->or_where('permit', $permit)
            ->group_end()
            ->get('gtg_employees')
            ->result_array();


        }else{
            $existing_details = $this->db->where('id !=', $id)
            ->where('delete_status',0)
            ->group_start()
            //->where('email', $email)
            ->or_where('passport', $passport)
            ->or_where('permit', $permit)
            ->group_end()
            ->get('gtg_employees')
            ->result_array();

        }
      
        //echo $this->db->last_query();
        $c_emp_details = $this->db->where('id', $id)->get('gtg_employees')->result_array();
        // echo "<pre>";  print_r($existing_details); echo "</pre>";

        // echo count($existing_details);
        // exit;
        if (count($existing_details) <= 0) {

            if ($c_emp_details[0]['passport'] == $passport) {

                $a = $this->aauth->create_user($email, $password, $username);
                $attach = $_FILES['passportfile']['name'];
                $attach1 = $_FILES['visafile']['name'];

                if(!empty($attach))
                {
                    $data['status'] = 'danger';
                    $data['message'] = $this->lang->line('No file error');
                    $config['upload_path'] = './userfiles/passport/';
                    $config['allowed_types'] = 'png|jpeg|jpg|JPEG|pdf';
                    $config['encrypt_name'] = true;
                    $config['max_size'] = 2669881;
                    $config['file_name'] = time() . str_replace(' ', '_', $attach);
                    $config['file_ext_tolower'] = true;
                    $config['encrypt_name'] = false;
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('passportfile')) {
                        // $error = array('status' => 'file', 'error' => $this->upload->display_errors());
                        // echo json_encode($error);
                        $passport_filename = '';

                } else {
                    $data = array('upload_data' => $this->upload->data());
                    $passport_filename = $data['upload_data']['file_name'];
                }

                }else{
                    $passport_filename = '';
                }

                if(!empty($attach1))
                {
                    
                    $data['status'] = 'danger';
                    $data['message'] = $this->lang->line('No file error');
                    $config['upload_path'] = './userfiles/passport/';
                    $config['allowed_types'] = 'png|jpeg|jpg|JPEG|pdf';
                    $config['max_size'] = 2669881;
                    $config['file_name'] = time() . str_replace(' ', '_', $attach1);
                    $this->load->library('upload', $config);
                    if (!$this->upload->do_upload('visafile')) {
                        //  $error = array('status' => 'file', 'error' => $this->upload->display_errors());
                        // echo json_encode($error);
                        $visa_filename = '';
                    } else {
                        $data = array('upload_data' => $this->upload->data());
                        $visa_filename = $data['upload_data']['file_name'];
                    }
                }else{
                    $visa_filename = '';
                }

                $update = $this->employee->updateInternational($id, $emp_name, $email, $passport, $permit, $country, $company, $type, $passport_expiry, $permit_expiry, $passport_filename, $visa_filename, $gender, $socso_number, $kwsp_number, $pcb_number,$join_date, $employee_job_type, $bank_name, $bank_account_number, $employee_type);
                //print_r($insert);
                //die;

                /*$count = count($_FILES['files']['name']);*/

                /*  for($i=0;$i<$count;$i++){

                if(!empty($_FILES['files']['name'][$i])){

                $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                $config['upload_path'] = './userfiles/passport/';
                $config['allowed_types'] = 'png|jpeg|jpg|JPEG|pdf';
                $config['max_size'] = '5000';
                $config['file_name'] = $_FILES['files']['name'][$i];

                $this->load->library('upload',$config);

                if($this->upload->do_upload('file')){
                $uploadData = $this->upload->data();
                $filename = $uploadData['file_name'];
                $data = array(
                'employee_id' =>$insert,
                'document'=>$filename);
                $this->db->insert('gtg_fws_documents', $data);
                ///$data['totalFiles'][] = $filename;
                }

                }

                }*/
                if (!$update) {
                    $data['status'] = 'danger';
                    $data['message'] = $this->lang->line('Employee Add error');

                    $_SESSION['status'] = $data['status'];
                    $_SESSION['message'] = $data['message'];
                    $this->session->mark_as_flash('status');
                    $this->session->mark_as_flash('message');
                    redirect('employee/fwmsemplyeeedit?id=' . $id, 'refresh');
                    exit();

                } else {
                    $data['status'] = 'success';
                    $data['message'] = $this->lang->line('Employee Updated Successfully');
                    $_SESSION['status'] = $data['status'];
                    $_SESSION['message'] = $data['message'];
                    $this->session->mark_as_flash('status');
                    $this->session->mark_as_flash('message');
                    redirect('fwms/fwmsemployees', 'refresh');
                    exit();

                }

            } else {
                $data['status'] = 'danger';
                $data['message'] = $this->lang->line("Passport Can't be Updated");
                $_SESSION['status'] = $data['status'];
                $_SESSION['message'] = $data['message'];
                $this->session->mark_as_flash('status');
                $this->session->mark_as_flash('message');
                redirect('employee/fwmsemplyeeedit?id=' . $id, 'refresh');
                exit();
            }
        } else {

            //  echo "<pre>";  print_r($existing_details); echo "</pre>";
            // echo count($existing_details);
            // exit;
            if(!empty($email))
            {
                $emails = array_column($existing_details, 'email');
            }else{
                $emails = array();
            }
            
            $passports = array_column($existing_details, 'passport');
            $permits = array_column($existing_details, 'permit');

            if (in_array($email, $emails)) {
                $data['message'] = $this->lang->line('Email Id Existed');

            } else if (in_array($passport, $passports)) {
                $data['message'] = $this->lang->line("Passport Can't be Updated");

            } else if (in_array($permit, $permits)) {
                $data['message'] = $this->lang->line('Permit Details Existed');

            } else {
                $data['message'] = $this->lang->line('Employee Details Update Error');
            }

            $data['status'] = 'danger';

            $_SESSION['status'] = $data['status'];
            $_SESSION['message'] = $data['message'];
            $this->session->mark_as_flash('status');
            $this->session->mark_as_flash('message');
            redirect('employee/fwmsemplyeeedit?id=' . $id, 'refresh');
            exit();

        }

    }

    public function payrolllist()
    {

        $eid = $this->input->post('eid');
        $list = $this->employee->pay_get_datatables($eid);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $pid = $prd->id;
            $row[] = $prd->date;

            $row[] = amountExchange($prd->debit, 0, $this->aauth->get_user()->loc);
            $row[] = amountExchange($prd->credit, 0, $this->aauth->get_user()->loc);
            $row[] = $prd->account;
            $row[] = $prd->payer;
            $row[] = $prd->method;
            $row[] = '<a href="' . base_url() . 'transactions/view?id=' . $pid . '" class="btn btn-primary btn-xs"><span class="fa fa-eye"></span> View</a> <a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-xs delete-object"><span class="fa fa-trash"></span></a> ';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->employee->pay_count_all($eid),
            "recordsFiltered" => $this->employee->pay_count_filtered($eid),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function attendances()
    {

        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Attendance';
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/attendance_list');
        $this->load->view('fixed/footer');
    }

    

    public function daily_attendances()
    {
       
       $data = $this->employee->daily_attendance_list();      
        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Daily Attendance';
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/daily_attendance_list',$data);
        $this->load->view('fixed/footer');
    }

    public function ajax_daily_attendances()
    {
       $att_date = $this->input->post('att_date');
       $data = $this->employee->daily_attendance_list($att_date);
       $response['status'] = '200';
       $response['html'] = $this->load->view('employee/daily_attendance_list_table',$data,TRUE);
       $response['ab_html'] = $this->load->view('employee/daily_attendance_list_absent_table',$data,TRUE);

       echo json_encode($response);

    }
    public function attendance()
    {
        if ($this->input->post()) {
            $emp = $this->input->post('employee');
            $adate = datefordatabase($this->input->post('adate'));
            $from = timefordatabase($this->input->post('from'));
            $todate = timefordatabase($this->input->post('to'));
            $note = $this->input->post('note');

            if ($this->employee->addattendance($emp, $adate, $from, $todate, $note)) {
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . "  <a href='attendance' class='btn btn-blue btn-lg'><span class='fa fa-plus-circle' aria-hidden='true'></span>  </a> <a href='attendances' class='btn btn-grey btn-lg'><span class='fa fa-eye' aria-hidden='true'></span>  </a>"));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $data['emp'] = $this->employee->list_employee();
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'New Attendance';
            $this->load->view('fixed/header', $head);
            $this->load->view('employee/attendance', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function attendance_settings()
    {
        if ($this->input->post()) {
            $data['total_working_hours'] = $this->input->post('total_working_hours');
            $data['clock_in_time'] = $this->input->post('clock_in_time');
            $data['clock_out_time'] = $this->input->post('clock_out_time');
            $data['ot_allowance_per_hour'] = $this->input->post('ot_allowance_per_hour');
            $data['clock_in_grace_period'] = $this->input->post('clock_in_grace_period');
            $data['clock_in_checking_hours'] = $this->input->post('clock_in_checking_hours');
            $data['address'] = $this->input->post('address');
            $data['latitude'] = $this->input->post('latitude');
            $data['longitude'] = $this->input->post('longitude');
            $data['office_login_radius'] = $this->input->post('office_login_radius');
            $data['clock_out_grace_period'] = $this->input->post('clock_out_grace_period');
            $data['auto_clock_out_minutes'] = $this->input->post('auto_clock_out_minutes');
            
            $att_sett_id = $this->input->post('att_sett_id');

            if ($this->employee->addattendance_settings($data,$att_sett_id)) {
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('ADDED') . "  <a href='attendance' class='btn btn-blue btn-lg'><span class='fa fa-plus-circle' aria-hidden='true'></span>  </a> <a href='attendances' class='btn btn-grey btn-lg'><span class='fa fa-eye' aria-hidden='true'></span>  </a>"));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $data['settings'] = $this->employee->get_attendance_settings();
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Attendance Settings';
            $this->load->view('fixed/header', $head);
            $this->load->view('employee/attendance_settings', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function auto_attendance()
    {
        if ($this->input->post()) {
            $auto_attand = $this->input->post('attend');

            if ($this->employee->autoattend($auto_attand)) {
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('UPDATED')));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            $this->load->model('plugins_model', 'plugins');

            $data['auto'] = $this->plugins->universal_api(62);

            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Auto Attendance';
            $this->load->view('fixed/header', $head);
            $this->load->view('employee/autoattend', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function att_list()
    {
        //$cid = $this->input->post('cid');

        $user_role = $this->aauth->get_user()->roleid;
        $role_details = $this->db->where('id',$user_role)->get('gtg_role')->result_array();
        $all_data_previleges = $role_details[0]['all_data_previleges'];

        if ($all_data_previleges) {
            $cid = 0;
        } else {
            $cid = $this->aauth->get_user()->id;
        }

        $year = $this->input->post('year');
        $month = $this->input->post('month');
        $list = $this->employee->attendance_datatables($cid, $year, $month);
        $data = array();
        $no = $this->input->post('start');
        // echo $this->db->last_query();
        // exit;
        // echo $this->db->last_query();
        // echo "<pre>"; print_r($list); echo "</pre>";
        // exit;
        $view_option = false;
        $delete_option = false;

        if ($this->aauth->premission(212)) { 
            $view_option = true;
        }

        
        if ($this->aauth->premission(210)) { 
            $delete_option = true;
        }

        foreach ($list as $obj) {

            $view_row = '';
            $delete_row = '';
            if(!empty($obj->tto))
            {
                //$temptime = strtotime($obj->tto) - strtotime($obj->tfrom);
                $duration = date("H:i:s", $obj->actual_hours);
            }else{
                //$temptime = '---';
                $duration = '---';
            }
            
           
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $obj->name;
            //$row[] = dateformat($obj->adate) . ' &nbsp; ' . $obj->tfrom . ' - ' . $obj->tto;
            $row[] = dateformat($obj->adate);
            //$row[] = bcdiv((strtotime($obj->tto) - strtotime($obj->tfrom)) / 3600,  1, 2);

            $row[] = $duration;
            //$row[] = $obj->actual_hours;
            $row[] = date("h:i A", strtotime($obj->tfrom));
            // $row[] = date("h:i A", strtotime($obj->tto));
            if(!empty($obj->tto))
            {
                $row[] = date("h:i A", strtotime($obj->tto));
            }else{
                $row[] = '---';
            }

            if($view_option)
            {
                $view_row .= '<a href="' . base_url('employee/attendview') . '?id=' . $obj->emp . '"  class="btn btn-cyan btn-sm"><span class="fa fa-eye"></span></a>';

            }

            
            if($delete_option)
            {
                $delete_row .= ' &nbsp;<a href="#" data-object-id="' . $obj->id . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';

            }
            $row[] = $view_row."".$delete_row;
            $row[] = $obj->clock_in_radius;
            $row[] = $obj->clock_out_radius;
            $data[] = $row;
        }

        $output = array(
            "draw" => 1,
            "recordsTotal" => $this->employee->attendance_count_all($cid, $year, $month),
            "recordsFiltered" => $this->employee->attendance_count_filtered($cid, $year, $month),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function delete_attendance()
    {
        $id = $this->input->post('deleteid');

        if ($this->employee->deleteattendance($id)) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }
    public function employee_list()
    {

        $list = $this->employee->list_employee();
        $html = '';
        foreach ($list as $item) {
            $html .= '<option value="' . $item['id'] . '" vehicle_id="'.$item['vehicle_id'].'">' . $item['name'] . '</option>';
        }
        echo $html;
    }


    

    public function attendview()
    {
        if ($this->input->get()) {
            $emp = $this->input->get('id');
            $data['emp'] = $this->employee->list_employee();
            $bdata = $this->employee->attend_break_three_month($emp);
            // echo "<pre>"; print_r($bdata); echo "</pre>";
            // exit;
            $data['employee_details'] = $this->employee->employee_details($emp);
            $clockout = '';
            $count = 1;
            $attend = '';
            $nn_data = array();
            foreach ($bdata as $temp) {
                $duration = strtotime($temp['clockout']) - strtotime($temp['clockin']);
                $duration = strtotime('00:00:00') + $duration;
                $rw = $this->employee->get_break_time($temp['code']);
                foreach ($rw as $br) {
                    $break = strtotime($br['btime']);
                }
                if ($break >= $duration) {
                    $clockout = '<span class="text-success">' . date('H:i A', strtotime($temp['clockout'])) . '</span>';
                } else {
                    $clockout = '<span class="text-danger">' . date('H:i A', strtotime($temp['clockout'])) . '</span>';
                }
                $clockin = date('H:i A', strtotime($temp['clockin']));
                $bdate = $temp['bdate'];
                $activity = $temp['break'];
                $clockin_fulltime = date('Y-m-d H:i:s', strtotime($temp['bdate'] . " " . $temp['clockin']));
                $n_data['clockin_fulltime'] = $clockin_fulltime;
                $n_data['clockin_seconds'] = strtotime($clockin_fulltime);
                $n_data['bdate'] = $temp['bdate'];
                $n_data['activity'] = $temp['break'];
                // echo $n_data;
                // exit;
                // echo "<pre>"; print_r($n_data); echo "</pre>";
                // exit;
                $nn_data[] = $n_data;
                $attend .= "<tr><td>$count</td><td>$bdate</td><td>$activity</td><td>$clockin</td><td>$clockout</td></tr>";
                $count++;
            }
            $data['attend'] = $attend;
            $data['bt'] = $this->employee->break_time_list();
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Employee current login status';

            // Extract the values of the specified key for sorting
            if (!empty($nn_data)) {
                $sortValues = array_column($nn_data, "clockin_seconds");
            }
            // Sort the array based on the sort values in descending order
            if (!empty($nn_data)) {
                array_multisort($sortValues, SORT_DESC, $nn_data);
            }
            $data['break_details'] = $nn_data;
            $head['break_details'] = $nn_data;

            // echo "<pre>"; print_r($head); echo "</pre>";
            // echo "<pre>"; print_r($nn_data); echo "</pre>";
            // exit;
            $this->load->view('fixed/header', $head);
            $this->load->view('employee/attend_view', $data);
            $this->load->view('fixed/footer');
        } else {

            $data['attend'] = $this->employee->attendance_table_list();
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Current Attendants Status';
            $employee = $this->employee->list_employee();
            $data['employee'] =
            $i = 1;
            $attend = '';
            $temp = '';
            $view_option = false;
            if ($this->aauth->premission(212)) { 
                $view_option = true;
            }
            foreach ($employee as $row) {
                $aid = $row['id'];
                $username = $row['username'];
                $name = $row['name'];
                $picture = base_url('userfiles/employee/' . $row['picture']);
                $role = user_role($row['roleid']);
                $status = $row['banned'];
                $clock = "Not Login";
                $state = "";
                $check = true;
                if ($status == 1) {
                    $status = 'Deactive';
                } else {
                    $status = 'Active';
                }
                if (($row['clock'] == 1 && strtotime(date('Y-m-d')) == strtotime($row['cdate']))) {
                    $clock = date('h:i A', $row['clockin']);
                    $temp = $this->employee->attend_break($row['id']);

                    //if(is_array($temp) && !empty($temp)){
                    if (!empty($temp['clockin'])) {
                        $duration = strtotime(date("H:i:s")) - strtotime($temp['clockin']);
                        $duration = strtotime('00:00:00') + $duration;
                        if ($temp['status']) {
                            $rw = $this->employee->get_break_time($temp['code']);
                            foreach ($rw as $br) {
                                $break = strtotime($br['btime']);
                            }
                            if ($break >= $duration) {
                                $state = '<span class="btn btn-success btn-sm">' . $temp['break'] . '</span>';
                            } else {
                                $state = '<span class="btn btn-danger btn-sm">' . $temp['break'] . '</span>';
                            }
                        } else { $state = 'Working';}
                        // }else{
                        //     $state='Working';
                        // }

                    }
                }
                $attend .= "<tr>
        <td>$i</td>
        <td><img src='" . $picture . "' class='profile-icon'>$name</td>
        <td>$role</td>
        <td>$status</td>";
                $attend .= "<td>$clock</td>";
                $attend .= "<td>$state</td>";
                $attend .= "<td>";
                if($view_option){
                    
                    $attend .= "<a href='" . base_url("employee/attendview?id=$aid") . "' style='display: inline-block; padding: 6px; margin-left: 1px;' class='btn btn-success btn-xs'><i class='fa fa-eye'></i> " . $this->lang->line('View') . "</a>";
                
                }
                $attend .= "</td></tr>";
                $i++;
            }

            $data['attend'] = $attend;

            $this->load->view('fixed/header', $head);
            $this->load->view('employee/attend_list', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function latelogin()
    {
        $id = $this->input->get('id');
        $datalist = $this->employee->attendance_late($id);
        $subject = "Sytem Late login";
        foreach ($datalist as $emp) {
            $message = "Hi, " . $emp['name'] . "<br/> You are late logged on system kidly login on time";
            $mailtoc = $emp['email'];
            $mailtotilte = $emp['name'];
            $this->load->model('communication_model');
            $attachmenttrue = false;
            $attachment = '';
            ob_start();
            $status = $this->communication_model->send_email($mailtoc, $mailtotilte, $subject, $message, $attachmenttrue, $attachment);
            ob_clean();
            echo 'late login ' . $emp['name'];
        }
        echo '<br>process completed';
        redirect(base_url('employee/departments'), 'refresh');
    }

    public function attendreport()
    {
        $cid = $this->input->get('employee');
        $from_date = $this->input->get('from_date');
        $to_date = $this->input->get('to_date');
        $list = $this->employee->attendance_datatables_by_dates($cid, $from_date, $to_date);
        $data['emp_list'] = $this->employee->list_employee();
        $data['emp_details'] = $this->employee->employee_details($cid);
        //echo "<pre>"; print_r($list); echo "</pre>";
        // exit;
        $a_dates = array_column($list, 'adate');
        $data['total_attendance'] = count(array_unique($a_dates));
        $data['total_absence'] = 0; 
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;


        $least_date = null;
        $highest_date = null;
        if(empty($from_date) && empty($to_date))
        {
        // Iterate over the array to find the least and highest dates
        foreach ($list as $item) {
            $adate = $item->adate;
            if ($least_date === null || $adate < $least_date) {
                $least_date = $adate;
            }
            if ($highest_date === null || $adate > $highest_date) {
                $highest_date = $adate;
            }
            
        }

        // Convert dates to DateTime objects for easier manipulation
        $least_date_obj = new DateTime($least_date);
        $highest_date_obj = new DateTime($highest_date);

        // Calculate the difference between the dates in terms of days
        $days_difference = $least_date_obj->diff($highest_date_obj)->days;
        // print_r($list);
        $total_absence = $days_difference - count(array_unique($a_dates)); 
        if ($total_absence < 0) {
            $total_absence = 0;
        }
        
        // Assign the total absence value to $data['total_absence']
        $data['total_absence'] = $total_absence;
        $data['from_date'] = $least_date_obj->format('d-m-Y');
        $data['to_date'] = $highest_date_obj->format('d-m-Y');

        }
        $att_settings = $this->employee->get_attendance_settings();

        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;

        if(!empty($att_settings))
        {
            $work_hours = $att_settings['total_working_hours'];
            $ot_allowance = $att_settings['ot_allowance_per_hour'];
        }else{
            $work_hours = 0;
            $ot_allowance = 0; 
        }
        $ot_allowance_amount = $att_settings['ot_allowance_per_hour'];
            
        $table = '';
        $no = $this->input->post('start');
        foreach ($list as $obj) {

            if(!empty($obj->tto))
            {
                //$temptime = strtotime($obj->tto) - strtotime($obj->tfrom);
                $duration = date("H:i", $obj->actual_hours);
            }else{
                //$temptime = '---';
                $duration = '---';
            }
            

            // $temptime = strtotime($obj->tto) - strtotime($obj->tfrom);
            // $duration = date("H:i", $temptime);

            $ot = (int)$duration - (int)$work_hours;
            if ($ot > 0){  $ot = $ot; $ot_allowance = $ot * $ot_allowance_amount; }else{ $ot = 0; $ot_allowance = 0; }
           
            if($obj->clock_in_radius){ $clk_in_background_color = '#ccffcc'; }else{ $clk_in_background_color = '#ffcccc'; }
            if($obj->clock_out_radius){ $clk_out_background_color = '#ccffcc'; }else{ $clk_out_background_color = '#ffcccc'; }
            $no++;
            $row = array();
            $table .= '<tr><td>' . $no . '</td>';
            $table .= '<td>' . $obj->name . '</td>';
            // $table.=  dateformat($obj->adate) . ' &nbsp; ' . $obj->tfrom . ' - ' . $obj->tto;
            $table .= '<td data-sort="' . strtotime($obj->adate) . '" >' . dateformat($obj->adate) . '</td>';
            // $table.=  round((strtotime($obj->tto) - strtotime($obj->tfrom)) / 3600, 2);
            $temptime = strtotime($obj->tto) - strtotime($obj->tfrom);
           
            $table .= '<td>' . date("h:i A", strtotime($obj->tfrom)) . '</td>';

            $table .= '<td><img height="50" width="50" src="' . base_url('userfiles/clock_in_photos/'.$obj->clock_in_photo) . '"/></td>';
            $table .= '<td style="background-color:'.$clk_in_background_color.'">' . $obj->clock_in_location. '</td>';
            // $table .= '<td>' . date("h:i A", strtotime($obj->tto)) . '</td>';
            if(!empty($obj->tto))
            {
                $table .= '<td>' . date("h:i A", strtotime($obj->tto)) . '</td>';
                
            }else{
                $table .= '<td>---</td>';
            }

            if(!empty($obj->clock_out_photo))
            {
                $table .= '<td><img height="50" width="50" src="' . base_url('userfiles/clock_out_photos/'.$obj->clock_out_photo). '"/></td>';
                
            }else{
                $table .= '<td>---</td>';
            }

            if(!empty($obj->clock_out_location))
            {
                $table .= '<td style="background-color:'.$clk_out_background_color.'">' . $obj->clock_out_location . '</td>';
                
            }else{
                $table .= '<td>---</td>';
            }
            $table .= '<td>' . date("H:i:s", $obj->actual_hours) . '</td>';
            $table .= '<td>' . $ot . '</td>';
            $table .= '<td>' . $ot_allowance . '</td>';
            $table .= '<td>----</td></tr>';
        }
        $data['report'] = $table;
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Attendance Report';
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/attend_report', $data);
        $this->load->view('fixed/footer');

    }
    public function attendbreaksetting()
    {

        $head['usernm'] = $this->aauth->get_user()->username;
        $data['time_list'] = $this->employee->break_time_list();
        $head['title'] = 'Attendence Break Setting';
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/break_setting', $data);
        $this->load->view('fixed/footer');
    }

    public function update_break_time()
    {

        $id = $this->input->get('id');
        $name = $this->input->get('name');
        $time = $this->input->get('hour');
        $time = $time . ":" . $this->input->get('minut') . ":00";

        $red = $this->employee->modify_break_time($id, $name, $time);
        if ($red) {
            $this->session->set_flashdata('key', 'success');
            $this->session->set_flashdata('msg', 'Updated break successful');
        } else {
            $this->session->set_flashdata('key', 'danger');
            $this->session->set_flashdata('msg', 'Failed to update break');
        }
        redirect('employee/attendbreaksetting', 'refresh');

    }
    public function getfilteredRecords()
    {
        $cid = $this->input->post('id');
        $clockout = '';
        $count = 1;
        $attend = '';
        $duration = $this->input->post('val');
        if (!empty($cid)) {
            $bdata = $this->employee->attend_break_intervel($cid, $duration);
            foreach ($bdata as $temp) {
                $duration = strtotime($temp['clockout']) - strtotime($temp['clockin']);
                $duration = strtotime('00:00:00') + $duration;
                $rw = $this->employee->get_break_time($temp['code']);
                foreach ($rw as $br) {
                    $break = strtotime($br['btime']);
                }
                if ($break >= $duration) {
                    $clockout = '<span class="text-success">' . date('H:i A', strtotime($temp['clockout'])) . '</span>';
                } else {
                    $clockout = '<span class="text-danger">' . date('H:i A', strtotime($temp['clockout'])) . '</span>';
                }
                $clockin = date('H:i A', strtotime($temp['clockin']));
                $bdate = $temp['bdate'];
                $activity = $temp['break'];
                $attend .= "<tr><td>$count</td><td>$bdate</td><td>$activity</td><td>$clockin</td><td>$clockout</td></tr>";
                $count++;
            }

        }
        echo $attend;
    }

    public function pdf_report_download()
    {
        // $invoice_id = $this->input->get('id');
        // $invoice_details = $this->invocies->peppol_invoice_details($invoice_id);

        // $xmlUrl =  $invoice_details['document_url'];

        // Fetch the XML data from the URL
        //$xmlData = file_get_contents($xmlUrl);
        //header('Content-Type: application/pdf');

        //try {

        $company = $this->input->post('company');
        $employee = $this->input->post('employee');
        $report = $this->employee->get_fwms_employees_report($company, $employee);

        $org_details = $this->employee->getOrganizationDetails();
        $logo = $org_details->logo;
        $name = $org_details->cname;

        $logo_url = base_url() . 'userfiles/company/' . $logo;

        $mpdf = $this->pdf->load_en();
        $mpdf->pdf_version = '1.4';
        $headers = @get_headers($logo_url);
        $client_image = '';
        $client_name = '';

        if ($headers && strpos($headers[0], "200 OK") !== false) {
            // HTTP status code is 200, indicating success
            $watermarkImage = base_url() . 'userfiles/company/' . $logo;
            $client_image = base_url() . 'userfiles/company/' . $logo;
            $mpdf->SetWatermarkImage($watermarkImage);
            $mpdf->showWatermarkImage = true;
        } else {
            // Image is not loadable or the URL is invalid
            $watermarkText = $name;
            $client_name = $name;
            $mpdf->SetWatermarkText($watermarkText);
            $mpdf->showWatermarkText = true;
        }

        $xmlData = '';
        $html = '<!DOCTYPE html>';
        $html .= '<html>';
        $html .= '<head>';
        $html .= '<title>FWMS Report</title>';
        $html .= '<style>';
        $html .= 'body { text-align: center; }'; // Center-align the content
        $html .= 'img { display: block; margin: 0 auto; width:100px; height:100px; }'; // Center-align the image
        $html .= '</style>';
        $html .= '</head>';
        $html .= '<body>';
        if (!empty($client_image)) {
            $html .= '<img src="' . $client_image . '" alt="" width="200" height="200" />'; // Replace with the path to your image
            $html .= '<h1>FWMS Report</h1>';
        } else {
            $html .= '<h1>' . $client_name . '</h1>';
            $html .= '<h2>FWMS Report</h2>';
        }

        $html .= '<pre>' . $report . '</pre>'; // Display the raw XML data for demonstration
        $html .= '</body>';
        $html .= '</html>';

        // Create an mPDF instance
        // $mpdf = new Mpdf();

        //echo $html;
        //exit;

        $mpdf->WriteHTML($html);
        $currentTimestamp = time();
        $name = 'fwms_report' . $currentTimestamp . '.pdf';
        // Output the PDF to the browser or save to a file
        $mpdf->Output($name, 'D'); // 'D' to download the PDF, 'I' to display in the browser

        // Your mPDF code here
        // } catch (\Mpdf\MpdfException $e) {
        //     echo 'PDF generation error: ' . $e->getMessage();
        // }

    }


    public function downloadEmployeeTemplate()
    {
        

        $filePath = FCPATH . 'userfiles/employee/Employee-Management-Template.xlsx';

        // Check if the file exists
        if (file_exists($filePath)) {
            // Load the download helper
            $this->load->helper('download');

            // Force download the file
            force_download('Employee-Management-Template.xlsx', file_get_contents($filePath));
        } else {
            redirect('employee/addExcel');
        }

    }

    public function documents()
    {
        $data['id'] = $this->input->get('id');
        //$data['details'] = $this->customers->details($data['id']);
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->session->set_userdata("emp_id", $data['id']);
        $head['title'] = 'Documents';
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/documents', $data);
        $this->load->view('fixed/footer');
    }

    public function document_load_list()
    {
        $cid = $this->input->post('cid');
        $list = $this->employee->document_datatables($cid);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $document) {
            $row = array();
            $no++;
            $row[] = $no;
            $row[] = $document->title;
            $row[] = dateformat($document->cdate);

            if (filter_var($document->filename, FILTER_VALIDATE_URL)) {
                // If it's a valid URL, use it directly
                $url = $document->filename;
            } else {
                // If it's not a valid URL, construct the URL using base_url
                $url = base_url('userfiles/documents/' . $document->filename);
            }
            $row[] = '<a href="' . $url . '" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-file-text"></i> ' . $this->lang->line('View') . '</a> <a class="btn btn-danger btn-xs delete-object" href="#" data-object-id="' . $document->id . '"> <i class="fa fa-trash"></i> </a>';


            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->employee->document_count_all($cid),
            "recordsFiltered" => $this->employee->document_count_filtered($cid),
            "data" => $data,
        );
        echo json_encode($output);
    }

    
    public function adddocument()
    {

        // echo "<pre>"; print_r($_FILES); echo "</pre>";
        // exit;
        $data['id'] = $this->input->get('id');
        $this->load->helper(array('form'));
        $data['response'] = 3;
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Add Document';

        $this->load->view('fixed/header', $head);

        if ($this->input->post('title')) {
            $title = $this->input->post('title', true);
            $cid = $this->input->post('id');
            $config['upload_path'] = './userfiles/documents';
            $config['allowed_types'] = 'docx|docs|txt|pdf|xls|xlsx|pptx';
            $config['encrypt_name'] = TRUE;
            //$config['max_size'] = 3000;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('userfile')) {
                $error = $this->upload->display_errors();
                $data['response'] = 0;
                $data['responsetext'] = $error;
                // $error = $this->upload->display_errors();
                // echo $error;
            } else {
                $data['response'] = 1;
                $data['responsetext'] = 'Document Uploaded Successfully. <a href="documents?id=' . $cid . '"
                                       class="btn btn-indigo btn-md"><i
                                                class="icon-folder"></i>
                                    </a>';
                $filename = $this->upload->data()['file_name'];
                $this->employee->adddocument($title, $filename, $cid);
            }
            // exit;
            $this->load->view('employee/adddocument', $data);
        } else {


            $this->load->view('employee/adddocument', $data);


        }
        $this->load->view('fixed/footer');


    }

    public function delete_document()
    {
        $id = $this->input->post('deleteid');
        $cid = $this->session->userdata('emp_id');

        if ($this->employee->deletedocument($id, $cid)) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }


    public function profile_download(){


        $id = intval($this->input->get('id'));
        $token = $this->input->get('token');

        $data['employee'] = $this->employee->employee_details($id);
        //$data['system_data'] = $this->db->get('gtg_system')->row_array();

        $html = $this->load->view('employee/employee_profile_download', $data, true);

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
        $mpdf->Output('employee_profile.pdf', 'D');

        // If you want to display in the browser
        // $mpdf->Output('employee_profile.pdf', 'I');

    }



    public function attendreport_new()
    {
        if(!empty($_POST))
        {
        
        $cid = $this->input->post('employee');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $list = $this->employee->attendance_report_new($cid, $from_date, $to_date);
        $data['emp_list'] = $this->employee->list_employee();
        $data['emp_details'] = $this->employee->employee_details($cid);
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        // echo "<pre>"; print_r($list); echo "</pre>";
        // exit;
        $att_settings = $this->employee->get_attendance_settings();

        $categorizedResult = array();

        foreach ($list as $row) {
            $empId = $row['emp'];

            // Create a new entry for emp if it doesn't exist
            if (!isset($categorizedResult[$empId])) {
                $categorizedResult[$empId] = array(
                    'emp_id' => $empId,
                    'entries' => array(),
                );
            }

            // Add the row to the entries array
            $categorizedResult[$empId]['entries'][] = $row;
        }

        // echo "<pre>"; print_r($categorizedResult); echo "</pre>";
        // exit;
        
        if(!empty($att_settings))
        {
            $work_hours = $att_settings['total_working_hours'];
            $clock_in_grace_period = $att_settings['clock_in_grace_period'];
            $clock_in_time = $att_settings['clock_in_time'];
            $clock_out_time = $att_settings['clock_out_time'];
            
           
        }else{
            
            $work_hours = 0; 
            $clock_in_grace_period = 0;
            $clock_in_time = '00:00:00';
            $clock_out_time = '00:00:00';
        }


        // $ot_allowance_amount = $att_settings['ot_allowance_per_hour'];
         
        
        $table = '';
        $n_data = array();
        foreach ($categorizedResult as $empData) {

            $data = array();
            $ot_hours = 0;
            $empId = $empData['emp_id'];
            $entries = $empData['entries'];
        
            // Initialize variables to calculate totals
            $totalAttendance = count($entries);
            $totalMc = 0;
            $totalOtHours = 0;
            $lateCounter = 0;
            $employee_exceeded_seconds = 0;
            foreach ($entries as $entry) {
                // echo $lateCounter."---";
                
                $data['department_name'] = $entry['department_name'];
                $data['employee_type'] = $entry['employee_type']." - ".$entry['employee_job_type'];
                $data['total_attendance'] = count($list);

                $data['clock_in'] = $entry['first_tfrom'];
                $data['clock_out'] = $entry['last_tto'];
                $data['ofc_clock_in'] = date('H:i:s', strtotime($clock_in_time));
                $data['ofc_clock_out'] = date('H:i:s',strtotime($clock_out_time));

                $clockInTime = strtotime($data['ofc_clock_in']);
                $clockOutTime = strtotime($data['ofc_clock_out']);
            
                // Calculate the difference in seconds
                $diffInSeconds = $clockOutTime - $clockInTime;
            
                // Check if the difference exceeds the specified work hours
                if ($diffInSeconds > $work_hours * 3600) {
                    // Save the exceeded seconds
                    $exceededSeconds = $diffInSeconds - ($work_hours * 3600);
            
                    // Add the exceeded seconds to the employee array
                    $employee_exceeded_seconds += $exceededSeconds;
                } else {
                    // If not exceeded, set 0 seconds
                    $employee_exceeded_seconds += 0;
                }

                
                $clockInTime = strtotime($data['clock_in']);
                $ofcClockInTime = strtotime($data['ofc_clock_in']);

                // Check if clock_in is less than ofc_clock_in
                if ($clockInTime > $ofcClockInTime) {
                   
                    $diffInMinutes = abs(($clockInTime - $ofcClockInTime) / 60);
                    // echo "clockin is heigher -- ".$diffInMinutes;
                    if ($diffInMinutes > $clock_in_grace_period) {
                        // Increment the late counter
                        $lateCounter++;
                    }

                }else{
                    // echo "ofc clockin is heigher";
                }

               
            }
        
            $exceededHours = floor($employee_exceeded_seconds / 3600);
            $exceededMinutes = floor(($employee_exceeded_seconds % 3600) / 60);

            if ($exceededHours > 0) {
                $ot_final_hours = $exceededHours." hrs,".$exceededMinutes." mins";
            } else if ($exceededMinutes > 0){
                $ot_final_hours = $exceededMinutes." mins";
            } else {
                $ot_final_hours = "0 mins";
            }

            
            if($lateCounter <= 0)
            {
                $kpi_indication = 'green';
            }else if($lateCounter == 1)
            {
                $kpi_indication = 'yellow';
            }else if($lateCounter > 1)
            {
                $kpi_indication = 'red';
            }

            $data['emp_id'] = $empId;
            $data['emp_name'] = $entries[0]['name']; // Assuming the name 
            $data['ot_hours'] = $ot_final_hours;
            $data['late_attendances'] = $lateCounter;
            $data['total_mc'] = 'NA';
            $data['total_annual_leaves'] = 'NA';
            $data['kpi_indication'] = $kpi_indication;
            $data['from_date'] = date('d-m-Y',strtotime($from_date));
            $data['to_date'] = date('d-m-Y',strtotime($to_date));
            $n_data[] = $data;





        }
 
        // echo "<pre>"; print_r($n_data); echo "</pre>";
        // exit;
        $data['attendance_report'] = $n_data;
        $data['report'] = $n_data;
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Attendance Report';
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/attend_report_new', $data);
        $this->load->view('fixed/footer');

        }else{

        $data['report'] = '';
        $data['from_date'] = '';
        $data['to_date'] = '';
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Attendance Report';
        $data['emp_list'] = $this->employee->list_employee();
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/attend_report_new', $data);
        $this->load->view('fixed/footer');

        }
    
    }

    

    public function getFileManagement(){

        //$employee_id = $this->aauth->get_user()->id;
        $employee_id = intval($this->input->get('id'));
        //$employee_id = 253;
        $parent_entity_id = '';
        //$parent_entity_id = $this->input->get('parent_entity_id'); // Assuming you are getting the parent_entity_id from the GET request

        

        $this->db->select('
            fme.entity_id,
            fme.parent_entity_id,
            fme.entity_name,
            fme.entity_type,
            fme.entity_path,
            fme.created_at,
            fme.updated_at,
            fme.delete_status,
            IF(fl.lock_id IS NOT NULL, "locked", "unlocked") AS file_lock_status,
            fl.global_lock
        ');
        $this->db->from('filemanagemententities fme');
        $this->db->join('user_folder_access ufa', 'fme.entity_id = ufa.folder_id', 'left');
        $this->db->join('file_locks fl', 'fme.entity_id = fl.file_id AND fl.user_type = "employee" AND fl.user_id = ' . $employee_id, 'left');
        $this->db->where('ufa.type', 'employee');
        $this->db->where('ufa.user_id', $employee_id);
        $this->db->where('(fme.parent_entity_id IS NULL OR EXISTS (SELECT 1 FROM filemanagemententities fmeparent WHERE fmeparent.entity_id = fme.parent_entity_id))');

        // Additional condition based on parent_entity_id
        if ($parent_entity_id) {
            $this->db->where('fme.parent_entity_id', $parent_entity_id);
        }

        $this->db->order_by('fme.parent_entity_id, fme.entity_name','ASC');
        $query = $this->db->get();
        $items = $query->result_array();

        $result = array();

        $grouped_items = array();
    
        foreach ($items as $item) {
            $parent_id = $item['parent_entity_id'] ?? null;
            $grouped_items[$parent_id][] = $item;
        }
        
        $contents = reset($grouped_items);
       
        $data = array(
            'folder' => array(),
            'contents' => $contents,
            'breadcrumbs' => array()
        );

        //$data['folders'] = $this->FileModel->getRootFoldersHeirarichy();

        $data['parent_id'] = '';
        $data['employees'] = array();
        $data['customers'] = array();

        // echo "<pre>";print_r($data);echo "</pre>";
        // exit;   

        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'File / Folders List';

        $this->load->view('fixed/header', $head);
        $this->load->view('employee/file_management_entities_list', $data);
        $this->load->view('fixed/footer');
    }

    public function export_daily_attendance_report(){


        $att_date = $this->input->post('att_date');
        $data = $this->employee->daily_attendance_list($att_date);

        $html = $this->load->view('employee/daily_attendance_list_download', $data, true);

        // echo $html;
        // exit;
        $this->load->library('pdf');

       // Create an instance of Mpdf
        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A3']);

        // Add a new page
        $mpdf->AddPage();

        // Write HTML content to the page
        $mpdf->WriteHTML($html);

        // If you want to force a download
        $mpdf->Output('daily_attendance_list.pdf', 'D');


        // If you want to display in the browser
        // $mpdf->Output('employee_profile.pdf', 'I');

    }

    public function employee_clock_in_locations(){

        $att_settings = $this->db->get('gtg_attendance_settings')->row_array();
               
        $this->db->select('gtg_employees.name, gtg_attendance.clock_in_latitude,gtg_attendance.clock_in_longitude');
        $this->db->from('gtg_attendance');
        $this->db->join('gtg_employees', 'gtg_employees.id = gtg_attendance.emp', 'inner');
        $this->db->where('gtg_attendance.adate', date('Y-m-d'));
        $this->db->order_by('gtg_attendance.id', 'ASC');
        $this->db->group_by('gtg_employees.id');
        $today_attendances = $this->db->get()->result_array();
        $final_attendance = array();
        if(!empty($today_attendances)){ foreach($today_attendances as $attendance){ 
       
            $f_attendance['name'] = $attendance['name'];
            $f_attendance['lat'] = floatval($attendance['clock_in_latitude']);
            $f_attendance['lng'] = floatval($attendance['clock_in_longitude']);
            $final_attendance[] = $f_attendance;
        }}

    
        $f_data['all_employees'] = $final_attendance;
        $f_data['att_settings'] = $att_settings;
        
        echo json_encode($f_data);
        //return $f_data;

    }

}