<?php


defined('BASEPATH') or exit('No direct script access allowed');

use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

class Ecommerce extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('invoices_model', 'invocies');
        $this->load->model('plugins_model', 'plugins');
        $this->load->model('ecommerce_model', 'ecommerce');
        $this->load->library("Aauth");

        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if (!$this->aauth->premission(1)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }

        if (($this->aauth->get_user()->roleid == 5)||($this->aauth->get_user()->roleid == 4)) {
            $this->limited = '';
        } else {
            $this->limited = $this->aauth->get_user()->id;
        }
        $this->load->library("Custom");
        $this->li_a = 'sales';
    }

    //invoices list
    public function analytics()
    {
        $head['title'] = "E-Commerce Analytics";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['online_sales'] = $this->ecommerce->getInvoiceCountByType(1);
        $data['offline_sales'] = $this->ecommerce->getInvoiceCountByType(0);
        $data['online_prod_sales'] = $this->ecommerce->getInvoiceProductsCountByType(1);
        $data['offline_prod_sales'] = $this->ecommerce->getInvoiceProductsCountByType(0);

        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;
        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/analytics',$data);
        $this->load->view('fixed/footer');
    }


    public function sales_invoices_ajax_list()
    {
        $list = $this->ecommerce->get_sales_invoices_datatables($this->limited);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $invoices) {

            if($invoices->invoice_type == '0')
            {   
                $sale_type = 'offline';
            }else{
                $sale_type = 'online';
            }
            $no++;
            $row = array();
            $row[] = $no;

            $row[] = '<a href="' . base_url("invoices/view?id=$invoices->id") . '">&nbsp; ' . $invoices->tid . '</a>';
            $row[] = $invoices->name;
            $row[] = $sale_type;
            // $row[] = dateformat($invoices->invoice_sent_date);
            $row[] = amountExchange($invoices->total, 0, $this->aauth->get_user()->loc);
            $row[] = amountExchange($invoices->pamnt, 0, $this->aauth->get_user()->loc);
            $row[] = '<span class="st-' . $invoices->status . '">' . $this->lang->line(ucwords($invoices->status)) . '</span>';
           
            $row[] = '<a href="' . base_url("invoices/view?id=$invoices->id") . '" class="btn btn-success btn-sm" title="View"><i class="fa fa-eye"></i></a>&nbsp;<a href="' . base_url("invoices/printinvoice?id=$invoices->id") . '&d=1" class="btn btn-info btn-sm"  title="Download"><span class="fa fa-download"></span></a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->invocies->count_peppol_invoices_all($this->limited),
            "recordsFiltered" => $this->invocies->count_peppol_invoices_filtered($this->limited),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}

