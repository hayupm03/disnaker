<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Validasi input
if (
    !isset($data['email']) || !isset($data['password']) || !isset($data['nama']) ||
    !isset($data['telp']) || !isset($data['perusahaan']) || !isset($data['alamat'])
) {
    echo json_encode([
        "status" => false,
        "message" => "All fields are required"
    ]);
    $conn->close();
    exit();
}

// Ambil data dari JSON
$email = $conn->real_escape_string($data['email']);
$password = $conn->real_escape_string($data['password']);
$nama = $conn->real_escape_string($data['nama']);
$telp = $conn->real_escape_string($data['telp']);
$perusahaan = $conn->real_escape_string($data['perusahaan']);
$alamat = $conn->real_escape_string($data['alamat']);

// Cek apakah email sudah terdaftar
$sql_check_email = "SELECT * FROM `users` WHERE `email` = '$email'";
$result_check = $conn->query($sql_check_email);

if ($result_check->num_rows > 0) {
    echo json_encode([
        "status" => false,
        "message" => "Email already exists"
    ]);
    $conn->close();
    exit();
}

// Enkripsi password
$password_hashed = password_hash($password, PASSWORD_DEFAULT);

// Query untuk insert ke tabel `users`
$sql_user = "INSERT INTO `users` (`email`, `password`) VALUES ('$email', '$password_hashed')";

if ($conn->query($sql_user) === true) {
    // Ambil id_user yang baru dimasukkan
    $user_id = $conn->insert_id;

    // Query untuk insert ke tabel `pelapor`
    $sql_pelapor = "INSERT INTO `pelapor` (`id_user`, `nama`, `telp`, `perusahaan`, `alamat`) 
                    VALUES ('$user_id', '$nama', '$telp', '$perusahaan', '$alamat')";

    if ($conn->query($sql_pelapor) === true) {
        echo json_encode([
            "status" => true,
            "message" => "Data pelapor berhasil ditambahkan!",
            "details" => [
                "email" => $email,
                "nama" => $nama,
                "telp" => $telp,
                "perusahaan" => $perusahaan,
                "alamat" => $alamat
            ]
        ]);
    } else {
        echo json_encode([
            "status" => false,
            "message" => "Error inserting data into 'pelapor' table",
            "details" => $conn->error
        ]);
    }
} else {
    echo json_encode([
        "status" => false,
        "message" => "Error inserting data into 'users' table",
        "details" => $conn->error
    ]);
}

// Tutup koneksi
$conn->close();
