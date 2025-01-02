<?php
class AgendaModel extends CI_Model {

    public function countStatus() {
        // Menghitung total berdasarkan status
        $this->db->select('status, COUNT(id) as total');
        $this->db->from('agenda_mediasi');
        $this->db->group_by('status');
        $query = $this->db->get();
        
        // Mengubah hasil query menjadi array yang lebih mudah diakses
        $result = $query->result_array();
        $statusCounts = [
            'disetujui' => 0,
            'ditolak' => 0,
            'diproses' => 0
        ];

        // Menyusun hasil status
        foreach ($result as $row) {
            if (isset($statusCounts[$row['status']])) {
                $statusCounts[$row['status']] = $row['total'];
            }
        }

        return $statusCounts;
    }
}
