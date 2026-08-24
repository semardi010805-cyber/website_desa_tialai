<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: ../login.php"); 
    exit(); 
}

// Tambah Berita Baru
if (isset($_POST['tambah_berita'])) {
    $judul = input($_POST['judul']);
    $isi   = input($_POST['isi']);

    $foto_nama = 'default.jpg';
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $allowed = array('jpg', 'jpeg', 'png');
        $filename = $_FILES['gambar']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $foto_nama = 'berita_' . time() . '.' . $ext;
            $target_dir = "../assets/uploads/";

            if (!file_exists($target_dir)) { 
                mkdir($target_dir, 0777, true); 
            }
            move_uploaded_file($_FILES['gambar']['tmp_name'], $target_dir . $foto_nama);
        }
    }

    // Menggunakan created_at (otomatis terisi tanggal saat ini)
    $query = "INSERT INTO berita (judul, isi_berita, gambar, created_at) VALUES ('$judul', '$isi', '$foto_nama', NOW())";
    mysqli_query($conn, $query);
    header("Location: berita.php");
    exit();
}

// Hapus Berita
if (isset($_GET['hapus'])) {
    $id = input($_GET['hapus']);
    
    // Opsional: Hapus file gambar lama jika bukan default
    $get_foto = mysqli_query($conn, "SELECT gambar FROM berita WHERE id = '$id'");
    $data_foto = mysqli_fetch_assoc($get_foto);
    if ($data_foto && $data_foto['gambar'] != 'default.jpg') {
        @unlink("../assets/uploads/" . $data_foto['gambar']);
    }

    mysqli_query($conn, "DELETE FROM berita WHERE id = '$id'");
    header("Location: berita.php");
    exit();
}

// Mengambil data berita diurutkan berdasarkan created_at terbaru
$data_berita = mysqli_query($conn, "SELECT * FROM berita ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Berita Desa - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-xs text-gray-800">

    <header class="bg-[#0b3323] text-white py-4 px-6 flex justify-between items-center shadow">
        <div class="flex items-center gap-3">
            <i class="fas fa-newspaper text-xl"></i>
            <h1 class="font-bold text-base">Kelola Berita & Informasi Desa</h1>
        </div>
        <a href="index.php" class="bg-gray-600 hover:bg-gray-700 px-3 py-1.5 rounded text-white font-semibold transition">
            ← Kembali ke Dashboard
        </a>
    </header>

    <div class="max-w-6xl mx-auto p-6">
        <!-- FORM TAMBAH BERITA -->
        <div class="bg-white p-5 rounded-xl border mb-6 shadow-sm">
            <h2 class="font-bold text-gray-700 mb-3 text-sm">Tulis Berita / Pengumuman Baru</h2>
            <form action="berita.php" method="POST" enctype="multipart/form-data" class="space-y-3">
                <div>
                    <label class="block font-semibold text-gray-600 mb-1">Judul Berita</label>
                    <input type="text" name="judul" placeholder="Masukkan judul berita atau kegiatan desa..." required class="w-full p-2 border rounded outline-none focus:ring-1 focus:ring-[#0b3323]">
                </div>
                <div>
                    <label class="block font-semibold text-gray-600 mb-1">Isi Berita</label>
                    <textarea name="isi" rows="5" placeholder="Tuliskan detail pengumuman atau berita di sini..." required class="w-full p-2 border rounded outline-none focus:ring-1 focus:ring-[#0b3323]"></textarea>
                </div>
                <div>
                    <label class="block font-semibold text-gray-600 mb-1">Gambar Sampul (JPG/PNG)</label>
                    <input type="file" name="gambar" required class="w-full text-xs text-gray-500 file:mr-4 file:py-1.5 file:px-3 file:rounded file:border-0 file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
                </div>
                <button type="submit" name="tambah_berita" class="bg-[#0b3323] text-white px-4 py-2 rounded font-semibold hover:bg-[#144733] transition flex items-center gap-1.5">
                    <i class="fas fa-paper-plane"></i> Publikasikan Berita
                </button>
            </form>
        </div>

        <!-- TABEL DATA BERITA -->
        <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
            <div class="p-4 bg-gray-50 border-b font-bold text-gray-700">Daftar Berita Diterbitkan</div>
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 font-semibold border-b text-gray-600">
                    <tr>
                        <th class="p-3">Tanggal Dibuat</th>
                        <th class="p-3">Judul Berita</th>
                        <th class="p-3">Gambar</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if(mysqli_num_rows($data_berita) > 0): ?>
                        <?php while($b = mysqli_fetch_assoc($data_berita)): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="p-3 text-gray-500 whitespace-nowrap">
                                <?php echo date('d/m/Y H:i', strtotime($b['created_at'])); ?>
                            </td>
                            <td class="p-3 font-bold text-gray-800">
                                <?php echo htmlspecialchars($b['judul']); ?>
                            </td>
                            <td class="p-3">
                                <img src="../assets/uploads/<?php echo htmlspecialchars($b['gambar']); ?>" class="w-12 h-12 object-cover rounded border">
                            </td>
                            <td class="p-3 text-center">
                                <a href="berita.php?hapus=<?php echo $b['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus berita ini?');" class="bg-red-600 text-white px-2.5 py-1 rounded hover:bg-red-700 font-semibold transition">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="p-6 text-center text-gray-400">Belum ada berita yang diterbitkan.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>