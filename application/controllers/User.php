<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model'); // Memuat model User_model
        $this->load->library('form_validation'); // Memuat library form_validation
    }

    // Fungsi untuk menampilkan halaman utama data user
    public function index() {
        if (!$this->session->userdata('logged_in') || 
            !in_array($this->session->userdata('user_type'), ['admin', 'mediator'])) {
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

    public function add() {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
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

            redirect('user');
        }
    }
}