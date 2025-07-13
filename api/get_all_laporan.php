<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Query SELECT hanya menampilkan yang statusnya "disetujui"
$sql = "SELECT 
    a.id, 
    a.id_mediator, 
    a.id_pelapor, 
    a.nomor_mediasi, 
    a.nama_pihak_satu, 
    a.nama_pihak_dua, 
    a.nama_kasus, 
    a.tgl_mediasi, 
    a.waktu_mediasi, 
    'disetujui' AS status, 
    a.tempat, 
    a.jenis_kasus, 
    a.deskripsi_kasus, 
    a.file_pdf, 
    l.id_laporan, 
    l.tgl_penutupan, 
    l.hasil_mediasi
FROM 
    agenda_mediasi a
INNER JOIN 
    laporan_mediasi l 
ON 
    a.id = l.id_agenda
WHERE 
    l.status IN ('selesai', 'gagal', 'dilanjut ke pengadilan')
ORDER BY 
    a.tgl_mediasi DESC;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode([
        "status" => true,
        "message" => "Data ditemukan",
        "data" => $data
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Tidak ada data yang ditemukan"
    ]);
}

$conn->close();
