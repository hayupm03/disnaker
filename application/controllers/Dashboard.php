<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Dashboard_model');
    }

    public function index()
    {
        $this->_check_access(['admin', 'mediator']);

        $agenda_status_totals = $this->Dashboard_model->get_agenda_status_totals();
        $pelaporan_status_totals = $this->Dashboard_model->get_pelaporan_status_totals();

        $data['agenda_status'] = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];
        $monthly_totals = array_fill(0, 12, 0);

        foreach ($agenda_status_totals as $total) {
            $monthly_totals[$total['month'] - 1] = $total['total'];
        }

        $data['agenda_totals'] = $monthly_totals;

        $status_totals = [
            'selesai' => 0,
            'dilanjut ke pengadilan' => 0,
        ];

        foreach ($pelaporan_status_totals as $total) {
            if (isset($status_totals[$total['status']])) {
                $status_totals[$total['status']] = $total['total'];
            }
        }

        $data['total_status_selesai'] = $status_totals['selesai'];
        $data['total_status_lanjut'] = $status_totals['dilanjut ke pengadilan'];

        $data['total_mediator'] = $this->Dashboard_model->get_total_mediator();
        $data['total_pelapor'] = $this->Dashboard_model->get_total_pelapor();
        $data['total_agenda'] = $this->Dashboard_model->get_total_agenda();
        $data['total_laporan'] = $this->Dashboard_model->get_total_laporan();

        $this->_load_backend_view('backend/dashboard', $data);
    }
}
