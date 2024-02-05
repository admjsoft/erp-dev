<?php

defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Payroll extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll_model', 'payroll');
        $this->load->model('employee_model', 'employee');
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        ///if (!$this->aauth->premission(9)) {

         ///   exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
      //  }
        $this->li_a = 'payroll';
        $c_module = 'payroll';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);
    }

public function settings()
{
        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Add Payroll Settings";
        $head['usernm'] = $this->aauth->get_user()->username;
		 $this->load->model('employee_model', 'employee');

		$data['employee'] = $this->employee->list_all_employee();

		
        $this->load->view('fixed/header', $head);
        $this->load->view('payroll/settings', $data);
        $this->load->view('fixed/footer');	
}
public function save_settings()
{
		
	    $staff = $this->input->post('staff', true);
	    $staffInfo =$this->payroll->getSettings($staff);
        $basic = $this->input->post('basic', true);
        $epf = $this->input->post('epf', true);
        $epfEmployee = $this->input->post('epfEmployee', true);
        $epfEmp = $this->input->post('epfEmp', true);
        $epfEmpyr = $this->input->post('epfEmpyr', true);
        $socsoEmployerPer = $this->input->post('socsoEmployerPer', true);
        $socsoEmpPer = $this->input->post('socsoEmpPer', true);
        $socso = $this->input->post('socso', true);
        $socsoEmp = $this->input->post('socsoEmp', true);
        $pcb = $this->input->post('pcb', true);
        $eis = $this->input->post('eis', true);
        $bankName = $this->input->post('bankName', true);
        $bankAcc = $this->input->post('bankAcc', true);
        $nationality = $this->input->post('nationality', true);
        $taxId = $this->input->post('taxId', true);
        
        $employee_details = $this->employee->employee_details($staff);

		 if(!empty($staffInfo)){
            $update=$this->payroll->updatesettings($staff,$basic,$epf,$epfEmployee,$epfEmp,$epfEmpyr,$socsoEmployerPer,$socsoEmpPer,$socso,$socsoEmp,$pcb,$eis,$bankName,$bankAcc,$nationality,$taxId);
            if(!$update){
                    $data['status'] = 'danger';
                    $data['message'] = $this->lang->line('Settings error');
                    }
					
					else{
                    $data['status'] = 'success';
                    $data['message'] = $employee_details['name']." ".$this->lang->line('- Record Updated Successfully');
        }
        $_SESSION['status']=$data['status'];
        $_SESSION['message']=$data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');
     }
	 
	 else{
 $insert=$this->payroll->addsettings($staff,$basic,$epf,$epfEmployee,$epfEmp,$epfEmpyr,$socsoEmployerPer,$socsoEmpPer,$socso,$socsoEmp,$pcb,$eis,$bankName,$bankAcc,$nationality,$taxId);
 if(!$insert){
                    $data['status'] = 'danger';
                    $data['message'] = $this->lang->line('Settings error');
                    }
					
					else{
                    $data['status'] = 'success';
                    $data['message'] = $employee_details['name']." ".$this->lang->line('- Record Saved Successfully');
}
        $_SESSION['status']=$data['status'];
        $_SESSION['message']=$data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');
	 }
        redirect('payroll/settings', 'refresh');
        exit();
}

public function getSettings()
{
		     $staff = $this->input->get('staffId');
            $settings=$this->payroll->getSettings($staff);
			//print_r($settings);
	        echo json_encode($settings);

}

public function payroll()
{
	    $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Payroll";
        $head['usernm'] = $this->aauth->get_user()->username;
		$data['employee'] = $this->payroll->getSettingsEmployee();
        $this->load->view('fixed/header', $head);
        $this->load->view('payroll/create', $data);
        $this->load->view('fixed/footer');	
	
}
public function paymentVoucher()
{
	
        $methodOfPayment = $this->input->post('methodOfPayment');
        $theSumOf = $this->input->post('theSumOf');
        $being = $this->input->post('being');
        $payee = $this->input->post('payee');
        $date = $this->input->post('datePaymentVoucher');
		$amountPaymentVoucher = $this->input->post('amountPaymentVoucher');
		$payee = $this->input->post('payee');
	    $amount = $amountPaymentVoucher;//amount
        //$rowOrg = getOrganizationDetails($con,$_SESSION['orgId']);
        //$rowOrgUser = fetchOrganizationUserbyId($con,$_SESSION['userid']);
       $approvedBy = $_SESSION['username'];//approvedBy
       $paidBy = "JsuitesCloud";//paidBy

        $logged_in_user = $this->aauth->get_user()->username;
        $logged_in_user_id = $this->aauth->get_user()->id;

        $employee = $this->employee->employee_details($logged_in_user_id);
        $logged_in_user = '';
        $logged_in_user_sign = '';
       if(!empty($employee))
       {
        
        if(!empty($employee['name']))
        {
            $logged_in_user = $employee['name'];     
        }else{
            $logged_in_user = '';
        }
        if(!empty($employee['sign']))
        {           
            $logged_in_user_sign =  base_url('userfiles/employee_sign/')."/".$employee['sign'];     
        }else{
            $logged_in_user_sign = '';
        }

       }
       
       $to = $payee;//to

      $refNo = "<i></u> [Generated after Payment Voucher is submitted]<u></i>";//refNo

  //(START)STORE SESSION FOR BUILDING PDF
     $_SESSION['methodOfPayment'] = $methodOfPayment;//methodOfPayment
     $_SESSION['theSumOf'] = $theSumOf;//theSumOf
     $_SESSION['being'] = $being;//being
     $_SESSION['payee'] = $payee;//payee
     $_SESSION['date'] = $date;//date
     $_SESSION['amount'] = $amount;//amount
     $_SESSION['approvedBy'] = $approvedBy;//approvedBy
     $_SESSION['paidBy'] = $paidBy;//paidBy
     $_SESSION['to'] = $to;//to
  //(END)STORE SESSION FOR BUILDING PDF

   $paymentVoucher=$this->payroll->paymentVoucherDesign($refNo,$amount,$date,$methodOfPayment,$to,$theSumOf,$being,$payee,$approvedBy,$paidBy,$logged_in_user,$logged_in_user_sign);
	
	echo json_encode($paymentVoucher);
}

public function generatePaymentVoucher()
{
	
        $logged_in_user = $this->aauth->get_user()->username;
        $logged_in_user_id = $this->aauth->get_user()->id;

       $employee = $this->employee->employee_details($logged_in_user_id);
       $logged_in_user = '';
        $logged_in_user_sign = '';
       if(!empty($employee))
       {
        
        if(!empty($employee['name']))
        {
            $logged_in_user = $employee['name'];     
        }else{
            $logged_in_user = '';
        }
        if(!empty($employee['sign']))
        {           
            $logged_in_user_sign =  base_url('userfiles/employee_sign/')."/".$employee['sign'];     
        }else{
            $logged_in_user_sign = '';
        }

       }

$methodOfPayment = $_SESSION['methodOfPayment'];//methodOfPayment
  $theSumOf = $_SESSION['theSumOf'];//theSumOf
  $being = $_SESSION['being'];//being
  $payee = $_SESSION['payee'];//payee
  $date = $_SESSION['date'];//date
  $amount = $_SESSION['amount'];//amount
  $approvedBy = $_SESSION['approvedBy'];//approvedBy
  $paidBy = $_SESSION['paidBy'];//paidBy
  $to = $_SESSION['to'];//to
    $bonus="";
			$payslipName = "P".rand(1000000,9999999).".pdf";

    if(isset($_SESSION['bonus'])){
        $bonus = $_SESSION['bonus'];}
  $refNo = substr($payslipName, 0 , (strrpos($payslipName, ".")));
  $paymentVoucher = $this->payroll->buildpaymentVoucher($refNo,$amount,$date,$methodOfPayment,$to,$theSumOf,$being,$payee,$approvedBy,$paidBy,$logged_in_user,$logged_in_user_sign);
 //(START)DATE ERROR FIX: Have to change date format by using string replace due to unknown error
  $date = str_replace("/","-",$date);
  $date = date("Y-m-d", strtotime($date));
  //(END)DATE ERROR FIX
	//(START)FULFILLING THE ARGUMENTS
  $monthText = $this->payroll->getMonthInText($date);

  $year=date("Y");
  $month='';

  $staffName = $being;
  $staffId = null;
  $employeeId = null;
  $designation = null;
  $department = null;
  $salaryMonth = $amount;
  $epf = null;
  $epfPerc = null;
  $socso = null;
  $pcb = null;
  $totalEarning = $amount;
  $totalDeduction = null;
  $datePayment = $date;
  $bankName = null;
  $bankAcc = null;
  $netPay = $amount;
  $payslipName = null;
  $paymentVoucher = $paymentVoucher;
  $feedback = $this->payroll->insertPayslipInformation($monthText,$payee,$staffId,$employeeId,$designation,$department,$salaryMonth,$epf,$epfPerc,
  $socso,$pcb,null,null,null,null,null,$totalEarning,$totalDeduction,$datePayment,$bankName,$bankAcc,$netPay,$payslipName,$paymentVoucher,$year,$month);
if(!$feedback){
                    $data['status'] = 'danger';
                    $data['message'] = $this->lang->line('Settings error');
                    }
					
					else{
                    $data['status'] = 'success';
                    $data['message'] = $this->lang->line('PAYMENT VOUCHER IS CREATED');
}
        $_SESSION['status']=$data['status'];
        $_SESSION['message']=$data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');

 redirect('payroll/payroll');
        exit();

}

