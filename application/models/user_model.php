<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{

    // Fungsi untuk mengambil data user dari database dengan relasi
    public function get_users()
    {
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
        $this->db->join('mediator', 'mediator.id_user = users.id', 'left');

        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_admins()
    {
        $query = $this->db->get('admin');
        return $query->result_array();
    }

    public function get_pelapors()
    {
        $query = $this->db->get('pelapor');
        return $query->result_array();
    }

    public function get_mediators()
    {
        $query = $this->db->get('mediator');
        return $query->result_array();
    }

    public function add_user($data)
    {
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function add_admin($data)
    {
        return $this->db->insert('admin', $data);
    }

    public function add_pelapor($data)
    {
        return $this->db->insert('pelapor', $data);
    }

    public function add_mediator($data)
    {
        return $this->db->insert('mediator', $data);
    }

    public function getUserProfile($userId)
    {
        $this->db->select('user.id as user_id, user.email, admin.nama as admin_nama, admin.telp as admin_telp, mediator.nama as mediator_nama, mediator.telp as mediator_telp');
        $this->db->from('users as user');
        $this->db->join('admin', 'admin.id_user = user.id', 'left');
        $this->db->join('mediator', 'mediator.id_users = user.id', 'left');
        $this->db->where('user.id', $userId);
        $query = $this->db->get();
        return $query->row_array();
    }

    // Update data for the admin user
    public function updateAdmin($adminId, $data)
    {
        $this->db->where('id', $adminId);
        return $this->db->update('admin', $data); // Update the admin table
    }

    // Update data for the mediator user
    public function updateMediator($mediatorId, $data)
    {
        $this->db->where('id_mediator', $mediatorId); // Corrected the ID field name for mediator
        return $this->db->update('mediator', $data); // Update the mediator table
    }

    // Update general user data
    public function updateUser($userId, $data)
    {
        $this->db->where('id', $userId);
        return $this->db->update('users', $data);
    }

    public function get_user_by_id($id)
    {
        $this->db->select('users.id, users.email, users.password, 
                       admin.nama as admin_name, admin.telp as admin_telp, admin.alamat as admin_alamat,
                       mediator.nama as mediator_name, mediator.telp as mediator_telp, mediator.alamat as mediator_alamat,
                       mediator.bidang as mediator_bidang, mediator.nip as mediator_nip,
                       pelapor.nama as pelapor_name, pelapor.telp as pelapor_telp, pelapor.alamat as pelapor_alamat, pelapor.perusahaan as pelapor_perusahaan');
        $this->db->from('users');
        $this->db->join('admin', 'admin.id_user = users.id', 'left');
        $this->db->join('mediator', 'mediator.id_user = users.id', 'left');
        $this->db->join('pelapor', 'pelapor.id_user = users.id', 'left');
        $this->db->where('users.id', $id);
        return $this->db->get()->row_array();
    }

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('users', $data);
    }

    public function update_admin($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('admin', $data);
    }

    public function update_mediator($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('mediator', $data);
    }

    public function update_pelapor($id, $data)
    {
        $this->db->where('id_user', $id);
        $this->db->update('pelapor', $data);
    }

    public function delete_related_data($id)
    {
        // Delete related data from mediator table
        $this->db->where('id_user', $id);
        $this->db->delete('mediator');

        // Delete related data from pelapor table
        $this->db->where('id_user', $id);
        $this->db->delete('pelapor');

        // Delete related data from admin table
        $this->db->where('id_user', $id);
        $this->db->delete('admin');
    }

    // Delete user by ID
    public function delete_user($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }

    // Function to update user password if needed
    public function update_user_password($id, $password)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', ['password' => $password]);
    }
}

