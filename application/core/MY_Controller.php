<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    protected function _check_access(array $roles)
    {
        if (
            !$this->session->userdata('logged_in') ||
            !in_array($this->session->userdata('user_type'), $roles)
        ) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('auth/login');
        }
    }

    protected function _load_backend_view($view, $data = [])
    {
        $this->load->view('backend/partials/header', $data);
        $this->load->view($view, $data);
        $this->load->view('backend/partials/footer', $data);
    }

    protected function _load_frontend_view($view, $data = [])
    {
        $this->load->view('frontend/partials/header', $data);
        $this->load->view($view, $data);
        $this->load->view('frontend/partials/footer', $data);
    }
}
