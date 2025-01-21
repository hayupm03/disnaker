<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{

    // Mengambil semua laporan dengan informasi dari tabel agenda_mediasi
    public function get_laporans()
    {
        $this->db->select('laporan_mediasi.*, agenda_mediasi.nama_pihak_satu, agenda_mediasi.nama_pihak_dua, agenda_mediasi.tgl_mediasi, agenda_mediasi.jenis_kasus, agenda_mediasi.tempat');
        $this->db->from('laporan_mediasi');
        $this->db->join('agenda_mediasi', 'agenda_mediasi.id = laporan_mediasi.id_agenda', 'left');
        $this->db->order_by('agenda_mediasi.tgl_mediasi', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getLaporanById($id)
    {
        // Query to get laporan_mediasi with agenda_mediasi details
        $this->db->select('laporan_mediasi.*, agenda_mediasi.nama_pihak_satu, agenda_mediasi.nama_pihak_dua, agenda_mediasi.nama_kasus, agenda_mediasi.tgl_mediasi, agenda_mediasi.waktu_mediasi, agenda_mediasi.jenis_kasus');
        $this->db->from('laporan_mediasi');
        $this->db->join('agenda_mediasi', 'agenda_mediasi.id = laporan_mediasi.id_agenda', 'left');
        $this->db->where('laporan_mediasi.id_laporan', $id);
        $query = $this->db->get();
        return $query->row_array();  // Return the result as an array
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

    public function getLaporan()
    {
        $this->db->select('
            laporan_mediasi.*,
            agenda_mediasi.nama_kasus,
            agenda_mediasi.nama_pihak_satu,
            agenda_mediasi.nama_pihak_dua,
            mediator.nama AS nama_mediator
        ');
        $this->db->from('laporan_mediasi');
        $this->db->join('agenda_mediasi', 'laporan_mediasi.id_agenda = agenda_mediasi.id', 'left');
        $this->db->join('mediator', 'agenda_mediasi.id_mediator = mediator.id_mediator', 'left');
        return $this->db->get()->result_array();
    }
}
