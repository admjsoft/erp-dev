<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Asset extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('asset_model', 'asset');

        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        // if (!$this->aauth->premission(9)) {
        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }
        $this->li_a = 'asset';
        $c_module = 'asset management';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);
    }
    public function assetlist() {
        $this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Asset List";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->model('employee_model', 'employee');
        $data['employee'] = $this->employee->list_employee();
        $this->load->view('fixed/header', $head);
        $this->load->view('asset/assetlist', $data);
        $this->load->view('fixed/footer');
    }
    public function create() {
        $this->load->library("Common");
        $data['langs'] = $this->common->languages();
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['categories'] = $this->asset->get_all_categories();
        $data['subcategories'] = $this->asset->get_all_sub_categories();
        $data['status'] = $this->asset->get_all_asset_status();
        $data['department'] = $this->asset->get_all_department();
        //die;
        // $data['custom_fields'] = $this->custom->add_fields(1);
        $this->load->model('employee_model', 'employee');
        $data['employee'] = $this->employee->list_employee();
        $head['title'] = 'Create Asset';
        $this->load->view('fixed/header', $head);
        $this->load->view('asset/create', $data);
        $this->load->view('fixed/footer');
    }
    public function edit() {
        $id = $this->input->get('id');
        $this->load->library("Common");
        $data['langs'] = $this->common->languages();
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['categories'] = $this->asset->get_all_categories();
        $data['subcategories'] = $this->asset->get_all_sub_categories();
        $data['status'] = $this->asset->get_all_asset_status();
        $data['department'] = $this->asset->get_all_department();
        $data['assetmanagement'] = $this->asset->get_all_sub_assets($id);
        // $data['custom_fields'] = $this->custom->add_fields(1);
        $this->load->model('employee_model', 'employee');
        $data['employee'] = $this->employee->list_employee();
        $head['title'] = 'Asset Edit';
        $this->load->view('fixed/header', $head);
        $this->load->view('asset/edit', $data);
        $this->load->view('fixed/footer');
    }
    public function assetStatus() {
        $this->load->library("Common");
        $data['langs'] = $this->common->languages();
        $head['usernm'] = $this->aauth->get_user()->username;
        $data = [];
        //die;
        // $data['custom_fields'] = $this->custom->add_fields(1);
        $head['title'] = 'Asset Status List';
        $this->load->view('fixed/header', $head);
        $this->load->view('asset/assetStatus', $data);
        $this->load->view('fixed/footer');
    }
    public function create_asset_status() {
        $this->load->model('asset_status');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $insert = $this->asset_status->addstatus($name, $description);
        if (!$insert) {
            $data['status'] = 'danger';
            $data['message'] = $this->lang->line('Asset Status Error');
        } else {
            $data['status'] = 'success';
            $data['message'] = $this->lang->line('Asset Satus added');
        }
        $_SESSION['status'] = $data['status'];
        $_SESSION['message'] = $data['message'];
        redirect('asset/assetStatus', 'refresh');
        exit();
    }
	
	
    public function getassetstatus() {
        $ttype = $this->input->get('type');
        $this->load->model('asset_status');
        $list = $this->asset_status->get_datatables($ttype);
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        $temp = '';
        $type = '';
        foreach ($list as $val) {
            $no++;
            $row = array();
            $pid = $val->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $val->name;
            $row[] = $val->description;
            $row[] = $val->created_at;
			$row[] = '<a href="#" class="btn btn-primary btn-sm" onclick="AddEdit(' . $pid . ');"><span class="fa fa-edit"></span>  ' . $this->lang->line('Edit') . '</a> &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            // $row[] = dateformat($prd->receipt_date);
            // $row[] = amountExchange($prd->receipt_amount, 0, $this->aauth->get_user()->loc);
            // $row[] = amountExchange($prd->tax_amount, 0, $this->aauth->get_user()->loc);
            //   $row[] = '<a href="' . base_url("payroll/viewslip?id=$pid&typeid=$typeid") . '" class="btn btn-success btn-sm" title="View"><i class="fa fa-eye"></i></a>&nbsp;
            //<a href="' . base_url("payroll/downloadpayslip?id=$pid&typeid=$typeid") . '" class="btn btn-info btn-sm"  title="Download"><span class="fa fa-download"></span></a>';
            //$row[] =$temp;
            /*
              $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            */
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->asset->count_all(), "recordsFiltered" => $this->asset->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }
    public function addasset() {
        $AssetId = $this->input->post('AssetId');
        $AssetModelNo = $this->input->post('AssetModelNo');
        $barcode = $this->input->post('barcode');
        $Name = $this->input->post('Name');
        $Description = $this->input->post('Description');
        $UnitPrice = $this->input->post('UnitPrice');
        $AssetStatus = $this->input->post('AssetStatus');
        $DateOfPurchase = $this->input->post('DateOfPurchase');
        $Category = $this->input->post('Category');
        $SubCategory = $this->input->post('SubCategory');
        $Supplier = $this->input->post('Supplier');
        $Department = $this->input->post('Department');
        $SubDepartment = $this->input->post('SubDepartment');
        $DateOfManufacture = $this->input->post('DateOfManufacture');
        $YearOfValuation = $this->input->post('YearOfValuation');
        $WarranetyInMonth = $this->input->post('WarranetyInMonth');
        $Location = $this->input->post('Location');
        $DepreciationInMonth = $this->input->post('DepreciationInMonth');
        $note = $this->input->post('Note');
        $employee = $this->input->post('AssignEmployeeId');
        $emp = $this->asset->employee_details($employee);
        $attach = $_FILES['ImageURLDetails']['name'];
		if($attach)
		{
        $data['status'] = 'danger';
        $data['message'] = $this->lang->line('No file error');
        $config['upload_path'] = './userfiles/assetmanagement/';
        $config['allowed_types'] = 'png|jpeg|jpg|JPEG';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = 969881;
        $config['file_name'] = time() . str_replace(' ', '_', $attach);
        $config['file_ext_tolower'] = TRUE;
        $config['encrypt_name'] = FALSE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('ImageURLDetails')) {
            $error = array('status' => 'file', 'error' => $this->upload->display_errors());
            echo json_encode($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
           $filename = $data['upload_data']['file_name'];
		}
		}
		else{
			$filename='blank-asset.png';
		}
		//print_r($filename);
            //die;
            $asset = $this->asset->addasset($AssetId, $barcode, $AssetModelNo, $Name, $Description, $UnitPrice, $AssetStatus, $DateOfPurchase, $Category, $SubCategory, $Supplier, $Department, $SubDepartment, $DateOfManufacture, $YearOfValuation, $WarranetyInMonth, $DepreciationInMonth, $Location, $filename, $note, $employee);
            if ($asset) {
                $datetime = date("Y-m-d") . " " . date("h:i:sa");
                if (empty($employee)) {
                    $action = "Asset Created";
                    $employee = "Unassigned";
                    $historydata = array('asset_id' => $asset, 'assign_asset_employee' =>'', 'emp_id' => $employee, 'action' => $action, 'created_at' => $datetime);
                   $this->db->insert('asset_history', $historydata);

			 } else {
                    $action = "Asset Created";
                    $employeeName = $emp->name;
                    $historydata = array(array('asset_id' => $asset, 'assign_asset_employee' => $employeeName, 'emp_id' => $employee, 'action' => $action, 'created_at' => $datetime), array('asset_id' => $asset, 'assign_asset_employee' => $employeeName, 'emp_id' => $employee, 'action' => 'Unassigned Asset Assigned to Employee', 'created_at' => $datetime));
                             $this->db->insert_batch('asset_history', $historydata);

			 }
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Asset Added')));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('Add Error')));
            }
			}
    
    public function update_asset() {
		//print_r($_POST);
        $id = $this->input->post('id');
        $AssetId = $this->input->post('AssetId');
        $AssetModelNo = $this->input->post('AssetModelNo');
        $barcode = $this->input->post('barcode');
        $Name = $this->input->post('Name');
        $Description = $this->input->post('Description');
        $UnitPrice = $this->input->post('UnitPrice');
        $AssetStatus = $this->input->post('AssetStatus');
        $DateOfPurchase = $this->input->post('DateOfPurchase');
        $Category = $this->input->post('Category');
        $SubCategory = $this->input->post('SubCategory');
        $Supplier = $this->input->post('Supplier');
        $Department = $this->input->post('Department');
        $SubDepartment = $this->input->post('SubDepartment');
        $DateOfManufacture = $this->input->post('DateOfManufacture');
        $YearOfValuation = $this->input->post('YearOfValuation');
        $WarranetyInMonth = $this->input->post('WarranetyInMonth');
        $Location = $this->input->post('Location');
        $DepreciationInMonth = $this->input->post('DepreciationInMonth');
        $note = $this->input->post('Note');
          $employee = $this->input->post('AssignEmployeeId');
        $assetemployee = $this->asset->get_asset_history($id);
		
		 $attach = $_FILES['ImageURLDetails']['name'];
		if($attach)
		{
        $data['status'] = 'danger';
        $data['message'] = $this->lang->line('No file error');
        $config['upload_path'] = './userfiles/assetmanagement/';
        $config['allowed_types'] = 'png|jpeg|jpg|JPEG';
        $config['encrypt_name'] = TRUE;
        $config['max_size'] = 969881;
        $config['file_name'] = time() . str_replace(' ', '_', $attach);
        $config['file_ext_tolower'] = TRUE;
        $config['encrypt_name'] = FALSE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('ImageURLDetails')) {
            $error = array('status' => 'file', 'error' => $this->upload->display_errors());
            echo json_encode($error);
        } else {
            $data = array('upload_data' => $this->upload->data());
           $filename = $data['upload_data']['file_name'];
		}
		}
		else{
        $filename = $this->input->post('image');
		}
        $updateasset = $this->asset->updateasset($id,$AssetId,$AssetModelNo,$Name,$Description, 
		$UnitPrice, $AssetStatus, $DateOfPurchase, $Category, $SubCategory, $Supplier, $Department, $SubDepartment,
		$DateOfManufacture, $YearOfValuation, $WarranetyInMonth, $Location,$filename,$DepreciationInMonth, $note, $employee);
        $datetime = date("Y-m-d") . " " . date("h:i:sa");
        if ($updateasset) {
			
			  if($employee==0 && empty($assetemployee))
		   {
		 $historydata = array('asset_id' => $id,  'action' => 'Unassigned Asset Updated', 'created_at' => $datetime);

		   }
		   if(!empty($assetemployee)){
             if ($assetemployee->emp_id == $employee) {
                $emp = $this->asset->employee_details($assetemployee->emp_id);
                $historydata = array('asset_id' => $id, 'assign_asset_employee' =>'', 'emp_id' => $assetemployee->emp_id, 'action' => 'Asset Updated', 'created_at' => $datetime);
                $this->db->insert('asset_history', $historydata);

		   } 
		  
		   
		   else { 
                $emp = $this->asset->employee_details($employee);
                $historydata = array(array('asset_id' => $id, 'assign_asset_employee' => $emp->name, 'emp_id' => $employee, 'action' => 'Asset Unassigned From employee', 'created_at' => $datetime), array('asset_id' => $id, 'assign_asset_employee' => $emp->name, 'emp_id' => $employee, 'action' => 'Asset Assigned to Employee', 'created_at' => $datetime));
                $this->db->insert_batch('asset_history', $historydata);

		 }
		   }
		 
		 
		 
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('UPDATED')));
        } 
		else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('Update Error')));
        }
    }
    public function deleteAsset() {
        $id = $this->input->post('deleteid');
        $delete = $this->asset->delete($id);
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
    }
	public function deleteComment()
	{
		        $id = $this->input->post('deleteid');
 $delete = $this->asset->deleteComment($id);
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
	}
	public function deleteStatus()
	{
	    $id = $this->input->post('deleteid');
        $delete = $this->asset->deleteStatus($id);
       if($delete)
	   {
	   echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
       }
	   else{
	   echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('Error In Delete')));	
	   }
		
	}
	
	
	
    public function assetcategory() {
        $this->load->library("Common");
        $data['langs'] = $this->common->languages();
        $head['usernm'] = $this->aauth->get_user()->username;
        $data = [];
        //die;
        // $data['custom_fields'] = $this->custom->add_fields(1);
        $head['title'] = 'Asset Cateory List';
        $this->load->view('fixed/header', $head);
        $this->load->view('asset/assetcategory', $data);
        $this->load->view('fixed/footer');
    }
    public function assetsubcategory() {
        $this->load->library("Common");
        $data['langs'] = $this->common->languages();
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->model('asset_category');
        $data['subcat'] = $this->asset_category->get_asset_category();
        //die;
        // $data['custom_fields'] = $this->custom->add_fields(1);
        $head['title'] = 'Asset Sub Category List';
        $this->load->view('fixed/header', $head);
        $this->load->view('asset/assetsubcategory', $data);
        $this->load->view('fixed/footer');
    }
    public function save_asset_sub_category() {
        $this->load->model('asset_sub_category');
        $category = $this->input->post('Category');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $insert = $this->asset_sub_category->addsubcategory($category, $name, $description);
        if (!$insert) {
            $data['status'] = 'danger';
            $data['message'] = $this->lang->line('Asset Sub Category error');
        } else {
            $data['status'] = 'success';
            $data['message'] = $this->lang->line('Asset Sub Category added');
        }
        $_SESSION['status'] = $data['status'];
        $_SESSION['message'] = $data['message'];
        redirect('asset/assetsubcategory', 'refresh');
        exit();
    }
    public function getassetsubcategories() {
        $ttype = $this->input->get('type');
        $this->load->model('asset_sub_category');
        $list = $this->asset_sub_category->get_datatables($ttype);
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        $temp = '';
        $type = '';
        foreach ($list as $val) {
            $no++;
            $row = array();
            $pid = $val->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $val->asset_category;
            $row[] = $val->name;
            $row[] = $val->description;
            $row[] = $val->created_at;
            $row[] = '<a href="' . base_url() . 'asset/sub_category_edit?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span>  ' . $this->lang->line('Edit') . '</a> &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            // $row[] = dateformat($prd->receipt_date);
            // $row[] = amountExchange($prd->receipt_amount, 0, $this->aauth->get_user()->loc);
            // $row[] = amountExchange($prd->tax_amount, 0, $this->aauth->get_user()->loc);
            //   $row[] = '<a href="' . base_url("payroll/viewslip?id=$pid&typeid=$typeid") . '" class="btn btn-success btn-sm" title="View"><i class="fa fa-eye"></i></a>&nbsp;
            //<a href="' . base_url("payroll/downloadpayslip?id=$pid&typeid=$typeid") . '" class="btn btn-info btn-sm"  title="Download"><span class="fa fa-download"></span></a>';
            //$row[] =$temp;
            /*
              $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            */
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->asset->count_all(), "recordsFiltered" => $this->asset->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }
    public function save_asset_category() {
        $this->load->model('asset_category');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $insert = $this->asset_category->addcategory($name, $description);
        if (!$insert) {
            $data['status'] = 'danger';
            $data['message'] = $this->lang->line('Asset Category error');
        } else {
            $data['status'] = 'success';
            $data['message'] = $this->lang->line('Asset Category added');
        }
        $_SESSION['status'] = $data['status'];
        $_SESSION['message'] = $data['message'];
        redirect('asset/assetcategory', 'refresh');
        exit();
    }
    public function category_edit() {
        $id = $this->input->get('id');
        $this->load->library("Common");
        $data['langs'] = $this->common->languages();
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['categorie'] = $this->asset->get_category_by_Id($id);
        //die;
        // $data['custom_fields'] = $this->custom->add_fields(1);
        $head['title'] = 'Create Customer';
        $this->load->view('fixed/header', $head);
        $this->load->view('asset/category_edit', $data);
        $this->load->view('fixed/footer');
    }
    public function sub_category_edit() {
        $id = $this->input->get('id');
        $this->load->library("Common");
        $data['langs'] = $this->common->languages();
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['sub_category'] = $this->asset->get_sub_category_by_Id($id);
        $data['categories'] = $this->asset->get_all_categories();
        //die;
        // $data['custom_fields'] = $this->custom->add_fields(1);
        $head['title'] = 'Create Customer';
        $this->load->view('fixed/header', $head);
        $this->load->view('asset/sub_category_edit', $data);
        $this->load->view('fixed/footer');
    }
    public function updateCategory() {
        $catid = $this->input->post('catid');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $update = $this->asset->updatecategory($catid, $name, $description);
        if ($update) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('UPDATED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }
    public function deleteCategory() {
        $id = $this->input->post('deleteid');
        $delete = $this->asset->deleteCategory($id);
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
       // echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('Error In Delete')));
    }
    public function deleteSubCategory() {
        $id = $this->input->post('deleteid');
        $delete = $this->asset->deleteSubCategory($id);
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
        echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('Error In Delete')));
    }
    public function updateSubCategory() {
        $subcatid = $this->input->post('subcatid');
        $category = $this->input->post('Category');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $update = $this->asset->updateSubCategory($category, $subcatid, $name, $description);
        if ($update) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('UPDATED')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
    }
    public function getassetcategories() {
        $ttype = $this->input->get('type');
        $this->load->model('asset_category');
        $list = $this->asset_category->get_datatables($ttype);
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        $temp = '';
        $type = '';
        foreach ($list as $val) {
            $no++;
            $row = array();
            $pid = $val->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $val->name;
            $row[] = $val->description;
            $row[] = $val->created_at;
            $row[] = '<a href="' . base_url() . 'asset/category_edit?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span>  ' . $this->lang->line('Edit') . '</a> &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            // $row[] = dateformat($prd->receipt_date);
            // $row[] = amountExchange($prd->receipt_amount, 0, $this->aauth->get_user()->loc);
            // $row[] = amountExchange($prd->tax_amount, 0, $this->aauth->get_user()->loc);
            //   $row[] = '<a href="' . base_url("payroll/viewslip?id=$pid&typeid=$typeid") . '" class="btn btn-success btn-sm" title="View"><i class="fa fa-eye"></i></a>&nbsp;
            //<a href="' . base_url("payroll/downloadpayslip?id=$pid&typeid=$typeid") . '" class="btn btn-info btn-sm"  title="Download"><span class="fa fa-download"></span></a>';
            //$row[] =$temp;
            /*
              $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            */
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->asset->count_all(), "recordsFiltered" => $this->asset->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }
    public function getbarcode() {
        $code = $this->input->post('assetid');
        //print_r($_SESSION['asset_id']);
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode
        $imageResource = Zend_Barcode::factory('code128', 'image', array('text' => $code), array())->draw();
        imagepng($imageResource, FCPATH . 'barcodes/' . $code . '.png');
        $barcode = 'barcodes/' . $code . '.png';
        $url = base_url($barcode);
        $img = '<img alt="image" id="dpic" class="card-img-top img-fluid"
                                 src="' . $url . '" style="width:200px;height:150px;">';
        $data['url'] = $url;
        $data['img'] = $img;
        echo json_encode($data);
    }
	public function assetllistComments()
	{
		
		   $this->load->model('asset_comment');
		  $ttype='';
          $list = $this->asset_comment->get_datatables($ttype);
		  $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        $temp = '';
        $type = '';
	  foreach ($list as $prd) {
            $no++;
            $row = array();
            $pid = $prd->id;
            //$empid = $prd->empid;
            //$row[] = dateformat($prd->created_at);
           /// $url = base_url('userfiles/assetmanagement/') . $prd->image_url;
            //	$row[]= $no;
            $row[] = $prd->asset_id;
            $row[] = $prd->comments;
            $row[] = $prd->comment_by;
			$row[] = $prd->created_at;			
            $row[] = '<a href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->asset->count_all(), "recordsFiltered" => $this->asset->count_filtered(), "data" => $data);
	 
	   //output to json format
        echo json_encode($output);
	}
    public function assetllistAjax() {
        $ttype = $this->input->get('type');
        $list = $this->asset->get_datatables($ttype);
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        $temp = '';
        $type = '';
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $pid = $prd->id;
            $empid = $prd->empid;
            //$row[] = dateformat($prd->created_at);
            $url = base_url('userfiles/assetmanagement/') . $prd->image_url;
            //	$row[]= $no;
            $row[] = '<img src="' . $url . '" width="75" height="75">';
            $row[] = $prd->asset_id;
            $row[] = $prd->asset_modelno;
            $row[] = $prd->name;
			if($empid!=0)
			{
            $row[] = '<a href="#" class="fa fa-eye" onclick="AssignEmployeeInfo(' . $empid . ');">&nbsp;&nbsp;' . $prd->employee . '</a>';
            }
			else{
		 $row[] = 'Unassigned';

			}
			$row[] = $prd->unit_price;
            $row[] = $prd->date_of_purchase;
            $row[] = '<a href="#" onclick="AssetInfo(' . $pid . ');" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> 
			<a href="#" onclick="AssetEdit('.$pid.');" class="btn btn-primary btn-sm"><span class="fa fa-edit"></span>  ' . $this->lang->line('Edit') . '</a> &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->asset->count_all(), "recordsFiltered" => $this->asset->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }
	
	public function AssetEdit()
	{
	    $id = $this->input->post('id');
	    $asset_data=$this->asset->get_all_sub_assets($id);
	    $categories= $this->asset->get_all_categories();
        $subcategories = $this->asset->get_all_sub_categories();
        $status = $this->asset->get_all_asset_status();
        $department = $this->asset->get_all_department();
		$this->load->model('employee_model', 'employee');
        $employee = $this->employee->list_employee();
		$comments = $this->asset->get_comments($id);

       foreach($asset_data as $assetValue)
	   {
		$asset=$assetValue;
	   }
	 
	 
$html='';
		    $html.='<div>
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" data-val="true" data-val-required="The SL field is required." id="Id" name="Id" value="0">
            <input type="hidden" data-val="true" data-val-required="The Created Date field is required." id="CreatedDate" name="CreatedDate" value="01/01/0001 00:00:00">
            <input type="hidden" id="CreatedBy" name="CreatedBy" value="">

            <form id="frmAsset" method="post"  class="form-horizontal" enctype="multipart/form-data">
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="BasicInfo" data-toggle="pill" href="#divBasicInfo" role="tab" aria-controls="BasicInfo" aria-selected="true">Basic Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="OtherInfo" data-toggle="pill" href="#divOtherInfo" role="tab" aria-controls="OtherInfo" aria-selected="true">Other Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="OtherTab" data-toggle="pill" href="#divOtherTab" role="tab" aria-controls="OtherTab" aria-selected="true">Asset Assign</a>
                            </li>
							<li class="nav-item">
                                <a class="nav-link" id="CommentTab" data-toggle="pill" href="#divCommentTab" role="tab" aria-controls="CommentHistoryTab" aria-selected="true">Comment History</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="tabContent">
                            <div class="tab-pane fade show active" id="divBasicInfo" role="tabpanel" aria-labelledby="divBasicInfo">
                                <div class="row">
                                    <div class="col-6 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="AssetId">Asset Id </label>
                                            <div class="col-sm-5">
                                                <input class="form-control" id="AssetId" type="text" data-val="true" data-val-required="The Asset Id field is required."
												name="AssetId" id="AssetId" value="'.$asset['asset_id'].'" readonly>
                                                <span class="text-danger field-validation-valid" data-valmsg-for="AssetId" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="col-sm-4">
												<input type="hidden" name="barcode"  id="barcode" value="">
												<input type="hidden" name="id"  id="id" value="'.$asset['id'].'">

                                             <!--   <input type="button" value="Update Barcode" onclick="UpdateBarcode()" class="btn btn-sm btn-info">-->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="AssetModelNo">Asset Model No <span style="color:red">*</span></label>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="AssetModelNo" type="text" name="AssetModelNo" id="AssetModelNo" value="'.$asset['asset_modelno'].'">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="AssetModelNo" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="Name">Name <span style="color:red">*</span></label>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="Name" type="text" data-val="true" data-val-required="The Name field is required." name="Name" value="'.$asset['name'].'">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="Name" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="Description">Description <span style="color:red">*</span></label>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="Description" type="text" name="Description" value="'.$asset['description'].'">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="Description" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="UnitPrice">Unit Price <span style="color:red">*</span></label>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="UnitPrice" type="number" data-val="true" data-val-number="The field Unit Price must be a number." name="UnitPrice" value="'.$asset['unit_price'].'">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="UnitPrice" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="AssetStatus">Asset Status <span style="color:red">*</span></label>
                                            <div class="col-sm-9">
                                           <select id="AssetStatus" class="form-control" style="width:100%;" data-val="true" 
										   data-val-required="The Asset Status field is required." name="AssetStatus">
                                                ';
												foreach($status as $statusVal)
											   {
												 if($statusVal['id']==$asset['asset_status']){ 
												 
												 $val="selected";
												 
												 }
								$html.='<option value="'.$statusVal['id'].'"  $val>'.$statusVal['name'].'</option>';
											}
											$html.='</select>
                                                <span class="text-danger field-validation-valid" data-valmsg-for="AssetStatus" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="DateOfPurchase">Date Of Purchase</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="date" data-val="true" data-val-required="The Date Of Purchase field is required." id="DateOfPurchase" name="DateOfPurchase" value="'.$asset['date_of_purchase'].'">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="DateOfPurchase" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="Barcode">Barcode</label>
                                            <div class="col-sm-9"><img alt="image" id="dpic" class="card-img-top img-fluid" src="'.$asset['barcode'].'" style="width:200px;height:150px;">';
											
											
                                                $html.='<span class="text-danger field-validation-valid" data-valmsg-for="Barcode" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="Category">Category <span style="color:red">*</span></label>
                                            <div class="col-sm-9">
                                                <select id="Category" class="form-control" style="width:100%;" data-val="true" data-val-required="The Category field is required." name="Category">
                                                    <option disabled="" selected="">--- SELECT ---</option>
                                               ';
											  foreach($categories as $catvalue)
											   {
												  if($catvalue['id']==$asset['category'])
												  { 
												 
												  $val="selected";
												 
												 }
												   $html.='<option value="'.$catvalue['id'].'"  $val>'.$catvalue['name'].'</option>';
											}
												
											  $html.='</select>
                                                <span class="text-danger field-validation-valid" data-valmsg-for="Category" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>';
										$html.='
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="SubCategory">Sub Category</label>
                                            <div class="col-sm-9">
                                                <select id="SubCategory" class="form-control" style="width:100%;" data-val="true" data-val-required="The Sub Category field is required." name="SubCategory">
                                                    <option disabled="" selected="">--- SELECT ---</option>
                                                ';
											foreach($subcategories as $subcat)
											     {
												  if($subcat['id']==$asset['subcategory']){ 
												 
												 $val="selected";
												 
												 }
												   $html.='<option value="'.$subcat['id'].'"  '.$val.'>'.$subcat['name'].'</option>';
											     }
												 
												
												$html.='</select>
                                                <span class="text-danger field-validation-valid" data-valmsg-for="SubCategory" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="Department">Department <span style="color:red">*</span></label>
                                            <div class="col-sm-9">
                                                <select id="Department" class="form-control" style="width:100%;" data-val="true" data-val-required="The Department field is required." name="Department">
                                                    <option disabled="" selected="">--- SELECT ---</option>';
												
												foreach($department as $dep)
											     {
												  if($dep['id']==$asset['department']){ 
												 
												 $val="selected";
												 
												 }
												   $html.='<option value="'.$dep['id'].'"  '.$val.'>'.$dep['val1'].'</option>';
											     }
												
                              $html.='                 
</select>
                                                <span class="text-danger field-validation-valid" data-valmsg-for="Department" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="divOtherInfo" role="tabpanel" aria-labelledby="divOtherInfoTab">
                                <div class="row">
                                    <div class="col-6 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="DateOfManufacture">Date Of Manufacture</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="DateOfManufacture" type="date" data-val="true" 
												data-val-required="The Date Of Manufacture field is required." name="DateOfManufacture" value="'.$asset['date_of_manufacture'].'">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="DateOfManufacture" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="YearOfValuation">Year Of Valuation</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="YearOfValuation" type="date" data-val="true"
												data-val-required="The Year Of Valuation field is required." name="YearOfValuation" value="'.$asset['year_of_valuation'].'">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="YearOfValuation" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="WarranetyInMonth">Warranety In Month</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="WarranetyInMonth" type="text" name="WarranetyInMonth" value="'.$asset['warrenty_month'].'">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="WarranetyInMonth" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="DepreciationInMonth">Depreciation In Month</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="DepreciationInMonth" type="text" name="DepreciationInMonth" value="'.$asset['depreciation_month'].'">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="DepreciationInMonth" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="Location">Location</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="Location" type="text" name="Location" value="'.$asset['location'].'">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="Location" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="ImageURL">Image</label>
                                            <div class="col-sm-9">
                                                <span class="control-fileupload">
                                                    <label for="file">Choose a file :</label>
                                                    <input type="file" id="ImageURLDetails" name="ImageURLDetails">
													<input type="hidden" name="image" id="image" value="'.$asset['image_url'].'">
                                                </span>
                                            </div>
                                        </div>
                                       <!--- <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="PurchaseReceipt">Purchase Receipt</label>
                                            <div class="col-sm-9">
                                                <span class="control-fileupload">
                                                    <label for="file">Choose a file :</label>
                                                    <input type="file" id="PurchaseReceiptDetails" name="PurchaseReceiptDetails">
                                                </span>
                                            </div>
                                        </div>-->
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="Note">Note</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" id="Note" type="text" rows="3" name="Note">'.$asset['note'].'</textarea>
                                                <span class="text-danger field-validation-valid" data-valmsg-for="Note" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="divOtherTab" role="tabpanel" aria-labelledby="divOtherTab">
                                <div class="row">
                                    <div class="col-6 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="AssignEmployeeId">Assign Employee</label>
                                            <div class="col-sm-8">
                                                <select id="AssignEmployeeId" class="form-control" style="width:100%;" data-val="true" data-val-required="The Assign Employee field is required." name="AssignEmployeeId">
                                                    ';
													if($asset['assign_employee']==0)
													{
												$html.='<option  value="0" selected>Unassigned</option>';		
													}
													else{
                                            $html.='<option  value="0">Unassigned</option>';		
	
													}
												foreach($employee as $emp)
											     {
													 $vall="";
												 if($emp['id']==$asset['assign_employee']){ 
												 
												$vall="selected";
												 
												}
												 
												   $html.='<option value="'.$emp['id'].'" '.$vall.'>'.$emp['name'].'</option>';
											     }
$html.='
</select>
                                                <span class="text-danger field-validation-valid" data-valmsg-for="AssignEmployeeId" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-6">
                                    </div>
                                </div>
                            </div>
							<div class="tab-pane" id="divCommentTab" role="tabpanel" aria-labelledby="divCommentTab">
                                
<div id="tblCommentHistoryInPrint_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
<div class="row"><div class="col-sm-12">
 <table class="CustomBlueTable dataTable no-footer" id="tblCommentHistoryInPrint" style="width: 100%;" border="1" role="grid" aria-describedby="tblCommentHistoryInPrint_info">
    <thead>
        <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="tblCommentHistoryInPrint" rowspan="1" colspan="1" aria-sort="ascending" 
		aria-label="Comment: activate to sort column descending" style="width: 276px;">Comment</th><th class="sorting" tabindex="0" aria-controls="tblCommentHistoryInPrint"
		rowspan="1" colspan="1" aria-label="Comment By: activate to sort column ascending" style="width: 361px;">Comment By</th>
		<th class="sorting" tabindex="0" aria-controls="tblCommentHistoryInPrint" rowspan="1" colspan="1" 
		aria-label="Comment Date: activate to sort column ascending" style="width: 411px;">Comment Date</th></tr>
    </thead>
    <tbody>';
	if(!empty($comments))
	{
	foreach($comments as $comment)
	{
	$html.='
	<tr class="odd">
	<td>'.$comment['comments'].'</td>
	<td>'.$comment['comment_by'].'</td>
	<td>'.$comment['created_at'].'</td>
	</tr>';
	}}
	else{
	$html.='
    <tr class="odd"><td valign="top" colspan="3" class="dataTables_empty">No data available in table</td></tr>';
	}
	$html.='</tbody>
</table></div></div>
<script>
    $(document).ready(function () {
        $("#tblCommentHistoryInPrint").DataTable({
        });
    });
</script>
                                <hr>
                                
                                <div class="form-group">
                                    <label class="control-label" for="CommentMessage">Comment Message</label>
									                                <input type="hidden" value="'.$id.'" id="tmpAssetId">

                                    <textarea class="form-control" id="CommentMessage" name="CommentMessage"></textarea>
                                    <span class="text-danger field-validation-valid" data-valmsg-for="CommentMessage" data-valmsg-replace="true"></span>
                                </div>
                                <div class="form-group">
                                    <input type="button" value="Add Comment" class="btn btn-info" onclick="AddNewComment()">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <input type="submit" id="btnSave" value="Save" onclick="updateAsset()" class="btn btn-info">
                            <button type="button" id="btnClose" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>';
echo json_encode($html);

	}
	
public function AddComments()
{
	        $id = $this->input->post('id');
	        $CommentMessage = $this->input->post('CommentMessage');
           $comment= $this->asset->addComment($id,$CommentMessage);  
	   if ($comment) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Added')));
        } else {
            echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
        }
	
}
	public function comments()
	{
		$this->load->library("Custom");
        $data['dual'] = $this->custom->api_config(65);
        $this->load->model('transactions_model', 'transactions');
        $data['cat'] = $this->transactions->categories();
        $data['accounts'] = $this->transactions->acc_list();
        $head['title'] = "Asset List";
        $head['usernm'] = $this->aauth->get_user()->username;
   
        $this->load->view('fixed/header', $head);
        $this->load->view('asset/comments', $data);
        $this->load->view('fixed/footer');
		
		
	}

	public function AddEdit()
	{
		$a=0;
 for($i = 0; $i<5; $i++) 
{
    $a .= mt_rand(0,9);
}
   $assetId="AST-".$a;
   $categories= $this->asset->get_all_categories();
        $subcategories = $this->asset->get_all_sub_categories();
        $status = $this->asset->get_all_asset_status();
        $department = $this->asset->get_all_department();
		$this->load->model('employee_model', 'employee');
        $employee= $this->employee->list_employee();
       // $code = $this->input->post('assetid');
        //print_r($_SESSION['asset_id']);
        //load library
        $this->load->library('zend');
        //load in folder Zend
        $this->zend->load('Zend/Barcode');
        //generate barcode
        $imageResource = Zend_Barcode::factory('code128', 'image', array('text' => $assetId), array())->draw();
        imagepng($imageResource, FCPATH . 'barcodes/' . $assetId . '.png');
        $barcode = 'barcodes/' . $assetId . '.png';
        $url = base_url($barcode);
		
        $img = '<img alt="image" id="dpic" class="card-img-top img-fluid"
                                 src="' . $url . '" style="width:200px;height:150px;">';

$html='';
		    $html.='<div>
    <div class="row">
        <div class="col-md-12">
            <input type="hidden" data-val="true" data-val-required="The SL field is required." id="Id" name="Id" value="0">
            <input type="hidden" data-val="true" data-val-required="The Created Date field is required." id="CreatedDate" name="CreatedDate" value="01/01/0001 00:00:00">
            <input type="hidden" id="CreatedBy" name="CreatedBy" value="">
            <form id="frmAsset" method="post"  class="form-horizontal" enctype="multipart/form-data" >
                <div class="card card-primary card-outline card-tabs">
                    <div class="card-header p-0 pt-1 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="BasicInfo" data-toggle="pill" href="#divBasicInfo" role="tab" aria-controls="BasicInfo" aria-selected="true">Basic Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="OtherInfo" data-toggle="pill" href="#divOtherInfo" role="tab" aria-controls="OtherInfo" aria-selected="true">Other Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="OtherTab" data-toggle="pill" href="#divOtherTab" role="tab" aria-controls="OtherTab" aria-selected="true">Asset Assign</a>
                            </li>
							
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="tabContent">
                            <div class="tab-pane fade show active" id="divBasicInfo" role="tabpanel" aria-labelledby="divBasicInfo">
                                <div class="row">
                                    <div class="col-6 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="AssetId">Asset Id</label>
                                            <div class="col-sm-5">
                                                <input class="form-control" id="AssetId" type="text" data-val="true" data-val-required="The Asset Id field is required." name="AssetId" id="AssetId" value="'.$assetId.'" readonly>
                                                <span class="text-danger field-validation-valid" data-valmsg-for="AssetId" data-valmsg-replace="true"></span>
                                            </div>
                                            <div class="col-sm-4">
												<input type="hidden" name="barcode"  id="barcode" value="'.$url.'">

                                             <!--   <input type="button" value="Update Barcode" onclick="UpdateBarcode()" class="btn btn-sm btn-info">-->
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="AssetModelNo">Asset Model No <span style="color:red">*</span></label>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="AssetModelNo" type="text" name="AssetModelNo" id="AssetModelNo" value="">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="AssetModelNo" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="Name">Name <span style="color:red">*</span></label>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="Name" type="text" data-val="true" data-val-required="The Name field is required." name="Name" value="">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="Name" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="Description">Description <span style="color:red">*</span></label>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="Description" type="text" name="Description" value="">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="Description" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="UnitPrice">Unit Price <span style="color:red">*</span></label>
                                            <div class="col-sm-9">
                                                <input class="form-control" id="UnitPrice" type="number" data-val="true" data-val-number="The field Unit Price must be a number." name="UnitPrice" value="">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="UnitPrice" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="AssetStatus">Asset Status <span style="color:red">*</span></label>
                                            <div class="col-sm-9">
                                                <select id="AssetStatus" class="form-control" style="width:100%;" data-val="true" data-val-required="The Asset Status field is required." name="AssetStatus">
                                                ';
												foreach($status as $statusVal)
											   {
												  
												   $html.='<option value="'.$statusVal['id'].'">'.$statusVal['name'].'</option>';
											}
											$html.='</select>
                                                <span class="text-danger field-validation-valid" data-valmsg-for="AssetStatus" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="DateOfPurchase">Date Of Purchase</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="date" data-val="true" data-val-required="The Date Of Purchase field is required." id="DateOfPurchase" name="DateOfPurchase" value="2023-05-17">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="DateOfPurchase" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="Barcode">Barcode</label>
                                            <div class="col-sm-9">';
											$html.=$img;
											
											
                                                $html.='<span class="text-danger field-validation-valid" data-valmsg-for="Barcode" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="Category">Category <span style="color:red">*</span></label>
                                            <div class="col-sm-9">
                                                <select id="Category" class="form-control" style="width:100%;" data-val="true" data-val-required="The Category field is required." name="Category">
                                                    <option disabled="" selected="">--- SELECT ---</option>
                                               ';
											   foreach($categories as $catvalue)
											   {
												  
												   $html.='<option value="'.$catvalue['id'].'">'.$catvalue['name'].'</option>';
											}
											  $html.='</select>
                                                <span class="text-danger field-validation-valid" data-valmsg-for="Category" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>';
										$html.='
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="SubCategory">Sub Category</label>
                                            <div class="col-sm-9">
                                                <select id="SubCategory" class="form-control" style="width:100%;" data-val="true" data-val-required="The Sub Category field is required." name="SubCategory">
                                                    <option disabled="" selected="">--- SELECT ---</option>
                                                ';
											foreach($subcategories as $subcat)
											     {
												  
												   $html.='<option value="'.$subcat['id'].'">'.$subcat['name'].'</option>';
											     }

												
												$html.='</select>
                                                <span class="text-danger field-validation-valid" data-valmsg-for="SubCategory" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                       
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="Department">Department <span style="color:red">*</span></label>
                                            <div class="col-sm-9">
                                                <select id="Department" class="form-control" style="width:100%;" data-val="true" data-val-required="The Department field is required." name="Department">
                                                    <option disabled="" selected="">--- SELECT ---</option>';
                                                 foreach($department as $dep)
											     {
												  
												   $html.='<option value="'.$dep['id'].'">'.$dep['val1'].'</option>';
											     }
												
                              $html.='                 
</select>
                                                <span class="text-danger field-validation-valid" data-valmsg-for="Department" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="divOtherInfo" role="tabpanel" aria-labelledby="divOtherInfoTab">
                                <div class="row">
                                    <div class="col-6 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="DateOfManufacture">Date Of Manufacture</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="DateOfManufacture" type="date" data-val="true" data-val-required="The Date Of Manufacture field is required." name="DateOfManufacture" value="2023-05-17">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="DateOfManufacture" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="YearOfValuation">Year Of Valuation</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="YearOfValuation" type="date" data-val="true" data-val-required="The Year Of Valuation field is required." name="YearOfValuation" value="2023-05-17">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="YearOfValuation" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="WarranetyInMonth">Warranety In Month</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="WarranetyInMonth" type="text" name="WarranetyInMonth" value="">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="WarranetyInMonth" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="DepreciationInMonth">Depreciation In Month</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="DepreciationInMonth" type="text" name="DepreciationInMonth" value="">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="DepreciationInMonth" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="Location">Location</label>
                                            <div class="col-sm-8">
                                                <input class="form-control" id="Location" type="text" name="Location" value="">
                                                <span class="text-danger field-validation-valid" data-valmsg-for="Location" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="ImageURL">Image</label>
                                            <div class="col-sm-9">
                                                <span class="control-fileupload">
                                                    <label for="file">Choose a file :</label>
                                                    <input type="file" id="ImageURLDetails" name="ImageURLDetails">
                                                </span>
                                            </div>
                                        </div>
                                       <!--- <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="PurchaseReceipt">Purchase Receipt</label>
                                            <div class="col-sm-9">
                                                <span class="control-fileupload">
                                                    <label for="file">Choose a file :</label>
                                                    <input type="file" id="PurchaseReceiptDetails" name="PurchaseReceiptDetails">
                                                </span>
                                            </div>
                                        </div>-->
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label" for="Note">Note</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" id="Note" type="text" rows="3" name="Note"></textarea>
                                                <span class="text-danger field-validation-valid" data-valmsg-for="Note" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="divOtherTab" role="tabpanel" aria-labelledby="divOtherTab">
                                <div class="row">
                                    <div class="col-6 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-sm-4 col-form-label" for="AssignEmployeeId">Assign Employee</label>
                                            <div class="col-sm-8">
                                                <select id="AssignEmployeeId" class="form-control" style="width:100%;" data-val="true" data-val-required="The Assign Employee field is required." name="AssignEmployeeId">
                                                    <option selected="" value="0">Unassigned</option>';
														foreach($employee as $emp)
											     {
												  
												   $html.='<option value="'.$emp['id'].'">'.$emp['name'].'</option>';
											     }
   
$html.='
</select>
                                                <span class="text-danger field-validation-valid" data-valmsg-for="AssignEmployeeId" data-valmsg-replace="true"></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 col-sm-6">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                        </div>
                        <div class="col-sm-6">
                            <input type="submit" id="btnSave" value="Save" onclick="SaveAsset()" class="btn btn-info">
                            <button type="button" id="btnClose" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>';

echo json_encode($html);

		
		
	}
    public function getassetdetails() {
        $id = $this->input->post('id');
        $employee = $this->asset->get_asset_details($id);
			$comments = $this->asset->get_comments($id);

		if($employee->assign_employee!=0)
		{
        $employee_assign = $this->asset->employee_details($employee->assign_employee);
		}
		
		$url = base_url('userfiles/assetmanagement/') . $employee->image_url;
            //	$row[]= $no;
             
        //print_r($employee_assign);
        $html = "";
        $html.= '<div class="card card-primary card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="EmployeeDetails" data-toggle="pill" href="#divEmployeeDetails" role="tab" aria-controls="EmployeeDetails" aria-selected="true">Asset Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="AssignedAsset" data-toggle="pill" href="#divAssignedAsset" role="tab" aria-controls="AssignedAsset" aria-selected="false">Assignee Info</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="AssetHistory" data-toggle="pill" href="#divAssetHistory" role="tab" aria-controls="AssetHistory" aria-selected="false">Asset History</a>
            </li>
				<li class="nav-item">
                                <a class="nav-link" id="CommentHistoryTab" data-toggle="pill" href="#divCommentHistoryTab" role="tab" aria-controls="CommentHistoryTab" aria-selected="true">Comment History</a>
                            </li>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content" id="tabContent">
            <div class="tab-pane fade active show" id="divEmployeeDetails" role="tabpanel" aria-labelledby="divEmployeeDetails">
<table class="CustomBlueTable">
    <tbody><tr><th>Id</th><td>' . $employee->id . '</td></tr>
    <tr><th>Asset Id</th><td>' . $employee->asset_id . '</td></tr>
    <tr><th>Barcode</th><td><img src="' . $employee->barcode . '"></td></tr>
    <tr><th>Asset Model No</th><td>' . $employee->asset_modelno . '</td></tr>
    <tr><th>Name</th><td>' . $employee->name . '</td></tr>
    <tr><th>Asset Status</th><td>' . $employee->asset_status . '</td></tr>
    <tr><th>Description</th><td>' . $employee->description . '</td></tr>
    <tr><th>Category</th><td>' . $employee->categoryname . '</td></tr>
	<tr><th>Sub Category</th><td>' . $employee->subcategoryname . '</td></tr>
	<tr><th>Unit Price</th><td>' . $employee->unit_price . '</td></tr>
	<tr><th>Supplier</th><td>' . $employee->supplier . '</td></tr>
	<tr><th>Location</th><td>' . $employee->location . '</td></tr>
	<tr><th>Department</th><td>' . $employee->depname . '</td></tr>
	<tr><th>Sub Department</th><td>' . $employee->sub_department . '</td></tr>
	<tr><th>Depreciation In Month</th><td>' . $employee->depreciation_month . '</td></tr>
	<tr><th>Image</th><td><img src="' . $url . '" width="75" height="75"></td></tr>
	<tr><th>Date Of Purchase</th><td>' . $employee->date_of_purchase . '</td></tr>
	<tr><th>Date Of Manufacture	</th><td>' . $employee->date_of_manufacture . '</td></tr>
	<tr><th>Year Of Valuation</th><td>' . $employee->year_of_valuation . '</td></tr>
	<tr><th>Assign User Id</th><td>' . $employee->employee . '</td></tr>
	<tr><th>Note</th><td>' . $employee->note . '</td></tr>
	<tr><th>Created Date</th><td>' . $employee->created_at . '</td></tr>
	<tr><th>Modified Date</th><td>' . $employee->updated_at . '</td></tr>
</tbody></table></div><div class="tab-pane fade" id="divAssignedAsset" role="tabpanel" aria-labelledby="divAssignedAsset">';

            if($employee->assign_employee!=0)
		{

$html.='<table class="CustomBlueTable">
    <tbody><tr><th>Id</th><td>' . $employee_assign->id . '</td></tr>
    <tr><th>First Name</th><td>Mr</td></tr>
    <tr><th>Last Name</th><td>' . $employee_assign->name . '</td></tr>
    <tr><th>Joining Date</th><td>' . $employee_assign->joindate . '</td></tr>
    <tr><th>Address</th><td>' . $employee_assign->address . '</td></tr>
    <tr><th>City</th><td>' . $employee_assign->city . '</td></tr>
    <tr><th>Region</th><td>' . $employee_assign->region . '</td></tr>
    <tr><th>Country</th><td>' . $employee_assign->country . '</td></tr>
	<tr><th>postbox</th><td>' . $employee_assign->postbox . '</td></tr>
	<tr><th>Phone</th><td>' . $employee_assign->phone . '</td></tr>
	<tr><th>Salary</th><td>' . $employee_assign->salary . '</td></tr>
</tbody></table>';

		}
		else{
	$html.='<h1>This resource is not assigned yet.</h1></div>';
		}
$html.='<div class="tab-pane fade" id="divAssetHistory" role="tabpanel" aria-labelledby="divAssetHistory">
                    
<table class="CustomBlueTable">
    <thead>
        <tr>
            <th>Id</th>
            <th>Asset Id</th>
            <th>Assign Employee</th>
            <th>Action</th>
            <th>Note</th>
            <th>Created Date</th>
        </tr>
    </thead>
    <tbody>
                <tr>
                    <td>19</td>
                    <td>12</td>
                    <td>Mr Hasan</td>
                    <td>Unassigned Asset Assigned to Employee.</td>
                    <td></td>
                    <td>Friday, May 12, 2023 3:32 PM</td>
                </tr>
    </tbody>
</table>



            </div>
										<div class="tab-pane" id="divCommentHistoryTab" role="tabpanel" aria-labelledby="divCommentHistoryTab">
                                
<div id="tblCommentHistoryInPrint_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
<div class="row"><div class="col-sm-12">
 <table class="CustomBlueTable dataTable no-footer" id="tblCommentHistoryInPrint" style="width: 100%;" border="1" role="grid" aria-describedby="tblCommentHistoryInPrint_info">
    <thead>
        <tr role="row"><th class="sorting_asc" tabindex="0" aria-controls="tblCommentHistoryInPrint" rowspan="1" colspan="1" aria-sort="ascending" 
		aria-label="Comment: activate to sort column descending" style="width: 276px;">Comment</th><th class="sorting" tabindex="0" aria-controls="tblCommentHistoryInPrint"
		rowspan="1" colspan="1" aria-label="Comment By: activate to sort column ascending" style="width: 361px;">Comment By</th>
		<th class="sorting" tabindex="0" aria-controls="tblCommentHistoryInPrint" rowspan="1" colspan="1" 
		aria-label="Comment Date: activate to sort column ascending" style="width: 411px;">Comment Date</th></tr>
    </thead>
    <tbody>';
		if(!empty($comments))
	{
	foreach($comments as $comment)
	{
	$html.='
	<tr class="odd">
	<td>'.$comment['comments'].'</td>
	<td>'.$comment['comment_by'].'</td>
	<td>'.$comment['created_at'].'</td>
	</tr>';
	}}
	else{
	$html.='
    <tr class="odd"><td valign="top" colspan="3" class="dataTables_empty">No data available in table</td></tr>';
	}
	$html.='</tbody>
</table></div></div>
        </div>
    </div>
</div>';



        echo json_encode($html);
    }
	
	 public function getAssetStatusForEdit() {
        $id = $this->input->post('id');
        $status = $this->asset->get_asset_status($id);
		
		$html='<div>
    <div class="row">
        <div class="col-md-12">
            <form id="frmAssetStatus" novalidate="novalidate">
                <input type="hidden" data-val="true" data-val-required="The SL field is required." id="Id" name="Id" value="'.$status->id.'">
                <div class="form-group">
                    <label class="control-label" for="Name">Name <span style="color:red">*</span></label>
                    <input class="form-control valid" type="text" data-val="true" data-val-required="The Name field is required." id="Name" name="Name" value="'.$status->name.'" aria-describedby="Name-error" aria-invalid="false">
                    <span class="text-danger field-validation-valid" data-valmsg-for="Name" data-valmsg-replace="true"></span>
                </div>
                <div class="form-group">
                    <label class="control-label" for="Description">Description <span style="color:red">*</span></label>
                    <input class="form-control valid" type="text" data-val="true" data-val-required="The Description field is required." id="Description" name="Description" value="'.$status->description.'">
                    <span class="text-danger1 field-validation-valid" data-valmsg-for="Description" data-valmsg-replace="true" style="color:red"></span>
                </div>
                <div class="form-group">
                    <input type="button" id="btnSave" value="Save" onclick="Save()" class="btn btn-info">
                    <button type="button" id="btnClose" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
';
echo json_encode($html);
	 }
	 
	 
	 
	 public function updateStatus()
	 {
        $name = $this->input->post('name');
		        $id = $this->input->post('id');

		$description = $this->input->post('descrption');
        $status=$this->asset->updateStatus($id,$name,$description);
            if ($status) {
            echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('UPDATED')));
              } 
		  else {
             echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
           }
	   
	   
	 }
    public function getemployeedetails() {
        $id = $this->input->post('id');
        $employee = $this->asset->employee_details($id);
        $employee_asign = $this->asset->employee_assign_details($id);
        $html = "";
        $html.= '<div class="card card-primary card-outline card-tabs">
    <div class="card-header p-0 pt-1 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-three-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="EmployeeDetails" data-toggle="pill" href="#divEmployeeDetails" role="tab" aria-controls="EmployeeDetails" aria-selected="true">Employee Details</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="AssignedAsset" data-toggle="pill" href="#divAssignedAsset" role="tab" aria-controls="AssignedAsset" aria-selected="false">Assigned Asset</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="AssetHistory" data-toggle="pill" href="#divAssetHistory" role="tab" aria-controls="AssetHistory" aria-selected="false">Asset History</a>
            </li>
        </ul>
    </div>

    <div class="card-body">
        <div class="tab-content" id="tabContent">
            <div class="tab-pane fade active show" id="divEmployeeDetails" role="tabpanel" aria-labelledby="divEmployeeDetails">
                
<table class="CustomBlueTable">
    <tbody><tr><th>Id</th><td>' . $employee->id . '</td></tr>
    <tr><th>First Name</th><td>Mr</td></tr>
    <tr><th>Last Name</th><td>' . $employee->name . '</td></tr>
    <tr><th>Joining Date</th><td>' . $employee->joindate . '</td></tr>
    <tr><th>Address</th><td>' . $employee->address . '</td></tr>
    <tr><th>City</th><td>' . $employee->city . '</td></tr>
    <tr><th>Region</th><td>' . $employee->region . '</td></tr>
    <tr><th>Country</th><td>' . $employee->country . '</td></tr>
	<tr><th>postbox</th><td>' . $employee->postbox . '</td></tr>
	<tr><th>Phone</th><td>' . $employee->phone . '</td></tr>
	<tr><th>Salary</th><td>' . $employee->salary . '</td></tr>
</tbody></table>


            </div>

            <div class="tab-pane fade" id="divAssignedAsset" role="tabpanel" aria-labelledby="divAssignedAsset">
                    
<table class="CustomBlueTable">
    <thead>
        <tr>
            <th>Id</th>
            <th>Asset Id</th>
            <th>Name</th>
            <th>Asset Model No</th>
            <th>Date Of Purchase</th>
            <th>Modified Date</th>
        </tr>
    </thead>
    <tbody>';
        foreach ($employee_asign as $assign) {
            $html.= '
<tr>
    <td>' . $assign['id'] . '</td>
    <td>' . $assign['asset_id'] . '</td>
    <td>' . $assign['name'] . '</td>
    <td>' . $assign['asset_modelno'] . '</td>
    <td>' . $assign['date_of_purchase'] . '</td>
    <td>' . $assign['updated_at'] . '</td>
</tr> 	';
        }
        $html.= '    </tbody>
</table>


            </div>
            <div class="tab-pane fade" id="divAssetHistory" role="tabpanel" aria-labelledby="divAssetHistory">
                    
<table class="CustomBlueTable">
    <thead>
        <tr>
            <th>Id</th>
            <th>Asset Id</th>
            <th>Assign Employee</th>
            <th>Action</th>
            <th>Note</th>
            <th>Created Date</th>
        </tr>
    </thead>
    <tbody>
                <tr>
                    <td>19</td>
                    <td>12</td>
                    <td>Mr Hasan</td>
                    <td>Unassigned Asset Assigned to Employee.</td>
                    <td></td>
                    <td>Friday, May 12, 2023 3:32 PM</td>
                </tr>
    </tbody>
</table>



            </div>
        </div>
    </div>
</div>';
        echo json_encode($html);
    }
    public function asset_history() {
        $this->load->library("Common");
        $data['langs'] = $this->common->languages();
        $head['usernm'] = $this->aauth->get_user()->username;
        $data = [];
        //die;
        // $data['custom_fields'] = $this->custom->add_fields(1);
        $head['title'] = 'Asset History List';
        $this->load->view('fixed/header', $head);
        $this->load->view('asset/assethistory', $data);
        $this->load->view('fixed/footer');
    }
    public function getAssetHistory() {
        $ttype = $this->input->get('type');
        $this->load->model('asset_history');
        $list = $this->asset_history->get_datatables($ttype);
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        $temp = '';
        $type = '';
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        $temp = '';
        $type = '';
        foreach ($list as $listval) {
            $no++;
            $row = array();
            $pid = $listval->id;
            //$row[] = dateformat($prd->created_at);
           // $row[] = $no;
            $row[] = '<a href="#" onclick="AssetInfo('.$listval->asset_id.');" class=""></span>' .$listval->asset_id .'</a>';
            $row[] = $listval->assign_asset_employee;
            $row[] = $listval->action;
            $row[] = $listval->created_at;
            // $row[] = dateformat($prd->receipt_date);
            // $row[] = amountExchange($prd->receipt_amount, 0, $this->aauth->get_user()->loc);
            // $row[] = amountExchange($prd->tax_amount, 0, $this->aauth->get_user()->loc);
            //   $row[] = '<a href="' . base_url("payroll/viewslip?id=$pid&typeid=$typeid") . '" class="btn btn-success btn-sm" title="View"><i class="fa fa-eye"></i></a>&nbsp;
            //<a href="' . base_url("payroll/downloadpayslip?id=$pid&typeid=$typeid") . '" class="btn btn-info btn-sm"  title="Download"><span class="fa fa-download"></span></a>';
            //$row[] =$temp;
            /*
              $row[] = '<a href="' . base_url() . 'expenses/view?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-eye"></span>  ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'expenses/print_t?id=' . $pid . '" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>&nbsp; &nbsp;<a  href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm delete-object"><span class="fa fa-trash"></span></a>';
            */
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->asset->count_all(), "recordsFiltered" => $this->asset->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }
    public function printBarcode() {
        $this->load->library("Common");
        $data['langs'] = $this->common->languages();
        $head['usernm'] = $this->aauth->get_user()->username;
        $data = [];
        //die;
        // $data['custom_fields'] = $this->custom->add_fields(1);
        $head['title'] = 'Barcode List';
        $this->load->view('fixed/header', $head);
        $this->load->view('asset/printBarcode', $data);
        $this->load->view('fixed/footer');
    }
    public function barcodeList() {
        $ttype = $this->input->get('type');
        $list = $this->asset->get_datatables($ttype);
		
        $data = array();
        // $no = $_POST['start'];
        $no = $this->input->post('start');
        $temp = '';
        $type = '';
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $pid = $prd->id;
            //$row[] = dateformat($prd->created_at);
            $row[] = $no;
            $row[] = $prd->name;
            //$row[] = $prd->barcode;
			if(!empty($prd->barcode))
			{
			 $row[] = '<div id="printTable"><img src="' . $prd->barcode . '"></div>';
			}
			else{
            $row[] = '';
			}
            $row[] = '<a href="" onclick="printData();" class="btn btn-info btn-sm"  title="Print"><span class="fa fa-print"></span></a>';
            $data[] = $row;
        }
        $output = array("draw" => $_POST['draw'], "recordsTotal" => $this->asset->count_all(), "recordsFiltered" => $this->asset->count_filtered(), "data" => $data,);
        //output to json format
        echo json_encode($output);
    }
}
