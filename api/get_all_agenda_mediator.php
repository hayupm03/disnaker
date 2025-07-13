<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil data JSON dari body request
$input = json_decode(file_get_contents("php://input"), true);

if (isset($input['id_mediator'])) {
    $idMediator = intval($input['id_mediator']);

    $sql = "SELECT am.*, 
                   lm.id_laporan, lm.tgl_penutupan, lm.status AS status_laporan, lm.hasil_mediasi,
                   m.nama AS nama_mediator
            FROM agenda_mediasi am
            LEFT JOIN laporan_mediasi lm ON am.id = lm.id_agenda
            LEFT JOIN mediator m ON am.id_mediator = m.id_mediator
            WHERE am.id_mediator = ?
            ORDER BY am.tgl_mediasi DESC";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idMediator);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        echo json_encode([
            "status" => true,
            "message" => "Data ditemukan",
            "data" => $data
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Tidak ada data yang ditemukan"
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        "status" => false,
        "message" => "Parameter id_mediator wajib dikirim"
    ]);
}

$conn->close();
