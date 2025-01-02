<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    // Menghitung total mediator
    public function get_total_mediator()
    {
        return $this->db->count_all('mediator');
    }

    // Menghitung total pelapor
    public function get_total_pelapor()
    {
        return $this->db->count_all('pelapor');
    }

    // Menghitung total agenda
    public function get_total_agenda()
    {
        return $this->db->count_all('agenda_mediasi');
    }

    // Menghitung total laporan
    public function get_total_laporan()
    {
        return $this->db->count_all('laporan_mediasi');
    }

    // Menghitung total berdasarkan status di tabel agenda_mediasi
    public function get_agenda_status_totals()
    {
        $this->db->select('MONTH(tgl_mediasi) as month, COUNT(*) as total');
        $this->db->group_by('month');
        $this->db->order_by('month', 'ASC');  // Untuk mengurutkan bulan dari Januari sampai Desember
        return $this->db->get('agenda_mediasi')->result_array();
    }

    // Menghitung total berdasarkan status di tabel pelaporan_mediasi
    public function get_pelaporan_status_totals()
    {
        $this->db->select('status, COUNT(*) as total');
        $this->db->group_by('status');
        return $this->db->get('laporan_mediasi')->result_array();
    }
}
