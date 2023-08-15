<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Digitalmarketing_model extends CI_Model
{
    private $myKey; // Class property to store the key
    
    public function __construct() {
        parent::__construct();
        // Load necessary libraries, models, or do other initializations here

        //$this->load->database(); // Load the database library

        // Fetch the key from the database and store it in the class property
        $query = $this->db->get('digital_marketing_settings'); // Replace 'your_key_table' with the actual table name
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->myKey = $row->api_key    ; // Replace 'your_key_column' with the actual column name
        }
    }


    public function addTransactionalData($data)
    {

        if ($this->db->insert('digital_marketing_transactional_report', $data)) {
            return true;
        } else {
            return false;
        }
    }

    public function getTransactionalData($type)
    {
        $transactions = $this->db->where('type',$type)->get('digital_marketing_transactional_report')->result_array();
        if (!empty($transactions)) {
            return $transactions;
        } else {
            return false;
        }
    }

    public function GetWhatsappCampaignsList(){
        
        // API endpoint URL
        $url = 'https://api.brevo.com/v3/whatsappCampaigns';
        
        // API headers
        $key = $this->myKey;
        $headers = array(
            'accept: application/json',
            'api-key: ' . $key // Use the dynamic key here
        );
        
        // Initialize cURL session
        $curl = curl_init($url);
        
        // Set cURL options
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        // Execute cURL request and get the response
        $response = curl_exec($curl);
        
        // Check for cURL errors
        if (curl_errno($curl)) {
            $error_message = 'cURL Error: ' . curl_error($curl);
            curl_close($curl);
            // Handle the failure case here
            //echo $error_message;
            return array();
        } else {
            $http_status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            
            if ($http_status_code >= 200 && $http_status_code < 300) {
                // Successful response
                $decoded_response = json_decode($response, true);
                // Do something with the decoded response
                //print_r($decoded_response);
                return $decoded_response;
            } else {
                // Handle the failure case here
                //echo 'Request failed with HTTP status code: ' . $http_status_code;
                return array();
            }
        }
    }

    
    public function GetWhatsAppCampaignById($campaignId){
            

            // $campaignId = 2; // Your dynamic value here, e.g., received from user input or database

            $apiUrl = 'https://api.brevo.com/v3/whatsappCampaigns/' . $campaignId;
            $apiKey = $this->myKey;


            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $headers = array(
                'accept: application/json',
                'api-key: ' . $apiKey,
            );

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                // echo 'cURL Error: ' . curl_error($ch);
                return array();
            }

            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($httpStatus >= 200 && $httpStatus < 300) {
                // Successful response
                $decodedResponse = json_decode($response, true);
                // Do something with the decoded response
                // print_r($decodedResponse);
                return $decodedResponse;
            } else {
                // Handle the failure case here
                // echo 'Request failed with HTTP status code: ' . $httpStatus;
                return array();
            }

    }

    public function DeleteWhatsAppCampaignById($campaignId){
        
        //$campaignId = 25; // Your dynamic value here, e.g., received from user input or database
        
        $apiUrl = 'https://api.brevo.com/v3/whatsappCampaigns/' . $campaignId;
        $apiKey = $this->myKey;
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE'); // Set request type to DELETE
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array(
            'accept: application/json',
            'api-key: ' . $apiKey,
        );
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            // echo 'cURL Error: ' . curl_error($ch);
            // return false;
            $resp_data['status'] = '500';
            $resp_data['message'] = 'Unable to Delete WhatsApp Campaign';
        }
        
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
    
        
        if ($httpStatus >= 200 && $httpStatus < 300) {
            // Successful response
            // echo 'Campaign with ID ' . $campaignId . ' deleted successfully.';
            // return true;
            $resp_data['status'] = '200';
            $resp_data['message'] = 'WhatsApp Campaign Deleted Successfully';
        } else {
            // Handle the failure case here
            // echo 'Request failed with HTTP status code: ' . $httpStatus;
            // return false;
            $resp_data['status'] = '500';
            $resp_data['message'] = 'Unable to Delete WhatsApp Campaign';
        }
        return $resp_data;
    }

    public function SmsCampaignSave($post){
        
        $campaign_id = $post['campaign_id'];
        if(!empty($campaign_id))
        {
            $apiUrl = 'https://api.brevo.com/v3/smsCampaigns/'.$campaign_id;
            $apiKey = $this->myKey;

           
            //$input_schedule_date  = $post['schedule_date'];
            //$formattedDate = $inputDateTime->format('Y-m-d\TH:i:sP');
            $//input_datetime = new DateTime($input_schedule_date);

            // $malaysian_timezone = new DateTimeZone('Asia/Kuala_Lumpur');
            // $input_datetime->setTimezone($malaysian_timezone);
            
            // Format the modified datetime to include Malaysian time zone
            //$formattedDate = $input_datetime->format('Y-m-d\TH:i:sP');

            $input_schedule_date  = $post['schedule_date'];
            //$formattedDate = $inputDateTime->format('Y-m-d\TH:i:sP');
            $input_datetime = new DateTime($input_schedule_date);
            $dateTimeObj = new DateTime($input_schedule_date, new DateTimeZone('Asia/Kuala_Lumpur'));

            // Convert to UTC by setting the time zone to UTC
            $dateTimeObj->setTimezone(new DateTimeZone('UTC'));

            // Format the DateTime object to the specified format ('Y-m-d\TH:i:sP')
            $formattedDate = $dateTimeObj->format('Y-m-d\TH:i:sP');

            $listIds = array_map('intval', $post['receipents']);

            $data = array(
                "recipients" => array(
                    "listIds" => $listIds
                ),       
                "unicodeEnabled" => false,
                "name" => $post['campaign_name'],
                "sender" => $post['sender_name'],
                "content" => $post['message_content'],
                "scheduledAt" => $formattedDate 
            );

            $jsonData = json_encode($data);

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

            $headers = array(
                'accept: application/json',
                'api-key: ' . $apiKey,
                'content-type: application/json',
            );

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                echo 'cURL Error: ' . curl_error($ch);
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to Update Sms Campaign';
            }
    
            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
            curl_close($ch);
    
            if ($httpStatus >= 200 && $httpStatus < 300) {
                // Successful response
                //$decodedResponse = json_decode($response, true);
                // Do something with the decoded response
                //print_r($decodedResponse);
                $resp_data['status'] = '200';
                $resp_data['message'] = 'Sms Campaign Updated Successfully';
            } else {
                // Handle the failure case here
                //echo 'Request failed with HTTP status code: ' . $httpStatus;
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to Update Sms Campaign';
            }
        }else{
            $apiUrl = 'https://api.brevo.com/v3/smsCampaigns';
            

        $apiKey = $this->myKey;

        // $input_schedule_date  = $post['schedule_date'];
        //$formattedDate = $inputDateTime->format('Y-m-d\TH:i:sP');
        // $input_datetime = new DateTime($input_schedule_date);

        // $malaysian_timezone = new DateTimeZone('Asia/Kuala_Lumpur');
        // $input_datetime->setTimezone($malaysian_timezone);
        
        // Format the modified datetime to include Malaysian time zone
        // $formattedDate = $input_datetime->format('Y-m-d\TH:i:sP');
        $input_schedule_date  = $post['schedule_date'];
        //$formattedDate = $inputDateTime->format('Y-m-d\TH:i:sP');
        $input_datetime = new DateTime($input_schedule_date);
        $dateTimeObj = new DateTime($input_schedule_date, new DateTimeZone('Asia/Kuala_Lumpur'));

        // Convert to UTC by setting the time zone to UTC
        $dateTimeObj->setTimezone(new DateTimeZone('UTC'));

        // Format the DateTime object to the specified format ('Y-m-d\TH:i:sP')
        $formattedDate = $dateTimeObj->format('Y-m-d\TH:i:sP');
        
        $listIds = array_map('intval', $post['receipents']);

        $data = array(
            "recipients" => array(
                "listIds" => $listIds
            ),       
            "unicodeEnabled" => false,
            "name" => $post['campaign_name'],
            "sender" => $post['sender_name'],
            "content" => $post['message_content'],
            "scheduledAt" => $formattedDate 
        );

        // echo "<pre>"; print_r($data); echo "</pre>"; 
        // exit;
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
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
            echo 'cURL Error: ' . curl_error($ch);
            $resp_data['status'] = '500';
            $resp_data['message'] = 'Unable to Create Sms Campaign';
        }

        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpStatus >= 200 && $httpStatus < 300) {
            // Successful response
            //$decodedResponse = json_decode($response, true);
            // Do something with the decoded response
            //print_r($decodedResponse);
            $resp_data['status'] = '200';
            $resp_data['message'] = 'Sms Campaign Created Successfully';
        } else {
            // Handle the failure case here
            //echo 'Request failed with HTTP status code: ' . $httpStatus;
            $resp_data['status'] = '500';
            $resp_data['message'] = 'Unable to Create Sms Campaign';
        }
