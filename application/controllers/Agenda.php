<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Agenda_model');
        $this->load->library('upload');
    }

    public function index()
    {
        $user_id = $this->session->userdata('user_id');
        $data['agendas'] = $this->Agenda_model->get_agendas($user_id);
        $data['mediators'] = $this->Agenda_model->get_mediators_agenda();

        $this->load->view('frontend/partials/header');
        $this->load->view('frontend/pages/agenda', $data);
        $this->load->view('frontend/partials/footer');
    }

    public function add()
    {
        $this->form_validation->set_rules('nama_pihak_satu', 'Nama Pihak 1', 'required');
        $this->form_validation->set_rules('nama_pihak_dua', 'Nama Pihak 2', 'required');
        $this->form_validation->set_rules('tgl_mediasi', 'Tanggal Mediasi', 'required');
        $this->form_validation->set_rules('waktu_mediasi', 'Waktu Mediasi', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('jenis_kasus', 'Jenis Kasus', 'required');
        $this->form_validation->set_rules('deskripsi_kasus', 'Deskripsi Kasus', 'required');

        if ($this->form_validation->run() === false) {
            redirect('agenda');
        }

        $nomor_mediasi = $this->_generate_nomor_mediasi();

        $agenda_data = [
            'nomor_mediasi' => $nomor_mediasi,
            'nama_pihak_satu' => $this->input->post('nama_pihak_satu'),
            'nama_pihak_dua' => $this->input->post('nama_pihak_dua'),
            'id_pelapor' => $this->session->userdata('user_id'),
            'tgl_mediasi' => $this->input->post('tgl_mediasi'),
            'waktu_mediasi' => $this->input->post('waktu_mediasi'),
            'status' => 'diproses',
            'tempat' => $this->input->post('alamat'),
            'jenis_kasus' => $this->input->post('jenis_kasus'),
            'deskripsi_kasus' => $this->input->post('deskripsi_kasus'),
        ];

        $this->Agenda_model->add_agenda($agenda_data);
        redirect('agenda');
    }

    public function detail($id = null)
    {
        $data['agenda'] = $this->Agenda_model->get_agenda_by_id($id);

        $this->load->view('frontend/partials/header');
        $this->load->view('frontend/pages/agenda_detail', $data);
        $this->load->view('frontend/partials/footer');
    }

    private function _generate_nomor_mediasi()
    {
        $nomor = (int) date('YmdHis');
        while ($this->Agenda_model->is_nomor_mediasi_exists($nomor)) {
            $nomor++;
        }
        return $nomor;
    }
}
