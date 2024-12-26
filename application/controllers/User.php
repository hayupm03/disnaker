<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model'); // Memuat model User_model
        $this->load->library('form_validation'); // Memuat library form_validation
    }

    // Fungsi untuk menampilkan halaman utama data user
    public function index()
    {
        if (
            !$this->session->userdata('logged_in') ||
            !in_array($this->session->userdata('user_type'), ['admin', 'mediator'])
        ) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('auth/login');
        }

        // Mengambil data users
        $data['users'] = $this->User_model->get_users();

        // Menampilkan view
        $this->load->view('backend/partials/header');
        $this->load->view('backend/user/view', $data); // Ganti view 'admin/view' ke 'user/index'
        $this->load->view('backend/partials/footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]', [
            'is_unique' => 'Email sudah terdaftar. Silakan gunakan email lain.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() === FALSE) {
            // Mengambil data role (admin, pelapor, mediator) untuk select option
            $data['admins'] = $this->User_model->get_admins();
            $data['pelapors'] = $this->User_model->get_pelapors();
            $data['mediators'] = $this->User_model->get_mediators();

            // Menampilkan form add user
            $this->load->view('backend/partials/header');
            $this->load->view('backend/user/add', $data); // View add user
            $this->load->view('backend/partials/footer');
        } else {
            // Proses penyimpanan data user
            $user_data = [
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            ];

            // Menambahkan user ke database
            $user_id = $this->User_model->add_user($user_data);

            // Menambahkan peran (admin, pelapor, atau mediator)
            $role_data = [
                'id_user' => $user_id,
                'nama' => $this->input->post('nama'),
                'telp' => $this->input->post('telp')
            ];

            if ($this->input->post('role') == 'admin') {
                $this->User_model->add_admin($role_data);
            } elseif ($this->input->post('role') == 'pelapor') {
                $this->User_model->add_pelapor($role_data);
            } elseif ($this->input->post('role') == 'mediator') {
                $this->User_model->add_mediator($role_data);
            }

            // Tidak perlu update setelah menambahkan, karena role sudah ditambahkan sebelumnya
            $this->session->set_flashdata('success', 'Pengguna berhasil ditambahkan.');
            redirect('user');
        }
    }

    // Edit user data
    public function edit($id)
    {
        if ($this->session->userdata('logged_in') && in_array($this->session->userdata('user_type'), ['admin', 'mediator'])) {
            // Get user data by ID
            $data['user'] = $this->User_model->get_user_by_id($id);

            if ($data['user'] == null) {
                $this->session->set_flashdata('error', 'User tidak ditemukan.');
                redirect('user');
            }

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'min_length[6]');

            if ($this->form_validation->run() === FALSE) {
                // Show the edit form
                $this->load->view('backend/partials/header');
                $this->load->view('backend/user/edit', $data);  // Show the edit view
                $this->load->view('backend/partials/footer');
            } else {
                // Update user data
                $update_data = [
                    'email' => $this->input->post('email')
                ];

                if ($this->input->post('password')) {
                    $update_data['password'] = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                }

                // Update user info
                $this->User_model->update_user($id, $update_data);

                // Update related role data (admin, mediator, pelapor)
                $role_data = [
                    'nama' => $this->input->post('nama'),
                    'telp' => $this->input->post('telp')
                ];

                if ($this->input->post('role') == 'admin') {
                    $this->User_model->update_admin($id, $role_data);
                } elseif ($this->input->post('role') == 'mediator') {
                    $this->User_model->update_mediator($id, $role_data);
                } elseif ($this->input->post('role') == 'pelapor') {
                    $this->User_model->update_pelapor($id, $role_data);
                }

                $this->session->set_flashdata('success', 'User berhasil diperbarui.');
                redirect('user');
            }
        } else {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('auth/login');
        }
    }

    // Delete user
    public function delete($id)
    {
        // Check if user has access
        if ($this->session->userdata('logged_in') && in_array($this->session->userdata('user_type'), ['admin'])) {
            // First, delete related data from the other tables
            $this->User_model->delete_related_data($id);

            // Then delete the user
            $this->User_model->delete_user($id);

            $this->session->set_flashdata('success', 'User berhasil dihapus beserta data terkait.');
            redirect('user');
        } else {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('auth/login');
        }
    }
}
