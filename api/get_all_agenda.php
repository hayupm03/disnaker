<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Query SELECT dengan tambahan JOIN ke tabel mediator untuk mengambil nama mediator
$sql = "SELECT am.*, 
               lm.id_laporan, lm.tgl_penutupan, lm.status AS status_laporan, lm.hasil_mediasi,
               m.nama AS nama_mediator
        FROM agenda_mediasi am
        LEFT JOIN laporan_mediasi lm ON am.id = lm.id_agenda
        LEFT JOIN mediator m ON am.id_mediator = m.id_mediator
        ORDER BY am.tgl_mediasi DESC";

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
