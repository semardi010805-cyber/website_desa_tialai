<?php
session_start();
require_once 'config.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Desa Tialai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <main class="max-w-4xl mx-auto px-6 py-12 flex-1 w-full">
        <h1 class="text-2xl font-bold text-[#082b1d] mb-4">Hubungi Kami</h1>
        <p class="text-sm text-gray-600 mb-6">Jika Anda memiliki pertanyaan atau kendala terkait layanan surat digital Desa Tialai, silakan hubungi kami melalui informasi di bawah ini.</p>
        
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm space-y-4 text-sm">
            <div class="flex items-start gap-3">
                <i class="fas fa-map-marker-alt text-[#082b1d] mt-1"></i>
                <div>
                    <strong>Alamat Kantor Desa:</strong><br>
                    Kantor Desa Tialai, Kec. Tasifeto Timur, Kab. Belu, Nusa Tenggara Timur.
                </div>
            </div>
            <div class="flex items-center gap-3">
                <i class="fas fa-envelope text-[#082b1d]"></i>
                <div>
                    <strong>Email Resmi:</strong><br>
                    <a href="mailto:info@tialai.desa.id" class="text-emerald-700 hover:underline">info@tialai.desa.id</a>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <i class="fab fa-whatsapp text-[#082b1d]"></i>
                <div>
                    <strong>WhatsApp Pelayanan:</strong><br>
                    <a href="https://wa.me/6281234567890" target="_blank" class="text-emerald-700 hover:underline">+62 812-3456-7890</a>
                </div>
            </div>
        </div>
    </main>

    <?php include 'components/footer.php'; ?>
</body>
</html>