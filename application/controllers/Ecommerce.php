<?php

defined('BASEPATH') or exit('No direct script access allowed');
use GuzzleHttp\Client;

//use GuzzleHttp\Client;

class Ecommerce extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('invoices_model', 'invocies');
        $this->load->model('pos_invoices_model', 'posinvocies');
        $this->load->model('categories_model', 'products_cat');
        $this->load->model('plugins_model', 'plugins');
        $this->load->model('ecommerce_model', 'ecommerce');
        $this->load->library("Aauth");

        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        // if (!$this->aauth->premission(1)) {
        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }

        if (($this->aauth->get_user()->roleid == 5) || ($this->aauth->get_user()->roleid == 4)) {
            $this->limited = '';
        } else {
            $this->limited = $this->aauth->get_user()->id;
        }
        $this->load->library("Custom");
        $this->li_a = 'ecommerce';
        $c_module = 'e-commerce';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);
    }

    //invoices list
    public function analytics()
    {
        $head['title'] = "E-Commerce Analytics";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['vendors'] = $this->ecommerce->GetThirdPartyVendors();
        // $data['online_sales'] = $this->ecommerce->getInvoiceCountByType(1);
        // $data['offline_sales'] = $this->ecommerce->getInvoiceCountByType(0);
        // $data['online_prod_sales'] = $this->ecommerce->getInvoiceProductsCountByType(1);
        // $data['offline_prod_sales'] = $this->ecommerce->getInvoiceProductsCountByType(0);
        $data['total_sales'] = 0;
        $data['total_orders'] = 0;
        $data['total_products'] = 0;
        $data['total_tax'] = 0;

        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;
        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/analytics', $data);
        $this->load->view('fixed/footer');
    }

    public function get_ajax_total_analytics()
    {

        $data['vendors'] = $this->ecommerce->GetThirdPartyVendors();

        $online_sales = 0;
        $offline_sales = 0;

        if (!empty($data['vendors'])) {
            foreach ($data['vendors'] as $vendor_details) {
                if ($vendor_details['VendorName'] == 'POS') {
                    $post = array();
                    $analytics = $this->ecommerce->GetPosAnalytics($post);
                    $data1['title'] = strtoupper($vendor_details['VendorName']) . $this->lang->line('Sales');
                    $data1['total_sales'] = $analytics['analytics'][0]['total_sales'];
                    $n_data[] = $data1;
                    $offline_sales += $data1['total_sales'];

                } else {
                    $vendor = $vendor_details['Id'];
                    $post['start_date'] = '1970-01-01';
                    $post['end_date'] = date('Y-m-d');
                    $vendor_details1 = $this->ecommerce->GetVendorDetails($vendor);
                    $analytics = $this->ecommerce->GetSalesReport($vendor_details1, $post);

                    // echo "<pre>"; print_r($analytics); echo "</pre>";
                    // exit;
                    $data1['title'] = strtoupper($vendor_details['VendorName']) . $this->lang->line('Sales');
                    if(!empty($analytics))
                    {
                        $data1['total_sales'] = $analytics[0]['total_sales'];
                    }else{
                        $data1['total_sales'] = 0.00;
                    }

                    $n_data[] = $data1;

                    if ($vendor_details['Id'] == "Offline") {
                        $offline_sales += $data1['total_sales'];
                    } else {
                        $online_sales += $data1['total_sales'];
                    }

                }
            }
        }

        $data['platform_sales'] = $n_data;
        $data['online_sales'] = $online_sales;
        $data['offline_sales'] = $offline_sales;

        echo $this->load->view('ecommerce/total_analytics_ajax_block', $data, true);
    }
    public function get_ajax_analytics()
    {
        $post = $this->input->post();
        $vendor_name = $post['vendor_name'];
        $vendor = $post['vendor_type'];
        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
        $data['vendor_details'] = $vendor_details;
        if ($vendor_name == 'POS') {
            $analytics = $this->ecommerce->GetPosAnalytics($post);

            $data['analytics'][0]['total_sales'] = $analytics['analytics'][0]['total_sales'];
            $data['analytics'][0]['total_orders'] = $analytics['analytics'][0]['total_orders'];
            $data['analytics'][0]['total_items'] = $analytics['counts'][0]['total_unique_pid_count'];
            $data['analytics'][0]['total_tax'] = $analytics['analytics'][0]['total_tax'];
            $data['analytics'][0]['totals'] = $this->ecommerce->GetAnalyticsOrders($vendor_details, $post);
            $data['type'] = $vendor_name;

        } else {
            $vendor = $post['vendor_type'];
            $start_date = $post['start_date'];
            $end_date = $post['end_date'];
            $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
            $data['analytics'] = $this->ecommerce->GetSalesReport($vendor_details, $post);
            $data['type'] = $vendor_name;
            // echo "<pre>"; print_r($data); echo "</pre>";
            // exit;
        }

        echo $this->load->view('ecommerce/analytics_ajax_block', $data, true);
    }

    public function sales_invoices_ajax_list()
    {
        $list = $this->ecommerce->get_sales_invoices_datatables($this->limited);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $invoices) {

            if ($invoices->invoice_type == '0') {
                $sale_type = 'offline';
            } else {
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

            if ($invoices->invoice_type == '0') {
                $sale_type = 'offline';
            } else {
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

        if (!empty($data['segments'][0]['id'])) {$SegmentId = $data['segments'][0]['id'];
            //$SegmentId = 3;
            //$MerchantId=$data['segments'][0]['MerchantId'];
            $data['sub_segments'] = $this->ecommerce->GetSubSegmentsPublishing($SegmentId);
        } else {
            $data['sub_segments'] = '';
        }

        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;

        // $data['view_page'] = 'product_catalogue/publishing';
        // return view('layouts/admin_layout',$data);

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/publishing', $data);
        $this->load->view('fixed/footer');
    }

    public function SetPublishingSessionId()
    {
        $publishingSessionId_id_check = $this->session->userdata('publishingSessionId');

        if ($publishingSessionId_id_check != '') {
            $publishingSessionId = $this->session->userdata('publishingSessionId');
        } else {
            $random_number = rand(999, 99999);
            $this->session->set_userdata('publishingSessionId', $random_number);
            $publishingSessionId = $this->session->userdata('publishingSessionId');
        }

    }

    public function GetUserPublishingActivities()
    {
        $data = $this->ecommerce->GetUserPublishingActivities();
        ob_start();
        $view_html = $this->load->view('ecommerce/publishing_activities_view', $data, true);
        $return_html = ob_get_clean();
        echo json_encode(array("status" => true, "html" => $view_html));
        return true;
    }

    public function GetPublishingSubSegments()
    {
        $post = $this->input->post();
        $SegmentId = $post['fetchId'];
        //$MerchantId = $post['fetchId2'];
        $data = $this->ecommerce->GetSubSegmentsPublishing($SegmentId);
        //$data['merchant_id'] = $MerchantId;
        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;
        ob_start();
        $view_html = $this->load->view('ecommerce/sub_segments_publishing_ajax', $data, true);
        $return_html = ob_get_clean();
        echo json_encode(array("status" => true, "html" => $view_html));
        return true;
    }

    public function GetPublishingSubSegmentsItems()
    {
        $post = $this->input->post();
        $SubSegmentId = $post['fetchId'];
        $SegmentId = $post['fetchId2'];
        $MerchantId = $post['fetchId3'];
        $data = $this->ecommerce->GetPublishingSubSegmentsItems($SegmentId, $SubSegmentId, $MerchantId);
        //   echo "<pre>"; print_r($data); echo "</pre>";
        // exit;

        ob_start();
        $view_html = $this->load->view('ecommerce/sub_segments_publishing_items_ajax', $data, true);
        $return_html = ob_get_clean();
        echo json_encode(array("status" => true, "html" => $view_html));
        return true;
    }

    public function UpdateThirdPartyVendorsStatusSegments()
    {
        $post = $this->input->post();
        $data = $this->ecommerce->UpdateThirdPartyVendorsStatusSegments($post);

        ob_start();
        $view_html = $this->load->view('ecommerce/sub_segments_publishing_ajax', $data, true);
        $return_html = ob_get_clean();
        echo json_encode(array("status" => true, "html" => $view_html));
        return true;
    }

    public function UpdateThirdPartyVendorsPrices()
    {
        if (!$this->input->is_ajax_request()) {
            $json_data = array();
        } else {
            $post = $this->input->post();
            $json_data = $this->ecommerce->UpdateThirdPartyVendorsPrices($post);
        }
        ob_get_clean();
        echo json_encode($json_data);
    }

    public function UpdateThirdPartyVendorsPricesStatus()
    {
        $post = $this->input->post();
        if (empty($post['ItemId'])) {
            $result = array("Status" => false, "Message" => "Unable to change status");
        } else {
            $result = $this->ecommerce->UpdateThirdPartyVendorsPricesStatus($post);
        }
        echo json_encode($result);
        return true;
    }

    public function UpdateThirdPartyVendorsStatus()
    {
        $post = $this->input->post();
        if (empty($post['fetchId'])) {
            $result = array("Status" => false, "Message" => "Unable to change status");
        } else {
            $result = $this->ecommerce->UpdateThirdPartyVendorsStatus($post);
        }
        echo json_encode($result);
        return true;
    }

    public function PublishingUserActivitiesUpdate()
    {
        if (!$this->input->is_ajax_request()) {
            $json_data = array();
        } else {
            $post = $this->input->post();
            $json_data = $this->ecommerce->PublishingUserActivitiesUpdate($post);
        }

        ob_get_clean();
        echo json_encode($json_data);

    }

    public function online_platforms()
    {
        $head['title'] = "E-Commerce Vendors";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['vendors'] = $this->ecommerce->GetThirdPartyVendors();

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/vendors', $data);
        $this->load->view('fixed/footer');
    }

    public function publishing()
    {
        $head['title'] = "E-Commerce Publishing";
        $head['usernm'] = $this->aauth->get_user()->username;

        $data['vendors'] = $this->ecommerce->GetThirdPartyVendors();
        $data['categories'] = $this->ecommerce->GetSegmentsPublishing();

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/publishing_new', $data);
        $this->load->view('fixed/footer');
    }

    public function get_categories_list()
    {
        $post = $this->input->post();
        $vendor = $post['vendor'];
        $vendor_name = $post['vendor_name'];

        if ($vendor_name == 'POS') {
            $segments = $this->ecommerce->GetSegmentsPublishing();
            //echo "<pre>"; print_r($sub_segments); echo "</pre>";
            if (!empty($segments)) {
                $html = '<option value="">Select Category</option>';
                foreach ($segments as $segment) {
                    $html .= '<option value="' . $segment['id'] . '">' . $segment['title'] . '</option>';
                }
                echo $html;
            } else {
                $html = '<option value="">Select Category</option>';
                echo $html;
            }
        } else {

            $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
            $segments = $this->ecommerce->GetThirdPartyCategories($vendor_details);
            if (!empty($segments)) {
                $html = '<option value="">Select Category</option>';
                foreach ($segments as $segment) {
                    $html .= '<option value="' . $segment['id'] . '">' . $segment['name'] . '</option>';
                }
                echo $html;
            } else {
                $html = '<option value="">Select Category</option>';
                echo $html;
            }
        }

    }

    public function get_sub_categories_list()
    {
        $post = $this->input->post();
        $segment_id = $post['category'];
        $vendor = $post['vendor'];
        $vendor_name = $post['vendor_name'];
        $sub_category = '';
        if (isset($post['sub_category'])) {
            $sub_category = $post['sub_category'];

        }

        if (isset($post['cat_type'])) {
            $cat_type = $post['cat_type'];

        }else{
            $cat_type = '';
        }

        if ($vendor_name == 'POS') {
            $sub_segments = $this->ecommerce->GetSubSegmentsList($segment_id);
            //echo "<pre>"; print_r($sub_segments); echo "</pre>";
            if (!empty($sub_segments)) {
                $html = '<option value="">Select Sub Category</option>';
                foreach ($sub_segments as $sub_segment) {
                    $html .= '<option value="' . $sub_segment['id'] . '">' . $sub_segment['title'] . '</option>';
                }
                echo $html;
            } else {
                $html = '<option value="">Select Sub Category</option>';
                echo $html;
            }
        } else {
            $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
            $sub_segments = $this->ecommerce->GetThirdPartySubCategories($vendor_details, $segment_id);
            $selected = '';

            if($cat_type == 'child')
            {
                $html = '<option value="">Select Child Category</option>';
            }else{
                $html = '<option value="">Select Sub Category</option>';
            }
            

            if (!empty($sub_segments)) {
                //$html = '<option value="">Select Sub Category</option>';
                foreach ($sub_segments as $sub_segment) {
                    if ($sub_segment['id'] == $sub_category) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    $html .= '<option value="' . $sub_segment['id'] . '" ' . $selected . '>' . $sub_segment['name'] . '</option>';
                }
                echo $html;
            } else {
                //$html = '<option value="">Select Sub Category</option>';
                echo $html;
            }
        }

    }



    public function get_sub_categories_edit_page_list()
    {
        $post = $this->input->post();
        $segment_id = $post['category'];
        $vendor = $post['vendor'];
        $vendor_name = $post['vendor_name'];
        $categories_list = json_decode($post['categories_list'],true);

        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
        $sub_segments = $this->ecommerce->GetThirdPartySubCategories($vendor_details, $segment_id);
        $selected = '';
        if (!empty($sub_segments)) {
            $html = '<option value="">Select Sub Category</option>';
            foreach ($sub_segments as $sub_segment) {
                if (in_array($sub_segment['id'],$categories_list)) {
                    $selected = 'selected';
                } else {
                    $selected = '';
                }
                $html .= '<option value="' . $sub_segment['id'] . '" ' . $selected . '>' . $sub_segment['name'] . '</option>';
            }
            echo $html;
        } else {
            $html = '<option value="">Select Sub Category</option>';
            echo $html;
        }
    

    }

    public function get_products_list()
    {

        $vendor = $this->input->post('vendor');
        $vendor_name = $this->input->post('vendor_name');
        $category = $this->input->post('category');
        $sub_category = $this->input->post('sub_category');
        $target_vendor = $this->input->post('target_vendor');

        if ($vendor_name == 'POS') {

            $post = $this->input->post();
            $vendor_details = $this->ecommerce->GetVendorDetails($target_vendor);
            $products = $this->ecommerce->GetPosProductsList($vendor, $category, $sub_category,$post);

            $tp_products_list = $this->ecommerce->GetPosProductsList($target_vendor, $category, $sub_category, array());

            // echo "<pre>"; print_r($tp_products_list); echo "</pre>";
            // exit;

            $combined_array = array();
            $combined_array_ids = array();
            // Loop through the products array
            foreach ($tp_products_list as $tp_product) {
                if (!empty($tp_product['pid']) && !empty($tp_product['ThirdPartyVendorItemId'])) {
                    $combined_array[] = array(
                        'pid' => $tp_product['pid'],
                        'ThirdPartyVendorItemId' => $tp_product['ThirdPartyVendorItemId'],
                    );
                    $combined_array_ids[] = $tp_product['ThirdPartyVendorItemId'];
                }
            }
            // $tp_item_ids = array_column($tp_products_list,'ThirdPartyVendorItemId');
            // $filtered_array = array_filter($tp_item_ids);
            // $fin_tp_item_ids = array_values($filtered_array);
            $newArray = [];
            if (!empty($combined_array_ids)) {
                $productIds = implode(',', $combined_array_ids);

                // echo "<pre>"; print_r($fin_tp_item_ids); echo "</pre>";
                // exit;
                //$vendor_details = $this->ecommerce->GetVendorDetails(4);
                $tp_products = $this->ecommerce->GetThirdPartyProductsByIds($vendor_details, $productIds);
                $tp_prod_ids = array_column($tp_products, 'id');
                foreach ($tp_products as $tp_product_d) {
                    $newArray[] = [
                        'id' => $tp_product_d['id'],
                        'regular_price' => $tp_product_d['regular_price'],
                        'sale_price' => $tp_product_d['sale_price'],
                    ];
                }

            } else {
                $tp_prod_ids = array();
            }

                                    
            $combined_assoc = [];
                foreach ($combined_array as $product) {
                    $combined_assoc[$product['ThirdPartyVendorItemId']] = $product;
                }

                // Merge values from $newArray into $combined_assoc based on 'id'
                foreach ($newArray as $newProduct) {
                    if (isset($combined_assoc[$newProduct['id']])) {
                        $combined_assoc[$newProduct['id']] = array_merge($combined_assoc[$newProduct['id']], $newProduct);
                    }
                }

                // Convert associative array back to indexed array
                $combined_array = array_values($combined_assoc);

                $filtered_array = array_filter($combined_array, function ($product) use ($tp_prod_ids) {
                    return in_array($product['ThirdPartyVendorItemId'], $tp_prod_ids);
                });
                
               
            $filtered_array = array_values($filtered_array);
            $tp_prod_ids = array_column($filtered_array, 'pid');
              //  echo "<pre>"; print_r($combined_array); echo "</pre>";
            //    echo "<pre>"; print_r($filtered_array); echo "</pre>";
            //         exit;

            $data = array();
            $no = $this->input->post('start');

            // echo "<pre>"; print_r($products); echo "</pre>";
            // exit;
            $products_count = count($products);
            foreach ($products as $product) {
                $row = array();
                $no++;

                $temp = '<a data-object-id="' . $product['pid'] . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs view-object"><i class="fa fa-eye"></i> View</a>';
                $temp .= '<a href="' . base_url('ecommerce/pos_product_edit/?' . http_build_query(array('id' => $product['pid'], 'vendor_id' => $product['ThirdPartyVendorId'], 'vendor_pr_id' => $product['ThirdPartyVendorPricingId']))) . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</a>';

                if (!in_array($product['pid'], $tp_prod_ids)) {
                    $temp .= '<a href="' . base_url('ecommerce/third_party_product_create/?' . http_build_query(array('id' => $product['pid'], 'vendor_id' => $vendor_details[0]['Id'], 'vendor_pr_id' => $product['ThirdPartyVendorPricingId']))) . '" product_id=' . $product['pid'] . ' vendor_id=' . $product['ThirdPartyVendorId'] . ' vendor_pricing_id=' . $product['ThirdPartyVendorPricingId'] . ' style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs share_product_to_third_party_old"><i class="fa fa-share"></i> Publish</a>';
                    $check_status = '';
                } else {
                    $check_status = "disabled";
                }

                $row[] = '<input  ' . $check_status . ' type="checkbox" name="pos_product_ids" vendor_pr_id =' . $product['ThirdPartyVendorPricingId'] . ' class="checkbox" fetchId="' . $product['pid'] . '" value="' . $product['pid'] . '"> ';
                $row[] = $no;
                $row[] = $product['product_name'];
                $row[] = $product['product_price'];

                
                $matched_array = null;
                $desired_pid = $product['pid'];
                foreach ($filtered_array as $product) {
                    if ($product['pid'] === $desired_pid) {
                        $matched_array = $product;
                        break; // No need to continue searching
                    }
                }

                if ($matched_array !== null) {
                    $regular_price = $matched_array['regular_price'];
                    $sale_price = $matched_array['sale_price'];
                    if(!empty($sale_price))
                    {
                        $row[] = $sale_price;
                    }else{
                        $row[] = $regular_price;
                    }   
                    // echo "Regular Price: $regular_price<br>";
                    // echo "Sale Price: $sale_price<br>";
                } else {
                    $row[] = '----';
                }

                // $row[] = '---';
                // $row[] = $product['ThirdPartyVendorPrice'];

                $row[] = $temp;
                $data[] = $row;
            }

        } else {
            $post = $this->input->post();
            $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
            $products = $thid_party_products = $array2 = $this->ecommerce->GetThirdPartyProductsList($vendor_details, $category, $sub_category,$post);
            $products_count = $this->ecommerce->GetThirdPartyProductsListCount($vendor_details, $category, $sub_category,$post);
            
            $data = array();
            // echo $products_count;
            // exit;
            $no = $this->input->post('start');
            // echo $length = $this->input->post('length');
            
            // echo $search_key = $post['search']['value'];

            // exit;
            // $no = 0;

            foreach ($products as $product) {
                $row = array();
                $no++;
                $row[] = '<input  disabled type="checkbox" name="tp_product_ids"  class="checkbox" > ';
                $row[] = $no;
            
                $row[] = $product['name'];
                if(!empty($product['regular_price']))
                {
                    $row[] = $product['regular_price'];
                }else{
                    
                    $row[] = $product['price'];
                }

                //$row[] = $product['regular_price'];
                if(!empty($product['sale_price']))
                {
                    $row[] = $product['sale_price'];
                }else{
                    if(!empty($product['regular_price']))
                    {
                        $row[] = $product['regular_price'];
                    }else{
                        
                        $row[] = $product['price'];
                    }
                }
                
                $temp1 = '<a href="' . base_url('ecommerce/third_party_product_view/?' . http_build_query(array('id' => $product['id'], 'vendor_id' => $vendor_details[0]['Id'], 'vendor_pr_id' => $vendor_details[0]['Id']))) . '" data-object-id="' . $product['id'] . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs view-object1"><i class="fa fa-eye"></i> View</a>';
                $temp1 .= '<a href="' . base_url('ecommerce/third_party_product_edit/?' . http_build_query(array('id' => $product['id'], 'vendor_id' => $vendor_details[0]['Id'], 'vendor_pr_id' => $vendor_details[0]['Id']))) . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-edit"></i> Edit</a>';
                $row[] = $temp1;

                $data[] = $row;
            }

        }

        // $list = $this->jobsheet->jobsheet_datatables($filt,$status,$employee,$start_date,$end_date);

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $products_count,
            "recordsFiltered" => $products_count,
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
            'auth' => [$consumerKey, $consumerSecret],
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

    public function publish_product_to_third_party()
    {
        $post = $this->input->post();
        $vendor = $post['vendor_id'];
        $product_id = $post['product_id'];
        $vendor_pricing_id = $post['vendor_pricing_id'];
        $product_details['category'] = $post['category'];
        $product_details['sub_category'] = $post['sub_category'];
        $product_details['child_category'] = $post['child_category'];
        $product_details['product_name'] = $post['product_name'];
        $product_details['regular_price'] = $post['regular_price'];
        $product_details['sale_price'] = $post['sale_price'];
        //$product_details['quantity'] = $post['quantity'];
        $product_details['product_description'] = $post['product_description'];
        $product_details['image_url'] = $post['image_url'];

        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
        //$product_details = $this->ecommerce->GetProductDetails($product_id);

        $response = $this->ecommerce->share_product_to_third_party($vendor_details, $product_details, $vendor_pricing_id);
        echo json_encode($response);

    }

    public function share_bulk_products_to_third_party()
    {
        $post = $this->input->post();
        $vendor = $post['vendor_id'];
        $product_ids = $post['product_ids'];

        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
        //$p_details = $this->ecommerce->GetVProductDetails($product_id);
        // //$product_details = $this->ecommerce->GetProductDetails($product_id);
        // echo "<pre>"; print_r($post); echo "</pre>";
        // exit;
        $selectedProductsArray = json_decode($product_ids, true);
        $allProductsProcessedSuccessfully = true; // Flag to track overall success
        $image_error = false;
        foreach ($selectedProductsArray as $pr_id) {
            $product_details = array();
            
            $p_details = $this->ecommerce->GetVProductDetails($vendor, $pr_id['fetchId']);
            $p_name = $p_details[0]['product_name'];
            $product_details['category'] = $post['category'];
            $product_details['sub_category'] = $post['sub_category'];
            $product_details['product_name'] = $p_details[0]['product_name'];
            $product_details['regular_price'] = $p_details[0]['product_price'];
            $product_details['sale_price'] = $p_details[0]['product_price'];
            //$product_details['quantity'] = $post['quantity'];
            $product_details['product_description'] = $p_details[0]['product_des'];
            $product_details['image_url'] = base_url('userfiles/product/').$p_details[0]['image'];
            $product_details['vendor_pricing_id'] = $p_details[0]['ThirdPartyVendorPricingId'];
            $all_product_details[] = $product_details;


            $imageUrl = base_url('userfiles/product/').$p_details[0]['image']; // Replace with the actual image URL
            $imageInfo = @getimagesize($imageUrl);

            if ($imageInfo !== false) {

            } else {
                $image_error = true;

                $finalResponse = array(
                    'status' => '500',
                    'message' => '('.$p_name.') Image Were Not Fully Qualified Please check url',
                );
            }

        }

        if(!$image_error)
        {   
            foreach($all_product_details as $all_p_details)
            {
                $vendor_pricing_id = $all_p_details['vendor_pricing_id'];
                // echo "<pre>"; print_r($product_details); echo "</pre>";
                $response = $this->ecommerce->share_product_to_third_party($vendor_details, $all_p_details, $vendor_pricing_id);
                if ($response['status'] !== '200') {
                    $allProductsProcessedSuccessfully = false;
                }
            }
            


            if ($allProductsProcessedSuccessfully) {
            $finalResponse = array(
                'status' => '200',
                'message' => 'All products added successfully',
            );
            } else {
            $finalResponse = array(
                'status' => '500',
                'message' => 'Some products failed to be added',
            );
            }

        }
        // Return the final response
        echo json_encode($finalResponse);

    }

    public function third_party_product_create()
    {
        $product_id = $this->input->get('id');
        $vendor = $this->input->get('vendor_id');
        $vendor_pricing_id = $this->input->get('vendor_pr_id');
        // $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Product Create';

        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
        $data['categories'] = $this->ecommerce->GetThirdPartyCategories($vendor_details);
        $data['vendor_details'] = $vendor_details;
        //$data['product_details'] = $this->ecommerce->GetProductDetails($product_id);
        $data['product_details'] = $this->ecommerce->GetVProductDetails($vendor, $product_id);
        $data['vendor_pricing_id'] = $vendor_pricing_id;
        $data['vendor_id'] = $vendor;
        //$data['product_details'] = $this->ecommerce->GetVProductDetails($vendor,$product_id);

        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/third_party_product_create', $data);
        $this->load->view('fixed/footer');

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
        $data['product_details'] = $this->ecommerce->get_third_party_product_details($vendor_details, $product_id);

        // echo "<pre>"; print_r($data['product_details']); echo "</pre>";
        // exit;
        $data['vendor_pricing_id'] = $vendor_pricing_id;
        $data['vendor_id'] = $vendor;
        $data['categories'] = $this->ecommerce->GetThirdPartyCategories($vendor_details);
        // $data['p_cat_id'] = 0;
        $data['category_details'] = array();
        if (!empty($data['product_details']['categories'][0]['id'])) {
            $data['p_cat_id'] = $this->ecommerce->GetAllThirdPartyCategoriesHeirarichy($vendor_details, $data['product_details']['categories'][0]['id']);

            // echo "<pre>"; print_r($category_details); echo "</pre>";
            // exit;
            // $data['category_details'] = $category_details;
            // if(!empty($category_details)){
            //     if($category_details['parent'] != 0)
            //     {
            //         $data['p_cat_id'] = $category_details['parent'];
            //     }else{
            //         $data['p_cat_id'] = $data['product_details']['categories'][0]['id'];
            //     }
            // }
        }

        // echo "<pre>"; print_r($data['p_cat_id']); echo "</pre>";
        // exit;

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/third_party_product_edit', $data);
        $this->load->view('fixed/footer');

    }

    public function third_party_product_view()
    {
        $product_id = $this->input->get('id');
        $vendor = $this->input->get('vendor_id');
        $vendor_pricing_id = $this->input->get('vendor_pr_id');
        // $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Product View';

        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
        $data['vendor_details'] = $vendor_details;
        $data['product_details'] = $this->ecommerce->get_third_party_product_details($vendor_details, $product_id);
        $data['vendor_pricing_id'] = $vendor_pricing_id;
        $data['vendor_id'] = $vendor;
        $data['categories'] = $this->ecommerce->GetThirdPartyCategories($vendor_details);
        // $data['p_cat_id'] = 0;
        $data['category_details'] = array();
        if (!empty($data['product_details']['categories'][0]['id'])) {
            $data['p_cat_id'] = $this->ecommerce->GetAllThirdPartyCategoriesHeirarichy($vendor_details, $data['product_details']['categories'][0]['id']);

            // echo "<pre>"; print_r($category_details); echo "</pre>";
            // exit;
            // $data['category_details'] = $category_details;
            // if(!empty($category_details)){
            //     if($category_details['parent'] != 0)
            //     {
            //         $data['p_cat_id'] = $category_details['parent'];
            //     }else{
            //         $data['p_cat_id'] = $data['product_details']['categories'][0]['id'];
            //     }
            // }
        }

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/third_party_product_view', $data);
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
        $data['product_details'] = $this->ecommerce->get_pos_product_details($vendor, $product_id, $vendor_pricing_id);
        $data['vendor_id'] = $vendor;
        $data['vendor_pricing_id'] = $vendor_pricing_id;

        $data['cat_ware'] = $this->products_cat->cat_ware($product_id);
        $data['cat_sub'] = $this->products_cat->sub_cat_curr($data['product_details'][0]['sub_id']);
        $data['cat_sub_list'] = $this->products_cat->sub_cat_list($data['product_details'][0]['pcat']);
        $data['cat'] = $this->products_cat->category_list();
        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;
        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/pos_product_edit', $data);
        $this->load->view('fixed/footer');

    }

    public function vendor_edit()
    {
        $vendor_id = $this->input->get('id');
        $head['title'] = 'Online Platform Edit';
        $data['vendor_details'] = $this->ecommerce->GetVendorDetails($vendor_id);

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/vendor_edit', $data);
        $this->load->view('fixed/footer');

    }
    public function online_platform_create()
    {

        $head['title'] = 'Online Platform Create';

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
        $sale_price = $post['sale_price'];
        $product_description = $post['product_description'];
        $vendor_pricing_id = $post['vendor_pricing_id'];

        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
        $product_details['product_name'] = $product_name;
        $product_details['product_price'] = $product_price;
        $product_details['sale_price'] = $sale_price;
        $product_details['product_description'] = $product_description;
        $product_details['product_id'] = $product_id;
        $product_details['category'] = $post['category'];
        $product_details['sub_category'] = $post['sub_category'];
        $product_details['child_category'] = $post['child_category'];
        //$product_details['quantity'] = $post['quantity'];
        $product_details['image_url'] = $post['image_url'];

        $response = $this->ecommerce->update_product_to_third_party($vendor_details, $product_details, $vendor_pricing_id);
        echo json_encode($response);

    }

    public function update_product_to_pos()
    {
        $post = $this->input->post();
        $vendor = $post['vendor_id'];
        $product_id = $post['product_id'];
        $product_price = $post['product_price'];
        $vendor_pricing_id = $post['vendor_pricing_id'];
        $product_name = $post['product_name'];

        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);

        $product_details['product_price'] = $product_price;
        $product_details['product_id'] = $product_id;
        $product_details['product_name'] = $product_name;
        $product_details['category'] = $post['product_cat'];
        $product_details['sub_category'] = $post['sub_cat'];
        $product_details['product_description'] = $post['description'];

        $response = $this->ecommerce->update_product_to_pos($vendor_details, $product_details, $vendor_pricing_id);
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

    public function get_products_list_by_invoices()
    {
        $post = $this->input->post();
        $vendor = $post['vendor_id'];
        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
        $items = $this->ecommerce->get_products_list_by_invoices($post, $vendor_details);

        if (!empty($items)) {
            $c = 1;
            $html = '';
            $prevOrder = null;

            foreach ($items as $item) {
                if ($prevOrder !== $item['tid']) {
                    // Start a new section for a different order
                    if ($prevOrder !== null) {
                        $html .= '</tbody></table>';
                    }

                    $prevOrder = $item['tid'];
                    //$html .= '<h3>' . $prevOrder . '</h3>';
                    $html .= '<table>';
                    $html .= '<thead><tr><th>S.No</th><th>Product Name</th><th>Quantity</th></tr></thead>';
                    $html .= '<tbody>';
                }

                $html .= '<tr>';
                $html .= '<td>' . $c . '</td>';
                $html .= '<td>' . $item['product'] . '</td>';
                $html .= '<td>' . $item['qty'] . '</td>';
                $html .= '</tr>';

                $c++;
                if (!empty($items)) {
                    $html .= '</tbody></table>';
                }
            }

            $response['status'] = '200';
            $response['products'] = $html;
        } else {
            $response['status'] = '500';
            $response['products'] = '';
        }

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
            'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
        ));

        // Execute cURL request
        $response = curl_exec($ch);

        echo $response;
        // echo "<pre>"; print_r($response); echo "</pre>";
        // exit;
        // Check if the request was successful
        if ($response !== false) {
            $products = json_decode($response);
            echo "<pre>";
            print_r($products);
            echo "</pre>";
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
            'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
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
            'name' => 'siva tested a product',
            // Add more updated fields as needed
        );

        // Set cURL options
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
            ),
            CURLOPT_POSTFIELDS => json_encode($product_data),
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
                'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
            ),
            CURLOPT_POSTFIELDS => json_encode($product_data),
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

    public function test()
    {
        $vendor_details = $this->ecommerce->GetVendorDetails(4);
        $products = $this->ecommerce->GetThirdPartyProductsByIds($vendor_details);

    }

    public function categories()
    {
        $head['title'] = "E-Commerce Categories";
        $head['usernm'] = $this->aauth->get_user()->username;

        $data['vendors'] = $this->ecommerce->GetThirdPartyVendors();
        $data['categories'] = $this->ecommerce->GetSegmentsPublishing();

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/categories', $data);
        $this->load->view('fixed/footer');
    }

    public function sub_categories()
    {
        $head['title'] = "E-Commerce Sub Categories";
        $head['usernm'] = $this->aauth->get_user()->username;

        $data['vendors'] = $this->ecommerce->GetThirdPartyVendors();
        $data['categories'] = $this->ecommerce->GetSegmentsPublishing();
        $data['sub_categories'] = $this->ecommerce->GetSubSegmentsAndSegmentsList($category_id = '');

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/sub_categories', $data);
        $this->load->view('fixed/footer');
    }

    public function get_categories_table_list()
    {
        $post = $this->input->post();
        $vendor = $post['vendor'];
        $vendor_name = $post['vendor_name'];
        $html = '';
        if ($vendor_name == 'POS') {
            $segments = $this->ecommerce->GetSegmentsPublishing();
            //echo "<pre>"; print_r($sub_segments); echo "</pre>";
            if (!empty($segments)) {
                $c = 1;
                foreach ($segments as $segment) {
                    $html .= '<tr>';
                    $html .= '<td>' . $c . '</td>';
                    $html .= '<td>' . $segment['title'] . '</td>';
                    $html .= '<td><a href="' . base_url('productcategory/edit/?' . http_build_query(array('id' => $segment['id']))) . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                <a data-object-id="' . $segment['id'] . '" category_id="' . $segment['id'] . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-danger btn-xs delete-object"><i class="fa fa-trash"></i></a></td>';
                    $html .= '</tr>';
                    $c++;
                }
                echo $html;
            } else {
                $html = '<tr>No categories Found</tr>';
                echo $html;
            }
        } else {

            $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
            $segments = $this->ecommerce->GetThirdPartyCategories($vendor_details);
            if (!empty($segments)) {
                $c = 1;
                foreach ($segments as $segment) {
                    $html .= '<tr id="tv_cat_id_' . $segment['id'] . '">';
                    $html .= '<td>' . $c . '</td>';
                    $html .= '<td>' . $segment['name'] . '</td>';
                    if ($vendor_details[0]['PlatformType'] == 0) {
                        $html .= '<td><a href="' . base_url('ecommerce/category_edit/?' . http_build_query(array('vendor_id' => $vendor_details[0]['Id'], 'category_id' => $segment['id']))) . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                <a vendor_id="' . $vendor_details[0]['Id'] . '" category_id="' . $segment['id'] . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-danger btn-xs delete_category"><i class="fa fa-trash"></i></a></td>';
                        $html .= '</tr>';
                    } else {
                        $html .= '<td>Not Allowed</td>';
                        $html .= '</tr>';
                    }

                    $c++;
                }
                echo $html;
            } else {
                $html = '<tr>No categories Found</tr>';
                echo $html;
            }
        }

    }

    public function get_sub_categories_table_list()
    {
        $post = $this->input->post();
        //$segment_id = $post['category'];
        $vendor = $post['vendor'];
        $vendor_name = $post['vendor_name'];
        $category_id = $post['category_id'];
        $html = '';
        if ($vendor_name == 'POS') {
            $sub_segments = $this->ecommerce->GetSubSegmentsAndSegmentsList($category_id);
            //echo "<pre>"; print_r($sub_segments); echo "</pre>";
            if (!empty($sub_segments)) {
                $c = 1;
                foreach ($sub_segments as $sub_segment) {
                    $html .= '<tr>';
                    $html .= '<td>' . $c . '</td>';
                    $html .= '<td>' . $sub_segment['subcategory_name'] . '</td>';
                    // $html.='<td>'.$sub_segment['category_name'].'</td>';
                    $html .= '<td><a href="' . base_url('productcategory/edit/?' . http_build_query(array('id' => $sub_segment['subcategory_id']))) . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                <a data-object-id="' . $sub_segment['subcategory_id'] . '" vendor_id="' . $sub_segment['subcategory_id'] . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-danger btn-xs delete-object"><i class="fa fa-trash"></i></a></td>';
                    $html .= '</tr>';
                    $c++;
                }
                echo $html;
            } else {
                $html = '<tr>No sub categories Found</tr>';
                echo $html;
            }
        } else {
            $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
            // $sub_segments = $this->ecommerce->get_subcategories_with_parent($vendor_details);
            $sub_segments = $this->ecommerce->GetThirdPartySubCategories($vendor_details, $category_id);
            // echo "<pre>"; print_r($sub_segments); echo "</pre>";
            // exit;
            if (!empty($sub_segments)) {
                $c = 1;
                foreach ($sub_segments as $sub_segment) {
                    $html .= '<tr id="tv_sub_cat_id_' . $sub_segment['id'] . '">';
                    $html .= '<td>' . $c . '</td>';
                    $html .= '<td>' . $sub_segment['name'] . '</td>';
                    // $html.='<td>'.$sub_segment['category_name'].'</td>';

                    if ($vendor_details[0]['PlatformType'] == 0) {

                        $html .= '<td><a href="' . base_url('ecommerce/sub_category_edit/?' . http_build_query(array('vendor_id' => $vendor_details[0]['Id'], 'sub_category_id' => $sub_segment['id']))) . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                <a vendor_id="' . $vendor_details[0]['Id'] . '" subcategory_id="' . $sub_segment['id'] . '" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-danger btn-xs delete_subcategory"><i class="fa fa-trash"></i></a></td>';

                    } else {
                        $html .= '<td>Not Allowed</td>';
                        $html .= '</tr>';
                    }
                    $c++;
                }
                echo $html;
            } else {
                $html = '<tr>No sub categories Found</tr>';
                echo $html;
            }
        }

    }

    public function delete_category()
    {
        $post = $this->input->post();
        $vendor = $post['vendor_id'];
        $category_id = $post['category_id'];
        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
        $response = $this->ecommerce->delete_subcategory($vendor_details, $category_id);
        echo json_encode($response);

    }

    public function delete_subcategory()
    {
        $post = $this->input->post();
        $vendor = $post['vendor_id'];
        $sub_category_id = $post['subcategory_id'];
        $vendor_details = $this->ecommerce->GetVendorDetails($vendor);
        $response = $this->ecommerce->delete_subcategory($vendor_details, $sub_category_id);
        echo json_encode($response);

    }

    public function category_edit()
    {
        $vendor_id = $this->input->get('vendor_id');
        $category_id = $this->input->get('category_id');
        $head['title'] = 'Vendor Edit';
        $data['vendor_details'] = $this->ecommerce->GetVendorDetails($vendor_id);
        $data['category_details'] = $this->ecommerce->GetCategoryDetailsById($data['vendor_details'], $category_id);

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/category_edit', $data);
        $this->load->view('fixed/footer');

    }

    public function category_create()
    {
        $vendor_id = $this->input->get('vendor_id');
        $head['title'] = 'Category Create';
        $data['vendor_details'] = $this->ecommerce->GetVendorDetails($vendor_id);

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/category_create', $data);
        $this->load->view('fixed/footer');

    }

    public function category_save()
    {
        $post = $this->input->post();
        $vendor_id = $post['vendor_id'];
        $vendor_details = $this->ecommerce->GetVendorDetails($vendor_id);
        $response = $this->ecommerce->category_save($vendor_details, $post);
        echo json_encode($response);

    }

    public function sub_category_edit()
    {
        $vendor_id = $this->input->get('vendor_id');
        $sub_category_id = $this->input->get('sub_category_id');
        $head['title'] = 'SubCategory Edit';
        $data['vendor_details'] = $this->ecommerce->GetVendorDetails($vendor_id);
        $data['sub_category_details'] = $this->ecommerce->GetCategoryDetailsById($data['vendor_details'], $sub_category_id);
        $data['categories'] = $this->ecommerce->GetThirdPartyCategories($data['vendor_details']);

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/sub_category_edit', $data);
        $this->load->view('fixed/footer');

    }

    public function sub_category_create()
    {
        $vendor_id = $this->input->get('vendor_id');
        $head['title'] = 'Sub Category create';
        $data['vendor_details'] = $this->ecommerce->GetVendorDetails($vendor_id);
        $data['categories'] = $this->ecommerce->GetThirdPartyCategories($data['vendor_details']);

        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/sub_category_create', $data);
        $this->load->view('fixed/footer');

    }

    public function sub_category_save()
    {
        $post = $this->input->post();
        $vendor_id = $post['vendor_id'];
        $vendor_details = $this->ecommerce->GetVendorDetails($vendor_id);
        $response = $this->ecommerce->sub_category_save($vendor_details, $post);
        echo json_encode($response);

    }

    public function get_all_vendors()
    {

        $storeUrl = 'https://jstore.my';

        // API authentication credentials
        $consumerKey = 'ck_79d37b95daf80fbe440c43c7a1a6833ab57dc8de';
        $consumerSecret = 'cs_203ef96d9576c53f711895fb3a55978ee390ad1d';
        // Endpoint to retrieve all vendors

        // Endpoint to retrieve all vendors (this is a fictional example)
        $get_vendors_endpoint = $storeUrl . "/wp-json/vendor-api/v1/vendors";

        $curl = curl_init($get_vendors_endpoint);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);

        echo $response;
        exit;
        if (curl_errno($curl)) {
            echo "cURL Error: " . curl_error($curl);
            exit;
        }

        curl_close($curl);

        $vendors = json_decode($response, true);

        echo "<pre>";
        print_r($vendors);
        echo "</pre>";
        // if (!empty($vendors)) {
        //     // Output the list of vendors
        //     foreach ($vendors as $vendor) {
        //         echo "Vendor ID: {$vendor['id']}<br>";
        //         echo "Vendor Name: {$vendor['store_name']}<br>";
        //         // Display other vendor details as needed
        //         echo "<br>";
        //     }
        // } else {
        //     echo "No vendors found or API request failed.";
        // }

    }

    public function sales_report()
    {

        // $apiUrl = 'https://example.com/wp-json/wc/v3/reports/sales?date_min=2016-05-03&date_max=2016-05-04';
        // $consumerKey = 'consumer_key';
        // $consumerSecret = 'consumer_secret';
        $consumerKey = 'ck_79d37b95daf80fbe440c43c7a1a6833ab57dc8de';
        $consumerSecret = 'cs_203ef96d9576c53f711895fb3a55978ee390ad1d';

        $queryParams = array(
            'date_min' => '2016-05-03',
            'date_max' => date('Y-m-d'),
        );

        // Convert the query parameters to a URL-encoded string
        $queryString = http_build_query($queryParams);

        // Combine the base URL with the query string
        // $storeUrl = 'https://jstore.my';
        // $apiUrl = $storeUrl . "/wp-json/wc/v3/reports/sales";
        $apiUrl = 'https://jstore.my/wp-json/wc/v3/reports/sales';
        $apiUrl = $apiUrl . '?' . $queryString;
        // echo $apiUrl;
        // exit;

        //$storeUrl = 'https://jstore.my';

        $ch = curl_init($apiUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
            'Content-Type: application/json',
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'cURL Error: ' . curl_error($ch);
        }

        echo $response;
        exit;
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpStatus >= 200 && $httpStatus < 300) {
            // Successful response
            echo $response;
        } else {
            // Handle the failure case here
            echo 'Request failed with HTTP status code: ' . $httpStatus;
        }

    }
    public function vendor_poducts_list()
    {
        // WooCommerce API endpoint for listing products
        // $url = 'https://jstore.my/wp-json/wc/v3/products';

        // API authentication credentials
        $consumerKey = 'ck_79d37b95daf80fbe440c43c7a1a6833ab57dc8de';
        $consumerSecret = 'cs_203ef96d9576c53f711895fb3a55978ee390ad1d';

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $storeUrl = 'https://jstore.my'; // Replace with your store URL
        $vendorUserId = 81; // Replace with your vendor's user ID

        // Endpoint to retrieve products based on the vendor's user ID
        $get_products_endpoint = $storeUrl . "/wp-json/wc/v3/products?vendor={$vendorUserId}";

        $curl = curl_init($get_products_endpoint);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo "cURL Error: " . curl_error($curl);
            exit;
        }

        curl_close($curl);

        $products = json_decode($response, true);

        if (!empty($products)) {
            // Output the list of products
            foreach ($products as $product) {
                echo "Product ID: {$product['id']}<br>";
                echo "Product Name: {$product['name']}<br>";
                // Display other product details as needed
                echo "<br>";
            }
        } else {
            echo "No products found or API request failed.";
        }
    }

    public function getCategoryHierarchy($category_id = 579)
    {
        $categoryDetails = $this->fetchCategoryDetails($category_id);
        //echo "<pre>"; print_r($categoryDetails); echo "</pre>";
        $this->displayCategoryDetails($categoryDetails);
    }

    private function fetchCategoryDetails($category_id)
    {

        $consumerKey = 'ck_79d37b95daf80fbe440c43c7a1a6833ab57dc8de';
        $consumerSecret = 'cs_203ef96d9576c53f711895fb3a55978ee390ad1d';

        $storeUrl = 'https://jstore.my/';
        $category_endpoint = $storeUrl . "/wp-json/wc/v3/products?vendor={$category_id}";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $category_endpoint);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret),
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($curl);

        if (curl_errno($curl)) {
            echo "cURL Error: " . curl_error($curl);
            exit;
        }

        curl_close($curl);

        return json_decode($response, true);
    }

    private function displayCategoryDetails($categoryDetails, $depth = 0)
    {
        if (!empty($categoryDetails)) {
            if (isset($categoryDetails['name'])) {
                echo str_repeat('-', $depth * 2) . " {$categoryDetails['name']} (ID: {$categoryDetails['id']})<br>";
            }

            if (isset($categoryDetails['parent']) && $categoryDetails['parent'] > 0) {
                $parentCategoryDetails = $this->fetchCategoryDetails($categoryDetails['parent']);
                $this->displayCategoryDetails($parentCategoryDetails, $depth + 1);
            }
        }
    }
    public function pos_category_add()
    {
        $data['cat'] = $this->products_cat->category_list();
        $this->load->model('locations_model');
        $data['locations'] = $this->locations_model->locations_list2();
        $head['title'] = "Add Product Category";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/product-cat-add', $data);
        $this->load->view('fixed/footer');
    }

    public function pos_sub_category_add()
    {
        $data['cat'] = $this->products_cat->category_list();
        $this->load->model('locations_model');
        $data['locations'] = $this->locations_model->locations_list2();
        $head['title'] = "Add Product Sub Category";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/product-sub-cat-add', $data);
        $this->load->view('fixed/footer');
    }

    public function pos_category_edit()
    {
        $catid = $this->input->get('id');
        $this->db->select('*');
        $this->db->from('gtg_product_cat');
        $this->db->where('id', $catid);
        $query = $this->db->get();
        $data['productcat'] = $query->row_array();
        $data['cat'] = $this->products_cat->category_list();

        $head['title'] = "Edit Product Category";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('ecommerce/product-cat-edit', $data);
        $this->load->view('fixed/footer');
    }

}
