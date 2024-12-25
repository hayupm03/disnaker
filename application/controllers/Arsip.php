<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index() {
        if (!$this->session->userdata('logged_in') || 
            !in_array($this->session->userdata('user_type'), ['admin', 'mediator'])) {
            $this->session->set_flashdata('error', 'Anda tidak memiliki akses ke halaman ini.');
            redirect('auth/login');
        }
        
        $this->load->view('frontend/partials/header');
        $this->load->view('frontend/pages/arsip');
        $this->load->view('frontend/partials/footer');
    }
}
