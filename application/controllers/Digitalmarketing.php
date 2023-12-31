<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Digitalmarketing extends CI_Controller
{

   public function __construct()
    {
        parent::__construct();
        $this->load->model('customers_model', 'customers');
        $this->load->model('digitalmarketing_model', 'digitalmarketing');
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }
        if (!$this->aauth->premission(15)&&!$this->aauth->premission(16)&&!$this->aauth->premission(17)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $this->li_a = 'digitalmarketing';
    }

    public function index()
    {
       // $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Digital Marketing';
        $data = array();
        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/digital_marketing', $data);
        $this->load->view('fixed/footer');
    }

    public function customers_list()
    {
       // $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Digital Marketing';
        $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();
        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/digital_marketing', $data);
        $this->load->view('fixed/footer');
    }

    public function load_list()
    {
        $no = $this->input->post('start');
        //$list = $this->customers->get_all_customers();
        $list = $this->customers->get_datatables();
        $data = array();
        if (!empty($list)) {
            foreach ($list as $customers) {
                $no++;
                $row = array();
                $row[] = ' <input type="checkbox" name="cust" class="checkbox" fetchId="' . $customers->id . '" value="' . $customers->id . '"> ';
                //$row[] = '<div style="display: flex; flex-direction: column; align-items: center;"><span class="avatar-sm align-baseline" ><img class="rounded-circle" src="' . base_url() . 'userfiles/customers/' . $customers->picture . '" width="50px" height="50px"></span> &nbsp;<a href="customers/view?id=' . $customers->id . '">' . $customers->name . '</a></div>';
                //$row[] = '<td style="text-align: center !important;"><span class="avatar-sm align-baseline"><img class="rounded-circle" src="' . base_url() . 'userfiles/customers/' . $customers->picture . '" width="50px" height="50px"></span><br/><a style="text-align: center !important;" href="customers/view?id=' . $customers->id . '">' . $customers->name . '</a></td>';
                //$row[] = amountExchange($customers->total - $customers->pamnt, 0, $this->aauth->get_user()->loc);
                $row[] = $customers->name;
                $row[] = $customers->email;
                $row[] = $customers->phone;
                $row[] = $customers->address . ',' . $customers->city . ',' . $customers->country;

			    if($customers->customer_type=="foreign")
				{
					$customer_type="International";
				}else{					
					$customer_type="Domestic";
				}
			    $row[] = $customer_type;
                $data[] = $row;
            }
        
        }


        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->customers->count_all(),
            "recordsFiltered" => $this->customers->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function transactions($type)
    {

       // $head['usernm'] = $this->aauth->get_user()->username;
        
        $data = array();
        
        $data['transactions'] = $this->digitalmarketing->getTransactionalData($type);
        $data['txn_type'] = $type;
        if($type == 'email')
        {
            $head['title'] = 'Email Transactions';

        }else if($type == 'sms'){
            
            $head['title'] = 'Sms Transactions';

        }else if($type == 'whatsapp'){

            $head['title'] = 'WhatsApp Transactions';
        }

        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/transactions', $data);
        $this->load->view('fixed/footer');
    }

    function sendSelected()
    {
        //if (!$this->aauth->premission(8)) {
        //    exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        //}

        $query = $this->db->get('digital_marketing_settings'); // Replace 'your_key_table' with the actual table name
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->myKey = $row->api_key    ; // Replace 'your_key_column' with the actual column name
        }

        $post = $this->input->post();
        $subject = $this->input->post('subject');
        $text = $this->input->post('text');
        // echo "<pre>"; print_r($post); echo "</pre>";
        // exit;
        if ($this->input->post('EmailMultipleTaskAssignIds')) {
            $ids = $this->input->post('EmailMultipleTaskAssignIds');
            $ex_ids = explode(',',$ids);            
            $recipients = $this->customers->recipients($ex_ids);

            $n_data = array();
            $nn_data = array();
            $nnn_data = array();
            foreach($recipients as $rec){
                $n_data['name'] = $rec['name'];
                $n_data['email'] = $rec['email'];
                $nn_data[] = $n_data;
                $nnn_data[] = $rec['email'];
            }
            $nnn_data = implode(',',$nnn_data);
            $dg_data['type'] = 'email';
            $dg_data['subject'] = $subject;
            $dg_data['message'] = $text;
            $dg_data['customer_ids'] = $ids;
            $dg_data['customer_source'] = $nnn_data;
            $m_response = $this->digitalmarketing->addTransactionalData($dg_data);

            $data = [
                "sender" => [
                        "name" => "JsoftSolutions", 
                        "email" => "sprasad96@gmail.com" 
                    ], 
                "to" => $nn_data, 
                "htmlContent" => $text, 
                "subject" => $subject, 
                "replyTo" => [
                                    "email" => "sprasad96@gmail.com", 
                                    "name" => "JsoftSolutions" 
                                ], 
                "tags" => [
                                "tag1", 
                                "tag2" 
                            ] 
                ]; 
                $data = json_encode($data);

                // echo "<pre>"; print_r($data); echo "</pre>";
                // exit;
                $curl = curl_init();

                curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.brevo.com/v3//smtp/email',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'api-key: '.$this->myKey
                ),
                ));

                $response = curl_exec($curl);
                // echo $response;
                // exit;
                //$response = curl_exec($ch);
        
                if (curl_errno($curl)) {
                    // echo 'cURL Error: ' . curl_error($ch);
                    // return false;
                    $resp_data['status'] = '500';
                    $resp_data['message'] = 'Unable to Send Email';
                }
                
                $httpStatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                
                curl_close($curl);

                
                if ($httpStatus >= 200 && $httpStatus < 300) {
                    // Successful response
                    // echo 'Campaign with ID ' . $campaignId . ' deleted successfully.';
                    // return true;
                    $resp_data['status'] = '200';
                    $resp_data['message'] = 'Email Sent Successfully';
                } else {
                    // Handle the failure case here
                    // echo 'Request failed with HTTP status code: ' . $httpStatus;
                    // return false;
                    $resp_data['status'] = '500';
                    $resp_data['message'] = 'Unable to Send Email';
                }

                echo json_encode($resp_data);


            }
    }

    function sendSmsSelected()
    {
        $post = $this->input->post();
        $text = $this->input->post('message');
        // echo "<pre>"; print_r($post); echo "</pre>";
        // exit;
        //if (!$this->aauth->premission(8)) {
        //    exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        //}

        $query = $this->db->get('digital_marketing_settings'); // Replace 'your_key_table' with the actual table name
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->myKey = $row->api_key    ; // Replace 'your_key_column' with the actual column name
        }


        if ($this->input->post('SmsMultipleTaskAssignIds')) {
            $ids = $this->input->post('SmsMultipleTaskAssignIds');
            $ex_ids = explode(',',$ids);            
            $recipients = $this->customers->recipients($ex_ids);

            $n_data = array();
            $nn_data = array();
            $nnn_data = array();
            foreach($recipients as $rec){
                $n_data['name'] = $rec['name'];
                $n_data['phone_no'] = $rec['phone'];
                $nn_data[] = $n_data;
                $nnn_data[] = $rec['phone'];
            }
            $nnn_data = implode(',',$nnn_data);
            $dg_data['type'] = 'sms';
            $dg_data['subject'] = '';
            $dg_data['message'] = $text;
            $dg_data['customer_ids'] = $ids;
            $dg_data['customer_source'] = $nnn_data;
            $m_response = $this->digitalmarketing->addTransactionalData($dg_data);

                $apiUrl = 'https://api.brevo.com/v3/transactionalSMS/sms';
                $apiKey = $this->myKey;
                
                $data = array(
                    "type" => "transactional",
                    "unicodeEnabled" => false,
                    "sender" => "Jsoft",
                    "recipient" => $n_data['phone_no'],
                    "content" => $text
                );
                
                // print_r($data);
                // exit;

                $jsonData = json_encode($data);
                
                $ch = curl_init();
                
                curl_setopt($ch, CURLOPT_URL, $apiUrl);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                
                $headers = array(
                    'accept: application/json',
                    'api-key: ' . $apiKey,
                    'content-type: application/json',
                );
                
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                
                $response = curl_exec($ch);
                
                // echo $response;
                // exit;
        
                if (curl_errno($ch)) {
                    // echo 'cURL Error: ' . curl_error($ch);
                    // return false;
                    $resp_data['status'] = '500';
                    $resp_data['message'] = 'Unable to Send Sms';
                }
                
                $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                
                curl_close($ch);

                
                if ($httpStatus >= 200 && $httpStatus < 300) {
                    // Successful response
                    // echo 'Campaign with ID ' . $campaignId . ' deleted successfully.';
                    // return true;
                    $resp_data['status'] = '200';
                    $resp_data['message'] = 'Sms Sent Successfully';
                } else {
                    // Handle the failure case here
                    // echo 'Request failed with HTTP status code: ' . $httpStatus;
                    // return false;
                    $resp_data['status'] = '500';
                    $resp_data['message'] = 'Unable to Send Sms';
                }

                echo json_encode($resp_data);
                
            }
    }

    function sendWhatsAppSelected()
    {
        $post = $this->input->post();
        $text = $this->input->post('message');
        // echo "<pre>"; print_r($post); echo "</pre>";
        // exit;
        //if (!$this->aauth->premission(8)) {
        //    exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        //}
        $query = $this->db->get('digital_marketing_settings'); // Replace 'your_key_table' with the actual table name
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->myKey = $row->api_key    ; // Replace 'your_key_column' with the actual column name
        }


        if ($this->input->post('WhatsAppMultipleTaskAssignIds')) {
            $ids = $this->input->post('WhatsAppMultipleTaskAssignIds');
            $ex_ids = explode(',',$ids);            
            $recipients = $this->customers->recipients($ex_ids);

            $n_data = array();
            $nn_data = array();
            $nnn_data = array();
            foreach($recipients as $rec){
                $n_data['name'] = $rec['name'];
                $n_data['phone_no'] = $rec['phone'];
                $nn_data[] = $n_data;
                $nnn_data[] = $rec['phone'];
            }
            $contact_nos = $nnn_data;
            $nnn_data = implode(',',$nnn_data);
            $dg_data['type'] = 'whatsapp';
            $dg_data['subject'] = '';
            $dg_data['message'] = $text;
            $dg_data['customer_ids'] = $ids;
            $dg_data['customer_source'] = $nnn_data;
            $m_response = $this->digitalmarketing->addTransactionalData($dg_data);

            $apiUrl = 'https://api.brevo.com/v3/whatsapp/sendMessage';
            $apiKey = $this->myKey;

            $data = array(
                "senderNumber" => "919032992056",
                "text" => $text,
                "contactNumbers" => $contact_nos
            );

            // echo "<pre>"; print_r($data); echo "</pre>";
            // exit;
            $jsonData = json_encode($data);

            // echo $jsonData;
            // exit;

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $headers = array(
                'accept: application/json',
                'api-key: ' . $apiKey,
                'content-type: application/json',
            );

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);

            // echo $response;
            // exit;
            if (curl_errno($ch)) {
                // echo 'cURL Error: ' . curl_error($ch);
                // return false;
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to Send Sms';
            }
            
            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            
            curl_close($ch);

            
            if ($httpStatus >= 200 && $httpStatus < 300) {
                // Successful response
                // echo 'Campaign with ID ' . $campaignId . ' deleted successfully.';
                // return true;
                $resp_data['status'] = '200';
                $resp_data['message'] = 'Sms Sent Successfully';
            } else {
                // Handle the failure case here
                // echo 'Request failed with HTTP status code: ' . $httpStatus;
                // return false;
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to Send Sms';
            }

            echo json_encode($resp_data);
            }
    }

    function saveContactsSelected()
    {
        $post = $this->input->post();
        $list_ids = $this->input->post('Recepients');
        // echo "<pre>"; print_r($post); echo "</pre>";
        // exit;
        //if (!$this->aauth->premission(8)) {
        //    exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        //}
        $query = $this->db->get('digital_marketing_settings'); // Replace 'your_key_table' with the actual table name
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->myKey = $row->api_key    ; // Replace 'your_key_column' with the actual column name
        }


        if ($this->input->post('ContactAddIds')) {
            $ids = $this->input->post('ContactAddIds');
            $ex_ids = explode(',',$ids);            
            $recipients = $this->customers->recipients($ex_ids);

            $n_data = array();
            $nn_data = array();
            $nnn_data = array();
            foreach($recipients as $rec){
                $n_data['first_name'] = $rec['name'];
                $n_data['last_name'] = '';
                $n_data['sms_no'] = $rec['phone'];
                $n_data['whatsapp_no'] = $rec['phone'];
                $n_data['email_id'] = $rec['email'];
                $n_data['receipents'] = $list_ids;
                $n_data['contact_id'] = '';
                $nn_data[] = $n_data;
            }
        }
        $f_response = array();
        foreach($nn_data as $nf_data)
        {
        $response = array();    
        $response = $this->digitalmarketing->ContactSave($nf_data);
        $response['first_name'] = $nf_data['first_name'];
        $response['phone'] = $nf_data['sms_no'];
        $f_response[] = $response;
        

        }

        // echo "<pre>"; print_r($f_response); echo "<pre>";
        $resp_html = '';
        foreach($f_response as $f_resp)
        {
            if($f_resp['status'] == '200')
            {
                $message = $f_resp['first_name']." Contact Saved Successfully";
                $resp_html .= "<p class='alert-success'>".$message."</p>";

            }else{
                $message = $f_resp['first_name']." Contact Unable to Save Due to: ".$f_resp['message'];
                $resp_html .= "<p class='alert-danger'>".$message."</p>";

            } 
            
        }

        $result_data['status'] = '200';
        $result_data['message'] = $resp_html;
        echo json_encode($result_data);



    }


    public function sms_marketing_campaigns(){
        $head['title'] = "Sms Marketing Campaigns";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['campaigns'] = $this->digitalmarketing->GetSmsCampaignsList();
        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/sms_campaigns',$data);
        $this->load->view('fixed/footer');
    }

    public function sms_campaign_create(){
        $head['title'] = "Sms Marketing Campaign";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();

        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/sms_campaign_create',$data);
        $this->load->view('fixed/footer');
    }
    public function sms_campaign_save()
    {
        $post = $this->input->post();  
        // echo "<pre>"; print_r($post); echo "</pre>"; 
        // /exit;     
        $response = $this->digitalmarketing->SmsCampaignSave($post);
        echo json_encode($response);
            
    }
    public function sms_campaign_edit(){
        $id = $this->input->get('id');
        $head['title'] = "Sms Marketing Campaign";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();
        $data['campaign_details'] = $this->digitalmarketing->GetSmsCampaignById($id);

        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;

        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/sms_campaign_edit',$data);
        $this->load->view('fixed/footer');
    }

    public function sms_campaign_view(){
        $id = $this->input->get('id');
        $head['title'] = "Sms Marketing Campaign";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();
        $data['campaign_details'] = $this->digitalmarketing->GetSmsCampaignById($id);
        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/sms_campaign_view',$data);
        $this->load->view('fixed/footer');
    }
    
    public function sms_campaign_delete()
    {
        $post = $this->input->post(); 
        $campaign_id = $post['campaign_id'];       
        $response = $this->digitalmarketing->DeleteSmsCampaignById($campaign_id);
        echo json_encode($response);
            
    }

    public function whatsapp_marketing_campaigns(){
        $head['title'] = "WhatsApp Marketing Campaigns";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['campaigns'] = $this->digitalmarketing->GetWhatsAppCampaignsList();
        // echo "<pre>"; print_r($data['campaigns']); echo "</pre>";
        // exit;
        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/whatsapp_campaigns',$data);
        $this->load->view('fixed/footer');
    }

    public function whatsapp_campaign_create(){
        $head['title'] = "WhatsApp Marketing Campaign";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();

        
        $data['templates'] = $this->digitalmarketing->GetWhatsAppTemplatesList();

        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/whatsapp_campaign_create',$data);
        $this->load->view('fixed/footer');
    }

    public function whatsapp_campaign_save()
    {
        $post = $this->input->post();  
        // echo "<pre>"; print_r($post); echo "</pre>"; 
        // /exit;     
        $response = $this->digitalmarketing->WhatsAppCampaignSave($post);
        echo json_encode($response);
            
    }

    public function whatsapp_campaign_edit(){
        
        $id = $this->input->get('id');
        $head['title'] = "WhatsApp Marketing Campaign";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['campaign_details'] = $this->digitalmarketing->GetWhatsAppCampaignById($id);

        $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();

        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/whatsapp_campaign_edit',$data);
        $this->load->view('fixed/footer');
    }

    public function whatsapp_campaign_view(){
        
        $id = $this->input->get('id');
        $head['title'] = "WhatsApp Marketing Campaign";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['campaign_details'] = $this->digitalmarketing->GetWhatsAppCampaignById($id);        
        $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();
        // echo "<pre>"; print_r($data); echo "</pre>"; 
        // exit;  
        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/whatsapp_campaign_view',$data);
        $this->load->view('fixed/footer');
    }

    public function whatsapp_campaign_delete()
    {
        $post = $this->input->post(); 
        $campaign_id = $post['campaign_id'];       
        $response = $this->digitalmarketing->DeleteWhatsAppCampaignById($campaign_id);
        echo json_encode($response);
            
    }

    public function email_marketing_campaigns(){
        $head['title'] = "Email Marketing Campaigns";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['campaigns'] = $this->digitalmarketing->GetEmailCampaignsList();
        
        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/email_campaigns',$data);
        $this->load->view('fixed/footer');
    }

    public function email_campaign_create(){
        $head['title'] = "Email Marketing Campaign";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();
        $data['templates'] = $this->digitalmarketing->EmailCampaignTemplates();

        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/email_campaign_create',$data);
        $this->load->view('fixed/footer');
    }
    public function email_campaign_save()
    {
        $post = $this->input->post();  
        // echo "<pre>"; print_r($post); echo "</pre>"; 
        // /exit;     
        $response = $this->digitalmarketing->EmailCampaignSave($post);
        echo json_encode($response);
            
    }

    public function email_campaign_edit(){
        $id = $this->input->get('id');
        $head['title'] = "Email Marketing Campaign";
        $head['usernm'] = $this->aauth->get_user()->username;
        $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();
        $data['templates'] = $this->digitalmarketing->EmailCampaignTemplates();
        $data['campaign_details'] = $this->digitalmarketing->EmailCampaignById($id);
        // echo "<pre>"; print_r($data['campaign_details']); echo "</pre>";
        // exit;

        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/email_campaign_edit',$data);
        $this->load->view('fixed/footer');
    }

    public function email_campaign_view(){
        $id = $this->input->get('id');
        $head['title'] = "Email Marketing Campaign";
        $head['usernm'] = $this->aauth->get_user()->username;
        
        $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();
        $data['templates'] = $this->digitalmarketing->EmailCampaignTemplates();        
        $data['campaign_details'] = $this->digitalmarketing->EmailCampaignById($id);
        
        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/email_campaign_view',$data);
        $this->load->view('fixed/footer');
    }

    public function email_campaign_delete()
    {
        $post = $this->input->post(); 
        $campaign_id = $post['campaign_id'];       
        $response = $this->digitalmarketing->DeleteEmailCampaignById($campaign_id);
        echo json_encode($response);
            
    }
    
    public function settings(){
      $head['title'] = "Digital Marketing Settings";
      $head['usernm'] = $this->aauth->get_user()->username;
      $data['dg_settings'] = $this->digitalmarketing->GetSettings();
      $this->load->view('fixed/header', $head);
      $this->load->view('digital_marketing/settings',$data);
      $this->load->view('fixed/footer');
    }

  public function settings_create(){
    $head['title'] = "Digital Marketing Settings";
    $head['usernm'] = $this->aauth->get_user()->username;
    $data = array();
    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/settings_create',$data);
    $this->load->view('fixed/footer');
  }
  public function settings_save()
  {
      $post = $this->input->post();  
      // echo "<pre>"; print_r($post); echo "</pre>"; 
      // /exit;     
      $response = $this->digitalmarketing->SettingsSave($post);
      echo json_encode($response);
          
  }
  public function settings_edit(){
      $id = $this->input->get('id');
      $head['title'] = "Digital Marketing Settings";
      $head['usernm'] = $this->aauth->get_user()->username;
      $data['settings_details'] = $this->digitalmarketing->GetSettingsById($id);

      // echo "<pre>"; print_r($data); echo "</pre>";
      // exit;

      $this->load->view('fixed/header', $head);
      $this->load->view('digital_marketing/settings_edit',$data);
      $this->load->view('fixed/footer');
  }

  public function settings_view(){
      $id = $this->input->get('id');
      $head['title'] = "Sms Marketing Campaign";
      $head['usernm'] = $this->aauth->get_user()->username;
      
      $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();
      $data['campaign_details'] = $this->digitalmarketing->GetSmsCampaignById($id);
      $this->load->view('fixed/header', $head);
      $this->load->view('digital_marketing/sms_campaign_view',$data);
      $this->load->view('fixed/footer');
  }

  public function settings_delete()
  {
      $post = $this->input->post(); 
      $setting_id = $post['setting_id'];       
      $response = $this->digitalmarketing->DeleteSettingsById($setting_id);
      echo json_encode($response);
          
  }



  

  public function contacts(){
    $head['title'] = "Contact Campaigns";
    $head['usernm'] = $this->aauth->get_user()->username;
    $data['contacts'] = $this->digitalmarketing->GetContactsList();
    $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();
    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/contacts',$data);
    $this->load->view('fixed/footer');
}

