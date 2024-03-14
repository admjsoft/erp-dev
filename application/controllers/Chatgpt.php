<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Chatgpt extends CI_Controller
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
       
        $this->li_a = 'file_manager';
        $c_module = 'file_manager';
        $this->load->vars('c_module', $c_module);
    }

    public function index()
    {
        $head['usernm'] = $this->aauth->get_user()->username;
        $head['title'] = 'Chat GPT';
        $data = array();
        $this->load->view('fixed/header', $head);
        $this->load->view('chat_gpt/chatgpt_view', $data);
        $this->load->view('fixed/footer');
    }  
    
}