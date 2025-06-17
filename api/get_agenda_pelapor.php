<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id_pelapor'])) {
    echo json_encode([
        "status" => false,
        "message" => "Parameter id_pelapor diperlukan"
    ]);
    exit();
}

$id_pelapor = $conn->real_escape_string($data['id_pelapor']);

// Query SELECT
$sql = "SELECT am.*, lm.id_laporan, lm.tgl_penutupan, lm.status AS status_laporan, lm.hasil_mediasi
        FROM agenda_mediasi am
        LEFT JOIN laporan_mediasi lm ON am.id = lm.id_agenda
        WHERE am.id_pelapor = '$id_pelapor'
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
        "message" => "Tidak ada data untuk id_pelapor ini"
    ]);
}

$conn->close();
