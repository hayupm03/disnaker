<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Arsip extends CI_Controller {

    public function index()
    {
        $this->load->helper('url');
        
        $this->load->view('frontend/partials/header');
        $this->load->view('frontend/pages/arsip');
        $this->load->view('frontend/partials/footer');
    }
}
