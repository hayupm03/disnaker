<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

    public function login($email, $password) {
        $query = $this->db->get_where('users', ['email' => $email]);
        $user = $query->row_array();

        // Verifikasi password
        if ($user && password_verify($password, $user['password'])) {
            unset($user['password']); // Jangan simpan password ke session
            return $user;
        }
        return false;
    }

    public function get_user_by_email($email) {
        return $this->db->get_where('users', ['email' => $email])->row();
    }
    
    public function get_user_type($user_id) {
        // Cek tabel admin
        $admin = $this->db->get_where('admin', ['id_user' => $user_id])->row();
        if ($admin) {
            return ['type' => 'admin', 'id' => $admin->id];
        }
    
        // Cek tabel pelapor
        $pelapor = $this->db->get_where('pelapor', ['id_user' => $user_id])->row();
        if ($pelapor) {
            return ['type' => 'pelapor', 'id' => $pelapor->id];
        }
    
        // Cek tabel mediator
        $mediator = $this->db->get_where('mediator', ['id_users' => $user_id])->row();
        if ($mediator) {
            return ['type' => 'mediator', 'id' => $mediator->id_mediator];
        }
    
        return null; // Jika tidak ditemukan
    }
  

    public function register_user($data) {
        return $this->db->insert('users', $data);
    }
    
    public function register_pelapor($data) {
        return $this->db->insert('pelapor', $data);
    }    
}
