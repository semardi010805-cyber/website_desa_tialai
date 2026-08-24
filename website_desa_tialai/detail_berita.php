<?php 
require_once 'config.php';
include 'components/header.php'; 

// Validasi parameter ID berita
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: berita.php");
    exit();
}

$id = input($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM berita WHERE id = '$id'");
$berita = mysqli_fetch_assoc($query);

// Jika berita tidak ditemukan
if (!$berita) {
    echo "<script>alert('Berita tidak ditemukan!'); window.location='berita.php';</script>";
    exit();
}
?>

<div class="max-w-4xl mx-auto px-4 py-12">
    <a href="index.php" class="text-xs font-semibold text-gray-500 hover:text-[#0b3323] inline-flex items-center gap-1 mb-6 transition">
        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
    </a>

    <article class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
        <h1 class="text-2xl font-bold text-gray-900 mb-3"><?php echo htmlspecialchars($berita['judul']); ?></h1>
        
        <div class="flex items-center gap-3 text-xs text-gray-400 mb-6 pb-4 border-b">
            <span><i class="far fa-calendar-alt"></i> <?php echo date('d F Y', strtotime($berita['created_at'])); ?></span>
            <span>•</span>
            <span><i class="far fa-user"></i> Penulis: Admin Desa Tialai</span>
        </div>

        <?php if (!empty($berita['gambar'])): ?>
            <img src="assets/uploads/<?php echo htmlspecialchars($berita['gambar']); ?>" class="w-full max-h-[400px] object-cover rounded-xl mb-6 bg-gray-100" alt="<?php echo htmlspecialchars($berita['judul']); ?>">
        <?php endif; ?>

        <div class="text-sm text-gray-700 leading-relaxed space-y-4">
            <?php echo nl2br(htmlspecialchars($berita['isi_berita'])); ?>
        </div>
    </article>
</div>

<?php include 'components/footer.php'; ?>