<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Validasi input
if (!isset($data['id_agenda']) || !isset($data['tgl_penutupan']) || !isset($data['status']) || !isset($data['hasil_mediasi'])) {
    echo json_encode([
        "status" => false,
        "message" => "All fields are required"
    ]);
    $conn->close();
    exit();
}

// Ambil data dari JSON
$id_agenda = $conn->real_escape_string($data['id_agenda']);
$tgl_penutupan = $conn->real_escape_string($data['tgl_penutupan']);
$status = $conn->real_escape_string($data['status']);
$hasil_mediasi = $conn->real_escape_string($data['hasil_mediasi']);

// Query untuk insert ke tabel `laporan_mediasi`
$sql = "INSERT INTO `laporan_mediasi` (`id_agenda`, `tgl_penutupan`, `status`, `hasil_mediasi`) 
        VALUES ('$id_agenda', '$tgl_penutupan', '$status', '$hasil_mediasi')";

if ($conn->query($sql) === true) {
    echo json_encode([
        "status" => true,
        "message" => "Laporan mediasi berhasil disimpan!",
        "id_laporan" => $conn->insert_id
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Error inserting data",
        "details" => $conn->error
    ]);
}

// Tutup koneksi
$conn->close();