public function payslip()
{

    $staffId = $this->input->post('staffId');
    $month = $this->input->post('month');
	$monthvalue = $this->input->post('month');

    $year = $this->input->post('yearSlip');
    $datePayment = $this->input->post('datePayment');
    $datePayment = date("d/m/Y", strtotime($datePayment));
	
    

    $this->db->select('*');
    $this->db->from('gtg_payslip');
    $this->db->where('staffId', $staffId);
    $this->db->where('month', $month);
    $this->db->where('year', $year);
    $query_check = $this->db->get();
    $result_check = $query_check->num_rows();
    
    // echo $this->db->last_query();
    // echo $result;
    if($result_check <= 0)
    {
        
    

	$allowance=$this->input->post('allowance');
	$claims=$this->input->post('claims');
	$commissions=$this->input->post('commissions');
	$ot=$this->input->post('ot');
    $bonus=$this->input->post('bonus');
    $deduction=$this->input->post('deduction');

	if($allowance ==""){
		$allowance=0;
	}else{
		$allowance=number_format($allowance,2,".","");
	}
	if($claims ==""){
		$claims=0;
	}else{
		$claims=number_format($claims,2,".","");
	}
	if($commissions ==""){
		$commissions=0;
	}else{
		$commissions=number_format($commissions,2,".","");
	}
	if($ot ==""){
		$ot=0;
	}else{
		$ot=number_format($ot,2,".","");
	}
    if($bonus==""){
        $bonus=0;
    }
    else{
        $bonus=number_format($bonus,2,".","");
    }
    if($deduction==""){
        $deduction=0;
    }
    else{
        $deduction=number_format($deduction,2,".","");
    }
	    $staff =$this->payroll->getStaffDetails($staffId);
       // print_r($staff);
	 $staffName = $staff->name;
    $employeeId = "00000".$staff->id;
	if(empty($staff->degis))
	{
		$designation="None";
	}else{
    $designation = $this->payroll->getdesgination($staff->degis);
	}
    if(empty($staff->dept))
	{
		$department="None";
	}else{
    $department = $this->payroll->getDepartment($staff->dept);
	}
	
	    //ORGANIZATION DETAILS
    $orgId = $_SESSION['loggedin'];
    $organization =$this->payroll->getOrganizationDetails($orgId);
    $address = "<p style='font-size:10px;width:196px;position:relative;float: left;margin: 0;'>".$organization->address.",".$organization->city.",".$organization->region."<br>".$organization->country.",".$organization->postbox."</p>";

	
    $payroll = $this->payroll->getSettings($staffId);
	
    $nasionalityCheck = $payroll->nationality;
		    if(isset($nasionalityCheck))
			{
    if ($nasionalityCheck==1) {
      $nasionality = "Malaysian";
    }elseif ($nasionalityCheck==2) {
      $nasionality = "Foreigner";
    }
			}
	    if(isset($payroll->tax_no))
		{
    $taxId = $payroll->tax_no;
		}
		   if(isset($payroll->basic_salary))
		{
    $salaryMonthCalc = $payroll->basic_salary;
		}
   // $epfCalc = $payroll['epf'];
	$epfCalc="";
	if(isset($payroll->epf_employer)){
	$epfCalc = $payroll->epf_employer;
		$epf=$epfCalc;
	}
		   if(isset($payroll->sosco_employer))
		   {
    $socsoCalc =$payroll->sosco_employer;
		   }
		   if(isset($payroll->pcb))
		   {
    $pcbCalc = $payroll->pcb;
		   }
	
	
    $salaryMonth = number_format($payroll->basic_salary,2,".","");
    // $epf = number_format($epfTotal,2);
    $socso = number_format($payroll->sosco_employer,2,".","");
    $socsoEmp = number_format($payroll->sosco_employee,2,".","");
    $pcb = number_format($payroll->pcb,2,".","");
	$eis= number_format($payroll->eis,2,".","");
	$epfEmp= number_format($payroll->epf_employee,2,".","");
	$epfEmpyr= number_format($payroll->epf_employer,2,".","");
	//$advance="";
	//$advance=$allowance + $claims + $commissions + $ot + $bonus;
	$advance=$this->payroll->checknum($allowance) + $this->payroll->checknum($claims) + $this->payroll->checknum($commissions) + $this->payroll->checknum($ot)+ $this->payroll->checknum($bonus);
    //$totalEarning = number_format(($salaryMonth + $advance),2);
    $totalEarning = $this->payroll->checknum($advance) + $this->payroll->checknum($payroll->basic_salary);
    
	if(isset($payroll->nationality))
	  {
$totalDeductionCalc='';
  if ($nasionalityCheck==1) {
      $console = "<script>console.log('nasionality=0')</script>";
      $totalDeductionCalc = $this->payroll->checknum($socsoEmp) + $this->payroll->checknum($pcbCalc)+$this->payroll->checknum($eis)+$this->payroll->checknum($epfEmp)+ $this->payroll->checknum($deduction);
      $epfRight=number_format($epfEmp,2,".","");
      $socsoRight=number_format($socsoEmp,2,".","");
      $pcbRight=number_format($pcb,2,".","");
	  $eisRight=number_format($eis,2,".","");

      $epfLeft=number_format($epfEmpyr,2,".","");
      $socsoLeft=number_format($socso,2,".","");
      $pcbLeft="-";
      $eisLeft=number_format($eis,2,".","");


    }elseif($nasionalityCheck==2){
      $console = "<script>console.log('nasionality=1')</script>";
      $totalDeductionCalc = $this->payroll->checknum($pcbCalc) + $this->payroll->checknum($epfEmp)+ $this->payroll->checknum($deduction);

      $epfRight=number_format($epfEmp,2,".","");
      $socsoRight="-";
      $pcbRight=number_format($pcb,2,".","");
	  $eisRight="-";

      $epfLeft=number_format($epfEmpyr,2,".","");
      $socsoLeft="-";
      $pcbLeft="-";
      $eisLeft="-";
    }
	  }
	/*
    if (isset($_SESSION['staffloan']) && $_SESSION['staffloan'] == 1) {
        require_once($_SERVER['DOCUMENT_ROOT'].$config['appRoot']."/phpfunctions/role.php");
        $data=getLoanDetails($staffId);
        if(!empty($data)){
            $loanAmount=$data['amount'];
            $emi=$data['emi'];
            $pending=$loanAmount-$emi;
            $date4=$data['start_date'];
            $date2=date("Y-m-d",mktime(0,0,0,$month,1,$year));
            $ts1 = strtotime($date4);
            $ts2 = strtotime($date2);

            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);

            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);

            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
            if($diff>=0 && $pending>=0){
                $condition=true;
                $totalDeductionCalc=checknum($totalDeductionCalc)+checknum($emi);
                $_SESSION['loanAmount']=$loanAmount;
                $_SESSION['pending']=$pending;
                $_SESSION['emi']=$emi;
                $_SESSION['start_date']=$date4;
                $_SESSION['date2']=$date2;
            }
        }
    }*/

    $totalDeduction = number_format($totalDeductionCalc,2,".","");
    $netPayCalc = $totalEarning - $totalDeductionCalc;

    $netPay = number_format($netPayCalc,2,".","");

    $bankName = $payroll->bank;
    $bankAcc = $payroll->accountno;

    switch ($month) {
    case "1":
        $monthText = "January";
        break;
    case "2":
        $monthText = "February";
        break;
    case "3":
        $monthText = "March";
        break;
    case "4":
        $monthText = "April";
        break;
    case "5":
        $monthText = "May";
        break;
    case "6":
        $monthText = "Jun";
        break;
    case "7":
        $monthText = "July";
        break;
    case "8":
        $monthText = "August";
        break;
    case "9":
        $monthText = "September";
        break;
    case "10":
        $monthText = "October";
        break;
    case "11":
        $monthText = "November";
        break;
    case "12":
        $monthText = "December";
        break;
    default:
        $monthText = "Error";
    }
		            $imageurl = base_url('userfiles/company/') . $organization->logo;

 //define session value to be used in phpfunctions/pdf/payslipPDF.php
    $_SESSION['nasionalityCheck'] = $nasionalityCheck;
    $_SESSION['address'] = $organization->address.",".$organization->city.",".$organization->region.",".$organization->country.", ".$organization->postbox;
   $_SESSION['monthText'] = $monthText;
   $_SESSION['monthvalue'] = $monthvalue;

    $_SESSION['staffName'] = $staffName;
    $_SESSION['staffId'] = $staffId;
	$_SESSION['logoimage']=$imageurl;
    $_SESSION['taxId'] = $taxId;
    $_SESSION['nasionality'] = $nasionality;
    $_SESSION['employeeId'] = $employeeId;
    $_SESSION['designation'] = $designation;
    $_SESSION['department'] = $department;
    $_SESSION['salaryMonth'] = $salaryMonth;
    $_SESSION['year'] = $year;
    $_SESSION['socsoEmp'] = $socsoEmp;

    $_SESSION['allowance'] = $allowance;
    $_SESSION['claims'] = $claims;
    $_SESSION['commissions'] = $commissions;
    $_SESSION['ot'] = $ot;
	$_SESSION['bonus']=$bonus;
	$_SESSION['deduction']=$deduction;

    $_SESSION['epf'] = $epfCalc;
    $_SESSION['epfPerc'] = $epfCalc;
    $_SESSION['socso'] = $socso;
    $_SESSION['pcb'] = $pcb;

    $_SESSION['totalEarning'] = $totalEarning;
	$_SESSION['totalDeduction'] = $totalDeduction;
    $_SESSION['datePayment'] = $datePayment;
    $_SESSION['bankName'] = $bankName;
    $_SESSION['bankAcc'] = $bankAcc;
    $_SESSION['netPay'] = $netPay;
    $_SESSION['epfLeft'] = $epfLeft;
    $_SESSION['epfRight'] = $epfRight;
    $_SESSION['socsoLeft'] = $socsoLeft;
    $_SESSION['socsoRight'] = $socsoRight;
    $_SESSION['pcbLeft'] = $pcbLeft;
    $_SESSION['pcbRight'] = $pcbRight;

	$_SESSION['eis'] = $eis;
	$_SESSION['epfEmp'] = $epfEmp;
	$_SESSION['epfEmpyr'] = $epfEmpyr;

	$_SESSION['eisLeft']=$eisLeft;
	$_SESSION['eisRight']=$eisRight;


    $style="style='margin-bottom:2px'";	
	$adisplay="";
	$ndisplay="";
	$adisplay.="<p style='text-align:right;'>&nbsp;</p><p style='text-align:right;'>&nbsp;</p><p style='text-align:right;'>&nbsp;</p><p style='text-align:right;'>&nbsp;</p>";
    if ((isset($_SESSION['staffloan']) && ($_SESSION['staffloan'] == 1)) && (($emi!=0) && ($condition==true))) {
        $ndisplay.='<p>EMI</p>';
        $adisplay.="<p style='text-align:right;'>&nbsp;</p>";
    }
    if($deduction !=0){
        $ndisplay.="<p>DEDUCTION</p>";
        $adisplay.="<p style='text-align:right;'>&nbsp;</p>";
    }
	if($allowance !=0){
		$ndisplay.="<p>ALLOWANCE</p>";
		$adisplay.="<p style='text-align:right;'>".$this->payroll->pointNumber($allowance)."</p>";
	}
	if($claims !=0){
		$ndisplay.="<p>CLAIMS</p>";
		$adisplay.="<p style='text-align:right;'>".$this->payroll->pointNumber($claims)."</p>";
		
	}
	if($commissions !=0){
		$ndisplay.="<p>COMMISSIONS</p>";
		$adisplay.="<p style='text-align:right;'>".$this->payroll->pointNumber($commissions)."</p>";
	}
	if($ot !=0){
		$ndisplay.="<p>OT</p>";
		$adisplay.="<p style='text-align:right;'>".$this->payroll->pointNumber($ot)."</p>";
	}
    if($bonus !=0){
        $ndisplay.="<p>BONUS</p>";
        $adisplay.="<p style='text-align:right;'>".$this->payroll->pointNumber($bonus)."</p>";
    }

	
    $slip=$console."<div class='p-3' style='border: 4px double black;width:100%;'>";
    $slip.="";
//     <div class="row pt-3 pr-3 pl-3">
//   <div class="p-3" style="border:1px solid black;width:70%">
//         <img style="width:20%;float:left" src="'.$imageurl.'" >
//         <center><h3><b>SALARY SLIP</b></h3></center>'.$address.'<center><h7><b>'.$monthText.' '.$year.'</b></h7></center>
//     </div>
//     <div class="p-3" style="background:#00B5B8;color:#fff;border:1px solid black;width:30%;border-left:0px;">
//         <center><h2 style="font-size:20px;"><b>CONFIDENTIAL</b></h2></center>
//     </div>
// </div>
    $slip.='<div class="row pt-3 pr-3 pl-3"><div class="p-3" style="border: 1px solid black; width: 70%; overflow: hidden; text-align: center;">
    <h3 style="margin-bottom: 10px;"><b>SALARY SLIP</b></h3>
      <div style="text-align: center;">
            <h7><b>'.$monthText.' '.$year.'</b></h7>
        </div>
    <div style="text-align: center;">
        <div style="float: left; width: 25%;">
            <img style="width: 100%;" src="'.$imageurl.'">
        </div>
        
      
        
        <div style="clear: both;"></div>
        <div style="float: left; text-align: left; width: 40%; margin-top:10px">
            <p style="font-size: 10px; margin: 0;">'.$address.'</p>
        </div>
    </div>
    
</div>
<div class="p-3" style="background:#00B5B8;color:#fff;border:1px solid black;width:30%;border-left:0px;">
            <center><h2 style="font-size:20px;"><b>CONFIDENTIAL</b></h2></center>
        </div>
        </div>
<!--
<div class="row pt-3 pr-3 pl-3">
    <div class="col" colspan="3" style="width:100%;"><img style="width:100%;" src="" ></div>
</div>-->


<div class="row pb-0 pr-3 pl-3">
    <div class="p-3" style="border:1px solid black;border-top:0px;width:50%">
        <p style="margin-bottom:2px" >Name: '.$staffName.'</p>
        <p style="margin-bottom:2px" >Employee ID: '. $employeeId .'</p>
        <p style="margin-bottom:2px">Tax ID: '.$taxId.'</p>
        <p style="margin-bottom:2px">Nationality: '.$nasionality.'</p>
    </div>

    <div class="p-3" style="border:1px solid black;border-top:0px;width:50%;border-left:0px;">';
        if(isset($designation)&&!empty($designation)){$slip.='<p>Designation: '.$designation.'</p>';}
		if(isset($department)&&!empty($department)){$slip.='<p>Department: '.$department.'</p>';}
	//	$slip.='<p>Salary For Month: '.$salaryMonth.'</p>';
		$slip.='<p>Salary Month: RM '.$this->payroll->pointNumber($totalEarning).'</p>';
    $slip.='</div>

</div>

<div class="row pb-0 pr-3 pl-3">
    <div class="p-1" style="background:#26C0C3 ;color:white;border:1px solid black;border-top:0px;width:50%">
    <center>Description</center></div>

    <div class="p-1" style="background:#26C0C3;color:white;border:1px solid black;border-top:0px;width:25%;border-left:0px;"><center>Earnings</center></div>

    <div class="p-1" style="background:#26C0C3;color:white;border:1px solid black;border-top:0px;width:25%;border-left:0px;"><center>Deductions</center></div>
</div>

    <div class="row pb-0 pr-3 pl-3">
        <div class="p-1" style="border:1px solid black;border-top:0px;width:50%">
        <p>Basic Salary</p>
        <p>EPF(%)</p>
        <p>SOCSO</p>
        <p>PCB</p>
        <p>EIS</p>';
             $slip.=''.$ndisplay.'
        </div>
        <div class="p-1" style="border:1px solid black;border-top:0px;width:25%;border-left:0px;">
            <p style="text-align:right;">RM '.$this->payroll->pointNumber($salaryMonth).'</p>'.$adisplay.'
        </div>

        <div class="p-1" style="border:1px solid black;border-top:0px;width:25%;border-left:0px;">

        <div style="text-align:right;border-bottom:1px solid black;margin-bottom:13px;display: flex;">
        <div style="display:inline-block; width: 60%; padding-left:20px;padding-right:20px;border-right:1px solid black;">Employer</div>
        <div style="display:inline-block;width:60%;padding-left:10px;padding-right:20px">Employee</div>
        </div>

        <div style="text-align:right;border-bottom:1px solid black;margin-bottom:13px;display: flex;">
            <div style="display:inline-block;width:50%;padding-right:20px;border-right:1px solid black;">&nbsp;'.$this->payroll->pointNumber($epfLeft).'</div>
            <div style="display:inline-block;width:50%;padding-right:20px">&nbsp;'.$this->payroll->pointNumber($epfRight).'</div>
        </div>

        <div style="text-align:right;border-bottom:1px solid black;margin-bottom:13px;display: flex;">
            <div style="display:inline-block;width:50%;padding-right:20px;border-right:1px solid black;">&nbsp;'.$this->payroll->pointNumber($socsoLeft).'</div>
            <div style="display:inline-block;width:50%;padding-right:20px">&nbsp;'.$this->payroll->pointNumber($socsoRight).'</div>
        </div>

        <div style="text-align:right;border-bottom:1px solid black;margin-bottom:13px;display:flex;">
            <div style="display:inline-block;width:50%;padding-right:20px;border-right:1px solid black;">&nbsp;'.$this->payroll->pointNumber($pcbLeft).'</div>
            <div style="display:inline-block;width:50%;padding-right:20px">&nbsp;'.$this->payroll->pointNumber($pcbRight).'</div>
        </div>

        <div style="text-align:right;border-bottom:1px solid black;margin-bottom:13px;display:flex;">
            <div style="display:inline-block;width:50%;padding-right:20px;border-right:1px solid black;">&nbsp;'.$this->payroll->pointNumber($eisLeft).'</div>
            <div style="display:inline-block;width:50%;padding-right:20px">&nbsp;'.$this->payroll->pointNumber($eisRight).'</div>
        </div>';
        if ((isset($_SESSION['staffloan']) && ($_SESSION['staffloan'] == 1)) && (($emi!=0) && ($condition==true))) {
            $slip .= '<div style="text-align:right;border-bottom:1px solid black;margin-bottom:13px;display:flex;">
            <div style="display:inline-block;width:50%;padding-right:20px;border-right:1px solid black;">&nbsp;-</div>
            <div style="display:inline-block;width:50%;padding-right:20px">&nbsp;' . $this->payroll->pointNumber($emi) . '</div>
        </div>';
         }
    if($deduction !=0){
        $slip .= '<div style="text-align:right;border-bottom:1px solid black;margin-bottom:13px;display:flex;">
            <div style="display:inline-block;width:50%;padding-right:20px;border-right:1px solid black;">-</div>
            <div style="display:inline-block;width:50%;padding-right:20px">&nbsp;' . $this->payroll->pointNumber($deduction) . '</div>
        </div>';
    }
        $slip.='<!--	//allowance
                //$slip.=$adisplay; -->
        </div>
    </div>
    <div class="row pb-0 pr-3 pl-3">
        <div class="p-1" style="border:1px solid black;border-top:0px;width:50%">
            <p>Total</p>
        </div>
        <div class="p-1" style="border:1px solid black;border-top:0px;width:25%;border-left:0px;">
            <p style="text-align:right;">RM '.$this->payroll->pointNumber($totalEarning).'</p>
        </div>
        <div class="p-1" style="border:1px solid black;border-top:0px;width:25%;border-left:0px;">
            <p style="text-align:right;">RM '.$this->payroll->pointNumber($totalDeduction).'</p>
        </div>
    </div>

    <div class="row pb-0 pr-3 pl-3">
        <div class="p-3" style="border:1px solid black;border-top:0px;width:50%">
            <p>Salary Slip Date: '.$datePayment.'</p>
            <p>Bank Name: '.$bankName.'</p>
            <p>Bank Account Name: '.$staffName.'</p>
            <p>Bank Account: '.$bankAcc.'</p>
        </div>

        <div style="border:1px solid black;border-top:0px;width:50%;border-left:0px;">
            <div style="background:#26C0C3;color:white;border-bottom:1px solid black;"><center><b>NET PAY</b></center></div>

            <div style="background:#26C0C3;color:white;border-bottom:1px solid black;"><center><h5>RM '.$this->payroll->pointNumber($netPay).'</h5></center></div>

            <div class="pt-5" style="height:100%"><center><h4></h4></center></div>
        </div>
    </div>

    <div class="pb-0 pr-3 pl-3">
        <center><p><i><b>This is a computer generated document</b></i></p></center>
    </div>';
    $_SESSION['payslip'] = $slip;
    //echo $slip;

        $response['status'] = '200';
        $response['message'] = 'payslip Generated Successfully';
        $response['html'] = $slip;
    }else{
        $response['status'] = '500';
        $response['message'] = 'Payslip already generated for this month for this employee. Please refer to list of payslips.';
        $response['html'] = '';
    }
    
    echo json_encode($response);
}

