<?php
require_once 'connection.php';
header("Content-Type: application/json");

// Ambil raw data JSON dari body request
$data = json_decode(file_get_contents("php://input"), true);

// Validasi input
if (!isset($data['email']) || !isset($data['password'])) {
    echo json_encode(["status" => false, "error" => "Email and password are required"]);
    $conn->close();
    exit();
}

// Ambil data dari JSON
$email = $conn->real_escape_string($data['email']);
$password = $conn->real_escape_string($data['password']);

// Query untuk mencari user berdasarkan email
$sql_user = "SELECT * FROM `users` WHERE `email` = '$email' LIMIT 1";
$result = $conn->query($sql_user);

if ($result->num_rows > 0) {
    // Ambil data user
    $user = $result->fetch_assoc();

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
        // Login berhasil
        // Ambil detail dari tabel sesuai dengan level pengguna
        $user_details = [];

        // Cek apakah user termasuk dalam salah satu level
        $sql_admin = "SELECT * FROM `admin` WHERE `id_user` = " . $user['id'] . " LIMIT 1";
        $admin_result = $conn->query($sql_admin);
        if ($admin_result->num_rows > 0) {
            $user_details = $admin_result->fetch_assoc();
            $level = 'admin';
        } else {
            $sql_mediator = "SELECT * FROM `mediator` WHERE `id_user` = " . $user['id'] . " LIMIT 1";
            $mediator_result = $conn->query($sql_mediator);
            if ($mediator_result->num_rows > 0) {
                $user_details = $mediator_result->fetch_assoc();
                $level = 'mediator';
            } else {
                $sql_pelapor = "SELECT * FROM `pelapor` WHERE `id_user` = " . $user['id'] . " LIMIT 1";
                $pelapor_result = $conn->query($sql_pelapor);
                if ($pelapor_result->num_rows > 0) {
                    $user_details = $pelapor_result->fetch_assoc();
                    $level = 'pelapor';
                } else {
                    $level = 'user';
                }
            }
        }

        // Kirimkan respons sukses dengan detail pengguna
        echo json_encode([
            "status" => true,
            "message" => "success",
            "id_user" => $user['id'],
            "email" => $user['email'],
            "level" => $level,
            "user_details" => $user_details
        ]);
    } else {
        // Password salah
        echo json_encode(["status" => false, "error" => "Invalid email or password"]);
    }
} else {
    // Email tidak ditemukan
    echo json_encode(["status" => false, "error" => "User not found"]);
}

// Tutup koneksi
$conn->close();
