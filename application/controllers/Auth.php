<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Auth_model'); // Memuat model untuk login dan register
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function login() {
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->Auth_model->login($email, $password);

            if ($user) {
                // Simpan data user ke session
                $this->session->set_userdata('logged_in', $user);
                redirect('dashboard'); // Arahkan ke halaman dashboard
            } else {
                $this->session->set_flashdata('error', 'Email atau Password salah.');
                redirect('auth/login');
            }
        }

        $this->load->view('auth/login');
    }

    public function register() {
        if ($this->input->post()) {
            $data = [
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            ];

            if ($this->Auth_model->register($data)) {
                $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Registrasi gagal. Coba lagi.');
                redirect('auth/register');
            }
        }

        $this->load->view('auth/register');
    }

    public function logout() {
        $this->session->unset_userdata('logged_in');
        redirect('auth/login');
    }
}
