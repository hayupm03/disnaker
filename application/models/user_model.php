<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    // Fungsi untuk mengambil data user dari database dengan relasi
    public function get_users() {
        $this->db->select('
            users.id, 
            users.email, 
            users.password, 
            admin.nama AS admin_name, 
            pelapor.nama AS pelapor_name, 
            mediator.nama AS mediator_name,
            admin.telp AS admin_telp, 
            pelapor.telp AS pelapor_telp, 
            mediator.telp AS mediator_telp
        ');
        
        $this->db->from('users');
        
        // Join dengan tabel admin
        $this->db->join('admin', 'admin.id_user = users.id', 'left');
        
        // Join dengan tabel pelapor
        $this->db->join('pelapor', 'pelapor.id_user = users.id', 'left');
        
        // Join dengan tabel mediator
        $this->db->join('mediator', 'mediator.id_users = users.id', 'left');
        
        $query = $this->db->get();
        return $query->result_array(); // Mengembalikan hasil sebagai array
    }    

    public function get_admins() {
        $query = $this->db->get('admin');
        return $query->result_array();
    }
    
    public function get_pelapors() {
        $query = $this->db->get('pelapor');
        return $query->result_array();
    }
    
    public function get_mediators() {
        $query = $this->db->get('mediator');
        return $query->result_array();
    }
    
    public function add_user($data) {
        $this->db->insert('users', $data);
        return $this->db->insert_id(); // Mengembalikan ID user yang baru ditambahkan
    }
    
    public function add_admin($data) {
        return $this->db->insert('admin', $data);
    }
    
    public function add_pelapor($data) {
        return $this->db->insert('pelapor', $data);
    }
    
    public function add_mediator($data) {
        return $this->db->insert('mediator', $data);
    }    
}
