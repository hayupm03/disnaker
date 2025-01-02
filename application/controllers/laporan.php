<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model');
        $this->load->model('Agenda_model');
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
        $this->load->view('backend/laporan/view', $data);
        $this->load->view('backend/partials/footer');
    }

    // Tambah laporan
    public function add()
    {
        // Ambil data agenda mediasi yang statusnya sudah "disetujui"
        $this->db->where('status', 'disetujui');
        $data['agenda_mediasi'] = $this->db->get('agenda_mediasi')->result();

        // Cek apakah ada agenda yang dipilih
        if ($this->input->post('agenda_mediasi_id')) {
            $agendaId = $this->input->post('agenda_mediasi_id');
            $selectedAgenda = $this->db->get_where('agenda_mediasi', ['id' => $agendaId])->row();

            // Cek apakah data agenda ada
            if ($selectedAgenda) {
                // Kirim data agenda terpilih ke view
                $data['selectedAgenda'] = $selectedAgenda;
            }
        }

        // Set rules untuk validasi form
        $this->form_validation->set_rules('agenda_mediasi_id', 'Agenda Mediasi', 'required');
        $this->form_validation->set_rules('tgl_penutupan', 'Tanggal Penutupan', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('hasil_mediasi', 'Hasil Mediasi', 'required');

        if ($this->form_validation->run() === FALSE) {
            // Jika validasi gagal, tampilkan halaman tambah laporan
            $this->load->view('backend/partials/header');
            $this->load->view('backend/laporan/add', $data);
            $this->load->view('backend/partials/footer');
        } else {
            // Ambil data dari form
            $laporan_data = [
                'id_agenda' => $this->input->post('agenda_mediasi_id'),
                'tgl_penutupan' => $this->input->post('tgl_penutupan'),
                'status' => $this->input->post('status'),
                'hasil_mediasi' => $this->input->post('hasil_mediasi')
            ];

            // Panggil model untuk menyimpan laporan
            $this->Laporan_model->add_laporan($laporan_data);

            // Redirect ke halaman laporan setelah berhasil
            redirect('laporan');
        }
    }

    public function edit($id)
    {
        // Pastikan model yang dibutuhkan sudah dimuat
        $this->load->model('Laporan_model');
        $this->load->model('Agenda_model');

        // Ambil data laporan mediasi berdasarkan ID
        $data['laporan'] = $this->Laporan_model->getLaporanById($id);

        // Jika data laporan tidak ditemukan, tampilkan halaman 404
        if (empty($data['laporan'])) {
            show_404();
        }

        // Ambil data agenda mediasi yang statusnya disetujui untuk dropdown
        $data['agenda_mediasi'] = $this->Agenda_model->get_agendas();

        // Jika form disubmit
        if ($this->input->post()) {
            // Validasi form
            $this->_validate_form();

            // Jika form valid, lakukan update
            if ($this->form_validation->run()) {
                $laporan_data = [
                    'id_agenda' => $this->input->post('agenda_mediasi_id'),
                    'tgl_penutupan' => $this->input->post('tgl_penutupan'),
                    'status' => $this->input->post('status'),
                    'hasil_mediasi' => $this->input->post('hasil_mediasi')
                ];

                // Update laporan di database
                $this->Laporan_model->update_laporan($id, $laporan_data);

                // Redirect ke halaman laporan setelah berhasil update
                redirect('laporan');
            }
        }

        // Tampilkan form edit dengan data yang sudah ada
        $this->load->view('backend/partials/header');
        $this->load->view('backend/laporan/edit', $data);
        $this->load->view('backend/partials/footer');
    }

    // Hapus laporan
    public function delete($id)
    {
        $this->Laporan_model->delete_laporan($id);
        redirect('laporan');
    }
}
