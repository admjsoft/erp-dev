<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Knowledgebase extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library("Aauth");
        if (!$this->aauth->is_loggedin()) {
            redirect('/user/', 'refresh');
            exit;
        }

      
        $c_module = 'knowledgebase';
        $this->load->vars('c_module', $c_module);

    }

    public function index()
    {
          $head['title'] = 'Knowledge Base';
          $data['web_url'] = 'https://user-guide.jsuitescloud.com';
          $this->load->view('fixed/header', $head);
          $this->load->view('knowledge_base/view', $data);
          $this->load->view('fixed/footer');
    }

}