public function generatePayslip()
{
        // $employee_details = $this->employee->employee_details($staff);
	   $monthText = $_SESSION['monthText'];
        $staffName = $_SESSION['staffName'];
        $staffId = $_SESSION['staffId'];
        $employeeId = $_SESSION['employeeId'];
		  $monthvalue = $_SESSION['monthvalue'];

        $designation = $_SESSION['designation'];
        $department = $_SESSION['department'];
        $salaryMonth = $_SESSION['salaryMonth'];
      //  $slipYear=$_SESSION['salaryYear'];
        $employee_details = $this->employee->employee_details($staffId);
	     $staffemail=$this->payroll->getStaffDetails($staffId);
        $epf = $_SESSION['epf'];
        $epfPerc = $_SESSION['epfPerc'];
        $socso = $_SESSION['socso'];
        $pcb = $_SESSION['pcb'];
	    $eis = $_SESSION['eis'];
	    $epfEmp = $_SESSION['epfEmp'];
	    $epfEmpyr = $_SESSION['epfEmpyr'];
        $allowance = $_SESSION['allowance'];
        $claims = $_SESSION['claims'];
        $commissions = $_SESSION['commissions'];
        $ot = $_SESSION['ot'];
        $year=$_SESSION['year'];
        $bonus="";
        $deduction="";
	    $datePayment = $_SESSION['datePayment'];//ET
    if(isset($_SESSION['bonus'])){
        $bonus = $_SESSION['bonus'];}
    if(isset($_SESSION['deduction'])){
        $deduction = $_SESSION['deduction'];}
        $totalEarning = $_SESSION['totalEarning'];
        $totalDeduction = $_SESSION['totalDeduction'];
        $bankName = $_SESSION['bankName'];
        $bankAcc = $_SESSION['bankAcc'];
        $netPay = $_SESSION['netPay'];
    //$rowOrgUser = fetchOrganizationUserbyId($con,$staffId);
    //$_SESSION['staffId']=$rowOrgUser['staffId'];
      //  $orgId=$_SESSION['orgId'];
    $pending=0;
		//$payslipDirectory=$_SERVER['DOCUMENT_ROOT'].$config['appRoot']."/resources/".$orgId."/payslip/";
	//(START)DATE ERROR FIX: Have to change date format by using string replace due to unknown error
        $datePayment = str_replace("/","-",$datePayment);
		 $datePayment = date("Y-m-d", strtotime($datePayment));
	//(END)DATE ERROR FIX
		    $payslipDirectory="./payslip";

  $check=$this->payroll->insertPayslipCheck($staffId,$monthText,$datePayment);
if(empty($check)){
   if(!is_dir($payslipDirectory)) //create the folder if it's not exists
    {
      mkdir($payslipDirectory,0755,TRUE);
    } 
}
$payslipPDF=$this->payroll->generatePayslipPDF();
$payslipName = "P".rand(1000000,9999999).".pdf";
		$payslipPDF->output($payslipDirectory."/".$payslipName,'F');
        $paymentVoucher = null;
 $feedback = $this->payroll->insertPayslipInformation($monthText,$staffName,$staffId,$employeeId,$designation,$department,$salaryMonth,$epf,$epfPerc,$socso,$pcb,$allowance,$claims,$commissions,$ot,$bonus,$totalEarning,$totalDeduction,$datePayment,$bankName,$bankAcc,$netPay,$payslipName,null,$year,$monthvalue);
		 $mailto=$staffemail->email;
         $mailtotitle="";
		 $subject="payslip";
		 $message="Hii $staffName This is Your  $monthText $year payslip";
		 $attachmenttrue="true";
		 $attachment=$payslipDirectory."/".$payslipName;
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
        $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto, $mailtotitle, $subject, $message, $attachmenttrue, $attachment);


