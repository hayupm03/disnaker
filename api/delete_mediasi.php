<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Periksa apakah parameter id_mediasi ada
if (!isset($data['id_mediasi']) || empty($data['id_mediasi'])) {
    echo json_encode([
        "status" => false,
        "message" => "ID Mediasi wajib diisi!"
    ]);
    exit();
}

$id_mediasi = (int)$data['id_mediasi'];

// Periksa apakah data mediasi dengan ID tersebut ada
$checkQuery = "SELECT id FROM agenda_mediasi WHERE id = $id_mediasi";
$result = $conn->query($checkQuery);

if ($result->num_rows == 0) {
    echo json_encode([
        "status" => false,
        "message" => "Data mediasi tidak ditemukan!"
    ]);
    exit();
}

// Hapus data mediasi berdasarkan ID
$deleteQuery = "DELETE FROM agenda_mediasi WHERE id = $id_mediasi";
if ($conn->query($deleteQuery) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "success",
        "data" => [
            "message" => "Data mediasi berhasil dihapus!"
        ]
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus data mediasi: " . $conn->error
    ]);
}

$conn->close();
