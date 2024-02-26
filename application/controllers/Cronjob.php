<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Cronjob extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('cronjob_model', 'cronjob');
        $this->load->library("Aauth");
        $this->li_a = 'advance';
        $c_module = 'dashboard';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);
    }

    public function index()
    {
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if ($this->aauth->get_user()->roleid < 5) {

            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $data['message'] = false;
        $data['corn'] = $this->cronjob->config();
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Cron Job Panel';
        $this->load->view('fixed/header', $head);
        $this->load->view('cronjob/info', $data);
        $this->load->view('fixed/footer');
    }

    public function generate()
    {
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
            if ($this->aauth->get_user()->roleid < 5) {

                exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
            }
        }

        if ($this->cronjob->generate()) {

            $data['message'] = true;

            $data['corn'] = $this->cronjob->config();
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Generate New Key';
            $this->load->view('fixed/header', $head);
            $this->load->view('cronjob/info', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function due_invoices_email()
    {

        $corn = $this->cronjob->config();
        $this->load->library('parser');

        $cornkey = $corn['cornkey'];

        echo "---------------Cron job for due invoices-------\n";

        if ($cornkey == $this->input->get('token')) {
            $i = 1;

            $emails = $this->cronjob->due_mail();
            $this->load->model('templates_model', 'templates');
            $template = $this->templates->template_info(7);

            $this->load->model('communication_model', 'communication');

            foreach ($emails as $invoice) {

                $validtoken = hash_hmac('ripemd160', $invoice['id'], $this->config->item('encryption_key'));

                $link = base_url('billing/view?id=' . $invoice['id'] . '&token=' . $validtoken);

                $loc = location($invoice['loc']);

                $data = array(
                    'Company' => $loc['cname'],
                    'BillNumber' => $invoice['tid'],
                );
                $subject = $this->parser->parse_string($template['key1'], $data, true);

                $data = array(
                    'Company' => $loc['cname'],
                    'BillNumber' => $invoice['tid'],
                    'URL' => "<a href='$link'>$link</a>",
                    'CompanyDetails' => '<h6><strong>' . $loc['cname'] . ',</strong></h6>
<address>' . $loc['address'] . '<br>' . $loc['city'] . ', ' . $loc['country'] . '</address>
            Phone: ' . $loc['phone'] . '<br> Email: ' . $loc['email'],
                    'DueDate' => dateformat($invoice['invoiceduedate']),
                    'Amount' => amountExchange($invoice['total'], $invoice['multi']),
                );
                $message = $this->parser->parse_string($template['other'], $data, true);

                if ($this->communication->send_corn_email($invoice['email'], $invoice['name'], $subject, $message)) {
                    echo "---------------$i. Email Sent! -------------------------\n";
                } else {

                    echo "---------------$i. Error! -------------------------\n";
                }

                $i++;
            }
        } else {

            echo "---------------Error! Invalid Token! -------------------------\n";
        }
    }

    public function reminder_new()
    {

        $this->load->model('employee_model', 'employee');
        $schedulers = $this->employee->getschedulerAllList();

        // echo "<pre>"; print_r($schedulers); echo "</pre>";
        // exit;
        if (!empty($schedulers)) {
            foreach ($schedulers as $schedular) {

                $this->load->helper('date');
                $hours = $schedular['hours'];
                $minutes = $schedular['minutes'];
                $current_date = date('Y-m-d');
                $currentTimeAfterAddition = "$current_date $hours:$minutes:00";
                $currentDateTime = date('Y-m-d H:i').":00";
                
                //echo "<br>".$currentTimeAfterAddition."<br>".$currentDateTime;
                
                if ($currentDateTime === $currentTimeAfterAddition) {
                    $schedular_status = true;
                } else {
                    $schedular_status = false; 
                }

                if($schedular_status){

                    //echo $schedular['id']."<br>";

                // $schedular_sub_modules = explode(',', $schedular['sub_module_names']);

                // if (!empty($schedular_sub_modules)) {
                //     foreach ($schedular_sub_modules as $schedular_sub_module) {
                //         if ($schedular_sub_module == 'permit') {
                //             $data = $this->check_permit_expiry($schedular);

                //             echo "<pre>";
                //             print_r($data);
                //             echo "</pre>";

                //         } else if ($schedular_sub_module == 'passport') {

                //             $data = $this->check_passport_expiry($schedular);

                //             echo "<pre>";
                //             print_r($data);
                //             echo "</pre>";
                //         } else if ($schedular_sub_module == 'contract_reminder') {

                //             $data = $this->check_contract_expiry($schedular);

                //             echo "<pre>";
                //             print_r($data);
                //             echo "</pre>";
                //         } else if ($schedular_sub_module == 'late_attendance_list') {

                //             $data = $this->check_late_attendance($schedular);

                //             echo "<pre>";
                //             print_r($data);
                //             echo "</pre>";
                //         }
                //     }
                // }
                }
            }
        }
    }

    public function check_passport_expiry($schedular)
    {
        $this->db->select('e.*, c.name AS cus_name, c.email AS cus_email');
        $this->db->from('gtg_employees AS e');
        $this->db->join('gtg_customers AS c', 'e.company = c.id', 'inner');
        $this->db->where('e.employee_type', 'foreign');
        $this->db->where('e.delete_status', 0);

        $days = $schedular['days'];
        // Calculate the date 30 days from today
        $days_from_now = date('Y-m-d', strtotime('+' . $days . ' days'));

        // Add a condition for "passport_expiry" within 30 days from today
        $this->db->where('e.passport_expiry =', $days_from_now);

        $query = $this->db->get();
        //echo "<br>".$this->db->last_query();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        } else {
            $result = array(); // No matching records found
        }

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        //exit;

        if(!empty($result))
        {
            $email_authors = explode(",", $schedular['email_to']);
            
            if(!empty($email_authors))
            {
                $organization = $this->employee->getOrganizationDetails();

                if (in_array("1", $email_authors)) {

                    $adminemail = $organization->email;
                    $elements = array();
                    $content = '';
                    $subject = "List of Employees PassPort Expiry in Next ".$schedular['days']." Days";

                    $table = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Passport</th><th>Expiry Date</th><th>Remaining Date</th></tr>';
                    foreach ($result as $exppassport) {
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
                        $subject = "List of Employees PassPort Expiry in Next ".$schedular['days']." Days";
                        $table .= '<tr><td>' . $name . '</td><td>' . $cus_name . '</td><td>' . $passport . '</td><td>' . $passport_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                    }
                    $table .= "</table>";

                    $message = '<!DOCTYPE html>
                    <html>
                    <head>
                    </head>
                    <body>
                        <div class="container" style="max-width: 600px; margin: 0 auto; background-color: #f5f5f5;">
                            <div class="header" style="background-color: #0073e6; padding: 20px; text-align: center;">
                                <h1 style="color: #fff; font-size: 28px;">Passport Expiry Information</h1>
                            </div>
                            <div class="subheading" style="background-color: #f2f2f2; padding: 10px; text-align: center;">
                                <h2 style="color: #333; font-size: 22px; margin: 0;">'.$subject.'</h2>
                            </div>
                            <div class="content" style="padding: 20px; background-color: #fff; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                <p style="font-size: 16px; color: #555; line-height: 1.5;">Dear Admin,</p>
                                <p style="font-size: 16px; color: #555; line-height: 1.5;">Here is some important information regarding your passport:</p>
                                <p style="font-size: 16px; color: #555; line-height: 1.5;">Description: List of Employees Passport Expiry Details.</p>
                                '.$table.'
                                <p style="font-size: 16px; color: #555; line-height: 1.5;">If you have any questions or need further assistance, please feel free to contact us.</p>
                                <p class="signature" style="font-size: 14px; color: #777; margin-top: 20px;">Best regards,</p>
                            </div>
                        </div>
                    </body>
                    </html>';

                    // echo $message;
                    // exit;

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
                        // foreach ($exppassportlist as $exppassport) {
                        //     $data = array(
                        //         'passport_email_sent' => 1,
                        //     );
                        //     $this->db->set($data);
                        //     $this->db->where('id', $exppassport['id']);
                        //     $this->db->update('gtg_employees');
                        // }
                    }
                }
    
                if (in_array("2", $email_authors)) {
                        
                        $elements = array();
                        $content = '';                    
                        $subject = "List of Employees PassPort Expiry in Next ".$schedular['days']." Days";

                        $table = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Passport</th><th>Expiry Date</th><th>Remaining Date</th></tr>';
                        //$employeeidarray = array();
                        $exppassport = array();
                        foreach ($result as $exppassport) {
                            //do something
                            $client_email = $exppassport['cus_email'];
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
                            $subject = "List of Employees PassPort Expiry in Next ".$schedular['days']." Days";
                            $table .= '<tr><td>' . $name . '</td><td>' . $cus_name . '</td><td>' . $passport . '</td><td>' . $passport_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                        }
                        $table .= "</table>";

                        $message = '<!DOCTYPE html>
                        <html>
                        <head>
                        </head>
                        <body>
                            <div class="container" style="max-width: 600px; margin: 0 auto; background-color: #f5f5f5;">
                                <div class="header" style="background-color: #0073e6; padding: 20px; text-align: center;">
                                    <h1 style="color: #fff; font-size: 28px;">Passport Expiry Information</h1>
                                </div>
                                <div class="subheading" style="background-color: #f2f2f2; padding: 10px; text-align: center;">
                                    <h2 style="color: #333; font-size: 22px; margin: 0;">'.$subject.'</h2>
                                </div>
                                <div class="content" style="padding: 20px; background-color: #fff; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">Dear Customer,</p>
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">Here is some important information regarding your passport:</p>
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">Description: List of Employees Passport Expiry Details.</p>
                                    '.$table.'
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">If you have any questions or need further assistance, please feel free to contact us.</p>
                                    <p class="signature" style="font-size: 14px; color: #777; margin-top: 20px;">Best regards,</p>
                                </div>
                            </div>
                        </body>
                        </html>';

                    
                    // echo $message;
                    // exit;
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
                            // foreach ($exppassportlist as $exppassport) {
                            //     $data = array(
                            //         'passport_email_sent' => 1,
                            //     );
                            //     $this->db->set($data);
                            //     $this->db->where('id', $exppassport['id']);
                            //     $this->db->update('gtg_employees');
                            // }
                        }

                }
    
                if (in_array("3", $email_authors)) {

                    $elements = array();
                    $content = '';

                    foreach ($result as $exppassport) {
                        //do something
                        $passportemail = $exppassport['email'];
                        $id = $exppassport['id'];
                        $name = $exppassport['name'];
                        $passport = $exppassport['passport'];
                        $passport_expiry = $exppassport['passport_expiry'];
                        $subject = "Passport Renewal Reminder";
                        $content = '<!DOCTYPE html>
                        <html>
                        <head>
                        </head>
                        <body>
                            <div class="container" style="max-width: 600px; margin: 0 auto; background-color: #f5f5f5;">
                                <div class="header" style="background-color: #0073e6; padding: 20px; text-align: center;">
                                    <h1 style="color: #fff; font-size: 28px;">Your Passport Information</h1>
                                </div>
                                <div class="subheading" style="background-color: #f2f2f2; padding: 10px; text-align: center;">
                                    <h2>'.$subject.'</h2>
                                </div>
                                <div class="content" style="padding: 20px; background-color: #fff; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">Dear Employee '.$name.',</p>
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">We are reaching out to you regarding the expiry of your passport with Passport No '.$passport.' on '.date("d-m-Y", strtotime($passport_expiry)).'.</p>
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">Kindly proceed with the renewal process.</p>
                                    <br>
                                    <br>
                                    
                                    <p style="font-size: 16px; color: #555;">Thank you and regards,</p>
                                    <p style="font-size: 16px; color: #555;">'.$organization->cname.'</p>
                                    <p style="font-size: 16px; color: #555;">'.$organization->address.'</p>
                                    <p style="font-size: 16px; color: #555;">'.$organization->city.'</p>
                                    <p style="font-size: 16px; color: #555;">'.$organization->region.'</p>
                                    <p style="font-size: 16px; color: #555;">'.$organization->country.'</p>
                                    <p style="font-size: 16px; color: #555;">Phone : '.$organization->phone.'</p>
                                    <p style="font-size: 16px; color: #555;">Email : support@jsoftsolution.com.my</p>
                                </div>
                            </div>
                        </body>
                        </html>';

                        
                    // echo $message;
                    // exit;
                        $mailto = $passportemail;
                        $mailtotitle = "";
                        
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
                            // $data = array(
                            //     'passport_email_sent' => 1,
                            // );
                            // $this->db->set($data);
                            // $this->db->where('id', $id);
                            // $this->db->update('gtg_employees');
                        }

                    }
                }
    
            }           

        }
    }

    public function check_permit_expiry($schedular)
    {
        $this->db->select('e.*, c.name AS cus_name, c.email AS cus_email');
        $this->db->from('gtg_employees AS e');
        $this->db->join('gtg_customers AS c', 'e.company = c.id', 'inner');
        $this->db->where('e.employee_type', 'foreign');
        $this->db->where('e.delete_status', 0);

        $days = $schedular['days'];
        // Calculate the date 30 days from today
        $days_from_now = date('Y-m-d', strtotime('+' . $days . ' days'));

        // Add a condition for "passport_expiry" within 30 days from today
        $this->db->where('e.permit_expiry =', $days_from_now);

        $query = $this->db->get();
        //echo "<br>".$this->db->last_query();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        } else {
            $result = array(); // No matching records found
        }

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        //exit;

        if(!empty($result))
        {
            $email_authors = explode(",", $schedular['email_to']);
            
            if(!empty($email_authors))
            {
                $organization = $this->employee->getOrganizationDetails();

                if (in_array("1", $email_authors)) {

                    $adminemail = $organization->email;
                    $elements = array();
                    $content1 = '';
                    $subject1 = "List of Employees Permit Expiry in Next ".$schedular['days']." Days";


                    $permit_table = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Permit</th><th>Expiry Date</th><th>Remaining Date</th></tr>';
                    $exppermit = array();
                    foreach ($result as $exppermit) {
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
                        $permit_table .= '<tr><td>' . $permitname . '</td><td>' . $cus_name . '</td><td>' . $permit . '</td><td>' . $permit_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                    }
                    $permit_table .= "</table>";


                    $permitmessage = '<!DOCTYPE html>
                    <html>
                    <head>
                    </head>
                    <body>
                        <div class="container" style="max-width: 600px; margin: 0 auto; background-color: #f5f5f5;">
                            <div class="header" style="background-color: #0073e6; padding: 20px; text-align: center;">
                                <h1 style="color: #fff; font-size: 28px;">Permit Expiry Information</h1>
                            </div>
                            <div class="subheading" style="background-color: #f2f2f2; padding: 10px; text-align: center;">
                                <h2 style="color: #333; font-size: 22px; margin: 0;">'.$subject1.'</h2>
                            </div>
                            <div class="content" style="padding: 20px; background-color: #fff; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                <p style="font-size: 16px; color: #555; line-height: 1.5;">Dear Admin,</p>
                                <p style="font-size: 16px; color: #555; line-height: 1.5;">Here is some important information regarding your permit:</p>
                                <p style="font-size: 16px; color: #555; line-height: 1.5;">Description: List of Employees Permit Expiry Details.</p>
                                '.$permit_table.'
                                <p style="font-size: 16px; color: #555; line-height: 1.5;">If you have any questions or need further assistance, please feel free to contact us.</p>
                                <p class="signature" style="font-size: 14px; color: #777; margin-top: 20px;">Best regards,</p>
                            </div>
                        </div>
                    </body>
                    </html>';


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
                    $mailto1 = $adminemail;
                    //$subject1 = "Permit Reminder";
                    $mailer1 = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto1, $mailtotitle, $subject1, $permitmessage, $attachmenttrue, '');

                    if ($mailer1) {
                        // foreach ($exppermitlist as $exppermit) {
                        //     $data = array(
                        //         'permit_email_sent' => 1,
                        //     );
                        //     $this->db->set($data);
                        //     $this->db->where('id', $exppermit['id']);
                        //     $this->db->update('gtg_employees');
                        // }
                    }

                }
    
                if (in_array("2", $email_authors)) {

                        $elements = array();
                        $content = ''; 
                        //$employeeidarray = array();
                        $exppermit = array();
                        $subject1 = "List of Employees Permit Expiry in Next ".$schedular['days']." Days";

                        $permit_table = '<table border=1><tr><th>Name</th><th>Company Name</th><th>Permit</th><th>Expiry Date</th><th>Remaining Date</th></tr>';

                        foreach ($result as $exppermit) {
                            //do something
                            $client_email = $exppermit['cus_email'];
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
                            $permit_table .= '<tr><td>' . $permitname . '</td><td>' . $cus_name . '</td><td>' . $permit . '</td><td>' . $permit_expiry . '</td><td>' . $remainingdate . '</td></tr>';

                        }
                        $permit_table .= "</table>";

                        $permitmessage = '<!DOCTYPE html>
                        <html>
                        <head>
                        </head>
                        <body>
                            <div class="container" style="max-width: 600px; margin: 0 auto; background-color: #f5f5f5;">
                                <div class="header" style="background-color: #0073e6; padding: 20px; text-align: center;">
                                    <h1 style="color: #fff; font-size: 28px;">Permit Expiry Information</h1>
                                </div>
                                <div class="subheading" style="background-color: #f2f2f2; padding: 10px; text-align: center;">
                                    <h2 style="color: #333; font-size: 22px; margin: 0;">'.$subject1.'</h2>
                                </div>
                                <div class="content" style="padding: 20px; background-color: #fff; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">Dear Customer,</p>
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">Here is some important information regarding your permit:</p>
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">Description: List of Employees Permit Expiry Details.</p>
                                    '.$permit_table.'
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">If you have any questions or need further assistance, please feel free to contact us.</p>
                                    <p class="signature" style="font-size: 14px; color: #777; margin-top: 20px;">Best regards,</p>
                                </div>
                            </div>
                        </body>
                        </html>';


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
                        //$subject1 = "Permit Reminder";
                        $mailer1 = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto1, $mailtotitle, $subject1, $permitmessage, $attachmenttrue, '');

                        if ($mailer1) {
                            // foreach ($exppermitlist as $exppermit) {
                            //     $data = array(
                            //         'permit_email_sent' => 1,
                            //     );
                            //     $this->db->set($data);
                            //     $this->db->where('id', $exppermit['id']);
                            //     $this->db->update('gtg_employees');
                            // }
                        }
                 
                }
    
                if (in_array("3", $email_authors)) {

                    $elements = array();
                    $content1 = '';
                    $exppermit = array();
                    foreach ($result as $exppermit) {
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
                        $subject1 = "Permit Renewal Reminder";
                        $content1 = '<!DOCTYPE html>
                        <html>
                        <head>
                        </head>
                        <body>
                            <div class="container" style="max-width: 600px; margin: 0 auto; background-color: #f5f5f5;">
                                <div class="header" style="background-color: #0073e6; padding: 20px; text-align: center;">
                                    <h1 style="color: #fff; font-size: 28px;">Your Permit Information</h1>
                                </div>
                                <div class="subheading" style="background-color: #f2f2f2; padding: 10px; text-align: center;">
                                    <h2>'.$subject1.'</h2>
                                </div>
                                <div class="content" style="padding: 20px; background-color: #fff; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">Dear Employee '.$permitname.',</p>
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">We are reaching out to you regarding the expiry of your permit with permit No '.$permit.' on '.date("d-m-Y", strtotime($permit_expiry)).'.</p>
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">Kindly proceed with the renewal process.</p>
                                    <br>
                                    <br>
                                    
                                    <p style="font-size: 16px; color: #555;">Thank you and regards,</p>
                                    <p style="font-size: 16px; color: #555;">'.$organization->cname.'</p>
                                    <p style="font-size: 16px; color: #555;">'.$organization->address.'</p>
                                    <p style="font-size: 16px; color: #555;">'.$organization->city.'</p>
                                    <p style="font-size: 16px; color: #555;">'.$organization->region.'</p>
                                    <p style="font-size: 16px; color: #555;">'.$organization->country.'</p>
                                    <p style="font-size: 16px; color: #555;">Phone : '.$organization->phone.'</p>
                                    <p style="font-size: 16px; color: #555;">Email : support@jsoftsolution.com.my</p>
                                </div>
                            </div>
                        </body>
                        </html>';

                        $mailtotitle = "";

                        $attachmenttrue = "true";
                        $mailto1 = $permitemail;
                        
                        $message1 = $content1;
                        $mailer1 = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto1, $mailtotitle, $subject1, $message1, $attachmenttrue, '');

                        if ($mailer1) {
                            // $data = array(
                            //     'permit_email_sent' => 1,
                            // );
                            // $this->db->set($data);
                            // $this->db->where('id', $id);
                            // $this->db->update('gtg_employees');
                        }
                    }
                }
    
            }           

        }
    }

    public function check_contract_expiry($schedular)
    {
        $this->db->select('*');
        $this->db->from('gtg_contract');
        $this->db->where('status !=','COMPLETED');

        $days = $schedular['days'];
        // Calculate the date 30 days from today
        $days_from_now = date('Y-m-d', strtotime('+' . $days . ' days'));

        // Add a condition for "passport_expiry" within 30 days from today
        $this->db->where('reminder_date =', $days_from_now);

        $query = $this->db->get();
        //echo "<br>".$this->db->last_query();

        if ($query->num_rows() > 0) {
            $result = $query->result_array();
        } else {
            $result = array(); // No matching records found
        }

        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // exit;

        if(!empty($result))
        {

            foreach($result as $result_contract)
            {
            $email_authors = explode(",", $schedular['email_to']);
            
            if(!empty($email_authors))
            {
                $organization = $this->employee->getOrganizationDetails();

                if (in_array("1", $email_authors)) {

                    $adminemail = $organization->email;
                    $mailto = $adminemail;
                    $elements = array();
                    $content = '';
                    $subject = "Your contract is set to end on " . date('d-m-Y', strtotime($result_contract['end_date'])) . ". Please contact the administrator.";
                    $mailtotitle = "";
                    $table = '<table border=1><tr><th>Contract Name</th><th>Client Name</th><th>Start Date</th><th>End Date</th></tr>';
                    $table .= '<tr><td>' . $result_contract['name'] . '</td><td>' . $result_contract['client_name'] . '</td><td>' . date('d-m-Y',strtotime($result_contract['start_date'])) . '</td><td>' . date('d-m-Y',strtotime($result_contract['end_date'])) . '</td></tr>';
                    $table .= "</table>";

                    $message = '<!DOCTYPE html>
                    <html>
                    <head>
                    </head>
                    <body>
                        <div class="container" style="max-width: 600px; margin: 0 auto; background-color: #f5f5f5;">
                            <div class="header" style="background-color: #0073e6; padding: 20px; text-align: center;">
                                <h1 style="color: #fff; font-size: 28px;">Contract Details</h1>
                            </div>
                            <div class="subheading" style="background-color: #f2f2f2; padding: 10px; text-align: center;">
                                <h2 style="color: #333; font-size: 22px; margin: 0;">'.$subject.'</h2>
                            </div>
                            <div class="content" style="padding: 20px; background-color: #fff; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                <p style="font-size: 16px; color: #555; line-height: 1.5;">Dear Admin,</p>
                                <p style="font-size: 16px; color: #555; line-height: 1.5;">Here is The Contract Reminder Details:</p>
                                '.$table.'
                                <p style="font-size: 16px; color: #555; line-height: 1.5;">If you have any questions or need further assistance, please feel free to contact us.</p>
                                <p class="signature" style="font-size: 14px; color: #777; margin-top: 20px;">Best regards,</p>
                            </div>
                        </div>
                    </body>
                    </html>';

                    //echo $message;
                    //exit;

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
                        // foreach ($exppassportlist as $exppassport) {
                        //     $data = array(
                        //         'passport_email_sent' => 1,
                        //     );
                        //     $this->db->set($data);
                        //     $this->db->where('id', $exppassport['id']);
                        //     $this->db->update('gtg_employees');
                        // }
                    }
                }
    
                if (in_array("2", $email_authors)) {
                        
                        $elements = array();
                        $content = '';
                        $subject = "Your contract is set to end on " . date('d-m-Y', strtotime($result_contract['end_date'])) . ". Please contact the administrator.";
                        $mailtotitle = "";
                        $table = '<table border=1><tr><th>Contract Name</th><th>Client Name</th><th>Start Date</th><th>End Date</th></tr>';
                        $table .= '<tr><td>' . $result_contract['name'] . '</td><td>' . $result_contract['client_name'] . '</td><td>' . date('d-m-Y',strtotime($result_contract['start_date'])) . '</td><td>' . date('d-m-Y',strtotime($result_contract['end_date'])) . '</td></tr>';
                        $table .= "</table>";
                        $mailto = $result_contract['email'];
                        $message = '<!DOCTYPE html>
                        <html>
                        <head>
                        </head>
                        <body>
                            <div class="container" style="max-width: 600px; margin: 0 auto; background-color: #f5f5f5;">
                                <div class="header" style="background-color: #0073e6; padding: 20px; text-align: center;">
                                    <h1 style="color: #fff; font-size: 28px;">Contract Details</h1>
                                </div>
                                <div class="subheading" style="background-color: #f2f2f2; padding: 10px; text-align: center;">
                                    <h2 style="color: #333; font-size: 22px; margin: 0;">'.$subject.'</h2>
                                </div>
                                <div class="content" style="padding: 20px; background-color: #fff; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">Dear Customer,</p>
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">Here is The Contract Reminder Details:</p>
                                    '.$table.'
                                    <p style="font-size: 16px; color: #555; line-height: 1.5;">If you have any questions or need further assistance, please feel free to contact us.</p>
                                    <p class="signature" style="font-size: 14px; color: #777; margin-top: 20px;">Best regards,</p>
                                </div>
                            </div>
                        </body>
                        </html>';

                    
                    // echo $message;
                    // exit;
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
                            // foreach ($exppassportlist as $exppassport) {
                            //     $data = array(
                            //         'passport_email_sent' => 1,
                            //     );
                            //     $this->db->set($data);
                            //     $this->db->where('id', $exppassport['id']);
                            //     $this->db->update('gtg_employees');
                            // }
                        }

                }
    
               
            } 
            }          

        }
    }

    public function check_late_attendance($schedular)
    {
        $this->db->select('gtg_attendance.*, gtg_employees.name');
        $this->db->from('gtg_attendance');
        $this->db->join('gtg_employees', 'gtg_employees.id = gtg_attendance.emp', 'left');
        $this->db->where('adate', date('Y-m-d'));
        $this->db->group_by('gtg_attendance.emp');
        $this->db->order_by('gtg_attendance.id', 'ASC'); // Assuming id is the primary key column
        $attendance_list = $this->db->get()->result_array();
       // $result = $this->db->result_array();

        $att_settings = $this->db->get('gtg_attendance_settings')->row_array();
       
        if(!empty($att_settings))
        {
            $clock_in_grace_period = $att_settings['clock_in_grace_period'];
            $clock_in_time = $att_settings['clock_in_time'];
            
           
        }else{
            
            $clock_in_grace_period = 0;
            $clock_in_time = '00:00:00';
        }

        // echo "<pre>"; print_r($attendance_list); echo "</pre>";
        //exit;

        
        if(!empty($attendance_list))
        {

            foreach($attendance_list as $att_result)
            {

                $data1 = array();
                $data2 = array();
                $data['clock_in'] = $att_result['tfrom'];
                $data['ofc_clock_in'] = date('H:i:s', strtotime($clock_in_time));

                $clockInTime = strtotime($data['clock_in']);
                $ofcClockInTime = strtotime($data['ofc_clock_in']);
                $ofcClockInTimeGrace = strtotime("+$clock_in_grace_period minutes", $ofcClockInTime);

                // Check if clock_in is less than ofc_clock_in
                if ($clockInTime > $ofcClockInTimeGrace) {
                   
                    $diffInSeconds = $clockInTime - $ofcClockInTimeGrace;

                    // Calculate the difference in hours and minutes
                    $diffInHours = floor($diffInSeconds / 3600);
                    $diffInMinutes = floor(($diffInSeconds % 3600) / 60);

                    // Convert to hours and minutes format if the difference is greater than 60 minutes
                    if ($diffInHours > 0) {
                        $diffFormatted = $diffInHours . ' hours ' . $diffInMinutes . ' minutes';
                    } else {
                        $diffFormatted = $diffInMinutes . ' minutes';
                    }
                    
                    $data1['date'] = date('d-m-Y');
                    $data1['name'] = $att_result['name'];
                    $data1['late_by_minutes'] = $diffFormatted;
                    $n_data[] = $data1;

                }


                if(!$att_result['clock_in_radius'])
                {
                    $data2['date'] = date('d-m-Y');
                    $data2['name'] = $att_result['name'];
                    $data2['distance'] = intval($att_result['clock_in_distance']);
                    $n_data2[] = $data2;
                }

                
            }
        
            // echo "<pre>"; print_r($n_data); echo "</pre>";
            // exit;

            $email_authors = explode(",", $schedular['email_to']);
            
            if(!empty($email_authors))
            {
                $organization = $this->employee->getOrganizationDetails();

                if (in_array("1", $email_authors)) {

                    $adminemail = $organization->email;
                    $mailto = $adminemail;
                    $elements = array();
                    $content = '';
                    $subject = "The Late Commerce on " . date('d-m-Y') . ". Please refer the List Below.";
                    $mailtotitle = "";
                    $table = '<table border=1><tr><th>Date</th><th>Employee Name</th><th>Late By Minutes</th></tr>';
                    if(!empty($n_data)){  foreach($n_data as $nd) { 
                    $table .= '<tr><td>' . $nd['date'] . '</td><td>' . $nd['name'] . '</td><td>' . $nd['late_by_minutes'] . '</td></tr>';
                   
                    } } 
                   
                    $table .= "</table>";

                    $table2 = '<table border=1><tr><th>Date</th><th>Employee Name</th><th>Late By Minutes</th></tr>';
                    if(!empty($n_data2)){  foreach($n_data2 as $nd2) { 
                    $table2 .= '<tr><td>' . $nd2['date'] . '</td><td>' . $nd2['name'] . '</td><td>' . $nd2['distance'] . '</td></tr>';
                   
                    } } 
                   
                    $table2 .= "</table>";

                    $message = '<!DOCTYPE html>
                    <html>
                    <head>
                    </head>
                    <body>
                        <div class="container" style="max-width: 600px; margin: 0 auto; background-color: #f5f5f5;">
                            <div class="header" style="background-color: #0073e6; padding: 20px; text-align: center;">
                                <h1 style="color: #fff; font-size: 28px;">Employee Late Attendance Details</h1>
                            </div>
                            <div class="subheading" style="background-color: #f2f2f2; padding: 10px; text-align: center;">
                                <h2 style="color: #333; font-size: 22px; margin: 0;">'.$subject.'</h2>
                            </div>
                            <div class="content" style="padding: 20px; background-color: #fff; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                                <p style="font-size: 16px; color: #555; line-height: 1.5;">Dear Admin,</p>
                                <p style="font-size: 16px; color: #555; line-height: 1.5;">Here is The Employee Late Attendance By Date List Details:</p>
                                '.$table.'
                                <br><br><p style="font-size: 16px; color: #555; line-height: 1.5;">Here is The Employee Login Out Of The Office Zone By Date List Details:</p>
                                '.$table2.'
                                <p style="font-size: 16px; color: #555; line-height: 1.5;">If you have any questions or need further assistance, please feel free to contact us.</p>
                                <p class="signature" style="font-size: 14px; color: #777; margin-top: 20px;">Best regards,</p>
                            </div>
                        </div>
                    </body>
                    </html>';

                    // echo $message;
                    // exit;

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
                        // foreach ($exppassportlist as $exppassport) {
                        //     $data = array(
                        //         'passport_email_sent' => 1,
                        //     );
                        //     $this->db->set($data);
                        //     $this->db->where('id', $exppassport['id']);
                        //     $this->db->update('gtg_employees');
                        // }
                    }
                }
    
              
               
            } 
          
        }
    }
    public function reminder()
    {

        $this->load->model('employee_model', 'employee');

        $exppassportlist = $this->employee->getpassportExpiryList();
        //print_r($exppassportlist);
        $exppassportlistsixty = $this->employee->getpassportExpiryListSixty();
        /// $exppassportlistninenty = $this->employee->getpassportExpiryListNinenty();

        $exppermitlist = $this->employee->getpermitExpiryList();
        $exppermitlistsixty = $this->employee->getpermitExpiryListSixty();
        /// $exppermitlistninenty = $this->employee->getpermitExpiryListNinenty();

        $schedulefor = $this->employee->getschedulerList();

        echo "<pre>"; print_r($schedulefor); echo "</pre>";
        exit;
        $explode = explode(",", $schedulefor->scheduler_on);

        $passport = $explode[0];
        if (count($explode) > 1) {
            $permit = $explode[1];
        } else {
            $permit = '';

        }
        $emailist = $this->employee->getEmailToSend();
        $explodevariable = explode(",", $emailist->email_to);

        $organization = $this->employee->getOrganizationDetails();

        if (in_array("1", $explodevariable)) {

            // $orgId = $_SESSION['loggedin'];
            // $this->load->model('payroll_model', 'payroll');
            $organization = $this->employee->getOrganizationDetails();

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
                        $subject = "List of Employee Expiry Between 16 months";
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
                        $subject = "List of Employee Expiry Between 17-19 months";
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
            $subject="List of Employee Expiry Between 61-90 days";
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
                    $mailto1 = $adminemail;
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
                        $permit_expiry = $exppermitsixty['permit_expiry'];
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
                    $mailto1 = $adminemail;
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

                    foreach ($exppermitlistninenty as $expninenty) {
                        //do something
                        $permitemail = $expninenty['email'];
                        $id = $expninenty['id'];
                        $permitname = $expninenty['name'];
                        $cus_name = $expninenty['cus_name'];

                        $permit = $expninenty['permit'];
                        $permit_expiry = $expninenty['permit_expiry'];
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
                    $mailto1 = $adminemail;
                    $subject1 = "Permit Reminder";
                    $mailer1 = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto1, $mailtotitle, $subject1, $permitmessage, $attachmenttrue, '');

                    if ($mailer1) {
                        foreach ($exppermitlistninenty as $expninenty) {
                            {
                                $data = array(
                                    'permit_email_sent' => 1,
                                );
                                $this->db->set($data);
                                $this->db->where('id', $expninenty['id']);
                                $this->db->update('gtg_employees');
                            }
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
                            $subject = "List of Employee Expiry Between 61-90 days";
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
	<p>We are reaching out you in regard to the expiry of your passport with the Passport No ' . $passport . ' on ' . date("d-m-Y", strtotime($passport_expiry)) . '</p>
	<p>Kindly proceed for the renewal process. </p></br>
	</br>

Thank you and regards.

<p>
' . $organization->cname . ',</p>
<p>' . $organization->address . ',</br></p>
<p>' . $organization->city . ',</br></p>
<p>' . $organization->region . ',</br></p>
<p>' . $organization->country . ',</br></p>
<p>Phone : ' . $organization->phone . ',</p>
<p>Email : support@jsoftsolution.com.my.</p>';
                        $mailto = $passportemail;
                        $mailtotitle = "";
                        $subject = "Passport Renewal Reminder";
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

                if (!empty($exppassportlistsixty)) {
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

                        $content = '<p>Dear Employee ' . $name . '</p>
	<p>We are reaching out you in regard to the expiry of your passport with the Passport No ' . $passport . ' on ' . date("d-m-Y", strtotime($passport_expiry)) . '</p>
	<p>Kindly proceed for the renewal process. </p></br>
	</br>

Thank you and regards.
<p>
' . $organization->cname . ',</p>
<p>' . $organization->address . ',</br></p>
<p>' . $organization->city . ',</br></p>
<p>' . $organization->region . ',</br></p>
<p>' . $organization->country . ',</br></p>
<p>Phone : ' . $organization->phone . ',</p>
<p>Email : support@jsoftsolution.com.my.</p>';
                        $mailto = $passportemail;
                        $mailtotitle = "";
                        $subject = "Passport Renewal Reminder";
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
            $content='<p>Dear Employee '.$name.'</p>
            <p>We are reaching out you in regard to the expiry of your passport with the Passport No '.$passport.' on '.date("d-m-Y",strtotime($passport_expiry)).'</p>
            <p>Kindly proceed for the renewal process. </p></br>
            </br>

            Thank you and regards.

            <p>
            JSOFT SOLUTION SDN BHD,</p>
            <p>16-03-C</br></p>
            <p>Phone : +0374956282</p>
            <p>Email : support@jsoftsolution.com.my</p>';
            $mailto=$passportemail;
            $mailtotitle="";
            $subject="90 Days  Passport Reminder";
            $message=$content;
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
            $data = array(
            'passport_email_sent' =>1
            );
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('gtg_employees');
            }

            }

            }
             */

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
' . $organization->cname . ',</p>
<p>' . $organization->address . ',</br></p>
<p>' . $organization->city . ',</br></p>
<p>' . $organization->region . ',</br></p>
<p>' . $organization->country . ',</br></p>
<p>Phone : ' . $organization->phone . ',</p>
<p>Email : support@jsoftsolution.com.my.</p>';
                        $mailtotitle = "";

                        $attachmenttrue = "true";
                        $mailto1 = $permitemail;
                        $subject1 = "Permit Renewal Reminder";
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

                if (!empty($exppermitlistsixty)) {
                    foreach ($exppermitlistsixty as $exppermitsixty) {
                        //do something
                        $permitemail = $exppermitsixty['email'];
                        $id = $exppermitsixty['id'];
                        $permitname = $exppermitsixty['name'];
                        $cus_name = $exppermitsixty['cus_name'];

                        $permit = $exppermitsixty['permit'];
                        $permit_expiry = $exppermitsixty['permit_expiry'];
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
' . $organization->cname . ',</p>
<p>' . $organization->address . ',</br></p>
<p>' . $organization->city . ',</br></p>
<p>' . $organization->region . ',</br></p>
<p>' . $organization->country . ',</br></p>
<p>Phone : ' . $organization->phone . ',</p>
<p>Email : support@jsoftsolution.com.my.</p>';
                        $mailtotitle = "";

                        $attachmenttrue = "true";
                        $mailto1 = $permitemail;
                        $subject1 = "Permit Renewal Reminder";
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

                if (!empty($exppermitlistninenty)) {
                    foreach ($exppermitlistninenty as $expninenty) {
                        //do something
                        $permitemail = $expninenty['email'];
                        $id = $expninenty['id'];
                        $permitname = $expninenty['name'];
                        $cus_name = $expninenty['cus_name'];

                        $permit = $expninenty['permit'];
                        $permit_expiry = $expninenty['permit_expiry'];
                        $currentdate = date("Y-m-d");
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
' . $organization->cname . ',</p>
<p>' . $organization->address . ',</br></p>
<p>' . $organization->city . ',</br></p>
<p>' . $organization->region . ',</br></p>
<p>' . $organization->country . ',</br></p>
<p>Phone : ' . $organization->phone . ',</p>
<p>Email : support@jsoftsolution.com.my.</p>';
                        $mailtotitle = "";

                        $attachmenttrue = "true";
                        $mailto1 = $permitemail;
                        $subject1 = "Permit Renewal Reminder";
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

    public function reports()
    {

        $corn = $this->cronjob->config();

        $cornkey = $corn['cornkey'];

        echo "---------------Updating Reports-------\n";

        if ($cornkey == $this->input->get('token')) {

            echo "---------------Cron started-------\n";

            $this->cronjob->reports();

            echo "---------------Task Done-------\n";
        }
    }

    public function update_exchange_rate()
    {

        $corn = $this->cronjob->config();

        $cornkey = $corn['cornkey'];

        echo "---------------Updating Exchange Rates-------\n";
        if ($cornkey == $this->input->get('token')) {

            echo "---------------Cron started-------\n";
            $this->load->model('plugins_model', 'plugins');
            $exchange = $this->plugins->universal_api(5);
            if ($exchange['active']) {
                $endpoint = $exchange['key2'];
                $access_key = $exchange['key1'];
                $base = $exchange['url'];

                $ch = curl_init('http://apilayer.net/api/' . $endpoint . '?access_key=' . $access_key . '');
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

                $json = curl_exec($ch);
                curl_close($ch);

                $exchangeRates = json_decode($json, true);

                $this->cronjob->exchange_rate($base, $exchangeRates['quotes']);
                echo "---------------Task Done-------\n";
            }
        }
    }

    public function subscription()
    {
        $corn = $this->cronjob->config();

        $cornkey = $corn['cornkey'];

        echo "---------------Cron job for subscription-------\n";

        if ($cornkey == $this->input->get('token')) {

            echo "---------------Process Started -------------------------\n";

            if ($this->cronjob->subs()) {

                echo "---------------Success! Process Done! -------------------------\n";
            } else {
                echo "---------------Error! Process Halted! -------------------------\n";
            }
        } else {

            echo "---------------Error! Invalid Token! -------------------------\n";
        }
    }

    public function cleandrafts()
    {
        $corn = $this->cronjob->config();

        $cornkey = $corn['cornkey'];

        echo "---------------Cron job for clean drafts-------\n";

        if ($cornkey == $this->input->get('token')) {

            echo "---------------Process Started -------------------------\n";

            // $ndate = date("Y-m-d", strtotime(date('Y-m-d') . " -7 days"));
            $this->db->where('tid>', 1);
            $this->db->delete('gtg_draft');
            $this->db->where('tid>', 1);
            $this->db->delete('gtg_draft_items');

            echo "---------------Success! Process Done! -------------------------\n";
        } else {

            echo "---------------Error! Invalid Token! -------------------------\n";
        }
    }

    public function promo()
    {
        $corn = $this->cronjob->config();

        $cornkey = $corn['cornkey'];

        echo "---------------Cron job for promo update-------\n";

        if ($cornkey == $this->input->get('token')) {

            echo "---------------Process Started -------------------------\n";

            $data = array(
                ' active' => 2,

            );
            $this->db->set($data);
            $this->db->where('valid<', date('Y-m-d'));

            $this->db->update('gtg_promo');

            echo "---------------Success! Process Done! -------------------------\n";
        } else {

            echo "---------------Error! Invalid Token! -------------------------\n";
        }
    }

    public function stock_alert()
    {
        $corn = $this->cronjob->config();
        $this->load->model('communication_model', 'communication');

        $cornkey = $corn['cornkey'];

        echo "---------------Cron job for product stock alert-------\n";

        if ($cornkey == $this->input->get('token')) {

            echo "---------------Process Started -------------------------\n";
            $subject = 'Stock Alert ' . date('Y-m-d H:i:s');

            if ($this->communication->send_corn_email($this->config->item('email'), $this->config->item('cname'), $subject, $this->cronjob->stock())) {
                echo "-------------- Email Sent! -------------------------\n";
            } else {

                echo "---------------. Error! -------------------------\n";
            }
        } else {

            echo "---------------Error! Invalid Token! -------------------------\n";
        }
    }

    public function dbbackup()
    {
        $corn = $this->cronjob->config();
        //  $this->load->model('communication_model', 'communication');

        $cornkey = $corn['cornkey'];

        echo "---------------Cron job for database backup-------\n";

        if ($cornkey == $this->input->get('token')) {

            echo "---------------Process Started -------------------------\n";
            $bdate = 'backup_' . date('Y_m_d_H_i_s');
            $this->load->dbutil();
            $backup = $this->dbutil->backup();
            $this->load->helper('file');
            write_file(FCPATH . 'userfiles/' . $bdate . '-' . rand(99, 999) . '.gz', $backup);
        } else {

            echo "---------------Error! Invalid Token! -------------------------\n";
        }
    }

    public function cleanlog()
    {
        $corn = $this->cronjob->config();

        $cornkey = $corn['cornkey'];

        echo "---------------Cron job to clean 7days old log-------\n";

        if ($cornkey == $this->input->get('token')) {

            echo "---------------Process Started -------------------------\n";

            // $ndate = date("Y-m-d", strtotime(date('Y-m-d') . " -7 days"));
            $this->db->where('DATE(created)<', date('Y-m-d', strtotime(date('Y-m-d') . " -7 days")));
            $this->db->delete('gtg_log');

            echo "---------------Success! Process Done! -------------------------\n";
        } else {

            echo "---------------Error! Invalid Token! -------------------------\n";
        }
    }

    public function expiry_alert()
    {
        $corn = $this->cronjob->config();
        $this->load->model('communication_model', 'communication');

        $cornkey = $corn['cornkey'];

        echo "---------------Cron job for product expiry alert-------\n";

        if ($cornkey == $this->input->get('token')) {

            echo "---------------Process Started -------------------------\n";
            $subject = 'Expiry Alert ' . date('Y-m-d H:i:s');

            if ($this->communication->send_corn_email($this->config->item('email'), $this->config->item('cname'), $subject, $this->cronjob->expiry())) {
                echo "-------------- Email Sent! -------------------------\n";
            } else {

                echo "---------------. Error! -------------------------\n";
            }
        } else {

            echo "---------------Error! Invalid Token! -------------------------\n";
        }
    }

    public function anniversary_mail()
    {
        $corn = $this->cronjob->config();
        $this->load->library('parser');
        $cornkey = $corn['cornkey'];

        echo "---------------Cron job for anniversary_mail-------\n";

        if ($cornkey == $this->input->get('token')) {
            $i = 1;

            $this->load->model('plugins_model', 'plugins');
            $anniversary_cron = $this->plugins->universal_api(67);

            $this->load->model('templates_model', 'templates');
            $template = $this->templates->template_info(17);
            $this->load->model('communication_model', 'communication');
            $loc = location(0);
            $data = array(
                'Company' => $loc['cname'],
            );
            $subject = $this->parser->parse_string($template['key1'], $data, true);
            $data = array(
                'Company' => $loc['cname'],
                'CompanyDetails' => '<h6><strong>' . $loc['cname'] . ',</strong></h6>
<address>' . $loc['address'] . '<br>' . $loc['city'] . ', ' . $loc['country'] . '</address>
            Phone: ' . $loc['phone'] . '<br> Email: ' . $loc['email'],

            );
            $message = $this->parser->parse_string($template['other'], $data, true);

            if (date('m-d', strtotime($loc['foundation'])) === date('m-d', strtotime(date('Y-m-d')))) {

                $date1 = strtotime($anniversary_cron['other']);
                $date2 = strtotime(date('Y-m-d')); // Can use date/string just like strtotime.

                if (!$anniversary_cron['active']) {
                    echo "---------------. Email Sent! block 0-------------------------\n";
                    $emails = $this->cronjob->customer_mail($anniversary_cron['method']);

                    $user = $this->communication->group_email($emails, $subject, $message, false, '', false);
                    if ($user) {
                        echo "---------------$user. Email Sent! -------------------------\n";
                        $vv = $this->plugins->m_update_api(67, 0, $user, date('Y-m-d'), $anniversary_cron['method'], '', 1);
                    } else {
                        echo "---------------$i. Esrror! -------------------------\n";
                    }
                } else if ($anniversary_cron['active'] == 1) {
                    $emails = $this->cronjob->customer_mail($anniversary_cron['method'], $anniversary_cron['key2']);

                    $user = $this->communication->group_email($emails, $subject, $message, false, '', false);
                    if ($user > 1) {
                        echo "---------------$user. Email Sent! block 1-------------------------\n";
                        $vv = $this->plugins->m_update_api(67, 0, $user, date('Y-m-d'), $anniversary_cron['method'], null, 1);
                    } else {
                        $futureDate = date('Y-m-d', strtotime('+1 year'));
                        $vv = $this->plugins->m_update_api(67, 0, $user, date('Y-m-d'), $anniversary_cron['method'], $futureDate, 2);
                    }
                } else if ($anniversary_cron['active'] == 2 and $date1 == $date2) {
                    echo "---------------. Email Sent! block 1-------------------------\n";
                    $emails = $this->cronjob->customer_mail($anniversary_cron['method'], $anniversary_cron['key2'] + 1);
                    $user = $this->communication->group_email($emails, $subject, $message, false, '', false);
                    if ($user) {
                        echo "---------------$user. Email Sent! -------------------------\n";
                        $this->plugins->m_update_api(67, 0, $user, date('Y-m-d'), $anniversary_cron['method'], null, 1);
                    } else {
                        $futureDate = date('Y-m-d', strtotime('+1 year'));
                        $this->plugins->m_update_api(67, 0, 0, date('Y-m-d'), $anniversary_cron['method'], $futureDate, 2);
                    }
                }
            }
        } else {

            echo "---------------Error! Invalid Token! -------------------------\n";
        }
    }

    public function anniversary_sms()
    {
        $corn = $this->cronjob->config();
        $this->load->library('parser');
        $cornkey = $corn['cornkey'];

        echo "---------------Cron job for anniversary_mail-------\n";

        if ($cornkey == $this->input->get('token')) {
            $i = 1;

            $this->load->model('plugins_model', 'plugins');
            $anniversary_cron = $this->plugins->universal_api(68);

            $this->load->model('templates_model', 'templates');
            $template = $this->templates->template_info(37);
            $this->load->model('communication_model', 'communication');
            $loc = location(0);
            $data = array(
                'Company' => $loc['cname'],
            );
            $subject = $this->parser->parse_string($template['key1'], $data, true);
            $data = array(
                'Company' => $loc['cname'],
                'CompanyDetails' => '<h6><strong>' . $loc['cname'] . ',</strong></h6>
<address>' . $loc['address'] . '<br>' . $loc['city'] . ', ' . $loc['country'] . '</address>
            Phone: ' . $loc['phone'] . '<br> Email: ' . $loc['email'],

            );
            $message = $this->parser->parse_string($template['other'], $data, true);

            if (date('m-d', strtotime($loc['foundation'])) === date('m-d', strtotime(date('Y-m-d')))) {

                $date1 = strtotime($anniversary_cron['other']);
                $date2 = strtotime(date('Y-m-d')); // Can use date/string just like strtotime.

                if (!$anniversary_cron['active']) {
                    echo "---------------. Sms Sent! block 0-------------------------\n";
                    $numbers = $this->cronjob->customer_mail($anniversary_cron['method']);

                    foreach ($numbers as $mob) {
                        $this->twilio($mob['phone'], $message);
                        $user = $mob['id'];
                    }

                    if ($user) {
                        echo "---------------$user. Sms Sent! -------------------------\n";
                        $vv = $this->plugins->m_update_api(68, 0, $user, date('Y-m-d'), $anniversary_cron['method'], '', 1);
                    } else {
                        echo "---------------$i. Esrror! -------------------------\n";
                    }
                } else if ($anniversary_cron['active'] == 1) {
                    $numbers = $this->cronjob->customer_mail($anniversary_cron['method'], $anniversary_cron['key2']);

                    foreach ($numbers as $mob) {
                        $this->twilio($mob['phone'], $message);
                        $user = $mob['id'];
                    }
                    if ($user > 1) {
                        echo "---------------$user. Sms Sent! block 1-------------------------\n";
                        $vv = $this->plugins->m_update_api(68, 0, $user, date('Y-m-d'), $anniversary_cron['method'], null, 1);
                    } else {
                        $futureDate = date('Y-m-d', strtotime('+1 year'));
                        $vv = $this->plugins->m_update_api(68, 0, $user, date('Y-m-d'), $anniversary_cron['method'], $futureDate, 2);
                    }
                } else if ($anniversary_cron['active'] == 2 and $date1 == $date2) {
                    echo "---------------. Sms Sent! block 1-------------------------\n";
                    $numbers = $this->cronjob->customer_mail($anniversary_cron['method'], $anniversary_cron['key2'] + 1);
                    foreach ($numbers as $mob) {
                        $this->twilio($mob['phone'], $message);
                        $user = $mob['id'];
                    }
                    if ($user) {
                        echo "---------------$user. Sms Sent! -------------------------\n";
                        $this->plugins->m_update_api(68, 0, $user, date('Y-m-d'), $anniversary_cron['method'], null, 1);
                    } else {
                        $futureDate = date('Y-m-d', strtotime('+1 year'));
                        $this->plugins->m_update_api(68, 0, 0, date('Y-m-d'), $anniversary_cron['method'], $futureDate, 2);
                    }
                }
            }
        } else {

            echo "---------------Error! Invalid Token! -------------------------\n";
        }
    }

    private function twilio($mobile, $text_message)
    {
        $this->load->model('plugins_model', 'plugins');
        require APPPATH . 'third_party/twilio-php-master/Twilio/autoload.php';

        $sms_service = $this->plugins->universal_api(2);

        // Your Account SID and Auth Token from twilio.com/console
        $sid = $sms_service['key1'];
        $token = $sms_service['key2'];
        $client = new Client($sid, $token);

        $message = $client->messages->create(
            // the number you'd like to send the message to
            $mobile,
            array(
                // A Twilio phone number you purchased at twilio.com/console
                'from' => $sms_service['url'],
                // the body of the text message you'd like to send
                'body' => $text_message,
            )
        );

        if ($message->sid) {
            echo json_encode(array('status' => 'Success', 'message' => 'Message sending successful. Current Message Status is ' . $message->status));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => 'SMS Service Error'));
        }
    }
}