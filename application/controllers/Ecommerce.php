<?php


defined('BASEPATH') or exit('No direct script access allowed');

use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
use GuzzleHttp\Client;

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
        $this->li_a = 'ecommerce';
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




    public function sales_invoices_products_ajax_list()
    {
        $list = $this->ecommerce->get_sales_invoices_products_datatables($this->limited);
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

            $row[] = '<a href="' . base_url("invoices/view?id=$invoices->pid") . '">&nbsp; ' . $invoices->tid . '</a>';
            $row[] = $invoices->product;
            $row[] = $sale_type;
            // $row[] = dateformat($invoices->invoice_sent_date);
            $row[] = $invoices->qty;
            $row[] = amountExchange($invoices->price, 0, $this->aauth->get_user()->loc);
            // $row[] = '<span class="st-' . $invoices->status . '">' . $this->lang->line(ucwords($invoices->status)) . '</span>';
           
            // $row[] = '<a href="' . base_url("invoices/view?id=$invoices->id") . '" class="btn btn-success btn-sm" title="View"><i class="fa fa-eye"></i></a>&nbsp;<a href="' . base_url("invoices/printinvoice?id=$invoices->id") . '&d=1" class="btn btn-info btn-sm"  title="Download"><span class="fa fa-download"></span></a>';
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

    public function publishing()
    {
        $this->li_a = 'ecommerce_publishing';
        $this->SetPublishingSessionId();
        // $MerchantId = $this->session->get('user_id');
        // $data['merchant_id'] = $MerchantId;
        $head['title'] = "E-Commerce Analytics";
        $head['usernm'] = $this->aauth->get_user()->username;

        $data['thirdparty_vendors'] = $this->ecommerce->GetThirdPartyVendors();
        $data['thirdparty_vendors_prices'] = $this->ecommerce->GetThirdPartyVendorsPrices();
        $data['segments'] = $this->ecommerce->GetSegmentsPublishing();

       
        // echo $data['segments'][0]['id'];
        // exit;

        if(!empty($data['segments'][0]['id']))
        {   $SegmentId=$data['segments'][0]['id'];
            //$SegmentId = 3;
            //$MerchantId=$data['segments'][0]['MerchantId']; 
            $data['sub_segments'] = $this->ecommerce->GetSubSegmentsPublishing($SegmentId);
        }else{
            $data['sub_segments'] = '';
        }
        
        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;

        // $data['view_page'] = 'product_catalogue/publishing';
        // return view('layouts/admin_layout',$data);

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/publishing',$data);
        $this->load->view('fixed/footer');
    }

    public function SetPublishingSessionId(){
        $publishingSessionId_id_check = $this->session->userdata('publishingSessionId');

        if ($publishingSessionId_id_check != '') {
            $publishingSessionId = $this->session->userdata('publishingSessionId');
        } else {
            $random_number = rand(999, 99999);
            $this->session->set_userdata('publishingSessionId', $random_number);
            $publishingSessionId = $this->session->userdata('publishingSessionId');
        }

    }

    public function GetUserPublishingActivities(){
        $data = $this->ecommerce->GetUserPublishingActivities();
        ob_start();
        $view_html = $this->load->view('ecommerce/publishing_activities_view', $data, TRUE);
        $return_html = ob_get_clean();
        echo json_encode(array("status"=>true,"html"=>$view_html));
        return true;
    }

    public function GetPublishingSubSegments(){
        $post = $this->input->post();
        $SegmentId = $post['fetchId'];
        //$MerchantId = $post['fetchId2'];
        $data = $this->ecommerce->GetSubSegmentsPublishing($SegmentId);
        //$data['merchant_id'] = $MerchantId;
        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;
        ob_start();
        $view_html = $this->load->view('ecommerce/sub_segments_publishing_ajax', $data,TRUE);
        $return_html = ob_get_clean();
        echo json_encode(array("status"=>true,"html"=>$view_html));
        return true;
    }

    public function GetPublishingSubSegmentsItems(){
        $post = $this->input->post();
        $SubSegmentId = $post['fetchId'];
        $SegmentId = $post['fetchId2'];
        $MerchantId=$post['fetchId3']; 
        $data = $this->ecommerce->GetPublishingSubSegmentsItems($SegmentId,$SubSegmentId,$MerchantId);
        //   echo "<pre>"; print_r($data); echo "</pre>";
        // exit;

        ob_start();
        $view_html = $this->load->view('ecommerce/sub_segments_publishing_items_ajax', $data,TRUE);
        $return_html = ob_get_clean();
        echo json_encode(array("status"=>true,"html"=>$view_html));
        return true;
    }

    
    public function UpdateThirdPartyVendorsStatusSegments(){
        $post = $this->input->post();
        $data = $this->ecommerce->UpdateThirdPartyVendorsStatusSegments($post);
        
        ob_start();
        $view_html = $this->load->view('ecommerce/sub_segments_publishing_ajax', $data, TRUE);
        $return_html = ob_get_clean();
        echo json_encode(array("status"=>true,"html"=>$view_html));
        return true;
    }


    public function UpdateThirdPartyVendorsPrices(){
        if (!$this->input->is_ajax_request()) {
             $json_data = array();
         }else{
             $post = $this->input->post();
             $json_data = $this->ecommerce->UpdateThirdPartyVendorsPrices( $post );
         }
         ob_get_clean();
         echo json_encode($json_data);
     }
 
     public function UpdateThirdPartyVendorsPricesStatus() {
         $post = $this->input->post();
         if(empty( $post['ItemId'] ) ){
             $result = array("Status"=>false,"Message"=>"Unable to change status");
         }else{
             $result = $this->ecommerce->UpdateThirdPartyVendorsPricesStatus( $post );
         }
         echo json_encode($result);
         return true;
     }
 
      public function UpdateThirdPartyVendorsStatus() {
         $post = $this->input->post();
         if(empty( $post['fetchId'] ) ){
             $result = array("Status"=>false,"Message"=>"Unable to change status");
         }else{
             $result = $this->ecommerce->UpdateThirdPartyVendorsStatus( $post );
         }
         echo json_encode($result);
         return true;
     }
 
     
     public function PublishingUserActivitiesUpdate(){
        if (!$this->input->is_ajax_request()) {
            $json_data = array();
        } else {
            $post = $this->input->post();
            $json_data = $this->ecommerce->PublishingUserActivitiesUpdate($post);
        }
        
        ob_get_clean();
        echo json_encode($json_data);
        
     }
 
   

    public function vendors()
    {
        $head['title'] = "E-Commerce Vendors";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['vendors'] = $this->ecommerce->GetThirdPartyVendors();
        
        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/vendors',$data);
        $this->load->view('fixed/footer');
    }


    public function products_list()
    {
        // WooCommerce API endpoint for listing products
        $url = 'https://jstore.my/wp-json/wc/v3/products';

        // API authentication credentials
        $consumerKey = 'ck_79d37b95daf80fbe440c43c7a1a6833ab57dc8de';
        $consumerSecret = 'cs_203ef96d9576c53f711895fb3a55978ee390ad1d';

        // Initialize Guzzle HTTP client
        $client = new Client();

        // Send GET request to retrieve products
        $response = $client->request('GET', $url, [
            'auth' => [$consumerKey, $consumerSecret]
        ]);

        // Check if the request was successful
        if ($response->getStatusCode() === 200) {
            $products = json_decode($response->getBody());

            // Process the list of products
            foreach ($products as $product) {
                // Access product details
                $productId = $product->id;
                $productName = $product->name;
                $productPrice = $product->price;

                // Do something with the product information (e.g., display it on the page)
                echo "Product ID: $productId<br>";
                echo "Product Name: $productName<br>";
                echo "Product Price: $productPrice<br><br>";
            }
        } else {
            // Request failed, show an error message
            echo "Error retrieving products";
        }
    }

    public function poducts_new_list()
    {
        // WooCommerce API endpoint for listing products
        $url = 'https://jstore.my/wp-json/wc/v3/products';

        // API authentication credentials
        $consumerKey = 'ck_79d37b95daf80fbe440c43c7a1a6833ab57dc8de';
        $consumerSecret = 'cs_203ef96d9576c53f711895fb3a55978ee390ad1d';

        // Initialize cURL session
        $ch = curl_init();
    
        // Set cURL options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret)
        ));
    
        // Execute cURL request
        $response = curl_exec($ch);
    
         echo "<pre>"; print_r($response); echo "</pre>";
        // exit;
        // Check if the request was successful
        if ($response !== false) {
            $products = json_decode($response);
    
            // Process the list of products
            foreach ($products as $product) {
                // Access product details
                $productId = $product->id;
                $productName = $product->name;
                $productPrice = $product->price;
    
                // Do something with the product information (e.g., display it on the page)
                echo "Product ID: $productId<br>";
                echo "Product Name: $productName<br>";
                echo "Product Price: $productPrice<br><br>";
            }
        } else {
            // Request failed, show an error message
            echo "Error retrieving products";
        }
    
        // Close cURL session
        curl_close($ch);
    }
    
    public function get_product($product_id)
{
    // WooCommerce API endpoint for fetching a single product
    $url = 'https://your-domain.com/wp-json/wc/v3/products/' . $product_id;

    // API authentication credentials
    $consumerKey = 'your_consumer_key';
    $consumerSecret = 'your_consumer_secret';

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret)
    ));

    // Execute cURL request
    $response = curl_exec($ch);

    // Check if the request was successful
    if ($response !== false) {
        $product = json_decode($response);

        // Access product details
        $productId = $product->id;
        $productName = $product->name;
        $productPrice = $product->price;

        // Do something with the product information (e.g., display it on the page)
        echo "Product ID: $productId<br>";
        echo "Product Name: $productName<br>";
        echo "Product Price: $productPrice<br>";
    } else {
        // Request failed, show an error message
        echo "Error retrieving product";
    }

    // Close cURL session
    curl_close($ch);
}


}

