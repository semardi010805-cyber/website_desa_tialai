<?php
// Memanggil file index utama Anda
if (file_exists(__DIR__ . '/../index.php')) {
    require __DIR__ . '/../index.php';
} elseif (file_exists(__DIR__ . '/../website_desa_tialai/index.php')) {
    require __DIR__ . '/../website_desa_tialai/index.php';
} else {
    echo "File index.php tidak ditemukan.";
}
