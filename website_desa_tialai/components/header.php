<?php
// Otomatis deteksi nama file yang sedang dibuka
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desa Tialai - Kabupaten Belu</title>
    
    <!-- Tailwind CSS (via CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS Terpisah (Sesuai Struktur Folder VS Code) -->
    <link rel="stylesheet" href="assets/style/style.css">
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- NAVBAR -->
    <nav class="bg-[#0b3323] text-white px-8 py-4 flex justify-between items-center sticky top-0 z-50 shadow-md">
        <a href="index.php" class="text-xl font-bold tracking-wide">Desa Tialai</a>
        
       <nav class="flex items-center space-x-6 text-sm font-medium">
    <a href="index.php" class="text-white hover:text-amber-200 transition">Beranda</a>
    <a href="profil.php" class="text-white hover:text-amber-200 transition">Profil</a>
    <a href="pemerintahan.php" class="text-white hover:text-amber-200 transition">Pemerintahan</a>
    <a href="potensi.php" class="text-white hover:text-amber-200 transition">Potensi</a>
    <a href="berita.php" class="text-white hover:text-amber-200 transition">Berita</a>  
</nav>
    <a href="layanan.php" class="bg-[#e2cb94] text-[#0b3323] px-4 py-2 rounded-md font-semibold text-xs hover:bg-yellow-200 transition">Layanan Mandiri</a>
</nav>