<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php");
    exit();
}

// Tambah Potensi Baru
if (isset($_POST['tambah_potensi'])) {
    $judul    = input($_POST['judul']);
    $kategori = input($_POST['kategori']);
    $deskripsi= input($_POST['deskripsi']);

    $foto_nama = 'default.jpg';
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $allowed = array('jpg', 'jpeg', 'png', 'webp');
        $filename = $_FILES['gambar']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $foto_nama = 'potensi_' . time() . '.' . $ext;
            $target_dir = "../assets/uploads/";

            if (!file_exists($target_dir)) { 
                mkdir($target_dir, 0777, true); 
            }
            move_uploaded_file($_FILES['gambar']['tmp_name'], $target_dir . $foto_nama);
        }
    }

    $query = "INSERT INTO potensi (judul, kategori, deskripsi, gambar) VALUES ('$judul', '$kategori', '$deskripsi', '$foto_nama')";
    mysqli_query($conn, $query);
    header("Location: potensi.php");
    exit();
}

// Hapus Potensi
if (isset($_GET['hapus'])) {
    $id = input($_GET['hapus']);
    mysqli_query($conn, "DELETE FROM potensi WHERE id = '$id'");
    header("Location: potensi.php");
    exit();
}

$potensi_list = mysqli_query($conn, "SELECT * FROM potensi ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Potensi Desa - Admin Desa Tialai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex min-h-screen">

    <!-- SIDEBAR COMPONENT -->
    <?php include 'sidebar.php'; ?>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 p-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Kelola Potensi Desa</h1>
            <p class="text-xs text-gray-500">Tambah dan update informasi potensi lokal seperti pertanian, peternakan, dan UMKM.</p>
        </div>

        <!-- FORM TAMBAH POTENSI -->
        <div class="bg-white p-6 rounded-2xl border shadow-sm mb-8">
            <h2 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                <i class="fas fa-plus-circle text-emerald-600"></i> Tambah Potensi Desa Baru
            </h2>
            <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Potensi / Sektor</label>
                        <input type="text" name="judul" placeholder="Contoh: Perkebunan Sayur" required class="w-full p-2.5 text-xs border rounded-lg outline-none focus:border-emerald-600">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Kategori Potensi</label>
                        <select name="kategori" required class="w-full p-2.5 text-xs border rounded-lg outline-none focus:border-emerald-600">
                            <option value="Pertanian">Pertanian</option>
                            <option value="Peternakan">Peternakan</option>
                            <option value="Perikanan">Perikanan</option>
                            <option value="UMKM & Kerajinan">UMKM & Kerajinan</option>
                            <option value="Pariwisata">Pariwisata</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Deskripsi Ringkas</label>
                    <textarea name="deskripsi" rows="3" placeholder="Jelaskan gambaran umum potensi ini..." required class="w-full p-2.5 text-xs border rounded-lg outline-none focus:border-emerald-600"></textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Upload Foto Sampul</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full p-2 text-xs border rounded-lg bg-gray-50">
                </div>

                <button type="submit" name="tambah_potensi" class="bg-[#0b3323] hover:bg-emerald-900 text-white px-5 py-2.5 rounded-lg text-xs font-semibold transition flex items-center gap-2">
                    <i class="fas fa-paper-plane"></i> Simpan Potensi
                </button>
            </form>
        </div>

        <!-- DAFTAR POTENSI DESA -->
        <div class="bg-white rounded-2xl border shadow-sm overflow-hidden">
            <div class="p-4 border-b bg-gray-50">
                <h2 class="text-sm font-bold text-gray-700">Daftar Potensi Desa Saat Ini</h2>
            </div>
            <div class="p-4 grid grid-cols-1 md:grid-cols-3 gap-4">
                <?php if (mysqli_num_rows($potensi_list) > 0): ?>
                    <?php while ($p = mysqli_fetch_assoc($potensi_list)): ?>
                        <div class="border rounded-xl p-3 flex flex-col justify-between bg-white">
                            <div>
                                <img src="../assets/uploads/<?php echo htmlspecialchars($p['gambar']); ?>" class="w-full h-36 object-cover rounded-lg mb-3 bg-gray-100">
                                <span class="bg-emerald-100 text-emerald-800 text-[10px] font-semibold px-2 py-0.5 rounded-full mb-2 inline-block">
                                    <?php echo htmlspecialchars($p['kategori']); ?>
                                </span>
                                <h3 class="font-bold text-sm text-gray-900 mb-1"><?php echo htmlspecialchars($p['judul']); ?></h3>
                                <p class="text-xs text-gray-500 line-clamp-3 mb-4"><?php echo htmlspecialchars($p['deskripsi']); ?></p>
                            </div>
                            <a href="?hapus=<?php echo $p['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus potensi ini?');" class="text-xs text-red-600 hover:text-red-800 font-semibold flex items-center gap-1 justify-end">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="col-span-3 text-center py-6 text-xs text-gray-400">Belum ada data potensi desa.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

</body>
</html>