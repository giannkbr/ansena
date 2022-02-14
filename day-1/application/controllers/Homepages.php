<?php


defined('BASEPATH') OR exit('No direct script access allowed');

class Homepages extends CI_Controller {
    
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
            $data = [
                "title" => "Belanja",
                "page" => "user/dashboard",
                "user" =>  $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(),
                'barang' =>  $this->M_admin->get_rows()
            ];
    
            $this->load->view('user/templates/app', $data, FALSE);
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
	}

}

/* End of file Homepages.php */
