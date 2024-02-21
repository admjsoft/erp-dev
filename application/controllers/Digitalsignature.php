<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Digitalsignature extends CI_Controller
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
        $this->load->model('digitalsignature_model');
        $this->load->model('uploads_model');
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->li_a = 'digital signature';
        $c_module = 'digital signature';
        // Make the variable available to all views
        $this->load->vars('c_module', $c_module);

    }

    public function index()
    {
        $data['digital_signatures'] = $this->digitalsignature_model->get_all_digital_signatures();
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Digital Signature';
        $this->load->view('fixed/header', $head);
        $this->load->view('digital_signature/list', $data);
        $this->load->view('fixed/footer');
    }

    public function view($ds_id)
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'View Digital Signature Document';
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
            $this->load->view('digital_signature/view', $data);
            $this->load->view('fixed/footer');
        } else {
            // Handle contract not found error
            echo "Digital Signature not found.";
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

                $ds_unique_id = "DS".$randomString;
                
                // Form validation passed, continue with contract creation
                $ds_data = array(
                    'sharing_count' => $this->input->post('sharing_count'),
                    'ds_unique_id' => $ds_unique_id,
                    'status' => 'PENDING'
                );

                $uploaded_files = array();
                
                //$contract_id = $this->contract_model->add_contract($contract_data);

                // $validtoken = hash_hmac('ripemd160', $contract_id, $this->config->item('encryption_key'));
                // $link = base_url('billing/contract_share_view?id=' . $contract_id . '&token=' . $validtoken);

                // $sh_data['share_link'] = $link;
                // $this->db->where('id',$contract_id)->update('gtg_contract',$sh_data);

                // echo $this->db->last_query();
                // exit;
                if (!empty($_FILES)) {
                    // Specify the allowed file types
                    $allowed_types = array('jpg', 'jpeg', 'png', 'gif', 'pdf');
                
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
                    $config['upload_path'] = './userfiles/ds_docs'; // The upload directory
                
                    $this->load->library('upload', $config);
                
                    if ($this->upload->do_upload('userfile')) {
                        $name = preg_replace('/\s+/', '_', $file_name[0] . strtotime("now") . "." . $media_type);
                        $file_path = base_url() . 'userfiles/ds_docs/' . $name;
                
                        $data = $this->upload->data();
                
                        $ds_data['file_name'] = $data['file_name'];
                        $ds_data['file_type'] = $data['file_type'];
                        $ds_data['file_size'] = $data['file_size'];
                        $ds_data['file_path'] = $file_path;
                
                        //$uploaded_files[] = $file_details;
                        //echo "<pre>"; print_r($uploaded_files); echo "</pre>";
                    } else {
                        $error = array('error' => $this->upload->display_errors());
                        //echo "<pre>"; print_r($error); echo "</pre>";
                        $this->load->view('upload_form', $error);
                    }
                
                    // Store uploaded file details in the database
                    //$this->UploadModel->batch_insert($uploaded_files);
                
                    // Redirect to a success page or display a success message
                    //$this->load->view('upload_success', $uploaded_files);
                }
                

                //if (!empty($uploaded_files)) {
                    // Insert uploaded file data into the database
                //    / $this->db->insert('gtg_digital_signatures', $ds_data);
                //}

                    //$this->uploads_model->do_upload($_FILES,1);
            //    / }
           // echo "<pre>"; print_r($error); echo "</pre>";
            //     echo "<pre>"; print_r($uploaded_files); echo "</pre>";
            //   exit;

                $ds_id = $this->digitalsignature_model->add_digital_signature($ds_data);
                //$this->db->insert('gtg_digital_signatures', $ds_data);
                if ($ds_id) {


                    $validtoken = hash_hmac('ripemd160', $ds_id, $this->config->item('encryption_key'));
                    $link = base_url('billing/digital_signature_share_view?id=' . $ds_id . '&token=' . $validtoken);
    
                    $sh_data['share_link'] = $link;
                    $this->db->where('id',$ds_id)->update('gtg_digital_signatures',$sh_data);
    
                    
                    // Data inserted successfully, return success response
                    $response['success'] = true;
                    $response['redirect_url'] = site_url('digitalsignature/view/' . $ds_id);
                    $this->session->set_flashdata('SuccessMsg', 'Digital Signature Document Uploaded Successfully!..');
                } else {
                    // Handle database insertion error
                    $response['success'] = false;
                    $response['error_message'] = 'Error creating the contract. Please try again.';
                    $this->session->set_flashdata('ErrorMsg', 'Digital Signature Document Upload Failed!..');
                }
            }

            
            // Send the JSON response back to the client
            header('Content-Type: application/json');
            echo json_encode($response);
            
    }
    
       
    public function delete()
    {
        $ds_id = $this->input->post('deleteid');
        $this->digitalsignature_model->delete_digital_signature($ds_id);
        //redirect('contract');
        echo json_encode(array('status' => 'Success', 'message' => $this->lang->line('Digital Signature DELETED')));
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

    public function change_status(){

        $ds_id = $this->input->post('ds_id');
        
        $data['status'] = 'INPROGRESS';       

        
            if ($this->db->where('id',$ds_id)->update('gtg_digital_signatures',$data)) {
            
                $response['status'] = 200;
                $response['message'] = "Digital Signature Status Changed Successfully";
                
            } else {
                
                $response['status'] = 500;
                $response['message'] = "Digital Signature Status Change Failed";

            }

    
        echo json_encode($response);

    }


    function employee_share()
    {
        $cid = $this->input->post('employee_id');
        $ds_id = $this->input->post('c_ds_id');
        //$ds_details = $this->db->get('gtg_digital_signatures')->where('id',$ds_id)->get()->result_array();
        $ds_signings = $this->db->select('*')->from('gtg_digital_signature_signings')->where('ds_id',$ds_id)->limit(1)->order_by('id','DESC')->get()->result_array();
        
        $data = array('title' => $ds_signings[0]['file_name'], 'filename' => $ds_signings[0]['file_path'], 'cdate' => date('Y-m-d'), 'cid' => $cid, 'fid' => $cid, 'rid' => 0, 'emp_doc' => 1);
        if($this->db->insert('gtg_documents', $data))
        {
            $response['status'] = 200;
            $response['message'] = "Digtial Signing Document Shared Successfully";
            $this->session->set_flashdata('SuccessMsg', 'Digital Signing Document Shared Successfully!..');
         
        }else{
            $response['status'] = 500;
            $response['message'] = "Digtial Signing Document Sharing Failed";
            $this->session->set_flashdata('SuccessMsg', 'Digital Signing Document Sharing Failed!..');

        }
        redirect('digitalsignature');
    }

    function customer_share()
    {
        // echo "<pre>"; print_r($_POST); echo "</pre>";
        // exit;
        $cid = $this->input->post('customer_id');
        $ds_id = $this->input->post('cc_ds_id');
        //$ds_details = $this->db->get('gtg_digital_signatures')->where('id',$ds_id)->get()->result_array();
        $ds_signings = $this->db->select('*')->from('gtg_digital_signature_signings')->where('ds_id',$ds_id)->limit(1)->order_by('id','DESC')->get()->result_array();
        
        $data = array('title' => $ds_signings[0]['file_name'], 'filename' => $ds_signings[0]['file_path'], 'cdate' => date('Y-m-d'), 'cid' => $cid, 'fid' => $cid, 'rid' => 1, 'emp_doc' => 0);
        if($this->db->insert('gtg_documents', $data))
        {
            $response['status'] = 200;
            $response['message'] = "Digtial Signing Document Shared Successfully";
            $this->session->set_flashdata('SuccessMsg', 'Digital Signing Document Shared Successfully!..');
         
        }else{
            $response['status'] = 500;
            $response['message'] = "Digtial Signing Document Sharing Failed";
            $this->session->set_flashdata('SuccessMsg', 'Digital Signing Document Sharing Failed!..');

        }
        redirect('digitalsignature');
    }

}