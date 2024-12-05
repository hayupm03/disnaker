<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile_model extends CI_Model {

    // Fungsi untuk mendapatkan data admin berdasarkan id_petugas
    public function get_profile($id_petugas) {
        $this->db->where('id_petugas', $id_petugas);
        $query = $this->db->get('admin'); // Tabel 'admin'
        return $query->row_array(); // Mengembalikan satu baris hasil
    }
}
