<?php 
require_once 'config.php'; 
include 'components/header.php'; 
?>

<!-- HERO SECTION -->
<header class="hero-bg h-[500px] flex flex-col justify-center items-center text-center text-white px-4 relative">
    <h1 class="text-3xl md:text-5xl font-bold mb-3 drop-shadow-md">Selamat Datang di Desa Tialai,<br>Kabupaten Belu</h1>
    <p class="text-sm md:text-base max-w-xl mb-6 text-gray-200">Membangun Masyarakat yang Sejahtera, Mandiri, dan Berbudaya</p>
    <a href="potensi.php" class="bg-white/90 backdrop-blur-sm text-[#0b3323] px-6 py-2.5 rounded-full font-medium text-sm flex items-center gap-2 hover:bg-white transition shadow-lg">
        Jelajahi Potensi <i class="fas fa-arrow-right text-xs"></i>
    </a>

    <!-- STATS CARD (FLOATING) -->
    <div class="absolute -bottom-16 w-11/12 max-w-5xl grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-5 rounded-xl shadow-lg text-center text-gray-800">
            <i class="fas fa-users text-gray-400 text-xl mb-2"></i>
            <div class="text-2xl font-bold">775</div>
            <div class="text-xs text-gray-500">Jumlah Penduduk</div>
        </div>
        <div class="bg-white p-5 rounded-xl shadow-lg text-center text-gray-800">
            <i class="fas fa-mountain text-gray-400 text-xl mb-2"></i>
            <div class="text-2xl font-bold">450<span class="text-sm font-normal"> Ha</span></div>
            <div class="text-xs text-gray-500">Luas Wilayah</div>
        </div>
        <div class="bg-white p-5 rounded-xl shadow-lg text-center text-gray-800">
            <i class="fas fa-tractor text-gray-400 text-xl mb-2"></i>
            <div class="text-2xl font-bold">12</div>
            <div class="text-xs text-gray-500">Kelompok Tani</div>
        </div>
        <div class="bg-white p-5 rounded-xl shadow-lg text-center text-gray-800">
            <i class="fas fa-building text-gray-400 text-xl mb-2"></i>
            <div class="text-2xl font-bold">8</div>
            <div class="text-xs text-gray-500">Fasilitas Umum</div>
        </div>
    </div>
</header>

<!-- SPACER UNTUK FLOATING CARD -->
<div class="h-24"></div>

<!-- LAYANAN UTAMA -->
<section class="max-w-6xl mx-auto px-4 py-12">
    <div class="flex justify-between items-end mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Layanan Utama</h2>
            <p class="text-xs text-gray-500 mt-1">Akses cepat ke layanan administrasi dan publik untuk warga Desa Tialai.</p>
        </div>
        <a href="layanan.php" class="text-xs font-semibold text-gray-600 hover:text-black">Lihat Semua Layanan &rarr;</a>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <!-- Card 1 -->
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between">
            <div>
                <i class="far fa-file-alt text-2xl mb-4 text-gray-700"></i>
                <h3 class="font-bold text-lg mb-2">Layanan Administrasi</h3>
                <p class="text-xs text-gray-500 leading-relaxed mb-6">Pembuatan surat keterangan, pengantar KTP, KK, dan dokumen kependudukan lainnya.</p>
            </div>
            <a href="layanan.php" class="bg-[#0b3323] text-white text-center py-2.5 rounded-lg text-xs font-semibold hover:bg-[#144733] transition">Ajukan Surat</a>
        </div>
        <!-- Card 2 -->
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between">
            <div>
                <i class="fas fa-hand-holding-heart text-2xl mb-4 text-gray-700"></i>
                <h3 class="font-bold text-lg mb-2">Bantuan Sosial</h3>
                <p class="text-xs text-gray-500 leading-relaxed mb-6">Informasi pendaftaran, penyaluran, dan transparansi data penerima bantuan sosial desa.</p>
            </div>
            <a href="bansos.php" class="border border-gray-300 text-gray-700 text-center py-2.5 rounded-lg text-xs font-semibold hover:bg-gray-50 transition">Cek Status</a>
        </div>
        <!-- Card 3 -->
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm flex flex-col justify-between">
            <div>
                <i class="fas fa-bullhorn text-2xl mb-4 text-gray-700"></i>
                <h3 class="font-bold text-lg mb-2">Pengaduan Masyarakat</h3>
                <p class="text-xs text-gray-500 leading-relaxed mb-6">Saluran resmi untuk melaporkan masalah infrastruktur, pelayanan, atau keamanan di desa.</p>
            </div>
            <a href="pengaduan.php" class="border border-gray-300 text-gray-700 text-center py-2.5 rounded-lg text-xs font-semibold hover:bg-gray-50 transition">Buat Laporan</a>
        </div>
    </div>
</section>

<!-- SECTION BERITA TERKINI -->
<section class="py-12 bg-gray-50">
    <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-10">
            <h2 class="text-2xl font-bold text-gray-900">Berita Terkini</h2>
            <p class="text-xs text-gray-500 mt-1">Informasi terbaru seputar kegiatan, program, dan pembangunan di Desa Tialai.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php 
            // Mengambil 3 berita terbaru berdasarkan tanggal dibuat
            $query_berita_terkini = mysqli_query($conn, "SELECT * FROM berita ORDER BY created_at DESC LIMIT 3");
            
            if (mysqli_num_rows($query_berita_terkini) > 0): 
                while ($berita = mysqli_fetch_assoc($query_berita_terkini)): 
            ?>
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col justify-between hover:shadow-md transition">
                    <div>
                        <img src="assets/uploads/<?php echo !empty($berita['gambar']) ? htmlspecialchars($berita['gambar']) : 'default.jpg'; ?>" 
                             class="w-full h-48 object-cover bg-gray-100" 
                             alt="<?php echo htmlspecialchars($berita['judul']); ?>">
                        
                        <div class="p-5">
                            <div class="flex items-center gap-2 text-[10px] text-gray-400 mb-2">
                                <i class="far fa-calendar-alt"></i> 
                                <?php echo date('d M Y', strtotime($berita['created_at'])); ?>
                            </div>
                            
                            <h3 class="font-bold text-sm text-gray-900 mb-2 line-clamp-2 hover:text-[#0b3323]">
                                <?php echo htmlspecialchars($berita['judul']); ?>
                            </h3>
                            
                            <p class="text-xs text-gray-600 line-clamp-3 mb-4">
                                <?php echo htmlspecialchars(substr(strip_tags($berita['isi_berita']), 0, 110)); ?>...
                            </p>
                        </div>
                    </div>

                    <div class="px-5 pb-5">
                        <a href="detail_berita.php?id=<?php echo $berita['id']; ?>" 
                           class="text-xs font-semibold text-[#0b3323] hover:underline inline-flex items-center gap-1">
                            Baca Selengkapnya <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            <?php 
                endwhile; 
            else: 
            ?>
                <div class="col-span-3 text-center py-8 text-gray-400 text-xs">
                    Belum ada berita terbaru yang dipublikasikan.
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php include 'components/footer.php'; ?>