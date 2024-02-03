<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Contract extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        // if (!$this->aauth->premission(5)) {

        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->model('contract_model');
        $this->load->model('uploads_model');
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->li_a = 'contract';
        $c_module = 'contract';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);

    }

    public function index()
    {
        $data['contract'] = $this->contract_model->get_all_contracts();
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Contract';
        $this->load->view('fixed/header', $head);
        $this->load->view('contract/list', $data);
        $this->load->view('fixed/footer');
    }

    // Contract.php
    public function create()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Add Contract';

       
        if ($this->input->is_ajax_request()) {

            // echo "<pre>"; print_r($_FILES); echo "</pre>";
            // echo "<pre>"; print_r($_POST); echo "</pre>";
            // exit;
        
            
            // AJAX request, handle form submission

            // Set up form validation rules
            $this->form_validation->set_rules('contract_name', 'Contract Name', 'required');
            $this->form_validation->set_rules('start_date', 'Start Date', 'required|regex_match[/^\d{4}-\d{2}-\d{2}$/]');
            $this->form_validation->set_rules('end_date', 'End Date', 'required|regex_match[/^\d{4}-\d{2}-\d{2}$/]');
            $this->form_validation->set_rules('client_name', 'Client Name', 'required');
            $this->form_validation->set_rules('person_in_charge', 'Person In Charge', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('phone', 'Phone', 'required|regex_match[/^[0-9+\-() ]+$/]');
            $this->form_validation->set_rules('reminder_date', 'Reminder Date', 'required|callback_check_date');
            $this->form_validation->set_rules('remarks', 'Remarks', 'required');
            $this->form_validation->set_rules('sharing_count', 'Sharing People', 'required');
            

            if ($this->form_validation->run() === FALSE) {
                // Validation failed, return validation errors
                $response['validation_errors'] = validation_errors();
                $response['success'] = false;
            } else {

                $numbers = '0123456789';
                $randomString = '';
                $length = 5;
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $numbers[rand(0, strlen($numbers) - 1)];
                }

                $contract_unique_id = "CON".$randomString;
                
                // Form validation passed, continue with contract creation
                $contract_data = array(
                    'name' => $this->input->post('contract_name'),
                    'start_date' => $this->input->post('start_date'),
                    'end_date' => $this->input->post('end_date'),
                    'client_name' => $this->input->post('client_name'),
                    'pic' => $this->input->post('person_in_charge'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'reminder_date' => $this->input->post('reminder_date'),
                    'remarks' => $this->input->post('remarks'),
                    'contract_unique_id' => $contract_unique_id,
                    'client_id' => $this->input->post('contract_customer_id'),
                    'status' => 'PENDING',
                    'updated_on' => date('Y-m-d H:i:s'),
                    'sharing_count' => $this->input->post('sharing_count')
                );

                $uploaded_files = array();
                
                $contract_id = $this->contract_model->add_contract($contract_data);

                $validtoken = hash_hmac('ripemd160', $contract_id, $this->config->item('encryption_key'));
                $link = base_url('billing/contract_share_view?id=' . $contract_id . '&token=' . $validtoken);

                $sh_data['share_link'] = $link;
                $this->db->where('id',$contract_id)->update('gtg_contract',$sh_data);

                // echo $this->db->last_query();
                // exit;
                if(!empty($_FILES))
                {
                        // Specify the allowed file types
                       

                        
                        // Array to store uploaded files
                        $uploaded_files = array();
                    
                        foreach ($_FILES['contract_files']['name'] as $key => $filename) {
                            $_FILES['userfile']['name'] = $_FILES['contract_files']['name'][$key];
                            $_FILES['userfile']['type'] = $_FILES['contract_files']['type'][$key];
                            $_FILES['userfile']['tmp_name'] = $_FILES['contract_files']['tmp_name'][$key];
                            $_FILES['userfile']['error'] = $_FILES['contract_files']['error'][$key];
                            $_FILES['userfile']['size'] = $_FILES['contract_files']['size'][$key];


                            $file_name = explode('.',$_FILES['contract_files']['name'][$key]);
                            $media_type = $file_name[1];
                            if(!empty($file_name))
                            {
                                
                                    $config['file_name'] = preg_replace('/\s+/', '_', $file_name[0].strtotime("now").".".$file_name[1]);
                            }
                            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
                            $config['upload_path'] = './userfiles/contract_docs'; // The upload directory
                            
                        

                            $this->load->library('upload', $config);
                    
                            if ($this->upload->do_upload('userfile')) {

                                $name = preg_replace('/\s+/', '_', $file_name[0].strtotime("now").".".$file_name[1]);
                                $file_path = base_url().'userfiles/contract_docs/'.$name;

                                $data = $this->upload->data();
                                $file_details = array(
                                    'file_name' => $data['file_name'],
                                    'file_type' => $data['file_type'],
                                    'file_size' => $data['file_size'],
                                    'upload_date' => date('Y-m-d H:i:s'),
                                    'file_path' => $file_path,
                                    'contract_id' => $contract_id
                                );
                                $uploaded_files[] = $file_details;
                                //echo "<pre>"; print_r($uploaded_files); echo "</pre>";
                            } else {
                                $error = array('error' => $this->upload->display_errors());
                                //echo "<pre>"; print_r($error); echo "</pre>";
                                $this->load->view('upload_form', $error);
                            }
                        }
                    
                        // Store uploaded file details in the database
                        //$this->UploadModel->batch_insert($uploaded_files);
                    
                        // Redirect to a success page or display a success message
                        //$this->load->view('upload_success', $uploaded_files);
                    
                    
                }

                if (!empty($uploaded_files)) {
                    // Insert uploaded file data into the database
                    $this->db->insert_batch('gtg_uploads', $uploaded_files);
                }

                    //$this->uploads_model->do_upload($_FILES,1);
            //    / }
           // echo "<pre>"; print_r($error); echo "</pre>";
            //     echo "<pre>"; print_r($uploaded_files); echo "</pre>";
            //   exit;

                //$contract_id = $this->contract_model->add_contract($contract_data);

                if ($contract_id) {


                    
                    // Data inserted successfully, return success response
                    $response['success'] = true;
                    $response['redirect_url'] = site_url('contract/view/' . $contract_id);
                    $this->session->set_flashdata('SuccessMsg', 'Contract Created Successfully!.. you can check form List');
                    
                } else {
                    // Handle database insertion error
                    $response['success'] = false;
                    $response['error_message'] = 'Error creating the contract. Please try again.';
                    $this->session->set_flashdata('ErrorMsg', 'Contract Creating Failed!..');
                    
                }
            }

            
            // Send the JSON response back to the client
            header('Content-Type: application/json');
            echo json_encode($response);
            } else {
                // Regular form submission, load the view
                $this->load->view('fixed/header', $head);
                $this->load->view('contract/create');
                $this->load->view('fixed/footer');
            }
    }

    private function process_files($data) {
        $uploaded_files = array();

        foreach ($data as $file) {
            $file_details = array(
                'file_name' => $file['file_name'],
                'file_type' => $file['file_type'],
                'file_size' => $file['file_size'],
                'upload_date' => date('Y-m-d H:i:s'),
            );
            $uploaded_files[] = $file_details;
        }

        return $uploaded_files;
    }

    public function check_date($date) {
        // Custom validation callback to check if reminder_date is within start_date and end_date
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');

        if ($date >= $start_date && $date <= $end_date) {
            return true;
        } else {
            $this->form_validation->set_message('check_date', 'The Reminder Date must be between Start Date and End Date.');
            return false;
        }
    }    

    
    public function delete()
    {
        $contract_id = $this->input->post('deleteid');
        $this->contract_model->delete_contract($contract_id);
        //redirect('contract');
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('CONTRACT DELETED')));
    }

    public function view($contract_id)
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'View Contract';
    
        // Load the contract details from the contract_model
        $contract = $this->contract_model->get_contract_by_id($contract_id);
    
        if ($contract) {
            // Load the associated upload files from the uploads_model
            $upload_files = $this->uploads_model->get_upload_files_by_contract_id($contract_id);
    
            // Load the view to display contract details and upload files
            $data = array(
                'contract' => $contract,
                'upload_files' => $upload_files
            );

            $data['signings'] = $this->db->where('contract_id',$contract_id)->get('gtg_contract_signings')->result_array();
            $data['contract_signings'] = $this->db->where('contract_id',$contract_id)->order_by('signed_date','DESC')->get('gtg_contract_signings')->result_array();        

            $this->load->view('fixed/header', $head);
            $this->load->view('contract/view', $data);
            $this->load->view('fixed/footer');
        } else {
            // Handle contract not found error
            echo "Contract not found.";
        }
    }
    

    public function edit($contract_id)
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'View Contract';

        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            

            $contract_data = array(
                'name' => $this->input->post('contract_name'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'client_name' => $this->input->post('client_name'),
                'pic' => $this->input->post('person_in_charge'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'reminder_date' => $this->input->post('reminder_date'),
                'remarks' => $this->input->post('remarks'),
                'client_id' => $this->input->post('contract_customer_id'),
                'status' => 'PENDING',
                'updated_on' => date('Y-m-d H:i:s'),
                'sharing_count' => $this->input->post('sharing_count')
            );

            $this->contract_model->update_contract($contract_id, $contract_data);
            $this->session->set_flashdata('SuccessMsg', 'Contract Updated Successfully!..');
            redirect('contract');
            $this->load->view('fixed/header', $head);
            $this->load->view('contract/view', $data);
            $this->load->view('fixed/footer');
        } else {
            // Get contract details including uploads
            $data['contract'] = $this->contract_model->get_contract_by_id($contract_id);
            $data['upload_files'] = $this->uploads_model->get_upload_files_by_contract_id($contract_id);
            $data['contract_signings'] = $this->db->where('contract_id',$contract_id)->order_by('signed_date','DESC')->get('gtg_contract_signings')->result_array();        

            
            $this->load->view('fixed/header', $head);
            $this->load->view('contract/edit', $data);
            $this->load->view('fixed/footer');
        }
    }

    public function share($contract_id) {
        // Load contract details based on $contract_id from your model
        
        // Generate a unique contract link
        $contract_link = base_url("contract/view/{$contract_id}");

        // Load the contract view with sharing options
        $data = array(
            'contract_link' => $contract_link
        );
        $this->load->view('contract/share', $data);
    }

    public function sendContractEmail() {
        // Get recipient email and contract link from the POST data
        $recipient_email = $this->input->post('recipient_email');
        $contract_link = $this->input->post('contract_link');

        // Prepare the email
        $this->email->from('your_email@example.com', 'Your Name');
        $this->email->to($recipient_email);
        $this->email->subject('Sign the Contract');
        $this->email->message('Please sign the contract by clicking on this link: ' . $contract_link);

        // Send the email
        if ($this->email->send()) {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }

        echo json_encode($response);
    }


   


    

    public function change_status(){

        $contract_id = $this->input->post('contract_id');
        
        $data['status'] = 'INPROGRESS';       

        
            if ($this->db->where('id',$contract_id)->update('gtg_contract',$data)) {
            
                $response['status'] = 200;
                $response['message'] = "Contract Signing Details Saved Successfully";
                
            } else {
                
                $response['status'] = 200;
                $response['message'] = "Contract Signing Details Saving Failed";

            }

    
        echo json_encode($response);

    }
}