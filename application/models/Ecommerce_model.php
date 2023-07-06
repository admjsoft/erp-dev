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
        $sql = "SELECT * FROM gtg_product_cat order by title ASC";
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


}