if(!$feedback){
                    $data['status'] = 'danger';
                    $data['message'] = $this->lang->line('Settings error');
                    }
					
					else{
				$data['status'] = 'success';
                    $data['message'] = $this->lang->line('Pay slip for')." ".$employee_details['name']."".$this->lang->line('Created');
}
        $_SESSION['status']=$data['status'];
        $_SESSION['message']=$data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');
 redirect('payroll/payroll');
        exit();
}


public function viewpaySlip()
{

	
        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "View Pay Slip";
        $head['usernm'] = $this->aauth->get_user()->username;
		$this->load->model('employee_model', 'employee');

		$data['employee'] = $this->employee->list_employee();
        $data['payslip']=$this->payroll->getPayslipList();
	
        $this->load->view('fixed/header', $head);
        $this->load->view('payroll/viewpaySlip', $data);
        $this->load->view('fixed/footer');	
	
}
	

  public function deletePayslip() {
        $id = $this->input->post('deleteid');
        $delete = $this->payroll->deletePayslip($id);
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        //echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('Error In Delete')));
    }
	
	public function paysliplist()
{
	     $ttype = $this->input->get('type');
         $list = $this->payroll->get_datatables($ttype);
         $data = array();
        // $no = $_POST['start'];
         $no = $this->input->post('start');
         $temp='';
		 $type='';
        foreach ($list as $prd) {
			if(empty($prd->paymentVoucher))
			{
				$type="Pay Slip";
				$typeid=1;
			}
			else{
				$type="Payment Voucher";
				$typeid=2;

			}
			
            $no++;
            $row = array();
            $pid = $prd->id;
            //$row[] = dateformat($prd->created_at);
			$row[]= $no;
            $row[] = $prd->staffName;
            $row[] = $prd->salaryMonth;
            $row[] = $prd->netPay;
			$row[] = $prd->totalEarning;
            $row[] = $prd->totalDeduction;
		    $row[] = $type;
            $row[] = $prd->monthText;
			$row[] = $prd->year;

           // $row[] = dateformat($prd->receipt_date);
           // $row[] = amountExchange($prd->receipt_amount, 0, $this->aauth->get_user()->loc);
           // $row[] = amountExchange($prd->tax_amount, 0, $this->aauth->get_user()->loc);
            $row[] = '<a href="' . base_url("payroll/viewslip?id=$pid&typeid=$typeid") . '" class="btn btn-success btn-sm" title="View" target="_blank"><i class="fa fa-eye"></i></a>&nbsp;
			<a href="' . base_url("payroll/downloadpayslip?id=$pid&typeid=$typeid") . '" class="btn btn-info btn-sm"  title="Download"><span class="fa fa-download"></span></a>&nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            //$row[] =$temp;
            /*
              $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
              */
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->payroll->count_all(),
            "recordsFiltered" => $this->payroll->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	
}

public function viewslip()
{
	
	$id=$this->input->get('id');
	$typeid=$this->input->get('typeid');
	$list = $this->payroll->get_payslip($id,$typeid);

	if($typeid==1)
	{
			$fileName =$list->payslip; 

	$folder="payslip/";	
	}
	else{
			$fileName =$list->paymentVoucher; 

		$folder="paymentVoucher/";	

	}
		   $filePath ="../".$folder.$fileName; 
		 
	 $output= '<iframe src="'.$filePath.'"
                width="100%"
                height="100%">
        </iframe>';
		
	echo $output;	
	
	
}
public function downloadpayslip()
{
	$id=$this->input->get('id');
	$typeid=$this->input->get('typeid');
	$list = $this->payroll->get_payslip($id,$typeid);

	if($typeid==1)
	{
			$fileName =$list->payslip; 

	$folder="payslip/";	
	
	}
	else{
			$fileName =$list->paymentVoucher; 

		$folder="paymentVoucher/";	

	}
		  $filePath =FCPATH.$folder.$fileName; 
    if(!empty($fileName) && file_exists($filePath)){ 
        // Define headers 
        header("Cache-Control: public"); 
        header("Content-Description: File Transfer"); 
        header("Content-Disposition: attachment; filename=$fileName"); 
        header("Content-Type: application/pdf"); 
        header("Content-Transfer-Encoding: binary"); 
         
        // Read the file 
        readfile($filePath); 
        exit; 
    }else{ 
        echo 'The file does not exist.'; 
    } 
}


public function payrollReport()
{
	
	    $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Payroll Report";
        $head['usernm'] = $this->aauth->get_user()->username;
	    $this->load->model('employee_model', 'employee');
		$data['employee'] = $this->employee->list_employee();

        $this->load->view('fixed/header', $head);
        $this->load->view('payroll/payrollReport', $data);
        $this->load->view('fixed/footer');	
	
	
}
public function payrollReportData()
{
	  $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "PayRoll Report";
        $head['usernm'] = $this->aauth->get_user()->username;
	    $this->load->model('employee_model', 'employee');
		$data['employee'] = $this->employee->list_employee();

        $this->load->view('fixed/header', $head);
        $this->load->view('payroll/payrollReportData', $data);
        $this->load->view('fixed/footer');	
	
	
}

public function payrollReportGenerate()
{
    // echo "<pre>"; print_r($_POST); echo "</pre>";
    // exit;

	$timeCategory = $this->input->post('timeCategory');
  	$data['timeCategory']=$timeCategory;

	//	$data['datesearch']=$datesearch;

    $staffid=$this->input->post('orgStaffId');
    if(!empty($staffid))
    {

        $data['staffid']=$staffid;
    }else{

        $data['staffid']='0';
    }

        $data['salary']=$this->input->post('salary');
        $data['allowance']=$this->input->post('allowance');
        $data['commissions']=$this->input->post('commissions');
        $data['claims']=$this->input->post('claims');
        $data['bonus']=$this->input->post('bonus');
        $data['ot']=$this->input->post('ot');
        $data['epf']=$this->input->post('epf');
        $data['socso']=$this->input->post('socso');
        $data['pcb']=$this->input->post('pcb');
        $data['dateYear']=$this->input->post('dateYear');
        $data['dateMonth']=$this->input->post('dateMonth');
        // $n_data = json_encode($data);
        //$no=$this->lang->line('No');
        $data['payroll_filters'] = json_encode($data);
        $html="<tr><th>".$this->lang->line('No')."</th></tr>";
        $data['html']=$html;


        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "payroll Report";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('payroll/payrollReportData', $data);
        $this->load->view('fixed/footer');
        //output to json format
       // echo json_encode($output);

}


public function payrollReportGenerateAjax()
{
	
	//echo "<pre>"; print_r($this->input->post()); echo "<pre>"; 
			//$datesearch=$this->input->post('datesearch');
	if(!empty($this->input->post('timeCategory'))){
		$datesearch=$this->input->post('dateYear');
         $year= $this->input->post('dateYear');
    }else{
		
		$datesearch=$this->input->post('dateMonth');
		$year='';
	}
			$staffid=$this->input->post('staffid');
if(!empty($this->input->post('salary'))){

    $salary=",salaryMonth";}
	else{
		$salary='';
	}

    if(!empty($this->input->post('allowance'))){

    $allowance=",allowance";}
else{
		$allowance='';
	}

    if(!empty($this->input->post('commissions'))){

    $commissions=",commissions";}
else{
		$commissions='';
	}

    if(!empty($this->input->post('claims'))){

    $claims=",claims";}
else{
		$claims='';
	}

    if(!empty($this->input->post('bonus'))){

        $bonus=",bonus";
		}else{
		$bonus='';
	}


    if(!empty($this->input->post('ot')))
	{

    $ot=",ot";}else{
		$ot='';
	}

    if(!empty($this->input->post('epf'))){

        $epf=",epf";}
else{
		$epf='';
	}

    if(!empty($this->input->post('socso')))
	{
            $socso=",socso";
      }
else{
		$socso='';
	}

     
    if(!empty($this->input->post('pcb'))){

                $pcb=",pcb";
				
				}else{
		$pcb='';
	}

 $list = $this->payroll->get_datatables_new($staffid,$salary,$allowance,$commissions,$claims,$bonus,$ot,$epf,$socso,$pcb,$datesearch,$year);
//  echo $this->db->last_query();
//  exit; 
 // echo "<pre>"; print_r($list); echo "</pre>";
    // exit;

 $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        $temp='';
		$type='';
$no = $this->input->post('start');
        $temp='';
		$type='';

        foreach ($list as $datavalue) {

		
            $no++;
            $row = array();
           // $pid = $data->id;
            //$row[] = dateformat($prd->created_at);
			$row[]= $no;
			 $row[]=$datavalue->staffName;
             
             $row[]=$datavalue->monthText;
             $row[]=$datavalue->year;
        if(!empty($this->input->post('salary'))){

            $row[]=$datavalue->salaryMonth;
		}else{
            $row[]= '---';
        }
        if(!empty($this->input->post('allowance'))){

             $row[]=$datavalue->allowance;
		}else{
            $row[]= '---';
        }
        if(!empty($this->input->post('commissions'))){

             $row[]=$datavalue->commissions;
		}else{
            $row[]= '---';
        }
        if(!empty($this->input->post('claims'))){

             $row[]=$datavalue->claims;
		}else{
            $row[]= '---';
        }
        if(!empty($this->input->post('bonus'))){

             $row[]=$datavalue->bonus;
		}else{
            $row[]= '---';
        }
        if(!empty($this->input->post('ot'))){

            $row[]=$datavalue->ot;
		}else{
            $row[]= '---';
        }
        if(!empty($this->input->post('epf'))){

             $row[]=$datavalue->epf;
		}else{
            $row[]= '---';
        }
        if(!empty($this->input->post('socso'))){

            $row[]=$datavalue->socso;
		}else{
            $row[]= '---';
        }
     
        if(!empty($this->input->post('pcb'))){

                $row[]=$datavalue->pcb;

        }else{
            $row[]= '---';
        }
            
        if(!empty($datavalue->netPay)){

                $row[]=$datavalue->netPay;

        }else{
            $row[]= '---';
        }


		//print_r($row);
            $data[] = $row;
			
        }
		
            $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->payroll->count_all(),
            "recordsFiltered" => $this->payroll->count_filtered(),
            "data" => $data,
        );	
echo json_encode($output);		
				
}


