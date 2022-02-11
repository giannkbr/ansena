<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('M_user');
    }

    public function index()
    {
        if ($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '2') {

            $data['title'] = "My Profile";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
            // echo 'Selamat datang ' . $data['user']['name'];

            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('admin/user/profile', $data);
            $this->load->view('admin/templates/footer');
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    public function edit()
    {
        if ($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '2') {

            $data['title'] = "Edit Profile";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

            if ($this->form_validation->run() == false) {
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/templates/sidebar', $data);
                $this->load->view('admin/templates/topbar', $data);
                $this->load->view('admin/user/edit', $data);
                $this->load->view('admin/templates/footer');
            } else {
                $name = $this->input->post('name');
                $email = $this->input->post('email');

                // cek jika ada gambar yang akan di upload
                $upload_image = $_FILES['image']['name'];
                // var_dump($upload_image);
                // die;

                if ($upload_image) {
                    $config['allowed_types'] = 'gif|jpg|jpeg|png';
                    $config['encrypt_name'] = TRUE;
                    $config['max_size'] = '2048';
                    $config['upload_path'] = './assets/images/user-auth/';

                    $this->load->library('upload', $config);

                    if ($this->upload->do_upload('image')) {
                        $old_image = $data['user']['image'];
                        if ($old_image != 'default.jpeg') {
                            unlink(FCPATH . 'assets/images/user-auth/' . $old_image);
                        }

                        $new_image = $this->upload->data('file_name');
                        $this->db->set('image', $new_image);
                    } else {
                        echo $this->upload->display_errors();
                    }
                }

                $this->db->set('name', $name);
                $this->db->where('email', $email);
                $this->db->update('user');

                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="uil uil-check me-2"></i>
                Your profile has been updated!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button></div>');
                redirect('user');
            }
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    public function changePassword()
    {
        if ($this->session->userdata('role_id') == '1' || $this->session->userdata('role_id') == '2') {

            $data['title'] = "Change Password";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
            $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[6]|matches[new_password2]');
            $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[6]|matches[new_password1]');

            if ($this->form_validation->run() == false) {
                $this->load->view('admin/templates/header', $data);
                $this->load->view('admin/templates/sidebar', $data);
                $this->load->view('admin/templates/topbar', $data);
                $this->load->view('admin/user/changepassword', $data);
                $this->load->view('admin/templates/footer');
            } else {
                $current_password = $this->input->post('current_password');
                $new_password = $this->input->post('new_password1');

                if (!password_verify($current_password, $data['user']['password'])) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="uil uil-exclamation-octagon me-2"></i>
                Wrong current password!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button></div>');
                    redirect('admin/user/changepassword');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_BCRYPT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="uil uil-check me-2"></i>
                    Password changed!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button></div>');
                    redirect('admin/user/changepassword');
                }
            }
        } else {
            echo "Anda tidak berhak mengakses halaman ini";
        }
    }

    public function userList()
    {
        if ($this->session->userdata('role_id') == '1') { // only admin

            $data['title'] = "User List";
            $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

            $data['allUsers'] = $this->M_user->tampil();

            $this->load->view('admin/templates/header', $data);
            $this->load->view('admin/templates/sidebar', $data);
            $this->load->view('admin/templates/topbar', $data);
            $this->load->view('admin/user/userlist', $data);
            $this->load->view('admin/templates/footer');
        } else {
            // echo "Anda tidak berhak mengakses halaman ini";

            $data['title'] = '404 | Page Not Found!!!';
            $this->load->view('admin/templates/auth_header', $data);
            $this->load->view('error404');
            $this->load->view('admin/templates/auth_footer');
        }
    }
}
