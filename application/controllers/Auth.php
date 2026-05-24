<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
    }

    public function login()
    {
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $user = $this->Auth_model->get_user_by_email($email);

            if ($user && password_verify($password, $user['password'])) {
                $user_type = $this->Auth_model->get_user_type($user['id']);

                if ($user_type) {
                    $session_data = [
                        'user_id' => $user['id'],
                        'user_name' => $user_type['nama'] ?? $user['nama'],
                        'user_profile' => $user['profile'] ?? null,
                        'email' => $user['email'],
                        'user_type' => $user_type['type'],
                        'type_id' => $user_type['id'],
                        'logged_in' => true,
                    ];
                    $this->session->set_userdata($session_data);

                    if (in_array($user_type['type'], ['admin', 'mediator'])) {
                        redirect('dashboard');
                    }
                    redirect('home');
                }

                $this->session->set_flashdata('error', 'User tidak terdaftar sebagai admin, pelapor, atau mediator.');
            } else {
                $this->session->set_flashdata('error', 'Email atau Password salah.');
            }

            redirect('auth/login');
        }

        $this->load->view('auth/login');
    }

    public function register()
    {
        if ($this->input->post()) {
            $user_data = [
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            ];

            if ($this->Auth_model->register_user($user_data)) {
                $user_id = $this->db->insert_id();

                $pelapor_data = [
                    'id_user' => $user_id,
                    'nama' => trim(
                        $this->input->post('first_name') . ' ' . $this->input->post('last_name')
                    ),
                    'perusahaan' => $this->input->post('perusahaan'),
                    'alamat' => $this->input->post('alamat'),
                ];

                $this->Auth_model->register_pelapor($pelapor_data);

                $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
                redirect('auth/login');
            }

            $this->session->set_flashdata('error', 'Registrasi gagal. Coba lagi.');
            redirect('auth/register');
        }

        $this->load->view('auth/register');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
