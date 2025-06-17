<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Ambil id_mediator dari data JSON
$id_mediator = isset($data['id_mediator']) ? $conn->real_escape_string($data['id_mediator']) : '';

// Periksa apakah id_mediator ada
if (empty($id_mediator)) {
    echo json_encode([
        "status" => false,
        "message" => "Parameter 'id_mediator' is required."
    ]);
    $conn->close();
    exit();
}

// Query SQL dengan 'dilanjut ke pengadilan' masuk ke total_disetujui
$sql = "SELECT YEAR(a.tgl_mediasi) AS tahun, MONTH(a.tgl_mediasi) AS bulan, 
               SUM(
                   IFNULL(
                       CASE 
                           WHEN COALESCE(l.status, a.status, 'diproses') IN ('selesai', 'dilanjut ke pengadilan') 
                           THEN 1 ELSE 0 
                       END, 0)
               ) AS total_disetujui,
               SUM(IFNULL(CASE WHEN COALESCE(l.status, a.status, 'diproses') = 'gagal' THEN 1 ELSE 0 END, 0)) AS total_ditolak,
               SUM(IFNULL(CASE WHEN COALESCE(l.status, a.status, 'diproses') = 'diproses' THEN 1 ELSE 0 END, 0)) AS total_diproses
        FROM agenda_mediasi a
        LEFT JOIN laporan_mediasi l ON a.id = l.id_agenda
        WHERE a.id_mediator = '$id_mediator'
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
            "total_diproses" => (int)$row['total_diproses']
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
