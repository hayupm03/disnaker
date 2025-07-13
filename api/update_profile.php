<?php
// Start output buffering and error handling
ob_start();
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log');

// Set headers early
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

try {
    // Include database connection
    require_once 'connection.php';

    // Check if connection exists
    if (!isset($conn)) {
        throw new Exception("Database connection not established");
    }

    // Check request method
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception("Only POST method is allowed");
    }

    // Log received data for debugging
    error_log("POST data: " . print_r($_POST, true));
    error_log("FILES data: " . print_r($_FILES, true));

    // Get and validate form data
    $id_user = isset($_POST['id_user']) ? trim($_POST['id_user']) : '';
    $nama = isset($_POST['nama']) ? trim($_POST['nama']) : '';
    $telp = isset($_POST['telp']) ? trim($_POST['telp']) : '';
    $alamat = isset($_POST['alamat']) ? trim($_POST['alamat']) : '';
    // Tambahkan pengambilan password dari POST
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Jika password tidak kosong, hash password
    $hashedPassword = null;
    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    }

    // Validate required fields
    if (empty($id_user) || empty($nama) || empty($telp) || empty($alamat)) {
        throw new Exception("All fields are required. Received: id_user=$id_user, nama=$nama, telp=$telp, alamat=$alamat");
    }

    // Validate id_user is numeric
    if (!is_numeric($id_user)) {
        throw new Exception("Invalid user ID format");
    }

    $id_user = (int)$id_user;

    // Handle file upload if exists
    $profileImagePath = null;
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../uploads/';

        // Create upload directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            if (!mkdir($uploadDir, 0755, true)) {
                throw new Exception("Failed to create upload directory");
            }
        }

        // Validate file type
        $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
        $fileType = $_FILES['gambar']['type'];
        if (!in_array($fileType, $allowedTypes)) {
            throw new Exception("Invalid file type. Only JPEG and PNG are allowed");
        }

        // Validate file size (max 5MB)
        if ($_FILES['gambar']['size'] > 5 * 1024 * 1024) {
            throw new Exception("File too large. Maximum size is 5MB");
        }

        $fileExtension = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
        $fileName = 'profile_' . $id_user . '_' . time() . '.' . $fileExtension;
        $targetPath = $uploadDir . $fileName;

        if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
            throw new Exception("Failed to upload image");
        }

        $profileImagePath = $fileName;
        error_log("Image uploaded successfully: $fileName");
    }

    // Get user type
    $userType = getUserTypeByRelationship($conn, $id_user);
    if ($userType === false) {
        throw new Exception("User not found with ID: $id_user");
    }

    error_log("User type: $userType");

    // Update profile based on user type
    $updateSuccess = false;
    switch ($userType) {
        case 'pelapor':
            $updateSuccess = updatePelaporProfile($conn, $id_user, $nama, $telp, $alamat, $profileImagePath, $hashedPassword);
            break;
        case 'mediator':
            $updateSuccess = updateMediatorProfile($conn, $id_user, $nama, $telp, $alamat, $profileImagePath);
            if ($hashedPassword !== null) updateUserPassword($conn, $id_user, $hashedPassword);
            break;
        case 'admin':
            $updateSuccess = updateAdminProfile($conn, $id_user, $nama, $telp, $alamat, $profileImagePath);
            if ($hashedPassword !== null) updateUserPassword($conn, $id_user, $hashedPassword);
            break;
        default:
            throw new Exception("Invalid user type: " . $userType);
    }

    if ($updateSuccess) {
        $response = [
            "status" => true,
            "message" => "Profile updated successfully"
        ];
    } else {
        throw new Exception("Failed to update profile in database");
    }
} catch (Exception $e) {
    error_log("Error in update_profile.php: " . $e->getMessage());
    $response = [
        "status" => false,
        "message" => $e->getMessage()
    ];
} finally {
    // Clean output buffer and send response
    ob_clean();
    echo json_encode($response);

    // Close database connection if it exists
    if (isset($conn)) {
        $conn->close();
    }
}

// Helper functions
function getUserTypeByRelationship($conn, $id_user)
{
    $tables = ['pelapor', 'mediator', 'admin'];
    foreach ($tables as $table) {
        $sql = "SELECT 1 FROM `$table` WHERE id_user = ? LIMIT 1";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            return $table; // Mengembalikan nama tabel sebagai tipe user
        }
    }
    return false;
}

function updatePelaporProfile($conn, $id_user, $nama, $telp, $alamat, $profileImage = null, $hashedPassword = null)
{
    if ($profileImage !== null) {
        $sql = "UPDATE pelapor SET nama = ?, telp = ?, alamat = ?, profile = ? WHERE id_user = ?";
        $params = [$nama, $telp, $alamat, $profileImage, $id_user];
        $types = "ssssi";
    } else {
        $sql = "UPDATE pelapor SET nama = ?, telp = ?, alamat = ? WHERE id_user = ?";
        $params = [$nama, $telp, $alamat, $id_user];
        $types = "sssi";
    }

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param($types, ...$params);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    // Update password jika ada
    if ($hashedPassword !== null) {
        updateUserPassword($conn, $id_user, $hashedPassword);
    }

    return true;
}

function updateUserPassword($conn, $id_user, $hashedPassword)
{
    $sql = "UPDATE users SET password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param("si", $hashedPassword, $id_user);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed updating password: " . $stmt->error);
    }

    return true;
}

function updateMediatorProfile($conn, $id_user, $nama, $telp, $alamat, $profileImage = null, $hashedPassword = null)
{
    if ($profileImage !== null) {
        $sql = "UPDATE mediator SET nama = ?, telp = ?, alamat = ?, profile = ? WHERE id_user = ?";
        $params = [$nama, $telp, $alamat, $profileImage, $id_user];
        $types = "ssssi";
    } else {
        $sql = "UPDATE mediator SET nama = ?, telp = ?, alamat = ? WHERE id_user = ?";
        $params = [$nama, $telp, $alamat, $id_user];
        $types = "sssi";
    }

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param($types, ...$params);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    // Update password jika ada
    if ($hashedPassword !== null) {
        updateUserPassword($conn, $id_user, $hashedPassword);
    }

    return true;
}

function updateAdminProfile($conn, $id_user, $nama, $telp, $alamat, $profileImage = null, $hashedPassword = null)
{
    if ($profileImage !== null) {
        $sql = "UPDATE admin SET nama = ?, telp = ?, alamat = ?, profile = ? WHERE id_user = ?";
        $params = [$nama, $telp, $alamat, $profileImage, $id_user];
        $types = "ssssi";
    } else {
        $sql = "UPDATE admin SET nama = ?, telp = ?, alamat = ? WHERE id_user = ?";
        $params = [$nama, $telp, $alamat, $id_user];
        $types = "sssi";
    }

    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        throw new Exception("Prepare failed: " . $conn->error);
    }

    $stmt->bind_param($types, ...$params);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    if ($hashedPassword !== null) {
        updateUserPassword($conn, $id_user, $hashedPassword);
    }

    return true;
}
