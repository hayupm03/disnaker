<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile_model extends CI_Model
{

    // Fungsi untuk mendapatkan data admin berdasarkan id_petugas
    public function get_profile($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('admin'); // Assume 'admin' is the table name

        return $query->row_array(); // Return profile data as an array
    }
}
