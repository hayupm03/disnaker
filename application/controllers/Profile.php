<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');  // Load the model to retrieve user data
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->library('form_validation');

        // Ensure the user is logged in
        if (!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
    }

    // Display the profile page
    public function index()
    {
        // Get the user ID from the session
        $userId = $this->session->userdata('user_id');

        // Retrieve user data based on user_id
        $userData = $this->user_model->getUserProfile($userId);
        $data['user'] = $userData; // Send profile data to the view

        // Retrieve additional user data if necessary
        $userById = $this->user_model->getUserById($userId);
        $data['user_details'] = $userById; // Additional details for the profile

        // Load the profile page
        $this->load->view('backend/partials/header', $data);
        $this->load->view('backend/profile/profile', $data);
        $this->load->view('backend/partials/footer');
    }

    // Function to update the user profile
    public function update()
    {
        $userId = $this->session->userdata('user_id');

        // Form validation
        $this->form_validation->set_rules('name', 'Nama', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'required');

        if ($this->form_validation->run() == FALSE) {
            // If validation fails, reload the profile page
            $this->index();
        } else {
            // Get updated data from the form
            $updatedData = [
                'nama' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'telp' => $this->input->post('phone'),
                'alamat' => $this->input->post('address') // Assuming the address field exists
            ];

            // Update user profile data
            if ($this->user_model->updateUser($userId, $updatedData)) {
                // If successful, set success message and redirect
                $this->session->set_flashdata('success', 'Profil berhasil diperbarui.');
                redirect('profile');
            } else {
                // If there's an error, set error message and reload the profile page
                $this->session->set_flashdata('error', 'Terjadi kesalahan saat memperbarui profil.');
                $this->index();
            }
        }
    }

    public function profile()
    {
        // Ambil data pengguna dari session atau database
        $user_id = $this->session->userdata('id_user');
        
        // Misalnya, ambil data profil pengguna dari model (sesuaikan dengan struktur database)
        $this->load->model('profile_model');
        $data['user'] = $this->user_model->get_user_by_id($id_user);

        // Tampilkan halaman profil
        $this->load->view('frontend/partials/header');
        $this->load->view('frontend/pages/profile', $data);
        $this->load->view('frontend/partials/footer');
    }
}

