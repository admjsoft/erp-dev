<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Payroll_model extends CI_Model
{
    public $column_order = array('id', 'staffName', 'salaryMonth', 'netPay', 'monthText', 'year');
    public $column_search = array('id', 'staffName', 'salaryMonth', 'netPay', 'monthText', 'year');
    public $order = array('id' => 'desc');
    public $opt = '';

    private function _get_datatables_query()
    {

        $this->db->select('*');
        $this->db->from('gtg_payslip');

        // if ($this->aauth->get_user()->roleid == 4 || $this->aauth->get_user()->roleid == 5) {

        // } else {

        //     $this->db->where('employeeId', $_SESSION['id']);

        // }

        $user_role = $this->aauth->get_user()->roleid;
        $role_details = $this->db->where('id',$user_role)->get('gtg_role')->result_array();
        $all_data_previleges = $role_details[0]['all_data_previleges'];

        if ($all_data_previleges) {
            $eid = 0;
        } else {
            $eid = $this->aauth->get_user()->id;
            $this->db->where('employeeId',$eid);
            //$this->db->where('employeeId', $_SESSION['id']);
        }


        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        }

        $i = 0;

        foreach ($this->column_search as $item) // loop column
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

                if (count($this->column_search) - 1 == $i) //last loop
                {
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;

            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public $rcolumn_order = array('gtg_payslip.id', 'gtg_payslip.staffName', 'gtg_payslip.salaryMonth', 'gtg_payslip.netPay');
    public $rcolumn_search = array('gtg_payslip.id', 'gtg_payslip.staffName', 'gtg_payslip.salaryMonth', 'gtg_payslip.netPay');
    public $rorder = array('gtg_payslip.id' => 'desc');
    private function _get_datatables_query_new($staffid, $salary, $allowance, $commissions, $claims, $bonus, $ot, $epf, $socso, $pcb)
    {
        $conditions = "staffName" . $salary . $allowance . $commissions . $claims . $bonus . $ot . $epf . $socso . $pcb . "," . "netPay";
        $this->db->select($conditions);
        $this->db->from('gtg_payslip');

        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        }

        $i = 0;

        foreach ($this->rcolumn_search as $item) // loop column
        {
            if (isset($this->input->post('search')['value'])) {
                $searchvalue = $this->input->post('search')['value'];
            } else {
                $searchvalue = '';
            }
            if ($searchvalue) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }

                if (count($this->rcolumn_search) - 1 == $i) //last loop
                {
                    $this->db->group_end();
                }
                //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->rcolumn_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->rorder)) {
            $order = $this->rorder;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    // expenses filtered
    public function count_filtered()
    {
        $this->db->from('gtg_payslip');
        $query = $this->db->get();
        return $query->num_rows();
    }
    // expense count function
    public function count_all()
    {
        $this->db->from('gtg_payslip');
        return $this->db->count_all_results();
    }
    public function list_employee()
    {
        $this->db->select('gtg_employees.*,gtg_users.banned,gtg_users.roleid,gtg_users.loc');
        $this->db->from('gtg_employees');

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
        $this->db->order_by('gtg_users.roleid', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }
    public function addsettings($staff, $basic, $epf, $epfEmployee, $epfEmp, $epfEmpyr, $socsoEmployerPer, $socsoEmpPer, $socso, $socsoEmp, $pcb, $eis, $bankName, $bankAcc, $nationality, $taxId)
    {
        $datetime = date("Y-m-d") . " " . date("h:i:s");
        $data = array(
            'staff_id' => $staff,
            'basic_salary' => $basic,
            'epf_percent' => $epf,
            'epf_employee_percent' => $epfEmployee,
            'epf_employee' => $epfEmp,
            'epf_employer' => $epfEmpyr,
            'sosco_employer_percent' => $socsoEmployerPer,
            'sosco_employee_percent' => $socsoEmpPer,
            'sosco_employer' => $socso,
            'sosco_employee' => $socsoEmp,
            'pcb' => $pcb,
            'eis' => $eis,
            'bank' => $bankName,
            'accountno' => $bankAcc,
            'nationality' => $nationality,
            'tax_no' => $taxId,
            'created_at' => $datetime,
        );
        return $this->db->insert('gtg_payroll_settings', $data);
    }
    public function updatesettings($staff, $basic, $epf, $epfEmployee, $epfEmp, $epfEmpyr, $socsoEmployerPer, $socsoEmpPer, $socso, $socsoEmp, $pcb, $eis, $bankName, $bankAcc, $nationality, $taxId)
    {
        ///$datetime=date("Y-m-d") ." ".date("h:i:s");
        $data = array(
            'staff_id' => $staff,
            'basic_salary' => $basic,
            'epf_percent' => $epf,
            'epf_employee_percent' => $epfEmployee,
            'epf_employee' => $epfEmp,
            'epf_employer' => $epfEmpyr,
            'sosco_employer_percent' => $socsoEmployerPer,
            'sosco_employee_percent' => $socsoEmpPer,
            'sosco_employer' => $socso,
            'sosco_employee' => $socsoEmp,
            'pcb' => $pcb,
            'eis' => $eis,
            'bank' => $bankName,
            'accountno' => $bankAcc,
            'nationality' => $nationality,
            'tax_no' => $taxId,
        );
        $this->db->where('staff_id', $staff);
        return $this->db->update('gtg_payroll_settings', $data);
    }
    public function getSettings($staff)
    {

        $this->db->select('*');
        $this->db->from('gtg_payroll_settings');
        $this->db->where('staff_id', $staff);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();

    }

    public function getPayslipList()
    {

        $this->db->select('*');
        $this->db->from('gtg_payslip');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();

    }
    public function get_payslip($id, $typeid)
    {
        if ($typeid == 1) {
            $this->db->select('payslip');
            $this->db->from('gtg_payslip');
            $this->db->where('id ', $id);

            $query = $this->db->get();
        } else {
            $this->db->select('paymentVoucher');
            $this->db->from('gtg_payslip');
            $this->db->where('id ', $id);

            $query = $this->db->get();
        }
        //echo $this->db->last_query();
        return $query->row();

    }

    public function get_datatables($opt = 'all')
    {
        $this->opt = $opt;
        $this->_get_datatables_query();
        if ($_POST['length'] != -1) {
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        //print_r($this->db->last_query());
        return $query->result();
    }
    public function get_datatables_new($staffid, $salary, $allowance, $commissions, $claims, $bonus, $ot, $epf, $socso, $pcb, $datesearch, $year)
    {

        if (empty($year)) {
            if (strpos($datesearch, '-')) {
                $exp = explode("-", $datesearch);
                $year = $exp[0];
                $month = (int) $exp[1];
            }

        } else {
            $year = $datesearch;
            $month = '';
        }
        $this->opt = 'all';
        $this->_get_datatables_query_new($staffid, $salary, $allowance, $commissions, $claims, $bonus, $ot, $epf, $socso, $pcb);
        if (empty($month)) {
            $this->db->where('year', $year);
        } else {
            $this->db->where('year', $year);
            $this->db->where('month', $month);
        }

        $length = 10;
        $start = 0;
        if ($staffid != 0) {
            $this->db->where('staffId', $staffid);
        }

        if ($length != -1) {
            $this->db->limit($length, $start);
        }

        $query = $this->db->get();
        //print_r($this->db->last_query());
        return $query->result();
    }

    public function paymentVoucherDesign($refNo, $amount, $date, $methodOfPayment, $to, $theSumOf, $being, $payee, $approvedBy, $paidBy)
    {
        $checkIcon = '<img src="../userfiles/theme/check.png">';
        if ($methodOfPayment == 0) {
            //  $tickCash = "&#10004;";
            $tickCash = $checkIcon;
            $tickCheck = "";
            $tickFund = "";
        } elseif ($methodOfPayment == 1) {
            $tickCash = "";
            //$tickCheck = "&#10004;";
            $tickCheck = $checkIcon;
            $tickFund = "";
        } elseif ($methodOfPayment == 2) {
            $tickCash = "";
            //$tickCheck = "&#10004;";
            $tickCheck = "";
            $tickFund = $checkIcon;
        }
        $orgId = $_SESSION['loggedin'];
        $organization = $this->getOrganizationDetails($orgId);
        $orgLogoSrc = base_url('userfiles/company/') . $organization->logo;

        //$orgLogoSrc='../userfiles/theme/logo-header.png';
        $heroFont = "font-size:30";
        $mainFont = "font-size:14";
        $content = "
  <div style='border: 2px solid black;width:100%;height:396px;padding:5px'>
  <table style='width:100%;'>
    <tr>
      <td style='text-align:center;" . $heroFont . ";'>
        Payment Voucher
      </td>
    </tr>
  </table>
  <table style='width:100%;'>
    <tr>
      <td style='text-align:left;" . $mainFont . ";'>
        Ref No:<u>" . $refNo . "</u>
      </td>
    </tr>
  </table>
  <table style='width:100%;border-top:1px solid black;border-right:1px solid black;border-collapse: collapse;'>
    <tr>
      <td style='width:50%;border-left:1px solid black;text-align:left;" . $mainFont . ";'>
        Amount(RM): " . number_format((float) $amount, 2, '.', '') . "
      </td>
      <td style='width:50%;border-left:1px solid black;text-align:left;" . $mainFont . ";'>
        Date: " . $date . "
      </td>
    </tr>
  </table>
  <table style='width:100%;border-top:1px solid black;border-right:1px solid black;border-collapse: collapse;'>
    <tr>
      <td style='border-left:1px solid black;text-align:center;" . $mainFont . ";'>
        <b>Method of Payment</b>
      </td>
    </tr>
  </table>
  <table style='width:100%;border-top:1px solid black;border-right:1px solid black;border-collapse: collapse;'>
    <tr>
      <td style='width:50%;border-left:1px solid black;text-align:left;" . $mainFont . ";'>
        Cash: " . $tickCash . "
      </td>
      <td style='width:50%;border-left:1px solid black;text-align:left;" . $mainFont . ";'>
        Cheque: " . $tickCheck . "
      </td>
      <td style='width:34%;border-left:1px solid black;text-align:left;" . $mainFont . ";'>
        Fund Transfer: " . $tickFund . "
      </td>
    </tr>
  </table>
  <table style='width:100%;border-top:1px solid black;border-right:1px solid black;border-collapse: collapse;'>
    <tr>
      <td style='border-left:1px solid black;text-align:left;" . $mainFont . ";'>
        To: " . $to . "
      </td>
    </tr>
  </table>
  <table style='width:100%;border-top:1px solid black;border-right:1px solid black;border-collapse: collapse;'>
    <tr>
      <td style='border-left:1px solid black;text-align:left;" . $mainFont . ";'>
        Payment for: " . $theSumOf . "
      </td>
    </tr>
  </table>
  <table style='width:100%;border-top:1px solid black;border-right:1px solid black;border-collapse: collapse;'>
    <tr>
      <td style='width:66.66%;border-left:1px solid black;text-align:left;" . $mainFont . ";'>
        Remarks:<br>&nbsp;&nbsp;&nbsp;&nbsp;" . $being . "<br><br><br>
      </td>
      <td style='width:33.33%;border-left:1px solid black;text-align:left;" . $mainFont . ";'>
        Payee:<br>&nbsp;&nbsp;&nbsp;&nbsp;" . $payee . "<br><br><br>
      </td>
    </tr>
  </table>
  <table style='width:100%;border-top:1px solid black;border-bottom:1px solid black;border-right:1px solid black;border-collapse: collapse;'>
    <tr>
      <td style='width:33.33%;border-left:1px solid black;text-align:left;" . $mainFont . ";'>
        Approved By:<br>&nbsp;&nbsp;&nbsp;&nbsp;" . $approvedBy . "<br><br><br>
      </td>
      <td style='width:33.33%;border-left:1px solid black;text-align:left;" . $mainFont . ";'>
        Paid By:<br>&nbsp;&nbsp;&nbsp;&nbsp;" . $paidBy . "<br><img style='height:60px;max-width:100pt'  src='" . $orgLogoSrc . "' alt='logo' /><br><br><br>
      </td>
      <td style='width:33.33%;border-left:1px solid black;text-align:left;" . $mainFont . ";'>
        Signature<br><br><br><br>
      </td>
    </tr>
  </table>
  </div>
  ";
        return $content;

    }

    public function buildpaymentVoucher($refNo, $amount, $date, $methodOfPayment, $to, $theSumOf, $being, $payee, $approvedBy, $paidBy)
    {

        $paymentVoucherDirectory = "./paymentVoucher";

        if (!is_dir($paymentVoucherDirectory)) //create the folder if it's not exists
        {
            mkdir($paymentVoucherDirectory, 0755, true);
        }

        $paymentVoucherName = "P" . rand(1000000, 9999999) . ".pdf";
        $refNo = substr($paymentVoucherName, 0, (strrpos($paymentVoucherName, ".")));
        $paymentVoucherPDF = $this->generatePaymentVoucherPDF($refNo, $amount, $date, $methodOfPayment, $to, $theSumOf, $being, $payee, $approvedBy, $paidBy);
        $paymentVoucherPDF->output($paymentVoucherDirectory . "/" . $paymentVoucherName, 'F');

        return $paymentVoucherName;

    }

    public function generatePaymentVoucherPDF($refNo, $amount, $date, $methodOfPayment, $to, $theSumOf, $being, $payee, $approvedBy, $paidBy)
    {

        $this->load->library('pdf');

        $content = $this->paymentVoucherDesign($refNo, $amount, $date, $methodOfPayment, $to, $theSumOf, $being, $payee, $approvedBy, $paidBy);
        $pdf = $this->pdf->load();
        //generate the PDF!
        $pdf->WriteHTML($content, 2);

        //$html2pdf->output();
        return $pdf;

    }
    public function insertPayslipInformation($monthText, $staffName, $staffId, $employeeId, $designation, $department, $salaryMonth, $epf, $epfPerc, $socso,
        $pcb, $allow, $claims, $commissions, $ot, $bonus, $totalEarning, $totalDeduction, $datePayment, $bankName, $bankAcc, $netPay, $payslipName, $paymentVoucher, $year, $month) {
        $datetime = date("Y-m-d") . " " . date("h:i:s");

        $data = array(
            'monthText' => $monthText,
            'month' => $month,
            'staffName' => $staffName,
            'staffId' => $staffId,
            'employeeId' => $staffId,
            'designation' => $designation,
            'department' => $department,
            'salaryMonth' => $salaryMonth,
            'epf' => $epf,
            'epfPerc' => $epfPerc,
            'socso' => $socso,
            'pcb' => $pcb,
            'allowance' => $allow,
            'claims' => $claims,
            'commissions' => $commissions,
            'ot' => $ot,
            'bonus' => $bonus,
            'totalEarning' => $totalEarning,
            'totalDeduction' => $totalDeduction,
            'datePayment' => $datePayment,
            'bankName' => $bankName,
            'bankAcc' => $bankAcc,
            'netPay' => $netPay,
            'payslip' => $payslipName,
            'paymentVoucher' => $paymentVoucher,
            'year' => $year,
            'created_at' => $datetime,
        );

        return $this->db->insert('gtg_payslip', $data);

    }

    public function getMonthInText($date)
    {
        $month = date("m", strtotime($date));
        switch ($month) {
            case '1':
                $monthText = "January";
                break;
            case '2':
                $monthText = "February";
                break;
            case '3':
                $monthText = "March";
                break;
            case '4':
                $monthText = "April";
                break;
            case '5':
                $monthText = "May";
                break;
            case '6':
                $monthText = "Jun";
                break;
            case '7':
                $monthText = "July";
                break;
            case '8':
                $monthText = "August";
                break;
            case '9':
                $monthText = "September";
                break;
            case '10':
                $monthText = "October";
                break;
            case '11':
                $monthText = "November";
                break;
            case '12':
                $monthText = "December";
                break;
            default:
                $monthText = "";
                break;
        }

        return $monthText;
    }

    public function getdesgination($value)
    {

        switch ($value) {
            case '1':
                $designation = "Inventory Manager";
                break;
            case '2':
                $designation = "Sales Person";
                break;
            case '3':
                $designation = "Sales Manager";
                break;
            case '4':
                $designation = "Business Manager";
                break;
            case '5':
                $designation = "Business Owner";
                break;
            case '-1':
                $designation = "Project Manager";

                break;

            default:
                $designation = "";
                break;
        }
        return $designation;

    }
    public function getDepartment($value)
    {
        switch ($value) {
            case '1':
                $department = "Sales";
                break;
            case '2':
                $department = "Finance";
                break;
            case '3':
                $department = "Operation";
                break;
            case '4':
                $department = "DEVELOPMENT";
            default:
                $department = "None";
                break;
        }
        return $department;

    }

    public function getStaffDetails($staffId)
    {
        $this->db->select('id,name,degis,dept,email');
        $this->db->from('gtg_employees');
        $this->db->where('id', $staffId);
        $query = $this->db->get();

        return $query->row();
    }

    public function getOrganizationDetails($id)
    {

        $this->db->select('*');
        $this->db->from('gtg_system');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();

    }
    public function getSettingsEmployee()
    {
        $this->db->select('gtg_employees.id,gtg_employees.name');
        $this->db->from('gtg_employees');
        $this->db->join('gtg_payroll_settings', 'gtg_employees.id = gtg_payroll_settings.staff_id');
        $query = $this->db->get();
        $this->db->last_query();
        return $query->result_array();
    }

    public function checknum($str)
    {
        if (is_string($str)) {
            return str_replace(',', '', $str);
        } else {
            return $str;
        }
    }
    public function pointNumber($str)
    {
        if (is_string($str)) {
            $str = str_replace(',', '', $str);
            if ($str > 0) {
                $str = number_format($str, 2);
            }
        } else {
            if ($str > 0) {
                $str = number_format($str, 2);
            }
        }
        return $str;
    }

    public function insertPayslipCheck($staffId, $monthText, $datePayment)
    {
        $this->db->select('*');
        $this->db->from('gtg_payslip');
        $this->db->where('staffId', $staffId);
        $this->db->where('monthText', $monthText);
        $this->db->where('datePayment', $datePayment);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();

    }

    public function generatePayslipPDF()
    {
        $this->load->library('pdf');

        $htmlStart = "<html>";

        //$headStart = "<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">";
        //<link href='https://".$_SERVER['HTTP_HOST'].$config['appRoot']."/adminTheme/custom-css/custom-css.css' rel='stylesheet'>
        $style = "
    <style>
    @page { size: landscape; }
      p{
          font-size:11px;
      }
      h3{
          font-size:19px;
      }
      h2{
          font-size:19px;
      }
      .row{
          border:1px solid black;
          border-bottom:0px;
      }
      .col{
          text-align:center;
      }
    </style>";

        //$headEnd = "</head>";
        $bodyStart = "<body>";
        $bodyEnd = "</body>";
        $htmlEnd = "</html>";

        $monthText = $_SESSION['monthText'];
        $staffName = $_SESSION['staffName'];
        $employeeId = $_SESSION['staffId'];
        $designation = $_SESSION['designation'];
        $department = $_SESSION['department'];
        $salaryMonth = $_SESSION['salaryMonth'];
        $epf = $_SESSION['epf'];
        $socso = $_SESSION['socso'];
        $socsoEmp = $_SESSION['socsoEmp'];

        $pcb = $_SESSION['pcb'];
        $year = $_SESSION['year'];
        $totalDeduction = $_SESSION['totalDeduction'];
        if (isset($_SESSION['staffloan']) && $_SESSION['staffloan'] == 1) {
            $loadAmount = 0;
            if (isset($_SESSION['loanAmount'])) {
                $loadAmount = $_SESSION['loanAmount'];}
            $emi = 0;
            if (isset($_SESSION['emi'])) {
                $emi = $_SESSION['emi'];}
            $pending = 0;
            if (isset($_SESSION['pending'])) {
                $pending = $_SESSION['pending'];}

            $date4 = date("Y-m-d");
            if (isset($_SESSION['start_date'])) {
                $date4 = $_SESSION['start_date'];}
            $date2 = date("Y-m-d");
            $ts1 = strtotime($date4);
            $ts2 = strtotime($date2);

            $year1 = date('Y', $ts1);
            $year2 = date('Y', $ts2);

            $month1 = date('m', $ts1);
            $month2 = date('m', $ts2);

            $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
            // $diffe=$loadAmount/$emi;
            if ($diff > 0 && $pending >= 0) {
                $condition = true;
                //  $diffe-$diff;
            }
        }
        $allowance = $_SESSION['allowance'];
        $claims = $_SESSION['claims'];
        $commissions = $_SESSION['commissions'];
        $ot = $_SESSION['ot'];
        $bonus = 0;
        if (isset($_SESSION['bonus'])) {
            $bonus = $_SESSION['bonus'];}
        $deduction = 0;
        if (isset($_SESSION['deduction'])) {
            $deduction = $_SESSION['deduction'];}

        $totalEarning = $_SESSION['totalEarning'];

        $datePayment = $_SESSION['datePayment'];
        $bankName = $_SESSION['bankName'];
        $bankAcc = $_SESSION['bankAcc'];
        $netPay = $_SESSION['netPay'];

        $eis = $_SESSION['eis'];
        $epfEmp = $_SESSION['epfEmp'];
        $epfEmpyr = $_SESSION['epfEmpyr'];

        $nasionalityCheck = $_SESSION['nasionalityCheck'];
        $epfRight = $epfEmp;
        $epfLeft = $epfEmpyr;
        if ($nasionalityCheck == 2) {
            $socso = "-";
            $eis = "-";
        }
        $adisplay = "";
        $ndisplay = "";
        $edisplay = "";
        $ddisplay = "";
        //$adisplay.="<p style='text-align:right;'>&nbsp;</p>";
        if ($deduction != 0) {
            $ndisplay .= "<p>DEDUCTION</p>";
            $adisplay .= "<p>-</p>";
            $edisplay .= "<p>-</p>";
            $ddisplay .= "<p>" . $this->pointNumber($deduction) . "</p>";
        }
        if ($allowance != 0) {
            $ndisplay .= "<p>ALLOWANCE</p>";
            $adisplay .= "<p>" . $this->pointNumber($allowance) . "</p>";
            $edisplay .= "<p>-</p>";
            $ddisplay .= "<p>-</p>";
        }
        if ($claims != 0) {
            $ndisplay .= "<p>CLAIMS</p>";
            $adisplay .= "<p>" . $this->pointNumber($claims) . "</p>";
            $edisplay .= "<p>-</p>";
            $ddisplay .= "<p>-</p>";

        }
        if ($commissions != 0) {
            $ndisplay .= "<p>COMMISSIONS</p>";
            $adisplay .= "<p>" . $this->pointNumber($commissions) . "</p>";
            $edisplay .= "<p>-</p>";
            $ddisplay .= "<p>-</p>";
        }
        if ($ot != 0) {
            $ndisplay .= "<p>OT</p>";
            $adisplay .= "<p>" . $this->pointNumber($ot) . "</p>";
            $edisplay .= "<p>-</p>";
            $ddisplay .= "<p>-</p>";
        }
        if ($bonus != 0) {
            $ndisplay .= "<p>BONUS</p>";
            $adisplay .= "<p>" . $this->pointNumber($bonus) . "</p>";
            $edisplay .= "<p>-</p>";
            $ddisplay .= "<p>-</p>";
        }

        $slip = "
    <div style='border: 4px double black;width:100%;height:396px;padding:5px'>
    <table style='border-collapse: collapse;width:100%'>
        <!--<tr class='row'>
            <td class='col' colspan='3' style='width:100%;'><img style='width:100%;' src='' ></td>
        </tr> -->
     <tr class='row'>
            <td class='col' style='width:20%;'><img style='width:20%;' src='" . $_SESSION['logoimage'] . "' ></td>
            <td class='col' style='width:50%;'><h3 style='margin-bottom:2px'>SALARY SLIP</h3><h7>" . $monthText . " " . $year . "</h7></td>
            <td class='col' style='width:30%;border-left:1px solid black;'><h2>CONFIDENTIAL</h2></td>
        </tr>
    </table>
    <table style='border-collapse: collapse;width:100%'>
        <tr class='row'>
            <td style='width:50%'>
                <p>Name: " . $staffName . "</p>
                <p>Employee ID: " . $employeeId . "</p>
            </td>
            <td style='width:50%;border-left:1px solid black;'>";
        if (isset($department) && !empty($designation)) {
            $slip .= "<p>Designation: " . $designation . "</p>";}
        if (isset($department) && !empty($department)) {
            $slip .= "<p>Department: " . $department . "</p>";}
        $slip .= "<p>Salary Month: RM " . $this->pointNumber($totalEarning) . "</p>";
        //$slip.="<p>Salary Month: ".$monthText." ".$year."</p>";
        $slip .= "</td>
        </tr>
    </table>
    <table style='border-collapse: collapse;width:100%'>
        <tr class='row'>
            <td style='color:white;background:#00B5B8;width:50%;border-left:1px solid black;text-align:center'><p><b>Description</b></p></td>
            <td style='color:white;background:#00B5B8;width:25%;border-left:1px solid black;text-align:center'><p><b>Earnings</b></p></td>
            <td style='color:white;background:#00B5B8;width:25%;border-left:1px solid black;text-align:center'><p><b>Deductions</b></p></td>
        </tr>
    </table>
    <table style='border-collapse: collapse;width:100%'>
        <tr class='row'>
            <td style='width:50%;'>
                <p>Basic Salary</p>
                <p>EPF(%)</p>
                <p>SOCSO</p>
                <p>PCB</p>
                <p>EIS</p>";
        if ((isset($_SESSION['staffloan']) && ($_SESSION['staffloan'] == 1)) && (($condition == true) && ($emi != 0))) {
            $slip .= '<p>EMI</p>';
        }
        $slip .= "" . $ndisplay . "
            </td>
            <td style='width:25%;border-left:1px solid black;text-align:right'> <p>RM " . $this->pointNumber($salaryMonth) . "</p>
                <p>-</p>
                <p>-</p>
                <p>-</p>
                <p>-</p>";
        if ((isset($_SESSION['staffloan']) && ($_SESSION['staffloan'] == 1)) && (($condition == true) && ($emi != 0))) {
            $slip .= '<p>-</p>';
        }
        $slip .= "" . $adisplay . "
            </td>
            <td style='width:13%;border-left:1px solid black;text-align:right;vertical-align: top;' > <p>Employer</p>
                <p>" . $this->pointNumber($epfLeft) . "</p>
                <p>" . $this->pointNumber($socso) . "</p>
                <p>-</p>
                <p>" . $this->pointNumber($eis) . "</p>";
        if ((isset($_SESSION['staffloan']) && ($_SESSION['staffloan'] == 1)) && (($condition == true) && ($emi != 0))) {
            $slip .= "<p>-</p>";
        }
        $slip .= $edisplay . "
            </td>
            <td style='width:12%;border-left:1px solid black;text-align:right;vertical-align: top;' ><p>Employee</p>
                <p>" . $this->pointNumber($epfRight) . "</p>
                <p>" . $this->pointNumber($socsoEmp) . "</p>
                <p>" . $this->pointNumber($pcb) . "</p>
                <p>" . $this->pointNumber($eis) . "</p>";
        if ((isset($_SESSION['staffloan']) && ($_SESSION['staffloan'] == 1)) && (($condition == true) && ($emi != 0))) {
            $slip .= "<p>" . $this->pointNumber($emi) . "</p>";
        }
        $slip .= $ddisplay . "
            </td>
        </tr>
    </table>
    <table style='border-collapse: collapse;width:100%'>
        <tr class='row'>
            <td style='width:50%;'>
                <p>Total</p>
            </td>
            <td style='width:25%;border-left:1px solid black;text-align:right'> <p>RM " . $this->pointNumber($totalEarning) . "</p>
            </td>
            <td style='width:25%;border-left:1px solid black;text-align:right'> <p>RM " . $this->pointNumber($totalDeduction) . "</p>
            </td>
        </tr>
    </table>
    <table style='border-collapse: collapse;width:100%'>
        <tr class='row' style='border-bottom:1px solid black'>
            <td style='width:50%;'>
                <p>Salary Slip Date: " . $datePayment . "</p>
                <p>Bank Name: " . $bankName . "</p>
                <p>Bank Account Name: " . $staffName . "</p>
                <p>Bank Account: " . $bankAcc . "</p>
            </td>
            <td style='width:50%;border-left:1px solid black;padding:0px'>
                <table style='border-collapse: collapse;width:100%'>
                    <tr style='border-bottom:1px solid black'>
                        <td style='background:#26C0C3;color:white;text-align:center;border-top:1px solid black;border-bottom:1px solid black;'><p>NET PAY</p></td>
                    </tr>
                    <tr style='background:#26C0C3;border-bottom:1px solid black'>
                        <td style='text-align:center;border-bottom:1px solid black;color:#fff;'><p>RM " . $this->pointNumber($netPay) . "</p></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <table style='border-collapse: collapse;width:100%'>
        <tr>
            <td style='width:100%;text-align:center'>
                <p><b><i>This is a computer generated document</i></b></p>
            </td>
        </tr>
    </table>
    </div>
    ";

        //$payslip = $htmlStart;
        //$payslip.= $headStart;
        $payslip = $style;
        //$payslip.=$headEnd;
        //$payslip.=$bodyStart;
        $payslip .= $slip;
        //$payslip.=$bodyEnd;
        //$payslip.=$htmlEnd;
        //echo $payslip;

        $pdf = $this->pdf->load();
        //generate the PDF!
        $pdf->WriteHTML($payslip);

        //$html2pdf->output();

        return $pdf;

    }

    public function fetchPayrollReportList($staffid, $salary, $allowance, $commissions, $claims, $bonus, $ot, $epf, $socso, $pcb)
    {
        $conditions = "staffName" . $salary . $allowance . $commissions . $claims . $bonus . $ot . $epf . $socso . $pcb . "," . "netPay";
        $this->db->select($conditions);
        $this->db->from('gtg_payslip');
        $this->db->where('staffId', $staffid);

        $query = $this->db->get();

        return $query->result_array();

    }
    public function deletePayslip($id)
    {
        $this->db->delete('gtg_payslip', array('id' => $id));
        return array('status' => 'Success', 'message' => $this->lang->line('DELETED'));
    }

}
