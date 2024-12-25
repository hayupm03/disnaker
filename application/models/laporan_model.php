<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    // Mengambil semua laporan dengan informasi dari tabel agenda_mediasi
    public function get_laporans() {
        $this->db->select('pelaporan_mediasi.*, agenda_mediasi.nama_pihak1, agenda_mediasi.nama_pihak2, agenda_mediasi.tempat');
        $this->db->from('pelaporan_mediasi');
        $this->db->join('agenda_mediasi', 'agenda_mediasi.id = pelaporan_mediasi.id_agenda', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Mengambil laporan berdasarkan ID
    public function get_laporan_by_id($id) {
        $this->db->where('id_laporan', $id);
        $query = $this->db->get('pelaporan_mediasi');
        return $query->row_array();
    }

    // Menambah laporan
    public function add_laporan($data) {
        return $this->db->insert('pelaporan_mediasi', $data);
    }

    // Mengedit laporan
    public function update_laporan($id, $data) {
        $this->db->where('id_laporan', $id);
        return $this->db->update('pelaporan_mediasi', $data);
    }

    // Menghapus laporan
    public function delete_laporan($id) {
        $this->db->where('id_laporan', $id);
        return $this->db->delete('pelaporan_mediasi');
    }
}