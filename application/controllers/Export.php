<?php


defined('BASEPATH') or exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_Controller
{
    var $date;

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
        $this->load->model('export_model', 'export');
        $this->load->model('jobsheet_model', 'jobsheet');
        $this->load->model('employee_model', 'employee');        
        $this->load->model('payroll_model', 'payroll');
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
            exit;
        }

        // if ($this->aauth->get_user()->roleid < 5) {

        //     exit('Not Allowed!');
        // }
        $this->date = 'backup_' . date('Y_m_d_H_i_s');
        $this->li_a = 'export';
    }


    function dbexport()
    {


        $head['title'] = "Backup Database";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('export/db_back');
        $this->load->view('fixed/footer');
    }


    function dbexport_c()
    {

        $this->load->dbutil();
        $backup = &$this->dbutil->backup();
        $this->load->helper('file');
        write_file('<?php  echo base_url();?>/downloads', $backup);
        $this->load->helper('download');
        force_download($this->date . '.gz', $backup);
    }


    function crm()
    {


        $head['title'] = "Export CRM Data";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('export/crm');
        $this->load->view('fixed/footer');
    }


    function crm_now()
    {


        $type = $this->input->post('type');

        switch ($type) {
            case 1:
                $this->customers();
                break;

            case 2:
                $this->suppliers();
                break;
        }
    }

    private function customers()
    {

        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=customers_' . $this->date . '..csv');
        header('Content-Transfer-Encoding: binary');
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = " WHERE loc='" . $this->aauth->get_user()->loc . "';";
        } elseif (!BDATA) {
            $whr = " WHERE loc='0';";
        }


        $query = $this->db->query("SELECT name,address,city,region,country,postbox,email,phone,company FROM gtg_customers $whr");
        echo "\xEF\xBB\xBF"; // Byte Order Mark
        echo $this->dbutil->csv_from_result($query);
        //  force_download('customers_' . $this->date . '.csv', );

    }

    private function suppliers()
    {
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = " WHERE loc='" . $this->aauth->get_user()->loc . "';";
        } elseif (!BDATA) {
            $whr = " WHERE loc='0';";
        }
        $query = $this->db->query("SELECT name,address,city,region,country,postbox,email,phone,company FROM gtg_supplier $whr");
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=suppliers_' . $this->date . '..csv');
        header('Content-Transfer-Encoding: binary');
        echo "\xEF\xBB\xBF"; // Byte Order Mark
        echo $this->dbutil->csv_from_result($query);
    }

    function transactions()
    {
        $this->load->model('transactions_model');
        $data['accounts'] = $this->transactions_model->acc_list();
        $head['title'] = "Export Transactions";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('export/transactions', $data);
        $this->load->view('fixed/footer');
    }

    function transactions_o()
    {
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = " AND loc='" . $this->aauth->get_user()->loc . "';";
        } elseif (!BDATA) {
            $whr = " AND loc='0';";
        }

        $pay_acc = $this->input->post('pay_acc');
        $trans_type = $this->input->post('trans_type');
        $sdate = datefordatabase($this->input->post('sdate'));
        $edate = datefordatabase($this->input->post('edate'));
        if ($pay_acc == 'All') {
            if ($trans_type == 'All') {
                $where = " WHERE (DATE(date) BETWEEN '$sdate' AND '$edate') ";
            } else {
                $where = " WHERE (DATE(date) BETWEEN '$sdate' AND '$edate') AND type='$trans_type'";
            }
        } else {
            if ($trans_type == 'All') {
                $where = " WHERE acid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') ";
            } else {
                $where = " WHERE acid='$pay_acc' AND (DATE(date) BETWEEN '$sdate' AND '$edate') AND type='$trans_type'";
            }
        }

        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=transactions_' . $this->date . '..csv');
        header('Content-Transfer-Encoding: binary');
        $query = $this->db->query("SELECT account,type,cat AS category,debit,credit,payer,method,date,note FROM gtg_transactions" . $where . ' ' . $whr);
        echo "\xEF\xBB\xBF"; // Byte Order Mark
        echo $this->dbutil->csv_from_result($query);
    }


    function products()
    {
        $head['title'] = "Export Products";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('export/products');
        $this->load->view('fixed/footer');
    }

    function products_o()
    {
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = "LEFT JOIN gtg_warehouse ON gtg_products.warehouse=gtg_warehouse.id WHERE gtg_warehouse.loc='" . $this->aauth->get_user()->loc . "';";
        } elseif (!BDATA) {
            $whr = "LEFT JOIN gtg_warehouse ON gtg_products.warehouse=gtg_warehouse.id WHERE gtg_warehouse.loc='0';";
        }

        $type = $this->input->post('type');
        $query = '';
        switch ($type) {
            case 1:
                $query = "SELECT product_name,product_code,product_price,fproduct_price AS factory_price,taxrate,disrate AS discount_rate,qty FROM gtg_products $whr";
                break;

            case 2:
                $query = "SELECT gtg_product_cat.title as category,gtg_products.product_name,gtg_products.product_code,gtg_products.product_price,gtg_products.fproduct_price AS factory_price,gtg_products.taxrate,gtg_products.disrate AS discount_rate,gtg_products.qty FROM gtg_products LEFT JOIN gtg_product_cat ON gtg_products.pcat=gtg_product_cat.id $whr";
                break;
        }
        $query = $this->db->query($query);
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=transactions_' . $this->date . '..csv');
        header('Content-Transfer-Encoding: binary');


        echo "\xEF\xBB\xBF"; // Byte Order Mark
        echo $this->dbutil->csv_from_result($query);
    }


    function account()
    {


        $this->load->model('transactions_model');
        $this->load->model('employee_model');
        $data['cat'] = $this->transactions_model->categories();
        $data['emp'] = $this->employee_model->list_employee();
        $data['accounts'] = $this->transactions_model->acc_list();
        $head['title'] = "Export Transactions";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('export/account', $data);
        $this->load->view('fixed/footer');
    }

    function accounts_o()
    {
        $this->load->model('reports_model');
        $this->load->model('accounts_model');

        $pay_acc = $this->input->post('pay_acc');
        $trans_type = $this->input->post('trans_type');
        $sdate = datefordatabase($this->input->post('sdate'));
        $edate = datefordatabase($this->input->post('edate'));
        $data['account'] = $this->accounts_model->details($pay_acc);


        $data['list'] = $this->reports_model->get_statements($pay_acc, $trans_type, $sdate, $edate);

        $data['lang']['statement'] = $this->lang->line('Account Statement');
        $data['lang']['title'] = $this->lang->line('Account');
        $data['lang']['var1'] = $data['account']['holder'];
        $data['lang']['var2'] = $data['account']['acn'];

        $loc = location($this->aauth->get_user()->loc);
        $company = '<strong>' . $loc['cname'] . '</strong><br>' . $loc['address'] . '<br>' . $loc['city'] . ', ' . $loc['region'] . '<br>' . $loc['country'] . ' -  ' . $loc['postbox'] . '<br>' . $this->lang->line('Phone') . ': ' . $loc['phone'] . '<br> ' . $this->lang->line('Email') . ': ' . $loc['email'];
        if ($loc['taxid']) $company .= '<br>' . $this->lang->line('Tax') . ' ID: ' . $loc['taxid'];
        $data['lang']['company'] = $company;


        $html = $this->load->view('accounts/statementpdf-' . LTR, $data, true);


        ini_set('memory_limit', '64M');


        $this->load->library('pdf');

        $pdf = $this->pdf->load();


        $pdf->WriteHTML($html);


        $pdf->Output('Statement' . $pay_acc . '.pdf', 'D');
    }

    function employee()
    {
        $this->load->model('reports_model');
        $this->load->model('accounts_model');

        $pay_acc = $this->input->post('employee');
        $trans_type = $this->input->post('trans_type');
        $sdate = datefordatabase($this->input->post('sdate'));
        $edate = datefordatabase($this->input->post('edate'));
        $this->load->model('employee_model');
        $data['employee'] = $this->employee_model->employee_details($pay_acc);


        $data['list'] = $this->reports_model->get_statements_employee($pay_acc, $trans_type, $sdate, $edate);

        $data['lang']['statement'] = $this->lang->line('Employee Account Statement');
        $data['lang']['title'] = $this->lang->line('Employee');
        $data['lang']['var1'] = $data['employee']['name'];
        $data['lang']['var2'] = $data['employee']['email'];
        $loc = location($this->aauth->get_user()->loc);
        $company = '<strong>' . $loc['cname'] . '</strong><br>' . $loc['address'] . '<br>' . $loc['city'] . ', ' . $loc['region'] . '<br>' . $loc['country'] . ' -  ' . $loc['postbox'] . '<br>' . $this->lang->line('Phone') . ': ' . $loc['phone'] . '<br> ' . $this->lang->line('Email') . ': ' . $loc['email'];
        if ($loc['taxid']) $company .= '<br>' . $this->lang->line('Tax') . ' ID: ' . $loc['taxid'];
        $data['lang']['company'] = $company;


        $html = $this->load->view('accounts/statementpdf-' . LTR, $data, true);


        ini_set('memory_limit', '64M');


        $this->load->library('pdf');

        $pdf = $this->pdf->load();


        $pdf->WriteHTML($html);


        $pdf->Output('Statement' . $pay_acc . '.pdf', 'D');
    }

    function trans_cat()
    {
        $this->load->model('reports_model');
        $this->load->model('transactions_model');

        $pay_cat = $this->input->post('pay_cat', true);
        $trans_type = $this->input->post('trans_type');
        $sdate = datefordatabase($this->input->post('sdate'));
        $edate = datefordatabase($this->input->post('edate'));
        $data['cat'] = $this->transactions_model->cat_details_name($pay_cat);


        $data['list'] = $this->reports_model->get_statements_cat($pay_cat, $trans_type, $sdate, $edate);

        $data['lang']['statement'] = $this->lang->line('Transaction Categories Statement');
        $data['lang']['title'] = $this->lang->line('Transaction Categories');
        $data['lang']['var1'] = $data['cat']['name'];
        $data['lang']['var2'] = '';
        $loc = location($this->aauth->get_user()->loc);
        $company = '<strong>' . $loc['cname'] . '</strong><br>' . $loc['address'] . '<br>' . $loc['city'] . ', ' . $loc['region'] . '<br>' . $loc['country'] . ' -  ' . $loc['postbox'] . '<br>' . $this->lang->line('Phone') . ': ' . $loc['phone'] . '<br> ' . $this->lang->line('Email') . ': ' . $loc['email'];
        if ($loc['taxid']) $company .= '<br>' . $this->lang->line('Tax') . ' ID: ' . $loc['taxid'];
        $data['lang']['company'] = $company;
        $html = $this->load->view('accounts/statementpdf-' . LTR, $data, true);


        ini_set('memory_limit', '64M');


        $this->load->library('pdf');

        $pdf = $this->pdf->load();


        $pdf->WriteHTML($html);


        $pdf->Output('Statement' . $data['lang']['var1'] . '.pdf', 'D');
    }

    function customer()
    {
        $this->load->model('reports_model');
        $this->load->model('customers_model');

        $customer = $this->input->post('customer');
        $trans_type = $this->input->post('trans_type');
        $sdate = datefordatabase($this->input->post('sdate'));
        $edate = datefordatabase($this->input->post('edate'));
        $data['customer'] = $this->customers_model->details($customer);


        $data['list'] = $this->reports_model->get_customer_statements($customer, $trans_type, $sdate, $edate);

        $loc = location($this->aauth->get_user()->loc);
        $company = '<strong>' . $loc['cname'] . '</strong><br>' . $loc['address'] . '<br>' . $loc['city'] . ', ' . $loc['region'] . '<br>' . $loc['country'] . ' -  ' . $loc['postbox'] . '<br>' . $this->lang->line('Phone') . ': ' . $loc['phone'] . '<br> ' . $this->lang->line('Email') . ': ' . $loc['email'];
        if ($loc['taxid']) $company .= '<br>' . $this->lang->line('Tax') . ' ID: ' . $loc['taxid'];
        $data['lang']['company'] = $company;


        $html = $this->load->view('customers/statementpdf', $data, true);


        ini_set('memory_limit', '64M');


        $this->load->library('pdf');

        $pdf = $this->pdf->load();


        $pdf->WriteHTML($html);


        $pdf->Output('Statement' . $customer . '.pdf', 'D');
    }

    function supplier()
    {
        $this->load->model('reports_model');
        $this->load->model('supplier_model');

        $customer = $this->input->post('supplier');
        $trans_type = $this->input->post('trans_type');
        $sdate = datefordatabase($this->input->post('sdate'));
        $edate = datefordatabase($this->input->post('edate'));
        $data['customer'] = $this->supplier_model->details($customer);

        $data['list'] = $this->reports_model->get_supplier_statements($customer, $trans_type, $sdate, $edate);

        $loc = location($this->aauth->get_user()->loc);
        $company = '<strong>' . $loc['cname'] . '</strong><br>' . $loc['address'] . '<br>' . $loc['city'] . ', ' . $loc['region'] . '<br>' . $loc['country'] . ' -  ' . $loc['postbox'] . '<br>' . $this->lang->line('Phone') . ': ' . $loc['phone'] . '<br> ' . $this->lang->line('Email') . ': ' . $loc['email'];
        if ($loc['taxid']) $company .= '<br>' . $this->lang->line('Tax') . ' ID: ' . $loc['taxid'];
        $data['lang']['company'] = $company;

        $html = $this->load->view('supplier/statementpdf', $data, true);

        ini_set('memory_limit', '64M');

        $this->load->library('pdf');
        $pdf = $this->pdf->load();

        $pdf->WriteHTML($html);

        $pdf->Output('Statement' . $customer . '.pdf', 'D');
    }

    function taxstatement()
    {


        $head['title'] = "Export TAX Report";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('export/taxstatement');
        $this->load->view('fixed/footer');
    }

    function taxstatement_o()
    {
        $whr = '';
        $whr2 = '';
        if ($this->aauth->get_user()->loc) {
            $whr = " AND gtg_invoices.loc='" . $this->aauth->get_user()->loc . "';";
            $whr2 = " AND gtg_purchase.loc='" . $this->aauth->get_user()->loc . "';";
        } elseif (!BDATA) {
            $whr = " AND gtg_invoices.loc='0';";
            $whr2 = " AND gtg_purchase.loc='0';";
        }

        $sdate = datefordatabase($this->input->post('sdate'));
        $edate = datefordatabase($this->input->post('edate'));
        $trans_type = $this->input->post('ty');
        $prefix = $this->config->item('prefix') . '-';
        $curr = $this->config->item('currency') . ' ';

        $general_flag = true;

        if ($this->input->post('cz_tax')) {
            $general_flag = false;

            header("Content-Type:text/xml; charset=utf-8");
            header('Content-Disposition: attachment; filename="' . $sdate . '_' . $edate . '.xml"');
            $this->load->helper('xml');
            $dom = xml_dom();
            $MoneyData = xml_add_child($dom, 'MoneyData');
            xml_add_attribute($MoneyData, 'ExpDate', date('Y-m-d'));
            xml_add_attribute($MoneyData, 'ExpTime',  date('H:i:s'));
            xml_add_attribute($MoneyData, 'ExpZkratka', '_FV');
            xml_add_attribute($MoneyData, 'HospRokDo', date('Y') . '-12-31');
            xml_add_attribute($MoneyData, 'HospRokOd', date('Y') . '-01-01');
            xml_add_attribute($MoneyData, 'ICAgendy', '28635426');
            xml_add_attribute($MoneyData, 'KodAgendy', "");
            xml_add_attribute($MoneyData, 'VyberZaznamu', "0");
            xml_add_attribute($MoneyData, 'HospRokOd', date('Y') . '-01-01');
            xml_add_attribute($MoneyData, 'description', 'faktury vydané');
            $SeznamFaktVyd = xml_add_child($MoneyData, 'SeznamFaktVyd');


            $where = " WHERE (DATE(gtg_invoices.invoicedate) BETWEEN '$sdate' AND '$edate') $whr";
            $query = $this->db->query("SELECT gtg_customers.name,gtg_customers.address,gtg_customers.city,gtg_customers.postbox,gtg_customers.country,gtg_customers.docid,gtg_customers.taxid,gtg_customers.phone,gtg_customers.email,gtg_customers.company,gtg_invoices.tid,gtg_invoices.id AS inv_id,concat('$prefix',gtg_invoices.tid) AS invoice_number,gtg_invoices.total,gtg_invoices.tax,gtg_invoices.pmethod,gtg_invoices.tax, gtg_invoices.pmethod AS payment_method, gtg_invoices.invoicedate AS date,gtg_invoices.invoiceduedate FROM gtg_invoices LEFT JOIN gtg_customers ON gtg_invoices.csd=gtg_customers.id" . $where);

            $xml_result = $query->result_array();

            foreach ($xml_result as $xml_row) {


                //loop
                $FaktVyd = xml_add_child($SeznamFaktVyd, 'FaktVyd');
                xml_add_child($FaktVyd, 'Doklad', $xml_row['tid']);
                xml_add_child($FaktVyd, 'Popis', $xml_row['invoice_number']);
                xml_add_child($FaktVyd, 'Vystaveno', $xml_row['date']);

                $SouhrnDPH = xml_add_child($FaktVyd, 'SouhrnDPH');
                //SouhrnDPH
                xml_add_child($SouhrnDPH, 'Zaklad0', "0");
                xml_add_child($SouhrnDPH, 'Zaklad5', "0");
                xml_add_child($SouhrnDPH, 'Zaklad22', $xml_row['total'] - $xml_row['tax']);
                xml_add_child($SouhrnDPH, 'DPH5', "0");
                xml_add_child($SouhrnDPH, 'DPH22', $xml_row['tax']);
                //end
                //Celkem
                xml_add_child($FaktVyd, 'Celkem', $xml_row['total'] + $xml_row['tax']);
                xml_add_child($FaktVyd, 'Rada');
                xml_add_child($FaktVyd, 'CisRada');
                xml_add_child($FaktVyd, 'DatUcPr', $xml_row['date']);
                xml_add_child($FaktVyd, 'PlnenoDPH', $xml_row['date']);
                xml_add_child($FaktVyd, 'Splatno', $xml_row['invoiceduedate']); //add 14days
                xml_add_child($FaktVyd, 'DatSkPoh', $xml_row['date']);
                xml_add_child($FaktVyd, 'KonstSym', "0008");
                xml_add_child($FaktVyd, 'KodDPH', "19Ř01,02");
                xml_add_child($FaktVyd, 'ZjednD', "0");
                xml_add_child($FaktVyd, 'VarSymbol', $xml_row['tid']);
                xml_add_child($FaktVyd, 'CObjednavk', $xml_row['tid']);
                xml_add_child($FaktVyd, 'Ucet', $xml_row['pmethod']);
                xml_add_child($FaktVyd, 'Druh', "N");
                xml_add_child($FaktVyd, 'Dobropis', "0");
                xml_add_child($FaktVyd, 'Uhrada', $xml_row['pmethod']);
                xml_add_child($FaktVyd, 'PredKontac', "FV001");
                xml_add_child($FaktVyd, 'StatMOSS');
                xml_add_child($FaktVyd, 'SazbaDPH1', "15");
                xml_add_child($FaktVyd, 'SazbaDPH2', "21");
                xml_add_child($FaktVyd, 'Proplatit', $xml_row['total']);
                xml_add_child($FaktVyd, 'Vyuctovano', "0");
                xml_add_child($FaktVyd, 'Typ', "ZBOŽÍ");
                xml_add_child($FaktVyd, 'PriUhrZbyv', "0");
                xml_add_child($FaktVyd, 'ValutyProp');
                xml_add_child($FaktVyd, 'SumZaloha', "0");
                xml_add_child($FaktVyd, 'SumZalohaC', "0");


                $DodOdb = xml_add_child($FaktVyd, 'DodOdb');
                //DodOdb
                xml_add_child($DodOdb, 'ObchNazev', $xml_row['name'], true);
                //Address
                $ObchAdresa = xml_add_child($DodOdb, 'ObchAdresa');
                xml_add_child($ObchAdresa, 'Ulice', $xml_row['address'], true);
                xml_add_child($ObchAdresa, 'Misto', $xml_row['city'], true);
                xml_add_child($ObchAdresa, 'PSC', $xml_row['postbox']);
                xml_add_child($ObchAdresa, 'Stat', $xml_row['country'], true);
                //end address

                xml_add_child($DodOdb, 'FaktNazev', $xml_row['name'], true);
                xml_add_child($DodOdb, 'ICO', $xml_row['docid']);
                xml_add_child($DodOdb, 'DIC', $xml_row['taxid']);
                xml_add_child($DodOdb, 'DICSK');

                $FaktAdresa = xml_add_child($DodOdb, 'FaktAdresa');
                xml_add_child($FaktAdresa, 'Ulice', $xml_row['address'], true);
                xml_add_child($FaktAdresa, 'Misto', $xml_row['city'], true);
                xml_add_child($FaktAdresa, 'PSC', $xml_row['postbox']);
                xml_add_child($FaktAdresa, 'Stat', $xml_row['country'], true);
                //end address

                xml_add_child($DodOdb, 'Nazev', $xml_row['name'], true);

                $Tel = xml_add_child($DodOdb, 'Tel');
                xml_add_child($Tel, 'Cislo', $xml_row['phone']);

                xml_add_child($DodOdb, 'EMail', $xml_row['email']);
                xml_add_child($DodOdb, 'PlatceDPH', "0");
                xml_add_child($DodOdb, 'FyzOsoba', "0");
                //DodOdb end

                //KonecPrij Start
                $KonecPrij = xml_add_child($FaktVyd, 'KonecPrij');
                //
                xml_add_child($KonecPrij, 'Nazev', $xml_row['name'], true);
                //Address
                $Adresa = xml_add_child($KonecPrij, 'Adresa');
                xml_add_child($Adresa, 'Ulice', $xml_row['address'], true);
                xml_add_child($Adresa, 'Misto', $xml_row['city'], true);
                xml_add_child($Adresa, 'PSC', $xml_row['postbox']);
                xml_add_child($Adresa, 'Stat', $xml_row['country'], true);
                //end address

                $Tel = xml_add_child($KonecPrij, 'Tel');
                xml_add_child($Tel, 'Cislo', $xml_row['phone']);

                xml_add_child($KonecPrij, 'EMail', $xml_row['email']);
                xml_add_child($KonecPrij, 'PlatceDPH', "0");
                xml_add_child($KonecPrij, 'FyzOsoba', "0");
                //$KonecPrij End

                xml_add_child($FaktVyd, 'KPFromOdb', "1");

                //SeznamPolozek Starts
                $SeznamPolozek = xml_add_child($FaktVyd, 'SeznamPolozek');


                //////////////////////////////////////////////////////////////////////////CRITICAL MEMORY CONSUMPTION 128 REC PASS
                /// ///
                ///
                $product_query = $this->db->query("SELECT gtg_invoice_items.product, gtg_invoice_items.qty AS s_qty,gtg_invoice_items.price,gtg_invoice_items.tax,gtg_invoice_items.totaldiscount,gtg_invoice_items.product_des,gtg_products.unit,gtg_products.product_code ,gtg_products.barcode FROM gtg_invoice_items LEFT JOIN gtg_products ON gtg_invoice_items.pid=gtg_products.pid WHERE gtg_invoice_items.tid=" . $xml_row['inv_id']);
                $product_xml_result = $product_query->result_array();

                foreach ($product_xml_result as $product_xml_row) {

                    //products loop
                    $Polozka = xml_add_child($SeznamPolozek, 'Polozka');

                    xml_add_child($Polozka, 'PredKontac', "FV001");
                    xml_add_child($Polozka, 'Popis', $product_xml_row['product']);
                    xml_add_child($Polozka, 'PocetMJ', $product_xml_row['s_qty']);
                    xml_add_child($Polozka, 'ZbyvaMJ');
                    xml_add_child($Polozka, 'Cena', $product_xml_row['price']);
                    xml_add_child($Polozka, 'SazbaDPH', $product_xml_row['tax']);
                    xml_add_child($Polozka, 'TypCeny', "4");
                    xml_add_child($Polozka, 'CenaTyp', "4");
                    xml_add_child($Polozka, 'Sleva', $product_xml_row['totaldiscount']);
                    xml_add_child($Polozka, 'Vystaveno', $xml_row['date']);
                    xml_add_child($Polozka, 'Vyridit_do', $xml_row['date']);
                    xml_add_child($Polozka, 'Poradi');
                    xml_add_child($Polozka, 'Valuty', "0");
                    xml_add_child($Polozka, 'Stredisko');
                    xml_add_child($Polozka, 'PredPC');
                    xml_add_child($Polozka, 'CenaPoSleve');
                    xml_add_child($Polozka, 'CenovaHlad');
                    xml_add_child($Polozka, 'Hmotnost', $product_xml_row['s_qty']);

                    $KmKarta = xml_add_child($Polozka, 'KmKarta');
                    xml_add_child($KmKarta, 'Popis', $product_xml_row['product']);
                    xml_add_child($KmKarta, 'Zkrat', $product_xml_row['product_code']);
                    xml_add_child($KmKarta, 'MJ', $product_xml_row['unit']);
                    xml_add_child($KmKarta, 'Katalog', $product_xml_row['product_code']);
                    xml_add_child($KmKarta, 'BarCode', $product_xml_row['barcode']);
                    xml_add_child($KmKarta, 'TypZarDoby');
                    xml_add_child($KmKarta, 'ZarDoba');
                    xml_add_child($KmKarta, 'DesMist');
                    xml_add_child($KmKarta, 'Hmotnost', $product_xml_row['s_qty']);
                    xml_add_child($KmKarta, 'Objem');
                    xml_add_child($KmKarta, 'TypKarty');
                }
                //SeznamPolozek Ends

                $MojeFirma = xml_add_child($FaktVyd, 'MojeFirma');
                xml_add_child($MojeFirma, 'MenaSymb', "Kč");
                xml_add_child($MojeFirma, 'MenaKod', "CZK");
                xml_add_child($FaktVyd, 'ZpDopravy', $xml_row['name']);
                $Prepravce = xml_add_child($FaktVyd, 'Prepravce');
                xml_add_child($Prepravce, 'Zkrat');
                xml_add_child($Prepravce, 'Nazev', $xml_row['name']);
            }
            xml_print($dom);
        }


        if ($general_flag) {

            $this->load->dbutil();

            if ($trans_type == 'Sales') {
                $where = " WHERE (DATE(gtg_invoices.invoicedate) BETWEEN '$sdate' AND '$edate') $whr";
                $query = $this->db->query("SELECT gtg_customers.taxid AS TAX_Number,concat('$prefix',gtg_invoices.tid) AS invoice_number,concat('$curr',gtg_invoices.total) AS amount,gtg_invoices.shipping AS shipping,gtg_invoices.ship_tax AS ship_tax,gtg_invoices.ship_tax_type AS ship_tax_type,gtg_invoices.discount AS discount,gtg_invoices.tax AS tax,gtg_invoices.pmethod AS payment_method,gtg_invoices.status AS status,gtg_invoices.refer AS referance,gtg_customers.name AS customer_name,gtg_customers.company AS Company_Name,gtg_invoices.invoicedate AS date FROM gtg_invoices LEFT JOIN gtg_customers ON gtg_invoices.csd=gtg_customers.id" . $where);

                $csv_result = $this->dbutil->csv_from_result($query);
            } else {

                $where = " WHERE (DATE(gtg_purchase.invoicedate) BETWEEN '$sdate' AND '$edate') $whr";
                $query = $this->db->query("SELECT concat('$prefix',gtg_purchase.tid) AS receipt_number,concat('$curr',gtg_purchase.total) AS amount,gtg_purchase.tax AS tax,gtg_supplier.name AS supplier_name,gtg_supplier.company AS Company_Name,gtg_purchase.invoicedate AS date FROM gtg_purchase LEFT JOIN gtg_supplier ON gtg_purchase.csd=gtg_supplier.id" . $where);

                $csv_result = $this->dbutil->csv_from_result($query);
            }


            $this->load->helper('file');
            $this->load->helper('download');
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=tax_transactions_' . $this->date . '..csv');
            header('Content-Transfer-Encoding: binary');


            echo "\xEF\xBB\xBF"; // Byte Order Mark
            echo $csv_result;
        }
    }

    function people_products()
    {


        $this->load->model('transactions_model');
        $data['accounts'] = $this->transactions_model->acc_list();
        $head['title'] = "Export Product Transactions";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('export/product', $data);
        $this->load->view('fixed/footer');
    }


    function cust_products_o()
    {
        $this->load->model('reports_model');
        $this->load->model('customers_model');

        $customer = $this->input->post('customer');

        $sdate = datefordatabase($this->input->post('sdate'));
        $edate = datefordatabase($this->input->post('edate'));
        $data['customer'] = $this->customers_model->details($customer);


        $data['list'] = $this->reports_model->product_customer_statements($customer, $sdate, $edate);


        $html = $this->load->view('customers/cust_prod_pdf', $data, true);


        ini_set('memory_limit', '64M');


        $this->load->library('pdf');

        $pdf = $this->pdf->load();


        $pdf->WriteHTML($html);


        $pdf->Output('Statement' . $customer . '.pdf', 'D');
    }

    function sup_products_o()
    {
        $this->load->model('reports_model');
        $this->load->model('supplier_model');

        $customer = $this->input->post('supplier');

        $sdate = datefordatabase($this->input->post('sdate'));
        $edate = datefordatabase($this->input->post('edate'));
        $data['customer'] = $this->supplier_model->details($customer);


        $data['list'] = $this->reports_model->product_supplier_statements($customer, $sdate, $edate);

        $html = $this->load->view('supplier/supp_prod_pdf', $data, true);


        ini_set('memory_limit', '64M');


        $this->load->library('pdf');

        $pdf = $this->pdf->load();


        $pdf->WriteHTML($html);


        $pdf->Output('Statement' . $customer . '.pdf', 'I');
    }


    
    public function employees_download()
    {
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $customFilename = 'Employee_List_Details_' . date('d-m-Y') . '.csv';

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename=' . $customFilename);
        header('Content-Transfer-Encoding: binary');
        
        $whr = '';
        if ($this->aauth->get_user()->loc) {
            $whr = " WHERE loc='" . $this->aauth->get_user()->loc . "'";
        } elseif (!BDATA) {
            $whr = " WHERE loc='0'";
        }
        
        $query = $this->db->query("SELECT name,address,city,region,country,postbox,email,phone,company FROM gtg_customers $whr");
        
        // Output the header
        echo "\xEF\xBB\xBF"; // Byte Order Mark
        echo "Employees list\n"; // Heading for the first row
        
        // Output the data from the second line
        echo $this->dbutil->csv_from_result($query, ',', "\n", '', 2);
        
    }


    
    public function export_employees_list() {

        // Create a PhpSpreadsheet object
        $data = array();
        $filename = 'employee_list';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
    
        // Merge cells for the first row
        $sheet->mergeCells('A1:J1');
    
        // Center align the merged cells
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
    
        // Add the header in the merged cells
        $sheet->setCellValue('A1', 'Employees list');
    
        // Add titles in the second row
        $sheet->setCellValue('A2', 'Name');
        $sheet->setCellValue('B2', 'Address');
        $sheet->setCellValue('C2', 'City');
        $sheet->setCellValue('D2', 'Region');
        $sheet->setCellValue('E2', 'Country');
        $sheet->setCellValue('F2', 'Postbox');
        $sheet->setCellValue('G2', 'Email');
        $sheet->setCellValue('H2', 'Phone');
        $sheet->setCellValue('I2', 'Salary');
        $sheet->setCellValue('J2', 'Joined Date');
    
        //$whr = '';
        // if ($this->aauth->get_user()->loc) {
        //     $whr = " WHERE loc='" . $this->aauth->get_user()->loc . "'";
        // } elseif (!BDATA) {
        //     $whr = " WHERE loc='0'";
        // }
    
        $query = $this->db->query("SELECT name,address,city,region,country,postbox,email,phone,salary,joindate FROM gtg_employees");
    
        $data = [];
        foreach ($query->result_array() as $row_data) {
            $data[] = $row_data;
        }
    
        // Custom filename
        $customFilename = 'custom_name_' . $this->date . '.xlsx';
    
        // Add the data from the third row (after titles)
        $row = 3;
        foreach ($data as $row_data) {
            $column = 'A';
            foreach ($row_data as $value) {
                $sheet->setCellValue($column . $row, $value);
                $column++;
            }
            $row++;
        }
    
        // Create a writer and output the spreadsheet to the browser
        $writer = new Xlsx($spreadsheet);
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
    }

    public function export_job_sheet_list() {

        // Create a PhpSpreadsheet object
        $data = array();
        $filename = 'job_sheet_details_list';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $job_data = $this->jobsheet->all_jobsheet_list();

        // echo "<pre>"; print_r($job_data); echo "</pre>";
        // exit;
        
        // Merge cells for the first row
        $sheet->mergeCells('A1:M1');
    
        // Center align the merged cells
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
    
        // Add the header in the merged cells
        $sheet->setCellValue('A1', 'Job Sheet Details');
    
        // Add titles in the second row
        $sheet->setCellValue('A2', 'Job Id');
        $sheet->setCellValue('B2', 'Created Date');
        $sheet->setCellValue('C2', 'Customer Name');
        $sheet->setCellValue('D2', 'Assigned To');
        $sheet->setCellValue('E2', 'Address');
        $sheet->setCellValue('F2', 'Status');
        $sheet->setCellValue('G2', 'Job Type');
        $sheet->setCellValue('I2', 'Assigned Date');        
        $sheet->setCellValue('H2', 'Assigned Time');
        $sheet->setCellValue('J2', 'Job Priority');
        $sheet->setCellValue('K2', 'Vehicle Number');
        $sheet->setCellValue('L2', 'Description');
        $sheet->setCellValue('M2', 'Remarks');
    
   

  
        $data = [];
        foreach ($job_data as $row_data) {

            if($row_data['status']==1){
                $temp = "Completed";
            }elseif($row_data['status']==2){
                $temp = "Pending";
            }elseif($row_data['status']==3){
                $temp = "Unassigned";
            }elseif($row_data['status']==4){
                $temp = "Work In Progress";
            }elseif($row_data['status']==5){
                $temp = "Closed";
            }elseif($row_data['status']==6){
                $temp = "Re-Open";
            }elseif($row_data['status']==7){
                $temp = "Re-Assign";
            }

            $j_data['job_unique_id'] = $row_data['job_unique_id'];
            $j_data['created_at'] = $row_data['created_at'];
            $j_data['cname'] = $row_data['cname'];
            $j_data['assigned_employee_name'] = $row_data['assigned_employee_name'];
            $j_data['clocation'] = $row_data['clocation'];
            $j_data['status'] = $temp;
            $j_data['assigned_employee_job_type'] = $row_data['assigned_employee_job_type'];
            $j_data['cdate'] = date('d-m-Y',strtotime($row_data['cdate']));
            $j_data['ctime'] = $row_data['ctime'];
            $j_data['job_priority'] = $row_data['job_priority'];
            $j_data['job_description'] = $row_data['job_description'];
            $j_data['vehicle_number'] = $row_data['vehicle_number'];         
            $j_data['remarks'] = $row_data['remarks'];

            $data[] = $j_data;

            
        }
    
        // Custom filename
        $customFilename = 'job_sheet_details_' . $this->date . '.xlsx';
    
        // Add the data from the third row (after titles)
        $row = 3;
        foreach ($data as $row_data) {
            $column = 'A';
            foreach ($row_data as $value) {
                $sheet->setCellValue($column . $row, $value);
                $column++;
            }
            $row++;
        }
    
        // Create a writer and output the spreadsheet to the browser
        $writer = new Xlsx($spreadsheet);
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');
    }
    

    
    public function export_attendance_report()
    {
        
        $cid = $this->input->post('employee');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $list = $this->employee->attendance_report_new($cid, $from_date, $to_date);
        $data['emp_list'] = $this->employee->list_employee();
        $data['emp_details'] = $this->employee->employee_details($cid);
        $data['from_date'] = $from_date;
        $data['to_date'] = $to_date;
        //  print_r($list);
        //  exit;
        $att_settings = $this->employee->get_attendance_settings();

        $categorizedResult = array();

        foreach ($list as $row) {
            $empId = $row['emp'];

            // Create a new entry for emp if it doesn't exist
            if (!isset($categorizedResult[$empId])) {
                $categorizedResult[$empId] = array(
                    'emp_id' => $empId,
                    'entries' => array(),
                );
            }

            // Add the row to the entries array
            $categorizedResult[$empId]['entries'][] = $row;
        }

        // echo "<pre>"; print_r($categorizedResult); echo "</pre>";
        // exit;
        
        if(!empty($att_settings))
        {
            $work_hours = $att_settings['total_working_hours'];
            $clock_in_grace_period = $att_settings['clock_in_grace_period'];
            $clock_in_time = $att_settings['clock_in_time'];
            $clock_out_time = $att_settings['clock_out_time'];
            
           
        }else{
            
            $work_hours = 0; 
            $clock_in_grace_period = 0;
            $clock_in_time = '00:00:00';
            $clock_out_time = '00:00:00';
        }


        // $ot_allowance_amount = $att_settings['ot_allowance_per_hour'];
         
        
        $table = '';
        $n_data = array();
        foreach ($categorizedResult as $empData) {

            $data = array();
            $ot_hours = 0;
            $empId = $empData['emp_id'];
            $entries = $empData['entries'];
        
            // Initialize variables to calculate totals
            $totalAttendance = count($entries);
            $totalMc = 0;
            $totalOtHours = 0;
            $lateCounter = 0;
            $employee_exceeded_seconds = 0;
            foreach ($entries as $entry) {
                // echo $lateCounter."---";
                
                $data['department_name'] = $entry['department_name'];
                $data['employee_type'] = $entry['employee_type']." - ".$entry['employee_job_type'];
                $data['total_attendance'] = count($list);

                $data['clock_in'] = $entry['first_tfrom'];
                $data['clock_out'] = $entry['last_tto'];
                $data['ofc_clock_in'] = date('H:i:s', strtotime($clock_in_time));
                $data['ofc_clock_out'] = date('H:i:s',strtotime($clock_out_time));

                $clockInTime = strtotime($data['ofc_clock_in']);
                $clockOutTime = strtotime($data['ofc_clock_out']);
            
                // Calculate the difference in seconds
                $diffInSeconds = $clockOutTime - $clockInTime;
            
                // Check if the difference exceeds the specified work hours
                if ($diffInSeconds > $work_hours * 3600) {
                    // Save the exceeded seconds
                    $exceededSeconds = $diffInSeconds - ($work_hours * 3600);
            
                    // Add the exceeded seconds to the employee array
                    $employee_exceeded_seconds += $exceededSeconds;
                } else {
                    // If not exceeded, set 0 seconds
                    $employee_exceeded_seconds += 0;
                }

                
                $clockInTime = strtotime($data['clock_in']);
                $ofcClockInTime = strtotime($data['ofc_clock_in']);

                // Check if clock_in is less than ofc_clock_in
                if ($clockInTime > $ofcClockInTime) {
                   
                    $diffInMinutes = abs(($clockInTime - $ofcClockInTime) / 60);
                    // echo "clockin is heigher -- ".$diffInMinutes;
                    if ($diffInMinutes > $clock_in_grace_period) {
                        // Increment the late counter
                        $lateCounter++;
                    }

                }else{
                    // echo "ofc clockin is heigher";
                }

               
            }
        
            $exceededHours = floor($employee_exceeded_seconds / 3600);
            $exceededMinutes = floor(($employee_exceeded_seconds % 3600) / 60);

            if ($exceededHours > 0) {
                $ot_final_hours = $exceededHours." hrs,".$exceededMinutes." mins";
            } else if ($exceededMinutes > 0){
                $ot_final_hours = $exceededMinutes." mins";
            } else {
                $ot_final_hours = "0 mins";
            }

            
            if($lateCounter <= 0)
            {
                $kpi_indication = 'green';
            }else if($lateCounter == 1)
            {
                $kpi_indication = 'yellow';
            }else if($lateCounter > 1)
            {
                $kpi_indication = 'red';
            }

            $data['emp_id'] = $empId;
            $data['emp_name'] = $entries[0]['name']; // Assuming the name 
            $data['ot_hours'] = $ot_final_hours;
            $data['late_attendances'] = $lateCounter;
            $data['total_mc'] = 'NA';
            $data['total_annual_leaves'] = 'NA';
            $data['kpi_indication'] = $kpi_indication;
            $n_data[] = $data;

            
        }

        // echo "<pre>"; print_r($n_data); echo "</pre>";
        // exit;

        $filename = 'attendance_report_details_list';
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $job_data = $this->jobsheet->all_jobsheet_list();

        // echo "<pre>"; print_r($job_data); echo "</pre>";
        // exit;
        
        // Merge cells for the first row
        $sheet->mergeCells('A1:J1');
    
        // Center align the merged cells
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
    
        // Add the header in the merged cells
        $sheet->setCellValue('A1', 'Attendance Report Details');
    
        // Add titles in the second row
        $sheet->setCellValue('A2', 'Staff Id');
        $sheet->setCellValue('B2', 'Staff Name');
        $sheet->setCellValue('C2', 'Department');
        $sheet->setCellValue('D2', 'Employee Type');
        $sheet->setCellValue('E2', 'Total Attendance');
        $sheet->setCellValue('F2', 'Total MC');
        $sheet->setCellValue('G2', 'Total late Attendance');
        $sheet->setCellValue('I2', 'Total OT Hours');        
        $sheet->setCellValue('H2', 'Total Balance Annual Leaves');
        $sheet->setCellValue('J2', 'KPI Indication');

  
        $data1 = [];
        foreach ($n_data as $row_data) {

            $j_data['emp_id'] = $row_data['emp_id'];
            $j_data['emp_name'] = $row_data['emp_name'];
            $j_data['department_name'] = $row_data['department_name'];
            $j_data['employee_type'] = $row_data['employee_type'];
            $j_data['total_attendance'] = $row_data['total_attendance'];
            $j_data['total_mc'] = $row_data['total_mc'];
            $j_data['late_attendances'] = $row_data['late_attendances'];
            $j_data['ot_hours'] = $row_data['ot_hours'];
            $j_data['total_annual_leaves'] = $row_data['total_annual_leaves'];
            $j_data['kpi_indication'] = $row_data['kpi_indication'];

            $data1[] = $j_data;

            
        }
    
        // Custom filename
        $customFilename = 'attendance_sheet_details_' . $this->date . '.xlsx';
    
        // Add the data from the third row (after titles)
        $row = 3;
        foreach ($data1 as $row_data1) {
            $column = 'A';
            foreach ($row_data1 as $value) {
                $sheet->setCellValue($column . $row, $value);
                $column++;
            }
            $row++;
        }
    
        // Create a writer and output the spreadsheet to the browser
        $writer = new Xlsx($spreadsheet);
    
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
    
        $writer->save('php://output');

        }
      
        public function export_jobsheet_report()
        {

            // echo "<pre>"; print_r($_POST); echo "</pre>";
            $cid = $this->input->post('employee');
            $customer_id = $this->input->post('customer');
            $job_id = $this->input->post('job_id');
            $from_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $data['emp_list'] = $this->employee->list_employee();
            $data['from_date'] = $from_date;
            $data['to_date'] = $to_date;
            // print
            $list = $this->jobsheet->jobsheet_report_new($cid, $job_id, $from_date, $to_date,$customer_id);

            // echo "<pre>"; print_r($list); echo "</pre>";
            // exit;

            if(!empty($list))
            {
                foreach ($list as $row) {
                    $userId = $row['userid'];
                
                    // Check if cid is empty, move it to the end
                    if (empty($userId)) {
                        $categorizedResult['empty_user_id']['entries'][] = $row;
                    } else {
                        // Create a new entry for emp if it doesn't exist
                        if (!isset($categorizedResult[$userId])) {
                            $categorizedResult[$userId] = array(
                                'userid' => $userId,
                                'entries' => array(),
                            );
                        }
                
                        // Add the row to the entries array
                        $categorizedResult[$userId]['entries'][] = $row;
                    }
                }
            }
            

            // echo "<pre>"; print_r($categorizedResult); echo "</pre>";
            // exit;

              
        $table = '';
        $n_data = array();
        $nn_data = array();
        if(!empty($categorizedResult))
        {
            foreach ($categorizedResult as $jobData) {

                $data = array();
                if(!empty($jobData['userid']))
                {
                    $empId = $jobData['userid'];
                }else{
                    $empId = 'Not Assigned';
                }
                
                $entries = $jobData['entries'];
            
                // Initialize variables to calculate totals
                $total_assigned_tasks = count($entries);
                $total_completed_tasks = 0;
                $total_pending_tasks = 0;
                $total_work_in_progress_tasks = 0;
                $working_seconds = 0;
               

                foreach ($entries as $entry) {
                    $job_status = '';
                    $given_hours = $entry['man_days'];
                    if(!empty($entry['work_in_progress_start_time']))
                    {
                        $work_in_progress_start_time = date('Y-m-d H:i:s',strtotime($entry['work_in_progress_start_time']));
                        $estimated_completed_date = date('d-m-Y H:i:s', strtotime($work_in_progress_start_time . '+'.$given_hours.' hours'));
        
                    }else{
                        $job_given_date = date('Y-m-d H:i:s',strtotime($entry['cdate']." ".$entry['ctime']));
                        $estimated_completed_date = date('d-m-Y H:i:s', strtotime($job_given_date . '+'.$given_hours.' hours'));
        
                    }
                    
                    switch ($entry['status']) {
                        case 1:
                            $job_status .= "Completed";
                            $total_completed_tasks++;
                            break;
                        case 2:
                            $job_status .= "Pending";
                            $total_pending_tasks++;
                            break;
                        case 3:
                            $job_status .= "UnAssigned";
                            break;
                        case 4:
                            $job_status .= "Work In Progress";
                            $total_work_in_progress_tasks++;
                            break;
                        case 5:
                            $job_status .= "Closed";
                            break;
                        case 6:
                            $job_status .= "Re-Open";
                            $total_work_in_progress_tasks++;
                            break;
                        case 7:
                            $job_status .= "Re-Assign";
                            break;
                        default:
                            $job_status .= "---";
                            break;
                    }
                    
                    $wp_time = date('Y-m-d H:i:s', strtotime($entry['work_in_progress_start_time']));
                    $c_time = date('Y-m-d H:i:s', strtotime($entry['completed_time']));
                    if(!empty($wp_time) && !empty($c_time))
                    {                    
                        $working_seconds += (strtotime($wp_time) - strtotime($wp_time));
                    }
                    
                    $data['cid'] = $entry['userid'];
                    $data['assigned_employee_name'] = $entry['assigned_employee_name'];
                    $data['created_date_time'] = date('d-m-Y H:i:s', strtotime($entry['created_at']));
                    $data['estimated_completed_date'] = $estimated_completed_date;
                    $data['status'] = $job_status;
                    $data['assigned_hours'] = $entry['man_days'];
                    $data['client_name'] = $entry['cname'];
                    $data['duration'] = 'NA';
                    $data['remarks'] = $entry['remarks'];
                    $data['total_assigned_tasks'] = '';
                    $data['total_completed_tasks'] = '';
                    $data['total_pending_tasks'] = '';
                    $data['total_work_in_progress_and_reopen'] = '';
                    $data['total_working_duration'] = '';
                    $data['kpi_indication'] = '';
                    $n_data[] = $data;
                
                }
            
                $workingHours = floor($working_seconds / 3600);
                $workingMinutes = floor(($working_seconds % 3600) / 60);

                if ($workingHours > 0) {
                    $working_final_hours = $workingHours." hrs,".$workingMinutes." mins";
                } else if ($workingMinutes > 0){
                    $working_final_hours = $workingMinutes." mins";
                } else {
                    $working_final_hours = "0 mins";
                }
                

                $data1['cid'] = '';
                $data1['assigned_employee_name'] = '';
                $data1['created_date_time'] = '';
                $data1['estimated_completed_date'] = '';
                $data1['status'] = '';
                $data1['assigned_hours'] = '';
                $data1['client_name'] = '';
                $data1['duration'] = '';
                $data1['remarks'] = '';
                $data1['total_assigned_tasks'] = $total_assigned_tasks;
                $data1['total_completed_tasks'] = $total_completed_tasks; // Assuming the name 
                $data1['total_pending_tasks'] = $total_pending_tasks;
                $data1['total_work_in_progress_and_reopen'] = $total_work_in_progress_tasks;
                $data1['total_working_duration'] = $working_final_hours;
                $kpi_indication = '';
                $data1['kpi_indication'] = $kpi_indication;
                $n_data[] = $data1;

                //$nn_data[] = $n_data;
            }
        }
        // echo "<pre>"; print_r($n_data); echo "</pre>";

    
            $filename = 'jobsheet_report_details_list';
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $job_data = $this->jobsheet->all_jobsheet_list();
    
            // echo "<pre>"; print_r($job_data); echo "</pre>";
            // exit;
            
            // Merge cells for the first row
            $sheet->mergeCells('A1:O1');
        
            // Center align the merged cells
            $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        
            // Add the header in the merged cells
            $sheet->setCellValue('A1', 'JobSheet Report Details');
        
            // Add titles in the second row
            $sheet->setCellValue('A2', 'Staff Id');
            $sheet->setCellValue('B2', 'Staff Name');
            $sheet->setCellValue('C2', 'Created Date & Time');
            $sheet->setCellValue('D2', 'Completion Date & Time');
            $sheet->setCellValue('E2', 'Status');
            $sheet->setCellValue('F2', 'Assigned Hours');
            $sheet->setCellValue('G2', 'Client Name');
            $sheet->setCellValue('I2', 'Duration');        
            $sheet->setCellValue('H2', 'Final Remarks');
            $sheet->setCellValue('J2', 'Total Assigned Tasks');
            $sheet->setCellValue('K2', 'Total Completed Tasks');
            $sheet->setCellValue('L2', 'Total Pending Tasks');
            $sheet->setCellValue('M2', 'Total Work In Progress & Others');
            $sheet->setCellValue('N2', 'Total Work Hours');
            $sheet->setCellValue('O2', 'KPI Indication');
    
      
            $data1 = [];
            foreach ($n_data as $row_data) {
    
                $j_data['cid'] = $row_data['cid'];
                $j_data['assigned_employee_name'] = $row_data['assigned_employee_name'];
                $j_data['created_date_time'] = $row_data['created_date_time'];
                $j_data['estimated_completed_date'] = $row_data['estimated_completed_date'];
                $j_data['status'] = $row_data['status'];
                $j_data['assigned_hours'] = $row_data['assigned_hours'];
                $j_data['client_name'] = $row_data['client_name'];
                $j_data['duration'] = $row_data['duration'];
                $j_data['remarks'] = $row_data['remarks'];
                $j_data['total_assigned_tasks'] = $row_data['total_assigned_tasks'];
                $j_data['total_completed_tasks'] = $row_data['total_completed_tasks'];
                $j_data['total_pending_tasks'] = $row_data['total_pending_tasks'];
                $j_data['total_work_in_progress_and_reopen'] = $row_data['total_work_in_progress_and_reopen'];
                $j_data['total_working_duration'] = $row_data['total_working_duration'];
                $j_data['kpi_indication'] = $row_data['kpi_indication'];
    
                $data1[] = $j_data;
    
                
            }
        
            // Custom filename
            $customFilename = 'attendance_sheet_details_' . $this->date . '.xlsx';
        
            // Add the data from the third row (after titles)
            $row = 3;
            foreach ($data1 as $row_data1) {
                $column = 'A';
                foreach ($row_data1 as $value) {
                    $sheet->setCellValue($column . $row, $value);
                    $column++;
                }
                $row++;
            }
        
            // Create a writer and output the spreadsheet to the browser
            $writer = new Xlsx($spreadsheet);
        
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
        
            $writer->save('php://output');
    
            }

            
        public function export_payroll_report()
        {
             // /print_r($_POST); 
        $data = $this->input->post('employee_payroll_data');
         
        $data = json_decode($data, true);

       //  echo "<pre>"; print_r($data); echo "</pre>";
       //  echo $data['timeCategory'];
        
        if($data['timeCategory']){
           $datesearch=$data['dateYear'];
           
          $year= $data['dateYear'];
       }
   
       else{
           
           $datesearch=$data['dateMonth'];
           $year='';
           }
               $staffid=$data['staffid'];
   if(!empty($data['salary'])){
   
       $salary=",gtg_payslip.salaryMonth";}
       else{
           $salary='';
       }
   
       if(!empty($data['allowance'])){
   
       $allowance=",gtg_payslip.allowance";}
   else{
           $allowance='';
       }
   
       if(!empty($data['commissions'])){
   
       $commissions=",gtg_payslip.commissions";}
   else{
           $commissions='';
       }
   
       if(!empty($data['claims'])){
   
       $claims=",gtg_payslip.claims";}
   else{
           $claims='';
       }
   
       if(!empty($data['bonus'])){
   
           $bonus=",gtg_payslip.bonus";
           }else{
           $bonus='';
       }
   
   
       if(!empty($data['ot']))
       {
   
       $ot=",gtg_payslip.ot";}else{
           $ot='';
       }
   
       if(!empty($data['epf'])){
   
           $epf=",gtg_payslip.epf";}
   else{
           $epf='';
       }
   
       if(!empty($data['socso']))
       {
               $socso=",gtg_payslip.socso";
         }
   else{
           $socso='';
       }
   
        
       if(!empty($data['pcb'])){
   
                   $pcb=",gtg_payslip.pcb";
                   
                   }else{
           $pcb='';
       }
   
       $list = $this->payroll->get_payroll_export_new($staffid,$salary,$allowance,$commissions,$claims,$bonus,$ot,$epf,$socso,$pcb,$datesearch,$year);
       $gorup_data_array = $list;
       //    echo "<pre>"; print_r($list); echo "</pre>";
    //    exit;
   
    
            $filename = 'payroll_report_details_list';
            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();
            $job_data = $this->jobsheet->all_jobsheet_list();
    
            // echo "<pre>"; print_r($job_data); echo "</pre>";
            // exit;
            
            // Merge cells for the first row
            $sheet->mergeCells('A1:N1');
        
            // Center align the merged cells
            $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        
            // Add the header in the merged cells
            $sheet->setCellValue('A1', 'Payroll Report Details');
        
            // Add titles in the second row
            $sheet->setCellValue('A2', 'No');
            $sheet->setCellValue('B2', 'Name Of Employee');
            $sheet->setCellValue('C2', 'Month');
            $sheet->setCellValue('D2', 'Year');
            $sheet->setCellValue('E2', 'Salary');
            $sheet->setCellValue('F2', 'Allowance');
            $sheet->setCellValue('G2', 'Commissions');
            $sheet->setCellValue('I2', 'Claims');        
            $sheet->setCellValue('H2', 'Bonus');
            $sheet->setCellValue('J2', 'OT');
            $sheet->setCellValue('K2', 'EPF');
            $sheet->setCellValue('L2', 'SOCSO');
            $sheet->setCellValue('M2', 'PCB');
            $sheet->setCellValue('N2', 'Net Salary');
    
      
            $data1 = [];
            if(!empty($list))
            {
                $ll=1;
            foreach ($list as $row_data) {
                
                $j_data['no'] = $ll;
                $j_data['staffName'] = $row_data['staffName'];
                $j_data['monthText'] = $row_data['monthText'];
                $j_data['year'] = $row_data['year'];
                $j_data['basic_salary'] = $row_data['basic_salary'];
                $j_data['allowance'] = $row_data['allowance'];
                $j_data['commissions'] = $row_data['commissions'];
                $j_data['claims'] = $row_data['claims'];
                $j_data['bonus'] = $row_data['bonus'];
                $j_data['ot'] = $row_data['ot'];
                $j_data['epf'] = $row_data['epf'];
                $j_data['socso'] = $row_data['socso'];
                $j_data['pcb'] = $row_data['pcb'];
                $j_data['netPay'] = $row_data['netPay'];
                $data1[] = $j_data;
                $ll++;
                
            }
            }


            // // Original array
            // $originalArray = [
            //     [
            //         'staffName' => 'jenifer',
            //         'salaryMonth' => 6000.00,
            //         'allowance' => 0,
            //         'commissions' => 0,
            //         'claims' => 0,
            //         'bonus' => 0,
            //         'ot' => 0,
            //         'epf' => 720,
            //         'socso' => 105.00,
            //         'pcb' => 5,
            //         'netPay' => 5293.00,
            //         'year' => 2024,
            //         'monthText' => 'January',
            //         'id' => 6,
            //         'staff_id' => 27,
            //         'basic_salary' => 6000,
            //         'epf_percent' => 0,
            //         'epf_employee_percent' => 11,
            //         'epf_employee' => 660,
            //         'epf_employer' => 720,
            //         'sosco_employer_percent' => 0,
            //         'sosco_employee_percent' => 0,
            //         'sosco_employer' => 105,
            //         'sosco_employee' => 30,
            //         'eis' => 12,
            //         'bank' => 'Maybank',
            //         'accountno' => '19030319',
            //         'nationality' => 1,
            //         'tax_no' => '112233445566',
            //         'created_at' => '2023-07-18 02:54:35',
            //         'updated_at' => '2023-07-18 10:58:52',
            //         'employee_job_type' => 'intern',
            //         'join_date' => null,
            //         'passport' => null,
            //         'employee_type' => 'foreigner',
            //     ],[
            //         'staffName' => 'siva',
            //         'salaryMonth' => 6000.00,
            //         'allowance' => 0,
            //         'commissions' => 0,
            //         'claims' => 0,
            //         'bonus' => 0,
            //         'ot' => 0,
            //         'epf' => 720,
            //         'socso' => 105.00,
            //         'pcb' => 5,
            //         'netPay' => 5293.00,
            //         'year' => 2024,
            //         'monthText' => 'January',
            //         'id' => 6,
            //         'staff_id' => 27,
            //         'basic_salary' => 6000,
            //         'epf_percent' => 0,
            //         'epf_employee_percent' => 11,
            //         'epf_employee' => 660,
            //         'epf_employer' => 720,
            //         'sosco_employer_percent' => 0,
            //         'sosco_employee_percent' => 0,
            //         'sosco_employer' => 105,
            //         'sosco_employee' => 30,
            //         'eis' => 12,
            //         'bank' => 'Maybank',
            //         'accountno' => '19030319',
            //         'nationality' => 1,
            //         'tax_no' => '112233445566',
            //         'created_at' => '2023-07-18 02:54:35',
            //         'updated_at' => '2023-07-18 10:58:52',
            //         'employee_job_type' => 'freelancer',
            //         'join_date' => null,
            //         'passport' => null,
            //         'employee_type' => 'domestic',
            //     ],[
            //         'staffName' => 'ajmal',
            //         'salaryMonth' => 6000.00,
            //         'allowance' => 0,
            //         'commissions' => 0,
            //         'claims' => 0,
            //         'bonus' => 0,
            //         'ot' => 0,
            //         'epf' => 720,
            //         'socso' => 105.00,
            //         'pcb' => 5,
            //         'netPay' => 5293.00,
            //         'year' => 2024,
            //         'monthText' => 'January',
            //         'id' => 6,
            //         'staff_id' => 27,
            //         'basic_salary' => 6000,
            //         'epf_percent' => 0,
            //         'epf_employee_percent' => 11,
            //         'epf_employee' => 660,
            //         'epf_employer' => 720,
            //         'sosco_employer_percent' => 0,
            //         'sosco_employee_percent' => 0,
            //         'sosco_employer' => 105,
            //         'sosco_employee' => 30,
            //         'eis' => 12,
            //         'bank' => 'Maybank',
            //         'accountno' => '19030319',
            //         'nationality' => 1,
            //         'tax_no' => '112233445566',
            //         'created_at' => '2023-07-18 02:54:35',
            //         'updated_at' => '2023-07-18 10:58:52',
            //         'employee_job_type' => 'employee',
            //         'join_date' => null,
            //         'passport' => null,
            //         'employee_type' => 'domestic',
            //     ],[
            //         'staffName' => 'harsha',
            //         'salaryMonth' => 6000.00,
            //         'allowance' => 0,
            //         'commissions' => 0,
            //         'claims' => 0,
            //         'bonus' => 0,
            //         'ot' => 0,
            //         'epf' => 720,
            //         'socso' => 105.00,
            //         'pcb' => 5,
            //         'netPay' => 5293.00,
            //         'year' => 2024,
            //         'monthText' => 'January',
            //         'id' => 6,
            //         'staff_id' => 27,
            //         'basic_salary' => 6000,
            //         'epf_percent' => 0,
            //         'epf_employee_percent' => 11,
            //         'epf_employee' => 660,
            //         'epf_employer' => 720,
            //         'sosco_employer_percent' => 0,
            //         'sosco_employee_percent' => 0,
            //         'sosco_employer' => 105,
            //         'sosco_employee' => 30,
            //         'eis' => 12,
            //         'bank' => 'Maybank',
            //         'accountno' => '19030319',
            //         'nationality' => 1,
            //         'tax_no' => '112233445566',
            //         'created_at' => '2023-07-18 02:54:35',
            //         'updated_at' => '2023-07-18 10:58:52',
            //         'employee_job_type' => 'employee',
            //         'join_date' => null,
            //         'passport' => null,
            //         'employee_type' => 'foreigner',
            //     ]
            //     // ... (more objects if needed)
            // ];

           $originalArray = $gorup_data_array;
            $styleArray = [
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'FFFF00'], // Yellow color
                ],
            ];

            $selectedJobTypes = ['intern', 'freelancer'];
            $groupedData1 = array();

            foreach ($originalArray as $item) {
                $employeeJobType = $item['employee_job_type'];

                if (in_array($employeeJobType, $selectedJobTypes)) {
                    $groupedData1[$employeeJobType][] = $item;
                }
            }

            // Output the filtered data
            //echo "<pre>"; print_r($groupedData1); echo "</pre>"; 
            //exit;

            $data  = $originalArray;
            //echo "<pre>";print_r($groupedData); echo "</pre>";
            $groupedData = array();
            
            foreach ($data as $item) {
                $employeeJobType = isset($item['employee_job_type']) ? strtolower($item['employee_job_type']) : '';
                $employeeType = isset($item['employee_type']) ? $item['employee_type'] : '';
            
                // if (!isset($groupedData[$employeeJobType])) {
                //     $groupedData[$employeeJobType] = array();
                // }
            
                if ($employeeJobType == 'employee' && !empty($employeeType)) {
                    if (!isset($groupedData[$employeeJobType][$employeeType])) {
                        $groupedData[$employeeJobType][$employeeType] = array();
                    }
            
                    $groupedData[$employeeJobType][$employeeType][] = $item;
                }
            }
            
            // Output the final grouped data
            //print_r($groupedData);
            $mergedData = array_merge_recursive($groupedData1, $groupedData);

            // echo "<pre>";print_r($mergedData); echo "</pre>";
            // exit;

            // Custom filename
            $customFilename = 'payroll_report_details_' . $this->date . '.xlsx';
        
            // Add the data from the third row (after titles)
            $row = 3;
            foreach ($data1 as $row_data1) {
                $column = 'A';
                foreach ($row_data1 as $value) {
                    $sheet->setCellValue($column . $row, $value);
                    $column++;
                }
                $row++;
            }
        
            $row += 2;
            
            $localheaderColumn = "B".$row;
            $sheet->mergeCells("B$row:C$row");
            $sheet->getStyle("B$row")->getAlignment()->setHorizontal('center');
            $sheet->getStyle("B$row")->applyFromArray($styleArray);

            $sheet->setCellValue($localheaderColumn, 'LOCAL STAFF');
            $LocalheaderValues = array(
                'No',
                'Name Of Employee',
                'Mykad',
                'Joining',
                'Staff ID',
                'Basic',
                'Day',
                'Basic Pay',
                'KWSP',
                '',
                'SOCSO',
                '',
                'EIS',
                '',
                'LHDN',
                'Unpaid Leave',
                'Advance',
                'ALLOWANCE',
                'COMMISSION',
                'Overtime',
                'Bonus',
                'Net Pay'
            );

            $LocalheaderValues1 = array(
                '',
                '',
                '',
                'Date',
                '',
                '',
                'Worked',
                '',
                'Employer',
                'Employee',
                'Employer',
                'Employee',
                'Employer',
                'Employee',
                '',
                'deduct',
                'deduct',
                'add',
                'add',
                'add',
                'add',
                ''
            );
            
            $row++;

            $column = 'A';
            foreach ($LocalheaderValues as $value) {
                $sheet->setCellValue($column . $row, $value);
                $column++;
            }
            $row++;

            $column = 'A';
            foreach ($LocalheaderValues1 as $value) {
                $sheet->setCellValue($column . $row, $value);
                $column++;
            }
            $row++;
            // Write the second set of data
            if(!empty($mergedData['employee']['domestic']))
            {
                $ds=1;
                foreach ($mergedData['employee']['domestic'] as $row_data2) {
                    // $column = 'A';
                    // foreach ($row_data2 as $value) {
                    //     $sheet->setCellValue($column . $row, $value);
                    //     $column++;
                    // }
                    
                    $sheet->setCellValue("A$row", $ds);
                    $sheet->setCellValue("B$row", $row_data2['staffName']);
                    $sheet->setCellValue("C$row", 'NA');
                    $sheet->setCellValue("D$row", $row_data2['join_date']);
                    $sheet->setCellValue("E$row", $row_data2['staff_id']);
                    $sheet->setCellValue("F$row", $row_data2['basic_salary']);
                    $sheet->setCellValue("G$row", 'NA');
                    $sheet->setCellValue("H$row", $row_data2['basic_salary']);
                    $sheet->setCellValue("I$row", $row_data2['epf_employer']);
                    $sheet->setCellValue("J$row", $row_data2['epf_employee']);
                    $sheet->setCellValue("K$row", $row_data2['sosco_employer']);
                    $sheet->setCellValue("L$row", $row_data2['sosco_employee']);
                    $sheet->setCellValue("M$row", $row_data2['eis']);
                    $sheet->setCellValue("N$row", 'NA');
                    $sheet->setCellValue("O$row", $row_data2['tax_no']);
                    $sheet->setCellValue("P$row", 'NA');
                    $sheet->setCellValue("Q$row", 'NA');
                    $sheet->setCellValue("R$row", $row_data2['allowance']);
                    $sheet->setCellValue("S$row", $row_data2['commissions']);
                    $sheet->setCellValue("T$row", $row_data2['ot']);
                    $sheet->setCellValue("U$row", $row_data2['bonus']);
                    $sheet->setCellValue("V$row", $row_data2['netPay']);
                    $ds++;
                    $row++;
                }
            }
            

            $row += 2;
            
            $localheaderColumn = "B".$row;
            $sheet->mergeCells("B$row:C$row");
            $sheet->getStyle("B$row")->getAlignment()->setHorizontal('center');
            $sheet->getStyle("B$row")->applyFromArray($styleArray);

            $sheet->setCellValue($localheaderColumn, 'FOREIGN STAFF');
            $LocalheaderValues2 = array(
                'No',
                'Name Of Employee',
                'Pasport No',
                'Joining',
                'Staff ID',
                'Basic',
                'Day',
                'Basic Pay',
                'KWSP',
                '',
                'SOCSO',
                '',
                'EIS',
                '',
                'LHDN',
                'Unpaid Leave',
                'Advance',
                'ALLOWANCE',
                'COMMISSION',
                'Overtime',
                'Bonus',
                'Net Pay'
            );

            $LocalheaderValues3 = array(
                '',
                '',
                '',
                'Date',
                '',
                '',
                'Worked',
                '',
                'Employer',
                'Employee',
                'Employer',
                'Employee',
                'Employer',
                'Employee',
                '',
                'deduct',
                'deduct',
                'add',
                'add',
                'add',
                'add',
                ''
            );
            
            $row++;

            $column = 'A';
            foreach ($LocalheaderValues2 as $value) {
                $sheet->setCellValue($column . $row, $value);
                $column++;
            }
            $row++;

            $column = 'A';
            foreach ($LocalheaderValues3 as $value) {
                $sheet->setCellValue($column . $row, $value);
                $column++;
            }
            $row++;
            
            if(!empty($mergedData['employee']['foreigner']))
            {
                $fs=1;
                foreach ($mergedData['employee']['foreigner'] as $row_data3) {
                    // $column = 'A';
                    // foreach ($row_data2 as $value) {
                    //     $sheet->setCellValue($column . $row, $value);
                    //     $column++;
                    // }
                    
                    $sheet->setCellValue("A$row", $fs);
                    $sheet->setCellValue("B$row", $row_data3['staffName']);
                    $sheet->setCellValue("C$row", $row_data3['passport']);
                    $sheet->setCellValue("D$row", $row_data3['join_date']);
                    $sheet->setCellValue("E$row", $row_data3['staff_id']);
                    $sheet->setCellValue("F$row", $row_data3['basic_salary']);
                    $sheet->setCellValue("G$row", 'NA');
                    $sheet->setCellValue("H$row", $row_data3['basic_salary']);
                    $sheet->setCellValue("I$row", $row_data3['epf_employer']);
                    $sheet->setCellValue("J$row", $row_data3['epf_employee']);
                    $sheet->setCellValue("K$row", $row_data3['sosco_employer']);
                    $sheet->setCellValue("L$row", $row_data3['sosco_employee']);
                    $sheet->setCellValue("M$row", $row_data3['eis']);
                    $sheet->setCellValue("N$row", 'NA');
                    $sheet->setCellValue("O$row", $row_data3['tax_no']);
                    $sheet->setCellValue("P$row", 'NA');
                    $sheet->setCellValue("Q$row", 'NA');
                    $sheet->setCellValue("R$row", $row_data3['allowance']);
                    $sheet->setCellValue("S$row", $row_data3['commissions']);
                    $sheet->setCellValue("T$row", $row_data3['ot']);
                    $sheet->setCellValue("U$row", $row_data3['bonus']);
                    $sheet->setCellValue("V$row", $row_data3['netPay']);
                    $fs++;
                    $row++;
                }
            }

            $row += 2;
            
            $localheaderColumn = "B".$row;
            $sheet->mergeCells("B$row:C$row");
            $sheet->getStyle("B$row")->getAlignment()->setHorizontal('center');
            $sheet->getStyle("B$row")->applyFromArray($styleArray);

            $sheet->setCellValue($localheaderColumn, 'INTERN');
            $LocalheaderValues4 = array(
                'No',
                'Name Of Intern',
                'MyKad / Pasport No',
                'Joining',
                'End',
                'Day',
                'Gross Pay',
                'UPL',
                'Advance',
                'Allowance',
                'Net Pay'
            );

            $LocalheaderValues5 = array(
                '',
                '',
                '',
                'Date',
                'Date',
                'Worked',
                '',
                'deduct',
                'add',
                'add',
                ''
            );
            
            $row++;

            $column = 'A';
            foreach ($LocalheaderValues4 as $value) {
                $sheet->setCellValue($column . $row, $value);
                $column++;
            }
            $row++;

            $column = 'A';
            foreach ($LocalheaderValues5 as $value) {
                $sheet->setCellValue($column . $row, $value);
                $column++;
            }
            $row++;
           
            if(!empty($mergedData['intern']))
            {
                foreach ($mergedData['intern'] as $row_data4) {
                    $int_e = 1;
                    
                        $sheet->setCellValue("A$row", $int_e);
                        $sheet->setCellValue("B$row", $row_data4['staffName']);
                        $sheet->setCellValue("C$row", $row_data4['passport']);
                        $sheet->setCellValue("D$row", $row_data4['join_date']);
                        $sheet->setCellValue("E$row", 'NA');
                        $sheet->setCellValue("F$row", 'NA');
                        $sheet->setCellValue("G$row", $row_data4['basic_salary']);
                        $sheet->setCellValue("H$row", 'NA');
                        $sheet->setCellValue("I$row", 'NA');
                        $sheet->setCellValue("J$row", $row_data4['allowance']);
                        $sheet->setCellValue("K$row", $row_data4['netPay']);
                        $int_e++;
                        $row++;
                    
                }
            }


         
            
            $row += 2;
            
            $localheaderColumn = "B".$row;
            $sheet->mergeCells("B$row:C$row");
            $sheet->getStyle("B$row")->getAlignment()->setHorizontal('center');
            $sheet->getStyle("B$row")->applyFromArray($styleArray);

            $sheet->setCellValue($localheaderColumn, 'FREELANCE');
            $LocalheaderValues6 = array(
                'No',
                'Name Of Freelancer',
                'MyKad / Pasport No',
                'Project Start Date',
                'Project End Date',
                'Payable Amount',
            );

            
            $row++;

            $column = 'A';
            foreach ($LocalheaderValues6 as $value) {
                $sheet->setCellValue($column . $row, $value);
                $column++;
            }
            
            $row++;
            
            if(!empty($mergedData['freelance']))
            {
                foreach ($mergedData['freelance'] as$row_data5) {
                    $frel_e = 1;
                    
                        $sheet->setCellValue("A$row", $frel_e);
                        $sheet->setCellValue("B$row", $row_data5['staffName']);
                        $sheet->setCellValue("C$row", $row_data5['passport']);
                        $sheet->setCellValue("G$row", 'NA');
                        $sheet->setCellValue("H$row", 'NA');
                        $sheet->setCellValue("I$row", $row_data5['basic_salary']);
                        $frel_e++;
                        $row++;
                    
                }
            }

            // Create a writer and output the spreadsheet to the browser
            $writer = new Xlsx($spreadsheet);
        
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="' . $filename . '"');
            header('Cache-Control: max-age=0');
        
            $writer->save('php://output');
    
            }



            public function export_daily_attendance_list() {

                // Create a PhpSpreadsheet object
                $data = array();
                $filename = 'attendance_details_list_'.date('d-m-Y');
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();

                $att_date = $this->input->post('att_date');
        
                $ndata = $this->employee->daily_attendance_list($att_date);      

                
                 // $ndata = $this->employee->daily_attendance_list();   
                // echo "<pre>"; print_r($job_data); echo "</pre>";
                // exit;
                
                // Merge cells for the first row
                $sheet->mergeCells('A1:G1');
            
                // Center align the merged cells
                $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
            
                // Add the header in the merged cells
                $header_str = "Daily Attendance Details ".date('d-m-Y');
                $sheet->setCellValue('A1', $header_str);
            
                // Add titles in the second row
                $sheet->setCellValue('A2', 'S.No');
                $sheet->setCellValue('B2', 'Employee Name');
                $sheet->setCellValue('C2', 'Date & ClockIn');
                $sheet->setCellValue('D2', 'Early / Late In Minutes');
                $sheet->setCellValue('E2', 'Date & ClockOut');
                $sheet->setCellValue('F2', 'Early / Late In Minutes');
                $sheet->setCellValue('G2', 'Auto LoggedOut');
            
                $defaultWidth = 25; // Set your desired default width

                // Loop through each column and set the default width
                for ($col = 'A'; $col <= 'Z'; $col++) {
                    $sheet->getColumnDimension($col)->setWidth($defaultWidth);
                }
        
          
                $data = [];
                if(!empty($ndata['attendance_list'])){
                    $j=1;

                foreach ($ndata['attendance_list'] as $attendance) {
        
                    $j_data['S.No'] = $j;
                    $j_data['name'] = $attendance['name'];
                    $j_data['lowest_clock_in_time'] = $attendance['lowest_clock_in_time'];
                    $j_data['clockin_difference'] = $attendance['clockin_difference'];
                    $j_data['highest_clock_out_time'] = $attendance['highest_clock_out_time'];
                    $j_data['clockout_difference'] = $attendance['clockout_difference'];
                    $j_data['auto_logout'] = $attendance['auto_logout'];
        
                    $data[] = $j_data;
                    $j++;
                }
                }
            
                // Custom filename
                $customFilename = 'attendance_details_' . $this->date . '.xlsx';
            
                // Add the data from the third row (after titles)
                $row = 3;
                foreach ($data as $row_data) {
                    $column = 'A';
                    foreach ($row_data as $value) {
                        $sheet->setCellValue($column . $row, $value);
                        $column++;
                    }
                    $row++;
                }

                $row += 2; // Move to the next row after the previous data

                
                $localheaderColumn = "A".$row;
                $sheet->mergeCells("A$row:B$row");
                // // echo $localheaderColumn;
                // // exit;
                $sheet->getStyle("A".$row)->getAlignment()->setHorizontal('center');
                $sheet->setCellValue("A".$row, "ClockIn Time : ".date('h:i A',strtotime($ndata['attendance_settings']['clock_in_time'])));
                // // Set header for Absent Employees section
                $row += 1; 
                $localheaderColumn = "A".$row;
                $sheet->mergeCells("A$row:B$row");
                // // echo $localheaderColumn;
                // // exit;
                $sheet->getStyle("A".$row)->getAlignment()->setHorizontal('center');
                $sheet->setCellValue("A".$row, "ClockOut Time : ".date('h:i A',strtotime($ndata['attendance_settings']['clock_out_time'])));
               
                $row += 2;
                
                $localheaderColumn = "A".$row;
                $sheet->mergeCells("A$row:B$row");
                // // echo $localheaderColumn;
                // // exit;
                $sheet->getStyle("A".$row)->getAlignment()->setHorizontal('center');
                $sheet->setCellValue("A".$row, 'Absent Employees');

                
                $row += 1;
                $sheet->setCellValue("A".$row, 'S.No');
                $sheet->setCellValue("B".$row, 'Employee Name');
                $row += 1;
                // Write Absent Employees header
                
                // Write data for Absent Employees section
                $data1 = [];
                if (!empty($ndata['absent_emp_names'])) {
                    $aj = 1;
                    foreach ($ndata['absent_emp_names'] as $absent_emp_names) {
                        $aj_data['S.No'] = $aj;
                        $aj_data['name'] = $absent_emp_names['name'];
                        $data1[] = $aj_data;
                        $aj++;
                    }
                }
                
                
                foreach ($data1 as $row_data1) {
                    $column = 'A';
                    foreach ($row_data1 as $value1) {
                        $sheet->setCellValue($column . $row, $value1);
                        $column++;
                    }
                    $row++;
                }
                
                // Create a writer and output the spreadsheet to the browser
                $writer = new Xlsx($spreadsheet);
            
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="' . $filename . '"');
                header('Cache-Control: max-age=0');
            
                $writer->save('php://output');
            }
            
          
}
