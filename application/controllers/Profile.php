<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Profile_model');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->helper('form');

        // Ensure the user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        // Ambil user ID dari session
        $userId = $this->session->userdata('user_id');

        if (!$userId) {
            redirect('login'); // Redirect jika belum login
        }

        // Ambil data user dari tabel `users`
        $userData = $this->Profile_model->get_user_by_id($userId);

        if (!$userData) {
            show_error('User tidak ditemukan.');
        }

        // Cek data di tabel terkait (admin, mediator, pelapor)
        $adminData = $this->Profile_model->get_admin_by_user_id($userId);
        $mediatorData = $this->Profile_model->get_mediator_by_user_id($userId);
        $pelaporData = $this->Profile_model->get_pelapor_by_user_id($userId);

        // Tentukan data profil berdasarkan role
        $userDetails = [];
        if ($adminData) {
            $userDetails = $adminData;
        } elseif ($mediatorData) {
            $userDetails = $mediatorData;
        } elseif ($pelaporData) {
            $userDetails = $pelaporData;
        }

        $data = [
            'user' => $userData,
            'user_details' => $userDetails
        ];

        // Load view
        $this->load->view('backend/partials/header', $data);
        $this->load->view('backend/profile/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function update()
    {
        $user_id = $this->session->userdata('user_id');
        if (!$user_id) {
            redirect('login');
        }

        // Validasi umum
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'required');

        // Validasi password jika salah satu diisi
        if (
            !empty($this->input->post('current_password')) ||
            !empty($this->input->post('new_password')) ||
            !empty($this->input->post('confirm_password'))
        ) {
            $this->form_validation->set_rules('current_password', 'Password Lama', 'required');
            $this->form_validation->set_rules('new_password', 'Password Baru', 'min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'matches[new_password]');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('profile');
        }

        // Update data umum
        $data_users = [
            'email' => $this->input->post('email')
        ];

        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');

        if (!empty($current_password)) {
            if ($this->Profile_model->verify_password($user_id, $current_password)) {
                if (!empty($new_password)) {
                    $data_users['password'] = password_hash($new_password, PASSWORD_BCRYPT);
                }
            } else {
                $this->session->set_flashdata('error', 'Password lama salah.');
                redirect('profile');
            }
        }

        $this->Profile_model->update_user($user_id, $data_users);

        // Cek peran pengguna dan update tabel terkait
        $role = $this->Profile_model->get_user_role($user_id);
        $data_role = [
            'telp' => $this->input->post('phone'),
            'nama' => $this->input->post('nama')
        ];

        switch ($role) {
            case 'pelapor':
                $this->Profile_model->update_pelapor($user_id, $data_role);
                break;
            case 'mediator':
                $this->Profile_model->update_mediator($user_id, $data_role);
                break;
            case 'admin':
                $this->Profile_model->update_admin($user_id, $data_role);
                break;
            default:
                $this->session->set_flashdata('error', 'Role tidak dikenali.');
                redirect('profile');
        }

        $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
        redirect('profile');
    }

    public function profile()
    {
        // Ambil user ID dari session
        $userId = $this->session->userdata('user_id');

        if (!$userId) {
            redirect('login'); // Redirect jika belum login
        }

        // Ambil data user dari tabel `users`
        $userData = $this->Profile_model->get_user_by_id($userId);

        if (!$userData) {
            show_error('User tidak ditemukan.');
        }

        // Cek data di tabel terkait (admin, mediator, pelapor)
        $adminData = $this->Profile_model->get_admin_by_user_id($userId);
        $mediatorData = $this->Profile_model->get_mediator_by_user_id($userId);
        $pelaporData = $this->Profile_model->get_pelapor_by_user_id($userId);

        // Tentukan data profil berdasarkan role
        $userDetails = [];
        if ($adminData) {
            $userDetails = $adminData;
        } elseif ($mediatorData) {
            $userDetails = $mediatorData;
        } elseif ($pelaporData) {
            $userDetails = $pelaporData;
        }

        $data = [
            'user' => $userData,
            'user_details' => $userDetails
        ];

        // Load view
        $this->load->view('frontend/partials/header', $data);
        $this->load->view('frontend/pages/profile', $data);
        $this->load->view('frontend/partials/footer');
    }
}
