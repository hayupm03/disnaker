<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mediator_model extends CI_Model {

    // Fungsi untuk mengambil data admin dari database
    public function get_mediators() {
        $query = $this->db->get('mediator'); // Tabel 'mediator'
        return $query->result_array(); // Mengembalikan hasil sebagai array
    }
}
