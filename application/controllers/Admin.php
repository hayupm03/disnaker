<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model'); // Memuat model
    }

    public function index() {
        // Mengambil data admin dari model
        $data['admins'] = $this->Admin_model->get_admins();

        $this->load->view('backend/partials/header', $data);
        $this->load->view('backend/admin/view', $data);
        $this->load->view('backend/partials/footer', $data);
    }

    public function add() {
        // Set validation rules
        $this->form_validation->set_rules('id', 'ID ', 'required|is_unique[admin.id]');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('telp', 'Telepon', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() === FALSE) {
            // Load view with validation errors
            $this->load->view('backend/partials/header');
            $this->load->view('backend/admin/add');
            $this->load->view('backend/partials/footer');
        } else {
            // Save mediator data to the database
            $this->Admin_model->add_mediator();
            redirect('admin/list'); // Redirect to the mediator list page
        }
    }
}
