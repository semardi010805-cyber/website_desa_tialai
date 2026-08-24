<?php 
require_once 'config.php';
include 'components/header.php'; 

$query_berita = mysqli_query($conn, "SELECT * FROM berita ORDER BY tanggal DESC");
?>

<div class="max-w-6xl mx-auto px-4 py-12">
    <div class="text-center max-w-xl mx-auto mb-10">
        <h1 class="text-2xl font-bold text-gray-900">Kabar & Informasi Desa Tialai</h1>
        <p class="text-xs text-gray-500 mt-1">Dapatkan informasi terbaru seputar program, kegiatan, dan pengumuman resmi Desa Tialai.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <?php if (mysqli_num_rows($query_berita) > 0): ?>
            <?php while ($b = mysqli_fetch_assoc($query_berita)): ?>
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col">
                    <img src="assets/uploads/<?php echo $b['gambar'] ? $b['gambar'] : 'default.jpg'; ?>" class="w-full h-48 object-cover bg-gray-100" alt="Gambar Berita">
                    <div class="p-5 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 text-[10px] text-gray-400 mb-2">
                                <span><i class="far fa-calendar-alt"></i> <?php echo date('d M Y', strtotime($b['tanggal'])); ?></span>
                                <span>•</span>
                                <span><i class="far fa-user"></i> Admin Desa</span>
                            </div>
                            <h2 class="font-bold text-sm text-gray-900 mb-2 line-clamp-2">
                                <?php echo htmlspecialchars($b['judul']); ?>
                            </h2>
                            <p class="text-xs text-gray-600 line-clamp-3 mb-4">
                                <?php echo htmlspecialchars(substr(strip_tags($b['isi']), 0, 120)); ?>...
                            </p>
                        </div>
                        <a href="detail_berita.php?id=<?php echo $b['id']; ?>" class="text-xs font-semibold text-[#0b3323] hover:underline flex items-center gap-1">
                            Baca Selengkapnya <i class="fas fa-arrow-right text-[10px]"></i>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col-span-3 text-center py-12 text-gray-400 text-xs">
                Belum ada berita atau kabar desa yang dipublikasikan.
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'components/footer.php'; ?>