<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('agenda_model'); // Memuat model
        $this->load->helper('form');
        $this->load->library('form_validation');
    }

    public function index() {
        // Mengambil data admin dari model
        $data['agendas'] = $this->agenda_model->get_agendas();

        $this->load->view('frontend/partials/header');
        $this->load->view('frontend/pages/agenda', $data);
        $this->load->view('frontend/partials/footer');
    }
}
