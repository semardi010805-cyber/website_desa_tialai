<?php
// Deteksi posisi halaman saat ini
// Jika dipanggil dari dalam folder admin, naik 1 tingkat (../), jika dari luar gunakan (./)
$prefix = file_exists('config.php') ? './' : '../';
?>

<!-- components/footer.php -->
<footer class="bg-[#082b1d] text-gray-300 text-sm border-t border-emerald-900/50 mt-auto">
    <div class="max-w-7xl mx-auto px-6 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 pb-8 border-b border-emerald-900/60">
            
            <!-- Deskripsi Desa -->
            <div>
                <h3 class="text-white text-base font-bold mb-3">Desa Tialai</h3>
                <p class="text-xs text-gray-300 leading-relaxed max-w-sm">
                    Membangun masyarakat yang sejahtera, mandiri, dan berbudaya melalui tata kelola pemerintahan yang transparan dan inovatif.
                </p>
            </div>

           <!-- Bagian Tautan Penting di components/footer.php -->
<div class="space-y-3">
    <h4 class="text-sm font-bold text-white">Tautan Penting</h4>
    <ul class="space-y-2 text-xs">
        <li>
            <a href="hubungi_kami.php" class="hover:underline flex items-center gap-2 text-emerald-100 hover:text-white">
                <i class="fas fa-phone text-[10px]"></i> Hubungi Kami
            </a>
        </li>
        <li>
            <a href="peta_situs.php" class="hover:underline flex items-center gap-2 text-emerald-100 hover:text-white">
                <i class="fas fa-sitemap text-[10px]"></i> Peta Situs
            </a>
        </li>
        <li>
            <a href="kebijakan_privasi.php" class="hover:underline flex items-center gap-2 text-emerald-100 hover:text-white">
                <i class="fas fa-shield-alt text-[10px]"></i> Kebijakan Privasi
            </a>
        </li>
    </ul>
</div>

            <!-- Kontak -->
            <div>
                <h3 class="text-white text-base font-bold mb-3">Kontak</h3>
                <ul class="space-y-2.5 text-xs text-gray-300">
                    <li class="flex items-start gap-2.5">
                        <i class="fas fa-map-marker-alt text-gray-200 mt-0.5"></i>
                        <span>Kantor Desa Tialai, Kec. Tasifeto Timur, Kab. Belu, NTT</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="fas fa-envelope text-gray-200"></i>
                        <a href="mailto:info@tialai.desa.id" class="hover:text-white transition">info@tialai.desa.id</a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Hak Cipta -->
        <div class="pt-6 text-center text-xs text-gray-400">
            &copy; <?php echo date('Y'); ?> Pemerintah Desa Tialai, Kec. Tasifeto Timur, Kab. Belu, NTT.
        </div>
    </div>
</footer>