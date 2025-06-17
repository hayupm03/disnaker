<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id_mediator'])) {
    echo json_encode([
        "status" => false,
        "message" => "Parameter id_mediator diperlukan"
    ]);
    exit();
}

$id_mediator = $conn->real_escape_string($data['id_mediator']);

// Query SELECT dengan JOIN antara agenda_mediasi dan laporan_mediasi
$sql = "SELECT am.*, lm.id_laporan, lm.tgl_penutupan, lm.status AS status_laporan, lm.hasil_mediasi
        FROM agenda_mediasi am
        LEFT JOIN laporan_mediasi lm ON am.id = lm.id_agenda
        WHERE am.id_mediator = '$id_mediator'";

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
        "message" => "Tidak ada data untuk id_mediator ini"
    ]);
}

$conn->close();
