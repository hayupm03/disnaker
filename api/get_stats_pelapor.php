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

// Query SQL untuk mendapatkan total kasus per bulan berdasarkan id_pelapor
$sql = "SELECT YEAR(a.tgl_mediasi) AS tahun, MONTH(a.tgl_mediasi) AS bulan, 
               SUM(IFNULL(CASE WHEN COALESCE(l.status, a.status, 'diproses') = 'selesai' THEN 1 ELSE 0 END, 0)) AS total_disetujui,
               SUM(IFNULL(CASE WHEN COALESCE(l.status, a.status, 'diproses') = 'gagal' THEN 1 ELSE 0 END, 0)) AS total_ditolak,
               SUM(IFNULL(CASE WHEN COALESCE(l.status, a.status, 'diproses') = 'diproses' THEN 1 ELSE 0 END, 0)) AS total_diproses,
               SUM(IFNULL(CASE WHEN COALESCE(l.status, a.status, 'diproses') = 'dilanjut ke pengadilan' THEN 1 ELSE 0 END, 0)) AS total_dilanjut_pengadilan
        FROM agenda_mediasi a
        LEFT JOIN laporan_mediasi l ON a.id = l.id_agenda
        WHERE a.id_pelapor = '$id_pelapor'
        GROUP BY YEAR(a.tgl_mediasi), MONTH(a.tgl_mediasi)
        ORDER BY YEAR(a.tgl_mediasi) ASC, MONTH(a.tgl_mediasi) ASC";

$result = $conn->query($sql);

$kasus_per_bulan = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $kasus_per_bulan[] = [
            "tahun" => (int)$row['tahun'],
            "bulan" => (int)$row['bulan'],
            "total_disetujui" => (int)$row['total_disetujui'],
            "total_ditolak" => (int)$row['total_ditolak'],
            "total_diproses" => (int)$row['total_diproses'],
            "total_dilanjut_pengadilan" => (int)$row['total_dilanjut_pengadilan']
        ];
    }
}

// Buat response JSON
$response = [
    "status" => true,
    "message" => "success",
    "data" => $kasus_per_bulan
];

echo json_encode($response, JSON_PRETTY_PRINT);

// Tutup koneksi database
$conn->close();
