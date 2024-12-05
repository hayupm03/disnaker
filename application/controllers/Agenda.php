<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Agenda_model'); // Memuat model
    }

    public function index() {
        // Mengambil data admin dari model
        $data['agendas'] = $this->Agenda_model->get_agendas();

        $this->load->view('backend/partials/header', $data);
        $this->load->view('backend/agenda/view', $data);
        $this->load->view('backend/partials/footer', $data);
    }
}
