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
    
    public function getUserProfile($userId) {
        $this->db->select('user.id as user_id, user.email, admin.nama as admin_nama, admin.telp as admin_telp, mediator.nama as mediator_nama, mediator.telp as mediator_telp');
        $this->db->from('users as user');
        $this->db->join('admin', 'admin.id_user = user.id', 'left');
        $this->db->join('mediator', 'mediator.id_users = user.id', 'left');
        $this->db->where('user.id', $userId); // Corrected from users.id to user.id
        $query = $this->db->get();
        return $query->row_array(); // Return a single row of user data
    }
    
    // Update data for the admin user
    public function updateAdmin($adminId, $data) {
        $this->db->where('id', $adminId);
        return $this->db->update('admin', $data); // Update the admin table
    }
    
    // Update data for the mediator user
    public function updateMediator($mediatorId, $data) {
        $this->db->where('id_mediator', $mediatorId); // Corrected the ID field name for mediator
        return $this->db->update('mediator', $data); // Update the mediator table
    }
    
    // Update general user data
    public function updateUser($userId, $data) {
        $this->db->where('id', $userId); // Use the correct user id column
        return $this->db->update('users', $data); // Update the users table
    }

    public function getUserById($userId) {
        $this->db->select('id, email');  // You can select other fields as needed
        $this->db->from('users');
        $this->db->where('id', $userId); // Where clause to match the user_id
        $query = $this->db->get();
        return $query->row_array(); // Return a single row of user data
    }
}

