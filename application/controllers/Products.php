<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        // if (!$this->aauth->premission(2)) {

        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }
        $this->load->model('products_model', 'products');
        
        $this->load->model('categories_model');
        $this->load->library("Custom");
        $this->li_a = 'stock';
        $c_module = 'stock';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);
    }

    public function index()
    {
        $head['title'] = "Products";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/products');
        $this->load->view('fixed/footer');
    }

    public function expire_products_list()
    {
        $head['title'] = "Products";
        $data['cat'] = $this->categories_model->category_stock();        
        $data['product_codes'] = $this->products->get_product_codes();
        $data['products'] = $this->products->get_expire_products_list();
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/expire_products_list',$data);
        $this->load->view('fixed/footer');
    }

    public function get_expire_products_list(){

        $post = $this->input->post();
        $data['products'] = $this->products->get_expire_products_list($post);
        $resp_data['status'] = '200';
        $resp_data['html'] = $this->load->view('products/expiry_products_table',$data,TRUE);     
        echo json_encode($resp_data);
    }


    public function expiry_product_variations_list()
    {
        $head['title'] = "Expiry Products Variations";
        $data['cat'] = $this->categories_model->category_stock();        
        $data['product_codes'] = $this->products->get_product_codes();
        $data['products'] = $this->products->get_expire_products_variations_list();
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/expire_variations_products_list',$data);
        $this->load->view('fixed/footer');
    }

    public function get_expiry_product_variations_list(){

        $post = $this->input->post();
        $data['products'] = $this->products->get_expire_products_variations_list($post);
        $resp_data['status'] = '200';
        $resp_data['html'] = $this->load->view('products/expiry_variations_products_table',$data,TRUE);     
        echo json_encode($resp_data);
    }


    public function get_product_variant_details(){

        $post = $this->input->post();
        $id = $post['p_id'];
        //$id = 1;

        $product_details = $this->db->where('pid',$id)->get('gtg_products')->result_array();
        $products_list = $this->db->where('product_code',$product_details[0]['product_code'])->get('gtg_products')->result_array();
        $product_ids = array_column($products_list,'pid');

        $this->db->select('gp.product_code,gddi.do_expire_date as product_expiry_date,gp.pid,gddi.supplier_delivery_order_id, gddi.return_qty, gddi.qty as delivered_qty, gddi.type as do_type, gddi.parent_delivery_order_id, gddi.delivery_order_id, gdr.cr_date as do_created_date, gp.product_name, gp.product_code, gp.qty as total_qty, gp.product_price, gp.fproduct_price, gp.warehouse,gdr.type');
        $this->db->from('gtg_do_delivered_items gddi');
        $this->db->join('gtg_do_relations gdr', 'gddi.delivery_order_id = gdr.do_id');
        $this->db->join('gtg_products gp', 'gddi.p_id = gp.pid');
        $this->db->where_in('gdr.type', array('po', 'default_po'));
        // $this->db->where('gddi.invoice_id', 'invoice');
        $this->db->where_in('gp.pid', $product_ids);
        $query = $this->db->get();
        $result = $query->result_array();

        // echo $this->db->last_query();
        // exit;
        // echo "<pre>"; print_r($result); echo "</pre>";
        // exit;
        
        if(!empty($result))
        {
        //     $do_products = $result;
        //     $products = $result;
        //     $do_qty = 0;
        //    if(!empty($products)) {  foreach($products as $product){ 
        //     $do_qty += ((int)$product['delivered_qty'] - (int)$product['return_qty']);
        //     }
        //     }
            
        

            // $this->db->select('gp.expiry as product_expiry_date, "Default Item from Warehouse" as supplier_delivery_order_id,gp.qty as delivered_qty,"0" as return_qty, gp.cr_date as do_created_date, gp.product_name, gp.product_code');
            // $this->db->from('gtg_products gp'); // Add alias 'gp' for the table
            // $this->db->join('gtg_do_delivered_items gddi', 'gddi.p_id = gp.pid', 'left'); // Join with gtg_do_delivered_items
            // $this->db->where_in('gp.pid', $id);
            // $query = $this->db->get();
            // $result = $query->result_array();
            //$id = array('1'); // Assuming $id is an array of values

            // $this->db->select('gp.expiry as product_expiry_date, "Default Item from Warehouse" as supplier_delivery_order_id,gp.qty as delivered_qty,"0" as return_qty, gp.cr_date as do_created_date, gp.product_name, gp.product_code');
            // $this->db->from('gtg_products gp'); // Add alias 'gp' for the table
            // $this->db->where_in('gp.pid', $id);
            // $query = $this->db->get();
            // $result = $query->result_array();

            // if(!empty($result)){ foreach($result as $rslt){ 
            //     $nn_data['product_expiry_date'] = $rslt['product_expiry_date'];
            //     $nn_data['supplier_delivery_order_id'] = $rslt['supplier_delivery_order_id'];
            //     $nn_data['delivered_qty'] = $rslt['delivered_qty'] - $do_qty;
            //     $nn_data['return_qty'] = 0;
            //     $nn_data['do_created_date'] = $rslt['do_created_date'];
            //     $nn_data['product_name'] = $rslt['product_name'];
            //     $nn_data['product_code'] = $rslt['product_code'];
            //     $n_data[] = $nn_data;
            // }}

            // $f_result = $n_data;
            // $mergedArray = array_merge($f_result, $do_products);
            // $data['products'] = $mergedArray;
            $data['products'] = $result;
            
        }else{

            // $this->db->select('gp.expiry as product_expiry_date, "Default Item from Warehouse" as supplier_delivery_order_id,gp.qty as delivered_qty,"0" as return_qty, gp.cr_date as do_created_date, gp.product_name, gp.product_code');
            // $this->db->from('gtg_products gp'); // Add alias 'gp' for the table
            // $this->db->join('gtg_do_delivered_items gddi', 'gddi.p_id = gp.pid', 'left'); // Join with gtg_do_delivered_items
            // $this->db->where_in('gp.pid', $id);
            // $query = $this->db->get();
            // $result = $query->result_array();
            
            $data['products'] = array();

        }
        // echo "<pre>"; print_r($product_ids); echo "</pre>";
        // echo "<pre>"; print_r($result); echo "</pre>";
        // exit;
        

        $resp_data['status'] = '200';
        $resp_data['html'] = $this->load->view('products/expiry_product_details_table',$data,TRUE);     
        echo json_encode($resp_data);
    }


    
    public function get_product_batch_variant_details(){

        $post = $this->input->post();
        $id = $post['p_id'];
        //$id = 1;

        $product_details = $this->db->where('pid',$id)->get('gtg_products')->result_array();
        $products_list = $this->db->where('product_code',$product_details[0]['product_code'])->get('gtg_products')->result_array();
        $product_ids = array_column($products_list,'pid');

        // $this->db->select('gp.product_code,gddi.do_expire_date as product_expiry_date,gp.pid,gddi.supplier_delivery_order_id, gddi.return_qty, gddi.qty as delivered_qty, gddi.type as do_type, gddi.parent_delivery_order_id, gddi.delivery_order_id, gdr.cr_date as do_created_date, gp.product_name, gp.product_code, gp.qty as total_qty, gp.product_price, gp.fproduct_price, gp.warehouse,gdr.type');
        // $this->db->from('gtg_do_delivered_items gddi');
        // $this->db->join('gtg_do_relations gdr', 'gddi.delivery_order_id = gdr.do_id');
        // $this->db->join('gtg_products gp', 'gddi.p_id = gp.pid');
        // $this->db->where('gdr.type', 'po');
        // $this->db->where_in('gp.pid', $product_ids);
        // $query = $this->db->get();
        // $result = $query->result_array();

        // $this->db->select('gp.product_code, gddi.do_expire_date as product_expiry_date, gp.pid, gddi.supplier_delivery_order_id, gddi.return_qty, gddi.qty as delivered_qty, gddi.type as do_type, gddi.parent_delivery_order_id, gddi.delivery_order_id, gdr.cr_date as do_created_date, gp.product_name, gp.product_code, gp.qty as total_qty, gp.product_price, gp.fproduct_price, gp.warehouse, gdr.type, SUM(gdpbh.used_qty) AS total_used_qty');
        // $this->db->from('gtg_do_delivered_items gddi');
        // $this->db->join('gtg_do_relations gdr', 'gddi.delivery_order_id = gdr.do_id');
        // $this->db->join('gtg_products gp', 'gddi.p_id = gp.pid');
        // $this->db->join('gtg_do_product_batches_history gdpbh', 'gddi.delivery_order_id = gdpbh.delivery_order_id AND gddi.p_id = gdpbh.p_id', 'left'); // Include product_id in the join condition
        // $this->db->where('gdr.type', 'invoice');
        // $this->db->where_in('gp.pid', $product_ids);
        // $this->db->group_by('gddi.delivery_order_id');
        // $this->db->group_by('gddi.p_id'); // Group by product_id to get the sum of used_qty per product_id and delivery_order_id
        // $query = $this->db->get();
        // $result = $query->result_array();
        // $this->db->select('gp.product_code, gddi.do_expire_date as product_expiry_date, gp.pid, gddi.supplier_delivery_order_id, gddi.return_qty, gddi.qty as delivered_qty, gddi.type as do_type, gddi.parent_delivery_order_id, gddi.delivery_order_id, gdr.cr_date as do_created_date, gp.product_name, gp.qty as total_qty, gp.product_price, gp.fproduct_price, gp.warehouse, gdr.type, SUM(gdpbh.used_qty) AS total_used_qty');
        // $this->db->from('gtg_do_delivered_items gddi');
        // $this->db->join('gtg_do_relations gdr', 'gddi.delivery_order_id = gdr.do_id');
        // $this->db->join('gtg_products gp', 'gddi.p_id = gp.pid');
        // $this->db->join('gtg_do_product_batches_history gdpbh', 'gddi.delivery_order_id = gdpbh.delivery_order_id AND gddi.p_id = gdpbh.p_id', 'left');
        // $this->db->where('gdr.type', 'invoice');
        // $this->db->where_in('gp.pid', $product_ids);
        // $this->db->group_by('gddi.delivery_order_id, gddi.p_id');
        // $query = $this->db->get();
        // $result = $query->result_array();


        $this->db->select('
                    gp.product_code,
                    gddi.do_expire_date as product_expiry_date,
                    gp.pid,
                    gddi.supplier_delivery_order_id,
                    gddi.return_qty,
                    gddi.qty as delivered_qty,
                    gddi.type as do_type,
                    gddi.parent_delivery_order_id,
                    gddi.delivery_order_id,
                    gdr.cr_date as do_created_date,
                    gp.product_name,
                    gp.product_code,
                    gp.qty as total_qty,
                    gp.product_price,
                    gp.fproduct_price,
                    gp.warehouse,
                    gdr.type,
                    COALESCE(gdpbh.total_used_qty, 0) AS total_used_qty
                ');

                $this->db->from('gtg_do_delivered_items gddi');
                $this->db->join('gtg_do_relations gdr', 'gddi.delivery_order_id = gdr.do_id');
                $this->db->join('gtg_products gp', 'gddi.p_id = gp.pid');
                $this->db->join('(SELECT delivery_order_id, p_id, SUM(used_qty) AS total_used_qty FROM gtg_do_product_batches_history GROUP BY delivery_order_id, p_id) gdpbh', 'gddi.delivery_order_id = gdpbh.delivery_order_id AND gddi.p_id = gdpbh.p_id', 'left'); // Subquery to get the sum of used_qty
                $this->db->where_in('gdr.type', array('po', 'default_po'));
                $this->db->where_in('gp.pid', $product_ids);
                $this->db->group_by('gddi.delivery_order_id');
                $this->db->group_by('gddi.p_id');

                $query = $this->db->get();
                $result = $query->result_array();

        
        if(!empty($result))
        {
            $data['products'] = $result;
            
        }else{

            // $this->db->select('gp.expiry as product_expiry_date, "Default Item from Warehouse" as supplier_delivery_order_id,gp.qty as delivered_qty,"0" as return_qty, gp.cr_date as do_created_date, gp.product_name, gp.product_code');
            // $this->db->from('gtg_products gp'); // Add alias 'gp' for the table
            // $this->db->join('gtg_do_delivered_items gddi', 'gddi.p_id = gp.pid', 'left'); // Join with gtg_do_delivered_items
            // $this->db->where_in('gp.pid', $id);
            // $query = $this->db->get();
            // $result = $query->result_array();
            
            $data['products'] = array();

        }
        

        $resp_data['status'] = '200';
        $resp_data['html'] = $this->load->view('products/expiry_product_details_table_with_sales',$data,TRUE);     
        echo json_encode($resp_data);
    }


    
    
    public function detailed_stock_balance(){

        $id = $this->input->get('id');
        // $id = $post['p_id'];
        //$id = 1;
        $data['cat'] = $this->categories_model->category_stock();        
        $data['product_codes'] = $this->products->get_product_codes();
       
        if(!empty($id))
        {
            $product_details = $this->db->where('pid',$id)->get('gtg_products')->result_array();
            $products_list = $this->db->where('product_code',$product_details[0]['product_code'])->get('gtg_products')->result_array();
            $product_ids = array_column($products_list,'pid');
        }else{

            $products_list = $this->db->get('gtg_products')->result_array();
            $product_ids = array_column($products_list,'pid');
        }
        
        $this->db->select('
                    gp.product_code,
                    gddi.do_expire_date as product_expiry_date,
                    gp.pid,
                    gddi.supplier_delivery_order_id,
                    gddi.return_qty,
                    gddi.qty as delivered_qty,
                    gddi.type as do_type,
                    gddi.parent_delivery_order_id,
                    gddi.delivery_order_id,
                    gdr.cr_date as do_created_date,
                    gp.product_name,
                    gp.product_code,
                    gp.qty as total_qty,
                    gp.product_price,
                    gp.fproduct_price,
                    gp.warehouse,
                    gdr.type,
                    gdr.parent_do_id,
                    COALESCE(gdpbh.total_used_qty, 0) AS total_used_qty
                ');

                $this->db->from('gtg_do_delivered_items gddi');
                $this->db->join('gtg_do_relations gdr', 'gddi.delivery_order_id = gdr.do_id');
                $this->db->join('gtg_products gp', 'gddi.p_id = gp.pid');
                $this->db->join('(SELECT delivery_order_id, p_id, SUM(used_qty) AS total_used_qty FROM gtg_do_product_batches_history GROUP BY delivery_order_id, p_id) gdpbh', 'gddi.delivery_order_id = gdpbh.delivery_order_id AND gddi.p_id = gdpbh.p_id', 'left'); // Subquery to get the sum of used_qty
                $this->db->where_in('gdr.type', array('po', 'default_po'));
                $this->db->where_in('gp.pid', $product_ids);
                $this->db->group_by('gddi.delivery_order_id');
                $this->db->group_by('gddi.p_id');

                $query = $this->db->get();
                $result = $query->result_array();

        
        if(!empty($result))
        {
            $data['products'] = $result;
            
        }else{


            $data['products'] = array();

        }
        $head['title'] = "Product Categories";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/detailed_stock_balance',$data);  
        $this->load->view('fixed/footer');
    }


    public function get_detailed_stock_balance(){

        $post = $this->input->post();
        if(!empty($post))
        {
            $cat_id = $post['cat_id'];
            $start_date = $post['start_date'];
            $end_date = $post['end_date'];
            $product_code = $post['product_code'];
        }

        if(!empty($cat_id))
        {
            $this->db->where('pcat', $cat_id); // Replace $cat_id with the actual category ID
        }

        // Add conditions for start and end dates for expiry
       


        if (!empty($product_code)) {
            $this->db->where('product_code', $product_code);
        }


        //$product_details = $this->db->where('pid',$id)->get('gtg_products')->result_array();
        $products_list = $this->db->get('gtg_products')->result_array();
        $product_ids = array_column($products_list,'pid');
//          echo $this->db->last_query();
//         echo "<pre>"; print_r($products_list); echo "</pre>";
//         exit;
        if(!empty($product_ids))
        {
        $this->db->select('
                    gp.product_code,
                    gddi.do_expire_date as product_expiry_date,
                    gp.pid,
                    gddi.supplier_delivery_order_id,
                    gddi.return_qty,
                    gddi.qty as delivered_qty,
                    gddi.type as do_type,
                    gddi.parent_delivery_order_id,
                    gddi.delivery_order_id,
                    gdr.cr_date as do_created_date,
                    gp.product_name,
                    gp.product_code,
                    gp.qty as total_qty,
                    gp.product_price,
                    gp.fproduct_price,
                    gp.warehouse,
                    gdr.type,
                    COALESCE(gdpbh.total_used_qty, 0) AS total_used_qty
                ');

                $this->db->from('gtg_do_delivered_items gddi');
                $this->db->join('gtg_do_relations gdr', 'gddi.delivery_order_id = gdr.do_id');
                $this->db->join('gtg_products gp', 'gddi.p_id = gp.pid');
                $this->db->join('(SELECT delivery_order_id, p_id, SUM(used_qty) AS total_used_qty FROM gtg_do_product_batches_history GROUP BY delivery_order_id, p_id) gdpbh', 'gddi.delivery_order_id = gdpbh.delivery_order_id AND gddi.p_id = gdpbh.p_id', 'left'); // Subquery to get the sum of used_qty
                $this->db->where_in('gdr.type', array('po', 'default_po'));
                $this->db->where_in('gp.pid', $product_ids);
                $this->db->group_by('gddi.delivery_order_id');

                if (!empty($start_date)) {
                    $this->db->where('gddi.do_expire_date >=', $start_date);
                }
        
                if (!empty($end_date)) {
                    $this->db->where('gddi.do_expire_date <=', $end_date);
                }

                $this->db->group_by('gddi.p_id');

                $query = $this->db->get();
                $result = $query->result_array();

        
        if(!empty($result))
        {
            $data['products'] = $result;
            
        }else{


            $data['products'] = array();

        }
    }else{
        $data['products'] = array();
    }
        $resp_data['status'] = '200';
        $resp_data['html'] = $this->load->view('products/detailed_stock_balance_table',$data,TRUE);     
        echo json_encode($resp_data);

    }




    public function get_do_sale_invoices_details(){
        
        $post = $this->input->post();
        $do_id = $post['do_id'];
        $p_id = $post['p_id'];

        $this->db->select('gi.id AS invoice_id, gi.tid AS invoice_tid, gi.invoicedate, gc.name,dh.used_qty');
        $this->db->from('gtg_do_product_batches_history dh');
        $this->db->join('gtg_invoices gi', 'gi.id = dh.invoice_id', 'left');
        $this->db->join('gtg_customers gc', 'gi.csd=gc.id', 'left');
        $this->db->where('dh.delivery_order_id', $do_id); // Add WHERE condition
        $this->db->group_by('gi.id');

        $query = $this->db->get();
        $data['invoices'] = $query->result_array();

       
        $resp_data['status'] = '200';
        $resp_data['html'] = $this->load->view('products/get_batch_sale_invoices',$data,TRUE);     
        echo json_encode($resp_data);


    }
    
    public function get_single_product_variant_details(){

        $post = $this->input->post();
        $product_code = $post['p_id'];
        //$id = 1;

        // $product_details = $this->db->where('pid',$id)->get('gtg_products')->result_array();
        // $product_code = $product_details[0]['product_code'];
        if(!empty($post['expire_month']))
        {

            $expire_month =  $post['expire_month'];
        }else{
            $expire_month = '';
        }

        $this->db->select('gp.expiry as product_expiry_date,gp.product_name,gp.product_code,gp.cr_date,gddi.serial,  TIMESTAMPDIFF(MONTH, CURDATE(), gp.expiry) as months_left');
        $this->db->from('gtg_products gp');
        $this->db->join('gtg_product_serials gddi', 'gddi.product_id = gp.pid', 'left'); // Join with gtg_do_delivered_items
        //$this->db->where_in('gp.pid', $id);
        $this->db->where('gp.product_code', $product_code);

        if ($expire_month) {
            $expiry_date_condition = date('Y-m-d', strtotime('+' . $expire_month . ' months'));
            $this->db->where('gp.expiry <=', $expiry_date_condition);
        }

        //$this->db->group_by('gp.pid');
        $query = $this->db->get();
        $data['products'] = $query->result_array();
        $data['product_code'] = $product_code;

        // echo $this->db->last_query();
        // exit;
        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;
        
       
        $resp_data['status'] = '200';
        $resp_data['html'] = $this->load->view('products/get_single_product_variant_details',$data,TRUE);     
        echo json_encode($resp_data);
    }



    public function cat()
    {
        $head['title'] = "Product Categories";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/cat_productlist');
        $this->load->view('fixed/footer');
    }


    public function add()
    {
        $data['cat'] = $this->categories_model->category_list();
        $data['units'] = $this->products->units();
        $data['warehouse'] = $this->categories_model->warehouse_list();
        $data['custom_fields'] = $this->custom->add_fields(4);
        $this->load->model('units_model', 'units');
        $data['variables'] = $this->units->variables_list();
        $head['title'] = "Add Product";
        $head['usernm'] = $this->aauth->get_user()->username;

        $this->load->view('fixed/header', $head);
        $this->load->view('products/product-add', $data);
        $this->load->view('fixed/footer');
    }


    public function product_list()
    {
        $catid = $this->input->get('id');
        $sub = $this->input->get('sub');

        if ($catid > 0) {
            $list = $this->products->get_datatables($catid, '', $sub);
        } else {
            $list = $this->products->get_datatables();
        }
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $row[] = $no;
            $pid = $prd->pid;
            $row[] = '<a href="#" data-object-id="' . $pid . '" class="view-object"><span class="avatar-lg align-baseline"><img src="' . base_url() . 'userfiles/product/thumbnail/' . $prd->image . '" ></span>&nbsp;' . $prd->product_name . '</a>';
            $row[] = +$prd->qty;
            $row[] = $prd->product_code;
            $row[] = $prd->c_title;
            $row[] = $prd->title;
            $row[] = amountExchange($prd->product_price, 0, $this->aauth->get_user()->loc);
            $row[] = '<a href="#" data-object-id="' . $pid . '" class="btn btn-success  btn-sm  view-object"><span class="fa fa-eye"></span> ' . $this->lang->line('View') . '</a>
<div class="btn-group">
                                    <button type="button" class="btn btn-indigo dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i>  ' . $this->lang->line('Print') . '</button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="' . base_url() . 'products/barcode?id=' . $pid . '" target="_blank"> ' . $this->lang->line('BarCode') . '</a><div class="dropdown-divider"></div> <a class="dropdown-item" href="' . base_url() . 'products/posbarcode?id=' . $pid . '" target="_blank"> ' . $this->lang->line('BarCode') . ' - Compact</a> <div class="dropdown-divider"></div>
                                             <a class="dropdown-item" href="' . base_url() . 'products/label?id=' . $pid . '" target="_blank"> ' . $this->lang->line('Product') . ' Label</a><div class="dropdown-divider"></div>
                                         <a class="dropdown-item" href="' . base_url() . 'products/poslabel?id=' . $pid . '" target="_blank"> Label - Compact</a></div></div><a class="btn btn-pink  btn-sm" href="' . base_url() . 'products/report_product?id=' . $pid . '" target="_blank"> <span class="fa fa-pie-chart"></span> ' . $this->lang->line('Reports') . '</a> <div class="btn-group">
                                    <button type="button" class="btn btn btn-primary dropdown-toggle   btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-cog"></i>  </button>
                                    <div class="dropdown-menu">
&nbsp;<a href="' . base_url() . 'products/edit?id=' . $pid . '"  class="btn btn-purple btn-sm"><span class="fa fa-edit"></span>' . $this->lang->line('Edit') . '</a><div class="dropdown-divider"></div>&nbsp;<a href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm  delete-object"><span class="fa fa-trash"></span>' . $this->lang->line('Delete') . '</a>
                                    </div>
                                </div>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->products->count_all($catid, '', $sub),
            "recordsFiltered" => $this->products->count_filtered($catid, '', $sub),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function addproduct()
    {
        $product_name = $this->input->post('product_name', true);
        $catid = $this->input->post('product_cat');
        $warehouse = $this->input->post('product_warehouse');
        $product_code = $this->input->post('product_code');
        $product_price = numberClean($this->input->post('product_price'));
        $factoryprice = numberClean($this->input->post('fproduct_price'));
        $taxrate = numberClean($this->input->post('product_tax', true));
        $disrate = numberClean($this->input->post('product_disc', true));
        $product_qty = numberClean($this->input->post('product_qty', true));
        $product_qty_alert = numberClean($this->input->post('product_qty_alert'));
        $product_desc = $this->input->post('product_desc', true);
        $image = $this->input->post('image');
        $unit = $this->input->post('unit', true);
        $barcode = $this->input->post('barcode');
        $v_type = $this->input->post('v_type');
        $v_stock = $this->input->post('v_stock');
        $v_alert = $this->input->post('v_alert');
        $w_type = $this->input->post('w_type');
        $w_stock = $this->input->post('w_stock');
        $w_alert = $this->input->post('w_alert');
        $wdate = datefordatabase($this->input->post('wdate'));
        $code_type = $this->input->post('code_type');
        $sub_cat = $this->input->post('sub_cat');
        $brand = $this->input->post('brand');
        $serial = $this->input->post('product_serial');
        $delivery_order_number = $this->input->post('delivery_order_number', true);
        if ($catid) {
            $this->products->addnew($catid, $warehouse, $product_name, $product_code, $product_price, $factoryprice, $taxrate, $disrate, $product_qty, $product_qty_alert, $product_desc, $image, $unit, $barcode, $v_type, $v_stock, $v_alert, $wdate, $code_type, $w_type, $w_stock, $w_alert, $sub_cat, $brand, $serial,$delivery_order_number);
        }
    }

    public function delete_i()
    {
        if ($this->aauth->premission(157)) {
            $id = $this->input->post('deleteid');
            if ($id) {
                $this->db->delete('gtg_products', array('pid' => $id));
                $this->db->delete('gtg_products', array('sub' => $id, 'merge' => 1));
                $this->db->delete('gtg_movers', array('d_type' => 1, 'rid1' => $id));
                $this->db->set('merge', 0);
                $this->db->where('sub', $id);
                $this->db->update('gtg_products');
                echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('DELETED')));
            } else {
                echo json_encode(array('status' => 'Error', 'message' => $this->lang->line('ERROR')));
            }
        } else {
            echo json_encode(array('status' => 'Error', 'message' =>
            $this->lang->line('ERROR')));
        }
    }

    public function edit()
    {
        if (!$this->aauth->premission(159)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $pid = $this->input->get('id');
        $this->db->select('*');
        $this->db->from('gtg_products');
        $this->db->where('pid', $pid);
        $query = $this->db->get();
        $data['product'] = $query->row_array();
        if ($data['product']['merge'] > 0) {
            $this->db->select('*');
            $this->db->from('gtg_products');
            $this->db->where('merge', 1);
            $this->db->where('sub', $pid);
            $query = $this->db->get();
            $data['product_var'] = $query->result_array();
            $this->db->select('*');
            $this->db->from('gtg_products');
            $this->db->where('merge', 2);
            $this->db->where('sub', $pid);
            $query = $this->db->get();
            $data['product_ware'] = $query->result_array();
        }


        $data['units'] = $this->products->units();
        $data['serial_list'] = $this->products->serials($data['product']['pid']);
        $data['cat_ware'] = $this->categories_model->cat_ware($pid);
        $data['cat_sub'] = $this->categories_model->sub_cat_curr($data['product']['sub_id']);
        $data['cat_sub_list'] = $this->categories_model->sub_cat_list($data['product']['pcat']);
        $data['warehouse'] = $this->categories_model->warehouse_list();
        $data['cat'] = $this->categories_model->category_list();
        $data['custom_fields'] = $this->custom->view_edit_fields($pid, 4);
        $head['title'] = "Edit Product";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->model('units_model', 'units');
        $data['variables'] = $this->units->variables_list();
        $this->load->view('fixed/header', $head);
        $this->load->view('products/product-edit', $data);
        $this->load->view('fixed/footer');
    }

    public function editproduct()
    {
        if (!$this->aauth->premission(159)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $pid = $this->input->post('pid');
        $product_name = $this->input->post('product_name', true);
        $catid = $this->input->post('product_cat');
        $warehouse = $this->input->post('product_warehouse');
        $product_code = $this->input->post('product_code');
        $product_price = numberClean($this->input->post('product_price'));
        $factoryprice = numberClean($this->input->post('fproduct_price'));
        $taxrate = numberClean($this->input->post('product_tax'));
        $disrate = numberClean($this->input->post('product_disc'));
        $product_qty = numberClean($this->input->post('product_qty'));
        $product_qty_alert = numberClean($this->input->post('product_qty_alert'));
        $product_desc = $this->input->post('product_desc', true);
        $image = $this->input->post('image');
        $unit = $this->input->post('unit');
        $barcode = $this->input->post('barcode');
        $code_type = $this->input->post('code_type');
        $sub_cat = $this->input->post('sub_cat');
        if (!$sub_cat) $sub_cat = 0;
        $brand = $this->input->post('brand');
        
        $wdate = datefordatabase($this->input->post('wdate'));
        $vari = array();
        $vari['v_type'] = $this->input->post('v_type');
        $vari['v_stock'] = $this->input->post('v_stock');
        $vari['v_alert'] = $this->input->post('v_alert');
        $vari['w_type'] = $this->input->post('w_type');
        $vari['w_stock'] = $this->input->post('w_stock');
        $vari['w_alert'] = $this->input->post('w_alert');
        $serial = array();
        $serial['new'] = $this->input->post('product_serial');
        $serial['old'] = $this->input->post('product_serial_e');
        if ($pid) {
            $this->products->edit($pid, $catid, $warehouse, $product_name, $product_code, $product_price, $factoryprice, $taxrate, $disrate, $product_qty, $product_qty_alert, $product_desc, $image, $unit, $barcode, $code_type, $sub_cat, $brand, $vari, $serial,$wdate);
        }
    }


    public function warehouseproduct_list()
    {
        $catid = $this->input->get('id');
        $list = $this->products->get_datatables($catid, true);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $prd) {
            $no++;
            $row = array();
            $row[] = $no;
            $pid = $prd->pid;
            $row[] = $prd->product_name;
            $row[] = +$prd->qty;
            $row[] = $prd->product_code;
            $row[] = $prd->c_title;
            $row[] = amountExchange($prd->product_price, 0, $this->aauth->get_user()->loc);
            $row[] = '<a href="#" data-object-id="' . $pid . '" class="btn btn-success btn-sm  view-object"><span class="fa fa-eye"></span> ' . $this->lang->line('View') . '</a> <a href="' . base_url() . 'products/edit?id=' . $pid . '" class="btn btn-primary btn-sm"><span class="fa fa-pencil"></span> ' . $this->lang->line('Edit') . '</a> <a href="#" data-object-id="' . $pid . '" class="btn btn-danger btn-sm  delete-object"><span class="fa fa-trash"></span> ' . $this->lang->line('Delete') . '</a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->products->count_all($catid, true),
            "recordsFiltered" => $this->products->count_filtered($catid, true),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function prd_stats()
    {
        $this->products->prd_stats();
    }

    public function stock_transfer_products()
    {
        $wid = $this->input->get('wid');
        $customer = $this->input->post('product');
        $terms = @$customer['term'];
        $result = $this->products->products_list($wid, $terms);
        echo json_encode($result);
    }

    public function sub_cat()
    {
        $wid = $this->input->get('id');
        $string = $this->input->post('product');


        if (isset($string['term'])) $this->db->like('title', $string['term']);
        $this->db->from('gtg_product_cat');
        $this->db->where('rel_id', $wid);
        $this->db->where('c_type', 1);
        $query = $this->db->get();
        $result = $query->result_array();


        echo json_encode($result);
    }

    public function stock_transfer()
    {
        if ($this->input->post()) {
            $products_l = $this->input->post('products_l');
            $from_warehouse = $this->input->post('from_warehouse');
            $to_warehouse = $this->input->post('to_warehouse');
            $qty = $this->input->post('products_qty');
            $this->products->transfer($from_warehouse, $products_l, $to_warehouse, $qty);
        } else {
            $data['cat'] = $this->categories_model->category_list();
            $data['warehouse'] = $this->categories_model->warehouse_list();
            $head['title'] = "Stock Transfer";
            $head['usernm'] = $this->aauth->get_user()->username;
            $this->load->view('fixed/header', $head);
            $this->load->view('products/stock_transfer', $data);
            $this->load->view('fixed/footer');
        }
    }


    public function file_handling()
    {
        if ($this->input->get('op')) {
            $name = $this->input->get('name');
            if ($this->products->meta_delete($name)) {
                echo json_encode(array('status' => 'Success'));
            }
        } else {
            $id = $this->input->get('id');
            $this->load->library("Uploadhandler_generic", array(
                'accept_file_types' => '/\.(gif|jpe?g|png)$/i', 'upload_dir' => FCPATH . 'userfiles/product/', 'upload_url' => base_url() . 'userfile/product/'
            ));
        }
    }

    public function barcode()
    {
        $pid = $this->input->get('id');
        if ($pid) {
            $this->db->select('product_name,barcode,code_type');
            $this->db->from('gtg_products');
            //  $this->db->where('warehouse', $warehouse);
            $this->db->where('pid', $pid);
            $query = $this->db->get();
            $resultz = $query->row_array();
            $data['name'] = $resultz['product_name'];
            $data['code'] = $resultz['barcode'];
            $data['ctype'] = $resultz['code_type'];
            $html = $this->load->view('barcode/view', $data, true);
            ini_set('memory_limit', '64M');

            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($data['name'] . '_barcode.pdf', 'I');
        }
    }

    public function posbarcode()
    {
        $pid = $this->input->get('id');
        if ($pid) {
            $this->db->select('product_name,barcode,code_type');
            $this->db->from('gtg_products');
            //  $this->db->where('warehouse', $warehouse);
            $this->db->where('pid', $pid);
            $query = $this->db->get();
            $resultz = $query->row_array();
            $data['name'] = $resultz['product_name'];
            $data['code'] = $resultz['barcode'];
            $data['ctype'] = $resultz['code_type'];
            $html = $this->load->view('barcode/posbarcode', $data, true);
            ini_set('memory_limit', '64M');

            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load_thermal();
            $pdf->WriteHTML($html);
            $pdf->Output($data['name'] . '_barcode.pdf', 'I');
        }
    }

    public function view_over()
    {
        $pid = $this->input->post('id');
        $this->db->select('gtg_products.*,gtg_warehouse.title');
        $this->db->from('gtg_products');
        $this->db->where('gtg_products.pid', $pid);
        $this->db->join('gtg_warehouse', 'gtg_warehouse.id = gtg_products.warehouse');
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('gtg_warehouse.loc', $this->aauth->get_user()->loc);
            if (BDATA) $this->db->or_where('gtg_warehouse.loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('gtg_warehouse.loc', 0);
        }

        $query = $this->db->get();
        $data['product'] = $query->row_array();

        $this->db->select('gtg_products.*,gtg_warehouse.title');
        $this->db->from('gtg_products');
        $this->db->join('gtg_warehouse', 'gtg_warehouse.id = gtg_products.warehouse');
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('gtg_warehouse.loc', $this->aauth->get_user()->loc);
            if (BDATA) $this->db->or_where('gtg_warehouse.loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('gtg_warehouse.loc', 0);
        }
        $this->db->where('gtg_products.merge', 1);
        $this->db->where('gtg_products.sub', $pid);
        $query = $this->db->get();
        $data['product_variations'] = $query->result_array();

        $this->db->select('gtg_products.*,gtg_warehouse.title');
        $this->db->from('gtg_products');
        $this->db->join('gtg_warehouse', 'gtg_warehouse.id = gtg_products.warehouse');
        if ($this->aauth->get_user()->loc) {
            $this->db->group_start();
            $this->db->where('gtg_warehouse.loc', $this->aauth->get_user()->loc);
            if (BDATA) $this->db->or_where('gtg_warehouse.loc', 0);
            $this->db->group_end();
        } elseif (!BDATA) {
            $this->db->where('gtg_warehouse.loc', 0);
        }
        $this->db->where('gtg_products.sub', $pid);
        $this->db->where('gtg_products.merge', 2);
        $query = $this->db->get();
        $data['product_warehouse'] = $query->result_array();


        $this->load->view('products/view-over', $data);
    }


    public function label()
    {
        $pid = $this->input->get('id');
        if ($pid) {
            $this->db->select('product_name,product_price,product_code,barcode,expiry,code_type');
            $this->db->from('gtg_products');
            //  $this->db->where('warehouse', $warehouse);
            $this->db->where('pid', $pid);
            $query = $this->db->get();
            $resultz = $query->row_array();

            $html = $this->load->view('barcode/label', array('lab' => $resultz), true);
            ini_set('memory_limit', '64M');

            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($resultz['product_name'] . '_label.pdf', 'I');
        }
    }


    public function poslabel()
    {
        $pid = $this->input->get('id');
        if ($pid) {
            $this->db->select('product_name,product_price,product_code,barcode,expiry,code_type');
            $this->db->from('gtg_products');
            //  $this->db->where('warehouse', $warehouse);
            $this->db->where('pid', $pid);
            $query = $this->db->get();
            $resultz = $query->row_array();
            $html = $this->load->view('barcode/poslabel', array('lab' => $resultz), true);
            ini_set('memory_limit', '64M');
            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load_thermal();
            $pdf->WriteHTML($html);
            $pdf->Output($resultz['product_name'] . '_label.pdf', 'I');
        }
    }

    public function report_product()
    {
        $pid = intval($this->input->post('id'));

        $r_type = intval($this->input->post('r_type'));
        $s_date = datefordatabase($this->input->post('s_date'));
        $e_date = datefordatabase($this->input->post('e_date'));

        if ($pid && $r_type) {


            switch ($r_type) {
                case 1:
                    $query = $this->db->query("SELECT gtg_invoices.tid,gtg_invoice_items.qty,gtg_invoice_items.price,gtg_invoices.invoicedate FROM gtg_invoice_items LEFT JOIN gtg_invoices ON gtg_invoices.id=gtg_invoice_items.tid WHERE gtg_invoice_items.pid='$pid' AND gtg_invoices.status!='canceled' AND (DATE(gtg_invoices.invoicedate) BETWEEN DATE('$s_date') AND DATE('$e_date'))");
                    $result = $query->result_array();
                    break;

                case 2:
                    $query = $this->db->query("SELECT gtg_purchase.tid,gtg_purchase_items.qty,gtg_purchase_items.price,gtg_purchase.invoicedate FROM gtg_purchase_items LEFT JOIN gtg_purchase ON gtg_purchase.id=gtg_purchase_items.tid WHERE gtg_purchase_items.pid='$pid' AND gtg_purchase.status!='canceled' AND (DATE(gtg_purchase.invoicedate) BETWEEN DATE('$s_date') AND DATE('$e_date'))");
                    $result = $query->result_array();
                    break;

                case 3:
                    $query = $this->db->query("SELECT rid2 AS qty, DATE(d_time) AS  invoicedate,note FROM gtg_movers  WHERE gtg_movers.d_type='1' AND rid1='$pid'  AND (DATE(d_time) BETWEEN DATE('$s_date') AND DATE('$e_date'))");
                    $result = $query->result_array();
                    break;
            }

            $this->db->select('*');
            $this->db->from('gtg_products');
            $this->db->where('pid', $pid);
            $query = $this->db->get();
            $product = $query->row_array();

            $cat_ware = $this->categories_model->cat_ware($pid, $this->aauth->get_user()->loc);

            //if(!$cat_ware) exit();
            $html = $this->load->view('products/statementpdf-ltr', array('report' => $result, 'product' => $product, 'cat_ware' => $cat_ware, 'r_type' => $r_type), true);
            ini_set('memory_limit', '64M');

            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($pid . 'report.pdf', 'I');
        } else {
            $pid = intval($this->input->get('id'));
            $this->db->select('*');
            $this->db->from('gtg_products');
            $this->db->where('pid', $pid);
            $query = $this->db->get();
            $product = $query->row_array();
            $head['title'] = "Product Sales";
            $head['usernm'] = $this->aauth->get_user()->username;
            $this->load->view('fixed/header', $head);
            $this->load->view('products/statement', array('id' => $pid, 'product' => $product));
            $this->load->view('fixed/footer');
        }
    }

    public function custom_label()
    {
        if ($this->input->post()) {
            require APPPATH . 'third_party/barcode/autoload.php';
            $width = $this->input->post('width');
            $height = $this->input->post('height');
            $padding = $this->input->post('padding');
            $store_name = $this->input->post('store_name');
            $warehouse_name = $this->input->post('warehouse_name');
            $product_price = $this->input->post('product_price');
            $product_code = $this->input->post('product_code');
            $bar_height = $this->input->post('bar_height');
            $bar_width = $this->input->post('bar_width');
            $label_width = $this->input->post('label_width');
            $label_height = $this->input->post('label_height');
            $product_name = $this->input->post('product_name');
            $font_size = $this->input->post('font_size');
            $max_char = $this->input->post('max_char');
            $b_type = $this->input->post('b_type');
            $total_rows = $this->input->post('total_rows');
            $items_per_rows = $this->input->post('items_per_row');
            $products = array();
            if (!$this->input->post('products_l')) exit('No Product Selected!');
            foreach ($this->input->post('products_l') as $row) {
                $this->db->select('gtg_products.product_name,gtg_products.product_price,gtg_products.product_code,gtg_products.barcode,gtg_products.expiry,gtg_products.code_type,gtg_warehouse.title,gtg_warehouse.loc');
                $this->db->from('gtg_products');
                $this->db->join('gtg_warehouse', 'gtg_warehouse.id = gtg_products.warehouse', 'left');

                if ($this->aauth->get_user()->loc) {
                    $this->db->group_start();
                    $this->db->where('gtg_warehouse.loc', $this->aauth->get_user()->loc);

                    if (BDATA) $this->db->or_where('gtg_warehouse.loc', 0);
                    $this->db->group_end();
                } elseif (!BDATA) {
                    $this->db->where('gtg_warehouse.loc', 0);
                }

                //  $this->db->where('warehouse', $warehouse);
                $this->db->where('gtg_products.pid', $row);
                $query = $this->db->get();
                $resultz = $query->row_array();

                $products[] = $resultz;
            }


            $loc = location($resultz['loc']);


            $design = array('store' => $loc['cname'], 'warehouse' => $resultz['title'], 'width' => $width, 'height' => $height, 'padding' => $padding, 'store_name' => $store_name, 'warehouse_name' => $warehouse_name, 'product_price' => $product_price, 'product_code' => $product_code, 'bar_height' => $bar_height, 'total_rows' => $total_rows, 'items_per_row' => $items_per_rows, 'bar_width' => $bar_width, 'label_width' => $label_width, 'label_height' => $label_height, 'product_name' => $product_name, 'font_size' => $font_size, 'max_char' => $max_char, 'b_type' => $b_type);


            $this->load->view('barcode/custom_label', array('products' => $products, 'style' => $design));

            /*
                        $html = $this->load->view('barcode/custom_label', array('products' => $products, 'style' => $design), true);
                        ini_set('memory_limit', '64M');

                        //PDF Rendering
                        $this->load->library('pdf');
                        $pdf = $this->pdf->load_en();
                        $pdf->WriteHTML($html);
                        $pdf->Output($resultz['product_name'] . '_label.pdf', 'I');
            */
        } else {
            $data['cat'] = $this->categories_model->category_list();
            $data['warehouse'] = $this->categories_model->warehouse_list();
            $head['title'] = "Custom Label";
            $head['usernm'] = $this->aauth->get_user()->username;
            $this->load->view('fixed/header', $head);
            $this->load->view('products/custom_label', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function custom_label_old()
    {
        if ($this->input->post()) {
            $width = $this->input->post('width');
            $height = $this->input->post('height');
            $padding = $this->input->post('padding');
            $store_name = $this->input->post('store_name');
            $warehouse_name = $this->input->post('warehouse_name');
            $product_price = $this->input->post('product_price');
            $product_code = $this->input->post('product_code');
            $bar_height = $this->input->post('bar_height');
            $total_rows = $this->input->post('total_rows');
            $items_per_rows = $this->input->post('items_per_row');
            $products = array();


            foreach ($this->input->post('products_l') as $row) {
                $this->db->select('gtg_products.product_name,gtg_products.product_price,gtg_products.product_code,gtg_products.barcode,gtg_products.expiry,gtg_products.code_type,gtg_warehouse.title,gtg_warehouse.loc');
                $this->db->from('gtg_products');
                $this->db->join('gtg_warehouse', 'gtg_warehouse.id = gtg_products.warehouse', 'left');

                if ($this->aauth->get_user()->loc) {
                    $this->db->group_start();
                    $this->db->where('gtg_warehouse.loc', $this->aauth->get_user()->loc);

                    if (BDATA) $this->db->or_where('gtg_warehouse.loc', 0);
                    $this->db->group_end();
                } elseif (!BDATA) {
                    $this->db->where('gtg_warehouse.loc', 0);
                }

                //  $this->db->where('warehouse', $warehouse);
                $this->db->where('gtg_products.pid', $row);
                $query = $this->db->get();
                $resultz = $query->row_array();

                $products[] = $resultz;
            }


            $loc = location($resultz['loc']);

            $design = array('store' => $loc['cname'], 'warehouse' => $resultz['title'], 'width' => $width, 'height' => $height, 'padding' => $padding, 'store_name' => $store_name, 'warehouse_name' => $warehouse_name, 'product_price' => $product_price, 'product_code' => $product_code, 'bar_height' => $bar_height, 'total_rows' => $total_rows, 'items_per_row' => $items_per_rows);


            $html = $this->load->view('barcode/custom_label', array('products' => $products, 'style' => $design), true);
            ini_set('memory_limit', '64M');

            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load_en();
            $pdf->WriteHTML($html);
            $pdf->Output($resultz['product_name'] . '_label.pdf', 'I');
        } else {
            $data['cat'] = $this->categories_model->category_list();
            $data['warehouse'] = $this->categories_model->warehouse_list();
            $head['title'] = "Custom Label";
            $head['usernm'] = $this->aauth->get_user()->username;
            $this->load->view('fixed/header', $head);
            $this->load->view('products/custom_label', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function standard_label()
    {
        if ($this->input->post()) {
            $width = $this->input->post('width');
            $height = $this->input->post('height');
            $padding = $this->input->post('padding');
            $store_name = $this->input->post('store_name');
            $warehouse_name = $this->input->post('warehouse_name');
            $product_price = $this->input->post('product_price');
            $product_code = $this->input->post('product_code');
            $bar_height = $this->input->post('bar_height');
            $total_rows = $this->input->post('total_rows');
            $items_per_rows = $this->input->post('items_per_row');
            $standard_label = $this->input->post('standard_label');
            $products = array();


            foreach ($this->input->post('products_l') as $row) {
                $this->db->select('gtg_products.product_name,gtg_products.product_price,gtg_products.product_code,gtg_products.barcode,gtg_products.expiry,gtg_products.code_type,gtg_warehouse.title,gtg_warehouse.loc');
                $this->db->from('gtg_products');
                $this->db->join('gtg_warehouse', 'gtg_warehouse.id = gtg_products.warehouse', 'left');

                if ($this->aauth->get_user()->loc) {
                    $this->db->group_start();
                    $this->db->where('gtg_warehouse.loc', $this->aauth->get_user()->loc);

                    if (BDATA) $this->db->or_where('gtg_warehouse.loc', 0);
                    $this->db->group_end();
                } elseif (!BDATA) {
                    $this->db->where('gtg_warehouse.loc', 0);
                }

                //  $this->db->where('warehouse', $warehouse);
                $this->db->where('gtg_products.pid', $row);
                $query = $this->db->get();
                $resultz = $query->row_array();

                $products[] = $resultz;
            }


            $loc = location($resultz['loc']);

            $design = array('store' => $loc['cname'], 'warehouse' => $resultz['title'], 'width' => $width, 'height' => $height, 'padding' => $padding, 'store_name' => $store_name, 'warehouse_name' => $warehouse_name, 'product_price' => $product_price, 'product_code' => $product_code, 'bar_height' => $bar_height, 'total_rows' => $total_rows, 'items_per_row' => $items_per_rows);

            switch ($standard_label) {
                case 'eu30019':
                    $html = $this->load->view('standard_label/eu30019', array('products' => $products, 'style' => $design), true);
                    break;
            }


            ini_set('memory_limit', '64M');

            //PDF Rendering
            $this->load->library('pdf');
            $pdf = $this->pdf->load_en();
            $pdf->WriteHTML($html);
            $pdf->Output($resultz['product_name'] . '_label.pdf', 'I');
        } else {
            $data['cat'] = $this->categories_model->category_list();
            $data['warehouse'] = $this->categories_model->warehouse_list();
            $head['title'] = "Stock Transfer";
            $head['usernm'] = $this->aauth->get_user()->username;
            $this->load->view('fixed/header', $head);
            $this->load->view('products/standard_label', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function detailed_product_expiry_list(){

        // $data['cat'] = $this->categories_model->category_stock();        
        // $data['product_codes'] = $this->products->get_product_codes();
    
        // $this->db->select('gp.expiry as product_expiry_date,gp.product_name,gp.product_code,gp.cr_date,c.title,  TIMESTAMPDIFF(MONTH, CURDATE(), gp.expiry) as months_left');
        // $this->db->from('gtg_products gp');
        // $this->db->join('gtg_product_cat c', 'gp.pcat = c.id', 'left');
        // $query = $this->db->get();
        // $data['products'] = $query->result_array();
        // $head['title'] = "Product Categories";
        // $head['usernm'] = $this->aauth->get_user()->username;
        // $this->load->view('fixed/header', $head);
        // $this->load->view('products/detailed_product_expiry_list',$data);  
        // $this->load->view('fixed/footer');

    
        $data['cat'] = $this->categories_model->category_stock();        
        $data['product_codes'] = $this->products->get_product_codes();

        $products_list = $this->db->get('gtg_products')->result_array();
        $product_ids = array_column($products_list,'pid');

        if(!empty($products_list))
        {

        //$product_details = $this->db->where('pid',$id)->get('gtg_products')->result_array();
        
//   
        $this->db->select('
                    gp.product_code,
                    gddi.do_expire_date as product_expiry_date,
                    gp.pid,
                    gddi.supplier_delivery_order_id,
                    gddi.return_qty,
                    gddi.qty as delivered_qty,
                    gddi.type as do_type,
                    gddi.parent_delivery_order_id,
                    gddi.delivery_order_id,
                    gddi.do_expire_date,
                    gdr.cr_date as do_created_date,
                    gp.product_name,
                    gp.product_code,
                    gp.qty as total_qty,
                    gp.product_price,
                    gp.fproduct_price,
                    gp.warehouse,
                    gdr.type,
                    gdr.parent_do_id,
                    c.title,
                    COALESCE(gdpbh.total_used_qty, 0) AS total_used_qty
                ');

                $this->db->from('gtg_do_delivered_items gddi');
                $this->db->join('gtg_do_relations gdr', 'gddi.delivery_order_id = gdr.do_id');
                $this->db->join('gtg_products gp', 'gddi.p_id = gp.pid');
                $this->db->join('gtg_product_cat c', 'gp.pcat = c.id', 'left');
                $this->db->join('(SELECT delivery_order_id, p_id, SUM(used_qty) AS total_used_qty FROM gtg_do_product_batches_history GROUP BY delivery_order_id, p_id) gdpbh', 'gddi.delivery_order_id = gdpbh.delivery_order_id AND gddi.p_id = gdpbh.p_id', 'left'); // Subquery to get the sum of used_qty
                $this->db->where_in('gdr.type', array('po', 'default_po'));
                $this->db->where_in('gp.pid', $product_ids);
              
              

                $this->db->group_by('gddi.delivery_order_id');
                $this->db->group_by('gddi.p_id');

                $query = $this->db->get();
                $result = $query->result_array();

        
                if(!empty($result))
                {
                    $data['products'] = $result;
                    
                }else{


                    $data['products'] = array();

                }
            }else{
                $data['products'] = array();

            }
        $head['title'] = "Product Categories";
        $head['usernm'] = $this->aauth->get_user()->username;
        $this->load->view('fixed/header', $head);
        $this->load->view('products/detailed_product_expiry_list',$data);  
        $this->load->view('fixed/footer');
    }
 
 
    public function get_detailed_product_expiry_list(){

        
        //$id = $this->input->get('id');
        // $id = $post['p_id'];
        //$id = 1;
        // $data['cat'] = $this->categories_model->category_stock();        
        // $data['product_codes'] = $this->products->get_product_codes();
    

        $data['cat'] = $this->categories_model->category_stock();        
        $data['product_codes'] = $this->products->get_product_codes();
       
        $post = $this->input->post();
        if(!empty($post))
        {
            $cat_id = $post['cat_id'];
            $start_date = $post['start_date'];
            $end_date = $post['end_date'];
            $product_code = $post['product_code'];
        }

        if(!empty($cat_id))
        {
            $this->db->where('pcat', $cat_id); // Replace $cat_id with the actual category ID
        }

        // Add conditions for start and end dates for expiry
       


        if (!empty($product_code)) {
            $this->db->where('product_code', $product_code);
        }

        $products_list = $this->db->get('gtg_products')->result_array();
        $product_ids = array_column($products_list,'pid');

        
        if(!empty($products_list))
        {
               
        
        $this->db->select('
                    gp.product_code,
                    gddi.do_expire_date as product_expiry_date,
                    gp.pid,
                    gddi.supplier_delivery_order_id,
                    gddi.return_qty,
                    gddi.qty as delivered_qty,
                    gddi.type as do_type,
                    gddi.parent_delivery_order_id,
                    gddi.delivery_order_id,
                    gddi.do_expire_date,
                    gdr.cr_date as do_created_date,
                    gp.product_name,
                    gp.product_code,
                    gp.qty as total_qty,
                    gp.product_price,
                    gp.fproduct_price,
                    gp.warehouse,
                    gdr.type,
                    gdr.parent_do_id,
                    c.title,
                    COALESCE(gdpbh.total_used_qty, 0) AS total_used_qty
                ');

                $this->db->from('gtg_do_delivered_items gddi');
                $this->db->join('gtg_do_relations gdr', 'gddi.delivery_order_id = gdr.do_id');
                $this->db->join('gtg_products gp', 'gddi.p_id = gp.pid');
                $this->db->join('gtg_product_cat c', 'gp.pcat = c.id', 'left');
                $this->db->join('(SELECT delivery_order_id, p_id, SUM(used_qty) AS total_used_qty FROM gtg_do_product_batches_history GROUP BY delivery_order_id, p_id) gdpbh', 'gddi.delivery_order_id = gdpbh.delivery_order_id AND gddi.p_id = gdpbh.p_id', 'left'); // Subquery to get the sum of used_qty
                $this->db->where_in('gdr.type', array('po', 'default_po'));
                $this->db->where_in('gp.pid', $product_ids);

                if (!empty($start_date)) {
                    $this->db->where('gddi.do_expire_date >=', $start_date);
                }
        
                if (!empty($end_date)) {
                    $this->db->where('gddi.do_expire_date <=', $end_date);
                }

                $this->db->group_by('gddi.delivery_order_id');
                $this->db->group_by('gddi.p_id');

                $query = $this->db->get();
                $result = $query->result_array();

        
                if(!empty($result))
                {
                    $data['products'] = $result;
                    
                }else{


                    $data['products'] = array();

                }
            }else{
                $data['products'] = array();

            }
            
        $resp_data['status'] = '200';
        $resp_data['html'] = $this->load->view('products/detailed_product_expiry_list_table',$data,TRUE);     
        echo json_encode($resp_data);

    }
       
}