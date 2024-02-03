<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/vendor/autoload.php';

use Omnipay\Omnipay;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;


class Billing extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->config->set_item('csrf_protection', false);
        $this->load->model('invoices_model', 'invocies');
        $this->load->model('billing_model', 'billing');
        $this->load->model('customers_model', 'customers');
        $this->load->model('settings_model', 'adminemail');
        $this->load->model('communication_model');        
        $this->load->model('contract_model');
        $this->load->model('digitalsignature_model');
        $this->load->model('uploads_model');
        $this->load->library("Aauth");
        $this->load->library("Custom");

    }

    public function view()
    {
        if (!$this->input->get()) {
            exit();
        }
        $tid = $this->input->get('id');
        $token = $this->input->get('token');
        $validtoken = hash_hmac('ripemd160', $tid, $this->config->item('encryption_key'));
        if (hash_equals($token, $validtoken)) {
            $this->load->model('accounts_model');
            $data['id'] = $tid;
            $data['token'] = $token;

            $data['invoice'] = $this->invocies->invoice_details($tid, '', false);
            $data['acclist'] = $this->accounts_model->accountslist(false . $data['invoice']['loc']);
            $data['online_pay'] = $this->billing->online_pay_settings();
            $data['products'] = $this->invocies->invoice_products($tid);
            $data['activity'] = $this->invocies->invoice_transactions($tid);
            $data['attach'] = $this->invocies->attach($tid);
            if (CUSTOM) {
                $data['c_custom_fields'] = $this->custom->view_fields_data($data['invoice']['cid'], 1, 1);
            }

            $data['gateway'] = $this->billing->gateway_list('Yes');

            $data['employee'] = $this->invocies->employee($data['invoice']['eid']);
            // $data['customers']=$this->aauth->get_user()->roleid;
            //   if(isset($this->session->userdata('user_details')[0]->cid))
            $data['customers'] = $this->customers->mydetails($data['invoice']['cid']);
            $head['usernm'] = '';
            $head['title'] = $this->lang->line('Invoice') . $data['invoice']['tid'];

            $this->load->view('billing/header', $head);
            $this->load->view('billing/view', $data);
            $this->load->view('billing/footer');
        }
    }

    public function quoteview()
    {
        if (!$this->input->get()) {
            exit();
        }
        $tid = intval($this->input->get('id'));
        $token = $this->input->get('token');
        $validtoken = hash_hmac('ripemd160', 'q' . $tid, $this->config->item('encryption_key'));
        if (hash_equals($token, $validtoken)) {
            $this->load->model('quote_model', 'quote');
            $this->load->model('accounts_model');
            $data['acclist'] = $this->accounts_model->accountslist();
            $tid = intval($this->input->get('id'));
            $data['id'] = $tid;
            $data['token'] = $token;
            $data['invoice'] = $this->quote->quote_details($tid);
            $data['attach'] = $this->quote->attach($tid);
            $data['products'] = $this->quote->quote_products($tid);
            $data['employee'] = $this->quote->employee($data['invoice']['eid']);
            $head['title'] = $this->lang->line('Quote') . $data['invoice']['tid'];
            $head['usernm'] = '';
            $this->load->view('billing/header', $head);
            $this->load->view('billing/quoteview', $data);
            $this->load->view('billing/footer');
        }

    }

    public function purchase()
    {
        if (!$this->input->get()) {
            exit();
        }
        $tid = intval($this->input->get('id'));
        $token = $this->input->get('token');
        $validtoken = hash_hmac('ripemd160', 'p' . $tid, $this->config->item('encryption_key'));
        if (hash_equals($token, $validtoken)) {
            $this->load->model('purchase_model', 'purchase');
            $this->load->model('accounts_model');
            $data['acclist'] = $this->accounts_model->accountslist();
            $data['attach'] = $this->purchase->attach($tid);
            $tid = intval($this->input->get('id'));
            $data['id'] = $tid;
            $data['token'] = $token;
            $data['invoice'] = $this->purchase->purchase_details($tid);
            // $data['online_pay'] = $this->purchase->online_pay_settings();
            $data['products'] = $this->purchase->purchase_products($tid);
            $data['activity'] = $this->purchase->purchase_transactions($tid);
            $head['title'] = $this->lang->line('Purchase') . $data['invoice']['tid'];
            $data['employee'] = $this->purchase->employee($data['invoice']['eid']);
            $head['usernm'] = '';
            $this->load->view('billing/header', $head);
            $this->load->view('billing/purchase', $data);
            $this->load->view('billing/footer');
        }
    }

    public function stockreturn()
    {
        if (!$this->input->get()) {
            exit();
        }
        $tid = intval($this->input->get('id'));
        $token = $this->input->get('token');
        $validtoken = hash_hmac('ripemd160', 's' . $tid, $this->config->item('encryption_key'));
        if (hash_equals($token, $validtoken)) {
            $this->load->model('stockreturn_model', 'stockreturn');
            $this->load->model('accounts_model');
            $data['acclist'] = $this->accounts_model->accountslist();
            $data['attach'] = $this->stockreturn->attach($tid);
            $tid = intval($this->input->get('id'));
            $data['id'] = $tid;
            $data['token'] = $token;
            $data['invoice'] = $this->stockreturn->purchase_details($tid);
            // $data['online_pay'] = $this->purchase->online_pay_settings();
            $data['products'] = $this->stockreturn->purchase_products($tid);
            $data['activity'] = $this->stockreturn->purchase_transactions($tid);
            $head['title'] = $this->lang->line('Order') . $data['invoice']['tid'];
            $data['employee'] = $this->stockreturn->employee($data['invoice']['eid']);
            $head['usernm'] = '';
            $this->load->view('billing/header', $head);
            $this->load->view('billing/stockreturn', $data);
            $this->load->view('billing/footer');
        }
    }

    public function gateway()
    {
        if (!$this->input->get()) {
            exit();
        }
        $tid = intval($this->input->post('tid'));
        $token = $this->input->post('token');
        $amount = $this->input->post('p_amount');
        $pay_gateway = $this->input->post('pay_gateway');
        $validtoken = hash_hmac('ripemd160', $tid, $this->config->item('encryption_key'));
        if (hash_equals($token, $validtoken)) {
            switch ($pay_gateway) {
                case 1:
                    $this->card();
                    break;
            }
        }
    }

    public function printinvoice()
    {
        if (!$this->input->get()) {
            exit();
        }
        $tid = intval($this->input->get('id'));
        $token = $this->input->get('token');
        $validtoken = hash_hmac('ripemd160', $tid, $this->config->item('encryption_key'));
        if (hash_equals($token, $validtoken)) {
            $data['id'] = $tid;
            $data['invoice'] = $this->invocies->invoice_details($tid);
            $data['title'] =  $this->lang->line('Invoice') . $data['invoice']['tid'];
            $data['products'] = $this->invocies->invoice_products($tid);
            $data['employee'] = $this->invocies->employee($data['invoice']['eid']);
            if (CUSTOM) {
                $data['c_custom_fields'] = $this->custom->view_fields_data($data['invoice']['cid'], 1, 1);
                $data['i_custom_fields'] = $this->custom->view_fields_data($tid, 2, 1);
            }

            $data['round_off'] = $this->custom->api_config(4);
            if ($data['invoice']['i_class'] == 1) {
                $pref = prefix(7);
            } elseif ($data['invoice']['i_class'] > 1) {
                $pref = prefix(3);
            } else {
                $pref = $this->config->item('prefix');
            }
            $data['general'] = array('title' => $this->lang->line('Invoice'), 'person' => $this->lang->line('Customer'), 'prefix' => $pref, 't_type' => 0);
            ini_set('memory_limit', '64M');
            if ($data['invoice']['taxstatus'] == 'cgst' || $data['invoice']['taxstatus'] == 'igst') {
                $html = $this->load->view('print_files/invoice-a4-gst_v' . INVV, $data, true);
            } else {
                $html = $this->load->view('print_files/invoice-a4_v' . INVV, $data, true);
                //    $html=str_replace("strong","span",$html);
                //     $html=str_replace("<h","<span",$html);
            }

            // echo $html;
            // exit;
            //PDF Rendering
            $this->load->library('pdf');
            if (INVV == 1) {
                $header = $this->load->view('print_files/invoice-header_v' . INVV, $data, true);
                //  $header=str_replace("<h","<span",$header);
                $pdf = $this->pdf->load_split(array('margin_top' => 40));
                $pdf->SetHTMLHeader($header);
            }
            if (INVV == 2) {
                $pdf = $this->pdf->load_split(array('margin_top' => 5));
            }
            $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:-6pt;">{PAGENO}/{nbpg} #' . $data['invoice']['tid'] . '</div>');
            $pdf->WriteHTML($html);
            if ($this->input->get('d')) {
                $pdf->Output('Invoice_#' . $data['invoice']['tid'] . '.pdf', 'D');
            } else {
                $pdf->Output('Invoice_#' . $data['invoice']['tid'] . '.pdf', 'I');
            }
        }
    }

    public function printdo()
    {

        $this->load->model('purchase_model', 'purchase');
        $this->load->model('invoices_model', 'invocies');
        $this->load->library("Aauth");        
        $this->load->library("Custom");
        
        if (!$this->input->get()) {
            exit();
        }
        $tid = intval($this->input->get('id'));
        $token = $this->input->get('token');
        $type = $this->input->get('type');
        $p_do_id = $this->input->get('do_id');

        if ($type == 'invoice') {
            // echo "adfsdfs";
            // exit;
            $validtoken = hash_hmac('ripemd160', $tid, $this->config->item('encryption_key'));
            if (hash_equals($token, $validtoken)) {
                $data['id'] = $tid;

                $sql = "SELECT parent_do_id, GROUP_CONCAT(DISTINCT CONCAT(do_id, '#', cr_date) ORDER BY cr_date ASC) AS do_ids_and_dates, MAX(type) AS do_type, MAX(cr_date) AS max_cr_date, MAX(po_id) AS max_po_id, MAX(invoice_id) AS max_invoice_id FROM gtg_do_relations WHERE parent_do_id = '$p_do_id' GROUP BY parent_do_id ";
                $result = $this->db->query($sql);
                $parent_delivery_orders = $result->result_array();
                // /echo $this->db->last_query();

                // echo "<pre>"; print_r($parent_delivery_orders); echo "</pre>";
                // exit;

                foreach ($parent_delivery_orders as $row) {
                    // Explode do_ids into an array

                    if ($row['do_type'] == 'po') {
                        $data['invoice'] = $this->purchase->purchase_details($row['max_po_id']);

                    } else if ($row['do_type'] == 'invoice') {

                        $data['invoice'] = $this->invocies->invoice_details($row['max_invoice_id'], $this->limited);
                    }

                    $data['c_custom_fields'] = $this->custom->view_fields_data($data['invoice']['cid'], 1);
                    $doIdsArray = explode(',', $row['do_ids_and_dates']);
                    $parent_delivery_order_id = $row['parent_do_id'];
                    // print_r($doIdsArray);
                    // exit;
                    // Fetch individual cr_dates based on do_ids

                    // Iterate over the do_ids array
                    foreach ($doIdsArray as $doId) {
                        // Create an array for each iteration

                        $do_data = explode('#', $doId);
                        // print_r($do_data);
                        $delivery_order_id = $do_data[0];
                        $cr_date = $do_data[1];

                        if ($row['do_type'] == 'po') {

                            // $po_sql = 'SELECT ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product FROM gtg_do_delivered_items ddi LEFT JOIN gtg_purchase_items gp ON ddi.p_id = gp.id WHERE ddi.delivery_order_id = '.$delivery_order_id.' AND ddi.parent_delivery_order_id = '.$parent_delivery_order_id.'';
                            // $po_result = $this->db->query($po_sql);
                            // $delivery_orders = $po_result->result_array();

                        } else if ($row['do_type'] == 'invoice') {
                            $po_sql = 'SELECT ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product,gp.qty as ordered_qty FROM gtg_do_delivered_items ddi LEFT JOIN gtg_invoice_items gp ON ddi.p_id = gp.pid WHERE ddi.delivery_order_id = ' . $delivery_order_id . ' AND ddi.parent_delivery_order_id = ' . $parent_delivery_order_id . '';
                            $po_result = $this->db->query($po_sql);
                            $delivery_orders = $po_result->result_array();

                        } else if ($row['do_type'] == 'do') {
                            $do_sql = 'SELECT qty as delivered_qty, "do" as do_type, product FROM gtg_delivery_order_items ';
                            $do_result = $this->db->query($do_sql);
                            $delivery_orders = $do_result->result_array();

                        }

                        // Use the corresponding cr_date based on the key
                        //$cr_date = isset($crDatesArray[$key]) ? $crDatesArray[$key] : null;

                        $iterationData = [
                            'parent_do_id' => $row['parent_do_id'],
                            'do_id' => $delivery_order_id,
                            'cr_date' => $cr_date,
                            'do_type' => $row['do_type'],
                            'max_po_id' => $row['max_po_id'],
                            'max_invoice_id' => $row['max_invoice_id'],
                            'delivery_order' => $delivery_orders,
                        ];

                        // Add the array to the output data
                        $outputData[] = $iterationData;
                    }

                }

                $data['do_list'] = $outputData;
                $data['do_option'] = $do_option;
                $data['do_type'] = $do_type;

                $data['general'] = array('title' => $this->lang->line('Invoice'), 'person' => $this->lang->line('Customer'), 'prefix' => $pref, 't_type' => 0);
                ini_set('memory_limit', '64M');
                if ($data['invoice']['taxstatus'] == 'cgst' || $data['invoice']['taxstatus'] == 'igst') {
                    $html = $this->load->view('print_files/invoice-a4-gst_v' . INVV, $data, true);
                } else {
                    $html = $this->load->view('print_files/do-a4_v' . INVV, $data, true);
                    //    $html=str_replace("strong","span",$html);
                    //     $html=str_replace("<h","<span",$html);
                }

                // echo $html;
                // exit;
                //PDF Rendering
                $this->load->library('pdf');
                if (INVV == 1) {
                    $header = $this->load->view('print_files/do-header_v' . INVV, $data, true);

                    //  $header=str_replace("<h","<span",$header);
                    $pdf = $this->pdf->load_split(array('margin_top' => 40));
                    $pdf->SetHTMLHeader($header);
                }
                if (INVV == 2) {
                    $pdf = $this->pdf->load_split(array('margin_top' => 5));
                }
                $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:-6pt;">{PAGENO}/{nbpg} #' . $data['invoice']['tid'] . '</div>');
                $pdf->WriteHTML($html);
                if ($this->input->get('d')) {
                    $pdf->Output('Invoice_#' . $data['invoice']['tid'] . '.pdf', 'D');
                } else {
                    $pdf->Output('Invoice_#' . $data['invoice']['tid'] . '.pdf', 'I');
                }
            }

        } else if ($type == 'po') {

            $validtoken = hash_hmac('ripemd160', 'p' . $tid, $this->config->item('encryption_key'));

            if (hash_equals($token, $validtoken)) {
                
                $data['id'] = $tid;

                $sql = "SELECT parent_do_id, GROUP_CONCAT(DISTINCT CONCAT(do_id, '#', cr_date) ORDER BY cr_date ASC) AS do_ids_and_dates, MAX(type) AS do_type, MAX(cr_date) AS max_cr_date, MAX(po_id) AS max_po_id, MAX(invoice_id) AS max_invoice_id FROM gtg_do_relations WHERE parent_do_id = '$p_do_id' GROUP BY parent_do_id ";
                $result = $this->db->query($sql);
                $parent_delivery_orders = $result->result_array();
                // /echo $this->db->last_query();

                // echo "<pre>"; print_r($parent_delivery_orders); echo "</pre>";
                // exit;

                foreach ($parent_delivery_orders as $row) {
                    // Explode do_ids into an array

                    if ($row['do_type'] == 'po') {
                        $data['invoice'] = $this->purchase->purchase_details($row['max_po_id']);

                    } else if ($row['do_type'] == 'invoice') {

                        $data['invoice'] = $this->invocies->invoice_details($row['max_invoice_id'], $this->limited);
                    }

                    $data['c_custom_fields'] = $this->custom->view_fields_data($data['invoice']['cid'], 1);
                    $doIdsArray = explode(',', $row['do_ids_and_dates']);
                    $parent_delivery_order_id = $row['parent_do_id'];
                    // print_r($doIdsArray);
                    // exit;
                    // Fetch individual cr_dates based on do_ids

                    // Iterate over the do_ids array
                    foreach ($doIdsArray as $doId) {
                        // Create an array for each iteration

                        $do_data = explode('#', $doId);
                        // print_r($do_data);
                        $delivery_order_id = $do_data[0];
                        $cr_date = $do_data[1];

                        if ($row['do_type'] == 'po') {

                            // $po_sql = 'SELECT ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product FROM gtg_do_delivered_items ddi LEFT JOIN gtg_purchase_items gp ON ddi.p_id = gp.id WHERE ddi.delivery_order_id = '.$delivery_order_id.' AND ddi.parent_delivery_order_id = '.$parent_delivery_order_id.'';
                            // $po_result = $this->db->query($po_sql);
                            // $delivery_orders = $po_result->result_array();
                            $po_sql = 'SELECT ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product,gp.qty as ordered_qty FROM gtg_do_delivered_items ddi LEFT JOIN gtg_purchase_items gp ON ddi.p_id = gp.pid WHERE ddi.delivery_order_id = ' . $delivery_order_id . ' AND ddi.parent_delivery_order_id = ' . $parent_delivery_order_id . '';
                            $po_result = $this->db->query($po_sql);
                            $delivery_orders = $po_result->result_array();


                        } else if ($row['do_type'] == 'invoice') {
                            $po_sql = 'SELECT ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product,gp.qty as ordered_qty FROM gtg_do_delivered_items ddi LEFT JOIN gtg_invoice_items gp ON ddi.p_id = gp.pid WHERE ddi.delivery_order_id = ' . $delivery_order_id . ' AND ddi.parent_delivery_order_id = ' . $parent_delivery_order_id . '';
                            $po_result = $this->db->query($po_sql);
                            $delivery_orders = $po_result->result_array();

                        } else if ($row['do_type'] == 'do') {
                            $do_sql = 'SELECT qty as delivered_qty, "do" as do_type, product FROM gtg_delivery_order_items ';
                            $do_result = $this->db->query($do_sql);
                            $delivery_orders = $do_result->result_array();

                        }

                        // Use the corresponding cr_date based on the key
                        //$cr_date = isset($crDatesArray[$key]) ? $crDatesArray[$key] : null;

                        $iterationData = [
                            'parent_do_id' => $row['parent_do_id'],
                            'do_id' => $delivery_order_id,
                            'cr_date' => $cr_date,
                            'do_type' => $row['do_type'],
                            'max_po_id' => $row['max_po_id'],
                            'max_invoice_id' => $row['max_invoice_id'],
                            'delivery_order' => $delivery_orders,
                        ];

                        // Add the array to the output data
                        $outputData[] = $iterationData;
                    }

                }

                $data['do_list'] = $outputData;
                $data['do_option'] = $do_option;
                $data['do_type'] = $do_type;

                $data['general'] = array('title' => $this->lang->line('Invoice'), 'person' => $this->lang->line('Customer'), 'prefix' => $pref, 't_type' => 0);
                ini_set('memory_limit', '64M');
                if ($data['invoice']['taxstatus'] == 'cgst' || $data['invoice']['taxstatus'] == 'igst') {
                    $html = $this->load->view('print_files/invoice-a4-gst_v' . INVV, $data, true);
                } else {
                    $html = $this->load->view('print_files/do-a4_v' . INVV, $data, true);
                    //    $html=str_replace("strong","span",$html);
                    //     $html=str_replace("<h","<span",$html);
                }

                // echo $html;
                // exit;
                //PDF Rendering
                $this->load->library('pdf');
                if (INVV == 1) {
                    $header = $this->load->view('print_files/do-header_v' . INVV, $data, true);

                    //  $header=str_replace("<h","<span",$header);
                    $pdf = $this->pdf->load_split(array('margin_top' => 40));
                    $pdf->SetHTMLHeader($header);
                }
                if (INVV == 2) {
                    $pdf = $this->pdf->load_split(array('margin_top' => 5));
                }
                $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:-6pt;">{PAGENO}/{nbpg} #' . $data['invoice']['tid'] . '</div>');
                $pdf->WriteHTML($html);
                if ($this->input->get('d')) {
                    $pdf->Output('Invoice_#' . $data['invoice']['tid'] . '.pdf', 'D');
                } else {
                    $pdf->Output('Invoice_#' . $data['invoice']['tid'] . '.pdf', 'I');
                }
            }

            }
    
        }
 

    public function printsubdo()
    {
        if (!$this->input->get()) {
            exit();
        }
        $tid = intval($this->input->get('id'));
        $token = $this->input->get('token');
        $type = $this->input->get('type');
        $p_do_id = $this->input->get('do_id');
        $sub_do_id = $this->input->get('sub_do_id');

        if ($type == 'invoice') {
            // echo "adfsdfs";
            // exit;
            $validtoken = hash_hmac('ripemd160', $tid, $this->config->item('encryption_key'));
            if (hash_equals($token, $validtoken)) {
                $data['id'] = $tid;

                $sql = "SELECT parent_do_id, GROUP_CONCAT(DISTINCT CONCAT(do_id, '#', cr_date) ORDER BY cr_date ASC) AS do_ids_and_dates, MAX(type) AS do_type, MAX(cr_date) AS max_cr_date, MAX(po_id) AS max_po_id, MAX(invoice_id) AS max_invoice_id FROM gtg_do_relations WHERE parent_do_id = '$p_do_id' AND do_id = '$sub_do_id' GROUP BY parent_do_id ";
                $result = $this->db->query($sql);
                $parent_delivery_orders = $result->result_array();
                // /echo $this->db->last_query();

                // echo "<pre>"; print_r($parent_delivery_orders); echo "</pre>";
                // exit;

                foreach ($parent_delivery_orders as $row) {
                    // Explode do_ids into an array

                    if ($row['do_type'] == 'po') {
                        $data['invoice'] = $this->purchase->purchase_details($row['max_po_id']);

                    } else if ($row['do_type'] == 'invoice') {

                        $data['invoice'] = $this->invocies->invoice_details($row['max_invoice_id'], $this->limited);
                    }

                    $data['c_custom_fields'] = $this->custom->view_fields_data($data['invoice']['cid'], 1);

                    $doIdsArray = explode(',', $row['do_ids_and_dates']);
                    $parent_delivery_order_id = $row['parent_do_id'];
                    // print_r($doIdsArray);
                    // exit;
                    // Fetch individual cr_dates based on do_ids

                    // Iterate over the do_ids array
                    foreach ($doIdsArray as $doId) {
                        // Create an array for each iteration

                        $do_data = explode('#', $doId);
                        // print_r($do_data);
                        $delivery_order_id = $do_data[0];
                        $cr_date = $do_data[1];

                        if ($row['do_type'] == 'po') {

                            // $po_sql = 'SELECT ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product FROM gtg_do_delivered_items ddi LEFT JOIN gtg_purchase_items gp ON ddi.p_id = gp.id WHERE ddi.delivery_order_id = '.$delivery_order_id.' AND ddi.parent_delivery_order_id = '.$parent_delivery_order_id.'';
                            // $po_result = $this->db->query($po_sql);
                            // $delivery_orders = $po_result->result_array();

                        } else if ($row['do_type'] == 'invoice') {
                            $po_sql = 'SELECT ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product,gp.qty as ordered_qty FROM gtg_do_delivered_items ddi LEFT JOIN gtg_invoice_items gp ON ddi.p_id = gp.pid WHERE ddi.delivery_order_id = ' . $delivery_order_id . ' AND ddi.parent_delivery_order_id = ' . $parent_delivery_order_id . '';
                            $po_result = $this->db->query($po_sql);
                            $delivery_orders = $po_result->result_array();

                        } else if ($row['do_type'] == 'do') {
                            $do_sql = 'SELECT qty as delivered_qty, "do" as do_type, product FROM gtg_delivery_order_items ';
                            $do_result = $this->db->query($do_sql);
                            $delivery_orders = $do_result->result_array();

                        }

                        // Use the corresponding cr_date based on the key
                        //$cr_date = isset($crDatesArray[$key]) ? $crDatesArray[$key] : null;

                        $iterationData = [
                            'parent_do_id' => $row['parent_do_id'],
                            'do_id' => $delivery_order_id,
                            'cr_date' => $cr_date,
                            'do_type' => $row['do_type'],
                            'max_po_id' => $row['max_po_id'],
                            'max_invoice_id' => $row['max_invoice_id'],
                            'delivery_order' => $delivery_orders,
                        ];

                        // Add the array to the output data
                        $outputData[] = $iterationData;
                    }

                }

                $data['do_list'] = $outputData;
                $data['do_option'] = $do_option;
                $data['do_type'] = $do_type;

                $data['general'] = array('title' => $this->lang->line('Invoice'), 'person' => $this->lang->line('Customer'), 'prefix' => $pref, 't_type' => 0);
                ini_set('memory_limit', '64M');
                if ($data['invoice']['taxstatus'] == 'cgst' || $data['invoice']['taxstatus'] == 'igst') {
                    $html = $this->load->view('print_files/invoice-a4-gst_v' . INVV, $data, true);
                } else {
                    $html = $this->load->view('print_files/subdo-a4_v' . INVV, $data, true);
                    //    $html=str_replace("strong","span",$html);
                    //     $html=str_replace("<h","<span",$html);
                }

                // echo $html;
                // exit;
                //PDF Rendering
                $this->load->library('pdf');
                if (INVV == 1) {
                    $header = $this->load->view('print_files/do-header_v' . INVV, $data, true);

                    //  $header=str_replace("<h","<span",$header);
                    $pdf = $this->pdf->load_split(array('margin_top' => 40));
                    $pdf->SetHTMLHeader($header);
                }
                if (INVV == 2) {
                    $pdf = $this->pdf->load_split(array('margin_top' => 5));
                }
                $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:-6pt;">{PAGENO}/{nbpg} #' . $data['invoice']['tid'] . '</div>');
                $pdf->WriteHTML($html);
                if ($this->input->get('d')) {
                    $pdf->Output('Invoice_#' . $data['invoice']['tid'] . '.pdf', 'D');
                } else {
                    $pdf->Output('Invoice_#' . $data['invoice']['tid'] . '.pdf', 'I');
                }
            }

        } else if ($type == 'po') {

            $validtoken = hash_hmac('ripemd160', 'p' . $tid, $this->config->item('encryption_key'));

            if (hash_equals($token, $validtoken)) {
                $this->load->model('purchase_model', 'purchase');

                $data['id'] = $tid;

                $sql = "SELECT parent_do_id, GROUP_CONCAT(DISTINCT CONCAT(do_id, '#', cr_date) ORDER BY cr_date ASC) AS do_ids_and_dates, MAX(type) AS do_type, MAX(cr_date) AS max_cr_date, MAX(po_id) AS max_po_id, MAX(invoice_id) AS max_invoice_id FROM gtg_do_relations WHERE parent_do_id = '$p_do_id' AND do_id = '$sub_do_id' GROUP BY parent_do_id ";
                $result = $this->db->query($sql);
                $parent_delivery_orders = $result->result_array();
                // /echo $this->db->last_query();

                // echo "<pre>"; print_r($parent_delivery_orders); echo "</pre>";
                // exit;

                foreach ($parent_delivery_orders as $row) {
                    // Explode do_ids into an array

                    if ($row['do_type'] == 'po') {
                        $data['invoice'] = $this->purchase->purchase_details($row['max_po_id']);

                    } else if ($row['do_type'] == 'invoice') {

                        $data['invoice'] = $this->invocies->invoice_details($row['max_invoice_id'], $this->limited);
                    }

                    $data['c_custom_fields'] = $this->custom->view_fields_data($data['invoice']['cid'], 1);

                    $doIdsArray = explode(',', $row['do_ids_and_dates']);
                    $parent_delivery_order_id = $row['parent_do_id'];
                    // print_r($doIdsArray);
                    // exit;
                    // Fetch individual cr_dates based on do_ids

                    // Iterate over the do_ids array
                    foreach ($doIdsArray as $doId) {
                        // Create an array for each iteration

                        $do_data = explode('#', $doId);
                        // print_r($do_data);
                        $delivery_order_id = $do_data[0];
                        $cr_date = $do_data[1];

                        if ($row['do_type'] == 'po') {

                            // $po_sql = 'SELECT ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product FROM gtg_do_delivered_items ddi LEFT JOIN gtg_purchase_items gp ON ddi.p_id = gp.id WHERE ddi.delivery_order_id = '.$delivery_order_id.' AND ddi.parent_delivery_order_id = '.$parent_delivery_order_id.'';
                            // $po_result = $this->db->query($po_sql);
                            // $delivery_orders = $po_result->result_array();
                            $po_sql = 'SELECT ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product,gp.qty as ordered_qty FROM gtg_do_delivered_items ddi LEFT JOIN gtg_purchase_items gp ON ddi.p_id = gp.pid WHERE ddi.delivery_order_id = ' . $delivery_order_id . ' AND ddi.parent_delivery_order_id = ' . $parent_delivery_order_id . '';
                            $po_result = $this->db->query($po_sql);
                            $delivery_orders = $po_result->result_array();


                        } else if ($row['do_type'] == 'invoice') {
                            $po_sql = 'SELECT ddi.qty as delivered_qty, ddi.return_qty, ddi.return_type, ddi.description, ddi.type as do_type, gp.product,gp.qty as ordered_qty FROM gtg_do_delivered_items ddi LEFT JOIN gtg_invoice_items gp ON ddi.p_id = gp.pid WHERE ddi.delivery_order_id = ' . $delivery_order_id . ' AND ddi.parent_delivery_order_id = ' . $parent_delivery_order_id . '';
                            $po_result = $this->db->query($po_sql);
                            $delivery_orders = $po_result->result_array();

                        } else if ($row['do_type'] == 'do') {
                            $do_sql = 'SELECT qty as delivered_qty, "do" as do_type, product FROM gtg_delivery_order_items ';
                            $do_result = $this->db->query($do_sql);
                            $delivery_orders = $do_result->result_array();

                        }

                        // Use the corresponding cr_date based on the key
                        //$cr_date = isset($crDatesArray[$key]) ? $crDatesArray[$key] : null;

                        $iterationData = [
                            'parent_do_id' => $row['parent_do_id'],
                            'do_id' => $delivery_order_id,
                            'cr_date' => $cr_date,
                            'do_type' => $row['do_type'],
                            'max_po_id' => $row['max_po_id'],
                            'max_invoice_id' => $row['max_invoice_id'],
                            'delivery_order' => $delivery_orders,
                        ];

                        // Add the array to the output data
                        $outputData[] = $iterationData;
                    }

                }

                $data['do_list'] = $outputData;
                $data['do_option'] = $do_option;
                $data['do_type'] = $do_type;

                $data['general'] = array('title' => $this->lang->line('Invoice'), 'person' => $this->lang->line('Customer'), 'prefix' => $pref, 't_type' => 0);
                ini_set('memory_limit', '64M');
                if ($data['invoice']['taxstatus'] == 'cgst' || $data['invoice']['taxstatus'] == 'igst') {
                    $html = $this->load->view('print_files/invoice-a4-gst_v' . INVV, $data, true);
                } else {
                    $html = $this->load->view('print_files/subdo-a4_v' . INVV, $data, true);
                    //    $html=str_replace("strong","span",$html);
                    //     $html=str_replace("<h","<span",$html);
                }

                // echo $html;
                // exit;
                //PDF Rendering
                $this->load->library('pdf');
                if (INVV == 1) {
                    $header = $this->load->view('print_files/do-header_v' . INVV, $data, true);

                    //  $header=str_replace("<h","<span",$header);
                    $pdf = $this->pdf->load_split(array('margin_top' => 40));
                    $pdf->SetHTMLHeader($header);
                }
                if (INVV == 2) {
                    $pdf = $this->pdf->load_split(array('margin_top' => 5));
                }
                $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:-6pt;">{PAGENO}/{nbpg} #' . $data['invoice']['tid'] . '</div>');
                $pdf->WriteHTML($html);
                if ($this->input->get('d')) {
                    $pdf->Output('Invoice_#' . $data['invoice']['tid'] . '.pdf', 'D');
                } else {
                    $pdf->Output('Invoice_#' . $data['invoice']['tid'] . '.pdf', 'I');
                }
        }
    }

    }

    public function printquote()
    {
        if (!$this->input->get()) {
            exit();
        }
        $tid = intval($this->input->get('id'));
        $token = $this->input->get('token');

        $validtoken = hash_hmac('ripemd160', 'q' . $tid, $this->config->item('encryption_key'));

        if (hash_equals($token, $validtoken)) {
            $this->load->model('quote_model', 'quote');
            $data['id'] = $tid;
            $data['title'] = $this->lang->line('Quote').$tid;
            $data['invoice'] = $this->quote->quote_details($tid);
            $data['products'] = $this->quote->quote_products($tid);
            $data['employee'] = $this->quote->employee($data['invoice']['eid']);
            $data['round_off'] = $this->custom->api_config(4);
            $data['general'] = array('title' => $this->lang->line('Quote'), 'person' => $this->lang->line('Customer'), 'prefix' => prefix(1), 't_type' => 1);
            //commented by siva
            //$data['custom_modify'] = '1';
            // $data['c_custom_fields'] = array();
            if (CUSTOM) {
                $data['c_custom_fields'] = $this->custom->view_fields_data($data['invoice']['cid'], 1, 1);
            } else {
                $data['c_custom_fields'] = array();
            }

            ini_set('memory_limit', '64M');

            if ($data['invoice']['taxstatus'] == 'cgst' || $data['invoice']['taxstatus'] == 'igst') {

                $html = $this->load->view('print_files/invoice-a4-gst_v' . INVV, $data, true);
            } else {

                $html = $this->load->view('print_files/invoice-a4_v' . INVV, $data, true);
            }

            //PDF Rendering
            $this->load->library('pdf');
            if (INVV == 1) {
                $header = $this->load->view('print_files/invoice-header_v' . INVV, $data, true);
                $pdf = $this->pdf->load_split(array('margin_top' => 40));
                $pdf->SetHTMLHeader($header);
            }
            if (INVV == 2) {
                $pdf = $this->pdf->load_split(array('margin_top' => 5));
            }
            $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:-6pt;">{PAGENO}/{nbpg} #' . $data['invoice']['tid'] . '</div>');

            $pdf->WriteHTML($html);

            if ($this->input->get('d')) {

                $pdf->Output('Quote_#' . $tid . '.pdf', 'D');
            } else {
                $pdf->Output('Quote_#' . $tid . '.pdf', 'I');
            }

        }

    }

    public function printorder()
    {
        if (!$this->input->get()) {
            exit();
        }
        $tid = intval($this->input->get('id'));
        $token = $this->input->get('token');

        $validtoken = hash_hmac('ripemd160', 'p' . $tid, $this->config->item('encryption_key'));

        if (hash_equals($token, $validtoken)) {
            $this->load->model('purchase_model', 'purchase');

            $data['id'] = $tid;
            $data['title'] = $this->lang->line('Invoice') . $tid;
            $data['invoice'] = $this->purchase->purchase_details($tid);
            $data['products'] = $this->purchase->purchase_products($tid);
            $data['employee'] = $this->purchase->employee($data['invoice']['eid']);
            $data['round_off'] = $this->custom->api_config(4);
            $data['general'] = array('title' => $this->lang->line('Purchase Order'), 'person' => $this->lang->line('Supplier'), 'prefix' => prefix(2), 't_type' => 0);
            //$data['custom_modify'] = '1';

            if (CUSTOM) {
                $data['c_custom_fields'] = $this->custom->view_fields_data($data['invoice']['cid'], 1, 1);
            } else {
                $data['c_custom_fields'] = array();
            }

            ini_set('memory_limit', '64M');
            if ($data['invoice']['taxstatus'] == 'cgst' || $data['invoice']['taxstatus'] == 'igst') {
                $html = $this->load->view('print_files/invoice-a4-gst_v' . INVV, $data, true);
            } else {
                $html = $this->load->view('print_files/invoice-a4_v' . INVV, $data, true);
            }

            //PDF Rendering
            $this->load->library('pdf');
            if (INVV == 1) {
                $header = $this->load->view('print_files/invoice-header_v' . INVV, $data, true);
                $pdf = $this->pdf->load_split(array('margin_top' => 40));
                $pdf->SetHTMLHeader($header);
            }
            if (INVV == 2) {
                $pdf = $this->pdf->load_split(array('margin_top' => 5));
            }
            $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:-6pt;">{PAGENO}/{nbpg} #' . $data['invoice']['tid'] . '</div>');

            $pdf->WriteHTML($html);

            if ($this->input->get('d')) {

                $pdf->Output('Purchase_#' . $tid . '.pdf', 'D');
            } else {
                $pdf->Output('Purchase_#' . $tid . '.pdf', 'I');
            }

        }

    }

    public function printstockreturn()
    {
        if (!$this->input->get()) {
            exit();
        }
        $tid = intval($this->input->get('id'));
        $token = $this->input->get('token');
        $validtoken = hash_hmac('ripemd160', 's' . $tid, $this->config->item('encryption_key'));
        if (hash_equals($token, $validtoken)) {
            $this->load->model('stockreturn_model', 'stockreturn');
            $data['id'] = $tid;
            $data['title'] = $this->lang->line('Invoice') . $tid;
            $data['invoice'] = $this->stockreturn->purchase_details($tid);
            $data['products'] = $this->stockreturn->purchase_products($tid);
            $data['employee'] = $this->stockreturn->employee($data['invoice']['eid']);
            $data['round_off'] = $this->custom->api_config(4);
            $ty = $this->input->get('ty');

            if (CUSTOM) {
                $data['c_custom_fields'] = $this->custom->view_fields_data($data['invoice']['cid'], 1, 1);
            } else {
                $data['c_custom_fields'] = array();
            }

            if ($ty < 2) {
                if ($data['invoice']['i_class'] == 1) {
                    $data['general'] = array('title' => $this->lang->line('Stock Return'), 'person' => $this->lang->line('Customer'), 'prefix' => prefix(4), 't_type' => 0);
                } else {
                    $data['general'] = array('title' => $this->lang->line('Stock Return'), 'person' => $this->lang->line('Supplier'), 'prefix' => prefix(4), 't_type' => 0);
                }
            } else {
                $data['general'] = array('title' => $this->lang->line('Credit Note'), 'person' => $this->lang->line('Customer'), 'prefix' => prefix(4), 't_type' => 0);
            }

            ini_set('memory_limit', '64M');
            if ($data['invoice']['taxstatus'] == 'cgst' || $data['invoice']['taxstatus'] == 'igst') {
                $html = $this->load->view('print_files/invoice-a4-gst_v' . INVV, $data, true);
            } else {
                $html = $this->load->view('print_files/invoice-a4_v' . INVV, $data, true);
            }
            //PDF Rendering
            $this->load->library('pdf');
            if (INVV == 1) {
                $header = $this->load->view('print_files/invoice-header_v' . INVV, $data, true);
                $pdf = $this->pdf->load_split(array('margin_top' => 40));
                $pdf->SetHTMLHeader($header);
            }
            if (INVV == 2) {
                $pdf = $this->pdf->load_split(array('margin_top' => 5));
            }
            $pdf->SetHTMLFooter('<div style="text-align: right;font-family: serif; font-size: 8pt; color: #5C5C5C; font-style: italic;margin-top:-6pt;">{PAGENO}/{nbpg} #' . $data['invoice']['tid'] . '</div>');
            $pdf->WriteHTML($html);
            if ($this->input->get('d')) {
                $pdf->Output('Stockreturn_order#' . $tid . '.pdf', 'D');
            } else {
                $pdf->Output('Stockreturn_order#' . $tid . '.pdf', 'I');
            }
        }
    }

    public function card()
    {
        $this->load->library('session');
        $response = array();
        if (isset($_REQUEST)) {
            $response[] = $_REQUEST;
            if (isset($_REQUEST['Status'])) {
                $data['response'] = $response;
                if ($_REQUEST['Status'] > 0) {
                    $this->progress_invoice_ipay88();
                } else {
                    $htmlcode = '<!DOCTYPE html><html lang="en">
                    <head><meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
                    <title>Payment - Error</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
                    </head><body>
                    <div class="card alert alert-danger" style="margin: 15px auto;max-width: 700px;">
                        <div class="card-body">
                            <h4 class="card-title">Error - ' . $_REQUEST['RefNo'] . '</h4>
                            <p class="card-text">' . $_REQUEST['ErrDesc'] . '</p>
                            <a class="card-link" href="' . substr_replace(base_url(), '', -1) . '/crm/invoices">Back to Invoice</a>
                        </div>
                    </div>
                     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script></body></html>';

                    echo $htmlcode;
                    exit;
                }
            }
        }

        if (!$this->input->get()) {
            $data['tid'] = $this->session->has_userdata('tid');
            $data['token'] = $this->session->has_userdata('token');
            $data['itype'] = 'inv';
            $data['gid'] = 9;
            exit();
        } else {
            $data['tid'] = $this->input->get('id');
            $this->session->set_userdata('tid', $this->input->get('id'));
            $data['token'] = $this->input->get('token');
            $this->session->set_userdata('token', $data['token']);
            $data['itype'] = $this->input->get('itype');
            $this->session->set_userdata('itype', $data['itype']);
            $data['gid'] = $this->input->get('gid');
            $this->session->set_userdata('gid', $data['gid']);
        }
        $data['redirect_u'] = '';
        if (isset($_COOKIE['pos_set'])) {
            $data['redirect_u'] = $_COOKIE['pos_set'];
            setcookie("pos_set", null, -1, '/');
        }
        $online_pay = $this->billing->online_pay_settings();
        if ($online_pay['enable'] == 0) {
            exit();
        }

        if ($data['itype'] == 'inv') {
            $validtoken = hash_hmac('ripemd160', $data['tid'], $this->config->item('encryption_key'));
            if (hash_equals($data['token'], $validtoken)) {
                $data['invoice'] = $this->invocies->invoice_details($data['tid'], '', false);
                $data['company'] = location($data['invoice']['loc']);
                $this->session->set_userdata('invoice', $data['invoice']);
                $this->session->set_userdata('company', $data['company']);
            } else {
                exit();
            }
        }
        switch ($data['gid']) {
            case 1:
                $fname = 'stripe';
                break;
            case 2:
                $fname = 'authorize';
                break;
            case 3:
                $fname = 'pinpay';
                break;
            case 4:
                $fname = 'paypal';
                break;
            case 5:
                $fname = 'securepay';
                break;
            case 6:
                $fname = 'checkout';
                break;
            case 7:
                $fname = 'payumoney';
                break;
            case 8:
                $fname = 'razor';
                break;
            case 9:
                $fname = 'ipay88';
                break;
            default:
                $fname = 'ipay88';
                break;
        }
        $online_pay = $this->billing->online_pay_settings();
        $pay_settings = $this->billing->pay_settings();

        $data['pay_setting'] = $pay_settings;

        $data['gateway'] = $this->billing->gateway($data['gid']);
        $response = array();

        if ($online_pay['enable'] == 1) {
            $this->load->view('billing/header');
            $this->load->view('gateways/card_' . $fname, $data);
            $this->load->view('billing/footer');
        } else {
            echo '<h3>' . $this->lang->line('Online Payment Service') . '</h3>';
        }
    }

    public function walletpay()
    {
        $cid = $_POST['cid'];
        $customer = $this->customers->mydetails($cid);
        $id = $_POST['id'];
        $tid = $_POST['tid'];
        $amount = $_POST['amount'];
        $pmethod = $_POST['pmethod'];
        if ($_POST['pmethod'] == "Balance") {
            $pmethod = "Wallet";
        }
        $shortnote = "";
        if (isset($_POST['shortnote'])) {
            $shortnote = " customer note:" . $_POST['shortnote'];
        }
        $multi = $_POST['multi'];
        $loc = $_POST['loc'];
        $account = $customer['balance'];
        if ($account < $amount) {
            $htmlcode = '<!DOCTYPE html><html lang="en">
                    <head><meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
                    <title>Payment - Error</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
                    </head><body>
                    <div class="card alert alert-danger" style="margin: 15px auto;max-width: 700px;">
                        <div class="card-body">
                            <h4 class="card-title">Error - ' . $tid . '</h4>
                            <p class="card-text">You Wallet Balence is low.</p>
                            <a class="card-link" href="' . substr_replace(base_url(), '', -1) . '/crm/invoices">Back to Invoice</a>
                        </div>
                    </div>
                     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script></body></html>';

            echo $htmlcode;
        } else {

            $note = $pmethod . ' for invoice #' . $tid . ", amount: " . $amount;

            $amount = number_format($amount, 2, '.', '');

            $amount_o = $amount;
            $amount_o = rev_amountExchange_s($amount_o, $multi, $loc);

            if ($this->billing->paynow($id, $amount_o, $note . " " . $shortnote, $pmethod, $customer['loc'])) {
                $htmlcode = '<!DOCTYPE html><html lang="en">
                    <head><meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
                    <title>Payment - Success</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
                    </head><body>
                    <div class="card alert alert-success" style="margin: 15px auto;max-width: 700px;">
                        <div class="card-body">
                            <h4 class="card-title">Payment For - ' . $tid . '</h4>
                            <p class="card-text"><h3>Thanks For The Payment</h3><br/>' . $note . '</p>
                            <a class="card-link" href="' . substr_replace(base_url(), '', -1) . '/crm/invoices">Back to Invoice</a>
                        </div>
                    </div>
                     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script></body></html>';

                echo $htmlcode;
            }
        }
    }
    public function progress_invoice_ipay88()
    {
        $pmethod = 'Card';
        $pay = array(
            array("paymethod" => "Credit Card (MYR)", "payid" => "2"),
            array("paymethod" => "Maybank2U", "payid" => "6"),
            array("paymethod" => "Alliance Online", "payid" => "8"),
            array("paymethod" => "AmOnline", "payid" => "10"),
            array("paymethod" => "RHB Online", "payid" => "14"),
            array("paymethod" => "Hong Leong Online", "payid" => "15"),
            array("paymethod" => "CIMB Click", "payid" => "20"),
            array("paymethod" => "Web Cash", "payid" => "22"),
            array("paymethod" => "Public Bank Online", "payid" => "31"),
            array("paymethod" => "PayPal (MYR)", "payid" => "48"),
            array("paymethod" => "Credit Card (MYR) Pre-Auth", "payid" => "55"),
            array("paymethod" => "Bank Rakyat Internet Banking", "payid" => "102"),
            array("paymethod" => "Affin Online", "payid" => "103"),
            array("paymethod" => "Pay4Me (Delay payment)", "payid" => "122"),
            array("paymethod" => "BSN Online", "payid" => "124"),
            array("paymethod" => "Bank Islam", "payid" => "134"),
            array("paymethod" => "UOB", "payid" => "152"),
            array("paymethod" => "Hong Leong PEx+ (QR Payment)", "payid" => "163"),
            array("paymethod" => "Bank Muamalat", "payid" => "166"),
            array("paymethod" => "OCBC", "payid" => "167"),
            array("paymethod" => "Standard Chartered Bank", "payid" => "168"),
            array("paymethod" => "CIMB Virtual Account (Delay payment)", "payid" => "173"),
            array("paymethod" => "HSBC Online Banking", "payid" => "198"),
            array("paymethod" => "Kuwait Finance House", "payid" => "199"),
            array("paymethod" => "Boost Wallet", "payid" => "210"),
            array("paymethod" => "VCash", "payid" => "243"),
            array("paymethod" => "Credit Card (USD)", "payid" => "25"),
            array("paymethod" => "Credit Card (GBP)", "payid" => "35"),
            array("paymethod" => "Credit Card (THB)", "payid" => "36"),
            array("paymethod" => "Credit Card (CAD)", "payid" => "37"),
            array("paymethod" => "Credit Card (SGD)", "payid" => "38"),
            array("paymethod" => "Credit Card (AUD)", "payid" => "39"),
            array("paymethod" => "Credit Card (MYR)", "payid" => "40"),
            array("paymethod" => "Credit Card (EUR)", "payid" => "41"),
            array("paymethod" => "Credit Card (HKD)", "payid" => "42"),
        );
        foreach ($pay as $value) {
            if ($value['payid'] == $_REQUEST['PaymentId']) {
                $pmethod = $value['paymethod'];
            }

        }
        $pay_settings = $this->billing->pay_settings();
        $test = $pay_settings['prefix'];
        $tid = $_REQUEST['RefNo'];
        if (!empty($test)) {
            $tid = substr($_REQUEST['RefNo'], strlen($test));
        }

        $hash = hash_hmac('ripemd160', $tid, $this->config->item('encryption_key'));
        $itype = 'inv';
        if ($itype == 'inv') {
            $customer = $this->invocies->invoice_table_details($tid, null, false);
            if (!is_array($customer)) {
                exit();
            }
        }
        $note = $pmethod . ' for #' . $_REQUEST['RefNo'] . " by ipay88 transid:" . $_REQUEST['TransId'];
        //$note = $pmethod.' for #' . $_REQUEST['RefNo']." by ipay88 transid:".$_REQUEST['TransId'].",  bankmid:".$_REQUEST['BankMID'].", bank name:".$_REQUEST['S_bankname'].", country:".$_REQUEST['S_country'];
        $amount = number_format($_REQUEST['Amount'], 2, '.', '');
        $amount_o = $amount;
        $amount_o = rev_amountExchange_s($amount_o, $customer['multi'], $customer['loc']);

        if ($this->billing->paynow($customer['id'], $amount_o, $note, $pmethod, $customer['loc'])) {
            $htmlcode = '<!DOCTYPE html><html lang="en">
                    <head><meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
                    <title>Payment - Error</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
                    </head><body>
                    <div class="card alert alert-success" style="margin: 15px auto;max-width: 700px;">
                        <div class="card-body">
                            <h4 class="card-title">Payment Successful</h4>
                            <div class="table-responsive mx-1 my-1">
                                <table class="table">
                                    <tr><td>Date</td><td>' . $_REQUEST['TranDate'] . '</td></tr>
                                    <tr><td>Invoice No</td><td>' . $_REQUEST['RefNo'] . '</td></tr>
                                    <tr><td>Transaction Id</td><td>' . $_REQUEST['TransId'] . '</td></tr>
                                    <tr><td>Amount</td><td>' . $_REQUEST['Amount'] . '</td></tr>
                                </table>
                            </div>
                            <a class="card-link" href="' . substr_replace(base_url(), '', -1) . '/crm/invoices">Back to Invoice</a>
                        </div>
                    </div>
                     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script></body></html>';

            echo $htmlcode;
            unset($_REQUEST);
            exit;
            header('Content-Type: application/json');
            echo json_encode(array('status' => 'Success', 'message' =>
                $this->lang->line('Thank you for the payment') . " <a href='" . base_url('billing/view?id=' . $tid . '&token=' . $hash) . "' class='btn btn-info btn-lg'><span class='icon-file-text2' aria-hidden='true'></span> " . $this->lang->line('View') . "</a>"));
        }
        exit;
    }

    public function process_card()
    {
        if (!$this->input->post()) {
            exit();
        }
        $tid = $this->input->post('id', true);
        $itype = $this->input->post('itype', true);
        $gateway = $this->input->post('gateway', true);

        $amount = number_format($this->input->post('amount', true), 2, '.', '');

        if ($itype == 'inv') {
            $customer = $this->invocies->invoice_details($tid, null, false);
            if (!$customer['tid']) {
                exit();
            }
        }
        $hash = $this->input->post('token', true);

        $cardNumber = $this->input->post('cardNumber', true);
        $cardExpiry = $this->input->post('cardExpiry', true);
        $cardCVC = $this->input->post('cardCVC', true);
        $nmonth = substr($cardExpiry, 0, 2);
        $nyear = '20' . substr($cardExpiry, 5, 2);
        $note = 'Card Payment for #' . $customer['tid'];
        $pmethod = 'Card';
        $amount_o = $amount;
        if ($customer['multi'] > 0) {
            $multi_currency = $this->invocies->currency_d($customer['multi']);
            //    $amount =  $amount;
            $gateway_data['currency'] = $multi_currency['code'];
            $note .= ' (Currency Conversion Applied)';
        }
        if ($customer['loc'] > 0) {
            $multi_currency = $this->invocies->currency_d($customer['multi'], $customer['loc']);
            //        $amount =  $amount;
            $gateway_data['currency'] = $multi_currency['code'];
            $note .= ' (Currency Conversion Applied)';
        }
        $validtoken = hash_hmac('ripemd160', $tid, $this->config->item('encryption_key'));
        $gateway_data = $this->billing->gateway($gateway);
        $surcharge = ($amount * $gateway_data['surcharge']) / 100;
        $amount_t = $amount + $surcharge;
        $amount = number_format($amount_t, 2, '.', '');
        if (hash_equals($hash, $validtoken)) {
            switch ($gateway) {
                case 1:
                    $response = $this->stripe($this->input->post('paymentMethodId', true), number_format($amount, 0, '', ''), $gateway_data, $tid, $customer, '', $this->input->post('paymentIntentId', true));
                    break;
                case 2:
                    $response = $this->authorizenet($cardNumber, $nmonth, $nyear, $cardCVC, $amount, $tid, $gateway_data, $customer);
                    break;
                case 3:
                    $response = $this->pinpay($cardNumber, $nmonth, $nyear, $cardCVC, $amount, $tid, $gateway_data, $customer);
                    break;
                case 4:
                    $response = $this->paypal($cardNumber, $nmonth, $nyear, $cardCVC, $amount, $tid, $gateway_data, $customer);
                    break;
                case 5:
                    $response = $this->securepay($cardNumber, $nmonth, $nyear, $cardCVC, $amount, $tid, $gateway_data);
                    break;
                case 6:
                    $response = $this->twocheckout($this->input->post('auth_token', true), $amount, $tid, $gateway_data, $customer);
                    break;
            }
            // Process response

            if ($gateway > 1) {
                if ($response->isSuccessful()) {

                    $amount_o = rev_amountExchange_s($amount_o, $customer['multi'], $customer['loc']);
                    if ($this->billing->paynow($tid, $amount_o, $note, $pmethod, $customer['loc'])) {
                        header('Content-Type: application/json');
                        echo json_encode(array('status' => 'Success', 'message' =>
                            $this->lang->line('Thank you for the payment') . " <a href='" . base_url('billing/view?id=' . $tid . '&token=' . $hash) . "' class='btn btn-info btn-lg'><span class='icon-file-text2' aria-hidden='true'></span> " . $this->lang->line('View') . "</a>"));
                    }
                } elseif ($response->isRedirect()) {
                    // Redirect to offsite payment gateway
                    $response->redirect();
                } else {
                    // Payment failed
                    echo json_encode(array('status' => 'Error', 'message' =>
                        $this->lang->line('Payment failed')));
                }
            } elseif ($gateway == 1 and @$response['status'] == 'succeeded') {
                $amount_o = rev_amountExchange_s(($amount - $surcharge) / 100, $customer['multi'], $customer['loc']);
                if ($this->billing->paynow($tid, $amount_o, $note, $pmethod, $customer['loc'])) {
                    header('Content-Type: application/json');
                    echo json_encode(array('status' => 'Success', 'clientSecret' => $response['clientSecret'], 'message' =>
                        $this->lang->line('Thank you for the payment') . " <a href='" . base_url('billing/view?id=' . $tid . '&token=' . $hash) . "' class='btn btn-info btn-lg'><span class='icon-file-text2' aria-hidden='true'></span> " . $this->lang->line('View') . "</a>"));

                }
            } elseif ($gateway == 1 and @$response['status'] == 'error') {
                header('Content-Type: application/json');
                echo json_encode(array('error' => $response['message']));
            }

        }
    }

    private function stripe($token, $amount, $gateway_data, $tid, $customer, $currency = '', $token_id = '')
    {
        require_once APPPATH . 'third_party/stripe-php/vendor/autoload.php';
        \Stripe\Stripe::setApiKey($gateway_data['key1']);
        try {
            if ($token) {
                // Create new PaymentIntent with a PaymentMethod ID from the client.
                $intent = \Stripe\PaymentIntent::create([
                    "amount" => $amount,
                    "currency" => $gateway_data['currency'],
                    "payment_method" => $token,
                    "confirmation_method" => "manual",
                    "confirm" => true,
                    // If a mobile client passes `useStripeSdk`, set `use_stripe_sdk=true`
                    // to take advantage of new authentication features in mobile SDKs
                    "use_stripe_sdk" => true,

                ]);
                switch ($intent->status) {
                    case "succeeded":

                        return array('status' => 'succeeded', 'paid_amount' => $intent->amount, 'clientSecret' => $intent->client_secret);
                        break;
                }
                // After create, if the PaymentIntent's status is succeeded, fulfill the order.
            } else if ($token_id) {
                // Confirm the PaymentIntent to finalize payment after handling a required action
                // on the client.

                $intent = \Stripe\PaymentIntent::retrieve($token_id);
                $intent->confirm();
                // After confirm, if the PaymentIntent's status is succeeded, fulfill the order.
                switch ($intent->status) {
                    case "succeeded":

                        return array('status' => 'succeeded', 'paid_amount' => $intent->amount, 'clientSecret' => $intent->client_secret);
                        break;
                }

            }

            $output = $this->generateResponse($intent);

            echo json_encode($output);
        } catch (Stripe\Exception\CardException $e) {
            return array('status' => 'error', 'paid_amount' => 0, 'message' => $e->getMessage());

        }

    }

    private function authorizenet($cardNumber, $nmonth, $nyear, $cardCVC, $amount, $tid, $gateway_data, $customer)
    {
        $gateway = Omnipay::create('AuthorizeNet_AIM');
        $gateway->setApiLoginId($gateway_data['key2']);
        $gateway->setTransactionKey($gateway_data['key1']);
        $gateway->setDeveloperMode($gateway_data['dev_mode']);
        $meta = array(
            'Name' => $customer['name'],
            'email' => $customer['email'],
        );
        try {
            return $gateway->purchase(
                array(
                    'card' => array(
                        'number' => $cardNumber,
                        'expiryMonth' => $nmonth,
                        'expiryYear' => $nyear,
                        'cvv' => $cardCVC,
                    ),
                    'amount' => $amount,
                    'currency' => $gateway_data['currency'],
                    'description' => 'Paid for ' . $customer['name'] . ' INV#' . $tid,
                    'metadata' => $meta,

                )
            )->send();
        } catch (Exception $e) {
            return 0;
        }
    }

    private function pinpay($cardNumber, $nmonth, $nyear, $cardCVC, $amount, $tid, $gateway_data, $customer)
    {
        $gateway = \Omnipay\Omnipay::create('Pin');

        // Initialise the gateway
        $gateway->initialize(array(
            'secretKey' => $gateway_data['key1'],
            'testMode' => $gateway_data['dev_mode'], // Or false when you are ready for live transactions
        ));

        // Create a credit card object
        // This card can be used for testing.
        // See https://pin.net.au/docs/api/test-cards for a list of card
        // numbers that can be used for testing.
        $card = new \Omnipay\Common\CreditCard(array(
            'firstName' => $customer['name'],
            'lastName' => 'Customer',
            'number' => $cardNumber,
            'expiryMonth' => $nmonth,
            'expiryYear' => $nyear,
            'cvv' => $cardCVC,
            'email' => $customer['email'],
            'billingAddress1' => $customer['address'],
            'billingCountry' => $customer['country'],
            'billingCity' => $customer['city'],
            'billingPostcode' => $customer['postbox'],
            'billingState' => $customer['region'],
        ));

        // Do a purchase transaction on the gateway
        $transaction = $gateway->purchase(array(
            'description' => 'Payment for INV#' . $tid,
            'amount' => $amount,
            'currency' => $gateway_data['currency'],
            'clientIp' => $_SERVER['REMOTE_ADDR'],
            'card' => $card,
        ));
        return $transaction->send();

    }

    private function securepay($cardNumber, $nmonth, $nyear, $cardCVC, $amount, $tid, $gateway_data)
    {

        $gateway = \Omnipay\Omnipay::create('SecurePay_SecureXML');
        $gateway->setMerchantId($gateway_data['key1']);
        $gateway->setTransactionPassword($gateway_data['key2']);
        $gateway->setTestMode($gateway_data['dev_mode']);
        // Create a credit card object
        $card = new \Omnipay\Common\CreditCard(
            [
                'number' => $cardNumber,
                'expiryMonth' => $nmonth,
                'expiryYear' => $nyear,
                'cvv' => $cardCVC,
            ]
        );
        // Perform a purchase test
        $transaction = $gateway->purchase(
            [
                'amount' => $amount,
                'currency' => $gateway_data['currency'],
                'transactionId' => 'invoice_' . $tid,
                'card' => $card,
            ]
        );

        return $transaction->send();
    }

    private function twocheckout($auth_token, $amount, $tid, $gateway_data, $customer)
    {

        $gateway = Omnipay::create('TwoCheckoutPlus_Token');
        $gateway->setAccountNumber($gateway_data['extra']);
        $gateway->setTestMode($gateway_data['dev_mode']);
        $gateway->setPrivateKey($gateway_data['key2']);

        $formData = array(
            'firstName' => $customer['name'],
            'email' => $customer['email'],
            'billingAddress1' => $customer['address'],
            'billingCountry' => $customer['country'],
            'billingCity' => $customer['city'],
            'billingPostcode' => $customer['postbox'],
            'billingState' => $customer['region'],
            "phoneNumber" => $customer['phone'],
        );

        $purchase_request_data = array(
            'card' => $formData,
            'token' => $auth_token,
            'transactionId' => $tid,
            'currency' => $gateway_data['currency'],
            'total' => $amount,
            'amount' => $amount,
        );
        return $gateway->purchase($purchase_request_data)->send();

    }

    private function paypal($cardNumber, $nmonth, $nyear, $cardCVC, $amount, $tid, $gateway_data, $customer)
    {

        $gateway = Omnipay::create('PayPal_Rest');
        // Initialise the gateway
        $gateway->initialize(array(
            'clientId' => $gateway_data['key1'],
            'secret' => $gateway_data['key2'],
            'testMode' => $gateway_data['dev_mode'], // Or false when you are ready for live transactions
        ));

        $card = new \Omnipay\Common\CreditCard(array(
            'firstName' => $customer['name'],
            'lastName' => 'Customer',
            'number' => $cardNumber,
            'expiryMonth' => $nmonth,
            'expiryYear' => $nyear,
            'cvv' => $cardCVC,
            'billingAddress1' => $customer['address'],
            'billingCountry' => $customer['country'],
            'billingCity' => $customer['city'],
            'billingPostcode' => $customer['postbox'],
            'billingState' => $customer['region'],
        ));

        try {
            $transaction = $gateway->purchase(array(
                'amount' => $amount,
                'currency' => $gateway_data['currency'],
                'description' => 'Payment for #inv ' . $tid,
                'card' => $card,
            ));
            return $transaction->send();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function bank()
    {
        $online_pay = $this->billing->online_pay_settings();
        if ($online_pay['bank'] == 1) {
            $data['accounts'] = $this->billing->bank_accounts('Yes');
            $this->load->view('billing/header');
            $this->load->view('payment/public_bank_view', $data);
            $this->load->view('billing/footer');
        }

    }

    public function recharge()
    {
        if ($this->session->userdata('user_details')) {
            $data['customers'] = $this->customers->mydetails($this->session->userdata('user_details')[0]->cid);
        }
        if (!$this->input->get()) {
            exit();
        }
        $online_pay = $this->billing->online_pay_settings();
        if ($online_pay['enable'] == 0) {
            exit();
        }
        $data['pay_setting'] = $this->billing->pay_settings();
        $data['id'] = base64_decode($this->input->get('id', true));

        $data['amount'] = $this->input->get('amount', true);
        $data['gid'] = $this->input->get('gid', true);
        $data['token'] = $this->input->get('token', true);

        switch ($data['gid']) {
            case 1:
                $fname = 'stripe';
                break;
            case 2:
                $fname = 'authorize';
                break;
            case 3:
                $fname = 'pinpay';
                break;
            case 4:
                $fname = 'paypal';
                break;
            case 5:
                $fname = 'securepay';
                break;
            case 6:
                $fname = 'checkout';
                break;
            case 7:
                $fname = 'payumoney';
                break;
            case 8:
                $fname = 'razor';
                break;
            case 9:
                $fname = 'ipay88';
                break;
            default:
                $fname = 'ipay88';
                break;
        }

        $data['gateway'] = $this->billing->gateway($data['gid']);
        if ($online_pay['enable'] == 1) {
            $this->load->view('billing/header');
            $this->load->view('gateways/recharge/card_' . $fname, $data);
            $this->load->view('billing/footer');
        } else {
            echo '<h3>' . $this->lang->line('Online Payment Service') . '</h3>';
        }
    }

    public function recharge_response()
    {
        $response = array();
        if (isset($_REQUEST)) {
            $response = $_REQUEST;
            if (isset($response['Status'])) {
                $data['response'] = $response;
                if ($response['Status'] > 0) {
                    $pmethod = 'Card';
                    $pay = array(
                        array("paymethod" => "Credit Card (MYR)", "payid" => "2"),
                        array("paymethod" => "Maybank2U", "payid" => "6"),
                        array("paymethod" => "Alliance Online", "payid" => "8"),
                        array("paymethod" => "AmOnline", "payid" => "10"),
                        array("paymethod" => "RHB Online", "payid" => "14"),
                        array("paymethod" => "Hong Leong Online", "payid" => "15"),
                        array("paymethod" => "CIMB Click", "payid" => "20"),
                        array("paymethod" => "Web Cash", "payid" => "22"),
                        array("paymethod" => "Public Bank Online", "payid" => "31"),
                        array("paymethod" => "PayPal (MYR)", "payid" => "48"),
                        array("paymethod" => "Credit Card (MYR) Pre-Auth", "payid" => "55"),
                        array("paymethod" => "Bank Rakyat Internet Banking", "payid" => "102"),
                        array("paymethod" => "Affin Online", "payid" => "103"),
                        array("paymethod" => "Pay4Me (Delay payment)", "payid" => "122"),
                        array("paymethod" => "BSN Online", "payid" => "124"),
                        array("paymethod" => "Bank Islam", "payid" => "134"),
                        array("paymethod" => "UOB", "payid" => "152"),
                        array("paymethod" => "Hong Leong PEx+ (QR Payment)", "payid" => "163"),
                        array("paymethod" => "Bank Muamalat", "payid" => "166"),
                        array("paymethod" => "OCBC", "payid" => "167"),
                        array("paymethod" => "Standard Chartered Bank", "payid" => "168"),
                        array("paymethod" => "CIMB Virtual Account (Delay payment)", "payid" => "173"),
                        array("paymethod" => "HSBC Online Banking", "payid" => "198"),
                        array("paymethod" => "Kuwait Finance House", "payid" => "199"),
                        array("paymethod" => "Boost Wallet", "payid" => "210"),
                        array("paymethod" => "VCash", "payid" => "243"),
                        array("paymethod" => "Credit Card (USD)", "payid" => "25"),
                        array("paymethod" => "Credit Card (GBP)", "payid" => "35"),
                        array("paymethod" => "Credit Card (THB)", "payid" => "36"),
                        array("paymethod" => "Credit Card (CAD)", "payid" => "37"),
                        array("paymethod" => "Credit Card (SGD)", "payid" => "38"),
                        array("paymethod" => "Credit Card (AUD)", "payid" => "39"),
                        array("paymethod" => "Credit Card (MYR)", "payid" => "40"),
                        array("paymethod" => "Credit Card (EUR)", "payid" => "41"),
                        array("paymethod" => "Credit Card (HKD)", "payid" => "42"),
                    );
                    foreach ($pay as $value) {
                        if ($value['payid'] == $response['PaymentId']) {
                            $pmethod = $value['paymethod'];
                        }

                    }
                    $string = $response['RefNo'];
                    $amount = $response['Amount'];
                    $tid = substr($string, 0, -12);
                    $transid = $response['TransId'];
                    $transdate = '';
                    if (isset($response['TranDate'])) {$transdate = $response['TranDate'];}
                    if ($this->billing->recharge_complete($tid, $amount)) {
                        $htmlcode = '<!DOCTYPE html><html lang="en">
                    <head><meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
                    <title>Payment - Successful</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
                    </head><body>
                    <div class="card alert alert-success" style="margin: 15px auto;max-width: 700px;">
                        <div class="card-body">
                            <h4 class="card-title">Payment Successful</h4>
                            <div class="table-responsive mx-1 my-1">
                                <table class="table">
                                    <tr><td>Date</td><td>' . $transdate . '</td></tr>
                                    <tr><td>Invoice No</td><td>' . $response['RefNo'] . '</td></tr>
                                    <tr><td>Transaction Id</td><td>' . $response['TransId'] . '</td></tr>
                                    <tr><td>Amount</td><td>' . $amount . '</td></tr>
                                </table>
                            </div>
                            <a class="card-link" href="' . substr_replace(base_url(), '', -1) . '/crm/payments/recharge">Back to Recharge Page</a>
                        </div>
                    </div>
                     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script></body></html>';
                        echo $htmlcode;
                        $customer = $this->customers->mydetails($tid);
                        $mailtoc = $this->adminemail->get_email_id();
                        $email = $customer['email'];
                        $name = $customer['name'];
                        $mailtotilte = "Jsuite Cloud";
                        $cid = $tid;
                        $message = "Hi " . $name . ",<br><br>Your recharge wallet account is successful.
                <br> Details are:->
                <table border='0px'>
                <tr><td>transaction id:</td><td>" . $transid . "</td></tr>
                <tr><td>ref no:</td><td>" . $string . "</td></tr>
                <tr><td>customer name:</td><td>" . $name . "</td></tr>
                <tr><td>amount:</td><td>" . $amount . "</td></tr>
                <tr><td>method:</td><td>" . $pmethod . "</td></tr>
                <tr><td>email:</td><td>" . $email . "</td></tr>
                </table>";

                        $subject = "wallet recharged by Customer:" . $name . " id:" . $cid;
                        $attachmenttrue = false;
                        $attachment = '';
                        ob_start();
                        $status = $this->communication_model->send_email($mailtoc, $mailtotilte, $subject, $message, $attachmenttrue, $attachment);
                        $status = $this->communication_model->send_email($email, $name, $subject, $message, $attachmenttrue, $attachment);
                        ob_end_clean();

                        if (isset($_REQUEST)) {
                            unset($_REQUEST);
                        }
                        exit;

                    }
                } else {
                    $htmlcode = '<!DOCTYPE html><html lang="en">
                    <head><meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
                    <title>Payment - Error</title>
                    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
                    </head><body>
                    <div class="card alert alert-danger" style="margin: 15px auto;max-width: 700px;">
                        <div class="card-body">
                            <h4 class="card-title">Error - ' . $response['RefNo'] . '</h4>
                            <p class="card-text">' . $response['ErrDesc'] . '</p>
                            <a class="card-link" href="' . substr_replace(base_url(), '', -1) . '/crm/payments/recharge">Back to Recharge Page</a>
                        </div>
                    </div>
                     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script></body></html>';

                    echo $htmlcode;
                    if (isset($_REQUEST)) {
                        unset($_REQUEST);
                    }
                    exit;
                }
            }
        }
        if (isset($_REQUEST)) {
            unset($_REQUEST);
        }
        exit;
    }

    public function process_recharge()
    {
        /*
    if (!$this->input->post()) {
    exit();
    }

    $tid = $this->input->post('id', true);
    $amount = number_format($this->input->post('amount', true), 2, '.', '');
    $gateway = $this->input->post('gateway', true);
    $cardNumber = $this->input->post('cardNumber', true);
    $cardExpiry = $this->input->post('cardExpiry', true);
    $cardCVC = $this->input->post('cardCVC', true);

    $nmonth = substr($cardExpiry, 0, 2);
    $nyear = '20' . substr($cardExpiry, 5, 2);

    $pmethod = 'Card';

    $amount_o = $amount;

    $gateway_data = $this->billing->gateway($gateway);
    $surcharge = ($amount * $gateway_data['surcharge']) / 100;
    $amount_t = $amount + $surcharge;
    $this->load->model('customers_model', 'customers');
    $customer = $this->customers->details($tid, false);
    $note = 'Recharge Card Payment for Customer' . $customer['email'];

    $amount = number_format($amount_t, 2, '.', '');

    switch ($gateway) {

    case 1:
    //       $response = $this->stripe($this->input->post('stripeToken', true), $amount, $gateway_data, $tid, $customer);

    $response = $this->stripe($this->input->post('paymentMethodId', true), number_format($amount, 0, '', ''), $gateway_data, $tid, $customer, '', $this->input->post('paymentIntentId', true));

    break;
    case 2:
    $response = $this->authorizenet($cardNumber, $nmonth, $nyear, $cardCVC, $amount, $tid, $gateway_data, $customer);
    break;
    case 3:
    $response = $this->pinpay($cardNumber, $nmonth, $nyear, $cardCVC, $amount, $tid, $gateway_data, $customer);
    break;
    case 4:
    $response = $this->paypal($cardNumber, $nmonth, $nyear, $cardCVC, $amount, $tid, $gateway_data, $customer);
    break;
    case 5:
    $response = $this->securepay($cardNumber, $nmonth, $nyear, $cardCVC, $amount, $tid, $gateway_data);
    break;
    case 6:
    $response = $this->twocheckout($this->input->post('auth_token', true), $amount, $tid, $gateway_data, $customer);
    break;

    }

    // Process response
    if ($gateway > 1) {
    if ($response->isSuccessful()) {

    if ($this->billing->recharge_done($tid, $amount_o)) {
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'Success', 'message' =>
    $this->lang->line('Thank you for the payment') . " <a href='" . base_url('crm/payments/recharge') . "' class='btn btn-info btn-lg'><span class='icon-file-text2' aria-hidden='true'></span> " . $this->lang->line('View') . "</a>"));
    }

    } elseif ($response->isRedirect()) {

    // Redirect to offsite payment gateway
    $response->redirect();

    } else {

    // Payment failed
    echo json_encode(array('status' => 'Error', 'message' =>
    $this->lang->line('Payment failed')));
    }
    } elseif ($gateway == 1 and @$response['status'] == 'succeeded') {
    $amount_o = $amount_o / 100;
    if ($this->billing->recharge_done($tid, $amount_o)) {
    header('Content-Type: application/json');
    echo json_encode(array('status' => 'Success', 'message' =>
    $this->lang->line('Thank you for the payment') . " <a href='" . base_url('crm/payments/recharge') . "' class='btn btn-info btn-lg'><span class='icon-file-text2' aria-hidden='true'></span> " . $this->lang->line('View') . "</a>"));
    }
    } elseif ($gateway == 1 and @$response['status'] == 'error') {
    header('Content-Type: application/json');
    echo json_encode(array('error' => $response['message']));
    }

     */
    }

    public function secureprocess()
    {

        $gid = $this->input->get('g', true);
        //payu
        if ($gid == 7) {
            $status = $this->input->post('status', true);
            $firstname = $this->input->post("firstname", true);
            $amount = $this->input->post("amount", true);
            $txnid = $this->input->post("txnid", true);
            $posted_hash = $this->input->post("hash", true);
            $key = $this->input->post("key", true);
            $productinfo = $this->input->post("productinfo", true);
            $email = $this->input->post("email", true);
            $gateway_data = $this->billing->gateway($gid);
            $salt = $gateway_data['key2'];

// Salt should be same Post Request

            if ($this->input->post('additionalCharges', true)) {
                $additionalCharges = $this->input->post("additionalCharges", true);
                $retHashSeq = $additionalCharges . '|' . $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
            } else {
                $retHashSeq = $salt . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
            }
            $hash = hash("sha512", $retHashSeq);
            if ($hash != $posted_hash) {
                echo "Invalid Transaction. Please try again";
            } elseif ($status == 'success') {

                //tt
                $tid = $this->input->get('inv', true);
                $customer = $this->invocies->invoice_details($tid);
                $note = 'Card Payment for #' . $customer['tid'] . ' T#' . $txnid;
                $pmethod = 'Card';
                $amount_o = $customer['total'] - $customer['pamnt'];
                $surcharge = ($amount_o * $gateway_data['surcharge']) / 100;
                $amount_t = $amount_o + $surcharge;
                $validtoken = hash_hmac('ripemd160', $tid, $this->config->item('encryption_key'));
                if (number_format($amount_t, 2, '.', '') == $amount) {
                    $amount = number_format($amount_o, 2, '.', '');
                    if ($this->billing->paynow($customer['iid'], $amount, $note, $pmethod, $customer['loc'])) {

                        redirect(base_url('billing/view?id=' . $tid . '&token=' . $validtoken));
                    }
                }
            } else {
                $tid = $this->input->get('inv', true);
                $validtoken = hash_hmac('ripemd160', $tid, $this->config->item('encryption_key'));
                echo "Invalid Transaction. Please try again";
                redirect(base_url('billing/view?id=' . $tid . '&token=' . $validtoken));
            }

        } else {
            $data['gateway_data'] = $this->billing->gateway($gid);
            $data['tid'] = $this->input->get('inv', true);
            $this->load->view('gateways/card_razor_verify', $data);
        }
    }

    public function gateway_process()
    {
        //for paypal
        $invoice = $this->input->post('id', true);
        $token = $this->input->post('token', true);

        $gateway_data = $this->billing->gateway(4);
        $paypalConfig = [
            'sandbox' => $gateway_data['dev_mode'],
            'client_id' => $gateway_data['key1'],
            'client_secret' => $gateway_data['key2'],
            'return_url' => base_url('billing/gateway_response'),
            'cancel_url' => base_url('billing/view?id=' . $invoice . '&token=' . $token),
        ];

        $this->load->library("Paypal_gateway", $paypalConfig);

        $apiContext = $this->paypal_gateway->getApiContext();

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

// Set some example data for the payment.
        $customer = $this->invocies->invoice_details($invoice);
        if (!$customer['tid']) {
            exit();
        }
        $amount = number_format($this->input->post('amount', true), 2, '.', '');
        if ($customer['multi'] > 0) {
            $multi_currency = $this->invocies->currency_d($customer['multi']);
            //    $amount =  $amount;
            $gateway_data['currency'] = $multi_currency['code'];

        }
        if ($customer['loc'] > 0) {
            $multi_currency = $this->invocies->currency_d($customer['multi'], $customer['loc']);
            //        $amount =  $amount;
            $gateway_data['currency'] = $multi_currency['code'];

        }
        $validtoken = hash_hmac('ripemd160', $invoice, $this->config->item('encryption_key'));
        $surcharge = ($amount * $gateway_data['surcharge']) / 100;
        $amount_t = $amount + $surcharge;
        $amount = number_format($amount_t, 2, '.', '');

        if (hash_equals($token, $validtoken)) {

            $amountPayable = $amount;
            $invoiceNumber = $invoice;

            $amount = new Amount();
            $amount->setCurrency($gateway_data['currency'])
                ->setTotal($amountPayable);

            $transaction = new Transaction();
            $transaction->setAmount($amount)
                ->setDescription('Some description about the payment being made')
                ->setInvoiceNumber($invoiceNumber);

            $redirectUrls = new RedirectUrls();
            $redirectUrls->setReturnUrl($paypalConfig['return_url'])
                ->setCancelUrl($paypalConfig['cancel_url']);

            $payment = new Payment();
            $payment->setIntent('sale')
                ->setPayer($payer)
                ->setTransactions([$transaction])
                ->setRedirectUrls($redirectUrls);

            try {
                $payment->create($apiContext);
                $this->billing->token($invoice, 1);
            } catch (Exception $e) {
                throw new Exception('Unable to create link for payment');
            }

            header('location:' . $payment->getApprovalLink());
            exit(1);
        }

    }

    public function gateway_response()
    {
        if (empty($this->input->get('paymentId', true)) || empty($this->input->get('PayerID', true))) {
            exit;
        }
        $gateway_data = $this->billing->gateway(4);
        $paypalConfig = [
            'sandbox' => $gateway_data['dev_mode'],
            'client_id' => $gateway_data['key1'],
            'client_secret' => $gateway_data['key2'],
            'return_url' => base_url('billing/gateway_response'),
            'cancel_url' => base_url('billing/view?id=105&token=ee2f511d44dd7f0212d46b92f2d6022754574bb3'),
        ];
        $this->load->library("Paypal_gateway", $paypalConfig);
        $apiContext = $this->paypal_gateway->getApiContext();
        $paymentId = $_GET['paymentId'];
        $payment = Payment::get($paymentId, $apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($_GET['PayerID']);
        try {
            // Take the payment
            $payment->execute($execution, $apiContext);
            try {
                $payment = Payment::get($paymentId, $apiContext);
                $data = [
                    'transaction_id' => $payment->getId(),
                    'payment_amount' => $payment->transactions[0]->amount->total,
                    'payment_status' => $payment->getState(),
                    'invoice_id' => $payment->transactions[0]->invoice_number,
                ];
                $validtoken = hash_hmac('ripemd160', $data['invoice_id'], $this->config->item('encryption_key'));
                $paypalConfig['bill_url'] = base_url('billing/view?id=' . $data['invoice_id'] . '&token=' . $validtoken);
                if ($data['payment_status'] === 'approved') {
                    $customer = $this->invocies->invoice_details($data['invoice_id']);
                    $amount_o = $data['payment_amount'];

                    $amount_o = rev_amountExchange_s($amount_o, $customer['multi'], $customer['loc']);

                    $note = 'Card Payment for #' . $customer['tid'];
                    $pmethod = 'Card';
                    if ($customer['multi'] > 0) {
                        //    $amount =  $amount;
                        $note .= ' (Currency Conversion Applied)';
                    }
                    if ($customer['loc'] > 0) {

                        $note .= ' (Currency Conversion Applied)';
                    }
                    $amount = $amount_o / (($gateway_data['surcharge'] / 100) + 1);
                    $amount_o = number_format($amount, 2, '.', '');
                    $valid = $this->billing->token($customer['iid'], 2);
                    if ($valid['rid'] == $customer['iid']) {
                        $this->billing->paynow($customer['iid'], $amount_o, $note, $pmethod, $customer['loc']);
                        $this->billing->token($customer['iid'], 3);
                    }
                    header('location:' . $paypalConfig['bill_url']);
                    exit(1);
                } else {
                    // Payment failed
                    header('location:' . $paypalConfig['bill_url']);
                    exit(1);
                }
            } catch (Exception $e) {
                // Failed to retrieve payment from PayPal
                $this->billing->token($customer['iid'], 3);
                header('location:' . base_url());
            }
        } catch (Exception $e) {
            // Failed to take payment
            $this->billing->token($customer['iid'], 3);
            header('location:' . base_url());
        }
    }

    public function process_stripe()
    {
        echo 'Payment processing do no hit back button.....';
    }

    public function stripe_api_response()
    {

        $data['gateway'] = $this->billing->gateway(1);
        echo json_encode(['publishableKey' => $data['gateway']['key2']]);
    }

    public function generateResponse($intent)
    {
        switch ($intent->status) {
            case "requires_action":
            case "requires_source_action":
                // Card requires authentication
                return [
                    'requiresAction' => true,
                    'paymentIntentId' => $intent->id,
                    'clientSecret' => $intent->client_secret,
                ];
            case "requires_payment_method":
            case "requires_source":
                // Card was not properly authenticated, suggest a new payment method
                return [
                    'error' => "Your card was denied, please provide a new payment method",
                ];
            case "succeeded":
                // Payment is complete, authentication not required
                // To cancel the payment after capture you will need to issue a Refund (https://stripe.com/docs/api/refunds)
                return ['clientSecret' => $intent->client_secret];
        }
    }

    public function sharepeppolinvoice()
    {

        $tid = $this->input->get('id');
        $type = $this->input->get('type');
        $data['id'] = $tid;
        $this->limited = '';
        $data['invoice'] = $this->invocies->invoice_details($tid, $this->limited);

        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;
        $data['c_custom_fields'] = $this->customers->mydetails($data['invoice']['cid']);
        $invoice_status = $data['invoice']['status'];
        // if($invoice_status == 'due')
        // {

        if ($type != 'canceled') {
            $email = 'sprasad96@gmail.com';

            $c_data = [
                "emails" => [$email],
                "eIdentifiers" => [["scheme" => "NL:KVK", "id" => "60881119"],
                    ["scheme" => "NL:VAT", "id" => "NL123456789B45"]],
            ];

        } else if ($type == 'reciever') {
            $email = 'mr.s.sivaprasad@gmail.com';
            $c_data = [
                "emails" => [$email],
                "eIdentifiers" => [],
            ];

        } else if ($type == 'customer') {
            $email = $data['c_custom_fields']['email'];
            //$email = 'sivaprasadsunkara@live.com';
            $c_data = [
                "emails" => [$email],
                "eIdentifiers" => [],
            ];

        }
        if (!empty($data['invoice']['postbox']) && mb_strlen($data['invoice']['postbox']) > 2) {
            $postbox = $data['invoice']['postbox'];
        } else {
            $postbox = $data['invoice']['postbox'] . "...";
        }

        if (!empty($data['invoice']['address']) && mb_strlen($data['invoice']['address']) > 2) {
            $address = $data['invoice']['address'];
        } else {
            $address = $data['invoice']['address'] . "...";
        }

        if (!empty($data['invoice']['city']) && mb_strlen($data['invoice']['city']) > 2) {
            $city = $data['invoice']['city'];
        } else {
            $city = $data['invoice']['city'] . "...";
        }

        $arrayVar = [
            "legalEntityId" => 215184,
            "routing" => $c_data,
            "document" => [
                "documentType" => "invoice",
                "invoice" => [
                    "invoiceNumber" => strval(mt_rand(10000000, 99999999)),
                    "issueDate" => "2021-12-07",
                    "documentCurrencyCode" => "EUR",
                    "taxSystem" => "tax_line_percentages",
                    "accountingCustomerParty" => [
                        "party" => [
                            "companyName" => $data['invoice']['company'],
                            "address" => [
                                "street1" => $address,
                                "zip" => $postbox,
                                "city" => $city,
                                // "country" => $data['invoice']['country'],
                                "country" => "NL",
                            ],
                        ],
                        "publicIdentifiers" => [
                            ["scheme" => "NL:KVK", "id" => "60881119"],
                            ["scheme" => "NL:VAT", "id" => "NL123456789B45"],
                        ],
                    ],
                    "invoiceLines" => [
                        [
                            "description" => "The things you purchased",
                            "amountExcludingVat" => 10,
                            "tax" => [
                                "percentage" => 0,
                                "category" => "reverse_charge",
                                "country" => "NL",
                            ],
                        ],
                    ],
                    "taxSubtotals" => [
                        [
                            "percentage" => 0,
                            "category" => "reverse_charge",
                            "country" => "NL",
                            "taxableAmount" => 10,
                            "taxAmount" => 0,
                        ],
                    ],
                    "paymentMeansArray" => [
                        [
                            "account" => "NL50ABNA0552321249",
                            "holder" => "Storecove",
                            "code" => "credit_transfer",
                        ],
                    ],
                    "amountIncludingVat" => 10,
                ],
            ],
        ];

        $jsonArray = json_encode($arrayVar, true);
        // echo $jsonArray;
        // exit;
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.storecove.com/api/v2/document_submissions',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST, false,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonArray,
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Bearer 5dcWDOCNH5VjMrzTsEAikCZ6FKnba8_qPL2yHCfx378 ',
                'Content-Type: application/json',
            ),
        ));

        $response = curl_exec($curl);
        $errors = curl_error($curl);
        curl_close($curl);

        // echo "<pre>"; echo $response; echo "</pre>";
        // echo "<pre>"; echo $errors; echo "</pre>";
        // exit;
        // print_r($errors);
        // exit;
        if (empty($errors)) {

            $response = json_decode($response, true);
            $guid = $response['guid'];
            $data1['guid'] = strval($guid);
            // $encodedGUID = urlencode($dynamicGUID);
            // // get confirmation by guid
            // $curl1 = curl_init();
            // $curl_url = 'https://api.storecove.com/api/v2/document_submissions/'.$guid.'/evidence';
            // //echo $curl_url;
            // curl_setopt_array($curl1, array(
            // CURLOPT_URL => $curl_url,
            // CURLOPT_RETURNTRANSFER => true,
            // CURLOPT_ENCODING => '',
            // CURLOPT_MAXREDIRS => 10,
            // CURLOPT_TIMEOUT => 0,
            // CURLOPT_FOLLOWLOCATION => true,
            // CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            // CURLOPT_CUSTOMREQUEST => 'GET',
            // CURLOPT_HTTPHEADER => array(
            //     'Accept: application/json',
            //     'Authorization: Bearer 5dcWDOCNH5VjMrzTsEAikCZ6FKnba8_qPL2yHCfx378',
            //     'Content-Type: application/json'
            // ),
            // ));

            // $response1 = curl_exec($curl1);
            // $errors1 = curl_error($curl1);
            // curl_close($curl1);

            $curl = curl_init();
            $ccc_url = "https://api.storecove.com/api/v2/document_submissions/325c39cc-197c-430e-98e0-f2ab7bd604ae/evidence";
            //$ccc1_url = '"https://api.storecove.com/api/v2/document_submissions/"'.$guid.'"/evidence"';

            //    echo $ccc_url."<br>";
            //    echo $ccc1_url;
            //    exit;
            //echo $ccc_url;

            curl_setopt_array($curl, array(
                CURLOPT_URL => $ccc_url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER, false,
                CURLOPT_SSL_VERIFYHOST, false,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    'Authorization: Bearer 5dcWDOCNH5VjMrzTsEAikCZ6FKnba8_qPL2yHCfx378 ',
                    'Content-Type: application/json',
                ),
            ));

            $response1 = curl_exec($curl);
            $errors1 = curl_error($curl);
            curl_close($curl);
            //echo $response1;
            // exit;
            $data1['evidence_json'] = $response1;

            // echo "<pre>"; echo $response1; echo "</pre>";
            // echo "<pre>"; echo $errors1; echo "</pre>";

            $response1 = json_decode($response1, true);

            //echo "<pre>"; print_r($response1); echo "</pre>";
            //exit;

            if (empty($errors1)) {

                $documents = $response1['documents'];

                if (!empty($documents)) {
                    foreach ($documents as $doc) {
                        if ($doc['mime_type'] == 'application/xml') {
                            $data1['document_url'] = $doc['document'];
                            $data1['document_expire_date'] = $doc['expires_at'];
                        }
                    }
                }
            }
            $p_invoice_id = $data['invoice']['id'];
            $p_invoice_sent_date = date('Y-m-d');
            $p_invoice_json = $jsonArray;

            $data1['invoice_id'] = $p_invoice_id;
            $data1['invoice_sent_date'] = $p_invoice_sent_date;
            $data1['invoice_json'] = $p_invoice_json;
//exit;
            if ($this->db->where('invoice_id', $p_invoice_id)->get('gtg_peppol_invoices')->num_rows() > 0) {
                // echo $this->db->last_query();
                // exit;
                if ($this->db->where('invoice_id', $p_invoice_id)->update('gtg_peppol_invoices', $data1)) {

                    $this->session->set_flashdata('messagePr', 'Invoice Sent Successfully');
                } else {

                    $this->session->set_flashdata('messagePr', 'Invoice Sent Successfully, But Storing Failed');
                }

            } else {
                if ($this->db->insert('gtg_peppol_invoices', $data1)) {

                    $this->session->set_flashdata('messagePr', 'Invoice Sent Successfully');
                } else {

                    $this->session->set_flashdata('messagePr', 'Invoice Sent Successfully, But Storing Failed');
                }
            }

        } else {

            $this->session->set_flashdata('messagePr', 'Invoice Sent Failed');
        }
        // }else{
        //         $this->session->set_flashdata('messagePr', 'Invoice Can\'t be Sent, Invoice status is '.$invoice_status);
        // }
        redirect(base_url() . 'invoices/view?id=' . $tid, 'refresh');
    }


    
    public function contract_share_view()
    {
       

        $contract_id = $this->input->get('id');
        $token = $this->input->get('token');
        $validtoken = hash_hmac('ripemd160', $contract_id, $this->config->item('encryption_key'));
        if (hash_equals($token, $validtoken)) {
             // Load the contract details from the contract_model
             $contract = $this->contract_model->get_contract_by_id($contract_id);
             
             $data['system_data'] = $this->db->get('gtg_system')->result_array();  
             $data['contract_signings'] = $this->db->where('contract_id',$contract_id)->order_by('signed_date','DESC')->get('gtg_contract_signings')->result_array();        
             $data['contract'] = $contract;

            if ($contract) {
                // Load the associated upload files from the uploads_model
                $data['upload_files'] = $this->uploads_model->get_upload_files_by_contract_id($contract_id);
        
                $head['usernm'] = '';
                $head['title'] = 'Contract Sharing';
                // $data = array();
                $this->load->view('billing/header', $head);
                $this->load->view('billing/contract_share_view', $data);
                $this->load->view('billing/footer');


            } else {
                // Handle contract not found error
                echo "Contract not found.";
            }
        }
    }


    public function digital_signature_share_view()
    {
       

        $ds_id = $this->input->get('id');
        $token = $this->input->get('token');
        $validtoken = hash_hmac('ripemd160', $ds_id, $this->config->item('encryption_key'));
        if (hash_equals($token, $validtoken)) {
             // Load the contract details from the contract_model
             $digital_signature = $this->digitalsignature_model->get_digital_signature_by_id($ds_id);
             
             $data['system_data'] = $this->db->get('gtg_system')->result_array();  
             $data['ds_signings'] = $this->db->where('ds_id',$ds_id)->order_by('signed_date','DESC')->get('gtg_digital_signature_signings')->result_array();        
             $data['digital_signatures'] = $digital_signature;

            if ($digital_signature) {

                $head['title'] = 'Digital Signing';
                // $data = array();
                $this->load->view('billing/header', $head);
                $this->load->view('billing/digital_signature_share_view', $data);
                $this->load->view('billing/footer');


            } else {
                // Handle contract not found error
                echo "Digital Signature not found.";
            }
        }
    }
    
    public function save_signing_details(){

        $contract_id = $this->input->post('contract_id');

        $contract = $this->contract_model->get_contract_by_id($contract_id);
        $contract_docs =  $this->db->where('contract_id',$contract_id)->get('gtg_uploads')->result_array();
       
        // echo "<pre>"; print_r($contract_signings); echo "</pre>";
        // exit;
        if(!empty($this->input->post('contract_remarks')))
        {
            
            $contract_remarks = $this->input->post('contract_remarks');
            
        }else{
            
            $contract_remarks = '';
        }


        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
        $config['upload_path'] = './userfiles/contract_docs';

        $file_name = explode('.',$_FILES['file']['name']);
        $media_type = $file_name[1];
        if(!empty($file_name))
        {
            
            $config['file_name'] = preg_replace('/\s+/', '_', $file_name[0].strtotime("now").".".$file_name[1]);
        }
        

        $this->load->library('upload', $config);

        // Check if the file is uploaded successfully
        if ($this->upload->do_upload('file')) {
            $file_data = $this->upload->data();
            
            // Access other form data
            $contract_id = $this->input->post('contract_id');
            $contract_remarks = $this->input->post('contract_remarks');

            $name = preg_replace('/\s+/', '_', $file_name[0].strtotime("now").".".$file_name[1]);
            $file_path = base_url().'userfiles/contract_docs/'.$name;


            $data = array(
                'file_name' => $file_data['file_name'],
                'file_type' => $file_data['file_type'],
                'file_size' => $file_data['file_size'],
                'file_path' => $file_path,
                'upload_date' => date('Y-m-d H:i:s')
            );

           
        } else {
            // Handle upload errors
           
            $response['status'] = 500;
            $response['message'] = "File Upload Error";
                
            echo json_encode($response);
        }

        $data['signed_date'] = date('Y-m-d h:i:s');
        $data['contract_remarks'] = $contract_remarks;
        $data['contract_id'] = $contract_id;       

        // Send the email
        if ($this->db->insert('gtg_contract_signings',$data)) {

            $contract_signings_count =  $this->db->where('contract_id',$contract_id)->get('gtg_contract_signings')->num_rows();
            $contract_signings = $this->db->where('contract_id',$contract_id)->order_by('signed_date','DESC')->get('gtg_contract_signings')->result_array();        

            if($contract['sharing_count'] <= $contract_signings_count)
            {
                $c_data['status'] = 'COMPLETED';

            }else{
                
                $c_data['status'] = 'INPROGRESS';
            }
            
            if ($this->db->where('id',$contract_id)->update('gtg_contract',$c_data)) {


                // saving document to client docs
            if(!empty($contract['client_id']))
            {
                //if(!empty($contract_docs)){ foreach($contract_docs as $con_docs){ 

                    $f_data['title'] = $contract['name'];
                    $f_data['filename'] = $contract_signings[0]['file_path'];
                    $f_data['cdate'] = date('d-m-Y',strtotime($contract['cr_date']));
                    $f_data['cid'] = $contract['client_id'];
                    $f_data['userid'] = 0;
                    $f_data['rid'] = 1;
                    $f_data['contract_id'] = $contract_id;

                    $ff_data[] = $f_data;
                //}}
               
                // echo "<pre>"; print_r($ff_data); echo "</pre>";
                // exit;
                $this->db->insert_batch('gtg_documents', $ff_data);
            }
    

            
                $response['status'] = 200;
                $response['message'] = "Contract Signing Details Saved Successfully";
                
            } else {
                
                $response['status'] = 500;
                $response['message'] = "Contract Signing Details Saving Failed";

            }

        } else {
            
                $response['status'] = 200;
                $response['message'] = "Contract Signing Details Saving Failed";
        }

        echo json_encode($response);

    }

    public function save_ds_signing_details(){

        $ds_id = $this->input->post('ds_id');

        $digital_signature = $this->digitalsignature_model->get_digital_signature_by_id($ds_id);
      

        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
        $config['upload_path'] = './userfiles/ds_docs';

        $file_name = explode('.',$_FILES['pdfData']['name']);
        $media_type = $file_name[1];
        if(!empty($file_name))
        {
            
            $config['file_name'] = preg_replace('/\s+/', '_', $file_name[0].strtotime("now").".".$file_name[1]);
        }
        

        $this->load->library('upload', $config);

        // Check if the file is uploaded successfully
        if ($this->upload->do_upload('pdfData')) {
            $file_data = $this->upload->data();
            
            // Access other form data
            $ds_id = $this->input->post('ds_id');
            $name = preg_replace('/\s+/', '_', $file_name[0].strtotime("now").".".$file_name[1]);
            $file_path = base_url().'userfiles/ds_docs/'.$name;


            $data = array(
                'file_name' => $file_data['file_name'],
                'file_type' => $file_data['file_type'],
                'file_size' => $file_data['file_size'],
                'file_path' => $file_path,
                'upload_date' => date('Y-m-d H:i:s')
            );

           
        } else {
            // Handle upload errors
            // $error_message = $this->upload->display_errors();
            // echo "File Upload Error: " . $error_message;
            $response['status'] = 500;
            $response['message'] = "File Upload Error";
                
            echo json_encode($response);
        }

        $data['signed_date'] = date('Y-m-d h:i:s');
        $data['ds_id'] = $ds_id;       

        // Send the email
        if ($this->db->insert('gtg_digital_signature_signings',$data)) {

            //$ds_signings_count =  $this->db->where('ds_id',$ds_id)->get('gtg_digital_signature_signings')->num_rows();
            $ds_signings = $this->db->where('ds_id',$ds_id)->order_by('signed_date','DESC')->get('gtg_digital_signature_signings')->result_array();        
            $ds_signings_count = count($ds_signings);
            if($digital_signature['sharing_count'] <= $ds_signings_count)
            {
                $c_data['status'] = 'COMPLETED';

            }else{
                
                $c_data['status'] = 'INPROGRESS';
            }
            
            if ($this->db->where('id',$ds_id)->update('gtg_digital_signatures',$c_data)) {


                // saving document to client docs
                $response['status'] = 200;
                $response['message'] = "Digtial Signing Details Saved Successfully";
                
            } else {
                
                $response['status'] = 500;
                $response['message'] = "Digtial Signing Details Saving Failed";

            }

        } else {
            
                $response['status'] = 200;
                $response['message'] = "Digtial Signing Details Saving Failed";
        }

        echo json_encode($response);

    }

    
}
