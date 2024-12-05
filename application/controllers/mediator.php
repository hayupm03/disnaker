<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mediator extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('mediator_model'); // Memuat model
    }

    public function index() {
        // Mengambil data admin dari model
        $data['mediator'] = $this->mediator_model->get_mediators();

        $this->load->view('backend/partials/header', $data);
        $this->load->view('backend/mediator/view', $data);
        $this->load->view('backend/partials/footer', $data);
    }
}
