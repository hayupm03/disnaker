<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
    public function get_laporans()
    {
        $this->db->select('
            laporan_mediasi.*,
            agenda_mediasi.nama_pihak_satu,
            agenda_mediasi.nama_pihak_dua,
            agenda_mediasi.tgl_mediasi,
            agenda_mediasi.jenis_kasus,
            agenda_mediasi.tempat
        ');
        $this->db->from('laporan_mediasi');
        $this->db->join('agenda_mediasi', 'agenda_mediasi.id = laporan_mediasi.id_agenda', 'left');
        $this->db->order_by('agenda_mediasi.tgl_mediasi', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_laporan_by_id($id)
    {
        $this->db->select('
            laporan_mediasi.*,
            agenda_mediasi.nama_pihak_satu,
            agenda_mediasi.nama_pihak_dua,
            agenda_mediasi.nama_kasus,
            agenda_mediasi.tgl_mediasi,
            agenda_mediasi.waktu_mediasi,
            agenda_mediasi.jenis_kasus
        ');
        $this->db->from('laporan_mediasi');
        $this->db->join('agenda_mediasi', 'agenda_mediasi.id = laporan_mediasi.id_agenda', 'left');
        $this->db->where('laporan_mediasi.id_laporan', $id);
        return $this->db->get()->row_array();
    }

    public function get_laporan_for_pdf()
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

    public function get_approved_agendas()
    {
        $this->db->where('status', 'disetujui');
        return $this->db->get('agenda_mediasi')->result_array();
    }

    public function get_agenda_by_id($id)
    {
        return $this->db->get_where('agenda_mediasi', ['id' => $id])->row_array();
    }

    public function add_laporan($data)
    {
        return $this->db->insert('laporan_mediasi', $data);
    }

    public function update_laporan($id, $data)
    {
        $this->db->where('id_laporan', $id);
        return $this->db->update('laporan_mediasi', $data);
    }

    public function delete_laporan($id)
    {
        $this->db->where('id_laporan', $id);
        return $this->db->delete('laporan_mediasi');
    }
}
