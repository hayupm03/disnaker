<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_Mediasi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('agenda_model'); // Memuat model
    }

    public function index() {
        // Mengambil data admin dari model
        $data['agendas'] = $this->agenda_model->get_agendas();

        $this->load->view('backend/partials/header', $data);
        $this->load->view('backend/agenda/view', $data);
        $this->load->view('backend/partials/footer', $data);
    }

    public function add() {
        // Set validation rules for form input
        $this->form_validation->set_rules('nama_pihak1', 'Nama Pihak 1', 'required');
        $this->form_validation->set_rules('nama_pihak2', 'Nama Pihak 2', 'required');
        $this->form_validation->set_rules('nama_kasus', 'Nama Kasus', 'required');
        $this->form_validation->set_rules('tujuan', 'Tujuan', 'required');
        $this->form_validation->set_rules('nama_mediator', 'Nama Mediator', 'required');
        $this->form_validation->set_rules('tgl_mediasi', 'Tanggal Mediasi', 'required');
        $this->form_validation->set_rules('waktu_mediasi', 'Waktu Mediasi', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[disetujui,ditolak,diproses]');
        $this->form_validation->set_rules('tempat', 'Tempat', 'required');
        $this->form_validation->set_rules('jenis_kasus', 'Jenis Kasus', 'required');
        $this->form_validation->set_rules('deskripsi_kasus', 'Deskripsi Kasus', 'required');
    
        if ($this->form_validation->run() === FALSE) {
            // If validation fails, reload the form with validation errors
            $this->load->view('backend/partials/header');
            $this->load->view('backend/agenda/add');
            $this->load->view('backend/partials/footer');
        } else {
            // Collect form data
            $agenda_data = array(
                'nama_pihak1' => $this->input->post('nama_pihak1'),
                'nama_pihak2' => $this->input->post('nama_pihak2'),
                'nama_kasus' => $this->input->post('nama_kasus'),
                'tujuan' => $this->input->post('tujuan'),
                'nama_mediator' => $this->input->post('nama_mediator'),
                'tgl_mediasi' => $this->input->post('tgl_mediasi'),
                'waktu_mediasi' => $this->input->post('waktu_mediasi'),
                'status' => $this->input->post('status'),
                'tempat' => $this->input->post('tempat'),
                'jenis_kasus' => $this->input->post('jenis_kasus'),
                'deskripsi_kasus' => $this->input->post('deskripsi_kasus')
            );
    
            // Pass the data to the model to insert into the database
            $this->agenda_model->add_agenda($agenda_data);
    
            // Redirect to the agenda list page
            redirect('agenda_mediasi');
        }
    }    
}
