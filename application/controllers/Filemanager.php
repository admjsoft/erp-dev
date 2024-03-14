<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Filemanager extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('filemanager_model', 'filemanager'); 
        $this->load->model('employee_model', 'employee');        
        $this->load->model('customers_model', 'customers');      
        $this->load->library("Aauth");
       if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
        }

        if(!$this->aauth->get_employee()){
            redirect('dashboard/clock_in');
        }
       
        $this->li_a = 'file_manager';
        $c_module = 'file_manager';
        $this->load->vars('c_module', $c_module);
    }

    public function index()
    {


        // echo "<pre>"; print_r($_SESSION); echo "</pre>";
        // echo "<pre>"; print_r($this->aauth->get_user()); echo "</pre>";
        // exit;

        if($_SESSION['s_role'] == 'r_5' || $_SESSION['s_role'] == 'r_4')
        {

      
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'File / Folders List';
        
        $folder = '';
        $contents = $this->filemanager->getRootContents();
        // Pass data to view
        $data = array(
            'folder' => $folder,
            'contents' => $contents,
            'breadcrumbs' => array()
        );
        $data['parent_id'] = '';
        $data['employees'] = $this->employee->list_employee();
        $data['customers'] = $this->customers->get_all_customers();
        $data['folders'] = $this->filemanager->getRootFoldersHeirarichy();
        // echo "<pre>";print_r($data);echo "</pre>";
        // exit;    
        
        $this->load->view('fixed/header', $head);
        $this->load->view('file_manager/file_management_entities_list', $data);
        $this->load->view('fixed/footer');

        }else{
              
            
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'File / Folders List';
        
        $folder = '';
        $contents = $this->filemanager->getEmployeeRootContents();
        // Pass data to view
        $data = array(
            'folder' => $folder,
            'contents' => $contents,
            'breadcrumbs' => array()
        );
        $data['parent_id'] = '';
   
        $data['folders'] = $this->filemanager->getRootFoldersHeirarichy();
        // echo "<pre>";print_r($data);echo "</pre>";
        // exit;    
        
        $this->load->view('fixed/header', $head);
        $this->load->view('file_manager/employee_file_management_entities_list', $data);
        $this->load->view('fixed/footer');

        }
    }  
    
    public function list_contents($folder_id)
    {
        if($_SESSION['s_role'] == 'r_5' || $_SESSION['s_role'] == 'r_4')
        {

        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'File / Folders List';
            
        $folder = $this->filemanager->getFolderById($folder_id);        
        $contents = $this->filemanager->getContentsByFolderId($folder_id);
        $breadcrumbs = $this->filemanager->getBreadcrumbs($folder_id);

        // Pass data to view
        $data = array(
            'folder' => $folder,
            'contents' => $contents,
            'breadcrumbs' => $breadcrumbs
        );

        $data['parent_id'] = $folder_id;
        $data['employees'] = $this->employee->list_employee();
        $data['customers'] = $this->customers->get_all_customers();
        $data['folders'] = $this->filemanager->getRootFoldersHeirarichy();
        // echo "<pre>";print_r($data);echo "</pre>";
        // exit;    
        
        $this->load->view('fixed/header', $head);
        $this->load->view('file_manager/file_management_entities_list', $data);
        $this->load->view('fixed/footer');
        }else{

            
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'File / Folders List';
            
        $folder = $this->filemanager->getFolderById($folder_id);        
        $contents = $this->filemanager->getContentsByFolderId($folder_id);
        $breadcrumbs = $this->filemanager->getBreadcrumbs($folder_id);

        // Pass data to view
        $data = array(
            'folder' => $folder,
            'contents' => $contents,
            'breadcrumbs' => $breadcrumbs
        );

        $data['parent_id'] = $folder_id;
        
        $data['folders'] = $this->filemanager->getRootFoldersHeirarichy();
        // echo "<pre>";print_r($data);echo "</pre>";
        // exit;    
        
        $this->load->view('fixed/header', $head);
        $this->load->view('file_manager/employee_file_management_entities_list', $data);
        $this->load->view('fixed/footer');

        }
    }  

    public function view_file($file_id) {
        // Load the model
       
        // Get the file details
        $file = $this->filemanager->getFileById($file_id);
        $file_path = $file['entity_path'];
        $file_extension = pathinfo($file_path, PATHINFO_EXTENSION);
// echo $file_path;
//         echo $file_extension;
//         exit;
        // Check if file extension corresponds to PDF or image types
        $is_pdf_or_image = in_array($file_extension, array('pdf', 'jpg', 'jpeg', 'png', 'gif', 'bmp'));

        $logged_in_user = $this->aauth->get_user()->username;
        $operation = "The User ".$logged_in_user." Viewed File";
        $this->filemanager->logOperation($file_id,$operation);

        if ($is_pdf_or_image) {
            // If PDF or image, redirect user to view in browser
            redirect($file_path);
        } else {
            // If any other type, force download
            $this->load->helper('download');
    
            $parsedUrl = parse_url($file_path);
            $relativeUrl = $parsedUrl['path'];
    
            
            force_download(FCPATH.$relativeUrl, null);
    
        }
        //echo 
        // // Check if file exists
        // if ($file) {
        //     // Check if file exists on server
        //     if (file_exists($file['entity_path'])) {
        //         // Set appropriate headers based on file type
        //         $mime_type = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $file['entity_path']);
        //         header('Content-Type: '.$mime_type);
                
        //         // Set Content-Disposition header based on file type
        //         if (in_array($mime_type, ['application/pdf', 'image/jpeg', 'image/png', 'image/gif'])) {
        //             header('Content-Disposition: inline; filename="'.$file['entity_name'].'"');
        //         } else {
        //             header('Content-Disposition: attachment; filename="'.$file['entity_name'].'"');
        //         }

                
        //         $logged_in_user = $this->aauth->get_user()->username;
        //         $operation = "The User ".$logged_in_user." Viewed File";
        //         $this->filemanager->logOperation($file_id,$operation);
        //         // Output the file content
        //         readfile($file['entity_path']);
        //     } else {
        //         // File not found on server
        //         echo "File not found on server.";
        //     }
        // } else {
        //     // File not found in database
        //     echo "File not found.";
        // }    
    
    }
    

    public function view_any_file($file_id) {
        // Load the model
        
    
        // Get the file details
        $file = $this->filemanager->getFileById($file_id);
    
        // Check if file exists
        if ($file) {
            // Check if file exists on server
            if (file_exists($file['entity_path'])) {
                // Set appropriate headers based on file type
                $mime_type = mime_content_type($file['entity_path']);
                header('Content-Type: '.$mime_type);
                header('Content-Disposition: inline; filename="'.$file['entity_name'].'"');
    
                // Output the file content
                $logged_in_user = $this->aauth->get_user()->username;
                $operation = "The User ".$logged_in_user." Viewed File";
                $this->filemanager->logOperation($file_id,$operation);
                echo file_get_contents($file['entity_path']);
            } else {
                // File not found on server
                echo "File not found on server.";
            }
        } else {
            // File not found in database
            echo "File not found.";
        }
    }

    public function rename_file_action() {
        // Load the model
        
        // Get the file ID and new name from the form submission
        $file_id = $this->input->post('file_id');
        $new_name = $this->input->post('new_name');
        $file_details = $this->filemanager->getFileById($file_id);
        // Rename the file
        $result = $this->filemanager->renameFile($file_id, $new_name);
        
        // Check if renaming was successful
        if ($result) {
            // Redirect to the appropriate page
            
            $logged_in_user = $this->aauth->get_user()->username;
            $operation = "The User ".$logged_in_user." ReNamed The File From ".$file_details['entity_name']." To ".$new_name;
            $this->filemanager->logOperation($file_id,$operation);
            $this->session->set_flashdata('SuccessMsg', 'Renamed Succeefully!..');
             
        } else {

           $this->session->set_flashdata('ErrorMsg', 'Renaming Failed!..');

        }

        $previous_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
        redirect($previous_url);
    }

    public function delete_file($file_id) {
        // Load the model
                // Delete the file
        $result = $this->filemanager->deleteFile($file_id);
        
        // Check if deletion was successful
        if ($result) {

            $logged_in_user = $this->aauth->get_user()->username;
            $operation = "The User ".$logged_in_user." Deleted The File";
            $this->filemanager->logOperation($file_id,$operation);
            // Redirect back to the previous URL or any other appropriate page
            $this->session->set_flashdata('SuccessMsg', 'Deleted Succeefully!..');
        } else {
            // Handle deletion failure
            $this->session->set_flashdata('ErrorMsg', 'Deleting Failed!..');
        }

        $previous_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
        redirect($previous_url);
    }

    public function employee_access() {
        
        $post = $this->input->post();

        $file_id = $post['emp_file_id'];
        $emp_list = $post['share_employees'];

        // Iterate over the employee names
        foreach ($post['share_employees'] as $emp_id) {
            // Retrieve the user_id of the employee from the database based on the name
            //$user_id = $this->get_user_id_by_name($employee_name);
            $access_data = array(
                'user_id' => $emp_id,
                'type' => 'employee',
                'folder_id' => $file_id,
                'access_type' => 'read,write' // Adjust access type as needed
            );

            $result = $this->db->insert('user_folder_access', $access_data);
            
            if ($result) {

                $emp_names = $this->employee->getEmployeeNames($emp_list);
                $logged_in_user = $this->aauth->get_user()->username;
                $operation = "The User ".$logged_in_user." Has Given File Access to Employees (".$emp_names.")";
                $this->filemanager->logOperation($file_id,$operation);   
                // Redirect to the appropriate page
                
                $this->session->set_flashdata('SuccessMsg', 'Employee Acceess Shared Succeefully!..');
            } else {
                // Handle renaming failure
                $this->session->set_flashdata('ErrorMsg', 'Employee Acceess Sharing Failed!..');
            }

            $previous_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
            redirect($previous_url);
        }
    }

    public function customer_access() {
        
        $post = $this->input->post();

        $file_id = $post['cust_file_id'];
        $cust_list = $post['share_customers'];
        // Iterate over the employee names
        foreach ($post['share_customers'] as $cust_id) {
            // Retrieve the user_id of the employee from the database based on the name
            //$user_id = $this->get_user_id_by_name($employee_name);
            $access_data = array(
                'user_id' => $cust_id,
                'type' => 'customer',
                'folder_id' => $file_id,
                'access_type' => 'read,write' // Adjust access type as needed
            );

            $result = $this->db->insert('user_folder_access', $access_data);
            
            if ($result) {

                $cust_names = $this->customers->getCustomerNames($cust_list);
                $logged_in_user = $this->aauth->get_user()->username;
                $operation = "The User ".$logged_in_user." Has Given File Access to Customers (".$cust_names.")";
                $this->filemanager->logOperation($file_id,$operation);   
                // Redirect to the appropriate page
                $this->session->set_flashdata('SuccessMsg', 'Customer Acceess Shared Succeefully!..');
            } else {
                // Handle renaming failure
                $this->session->set_flashdata('ErrorMsg', 'Customer Acceess Sharing Failed!..');
            }

            $previous_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
            redirect($previous_url);
        }
    }
    

    public function lock_file()
    {

        // echo "<pre>"; print_r($_POST); echo "</pre>";
        // exit;
        // Check if the file exists
        $post = $this->input->post();

        $file_id = $post['lock_file_id'];
        $file = $this->filemanager->getFileById($file_id);

        if (!$file) {
            // File not found
            // Handle the error, e.g., show an error message or redirect
            echo "File not found.";
            return;
        }

        
        $globalLock = $post['globalLock'];
        if(!empty($post['share_lock_employees'])){
            $employees = $post['share_lock_employees'];
        }else{
            $employees = array();
        }
        if(!empty($post['share_lock_customers'])){
            $customers = $post['share_lock_customers'];
        }else{
            $customers = array();
        }
        
        $lockFileId = $post['lock_file_id'];

        // Define arrays to store insert data
        $insertData = array();

        if($globalLock == 'yes')
        {
            $insertData[] = array(
                'user_type' => 'global',
                'user_id' => Null,
                'global_lock' => 1,
                'file_id' => $lockFileId
            );
        }
         // Populate employee and customer data arrays
        if(!empty($employees)){
            foreach ($employees as $employeeId) {
                $insertData[] = array(
                    'user_type' => 'employee',
                    'user_id' => $employeeId,
                    'global_lock' => 0,
                    'file_id' => $lockFileId
                );
            }
        }

        if(!empty($customers)){
            foreach ($customers as $customerId) {
                $insertData[] = array(
                    'user_type' => 'customer',
                    'user_id' => $customerId,
                    'global_lock' => 0,
                    'file_id' => $lockFileId
                );
            }
        }

        // echo "<pre>"; print_r($insertData); echo "</pre>";
        // exit;

        // Batch insert data into the database
        $result = $this->db->insert_batch('file_locks', $insertData);

       
        if ($result) {

            if($globalLock == 'yes')
            {
                $logged_in_user = $this->aauth->get_user()->username;
                $operation = "The User ".$logged_in_user." Locked File as Global Lock";
                $this->filemanager->logOperation($file_id,$operation); 
            }

            if(!empty($employees))
            {
                $emp_names = $this->employee->getEmployeeNames($employees);
                $logged_in_user = $this->aauth->get_user()->username;
                $operation = "The User ".$logged_in_user." Has Locked Access to Employees (".$emp_names.")";
                $this->filemanager->logOperation($file_id,$operation);   
            }

            if(!empty($customers))
            {
                $cust_names = $this->customers->getCustomerNames($customers);
                $logged_in_user = $this->aauth->get_user()->username;
                $operation = "The User ".$logged_in_user." Has Locked File Access to Customers (".$cust_names.")";
                $this->filemanager->logOperation($file_id,$operation);   
            }
            // Redirect to the appropriate page
            $this->session->set_flashdata('SuccessMsg', 'File Locked Succeefully!..');
        } else {
            // Handle renaming failure
            $this->session->set_flashdata('ErrorMsg', 'File Locking Failed!..');
        }

            $previous_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
            redirect($previous_url);
    }


    public function unlock_file()
    {

        // echo "<pre>"; print_r($_POST); echo "</pre>";
        // exit;
        // Check if the file exists
        $post = $this->input->post();

        $file_id = $post['unlock_file_id'];
        $file = $this->filemanager->getFileById($file_id);

        if (!$file) {
            // File not found
            // Handle the error, e.g., show an error message or redirect
            echo "File not found.";
            return;
        }

        
        $globalunLock = $post['globalunLock'];
        if(!empty($post['share_unlock_employees'])){
            $employees = $post['share_unlock_employees'];
        }else{
            $employees = array();
        }
        if(!empty($post['share_unlock_customers'])){
            $customers = $post['share_unlock_customers'];
        }else{
            $customers = array();
        }
        $lockFileId = $post['unlock_file_id'];

        // Define arrays to store insert data
        $insertData = array();

        if($globalunLock == 'no')
        {            
            $this->db->where('file_id', $lockFileId);
            $this->db->where('user_type', 'global');
            $g_result = $this->db->delete('file_locks');
        }else{
            $g_result = true;
        }
       // Populate employee and customer data arrays
       // Delete records for customers
        if(!empty($customers)){
            $this->db->where_in('user_id', $customers);
            $this->db->where('file_id', $lockFileId);
            $this->db->where('user_type', 'customer');
            $c_result = $this->db->delete('file_locks');
        }else{
            $c_result = true;
        }

       // Delete records for employees
        if(!empty($employees)){
            $this->db->where_in('user_id', $employees);
            $this->db->where('file_id', $lockFileId);
            $this->db->where('user_type', 'employee');
            $e_result = $this->db->delete('file_locks');
        }else{
            $e_result = true;
        }

        if ($g_result == true && $c_result == true || $e_result == true) {
            // Redirect to the appropriate page
            if($globalunLock == 'no')
            {
                $logged_in_user = $this->aauth->get_user()->username;
                $operation = "The User ".$logged_in_user." UnLocked File From Global Lock";
                $this->filemanager->logOperation($file_id,$operation); 
            }

            if(!empty($employees))
            {
                $emp_names = $this->employee->getEmployeeNames($employees);
                $logged_in_user = $this->aauth->get_user()->username;
                $operation = "The User ".$logged_in_user." Has UnLocked File Access to Employees (".$emp_names.")";
                $this->filemanager->logOperation($file_id,$operation);   
            }

            if(!empty($customers))
            {
                $cust_names = $this->customers->getCustomerNames($customers);
                $logged_in_user = $this->aauth->get_user()->username;
                $operation = "The User ".$logged_in_user." Has UnLocked File Access to Customers (".$cust_names.")";
                $this->filemanager->logOperation($file_id,$operation);   
            }

            $this->session->set_flashdata('SuccessMsg', 'File UnLocked Succeefully!..');
        } else {
            // Handle renaming failure
            $this->session->set_flashdata('ErrorMsg', 'File UnLocking Failed!..');
        }

            $previous_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
            redirect($previous_url);
    }


    public function getFileLockDetails(){

        $file_id = $this->input->post('fileId');

        $this->db->select('fme.*, fl_user.global_lock');
        $this->db->select('GROUP_CONCAT(DISTINCT CASE WHEN fl_user.user_type = "customer" THEN fl_user.user_id END) AS customer_ids');
        $this->db->select('GROUP_CONCAT(DISTINCT CASE WHEN fl_user.user_type = "employee" THEN fl_user.user_id END) AS employee_ids');
        $this->db->from('filemanagemententities fme');
        $this->db->join('file_locks fl_user', 'fme.entity_id = fl_user.file_id', 'left');
        $this->db->where('fme.entity_id', $file_id);
        $this->db->group_by('fme.entity_id');
        $query = $this->db->get();
        $data['file_details'] =  $query->result_array();
        $data['employees'] = $this->employee->list_employee();
        $data['customers'] = $this->customers->get_all_customers();

        // echo "<pre>"; print_r($data); echo "</pre>";
        // exit;

        $response['status'] = true;
        $response['html'] = $this->load->view('file_manager/file_unlock_options',$data,TRUE);

        echo json_encode($response);

    }


    public function add_entity() {
        // Check if form is submitted

        // echo "<pre>"; print_r($_POST); echo "</pre>";
        // echo "<pre>"; print_r($_FILES); echo "</pre>";
        // exit;
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the entity type (folder or file)
            $entityType = $this->input->post('entityType');
            $parentId = $this->input->post('parentId');
            $path = '';
            if(!empty($parentId))
            {
                $parent_folders = $this->filemanager->getParentFolders($parentId);

                // echo "<pre>"; print_r($_FILES); echo "</pre>";
                
                foreach ($parent_folders as $pitem) {
                    // Append entity_name to the path
                    $path .= $pitem['entity_name'] . '/';
                }
                
                // Remove the trailing slash
                $path = rtrim($path, '/');
            }else{
                $parentId = NULL;
            }
           
            
            // Process based on entity type
            if ($entityType == 'folder') {
                // Handle folder submission
                $folderName = trim($this->input->post('folderName'));
                
                // Insert folder details into database
                $data = array(
                    'entity_name' => $folderName,
                    'entity_type' => 'folder',
                    'parent_entity_id' => $parentId
                    // Add other necessary fields
                );

                $this->db->insert('filemanagemententities', $data);

                $file_id = $this->db->insert_id();

                // echo $path."<br>";
                // Create folder in userfiles/file_manager folder
                if(!empty($path))
                {                    
                    $folderPath = FCPATH . 'userfiles/file_manager/' .$path.'/'.$folderName;
                }else{
                    
                    $folderPath = FCPATH . 'userfiles/file_manager/'.$folderName;
                }

                // echo $folderPath."<br>";
                // exit;
                if (!is_dir($folderPath)) {
                    mkdir($folderPath, 0777, true);
                }

                $logged_in_user = $this->aauth->get_user()->username;
                $operation = "The User ".$logged_in_user." Has Created The Folder with Name ".$folderName;
                $this->filemanager->logOperation($file_id,$operation);   
                $this->session->set_flashdata('SuccessMsg', 'Folder Created Succeefully!..');
        
                $previous_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
                redirect($previous_url);

            } elseif ($entityType == 'file') {
                // Handle file submission
                $fileName = trim($this->input->post('fileName'));
                $fileUpload = $_FILES['userfile'];

                if (!empty($_FILES)) {
                    // Specify the allowed file types
                    $allowed_types = array(
                        'jpg', 'jpeg', 'png', 'gif', // Image files
                        'pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', // Document files
                        'zip', 'rar', '7z', 'tar', 'gz', // Archive files
                        'txt', 'csv', // Text files
                        'mp3', 'wav', 'ogg', // Audio files
                        'mp4', 'avi', 'mov', 'wmv', // Video files
                        'html', 'htm', 'php', 'js', 'css', // Web files
                        'exe', 'msi', 'bat', // Executable files
                        'svg', 'eps', // Vector image files
                        'ai', 'psd', // Design files
                        'key', 'numbers', // Apple iWork files
                        'pages', 'numbers', // Apple iWork files
                        'odt', 'ods', 'odp', // OpenDocument files
                        'csv', // Comma-separated values
                        'xml', // XML files
                        'json', // JSON files
                        'markdown', 'md', // Markdown files
                        'rtf', // Rich Text Format files
                        'sql'
                    );
                
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

                    if(!empty($path))
                    {                    
                        $config['upload_path'] = FCPATH . 'userfiles/file_manager/' .$path.'/';
                    }else{
                        
                        $config['upload_path'] =  FCPATH . 'userfiles/file_manager/';
                    }
                    //$config['upload_path'] = './userfiles/ds_docs'; // The upload directory
                
                    // echo "<pre>"; print_r($config); echo "</pre>";
                    $this->load->library('upload', $config);
                
                    if ($this->upload->do_upload('userfile')) {
                        $name = preg_replace('/\s+/', '_', $file_name[0] . strtotime("now") . "." . $media_type);
                        
                        if(!empty($path))
                        {                    
                            $file_path = base_url() . 'userfiles/file_manager/' .$path.'/'.$name;
                        }else{
                            
                            $file_path = base_url() . 'userfiles/file_manager/'.$name;
                        }
                        $data = $this->upload->data();
                
                    } else {
                        // $error = array('error' => $this->upload->display_errors());
                        // echo "<pre>"; print_r($error); echo "</pre>";
                        //$this->load->view('upload_form', $error);
                        $this->session->set_flashdata('ErrorMsg', $this->upload->display_errors());
                        $previous_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
                        redirect($previous_url);
                    }

                   // exit;
                    $data = array(
                        'entity_name' => $fileName,
                        'entity_type' => 'file',
                        'parent_entity_id' => $parentId,
                        'entity_path' => $file_path
                        // Add other necessary fields
                    );
                    $this->db->insert('filemanagemententities', $data);
                    $file_id = $this->db->insert_id();
                    
                    $logged_in_user = $this->aauth->get_user()->username;
                    $operation = "The User ".$logged_in_user." Has Created The File with Name ".$fileName;
                    $this->filemanager->logOperation($file_id,$operation);   
                    
                    $this->session->set_flashdata('SuccessMsg', 'File Uploaded Succeefully!..');
                    $previous_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
                    redirect($previous_url);
                
                  
                }
            }

            // Redirect or return response as needed
        }
    }


    public function download_file($file_id) {
        // Retrieve the file URL from the query string or any other source
        //$file_url = $this->input->get('file_url');
        $this->load->helper('download');
        $file = $this->filemanager->getFileById($file_id);
        $file_url = $file['entity_path'];

        //$baseUrl = base_url()."erp-dev/";

        // Remove the host from the full URL
        $parsedUrl = parse_url($file_url);
        $relativeUrl = $parsedUrl['path'];

        // Output the relative URL
        //echo $relativeUrl;
// echo $relativeUrl;
// exit;
        force_download(FCPATH.$relativeUrl, null);
            // echo  $file_url;
            // exit;
        // Extract the file name from the URL
        // $file_name = basename($file_url);

        // // Use CodeIgniter's force_download helper to initiate the download
        // force_download($file_name, file_get_contents($file_url));
            
    }

    public function getFileLogDetails(){

        $file_id = $this->input->post('fileId');

        $this->db->select('*');
        $this->db->from('file_folder_log');
        $this->db->where('entity_id', $file_id);
        $this->db->order_by('log_id');
        $query = $this->db->get();

        $file_log_details =  $query->result_array();
        $logs = "";
        // Loop through paragraphs and insert into modal body
        if(!empty($file_log_details))
        {
            foreach ($file_log_details as $f_log) {
                $logs .= "<p>".$f_log['operation']."</p>";
                }
        }else{
            $logs .= "<p>No Logs Recorded!..</p>";
        }

        $response['status'] = true;
        $response['html'] = $logs;

        echo json_encode($response);

    }


    public function getFolderHeirarichy(){

        $folderId = $this->input->post('folderId');
        $data['folder_id'] = $folderId;
        $data['folders'] = $this->filemanager->getRootFoldersHeirarichy($folderId);
        $data['breadcrumbs'] = $this->filemanager->getBreadcrumbs($folderId);
        // Loop through paragraphs and insert into modal body

        $response['status'] = true;
        $response['html'] = $this->load->view('file_manager/file_transfer_options',$data,TRUE);

        echo json_encode($response);

    }

    public function transfer_file(){

        $post = $this->input->post();

        $file_id = $post['transfer_file_id'];  
        
        $file_details = $this->filemanager->getFileById($file_id);

        if (!$file_details) {
            // File not found
            // Handle the error, e.g., show an error message or redirect
            echo "File not found.";
            return;
        }

        $transfer_type = $post['actionType'];  
        $parentId = $post['parentId'];
        // Define arrays to store insert data
        $insertData = array();

        $parent_details = $this->filemanager->getFileById($parentId);

        if($transfer_type == 'copy')
        {
            
            $data = array(
                'entity_name' => $file_details['entity_name'],
                'entity_type' => $file_details['entity_type'],
                'parent_entity_id' => $parentId,
                'entity_path' => $file_details['entity_path']
                // Add other necessary fields
            );
            $result = $this->db->insert('filemanagemententities', $data);

        }else if($transfer_type == 'move'){ 
            $data1 = array(
                
                'parent_entity_id' => $parentId,
                // Add other necessary fields
            );
            $result = $this->db->where('entity_id',$file_details['entity_id'])->update('filemanagemententities', $data1);

        }


        if ($result) {

            if($transfer_type == 'copy')
            {
                $logged_in_user = $this->aauth->get_user()->username;
                $operation = "The User ".$logged_in_user." Copied The ".$file_details['entity_name']." To ".$parent_details['entity_name']." ".$parent_details['entity_type']."";
                $this->filemanager->logOperation($file_id,$operation); 
            
            }else if($transfer_type == 'move'){

                $logged_in_user = $this->aauth->get_user()->username;
                $operation = "The User ".$logged_in_user." Moved The ".$file_details['entity_name']." To ".$parent_details['entity_name']." ".$parent_details['entity_type']."";
                $this->filemanager->logOperation($file_id,$operation); 

            }

            if($transfer_type == 'copy')
            {
                $this->session->set_flashdata('SuccessMsg', 'Copied Successfully!..');
            }else if($transfer_type == 'move'){
                $this->session->set_flashdata('SuccessMsg', 'Moved Successfully!..');
            }
            
        } else {
            if($transfer_type == 'copy')
            {
                $this->session->set_flashdata('ErrorMsg', 'Copying Failed!..');
            }else if($transfer_type == 'move'){
                $this->session->set_flashdata('ErrorMsg', 'Moving Failed!..');
            }
        }

        $previous_url = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : base_url();
            redirect($previous_url);
    }


}