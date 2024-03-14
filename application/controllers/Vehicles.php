<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vehicles extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }

        // if (!$this->aauth->premission(5)) {

        //     exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        // }
        $this->load->library('form_validation');
        $this->load->model('vehicle_model');
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->li_a = 'vehicles';
        $c_module = 'vehicles';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);

    }

    public function index()
    {
        $data['vehicles'] = $this->vehicle_model->get_all_vehicles();
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Vehicles';
        $this->load->view('fixed/header', $head);
        $this->load->view('vehicles/list', $data);
        $this->load->view('fixed/footer');
    }

    // Contract.php
    public function create()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Add Vehicle';

       
        if ($this->input->is_ajax_request()) {

            // echo "<pre>"; print_r($_FILES); echo "</pre>";
            // echo "<pre>"; print_r($_POST); echo "</pre>";
            // exit;
        
            
            // AJAX request, handle form submission

            // Set up form validation rules
            $this->form_validation->set_rules('registrationNo', 'Registration No', 'required');
            $this->form_validation->set_rules('vinNo', 'VIN No', 'required');
            $this->form_validation->set_rules('fuelType', 'Fuel Type', 'required');
            $this->form_validation->set_rules('manufactureYear', 'Manufacture Year', 'required');
            $this->form_validation->set_rules('make', 'Make', 'required');
            $this->form_validation->set_rules('model', 'Model', 'required');
            $this->form_validation->set_rules('color', 'Color', 'required');
            // $this->form_validation->set_rules('emp_id', 'Employee', 'required');
            

            if ($this->form_validation->run() === FALSE) {
                // Validation failed, return validation errors
                $response['validation_errors'] = validation_errors();
                $response['success'] = false;
            } else {

              
                
                // Form validation passed, continue with contract creation
                $vehicle_data = array(
                    'registration_number' => $this->input->post('registrationNo'),
                    'vin' => $this->input->post('vinNo'),
                    'fuel_type' => $this->input->post('fuelType'),
                    'year_of_manufacture' => $this->input->post('manufactureYear'),
                    'model' => $this->input->post('model'),
                    'make' => $this->input->post('make'),
                    'color' => $this->input->post('color'),
                    'emp_id' => $this->input->post('emp_id')
                );

               
                
                $vehicle_id = $this->vehicle_model->add_vehicle($vehicle_data);


                if ($vehicle_id) {


                    
                    // Data inserted successfully, return success response
                    $response['success'] = true;
                    $response['redirect_url'] = site_url('vehicles/view/' . $vehicle_id);
                    $this->session->set_flashdata('SuccessMsg', 'Vehicle Details Created Successfully!.. you can check form List');
                    
                } else {
                    // Handle database insertion error
                    $response['success'] = false;
                    $response['error_message'] = 'Error creating the Vehicle Details. Please try again.';
                    $this->session->set_flashdata('ErrorMsg', 'Vehicle Details Creating Failed!..');
                    
                }
            }

            
            // Send the JSON response back to the client
            header('Content-Type: application/json');
            echo json_encode($response);
            } else {
                // Regular form submission, load the view
                $data['drivers'] = $this->vehicle_model->get_drivers_based_on_user_role();
                $this->load->view('fixed/header', $head);
                $this->load->view('vehicles/create',$data);
                $this->load->view('fixed/footer');
            }
    }

    
    public function delete()
    {
        $vehicle_id = $this->input->post('deleteid');
        $this->vehicle_model->delete_vehicle($vehicle_id);
        //redirect('contract');
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('CONTRACT DELETED')));
    }

    public function view($vehicle_id)
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'View Vehicle';
    
        // Load the contract details from the contract_model
        $data['vehicle'] = $this->vehicle_model->get_vehicle_by_id($vehicle_id);
    
        if ($data['vehicle']) {
            // Load the associated upload files from the uploads_model
            $this->load->view('fixed/header', $head);
            $this->load->view('vehicles/view', $data);
            $this->load->view('fixed/footer');
        } else {
            // Handle contract not found error
            echo "Contract not found.";
        }
    }
    

    public function edit($vehicle_id = '')
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Edit Contract';
// echo $vehicle_id;
// exit;
        // Handle form submission
        if (empty($vehicle_id)) {
            
            // echo "ssssss";
            // exit;
            $vehicle_data = array(
                'registration_number' => $this->input->post('registrationNo'),
                'vin' => $this->input->post('vinNo'),
                'fuel_type' => $this->input->post('fuelType'),
                'year_of_manufacture' => $this->input->post('manufactureYear'),
                'model' => $this->input->post('model'),
                'make' => $this->input->post('make'),
                'color' => $this->input->post('color'),
                'emp_id' => $this->input->post('emp_id')
                
            );

            $vehicle_id = $this->input->post('id');
            $v_update_status = $this->vehicle_model->update_vehicle($vehicle_id, $vehicle_data);
           
            if ($v_update_status) {

                // Data inserted successfully, return success response
                $response['success'] = true;
                $response['redirect_url'] = site_url('vehicles/view/' . $vehicle_id);
                $this->session->set_flashdata('SuccessMsg', 'Vehicle Details Updated Successfully!.. you can check form List');
                
            } else {
                // Handle database insertion error
                $response['success'] = false;
                $response['error_message'] = 'Error creating the Vehicle Details. Please try again.';
                $this->session->set_flashdata('ErrorMsg', 'Vehicle Details Updating Failed!..');
                
            }
            
            // Send the JSON response back to the client
            header('Content-Type: application/json');
            echo json_encode($response);

        } else {
            $head['usernm'] = $this->aauth->get_user()->username;
            $head['title'] = 'Edit Vehicle';
            $data['drivers'] = $this->vehicle_model->get_drivers_based_on_user_role();
            $data['vehicle'] = $this->vehicle_model->get_vehicle_by_id($vehicle_id);
            // Load the contract details from the contract_model
        
            
            $this->load->view('fixed/header', $head);
            $this->load->view('vehicles/edit', $data);
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

    public function vehicles_list()
    {

        $list = $this->vehicle_model->get_all_vehicles();
        $html = '';
        foreach ($list as $item) {
            $html .= '<option value="' . $item['id'] . '">' . $item['vin'] . '</option>';
        }
        echo $html;
    }
}