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

            if ($this->form_validation->run() === FALSE) {
                // Validation failed, return validation errors
                $response['validation_errors'] = validation_errors();
                $response['success'] = false;
            } else {
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
                    'updated_on' => date('Y-m-d H:i:s')
                );

                $contract_id = $this->contract_model->add_contract($contract_data);

                if ($contract_id) {
                    // Data inserted successfully, return success response
                    $response['success'] = true;
                    $response['redirect_url'] = site_url('contract/view/' . $contract_id);
                } else {
                    // Handle database insertion error
                    $response['success'] = false;
                    $response['error_message'] = 'Error creating the contract. Please try again.';
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

    
    public function delete($contract_id)
    {
        $this->contract_model->delete_contract($contract_id);
        redirect('contract');
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
                'name' => $this->input->post('name'),
                'start_date' => $this->input->post('start_date'),
                'end_date' => $this->input->post('end_date'),
                'client_name' => $this->input->post('client_name'),
                'pic' => $this->input->post('pic'),
                'email' => $this->input->post('email'),
                'phone' => $this->input->post('phone'),
                'reminder_date' => $this->input->post('reminder_date'),
                'remarks' => $this->input->post('remarks'),
                'updated_on' => date('Y-m-d H:i:s')
            );

            $this->contract_model->update_contract($contract_id, $contract_data);
            redirect('contract');
            $this->load->view('fixed/header', $head);
            $this->load->view('contract/view', $data);
            $this->load->view('fixed/footer');
        } else {
            // Get contract details including uploads
            $data['contract'] = $this->contract_model->get_contract_by_id($contract_id);
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
}