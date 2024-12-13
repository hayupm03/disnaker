<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class laporan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('laporan_model'); // Memuat model
    }

    public function index() {
        // Mengambil data admin dari model
        $data['laporans'] = $this->laporan_model->get_laporans();

        $this->load->view('backend/partials/header', $data);
        $this->load->view('backend/laporan/view', $data);
        $this->load->view('backend/partials/footer', $data);
    }
    public function add() {
        // Set validation rules
        $this->form_validation->set_rules('id_laporan', 'ID Laporan', 'required|is_unique[lapora .id_laporan]');
        $this->form_validation->set_rules('id_agenda', 'ID Agenda', 'required');
        $this->form_validation->set_rules('nama_pihak_satu', 'Nama Pihak Satu', 'required');
        $this->form_validation->set_rules('nama_pihak_dua', 'Nama Pihak Dua', 'required');
        $this->form_validation->set_rules('tgl_agenda', 'Tanggal Agenda', 'required');
        $this->form_validation->set_rules('tgl_penutupan', 'Tanggal Penutupan', 'required');
        $this->form_validation->set_rules('jenis_kasus', 'Jenis Kasus', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('hasil_mediasi', 'Hasil Mediasi', 'required|valid_email');
        

        if ($this->form_validation->run() === FALSE) {
            // Load view with validation errors
            $this->load->view('backend/partials/header');
            $this->load->view('backend/laporan/add');
            $this->load->view('backend/partials/footer');
        } else {
            // Save mediator data to the database
            $this->Laporan_model->add_mediator();
            redirect('laporan/list'); // Redirect to the mediator list page
        }
    }
}
