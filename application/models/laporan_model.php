<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    // Mengambil semua laporan
    public function get_laporans() {
        $query = $this->db->get('pelaporan_mediasi');
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
