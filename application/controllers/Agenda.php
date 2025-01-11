<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('agenda_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $data['agendas'] = $this->agenda_model->get_agendas($user_id);
        $data['mediators'] = $this->agenda_model->get_mediators_agenda();

        $this->load->view('frontend/partials/header');
        $this->load->view('frontend/pages/agenda', $data);
        $this->load->view('frontend/partials/footer');
    }

    public function add()
    {
        // Set validation rules for form input
        $this->form_validation->set_rules('nama_pihak_satu', 'Nama Pihak 1', 'required');
        $this->form_validation->set_rules('nama_pihak_dua', 'Nama Pihak 2', 'required');
        $this->form_validation->set_rules('tgl_mediasi', 'Tanggal Mediasi', 'required');
        $this->form_validation->set_rules('waktu_mediasi', 'Waktu Mediasi', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jenis_kasus', 'Jenis Kasus', 'required');
        $this->form_validation->set_rules('deskripsi_kasus', 'Deskripsi Kasus', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal, redirect kembali ke halaman agenda
            redirect('agenda');
        } else {
            // Generate nomor mediasi yang unik
            do {
                $nomor_mediasi = rand(1000, 9999);
            } while ($this->agenda_model->is_nomor_mediasi_exists($nomor_mediasi));

            $user_id = $this->session->userdata('user_id');

            $agenda_data = array(
                'nomor_mediasi' => $nomor_mediasi,
                'nama_pihak_satu' => $this->input->post('nama_pihak_satu'),
                'nama_pihak_dua' => $this->input->post('nama_pihak_dua'),
                'id_pelapor' => $user_id,
                'tgl_mediasi' => $this->input->post('tgl_mediasi'),
                'waktu_mediasi' => $this->input->post('waktu_mediasi'),
                'status' => "diproses",
                'tempat' => $this->input->post('alamat'),
                'jenis_kasus' => $this->input->post('jenis_kasus'),
                'deskripsi_kasus' => $this->input->post('deskripsi_kasus')
            );

            $this->agenda_model->add_agenda($agenda_data);

            redirect('agenda');
        }
    }

    public function detail($id = null)
    {
        $data['agenda'] = $this->agenda_model->get_agenda_by_id($id);

        $this->load->view('frontend/partials/header');
        $this->load->view('frontend/pages/agenda_detail', $data);
        $this->load->view('frontend/partials/footer');
    }
}
