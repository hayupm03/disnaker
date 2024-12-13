<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_model extends CI_Model {

    // Fungsi untuk mengambil data admin dari database
    public function get_laporans() {
        $query = $this->db->get('pelaporan_mediasi'); // Tabel 'laporan'
        return $query->result_array(); // Mengembalikan hasil sebagai array
    }

    public function add_laporan() {
        $data = array(
            'id_agenda' => $this->input->post('id_agenda'),
            'nama_pihak_satu' => $this->input->post('nama_pihak_satu'),
            'nama_pihak_dua' => $this->input->post('nama_pihak_dua'),
            'tgl_agenda' => $this->input->post('tgl_agenda'),
            'tgl_penutupan' => $this->input->post('tgl_penutupan'),
            'jenis_kasus' => $this->input->post('jenis_kasus'),
            'status' => $this->input->post('status'),
            'hasil_mediasi' => $this->input->post('hasil_mediasi')
        );

        return $this->db->insert('laporans', $data); // Insert into 'mediators' table
    }
}
