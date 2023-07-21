<?php


defined('BASEPATH') or exit('No direct script access allowed');
use GuzzleHttp\Client;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;
//use GuzzleHttp\Client;

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

    public function publishing_old()
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

    
    public function publishing()
    {
        $head['title'] = "E-Commerce Publishing";
        $head['usernm'] = $this->aauth->get_user()->username;

        $data['vendors'] = $this->ecommerce->GetThirdPartyVendors();
        $data['categories'] = $this->ecommerce->GetSegmentsPublishing();

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/publishing_new',$data);
        $this->load->view('fixed/footer');
    }


    public function get_categories_list(){
        $post = $this->input->post();
        $vendor = $post['vendor'];
        $vendor_name = $post['vendor_name'];

        if($vendor_name == 'POS')
        {
            $segments = $this->ecommerce->GetSegmentsPublishing();
            //echo "<pre>"; print_r($sub_segments); echo "</pre>";
            if(!empty($segments))
            {
                $html='<option value="">Select Category</option>';
                foreach($segments as $segment){
                $html.='<option value="'.$segment['id'].'">'.$segment['title'].'</option>';
                }
                echo $html;
            }else{
                $html='<option value="">Select Category</option>';
                echo $html;
            }
        }else{

            $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
            $segments = $this->ecommerce->GetThirdPartyCategories($vendor_details);
            if(!empty($segments))
            {
                $html='<option value="">Select Category</option>';
                foreach($segments as $segment){
                $html.='<option value="'.$segment->id.'">'.$segment->name.'</option>';
                }
                echo $html;
            }else{
                $html='<option value="">Select Category</option>';
                echo $html;
            }
        }
        
    }


    public function get_sub_categories_list(){
        $post = $this->input->post();
        $segment_id = $post['category'];
        $vendor = $post['vendor'];
        $vendor_name = $post['vendor_name'];

        if($vendor_name == 'POS')
        {
            $sub_segments = $this->ecommerce->GetSubSegmentsList($segment_id);
            //echo "<pre>"; print_r($sub_segments); echo "</pre>";
            if(!empty($sub_segments))
            {
                $html='<option value="">Select Sub Category</option>';
                foreach($sub_segments as $sub_segment){
                $html.='<option value="'.$sub_segment['id'].'">'.$sub_segment['title'].'</option>';
                }
                echo $html;
            }else{
                $html='<option value="">Select Sub Category</option>';
                echo $html;
            }
        }else{
            $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
            $sub_segments = $this->ecommerce->GetThirdPartySubCategories($vendor_details,$segment_id);
            if(!empty($sub_segments))
            {
                $html='<option value="">Select Sub Category</option>';
                foreach($sub_segments as $sub_segment){
                $html.='<option value="'.$sub_segment->id.'">'.$sub_segment->name.'</option>';
                }
                echo $html;
            }else{
                $html='<option value="">Select Sub Category</option>';
                echo $html;
            }
        }
        
    }


    public function get_products_list()
    {
        
        $vendor = $this->input->post('vendor');
        $vendor_name = $this->input->post('vendor_name');
        $category = $this->input->post('category');
        $sub_category = $this->input->post('sub_category');

        if($vendor_name == 'POS')
        {
            $products = $this->ecommerce->GetPosProductsList($vendor,$category,$sub_category);
            $data = array();
            $no = $this->input->post('start');

            
            // echo "<pre>"; print_r($products); echo "</pre>";
            // exit;

            foreach ($products as $product) {
                $row = array();
                $no++;
                $row[] = $no;
                $row[] = $product['product_name'];
                $row[] = $product['product_price'];
                $row[] = '---';
                $row[] = $product['ThirdPartyVendorPrice'];
                $temp = '<a data-object-id="' . $product['pid'] . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs view-object"><i class="fa fa-eye"></i></a>';
                $temp .= '<a href="' .  base_url('ecommerce/pos_product_edit/?' . http_build_query(array('id' => $product['pid'],'vendor_id' => $product['ThirdPartyVendorId'],'vendor_pr_id'=> $product['ThirdPartyVendorPricingId']))). '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>';
                $row[]=$temp;
                $data[] = $row;
            }
            
        }else{

            $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
            $thid_party_products =  $array2 = $this->ecommerce->GetThirdPartyProductsList($vendor_details,$category,$sub_category);
            $system_products = $array1 = $this->ecommerce->GetAllProductsList($vendor);

            // echo "<pre>"; print_r($thid_party_products); echo "</pre>";
            // echo "<pre>"; print_r($system_products); echo "</pre>";
            // exit;
            $mergedArray = [];
        foreach ($array1 as $item1) {
            $matched = false;
            foreach ($array2 as $item2) {

                // echo $item1['ThirdPartyVendorItemId']."====".$item2['id']."<br>";
                if ((int)$item1['ThirdPartyVendorItemId'] === (int)$item2['id']) {
                    $mergedArray[] = array_merge($item1, $item2, ['match_status' => '0']);
                    $matched = true;
                    break;
                }
            }
            if (!$matched) {
                $item1['match_status'] = '1';
                $mergedArray[] = $item1;
            }
        }

        // echo "<pre>"; print_r($mergedArray); echo "</pre>";
        // exit;
        // Add unmatched items from array2
        foreach ($array2 as $item2) {
            $matched = false;
            foreach ($array1 as $item1) {
                if ((int)$item2['id'] === (int)$item1['ThirdPartyVendorItemId']) {
                    $matched = true;
                    break;
                }
            }
            if (!$matched) {
                $item2['match_status'] = '2';
                $item2['pid'] = '';
                $item2['product_name'] = '';
                $item2['product_price'] = '';
                $item2['ThirdPartyVendorPricingId'] = '';
                $item2['ThirdPartyVendorItemId'] = '';
                $item2['ThirdPartyVendorId'] = $vendor;
                $item2['ThirdPartyVendorPrice'] = '';
                $mergedArray[] = $item2;
            }
        }

        // Output the merged array
        // echo "<pre>"; print_r($mergedArray); echo "</pre>";
        // exit;
        $products = $mergedArray;
        $data = array();
        $no = $this->input->post('start');

        foreach ($products as $product) {
            $row = array();
            $no++;
            $row[] = $no;
            if($product['match_status'] == '0')
            {
                $row[] = $product['product_name'];
                $row[] = $product['product_price'];
                $row[] = $product['name'];
                $row[] = $product['price'];
                $temp1 = '<a data-object-id="' . $product['pid'] . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs view-object"><i class="fa fa-eye"></i></a>';
                $temp1 .= '<a href="' .  base_url('ecommerce/third_party_product_edit/?' . http_build_query(array('id' => $product['id'],'vendor_id' => $product['ThirdPartyVendorId'],'vendor_pr_id'=> $product['ThirdPartyVendorId']))). '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>';
                $row[]=$temp1;
            }else if($product['match_status'] == '1'){
                $row[] = $product['product_name'];
                $row[] = $product['product_price'];
                $row[] = '---';
                $row[] = '---';
                $temp2 = '<a data-object-id="' . $product['pid'] . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs view-object"><i class="fa fa-eye"></i></a>';
                //$temp2 .= '<a href="' . base_url('jobsheets/edit/?id=' . $product['pid']) . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>';
                $temp2 .= '<a product_id='.$product['pid'].' vendor_id='.$product['ThirdPartyVendorId'].' vendor_pricing_id='.$product['ThirdPartyVendorPricingId'].' style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs share_product_to_third_party"><i class="fa fa-share"></i></a>';

                $row[]=$temp2;
            }else if($product['match_status'] == '2'){
                $row[] = '---';
                $row[] = '---';
                $row[] = $product['name'];
                $row[] = $product['price'];
                //$temp = '<a href="' . base_url('jobsheets/thread/?id=' . $product['id']) . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>';
                $temp3 = '<a href="' .  base_url('ecommerce/third_party_product_edit/?' . http_build_query(array('id' => $product['id'],'vendor_id' => $product['ThirdPartyVendorId'],'vendor_pr_id'=> 0))). '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>';
                $row[]=$temp3;
            }
           
            $data[] = $row;
        }
            
        }
     

        // $list = $this->jobsheet->jobsheet_datatables($filt,$status,$employee,$start_date,$end_date);
        

        $output = array(
           // "draw" => $_POST['draw'],
            "recordsTotal" => count($products),
            "recordsFiltered" => count($products),
            "data" => $data,
        );
        echo json_encode($output);
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

    
    public function share_product_to_third_party()
    {
        $post = $this->input->post();
        $vendor = $post['vendor_id'];
        $product_id = $post['product_id'];
        $vendor_pricing_id = $post['vendor_pricing_id'];

        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
        $product_details = $this->ecommerce->GetProductDetails($product_id);
        
        $response = $this->ecommerce->share_product_to_third_party($vendor_details,$product_details,$vendor_pricing_id);
        echo json_encode($response);
            
    }

    
    public function third_party_product_edit()
    {
        $product_id = $this->input->get('id');
        $vendor = $this->input->get('vendor_id');
        $vendor_pricing_id = $this->input->get('vendor_pr_id');
        // $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Product Edit';
       
        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
        $data['vendor_details'] = $vendor_details;
        $data['product_details'] = $this->ecommerce->get_third_party_product_details($vendor_details,$product_id);
        $data['vendor_pricing_id'] = $vendor_pricing_id;
        $data['vendor_id'] = $vendor;

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/third_party_product_edit',$data);
        $this->load->view('fixed/footer');
       
    }

    public function pos_product_edit()
    {
        $product_id = $this->input->get('id');
        $vendor = $this->input->get('vendor_id');
        $vendor_pricing_id = $this->input->get('vendor_pr_id');
        // $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Product Edit';
       
        //$vendor_details = $this->ecommerce->GetVendorDetails($vendor);
        //$data['vendor_details'] = $vendor_details;
        $data['product_details'] = $this->ecommerce->get_pos_product_details($vendor,$product_id,$vendor_pricing_id);
        $data['vendor_id'] = $vendor;
        $data['vendor_pricing_id'] = $vendor_pricing_id;

        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;
        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/pos_product_edit',$data);
        $this->load->view('fixed/footer');
       
    }

    public function vendor_edit()
    {
        $vendor_id = $this->input->get('id');
        $head['title'] = 'Vendor Edit';
        $data['vendor_details'] = $this->ecommerce->GetVendorDetails($vendor_id);
       
        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/vendor_edit',$data);
        $this->load->view('fixed/footer');
       
    }
    public function vendor_create()
    {
        
        $head['title'] = 'Vendor Create';
       
        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/vendor_create');
        $this->load->view('fixed/footer');
       
    }

    public function update_product_to_third_party()
    {
        $post = $this->input->post();
        $vendor = $post['vendor_id'];
        $product_id = $post['product_id'];
        $product_name = $post['product_name'];
        $product_price = $post['product_price'];
        $product_description = $post['product_description'];
        $vendor_pricing_id = $post['vendor_pricing_id'];

        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
        $product_details['product_name'] = $product_name;
        $product_details['product_price'] = $product_price;
        $product_details['product_description'] = $product_description;
        $product_details['product_id'] = $product_id;
        
        $response = $this->ecommerce->update_product_to_third_party($vendor_details,$product_details,$vendor_pricing_id);
        echo json_encode($response);
            
    }


    
    public function update_product_to_pos()
    {
        $post = $this->input->post();
        $vendor = $post['vendor_id'];
        $product_id = $post['product_id'];
        $product_price = $post['product_price'];
        $vendor_pricing_id = $post['vendor_pricing_id'];

        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);

        $product_details['product_price'] = $product_price;
        $product_details['product_id'] = $product_id;
        
        $response = $this->ecommerce->update_product_to_pos($vendor_details,$product_details,$vendor_pricing_id);
        echo json_encode($response);
            
    }

    public function vendor_save()
    {
        $post = $this->input->post();        
        $response = $this->ecommerce->vendor_save($post);
        echo json_encode($response);
            
    }
    public function vendor_delete()
    {
        $post = $this->input->post(); 
        $vendor_id = $post['vendor_id'];       
        $response = $this->ecommerce->vendor_delete($vendor_id);
        echo json_encode($response);
            
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
    
        echo $response;
        // echo "<pre>"; print_r($response); echo "</pre>";
        // exit;
        // Check if the request was successful
        if ($response !== false) {
            $products = json_decode($response);
            echo "<pre>"; print_r($products); echo "</pre>";
            exit;
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
    $url = 'https://jstore.my/wp-json/wc/v3/products/' . $product_id;

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



    public function update_product($product_id = '')
    {
        // WooCommerce API endpoint for updating a product
        $url = "https://jstore.my/wp-json/wc/v3/products/$product_id";

        // API authentication credentials
        $consumerKey = 'ck_79d37b95daf80fbe440c43c7a1a6833ab57dc8de';
        $consumerSecret = 'cs_203ef96d9576c53f711895fb3a55978ee390ad1d';

        // Updated product data
        $product_data = array(
            'regular_price' => '19.99',
            'description' => 'This is an updated product',
            'name' => 'siva tested a product'
            // Add more updated fields as needed
        );

        // Set cURL options
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret)
            ),
            CURLOPT_POSTFIELDS => json_encode($product_data)
        );

        // Initialize cURL
        $curl = curl_init();
        curl_setopt_array($curl, $options);

        // Send the cURL request
        $response = curl_exec($curl);

        // Check if the request was successful
        if ($response !== false) {
            $product = json_decode($response);

            // Product updated successfully
            echo "Product ID: $product->id<br>";
            echo "Product Name: $product->name<br>";
            echo "Product Price: $product->price<br>";
        } else {
            // Request failed, show an error message
            echo "Error updating product: " . curl_error($curl);
        }

        // Close cURL
        curl_close($curl);
    }

    public function change_product_status($product_id = '')
    {
        // WooCommerce API endpoint for updating a product
         $url = "https://jstore.my/wp-json/wc/v3/products/$product_id";

        // API authentication credentials
        $consumerKey = 'ck_79d37b95daf80fbe440c43c7a1a6833ab57dc8de';
        $consumerSecret = 'cs_203ef96d9576c53f711895fb3a55978ee390ad1d';

        // Enable product
        // $product_data = array(
        //     'status' => 'publish',
        // );
        // Disable product
        $product_data = array(
            'status' => 'draft',
        );

        // Set cURL options
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret)
            ),
            CURLOPT_POSTFIELDS => json_encode($product_data)
        );

        // Initialize cURL
        $curl = curl_init();
        curl_setopt_array($curl, $options);

        // Send the cURL request
        $response = curl_exec($curl);

        // Check if the request was successful
        if ($response !== false) {
            $product = json_decode($response);

            // Product disabled successfully
            echo "Product ID: $product->id<br>";
            echo "Product Name: $product->name<br>";
            echo "Product Status: $product->status<br>";
        } else {
            // Request failed, show an error message
            echo "Error disabling product: " . curl_error($curl);
        }

        // Close cURL
        curl_close($curl);
    }

    public function test(){
//         // Sample arrays
// $array1 = [
//     ['id' => 1, 'name' => 'John'],
//     ['id' => 2, 'name' => 'Alice'],
//     ['id' => 6, 'name' => 'fucker'],
// ];

// $array2 = [
//     ['id' => 1, 'age' => 25],
//     ['id' => 3, 'age' => 30],
//     ['id' => 4, 'age' => 30],
//     ['id' => 5, 'age' => 30],
//     ['id' => 6, 'age' => 30],
// ];

// // Merge arrays based on 'id' element
// $mergedArray = [];
// foreach ($array1 as $item1) {
//     $matched = false;
//     foreach ($array2 as $item2) {
//         if ($item1['id'] === $item2['id']) {
//             $mergedArray[] = array_merge($item1, $item2, ['match_status' => true]);
//             //$item1['match_status'] = true;
//             //$mergedArray[] = $item1;
//             $matched = true;
//         }
//     }
//     if (!$matched) {
//         $item1['match_status'] = false;
//         $mergedArray[] = $item1;
//     }
// }

// // Add unmatched items from array2
// foreach ($array2 as $item2) {
//     $matched = false;
//     foreach ($array1 as $item1) {
//         if ($item2['id'] === $item1['id']) {
//             $matched = true;
//             break;
//         }
//     }
//     if (!$matched) {
//         $item2['match_status'] = false;
//         $mergedArray[] = $item2;
//     }
// }

// // Output the merged array
// echo "<pre>"; print_r($mergedArray); echo "</pre>";

// Sample arrays
$array1 = [
    ['id' => 1, 'name' => 'John'],
    ['id' => 2, 'name' => 'Alice'],
    ['id' => 6, 'name' => 'fucker'],
];

$array2 = [
    ['id' => 1, 'age' => 25, 'id22' => 1, 'ag22e' => 25],
    ['id' => 3, 'age' => 30, 'id22' => 1, 'ag22e' => 25],
    ['id' => 4, 'age' => 30, 'id22' => 1, 'ag22e' => 25],
    ['id' => 5, 'age' => 30, 'id22' => 1, 'ag22e' => 25],
    ['id' => 6, 'age' => 30, 'id22' => 1, 'ag22e' => 25],
];

// Merge arrays based on 'id' element
$mergedArray = [];
foreach ($array1 as $item1) {
    $matched = false;
    foreach ($array2 as $item2) {
        if ($item1['id'] === $item2['id']) {
            $mergedArray[] = array_merge($item1, $item2, ['match_status' => 'Both']);
            $matched = true;
            break;
        }
    }
    if (!$matched) {
        $item1['match_status'] = 'Only in Array 1';
        $mergedArray[] = $item1;
    }
}

// Add unmatched items from array2
foreach ($array2 as $item2) {
    $matched = false;
    foreach ($array1 as $item1) {
        if ($item2['id'] === $item1['id']) {
            $matched = true;
            break;
        }
    }
    if (!$matched) {
        $item2['match_status'] = 'Only in Array 2';
        $mergedArray[] = $item2;
    }
}

// Output the merged array
echo "<pre>"; print_r($mergedArray); echo "</pre>";

    }

}

