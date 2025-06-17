<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id_mediasi'])) {
    echo json_encode([
        "status" => false,
        "message" => "Parameter id_mediasi diperlukan"
    ]);
    exit();
}

$id_agenda = $conn->real_escape_string($data['id_mediasi']);

// Query SELECT dengan JOIN antara agenda_mediasi, laporan_mediasi, dan mediator
$sql = "SELECT am.*, 
               lm.id_laporan, lm.tgl_penutupan, lm.status AS status_laporan, lm.hasil_mediasi,
               m.nama AS nama_mediator
        FROM agenda_mediasi am
        LEFT JOIN laporan_mediasi lm ON am.id = lm.id_agenda
        LEFT JOIN mediator m ON am.id_mediator = m.id_mediator
        WHERE am.id = '$id_agenda'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode([
        "status" => true,
        "message" => "Data ditemukan",
        "data" => $row
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Tidak ada data untuk id_agenda ini"
    ]);
}

$conn->close();
