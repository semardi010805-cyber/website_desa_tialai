<?php
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Peta Situs - Desa Tialai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <main class="max-w-4xl mx-auto px-6 py-12 flex-1 w-full">
        <h1 class="text-2xl font-bold text-[#082b1d] mb-4">Peta Situs</h1>
        <p class="text-sm text-gray-600 mb-6">Struktur halaman dan navigasi layanan digital Desa Tialai.</p>
        
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm text-sm space-y-3">
            <ul class="list-disc list-inside space-y-2 text-gray-700">
                <li><a href="index.php" class="text-emerald-700 hover:underline">Beranda Utama</a></li>
                <li><a href="index.php#permohonan" class="text-emerald-700 hover:underline">Pengajuan Surat Online</a></li>
                <li><a href="login.php" class="text-emerald-700 hover:underline">Login Admin / Perangkat Desa</a></li>
                <li><a href="hubungi_kami.php" class="text-emerald-700 hover:underline">Hubungi Kami</a></li>
                <li><a href="kebijakan_privasi.php" class="text-emerald-700 hover:underline">Kebijakan Privasi</a></li>
            </ul>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>
</body>
</html>