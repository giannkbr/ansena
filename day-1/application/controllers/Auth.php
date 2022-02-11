<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        // jika user atau admin mencoba mngakses ke auth login maka di kick kembali
        // ke halaman user karena belum logout
        if ($this->session->userdata('email')) {
            redirect('admin');
        }

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Page';

            $this->load->view('admin/templates/auth_header', $data);
            $this->load->view('admin/auth/login', $data);
            $this->load->view('admin/templates/auth_footer');
        } else {
            // validasinya success 
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();
        // var_dump($user);
        // die;

        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['role_id'] == 1) {
                        // $this->session->set_userdata('akses', 1);
                        redirect('admin');
                    } else { // akses user
                        // $this->session->set_userdata('akses', 2);
                        redirect('admin');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="uil uil-exclamation-octagon me-2"></i>
                    Wrong Password!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button></div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="uil uil-exclamation-triangle me-2"></i>
                This email has not been activated!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button></div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="uil uil-exclamation-octagon me-2"></i>
            Email is not registered!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button></div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('admin');
        }

        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
            'matches' => 'password dont match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'User Registration';
            $this->load->view('admin/templates/auth_header', $data);
            $this->load->view('admin/auth/registration', $data);
            $this->load->view('admin/templates/auth_footer');
        } else {
            // echo 'Data berhasil ditambahkan!';
            $email = $this->input->post('email', true);
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($email),
                'image' => 'default.jpeg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_BCRYPT),
                'role_id' => 2,
                'is_active' => 0,
                'date_created' => time()
            ];

            // var_dump($data);
            // die;

            // siapakan token
            $token = base64_encode(random_bytes(32));
            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);

            $this->_sendEmail($token, 'verify');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="uil uil-check me-2"></i>
            Congratulation! your accout has been created. Please activate your account
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button></div>');
            redirect('auth');
        }
    }

    private function _sendEmail($token, $type)
    {
        $config = [
            'useragent' => 'CodeIgniter',
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => '',
            'smtp_pass' => '',
            'smtp_port' => 465,
            'smtp_keepalive' => TRUE,
            'smtp_crypto' => 'SSL',
            'wrapchars' => 80,
            'validate'  => TRUE,
            'mailtype'  => 'html',
            'charset'   => 'iso-8859-1',
            'starttls'  => TRUE,
            'newline'   => "\r\n",
            'wordwrap' => TRUE
        ];

        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('', 'ADMINISTRATOR | SYSTEM');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Verification');
            $this->email->message('Click this link to verify your account : <a href="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Activate</a>');
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '">Reset Password</a>');
        }

        if ($this->email->send()) {
            return true;
        } else {
            echo $this->email->print_debugger();
            die;
        }
    }

    public function verify()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                if (time() - $user_token['date_created'] < (60 * 60 * 24)) {
                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="uil uil-check me-2"></i>
                    ' . $email . ' has been acivated! Please login.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button></div>');
                    redirect('auth');
                } else {

                    $this->db->delete('user', ['email' => $email]);
                    $this->db->delete('user_token', ['email' => $email]);

                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="uil uil-exclamation-octagon me-2"></i>
                    Account activation failed! Token expired.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    </button></div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="uil uil-exclamation-octagon me-2"></i>
                Account activation failed! Wrong token.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button></div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="uil uil-exclamation-octagon me-2"></i>
            Account activation failed! Wrong email.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button></div>');
            redirect('auth');
        }
    }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('admin/templates/auth_header', $data);
            $this->load->view('admin/auth/forgot-password');
            $this->load->view('admin/templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);
                $this->_sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="uil uil-check me-2"></i>
                Please check your email to reset your password!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button></div>');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="uil uil-exclamation-octagon me-2"></i>
                Email is not registered or activated!.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button></div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) {
                $this->session->set_userdata('reset_email', $email);
                $this->changePassword();
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="uil uil-exclamation-octagon me-2"></i>
                Reset password failed! Wrong token.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button></div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="uil uil-exclamation-octagon me-2"></i>
            Reset password failed! Wrong email.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button></div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'trim|required|min_length[6]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat Password', 'trim|required|min_length[6]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('admin/templates/auth_header', $data);
            $this->load->view('admin/auth/change-password');
            $this->load->view('admin/templates/auth_footer');
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_BCRYPT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="uil uil-check me-2"></i>
            Password has been changed! Please Login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button></div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="uil uil-check me-2"></i>
        You have been logged out!
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        </button></div>');
        redirect('auth');
    }
}
