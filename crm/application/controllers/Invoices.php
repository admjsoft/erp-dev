<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Invoices extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('invoices_model', 'invocies');
        if (!is_login()) {
            redirect(base_url() . 'user/profile', 'refresh');
        }

        $this->load->model('User_model');
    }

    //invoices list
    public function index()
    {
        $head['title'] = "Manage Invoices";
        is_login();
        $userid = $this->session->userdata('user_details')[0]->users_id;
        $data['user_data'] = $this->User_model->get_users($userid);
        $head['user_data']=$data['user_data'];
        $this->load->view('includes/header',$head);
        $this->load->view('invoices/invoices');
        $this->load->view('includes/footer');
    }

    public function peppol_invoices()
    {
        $head['title'] = "Peppol Invoices";
        is_login();
        $userid = $this->session->userdata('user_details')[0]->users_id;
        $data['user_data'] = $this->User_model->get_users($userid);
        $head['user_data']=$data['user_data'];
        $this->load->view('includes/header',$head);
        $this->load->view('invoices/peppol_invoices');
        $this->load->view('includes/footer');
    }


    public function ajax_list()
    {
        $query = $this->db->query("SELECT currency FROM gtg_system WHERE id=1 LIMIT 1");
        $row = $query->row_array();

        $this->config->set_item('currency', $row["currency"]);


        $list = $this->invocies->get_datatables();
        $data = array();

        $no = $this->input->post('start');
        $curr = $this->config->item('currency');

        foreach ($list as $invoices) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $invoices->tid;
            $row[] = $invoices->name;
            $row[] = $invoices->invoicedate;
           // $row[] = amountExchange($invoices->total, $invoices->multi);
            $row[] = $invoices->total;
            $row[] = '<span class="st-' . $invoices->status . '">' . $this->lang->line(ucwords($invoices->status)) . '</span>';
            $row[] = '<a href="' . base_url("invoices/view?id=$invoices->id") . '" class="btn btn-success btn-xs"><i class="fa fa-file-text"></i> ' . $this->lang->line('View') . '</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->invocies->count_all(),
            "recordsFiltered" => $this->invocies->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function peppol_invoices_ajax_list()
    {
        $query = $this->db->query("SELECT currency FROM gtg_system WHERE id=1 LIMIT 1");
        $row = $query->row_array();

        $this->config->set_item('currency', $row["currency"]);


        $list = $this->invocies->get_peppol_datatables();
        $data = array();

        $no = $this->input->post('start');
        $curr = $this->config->item('currency');

        foreach ($list as $invoices) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $invoices->tid;
            $row[] = $invoices->name;
            $row[] = $invoices->invoicedate;
            // $row[] = amountExchange($invoices->total, $invoices->multi);
            $row[] = $invoices->total;
            $row[] = '<span class="st-' . $invoices->status . '">' . $this->lang->line(ucwords($invoices->status)) . '</span>';
            //$row[] = '<a href="' . base_url("invoices/view?id=$invoices->id") . '" class="btn btn-success btn-xs"><i class="fa fa-file-text"></i> ' . $this->lang->line('View') . '</a><a target="_blank" href="'.$invoices->document_url.'" tartget="_blank" class="btn btn-info btn-xs"  title="xml doc"><span class="fa fa-code"></span>Xml Doc</a>     <a href="' . base_url("invoices/download_peppol_invoice?id=$invoices->id") . '"  class="btn btn-info btn-xs"   title="xml Download"><span class="fa fa-file"></span>Xml Download</a>';
            $row[] = '<a href="' . base_url("invoices/view?id=$invoices->id") . '" class="btn btn-success btn-xs"><i class="fa fa-file-text"></i> ' . $this->lang->line('View') . '</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->invocies->peppol_count_all(),
            "recordsFiltered" => $this->invocies->peppol_count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    
    public function download_peppol_invoice(){
        $invoice_id = $this->input->get('id');
        $invoice_details = $this->invocies->peppol_invoice_details($invoice_id);

        $xmlUrl =  $invoice_details['document_url'];

        // Fetch the XML data from the URL
        $xmlData = file_get_contents($xmlUrl);
        $html = '<!DOCTYPE html>';
        $html .= '<html>';
        $html .= '<head>';
        $html .= '<title>Peppol Invoice Document</title>';
        $html .= '</head>';
        $html .= '<body>';
        $html .= '<h1>Peppol Invoice Document</h1>';
        $html .= '<pre>' . htmlentities($xmlData) . '</pre>'; // Display the raw XML data for demonstration
        $html .= '</body>';
        $html .= '</html>';

        // Create an mPDF instance
        // $mpdf = new Mpdf();
        $mpdf = $this->pdf->load_en();
        // Load HTML content into mPDF
        $mpdf->WriteHTML($html);

        // Output the PDF to the browser or save to a file
        $mpdf->Output('peppol_invoice_document.pdf', 'D'); // 'D' to download the PDF, 'I' to display in the browser

 

    }



    public function view()
    {



        $data['acclist'] = '';
        $tid = intval($this->input->get('id'));
        $data['id'] = $tid;

        $data['invoice'] = $this->invocies->invoice_details($tid);
        if ($data['invoice']['csd'] == $this->session->userdata('user_details')[0]->cid) {
            $data['products'] = $this->invocies->invoice_products($tid);
            $data['activity'] = $this->invocies->invoice_transactions($tid);
            $data['employee'] = $this->invocies->employee($data['invoice']['eid']);
            is_login();
            $userid = $this->session->userdata('user_details')[0]->users_id;
            $data['user_data'] = $this->User_model->get_users($userid);
            $head['user_data']=$data['user_data'];
            $this->load->view('includes/header',$head);
            $this->load->view('invoices/view', $data);
            $this->load->view('includes/footer');
        }
    }
}
