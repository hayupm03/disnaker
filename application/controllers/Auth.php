<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auth_model');
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function login()
    {
        if ($this->input->post()) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            // Cek user berdasarkan email
            $user = $this->Auth_model->get_user_by_email($email);

            if ($user && password_verify($password, $user->password)) {
                // Tentukan tipe user (admin, pelapor, mediator)
                $user_type = $this->Auth_model->get_user_type($user->id);

                if ($user_type) {
                    // Ambil nama dari hasil get_user_type
                    $user_name = $user_type['nama'] ?? $user->nama;

                    // Simpan data session berdasarkan tipe user
                    $session_data = [
                        'user_id' => $user->id,
                        'user_name' => $user_name,
                        'email' => $user->email,
                        'user_type' => $user_type['type'],
                        'type_id' => $user_type['id'],
                        'logged_in' => true,
                    ];
                    $this->session->set_userdata($session_data);

                    // Arahkan ke halaman sesuai tipe user
                    if ($user_type['type'] === 'admin' || $user_type['type'] === 'mediator') {
                        redirect('dashboard'); // Arahkan ke dashboard
                    } elseif ($user_type['type'] === 'pelapor') {
                        redirect('home');
                    }
                } else {
                    $this->session->set_flashdata('error', 'User tidak terdaftar sebagai admin, pelapor, atau mediator.');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('error', 'Email atau Password salah.');
                redirect('auth/login');
            }
        }

        $this->load->view('auth/login');
    }

    public function register()
    {
        if ($this->input->post()) {
            // Data untuk tabel users
            $user_data = [
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            ];

            // Insert ke tabel users
            if ($this->Auth_model->register_user($user_data)) {
                $user_id = $this->db->insert_id();

                // Data untuk tabel pelapor
                $pelapor_data = [
                    'id_user' => $user_id,
                    'nama' => $this->input->post('first_name') . ' ' . $this->input->post('last_name'),
                    'perusahaan' => $this->input->post('perusahaan'),
                    'alamat' => $this->input->post('alamat'),
                ];

                // Insert ke tabel pelapor
                $this->Auth_model->register_pelapor($pelapor_data);

                $this->session->set_flashdata('success', 'Registrasi berhasil. Silakan login.');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('error', 'Registrasi gagal. Coba lagi.');
                redirect('auth/register');
            }
        }

        $this->load->view('auth/register');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
