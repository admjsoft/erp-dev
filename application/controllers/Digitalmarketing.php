<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Digitalmarketing extends CI_Controller
{

   public function __construct()
    {
        parent::__construct();
        $this->load->model('customers_model', 'customers');
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
            $ids = explode(',',$ids);            
            $recipients = $this->customers->recipients($ids);

            $n_data = array();
            $nn_data = array();
            foreach($recipients as $rec){
                $n_data['name'] = $rec['name'];
                $n_data['email'] = $rec['email'];
                $nn_data[] = $n_data;
            }

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
        if (!$this->aauth->premission(8)) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }

        if ($this->input->post('cust')) {
            $ids = $this->input->post('cust');
            $message = $this->input->post('message', true);
            $recipients = $this->customers->recipients($ids);
            $this->config->load('sms');
            $this->load->model('sms_model');
            foreach ($recipients as $row) {

                $this->sms_model->send_sms($row['phone'], $message);

            }
        }
    }

}
