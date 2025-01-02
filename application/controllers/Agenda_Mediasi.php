<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda_mediasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('agenda_model');
        $this->load->model('Mediator_model');
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

        $data['agendas'] = $this->agenda_model->get_agendas();

        $this->load->view('backend/partials/header', $data);
        $this->load->view('backend/agenda/view', $data);
        $this->load->view('backend/partials/footer', $data);
    }

    public function add()
    {
        // Ambil data mediator
        $data['mediators'] = $this->agenda_model->get_mediators_agenda();

        // Set validation rules for form input
        $this->form_validation->set_rules('nama_pihak_satu', 'Nama Pihak 1', 'required');
        $this->form_validation->set_rules('nama_pihak_dua', 'Nama Pihak 2', 'required');
        $this->form_validation->set_rules('nama_kasus', 'Nama Kasus', 'required');
        $this->form_validation->set_rules('id_mediator', 'Nama Mediator', 'required');
        $this->form_validation->set_rules('tgl_mediasi', 'Tanggal Mediasi', 'required');
        $this->form_validation->set_rules('waktu_mediasi', 'Waktu Mediasi', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required|in_list[disetujui,ditolak,diproses]');
        $this->form_validation->set_rules('tempat', 'Tempat', 'required');
        $this->form_validation->set_rules('jenis_kasus', 'Jenis Kasus', 'required');
        $this->form_validation->set_rules('deskripsi_kasus', 'Deskripsi Kasus', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('backend/partials/header');
            $this->load->view('backend/agenda/add', $data);
            $this->load->view('backend/partials/footer');
        } else {
            // Generate nomor mediasi yang unik
            do {
                $nomor_mediasi = rand(1000, 9999);
            } while ($this->agenda_model->is_nomor_mediasi_exists($nomor_mediasi));

            // Collect form data
            $agenda_data = array(
                'nomor_mediasi' => $nomor_mediasi,
                'nama_pihak_satu' => $this->input->post('nama_pihak_satu'),
                'nama_pihak_dua' => $this->input->post('nama_pihak_dua'),
                'nama_kasus' => $this->input->post('nama_kasus'),
                'id_mediator' => $this->input->post('id_mediator'),  // Menyimpan id_mediator
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

    public function edit($id)
    {
        // Ambil data agenda mediasi berdasarkan ID
        $data['agenda'] = $this->agenda_model->get_agenda_by_id($id);

        if (!$data['agenda']) {
            // Jika data tidak ditemukan, redirect atau tampilkan error
            show_404();
        }

        // Ambil data mediator untuk pilihan pada select box
        $data['mediators'] = $this->Mediator_model->get_mediators();

        // Set form validation rules
        $this->form_validation->set_rules('nama_pihak_satu', 'Nama Pihak 1', 'required');
        $this->form_validation->set_rules('nama_pihak_dua', 'Nama Pihak 2', 'required');
        $this->form_validation->set_rules('nama_kasus', 'Nama Kasus', 'required');
        $this->form_validation->set_rules('id_mediator', 'Nama Mediator', 'required');
        $this->form_validation->set_rules('tgl_mediasi', 'Tanggal Mediasi', 'required');
        $this->form_validation->set_rules('waktu_mediasi', 'Waktu Mediasi', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('tempat', 'Tempat', 'required');
        $this->form_validation->set_rules('jenis_kasus', 'Jenis Kasus', 'required');
        $this->form_validation->set_rules('deskripsi_kasus', 'Deskripsi Kasus', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal, tampilkan form dengan data yang sudah ada
            $this->load->view('backend/partials/header');
            $this->load->view('backend/agenda/edit', $data);
            $this->load->view('backend/partials/footer');
        } else {
            // Ambil data dari form
            $agenda_data = [
                'nama_pihak_satu' => $this->input->post('nama_pihak_satu'),
                'nama_pihak_dua' => $this->input->post('nama_pihak_dua'),
                'nama_kasus' => $this->input->post('nama_kasus'),
                'id_mediator' => $this->input->post('id_mediator'),
                'tgl_mediasi' => $this->input->post('tgl_mediasi'),
                'waktu_mediasi' => $this->input->post('waktu_mediasi'),
                'status' => $this->input->post('status'),
                'tempat' => $this->input->post('tempat'),
                'jenis_kasus' => $this->input->post('jenis_kasus'),
                'deskripsi_kasus' => $this->input->post('deskripsi_kasus')
            ];

            // Update agenda mediasi ke database
            $this->agenda_model->update_agenda($id, $agenda_data);

            // Redirect ke halaman daftar agenda setelah berhasil update
            redirect('agenda_mediasi');
        }
    }

    public function delete($id)
    {
        $this->agenda_model->delete_agenda($id);
        redirect('agenda_mediasi');
    }
}
