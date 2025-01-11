<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (
            !$this->session->userdata('logged_in') ||
            !in_array($this->session->userdata('user_type'), ['admin', 'mediator'])
        ) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('auth/login');
        }

        $data['users'] = $this->User_model->get_users();

        $this->load->view('backend/partials/header');
        $this->load->view('backend/user/view', $data);
        $this->load->view('backend/partials/footer');
    }

    public function add()
    {
        // Menentukan aturan validasi untuk form input
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email sudah terdaftar. Silakan gunakan email lain.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('telp', 'Telepon', 'required');

        // Menambahkan aturan validasi untuk input berdasarkan role
        if ($this->input->post('role') === 'mediator') {
            $this->form_validation->set_rules('bidang', 'Bidang', 'required');
            $this->form_validation->set_rules('nip', 'NIP', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        } elseif ($this->input->post('role') === 'pelapor') {
            $this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        } else {
            $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        }

        // Menjalankan validasi form
        if ($this->form_validation->run() === FALSE) {
            // Mengambil data role (admin, pelapor, mediator) untuk select option
            $data['admins'] = $this->User_model->get_admins();
            $data['pelapors'] = $this->User_model->get_pelapors();
            $data['mediators'] = $this->User_model->get_mediators();

            // Menampilkan form add user jika validasi gagal
            $this->load->view('backend/partials/header');
            $this->load->view('backend/user/add', $data); // View add user
            $this->load->view('backend/partials/footer');
        } else {
            // Data yang akan disimpan untuk tabel users
            $user_data = [
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];

            // Menambahkan user ke database dan mendapatkan ID user yang baru
            $user_id = $this->User_model->add_user($user_data);

            // Menyimpan data berdasarkan role
            $role_data = [
                'id_user' => $user_id,
                'nama' => $this->input->post('nama'),
                'telp' => $this->input->post('telp')
            ];

            if ($this->input->post('role') === 'admin') {
                $this->User_model->add_admin($role_data);
                $role_data['alamat'] = $this->input->post('alamat');
            } elseif ($this->input->post('role') === 'pelapor') {
                $role_data['perusahaan'] = $this->input->post('perusahaan');
                $role_data['alamat'] = $this->input->post('alamat');
                $this->User_model->add_pelapor($role_data);
            } elseif ($this->input->post('role') === 'mediator') {
                $role_data['bidang'] = $this->input->post('bidang');
                $role_data['nip'] = $this->input->post('nip');
                $role_data['alamat'] = $this->input->post('alamat');
                $this->User_model->add_mediator($role_data);
            }

            // Menampilkan pesan sukses setelah berhasil ditambahkan
            $this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan.');
            redirect('user');
        }
    }

    // Edit user data
    public function edit($id)
    {
        // Ambil data user berdasarkan id
        $user = $this->User_model->get_user_by_id($id);

        if (!$user) {
            $this->session->set_flashdata('error', 'User tidak ditemukan.');
            redirect('user');
        }

        // Set rules untuk validasi form
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'min_length[6]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('telp', 'Telepon', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('backend/partials/header');
            $this->load->view('backend/user/edit', ['user' => $user]);
            $this->load->view('backend/partials/footer');
        } else {
            // Data yang akan diupdate
            $user_data = [
                'email' => $this->input->post('email')
            ];

            // Update password jika diisi
            $password = $this->input->post('password');
            if (!empty($password)) {
                $user_data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            // Update data user
            $this->User_model->update_user($id, $user_data);

            // Update nama dan data spesifik role (admin, mediator, pelapor)
            $role = $this->input->post('role');
            if ($role == 'admin') {
                $role_data = [
                    'nama' => $this->input->post('nama'),
                    'telp' => $this->input->post('telp'),
                    'alamat' => $this->input->post('alamat')
                ];
                $this->User_model->update_admin($id, $role_data);
            } elseif ($role == 'mediator') {
                $role_data = [
                    'nama' => $this->input->post('nama'),
                    'telp' => $this->input->post('telp'),
                    'bidang' => $this->input->post('bidang'),
                    'nip' => $this->input->post('nip'),
                    'alamat' => $this->input->post('alamat')
                ];
                $this->User_model->update_mediator($id, $role_data);
            } elseif ($role == 'pelapor') {
                $role_data = [
                    'nama' => $this->input->post('nama'),
                    'telp' => $this->input->post('telp'),
                    'perusahaan' => $this->input->post('perusahaan'),
                    'alamat' => $this->input->post('alamat')
                ];
                $this->User_model->update_pelapor($id, $role_data);
            }

            // Redirect setelah update
            $this->session->set_flashdata('success', 'User berhasil diupdate.');
            redirect('user');
        }
    }

    // Delete user
    public function delete($id)
    {
        if ($this->session->userdata('logged_in') && in_array($this->session->userdata('user_type'), ['admin'])) {
            $this->User_model->delete_related_data($id);

            $this->User_model->delete_user($id);

            $this->session->set_flashdata('success', 'User berhasil dihapus beserta data terkait.');
            redirect('user');
        } else {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('auth/login');
        }
    }
}
