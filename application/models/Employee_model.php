<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Employee_model extends CI_Model
{

    public function list_all_employee()
    {

        $this->db->select('gtg_employees.*,gtg_users.banned,gtg_users.roleid,gtg_users.loc,gtg_role.role_name');
        $this->db->from('gtg_employees');
        $this->db->join('gtg_role', 'gtg_role.id = gtg_employees.degis', 'left');
        //  $this->db->join('gtg_users', 'gtg_employees.id = gtg_users.id', 'left');
        $this->db->join('gtg_users', 'gtg_employees.id = gtg_users.id', 'left');

        $this->db->order_by('gtg_users.roleid', 'DESC');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function list_employee()
    {
        $this->db->select('gtg_employees.*,gtg_users.banned,gtg_users.roleid,gtg_users.loc,gtg_role.role_name');
        $this->db->from('gtg_employees');
        $this->db->join('gtg_role', 'gtg_role.id = gtg_employees.degis', 'left');

        //  $this->db->join('gtg_users', 'gtg_employees.id = gtg_users.id', 'left');
        $this->db->join('gtg_users', 'gtg_employees.id = gtg_users.id', 'left');
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('gtg_users.loc', $this->aauth->get_user()->loc);
            if (BDATA) {
                $this->db->or_where('loc', 0);
            }

            $this->db->group_end();
        }
        $this->db->where('gtg_employees.delete_status', 0);
        //$this->db->where('gtg_employees.employee_type!=', "foreign");
        $this->db->order_by('gtg_users.roleid', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getEmailToSend()
    {

        $this->db->select('email_to');
        $this->db->from('scheduler');
        $query = $this->db->get();
        return $query->row();

    }

    public function getclient()
    {

        $this->db->select('days');
        $this->db->from('scheduler');
        $query = $this->db->get();
        //print_r($this->db->last_query());
        $value = $query->row();
        $days = $value->days;

        $thirtydays = date('Y-m-d', strtotime('+30 days'));
        $sixtydays = date('Y-m-d', strtotime('+60 days'));
        $ninentydays = date('Y-m-d', strtotime('+90 days'));

        /**$this->db->select('days');
        $this->db->from('scheduler');
        $this->db->where('module',8);
        $query = $this->db->get();
        $value=$query->row();*/
        $this->db->select('gtg_employees.id,gtg_employees.email,gtg_employees.name,gtg_employees.passport,gtg_employees.passport_expiry,gtg_customers.email as cus_email');
        $this->db->from('gtg_employees');
        $this->db->join('gtg_customers', 'gtg_customers.id = gtg_employees.company');
        if ($days == 30) {
            $this->db->where('passport_expiry>', $thirtydays);
        } else if ($days == 60) {
            $this->db->or_where('passport_expiry>', $sixtydays);

        } else {
            $this->db->or_where('passport_expiry>', $ninentydays);

        }
        //$this->db->or_where('passport_expiry>', $sixtydays);
        //$this->db->or_where('passport_expiry>', $ninentydays);

        $this->db->where('employee_type', "foreign");
        $this->db->where('delete_status', 0);
        $this->db->where('passport_email_sent', 0);

        $query = $this->db->get();
        //print_r($this->db->last_query());
        return $query->result_array();

    }

    public function list_project_employee($id)
    {
        $this->db->select('gtg_employees.*');
        $this->db->from('gtg_project_meta');
        $this->db->where('gtg_project_meta.pid', $id);
        $this->db->where('gtg_project_meta.meta_key', 19);
        $this->db->join('gtg_employees', 'gtg_employees.id = gtg_project_meta.meta_data', 'left');
        $this->db->join('gtg_users', 'gtg_employees.id = gtg_users.id', 'left');
        $this->db->order_by('gtg_users.roleid', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function employee_details($id)
    {
        $this->db->select('gtg_employees.*,gtg_users.email,gtg_users.loc,gtg_users.roleid,gtg_countries.country_name');
        $this->db->from('gtg_employees');
        $this->db->where('gtg_employees.id', $id);
        $this->db->join('gtg_countries', 'gtg_countries.id = gtg_employees.country', 'left');

        $this->db->join('gtg_users', 'gtg_employees.id = gtg_users.id', 'left');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function employee_foreign_details($id)
    {
        $this->db->select('*');
        $this->db->from('gtg_employees');
        $this->db->where('gtg_employees.id', $id);
        $this->db->where('gtg_employees.employee_type', "foreign");

        $query = $this->db->get();
        return $query->row();
    }

    public function details_by_username($username)
    {
        $this->db->select('*');
        $this->db->from('gtg_employees');
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row_array();
    }
    public function salary_history($id)
    {
        $this->db->select('*');
        $this->db->from('gtg_hrm');
        $this->db->where('typ', 1);
        $this->db->where('rid', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_employee($id, $name, $phone, $phonealt, $address, $city, $region, $country, $postbox, $location, $salary = 0, $department = -1, $commission = 0, $roleid = false)
    {
        $this->db->select('salary');
        $this->db->from('gtg_employees');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $sal = $query->row_array();
        $this->db->select('roleid');
        $this->db->from('gtg_users');
        $this->db->where('id', $id);
        $query = $this->db->get();
        $role = $query->row_array();

        $data = array(
            'name' => $name,
            'phone' => $phone,
            'phonealt' => $phonealt,
            'address' => $address,
            'city' => $city,
            'region' => $region,
            'country' => $country,
            'postbox' => $postbox,
            'salary' => $salary,
            'c_rate' => $commission,
        );
        if ($department > -1) {
            $data = array(
                'name' => $name,
                'phone' => $phone,
                'phonealt' => $phonealt,
                'address' => $address,
                'city' => $city,
                'region' => $region,
                'degis' => $roleid,
                'country' => $country,
                'postbox' => $postbox,
                'salary' => $salary,
                'dept' => $department,
                'c_rate' => $commission,
            );
        }

        $this->db->set($data);
        $this->db->where('id', $id);

        if ($this->db->update('gtg_employees')) {
            if (!empty($role)) {
                if ($roleid && $role['roleid'] != 5) {
                    $this->db->set('loc', $location);
                    $this->db->set('roleid', $roleid);
                    $this->db->where('id', $id);
                    $this->db->update('gtg_users');
                }
            }
            if (($salary != $sal['salary']) and ($salary > 0.00)) {
                $data1 = array(
                    'typ' => 1,
                    'rid' => $id,
                    'val1' => $salary,
                    'val2' => $sal['salary'],
                    'val3' => date('Y-m-d H:i:s'),
                );

                $this->db->insert('gtg_hrm', $data1);
            }

            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('UPDATED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }
    }

    public function update_password($id, $cpassword, $newpassword, $renewpassword)
    {
    }

    public function editpicture($id, $pic)
    {
        $this->db->select('picture');
        $this->db->from('gtg_employees');
        $this->db->where('id', $id);

        $query = $this->db->get();
        $result = $query->row_array();

        $data = array(
            'picture' => $pic,
        );

        $this->db->set($data);
        $this->db->where('id', $id);
        if ($this->db->update('gtg_employees')) {
            $this->db->set($data);
            $this->db->where('id', $id);
            $this->db->update('gtg_users');

            unlink(FCPATH . 'userfiles/employee/' . $result['picture']);
            unlink(FCPATH . 'userfiles/employee/thumbnail/' . $result['picture']);
        }
    }

    public function editsign($id, $pic)
    {
        $this->db->select('sign');
        $this->db->from('gtg_employees');
        $this->db->where('id', $id);

        $query = $this->db->get();
        $result = $query->row_array();

        $data = array(
            'sign' => $pic,
        );

        $this->db->set($data);
        $this->db->where('id', $id);
        if ($this->db->update('gtg_employees')) {

            unlink(FCPATH . 'userfiles/employee_sign/' . $result['sign']);
            unlink(FCPATH . 'userfiles/employee_sign/thumbnail/' . $result['sign']);
        }
    }

    public $table = 'gtg_invoices';
    public $column_order = array(null, 'gtg_invoices.tid', 'gtg_invoices.invoicedate', 'gtg_invoices.total', 'gtg_invoices.status');
    public $column_search = array('gtg_invoices.tid', 'gtg_invoices.invoicedate', 'gtg_invoices.total', 'gtg_invoices.status');
    public $order = array('gtg_invoices.tid' => 'asc');

    private function _invoice_datatables_query($id)
    {
        $this->db->select('gtg_invoices.*,gtg_customers.name');
        $this->db->from('gtg_invoices');
        $this->db->where('gtg_invoices.eid', $id);
        $this->db->join('gtg_customers', 'gtg_invoices.csd=gtg_customers.id', 'left');

        $i = 0;

        foreach ($this->column_search as $item) // loop column
        {
            $search = $this->input->post('search');
            $value = $search['value'];
            if ($value) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                {
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) // here order processing
        {
            $this->db->order_by($this->column_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function invoice_datatables($id)
    {
        $this->_invoice_datatables_query($id);
        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function invoicecount_filtered($id)
    {
        $this->_invoice_datatables_query($id);
        $query = $this->db->get();
        if ($id != '') {
            $this->db->where('gtg_invoices.eid', $id);
        }
        return $query->num_rows($id);
    }

    public function invoicecount_all($id)
    {
        $this->_invoice_datatables_query($id);
        $query = $this->db->get();
        if ($id != '') {
            $this->db->where('gtg_invoices.eid', $id);
        }
        return $query->num_rows($id = '');
    }

    //transaction

    public $tcolumn_order = array(null, 'account', 'type', 'cat', 'amount', 'stat');
    public $tcolumn_search = array('id', 'account');
    public $torder = array('id' => 'asc');
    public $eid = '';

    private function _get_datatables_query()
    {

        $this->db->from('gtg_transactions');

        $this->db->where('eid', $this->eid);

        $i = 0;

        foreach ($this->tcolumn_search as $item) // loop column
        {
            if ($this->input->post('search')['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }

                if (count($this->tcolumn_search) - 1 == $i) //last loop
                {
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->tcolumn_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->torder)) {
            $order = $this->torder;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables($eid)
    {
        $this->eid = $eid;
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->db->from('gtg_transactions');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->from('gtg_transactions');
        $this->db->where('eid', $this->eid);
        return $this->db->count_all_results();
    }
    public function add_employee_new($d_user_id, $name, $roleid, $phone, $address, $city, $region, $country, $postbox, $location, $salary = 0, $commission = 0, $department = 0, $user_role)
    {
        $data = array(
            'id' => $d_user_id,
            'name' => $name,
            'address' => $address,
            'city' => $city,
            'region' => $region,
            'country' => $country,
            'postbox' => $postbox,
            'phone' => $phone,
            'dept' => $department,
            'salary' => $salary,
            'degis' => $user_role,
            'c_rate' => $commission,
        );

        if ($this->db->insert('gtg_employees', $data)) {
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('ADDED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }

    }

    public function add_employee($id, $username, $name, $roleid, $phone, $address, $city, $region,
        $country, $postbox, $location, $salary = 0, $commission = 0, $department = 0, $email, $password, $user_role) {
        $data = array(
            'id' => $id,
            'username' => $username,
            'name' => $name,
            'address' => $address,
            'city' => $city,
            'region' => $region,
            'country' => $country,
            'postbox' => $postbox,
            'phone' => $phone,
            'dept' => $department,
            'degis' => $user_role,
            'salary' => $salary,
            'c_rate' => $commission,
        );

        // echo "dddd";
        // exit;

        if ($this->db->insert('gtg_employees', $data)) {
            $data1 = array(
                'roleid' => $roleid,
                'loc' => $location,
            );

            $this->db->set($data1);
            $this->db->where('id', $id);

            $this->db->update('gtg_users');

            $message = "<!DOCTYPE html><html><head><title>Email Notification</title></head><body><h2>Welcome to Our Platform!</h2><p>Thank you for signing up. Below are your login credentials:</p><table><tr><td>User Name:</td><td><strong>'.$email.'</strong></td></tr><tr><td>Password:</td><td><strong>'.$password.'</strong></td></tr></table><p>Please use the provided email and password to log into our platform.</p><p>If you have any questions or need assistance, feel free to contact our support team.</p><p>Thank you!</p></body></html>";

            $this->send_email($email, $name, '[Profile Created]', $message, $attachmenttrue = false, $attachment = '');

            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('ADDED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('ERROR')));
        }

    }

    public function employee_validate($email)
    {
        $this->db->select('*');
        $this->db->from('gtg_users');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function money_details($eid)
    {
        $this->db->select('SUM(debit) AS debit,SUM(credit) AS credit');
        $this->db->from('gtg_transactions');
        $this->db->where('eid', $eid);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function sales_details($eid)
    {
        $this->db->select('SUM(pamnt) AS total');
        $this->db->from('gtg_invoices');
        $this->db->where('eid', $eid);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function employee_permissions_modules($role)
    {

        $roleuser = "r_" . $role;
        $this->db->select('id');
        $this->db->from('gtg_premissions');
        $this->db->where($roleuser, 1);
        $query = $this->db->get();
        return $query->result_array();

    }
    public function client_list()
    {
        $this->db->select('id,company');
        $this->db->from('gtg_customers');
        // $this->db->where('customer_type',"foreign");
        $query = $this->db->get();
        return $query->result_array();

    }

    public function getRole($id)
    {

        $this->db->select('*');
        $this->db->from('gtg_role');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();

    }

    public function role_list()
    {
        $this->db->select('*');
        $this->db->from('gtg_role');
        $this->db->where('delete_status', 0);

        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function employee_permissions()
    {
        $this->db->select('*');
        $this->db->from('gtg_premissions');
        $this->db->order_by('id', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    //documents list

    public $doccolumn_order = array(null, 'val1', 'val2', null);
    public $doccolumn_search = array('val1', 'val2');

    public function addholidays($loc, $hday, $hdayto, $note)
    {
        $data = array('typ' => 2, 'rid' => $loc, 'val1' => $hday, 'val2' => $hdayto, 'val3' => $note);
        return $this->db->insert('gtg_hrm', $data);
    }

    public function role_create($role_name,$all_data_previleges)
    {
        $data = array('role_name' => $role_name, 'all_data_previleges' => $all_data_previleges, 'status' => 1);
        $this->db->insert('gtg_role', $data);
        $id = $this->db->insert_id();
        if ($id) {
            $table = 'sidebaritems'; // Replace with your table name
            $query = "ALTER TABLE $table ADD r_$id INT(11) DEFAULT 0";
            if ($this->db->query($query)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }
    public function role_update($role_name, $role_id, $role_status, $all_data_previleges)
    {
        $data = array('role_name' => $role_name, 'all_data_previleges' => $all_data_previleges, 'status' => $role_status);

        $this->db->set($data);
        $this->db->where('id', $role_id);
        $this->db->update('gtg_role');
        return true;
    }

    public function deleterole($id)
    {

        $data = array('delete_status' => 1);
        $this->db->set($data);
        $this->db->where('id', $id);
        $this->db->update('gtg_role');
        return true;

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
        $username = $smtpresult['username'];
        $password = $smtpresult['password'];
        $mailfrom = $smtpresult['sender'];
        $mailfromtilte = $this->config->item('ctitle');

        $this->ultimatemailer->bin_send($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto, $mailtotitle, $subject, $message, $attachmenttrue, $attachment);
    }

    public function deleteholidays($id)
    {

        if ($this->db->delete('gtg_hrm', array('id' => $id, 'typ' => 2))) {

            return true;
        } else {
            return false;
        }
    }

    public function holidays_datatables()
    {
        $this->holidays_datatables_query();
        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }

        $query = $this->db->get();
        return $query->result();
    }

    private function holidays_datatables_query()
    {

        $this->db->from('gtg_hrm');
        $this->db->where('typ', 2);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('rid', $this->aauth->get_user()->loc);
        }
        $i = 0;

        foreach ($this->doccolumn_search as $item) // loop column
        {
            $search = $this->input->post('search');
            $value = $search['value'];
            if ($value) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->doccolumn_search) - 1 == $i) //last loop
                {
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->doccolumn_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->doccolumn_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function holidays_count_filtered()
    {
        $this->holidays_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function holidays_count_all()
    {
        $this->holidays_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function hday_view($id, $loc)
    {
        $this->db->select('*');
        $this->db->from('gtg_hrm');
        $this->db->where('id', $id);
        $this->db->where('typ', 2);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('rid', $loc);
        }

        $query = $this->db->get();
        return $query->row_array();
    }

    public function edithday($id, $loc, $from, $todate, $note)
    {

        $data = array('typ' => 2, 'val1' => $from, 'val2' => $todate, 'val3' => $note);

        $this->db->set($data);
        $this->db->where('id', $id);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('rid', $loc);
        }

        $this->db->update('gtg_hrm');
        return true;
    }

    public function department_list($id, $rid = 0)
    {
        $this->db->select('*');
        $this->db->from('gtg_hrm');
        $this->db->where('typ', 3);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('rid', $id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    public function department_elist($id)
    {
        $this->db->select('*');
        $this->db->from('gtg_employees');

        $this->db->where('dept', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function department_view($id, $loc)
    {
        $this->db->select('*');
        $this->db->from('gtg_hrm');
        $this->db->where('id', $id);
        $this->db->where('typ', 3);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('rid', $loc);
        }

        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_client_list()
    {
        $this->db->select('*');
        $this->db->from('gtg_customers');
        $this->db->where('customer_type', "foreign");

        $query = $this->db->get();
        return $query->result_array();

    }

    public function adddepartment($loc, $name)
    {
        $data = array('typ' => 3, 'rid' => $loc, 'val1' => $name);
        return $this->db->insert('gtg_hrm', $data);
    }

    public function deletedepartment($id)
    {

        if ($this->db->delete('gtg_hrm', array('id' => $id, 'typ' => 3))) {

            return true;
        } else {
            return false;
        }
    }

    public function editdepartment($id, $loc, $name)
    {

        $data = array(
            'val1' => $name,
        );

        $this->db->set($data);
        $this->db->where('id', $id);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('rid', $loc);
        }

        $this->db->update('gtg_hrm');
        return true;
    }

    //payroll

    private function _pay_get_datatables_query($eid)
    {

        $this->db->from('gtg_transactions');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        }
        $this->db->where('ext', 4);
        if ($eid) {
            $this->db->where('payerid', $eid);
        }

        $i = 0;

        foreach ($this->tcolumn_search as $item) // loop column
        {
            if ($this->input->post('search')['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }

                if (count($this->tcolumn_search) - 1 == $i) //last loop
                {
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->tcolumn_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->torder)) {
            $order = $this->torder;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function pay_get_datatables($eid)
    {

        $this->_pay_get_datatables_query($eid);
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function pay_count_filtered($eid)
    {
        $this->db->from('gtg_transactions');
        $this->db->where('ext', 4);
        if ($eid) {
            $this->db->where('payerid', $eid);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function pay_count_all($eid)
    {
        $this->db->from('gtg_transactions');
        $this->db->where('ext', 4);
        if ($eid) {
            $this->db->where('payerid', $eid);
        }
        return $this->db->count_all_results();
    }

    public function addattendance($emp, $adate, $tfrom, $tto, $note)
    {

        foreach ($emp as $row) {

            $this->db->where('emp', $row);
            $this->db->where('DATE(adate)', $adate);
            $num = $this->db->count_all_results('gtg_attendance');

            if (!$num) {
                $data = array('emp' => $row, 'created' => date('Y-m-d H:i:s'), 'adate' => $adate, 'tfrom' => $tfrom, 'tto' => $tto, 'note' => $note);
                $this->db->insert('gtg_attendance', $data);
            }
        }

        return true;
    }

    public function deleteattendance($id)
    {

        if ($this->db->delete('gtg_attendance', array('id' => $id))) {
            return true;
        } else {
            return false;
        }
    }

    public $acolumn_order = array(null, 'gtg_attendance.emp', 'gtg_attendance.adate', null, null);
    public $acolumn_search = array('gtg_employees.name', 'gtg_attendance.adate');

    public function attendance_datatables($cid, $year, $month)
    {
        $this->attendance_datatables_query($cid, $year, $month);
        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function attendance_table_list()
    {
        $today = date('Y-m-d');
        $this->db->select('*');
        $this->db->from('gtg_attendance');
        $this->db->where('adate', $today);
        $query = $this->db->get();
        return $query->result_array();

    }
    public function attend_break($id)
    {
        $today = date('Y-m-d');
        $this->db->select('*');

        $this->db->where('emp', $id);
        $this->db->where('bdate', $today);
        $this->db->order_by("clockin", "desc");
        $this->db->limit(1);
        $this->db->from('gtg_attend_break');
        $query = $this->db->get();
        return $query->result_array()[0];

    }
    public function attend_break_three_month($id)
    {
        $today = date('Y-m-d');
        $this->db->select('*');
        $this->db->where('emp', $id);
        $this->db->where('bdate > now() - INTERVAL 3 MONTH');
        $this->db->order_by("bdate", "desc");
        $this->db->from('gtg_attend_break');
        $query = $this->db->get();
        return $query->result_array();

    }
    public function attend_break_intervel($id, $interval)
    {
        $today = date('Y-m-d');
        $this->db->select('*');
        $this->db->where('emp', $id);
        if (strcasecmp($interval, 'day') == 0) {
            $this->db->where('bdate > now() - INTERVAL 1 DAY');
        }
        if (strcasecmp($interval, 'week') == 0) {
            $this->db->where('bdate > now() - INTERVAL 7 DAY');
        } elseif (strcasecmp($interval, 'month') == 0) {
            $this->db->where('bdate > now() - INTERVAL 1 MONTH');
        } else {
            $this->db->where('bdate > now() - INTERVAL 3 MONTH');
        }
        $this->db->order_by("bdate", "desc");
        $this->db->from('gtg_attend_break');
        $query = $this->db->get();
        return $query->result_array();

    }
    private function attendance_datatables_query($cid = 0, $year = 0, $month = 0)
    {

        $this->db->select('gtg_attendance.*,gtg_employees.name');
        $this->db->from('gtg_attendance');
        $this->db->join('gtg_employees', 'gtg_employees.id=gtg_attendance.emp', 'left');
        if ($this->aauth->get_user()->loc) {
            $this->db->join('gtg_users', 'gtg_users.id=gtg_attendance.emp', 'left');
            $this->db->where('gtg_users.loc', $this->aauth->get_user()->loc);
        }
        if ($cid) {$this->db->where('gtg_attendance.emp', $cid);}
        if ($year != 0) {$this->db->like('gtg_attendance.adate', $year);} else { $year = date('Y');}
        if ($month != 0) {
            $this->db->like('gtg_attendance.adate', $year . '-' . $month);
        }

        $i = 0;

        foreach ($this->acolumn_search as $item) // loop column
        {
            $search = $this->input->post('search');
            if ($search) {
                $value = $search['value'];
            } else { $value = 0;}
            if ($value) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->acolumn_search) - 1 == $i) //last loop
                {
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->acolumn_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->acolumn_order)) {
            $order = $this->acolumn_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function attendance_count_filtered($cid, $year, $month)
    {
        $this->attendance_datatables_query($cid, $year, $month);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function attendance_count_all($cid, $year, $month)
    {
        $this->attendance_datatables_query($cid, $year, $month);
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function attendance_late($cid)
    {

        $this->db->select('gtg_employees.*, gtg_users.email');
        $this->db->from('gtg_employees');
        $this->db->join('gtg_users', 'gtg_employees.id=gtg_users.id', 'left');
        $this->db->where('gtg_employees.dept', $cid);
        $this->db->where_not_in('gtg_employees.cdate', date('Y-m-d'));
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getcompnayEmployees($id)
    {
        $this->db->select('*');
        $this->db->from('gtg_employees');
        $this->db->where('company', $id);
        $this->db->where('employee_type', 'foreign');
        $this->db->where('delete_status', 0);
        $query = $this->db->get();
        return $query->result_array();

    }
    public function addInternational_new($d_user_id,
        $emp_name, $roleid, $passport, $permit,
        $country, $company, $type, $passport_expiry, $permit_expiry,
        $passport_filename, $visa_filename, $role_id) {

        $data = array(
            'id' => $d_user_id,
            'name' => $emp_name,
            'country' => $country,
            'company' => $company,
            'passport' => $passport,
            'permit' => $permit,
            'permit_expiry' => $permit_expiry,
            'passport_expiry' => $passport_expiry,
            'employee_type' => 'foreign',
            'passport_document' => $passport_filename,
            'visa_document' => $visa_filename,
            'degis' => $role_id,

        );

        return $this->db->insert('gtg_employees', $data);

    }

    public function insert_excel($data)
    {

        $res = $this->db->insert_batch('import', $data);
        if ($res) {
            return true;
        } else {
            return false;
        }

    }

    public function addInternational($id, $username, $emp_name, $email, $roleid, $passport, $permit,
        $country, $company, $type, $passport_expiry, $permit_expiry, $passport_filename, $visa_filename, $role_id) {
        $data = array(
            'id' => $id,
            'username' => $emp_name,
            'email' => $email,
            'name' => $emp_name,
            'country' => $country,
            'company' => $company,
            'passport' => $passport,
            'permit' => $permit,
            'permit_expiry' => $permit_expiry,
            'passport_expiry' => $passport_expiry,
            'employee_type' => 'foreign',
            'passport_document' => $passport_filename,
            'visa_document' => $visa_filename,
            'degis' => $role_id,

        );

        $this->db->insert('gtg_employees', $data);
        $insert_id = $this->db->insert_id();
        $data1 = array(
            'roleid' => $roleid,
        );
        $this->db->set($data1);
        $this->db->where('id', $id);

        $this->db->update('gtg_users');
        return $insert_id;

    }

    public function updateInternational($id, $emp_name, $email, $passport, $permit, $country, $company, $type, $passport_expiry, $permit_expiry, $passport_filename, $visa_filename)
    {
        $type = "foreign";
        $data = array(
            'username' => $emp_name,
            'email' => $email,
            'name' => $emp_name,
            'country' => $country,
            'company' => $company,
            'passport' => $passport,
            'permit' => $permit,
            'permit_expiry' => $permit_expiry,
            'passport_expiry' => $passport_expiry,
            'employee_type' => $type,
        );

        if(!empty($passport_filename))
        {
            $data['passport_document'] = $passport_filename;
        }

        if(!empty($passport_filename))
        {            
            $data['visa_document'] = $visa_filename;            
        }

        $this->db->where('id', $id);
        return $this->db->update('gtg_employees', $data);

    }

    public function getAttendance($emp, $start, $end)
    {

        $sql = "SELECT  CONCAT(tfrom, ' - ', tto) AS title,DATE(adate) as start ,DATE(adate) as end FROM gtg_attendance WHERE (emp='$emp') AND (DATE(adate) BETWEEN ? AND ? ) ORDER BY DATE(adate) ASC";
        return $this->db->query($sql, array($start, $end))->result();
    }

    public function getHolidays($loc, $start, $end)
    {

        $sql = "SELECT  CONCAT(DATE(val1), ' - ', DATE(val2),' - ',val3) AS title,DATE(val1) as start ,DATE(val2) as end FROM gtg_hrm WHERE  (typ='2') AND  (rid='$loc') AND (DATE(val1) BETWEEN ? AND ? ) ORDER BY DATE(val1) ASC";
        return $this->db->query($sql, array($start, $end))->result();
    }

    public function salary_view($eid)
    {
        $this->db->from('gtg_transactions');
        $this->db->where('ext', 4);
        $this->db->where('payerid', $eid);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function autoattend($opt)
    {
        $this->db->set('key1', $opt);
        $this->db->where('id', 62);

        $this->db->update('univarsal_api');
        return true;
    }
    public function break_time_list()
    {
        $this->db->select('*');
        $this->db->from('gtg_break_time');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function modify_break_time($id, $name, $time)
    {
        $this->db->set('name', $name);
        $this->db->set('btime', $time);
        $this->db->where('id', $id);
        $res = $this->db->update('gtg_break_time');
        return $res;
    }
    public function get_break_time($id)
    {
        $this->db->select('*');
        $this->db->where('id', $id);
        $this->db->from('gtg_break_time');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getfdmsemployees()
    {
        $this->db->select('*');
        $this->db->where('employee_type', "foreign");
        $this->db->from('gtg_employees');
        $query = $this->db->get();
        return $query->result_array();

    }

    public function employee_datatables()
    {
        $this->employee_datatables_query();
        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function getschedulerList()
    {

        $this->db->select('scheduler_on');
        $this->db->from('scheduler');
        $query = $this->db->get();
        return $query->row();

    }

    public function getschedulerAllList()
    {

        // return $this->db->where('status',1)->get('scheduler')->result_array();
        $sql = 'SELECT mn.id, mn.run_scheduler_expiry_date, mn.module, mn.scheduler_on, mn.minutes, mn.hours, mn.days, mn.month, mn.day, mn.Schdeuleno_days, mn.email_to, mn.status, mn.created_at, GROUP_CONCAT(ssm.name) AS sub_module_names FROM scheduler mn LEFT JOIN gtg_schedular_sub_modules ssm ON FIND_IN_SET(ssm.Id, mn.scheduler_on) > 0 WHERE mn.status = 1 GROUP BY mn.id, mn.run_scheduler_expiry_date, mn.module, mn.scheduler_on, mn.minutes, mn.hours, mn.days, mn.month, mn.day, mn.Schdeuleno_days, mn.email_to, mn.status, mn.created_at;';
        return $this->db->query($sql)->result_array();

    }

    public function getpassportExpiryListSixty()
    {
        $this->db->select('days');
        $this->db->from('scheduler');
        $query = $this->db->get();
        //print_r($this->db->last_query());
        $value = $query->row();
        $days = $value->days;

        $thirtydays = date('Y-m-d', strtotime('+487 days'));
        $sixtydays = date('Y-m-d', strtotime('+579 days'));

        /**$this->db->select('days');
        $this->db->from('scheduler');
        $this->db->where('module',8);
        $query = $this->db->get();
        $value=$query->row();*/

        $this->db->select('gtg_employees.id,gtg_employees.email,gtg_employees.name,gtg_employees.passport,gtg_employees.passport_expiry,
		 gtg_customers.name as cus_name');
        $this->db->from('gtg_employees');
        $this->db->join('gtg_customers', 'gtg_customers.id=gtg_employees.company');

        $this->db->where('passport_expiry>', $thirtydays);
        $this->db->where('passport_expiry<=', $sixtydays);
        $this->db->where('employee_type', "foreign");
        $this->db->where('delete_status', 0);
        $this->db->where('passport_email_sent', 0);
        $query = $this->db->get();
        //print_r($this->db->last_query());

        return $query->result_array();

    }

    public function getpassportExpiryListNinenty()
    {

        $this->db->select('days');
        $this->db->from('scheduler');
        $query = $this->db->get();
        //print_r($this->db->last_query());
        $value = $query->row();
        $days = $value->days;

        $thirtydays = date('Y-m-d', strtotime('+30 days'));
        $sixtydays = date('Y-m-d', strtotime('+60 days'));
        $ninentydays = date('Y-m-d', strtotime('+90 days'));

        /**$this->db->select('days');
        $this->db->from('scheduler');
        $this->db->where('module',8);
        $query = $this->db->get();
        $value=$query->row();*/

        $this->db->select('gtg_employees.id,gtg_employees.email,gtg_employees.name,gtg_employees.passport,gtg_employees.passport_expiry,
		 gtg_customers.name as cus_name');
        $this->db->from('gtg_employees');
        $this->db->join('gtg_customers', 'gtg_customers.id=gtg_employees.company');

        $this->db->where('passport_expiry>', $sixtydays);
        $this->db->where('passport_expiry<=', $ninentydays);
        $this->db->where('employee_type', "foreign");
        $this->db->where('delete_status', 0);
        $this->db->where('passport_email_sent', 0);
        $query = $this->db->get();

        return $query->result_array();

    }

    public function getpassportExpiryList()
    {
        $this->db->select('days');
        $this->db->from('scheduler');
        $query = $this->db->get();
        //print_r($this->db->last_query());
        $value = $query->row();
        $days = $value->days;
        $current_date = date('Y-m-d');

        $thirtydays = date('Y-m-d', strtotime('+487 days'));
        //$sixtydays=date('Y-m-d',strtotime('+60 days'));
        //$ninentydays=date('Y-m-d',strtotime('+80 days'));

        $this->db->select('gtg_employees.id,gtg_employees.email,gtg_employees.name,gtg_employees.passport,gtg_employees.passport_expiry,
		 gtg_customers.name as cus_name');
        $this->db->from('gtg_employees');
        $this->db->join('gtg_customers', 'gtg_customers.id=gtg_employees.company');

        //if($days==30)
        //{
        $this->db->where('passport_expiry<=', $thirtydays);
        $this->db->where('passport_expiry>=', $current_date);

        //}
        //else if($days==60)
        //{
        //$this->db->or_where('passport_expiry=', $sixtydays);

        //}
        //else{
        //$this->db->or_where('passport_expiry=', $ninentydays);

        //}
        //$this->db->or_where('passport_expiry>', $sixtydays);
        //$this->db->or_where('passport_expiry>', $ninentydays);

        $this->db->where('employee_type', "foreign");
        $this->db->where('delete_status', 0);
        $this->db->where('passport_email_sent', 0);
        $query = $this->db->get();
        //print_r($this->db->last_query());
        return $query->result_array();

    }

    public function getpermitExpiryList()
    {
        $this->db->select('days');
        $this->db->from('scheduler');
        $query = $this->db->get();
        //print_r($this->db->last_query());
        $value = $query->row();
        $days = $value->days;
        $current_date = date('Y-m-d');
        $thirtydays = date('Y-m-d', strtotime('+30 days'));
        $sixtydays = date('Y-m-d', strtotime('+60 days'));
        $ninentydays = date('Y-m-d', strtotime('+90 days'));
        $this->db->select('gtg_employees.id,gtg_employees.email,gtg_employees.name,gtg_employees.permit,gtg_employees.permit_expiry,gtg_customers.name as cus_name');
        $this->db->from('gtg_employees');
        $this->db->join('gtg_customers', 'gtg_customers.id=gtg_employees.company');

        //if($days==30)
        //{
        $this->db->where('permit_expiry<=', $thirtydays);
        $this->db->where('permit_expiry>=', $current_date);

        //}
        /*else if($days==60)
        {
        $this->db->or_where('permit_expiry=', $sixtydays);

        }
        else{
        $this->db->or_where('permit_expiry=', $ninentydays);

        }*/
        $this->db->where('employee_type', "foreign");
        $this->db->where('delete_status', 0);
        $this->db->where('permit_email_sent', 0);

        $query = $this->db->get();
        return $query->result_array();

    }
    public function getOrganizationDetails()
    {

        $this->db->select('*');
        $this->db->from('gtg_system');
        $query = $this->db->get();
        //print_r($this->db->last_query());
        return $value = $query->row();

    }

    public function getRoles()
    {

        $this->db->select('*');
        $this->db->from('gtg_role');
        $this->db->where('delete_status', 0);

        $query = $this->db->get();
        //print_r($this->db->last_query());
        return $query->result_array();

    }

    public function getpermitExpiryListSixty()
    {
        $this->db->select('days');
        $this->db->from('scheduler');
        $query = $this->db->get();
        //print_r($this->db->last_query());
        $value = $query->row();
        $days = $value->days;
        $current_date = date('Y-m-d');
        $thirtydays = date('Y-m-d', strtotime('+30 days'));
        $sixtydays = date('Y-m-d', strtotime('+60 days'));
        $ninentydays = date('Y-m-d', strtotime('+90 days'));
        $this->db->select('gtg_employees.id,gtg_employees.email,gtg_employees.name,gtg_employees.permit,gtg_employees.permit_expiry,gtg_customers.name as cus_name');
        $this->db->from('gtg_employees');
        $this->db->join('gtg_customers', 'gtg_customers.id=gtg_employees.company');

        //if($days==30)
        //{

        $this->db->where('passport_expiry>', $thirtydays);
        $this->db->where('passport_expiry<=', $sixtydays);
        //}
        /*else if($days==60)
        {
        $this->db->or_where('permit_expiry=', $sixtydays);

        }
        else{
        $this->db->or_where('permit_expiry=', $ninentydays);

        }*/
        $this->db->where('employee_type', "foreign");
        $this->db->where('delete_status', 0);
        $this->db->where('permit_email_sent', 0);

        $query = $this->db->get();
        return $query->result_array();

    }
    public function getpermitExpiryListNinenty()
    {

        $this->db->select('days');
        $this->db->from('scheduler');
        $query = $this->db->get();
        //print_r($this->db->last_query());
        $value = $query->row();
        $days = $value->days;
        $current_date = date('Y-m-d');
        $thirtydays = date('Y-m-d', strtotime('+30 days'));
        $sixtydays = date('Y-m-d', strtotime('+60 days'));
        $ninentydays = date('Y-m-d', strtotime('+90 days'));
        $this->db->select('gtg_employees.id,gtg_employees.email,gtg_employees.name,gtg_employees.permit,gtg_employees.permit_expiry,gtg_customers.name as cus_name');
        $this->db->from('gtg_employees');
        $this->db->join('gtg_customers', 'gtg_customers.id=gtg_employees.company');

        //if($days==30)
        //{
        $this->db->where('passport_expiry>', $sixtydays);
        $this->db->where('passport_expiry<=', $ninentydays);

        //}
        /*else if($days==60)
        {
        $this->db->or_where('permit_expiry=', $sixtydays);

        }
        else{
        $this->db->or_where('permit_expiry=', $ninentydays);

        }*/
        $this->db->where('employee_type', "foreign");
        $this->db->where('delete_status', 0);
        $this->db->where('permit_email_sent', 0);

        $query = $this->db->get();
        return $query->result_array();

    }

    public $ecolumn_order = array(null, 'gtg_employees.name', 'gtg_customers.company', 'gtg_employees.passport',
        'gtg_employees.passport_expiry', null, null);
    public $ecolumn_search = array('gtg_employees.name', 'gtg_customers.company', 'gtg_employees.passport',
        'gtg_employees.passport_expiry', 'gtg_employees.permit', 'gtg_employees.permit_expiry');
    public $eorder = array('gtg_employees.id' => 'desc');

    public function employee_datatables_query()
    {
        $empid = $_SESSION['id'];

        $currentdate = date("Y-m-d");
        $thirtydays = date('Y-m-d', strtotime('+30 days'));
        $sixtydays = date('Y-m-d', strtotime('+60 days'));

        $active = $this->input->post('active');
        $permitactive = $this->input->post('permit_active');
        $passport_expiry = $this->input->post('passport_expiry');
        $permit_expiry = $this->input->post('permit_expiry');
        $passport_thirty_expiry = $this->input->post('passport_thirty_expiry');
        $passport_sixty_expiry = $this->input->post('passport_sixty_expiry');
        $passport_ninety_expiry = $this->input->post('passport_ninety_expiry');
        $ninentydays = date('Y-m-d', strtotime('+90 days'));

        $permit_thirty_expiry = $this->input->post('permit_thirty_expiry');
        $permit_sixty_expiry = $this->input->post('permit_sixty_expiry');
        $permit_ninety_expiry = $this->input->post('permit_ninety_expiry');

        $this->db->select('gtg_employees.id,gtg_employees.name,gtg_employees.passport,gtg_employees.passport_document,
		gtg_employees.visa_document,gtg_employees.passport_expiry,permit_expiry,gtg_employees.passport,
		gtg_employees.permit,gtg_employees.delete_status,gtg_customers.company as cname');

        $this->db->from('gtg_employees');
        $this->db->join('gtg_customers', 'gtg_customers.id=gtg_employees.company', 'left');
        $this->db->where('gtg_employees.employee_type', "foreign");
        $this->db->where('gtg_employees.delete_status', 0);

        if ($this->aauth->get_user()->roleid == 2) {
            $this->db->where('gtg_employees.id', $empid);
        }
        if ($active) {
            $this->db->where('gtg_employees.passport_expiry>=', $currentdate);

        } else if ($permitactive) {
            $this->db->where('gtg_employees.permit_expiry>=', $currentdate);

        } else if ($passport_expiry) {
            $this->db->where('gtg_employees.passport_expiry<', $currentdate);

        } else if ($permit_expiry) {

            $this->db->where('gtg_employees.permit_expiry<', $currentdate);

        } else if ($passport_thirty_expiry) {

            $this->db->where('passport_expiry<=', $thirtydays);
            $this->db->where('passport_expiry>=', $currentdate);

        } else if ($passport_sixty_expiry) {

            $this->db->where('passport_expiry>', $thirtydays);
            $this->db->where('passport_expiry<=', $sixtydays);

        } else if ($passport_ninety_expiry) {
            $this->db->where('passport_expiry>', $sixtydays);
            $this->db->where('passport_expiry<=', $ninentydays);
        } else if ($permit_thirty_expiry) {

            $this->db->where('permit_expiry<=', $thirtydays);
            $this->db->where('permit_expiry>=', $currentdate);

        } else if ($permit_sixty_expiry) {

            $this->db->where('passport_expiry>', $thirtydays);
            $this->db->where('passport_expiry<=', $sixtydays);

        } else if ($permit_ninety_expiry) {
            $this->db->where('passport_expiry>', $sixtydays);
            $this->db->where('passport_expiry<=', $ninentydays);
        }

        //$this->db->order_by('gtg_employees.id', 'DESC');

        $i = 0;

        foreach ($this->ecolumn_search as $item) // loop column
        {
            //echo"<pre>";
            //print_r($item);
            $search = $this->input->post('search');
            if ($search) {
                $value = $search['value'];
            } else { $value = 0;}
            if ($value) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->acolumn_search) - 1 == $i) //last loop
                {
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            //print_r($search);
            $this->db->order_by($this->ecolumn_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->eorder)) {

            $order = $this->eorder;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function employee_count_filtered()
    {
        $this->employee_datatables_query();

        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->num_rows();
    }

    public function employee_count_all()
    {
        $this->attendance_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function employee_report_datatables()
    {
        $this->employee_report_datatables_query();
        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }

        $query = $this->db->get();
        return $query->result();

    }

    public $rcolumn_order = array(null, 'gtg_employees.name', 'tg_customers.company', 'gtg_countries.country_name',
        'gtg_employees.passport', 'gtg_employees.passport_expiry', 'gtg_employees.permit', 'gtg_employees.permit_expiry');
    public $rcolumn_search = array('gtg_employees.name', 'gtg_customers.company', 'gtg_countries.country_name',
        'gtg_employees.passport', 'gtg_employees.passport_expiry', 'gtg_employees.permit', 'gtg_employees.permit_expiry');
    public $rorder = array('gtg_employees.id' => 'desc');
    public function employee_report_datatables_query()
    {
        $company = $this->input->post('company');
        $employee = $this->input->post('employee');
        $this->db->select('gtg_employees.id,gtg_employees.name,gtg_countries.country_name,gtg_employees.passport,gtg_employees.passport_document,gtg_employees.visa_document,
		gtg_employees.passport_expiry,gtg_employees.permit,gtg_employees.permit_expiry,gtg_customers.company as client');
        $this->db->from('gtg_employees');

        if (!empty($company) && !empty($employee)) {
            $this->db->where('gtg_employees.id', $employee);
            $this->db->where('gtg_customers.id', $company);
            $this->db->where('gtg_employees.employee_type', "foreign");
            $this->db->join('gtg_countries', 'gtg_countries.id=gtg_employees.country');

            $this->db->join('gtg_customers', 'gtg_customers.id = gtg_employees.company');

        } else if (!empty($company) && empty($employee)) {
            $this->db->where('gtg_customers.id', $company);
            $this->db->where('gtg_employees.employee_type', "foreign");
            $this->db->join('gtg_countries', 'gtg_countries.id=gtg_employees.country');

            $this->db->join('gtg_customers', 'gtg_customers.id = gtg_employees.company');

        } else {
            $this->db->where('gtg_employees.employee_type', "foreign");
            $this->db->join('gtg_countries', 'gtg_countries.id=gtg_employees.country');

            $this->db->join('gtg_customers', 'gtg_customers.id = gtg_employees.company');

        }

        $this->db->where('gtg_employees.delete_status', 0);

        $i = 0;

        foreach ($this->rcolumn_search as $item) // loop column
        {
            $search = $this->input->post('search');
            if ($search) {
                $value = $search['value'];
            } else { $value = 0;}
            if ($value) {

                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->rcolumn_search) - 1 == $i) //last loop
                {
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) {
            $this->db->order_by($this->rcolumn_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->rcolumn_order)) {
            $order = $this->rcolumn_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function employee_report_count_filtered()
    {
        $this->employee_report_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function employee_report_count_all()
    {
        $this->employee_report_datatables_query();
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->num_rows();
    }

    public function country_list()
    {

        $this->db->select('*');
        $this->db->from('gtg_countries');
        $query = $this->db->get();

        return $query->result();

    }

    public $role_column_order = array(null, 'gtg_role.id', 'gtg_role.name', 'gtg_role.status');
    public $role_column_search = array('gtg_role.id', 'gtg_role.name', 'gtg_role.status');
    public $role_order = array('gtg_role.id' => 'desc');

    private function _role_datatables_query($id)
    {
        $this->db->select('*');
        $this->db->from('gtg_role');

        $i = 0;

        foreach ($this->role_column_search as $item) // loop column
        {
            $search = $this->input->post('search');
            $value = $search['value'];
            if ($value) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $value);
                } else {
                    $this->db->or_like($item, $value);
                }

                if (count($this->role_column_search) - 1 == $i) //last loop
                {
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }
        $search = $this->input->post('order');
        if ($search) // here order processing
        {
            $this->db->order_by($this->role_order[$search['0']['column']], $search['0']['dir']);
        } else if (isset($this->role_order)) {
            $order = $this->role_order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function role_datatables()
    {
        $this->_role_datatables_query();
        if ($this->input->post('length') != -1) {
            $this->db->limit($this->input->post('length'), $this->input->post('start'));
        }

        $query = $this->db->get();
        return $query->result();
    }

    public function rolecount_filtered()
    {
        $this->_role_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function rolecount_all()
    {
        $this->_role_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function add($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        return $this->db->update($this->table, $data, $where);
    }

    public function delete($where)
    {
        return $this->db->delete($this->table, $where);
    }

    public function get()
    {
        $this->db->select('*');
        $this->db->from('gtg_employees');
        $query = $this->db->get();

        return $query->row();
    }

    public function get_all($where = 0, $order_by_column = 0, $order_by = 0)
    {
        if ($where) {
            $this->db->where($where);
        }

        if ($order_by_column and $order_by) {
            $this->db->order_by($order_by_column, $order_by);
        }

        $query = $this->db->get($this->table);
        return $query->result();
    }

    public function get_num_rows($where = 0)
    {
        if ($where) {
            $this->db->where($where);
        }

        $query = $this->db->get($this->table);
        return $query->num_rows();
    }

    public function add_batch($data, $data1)
    {

        foreach ($data as $key => $value) {
            $result[$value['username']] = $value;

        }
        $count1 = count($data);
        $count2 = count($result);
        $count = $count1 - $count2;

        for ($i = 0; $i < count($data1); $i++) {
            $a = $this->aauth->create_user($data1[$i]['email'], $data1[$i]['pass'], $data1[$i]['name']);
            //$this->db->insert_batch('gtg_users', $data1);
            $data2 = array(
                'roleid' => $data1[$i]['roleid'],
            );
            $this->db->set($data2);
            $this->db->where('id', $a);

            $this->db->update('gtg_users');
        }
        $this->db->insert_batch('gtg_employees', $result);
        return $count;

    }

    public function get_fwms_employees_report($company, $employee)
    {

        $this->db->select('gtg_employees.id,gtg_employees.name,gtg_countries.country_name,gtg_employees.passport,gtg_employees.passport_document,gtg_employees.visa_document,
		gtg_employees.passport_expiry,gtg_employees.permit,gtg_employees.permit_expiry,gtg_customers.company as client');
        $this->db->from('gtg_employees');

        if (!empty($company) && !empty($employee)) {
            $this->db->where('gtg_employees.id', $employee);
            $this->db->where('gtg_customers.id', $company);
            $this->db->where('gtg_employees.employee_type', "foreign");
            $this->db->join('gtg_countries', 'gtg_countries.id=gtg_employees.country');

            $this->db->join('gtg_customers', 'gtg_customers.id = gtg_employees.company');

        } else if (!empty($company) && empty($employee)) {
            $this->db->where('gtg_customers.id', $company);
            $this->db->where('gtg_employees.employee_type', "foreign");
            $this->db->join('gtg_countries', 'gtg_countries.id=gtg_employees.country');

            $this->db->join('gtg_customers', 'gtg_customers.id = gtg_employees.company');

        } else {
            $this->db->where('gtg_employees.employee_type', "foreign");
            $this->db->join('gtg_countries', 'gtg_countries.id=gtg_employees.country');

            $this->db->join('gtg_customers', 'gtg_customers.id = gtg_employees.company');

        }
        $this->db->where('gtg_employees.delete_status', 0);
        $list = $this->db->get()->result();

        $data = array();
        $table = '<table border="1"><thead><tr><th>No</th><th>Name</th><th>Client</th><th>Country</th><th>Passport</th><th>Passport Expiry</th><th>Visa</th><th>Visa Expiry</th></tr></thead><tbody>';

        if (empty($list)) {
            $table .= '<tr><td colspan="8">No data available</td></tr>';
        } else {
            $no = 0;
            foreach ($list as $obj) {
                $no++;
                $table .= '<tr>';
                $table .= '<td>' . $no . '</td>';
                $table .= '<td>' . $obj->name . '</td>';
                $table .= '<td>' . $obj->client . '</td>';
                $table .= '<td>' . $obj->country_name . '</td>';
                $table .= '<td>' . $obj->passport . '</td>';
                $table .= '<td>' . $obj->passport_expiry . '</td>';
                $table .= '<td>' . $obj->permit . '</td>';
                $table .= '<td>' . $obj->permit_expiry . '</td>';
                $table .= '</tr>';
            }
        }

        $table .= '</tbody></table>';

        return $table;
        // Now you can use $data['table'] to display the HTML table in your view.

    }
}
