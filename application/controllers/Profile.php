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
        $userId = $this->session->userdata('user_id');

        if (!$userId) {
            redirect('login');
        }

        $userData = $this->Profile_model->get_user_by_id($userId);

        if (!$userData) {
            show_error('User tidak ditemukan.');
        }

        $adminData = $this->Profile_model->get_admin_by_user_id($userId);
        $mediatorData = $this->Profile_model->get_mediator_by_user_id($userId);
        $pelaporData = $this->Profile_model->get_pelapor_by_user_id($userId);

        $userDetails = [];
        $profileImage = null;

        if ($adminData) {
            $userDetails = $adminData;
            $profileImage = $adminData['profile'] ?? null;
        } elseif ($mediatorData) {
            $userDetails = $mediatorData;
            $profileImage = $mediatorData['profile'] ?? null;
        } elseif ($pelaporData) {
            $userDetails = $pelaporData;
            $profileImage = $pelaporData['profile'] ?? null;
        }

        $data = [
            'user' => $userData,
            'user_details' => $userDetails,
            'profile_image' => $profileImage
        ];

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

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');

        $current_password = $this->input->post('current_password');
        $new_password = $this->input->post('new_password');
        $confirm_password = $this->input->post('confirm_password');

        if (!empty($current_password) || !empty($new_password) || !empty($confirm_password)) {
            $this->form_validation->set_rules('current_password', 'Password Lama', 'required');
            $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'required|matches[new_password]');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('profile');
        }

        // Upload gambar baru kalau ada
        $profile_image = $this->upload_image();

        $data_users = ['email' => $this->input->post('email')];

        if (!empty($current_password)) {
            if ($this->Profile_model->verify_password($user_id, $current_password)) {
                $data_users['password'] = password_hash($new_password, PASSWORD_BCRYPT);
            } else {
                $this->session->set_flashdata('error', 'Password lama salah.');
                redirect('profile');
            }
        }

        $this->Profile_model->update_user($user_id, $data_users);

        $role = $this->Profile_model->get_user_role($user_id);

        $data_role = [
            'telp' => $this->input->post('phone'),
            'nama' => $this->input->post('nama'),
        ];

        if ($profile_image !== false && $profile_image !== null) {
            $data_role['profile'] = $profile_image;
        }

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

        // Session update untuk nama dan profile dari role saja
        $this->session->set_userdata([
            'user_name' => $data_role['nama'],
            'user_profile' => isset($data_role['profile']) ? $data_role['profile'] : $this->session->userdata('user_profile')
        ]);

        $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
        redirect('profile');
    }


    private function upload_image()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048; // 2MB
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_image')) {
            // Jika tidak ada file yang diupload, return null
            if (empty($_FILES['profile_image']['name'])) {
                return null;
            }
            return false;
        } else {
            return $this->upload->data('file_name');
        }
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
