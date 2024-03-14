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
        $this->load->library('pdf');
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
            $row[] = '<a href="' . base_url("invoices/view?id=$invoices->id") . '" class="btn btn-success btn-xs"><i class="fa fa-file-text"></i> ' . $this->lang->line('View') . '</a>&nbsp;<a target="_blank" href="'.base_url("invoices/download_peppol_invoice_evidance?id=$invoices->id").'" tartget="_blank" class="btn btn-info btn-xs"  title="xml doc"><span class="fa fa-code"></span>Xml Doc</a>     <a href="' . base_url("invoices/download_peppol_invoice?id=$invoices->id") . '"  class="btn btn-info btn-xs"   title="xml Download"><span class="fa fa-file"></span>Pdf Download</a>';
            //$row[] = '<a href="' . base_url("invoices/view?id=$invoices->id") . '" class="btn btn-success btn-xs"><i class="fa fa-file-text"></i> ' . $this->lang->line('View') . '</a>';

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
    
    public function download_peppol_invoice_old(){
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

    public function download_peppol_invoice_evidance(){

        $this->load->helper('download');
        
        $url = 'https://sc-peppol.s3.eu-west-1.amazonaws.com/out/0106%3A74174174/0106%3A60881119/2024-03-11T10%3A53%3A45-4ddf8b5a-0a6c-45ec-b822-7187083a12a3/ubl.xml?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIARNX7AQGFKQNQEUWQ%2F20240311%2Feu-west-1%2Fs3%2Faws4_request&X-Amz-Date=20240311T105637Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=98c42d0567b51dcaf526147b9fa64c75e7cd6293fc022b3145f5530c47524093';

        // Fetch the XML data
        $xmlData = file_get_contents($url);
        
        // Load XML string
        $xml = simplexml_load_string($xmlData);
        
        // Convert SimpleXMLElement object to string
        $xmlString = $xml->asXML();
        
        // Set the filename
        $filename = 'downloaded_ubl.xml';

        // Force download the XML content as a file
        force_download($filename, $xmlString);

    }
    public function download_peppol_invoice()
    {
        // $invoice_id = $this->input->get('id');
        // $invoice_details = $this->invocies->peppol_invoice_details($invoice_id);

        // $xmlUrl = $invoice_details['document_url'];

        // // Fetch the XML data from the URL
        // //$xmlData = file_get_contents($xmlUrl);
        // $xmlData = '';
        // $html = '<!DOCTYPE html>';
        // $html .= '<html>';
        // $html .= '<head>';
        // $html .= '<title>Peppol Invoice Document</title>';
        // $html .= '</head>';
        // $html .= '<body>';
        // $html .= '<h1>Peppol Invoice Document</h1>';
        // $html .= '<pre>' . htmlentities($xmlData) . '</pre>'; // Display the raw XML data for demonstration
        // $html .= '</body>';
        // $html .= '</html>';

        // // Create an mPDF instance
        // // $mpdf = new Mpdf();

        // $mpdf = $this->pdf->load_en();
        // // Load HTML content into mPDF
        // $mpdf->WriteHTML($html);
        // // $watermarkText = 'Watermark Text';
        // // $mpdf->SetWatermarkText($watermarkText);
        // // $mpdf->showWatermarkText = true;

        // // Output the PDF to the browser or save to a file
        // $mpdf->Output('peppol_invoice_document.pdf', 'D'); // 'D' to download the PDF, 'I' to display in the browser


        $url = 'https://sc-peppol.s3.eu-west-1.amazonaws.com/out/0106%3A74174174/0106%3A60881119/2024-03-11T10%3A53%3A45-4ddf8b5a-0a6c-45ec-b822-7187083a12a3/ubl.xml?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIARNX7AQGFKQNQEUWQ%2F20240311%2Feu-west-1%2Fs3%2Faws4_request&X-Amz-Date=20240311T105637Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=98c42d0567b51dcaf526147b9fa64c75e7cd6293fc022b3145f5530c47524093';

        // Fetch the XML data
        $xmlData = file_get_contents($url);
        
        // Load XML string
        $xml = simplexml_load_string($xmlData);
        
        // Register namespaces
        $xml->registerXPathNamespace('cbc', 'urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2');
        $xml->registerXPathNamespace('cac', 'urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2');
        
        // Retrieve specific elements using XPath
        $UBLVersionID = $xml->xpath('//cbc:UBLVersionID')[0];
        $CustomizationID = $xml->xpath('//cbc:CustomizationID')[0];
        $ProfileID = $xml->xpath('//cbc:ProfileID')[0];
        $ID = $xml->xpath('//cbc:ID')[0];
        $IssueDate = $xml->xpath('//cbc:IssueDate')[0];
        $InvoiceTypeCode = $xml->xpath('//cbc:InvoiceTypeCode')[0];
        $DocumentCurrencyCode = $xml->xpath('//cbc:DocumentCurrencyCode')[0];
        $StreetName = $xml->xpath('//cbc:StreetName')[0];
        $CityName = $xml->xpath('//cbc:CityName')[0];
        $PostalZone = $xml->xpath('//cbc:PostalZone')[0];
        $CountryCode = $xml->xpath('//cac:Country/cbc:IdentificationCode')[0];
        $CompanyName = $xml->xpath('//cac:PartyName/cbc:Name')[0];
        $CompanyID = $xml->xpath('//cac:PartyLegalEntity/cbc:CompanyID')[0];
        $ContactEmail = $xml->xpath('//cac:Contact/cbc:ElectronicMail')[0];
        $PaymentMeansCode = $xml->xpath('//cbc:PaymentMeansCode')[0];
        $PaymentID = $xml->xpath('//cbc:PaymentID')[0];
        $FinancialAccountID = $xml->xpath('//cac:PayeeFinancialAccount/cbc:ID')[0];
        $FinancialAccountName = $xml->xpath('//cac:PayeeFinancialAccount/cbc:Name')[0];
        $InvoicedQuantity = $xml->xpath('//cbc:InvoicedQuantity')[0];
        $LineExtensionAmount = $xml->xpath('//cbc:LineExtensionAmount')[0];
        $ItemName = $xml->xpath('//cac:Item/cbc:Name')[0];
        $PriceAmount = $xml->xpath('//cbc:PriceAmount')[0];
        
        // // Output retrieved dataecho "UBLVersionID: $UBLVersionID<br>";
        // echo "CustomizationID: $CustomizationID<br>";
        // echo "ProfileID: $ProfileID<br>";
        // echo "ID: $ID<br>";
        // echo "IssueDate: $IssueDate<br>";
        // echo "InvoiceTypeCode: $InvoiceTypeCode<br>";
        // echo "DocumentCurrencyCode: $DocumentCurrencyCode<br>";
        // echo "StreetName: $StreetName<br>";
        // echo "CityName: $CityName<br>";
        // echo "PostalZone: $PostalZone<br>";
        // echo "CountryCode: $CountryCode<br>";
        // echo "CompanyName: $CompanyName<br>";
        // echo "CompanyID: $CompanyID<br>";
        // echo "ContactEmail: $ContactEmail<br>";
        // echo "PaymentMeansCode: $PaymentMeansCode<br>";
        // echo "PaymentID: $PaymentID<br>";
        // echo "FinancialAccountID: $FinancialAccountID<br>";
        // echo "FinancialAccountName: $FinancialAccountName<br>";
        // echo "InvoicedQuantity: $InvoicedQuantity<br>";
        // echo "LineExtensionAmount: $LineExtensionAmount<br>";
        // echo "ItemName: $ItemName<br>";
        // echo "PriceAmount: $PriceAmount<br>";

        
        //PDF Rendering
        $this->load->library('pdf');

        $pdf = $this->pdf->load();

        $pdf->writeHTML('
        <style>
            body { font-family: Arial, sans-serif; }
            table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
            th, td { border: 1px solid #000; padding: 8px; text-align: left; }
            th { background-color: #f2f2f2; }
        </style>
        
        <h1 style="text-align: center; margin-bottom: 20px;">Invoice Information</h1>
        
        <table>
            <tr>
                <th>ID</th>
                <td>' . $ID . '</td>
            </tr>
            <tr>
                <th>Issue Date</th>
                <td>' . $IssueDate . '</td>
            </tr>
            <tr>
                <th>Invoice Type Code</th>
                <td>' . $InvoiceTypeCode . '</td>
            </tr>
            <tr>
                <th>Document Currency Code</th>
                <td>' . $DocumentCurrencyCode . '</td>
            </tr>
            <tr>
                <th>Street Name</th>
                <td>' . $StreetName . '</td>
            </tr>
            <tr>
                <th>City Name</th>
                <td>' . $CityName . '</td>
            </tr>
            <tr>
                <th>Postal Zone</th>
                <td>' . $PostalZone . '</td>
            </tr>
            <tr>
                <th>Country Code</th>
                <td>' . $CountryCode . '</td>
            </tr>
            <tr>
                <th>Company Name</th>
                <td>' . $CompanyName . '</td>
            </tr>
            <tr>
                <th>Company ID</th>
                <td>' . $CompanyID . '</td>
            </tr>
            <tr>
                <th>Contact Email</th>
                <td>' . $ContactEmail . '</td>
            </tr>
            <tr>
                <th>Payment Means Code</th>
                <td>' . $PaymentMeansCode . '</td>
            </tr>
            <tr>
                <th>Payment ID</th>
                <td>' . $PaymentID . '</td>
            </tr>
            <tr>
                <th>Financial Account ID</th>
                <td>' . $FinancialAccountID . '</td>
            </tr>
            <tr>
                <th>Financial Account Name</th>
                <td>' . $FinancialAccountName . '</td>
            </tr>
            <tr>
                <th>Invoiced Quantity</th>
                <td>' . $InvoicedQuantity . '</td>
            </tr>
            <tr>
                <th>Line Extension Amount</th>
                <td>' . $LineExtensionAmount . '</td>
            </tr>
            <tr>
                <th>Item Name</th>
                <td>' . $ItemName . '</td>
            </tr>
            <tr>
                <th>Price Amount</th>
                <td>' . $PriceAmount . '</td>
            </tr>
        </table>
    ');
    
    

       
        $pdf->Output('Peppol_Invoice_#' . $data['invoice']['tid'] . '.pdf', 'I');
        
        

    }


}
