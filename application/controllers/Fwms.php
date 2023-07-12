<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Fwms extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
       // $this->load->model('customers_model', 'customers');
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if (!$this->aauth->premission(3)) {

            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');

        }
        $this->load->library("Custom");
		$this->li_a == "fwms";
    }
public function fwmsclients()
{
	   $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Fwms clients";
        $head['usernm'] = $this->aauth->get_user()->username;
		//$this->load->model('employee_model', 'employee');
       // $data['payslip']=$this->payroll->getPayslipList();
	    
        $this->load->view('fixed/header', $head);
        $this->load->view('customers/fwmsclients', $data);
        $this->load->view('fixed/footer');	
	
	
	
}
 	public function fwmsemployees()
{
	    $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Fwms employees";
        $head['usernm'] = $this->aauth->get_user()->username;
		$this->load->model('employee_model', 'employee');
       // $data['payslip']=$this->payroll->getPayslipList();

        $this->load->view('fixed/header', $head);
        $this->load->view('employee/fwmsemployees', $data);
        $this->load->view('fixed/footer');



}   


public function fwmsreport()
{

	    $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Fws Report";
        $head['usernm'] = $this->aauth->get_user()->username;
		$this->load->model('employee_model', 'employee');
        $data['clients'] = $this->employee->get_client_list();
$orgId = $_SESSION['loggedin'];
	// $this->load->model('payroll_model', 'payroll');
     $data['organization'] =$this->employee->getOrganizationDetails($orgId);
        $this->load->view('fixed/header', $head);
        $this->load->view('employee/fwmsReport', $data);
        $this->load->view('fixed/footer');
}


}