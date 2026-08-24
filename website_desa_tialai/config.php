<?php
// Konfigurasi Database
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_desa_tialai";

// Membuat Koneksi
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8mb4");

// DETEKSI OTOMATIS LARAGON (Bisa untuk .test maupun localhost)
if (!defined('BASE_URL')) {
    $protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http";
    $host = $_SERVER['HTTP_HOST'];
    
    // Jika diakses lewat localhost/website_desa_tialai
    if ($host === 'localhost' || $host === '127.0.0.1') {
        define('BASE_URL', $protocol . "://" . $host . "/website_desa_tialai/");
    } else {
        // Jika diakses lewat virtual host Laragon (http://website_desa_tialai.test/)
        define('BASE_URL', $protocol . "://" . $host . "/");
    }
}

function input($data) {
    global $conn;
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return mysqli_real_escape_string($conn, $data);
}
?>