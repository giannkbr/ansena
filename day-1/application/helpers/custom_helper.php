<?php

function is_logged_in()
{
    //  kalau belum login di kick kembali ke login form
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        // kalau sudah login
        $ci->session->userdata('role_id');
    }
}
