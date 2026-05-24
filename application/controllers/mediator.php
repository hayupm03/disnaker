<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mediator extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mediator_model');
    }

    public function index()
    {
        $this->_check_access(['admin', 'mediator']);

        $data['mediators'] = $this->Mediator_model->get_mediators();
        $this->_load_backend_view('backend/mediator/view', $data);
    }

    public function add()
    {
        $this->_check_access(['admin']);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('telp', 'Telepon', 'required');
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('bidang', 'Bidang', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() === false) {
            $this->_load_backend_view('backend/mediator/add');
            return;
        }

        $data = [
            'nama' => $this->input->post('nama'),
            'telp' => $this->input->post('telp'),
            'nip' => $this->input->post('nip'),
            'bidang' => $this->input->post('bidang'),
            'email' => $this->input->post('email'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT),
        ];

        if ($this->Mediator_model->add_mediator($data)) {
            $this->session->set_flashdata('success', 'Mediator berhasil ditambahkan.');
            redirect('mediator');
        }

        $this->session->set_flashdata('error', 'Terjadi kesalahan, coba lagi.');
        redirect('mediator/add');
    }

    public function edit($id)
    {
        $this->_check_access(['admin']);

        $data['mediator'] = $this->Mediator_model->get_mediator_by_id($id);

        if ($this->input->post()) {
            $update_data = [
                'nama' => $this->input->post('nama'),
                'telp' => $this->input->post('telp'),
                'nip' => $this->input->post('nip'),
                'bidang' => $this->input->post('bidang'),
                'email' => $this->input->post('email'),
            ];

            $this->Mediator_model->edit_mediator($id, $update_data);
            redirect('mediator');
        }

        $this->_load_backend_view('backend/mediator/edit', $data);
    }

    public function delete($id)
    {
        $this->_check_access(['admin']);
        $this->Mediator_model->delete_mediator($id);
        redirect('mediator');
    }
}
