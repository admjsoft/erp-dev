<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Asset_model extends CI_Model {
    var $column_order = array('id', 'image', 'asset_id', 'asset_modelno', 'asset_name', 'assign_employee', 'unit_price');
    var $column_search = array('id', 'image', 'asset_id', 'asset_modelno', 'asset_name', 'assign_employee', 'unit_price');
    var $order = array('asset_management.id' => 'desc');
    var $opt = '';
    private function _get_datatables_query() {
        $this->db->select('asset_management.id,gtg_employees.id as empid,asset_management.image_url,asset_management.name,asset_management.asset_id,asset_management.asset_modelno,gtg_employees.name as employee,asset_management.unit_price,asset_management.date_of_purchase');
        $this->db->from('asset_management');
        $this->db->join('gtg_employees', 'gtg_employees.id = asset_management.assign_employee','left');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        }
        $i = 0;
        foreach ($this->column_search as $item) // loop column
        {
            if ($this->input->post('search') ['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $this->input->post('search') ['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search') ['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                $this->db->group_end(); //close bracket
                
            }
            $i++;
        }
        $order = $this->order;
        $this->db->order_by(key($order), $order[key($order) ]);
    }
    function get_datatables($opt = 'all') {
        $this->opt = $opt;
        $this->_get_datatables_query();
        if ($_POST['length'] != - 1) $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
		//print_r($this->db->last_query());    

        return $query->result();
    }
    // expenses filtered
    function count_filtered() {
        $this->db->from('gtg_payslip');
        $query = $this->db->get();
        return $query->num_rows();
    }
    // expense count function
    public function count_all() {
        $this->db->from('gtg_payslip');
        return $this->db->count_all_results();
    }
    public function get_all_asset_status() {
        $this->db->select('*');
        $this->db->from('asset_status');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
	public function get_asset_status($id) {
        $this->db->select('*');
        $this->db->from('asset_status');
        $this->db->where('id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();
    }
    public function get_all_department() {
        $this->db->select('*');
        $this->db->from('gtg_hrm');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    public function employee_details($id) {
        $this->db->select('*');
        $this->db->from('gtg_employees');
        $this->db->where('gtg_employees.id', $id);
        // $this->db->join('gtg_users', 'gtg_employees.id = gtg_users.id', 'left');
        $query = $this->db->get();
        return $query->row();
    }
    public function get_all_categories() {
        $this->db->select('*');
        $this->db->from('asset_categories');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    public function get_all_sub_categories() {
        $this->db->select('*');
        $this->db->from('asset_sub_categories');
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    public function addasset($AssetId, $barcode, $AssetModelNo, $Name, $Description, $UnitPrice, $AssetStatus, $DateOfPurchase, $Category, $SubCategory, $Supplier, $Department, $SubDepartment, $DateOfManufacture, $YearOfValuation, $WarranetyInMonth, $DepreciationInMonth, $Location, $image_url, $note, $employee) {
        $datetime = date("Y-m-d") . " " . date("h:i:s a");
        $data = array('asset_id' => $AssetId, 'barcode' => $barcode, 'asset_modelno' => $AssetModelNo, 'name' => $Name, 'description' => $Description, 'unit_price' => $UnitPrice, 'asset_status' => $AssetStatus, 'date_of_purchase' => $DateOfPurchase, 'category' => $Category, 'subcategory' => $Category, 'supplier' => $Supplier, 'department' => $Department, 'sub_department' => $SubDepartment, 'date_of_manufacture' => $DateOfManufacture, 'year_of_valuation' => $YearOfValuation, 'warrenty_month' => $WarranetyInMonth, 'depreciation_month' => $DepreciationInMonth, 'location' => $Location, 'image_url' => $image_url, 'note' => $note, 'assign_employee' => $employee, 'created_at' => $datetime);
        $this->db->insert('asset_management', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }
    public function updateasset($id, $AssetId,$AssetModelNo, $Name, $Description, $UnitPrice, $AssetStatus, $DateOfPurchase, $Category, $SubCategory, $Supplier, $Department, $SubDepartment, $DateOfManufacture, $YearOfValuation, $WarranetyInMonth, $Location,$filename,$DepreciationInMonth, $note, $employee) {
		$datetime = date("Y-m-d") . " " . date("h:i:s a");
        $data = array('asset_id' => $AssetId,'asset_modelno' => $AssetModelNo, 
		'name' => $Name, 'description' => $Description, 'unit_price' => $UnitPrice,
		'asset_status' => $AssetStatus, 'date_of_purchase' => $DateOfPurchase, 
		'category' => $Category, 'subcategory' => $Category, 'supplier' => $Supplier,
		'department' => $Department,'sub_department' => $SubDepartment,'date_of_manufacture' => $DateOfManufacture,'year_of_valuation' => $YearOfValuation,'depreciation_month' => $WarranetyInMonth, 'location' => $Location, 'image_url' => $filename,'depreciation_month'=>$DepreciationInMonth,'note' => $note, 'assign_employee' => $employee, 'updated_at' => $datetime);
        $this->db->where('id',$id);
        return $this->db->update('asset_management',$data);
    }
	public function addComment($id,$CommentMessage)
	{
				$datetime = date("Y-m-d") . " " . date("h:i:s a");
                 $created_by=$_SESSION['username'];
			    $data = array('asset_id' => $id,'comments' => $CommentMessage, 'comment_by' => $created_by, 'created_at' => $datetime);
		        $this->db->insert('asset_comments', $data);
				$this->db->last_query();
	}	
	public function get_comments($id)
	{
        $this->db->select('*');
        $this->db->from('asset_comments');
        $this->db->where('asset_id', $id);
		        $query = $this->db->get();

		 return $query->result_array();

	}
    public function get_asset_history($assetid) {
        $this->db->select('emp_id,assign_asset_employee');
        $this->db->from('asset_history');
        $this->db->where('asset_id', $assetid);
        $this->db->order_by('id', 'desc');
        $this->db->limit(1, 0);
        $query = $this->db->get();
        return $query->row();
    }
    public function get_all_sub_assets($id) {
        $this->db->select('*');
        $this->db->from('asset_management');
        $this->db->where('id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    public function delete($id) {
        $this->db->delete('asset_management', array('id' => $id));
        return array('status' => 'Success', 'message' => $this->lang->line('DELETED'));
    }
	    public function deleteStatus($id) {
        $this->db->delete('asset_status', array('id' => $id));
        return array('status' => 'Success', 'message' => $this->lang->line('DELETED'));
    }
	  public function deleteComment($id) {
        $this->db->delete('asset_comments', array('id' => $id));
        return array('status' => 'Success', 'message' => $this->lang->line('DELETED'));
    }
	
	
    public function get_category_by_Id($id) {
        $this->db->select('*');
        $this->db->from('asset_categories');
        $this->db->where('id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();
    }
    public function get_sub_category_by_Id($id) {
        $this->db->select('*');
        $this->db->from('asset_sub_categories');
        $this->db->where('id', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->row();
    }
    public function updatecategory($catid, $name, $description) {
        $data = array('name' => $name, 'description' => $description);
        $this->db->where('id', $catid);
        return $this->db->update('asset_categories', $data);
    }
	public function updateStatus($id,$name,$description)
	{
		 $data = array('name' => $name, 'description' => $description);
        $this->db->where('id', $id);
        return $this->db->update('asset_status', $data);
		
	}
    public function updateSubCategory($category, $subcatid, $name, $description) {
        $data = array('asset_category' => $category, 'name' => $name, 'description' => $description);
        $this->db->where('id', $subcatid);
        return $this->db->update('asset_sub_categories', $data);
    }
    public function deleteCategory($id) {
        $this->db->delete('asset_categories', array('id' => $id));
        return array('status' => 'Success', 'message' => $this->lang->line('DELETED'));
    }
    public function deleteSubCategory($id) {
        $this->db->delete('asset_sub_categories', array('id' => $id));
        return array('status' => 'Success', 'message' => $this->lang->line('DELETED'));
    }
    public function employee_assign_details($id) {
        $this->db->select('id,name,date_of_purchase,asset_modelno,asset_id,updated_at');
        $this->db->from('asset_management');
        $this->db->where('assign_employee', $id);
        $query = $this->db->get();
        //echo $this->db->last_query();
        return $query->result_array();
    }
    public function get_asset_details($id) {
        $this->db->select('asset_status.name as status,asset_categories.name as categoryname,asset_sub_categories.name as subcategoryname,gtg_hrm.val1 as depname,gtg_employees.name as employee,asset_management.*');
        $this->db->from('asset_management');
	    $this->db->join('gtg_employees', 'gtg_employees.id = asset_management.assign_employee', 'left');
	    $this->db->join('asset_status', 'asset_status.id = asset_management.asset_status');
	    $this->db->join('asset_categories', 'asset_categories.id = asset_management.category');
	    $this->db->join('asset_sub_categories', 'asset_sub_categories.id = asset_management.subcategory','left');
	    $this->db->join('gtg_hrm', 'gtg_hrm.id = asset_management.department');
        $this->db->where('asset_management.id', $id);
        $query = $this->db->get();
        return $query->row();
    }
}
