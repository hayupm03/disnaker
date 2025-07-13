<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil data dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Validasi parameter wajib
$required_fields = ['id', 'id_mediator'];
foreach ($required_fields as $field) {
    if (!isset($data[$field])) {
        echo json_encode([
            "status" => false,
            "message" => "Field '$field' harus diisi"
        ]);
        exit();
    }
}

$id = (int) $data['id'];
$id_mediator = (int) $data['id_mediator'];

// Cek apakah data dengan ID tersebut ada
$sql_check = "SELECT id FROM agenda_mediasi WHERE id = $id";
$result = $conn->query($sql_check);

if ($result->num_rows === 0) {
    echo json_encode([
        "status" => false,
        "message" => "Data agenda mediasi dengan ID $id tidak ditemukan"
    ]);
    exit();
}

// Update data
$sql_update = "
    UPDATE agenda_mediasi 
    SET id_mediator = $id_mediator
    WHERE id = $id
";

if ($conn->query($sql_update)) {
    echo json_encode([
        "status" => true,
        "message" => "Data agenda mediasi berhasil diperbarui"
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal memperbarui data: " . $conn->error
    ]);
}

$conn->close();
