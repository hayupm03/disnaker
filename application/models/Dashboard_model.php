<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function get_total_mediator()
    {
        return $this->db->count_all('mediator');
    }

    public function get_total_pelapor()
    {
        return $this->db->count_all('pelapor');
    }

    public function get_total_agenda()
    {
        return $this->db->count_all('agenda_mediasi');
    }

    public function get_total_laporan()
    {
        return $this->db->count_all('laporan_mediasi');
    }

    public function get_agenda_status_totals()
    {
        $this->db->select('MONTH(tgl_mediasi) as month, COUNT(*) as total');
        $this->db->group_by('month');
        $this->db->order_by('month', 'ASC');
        return $this->db->get('agenda_mediasi')->result_array();
    }

    public function get_pelaporan_status_totals()
    {
        $this->db->select('status, COUNT(*) as total');
        $this->db->where_in('status', ['selesai', 'dilanjut ke pengadilan']);
        $this->db->group_by('status');
        return $this->db->get('laporan_mediasi')->result_array();
    }
}
