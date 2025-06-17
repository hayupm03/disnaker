<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Ambil id_pelapor dari data JSON
$id_pelapor = isset($data['id_pelapor']) ? $conn->real_escape_string($data['id_pelapor']) : '';

// Periksa apakah id_pelapor ada
if (empty($id_pelapor)) {
    echo json_encode([
        "status" => false,
        "message" => "Parameter 'id_pelapor' is required."
    ]);
    $conn->close();
    exit();
}

// Ambil tahun sekarang
$current_year = date("Y");

// Query untuk mengambil total berdasarkan status dan tahun sekarang
$sql = "SELECT 
            CASE 
                WHEN COALESCE(l.status, a.status, 'diproses') = 'selesai' THEN 'disetujui'
                WHEN COALESCE(l.status, a.status, 'diproses') = 'gagal' THEN 'ditolak'
                ELSE COALESCE(l.status, a.status, 'diproses')
            END AS status_final,
            COUNT(a.id) AS total
        FROM agenda_mediasi a
        LEFT JOIN laporan_mediasi l ON a.id = l.id_agenda
        WHERE a.id_pelapor = '$id_pelapor'
        AND YEAR(a.tgl_mediasi) = '$current_year'
        GROUP BY status_final";

$result = $conn->query($sql);

$status_counts = [];

// Jika query berhasil dan ada hasil
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $status_counts[$row['status_final']] = (int)$row['total'];
    }
}

// Pastikan semua status ada dalam array meskipun tidak ada di database
$all_statuses = ['disetujui', 'ditolak', 'diproses', 'dilanjut ke pengadilan'];
foreach ($all_statuses as $status) {
    if (!isset($status_counts[$status])) {
        $status_counts[$status] = 0;
    }
}

// Buat response JSON
echo json_encode([
    "status" => true,
    "message" => "success",
    "data" => $status_counts
], JSON_PRETTY_PRINT);

// Tutup koneksi database
$conn->close();
