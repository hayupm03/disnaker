<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cetak extends CI_Controller
{

    public function generate_pdf()
    {
        $this->load->library('Dompdf_lib'); // Memuat library Dompdf_lib

        // Data untuk ditampilkan di PDF
        $data['title'] = 'Judul Dokumen';
        $data['content'] = 'Ini adalah konten PDF.';

        // Load view dan konversi menjadi string
        $html = $this->load->view('pdf_template', $data, TRUE);

        // Muat HTML ke Dompdf
        $this->dompdf_lib->loadHtml($html);

        // Atur ukuran kertas dan orientasi
        $this->dompdf_lib->setPaper('A4', 'portrait');

        // Render PDF
        $this->dompdf_lib->render();

        // Kirimkan ke browser untuk diunduh
        $this->dompdf_lib->stream("contoh.pdf", ["Attachment" => 0]); // 0: Tampilkan di browser, 1: Unduh langsung
    }
}
