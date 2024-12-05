<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_model extends CI_Model {

    // Fungsi untuk mengambil data admin dari database
    public function get_agendas() {
        $query = $this->db->get('agenda_mediasi'); // Tabel 'agenda'
        return $query->result_array(); // Mengembalikan hasil sebagai array
    }
}
