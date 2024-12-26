<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model');
        $this->load->library('form_validation');
    }

    // Menampilkan daftar laporan
    public function index()
    {
        if (
            !$this->session->userdata('logged_in') ||
            !in_array($this->session->userdata('user_type'), ['admin', 'mediator'])
        ) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('auth/login');
        }

        // Mengambil data laporan
        $data['laporans'] = $this->Laporan_model->get_laporans();

        // Menampilkan view
        $this->load->view('backend/partials/header');
        $this->load->view('backend/laporan/view', $data); // Pastikan view ini sudah ada
        $this->load->view('backend/partials/footer');
    }

    // Tambah laporan
    public function add()
    {
        $this->form_validation->set_rules('nama_pihak_satu', 'Nama Pihak 1', 'required');
        $this->form_validation->set_rules('nama_pihak_dua', 'Nama Pihak 2', 'required');
        $this->form_validation->set_rules('tgl_agenda', 'Tanggal Agenda', 'required');
        $this->form_validation->set_rules('tgl_penutupan', 'Tanggal Penutupan', 'required');
        $this->form_validation->set_rules('jenis_kasus', 'Jenis Kasus', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('hasil_mediasi', 'Hasil Mediasi', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('backend/partials/header');
            $this->load->view('backend/laporan/add');
            $this->load->view('backend/partials/footer');
        } else {
            $data = $this->input->post();
            $this->Laporan_model->add_laporan($data);
            redirect('laporan');
        }
    }

    // Edit laporan
    public function edit($id)
    {
        $data['laporan'] = $this->Laporan_model->get_laporan_by_id($id);

        $this->form_validation->set_rules('nama_pihak_satu', 'Nama Pihak 1', 'required');
        $this->form_validation->set_rules('nama_pihak_dua', 'Nama Pihak 2', 'required');
        $this->form_validation->set_rules('tgl_agenda', 'Tanggal Agenda', 'required');
        $this->form_validation->set_rules('tgl_penutupan', 'Tanggal Penutupan', 'required');
        $this->form_validation->set_rules('jenis_kasus', 'Jenis Kasus', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('hasil_mediasi', 'Hasil Mediasi', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('backend/partials/header');
            $this->load->view('backend/laporan/edit', $data);
            $this->load->view('backend/partials/footer');
        } else {
            $update_data = $this->input->post();
            $this->Laporan_model->update_laporan($id, $update_data);
            redirect('laporan');
        }
    }

    // Hapus laporan
    public function delete($id)
    {
        $this->Laporan_model->delete_laporan($id);
        redirect('laporan');
    }
}