public function contact_create(){
    $head['title'] = "Contact management";
    $head['usernm'] = $this->aauth->get_user()->username;
    $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();

    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/contact_create',$data);
    $this->load->view('fixed/footer');
}
public function contact_save()
{
    $post = $this->input->post();  
    // echo "<pre>"; print_r($post); echo "</pre>"; 
    // /exit;     
    $response = $this->digitalmarketing->ContactSave($post);
    echo json_encode($response);
        
}
public function contact_edit(){
    $id = $this->input->get('id');
    $head['title'] = "Contact management";
    $head['usernm'] = $this->aauth->get_user()->username;
    $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();
    $data['contact_details'] = $this->digitalmarketing->GetContactById($id);

    // echo "<pre>"; print_r($data); echo "</pre>";
    // exit;

    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/contact_edit',$data);
    $this->load->view('fixed/footer');
}

public function contact_view(){
    $id = $this->input->get('id');
    $head['title'] = "Contact Management";
    $head['usernm'] = $this->aauth->get_user()->username;    
    $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();
    $data['contact_details'] = $this->digitalmarketing->GetContactById($id);

    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/contact_view',$data);
    $this->load->view('fixed/footer');
}

public function delete_contact()
{
    $post = $this->input->post(); 
    $contact_id = $post['contact_id'];       
    $response = $this->digitalmarketing->DeleteContactById($contact_id);
    echo json_encode($response);
        
}



 

