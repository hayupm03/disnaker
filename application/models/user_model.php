<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
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
        $this->db->join('admin', 'admin.id_user = users.id', 'left');
        $this->db->join('pelapor', 'pelapor.id_user = users.id', 'left');
        $this->db->join('mediator', 'mediator.id_user = users.id', 'left');
        return $this->db->get()->result_array();
    }

    public function get_user_by_id($id)
    {
        $this->db->select('
            users.id, users.email, users.password,
            admin.nama as admin_name, admin.telp as admin_telp, admin.alamat as admin_alamat,
            mediator.nama as mediator_name, mediator.telp as mediator_telp,
            mediator.alamat as mediator_alamat, mediator.bidang as mediator_bidang,
            mediator.nip as mediator_nip,
            pelapor.nama as pelapor_name, pelapor.telp as pelapor_telp,
            pelapor.alamat as pelapor_alamat, pelapor.perusahaan as pelapor_perusahaan
        ');
        $this->db->from('users');
        $this->db->join('admin', 'admin.id_user = users.id', 'left');
        $this->db->join('mediator', 'mediator.id_user = users.id', 'left');
        $this->db->join('pelapor', 'pelapor.id_user = users.id', 'left');
        $this->db->where('users.id', $id);
        return $this->db->get()->row_array();
    }

    public function get_admins()
    {
        return $this->db->get('admin')->result_array();
    }

    public function get_pelapors()
    {
        return $this->db->get('pelapor')->result_array();
    }

    public function get_mediators()
    {
        return $this->db->get('mediator')->result_array();
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

    public function update_user($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('users', $data);
    }

    public function update_admin($id, $data)
    {
        $this->db->where('id_user', $id);
        return $this->db->update('admin', $data);
    }

    public function update_mediator($id, $data)
    {
        $this->db->where('id_user', $id);
        return $this->db->update('mediator', $data);
    }

    public function update_pelapor($id, $data)
    {
        $this->db->where('id_user', $id);
        return $this->db->update('pelapor', $data);
    }

    public function delete_related_data($id)
    {
        $this->db->where('id_user', $id)->delete('mediator');
        $this->db->where('id_user', $id)->delete('pelapor');
        $this->db->where('id_user', $id)->delete('admin');
    }

    public function delete_user($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('users');
    }
}
