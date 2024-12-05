<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Profile_model'); // Memuat model
    }

    // Fungsi untuk menampilkan profil admin berdasarkan ID
    public function index() {
        // Mengambil data profil dari model
        $data['profile'] = $this->Profile_model->get_profile();

        $this->load->view('backend/profile', $data);
    }
}