public function lists(){
    $head['title'] = "List Management";
    $head['usernm'] = $this->aauth->get_user()->username;
    $data['lists'] = $this->digitalmarketing->GetList();
    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/lists',$data);
    $this->load->view('fixed/footer');
}

public function list_create(){
    $head['title'] = "List management";
    $head['usernm'] = $this->aauth->get_user()->username;
    $data['list_ids'] = $this->digitalmarketing->GetSmsCampaignsListIds();
    $data['folders'] = $this->digitalmarketing->GetFoldersList();
    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/list_create',$data);
    $this->load->view('fixed/footer');
}
public function list_save()
{
    $post = $this->input->post();  
    // echo "<pre>"; print_r($post); echo "</pre>"; 
    // /exit;     
    $response = $this->digitalmarketing->ListSave($post);
    echo json_encode($response);
        
}
public function list_edit(){
    $id = $this->input->get('id');
    $head['title'] = "List management";
    $head['usernm'] = $this->aauth->get_user()->username;
    $data['list_details'] = $this->digitalmarketing->GetListById($id);

    $data['folders'] = $this->digitalmarketing->GetFoldersList();
    // echo "<pre>"; print_r($data); echo "</pre>";
    // exit;

    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/list_edit',$data);
    $this->load->view('fixed/footer');
}


