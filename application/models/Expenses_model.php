<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Expenses_model extends CI_Model
{
    var $table = 'gtg_expenses';
    var $column_order = array('id', 'name', 'title', 'category', 'receipt_no', 'receipt_date', 'receipt_amount','tax_amount','reason','remarks','doc','loc');
    var $column_search = array('id', 'name', 'title');
    var $order = array('id' => 'desc');
    var $opt = '';

    private function _get_datatables_query($status='',$employee = '',$start_date = '',$end_date = '')
    {

        $this->db->select('gtg_expenses.*,gtg_expenses.id as id');
        $this->db->from($this->table);
if($this->aauth->get_user()->roleid==4 || $this->aauth->get_user()->roleid==5)
{
    }
        else{
        
               //     $this->db->where('gtg_expenses.eid',$this->aauth->get_user()->id);
    
            
        }
        
        switch ($this->opt) {
            case 'income':
                $this->db->where('type', 'Income');
                break;
            case 'expense':
                $this->db->where('type', 'Expense');
                break;
        }

        if (!empty($status)) {
            $this->db->where('category', $status);
        }

        
        if (!empty($employee)) {
            $this->db->where('eid', $employee);
        }

        if (!empty($start_date) && !empty($end_date) ) {
            $this->db->where('DATE(created_at) >=', datefordatabase($start_date));
            $this->db->where('DATE(created_at) <=', datefordatabase($end_date));

        }else if (!empty($start_date) && empty($end_date) ) {
            $this->db->where('DATE(created_at) >=', datefordatabase($start_date));

        }else if (empty($start_date) && !empty($end_date) ) {
            $this->db->where('DATE(created_at) <=', datefordatabase($end_date));

        }

      if($this->aauth->premission(21) && !$this->aauth->premission(22)){
          if($this->aauth->get_user()->roleid==4 || $this->aauth->get_user()->roleid==5)
{
}
else{
           $this->db->where('eid', $this->session->userdata('id'));
     } }
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
                    $this->db->group_end(); //close bracket
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

    function get_datatables($opt = 'all', $status = '',$employee = '',$start_date = '',$end_date = '')
    {
        $this->opt = $opt;
        $this->_get_datatables_query($status,$employee,$start_date,$end_date);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();

        // echo $this->db->last_query();
        // exit;
        return $query->result();
    }
    // get expense by id
    function get_expense($id)
    {
        $this->db->from('gtg_expenses');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }
    //get employee by id
    function get_expense_user_by_id($id){
        $this->db->from('gtg_users');
        $this->db->where('id',$id);
        $query = $this->db->get();
        return $query->result();
    }
    // expenses filtered
    function count_filtered($status='',$employee='',$start_date='',$end_date='')
    {
        $this->db->from('gtg_expenses');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        }
        if (!empty($status)) {
            $this->db->where('category', $status);
        }

        
        if (!empty($employee)) {
            $this->db->where('eid', $employee);
        }

        if (!empty($start_date) && !empty($end_date) ) {
            $this->db->where('DATE(created_at) >=', datefordatabase($start_date));
            $this->db->where('DATE(created_at) <=', datefordatabase($end_date));

        }else if (!empty($start_date) && empty($end_date) ) {
            $this->db->where('DATE(created_at) >=', datefordatabase($start_date));

        }else if (empty($start_date) && !empty($end_date) ) {
            $this->db->where('DATE(created_at) <=', datefordatabase($end_date));

        }

        $query = $this->db->get();
        return $query->num_rows();
    }
    // expense count function
    public function count_all($status='',$employee='',$start_date='',$end_date='')
    {
        $this->db->from($this->table);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        }

        if (!empty($status)) {
            $this->db->where('category', $status);
        }

        
        if (!empty($employee)) {
            $this->db->where('eid', $employee);
        }

        if (!empty($start_date) && !empty($end_date) ) {
            $this->db->where('DATE(created_at) >=', datefordatabase($start_date));
            $this->db->where('DATE(created_at) <=', datefordatabase($end_date));

        }else if (!empty($start_date) && empty($end_date) ) {
            $this->db->where('DATE(created_at) >=', datefordatabase($start_date));

        }else if (empty($start_date) && !empty($end_date) ) {
            $this->db->where('DATE(created_at) <=', datefordatabase($end_date));

        }

        return $this->db->count_all_results();
    }
// category list
    public function categories()
    {
        $this->db->select('*');
        $this->db->from('gtg_expenses_cat');
        $query = $this->db->get();
        return $query->result_array();
    }


