<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Ambil id_user dari data JSON
$id_user = isset($data['id_user']) ? $conn->real_escape_string($data['id_user']) : '';

// Periksa apakah id_user ada
if (empty($id_user)) {
    echo json_encode([
        "status" => false,
        "message" => "Parameter 'id_user' is required."
    ]);
    $conn->close();
    exit();
}

// Query untuk mendapatkan data user dan data terkait dari pelapor, mediator, atau admin
$sql = "
SELECT 
    u.id,
    u.email,
    p.id_laporan,
    p.nama AS pelapor_nama,
    p.telp AS pelapor_telp,
    p.perusahaan,
    p.alamat AS pelapor_alamat,
    p.profile AS pelapor_profile,
    NULL AS nip,
    'pelapor' AS user_type
FROM users u
LEFT JOIN pelapor p ON u.id = p.id_user
WHERE u.id = '$id_user' AND p.id_user IS NOT NULL

UNION ALL

SELECT 
    u.id,
    u.email,
    m.id_mediator AS id_laporan,
    m.nama AS pelapor_nama,
    m.telp AS pelapor_telp,
    m.bidang AS perusahaan,
    m.alamat AS pelapor_alamat,
    m.profile AS pelapor_profile,
    m.nip AS nip,
    'mediator' AS user_type
FROM users u
LEFT JOIN mediator m ON u.id = m.id_user
WHERE u.id = '$id_user' AND m.id_user IS NOT NULL

UNION ALL

SELECT 
    u.id,
    u.email,
    a.id AS id_laporan,
    a.nama AS pelapor_nama,
    a.telp AS pelapor_telp,
    '' AS perusahaan,
    a.alamat AS pelapor_alamat,
    a.profile AS pelapor_profile,
    NULL AS nip,
    'admin' AS user_type
FROM users u
LEFT JOIN admin a ON u.id = a.id_user
WHERE u.id = '$id_user' AND a.id_user IS NOT NULL
";

$result = $conn->query($sql);

// Cek apakah data ditemukan
if ($result && $result->num_rows > 0) {
    $user_data = $result->fetch_assoc();

    // Format response berdasarkan tipe user
    $response_data = [
        "user_info" => [
            "id" => $user_data['id'],
            "email" => $user_data['email']
        ],
        "user_type" => $user_data['user_type']
    ];

    // Tambahkan data spesifik berdasarkan tipe user
    switch ($user_data['user_type']) {
        case 'pelapor':
            $response_data['pelapor_info'] = [
                "id_laporan" => $user_data['id_laporan'],
                "nama" => $user_data['pelapor_nama'],
                "telp" => $user_data['pelapor_telp'],
                "perusahaan" => $user_data['perusahaan'],
                "alamat" => $user_data['pelapor_alamat'],
                "profile" => $user_data['pelapor_profile']
            ];
            break;

        case 'mediator':
            $response_data['mediator_info'] = [
                "id_mediator" => $user_data['id_laporan'],
                "nama" => $user_data['pelapor_nama'],
                "telp" => $user_data['pelapor_telp'],
                "bidang" => $user_data['perusahaan'],
                "alamat" => $user_data['pelapor_alamat'],
                "nip" => $user_data['nip'],
                "profile" => $user_data['pelapor_profile']
            ];
            break;

        case 'admin':
            $response_data['admin_info'] = [
                "id" => $user_data['id_laporan'],
                "nama" => $user_data['pelapor_nama'],
                "telp" => $user_data['pelapor_telp'],
                "alamat" => $user_data['pelapor_alamat'],
                "profile" => $user_data['pelapor_profile']
            ];
            break;
    }

    echo json_encode([
        "status" => true,
        "message" => "User ditemukan.",
        "data" => $response_data
    ], JSON_PRETTY_PRINT);
} else {
    echo json_encode([
        "status" => false,
        "message" => "User tidak ditemukan di pelapor, mediator, atau admin.",
        "data" => null
    ], JSON_PRETTY_PRINT);
}

// Tutup koneksi database
$conn->close();
