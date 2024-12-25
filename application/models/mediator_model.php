<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mediator_model extends CI_Model {

    // Fungsi untuk mengambil data mediator dari database
    public function get_mediators() {
        $query = $this->db->get('mediator');
        return $query->result_array();
    }

    public function add_mediator($data) {
        return $this->db->insert('mediator', $data);
    }

    public function get_mediator_by_id($id) {
        $this->db->where('id_mediator', $id);
        $query = $this->db->get('mediator');
        return $query->row_array();
    }
    
    public function edit_mediator($id, $data) {
        $this->db->where('id_mediator', $id);
        return $this->db->update('mediator', $data);
    }
    
    public function delete_mediator($id) {
        $this->db->where('id_mediator', $id);
        return $this->db->delete('mediator');
    }
    
    
}
