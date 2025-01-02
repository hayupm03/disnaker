<?php
require_once APPPATH . 'third_party/dompdf/autoload.inc.php'; // Sesuaikan jika letak Dompdf berbeda

use Dompdf\Dompdf;
use Dompdf\Options;

class Dompdf_lib
{
    protected $dompdf;

    public function __construct()
    {
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true); // Aktifkan untuk memuat gambar dari URL
        $this->dompdf = new Dompdf($options);
    }

    public function loadHtml($html)
    {
        $this->dompdf->loadHtml($html);
    }

    public function setPaper($size, $orientation = 'portrait')
    {
        $this->dompdf->setPaper($size, $orientation);
    }

    public function render()
    {
        $this->dompdf->render();
    }

    public function stream($filename, $options = [])
    {
        $this->dompdf->stream($filename, $options);
    }

    public function output()
    {
        return $this->dompdf->output();
    }
}
