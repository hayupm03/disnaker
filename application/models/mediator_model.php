<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mediator_model extends CI_Model
{
    public function get_mediators()
    {
        $this->db->select('mediator.*, users.email');
        $this->db->from('mediator');
        $this->db->join('users', 'mediator.id_user = users.id', 'left');
        return $this->db->get()->result_array();
    }

    public function add_mediator($data)
    {
        return $this->db->insert('mediator', $data);
    }

    public function get_mediator_by_id($id)
    {
        $this->db->where('id_mediator', $id);
        $query = $this->db->get('mediator');
        return $query->row_array();
    }

    public function edit_mediator($id, $data)
    {
        $this->db->where('id_mediator', $id);
        return $this->db->update('mediator', $data);
    }

    public function delete_mediator($id)
    {
        $this->db->where('id_mediator', $id);
        return $this->db->delete('mediator');
    }
}
