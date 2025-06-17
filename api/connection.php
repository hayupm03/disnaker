<?php

$host = "localhost";
$username = "root";
$password = "";
$dbname = "disnaker-agenda";

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
