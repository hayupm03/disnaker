<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Fungsi untuk menghasilkan nomor mediasi unik
function generateUniqueNomorMediasi($conn)
{
    do {
        // Buat nomor acak 4 digit
        $nomor_mediasi = rand(1000, 9999);
        // Cek apakah nomor tersebut sudah ada di database
        $sql_check = "SELECT COUNT(*) AS count FROM `agenda_mediasi` WHERE `nomor_mediasi` = '$nomor_mediasi'";
        $result = $conn->query($sql_check);
        $row = $result->fetch_assoc();
    } while ($row['count'] > 0); // Jika sudah ada, ulangi proses

    return $nomor_mediasi;
}

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Validasi input
if (
    !isset($data['id_pelapor']) || !isset($data['nama_pihak_satu']) ||
    !isset($data['nama_pihak_dua']) || !isset($data['tgl_mediasi']) ||
    !isset($data['waktu_mediasi']) ||
    !isset($data['jenis_kasus']) || !isset($data['deskripsi_kasus'])
) {
    echo json_encode([
        "status" => false,
        "message" => "All fields are required"
    ]);
    $conn->close();
    exit();
}

// Ambil data dari JSON dan hindari SQL Injection
$id_pelapor = $conn->real_escape_string($data['id_pelapor']);
$nama_pihak_satu = $conn->real_escape_string($data['nama_pihak_satu']);
$nama_pihak_dua = $conn->real_escape_string($data['nama_pihak_dua']);
$tgl_mediasi = $conn->real_escape_string($data['tgl_mediasi']);
$waktu_mediasi = $conn->real_escape_string($data['waktu_mediasi']);
$jenis_kasus = $conn->real_escape_string($data['jenis_kasus']);
$deskripsi_kasus = $conn->real_escape_string($data['deskripsi_kasus']);

// Status langsung di-set ke 'diproses'
$status = 'diproses';

// Generate nomor mediasi unik
$nomor_mediasi = generateUniqueNomorMediasi($conn);

// Query untuk menyimpan data ke tabel agenda_mediasi
$sql = "INSERT INTO `agenda_mediasi` (`id_pelapor`, `nomor_mediasi`, `nama_pihak_satu`, `nama_pihak_dua`, `tgl_mediasi`, `waktu_mediasi`, `status`, `jenis_kasus`, `deskripsi_kasus`) 
        VALUES ('$id_pelapor', '$nomor_mediasi', '$nama_pihak_satu', '$nama_pihak_dua', '$tgl_mediasi', '$waktu_mediasi', '$status', '$jenis_kasus', '$deskripsi_kasus')";

if ($conn->query($sql) === true) {
    echo json_encode([
        "status" => true,
        "message" => "Agenda mediasi berhasil ditambahkan!",
        "id" => $conn->insert_id,
        "nomor_mediasi" => $nomor_mediasi
    ]);
} else {
    echo json_encode([
        "status" => false,
        "message" => "Error inserting data into 'agenda_mediasi' table",
        "details" => $conn->error
    ]);
}

// Tutup koneksi
$conn->close();
