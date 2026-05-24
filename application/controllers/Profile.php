<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Profile_model');

        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    public function index()
    {
        $data = $this->_get_profile_data();
        if (!$data) {
            show_error('User tidak ditemukan.');
        }

        $this->load->view('backend/partials/header', $data);
        $this->load->view('backend/profile/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function profile()
    {
        $data = $this->_get_profile_data();
        if (!$data) {
            show_error('User tidak ditemukan.');
        }

        $this->load->view('frontend/partials/header', $data);
        $this->load->view('frontend/pages/profile', $data);
        $this->load->view('frontend/partials/footer');
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

        if ($current_password || $new_password || $confirm_password) {
            $this->form_validation->set_rules('current_password', 'Password Lama', 'required');
            $this->form_validation->set_rules('new_password', 'Password Baru', 'required|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password Baru', 'required|matches[new_password]');
        }

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('profile');
        }

        $profile_image = $this->_upload_image();

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

        $role_update_map = [
            'pelapor' => 'update_pelapor',
            'mediator' => 'update_mediator',
            'admin' => 'update_admin',
        ];

        if (isset($role_update_map[$role])) {
            $this->Profile_model->{$role_update_map[$role]}($user_id, $data_role);
        } else {
            $this->session->set_flashdata('error', 'Role tidak dikenali.');
            redirect('profile');
        }

        $this->session->set_userdata([
            'user_name' => $data_role['nama'],
            'user_profile' => $data_role['profile'] ?? $this->session->userdata('user_profile'),
        ]);

        $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
        redirect($role === 'pelapor' ? 'profile/profile' : 'profile');
    }

    private function _get_profile_data()
    {
        $userId = $this->session->userdata('user_id');
        if (!$userId) {
            return null;
        }

        return $this->Profile_model->get_user_profile_data($userId);
    }

    private function _upload_image()
    {
        if (empty($_FILES['profile_image']['name'])) {
            return null;
        }

        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = 2048;
        $config['encrypt_name'] = true;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('profile_image')) {
            return $this->upload->data('file_name');
        }

        return false;
    }
}
