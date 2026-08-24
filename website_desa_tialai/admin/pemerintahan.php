<?php
session_start();
require_once '../config.php';

// Proteksi Halaman Admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login.php");
    exit();
}

// Proses Tambah Perangkat Desa
if (isset($_POST['tambah_perangkat'])) {
    $jabatan = input($_POST['jabatan']);
    $nama    = input($_POST['nama']);

    $foto_nama = 'default_user.jpg';
    if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $allowed = array('jpg', 'jpeg', 'png', 'webp');
        $filename = $_FILES['foto']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            $foto_nama = 'perangkat_' . time() . '.' . $ext;
            $target_dir = "../assets/uploads/";

            if (!file_exists($target_dir)) { 
                mkdir($target_dir, 0777, true); 
            }
            move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $foto_nama);
        }
    }

    $query = "INSERT INTO perangkat_desa (jabatan, nama, foto) VALUES ('$jabatan', '$nama', '$foto_nama')";
    mysqli_query($conn, $query);
    header("Location: perangkat.php");
    exit();
}

// Proses Hapus Data Perangkat
if (isset($_GET['hapus'])) {
    $id = input($_GET['hapus']);
    
    $get_foto = mysqli_query($conn, "SELECT foto FROM perangkat_desa WHERE id = '$id'");
    $data_foto = mysqli_fetch_assoc($get_foto);
    if ($data_foto && $data_foto['foto'] != 'default_user.jpg') {
        @unlink("../assets/uploads/" . $data_foto['foto']);
    }

    mysqli_query($conn, "DELETE FROM perangkat_desa WHERE id = '$id'");
    header("Location: perangkat.php");
    exit();
}

// Ambil Data Perangkat Desa
$perangkat_list = mysqli_query($conn, "SELECT * FROM perangkat_desa ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Perangkat Desa - Admin Desa Tialai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800 flex min-h-screen">

    <!-- INTEGRASI SIDEBAR MENU -->
    <?php include 'sidebar.php'; ?>

    <!-- AREA CONTENT UTAMA -->
    <main class="flex-1 p-8">
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-gray-900">Kelola Perangkat Desa</h1>
            <p class="text-xs text-gray-500">Atur dan update data profil perangkat/aparatur Desa Tialai.</p>
        </div>

        <!-- FORM TAMBAH PERANGKAT DESA -->
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm mb-8">
            <h2 class="text-sm font-bold text-gray-700 mb-4 flex items-center gap-2">
                <i class="fas fa-user-plus text-emerald-600"></i> Tambah Perangkat Desa Baru
            </h2>
            <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Jabatan</label>
                        <input type="text" name="jabatan" placeholder="Contoh: Kaur Perencanaan" required class="w-full p-2.5 text-xs border rounded-lg outline-none focus:border-emerald-600">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gray-600 mb-1">Nama Lengkap & Gelar</label>
                        <input type="text" name="nama" placeholder="Contoh: Maria Goreti Hoar, S.Pd." required class="w-full p-2.5 text-xs border rounded-lg outline-none focus:border-emerald-600">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Upload Foto Profil</label>
                    <input type="file" name="foto" accept="image/*" required class="w-full p-2 text-xs border rounded-lg bg-gray-50">
                </div>

                <button type="submit" name="tambah_perangkat" class="bg-[#0b3323] hover:bg-emerald-900 text-white px-5 py-2.5 rounded-lg text-xs font-semibold transition flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan Perangkat Desa
                </button>
            </form>
        </div>

        <!-- DAFTAR PERANGKAT DESA (TAMPILAN CARD SESUAI DESAIN) -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="p-4 border-b bg-gray-50">
                <h2 class="text-sm font-bold text-gray-700">Daftar Profil Perangkat Desa Saat Ini</h2>
            </div>
            
            <div class="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <?php if (mysqli_num_rows($perangkat_list) > 0): ?>
                    <?php while ($p = mysqli_fetch_assoc($perangkat_list)): ?>
                        <div class="bg-white rounded-2xl border shadow-sm overflow-hidden flex flex-col justify-between border-gray-200">
                            <div>
                                <!-- FOTO PERANGKAT -->
                                <img src="../assets/uploads/<?php echo htmlspecialchars($p['foto']); ?>" class="w-full h-48 object-cover object-center bg-gray-100">
                                
                                <!-- DETAIL JABATAN & NAMA -->
                                <div class="p-4">
                                    <h3 class="font-bold text-sm text-gray-900 leading-snug mb-1">
                                        <?php echo htmlspecialchars($p['jabatan']); ?>
                                    </h3>
                                    <p class="text-xs text-gray-400">
                                        <?php echo htmlspecialchars($p['nama']); ?>
                                    </p>
                                </div>
                            </div>
                            
                            <!-- TOMBOL HAPUS -->
                            <div class="p-3 border-t bg-gray-50 flex justify-end">
                                <a href="?hapus=<?php echo $p['id']; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');" class="text-xs text-red-600 hover:text-red-800 font-semibold flex items-center gap-1">
                                    <i class="fas fa-trash"></i> Hapus
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="col-span-4 text-center py-6 text-xs text-gray-400">Belum ada data perangkat desa.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

</body>
</html>