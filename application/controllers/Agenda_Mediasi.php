<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda_mediasi extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Agenda_model');
        $this->load->model('Mediator_model');
    }

    public function index()
    {
        $this->_check_access(['admin', 'mediator']);

        $data['agendas'] = $this->Agenda_model->get_agendas();
        $this->_load_backend_view('backend/agenda/view', $data);
    }

    public function add()
    {
        $this->_check_access(['admin', 'mediator']);

        $data['mediators'] = $this->Agenda_model->get_mediators_agenda();

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

        if ($this->form_validation->run() === false) {
            $this->_load_backend_view('backend/agenda/add', $data);
            return;
        }

        $nomor_mediasi = $this->_generate_nomor_mediasi();

        $uploaded_file = $this->_handle_file_upload();
        if ($uploaded_file === false) {
            $data['upload_error'] = $this->upload->display_errors();
            $this->_load_backend_view('backend/agenda/add', $data);
            return;
        }

        $agenda_data = [
            'nomor_mediasi' => $nomor_mediasi,
            'nama_pihak_satu' => $this->input->post('nama_pihak_satu'),
            'nama_pihak_dua' => $this->input->post('nama_pihak_dua'),
            'nama_kasus' => $this->input->post('nama_kasus'),
            'id_mediator' => $this->input->post('id_mediator'),
            'tgl_mediasi' => $this->input->post('tgl_mediasi'),
            'waktu_mediasi' => $this->input->post('waktu_mediasi'),
            'status' => $this->input->post('status'),
            'tempat' => $this->input->post('tempat'),
            'jenis_kasus' => $this->input->post('jenis_kasus'),
            'deskripsi_kasus' => $this->input->post('deskripsi_kasus'),
            'file_pdf' => $uploaded_file,
        ];

        $this->Agenda_model->add_agenda($agenda_data);
        redirect('agenda_mediasi');
    }

    public function edit($id)
    {
        $this->_check_access(['admin', 'mediator']);

        $data['agenda'] = $this->Agenda_model->get_agenda_by_id($id);
        if (!$data['agenda']) {
            show_404();
        }

        $data['mediators'] = $this->Mediator_model->get_mediators();

        $this->form_validation->set_rules('nama_pihak_satu', 'Nama Pihak 1', 'required');
        $this->form_validation->set_rules('nama_pihak_dua', 'Nama Pihak 2', 'required');
        $this->form_validation->set_rules('nama_kasus', 'Nama Kasus', 'required');
        $this->form_validation->set_rules('id_mediator', 'Nama Mediator', 'required');
        $this->form_validation->set_rules('tgl_mediasi', 'Tanggal Mediasi', 'required');
        $this->form_validation->set_rules('waktu_mediasi', 'Waktu Mediasi', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('jenis_kasus', 'Jenis Kasus', 'required');
        $this->form_validation->set_rules('deskripsi_kasus', 'Deskripsi Kasus', 'required');

        if ($this->form_validation->run() === false) {
            $this->_load_backend_view('backend/agenda/edit', $data);
            return;
        }

        $uploaded_file = $data['agenda']['file_pdf'];

        if (!empty($_FILES['file_pdf']['name'])) {
            $config['upload_path'] = './uploads/agenda_files/';
            $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
            $config['max_size'] = 2048;
            $config['file_name'] = 'agenda_' . time();

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file_pdf')) {
                if (!empty($uploaded_file) && file_exists('./uploads/agenda_files/' . $uploaded_file)) {
                    unlink('./uploads/agenda_files/' . $uploaded_file);
                }
                $uploaded_file = $this->upload->data('file_name');
            } else {
                $data['upload_error'] = $this->upload->display_errors();
                $this->_load_backend_view('backend/agenda/edit', $data);
                return;
            }
        }

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
            'deskripsi_kasus' => $this->input->post('deskripsi_kasus'),
            'file_pdf' => $uploaded_file,
        ];

        $this->Agenda_model->update_agenda($id, $agenda_data);
        redirect('agenda_mediasi');
    }

    public function delete($id)
    {
        $this->_check_access(['admin', 'mediator']);
        $this->Agenda_model->delete_agenda($id);
        redirect('agenda_mediasi');
    }

    private function _generate_nomor_mediasi()
    {
        $nomor = (int) date('YmdHis');
        while ($this->Agenda_model->is_nomor_mediasi_exists($nomor)) {
            $nomor++;
        }
        return $nomor;
    }

    private function _handle_file_upload()
    {
        if (empty($_FILES['file_pdf']['name'])) {
            return null;
        }

        $config['upload_path'] = './uploads/agenda_files/';
        $config['allowed_types'] = 'jpg|jpeg|png|pdf|doc|docx';
        $config['max_size'] = 2048;
        $config['file_name'] = 'agenda_' . time();

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file_pdf')) {
            return $this->upload->data('file_name');
        }

        return false;
    }
}
