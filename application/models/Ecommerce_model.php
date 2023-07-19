<?php



defined('BASEPATH') or exit('No direct script access allowed');

class Ecommerce_model extends CI_Model
{
    var $table = 'gtg_invoices';
    var $column_order = array(null, 'gtg_invoices.tid', 'gtg_customers.name', 'gtg_invoices.invoicedate', 'gtg_invoices.total', 'gtg_invoices.status', null);
    var $column_search = array('gtg_invoices.tid', 'gtg_customers.name', 'gtg_invoices.invoicedate', 'gtg_invoices.total', 'gtg_invoices.status');
    var $order = array('gtg_invoices.tid' => 'desc');

    public function __construct()
    {
        parent::__construct();
    }


    public function getInvoiceCountByType($invoice_type)
    {
        //$where = "DATE(invoicedate) ='$today'";
        //$this->db->where($where);
        $this->db->from('gtg_invoices');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }

        $this->db->where('invoice_type', $invoice_type);

        return $this->db->count_all_results();
    }


    public function getInvoiceProductsCountByType($invoice_type)
    {
        //$where = "DATE(invoicedate) ='$today'";
        $this->db->select_sum('items');
        $this->db->from('gtg_invoices');
        if ($this->aauth->get_user()->loc) {
            $this->db->where('loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('loc', 0);
        }

        $this->db->where('invoice_type', $invoice_type);

        return $this->db->get()->result_array();
    }


    


    private function _get_sales_invoices_datatables_query($opt = '')
    {
        $this->db->select('gtg_invoices.id,gtg_invoices.tid,gtg_invoices.invoicedate,gtg_invoices.invoiceduedate,gtg_invoices.total,gtg_invoices.csd,gtg_invoices.status,gtg_customers.name,gtg_invoices.pamnt,gtg_invoices.invoicedate,,gtg_invoices.invoice_type');
        $this->db->from('gtg_invoices');
        $this->db->join('gtg_customers', 'gtg_invoices.csd=gtg_customers.id', 'left');

        // $this->db->where('gtg_invoices.i_class', 0);
        // if ($opt) {
        //     $this->db->where('gtg_invoices.eid', $opt);
        // }

    //         $query = $this->db->query("SELECT i.id,i.tid,i.invoicedate,i.total,i.status,i.i_class,c.name,c.picture,i.csd
    // FROM gtg_invoices AS i LEFT JOIN gtg_customers AS c ON i.csd=c.id $whr ORDER BY i.id DESC LIMIT 10");
    //         return $query->result_array();

        if ($this->aauth->get_user()->loc) {
            $this->db->where('gtg_invoices.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('gtg_invoices.loc', 0);
        }
        if ($this->input->post('start_date') && $this->input->post('end_date')) // if datatable send POST for search
        {
            $this->db->where('DATE(gtg_invoices.invoicedate) >=', datefordatabase($this->input->post('start_date')));
            $this->db->where('DATE(gtg_invoices.invoicedate) <=', datefordatabase($this->input->post('end_date')));
        }
        $sale_type = $this->input->post('sale_type');
        if (isset($sale_type)) // if datatable send POST for search
        {
            $this->db->where('gtg_invoices.invoice_type',$this->input->post('sale_type'));
        }
       
        
        $i = 0;

        foreach ($this->column_search as $item) // loop column
        {
            if ($this->input->post('search')['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_sales_invoices_datatables($opt = '')
    {
        $this->_get_sales_invoices_datatables_query($opt);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        $this->db->where('gtg_invoices.i_class', 0);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('gtg_invoices.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('gtg_invoices.loc', 0);
        }

        return $query->result();
    }



    function get_sales_invoices_products_datatables($opt = '')
    {
        $this->_get_sales_invoices_products_datatables_query($opt);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        $this->db->where('gtg_invoices.i_class', 0);
        if ($this->aauth->get_user()->loc) {
            $this->db->where('gtg_invoices.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('gtg_invoices.loc', 0);
        }

        return $query->result();
    }


    private function _get_sales_invoices_products_datatables_query($opt = '')
    {
        $this->db->select('gtg_invoice_items.pid,gtg_invoice_items.product,gtg_invoice_items.qty,gtg_invoice_items.price,gtg_invoices.id,gtg_invoices.tid,gtg_invoices.invoicedate,gtg_invoices.invoiceduedate,gtg_invoices.total,gtg_invoices.csd,gtg_invoices.status,gtg_customers.name,gtg_invoices.pamnt,gtg_invoices.invoicedate,,gtg_invoices.invoice_type');
        $this->db->from('gtg_invoices');
        $this->db->join('gtg_customers', 'gtg_invoices.csd=gtg_customers.id', 'left');
        $this->db->join('gtg_invoice_items', 'gtg_invoices.id=gtg_invoice_items.tid', 'left');

        // $this->db->where('gtg_invoices.i_class', 0);
        // if ($opt) {
        //     $this->db->where('gtg_invoices.eid', $opt);
        // }

    //         $query = $this->db->query("SELECT i.id,i.tid,i.invoicedate,i.total,i.status,i.i_class,c.name,c.picture,i.csd
    // FROM gtg_invoices AS i LEFT JOIN gtg_customers AS c ON i.csd=c.id $whr ORDER BY i.id DESC LIMIT 10");
    //         return $query->result_array();

        if ($this->aauth->get_user()->loc) {
            $this->db->where('gtg_invoices.loc', $this->aauth->get_user()->loc);
        } elseif (!BDATA) {
            $this->db->where('gtg_invoices.loc', 0);
        }
        if ($this->input->post('start_date') && $this->input->post('end_date')) // if datatable send POST for search
        {
            $this->db->where('DATE(gtg_invoices.invoicedate) >=', datefordatabase($this->input->post('start_date')));
            $this->db->where('DATE(gtg_invoices.invoicedate) <=', datefordatabase($this->input->post('end_date')));
        }
        $sale_type = $this->input->post('sale_type');
        if (isset($sale_type)) // if datatable send POST for search
        {
            $this->db->where('gtg_invoices.invoice_type',$this->input->post('sale_type'));
        }
       
        
        $i = 0;

        foreach ($this->column_search as $item) // loop column
        {
            if ($this->input->post('search')['value']) // if datatable send POST for search
            {

                if ($i === 0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $this->input->post('search')['value']);
                } else {
                    $this->db->or_like($item, $this->input->post('search')['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    // Get segments
    public function GetThirdPartyVendors(){
        $sql = "SELECT * FROM merchant_thirdparty_vendors order by Id ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }
    

    public function GetThirdPartyVendorsPrices(){
        $sql = "SELECT mv.*,mtv.ItemId,mtv.Price,mtv.Id,mi.pid as miId FROM merchant_thirdparty_vendors mv LEFT JOIN merchant_items_thirdparty_pricing mtv ON mtv.ThirdPartyVenderId=mv.Id LEFT JOIN gtg_products mi ON mi.pid=mtv.ItemId;";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    // Get segments
    public function GetSegmentsPublishing(){
        //$sql = "SELECT Id,Name,MerchantId,Status FROM segments WHERE MerchantId={$MerchantId}";
        $sql = "SELECT * FROM gtg_product_cat where c_type='0' order by title ASC";
        $query = $this->db->query($sql);
        return $query->result_array();
    }


    public function GetSubSegmentsPublishing($SegmentId){

        // $segment_query= $this->db->table('gtg_product_cat')->select('id,title')->where('id', $SegmentId)->get()->getRowArray();
        
        $sql = "SELECT * FROM gtg_product_cat WHERE id={$SegmentId}";
        $query = $this->db->query($sql);
        $segments_details = $query->result_array();
        

        $segment_name=$segments_details[0]['title'];

        $sql = "SELECT id,rel_id,title FROM gtg_product_cat WHERE rel_id={$SegmentId}";
        $query = $this->db->query($sql);
        $sub_segments_details = $query->result_array();
        
        $LocationId ='';

        $item_details = [];
        if( !empty( $sub_segments_details ) ){
        $SubSegmentId=$sub_segments_details[0]['id'];
        //$sql_sub = "SELECT mi.pid,mi.product_name,mi.product_price,mtv.Id as ThirdVendorId,mtv.Price as ThirdVendorPrice,GROUP_CONCAT(mtv.ThirdPartyVenderId,',',mtv.Price,'##' ORDER BY mtv.ThirdPartyVenderId ASC) as PricesVendors FROM gtg_products mi LEFT JOIN merchant_items_thirdparty_pricing mtv ON mtv.ItemId=mi.pid LEFT JOIN merchant_thirdparty_vendors as mt ON mtv.ThirdPartyVenderId = mt.Id WHERE mi.pcat ={$SegmentId} and mi.sub_id ={$SubSegmentId} group by mtv.ItemId"; 
        $sql_sub = "SELECT mi.pid,mi.product_name,mi.product_price,mtv.Id as ThirdVendorId,mtv.Price as ThirdVendorPrice,GROUP_CONCAT(mtv.Id,',',mtv.ItemStatus,',',mtv.Price,'##' ORDER BY mtv.ThirdPartyVenderId ASC) as PricesVendors FROM gtg_products mi LEFT JOIN merchant_items_thirdparty_pricing mtv ON mtv.ItemId=mi.pid LEFT JOIN merchant_thirdparty_vendors as mt ON mtv.ThirdPartyVenderId = mt.Id WHERE mi.pcat ={$SegmentId} and mi.sub_id ={$SubSegmentId} group by mtv.ItemId"; 
 
    
        $query_sub = $this->db->query($sql_sub);
        $item_details =$query_sub->result_array();
        }
        return array("segment_name"=>$segment_name,"sub_segments_details"=>$sub_segments_details,"item_details"=>$item_details,"thirdparty_vendors"=>$this->GetThirdPartyVendors()); 
    }

    public function GetPublishingSubSegmentsItems($SegmentId,$SubSegmentId,$MerchantId){
        $LocationId ='';
       // $sql = "SELECT Id,Name,Price FROM merchant_items WHERE MerchantId={$MerchantId} and Segment ={$SegmentId} and SubSegment ={$SubSegmentId}"; 
        $sql = "SELECT mi.pid,mi.product_name,mi.product_price,mtv.Id as ThirdVendorId,mtv.Price as ThirdVendorPrice,GROUP_CONCAT(mtv.Id,',',mtv.ItemStatus,',',mtv.Price,'##' ORDER BY mtv.ThirdPartyVenderId ASC) as PricesVendors FROM gtg_products mi LEFT JOIN merchant_items_thirdparty_pricing mtv ON mtv.ItemId=mi.pid LEFT JOIN merchant_thirdparty_vendors as mt ON mtv.ThirdPartyVenderId = mt.Id WHERE mi.pcat ={$SegmentId} and mi.sub_id ={$SubSegmentId} group by mtv.ItemId"; 

        // if($LocationId!='') {
        //    $sql.= " and LocationId={$LocationId}";
        // }
        // echo $sql;
        // exit;
        $query = $this->db->query($sql);
        $item_details =$query->result_array();
        // echo "<pre>"; print_r($item_details); echo "</pre>"; 
        // exit;
        return array("item_details"=>$item_details,"thirdparty_vendors"=>$this->GetThirdPartyVendors()); 
    }

    public function UpdateThirdPartyVendorsStatus($post)
    {
        $MerchantId = $post['MerchantId'];
        $CityId = $post['CityId'];
        $LocationId = $post['LocationId'];
        $SegmentId = $post['SegmentId'];
        $SubSegmentId = $post['SubSegmentId'];
        $publishingSessionId = $this->session->userdata('publishingSessionId'); // Use userdata() to access session data in CI3
    
        $fetchId = !empty($post['fetchId']) ? $post['fetchId'] : false;
    
        $Status = $post['status'];
        $SubSegmentId = $post['fetchId'];
        $ThirdPartyVenderId = $post['fetchId2'];
    
        try {
            $query = "UPDATE `merchant_items_thirdparty_pricing` SET `ItemStatus` = $Status WHERE `ThirdPartyVenderId` = $ThirdPartyVenderId AND `SubSegmentId` = $SubSegmentId";
    
            $TStatus = $Status;
            $Previous_Status = $TStatus == 1 ? 0 : 1;
            $data3 = array(
                "SessionId" => $publishingSessionId,
                "ThirdPartyVenderId" => $fetchId,
                "MerchantId" => $post['MerchantId'],
                "CityId" => $post['CityId'],
                "LocationId" => $post['LocationId'],
                "SegmentId" => $post['SegmentId'],
                "SubSegmentId" => $post['SubSegmentId'],
                "ActionType" => 'UpdateSubsegmentsStatus',
                "Action" => 'Update New ' . $Status,
                "PreviousValue" => $Previous_Status,
                "NewValue" => $Status,
                "Query" => $query,
                "CrDate" => date('Y-m-d h:i:s', time()),
            );
            $this->db->insert('publishing_activity', $data3);
    
            return array("Status" => false, "Message" => "Status Changed Successfully");
        } catch (Exception $ex) {
            return array("Status" => false, "Message" => "Unable Update Status");
        }
    }
    
    
    public function UpdateThirdPartyVendorsStatusSegments( $post ){
        $MerchantId = $post['MerchantId'];
        $CityId = $post['CityId'];
        $LocationId = $post['LocationId'];
        $SegmentId = $post['SegmentId'];
        $publishingSessionId = $this->session->get('publishingSessionId');
        $Status = $post['status'];

        $fetchId = !empty($post['fetchId'])?$post['fetchId']:false;
        // $m_item_data = $this->db->table('merchant_thirdparty_vendors')->select(["Id","Status"])->where(array("Id"=>$fetchId))->get()->getRowArray();
        // if( empty($m_item_data) ){
        //     return array("Status"=>false,"Message"=>"Thirdparty Vendor Details Not Found");
        // } else {
            // $Status = $m_item_data['Status'] == 1?0:1;
            // $data = array("Status"=>$Status);
            // $data1 = array("SegmentStatus"=>$Status);
            //$this->db->table('merchant_thirdparty_vendors')->where(["Id"=>$fetchId])->update($data);
            //$query1 = "UPDATE `merchant_thirdparty_vendors` SET `Status` = $Status WHERE `Id` = $fetchId";
            //$query1 = $this->db->getLastQuery();

            //$this->db->table('merchant_items_thirdparty_pricing')->where(["ThirdPartyVenderId"=>$fetchId,"MerchantId"=>$MerchantId,"CityId"=>$CityId,"LocationId"=>$LocationId,"SegmentId"=>$SegmentId])->update($data1);
            $query = "UPDATE `merchant_items_thirdparty_pricing` SET `ItemStatus` = $Status WHERE `ThirdPartyVenderId` = $fetchId AND `SegmentId` = $SegmentId";
            //$query2 = $this->db->getLastQuery();
            // echo $query;
            // exit;

            //$query = $query1."BazaaRPortal".$query2;
            $TStatus = $Status;
           
            $Previous_Status = $TStatus == 1?0:1;
            $data3 = array(
            "SessionId"=>$publishingSessionId,
            "ThirdPartyVenderId"=>$fetchId,
            "MerchantId"=>$post['MerchantId'],
            "CityId"=>$post['CityId'],
            "LocationId"=>$post['LocationId'],
            "SegmentId"=>$post['SegmentId'],
            "ActionType"=>'UpdateSegmentsStatus',
            "Action"=>'Update New '.$Status,
            "PreviousValue"=>$Previous_Status,
            "NewValue"=>$Status,
            "Query"=>$query,
            "CrDate"=>date('Y-m-d h:i:s',time()),
        );
        $this->db->insert('publishing_activity',$data3);

        $segment_query= $this->db->get('gtg_product_cat')->where('id', $SegmentId)->get()->result_array();
        $segment_name=$segment_query['title'];
        $sql = "SELECT ss.id,ss.rel_id,ss.title FROM gtg_product_cat ss.id={$SegmentId}";
        $query = $this->db->query($sql);
        $sub_segments_details =$query->result_array();
        
        $LocationId ='';

        $item_details = [];
        if( !empty( $sub_segments_details ) ){
        $SubSegmentId=$sub_segments_details[0]['Id'];
        $sql_sub = "SELECT Id,Name,Price FROM merchant_items WHERE MerchantId={$MerchantId} and Segment ={$SegmentId} and SubSegment ={$SubSegmentId}"; 
        if($LocationId!='') {
           $sql_sub.= " and LocationId={$LocationId}";
        }
    
            $query_sub = $this->db->query($sql_sub);
            $item_details =$query_sub->getResultArray();
        }
        //print_r($sub_segments_details);
        
        return array("merchant_id"=>$MerchantId,"segment_name"=>$segment_name,"sub_segments_details"=>$sub_segments_details,"item_details"=>$item_details,"thirdparty_vendors"=>$this->GetThirdPartyVendors()); 

    //    / }
        
    }

    public function UpdateThirdPartyVendorsPrices($post){
        $ItemId = $post['ItemId'];
        $ThirdPartyVenderId = $post['ThirdPartyVenderId'];
        $MerchantId = $post['MerchantId'];
        $CityId = $post['CityId'];
        $LocationId = $post['LocationId'];
        $Price =$post['Price'];
        $SegmentId =$post['SegmentId'];
        $SubSegmentId =$post['SubSegmentId'];
        $publishingSessionId = $_SESSION['publishingSessionId'];
        $CrDate =date('Y-m-d h:i:s',time());

        $data = array(
            "ItemId"=>$post['ItemId'],
            "ThirdPartyVenderId"=>$post['ThirdPartyVenderId'],
            "MerchantId"=>$post['MerchantId'],
            "CityId"=>$post['CityId'],
            "LocationId"=>$post['LocationId'],
            "SegmentId"=>$post['SegmentId'],
            "SubSegmentId"=>$post['SubSegmentId'],
            "Price"=>$post['Price'],
            "CrDate"=>date('Y-m-d h:i:s',time()),
        );

        $data1= array(
            "Price"=>$post['Price'],
        );

        // $m_item_price_data = $this->db->select('*')->from('merchant_items_thirdparty_pricing')->where("ItemId",$ItemId)->where("ThirdPartyVenderId",$ThirdPartyVenderId)->where("MerchantId",$MerchantId)->where("CityId",$CityId)->where("LocationId",$LocationId)->get()->result_array();
        // echo $this->db->last_query();
        // exit;
        $m_item_price_data = $this->db->where("ItemId",$ItemId)->where("Id",$ThirdPartyVenderId)->get('merchant_items_thirdparty_pricing')->result_array();
        // echo $this->db->last_query();
        // exit;
        if( empty($m_item_price_data) ){
             //$this->db->table('merchant_items_thirdparty_pricing')->insert($data);
               //$query = $this->db->getLastQuery();
            $query = "INSERT INTO `merchant_items_thirdparty_pricing` (`ItemId`, `ThirdPartyVenderId`, `MerchantId`, `CityId`, `LocationId`, `SegmentId`, `SubSegmentId`, `Price`, `CrDate`) VALUES ($ItemId, $ThirdPartyVenderId, $MerchantId, $CityId, $LocationId, $SegmentId, $SubSegmentId, $Price,'$CrDate')";
                 $data3 = array(
            "SessionId"=>$publishingSessionId,
            "ItemId"=>$post['ItemId'],
            "ThirdPartyVenderId"=>$post['ThirdPartyVenderId'],
            "MerchantId"=>$post['MerchantId'],
            "CityId"=>$post['CityId'],
            "LocationId"=>$post['LocationId'],
            "SegmentId"=>$post['SegmentId'],
            "SubSegmentId"=>$post['SubSegmentId'],
            "ActionType"=>'PriceInsert',
            "Action"=>'Price Insert new price value '.$Price,
            "PreviousValue"=>'',
            "NewValue"=>$Price,
            "Query"=>$query,
            "CrDate"=>date('Y-m-d h:i:s',time()),
        );
                 $this->db->insert('publishing_activity',$data3);
             

            return array("Status"=>false,"Message"=>"Merchant Item vendor price inserted");
        }
        
        else {
            
            $old_price = $m_item_price_data[0]['Price'];
            //$this->db->table('merchant_items_thirdparty_pricing')->where("ItemId",$ItemId)->where("ThirdPartyVenderId",$ThirdPartyVenderId)->where("MerchantId",$MerchantId)->where("CityId",$CityId)->where("LocationId",$LocationId)->update($data1);
                //$query = $this->db->getLastQuery();
                //$query = "UPDATE `merchant_items_thirdparty_pricing` SET `Price` = $Price WHERE `ItemId` = $ItemId AND `ThirdPartyVenderId` = $ThirdPartyVenderId AND `MerchantId` = $MerchantId AND `CityId` = $CityId AND `LocationId` = $LocationId";
                $query = "UPDATE `merchant_items_thirdparty_pricing` SET `Price` = $Price WHERE `Id` = $ThirdPartyVenderId AND `ItemId` = $ItemId";

                 $data3 = array(
            "SessionId"=>$publishingSessionId,
            "ItemId"=>$post['ItemId'],
            "ThirdPartyVenderId"=>$post['ThirdPartyVenderId'],
            "MerchantId"=>$post['MerchantId'],
            "CityId"=>$post['CityId'],
            "LocationId"=>$post['LocationId'],
            "SegmentId"=>$post['SegmentId'],
            "SubSegmentId"=>$post['SubSegmentId'],
            "ActionType"=>'PriceUpdate',
            "Action"=>'Price Update old price value '.$old_price.' new price value '.$Price,
            "PreviousValue"=>$old_price,
            "NewValue"=>$Price,
            "Query"=>$query,
            "CrDate"=>date('Y-m-d h:i:s',time()),
        );
                 $this->db->insert('publishing_activity',$data3);
            
            return array("Status"=>false,"Message"=>"Status Changed Successfully");
        } 
      
    }

    public function GetUserPublishingActivities()
    {
        $publishingSessionId = $this->session->userdata('publishingSessionId');
        $sql = "SELECT pa.Id, pa.ItemId, pa.ActionType, pa.Action, pa.PreviousValue, pa.NewValue, mtv.VendorName, mtv.Status FROM publishing_activity pa LEFT JOIN merchant_thirdparty_vendors mtv ON mtv.Id = pa.ThirdPartyVenderId WHERE pa.SessionId = '{$publishingSessionId}'";
        $query = $this->db->query($sql);
        $user_publishing_activities = $query->result_array();

        return array("user_publishing_activities" => $user_publishing_activities);
    }

    public function PublishingUserActivitiesUpdate( $post ){
        $form_id = !empty($post['form_id']) ? $post['form_id'] : false;
        $publishingSessionId = $this->session->userdata('publishingSessionId');

        try {
            $user_activities = $this->db->where('SessionId', $publishingSessionId)->get('publishing_activity')->result_array();

            // echo "<pre>"; print_r($user_activities); echo "</pre>";
            // exit;

            foreach ($user_activities as $p_activity) {
                $explode = explode('BazaaRPortal', $p_activity['Query']);

                if (count($explode) == 1) {
                    $sql1 = $p_activity['Query'];
                    $query1 = $this->db->query($sql1);
                } else {
                    $sql1 = $explode[0];
                    $sql2 = $explode[1];
                    $query1 = $this->db->query($sql1);
                    $query2 = $this->db->query($sql2);
                }
            }

            $this->db->where('SessionId', $publishingSessionId)->delete('publishing_activity');
            return array("Status" => 200, "Message" => "Activities Updated Successfully");
        } catch (Exception $ex) {
            return array("Status" => 500, "Message" => "Unable to Update Activities");
        }

    }

    public function UpdateThirdPartyVendorsPricesStatus($post)
{
    $ItemId = $post['ItemId'];
    $ThirdPartyVenderId = $post['ThirdPartyVenderId'];
    $MerchantId = $post['MerchantId'];
    $CityId = $post['CityId'];
    $LocationId = $post['LocationId'];
    $publishingSessionId = $this->session->userdata('publishingSessionId'); // Use userdata() to access session data in CI3

    $m_vendor_data = $this->db->select(["Id", "ItemStatus"])
        ->where("Id", $ThirdPartyVenderId)
        ->get('merchant_items_thirdparty_pricing')
        ->row_array();

    if (empty($m_vendor_data)) {
        return array("Status" => false, "Message" => "Merchant Vendors Not Found");
    }

    $Status = $m_vendor_data['ItemStatus'] == 1 ? 0 : 1;
    $data = array("ItemStatus" => $Status);

    try {
        $this->db->where('Id', $ThirdPartyVenderId)
            ->update('merchant_items_thirdparty_pricing', $data);

        $query = "UPDATE `merchant_items_thirdparty_pricing` SET `ItemStatus` = $Status WHERE `Id` = $ThirdPartyVenderId";

        $data3 = array(
            "SessionId" => $publishingSessionId,
            "ItemId" => $post['ItemId'],
            "ThirdPartyVenderId" => $post['ThirdPartyVenderId'],
            "MerchantId" => $post['MerchantId'],
            "CityId" => $post['CityId'],
            "LocationId" => $post['LocationId'],
            "SegmentId" => $post['SegmentId'],
            "SubSegmentId" => $post['SubSegmentId'],
            "ActionType" => 'UpdateItemStatus',
            "Action" => 'Update New ' . $Status,
            "PreviousValue" => $m_vendor_data['ItemStatus'],
            "NewValue" => $Status,
            "Query" => $query,
            "CrDate" => date('Y-m-d h:i:s', time()),
        );
        $this->db->insert('publishing_activity', $data3);

        return array("Status" => false, "Message" => "Status Changed Successfully");
    } catch (Exception $ex) {
        return array("Status" => false, "Message" => "Unable Update Status");
    }
}

public function GetSubSegmentsList($SegmentId){

    $sql = "SELECT * FROM gtg_product_cat WHERE rel_id={$SegmentId}";
    $query = $this->db->query($sql);
    return $query->result_array();

}


public function GetVendorDetails($id){
    //$sql = "SELECT Id,Name,MerchantId,Status FROM segments WHERE MerchantId={$MerchantId}";
    $sql = "SELECT * FROM merchant_thirdparty_vendors where Id=$id";
    $query = $this->db->query($sql);
    return $query->result_array();
}


public function GetThirdPartyCategories($vendor_details)
{
    // print_r($vendor_details);
    $website_url = $vendor_details[0]['WebSiteUrl'];
    $consumer_key = $vendor_details[0]['ConsumerKey'];
    $consumer_secret = $vendor_details[0]['ConsumerSecret'];

    // WooCommerce API endpoint for retrieving categories
    $url = $website_url.'/wp-json/wc/v3/products/categories';

    // API authentication credentials
    $consumerKey = $consumer_key;
    $consumerSecret = $consumer_secret;

    // Set cURL options
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret)
        )
    );

    // Initialize cURL
    $curl = curl_init();
    curl_setopt_array($curl, $options);

    // Send the cURL request
    $response = curl_exec($curl);

    // Check if the request was successful
    if ($response !== false) {
        $categories = json_decode($response);
        return $categories;
        // Process the list of categories
        // foreach ($categories as $category) {
        //     // Category details
        //     $categoryId = $category->id;
        //     $categoryName = $category->name;

        //     // Display the category information
        //     echo "Category ID: $categoryId<br>";
        //     echo "Category Name: $categoryName<br><br>";

        //     // Check if the category has subcategories
        //     if (!empty($category->children)) {
        //         // Process the list of subcategories
        //         foreach ($category->children as $subcategory) {
        //             // Subcategory details
        //             $subcategoryId = $subcategory->id;
        //             $subcategoryName = $subcategory->name;

        //             // Display the subcategory information
        //             echo "Subcategory ID: $subcategoryId<br>";
        //             echo "Subcategory Name: $subcategoryName<br><br>";
        //         }
        //     }
        // }
    } else {
        // Request failed, show an error message
        // echo "Error retrieving categories: " . curl_error($curl);
        return array();
    }

    // Close cURL
    curl_close($curl);
}



public function GetThirdPartySubCategories($vendor_details,$category_id)
{
    // print_r($vendor_details);
    $website_url = $vendor_details[0]['WebSiteUrl'];
    $consumer_key = $vendor_details[0]['ConsumerKey'];
    $consumer_secret = $vendor_details[0]['ConsumerSecret'];

    // WooCommerce API endpoint for retrieving categories
    $url = $website_url.'/wp-json/wc/v3/products/categories';

    // API authentication credentials
    $consumerKey = $consumer_key;
    $consumerSecret = $consumer_secret;

    $params = array(
        'parent' => $category_id, // Parent category ID
        //'per_page' => 10, // Number of subcategories per page
    );

    // Set cURL options
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret)
        ),
        CURLOPT_POSTFIELDS => http_build_query($params)
    );

    // Initialize cURL
    $curl = curl_init();
    curl_setopt_array($curl, $options);

    // Send the cURL request
    $response = curl_exec($curl);

    // Check if the request was successful
    if ($response !== false) {
        $subcategories = json_decode($response);
        return $subcategories;
        // Process the list of subcategories
        // foreach ($subcategories as $subcategory) {
        //     // Subcategory details
        //     $subcategoryId = $subcategory->id;
        //     $subcategoryName = $subcategory->name;

        //     // Display the subcategory information
        //     echo "Subcategory ID: $subcategoryId<br>";
        //     echo "Subcategory Name: $subcategoryName<br><br>";
        // }
    } else {
        // Request failed, show an error message
        // echo "Error retrieving subcategories: " . curl_error($curl);
        return array();
    }

    // Close cURL
    curl_close($curl);
}

public function GetPosProductsList($vendor,$category,$sub_category){
    // $LocationId ='';
    // $sql = "SELECT Id,Name,Price FROM merchant_items WHERE MerchantId={$MerchantId} and Segment ={$SegmentId} and SubSegment ={$SubSegmentId}"; 
    // $sql = "SELECT mi.pid,mi.product_name,mi.product_price,mtv.Id as ThirdVendorId,mtv.Price as ThirdVendorPrice,GROUP_CONCAT(mtv.Id,',',mtv.ItemStatus,',',mtv.Price,'##' ORDER BY mtv.ThirdPartyVenderId ASC) as PricesVendors FROM gtg_products mi LEFT JOIN merchant_items_thirdparty_pricing mtv ON mtv.ItemId=mi.pid LEFT JOIN merchant_thirdparty_vendors as mt ON mtv.ThirdPartyVenderId = mt.Id WHERE mi.pcat ={$SegmentId} and mi.sub_id ={$SubSegmentId} group by mtv.ItemId"; 
    $sql = "SELECT mi.pid,mi.product_name,mi.product_price,mtv.Id as ThirdPartyVendorPricingId,mtv.ThirdPartyVendorId,mtv.ThirdPartyVendorItemId,mtv.Price as ThirdPartyVendorPrice FROM gtg_products mi LEFT JOIN merchant_items_thirdparty_pricing mtv ON mtv.ItemId=mi.pid LEFT JOIN merchant_thirdparty_vendors as mt ON mtv.ThirdPartyVendorId = mt.Id ";
    
    if(!empty($vendor))
    {
        $sql .= " WHERE mtv.ThirdPartyVendorId ={$vendor}"; 
    }


    if(!empty($category))
    {
        $sql .= " and mi.pcat ={$category}"; 
    }

    if(!empty($sub_category))
    {
        $sql .= " and mi.sub_id ={$sub_category}"; 
    }

    $sql .= " group by mtv.ItemId"; 
    // if($LocationId!='') {
    //    $sql.= " and LocationId={$LocationId}";
    // }
    // echo $sql;
    // exit;
    $query = $this->db->query($sql);
    $item_details =$query->result_array();
    return $item_details;
    // echo "<pre>"; print_r($item_details); echo "</pre>"; 
    // exit;
    // return array("item_details"=>$item_details,"thirdparty_vendors"=>$this->GetThirdPartyVendors()); 
}

public function GetThirdPartyProductsList($vendor,$category,$sub_category){

    $website_url = $vendor_details[0]['WebSiteUrl'];
    $consumer_key = $vendor_details[0]['ConsumerKey'];
    $consumer_secret = $vendor_details[0]['ConsumerSecret'];

    // WooCommerce API endpoint for retrieving categories
    $url = $website_url.'/wp-json/wc/v3/products/categories';

    // API authentication credentials
    $consumerKey = $consumer_key;
    $consumerSecret = $consumer_secret;

    $params = array();
    if(!empty($category))
    {
        $params['category'] = $category;
    }
    
    if(!empty($sub_category)){
        $params['subcategory'] = $sub_category;
    }

    // Set cURL options
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: Basic ' . base64_encode($consumerKey . ':' . $consumerSecret)
        ),
        CURLOPT_POSTFIELDS => http_build_query($params)
    );

    // Initialize cURL
    $curl = curl_init();
    curl_setopt_array($curl, $options);

    // Send the cURL request
    $response = curl_exec($curl);

    // Check if the request was successful
    if ($response !== false) {
        $products = json_decode($response);
        return $products;
        // Process the list of products
        // foreach ($products as $product) {
        //     // Product details
        //     $productId = $product->id;
        //     $productName = $product->name;
        //     $productPrice = $product->price;

        //     // Display the product information
        //     echo "Product ID: $productId<br>";
        //     echo "Product Name: $productName<br>";
        //     echo "Product Price: $productPrice<br><br>";
        // }
    } else {
        // Request failed, show an error message
        // echo "Error retrieving products: " . curl_error($curl);
        return array();
    }

    // Close cURL
    curl_close($curl);

    
//  $jayParsedAry = [
//         [
//           "id" => 1, 
//           "name" => "siva tested a product", 
//           "slug" => "new-product-by-siva", 
//           "permalink" => "https://jstore.my/?post_type=product&p=26250", 
//           "date_created" => "2023-07-18T11:20:42", 
//           "date_created_gmt" => "2023-07-18T03:20:42", 
//           "date_modified" => "2023-07-18T12:03:07", 
//           "date_modified_gmt" => "2023-07-18T04:03:07", 
//           "type" => "simple", 
//           "status" => "draft", 
//           "featured" => false, 
//           "catalog_visibility" => "visible", 
//           "description" => "This is an updated product</p>", 
//           "short_description" => "", 
//           "sku" => "", 
//           "price" => "19.99", 
//           "regular_price" => "19.99", 
//           "sale_price" => "", 
//           "date_on_sale_from" => null, 
//           "date_on_sale_from_gmt" => null, 
//           "date_on_sale_to" => null, 
//           "date_on_sale_to_gmt" => null, 
//           "on_sale" => false, 
//           "purchasable" => true, 
//           "total_sales" => 0, 
//           "virtual" => false, 
//           "downloadable" => false, 
//         ],
//         [
//             "id" => 2, 
//             "name" => "siva tested a product", 
//             "slug" => "new-product-by-siva", 
//             "permalink" => "https://jstore.my/?post_type=product&p=26250", 
//             "date_created" => "2023-07-18T11:20:42", 
//             "date_created_gmt" => "2023-07-18T03:20:42", 
//             "date_modified" => "2023-07-18T12:03:07", 
//             "date_modified_gmt" => "2023-07-18T04:03:07", 
//             "type" => "simple", 
//             "status" => "draft", 
//             "featured" => false, 
//             "catalog_visibility" => "visible", 
//             "description" => "This is an updated product</p>", 
//             "short_description" => "", 
//             "sku" => "", 
//             "price" => "19.99", 
//             "regular_price" => "19.99", 
//             "sale_price" => "", 
//             "date_on_sale_from" => null, 
//             "date_on_sale_from_gmt" => null, 
//             "date_on_sale_to" => null, 
//             "date_on_sale_to_gmt" => null, 
//             "on_sale" => false, 
//             "purchasable" => true, 
//             "total_sales" => 0, 
//             "virtual" => false, 
//             "downloadable" => false, 
//         ],
//         [
//             "id" => 35, 
//             "name" => "siva tested a product", 
//             "slug" => "new-product-by-siva", 
//             "permalink" => "https://jstore.my/?post_type=product&p=26250", 
//             "date_created" => "2023-07-18T11:20:42", 
//             "date_created_gmt" => "2023-07-18T03:20:42", 
//             "date_modified" => "2023-07-18T12:03:07", 
//             "date_modified_gmt" => "2023-07-18T04:03:07", 
//             "type" => "simple", 
//             "status" => "draft", 
//             "featured" => false, 
//             "catalog_visibility" => "visible", 
//             "description" => "This is an updated product</p>", 
//             "short_description" => "", 
//             "sku" => "", 
//             "price" => "19.99", 
//             "regular_price" => "19.99", 
//             "sale_price" => "", 
//             "date_on_sale_from" => null, 
//             "date_on_sale_from_gmt" => null, 
//             "date_on_sale_to" => null, 
//             "date_on_sale_to_gmt" => null, 
//             "on_sale" => false, 
//             "purchasable" => true, 
//             "total_sales" => 0, 
//             "virtual" => false, 
//             "downloadable" => false, 
//          ]
//  ]; 

//  return $jayParsedAry;
}


public function GetAllProductsList($vendor){
    $sql = "SELECT mi.pid,mi.product_name,mi.product_price,mtv.Id as ThirdPartyVendorPricingId,mtv.ThirdPartyVendorItemId,mtv.ThirdPartyVendorId,mtv.Price as ThirdPartyVendorPrice FROM gtg_products mi LEFT JOIN merchant_items_thirdparty_pricing mtv ON mtv.ItemId=mi.pid LEFT JOIN merchant_thirdparty_vendors as mt ON mtv.ThirdPartyVendorId = mt.Id ";
    
    if(!empty($vendor))
    {
        $sql .= " WHERE mtv.ThirdPartyVendorId = {$vendor}"; 
    }
    $sql .= " group by mtv.ItemId"; 
   
    $query = $this->db->query($sql);
    $item_details =$query->result_array();
    return $item_details;
   }

   public function GetProductDetails($product_id){
    $sql = "SELECT * from gtg_products where pid = $product_id";
    $query = $this->db->query($sql);
    $product_details =$query->result_array();
    return $product_details;
   }


   public function get_pos_product_details($vendor,$product_id,$third_party_prcing_id){
    $sql = "SELECT mi.pid,mi.product_name,mi.product_price,mtv.Id as ThirdPartyVendorPricingId,mtv.ThirdPartyVendorItemId,mtv.ThirdPartyVendorId,mtv.Price as ThirdPartyVendorPrice FROM gtg_products mi LEFT JOIN merchant_items_thirdparty_pricing mtv ON mtv.ItemId=mi.pid LEFT JOIN merchant_thirdparty_vendors as mt ON mtv.ThirdPartyVendorId = mt.Id ";
    
    if(!empty($vendor))
    {
        $sql .= " WHERE mtv.ThirdPartyVendorId = {$vendor}"; 
    }
    if(!empty($product_id))
    {
        $sql .= " AND mi.pid = {$product_id}"; 
    }
    if(!empty($third_party_prcing_id))
    {
        $sql .= " AND mtv.Id = {$third_party_prcing_id}"; 
    }
    
    $sql .= " group by mtv.ItemId"; 
   
    $query = $this->db->query($sql);
    $item_details =$query->result_array();
    return $item_details;
   }


   public function share_product_to_third_party($vendor_details,$product_details,$vendor_pricing_id)
   {
       // print_r($vendor_details);
    $website_url = $vendor_details[0]['WebSiteUrl'];
    $consumer_key = $vendor_details[0]['ConsumerKey'];
    $consumer_secret = $vendor_details[0]['ConsumerSecret'];

    // WooCommerce API endpoint for retrieving categories
    $url = $website_url.'/wp-json/wc/v3/products';

    // API authentication credentials
    $consumerKey = $consumer_key;
    $consumerSecret = $consumer_secret;
       // New product data
       $product_data = array(
           'name' => $product_details[0]['product_name'],
           'type' => 'simple',
           'regular_price' => $product_details[0]['product_price'],
           'description' => $product_details[0]['product_des'],
           // Add more product fields as needed
       );
   
       // Set cURL options
       $options = array(
           CURLOPT_URL => $url,
           CURLOPT_RETURNTRANSFER => true,
           CURLOPT_CUSTOMREQUEST => 'POST',
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
           
           $th_product_data['ThirdPartyVendorItemId'] = $product->id;
           
           if($this->db->where('Id',$vendor_pricing_id)->update('merchant_items_thirdparty_pricing ',$th_product_data))
           {
            $resp_data['status'] = '200';
            $resp_data['message'] = 'Product added successfully';
           }else{
            $resp_data['status'] = '500';
            $resp_data['message'] = 'Product added successfully not updated in third party pricing';
           }
           
           
       } else {
           // Request failed, show an error message
           $resp_data['status'] = '500';
           $resp_data['message'] = 'Unable to add Product';

       }
   
       // Close cURL
       curl_close($curl);

       return $resp_data;
   }

   public function update_product_to_third_party($vendor_details,$product_details,$vendor_pricing_id)
   {
    // print_r($vendor_details);
    $website_url = $vendor_details[0]['WebSiteUrl'];
    $consumer_key = $vendor_details[0]['ConsumerKey'];
    $consumer_secret = $vendor_details[0]['ConsumerSecret'];

    // WooCommerce API endpoint for retrieving categories
    $url = $website_url.'/wp-json/wc/v3/products/'.$product_details['product_id'];

    // API authentication credentials
    $consumerKey = $consumer_key;
    $consumerSecret = $consumer_secret;
            // New product data
    $product_data = array(
        'name' => $product_details['product_name'],
        'type' => 'simple',
        'regular_price' => $product_details['product_price'],
        'description' => $product_details['product_description'],
        // Add more product fields as needed
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

        $resp_data['status'] = '200';
        $resp_data['message'] = 'Product updated successfully';
    } else {
        // Request failed, show an error message
        $resp_data['status'] = '500';
        $resp_data['message'] = 'Unable to update Product';
    }
    // Close cURL
    curl_close($curl);
    return $resp_data;
}



public function vendor_save($vendor_details)
{
        $data['VendorName'] = $vendor_details['vendor_name'];
        $data['Type'] = $vendor_details['sale_type'];
        $data['WebSiteUrl'] = $vendor_details['website_url'];
        $data['ConsumerKey'] = $vendor_details['consumer_key'];
        $data['ConsumerSecret'] = $vendor_details['consumer_secret'];
        $data['WebSiteType'] = $vendor_details['website_type'];
        $id = $vendor_details['vendor_id'];

        if(!empty($id))
        {
            if ($this->db->where('Id',$id)->update('merchant_thirdparty_vendors', $data)) {
           
                $resp_data['status'] = '200';
                $resp_data['message'] = 'Vendor updated successfully';
            } else {
                // Request failed, show an error message
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to update Vendor';
            }
        }else{

            if ($this->db->insert('merchant_thirdparty_vendors', $data)) {
           
                $resp_data['status'] = '200';
                $resp_data['message'] = 'Vendor Created successfully';
            } else {
                // Request failed, show an error message
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to create Vendor';
            }
        }

        

        return $resp_data;
}



public function vendor_delete($vendor_id)
{
        
        if ($this->db->where('Id',$vendor_id)->delete('merchant_thirdparty_vendors')) {
        
            if ($this->db->where('ThirdPartyVendorId',$vendor_id)->delete(' merchant_items_thirdparty_pricing')) {
        
                $resp_data['status'] = '200';
                $resp_data['message'] = 'Vendor delete successfully';
            } else {
                // Request failed, show an error message
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to delete Vendor products';
            }

        } else {
            // Request failed, show an error message
            $resp_data['status'] = '500';
            $resp_data['message'] = 'Unable to delete Vendor';
        }
        

        return $resp_data;
}


public function update_product_to_pos($vendor_details,$product_details,$vendor_pricing_id)
{
        $data['Price'] = $product_details['product_price'];
    
        if ($this->db->where('Id', $vendor_pricing_id)->update('merchant_items_thirdparty_pricing', $data)) {
           
            $resp_data['status'] = '200';
            $resp_data['message'] = 'Product updated successfully';
        } else {
            // Request failed, show an error message
            $resp_data['status'] = '500';
            $resp_data['message'] = 'Unable to update Product';
        }

        return $resp_data;
}

public function get_third_party_product_details($vendor_details,$product_id)
{
    $website_url = $vendor_details[0]['WebSiteUrl'];
    $consumer_key = $vendor_details[0]['ConsumerKey'];
    $consumer_secret = $vendor_details[0]['ConsumerSecret'];

    // WooCommerce API endpoint for retrieving categories
    $url = $website_url.'/wp-json/wc/v3/products/'.$product_id;

    // API authentication credentials
    $consumerKey = $consumer_key;
    $consumerSecret = $consumer_secret;
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
        return $product;
    } else {
        // Request failed, show an error message
        // echo "Error retrieving product";
        return array();
    }

    // Close cURL session
    curl_close($ch);
}

   
}

