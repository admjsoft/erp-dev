<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Payroll extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payroll_model', 'payroll');
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        // if (!$this->aauth->premission(9)) {

        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }
        $this->li_a = 'emp';
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

		$data['employee'] = $this->employee->list_employee();

		
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

		 if(!empty($staffInfo)){
 $update=$this->payroll->updatesettings($staff,$basic,$epf,$epfEmployee,$epfEmp,$epfEmpyr,$socsoEmployerPer,$socsoEmpPer,$socso,$socsoEmp,$pcb,$eis,$bankName,$bankAcc,$nationality,$taxId);
if(!$update){
                    $data['status'] = 'danger';
                    $data['message'] = $this->lang->line('Settings error');
                    }
					
					else{
                    $data['status'] = 'success';
                    $data['message'] = $this->lang->line('Payroll Settings updated');
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
                    $data['message'] = $this->lang->line('Payroll Settings added');
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

   $paymentVoucher=$this->payroll->paymentVoucherDesign($refNo,$amount,$date,$methodOfPayment,$to,$theSumOf,$being,$payee,$approvedBy,$paidBy);
	
	echo json_encode($paymentVoucher);
}

public function generatePaymentVoucher()
{
	
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
  $paymentVoucher = $this->payroll->buildpaymentVoucher($refNo,$amount,$date,$methodOfPayment,$to,$theSumOf,$being,$payee,$approvedBy,$paidBy);
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
    $slip.='<div class="row pt-3 pr-3 pl-3">
  <div class="p-3" style="border:1px solid black;width:70%">
        <img style="width:20%;float:left" src="'.$imageurl.'" >
        <center><h3><b>SALARY SLIP</b></h3></center>'.$address.'<center><h7><b>'.$monthText.' '.$year.'</b></h7></center>
    </div>
    <div class="p-3" style="background:#FF8585;border:1px solid black;width:30%;border-left:0px;">
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
    <div class="p-1" style="background:red;color:white;border:1px solid black;border-top:0px;width:50%">
    <center>Description</center></div>

    <div class="p-1" style="background:red;color:white;border:1px solid black;border-top:0px;width:25%;border-left:0px;"><center>Earnings</center></div>

    <div class="p-1" style="background:red;color:white;border:1px solid black;border-top:0px;width:25%;border-left:0px;"><center>Deductions</center></div>
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
            <div style="background:red;color:white;border-bottom:1px solid black;"><center><b>NET PAY</b></center></div>

            <div style="background:#FF8585;border-bottom:1px solid black;"><center><h5>RM '.$this->payroll->pointNumber($netPay).'</h5></center></div>

            <div class="pt-5" style="height:100%"><center><h4></h4></center></div>
        </div>
    </div>

    <div class="pb-0 pr-3 pl-3">
        <center><p><i><b>This is a computer generated document</b></i></p></center>
    </div>';
    $_SESSION['payslip'] = $slip;
    echo $slip;
	
}

public function generatePayslip()
{

	   $monthText = $_SESSION['monthText'];
        $staffName = $_SESSION['staffName'];
        $staffId = $_SESSION['staffId'];
        $employeeId = $_SESSION['employeeId'];
		  $monthvalue = $_SESSION['monthvalue'];

        $designation = $_SESSION['designation'];
        $department = $_SESSION['department'];
        $salaryMonth = $_SESSION['salaryMonth'];
      //  $slipYear=$_SESSION['salaryYear'];
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
                    $data['message'] = $this->lang->line('PAYSLIP IS GENERATED');
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
	
	
	
	$timeCategory = $this->input->post('timeCategory');

    $datesearch="";

    $salary="";

    $allowance="";

    $commissions="";

    $claims="";

    $bonus="";

    $ot="";

    $epf="";

    $socso="";

    $pcb="";

    if($timeCategory){
		$datesearch=$this->input->post('dateYear');
        
       $year= $this->input->post('dateYear');
    }

    else{
		
		$datesearch=$this->input->post('dateMonth');
		$year='';
		}

    $staffid=$this->input->post('orgStaffId');

    if(!empty($this->input->post('salary'))){

    $salary=",salaryMonth";}

    if(!empty($this->input->post('allowance'))){

    $allowance=",allowance";}

    if(!empty($this->input->post('commissions'))){

    $commissions=",commissions";}

    if(!empty($this->input->post('claims'))){

    $claims=",claims";}

    if(!empty($this->input->post('bonus'))){

        $bonus=",bonus";
		}

    if(!empty($this->input->post('ot')))
	{

    $ot=",ot";}

    if(!empty($this->input->post('epf'))){

        $epf=",epf";}

    if(!empty($this->input->post('socso')))
	{
            $socso=",socso";
      }

     
    if(!empty($this->input->post('pcb'))){

                $pcb=",pcb";
				
				}
  $ttype = $this->input->get('type');

 // $this->input->post('search')['value']='';
 //$start=0;
 // $this->input->post('length')=10;

       $list = $this->payroll->get_datatables_new($staffid,$salary,$allowance,$commissions,$claims,$bonus,$ot,$epf,$socso,$pcb,$datesearch,$year);
		
     
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
        if(!empty($this->input->post('salary'))){

            $row[]=$datavalue->salaryMonth;
		}
        if(!empty($this->input->post('allowance'))){

             $row[]=$datavalue->allowance;
		}
        if(!empty($this->input->post('commissions'))){

             $row[]=$datavalue->commissions;
		}
        if(!empty($this->input->post('claims'))){

             $row[]=$datavalue->claims;
		}
        if(!empty($this->input->post('bonus'))){

             $row[]=$datavalue->bonus;
		}
        if(!empty($this->input->post('ot'))){

            $row[]=$datavalue->ot;
		}
        if(!empty($this->input->post('epf'))){

             $row[]=$datavalue->epf;
		}
        if(!empty($this->input->post('socso'))){

            $row[]=$datavalue->socso;
		}
     
    if(!empty($this->input->post('pcb'))){

            $row[]=$datavalue->pcb;

	}
		  
    if(!empty($datavalue->netPay)){

            $row[]=$datavalue->netPay;

	}


		//print_r($row);
            $data[] = $row;
			
        }
		$_POST['draw']=1;
            $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->payroll->count_all(),
            "recordsFiltered" => $this->payroll->count_filtered(),
            "data" => $data,
        );
		$_SESSION['payrollReportData']=$output;
	    $value['dateYear']=$this->input->post('dateYear');
	    $value['dateMonth']=$this->input->post('dateMonth');
        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "payroll Report";
        $head['usernm'] = $this->aauth->get_user()->username;
	    $this->load->model('employee_model', 'employee');
		$data['employee'] = $this->employee->list_employee();

        $this->load->view('fixed/header', $head);
        $this->load->view('payroll/payrollReportData', $value);
        $this->load->view('fixed/footer');
        //output to json format
       // echo json_encode($output);

}

public function payrollReportGenerateAjax()
{
	
	       echo json_encode($_SESSION['payrollReportData']);
        unset($_SESSION['payrollReportData']);
	
}




}