<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        if (
            !$this->session->userdata('logged_in') ||
            !in_array($this->session->userdata('user_type'), ['admin', 'mediator'])
        ) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('auth/login');
        }

        // Ambil data agenda mediasi per bulan
        $agenda_status_totals = $this->Dashboard_model->get_agenda_status_totals();
        $pelaporan_status_totals = $this->Dashboard_model->get_pelaporan_status_totals();

        // Siapkan data untuk chart agenda
        $data['agenda_status'] = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $monthly_totals = array_fill(0, 12, 0);  // Inisialisasi dengan 0 untuk 12 bulan

        foreach ($agenda_status_totals as $total) {
            $monthly_totals[$total['month'] - 1] = $total['total'];
        }

        $data['agenda_totals'] = $monthly_totals;

        // Siapkan data untuk chart pelaporan
        $data['pelaporan_status'] = array_column($pelaporan_status_totals, 'status');
        $data['pelaporan_totals'] = array_column($pelaporan_status_totals, 'total');

        // Data untuk card
        $data['total_mediator'] = $this->Dashboard_model->get_total_mediator();
        $data['total_pelapor'] = $this->Dashboard_model->get_total_pelapor();
        $data['total_agenda'] = $this->Dashboard_model->get_total_agenda();
        $data['total_laporan'] = $this->Dashboard_model->get_total_laporan();

        $this->load->view('backend/partials/header');
        $this->load->view('backend/dashboard', $data);
        $this->load->view('backend/partials/footer');
    }
}
