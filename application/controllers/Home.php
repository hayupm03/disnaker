<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

    public function index()
    {
        $this->load->helper('url');

        $this->load->view('frontend/partials/header');
        $this->load->view('frontend/pages/home');
        $this->load->view('frontend/partials/footer');
    }
}
