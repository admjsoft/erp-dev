<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Deliveryorder extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('purchase_model', 'purchase');
        $this->load->model('deliveryorder_model', 'deliveryorder');
        $this->load->model('invoices_model', 'invocies');
        $this->load->model('plugins_model', 'plugins');        
        $this->load->model('transactions_model', 'transactions');
        $this->load->model('accounts_model');
        $this->load->library('pdf');
        $this->load->library("Aauth");        
        $this->load->library("Custom");
       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }
        if (($this->aauth->get_user()->roleid == 5) || ($this->aauth->get_user()->roleid == 4)) {
            $this->limited = '';
        } else {
            $this->limited = $this->aauth->get_user()->id;
        }
        
        $this->li_a = 'supplier';
        $c_module = 'supplier';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);
        //exit('Under Dev Mode');


    }

    public function index()
    {
    }
    

    //create invoice
    public function create_purchase_delivery_order()
    {

        $tid = intval($this->input->get('id'));
        $data['id'] = $tid;
        $head['title'] = $this->lang->line('Delivery Order for Purchase Order').$tid;
        $data['invoice'] = $this->purchase->purchase_details($tid);
        $data['products'] = $this->purchase->purchase_do_products($tid);
        // echo $this->db->last_query();
        // exit;
        $data['lastdo'] = $this->deliveryorder->lastdo();
          // echo $this->db->last_query();
        // exit;
        // echo $data['lastdo'];
        // exit;
        // $data['activity'] = $this->purchase->purchase_transactions($tid);
        // $data['attach'] = $this->purchase->attach($tid);
        // $data['employee'] = $this->purchase->employee($data['invoice']['eid']);
        
        // echo "<pre>"; print_r($data['products']); echo "</pre>";
        // exit;
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        if ($data['invoice']['tid']) $this->load->view('delivery_order/converting_to_do', $data);
        $this->load->view('fixed/footer');

    }

    public function create_invoice_delivery_order()
    {

        $tid = intval($this->input->get('id'));
        $data['id'] = $tid;
        $head['title'] = $this->lang->line('Delivery Order for Invoice').$tid;
        $data['invoice'] = $this->invocies->invoice_details($tid, $this->limited);
        $data['products'] = $this->invocies->invoice_do_products($tid);
        // echo $this->db->last_query();
        // exit;
        $data['lastdo'] = $this->deliveryorder->lastdo();
        // $data['activity'] = $this->purchase->purchase_transactions($tid);
        // $data['attach'] = $this->purchase->attach($tid);
        // $data['employee'] = $this->purchase->employee($data['invoice']['eid']);
        
        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        if ($data['invoice']['tid']) $this->load->view('delivery_order/converting_invoice_to_do', $data);
        $this->load->view('fixed/footer');

    }

    public function update_delivery_order()
    {
        
        
        $json = $this->input->post('inputData');
        $po_id = $this->input->post('po_id');
        $supplier_do_no = $this->input->post('do_no');
       
        $last_do_details = $this->db->where('po_id',$po_id)->order_by('id',"desc")->get('gtg_do_relations')->result_array();
        $purchase_order_details = $this->db->where('id',$po_id)->get('gtg_purchase')->result_array();
        if(!empty($last_do_details))
        {
            $lastdo = $last_do_details[0]['parent_do_id'];
            $last_child_do = $last_do_details[0]['do_id'] + 1;

        }else{
            $lastdo = $this->deliveryorder->lastdo();
            $last_child_do = $lastdo."111";

        }
        $do_items = json_decode($json, true);    
                     

        if(!empty($do_items))
        {
            foreach($do_items as $do_item){

                $data['parent_delivery_order_id'] = $lastdo;
                $data['delivery_order_id'] = $last_child_do;
                $data['supplier_delivery_order_id'] = $supplier_do_no;
                $data['po_id'] = $do_item['po_id'];
                $data['p_id'] = $do_item['p_id'];                
                $data['do_expire_date'] = $do_item['date']; 

                // $data['do_id'] = $lastdo + 1;
                $data['qty'] = $do_item['value'];
                $data['type'] = 'cr';
                $n_data[] = $data;

                $s_p_data['p_id'] = $do_item['p_id'];
                $s_p_data['qty'] = $do_item['value'];

                $stock_p_ids[] = $s_p_data;

            }
        }

        // echo "<pre>"; print_r($stock_p_ids); echo "</pre>";
        // echo exit;

        if(!empty($n_data)){

            
            $rel_data['type'] = 'po';
            $rel_data['parent_do_id'] = $lastdo;
            $rel_data['do_id'] = $last_child_do;
            $rel_data['po_id'] = $po_id;
            $rel_data['supplier_do_id'] = $supplier_do_no;
            $this->db->insert('gtg_do_relations',$rel_data);
            // Decode the JSON data
           
            if($this->db->insert_batch('gtg_do_delivered_items', $n_data))
            {

                if($purchase_order_details[0]['stock_update_status'] == 0)
                {
                    if(!empty($stock_p_ids))
                    {

                        foreach ($stock_p_ids as $stock_p_id) {
                            $prid = $stock_p_id['p_id'];
                            $dqty = $stock_p_id['qty'];
                            if ($prid > 0) {
        
                                $this->db->set('qty', "qty+$dqty", FALSE);
                                $this->db->where('pid', $prid);
                                $this->db->update('gtg_products');
                            }
                        }

                    }
                }
                

                $resp_data['status'] = '200';
                $resp_data['message'] = 'Delivery Order Confirmed Successfully';
            } else {

                $resp_data['status'] = '500';
                $resp_data['message'] = 'Delivery Order Confirm Failed';
            }

            
            
        }else{
            $resp_data['status'] = '500';
            $resp_data['message'] = 'All Items were Delivered!, DO Confirmed';
        }

        echo json_encode($resp_data);
    }

    public function update_invoice_delivery_order()
    {
        $json = $this->input->post('inputData');
        $invoice_id = $this->input->post('invoice_id');


        $last_do_details = $this->db->where('invoice_id',$invoice_id)->order_by('id',"desc")->get('gtg_do_relations')->result_array();
        if(!empty($last_do_details))
        {
            $lastdo = $last_do_details[0]['parent_do_id'];
            $last_child_do = $last_do_details[0]['do_id'] + 1;

        }else{
            $lastdo = $this->deliveryorder->lastdo();
            $last_child_do = $lastdo."111";

        }
        
         
        $do_items = json_decode($json, true);
            
        if(!empty($do_items))
        {
            foreach($do_items as $do_item){

                $data['parent_delivery_order_id'] = $lastdo;
                $data['delivery_order_id'] = $last_child_do;
                $data['invoice_id'] = $do_item['invoice_id'];
                $data['p_id'] = $do_item['p_id'];
                // $data['do_id'] = $lastdo + 1;
                $data['qty'] = $do_item['value'];
                $data['type'] = 'dr';
                $n_data[] = $data;

                $s_p_data['p_id'] = $do_item['p_id'];
                $s_p_data['qty'] = $do_item['value'];

                $stock_p_ids[] = $s_p_data;

                
                $this->db->select('gtg_do_delivered_items.id, gtg_do_delivered_items.po_id, gtg_do_delivered_items.p_id, gtg_do_delivered_items.qty, gtg_do_delivered_items.return_qty, gtg_do_delivered_items.delivery_order_id, gtg_do_delivered_items.parent_delivery_order_id, gtg_do_delivered_items.supplier_delivery_order_id, gtg_do_delivered_items.do_expire_date, SUM(gtg_do_delivered_items.qty - gtg_do_delivered_items.return_qty) AS total_available_quantity');
                $this->db->from('gtg_do_delivered_items');
                //$this->db->join('gtg_do_product_batches_history', 'gtg_do_delivered_items.delivery_order_id = gtg_do_product_batches_history.delivery_order_id', 'left');
                //$this->db->where('gtg_do_delivered_items.po_id !=', 0);
                $this->db->where('gtg_do_delivered_items.type', 'cr');
                $this->db->where('gtg_do_delivered_items.p_id', $do_item['p_id']);
                $this->db->group_by('gtg_do_delivered_items.p_id');
                $this->db->group_by('gtg_do_delivered_items.delivery_order_id');
                $this->db->order_by('gtg_do_delivered_items.do_expire_date', 'ASC');

                //$query = $this->db->get();
                
                $batch_query = $this->db->get();

                $results =  $batch_query->result_array();
                // echo $this->db->last_query();
                // exit;
                // echo "<pre>"; print_r($results); echo "</pre>";
                // exit;
                
                $required_product_qty = $do_item['value'];
                $filteredData = array();
                $used_qty_by_delivery_order = array();
                $total_used_qty = 0;
                
                foreach ($results as $row) {
                
                    $this->db->select_sum('used_qty');
                    $this->db->where('delivery_order_id', $row['delivery_order_id']);
                    $used_qty_query = $this->db->get('gtg_do_product_batches_history');
                    $used_qty_result = $used_qty_query->row();
                    $used_qty = $used_qty_result->used_qty;
                
                    // Calculate available_quantity
                    $available_quantity = $row['total_available_quantity'] - $used_qty;
                
                    // Add condition to fetch rows where available_quantity > 0
                    if ($available_quantity > 0) {

                        
                    $filteredData[] = array(
                        'do_delivered_item_id' => $row['id'],
                        'po_id' => $row['po_id'],
                        'invoice_id' => $do_item['invoice_id'],
                        'p_id' => $row['p_id'],
                        'supplier_delivery_order_id' => $row['supplier_delivery_order_id'],
                        'delivery_order_id' => $row['delivery_order_id'],
                        'parent_delivery_order_id' => $row['parent_delivery_order_id'],
                        'available_quantity' => $available_quantity,
                        'do_expire_date' => $row['do_expire_date'],
                        'used_qty' => 0,
                    );
                
                    // Check if required quantity is not fulfilled
                    if ($total_used_qty < $required_product_qty) {
                        $deduct_qty = min($available_quantity, $required_product_qty - $total_used_qty);
                        $used_qty_by_delivery_order[$row['delivery_order_id']] = $deduct_qty;
                        $filteredData[count($filteredData) - 1]['used_qty'] = $deduct_qty;
                        $total_used_qty += $deduct_qty;
                    }
                
                    // Check if required quantity is fulfilled
                    if ($total_used_qty >= $required_product_qty) {
                        break; // Exit the loop if the required quantity is fulfilled
                    }
                }
            }
                // Display an error if the required quantity is not available
                if ($total_used_qty < $required_product_qty) {
                    
                    $resp_data['status'] = '500';
                    $resp_data['message'] = 'Delivery Order Generate Failed';
                    
                    echo json_encode($resp_data);

                } else {

                   // $final_filtered_array[] = $filteredData;
                  //  echo "<pre>"; print_r($filteredData); echo "</pre>";
                }
                
          
          
          
            }
        }

        // echo "<pre>"; print_r($filteredData); echo "</pre>";
        // exit;

        if(!empty($n_data)){

                
            $rel_data['type'] = 'invoice';
            $rel_data['parent_do_id'] = $lastdo;
            $rel_data['do_id'] = $last_child_do;
            $rel_data['invoice_id'] = $invoice_id;
            $this->db->insert('gtg_do_relations',$rel_data);
            // Decode the JSON data
            
            if($this->db->insert_batch('gtg_do_delivered_items', $n_data))
            {
                if($this->db->insert_batch('gtg_do_product_batches_history', $filteredData))
                {

                    if(!empty($stock_p_ids))
                    {
                        
                        foreach ($stock_p_ids as $stock_p_id) {
                            $prid = $stock_p_id['p_id'];
                            $dqty = $stock_p_id['qty'];
                            if ($prid > 0) {
        
                                $this->db->set('qty', "qty-$dqty", FALSE);
                                $this->db->where('pid', $prid);
                                $this->db->update('gtg_products');
                            }
                        }

                    }
                }
                

                $resp_data['status'] = '200';
                $resp_data['message'] = 'Delivery Order Generated Successfully';
            } else {

                $resp_data['status'] = '500';
                $resp_data['message'] = 'Delivery Order Generate Failed';
            }

            
            
        }else{
            $resp_data['status'] = '500';
            $resp_data['message'] = 'All Items were Delivered!, DO Generated';
        }

        echo json_encode($resp_data);

    }


    public function create_delivery_order(){
        
        $data['emp'] = $this->plugins->universal_api(69);
        if ($data['emp']['key1']) {
            $this->load->model('employee_model', 'employee');
            $data['employee'] = $this->employee->list_employee();
        }

        $this->load->library("Common");
        $data['custom_fields_c'] = $this->custom->add_fields(1);

        $this->load->model('customers_model', 'customers');
        $this->load->model('plugins_model', 'plugins');
        $data['exchange'] = $this->plugins->universal_api(5);
        $data['customergrouplist'] = $this->customers->group_list();
        if (isset($_GET)) {
            $custid = $this->input->get('cid');
            $data['cust_details'] = $this->customers->mydetails($custid);
        } else {
            $data['cust_details'] = 0;
        }

        $data['lastinvoice'] = $this->invocies->lastinvoice();
        $data['warehouse'] = $this->invocies->warehouses();
        $data['terms'] = $this->invocies->billingterms();
        $data['currency'] = $this->invocies->currencies();
        $this->load->library("Common");
        $data['taxlist'] = $this->common->taxlist($this->config->item('tax'));
        $head['title'] = "New Invoice";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['taxdetails'] = $this->common->taxdetail();
        $data['custom_fields'] = $this->custom->add_fields(2);
        $data['system_data'] = $this->db->get('gtg_system')->result_array();

        $data['invoice_ids'] = $this->db->distinct()->select('tid')->where('status','paid')->get('gtg_invoices')->result_array();
        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;
        $this->load->view('fixed/header', $head);
        $this->load->view('delivery_order/newinvoice', $data);
        $this->load->view('fixed/footer');

    }

    public function get_invoice_details(){

        $this->load->model('accounts_model');
        $invoice_id = $this->input->post('invoice_id');
        $invoice_id_details = $this->db->distinct()->select('id')->where('tid',$invoice_id)->get('gtg_invoices')->result_array();
        $tid = $invoice_id_details[0]['id'];
        $data['acclist'] = $this->accounts_model->accountslist((int) $this->aauth->get_user()->loc);
        $data['invoice'] = $this->invocies->invoice_details($tid, $this->limited);
        $data['attach'] = $this->invocies->attach($tid);
        $data['c_custom_fields'] = $this->custom->view_fields_data($data['invoice']['cid'], 1);
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = $this->lang->line('Invoice'). $data['invoice']['tid'];
        $data['products'] = $this->invocies->invoice_products($tid);
        if ($data['invoice']['id']) {
            $data['activity'] = $this->invocies->invoice_transactions($tid);
        }

        $data['employee'] = $this->invocies->employee($data['invoice']['eid']);
        $data['custom_fields'] = $this->custom->view_fields_data($tid, 2);

        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;
        if ($data['invoice']['id']) {
                $data['invoice']['id'] = $tid;      
                $resp_data['invoice_id'] = $tid;    
                $resp_data['status'] = '200';
                $resp_data['html'] = $this->load->view('delivery_order/invoice_details_view', $data, TRUE);
            } else {

                $resp_data['status'] = '500';
                $resp_data['message'] = 'Delivery Order Generate Failed';
            }
          
        echo json_encode($resp_data);
    }


    public function get_invoice_product_details(){

        $this->load->model('accounts_model');
        $this->load->library("Common");
        $invoice_id = $this->input->post('invoice_id');
        $invoice_id_details = $this->db->distinct()->select('id')->where('tid',$invoice_id)->get('gtg_invoices')->result_array();
        $tid = $invoice_id_details[0]['id'];

        $data['products'] = $this->invocies->invoice_original_products($tid);
        $data['taxlist'] = $this->common->taxlist($this->config->item('tax'));
        $this->load->model('plugins_model', 'plugins');
        $data['exchange'] = $this->plugins->universal_api(5);
        $data['currency'] = $this->purchase->currencies();
        $this->load->model('customers_model', 'customers');
        $data['customergrouplist'] = $this->customers->group_list();
        $data['lastinvoice'] = $this->purchase->lastpurchase();
        $data['terms'] = $this->purchase->billingterms();
        $head['title'] = "New Purchase";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['warehouse'] = $this->purchase->warehouses();
        $data['taxdetails'] = $this->common->taxdetail();
        
        if (!empty($tid)) {
            $data['invoice']['id'] = $tid;      
            $resp_data['invoice_id'] = $tid;    
            $resp_data['status'] = '200';
            $resp_data['html'] = $this->load->view('purchase/invoice_products_details', $data, TRUE);
        } else {

            $resp_data['status'] = '500';
            $resp_data['message'] = 'Delivery Order Generate Failed';
        }
          
        echo json_encode($resp_data);
    }

    

    public function action()
    {
        $currency = $this->input->post('mcurrency');
        $customer_id = $this->input->post('customer_id');
        $invocieno = $this->input->post('invocieno');
        $invoicedate = $this->input->post('invoicedate');
        $invocieduedate = $this->input->post('invocieduedate');
        $notes = $this->input->post('notes', true);
        $tax = $this->input->post('tax_handle');
        $ship_taxtype = $this->input->post('ship_taxtype');
        $disc_val = numberClean($this->input->post('disc_val'));
        $subtotal = rev_amountExchange_s($this->input->post('subtotal'), $currency, $this->aauth->get_user()->loc);
        $shipping = rev_amountExchange_s($this->input->post('shipping'), $currency, $this->aauth->get_user()->loc);
        $shipping_tax = rev_amountExchange_s($this->input->post('ship_tax'), $currency, $this->aauth->get_user()->loc);
        if ($ship_taxtype == 'incl') {
            $shipping = $shipping - $shipping_tax;
        }

        $refer = $this->input->post('refer', true);
        $total = rev_amountExchange_s($this->input->post('total'), $currency, $this->aauth->get_user()->loc);
        $project = $this->input->post('prjid');
        $total_tax = 0;
        $total_discount = rev_amountExchange_s($this->input->post('after_disc'), $currency, $this->aauth->get_user()->loc);
        $discountFormat = $this->input->post('discountFormat');
        $pterms = $this->input->post('pterms', true);
        $i = 0;
        if ($discountFormat == '0') {
            $discstatus = 0;
        } else {
            $discstatus = 1;
        }
        if ($customer_id == 0) {
            echo json_encode(array('status' => 'Error', 'message' =>
                $this->lang->line('Please add a new client')));
            exit;
        }

        $this->load->model('plugins_model', 'plugins');
        $empl_e = $this->plugins->universal_api(69);
        if ($empl_e['key1']) {
            $emp = $this->input->post('employee');
        } else {
            $emp = $this->aauth->get_user()->id;
        }

        $transok = true;
        $st_c = 0;
        $this->load->library("Common");
        $this->db->trans_start();
        //Invoice Data
        $bill_date = datefordatabase($invoicedate);
        $bill_due_date = datefordatabase($invocieduedate);

        $this->db->select('tid');
        $this->db->from('gtg_delivery_orders');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1);
        $this->db->where('tid', $invocieno);
        $this->db->where('i_class', 0);
        $query = $this->db->get();
        if (@$query->row()->tid) {
            $this->db->select('tid');
            $this->db->from('gtg_delivery_orders');
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            $this->db->where('i_class', 0);
            $query = $this->db->get();
            $invocieno = $query->row()->tid + 1;
        }

        $data = array('tid' => $invocieno, 'invoicedate' => $bill_date,
            'invoiceduedate' => $bill_due_date,
            'subtotal' => $subtotal, 'shipping' => $shipping, 'ship_tax' => $shipping_tax, 'ship_tax_type' => $ship_taxtype, 'discount_rate' => $disc_val, 'total' => $total, 'notes' => $notes, 'csd' => $customer_id, 'eid' => $emp, 'taxstatus' => $tax, 'discstatus' => $discstatus, 'format_discount' => $discountFormat, 'refer' => $refer, 'term' => $pterms, 'multi' => $currency, 'loc' => $this->aauth->get_user()->loc);
        $invocieno2 = $invocieno;
        if ($this->db->insert('gtg_delivery_orders', $data)) {
            $invocieno = $this->db->insert_id();
            //products
            $pid = $this->input->post('pid');
            $productlist = array();
            $prodindex = 0;
            $itc = 0;
            $product_id = $this->input->post('pid');
            $product_name1 = $this->input->post('product_name', true);
            $product_qty = $this->input->post('product_qty');
            $product_price = $this->input->post('product_price');
            $product_tax = $this->input->post('product_tax');
            $product_discount = $this->input->post('product_discount');
            $product_subtotal = $this->input->post('product_subtotal');
            $ptotal_tax = $this->input->post('taxa');
            $ptotal_disc = $this->input->post('disca');
            $product_des = $this->input->post('product_description', true);
            $product_unit = $this->input->post('unit');
            $product_hsn = $this->input->post('hsn', true);
            $product_alert = $this->input->post('alert');
            $product_serial = $this->input->post('serial');
            foreach ($pid as $key => $value) {
                $total_discount += numberClean(@$ptotal_disc[$key]);
                $total_tax += numberClean($ptotal_tax[$key]);
                $data = array(
                    'tid' => $invocieno,
                    'pid' => $product_id[$key],
                    'product' => $product_name1[$key],
                    'code' => $product_hsn[$key],
                    'qty' => numberClean($product_qty[$key]),
                    'price' => rev_amountExchange_s($product_price[$key], $currency, $this->aauth->get_user()->loc),
                    'tax' => numberClean($product_tax[$key]),
                    'discount' => numberClean($product_discount[$key]),
                    'subtotal' => rev_amountExchange_s($product_subtotal[$key], $currency, $this->aauth->get_user()->loc),
                    'totaltax' => rev_amountExchange_s($ptotal_tax[$key], $currency, $this->aauth->get_user()->loc),
                    'totaldiscount' => rev_amountExchange_s($ptotal_disc[$key], $currency, $this->aauth->get_user()->loc),
                    'product_des' => $product_des[$key],
                    'unit' => $product_unit[$key],
                    'serial' => $product_serial[$key],
                );

                $productlist[$prodindex] = $data;
                $i++;
                $prodindex++;
                $amt = numberClean($product_qty[$key]);
                if ($product_id[$key] > 0) {
                    $this->db->set('qty', "qty-$amt", false);
                    $this->db->where('pid', $product_id[$key]);
                    $this->db->update('gtg_products');
                    if ((numberClean($product_alert[$key]) - $amt) < 0 and $st_c == 0 and $this->common->zero_stock()) {
                        echo json_encode(array('status' => 'Error', 'message' => 'Product - <strong>' . $product_name1[$key] . "</strong> - Low quantity. Available stock is  " . $product_alert[$key]));
                        $transok = false;
                        $st_c = 1;
                    }
                }
                $itc += $amt;
            }
            if (count($product_serial) > 0) {
                $this->db->set('status', 1);
                $this->db->where_in('serial', $product_serial);
                $this->db->update('gtg_product_serials');
            }
            if ($prodindex > 0) {
                $this->db->insert_batch('gtg_delivery_order_items', $productlist);
                $this->db->set(array('discount' => rev_amountExchange_s(amountFormat_general($total_discount), $currency, $this->aauth->get_user()->loc), 'tax' => rev_amountExchange_s(amountFormat_general($total_tax), $currency, $this->aauth->get_user()->loc), 'items' => $itc));
                $this->db->where('id', $invocieno);
                $this->db->update('gtg_delivery_orders');
            } else {
                echo json_encode(array('status' => 'Error', 'message' =>
                    "Please choose product from product list. Go to Item manager section if you have not added the products."));
                $transok = false;
            }
            $tnote = '#' . $invocieno . '-';
            $d_trans = $this->plugins->universal_api(69);
            if ($d_trans['key2']) {
                $t_data = array(
                    'type' => 'Income',
                    'cat' => 'Sales',
                    'payerid' => $customer_id,
                    'method' => 'Auto',
                    'date' => $bill_date,
                    'eid' => $emp,
                    'tid' => $invocieno,
                    'loc' => $this->aauth->get_user()->loc,
                );

                $dual = $this->custom->api_config(65);
                $this->db->select('holder');
                $this->db->from('gtg_accounts');
                $this->db->where('id', $dual['key2']);
                $query = $this->db->get();
                $account_d = $query->row_array();
                $t_data['credit'] = 0;
                $t_data['debit'] = $total;
                $t_data['type'] = 'Expense';
                $t_data['acid'] = $dual['key2'];
                $t_data['account'] = $account_d['holder'];
                $t_data['note'] = 'Debit ' . $tnote;

                $this->db->insert('gtg_transactions', $t_data);
                //account update
                $this->db->set('lastbal', "lastbal-$total", false);
                $this->db->where('id', $dual['key2']);
                $this->db->update('gtg_accounts');
            }
            if ($transok) {
                $validtoken = hash_hmac('ripemd160', $invocieno, $this->config->item('encryption_key'));
                $link = base_url('billing/view?id=' . $invocieno . '&token=' . $validtoken);
                $viewlink = base_url('billing/view?id=' . $invocieno . '&token=' . $validtoken);
                $printlink = base_url('billing/printinvoice?id=' . $invocieno . '&token=' . $validtoken);
                echo json_encode(array('status' => 'Success', 'message' =>
                    $this->lang->line('Invoice Success') . " <a href='$viewlink' class='btn btn-primary btn-lg'><span class='fa fa-eye' aria-hidden='true'></span> " . $this->lang->line('View') . "  </a> &nbsp; &nbsp;<a href='$printlink' class='btn btn-blue btn-lg' target='_blank'><span class='fa fa-print' aria-hidden='true'></span> " . $this->lang->line('Print') . "  </a> &nbsp; &nbsp; <a href='$link' class='btn btn-purple btn-lg'><span class='fa fa-globe' aria-hidden='true'></span> " . $this->lang->line('Public View') . " </a> &nbsp; &nbsp; <a href='create' class='btn btn-warning btn-lg'><span class='fa fa-plus-circle' aria-hidden='true'></span></a>"));
            }
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
                "Invalid Entry!"));
            $transok = false;
        }
        if ($transok) {
            if ($this->aauth->premission(4) and $project > 0) {
                $data = array('pid' => $project, 'meta_key' => 11, 'meta_data' => $invocieno, 'value' => '0');
                $this->db->insert('gtg_project_meta', $data);
            }
            $this->db->trans_complete();
        } else {
            $this->db->trans_rollback();
        }
        if ($transok) {
            $this->db->from('univarsal_api');
            $this->db->where('univarsal_api.id', 56);
            $query = $this->db->get();
            $auto = $query->row_array();
            if ($auto['key1'] == 1) {
                $this->db->select('name,email');
                $this->db->from('gtg_customers');
                $this->db->where('id', $customer_id);
                $query = $this->db->get();
                $customer = $query->row_array();
                $this->load->model('communication_model');
                $invoice_mail = $this->send_invoice_auto($invocieno, $invocieno2, $bill_date, $total, $currency);
                $attachmenttrue = false;
                $attachment = '';
                $this->communication_model->send_corn_email($customer['email'], $customer['name'], $invoice_mail['subject'], $invoice_mail['message'], $attachmenttrue, $attachment);
            }
            if ($auto['key2'] == 1) {
                $this->db->select('name,phone');
                $this->db->from('gtg_customers');
                $this->db->where('id', $customer_id);
                $query = $this->db->get();
                $customer = $query->row_array();
                $this->load->model('plugins_model', 'plugins');

                $invoice_sms = $this->send_sms_auto($invocieno, $invocieno2, $bill_date, $total, $currency);
                $mobile = $customer['phone'];
                $text_message = $invoice_sms['message'];
                $this->load->model('sms_model', 'sms');
                $this->sms->send_sms($mobile, $text_message, false);
            }

            //profit calculation
            $t_profit = 0;
            $this->db->select('gtg_delivery_order_items.pid, gtg_delivery_order_items.price, gtg_delivery_order_items.qty, gtg_products.fproduct_price');
            $this->db->from('gtg_delivery_order_items');
            $this->db->join('gtg_products', 'gtg_products.pid = gtg_delivery_order_items.pid', 'left');
            $this->db->where('gtg_delivery_order_items.tid', $invocieno);
            $query = $this->db->get();
            $pids = $query->result_array();
            foreach ($pids as $profit) {
                $t_cost = $profit['fproduct_price'] * $profit['qty'];
                $s_cost = $profit['price'] * $profit['qty'];
                $t_profit += $s_cost - $t_cost;
            }
            $data = array('type' => 9, 'rid' => $invocieno, 'col1' => $t_profit, 'd_date' => $bill_date);

            $this->db->insert('gtg_metadata', $data);

            $this->custom->save_fields_data($invocieno, 2);
        }
    }

    

    public function list()
    {
       // $head['usernm'] = $this->aauth->get_user()->username;
          $head['title'] = 'Delivery Orders';        
        ///$data['employee'] = $this->employee->list_employee();
       // print_r($data);
          $data['do_orders'] = $this->deliveryorder->get_do_list();
          $data['invoice_ids'] = $this->db->distinct()->select('tid')->where('status','paid')->get('gtg_invoices')->result_array();
          $data['do_ids'] = $this->db->distinct()->select('parent_do_id')->get('gtg_do_relations')->result_array();

          $this->load->view('fixed/header', $head);
          $this->load->view('delivery_order/do_list', $data);
          $this->load->view('fixed/footer');
    }

    public function get_delivery_orders_list(){
        $post = $this->input->post();
        $data['do_orders'] = $this->deliveryorder->get_delivery_orders_list($post);

        $resp_data['status'] = '200';
        $resp_data['html'] = $this->load->view('delivery_order/delivery_orders_table',$data,TRUE);
        
            
        echo json_encode($resp_data);
    }



    
    public function recieved_list()
    {
       
       // $head['usernm'] = $this->aauth->get_user()->username;
          $head['title'] = 'Recieved Delivery Orders';        
        ///$data['employee'] = $this->employee->list_employee();
       // print_r($data);
          $data['do_orders'] = $this->deliveryorder->get_recieved_do_list();
          $this->load->view('fixed/header', $head);
          $this->load->view('delivery_order/recieved_do_list', $data);
          $this->load->view('fixed/footer');
    }

    public function get_delivery_orders_recieved_list(){
        $post = $this->input->post();
        $data['do_orders'] = $this->deliveryorder->get_delivery_orders_recieved_list($post);

        $resp_data['status'] = '200';
        $resp_data['html'] = $this->load->view('delivery_order/recieved_delivery_orders_table',$data,TRUE);
        
            
        echo json_encode($resp_data);
    }



    public function get_delivery_orders_details(){
        $post = $this->input->post();
        $p_do_id = $post['do_id'];
        $do_type = $post['do_type'];
        $do_option = $post['do_option'];
        // $p_do_id = '1000';
        
        $sql = "SELECT parent_do_id, GROUP_CONCAT(DISTINCT CONCAT(do_id, '#', cr_date) ORDER BY cr_date ASC) AS do_ids_and_dates,GROUP_CONCAT(DISTINCT CONCAT(supplier_do_id) ORDER BY cr_date ASC) AS supplier_do_ids, MAX(type) AS do_type, MAX(cr_date) AS max_cr_date, MAX(po_id) AS max_po_id, MAX(invoice_id) AS max_invoice_id FROM gtg_do_relations WHERE parent_do_id = '$p_do_id' GROUP BY parent_do_id ";
        $result = $this->db->query($sql);
        $parent_delivery_orders = $result->result_array();  
        // /echo $this->db->last_query();

        // echo "<pre>"; print_r($parent_delivery_orders); echo "</pre>";
        // exit;
       

        foreach ($parent_delivery_orders as $row) {
            // Explode do_ids into an array

            if($row['do_type'] == 'po')
            {
                $data['invoice'] = $this->purchase->purchase_details($row['max_po_id']);

            }else if($row['do_type'] == 'invoice'){

                $data['invoice'] = $this->invocies->invoice_details($row['max_invoice_id'], $this->limited);
            }

            
            $data['c_custom_fields'] = $this->custom->view_fields_data($data['invoice']['cid'], 1);

            // $doIdsArray = explode(',', $row['do_ids']); 
            // $parent_delivery_order_id = $row['parent_do_id'];
            // // Iterate over the do_ids array
            // foreach ($doIdsArray as $doId) {
            //     // Create an array for each iteration
            //     $delivery_order_id = $doId;

            //     if($row['do_type'] == 'po'){

            //         $po_sql = 'SELECT ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product FROM gtg_do_delivered_items ddi LEFT JOIN gtg_purchase_items gp ON ddi.p_id = gp.id WHERE ddi.delivery_order_id = '.$delivery_order_id.' AND ddi.parent_delivery_order_id = '.$parent_delivery_order_id.'';
            //         $po_result = $this->db->query($po_sql);
            //         $delivery_orders = $po_result->result_array();            

            //     }else if($row['do_type'] == 'invoice')
            //     {
            //         $po_sql = 'SELECT ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product FROM gtg_do_delivered_items ddi LEFT JOIN gtg_invoice_items gp ON ddi.p_id = gp.id WHERE ddi.delivery_order_id = '.$delivery_order_id.' AND ddi.parent_delivery_order_id = '.$parent_delivery_order_id.'';
            //         $po_result = $this->db->query($po_sql);
            //         $delivery_orders = $po_result->result_array();            
        
            //     }else if($row['do_type'] == 'do')
            //     {
            //         $do_sql = 'SELECT qty as delivered_qty, "do" as do_type, product FROM gtg_delivery_order_items ';
            //         $do_result = $this->db->query($do_sql);
            //         $delivery_orders = $do_result->result_array();       
        
            //     }

                
            //     $iterationData = [
            //         'parent_do_id' => $row['parent_do_id'],
            //         'do_id' => $row['parent_do_id'],
            //         'do_id' => $doId,
            //         'do_type' => $row['do_type'],
            //         'max_cr_date' => $row['max_cr_date'],
            //         'max_po_id' => $row['max_po_id'],
            //         'max_invoice_id' => $row['max_invoice_id'],
            //         'delivery_order' => $delivery_orders
            //     ];
    
            //     // Add the array to the output data
            //     $outputData[] = $iterationData;
            // print_r($row);
            // exit;

            $doIdsArray = explode(',',$row['do_ids_and_dates']); 
            $parent_delivery_order_id = $row['parent_do_id'];
            $supplier_do_ids = explode(',',$row['supplier_do_ids']);
            $max_po_id = $row['max_po_id'];
            $max_invoice_id = $row['max_invoice_id'];
            // print_r($doIdsArray);
            // exit;
            // Fetch individual cr_dates based on do_ids
            
            $sup=0;
            // Iterate over the do_ids array
            foreach ($doIdsArray as $doId) {
               
                
                // Create an array for each iteration
                
                $supplier_do_id = $supplier_do_ids[$sup];
                $do_data = explode('#',$doId);
                // print_r($do_data);
                $delivery_order_id = $do_data[0];
                $cr_date = $do_data[1];
                
                if($row['do_type'] == 'po'){

                    //$po_sql = 'SELECT ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product,gp.qty as ordered_qty FROM gtg_do_delivered_items ddi LEFT JOIN gtg_purchase_items gp ON ddi.p_id = gp.id WHERE ddi.delivery_order_id = '.$delivery_order_id.' AND ddi.parent_delivery_order_id = '.$parent_delivery_order_id.'';
                    $po_sql = 'SELECT ddi.id,ddi.delivery_order_id, ddi.parent_delivery_order_id, MAX(ddi.qty) as delivered_qty, MAX(ddi.return_qty) as return_qty, MAX(ddi.return_type) as return_type, MAX(ddi.description) as description, MAX(ddi.type) as do_type, MAX(gp.product) as product, gp.qty as ordered_qty FROM gtg_do_delivered_items ddi LEFT JOIN gtg_purchase_items gp ON ddi.p_id = gp.pid WHERE ddi.parent_delivery_order_id = '.$parent_delivery_order_id.' AND ddi.delivery_order_id = '.$delivery_order_id.' AND gp.tid='.$max_po_id.' GROUP BY ddi.delivery_order_id, ddi.parent_delivery_order_id, ddi.id  ';
                    $po_result = $this->db->query($po_sql);
                    $delivery_orders = $po_result->result_array();            

                }else if($row['do_type'] == 'invoice')
                {
                    $po_sql = 'SELECT ddi.id,ddi.delivery_order_id, ddi.parent_delivery_order_id, MAX(ddi.qty) as delivered_qty, MAX(ddi.return_qty) as return_qty, MAX(ddi.return_type) as return_type, MAX(ddi.description) as description, MAX(ddi.type) as do_type, MAX(gp.product) as product, gp.qty as ordered_qty FROM gtg_do_delivered_items ddi LEFT JOIN gtg_invoice_items gp ON ddi.p_id = gp.pid WHERE ddi.parent_delivery_order_id = '.$parent_delivery_order_id.' AND ddi.delivery_order_id = '.$delivery_order_id.' AND gp.tid='.$max_invoice_id.' GROUP BY ddi.delivery_order_id, ddi.parent_delivery_order_id, ddi.id  ';
                    $po_result = $this->db->query($po_sql);
                    $delivery_orders = $po_result->result_array();            
        
                }else if($row['do_type'] == 'do')
                {
                    $do_sql = 'SELECT qty as delivered_qty, "do" as do_type, product FROM gtg_delivery_order_items ';
                    $do_result = $this->db->query($do_sql);
                    $delivery_orders = $do_result->result_array();       
        
                }

                //echo $this->db->last_query();
                // Use the corresponding cr_date based on the key
                //$cr_date = isset($crDatesArray[$key]) ? $crDatesArray[$key] : null;

                $iterationData = [
                    'supplier_do_id'=> $supplier_do_id,
                    'parent_do_id' => $row['parent_do_id'],
                    'do_id' => $delivery_order_id,
                    'cr_date' => $cr_date,
                    'do_type' => $row['do_type'],
                    'max_po_id' => $row['max_po_id'],
                    'max_invoice_id' => $row['max_invoice_id'],
                    'delivery_order' => $delivery_orders
                ];

                // Add the array to the output data
                $outputData[] = $iterationData;
                $sup++;
            }
            
            
        }

         $data['do_list'] = $outputData;
         $data['do_option'] = $do_option;
         $data['do_type'] = $do_type;
         $data['parent_do_id'] = $p_do_id;
        //  echo "<pre>"; print_r($data); echo "</pre>";
        //  exit;
       

        // $data['do_orders'] = $this->deliveryorder->get_delivery_orders_list($post);

        $resp_data['status'] = '200';
        $resp_data['html'] = $this->load->view('delivery_order/do_detailed_view',$data,TRUE);
        
            
        echo json_encode($resp_data);
    }

    public function get_single_do_details(){
        
        $post = $this->input->post();
        $p_do_id = $post['p_do_id'];
        $do_id = $post['do_id'];
        $do_type = $post['do_type'];
        // $do_option = $post['do_option'];
        // $p_do_id = '1000';
        
        $sql = 'SELECT * from gtg_do_relations where do_id = '.$do_id.'';
        $result = $this->db->query($sql);
        $parent_delivery_orders = $result->result_array();  

        // echo "<pre>"; print_r($parent_delivery_orders); echo "</pre>";
        // exit;
       

        foreach ($parent_delivery_orders as $row) {
            // Explode do_ids into an array

           
                // Create an array for each iteration
                $delivery_order_id = $row['do_id'];
                $parent_delivery_order_id = $row['parent_do_id'];
                $max_po_id = $row['po_id'];
                $max_invoice_id = $row['invoice_id'];

                if($do_type == 'po'){

                    // $po_sql = 'SELECT ddi.id as id,ddi.qty as delivered_qty, ddi.type as do_type, gp.product,ddi.p_id as p_id  FROM gtg_do_delivered_items ddi LEFT JOIN gtg_purchase_items gp ON ddi.p_id = gp.id WHERE ddi.delivery_order_id = '.$delivery_order_id.' AND ddi.parent_delivery_order_id = '.$parent_delivery_order_id.'';
                    // $po_result = $this->db->query($po_sql);
                    // $delivery_orders = $po_result->result_array(); 
                    $po_sql = 'SELECT ddi.id,ddi.delivery_order_id, ddi.parent_delivery_order_id,ddi.p_id as p_id, MAX(ddi.qty) as delivered_qty, MAX(ddi.return_qty) as return_qty, MAX(ddi.return_type) as return_type, MAX(ddi.description) as description, MAX(ddi.type) as do_type, MAX(gp.product) as product, gp.qty as ordered_qty FROM gtg_do_delivered_items ddi LEFT JOIN gtg_purchase_items gp ON ddi.p_id = gp.pid WHERE ddi.parent_delivery_order_id = '.$parent_delivery_order_id.' AND ddi.delivery_order_id = '.$delivery_order_id.' AND gp.tid='.$max_po_id.' GROUP BY ddi.delivery_order_id, ddi.parent_delivery_order_id, ddi.id  ';
                    $po_result = $this->db->query($po_sql);
                    $delivery_orders = $po_result->result_array();            


                }else if($do_type == 'invoice')
                {
                    $po_sql = 'SELECT ddi.id,ddi.delivery_order_id, ddi.parent_delivery_order_id,ddi.p_id as p_id, MAX(ddi.qty) as delivered_qty, MAX(ddi.return_qty) as return_qty, MAX(ddi.return_type) as return_type, MAX(ddi.description) as description, MAX(ddi.type) as do_type, MAX(gp.product) as product, gp.qty as ordered_qty FROM gtg_do_delivered_items ddi LEFT JOIN gtg_invoice_items gp ON ddi.p_id = gp.pid WHERE ddi.parent_delivery_order_id = '.$parent_delivery_order_id.' AND ddi.delivery_order_id = '.$delivery_order_id.' AND gp.tid='.$max_invoice_id.' GROUP BY ddi.delivery_order_id, ddi.parent_delivery_order_id, ddi.id  ';
                    $po_result = $this->db->query($po_sql);
                    $delivery_orders = $po_result->result_array();            
        
                }else if($do_type == 'do')
                {
                    $do_sql = 'SELECT qty as delivered_qty, "do" as do_type, product FROM gtg_delivery_order_items ';
                    $do_result = $this->db->query($do_sql);
                    $delivery_orders = $do_result->result_array();       
        
                }

                // echo $this->db->last_query();
                // exit;
                
                $iterationData = [
                    'parent_do_id' => $row['parent_do_id'],
                    'do_id' => $row['do_id'],
                    'do_type' => $row['type'],
                    'max_cr_date' => $row['cr_date'],
                    'max_po_id' => $row['po_id'],
                    'max_invoice_id' => $row['invoice_id'],
                    'delivery_order' => $delivery_orders
                ];
    
                // Add the array to the output data
                $outputData[] = $iterationData;
            
        }

         $data['do_list'] = $outputData;
         //$data['do_option'] = $do_option;
        //  echo "<pre>"; print_r($data); echo "</pre>";
        //  exit;
       

        // $data['do_orders'] = $this->deliveryorder->get_delivery_orders_list($post);

        $resp_data['status'] = '200';
        $resp_data['html'] = $this->load->view('delivery_order/do_items_list_view',$data,TRUE);

            
        echo json_encode($resp_data);
    }

    public function update_do_return_items_details(){
        $jsonData = $this->input->post('rowData');

        // Decode the JSON string into an associative array
        $rowData = json_decode($jsonData, true);
        $success = 0;
        // Check if the decoding was successful
        if ($rowData !== null) {
            // Iterate through each row in the array
            foreach ($rowData as $row) {
                // Access the data in each row

              //  $do_details = $this->db->where('parent_do_id',$parent_do_id)->get('gtg_do_relations')->result_array();

                $qty = $row['qty'];
                $desc = $row['desc'];
                $do_id = $row['do_id'];
                $parent_do_id = $row['parent_do_id'];
                $id = $row['id'];
                $p_id = $row['p_id'];

                $data = array(
                    'return_qty' => $row['qty'],
                    'description' => $row['desc'],
                    'return_type' => 'return',
                    // Add other columns as needed
                );
    
                // Construct the WHERE clause
                $where = array(
                    'delivery_order_id' => $row['do_id'],
                    'parent_delivery_order_id' => $row['parent_do_id'],
                    'id' => $row['id'],
                );
    
                $select_p_ids[] = $id;
                $delivery_order_parent_do_id = $row['parent_do_id'];
                $delivery_order_do_id = $row['do_id'];
                

                $do_details = $this->db->where('parent_do_id',$parent_do_id)->limit(1)->get('gtg_do_relations')->result_array();
                $do_type =  $do_details[0]['type'];
                $s_p_data['p_id'] = $row['p_id'];
                $s_p_data['qty'] = $row['qty'];

                $stock_p_ids[] = $s_p_data;

                // Perform the update query
                if($this->db->update('gtg_do_delivered_items', $data, $where))
                {
                    $success++;
                   
                }

            }


        // echo "<pre>"; print_r($stock_p_ids); echo "</pre>";
        // exit;
        
        if($do_type == 'invoice')
        {
            $invoice_id = $do_details[0]['invoice_id'];            
            $invoice_details = $this->invocies->invoice_details($invoice_id);
            $mailto = $invoice_details['email_s'];
        }else  if($do_type == 'po'){
            $po_id = $do_details[0]['po_id'];
            $invoice_details = $this->purchase->purchase_details($po_id);
            $mailto = $invoice_details['email'];
        }

        // echo "<pre>"; print_r($invoice_details); echo "</pre>";
        // exit;

        if(!empty($stock_p_ids))
        {
            if($do_type == 'invoice')
            {
                foreach ($stock_p_ids as $stock_p_id) {
                    $prid = $stock_p_id['p_id'];
                    $dqty = $stock_p_id['qty'];
                    if ($prid > 0) {
    
                        $this->db->set('qty', "qty+$dqty", FALSE);
                        $this->db->where('pid', $prid);
                        $this->db->update('gtg_products');
                    }
                }
            }else{
                foreach ($stock_p_ids as $stock_p_id) {
                    $prid = $stock_p_id['p_id'];
                    $dqty = $stock_p_id['qty'];
                    if ($prid > 0) {
    
                        $this->db->set('qty', "qty-$dqty", FALSE);
                        $this->db->where('pid', $prid);
                        $this->db->update('gtg_products');
                    }
                }
            }
            
        }

            $delivery_r_data['id'] = implode(',',$select_p_ids);
            $delivery_r_data['parent_do_id'] = $delivery_order_parent_do_id;
            $delivery_r_data['do_id'] = $delivery_order_do_id;
        }

        $slected_po_ids_str =  $delivery_r_data['id'];
        // echo "<pre>"; print_r($select_p_ids); echo "</pre>";
        // exit; 
        $po_sql = 'SELECT ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product,gp.qty as ordered_qty FROM gtg_do_delivered_items ddi LEFT JOIN gtg_invoice_items gp ON ddi.p_id = gp.pid WHERE ddi.delivery_order_id = '.$delivery_order_do_id.' AND ddi.parent_delivery_order_id = '.$delivery_order_parent_do_id.' AND ddi.id IN ('.$slected_po_ids_str.')';
        $po_result = $this->db->query($po_sql);
        $delivery_orders = $po_result->result_array(); 
        
        if(empty($mailto))
        {

            $system_data = $this->db->get('gtg_system')->result_array();
            $mailto = $system_data[0]['email'];
        }
        $delivery_r_data['delivery_order'] = $delivery_orders;
                
        
        $elements = array();
        $content = "";
        $subject = "Sub Delivery Order #{$do_id} Return Request";
        $message = $this->load->view('delivery_order/return_email_template', $delivery_r_data,TRUE);
        $mailtotitle = "";
        // echo $message;
        // exit;

        $attachmenttrue = "true";
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
        $mailer = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto,
            $mailtotitle, $subject, $message, $attachmenttrue, '');
        if ($mailer) {
            // foreach ($exppassportlist as $exppassport) {
            //     $data = array(
            //         'passport_email_sent' => 1,
            //     );
            //     $this->db->set($data);
            //     $this->db->where('id', $exppassport['id']);
            //     $this->db->update('gtg_employees');
            // }
        }

        $resp_data['status'] = '200';
        $resp_data['message'] = 'Return Request Created Successfully';

            
        echo json_encode($resp_data);
    }

    public function update_do_cancel_details(){

        $do_id = $this->input->post('do_id');
        $p_do_id = $this->input->post('p_do_id');
        $cancelDescription = $this->input->post('cancelDescription');
        $success = 0;
        $nrowData = $this->db->where('delivery_order_id',$do_id)->where('parent_delivery_order_id',$p_do_id)->get('gtg_do_delivered_items')->result_array();
        $do_details = $this->db->where('parent_do_id',$p_do_id)->limit(1)->get('gtg_do_relations')->result_array();
        $do_type =  $do_details[0]['type'];
                
       // echo "<pre>"; print_r($nrowData); echo "</pre>";
        //exit;
        // Iterate through each row in the array
            foreach ($nrowData as $n_row) {

                $id = $n_row['id'];

                // Access the data in each row
                $data = array();
                $data = array(
                    'return_qty' => $n_row['qty'],
                    'description' => $cancelDescription,
                    'return_type' => 'cancel',
                    // Add other columns as needed
                );
                $where = array();
                // Construct the WHERE clause
                $where = array(
                    'delivery_order_id' => $do_id,
                    'parent_delivery_order_id' => $p_do_id,
                    'id' => $n_row['id']
                );
    
                $select_p_ids[] = $id;
                $delivery_order_parent_do_id = $p_do_id;
                $delivery_order_do_id = $do_id;

                $s_p_data['p_id'] = $n_row['p_id'];
                $s_p_data['qty'] = $n_row['qty'];

                $stock_p_ids[] = $s_p_data;
                
                // Perform the update query
                if($this->db->update('gtg_do_delivered_items', $data, $where))
                {
                    $success++;
                }

               

            $delivery_r_data['id'] = implode(',',$select_p_ids);
            $delivery_r_data['parent_do_id'] = $delivery_order_parent_do_id;
            $delivery_r_data['do_id'] = $delivery_order_do_id;
    
            }  
            
            
            
            if($do_type == 'invoice')
            {
                $invoice_id = $do_details[0]['invoice_id'];            
                $invoice_details = $this->invocies->invoice_details($invoice_id);
                $mailto = $invoice_details['email_s'];
            }else  if($do_type == 'po'){
                $po_id = $do_details[0]['po_id'];
                $invoice_details = $this->purchase->purchase_details($po_id);
                $mailto = $invoice_details['email'];
            }

            if(!empty($stock_p_ids))
        {
            if($do_type == 'invoice')
            {
                foreach ($stock_p_ids as $stock_p_id) {
                    $prid = $stock_p_id['p_id'];
                    $dqty = $stock_p_id['qty'];
                    if ($prid > 0) {
    
                        $this->db->set('qty', "qty+$dqty", FALSE);
                        $this->db->where('pid', $prid);
                        $this->db->update('gtg_products');
                    }
                }
            }else{
                foreach ($stock_p_ids as $stock_p_id) {
                    $prid = $stock_p_id['p_id'];
                    $dqty = $stock_p_id['qty'];
                    if ($prid > 0) {
    
                        $this->db->set('qty', "qty-$dqty", FALSE);
                        $this->db->where('pid', $prid);
                        $this->db->update('gtg_products');
                    }
                }
            }
            
        }



        $slected_po_ids_str =  $delivery_r_data['id'];
        $po_sql = 'SELECT ddi.invoice_id, ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product,gp.qty as ordered_qty FROM gtg_do_delivered_items ddi LEFT JOIN gtg_invoice_items gp ON ddi.p_id = gp.pid WHERE ddi.delivery_order_id = '.$delivery_order_do_id.' AND ddi.parent_delivery_order_id = '.$delivery_order_parent_do_id.' AND ddi.id IN ('.$slected_po_ids_str.')';
        $po_result = $this->db->query($po_sql);
        $delivery_orders = $po_result->result_array(); 

        if(empty($mailto))
        {

            $system_data = $this->db->get('gtg_system')->result_array();
            $mailto = $system_data[0]['email'];
        }

        //$system_data = $this->db->get('gtg_system')->result_array();
        // $invoice_details = $this->invocies->invoice_details($delivery_orders[0]['invoice_id']);

        $delivery_r_data['delivery_order'] = $delivery_orders;
                
        //$mailto = $system_data[0]['email'];
        $elements = array();
        $content = "";
        $subject = "Sub Delivery Order #{$do_id} Return Request";
        $message = $this->load->view('delivery_order/return_email_template', $delivery_r_data,TRUE);
        $mailtotitle = "";
        // echo $message;
        // exit;

        $attachmenttrue = "true";
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
        $mailer = $this->ultimatemailer->load($host, $port, $auth, $auth_type, $username, $password, $mailfrom, $mailfromtilte, $mailto,
            $mailtotitle, $subject, $message, $attachmenttrue, '');
        if ($mailer) {
            // foreach ($exppassportlist as $exppassport) {
            //     $data = array(
            //         'passport_email_sent' => 1,
            //     );
            //     $this->db->set($data);
            //     $this->db->where('id', $exppassport['id']);
            //     $this->db->update('gtg_employees');
            // }
        }


            $resp_data['status'] = '200';
            $resp_data['message'] = 'Cancel Request Created Successfully';
    
                
            echo json_encode($resp_data);    
        }


        public function test($pid= ''){

                       
            // $this->db->select('id,po_id,p_id,qty,return_qty,delivery_order_id,parent_delivery_order_id,supplier_delivery_order_id,do_expire_date, SUM(`qty` - `return_qty`) AS total_available_quantity');
            // $this->db->from('gtg_do_delivered_items');
            // $this->db->where('po_id !=', 0);
            // $this->db->where('type', 'cr');
            // $this->db->where('p_id', 6);
            // $this->db->group_by('p_id');
            // $this->db->group_by('delivery_order_id');
            // $this->db->order_by('do_expire_date', 'ASC');

            $this->db->select('gtg_do_delivered_items.id, gtg_do_delivered_items.po_id, gtg_do_delivered_items.p_id, gtg_do_delivered_items.qty, gtg_do_delivered_items.return_qty, gtg_do_delivered_items.delivery_order_id, gtg_do_delivered_items.parent_delivery_order_id, gtg_do_delivered_items.supplier_delivery_order_id, gtg_do_delivered_items.do_expire_date, SUM(gtg_do_delivered_items.qty - gtg_do_delivered_items.return_qty) AS total_available_quantity');
            $this->db->from('gtg_do_delivered_items');
            $this->db->join('gtg_do_product_batches_history', 'gtg_do_delivered_items.delivery_order_id = gtg_do_product_batches_history.delivery_order_id', 'left');
            $this->db->where('gtg_do_delivered_items.po_id !=', 0);
            $this->db->where('gtg_do_delivered_items.type', 'cr');
            $this->db->where('gtg_do_delivered_items.p_id', 6);
            $this->db->group_by('gtg_do_delivered_items.p_id');
            $this->db->group_by('gtg_do_delivered_items.delivery_order_id');
            $this->db->order_by('gtg_do_delivered_items.do_expire_date', 'ASC');

            //$query = $this->db->get();
            
            $batch_query = $this->db->get();

            $results =  $batch_query->result_array();
            // echo "<pre>"; print_r($results); echo "</pre>";

            $required_product_qty = 5;
            $filteredData = array();
            $used_qty_by_delivery_order = array();
            $total_used_qty = 0;
            
            foreach ($results as $row) {
            
                $this->db->select_sum('used_qty');
                $this->db->where('delivery_order_id', $row['delivery_order_id']);
                $used_qty_query = $this->db->get('gtg_do_product_batches_history');
                $used_qty_result = $used_qty_query->row();
                $used_qty = $used_qty_result->used_qty;
            
                // Calculate available_quantity
                $available_quantity = $row['total_available_quantity'] - $used_qty;
            
                // Add condition to fetch rows where available_quantity > 0
                if ($available_quantity > 0) {

                    
                $filteredData[] = array(
                    'id' => $row['id'],
                    'po_id' => $row['po_id'],
                    'p_id' => $row['p_id'],
                    'supplier_delivery_order_id' => $row['supplier_delivery_order_id'],
                    'delivery_order_id' => $row['delivery_order_id'],
                    'parent_delivery_order_id' => $row['parent_delivery_order_id'],
                    'available_quantity' => $available_quantity,
                    'do_expire_date' => $row['do_expire_date'],
                    'used_qty' => 0,
                );
            
                // Check if required quantity is not fulfilled
                if ($total_used_qty < $required_product_qty) {
                    $deduct_qty = min($available_quantity, $required_product_qty - $total_used_qty);
                    $used_qty_by_delivery_order[$row['delivery_order_id']] = $deduct_qty;
                    $filteredData[count($filteredData) - 1]['used_qty'] = $deduct_qty;
                    $total_used_qty += $deduct_qty;
                }
            
                // Check if required quantity is fulfilled
                if ($total_used_qty >= $required_product_qty) {
                    break; // Exit the loop if the required quantity is fulfilled
                }
            }
        }
            
            // Display an error if the required quantity is not available
            if ($total_used_qty < $required_product_qty) {
                echo "Error: Required quantity is not available.";
            } else {
                echo "<pre>"; print_r($filteredData); echo "</pre>";

               //$this->db->insert_batch('gtg_do_product_batches_history', $filteredData);    
                
            }
            

        }
}