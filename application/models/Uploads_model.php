<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uploads_model extends CI_Model {

    protected $table = 'gtg_uploads';

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row();
    }

    public function get_all() {
        return $this->db->get($this->table)->result();
    }

    public function update($id, $data) {
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function delete($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    public function do_upload($inputName, $contract_id)
    {
        // Define upload configuration
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'pdf|jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE; // Rename the uploaded file for security

        $this->load->library('upload', $config);

        // Check if files are uploaded using is_uploaded_file() function
        $files = $_FILES[$inputName];

        $uploaded_files = [];

        foreach ($files['name'] as $key => $filename) {
            // Validate file type and size
            if ($this->upload->is_valid_image($files['tmp_name'][$key])) {
                if ($this->upload->do_upload('userfile')) {
                    // Get file data after successful upload
                    $fileData = $this->upload->data();

                    // Add file data to the $uploaded_files array
                    $uploaded_files[] = array(
                        'contract_id' => $contract_id,
                        'file_name' => $fileData['file_name'],
                        'file_path' => $fileData['full_path'],
                        'file_type' => $fileData['file_type'],
                        'file_size' => $fileData['file_size'],
                        'created_at' => date('Y-m-d H:i:s')
                    );
                }
            } else {
                // Handle invalid file type
            }
        }

        if (!empty($uploaded_files)) {
            // Insert uploaded file data into the database
            $this->db->insert_batch('gtg_uploads', $uploaded_files);
        }

        return $uploaded_files;
    }


    public function get_upload_files_by_contract_id($contract_id)
    {
        // Query the database to retrieve upload files associated with a contract_id
        $query = $this->db->get_where('gtg_uploads', array('contract_id' => $contract_id));

        return $query->result_array(); // Return upload files as an array of results
    }

    public function is_valid_image($file)
    {
        if (function_exists('exif_imagetype')) {
            $allowed_types = [
                IMAGETYPE_JPEG,
                IMAGETYPE_PNG,
                IMAGETYPE_GIF,
            ];

            $image_type = exif_imagetype($file);

            return in_array($image_type, $allowed_types);
        }

        return false;
    }


}