public function list_view(){
    $id = $this->input->get('id');
    $head['title'] = "List Management";
    $head['usernm'] = $this->aauth->get_user()->username;    
   
    $data['list_details'] = $this->digitalmarketing->GetListById($id);

    $data['folders'] = $this->digitalmarketing->GetFoldersList();
    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/list_view',$data);
    $this->load->view('fixed/footer');
}

public function delete_list()
{
    $post = $this->input->post(); 
    $list_id = $post['list_id'];       
    $response = $this->digitalmarketing->DeleteListById($list_id);
    echo json_encode($response);
        
}

public function list_contacts(){
    
    $id = $this->input->get('id');
    $head['title'] = "List Management";
    $head['usernm'] = $this->aauth->get_user()->username;
    $data['contacts'] = $this->digitalmarketing->GetListContacts($id);
    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/list_contacts',$data);
    $this->load->view('fixed/footer');
}


public function folders(){
    $head['title'] = "Folder Management";
    $head['usernm'] = $this->aauth->get_user()->username;
    $data['folders'] = $this->digitalmarketing->GetFoldersList();
    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/folders',$data);
    $this->load->view('fixed/footer');
}

public function folder_create(){
    $head['title'] = "Folder management";
    $head['usernm'] = $this->aauth->get_user()->username;
    $data = array();
    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/folder_create',$data);
    $this->load->view('fixed/footer');
}
public function folder_save()
{
    $post = $this->input->post();  
    // echo "<pre>"; print_r($post); echo "</pre>"; 
    // /exit;     
    $response = $this->digitalmarketing->FolderSave($post);
    echo json_encode($response);
        
}
public function folder_edit(){
    $id = $this->input->get('id');
    $head['title'] = "Folder management";
    $head['usernm'] = $this->aauth->get_user()->username;
    $data['folder_details'] = $this->digitalmarketing->GetFolderById($id);

    // echo "<pre>"; print_r($data); echo "</pre>";
    // exit;

    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/folder_edit',$data);
    $this->load->view('fixed/footer');
}


