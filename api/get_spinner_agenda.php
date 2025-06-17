<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Validasi parameter id_mediator
if (!isset($data['id_mediator']) || empty($data['id_mediator'])) {
    echo json_encode([
        "status" => false,
        "message" => "Parameter id_mediator diperlukan"
    ]);
    exit();
}

// Ambil id_mediator dari request
$id_mediator = $conn->real_escape_string($data['id_mediator']);

// Query untuk mengambil agenda dengan id_mediator tertentu dan belum memiliki laporan
$sql = "SELECT am.* 
        FROM agenda_mediasi am
        LEFT JOIN laporan_mediasi lm ON am.id = lm.id_agenda
        WHERE lm.id_laporan IS NULL 
        AND am.id_mediator = '$id_mediator'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode([
        "status" => true,
        "message" => "success",
        "data" => $data
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Tidak ada agenda yang memenuhi kriteria"
    ]);
}

$conn->close();
