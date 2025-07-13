<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil data dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Validasi parameter wajib
$required_fields = ['id', 'status', 'waktu_mediasi', 'tgl_mediasi','tempat_mediasi'];
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
$status = $conn->real_escape_string($data['status']);
$waktu_mediasi = $conn->real_escape_string($data['waktu_mediasi']);
$tempat_mediasi = $conn->real_escape_string($data['tempat_mediasi']);
$tgl_mediasi = $conn->real_escape_string($data['tgl_mediasi']);

// Validasi nilai status
$valid_status = ['disetujui', 'ditolak', 'diproses'];
if (!in_array($status, $valid_status)) {
    echo json_encode([
        "status" => false,
        "message" => "Status tidak valid, pilih antara: disetujui, ditolak, atau diproses"
    ]);
    exit();
}

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
    SET
        status = '$status', 
        waktu_mediasi = '$waktu_mediasi',
        tempat = '$tempat_mediasi',
        tgl_mediasi = '$tgl_mediasi'
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
