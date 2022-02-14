<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->library('form_validation');
        $this->load->model('M_admin');
    }

    public function index()
    {
        if ($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '2') {

            $data['title'] = "Dashboard";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();


            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('admin/dashboard', $data);
            $this->load->view('admin/templates/footer');
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }
}