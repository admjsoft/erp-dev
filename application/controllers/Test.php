<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct()
    {
       parent::__construct();
        $this->load->library("Custom");
        $this->load->library('pdf');

    }


    public function index() {
        // // Replace this with the URL of the XML file
        // $xmlUrl = 'https://dj-temp.s3.eu-west-1.amazonaws.com/887c10443bfc285600aa9584899406a3b9ab85355dc7914107e7d636f530434835d706908ea31ee88cbb65d8697debf1ad91a20d21012322390e394f90ba42ec?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIAI5G5MTYS7SBP4ZEQ%2F20230723%2Feu-west-1%2Fs3%2Faws4_request&X-Amz-Date=20230723T091351Z&X-Amz-Expires=604800&X-Amz-SignedHeaders=host&X-Amz-Signature=9839a7cb26543e11fb1eb91c7e46f9adaa5e8a69e9d2caf0c7b70d0c409fafe7';

        // // Fetch the XML data from the URL
        // $xmlData = file_get_contents($xmlUrl);

        // $this->generatePdfFromXml($xmlData);
        echo date_default_timezone_get();
    }

    private function generatePdfFromXml($xmlData) {
        // Create an HTML template to format the XML data (customize as needed)
        $html = '<!DOCTYPE html>';
        $html .= '<html>';
        $html .= '<head>';
        $html .= '<title>XML to PDF</title>';
        $html .= '</head>';
        $html .= '<body>';
        $html .= '<h1>XML Data to PDF</h1>';
        $html .= '<pre>' . htmlentities($xmlData) . '</pre>'; // Display the raw XML data for demonstration
        $html .= '</body>';
        $html .= '</html>';

        // Create an mPDF instance
        // $mpdf = new Mpdf();
        $mpdf = $this->pdf->load_en();
        // Load HTML content into mPDF
        $mpdf->WriteHTML($html);

        // Output the PDF to the browser or save to a file
        $mpdf->Output('xml_to_pdf_output.pdf', 'D'); // 'D' to download the PDF, 'I' to display in the browser

        // If you want to save the PDF to a file instead, use:
        // $mpdf->Output('path/to/save/xml_to_pdf_output.pdf', 'F');
    }

    public function one(){
        $mobile = '9182288185';
        $otp = '1234';
        $reciepts_array = array( array("mobiles" => "91".$mobile,"otp" => $otp) );
        $post_fields = json_encode(array('flow_id' => '6047098578a9a87f63337cfd','recipients' => $reciepts_array,'sender' => 'DEEASE'),JSON_UNESCAPED_SLASHES);
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.msg91.com/api/v5/flow",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST, false,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>  $post_fields,
            CURLOPT_HTTPHEADER => array( "authkey: 229148AeEOf2XBU1sv5b605b34","content-type: application/json"),
        ));
        curl_exec($curl);
        $err = curl_error($curl);
        echo $err;
        curl_close($curl);
        return ( $err )?false:true;
    }
}