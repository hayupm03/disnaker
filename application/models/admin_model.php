<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {

    // Fungsi untuk mengambil data admin dari database
    public function get_admins() {
        $query = $this->db->get('admin'); // Tabel 'admin'
        return $query->result_array(); // Mengembalikan hasil sebagai array
    }

    public function add_admin() {
        $data = array(
            'name' => $this->input->post('name'),
            'telp' => $this->input->post('telp'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );

        return $this->db->insert('admins', $data); // Insert into 'mediators' table
    }
}
