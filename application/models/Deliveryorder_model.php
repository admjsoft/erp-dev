<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Deliveryorder_model extends CI_Model
{
   
    public function __construct()
    {
        parent::__construct();
    }

    public function lastdo()
    {
        $this->db->select('parent_do_id');
        $this->db->from('gtg_do_relations');
        $this->db->order_by('parent_do_id', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return ($query->row()->parent_do_id + 1 );
        } else {
            return 1000;
        }
    }

    public function get_do_list(){

        $po_delivery_orders = array();
        $delivery_orders = array();
        // $po_sql = 'SELECT ddi.po_id, ddi.invoice_id, ddi.parent_do_id AS do_id, ddi.type AS do_type, MAX(ddi.cr_date) AS cr_date, MAX(gp.tid) AS tid, MAX(gp.items) AS items, ( SELECT COALESCE(SUM(doi.qty), 0) FROM gtg_do_delivered_items doi WHERE doi.parent_delivery_order_id = ddi.parent_do_id ) AS total_qty, ( SELECT COALESCE(SUM(doi.return_qty), 0) FROM gtg_do_delivered_items doi WHERE doi.parent_delivery_order_id = ddi.parent_do_id ) AS return_qty  FROM gtg_do_relations ddi LEFT JOIN gtg_purchase gp ON ddi.po_id = gp.id WHERE ddi.po_id != 0 GROUP BY ddi.parent_do_id, ddi.type; ';
        // $po_result = $this->db->query($po_sql);
        // $po_delivery_orders = $po_result->result_array();

        
        $invoice_sql = 'SELECT ddi.po_id, ddi.invoice_id, gp.tid AS display_invoice_id, ddi.parent_do_id AS do_id, ddi.type AS do_type, MAX(ddi.cr_date) AS cr_date, CAST(MAX(gp.tid) AS SIGNED) AS tid, CAST(MAX(gp.items) AS SIGNED) AS items, COUNT(DISTINCT ddi.do_id) AS do_count, CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) AS total_qty, CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED) AS return_qty, (CAST(MAX(gp.items) AS SIGNED) - (CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) - CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED))) AS balance_qty FROM gtg_do_relations ddi LEFT JOIN gtg_invoices gp ON ddi.invoice_id = gp.id LEFT JOIN (SELECT parent_delivery_order_id, MAX(cr_date) AS max_cr_date, SUM(IFNULL(qty, 0)) AS qty, SUM(IFNULL(return_qty, 0)) AS return_qty FROM gtg_do_delivered_items GROUP BY parent_delivery_order_id) doi ON doi.parent_delivery_order_id = ddi.parent_do_id WHERE ddi.invoice_id != 0 GROUP BY ddi.parent_do_id, ddi.type; ';
        $invoice_result = $this->db->query($invoice_sql);
        $invoice_delivery_orders = $invoice_result->result_array();
        
        // $do_sql = 'SELECT tid as do_id,"do" AS do_type,cr_date,tid,items,items as total_qty FROM gtg_delivery_orders';
        // $do_result = $this->db->query($do_sql);
        // $delivery_orders = $do_result->result_array();

        // echo "<pre>"; print_r($po_delivery_orders); echo "</pre>";
        // echo "<pre>"; print_r($invoice_delivery_orders); echo "</pre>";
        // echo "<pre>"; print_r($delivery_orders); echo "</pre>";
        // exit;

        $total_do = array_merge($po_delivery_orders, $invoice_delivery_orders, $delivery_orders);

        // Extract the 'age' column to a separate array for sorting
        $dates = array_column($total_do, 'cr_date');

        // Use array_multisort to sort the original array based on the 'age' column
        array_multisort($dates, SORT_DESC, $total_do);

        // echo "<pre>"; print_r($total_do); echo "</pre>";
        // exit;
        $total_do_list = [];
        
        // Iterate through the result array and categorize items based on conditions
        
           foreach ($total_do as $item) {
                if (((int)$item['total_qty']-$item['return_qty']) === 0 || is_null(((int)$item['total_qty']-$item['return_qty']))) {
                    $item['status'] = 'due';
                    $total_do_list[] = $item;
                }else if ((((int)$item['total_qty']-$item['return_qty']) != $item['items']) && ((int)$item['total_qty']-$item['return_qty']) != 0 ) {
                    $item['status'] = 'partial';
                    $total_do_list[] = $item;
                }else if (((int)$item['total_qty']-$item['return_qty'])  == $item['items']) {
                    $item['status'] = 'completed';
                    $total_do_list[] = $item;
                }
                }
            

        // echo "<pre>"; print_r($total_do_list); echo "</pre>";
        // exit;
        return $total_do_list;



    }

    public function get_recieved_do_list(){

        $po_delivery_orders = array();
        $po_sql = 'SELECT ddi.po_id, ddi.invoice_id, gp.tid AS display_invoice_id, ddi.parent_do_id AS do_id, ddi.type AS do_type, MAX(ddi.cr_date) AS cr_date, CAST(MAX(gp.tid) AS SIGNED) AS tid, CAST(MAX(gp.items) AS SIGNED) AS items, COUNT(DISTINCT ddi.do_id) AS do_count, CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) AS total_qty, CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED) AS return_qty, (CAST(MAX(gp.items) AS SIGNED) - (CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) - CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED))) AS balance_qty FROM gtg_do_relations ddi LEFT JOIN gtg_purchase gp ON ddi.po_id = gp.id LEFT JOIN (SELECT parent_delivery_order_id, MAX(cr_date) AS max_cr_date, SUM(IFNULL(qty, 0)) AS qty, SUM(IFNULL(return_qty, 0)) AS return_qty FROM gtg_do_delivered_items GROUP BY parent_delivery_order_id) doi ON doi.parent_delivery_order_id = ddi.parent_do_id WHERE ddi.po_id != 0 GROUP BY ddi.parent_do_id, ddi.type ';
        $po_result = $this->db->query($po_sql);
        $po_delivery_orders = $po_result->result_array();

              // Extract the 'age' column to a separate array for sorting
        $dates = array_column($po_delivery_orders, 'cr_date');

        // Use array_multisort to sort the original array based on the 'age' column
        array_multisort($dates, SORT_DESC, $po_delivery_orders);

        // echo "<pre>"; print_r($total_do); echo "</pre>";
        // exit;
        $total_do_list = [];
        
        // Iterate through the result array and categorize items based on conditions
        
           foreach ($po_delivery_orders as $item) {
                if (((int)$item['total_qty']-$item['return_qty']) === 0 || is_null(((int)$item['total_qty']-$item['return_qty']))) {
                    $item['status'] = 'due';
                    $total_do_list[] = $item;
                }else if ((((int)$item['total_qty']-$item['return_qty']) != $item['items']) && ((int)$item['total_qty']-$item['return_qty']) != 0 ) {
                    $item['status'] = 'partial';
                    $total_do_list[] = $item;
                }else if (((int)$item['total_qty']-$item['return_qty'])  == $item['items']) {
                    $item['status'] = 'completed';
                    $total_do_list[] = $item;
                }
                }
            

        // echo "<pre>"; print_r($total_do_list); echo "</pre>";
        // exit;
        return $total_do_list;



    }

    public function get_delivery_orders_list($post){

        $do_type = $post['do_type'];
        $do_status = $post['do_status'];
        $do_start_date = $post['do_start_date'];
        $do_end_date = $post['do_end_date'];
        $search_invoice_id = $post['search_invoice_id'];

        $po_delivery_orders = array();
        $invoice_delivery_orders = array();
        $delivery_orders = array();

        if($do_type == 'all')
        {
            // $po_sql = 'SELECT ddi.po_id, ddi.invoice_id,ddi.parent_do_id as do_id, ddi.type as do_type, MAX(ddi.cr_date) as cr_date, MAX(gp.tid) as tid, MAX(gp.items) as items, SUM(doi.qty) as total_qty, ( SELECT COALESCE(SUM(doi.return_qty), 0) FROM gtg_do_delivered_items doi WHERE doi.parent_delivery_order_id = ddi.parent_do_id ) AS return_qty  FROM gtg_do_relations ddi LEFT JOIN gtg_purchase gp ON ddi.po_id = gp.id LEFT JOIN gtg_do_delivered_items doi ON doi.parent_delivery_order_id = ddi.parent_do_id WHERE ddi.po_id != 0 ';
            // if(!empty($do_date)){ $po_sql .= ' AND DATE(ddi.cr_date) = "'.$do_date.'" '; } 
            // $po_sql .= ' GROUP BY ddi.parent_do_id, ddi.type'; 
            // $po_result = $this->db->query($po_sql);
            // $po_delivery_orders = $po_result->result_array();

            $invoice_sql = 'SELECT ddi.po_id, ddi.invoice_id, gp.tid AS display_invoice_id, ddi.parent_do_id AS do_id, ddi.type AS do_type, MAX(ddi.cr_date) AS cr_date, CAST(MAX(gp.tid) AS SIGNED) AS tid, CAST(MAX(gp.items) AS SIGNED) AS items, COUNT(DISTINCT ddi.do_id) AS do_count, CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) AS total_qty, CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED) AS return_qty, (CAST(MAX(gp.items) AS SIGNED) - (CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) - CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED))) AS balance_qty FROM gtg_do_relations ddi LEFT JOIN gtg_invoices gp ON ddi.invoice_id = gp.id LEFT JOIN (SELECT parent_delivery_order_id, MAX(cr_date) AS max_cr_date, SUM(IFNULL(qty, 0)) AS qty, SUM(IFNULL(return_qty, 0)) AS return_qty FROM gtg_do_delivered_items GROUP BY parent_delivery_order_id) doi ON doi.parent_delivery_order_id = ddi.parent_do_id WHERE ddi.invoice_id != 0  ';
            if(!empty($do_start_date) && !empty($do_end_date)){ $invoice_sql .= ' AND DATE(ddi.cr_date) BETWEEN "' . $do_start_date . '" AND "' . $do_end_date . '" '; }
            if (!empty($search_invoice_id)) {
                $invoice_sql .= ' AND (ddi.parent_do_id = "' . $search_invoice_id . '" OR gp.tid = "' . $search_invoice_id . '")';
            }
            $invoice_sql .= ' GROUP BY ddi.parent_do_id, ddi.type'; 
            $invoice_result = $this->db->query($invoice_sql);
            $invoice_delivery_orders = $invoice_result->result_array();
            
            $do_sql = 'SELECT "do" AS do_type,tid as do_id,cr_date,tid,items,items as total_qty FROM gtg_delivery_orders';
            if(!empty($do_date)){ $do_sql .= ' WHERE DATE(cr_date) = "'.$do_date.'" '; }
            $do_result = $this->db->query($do_sql);
            $delivery_orders = $do_result->result_array();

        }else if($do_type == 'po')
        {
            // $po_sql = 'SELECT ddi.po_id, ddi.invoice_id,ddi.parent_do_id as do_id, ddi.type as do_type, MAX(ddi.cr_date) as cr_date, MAX(gp.tid) as tid, MAX(gp.items) as items, SUM(doi.qty) as total_qty, ( SELECT COALESCE(SUM(doi.return_qty), 0) FROM gtg_do_delivered_items doi WHERE doi.parent_delivery_order_id = ddi.parent_do_id ) AS return_qty  FROM gtg_do_relations ddi LEFT JOIN gtg_purchase gp ON ddi.po_id = gp.id LEFT JOIN gtg_do_delivered_items doi ON doi.parent_delivery_order_id = ddi.parent_do_id WHERE ddi.po_id != 0 ';
            // if(!empty($do_date)){ $po_sql .= ' AND DATE(ddi.cr_date) = "'.$do_date.'" '; } 
            // $po_sql .= ' GROUP BY ddi.parent_do_id, ddi.type'; 
            // $po_result = $this->db->query($po_sql);
            // $po_delivery_orders = $po_result->result_array();            

        }else if($do_type == 'invoice')
        {
            $invoice_sql = 'SELECT ddi.po_id, ddi.invoice_id, gp.tid AS display_invoice_id, ddi.parent_do_id AS do_id, ddi.type AS do_type, MAX(ddi.cr_date) AS cr_date, CAST(MAX(gp.tid) AS SIGNED) AS tid, CAST(MAX(gp.items) AS SIGNED) AS items, COUNT(DISTINCT ddi.do_id) AS do_count, CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) AS total_qty, CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED) AS return_qty, (CAST(MAX(gp.items) AS SIGNED) - (CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) - CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED))) AS balance_qty FROM gtg_do_relations ddi LEFT JOIN gtg_invoices gp ON ddi.invoice_id = gp.id LEFT JOIN (SELECT parent_delivery_order_id, MAX(cr_date) AS max_cr_date, SUM(IFNULL(qty, 0)) AS qty, SUM(IFNULL(return_qty, 0)) AS return_qty FROM gtg_do_delivered_items GROUP BY parent_delivery_order_id) doi ON doi.parent_delivery_order_id = ddi.parent_do_id WHERE ddi.invoice_id != 0  ';
            if(!empty($do_start_date) && !empty($do_end_date)){ $invoice_sql .= ' AND DATE(ddi.cr_date) BETWEEN "' . $do_start_date . '" AND "' . $do_end_date . '" '; }
            if (!empty($search_invoice_id)) {
                $invoice_sql .= ' AND (ddi.parent_do_id = "' . $search_invoice_id . '" OR gp.tid = "' . $search_invoice_id . '")';
            }
            $invoice_sql .= ' GROUP BY ddi.parent_do_id, ddi.type'; 
            $invoice_result = $this->db->query($invoice_sql);
            $invoice_delivery_orders = $invoice_result->result_array();

        }else if($do_type == 'do')
        {
            $do_sql = 'SELECT "do" AS do_type,tid as do_id,cr_date,tid,items,items as total_qty FROM gtg_delivery_orders';
            if(!empty($do_date)){ $do_sql .= ' WHERE DATE(cr_date) = "'.$do_date.'" '; }
            $do_result = $this->db->query($do_sql);
            $delivery_orders = $do_result->result_array();       

        }
        
        // echo "<pre>"; print_r($po_delivery_orders); echo "</pre>";
        // echo "<pre>"; print_r($invoice_delivery_orders); echo "</pre>";
        // echo "<pre>"; print_r($delivery_orders); echo "</pre>";

        $total_do = array_merge($po_delivery_orders, $invoice_delivery_orders, $delivery_orders);

        // Extract the 'age' column to a separate array for sorting
        $dates = array_column($total_do, 'cr_date');

        // Use array_multisort to sort the original array based on the 'age' column
        array_multisort($dates, SORT_DESC, $total_do);

      
        $total_do_list = [];
        
        // Iterate through the result array and categorize items based on conditions
        
            if($do_status == 'due')
            {   foreach ($total_do as $item) {
                if (((int)$item['total_qty']-$item['return_qty']) === 0 || is_null(((int)$item['total_qty']-$item['return_qty']))) {
                    $item['status'] = 'due';
                    $total_do_list[] = $item;
                }
                }
            }else if($do_status == 'partial')
            {
                foreach ($total_do as $item) {
                if ((((int)$item['total_qty']-$item['return_qty']) != $item['items']) && ((int)$item['total_qty']-$item['return_qty']) != 0 ) {
                    $item['status'] = 'partial';
                    $total_do_list[] = $item;
                }
                }
            }else if($do_status == 'completed')
            {
                foreach ($total_do as $item) {
                if (((int)$item['total_qty']-$item['return_qty'])  == $item['items']) {
                    $item['status'] = 'completed';
                    $total_do_list[] = $item;
                }
                }
            }else{

                foreach ($total_do as $item) {
                    if (((int)$item['total_qty']-$item['return_qty']) === 0 || is_null(((int)$item['total_qty']-$item['return_qty']))) {
                        $item['status'] = 'due';
                        $total_do_list[] = $item;
                    }else if ((((int)$item['total_qty']-$item['return_qty']) != $item['items']) && ((int)$item['total_qty']-$item['return_qty']) != 0 ) {
                        $item['status'] = 'partial';
                        $total_do_list[] = $item;
                    }else if (((int)$item['total_qty']-$item['return_qty'])  == $item['items']) {
                        $item['status'] = 'completed';
                        $total_do_list[] = $item;
                    }
                    }
                
    
            }
          

        // echo "<pre>"; print_r($total_do_list); echo "</pre>";
        // exit;
        return $total_do_list;

    }


    public function get_delivery_orders_recieved_list($post){

        // /$do_type = $post['do_type'];
        $do_status = $post['do_status'];
        $do_start_date = $post['do_start_date'];
        $do_end_date = $post['do_end_date'];
        $search_invoice_id = $post['search_invoice_id'];

        $po_delivery_orders = array();
        $invoice_delivery_orders = array();
        $delivery_orders = array();
        
        $po_sql = 'SELECT ddi.po_id, ddi.invoice_id, gp.tid AS display_invoice_id, ddi.parent_do_id AS do_id, ddi.type AS do_type, MAX(ddi.cr_date) AS cr_date, CAST(MAX(gp.tid) AS SIGNED) AS tid, CAST(MAX(gp.items) AS SIGNED) AS items, COUNT(DISTINCT ddi.do_id) AS do_count, CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) AS total_qty, CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED) AS return_qty, (CAST(MAX(gp.items) AS SIGNED) - (CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) - CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED))) AS balance_qty FROM gtg_do_relations ddi LEFT JOIN gtg_purchase gp ON ddi.po_id = gp.id LEFT JOIN (SELECT parent_delivery_order_id, MAX(cr_date) AS max_cr_date, SUM(IFNULL(qty, 0)) AS qty, SUM(IFNULL(return_qty, 0)) AS return_qty FROM gtg_do_delivered_items GROUP BY parent_delivery_order_id) doi ON doi.parent_delivery_order_id = ddi.parent_do_id WHERE ddi.po_id != 0 ';
        if(!empty($do_start_date) && !empty($do_end_date)){ $po_sql .= ' AND DATE(ddi.cr_date) BETWEEN "' . $do_start_date . '" AND "' . $do_end_date . '" '; }
        if (!empty($search_invoice_id)) {
            $po_sql .= ' AND (ddi.parent_do_id = "' . $search_invoice_id . '" OR gp.tid = "' . $search_invoice_id . '")';
        }
        $po_result = $this->db->query($po_sql);
        $po_delivery_orders = $po_result->result_array();

        // echo $this->db->last_query();
        // exit;
        //if($do_type == 'all')
        //{
            // $po_sql = 'SELECT ddi.po_id, ddi.invoice_id,ddi.parent_do_id as do_id, ddi.type as do_type, MAX(ddi.cr_date) as cr_date, MAX(gp.tid) as tid, MAX(gp.items) as items, SUM(doi.qty) as total_qty, ( SELECT COALESCE(SUM(doi.return_qty), 0) FROM gtg_do_delivered_items doi WHERE doi.parent_delivery_order_id = ddi.parent_do_id ) AS return_qty  FROM gtg_do_relations ddi LEFT JOIN gtg_purchase gp ON ddi.po_id = gp.id LEFT JOIN gtg_do_delivered_items doi ON doi.parent_delivery_order_id = ddi.parent_do_id WHERE ddi.po_id != 0 ';
            // if(!empty($do_date)){ $po_sql .= ' AND DATE(ddi.cr_date) = "'.$do_date.'" '; } 
            // $po_sql .= ' GROUP BY ddi.parent_do_id, ddi.type'; 
            // $po_result = $this->db->query($po_sql);
            // $po_delivery_orders = $po_result->result_array();

            // $po_sql = 'SELECT ddi.po_id, ddi.invoice_id, gp.tid AS display_invoice_id, ddi.parent_do_id AS do_id, ddi.type AS do_type, MAX(ddi.cr_date) AS cr_date, CAST(MAX(gp.tid) AS SIGNED) AS tid, CAST(MAX(gp.items) AS SIGNED) AS items, COUNT(DISTINCT ddi.do_id) AS do_count, CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) AS total_qty, CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED) AS return_qty, (CAST(MAX(gp.items) AS SIGNED) - (CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) - CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED))) AS balance_qty FROM gtg_do_relations ddi LEFT JOIN gtg_purchase gp ON ddi.po_id = gp.id LEFT JOIN (SELECT parent_delivery_order_id, MAX(cr_date) AS max_cr_date, SUM(IFNULL(qty, 0)) AS qty, SUM(IFNULL(return_qty, 0)) AS return_qty FROM gtg_do_delivered_items GROUP BY parent_delivery_order_id) doi ON doi.parent_delivery_order_id = ddi.parent_do_id WHERE ddi.po_id != 0 GROUP BY ddi.parent_do_id, ddi.type ';
            // if(!empty($do_start_date) && !empty($do_end_date)){ $po_sql .= ' AND DATE(ddi.cr_date) BETWEEN "' . $do_start_date . '" AND "' . $do_end_date . '" '; }
            // if (!empty($search_invoice_id)) {
            //     $po_sql .= ' AND (ddi.parent_do_id = "' . $search_invoice_id . '" OR gp.tid = "' . $search_invoice_id . '")';
            // }
            // $po_result = $this->db->query($po_sql);
            // $po_delivery_orders = $po_result->result_array();

            

            // $invoice_sql = 'SELECT ddi.po_id, ddi.invoice_id, gp.tid AS display_invoice_id, ddi.parent_do_id AS do_id, ddi.type AS do_type, MAX(ddi.cr_date) AS cr_date, CAST(MAX(gp.tid) AS SIGNED) AS tid, CAST(MAX(gp.items) AS SIGNED) AS items, COUNT(DISTINCT ddi.do_id) AS do_count, CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) AS total_qty, CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED) AS return_qty, (CAST(MAX(gp.items) AS SIGNED) - (CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) - CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED))) AS balance_qty FROM gtg_do_relations ddi LEFT JOIN gtg_invoices gp ON ddi.invoice_id = gp.id LEFT JOIN (SELECT parent_delivery_order_id, MAX(cr_date) AS max_cr_date, SUM(IFNULL(qty, 0)) AS qty, SUM(IFNULL(return_qty, 0)) AS return_qty FROM gtg_do_delivered_items GROUP BY parent_delivery_order_id) doi ON doi.parent_delivery_order_id = ddi.parent_do_id WHERE ddi.invoice_id != 0  ';
            // if(!empty($do_start_date) && !empty($do_end_date)){ $invoice_sql .= ' AND DATE(ddi.cr_date) BETWEEN "' . $do_start_date . '" AND "' . $do_end_date . '" '; }
            // if (!empty($search_invoice_id)) {
            //     $invoice_sql .= ' AND (ddi.parent_do_id = "' . $search_invoice_id . '" OR gp.tid = "' . $search_invoice_id . '")';
            // }
            // $invoice_sql .= ' GROUP BY ddi.parent_do_id, ddi.type'; 
            // $invoice_result = $this->db->query($invoice_sql);
            // $invoice_delivery_orders = $invoice_result->result_array();
            
            // $do_sql = 'SELECT "do" AS do_type,tid as do_id,cr_date,tid,items,items as total_qty FROM gtg_delivery_orders';
            // if(!empty($do_date)){ $do_sql .= ' WHERE DATE(cr_date) = "'.$do_date.'" '; }
            // $do_result = $this->db->query($do_sql);
            // $delivery_orders = $do_result->result_array();

        // }else if($do_type == 'po')
        // {
        //     $po_sql = 'SELECT ddi.po_id, ddi.invoice_id, gp.tid AS display_invoice_id, ddi.parent_do_id AS do_id, ddi.type AS do_type, MAX(ddi.cr_date) AS cr_date, CAST(MAX(gp.tid) AS SIGNED) AS tid, CAST(MAX(gp.items) AS SIGNED) AS items, COUNT(DISTINCT ddi.do_id) AS do_count, CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) AS total_qty, CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED) AS return_qty, (CAST(MAX(gp.items) AS SIGNED) - (CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) - CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED))) AS balance_qty FROM gtg_do_relations ddi LEFT JOIN gtg_purchase gp ON ddi.po_id = gp.id LEFT JOIN (SELECT parent_delivery_order_id, MAX(cr_date) AS max_cr_date, SUM(IFNULL(qty, 0)) AS qty, SUM(IFNULL(return_qty, 0)) AS return_qty FROM gtg_do_delivered_items GROUP BY parent_delivery_order_id) doi ON doi.parent_delivery_order_id = ddi.parent_do_id WHERE ddi.po_id != 0 GROUP BY ddi.parent_do_id, ddi.type ';
        //     if(!empty($do_start_date) && !empty($do_end_date)){ $po_sql .= ' AND DATE(ddi.cr_date) BETWEEN "' . $do_start_date . '" AND "' . $do_end_date . '" '; }
        //     if (!empty($search_invoice_id)) {
        //         $po_sql .= ' AND (ddi.parent_do_id = "' . $search_invoice_id . '" OR gp.tid = "' . $search_invoice_id . '")';
        //     }
        //     $po_result = $this->db->query($po_sql);
        //     $po_delivery_orders = $po_result->result_array();

                     

        // }else if($do_type == 'invoice')
        // {
        //     // $invoice_sql = 'SELECT ddi.po_id, ddi.invoice_id, gp.tid AS display_invoice_id, ddi.parent_do_id AS do_id, ddi.type AS do_type, MAX(ddi.cr_date) AS cr_date, CAST(MAX(gp.tid) AS SIGNED) AS tid, CAST(MAX(gp.items) AS SIGNED) AS items, COUNT(DISTINCT ddi.do_id) AS do_count, CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) AS total_qty, CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED) AS return_qty, (CAST(MAX(gp.items) AS SIGNED) - (CAST(SUM(DISTINCT IFNULL(doi.qty, 0)) AS SIGNED) - CAST(SUM(DISTINCT IFNULL(doi.return_qty, 0)) AS SIGNED))) AS balance_qty FROM gtg_do_relations ddi LEFT JOIN gtg_invoices gp ON ddi.invoice_id = gp.id LEFT JOIN (SELECT parent_delivery_order_id, MAX(cr_date) AS max_cr_date, SUM(IFNULL(qty, 0)) AS qty, SUM(IFNULL(return_qty, 0)) AS return_qty FROM gtg_do_delivered_items GROUP BY parent_delivery_order_id) doi ON doi.parent_delivery_order_id = ddi.parent_do_id WHERE ddi.invoice_id != 0  ';
        //     // if(!empty($do_start_date) && !empty($do_end_date)){ $invoice_sql .= ' AND DATE(ddi.cr_date) BETWEEN "' . $do_start_date . '" AND "' . $do_end_date . '" '; }
        //     // if (!empty($search_invoice_id)) {
        //     //     $invoice_sql .= ' AND (ddi.parent_do_id = "' . $search_invoice_id . '" OR gp.tid = "' . $search_invoice_id . '")';
        //     // }
        //     // $invoice_sql .= ' GROUP BY ddi.parent_do_id, ddi.type'; 
        //     // $invoice_result = $this->db->query($invoice_sql);
        //     // $invoice_delivery_orders = $invoice_result->result_array();

        // }else if($do_type == 'do')
        // {
        //     $do_sql = 'SELECT "do" AS do_type,tid as do_id,cr_date,tid,items,items as total_qty FROM gtg_delivery_orders';
        //     if(!empty($do_date)){ $do_sql .= ' WHERE DATE(cr_date) = "'.$do_date.'" '; }
        //     $do_result = $this->db->query($do_sql);
        //     $delivery_orders = $do_result->result_array();       

        // }
        
        // echo "<pre>"; print_r($po_delivery_orders); echo "</pre>";
        // echo "<pre>"; print_r($invoice_delivery_orders); echo "</pre>";
        // echo "<pre>"; print_r($delivery_orders); echo "</pre>";

        //$total_do = array_merge($po_delivery_orders, $invoice_delivery_orders, $delivery_orders);

        // Extract the 'age' column to a separate array for sorting
        $dates = array_column($po_delivery_orders, 'cr_date');

        // Use array_multisort to sort the original array based on the 'age' column
        array_multisort($dates, SORT_DESC, $po_delivery_orders);

      
        $total_do_list = [];
        
        // Iterate through the result array and categorize items based on conditions
        
            if($do_status == 'due')
            {   foreach ($po_delivery_orders as $item) {
                if (((int)$item['total_qty']-$item['return_qty']) === 0 || is_null(((int)$item['total_qty']-$item['return_qty']))) {
                    $item['status'] = 'due';
                    $total_do_list[] = $item;
                }
                }
            }else if($do_status == 'partial')
            {
                foreach ($po_delivery_orders as $item) {
                if ((((int)$item['total_qty']-$item['return_qty']) != $item['items']) && ((int)$item['total_qty']-$item['return_qty']) != 0 ) {
                    $item['status'] = 'partial';
                    $total_do_list[] = $item;
                }
                }
            }else if($do_status == 'completed')
            {
                foreach ($po_delivery_orders as $item) {
                if (((int)$item['total_qty']-$item['return_qty'])  == $item['items']) {
                    $item['status'] = 'completed';
                    $total_do_list[] = $item;
                }
                }
            }else{

                foreach ($po_delivery_orders as $item) {
                    if (((int)$item['total_qty']-$item['return_qty']) === 0 || is_null(((int)$item['total_qty']-$item['return_qty']))) {
                        $item['status'] = 'due';
                        $total_do_list[] = $item;
                    }else if ((((int)$item['total_qty']-$item['return_qty']) != $item['items']) && ((int)$item['total_qty']-$item['return_qty']) != 0 ) {
                        $item['status'] = 'partial';
                        $total_do_list[] = $item;
                    }else if (((int)$item['total_qty']-$item['return_qty'])  == $item['items']) {
                        $item['status'] = 'completed';
                        $total_do_list[] = $item;
                    }
                    }
                
    
            }
          

        // echo "<pre>"; print_r($total_do_list); echo "</pre>";
        // exit;
        return $total_do_list;

    }

}