<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use Dompdf\Dompdf;

class Cetak extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan_model');
    }

    public function laporan()
    {
        $data['title'] = 'Laporan Mediasi';
        $data['media'] = $this->Laporan_model->get_laporan_for_pdf();

        $html = $this->load->view('backend/pdf/laporan', $data, true);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('laporan_media.pdf', ['Attachment' => 0]);
    }
}
