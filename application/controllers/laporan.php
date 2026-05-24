<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model');
        $this->load->model('Agenda_model');
    }

    public function index()
    {
        $this->_check_access(['admin', 'mediator']);

        $data['laporans'] = $this->Laporan_model->get_laporans();
        $this->_load_backend_view('backend/laporan/view', $data);
    }

    public function add()
    {
        $this->_check_access(['admin', 'mediator']);

        $data['agenda_mediasi'] = $this->Laporan_model->get_approved_agendas();

        if ($this->input->post('agenda_mediasi_id')) {
            $selected = $this->Laporan_model->get_agenda_by_id($this->input->post('agenda_mediasi_id'));
            if ($selected) {
                $data['selectedAgenda'] = $selected;
            }
        }

        $this->form_validation->set_rules('agenda_mediasi_id', 'Agenda Mediasi', 'required');
        $this->form_validation->set_rules('tgl_penutupan', 'Tanggal Penutupan', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('hasil_mediasi', 'Hasil Mediasi', 'required');

        if ($this->form_validation->run() === false) {
            $this->_load_backend_view('backend/laporan/add', $data);
            return;
        }

        $laporan_data = [
            'id_agenda' => $this->input->post('agenda_mediasi_id'),
            'tgl_penutupan' => $this->input->post('tgl_penutupan'),
            'status' => $this->input->post('status'),
            'hasil_mediasi' => $this->input->post('hasil_mediasi'),
        ];

        $this->Laporan_model->add_laporan($laporan_data);
        redirect('laporan');
    }

    public function edit($id)
    {
        $this->_check_access(['admin', 'mediator']);

        $data['laporan'] = $this->Laporan_model->get_laporan_by_id($id);

        if (empty($data['laporan'])) {
            show_404();
        }

        $data['agenda_mediasi'] = $this->Agenda_model->get_agendas();

        $this->form_validation->set_rules('agenda_mediasi_id', 'Agenda Mediasi', 'required');
        $this->form_validation->set_rules('tgl_penutupan', 'Tanggal Penutupan', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
        $this->form_validation->set_rules('hasil_mediasi', 'Hasil Mediasi', 'required');

        if ($this->form_validation->run()) {
            $laporan_data = [
                'id_agenda' => $this->input->post('agenda_mediasi_id'),
                'tgl_penutupan' => $this->input->post('tgl_penutupan'),
                'status' => $this->input->post('status'),
                'hasil_mediasi' => $this->input->post('hasil_mediasi'),
            ];

            $this->Laporan_model->update_laporan($id, $laporan_data);
            redirect('laporan');
        }

        $this->_load_backend_view('backend/laporan/edit', $data);
    }

    public function delete($id)
    {
        $this->_check_access(['admin', 'mediator']);
        $this->Laporan_model->delete_laporan($id);
        redirect('laporan');
    }
}
