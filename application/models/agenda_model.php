<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Agenda_model extends CI_Model
{
    public function get_agendas($id = null)
    {
        $this->db->select('agenda_mediasi.*, mediator.nama as nama_mediator');
        $this->db->from('agenda_mediasi');
        $this->db->join('mediator', 'mediator.id_mediator = agenda_mediasi.id_mediator', 'left');
        $this->db->order_by('agenda_mediasi.tgl_mediasi', 'DESC');
        if ($id !== null) {
            $this->db->where('agenda_mediasi.id_pelapor', $id);
        }

        return $this->db->get()->result_array();
    }

    public function get_agenda_by_id($id)
    {
        $this->db->select('
            agenda_mediasi.*,
            mediator.nama as nama_mediator,
            mediator.telp as telp_mediator,
            mediator.nip as nip_mediator,
            mediator.bidang as bidang_mediator
        ');
        $this->db->from('agenda_mediasi');
        $this->db->join('mediator', 'agenda_mediasi.id_mediator = mediator.id_mediator', 'left');
        $this->db->where('agenda_mediasi.id', $id);
        return $this->db->get()->row_array();
    }

    public function get_mediators_agenda()
    {
        return $this->db->get('mediator')->result_array();
    }

    public function add_agenda($data)
    {
        return $this->db->insert('agenda_mediasi', $data);
    }

    public function update_agenda($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('agenda_mediasi', $data);
    }

    public function delete_agenda($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('agenda_mediasi');
    }

    public function is_nomor_mediasi_exists($nomor_mediasi)
    {
        $this->db->where('nomor_mediasi', $nomor_mediasi);
        return $this->db->get('agenda_mediasi')->num_rows() > 0;
    }
}