// create category
    public function addcat($name)
    {
        $data = array(
            'name' => $name
        );

        return $this->db->insert('gtg_expenses_cat', $data);
    }

    public function addexpense($emp_id,$emp_name,$title,$category,$receipt_no,$receipt_date,$receipt_amount,$tax_amount,$reason,$remarks,$filename, $loc = 0)
    {
        $datetime=date("Y-m-d") ." ".date("h:i:s");
            $data = array(
                'eid' => $emp_id,
                'name' => $emp_name,
                'title' => $title,
                'category' => $category,
                'receipt_no' => $receipt_no,
                'receipt_date' => $receipt_date,
                'receipt_amount' => $receipt_amount,
                'tax_amount' => $tax_amount,
                'reason' => $reason,
                'remarks' => $remarks,
                'doc' => $filename,
                'loc' => $loc,
                'created_at' => $datetime
            );
			
            return $this->db->insert('gtg_expenses', $data);

    }

    public function addtransfer($pay_acc, $pay_acc2, $amount, $eid, $loc = 0)
    {

        if ($pay_acc > 0) {

            $this->db->select('holder');
            $this->db->from('gtg_accounts');
            $this->db->where('id', $pay_acc);
            if ($this->aauth->get_user()->loc) {
                $this->db->group_start();
                $this->db->where('loc', $this->aauth->get_user()->loc);
                if (BDATA) $this->db->or_where('loc', 0);
                $this->db->group_end();
            } elseif (!BDATA) {
                $this->db->where('loc', 0);
            }
            $query = $this->db->get();
            $account = $query->row_array();
            $this->db->select('holder');
            $this->db->from('gtg_accounts');
            $this->db->where('id', $pay_acc2);
            if ($this->aauth->get_user()->loc) {
                $this->db->group_start();
                $this->db->where('loc', $this->aauth->get_user()->loc);
                if (BDATA) $this->db->or_where('loc', 0);
                $this->db->group_end();
            } elseif (!BDATA) {
                $this->db->where('loc', 0);
            }
            $query = $this->db->get();
            $account2 = $query->row_array();

            if ($account2) {
                $data = array(
                    'payerid' => '',
                    'payer' => '',
                    'acid' => $pay_acc2,
                    'account' => $account2['holder'],
                    'date' => date('Y-m-d'),
                    'debit' => 0,
                    'credit' => $amount,
                    'type' => 'Transfer',
                    'cat' => '',
                    'method' => '',
                    'eid' => $eid,
                    'note' => 'Transferred by ' . $account['holder'],
                    'ext' => 9,
                    'loc' => $loc
                );
                $this->db->insert('gtg_expenses', $data);


                $this->db->set('lastbal', "lastbal+$amount", FALSE);
                $this->db->where('id', $pay_acc2);
                $this->db->update('gtg_accounts');
                $datec = date('Y-m-d');

                $data = array(
                    'payerid' => '',
                    'payer' => '',
                    'acid' => $pay_acc,
                    'account' => $account['holder'],
                    'date' => $datec,
                    'debit' => $amount,
                    'credit' => 0,
                    'type' => 'Transfer',
                    'cat' => '',
                    'method' => '',
                    'eid' => $eid,
                    'note' => 'Transferred to ' . $account2['holder'],
                    'ext' => 9,
                    'loc' => $loc
                );

                $this->db->set('lastbal', "lastbal-$amount", FALSE);
                $this->db->where('id', $pay_acc);
                $this->db->update('gtg_accounts');

                return $this->db->insert('gtg_expenses', $data);
            }
        }
    }

    // expenses deleted query
    public function delt($id)
    {
        $this->db->delete('gtg_expenses', array('id' => $id));
        return array('status' => 'Success', 'message' => $this->lang->line('DELETED'));
    }
    // Expenses view query
    public function view($id)
    {

        $this->db->select('*');
        $this->db->from('gtg_expenses');
        $this->db->where('id', $id);

        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('loc', $this->aauth->get_user()->loc);
            if (BDATA) $this->db->or_where('loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $query = $this->db->get();
        return $query->row_array();
    }
    // expense cview query
    public function cview($id)
    {
        $this->db->select('gtg_employees.*,gtg_users.email');
        $this->db->from('gtg_employees');
        $this->db->join('gtg_users', 'gtg_employees.id = gtg_users.id', 'left');
        $this->db->where('gtg_employees.id', $id);
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('loc', $this->aauth->get_user()->loc);
            if (BDATA) $this->db->or_where('loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $query = $this->db->get();
        return $query->row_array();
    }
    // expense category details query
    public function cat_details($id)
    {

        $this->db->select('*');
        $this->db->from('gtg_expenses_cat');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // expense category name query
    public function cat_details_name($id)
    {

        $this->db->select('*');
        $this->db->from('gtg_expenses_cat');
        $this->db->where('name', $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    // expenses category update query
    public function cat_update($id, $cat_name)
    {
        $data = array(
            'name' => $cat_name

        );
        $this->db->set($data);
        $this->db->where('id', $id);

        if ($this->db->update('gtg_expenses_cat')) {
            return true;
        } else {
            return false;
        }
    }


    // expense update status query
    public function expenses_update($id, $remarks, $status)
    {
        /*
            $this->db->select('remarks');
            $this->db->from('gtg_expenses');
            $this->db->where('id', $id);
            $query = $this->db->get();
            $res= $query->row_array();
            $tempremarks='';
            if(!empty($res['remarks'])){
            $tempremarks=$res['remarks'].' <br />';}
        */
        $data = array(
            'remarks' => $remarks,
            'status' => $status
        );

        $this->db->set($data);
        $this->db->where('id', $id);

        if ($this->db->update('gtg_expenses')) {
            return true;
        } else {
            return false;
        }
    }
    public function acc_list()
    {
        $this->db->select('id,acn,holder');
        $this->db->from('gtg_accounts');
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('loc', $this->aauth->get_user()->loc);
            if (BDATA) $this->db->or_where('loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
}
