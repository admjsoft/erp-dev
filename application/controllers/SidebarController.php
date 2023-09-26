<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SidebarController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('SidebarItemModel');
    }

    public function index() {
        $data['sidebar_hierarchy'] = $this->SidebarItemModel->getSidebarHierarchy();
        $this->load->view('sidebar', $data);
    }
}
