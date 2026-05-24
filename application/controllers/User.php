<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index()
    {
        $this->_check_access(['admin', 'mediator']);

        $data['users'] = $this->User_model->get_users();
        $this->_load_backend_view('backend/user/view', $data);
    }

    public function add()
    {
        $this->_check_access(['admin']);

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email sudah terdaftar. Silakan gunakan email lain.',
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('telp', 'Telepon', 'required');

        $role = $this->input->post('role');
        if ($role === 'mediator') {
            $this->form_validation->set_rules('bidang', 'Bidang', 'required');
            $this->form_validation->set_rules('nip', 'NIP', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        } elseif ($role === 'pelapor') {
            $this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        } else {
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        }

        if ($this->form_validation->run() === false) {
            $data['admins'] = $this->User_model->get_admins();
            $data['pelapors'] = $this->User_model->get_pelapors();
            $data['mediators'] = $this->User_model->get_mediators();
            $this->_load_backend_view('backend/user/add', $data);
            return;
        }

        $user_data = [
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        ];

        $user_id = $this->User_model->add_user($user_data);

        $role_data = [
            'id_user' => $user_id,
            'nama' => $this->input->post('nama'),
            'telp' => $this->input->post('telp'),
        ];

        if ($role === 'admin') {
            $role_data['alamat'] = $this->input->post('alamat');
            $this->User_model->add_admin($role_data);
        } elseif ($role === 'pelapor') {
            $role_data['perusahaan'] = $this->input->post('perusahaan');
            $role_data['alamat'] = $this->input->post('alamat');
            $this->User_model->add_pelapor($role_data);
        } elseif ($role === 'mediator') {
            $role_data['bidang'] = $this->input->post('bidang');
            $role_data['nip'] = $this->input->post('nip');
            $role_data['alamat'] = $this->input->post('alamat');
            $this->User_model->add_mediator($role_data);
        }

        $this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan.');
        redirect('user');
    }

    public function edit($id)
    {
        $this->_check_access(['admin']);

        $user = $this->User_model->get_user_by_id($id);

        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('user');
        }

        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('telp', 'Telepon', 'required');

        if ($this->form_validation->run() === false) {
            $this->_load_backend_view('backend/user/edit', ['user' => $user]);
            return;
        }

        $user_data = ['email' => $this->input->post('email')];

        $password = $this->input->post('password');
        if (!empty($password)) {
            $user_data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        $this->User_model->update_user($id, $user_data);

        $role = $this->input->post('role');
        if ($role === 'admin') {
            $this->User_model->update_admin($id, [
                'nama' => $this->input->post('nama'),
                'telp' => $this->input->post('telp'),
                'alamat' => $this->input->post('alamat'),
            ]);
        } elseif ($role === 'mediator') {
            $this->User_model->update_mediator($id, [
                'nama' => $this->input->post('nama'),
                'telp' => $this->input->post('telp'),
                'bidang' => $this->input->post('bidang'),
                'nip' => $this->input->post('nip'),
                'alamat' => $this->input->post('alamat'),
            ]);
        } elseif ($role === 'pelapor') {
            $this->User_model->update_pelapor($id, [
                'nama' => $this->input->post('nama'),
                'telp' => $this->input->post('telp'),
                'perusahaan' => $this->input->post('perusahaan'),
                'alamat' => $this->input->post('alamat'),
            ]);
        }

        $this->session->set_flashdata('success', 'User berhasil diupdate.');
        redirect('user');
    }

    public function delete($id)
    {
        $this->_check_access(['admin']);

        $this->User_model->delete_related_data($id);
        $this->User_model->delete_user($id);

        $this->session->set_flashdata('success', 'User berhasil dihapus beserta data terkait.');
        redirect('user');
    }
}
