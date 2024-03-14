<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // YRegards constructor code
        $this->load->library("Aauth");
        $this->load->library("Captcha_u");
        $this->load->library("form_validation");
        $this->load->model('employee_model', 'user_employee');
	    $this->load->model('user_model', 'user');
        $this->load->model('Modules_model','modules');
        $this->captcha = $this->captcha_u->public_key()->captcha;
        $c_module = 'dashboard';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);
    }

    public function index()
    {
        if ($this->aauth->is_loggedin()) {
            redirect('/dashboard/', 'refresh');
        }
        $data['response'] = '';
        $data['captcha_on'] = $this->captcha;
        $data['captcha'] = $this->captcha_u->public_key()->recaptcha_p;
        if ($this->input->get('e')) {
            $data['response'] = 'Invalid username or password!';
        }
       // $this->load->view('user/header');
        $this->load->view('user/index', $data);
       // $this->load->view('user/footer');
    }

    public function checklogin()
    {
        $user = $this->input->post('username');
        $password = $this->input->post('password');
        $remember_me = $this->input->post('remember_me');
        $rem = false;
        if ($remember_me == 'on') {
            $rem = true;
        }

        if ($this->aauth->login($user, $password, $rem, $this->captcha)) {
			
            $this->aauth->applog("[Logged In] $user");
            $id=$this->aauth->get_user()->username;
            $data=$this->details_by_username($id);
          
            if(isset($data)){
                $data1 = array(
                'login_status' =>1);
                $this->db->where('id', $data['id']);
                $this->db->update('gtg_users', $data1);	
                //  echo   $this->db->last_query();
                $this->session->set_userdata('login_name', $data['name']);
                
            }else{
                /*  $data1 = array(
                  'login_status' =>1);
                 $this->db->where('id', $id);
                 $this->db->update('gtg_users', $data1);	
                 echo$this->db->last_query(); */

                $this->session->set_userdata('login_name', $id);
            }

            redirect('/dashboard/', 'refresh');
        } else {

            redirect('/user/?e=eyxde', 'refresh');
        }
    }
  public function details_by_username($username)
    {
		
        $this->db->select('*');
        $this->db->from('gtg_employees');
        $this->db->where('username', $username);
        $query = $this->db->get();
		return $query->row_array();
    }

    public function update_user_personalized_module(){


        $user_id = $this->aauth->get_user()->id;

        $role = $_SESSION['s_role'];
        $role_permissions = $this->modules->get_role_personalization_modules($role);

        $selected_modules = $this->input->post('selected_modules');
        $selected_modules = explode(',',$selected_modules);
        //echo "<pre>"; print_r($_POST); echo "</pre>";
        // echo "<pre>"; print_r($role_permissions); echo "</pre>";
        // echo "<pre>"; print_r($selected_modules); echo "</pre>";
        // exit;

        $resultArray = array();

        foreach ($role_permissions as $item) {
            if (!in_array($item['id'], $selected_modules)) {
                $resultArray[] = $item['id'];
            }
        }

        $n_data = array();
        if(!empty($resultArray))
        {
            foreach($resultArray as $sm){
                $data['module_id'] = $sm;
                $data['user_id'] = $user_id;
                $n_data[] = $data;
            }
        }
        $this->db->where('user_id',$user_id)->delete('gtg_employee_modules_personalization');
        $this->db->insert_batch('gtg_employee_modules_personalization',$n_data);
        echo json_encode(array('status' => 'Success', 'message' =>
            $this->lang->line('UPDATED')));
    }
    public function profile()
    {

        // echo "<pre>"; print_r($_SESSION); echo "</pre>";
        // exit;
        $user_id = $this->aauth->get_user()->id;
        $role = $_SESSION['s_role'];
        $data['role_permissions'] = $this->modules->get_role_personalization_modules($role);
        $data['sidebar_hierarchy'] = $this->modules->get_modules_personalization_hierarchy($role);
        $data['disabled_modules'] = $this->db->select('module_id')->where('user_id',$user_id)->get('gtg_employee_modules_personalization')->result_array();
        
        $moduleIds = array_map(function($item) {
            return $item['module_id'];
        }, $data['disabled_modules']);
        
        // Remove elements from role_permissions array if id exists in moduleIds
        $data['role_permissions'] = array_filter($data['role_permissions'], function($item) use ($moduleIds) {
            return !in_array($item['id'], $moduleIds);
        });

        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;
        
       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }

        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = $head['usernm'] . $this->lang->line('Profile');
        $this->load->model('employee_model', 'employee');
        $id = $this->aauth->get_user()->id;
        $data['employee'] = $this->employee->employee_details($id);
        $data['eid'] = intval($id);
		$data['user'] = $this->user->get_user($id);
		//print_r($data['user']);
        $this->load->view('fixed/header', $head);
        $this->load->view('user/profile', $data);
        $this->load->view('fixed/footer');
    }

    public function attendance()
    {
       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }


        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = $head['usernm'] . $this->lang->line('attendance');


        $this->load->view('fixed/header', $head);
        $this->load->view('user/attendance');
        $this->load->view('fixed/footer');
    }

    public function holidays()
    {
       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = $head['usernm'] . $this->lang->line('attendance');

        $this->load->view('fixed/header', $head);
        $this->load->view('user/holidays');
        $this->load->view('fixed/footer');
    }

    public function getAttendance()
    {
       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }
        $this->load->model('employee_model', 'employee');
        $id = $this->aauth->get_user()->id;

        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $result = $this->employee->getAttendance($id, $start, $end);
        echo json_encode($result);
    }

    public function getHolidays()
    {
       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }
        $this->load->model('employee_model', 'employee');
        $id = $this->aauth->get_user()->loc;

        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $result = $this->employee->getHolidays($id, $start, $end);
        echo json_encode($result);
    }

    public function update()
    {
       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }


        $id = $this->aauth->get_user()->id;
        $this->load->model('employee_model', 'employee');
        if ($this->input->post()) {
            $name = $this->input->post('name', true);
            $phone = $this->input->post('phone', true);
            $phonealt = $this->input->post('phonealt', true);
            $address = $this->input->post('address', true);
            $city = $this->input->post('city', true);
            $region = $this->input->post('region', true);
            $country = $this->input->post('country', true);
            $postbox = $this->input->post('postbox', true);
            $lang = $this->input->post('language', true);
            $this->employee->update_employee($id, $name, $phone, $phonealt, $address, $city, $region, $country, $postbox, $this->aauth->get_user()->loc,$salary = 0, $department = -1, $commission = 0, $roleid = false, $gender='', $kwsp_number='', $socso_number='', $pcb_number='');
            $this->db->set('lang', $lang);
            $this->db->where('id', $id);
            $this->db->update('gtg_users');
        } else {
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = $head['usernm'] . $this->lang->line('Profile');
            $this->load->library("Common");
            $data['langs'] = $this->common->current_language($this->aauth->get_user()->lang);


            $data['user'] = $this->employee->employee_details($id);
            $data['eid'] = intval($id);
            $this->load->view('fixed/header', $head);
            $this->load->view('user/edit', $data);
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
        $id = $this->aauth->get_user()->id;
        $this->load->library("uploadhandler", array(
            'accept_file_types' => '/\.(gif|jpe?g|png)$/i', 'upload_dir' => FCPATH . 'userfiles/employee/'
        ));
        $img = (string)$this->uploadhandler->filenaam();
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
        $id = $this->aauth->get_user()->id;
        $this->load->library("uploadhandler", array(
            'accept_file_types' => '/\.(gif|jpe?g|png)$/i', 'upload_dir' => FCPATH . 'userfiles/employee_sign/'
        ));
        $img = (string)$this->uploadhandler->filenaam();
        if ($img != '') {
            $this->employee->editsign($id, $img);
        }
    }


    public function updatepassword()
    {

       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }

        $id = $this->aauth->get_user()->id;
        $this->load->model('employee_model', 'employee');


        if ($this->input->post()) {
            $this->form_validation->set_rules('newpassword', 'Password', 'required');
            $this->form_validation->set_rules('renewpassword', 'Confirm Password', 'required|matches[newpassword]');
            if ($this->form_validation->run() == FALSE) {
                echo json_encode(array('status' => 'Error', 'message' => '<br>Rules<br> Password length should  be at least 6 [a-z-0-9] allowed!<br>New Password & Re New Password should be same!'));
            } else {
                $cpassword = $this->input->post('cpassword');
                $newpassword = $this->input->post('newpassword');
                $renewpassword = $this->input->post('renewpassword');

                $hash = $this->aauth->hash_password($cpassword, $id);

                if (hash_equals($this->aauth->get_user()->pass, $hash)) {
                    echo json_encode(array('status' => 'Success', 'message' => 'Password Updated Successfully!'));

                    $this->aauth->update_user($id, false, $newpassword, false);
                } else {
                    echo json_encode(array('status' => 'Error', 'message' => 'Incorrect current password!'));
                }
            }
        } else {
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = $head['usernm'] . $this->lang->line('Profile');


            $data['user'] = $this->employee->employee_details($id);
            $data['eid'] = intval($id);
            $this->load->view('fixed/header', $head);
            $this->load->view('user/password', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function forgot()
    {
        if ($this->aauth->is_loggedin()) {
            redirect('/dashboard/', 'refresh');
        }

        $data['response'] = '';
        if ($this->input->get('e')) {
            $data['response'] = 'Invalid username or password!';
        }
        $this->load->view('user/header');
        $this->load->view('user/forgot', $data);
        $this->load->view('user/footer');
    }

    public function send_reset()
    {
        if ($this->aauth->is_loggedin()) {
            redirect('/dashboard/', 'refresh');
        }

        $data['response'] = '';


        $email = $this->input->post('email', true);
        $out = $this->aauth->remind_password($email);
	 
        if ($out) {
            $this->load->model('communication_model');

            $mailtoc = $out['email'];
            $mailtotilte = $out['username'];
            $subject = '[' . $this->config->item('ctitle') . '] Password Reset Link';
            $link = base_url('user/reset_pass?code=' . $out['vcode'] . '&email=' . $email);

            $message = "<h4>Dear $mailtotilte</h4>, <p>We have generated a password reset request for you. You can reset the password using following link.</p> <p><a href='$link'>$link</a></p><p>Reagrds,<br>Team " . $this->config->item('ctitle') . "</p>";
            $attachmenttrue = false;
            $attachment = '';
            $this->communication_model->send_email($mailtoc, $mailtotilte, $subject, $message, $attachmenttrue, $attachment);
        } else {
            echo json_encode(array('status' => 'Error', 'message' => 'Enter Valid Email'));
        }
    }

    public function reset_pass()
    {
        if ($this->aauth->is_loggedin()) {
            redirect('/dashboard/', 'refresh');
        }
        $data['code'] = $this->input->get('code', true);
        $data['email'] = $this->input->get('email', true);

        $data['response'] = '';
        if ($this->input->get('e')) {
            $data['response'] = 'Invalid username or password!';
        }
        if ($this->input->get('k')) {
            $this->load->model('general_model', 'general');
            $this->general->reset($this->input->get('k'));
        }
        $this->load->view('user/header');
        $this->load->view('user/reset', $data);
        $this->load->view('user/footer');
    }

    public function reset_change()
    {
        if ($this->aauth->is_loggedin()) {
            redirect('/dashboard/', 'refresh');
        }

        $password = $this->input->post('n_password', true);
        $code = $this->input->post('n_code', true);
        $email = $this->input->post('email', true);

        if (strlen($password) > 5) {
            $out = $this->aauth->reset_password($email, $code, $password);
            //   print_r($out);
            if ($out) echo json_encode(array('status' => 'Success', 'message' => "Password Changed Successfully!  <a href='" . base_url() . "' class='btn btn-indigo btn-md'>
			<span class='icon-home' aria-hidden='true'></span> Login </a>"));
            else echo json_encode(array('status' => 'Error', 'message' => "Code Expired! <a href='" . base_url() . "' class='btn btn-blue btn-md'><span class='fa fa-home' aria-hidden='true'></span> " . $this->lang->line('Login') . "  </a>"));
        }


        $data['response'] = '';
        if ($this->input->get('e')) {
            $data['response'] = 'Invalid username or password!';
        }
    }

    public function logout()
    {
        
        // $id=$this->aauth->get_user()->id;
       //   $data = array(
        ///        'login_status' =>0);
       // $this->db->where('id', $id);
     //  $this->db->update('gtg_users', $data);
        $this->aauth->applog('[Logged Out] ' . $this->aauth->get_user()->username);
        $this->aauth->logout();
        
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
         
  
        redirect('/user/', 'refresh');
    }

    public function salary()
    {
       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }
        $id = $this->aauth->get_user()->id;
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = $head['usernm'] . $this->lang->line('salary');
        $this->load->model('employee_model', 'employee');
        $id = $this->aauth->get_user()->id;
        $data['employee_salary'] = $this->employee->salary_view($id);
        $data['employee'] = $this->employee->employee_details($id);
        $this->load->view('fixed/header', $head);
        $this->load->view('user/salary', $data);
        $this->load->view('fixed/footer');
    }
}