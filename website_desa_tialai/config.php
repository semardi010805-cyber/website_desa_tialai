<?php
$host     = "localhost";
$username = "root";
$password = "";
$database = "db_desa_tialai";

// Menggunakan error handling agar tidak crash di Vercel
try {
    $koneksi = mysqli_connect($host, $username, $password, $database);
} catch (Exception $e) {
    // Koneksi disiapkan dummy agar halaman depan tetap tampil
    $koneksi = false;
}
?>
