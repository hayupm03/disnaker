<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends CI_Model
{
    public function get_user_by_id($id_user)
    {
        return $this->db->get_where('users', ['id' => $id_user])->row_array();
    }

    public function get_admin_by_user_id($id_user)
    {
        return $this->db->get_where('admin', ['id_user' => $id_user])->row_array();
    }

    public function get_mediator_by_user_id($id_user)
    {
        return $this->db->get_where('mediator', ['id_user' => $id_user])->row_array();
    }

    public function get_pelapor_by_user_id($id_user)
    {
        return $this->db->get_where('pelapor', ['id_user' => $id_user])->row_array();
    }

    public function get_user_role($user_id)
    {
        if ($this->db->where('id_user', $user_id)->get('pelapor')->row()) {
            return 'pelapor';
        }
        if ($this->db->where('id_user', $user_id)->get('mediator')->row()) {
            return 'mediator';
        }
        if ($this->db->where('id_user', $user_id)->get('admin')->row()) {
            return 'admin';
        }
        return null;
    }

    public function get_user_profile_data($user_id)
    {
        $user = $this->get_user_by_id($user_id);
        if (!$user) {
            return null;
        }

        $admin = $this->get_admin_by_user_id($user_id);
        $mediator = $this->get_mediator_by_user_id($user_id);
        $pelapor = $this->get_pelapor_by_user_id($user_id);

        $details = [];
        $profile_image = null;

        if ($admin) {
            $details = $admin;
            $profile_image = $admin['profile'] ?? null;
        } elseif ($mediator) {
            $details = $mediator;
            $profile_image = $mediator['profile'] ?? null;
        } elseif ($pelapor) {
            $details = $pelapor;
            $profile_image = $pelapor['profile'] ?? null;
        }

        return [
            'user' => $user,
            'user_details' => $details,
            'profile_image' => $profile_image,
        ];
    }

    public function verify_password($user_id, $current_password)
    {
        $user = $this->db->get_where('users', ['id' => $user_id])->row();
        return $user && password_verify($current_password, $user->password);
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
