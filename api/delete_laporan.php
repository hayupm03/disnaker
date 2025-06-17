<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Periksa apakah parameter id_laporan ada
if (!isset($data['id_laporan']) || empty($data['id_laporan'])) {
    echo json_encode([
        "status" => false,
        "message" => "ID Laporan wajib diisi!"
    ]);
    exit();
}

$id_laporan = (int)$data['id_laporan'];

// Periksa apakah laporan dengan ID tersebut ada
$checkQuery = "SELECT id_laporan FROM laporan_mediasi WHERE id_laporan = $id_laporan";
$result = $conn->query($checkQuery);

if ($result->num_rows == 0) {
    echo json_encode([
        "status" => false,
        "message" => "Data laporan tidak ditemukan!"
    ]);
    exit();
}

// Hapus data laporan berdasarkan ID
$deleteQuery = "DELETE FROM laporan_mediasi WHERE id_laporan = $id_laporan";
if ($conn->query($deleteQuery) === TRUE) {
    echo json_encode([
        "status" => true,
        "message" => "success",
        "data" => [
            "message" => "Data laporan berhasil dihapus!"
        ]
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Gagal menghapus data laporan: " . $conn->error
    ]);
}

$conn->close();