//exit;
        }
        
        
        return $resp_data;
    }



    public function GetSmsCampaignsList(){
        

            $apiUrl = 'https://api.brevo.com/v3/smsCampaigns';
            $apiKey = $this->myKey;

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $headers = array(
                'accept: application/json',
                'api-key: ' . $apiKey,
            );

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);

            // echo $response;
            // exit;
            
            if (curl_errno($ch)) {
                // echo 'cURL Error: ' . curl_error($ch);
                return array();
            }

            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($httpStatus >= 200 && $httpStatus < 300) {
                // Successful response
                $decodedResponse = json_decode($response, true);
                // Do something with the decoded response
                // print_r($decodedResponse);
                return $decodedResponse;
            } else {
                // Handle the failure case here
                // echo 'Request failed with HTTP status code: ' . $httpStatus;
                return array();
            }
    }

    public function GetSmsCampaignById($campaignId){
        

            // $campaignId = 2; // Your dynamic value here, e.g., received from user input or database

            $apiUrl = 'https://api.brevo.com/v3/smsCampaigns/' . $campaignId;
            $apiKey = $this->myKey;

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $headers = array(
                'accept: application/json',
                'api-key: ' . $apiKey,
            );

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);

            if (curl_errno($ch)) {
                // echo 'cURL Error: ' . curl_error($ch);
                return array();
            }

            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($httpStatus >= 200 && $httpStatus < 300) {
                // Successful response
                $decodedResponse = json_decode($response, true);
                // Do something with the decoded response
                // print_r($decodedResponse);
                return $decodedResponse;
            } else {
                // Handle the failure case here
                // echo 'Request failed with HTTP status code: ' . $httpStatus;
                return array();
            }

    }

    public function DeleteSmsCampaignById($campaignId){
        

        // $campaignId = 2; // Your dynamic value here, e.g., received from user input or database

        $apiUrl = 'https://api.brevo.com/v3/smsCampaigns/' . $campaignId;
        $apiKey = $this->myKey;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE'); // Set request type to DELETE
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array(
            'accept: application/json',
            'api-key: ' . $apiKey,
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        // echo $response;
        // exit;

        if (curl_errno($ch)) {
            // echo 'cURL Error: ' . curl_error($ch);
            //return false;
            $decodedResponse = json_decode($response, true);
            $resp_data['status'] = '500';
            $resp_data['message'] = $decodedResponse['message'];
        }

        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpStatus >= 200 && $httpStatus < 300) {
            // Successful response
            // echo 'Campaign with ID ' . $campaignId . ' deleted successfully.';
            // return true;
            $resp_data['status'] = '200';
            $resp_data['message'] = 'Sms Campaign Deleted Successfully';
        } else {
            // Handle the failure case here
            // echo 'Request failed with HTTP status code: ' . $httpStatus;
            // return false;
            $decodedResponse = json_decode($response, true);
            $resp_data['status'] = '500';
            $resp_data['message'] = $decodedResponse['message'];
        }
        return $resp_data;
    }

    public function GetSmsCampaignsListIds(){
        
        $apiUrl = 'https://api.brevo.com/v3/contacts/lists';
        $apiKey = $this->myKey;
        $limit = 10;
        $offset = 0;
        $sort = 'desc';

        $url = $apiUrl . '?limit=' . $limit . '&offset=' . $offset . '&sort=' . $sort;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array(
            'accept: application/json',
            'api-key: ' . $apiKey,
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            //echo 'cURL Error: ' . curl_error($ch);
            return array();
        }

        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpStatus >= 200 && $httpStatus < 300) {
            // Successful response
            $decodedResponse = json_decode($response, true);
            // Do something with the decoded response
            //print_r($decodedResponse);
            return $decodedResponse;
        } else {
            // Handle the failure case here
            //echo 'Request failed with HTTP status code: ' . $httpStatus;
            return array();
        }

    }

    public function WhatsAppCampaignSave($post){
        
        $campaign_id = $post['campaign_id'];
        if(!empty($campaign_id))
        {
            
        $apiUrl = 'https://api.brevo.com/v3/whatsappCampaigns/'.$campaign_id;
        $apiKey = $this->myKey;

        // $inputDateTime = new DateTime($post['schedule_date']);
        // $formattedDate = $inputDateTime->format('Y-m-d\TH:i:sP');
        $input_schedule_date  = $post['schedule_date'];
        //$formattedDate = $inputDateTime->format('Y-m-d\TH:i:sP');
        $input_datetime = new DateTime($input_schedule_date);
        $dateTimeObj = new DateTime($input_schedule_date, new DateTimeZone('Asia/Kuala_Lumpur'));

        // Convert to UTC by setting the time zone to UTC
        $dateTimeObj->setTimezone(new DateTimeZone('UTC'));

        // Format the DateTime object to the specified format ('Y-m-d\TH:i:sP')
        $formattedDate = $dateTimeObj->format('Y-m-d\TH:i:sP');
        

        $listIds = array_map('intval', $post['receipents']);


        $data = array(
            "recipients" => array(
                "listIds" => $listIds
            ), 
            "name" => $post['campaign_name'],
            "scheduledAt" =>  $formattedDate,
            "campaignStatus" => $post['campaign_status']
        );
       

        $jsonData = json_encode($data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $headers = array(
            'accept: application/json',
            'api-key: ' . $apiKey,
            'content-type: application/json',
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            // echo 'cURL Error: ' . curl_error($ch);
            $resp_data['status'] = '500';
            $resp_data['message'] = 'Unable to Update WhatsApp Campaign';
        }

        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpStatus >= 200 && $httpStatus < 300) {
            // Successful response
            $decodedResponse = json_decode($response, true);
            // Do something with the decoded response
            // print_r($decodedResponse);
            $resp_data['status'] = '200';
            $resp_data['message'] = 'Updated WhatsApp Campaign Successfully';
        } else {
            // Handle the failure case here
            // echo 'Request failed with HTTP status code: ' . $httpStatus;
            $resp_data['status'] = '500';
            $resp_data['message'] = 'Unable to Update WhatsApp Campaign';
        }

        }else{

        $apiUrl = 'https://api.brevo.com/v3/whatsappCampaigns';
        $apiKey = $this->myKey;

        // /$datetime = new DateTime($post['schedule_date']);
        // $inputDateTime = new DateTime($post['schedule_date']);
        // $formattedDate = $inputDateTime->format('Y-m-d\TH:i:sP');
        $input_schedule_date  = $post['schedule_date'];
        //$formattedDate = $inputDateTime->format('Y-m-d\TH:i:sP');
        $input_datetime = new DateTime($input_schedule_date);
        $dateTimeObj = new DateTime($input_schedule_date, new DateTimeZone('Asia/Kuala_Lumpur'));

        // Convert to UTC by setting the time zone to UTC
        $dateTimeObj->setTimezone(new DateTimeZone('UTC'));

        // Format the DateTime object to the specified format ('Y-m-d\TH:i:sP')
        $formattedDate = $dateTimeObj->format('Y-m-d\TH:i:sP');
        

        $listIds = array_map('intval', $post['receipents']);


        $data = array(
            "recipients" => array(
                "listIds" => $listIds
            ), 
            "name" => $post['campaign_name'],
            "templateId" => (int)$post['template'],
            "scheduledAt" =>  $formattedDate
        );

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
            $resp_data['status'] = '500';
            $resp_data['message'] = 'Unable to Create WhatsApp Campaign';
        }

        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpStatus >= 200 && $httpStatus < 300) {
            // Successful response
            $decodedResponse = json_decode($response, true);
            // Do something with the decoded response
            // print_r($decodedResponse);
            $resp_data['status'] = '200';
            $resp_data['message'] = 'Created WhatsApp Campaign Successfully';
        } else {
            // Handle the failure case here
            // echo 'Request failed with HTTP status code: ' . $httpStatus;
            $resp_data['status'] = '500';
            $resp_data['message'] = 'Unable to Create WhatsApp Campaign';
        }
    }
        return $resp_data;
    }   

    public function GetEmailCampaignsList(){
        
        $apiUrl = 'https://api.brevo.com/v3/emailCampaigns';
        $apiKey = $this->myKey;
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array(
            'accept: application/json',
            'api-key: ' . $apiKey,
        );
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            // echo 'cURL Error: ' . curl_error($ch);
            return array();
        }
        
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
        
        if ($httpStatus >= 200 && $httpStatus < 300) {
            // Successful response
            $decodedResponse = json_decode($response, true);
            // Do something with the decoded response
            // print_r($decodedResponse);
            return $decodedResponse;
        } else {
            // Handle the failure case here
            // echo 'Request failed with HTTP status code: ' . $httpStatus;
            return array();
        }
        
    }

    public function EmailCampaignById($campaignId){
        

            // $campaignId = 2; // Your dynamic value here, e.g., received from user input or database

            $apiUrl = 'https://api.brevo.com/v3/emailCampaigns/' . $campaignId;
            $apiKey = $this->myKey;

            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            $headers = array(
                'accept: application/json',
                'api-key: ' . $apiKey
            );
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            // echo $response;
            // exit;
            if (curl_errno($ch)) {
                // echo 'cURL Error: ' . curl_error($ch);
                return array();
            }

            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($httpStatus >= 200 && $httpStatus < 300) {
                // Successful response
                $decodedResponse = json_decode($response, true);
                // Do something with the decoded response
                // print_r($decodedResponse);
                return $decodedResponse;
            } else {
                // Handle the failure case here
                // echo 'Request failed with HTTP status code: ' . $httpStatus;
                return array();
            }

    }

    public function DeleteEmailCampaignById($campaignId){
        
        // $campaignId = 2; // Your dynamic value here, e.g., received from user input or database

        $apiUrl = 'https://api.brevo.com/v3/emailCampaigns/' . $campaignId;
        $apiKey = $this->myKey;

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE'); // Set request type to DELETE
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array(
            'accept: application/json',
            'api-key: '.$apiKey,
        );

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
            
            if (curl_errno($ch)) {
                //echo 'cURL Error: ' . curl_error($ch);
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to Delete Email Campaign';
            }

            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($httpStatus >= 200 && $httpStatus < 300) {
                // Successful response
                //$decodedResponse = json_decode($response, true);
                // Do something with the decoded response
                //print_r($decodedResponse);
                $resp_data['status'] = '200';
                $resp_data['message'] = 'Email Campaign Deleted Successfully';
            } else {
                // Handle the failure case here
                //echo 'Request failed with HTTP status code: ' . $httpStatus;
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to Delete Email Campaign';
            }

            return $resp_data;
    }

    public function GetWhatsAppTemplatesList(){
        
        $apiUrl = 'https://api.brevo.com/v3/whatsappCampaigns/template-list';
        $apiKey = $this->myKey;
        $limit = 50;
        $offset = 0;
        $sort = 'desc';
        
        $url = $apiUrl . '?limit=' . $limit . '&offset=' . $offset . '&sort=' . $sort;
        
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $headers = array(
            'accept: application/json',
            'api-key: ' . $apiKey,
        );
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        
        $response = curl_exec($ch);
        
        if (curl_errno($ch)) {
            // echo 'cURL Error: ' . curl_error($ch);
            return array();
        }
        
        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        curl_close($ch);
        
        if ($httpStatus >= 200 && $httpStatus < 300) {
            // Successful response
            $decodedResponse = json_decode($response, true);
            // Do something with the decoded response
            // print_r($decodedResponse);
            return $decodedResponse;
        } else {
            // Handle the failure case here
            // echo 'Request failed with HTTP status code: ' . $httpStatus;
            return array();
        }
        
                
    }



    
    public function GetSettings(){
        
        return $this->db->get('digital_marketing_settings')->result_array();
    }

    public function GetSettingsById($id){
        
        return $this->db->where('id',$id)->get('digital_marketing_settings')->result_array();
    }

    public function DeleteSettingsById($id){
        
        if($this->db->where('id',$id)->delete('digital_marketing_settings'))
        {            
            $resp_data['status'] = '200';
            $resp_data['message'] = 'Settings Deleted Successfully';
        } else {
            $resp_data['status'] = '500';
            $resp_data['message'] = 'Unable to Delete Settings';
        }
        return $resp_data;
    }
    public function SettingsSave($post){
        
        $data = array(
            "name" => $post['setting_name'],
            "api_key" => $post['api_key']
        );
        
        $id = $post['setting_id'];

        if(empty($id))
        {
            if ($this->db->insert('digital_marketing_settings',$data)) {
           
                $resp_data['status'] = '200';
                $resp_data['message'] = 'Settings Created Successfully';
            } else {
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to Create Settings';
            }
        }else{
            if ($this->db->where('id',$id)->update('digital_marketing_settings',$data)) {
           
                $resp_data['status'] = '200';
                $resp_data['message'] = 'Settings Updated Successfully';
            } else {
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to Updated Settings';
            }
        } 
        
//exit;
        return $resp_data;
    }


    public function EmailCampaignSave($post){
        
        $campaign_id = $post['campaign_id'];
        if(!empty($campaign_id))
        {
            
            $input_schedule_date  = $post['schedule_date'];
            //$formattedDate = $inputDateTime->format('Y-m-d\TH:i:sP');
            $input_datetime = new DateTime($input_schedule_date);
            $dateTimeObj = new DateTime($input_schedule_date, new DateTimeZone('Asia/Kuala_Lumpur'));

            // Convert to UTC by setting the time zone to UTC
            $dateTimeObj->setTimezone(new DateTimeZone('UTC'));

            // Format the DateTime object to the specified format ('Y-m-d\TH:i:sP')
            $formattedDate = $dateTimeObj->format('Y-m-d\TH:i:sP');

            // $malaysian_timezone = new DateTimeZone('Asia/Kuala_Lumpur');
            // $input_datetime->setTimezone($malaysian_timezone);
            
            // Format the modified datetime to include Malaysian time zone
            // $formattedDate = $input_datetime->format('Y-m-d\TH:i:sP');
            // echo $input_schedule_date."</ br>";
            // echo  $formattedDate; 
            // exit;
            $listIds = array_map('intval', $post['receipents']);


            $apiUrl = 'https://api.brevo.com/v3/emailCampaigns/'.$campaign_id;
            $apiKey = $this->myKey;
            
            $data = array(
                "sender" => array(
                    "name" => $post['sender_name'],
                    "email" =>  $post['sender_email'],
                ),
                "recipients" => array(
                    "listIds" => $listIds
                ),  
                "inlineImageActivation" => false,
                "sendAtBestTime" => false,
                "abTesting" => false,
                "ipWarmupEnable" => false,
                "tag" =>  $post['campaign_name'],
                "name" =>  $post['campaign_tag'],                
                "subject" => $post['subject'],
                "scheduledAt" => $formattedDate,
                "replyTo" => $post['reply_to'],
                "previewText" => $post['email_preview_text'],
            );

                        
            $jsonData = json_encode($data);
            
            $ch = curl_init();
            
            curl_setopt($ch, CURLOPT_URL, $apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
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
                //echo 'cURL Error: ' . curl_error($ch);
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to Update Email Campaign';
            }

            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($httpStatus >= 200 && $httpStatus < 300) {
                // Successful response
                //$decodedResponse = json_decode($response, true);
                // Do something with the decoded response
                //print_r($decodedResponse);
                $resp_data['status'] = '200';
                $resp_data['message'] = 'Email Campaign Update Successfully';
            } else {
                // Handle the failure case here
                //echo 'Request failed with HTTP status code: ' . $httpStatus;
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to Update Email Campaign';
            }
        }else{
        
            
            $input_schedule_date  = $post['schedule_date'];
            //$formattedDate = $inputDateTime->format('Y-m-d\TH:i:sP');
            $input_datetime = new DateTime($input_schedule_date);
            $dateTimeObj = new DateTime($input_schedule_date, new DateTimeZone('Asia/Kuala_Lumpur'));

            // Convert to UTC by setting the time zone to UTC
            $dateTimeObj->setTimezone(new DateTimeZone('UTC'));

            // Format the DateTime object to the specified format ('Y-m-d\TH:i:sP')
            $formattedDate = $dateTimeObj->format('Y-m-d\TH:i:sP');

            // $malaysian_timezone = new DateTimeZone('Asia/Kuala_Lumpur');
            // $input_datetime->setTimezone($malaysian_timezone);
            
            // Format the modified datetime to include Malaysian time zone
            // $formattedDate = $input_datetime->format('Y-m-d\TH:i:sP');
            // echo $input_schedule_date."</ br>";
            // echo  $formattedDate; 
            // exit;
            $listIds = array_map('intval', $post['receipents']);


            $apiUrl = 'https://api.brevo.com/v3/emailCampaigns';
            $apiKey = $this->myKey;
            
            $data = array(
                "sender" => array(
                    "name" => $post['sender_name'],
                    "email" =>  $post['sender_email'],
                ),
                "recipients" => array(
                    "listIds" => $listIds
                ),  
                "inlineImageActivation" => false,
                "sendAtBestTime" => false,
                "abTesting" => false,
                "ipWarmupEnable" => false,
                "tag" =>  $post['campaign_name'],
                "name" =>  $post['campaign_tag'],                
                "subject" => $post['subject'],
                "scheduledAt" => $formattedDate,
                "replyTo" => $post['reply_to'],
                "previewText" => $post['email_preview_text'],
            );

            if(!empty($post['template']))
            {
                $data["templateId"] = (int)$post['template'];
            }else{
                $data["htmlContent"] = $post['message_content'];
            }
            
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
                //echo 'cURL Error: ' . curl_error($ch);
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to Create Email Campaign';
            }

            $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);

            if ($httpStatus >= 200 && $httpStatus < 300) {
                // Successful response
                //$decodedResponse = json_decode($response, true);
                // Do something with the decoded response
                //print_r($decodedResponse);
                $resp_data['status'] = '200';
                $resp_data['message'] = 'Email Campaign Created Successfully';
            } else {
                // Handle the failure case here
                //echo 'Request failed with HTTP status code: ' . $httpStatus;
                $resp_data['status'] = '500';
                $resp_data['message'] = 'Unable to Create Email Campaign';
            }
//exit;
        }
        
        
        return $resp_data;
    }


public function EmailCampaignTemplates(){
        
    $apiUrl = 'https://api.brevo.com/v3/smtp/templates?limit=50&offset=0&sort=desc';
    $apiKey = $this->myKey;

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);            
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $headers = array(
        'accept: application/json',
        'api-key: ' . $apiKey
    );

    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        // echo 'cURL Error: ' . curl_error($ch);
        return array();
    }

    $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($httpStatus >= 200 && $httpStatus < 300) {
        // Successful response
        $decodedResponse = json_decode($response, true);
        // Do something with the decoded response (e.g., print the data)
        return $decodedResponse;
    } else {
        // Handle the failure case here
        // echo 'Request failed with HTTP status code: ' . $httpStatus;
        return array();
    }

}

}
