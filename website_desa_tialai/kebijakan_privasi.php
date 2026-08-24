<?php
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi - Desa Tialai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <main class="max-w-4xl mx-auto px-6 py-12 flex-1 w-full">
        <h1 class="text-2xl font-bold text-[#082b1d] mb-4">Kebijakan Privasi</h1>
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm text-sm leading-relaxed space-y-4 text-gray-700">
            <p>Pemerintah Desa Tialai berkomitmen untuk melindungi privasi dan data pribadi masyarakat yang menggunakan Sistem Pelayanan Surat Digital.</p>
            <h3 class="font-bold text-gray-900 text-base">1. Pengumpulan Data</h3>
            <p>Data pribadi seperti NIK, Nama, Nomor WhatsApp, serta berkas lampiran yang diunggah hanya digunakan untuk keperluan verifikasi dan pembuatan permohonan surat administrasi desa.</p>
            <h3 class="font-bold text-gray-900 text-base">2. Keamanan Data</h3>
            <p>Data masyarakat disimpan secara aman dan tidak akan disebarluaskan kepada pihak luar tanpa izin dari warga yang bersangkutan atau ketentuan hukum yang berlaku.</p>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>
</body>
</html>