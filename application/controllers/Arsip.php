<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
    }

    public function index() {

        $this->load->view('frontend/partials/header');
        $this->load->view('frontend/pages/arsip');
        $this->load->view('frontend/partials/footer');
    }
}
