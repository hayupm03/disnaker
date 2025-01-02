<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mediator extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mediator_model'); // Pastikan model dimuat dengan benar
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

        $data['mediators'] = $this->Mediator_model->get_mediators();

        // Memuat tampilan dengan data
        $this->load->view('backend/partials/header', $data);
        $this->load->view('backend/mediator/view', $data);
        $this->load->view('backend/partials/footer');
    }


    public function add()
    {
        // Set validation rules
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('telp', 'Telepon', 'required');
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('bidang', 'Bidang', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() === FALSE) {
            // If validation fails, reload the add mediator form with errors
            $this->load->view('backend/partials/header');
            $this->load->view('backend/mediator/add');
            $this->load->view('backend/partials/footer');
        } else {
            // Prepare data for insertion
            $data = array(
                'nama'     => $this->input->post('nama'),
                'telp'     => $this->input->post('telp'),
                'nip'      => $this->input->post('nip'),
                'bidang'   => $this->input->post('bidang'),
                'email'    => $this->input->post('email'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT) // Hash the password for security
            );

            // Insert the mediator data into the database
            if ($this->Mediator_model->add_mediator($data)) {
                // Redirect to the mediator list page after successful insertion
                $this->session->set_flashdata('success', 'Mediator berhasil ditambahkan.');
                redirect('mediator');
            } else {
                // Handle errors if insertion fails
                $this->session->set_flashdata('error', 'Terjadi kesalahan, coba lagi.');
                redirect('mediator/add');
            }
        }
    }

    public function edit($id)
    {
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

        $this->load->view('backend/partials/header', $data);
        $this->load->view('backend/mediator/edit', $data);
        $this->load->view('backend/partials/footer');
    }

    public function delete($id)
    {
        $this->Mediator_model->delete_mediator($id);
        redirect('mediator');
    }
}
