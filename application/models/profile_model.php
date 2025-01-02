<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends CI_Model
{
    // Ambil data user dari tabel `users`
    public function get_user_by_id($id_user)
    {
        $this->db->where('id', $id_user);
        $query = $this->db->get('users');
        return $query->row_array();
    }

    // Ambil data admin berdasarkan user_id
    public function get_admin_by_user_id($id_user)
    {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('admin');
        return $query->row_array();
    }

    // Ambil data mediator berdasarkan user_id
    public function get_mediator_by_user_id($id_user)
    {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('mediator');
        return $query->row_array();
    }

    // Ambil data pelapor berdasarkan user_id
    public function get_pelapor_by_user_id($id_user)
    {
        $this->db->where('id_user', $id_user);
        $query = $this->db->get('pelapor');
        return $query->row_array();
    }

    public function verify_password($user_id, $current_password)
    {
        // Verifikasi password lama
        $this->db->where('id', $user_id);
        $user = $this->db->get('users')->row();
        return password_verify($current_password, $user->password);
    }

    public function get_user_role($user_id)
    {
        if ($this->db->where('id_user', $user_id)->get('pelapor')->row()) {
            return 'pelapor';
        } elseif ($this->db->where('id_user', $user_id)->get('mediator')->row()) {
            return 'mediator';
        } elseif ($this->db->where('id_user', $user_id)->get('admin')->row()) {
            return 'admin';
        }
        return null;
    }

    public function update_user($user_id, $data)
    {
        $this->db->where('id', $user_id)->update('users', $data);
    }

    public function update_pelapor($user_id, $data)
    {
        $this->db->where('id_user', $user_id)->update('pelapor', $data);
    }

    public function update_mediator($user_id, $data)
    {
        $this->db->where('id_user', $user_id)->update('mediator', $data);
    }

    public function update_admin($user_id, $data)
    {
        $this->db->where('id_user', $user_id)->update('admin', $data);
    }
}
