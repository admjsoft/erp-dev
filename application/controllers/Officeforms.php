<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Officeforms extends CI_Controller
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
       
        $this->load->model('officeforms_model');
        $this->load->helper(array('form', 'url'));
        $this->li_a = 'Office forms';
        $c_module = 'office forms';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);

    }

    public function index()
    {
        $data['office_forms'] = $this->officeforms_model->get_all_office_forms();
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Office Forms';
        $this->load->view('fixed/header', $head);
        $this->load->view('office_forms/list', $data);
        $this->load->view('fixed/footer');
    }

    public function view($of_id)
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'View Office Form';
        $data = array();
       
    
        // Load the contract details from the contract_model
        $office_form = $this->officeforms_model->get_office_from_by_id($of_id);
    
        if ($office_form) {

            $data['office_form'] = $office_form;
            
            $this->load->view('fixed/header', $head);
            $this->load->view('office_forms/view', $data);
            $this->load->view('fixed/footer');
        } else {
            // Handle contract not found error
            echo "Office Form not found.";
        }
    }


    public function edit($ds_id)
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Edit Digital Signature Document';
        $data = array();
       
    
        // Load the contract details from the contract_model
        $digital_signature = $this->digitalsignature_model->get_digital_signature_by_id($ds_id);
    
        if ($digital_signature) {
            // Load the associated upload files from the uploads_model
            // $upload_files = $this->uploads_model->get_upload_files_by_contract_id($contract_id);
    
            // Load the view to display contract details and upload files
            $data['digital_signatures'] = $digital_signature;
            $data['signings'] = $this->db->where('ds_id',$ds_id)->get('gtg_digital_signature_signings')->result_array();
            $data['ds_signings'] = $this->db->where('ds_id',$ds_id)->order_by('signed_date','DESC')->get('gtg_digital_signature_signings')->result_array();        

            $this->load->view('fixed/header', $head);
            $this->load->view('digital_signature/edit', $data);
            $this->load->view('fixed/footer');
        } else {
            // Handle contract not found error
            echo "Digital Signature not found.";
        }
    }



    public function create()
    {
       
            // AJAX request, handle form submission

            // Set up form validation rules
           
            $this->form_validation->set_rules('form_name', 'Form Name', 'required');
            

            if ($this->form_validation->run() === FALSE) {
                // Validation failed, return validation errors
                $response['validation_errors'] = validation_errors();
                $response['success'] = false;
            } else {

                
                // Form validation passed, continue with contract creation
                $of_data = array(
                    'form_name' => $this->input->post('form_name'),
                    'status' => 1
                );

                $uploaded_files = array();
                
                if (!empty($_FILES)) {
                    // Specify the allowed file types
                    $allowed_types = array('pdf');
                
                    // Array to store uploaded files
                    $uploaded_files = array();
                
                    // Only handle the first file if multiple files are submitted
                    $filename = $_FILES['userfile']['name'];
                    $file_type = $_FILES['userfile']['type'];
                    $file_tmp = $_FILES['userfile']['tmp_name'];
                    $file_size = $_FILES['userfile']['size'];
                
                    $file_name = explode('.', $filename);
                    $media_type = end($file_name);
                
                    if (!empty($file_name)) {
                        $config['file_name'] = preg_replace('/\s+/', '_', $file_name[0] . strtotime("now") . "." . $media_type);
                    }
                
                    $config['allowed_types'] = implode('|', $allowed_types);
                    $config['upload_path'] = './userfiles/office_docs'; // The upload directory
                
                    $this->load->library('upload', $config);
                
                    if ($this->upload->do_upload('userfile')) {
                        $name = preg_replace('/\s+/', '_', $file_name[0] . strtotime("now") . "." . $media_type);
                        $file_path = base_url() . 'userfiles/office_docs/' . $name;
                
                        $data = $this->upload->data();
                
                        $of_data['form_url'] = $file_path;
                
                        //$uploaded_files[] = $file_details;
                        //echo "<pre>"; print_r($uploaded_files); echo "</pre>";
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        //echo "<pre>"; print_r($error); echo "</pre>";
                        $this->load->view('upload_form', $error);
                    }
                }
                


                $of_id = $this->officeforms_model->add_office_form($of_data);
                //$this->db->insert('gtg_digital_signatures', $ds_data);
                if ($of_id) {


                    $response['success'] = true;
                    $response['redirect_url'] = site_url('officeforms/view/' . $of_id);
                    $this->session->set_flashdata('SuccessMsg', 'Office Form Uploaded Successfully!..');
                } else {
                    // Handle database insertion error
                    $response['success'] = false;
                    $response['error_message'] = 'Error Uploadng the Form. Please try again.';
                    $this->session->set_flashdata('ErrorMsg', 'Office Form Upload Failed!..');
                }
            }

            echo json_encode($response);
            
    }
    
       
    public function delete()
    {
        $of_id = $this->input->post('deleteid');
        $this->officeforms_model->delete_office_form($of_id);
        //redirect('contract');
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Office Form DELETED')));
    }

    public function edit_digital_signature(){

        $ds_id = $this->input->post('ds_id');

        $digital_signature = $this->digitalsignature_model->get_digital_signature_by_id($ds_id);
      

        $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
        $config['upload_path'] = './userfiles/ds_docs';

        $file_name = explode('.',$_FILES['pdfData']['name']);
        $media_type = $file_name[1];
        if(!empty($file_name))
        {
            
            $config['file_name'] = preg_replace('/\s+/', '_', $file_name[0].strtotime("now").".".$file_name[1]);
        }
        

        $this->load->library('upload', $config);

        // Check if the file is uploaded successfully
        if ($this->upload->do_upload('pdfData')) {
            $file_data = $this->upload->data();
            
            // Access other form data
            $ds_id = $this->input->post('ds_id');
            $name = preg_replace('/\s+/', '_', $file_name[0].strtotime("now").".".$file_name[1]);
            $file_path = base_url().'userfiles/ds_docs/'.$name;


            $data = array(
                'file_name' => $file_data['file_name'],
                'file_type' => $file_data['file_type'],
                'file_size' => $file_data['file_size'],
                'file_path' => $file_path
            );

           
        } else {
            // Handle upload errors
            // $error_message = $this->upload->display_errors();
            // echo "File Upload Error: " . $error_message;
            $response['status'] = 500;
            $response['message'] = "File Upload Error";
                
            echo json_encode($response);
        }
 
        $data['status'] = 'PENDING';       

        // Send the email
        if ($this->db->where('id',$ds_id)->update('gtg_digital_signatures',$data)) {

                $this->db->delete('gtg_digital_signature_signings', array('ds_id' => $ds_id));
                // saving document to client docs
                $response['status'] = 200;
                $response['message'] = "Digtial Signing Details Saved Successfully";
                $this->session->set_flashdata('SuccessMsg', 'Digital Signature Document Updated Successfully!..');
                

        } else {
            
                $response['status'] = 200;
                $response['message'] = "Digtial Signing Details Saving Failed";
                $this->session->set_flashdata('ErrorMsg', 'Digital Signature Document Update Failed!..');
             
        }

        echo json_encode($response);



    }

    public function download_office_form($ds_id)
    {
        

        
        $office_form = $this->officeforms_model->get_office_from_by_id($ds_id);
        $file_path = $office_form['form_url'];
        $filePath = FCPATH . 'userfiles/employee/Employee-Management-Template.xlsx';

        // Check if the file exists
        if (file_exists($filePath)) {
            // Load the download helper
            $this->load->helper('download');

            // Force download the file
            force_download($file_path, file_get_contents($filePath));
        } else {
            redirect('officeforms');
        }

    }
   
}