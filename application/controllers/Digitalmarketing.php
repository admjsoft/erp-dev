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
        $this->li_a = 'digital_marketing';
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
        $data = array();
        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/digital_marketing', $data);
        $this->load->view('fixed/footer');
    }

    public function load_list()
    {
        $no = $this->input->post('start');
        $list = $this->customers->get_all_customers();
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
            "recordsTotal" => count($list),
            "recordsFiltered" => count($list),
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
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
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
                "bcc" => [], 
                "cc" => [], 
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
                    'api-key: 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'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                echo $response;

                   }
    }

    function sendSmsSelected()
    {
        $post = $this->input->post();
        $text = $this->input->post('message');
        // echo "<pre>"; print_r($post); echo "</pre>";
        // exit;
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
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

            $data = [
                "sender" => [
                        "name" => "JsoftSolutions", 
                        "email" => "sprasad96@gmail.com" 
                    ], 
                "to" => $nn_data, 
                "bcc" => [], 
                "cc" => [], 
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
                    'api-key: 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'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                echo $response;

                   }

    }

    function sendWhatsAppSelected()
    {
        $post = $this->input->post();
        $text = $this->input->post('message');
        // echo "<pre>"; print_r($post); echo "</pre>";
        // exit;
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
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
            $nnn_data = implode(',',$nnn_data);
            $dg_data['type'] = 'whatsapp';
            $dg_data['subject'] = '';
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
                "bcc" => [], 
                "cc" => [], 
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
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_SSL_VERIFYPEER => false,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Accept: application/json',
                    'api-key: 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'
                ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                echo $response;

            }
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
        $campaigns = '{
            "count": 1,
            "campaigns": [
              {
                "id": 3,
                "name": "siva email test",
                "type": "classic",
                "status": "sent",
                "testSent": false,
                "header": "[DEFAULT_HEADER]",
                "footer": "EXISTS",
                "sender": {
                  "name": "Testing Company",
                  "id": 1,
                  "email": "sprasad96@gmail.com"
                },
                "replyTo": "",
                "toField": "",
                "previewText": "hiiiiiiiiiiiiiiiii",
                "tag": "",
                "inlineImageActivation": false,
                "mirrorActive": false,
                "recipients": {
                  "lists": [
                    6,
                    2
                  ],
                  "exclusionLists": []
                },
                "statistics": {
                  "globalStats": {
                    "uniqueClicks": 0,
                    "clickers": 0,
                    "complaints": 0,
                    "delivered": 0,
                    "sent": 0,
                    "softBounces": 0,
                    "hardBounces": 0,
                    "uniqueViews": 0,
                    "unsubscriptions": 0,
                    "viewed": 0,
                    "trackableViews": 0,
                    "trackableViewsRate": 0,
                    "estimatedViews": 0
                  },
                  "campaignStats": [
                    {
                      "listId": 2,
                      "uniqueClicks": 0,
                      "clickers": 0,
                      "complaints": 0,
                      "delivered": 2,
                      "sent": 2,
                      "softBounces": 0,
                      "hardBounces": 0,
                      "uniqueViews": 1,
                      "trackableViews": 1,
                      "unsubscriptions": 0,
                      "viewed": 1,
                      "deferred": 0
                    }
                  ],
                  "mirrorClick": 0,
                  "remaining": 0,
                  "linksStats": {},
                  "statsByDomain": {}
                },
                "htmlContent": "",
                "subject": "hiiii",
                "scheduledAt": "2023-08-02T08:30:14.000+05:30",
                "createdAt": "2023-08-02T08:18:14.000+05:30",
                "modifiedAt": "2023-08-02T08:20:23.000+05:30",
                "shareLink": "http://sh1.sendinblue.com/1yjvbyk2gc.html",
                "sentDate": "2023-08-02T08:31:02.000+05:30",
                "sendAtBestTime": false,
                "abTesting": false
              }
            ]
          }';

          $data['campaigns'] = json_decode($campaigns,true);
        
        
        $this->load->view('fixed/header', $head);
        $this->load->view('digital_marketing/email_campaigns',$data);
        $this->load->view('fixed/footer');
    }
    

}