public function get_selected_employee_details(){

    $staff = $this->input->post('employee_id', true);
    $data['employee_details'] = $this->employee->employee_details($staff);
    $output['status'] = '200';
    $output['html'] = $this->load->view('payroll/selected_staff_details',$data,TRUE);
    echo json_encode($output);	
}


public function bulk_payroll()
{
	   
        $head['title'] = "Bulk Payroll";
        $head['usernm'] = $this->aauth->get_user()->username;
		$data['employee'] = $this->payroll->getSettingsEmployee();
        $this->load->view('fixed/header', $head);
        $this->load->view('payroll/bulk_create', $data);
        $this->load->view('fixed/footer');	
	
}


public function bulk_payslip_generation(){


    $staffIds = $this->input->post('staffIds');
    $monthvalue = $this->input->post('month');
    $year = $this->input->post('year');


    // echo "<pre>"; print_r($_POST); echo "</pre>";
    // exit;

    $failure_counter = 0;
    $success_counter = 0;
    $staff_counter = count($staffIds);
    
    // $timestamp = mktime(0, 0, 0, $monthvalue, 1, 2000);

    // Use the date function to get the month name
    // $monthName = date('F', $timestamp);
	$month = $this->input->post('month');

    //echo $month."###";

    foreach ($staffIds as $staffId) {

   

    
    
    $datePayment = date('Y-m-d');
    $datePayment = date("d/m/Y", strtotime($datePayment));
	
	$allowance=$this->input->post('allowance');
	$claims=$this->input->post('claims');
	$commissions=$this->input->post('commissions');
	$ot=$this->input->post('ot');
    $bonus=$this->input->post('bonus');
    $deduction=$this->input->post('deduction');

	
		$allowance=0;
		$claims=0;
		$commissions=0;
		$ot=0;
	    $bonus=0;
        $deduction=0;
    
    $staff =$this->payroll->getStaffDetails($staffId);
       // print_r($staff);
	$staffName = $staff->name;
    $employeeId = "00000".$staff->id;
	if(empty($staff->degis))
	{
		$designation="None";
	}else{
    $designation = $this->payroll->getdesgination($staff->degis);
	}
    if(empty($staff->dept))
	{
		$department="None";
	}else{
    $department = $this->payroll->getDepartment($staff->dept);
	}
	
	    //ORGANIZATION DETAILS
    $orgId = $_SESSION['loggedin'];
    $organization =$this->payroll->getOrganizationDetails($orgId);
    $address = "<p style='font-size:10px;width:196px;position:relative;float: left;margin: 0;'>".$organization->address."<br>".$organization->city."<br>".$organization->region."<br>".$organization->country."<br>".$organization->postbox."</p>";

	
    $payroll = $this->payroll->getSettings($staffId);
	
    $nasionalityCheck = $payroll->nationality;
		    if(isset($nasionalityCheck))
			{
    if ($nasionalityCheck==1) {
      $nasionality = "Malaysian";
    }elseif ($nasionalityCheck==2) {
      $nasionality = "Foreigner";
    }
			}
	    if(isset($payroll->tax_no))
		{
    $taxId = $payroll->tax_no;
		}
		   if(isset($payroll->basic_salary))
		{
    $salaryMonthCalc = $payroll->basic_salary;
		}
   // $epfCalc = $payroll['epf'];
	$epfCalc="";
	if(isset($payroll->epf_employer)){
	$epfCalc = $payroll->epf_employer;
		$epf=$epfCalc;
	}
		   if(isset($payroll->sosco_employer))
		   {
    $socsoCalc =$payroll->sosco_employer;
		   }
		   if(isset($payroll->pcb))
		   {
    $pcbCalc = $payroll->pcb;
		   }
	
	
    $salaryMonth = number_format($payroll->basic_salary,2,".","");
    // $epf = number_format($epfTotal,2);
    $socso = number_format($payroll->sosco_employer,2,".","");
    $socsoEmp = number_format($payroll->sosco_employee,2,".","");
    $pcb = number_format($payroll->pcb,2,".","");
	$eis= number_format($payroll->eis,2,".","");
	$epfEmp= number_format($payroll->epf_employee,2,".","");
	$epfEmpyr= number_format($payroll->epf_employer,2,".","");
	//$advance="";
	//$advance=$allowance + $claims + $commissions + $ot + $bonus;
	$advance=$this->payroll->checknum($allowance) + $this->payroll->checknum($claims) + $this->payroll->checknum($commissions) + $this->payroll->checknum($ot)+ $this->payroll->checknum($bonus);
    //$totalEarning = number_format(($salaryMonth + $advance),2);
    $totalEarning = $this->payroll->checknum($advance) + $this->payroll->checknum($payroll->basic_salary);
    
	if(isset($payroll->nationality))
	  {
    $totalDeductionCalc='';
  if ($nasionalityCheck==1) {
      $console = "<script>console.log('nasionality=0')</script>";
      $totalDeductionCalc = $this->payroll->checknum($socsoEmp) + $this->payroll->checknum($pcbCalc)+$this->payroll->checknum($eis)+$this->payroll->checknum($epfEmp)+ $this->payroll->checknum($deduction);
      $epfRight=number_format($epfEmp,2,".","");
      $socsoRight=number_format($socsoEmp,2,".","");
      $pcbRight=number_format($pcb,2,".","");
	  $eisRight=number_format($eis,2,".","");

      $epfLeft=number_format($epfEmpyr,2,".","");
      $socsoLeft=number_format($socso,2,".","");
      $pcbLeft="-";
      $eisLeft=number_format($eis,2,".","");


    }elseif($nasionalityCheck==2){
      $console = "<script>console.log('nasionality=1')</script>";
      $totalDeductionCalc = $this->payroll->checknum($pcbCalc) + $this->payroll->checknum($epfEmp)+ $this->payroll->checknum($deduction);

      $epfRight=number_format($epfEmp,2,".","");
      $socsoRight="-";
      $pcbRight=number_format($pcb,2,".","");
	  $eisRight="-";

      $epfLeft=number_format($epfEmpyr,2,".","");
      $socsoLeft="-";
      $pcbLeft="-";
      $eisLeft="-";
    }
	  }
	
    $totalDeduction = number_format($totalDeductionCalc,2,".","");
    $netPayCalc = $totalEarning - $totalDeductionCalc;

    $netPay = number_format($netPayCalc,2,".","");

    $bankName = $payroll->bank;
    $bankAcc = $payroll->accountno;

    // echo $month;
    // exit;

    switch ($month) {
    case "1":
        $monthText = "January";
        break;
    case "2":
        $monthText = "February";
        break;
    case "3":
        $monthText = "March";
        break;
    case "4":
        $monthText = "April";
        break;
    case "5":
        $monthText = "May";
        break;
    case "6":
        $monthText = "June";
        break;
    case "7":
        $monthText = "July";
        break;
    case "8":
        $monthText = "August";
        break;
    case "9":
        $monthText = "September";
        break;
    case "10":
        $monthText = "October";
        break;
    case "11":
        $monthText = "November";
        break;
    case "12":
        $monthText = "December";
        break;
    default:
        $monthText = "Error";
    }
	$imageurl = base_url('userfiles/company/') . $organization->logo;

 //define session value to be used in phpfunctions/pdf/payslipPDF.php
    $npayslip_data['nasionalityCheck'] = $nasionalityCheck;
    $npayslip_data['address'] = $organization->address.",".$organization->city.",".$organization->region.",".$organization->country.", ".$organization->postbox;
    $npayslip_data['monthText'] = $monthText;
    $npayslip_data['monthvalue'] = $monthvalue;

    $npayslip_data['staffName'] = $staffName;
    $npayslip_data['staffId'] = $staffId;
	$npayslip_data['logoimage']=$imageurl;
    $npayslip_data['taxId'] = $taxId;
    $npayslip_data['nasionality'] = $nasionality;
    $npayslip_data['employeeId'] = $employeeId;
    $npayslip_data['designation'] = $designation;
    $npayslip_data['department'] = $department;
    $npayslip_data['salaryMonth'] = $salaryMonth;
    $npayslip_data['year'] = $year;
    $npayslip_data['socsoEmp'] = $socsoEmp;

    $npayslip_data['allowance'] = $allowance;
    $npayslip_data['claims'] = $claims;
    $npayslip_data['commissions'] = $commissions;
    $npayslip_data['ot'] = $ot;
	$npayslip_data['bonus']=$bonus;
	$npayslip_data['deduction']=$deduction;

    $npayslip_data['epf'] = $epfCalc;
    $npayslip_data['epfPerc'] = $epfCalc;
    $npayslip_data['socso'] = $socso;
    $npayslip_data['pcb'] = $pcb;

    $npayslip_data['totalEarning'] = $totalEarning;
	$npayslip_data['totalDeduction'] = $totalDeduction;
    $npayslip_data['datePayment'] = $datePayment;
    $npayslip_data['bankName'] = $bankName;
    $npayslip_data['bankAcc'] = $bankAcc;
    $npayslip_data['netPay'] = $netPay;
    $npayslip_data['epfLeft'] = $epfLeft;
    $npayslip_data['epfRight'] = $epfRight;
    $npayslip_data['socsoLeft'] = $socsoLeft;
    $npayslip_data['socsoRight'] = $socsoRight;
    $npayslip_data['pcbLeft'] = $pcbLeft;
    $npayslip_data['pcbRight'] = $pcbRight;

	$npayslip_data['eis'] = $eis;
	$npayslip_data['epfEmp'] = $epfEmp;
	$npayslip_data['epfEmpyr'] = $epfEmpyr;

	$npayslip_data['eisLeft']=$eisLeft;
	$npayslip_data['eisRight']=$eisRight;

    //$npayslip_data['payslip'] = $slip;
    //$nn_data[] = $npayslip_data;
    


    $employee_details = $this->employee->employee_details($staffId);
    $monthText = $npayslip_data['monthText'];
     $staffName = $npayslip_data['staffName'];
     $staffId = $npayslip_data['staffId'];
     $employeeId = $npayslip_data['employeeId'];
       $monthvalue = $npayslip_data['monthvalue'];

     $designation = $npayslip_data['designation'];
     $department = $npayslip_data['department'];
     $salaryMonth = $npayslip_data['salaryMonth'];
   //  $slipYear=$_SESSION['salaryYear'];
      $staffemail=$this->payroll->getStaffDetails($staffId);
     $epf = $npayslip_data['epf'];
     $epfPerc = $npayslip_data['epfPerc'];
     $socso = $npayslip_data['socso'];
     $pcb = $npayslip_data['pcb'];
     $eis = $npayslip_data['eis'];
     $epfEmp = $npayslip_data['epfEmp'];
     $epfEmpyr = $npayslip_data['epfEmpyr'];
     $allowance = $npayslip_data['allowance'];
     $claims = $npayslip_data['claims'];
     $commissions = $npayslip_data['commissions'];
     $ot = $npayslip_data['ot'];
     $year=$npayslip_data['year'];
     $bonus="";
     $deduction="";
     $datePayment = $npayslip_data['datePayment'];//ET
 if(isset($npayslip_data['bonus'])){
     $bonus = $npayslip_data['bonus'];}
 if(isset($npayslip_data['deduction'])){
     $deduction = $npayslip_data['deduction'];}
     $totalEarning = $npayslip_data['totalEarning'];
     $totalDeduction = $npayslip_data['totalDeduction'];
     $bankName = $npayslip_data['bankName'];
     $bankAcc = $npayslip_data['bankAcc'];
     $netPay = $npayslip_data['netPay'];
 //$rowOrgUser = fetchOrganizationUserbyId($con,$staffId);
 //$_SESSION['staffId']=$rowOrgUser['staffId'];
   //  $orgId=$_SESSION['orgId'];
 $pending=0;
     //$payslipDirectory=$_SERVER['DOCUMENT_ROOT'].$config['appRoot']."/resources/".$orgId."/payslip/";
 //(START)DATE ERROR FIX: Have to change date format by using string replace due to unknown error
     $datePayment = str_replace("/","-",$datePayment);
      $datePayment = date("Y-m-d", strtotime($datePayment));
 //(END)DATE ERROR FIX
         $payslipDirectory="./payslip";

$check=$this->payroll->insertPayslipCheck($staffId,$monthText,$datePayment);
if(empty($check)){
if(!is_dir($payslipDirectory)) //create the folder if it's not exists
 {
   mkdir($payslipDirectory,0755,TRUE);
 } 
}
    
    $payslipPDF = $this->payroll->generatePayslipPDFNew($npayslip_data);

      $payslipName = "P".rand(1000000,9999999).".pdf";
      $payslipPDF->output($payslipDirectory."/".$payslipName,'F');
      $paymentVoucher = null;
      $feedback = $this->payroll->insertPayslipInformation($monthText,$staffName,$staffId,$employeeId,$designation,$department,$salaryMonth,$epf,$epfPerc,$socso,$pcb,$allowance,$claims,$commissions,$ot,$bonus,$totalEarning,$totalDeduction,$datePayment,$bankName,$bankAcc,$netPay,$payslipName,null,$year,$monthvalue);
      $mailto=$staffemail->email;
      $mailtotitle="";
      $subject="payslip";
      $message="Hii $staffName This is Your  $monthText $year payslip";
      $attachmenttrue="true";
      $attachment=$payslipDirectory."/".$payslipName;
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
     if(!empty($mailto))
     {
        $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto, $mailtotitle, $subject, $message, $attachmenttrue, $attachment);
     }
     
    if(!$feedback){

     $failure_counter++;   
    // $data['status'] = 'danger';
    // $data['message'] = $this->lang->line('Settings error');
    }

    else{
     $success_counter++;   
    // $data['status'] = 'success';
    // $data['message'] = $this->lang->line('Pay slip for')." ".$employee_details['name']."".$this->lang->line('Created');
    }
    
    //echo "<pre>"; print_r($data); echo "</pre>";
}

    if($success_counter == $staff_counter)
    {
         $data['status'] = '200';
         $data['message'] = "Payslip generated Successfull! for Selected Employees";

    }else{
        $data['status'] = '500';
        $data['message'] = "Payslip Generation Failed";

    }

    echo json_encode($data);
}


