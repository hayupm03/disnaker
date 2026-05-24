<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_Model
{
    public function get_user_by_email($email)
    {
        return $this->db->get_where('users', ['email' => $email])->row_array();
    }

    public function get_user_type($user_id)
    {
        $admin = $this->db->get_where('admin', ['id_user' => $user_id])->row_array();
        if ($admin) {
            return ['type' => 'admin', 'id' => $admin['id'], 'nama' => $admin['nama']];
        }

        $pelapor = $this->db->get_where('pelapor', ['id_user' => $user_id])->row_array();
        if ($pelapor) {
            return ['type' => 'pelapor', 'id' => $pelapor['id'], 'nama' => $pelapor['nama']];
        }

        $mediator = $this->db->get_where('mediator', ['id_user' => $user_id])->row_array();
        if ($mediator) {
            return ['type' => 'mediator', 'id' => $mediator['id_mediator'], 'nama' => $mediator['nama']];
        }

        return null;
    }

    public function register_user($data)
    {
        return $this->db->insert('users', $data);
    }

    public function register_pelapor($data)
    {
        return $this->db->insert('pelapor', $data);
    }
}
