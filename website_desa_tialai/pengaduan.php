<?php 
require_once 'config.php';
include 'components/header.php'; 

$pesan = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama        = input($_POST['nama']);
    $no_hp       = input($_POST['no_hp']);
    $kategori    = input($_POST['kategori']);
    $judul       = input($_POST['judul']);
    $isi_laporan = input($_POST['isi_laporan']);

    // Handling Upload Foto Aduan
    $foto_nama = NULL;
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $allowed = array('jpg', 'jpeg', 'png');
        $filename = $_FILES['foto']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $foto_nama = 'aduan_' . time() . '.' . $ext;
            $target_dir = "assets/uploads/";

            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $foto_nama);
        }
    }

    $query = "INSERT INTO pengaduan (nama, no_hp, kategori, judul, isi_laporan, foto, status) 
              VALUES ('$nama', '$no_hp', '$kategori', '$judul', '$isi_laporan', '$foto_nama', 'Baru')";

    if (mysqli_query($conn, $query)) {
        $pesan = "<div class='bg-emerald-50 border border-emerald-200 text-emerald-800 p-4 rounded-xl text-xs mb-6 text-center'>
                    <i class='fas fa-check-circle mr-1'></i> Laporan Anda telah berhasil dikirim! Pemerintah desa akan segera menindaklanjuti.
                  </div>";
    } else {
        $pesan = "<div class='bg-red-50 border border-red-200 text-red-600 p-4 rounded-xl text-xs mb-6 text-center'>
                    <i class='fas fa-exclamation-circle mr-1'></i> Gagal mengirim laporan. Silakan coba lagi.
                  </div>";
    }
}
?>

<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
        <div class="text-center mb-6">
            <div class="w-12 h-12 bg-amber-50 rounded-full flex items-center justify-center mx-auto mb-3 text-amber-700">
                <i class="fas fa-bullhorn text-xl"></i>
            </div>
            <h1 class="text-2xl font-bold text-gray-900">Layanan Pengaduan Masyarakat</h1>
            <p class="text-xs text-gray-500 mt-1">Sampaikan keluhan, aduan, atau aspirasi mengenai fasilitas dan pelayanan di Desa Tialai.</p>
        </div>

        <?php echo $pesan; ?>

        <form action="pengaduan.php" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="nama" required class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#0b3323] outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">No. WhatsApp</label>
                    <input type="text" name="no_hp" required placeholder="08xxxxxxxxxx" class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#0b3323] outline-none">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Kategori Pengaduan</label>
                    <select name="kategori" class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#0b3323] outline-none">
                        <option value="Infrastruktur">Infrastruktur & Jalan</option>
                        <option value="Pelayanan Publik">Pelayanan Publik</option>
                        <option value="Keamanan & Ketertiban">Keamanan & Ketertiban</option>
                        <option value="Kebersihan & Lingkungan">Kebersihan & Lingkungan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">Judul Laporan</label>
                    <input type="text" name="judul" required placeholder="Ringkasan singkat aduan..." class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#0b3323] outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Isi Detail Laporan</label>
                <textarea name="isi_laporan" rows="4" required placeholder="Jelaskan detail masalah, lokasi kejadian, dll..." class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#0b3323] outline-none"></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Foto Bukti Pendukung (JPG/PNG)</label>
                <input type="file" name="foto" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
            </div>

            <button type="submit" class="w-full bg-[#0b3323] text-white py-2.5 rounded-lg text-xs font-semibold hover:bg-[#144733] transition flex items-center justify-center gap-2">
                <i class="fas fa-paper-plane"></i> Kirim Laporan Pengaduan
            </button>
        </form>
    </div>
</div>

<?php include 'components/footer.php'; ?>