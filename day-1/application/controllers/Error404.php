<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Error404 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index()
    {
        $data['title'] = '404 | Page Not Found!!!';
        $this->load->view('admin/templates/auth_header', $data);
        $this->load->view('error404');
        $this->load->view('admin/templates/auth_footer');
    }
}
