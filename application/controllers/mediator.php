<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mediator extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Mediator_model'); // Pastikan model dimuat dengan benar
    }

    public function index() {
        // Mengambil data mediator dari model
        $data['mediators'] = $this->Mediator_model->get_mediators(); // Perbaiki nama model

        $this->load->view('backend/partials/header', $data);
        $this->load->view('backend/mediator/view', $data);
        $this->load->view('backend/partials/footer', $data);
    }

    public function add() {
        // Set validation rules
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('telp', 'Telepon', 'required');
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('bidang', 'Bidang', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() === FALSE) {
            // Load view with validation errors
            $this->load->view('backend/partials/header');
            $this->load->view('backend/mediator/add');
            $this->load->view('backend/partials/footer');
        } else {
            // Save mediator data to the database
            $this->Mediator_model->add_mediator();
            redirect('mediator'); // Redirect to the mediator list page
        }
    }
}