public function ImportPaySlip()
{
    $id = $this->input->get('id');
    $head['usernm'] = $this->aauth->get_user()->username;
    $head['title'] = 'Import PaySlip';
    //$data['employee'] = $this->employee->employee_details($id);
    $data['eid'] = intval($id);
    $this->load->view('fixed/header', $head);
    $this->load->view('payroll/import', $data);
    $this->load->view('fixed/footer');
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

public function ImportPaySlipSave(){
    // if ($_FILES['file']['name'] != "employee_jsuiteTemplate.xlsx") {
    //     $data['status'] = 'danger';
    //     $data['message'] = $this->lang->line('Employee Template Error Use JsuiteTemplate');
    //     $_SESSION['status'] = $data['status'];
    //     $_SESSION['message'] = $data['message'];
    //     $this->session->mark_as_flash('status');
    //     $this->session->mark_as_flash('message');
    //     redirect('employee/addExcel', 'refresh');

    // }

    
	$employees = $this->payroll->getSettingsEmployee();
    $employee_ids = array_column($employees,"id");
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

        foreach ($sheet_data as $key => $val) {

            if ($key > 1) {
                $result = '';

                if ($result) {
                } else {

                    //$timestamp = mktime(0, 0, 0, $val[0], 1, 2000);
                    // Use the date function to get the month name
                    $monthName = '';

                    if(in_array($val[3],$employee_ids))
                    {

                        if (isset($val[0])) {
                            $timestamp = mktime(0, 0, 0, $val[0], 1, 2000);
                            $monthName = date('F', $timestamp);
                            // Rest of your code
                        } else {
                            // Handle the case where $val[0] is not set
                        }
                
                    $list[] = [
                        'month' => $val[0],
                        'year' => $val[1],
                        'datePayment' => date('Y-m-d',strtotime($val[2])),
                        'staffId' => $val[3],
                        'staffName' => $val[4],
                        'designation' => $val[5],
                        'department' => $val[6],
                        'salaryMonth' => $val[7],
                        'epf' => $val[8],
                        'epfPerc' => $val[9],
                        'socso' => $val[10],
                        'pcb' => $val[11],
                        'allowance' => $val[12],
                        'claims' => $val[13],
                        'commissions' => $val[14],
                        'ot' => $val[15],
                        'bonus' => $val[16],
                        'totalEarning' => $val[17],
                        'totalDeduction' => $val[18],                        
                        'netpay' => $val[19],
                        'bankName' => $val[20],
                        'bankAcc' => $val[21],
                        'monthText' => $monthName,
                        'employeeId' => $val[3],

                    ];
                    }else{
                        $unregistered_list[] = [
                            'month' => $val[0],
                            'year' => $val[1],
                            'datePayment' => $val[2],
                            'staffId' => $val[3],
                            'staffName' => $val[4],
                            'designation' => $val[5],
                            'department' => $val[6],
                            'salaryMonth' => $val[7],
                            'epf' => $val[8],
                            'epfPerc' => $val[9],
                            'socso' => $val[10],
                            'pcb' => $val[11],
                            'allowance' => $val[12],
                            'claims' => $val[13],
                            'commissions' => $val[14],
                            'ot' => $val[15],
                            'bonus' => $val[16],
                            'totalEarning' => $val[17],
                            'totalDeduction' => $val[18],                        
                            'netpay' => $val[19],
                            'bankName' => $val[20],
                            'bankAcc' => $val[21]
    
                        ];
                    }
                }
            }
        }
        // echo "<pre>"; print_r($employee_ids); echo "</pre>";
        // echo "<pre>"; print_r($list); echo "</pre>";
        // echo "<pre>"; print_r($unregistered_list); echo "</pre>";
        // exit;
        
        if (file_exists($file_name)) {
            unlink($file_name);
        }

        if (count($list) > 0) {
            //$result = $this->employee->add_batch($list, $list1);
            //print_r($result);
                        
            if ($this->db->insert_batch('gtg_payslip',$list)) {
                if(empty($unregistered_list))
                {
                    $data['status'] = '200';
                    $data['message'] = 'Employees Imported into System Successfully';
                }else{

                    $unassociatedEmployees = array_column($unregistered_list, 'staffName');
                    $result_message = '';
                    $result_message = 'Employees not associated with the system:';
                    $result_message .= '<ul>';
                    foreach ($unassociatedEmployees as $un_employee) {
                        $result_message .= '<li>' . $un_employee . '</li>';
                    }
                    $result_message .= '</ul>';

                    $data['status'] = '200';
                    $data['message'] = $result_message;

                    // $spreadsheet = new Spreadsheet();

                    // // Set column headers
                    // $spreadsheet->getActiveSheet()->fromArray(array_keys($unregistered_list[0]), null, 'A1');

                    // // Add data starting from the second row
                    // $spreadsheet->getActiveSheet()->fromArray($unregistered_list, null, 'A2');

                    // // Create a writer object
                    // $writer = new Xlsx($spreadsheet);

                    // // Define the server path to save the file
                    // $serverPath = 'https://localhost/erp-dev/userfiles/payslip_rejected_sheets/';

                    // // Ensure the directory exists; create it if not
                    // if (!file_exists($serverPath)) {
                    //     mkdir($serverPath, 0777, true);
                    // }

                    // // Define the filename
                    // $filename = 'payslip_rejected_list.xlsx';

                    // // Save the file on the server
                    // $writer->save($serverPath . $filename);

                    // // Provide a downloadable URL
                    // $downloadUrl = base_url('userfiles/payslip_rejected_sheets/') . $filename;

                    // // Output the downloadable URL
                    // echo 'Download your file: <a href="' . $downloadUrl . '" target="_blank">Download</a>';

                }
                

            } else {

                $data['status'] = '500';
                $data['message'] = "The List Not updated Successfully!..";
            }

        } else {

            $unassociatedEmployees = array_column($unregistered_list, 'staffName');
            $result_message = '';
            $result_message = 'Employees not associated with the system:';
            $result_message .= '<ul>';
            foreach ($unassociatedEmployees as $un_employee) {
                $result_message .= '<li>' . $un_employee . '</li>';
            }
            $result_message .= '</ul>';

            $data['status'] = '500';
            $data['message'] = $result_message;


        }
    }
    $_SESSION['status'] = $data['status'];
    $_SESSION['message'] = $data['message'];
    $this->session->mark_as_flash('status');
    $this->session->mark_as_flash('message');
    redirect('payroll/ImportPaySlip', 'refresh');
    exit();
}

