<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda_model extends CI_Model {

    // Fungsi untuk mengambil data agenda dari database
    public function get_agendas() {
        $query = $this->db->get('agenda_mediasi'); // Tabel 'agenda'
        return $query->result_array(); // Mengembalikan hasil sebagai array
    }

    public function add_agenda($data) {
        // Insert the data into the 'agenda_mediasi' table
        return $this->db->insert('agenda_mediasi', $data);
    }    
}
