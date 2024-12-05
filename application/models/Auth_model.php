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

    public function register($data) {
        return $this->db->insert('users', $data);
    }
}
