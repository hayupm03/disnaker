<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

    // Mengambil semua laporan dengan informasi dari tabel agenda_mediasi
    public function get_laporans()
    {
        $this->db->select('laporan_mediasi.*, agenda_mediasi.nama_pihak_satu, agenda_mediasi.nama_pihak_dua, agenda_mediasi.tempat');
        $this->db->from('laporan_mediasi');
        $this->db->join('agenda_mediasi', 'agenda_mediasi.id = laporan_mediasi.id_agenda', 'left');
        $query = $this->db->get();
        return $query->result_array();
    }

    // Mengambil laporan berdasarkan ID
    public function get_laporan_by_id($id)
    {
        $this->db->where('id_laporan', $id);
        $query = $this->db->get('laporan_mediasi');
        return $query->row_array();
    }

    // Menambah laporan
    public function add_laporan($data)
    {
        return $this->db->insert('laporan_mediasi', $data);
    }

    // Mengedit laporan
    public function update_laporan($id, $data)
    {
        $this->db->where('id_laporan', $id);
        return $this->db->update('laporan_mediasi', $data);
    }

    // Menghapus laporan
    public function delete_laporan($id)
    {
        $this->db->where('id_laporan', $id);
        return $this->db->delete('laporan_mediasi');
    }
}
