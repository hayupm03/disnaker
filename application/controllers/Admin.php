<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Admin_model'); // Memuat model
    }

    public function index() {
        // Mengambil data admin dari model
        $data['admins'] = $this->Admin_model->get_admins();

        $this->load->view('backend/partials/header', $data);
        $this->load->view('backend/admin/view', $data);
        $this->load->view('backend/partials/footer', $data);
    }
}
