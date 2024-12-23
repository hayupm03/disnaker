<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mediator_model extends CI_Model {

    // Fungsi untuk mengambil data mediator dari database
    public function get_mediators() {
        $query = $this->db->get('mediator'); // Tabel 'mediators' (perbaiki sesuai nama tabel)
        return $query->result_array(); // Mengembalikan hasil sebagai array
    }

    public function add_mediator() {
        // Mengambil data dari form dan memasukkan ke dalam array $data
        $data = array(
            'id_mediator' => $this->input->post('id_mediator'),
            'nama' => $this->input->post('nama'),
            'telp' => $this->input->post('telp'),
            'nip' => $this->input->post('nip'),
            'bidang' => $this->input->post('bidang'),
            'email' => $this->input->post('email'),
            'password' => md5($this->input->post('password')) // Menggunakan md5 untuk password
        );

        // Insert into 'mediators' table
        return $this->db->insert('mediator', $data);
    }

    public function get_mediator_by_id($id) {
        $this->db->where('id_mediator', $id);
        $query = $this->db->get('mediator');
        return $query->row_array(); // Mengembalikan data sebagai array
    }
    
    public function edit_mediator($id, $data) {
        $this->db->where('id_mediator', $id);
        return $this->db->update('mediator', $data);
    }
    
    public function delete_mediator($id) {
        $this->db->where('id_mediator', $id);
        return $this->db->delete('mediator');
    }
    
    
}
