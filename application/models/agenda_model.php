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

    public function is_nomor_mediasi_exists($nomor_mediasi) {
        $this->db->where('nomor_mediasi', $nomor_mediasi);
        $query = $this->db->get('agenda_mediasi');
        return $query->num_rows() > 0;
    }    

    public function save_agenda($data) {
        // Menyimpan data agenda ke tabel agenda_mediasi
        $this->db->insert('agenda_mediasi', $data);
    }

    public function update_agenda($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('agenda_mediasi', $data);
    }

    public function get_agenda_by_id($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('agenda_mediasi');
        return $query->row_array();
    }

    public function edit_agenda($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update('agenda_mediasi', $data);
    }

    public function delete_agenda($id) {
        $this->db->where('id', $id);
        return $this->db->delete('agenda_mediasi');
    }
}