public function folder_view(){
    $id = $this->input->get('id');
    $head['title'] = "Folder Management";
    $head['usernm'] = $this->aauth->get_user()->username;    
   
    $data['folder_details'] = $this->digitalmarketing->GetFolderById($id);

    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/folder_view',$data);
    $this->load->view('fixed/footer');
}

public function delete_folder()
{
    $post = $this->input->post(); 
    $folder_id = $post['folder_id'];       
    $response = $this->digitalmarketing->DeleteFolderById($folder_id);
    echo json_encode($response);
        
}

public function folder_lists(){
    $id = $this->input->get('id');
    $head['title'] = "List Management";
    $head['usernm'] = $this->aauth->get_user()->username;
    $data['lists'] = $this->digitalmarketing->GetFolderLists($id);
    $this->load->view('fixed/header', $head);
    $this->load->view('digital_marketing/lists',$data);
    $this->load->view('fixed/footer');
}

public function get_email_template_details(){

    
    $post = $this->input->post();
    $template_id = $post['template_id'];
    $data['template_details'] = $this->digitalmarketing->GetEmailTemplateById($template_id);
    // echo "<pre>"; print_r($data['campaign_details']); echo "</pre>";
    // exit;
    $data['status'] = '200';
    $data['html'] = $this->load->view('digital_marketing/email_template_view',$data,TRUE);
    echo json_encode($data);
}


    function saveContactsToListSelected()
    {
        $post = $this->input->post();
        //if (!$this->aauth->premission(8)) {
        //    exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        //}
        $query = $this->db->get('digital_marketing_settings'); // Replace 'your_key_table' with the actual table name
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->myKey = $row->api_key    ; // Replace 'your_key_column' with the actual column name
        }

        $response = $this->digitalmarketing->saveContactsToListSelected($post);
        
        echo json_encode($response);


    }


}
