<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;

class Dompdf_gen
{
    public $dompdf;

    public function __construct()
    {
        // Memuat autoloader Composer
        require_once APPPATH . '../vendor/autoload.php';

        // Inisialisasi Dompdf
        $this->dompdf = new Dompdf();
    }
}