public function verify_payslip(){

    $employee = $this->input->post('employee');
    $month = $this->input->post('month');
    $year = $this->input->post('year');


    $this->db->select('*');
    $this->db->from('gtg_payslip');
    $this->db->where('staffId', $employee);
    $this->db->where('month', $month);
    $this->db->where('year', $year);
    $query = $this->db->get();
    $result = $query->num_rows();
    
    // echo $this->db->last_query();
    // echo $result;
    if($result > 0)
    {
        $response['status'] = '500';
        $response['message'] = 'payslip Already Existed';
    }else{
        $response['status'] = '200';
        $response['message'] = 'No Payslip Found';
    }
    
    echo json_encode($response);

}

    public function downloadPaySlipTemplate()
    {
        // Define the server path to the file
        $filePath = FCPATH . 'userfiles/company/Payslip-Management-Template.xlsx';

        // Check if the file exists
        if (file_exists($filePath)) {
            // Load the download helper
            $this->load->helper('download');

            // Force download the file
            force_download('Payslip-Management-Template.xlsx', file_get_contents($filePath));
        } else {
            redirect('payroll/ImportPayslip');
        }
    }

    public function payroll_report_new(){

        // /print_r($_POST); 
        $data = $this->input->post('employee_payroll_data');
         
         $data = json_decode($data, true);

        //  echo "<pre>"; print_r($data); echo "</pre>";
        //  echo $data['timeCategory'];
         
         if($data['timeCategory']){
            $datesearch=$data['dateYear'];
            
           $year= $data['dateYear'];
        }
    
        else{
            
            $datesearch=$data['dateMonth'];
            $year='';
            }
                $staffid=$data['staffid'];
    if(!empty($data['salary'])){
    
        $salary=",gtg_payslip.salaryMonth";}
        else{
            $salary='';
        }
    
        if(!empty($data['allowance'])){
    
        $allowance=",gtg_payslip.allowance";}
    else{
            $allowance='';
        }
    
        if(!empty($data['commissions'])){
    
        $commissions=",gtg_payslip.commissions";}
    else{
            $commissions='';
        }
    
        if(!empty($data['claims'])){
    
        $claims=",gtg_payslip.claims";}
    else{
            $claims='';
        }
    
        if(!empty($data['bonus'])){
    
            $bonus=",gtg_payslip.bonus";
            }else{
            $bonus='';
        }
    
    
        if(!empty($data['ot']))
        {
    
        $ot=",gtg_payslip.ot";}else{
            $ot='';
        }
    
        if(!empty($data['epf'])){
    
            $epf=",gtg_payslip.epf";}
    else{
            $epf='';
        }
    
        if(!empty($data['socso']))
        {
                $socso=",gtg_payslip.socso";
          }
    else{
            $socso='';
        }
    
         
        if(!empty($data['pcb'])){
    
                    $pcb=",gtg_payslip.pcb";
                    
                    }else{
            $pcb='';
        }
    
     $list = $this->payroll->get_payroll_export_new($staffid,$salary,$allowance,$commissions,$claims,$bonus,$ot,$epf,$socso,$pcb,$datesearch,$year);
        // echo "<pre>"; print_r($list); echo "</pre>";
        // exit;
    
     $data = array();
            // $no = $_POST['start'];
            $no = $data['start'];
            $temp='';
            $type='';
    $no = $data['start'];
            $temp='';
            $type='';
    
            foreach ($list as $datavalue) {
    
            
                $no++;
                $row = array();
               // $pid = $data->id;
                //$row[] = dateformat($prd->created_at);
                $row[]= $no;
                 $row[]=$datavalue->staffName;
                 
                 $row[]=$datavalue->monthText;
                 $row[]=$datavalue->year;
            if(!empty($data['salary'])){
    
                $row[]=$datavalue->salaryMonth;
            }else{
                $row[]= '---';
            }
            if(!empty($data['allowance'])){
    
                 $row[]=$datavalue->allowance;
            }else{
                $row[]= '---';
            }
            if(!empty($data['commissions'])){
    
                 $row[]=$datavalue->commissions;
            }else{
                $row[]= '---';
            }
            if(!empty($data['claims'])){
    
                 $row[]=$datavalue->claims;
            }else{
                $row[]= '---';
            }
            if(!empty($data['bonus'])){
    
                 $row[]=$datavalue->bonus;
            }else{
                $row[]= '---';
            }
            if(!empty($data['ot'])){
    
                $row[]=$datavalue->ot;
            }else{
                $row[]= '---';
            }
            if(!empty($data['epf'])){
    
                 $row[]=$datavalue->epf;
            }else{
                $row[]= '---';
            }
            if(!empty($data['socso'])){
    
                $row[]=$datavalue->socso;
            }else{
                $row[]= '---';
            }
         
            if(!empty($data['pcb'])){
    
                    $row[]=$datavalue->pcb;
    
            }else{
                $row[]= '---';
            }
                
            if(!empty($datavalue->netPay)){
    
                    $row[]=$datavalue->netPay;
    
            }else{
                $row[]= '---';
            }
    
    
            //print_r($row);
                $data[] = $row;
                
            }
            
                $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->payroll->count_all(),
                "recordsFiltered" => $this->payroll->count_filtered(),
                "data" => $data,
            );	
    echo json_encode($output);		

			       
    }

}