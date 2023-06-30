<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Payments extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payments_model', 'payments');
        if (!is_login()) {
            redirect(base_url() . 'user/profile', 'refresh');
        }
        $this->load->model('payments_model', 'payments');
        $this->load->model('system_model', 'adminemail');
        $this->load->model('User_model');
        $this->load->model('communication_model');
    }

    //invoices list
    public function index()
    {
        $head['title'] = "Payments";
        is_login();
        $userid = $this->session->userdata('user_details')[0]->users_id;
        $data['user_data'] = $this->User_model->get_users($userid);
        $head['user_data']=$data['user_data'];
        $this->load->view('includes/header',$head);
        $this->load->view('payments/payments');
        $this->load->view('includes/footer');
    }

  public function send_general()
    {
        $mailtoc=$this->adminemail->get_email_id();
        $email = $this->input->post('mailtoc');
        $customer = $this->input->post('customername');
        $mailtotilte = "Jsuite Cloud";
        $note = $this->input->post('notes');
        $amount = $this->input->post('amount');
        $cid = $this->input->post('cid');
        $message="Hi Admin,<br><br>client want to recharge account. <br>Customer Name:".$customer." <br>Customer id:".$cid." <br>Amount: ".$amount." <br>email:".$email." <br>Notes: ".$note;
        $subject="wallet recharge request from Customer:".$customer." id:".$cid;
        $attachmenttrue = false;
        $attachment = '';
        $config=array();
        $newname="";
    if ( $_FILES['afile']['name']!='' && $_FILES['afile']['size'] > 0 )
    {
        $tmpname = $_FILES['afile']['tmp_name'];
        $filename = $_FILES['afile']['name'];
        $exp = explode('.', $filename);
        $ext = end($exp);
        $newname = "prof_pay_" . time() . "." . $ext;
        $config['upload_path'] = '../userfiles/customers/';
        $config['upload_url'] = '../userfiles/customers/';
        $config['allowed_types'] = "jpg|jpeg|png";
        $config['file_name'] = $newname;
        $this->load->library('upload', $config);
        move_uploaded_file($tmpname, $config['upload_path'] . $newname);
        $attachmenttrue = true;
        $attachment = $config['upload_path'].$newname;
        }
        $redirecturl=base_url()."payments/recharge";
        ob_start();
        $status= $this->communication_model->send_email($mailtoc, $mailtotilte, $subject, $message, $attachmenttrue, $attachment);
        echo $status." ";
        $data=json_decode($status,TRUE);
        print_r($data);
        ob_end_clean();
        $this->session->set_flashdata('sstatus', $data['status']);
        unlink($config['upload_path'].$newname);
        redirect($redirecturl);
    }

    public function recharge()
    {
        $head['title'] = "Payments";
        $data['balance'] = $this->payments->balance($this->session->userdata('user_details')[0]->cid);
        $data['activity'] = $this->payments->activity($this->session->userdata('user_details')[0]->cid);
        $data['gateway'] = $this->payments->gateway_list('Yes');

        is_login();
        $userid = $this->session->userdata('user_details')[0]->users_id;
        $data['user_data'] = $this->User_model->get_users($userid);
        $head['user_data']=$data['user_data'];

        $this->load->view('includes/header',$head);
        $this->load->view('payments/recharge', $data);
        $this->load->view('includes/footer');
    }


    public function ajax_list()
    {
        $query = $this->db->query("SELECT currency FROM gtg_system WHERE id=1 LIMIT 1");
        $row = $query->row_array();

        $this->config->set_item('currency', $row["currency"]);


        $list = $this->payments->get_datatables();
        $data = array();

        $no = $this->input->post('start');
        $curr = $this->config->item('currency');

        foreach ($list as $invoices) {
            $no++;
            $row = array();
            $row[] = $invoices->date;
            $row[] =  amountExchange($invoices->credit, 0, $invoices->loc);
            $row[] =   amountExchange($invoices->debit, 0, $invoices->loc);
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->payments->count_all(),
            "recordsFiltered" => $this->payments->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
