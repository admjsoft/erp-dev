<?php


defined('BASEPATH') or exit('No direct script access allowed');

class employee extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('employee_model', 'employee');
        if (!is_login()) {
            redirect(base_url() . 'user/profile', 'refresh');
        }
        $this->load->model('payments_model', 'payments');
        $this->load->model('system_model', 'adminemail');
        $this->load->model('User_model');
        $this->load->model('communication_model');
    }
public function fwmsemployees()
{
         $head['title'] = "fwmsemployees";
        is_login();
        $userid = $this->session->userdata('user_details')[0]->users_id;
		  $data['cid'] = $this->session->userdata('user_details')[0]->cid;
	
        $data['user_data'] = $this->User_model->get_users($userid);
        $head['user_data']=$data['user_data'];
        $this->load->view('includes/header',$head);
        $this->load->view('employee/fwmsemployees',$data);
        $this->load->view('includes/footer');
    
}

public function fwmsemplyeeedit()
{
        $head['title'] = "Fwms employee";
        is_login();
        $userid = $this->session->userdata('user_details')[0]->users_id;
        $data['user_data'] = $this->User_model->get_users($userid);
        $head['user_data']=$data['user_data'];
		        $id = $this->input->get('id');
        $data['clients'] = $this->employee->get_client_list();
	    $data['employee'] = $this->employee->employee_foreign_details($id);

		//$this->load->model('employee_model', 'employee');
       // $data['payslip']=$this->payroll->getPayslipList();

        $this->load->view('includes/header',$head);
        $this->load->view('employee/fwmsemployeeedit', $data);
        $this->load->view('includes/footer');


}	
public function updateInternational()
{
	  $id = $this->input->post('update_id');
      
	$type=$this->input->post('chooseradio');
	$emp_name= $this->input->post('emp_name');
    $passport= $this->input->post('passport');
	$permit= $this->input->post('permit');
	$country= $this->input->post('country');
	$company= $this->input->post('company');
	$passport_expiry= $this->input->post('passport_expiry');
	$permit_expiry= $this->input->post('permit_expiry');
    $username = $this->input->post('user_name', true);
   // $attach = $_FILES['image']['name'];
	$email= $this->input->post('user_email');

        $password = $this->input->post('user_password', true);
        $roleid = 3;
        if ($this->input->post('roleid')) {
            $roleid = $this->input->post('roleid');
        }

    
	//	$a = $this->aauth->create_user($email, $password, $username);
		
    $update=$this->employee->updateInternational($id,$emp_name,$email,$passport,$permit,$country,$company,$type,$passport_expiry,$permit_expiry,'');
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
	if(!$update){
                    $data['status'] = 'danger';
                    $data['message'] = $this->lang->line('Employee Add error');
                    }

					else{
                    $data['status'] = 'success';
                    $data['message'] = $this->lang->line('Employee Updated Successfully');
}
	     $_SESSION['status']=$data['status'];
        $_SESSION['message']=$data['message'];
        $this->session->mark_as_flash('status');
        $this->session->mark_as_flash('message');
		redirect('employee/fwmsemployees', 'refresh');
        exit();


	
}

public function deleteFwmsEmployee()
{
		 $id = $this->input->post('deleteid');

	$this->db->delete('gtg_employees', array('id' => $id));

           // $this->db->delete('gtg_users', array('id' => $uid));

            echo json_encode(array('status' => 'Success', 'message' =>
            'Employee deleted successfully'));

	}
public function getfwmsEmployees()
{

	    $ttype = $this->input->get('type');
        $list = $this->employee->employee_datatables();
         $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        $temp='';
		$type='';
	  foreach ($list as $prd) {
            $no++;
			$ps='<a href="../userfiles/passport/'.$prd->passport_document.'" target=_blank>'.$prd->passport.'</a>';
			$vs='<a href="../userfiles/passport/'.$prd->visa_document.'" target=_blank>'.$prd->permit.'</a>';
            $row = array();
		    if($prd->delete_status==1)
			{
			$status="In Active";
			}
			else{
			$status="Active";

			}
			
            $pid = $prd->id;
            //$row[] = dateformat($prd->created_at);
			$row[]= $no;
            $row[] = $prd->name;
            $row[] = $prd->cname;
            $row[] = $ps;
			$row[] = '<b style="color:red">'.$prd->passport_expiry.'</b>';
            $row[] = $vs;
			$row[] = '<b style="color:red">'.$prd->permit_expiry.'';
			$row[]=$status;
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
            "recordsTotal" =>$this->employee->employee_count_all(),
            "recordsFiltered" =>$this->employee->employee_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
}


public function fwmsreport()
{

	    $this->load->library("Custom");
        $head['title'] = "Fws Report";
		  $cid= $this->session->userdata('user_details')[0]->cid;
        $data['employees'] = $this->employee->get_employee_list($cid);
  
        $this->load->view('includes/header',$head);
        $this->load->view('employee/fwmsReport', $data);
        $this->load->view('includes/footer');


}


public function fwmsreportGenerate()
{

		    $this->load->library("Custom");
        $head['title'] = "Fws Report";
		  $cid= $this->session->userdata('user_details')[0]->cid;
        $data['employees'] = $this->employee->get_employee_list($cid);
          $data['cid'] =$cid;
$data['employee']=$this->input->post('employee');
$data['expiry']=$this->input->post('expiry');

        $this->load->view('includes/header',$head);
        $this->load->view('employee/fwmsReportdata', $data);
        $this->load->view('includes/footer');

}
public function fwmsemplyeeview()
{
	
	 $id = $this->input->get('id');
	
        $head['title'] = "Fwms employee";
        is_login();
        $userid = $this->session->userdata('user_details')[0]->users_id;
        $data['user_data'] = $this->User_model->get_users($userid);
        $head['user_data']=$data['user_data'];
		 $id = $this->input->get('id');
        $data['clients'] = $this->employee->get_client_list();
	    $data['employee'] = $this->employee->employee_foreign_details($id);
		//$this->load->model('employee_model', 'employee');
       // $data['payslip']=$this->payroll->getPayslipList();
        $this->load->view('includes/header',$head);
        $this->load->view('employee/fwmsemployeeview', $data);
        $this->load->view('includes/footer');

	
}





public function fwmsReportGenerateAjax()
{
	
	   	    ///  $company = $this->input->post('company');

	      $ttype = $this->input->get('type');
        $list = $this->employee->employee_report_datatables();
         $data = array();
        // $no = $_POST['start'];
        $temp='';
		$type='';
	   $no = $this->input->post('start');
        foreach ($list as $obj) {
            $no++;
            $row = array();
			$pid= $obj->id;
            $row[] = $no;
            $row[] = $obj->name;
            $row[] = $obj->country;
            $row[] = $obj->passport;
			$row[] = $obj->passport_expiry;
            $row[] = $obj->permit;
            $row[] = $obj->permit_expiry;
		 $row[] = '<a href="' . base_url() . 'employee/fwmsemplyeeview?id=' . $pid . '" class="btn btn-success btn-sm" title="view"><i class="fa fa-view">view</i></a>';

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









}