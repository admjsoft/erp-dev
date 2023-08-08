<?php


defined('BASEPATH') or exit('No direct script access allowed');

class DigitalMarketing_model extends CI_Model
{


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
        $headers = array(
            'accept: application/json',
            'api-key: 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'
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
            $apiKey = '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';

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
        $apiKey = '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';
        
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
        
        $apiUrl = 'https://api.brevo.com/v3/smsCampaigns';
        $apiKey = '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';

        $inputDateTime = new DateTime($post['schedule_date']);
        $formattedDate = $inputDateTime->format('Y-m-d\TH:i:sP');

       
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
        return $resp_data;
    }



    public function GetSmsCampaignsList(){
        

            $apiUrl = 'https://api.brevo.com/v3/smsCampaigns';
            $apiKey = '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';

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

    public function GetSmsCampaignById($campaignId){
        

            // $campaignId = 2; // Your dynamic value here, e.g., received from user input or database

            $apiUrl = 'https://api.brevo.com/v3/smsCampaigns/' . $campaignId;
            $apiKey = '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';

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
        $apiKey = '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';

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
            $resp_data['status'] = '500';
            $resp_data['message'] = 'Unable to Delete Sms Campaign';
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
            $resp_data['status'] = '500';
            $resp_data['message'] = 'Unable to Delete Sms Campaign';
        }
        return $resp_data;
    }

    public function GetSmsCampaignsListIds(){
        
        $apiUrl = 'https://api.brevo.com/v3/contacts/lists';
        $apiKey = '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';
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
        
        
        $apiUrl = 'https://api.brevo.com/v3/whatsappCampaigns';
        $apiKey = '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';

        // /$datetime = new DateTime($post['schedule_date']);
        $inputDateTime = new DateTime($post['schedule_date']);
        $formattedDate = $inputDateTime->format('Y-m-d\TH:i:sP');

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

        return $resp_data;
    }   

    public function GetEmailCampaignsList(){
        
        $apiUrl = 'https://api.brevo.com/v3/emailCampaigns';
        $apiKey = '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';
        
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

            $apiUrl = 'https://api.brevo.com/v3/whatsappCampaigns/' . $campaignId;
            $apiKey = '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';

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

    public function DeleteEmailCampaignById($campaignId){
        
        // $campaignId = 2; // Your dynamic value here, e.g., received from user input or database

        $apiUrl = 'https://api.brevo.com/v3/emailCampaigns/' . $campaignId;
        $apiKey = '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';

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
           return false;
        }

        $httpStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

    
        if ($httpStatus >= 200 && $httpStatus < 300) {
            // Successful response
            // echo 'Campaign with ID ' . $campaignId . ' deleted successfully.';
            return true;
        } else {
            // Handle the failure case here
            // echo 'Request failed with HTTP status code: ' . $httpStatus;
            return false;
        }
    }

    public function GetWhatsAppTemplatesList(){
        
        $apiUrl = 'https://api.brevo.com/v3/whatsappCampaigns/template-list';
        $apiKey = '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';
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


}
