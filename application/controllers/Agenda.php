<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('agenda_model'); // Memuat model
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('upload');
    }

    public function index() {
        // Mengambil data admin dari model
        $data['agendas'] = $this->agenda_model->get_agendas();

        $this->load->view('frontend/partials/header');
        $this->load->view('frontend/pages/agenda', $data);
        $this->load->view('frontend/partials/footer');
    }

    public function save() {
        // Validasi form
        $this->form_validation->set_rules('nama_pihak1', 'Nama Pihak 1', 'required');
        $this->form_validation->set_rules('nama_pihak2', 'Nama Pihak 2', 'required');
        $this->form_validation->set_rules('nama_kasus', 'Nama Kasus', 'required');
        $this->form_validation->set_rules('nama_mediator', 'Nama Mediator', 'required');
        $this->form_validation->set_rules('tgl_mediasi', 'Tanggal Mediasi', 'required');
        $this->form_validation->set_rules('waktu_mediasi', 'Waktu Mediasi', 'required');
        $this->form_validation->set_rules('tempat', 'Tempat Mediasi', 'required');
        $this->form_validation->set_rules('jenis_kasus', 'Jenis Kasus', 'required');
        $this->form_validation->set_rules('deskripsi_kasus', 'Deskripsi Kasus', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal, kembali ke form
            $this->load->view('frontend/partials/header');
            $this->load->view('frontend/pages/agenda');
            $this->load->view('frontend/partials/footer');
        } else {
            // Mengunggah file PDF
            $config['upload_path'] = './uploads/'; // Path tempat menyimpan file
            $config['allowed_types'] = 'pdf'; // Hanya PDF yang diperbolehkan
            $config['max_size'] = 2048; // Maksimal ukuran file 2MB
            $this->upload->initialize($config);

            if ($this->upload->do_upload('file_pdf')) {
                // Jika file berhasil di-upload, ambil nama file-nya
                $file_data = $this->upload->data();
                $file_name = $file_data['file_name'];
            } else {
                // Jika file gagal di-upload
                $file_name = null; // Atau bisa set pesan error
            }
            // Generate a unique 4-digit number for nomor_mediasi
            $this->load->model('agenda_model');
            do {
                $nomor_mediasi = rand(1000, 9999); // Generate a random 4-digit number
            } while ($this->agenda_model->is_nomor_mediasi_exists($nomor_mediasi)); // Check if it exists in the database

            // Menyimpan data ke database
            $agenda_data = array(
                'nomor_mediasi' => $nomor_mediasi,
                'nama_pihak1' => $this->input->post('nama_pihak1'),
                'nama_pihak2' => $this->input->post('nama_pihak2'),
                'nama_kasus' => $this->input->post('nama_kasus'),
                'nama_mediator' => $this->input->post('nama_mediator'),
                'tgl_mediasi' => $this->input->post('tgl_mediasi'),
                'waktu_mediasi' => $this->input->post('waktu_mediasi'),
                'status' => 'diproses',
                'tempat' => $this->input->post('tempat'),
                'jenis_kasus' => $this->input->post('jenis_kasus'),
                'deskripsi_kasus' => $this->input->post('deskripsi_kasus'),
                'file_pdf' => $file_name
            );

            // Simpan agenda ke database
            $this->agenda_model->save_agenda($agenda_data);

            // Redirect atau tampilkan pesan sukses
            redirect('agenda');
        }
    } 

    public function detail($id = null) {
        if (!$id) {
            redirect('agenda');
        }
    
        // Ambil data berdasarkan ID
        $data['agenda'] = $this->agenda_model->get_agenda_by_id($id);
    
        // Jika data tidak ditemukan
        if (empty($data['agenda'])) {
            show_404();
        }
    
        $this->load->view('frontend/partials/header');
        $this->load->view('frontend/pages/agenda_detail', $data);
        $this->load->view('frontend/partials/footer');
    }
}
