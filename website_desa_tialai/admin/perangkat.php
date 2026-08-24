<?php
session_start();
require_once '../config.php';

// Proses Tambah Data Perangkat
if (isset($_POST['tambah'])) {
    $nama     = mysqli_real_escape_string($conn, $_POST['nama']);
    $jabatan  = mysqli_real_escape_string($conn, $_POST['jabatan']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']); // Tambahan untuk kategori
    
    // Upload Foto
    $foto     = $_FILES['foto']['name'];
    $tmp_name = $_FILES['foto']['tmp_name'];
    $file_ext = pathinfo($foto, PATHINFO_EXTENSION);
    $foto_baru = time() . '_' . rand(100, 999) . '.' . $file_ext;
    
    $target = "../assets/uploads/" . $foto_baru;

    if (move_uploaded_file($tmp_name, $target)) {
        // Query disesuaikan memasukkan kolom kategori
        $query = "INSERT INTO perangkat_desa (nama, jabatan, foto, kategori) VALUES ('$nama', '$jabatan', '$foto_baru', '$kategori')";
        mysqli_query($conn, $query);
        header("Location: perangkat.php?status=success");
        exit;
    }
}

// Proses Hapus Data
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    
    // Ambil nama file foto sebelum dihapus dari DB
    $get_foto = mysqli_query($conn, "SELECT foto FROM perangkat_desa WHERE id = $id");
    if ($data = mysqli_fetch_assoc($get_foto)) {
        @unlink("../assets/uploads/" . $data['foto']);
    }
    
    mysqli_query($conn, "DELETE FROM perangkat_desa WHERE id = $id");
    header("Location: perangkat.php?status=deleted");
    exit;
}

// Ambil data perangkat desa
$query_perangkat = mysqli_query($conn, "SELECT * FROM perangkat_desa ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Perangkat Desa - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100 font-sans flex">

    <!-- Sertakan Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-1 p-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-2">Kelola Perangkat Desa</h1>
        <p class="text-sm text-gray-500 mb-6">Tambah, lihat, atau hapus data aparatur desa yang akan ditampilkan pada halaman publik.</p>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- FORM TAMBAH DATA -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 h-fit">
                <h2 class="text-base font-bold text-gray-800 mb-4 border-b pb-2">Tambah Perangkat Desa</h2>
                <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
    <div>
        <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Lengkap</label>
        <input type="text" name="nama" required class="w-full text-sm border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:border-emerald-600" placeholder="Contoh: Ahmad Subagjo, S.STP">
    </div>
    <div>
        <label class="block text-xs font-semibold text-gray-600 mb-1">Jabatan</label>
        <input type="text" name="jabatan" required class="w-full text-sm border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:border-emerald-600" placeholder="Contoh: Kepala Desa / Kasi Pemerintahan">
    </div>
    <div>
        <label class="block text-xs font-semibold text-gray-600 mb-1">Kategori Visual</label>
        <select name="kategori" class="w-full text-sm border border-gray-300 rounded-lg p-2.5 focus:outline-none focus:border-emerald-600">
            <option value="perangkat">Perangkat Desa (Biasa)</option>
            <option value="utama">Struktur Utama (Kades / Sekdes / BPD)</option>
        </select>
    </div>
    <div>
        <label class="block text-xs font-semibold text-gray-600 mb-1">Foto Formal</label>
        <input type="file" name="foto" accept="image/*" required class="w-full text-xs text-gray-500 border border-gray-300 rounded-lg p-2 focus:outline-none">
    </div>
    <button type="submit" name="tambah" class="w-full bg-emerald-800 text-white font-semibold text-sm py-2.5 rounded-lg hover:bg-emerald-900 transition-all">
        Simpan Data
    </button>
</form>
            </div>

            <!-- TABEL DAFTAR DATA PERANGKAT -->
            <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                <h2 class="text-base font-bold text-gray-800 mb-4 border-b pb-2">Daftar Perangkat Desa Saat Ini</h2>
                
                <div class="overflow-x-auto">
                   <table class="w-full text-left border-collapse">
    <thead>
        <tr class="bg-gray-50 text-xs font-semibold text-gray-500 border-b">
            <th class="p-3">Foto</th>
            <th class="p-3">Nama Lengkap</th>
            <th class="p-3">Jabatan</th>
            <th class="p-3">Kategori</th>
            <th class="p-3 text-center">Aksi</th>
        </tr>
    </thead>
    <tbody class="divide-y text-xs text-gray-700">
        <?php if (mysqli_num_rows($query_perangkat) > 0): ?>
            <?php while ($p = mysqli_fetch_assoc($query_perangkat)): ?>
                <tr>
                    <td class="p-3">
                        <img src="../assets/uploads/<?php echo htmlspecialchars($p['foto']); ?>" class="w-10 h-10 rounded-full object-cover border" onerror="this.src='https://via.placeholder.com/150'">
                    </td>
                    <td class="p-3 font-medium text-gray-900"><?php echo htmlspecialchars($p['nama']); ?></td>
                    <td class="p-3 text-emerald-800 font-semibold"><?php echo htmlspecialchars($p['jabatan']); ?></td>
                    <td class="p-3">
                        <?php if (isset($p['kategori']) && $p['kategori'] == 'utama'): ?>
                            <span class="bg-amber-100 text-amber-800 px-2 py-1 rounded text-[10px] font-bold">Struktur Utama</span>
                        <?php else: ?>
                            <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-[10px]">Perangkat Desa</span>
                        <?php endif; ?>
                    </td>
                    <td class="p-3 text-center">
                        <a href="perangkat.php?hapus=<?php echo $p['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="bg-red-50 text-red-600 px-3 py-1.5 rounded-lg hover:bg-red-100 font-medium">
                            Hapus
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="5" class="p-4 text-center text-gray-400">Belum ada data perangkat desa.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
                </div>
            </div>

        </div>
    </main>

</body>
</html>