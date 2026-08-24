<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin_logged_in'])) { 
    header("Location: ../login.php"); 
    exit(); 
}

// Fungsi bantu sanitasi input jika belum ada di config.php
if (!function_exists('input')) {
    function input($data) {
        global $conn;
        return mysqli_real_escape_string($conn, trim($data));
    }
}

// Update Status Pengaduan
if (isset($_POST['update_status'])) {
    $id_aduan = input($_POST['id_aduan']);
    $status_baru = input($_POST['status']);
    
    mysqli_query($conn, "UPDATE pengaduan SET status = '$status_baru' WHERE id = '$id_aduan'");
    header("Location: pengaduan.php");
    exit();
}

// Hapus Pengaduan
if (isset($_POST['hapus_aduan'])) {
    $id_aduan = input($_POST['id_aduan']);
    
    // Ambil info foto untuk dihapus dari folder jika ada
    $cek_foto = mysqli_query($conn, "SELECT foto FROM pengaduan WHERE id = '$id_aduan' LIMIT 1");
    if ($cek_foto && mysqli_num_rows($cek_foto) > 0) {
        $data_foto = mysqli_fetch_assoc($cek_foto);
        if (!empty($data_foto['foto']) && file_exists("../assets/uploads/" . $data_foto['foto'])) {
            unlink("../assets/uploads/" . $data_foto['foto']);
        }
    }

    mysqli_query($conn, "DELETE FROM pengaduan WHERE id = '$id_aduan'");
    header("Location: pengaduan.php");
    exit();
}

$query = mysqli_query($conn, "SELECT * FROM pengaduan ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Pengaduan Masyarakat - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-xs text-gray-800">

    <header class="bg-[#0b3323] text-white py-4 px-6 flex justify-between items-center shadow">
        <div class="flex items-center gap-3">
            <i class="fas fa-bullhorn text-xl"></i>
            <h1 class="font-bold text-base">Kelola Pengaduan Masyarakat</h1>
        </div>
        <a href="index.php" class="bg-gray-600 hover:bg-gray-700 px-3 py-1.5 rounded transition font-semibold text-white">
            ← Kembali ke Dashboard
        </a>
    </header>

    <main class="max-w-7xl mx-auto px-4 py-8">
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100 font-semibold border-b text-gray-700">
                        <tr>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">Pelapor & WA</th>
                            <th class="p-3">Kategori & Judul</th>
                            <th class="p-3">Isi Laporan</th>
                            <th class="p-3">Foto Bukti</th>
                            <th class="p-3">Status</th>
                            <th class="p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php if (mysqli_num_rows($query) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($query)): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="p-3 text-gray-500 whitespace-nowrap">
                                        <?php echo date('d/m/Y H:i', strtotime($row['created_at'])); ?>
                                    </td>
                                    <td class="p-3">
                                        <div class="font-bold text-gray-900"><?php echo htmlspecialchars($row['nama']); ?></div>
                                        <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $row['no_hp']); ?>" target="_blank" class="text-emerald-700 font-semibold hover:underline flex items-center gap-1 mt-0.5">
                                            <i class="fab fa-whatsapp"></i> <?php echo htmlspecialchars($row['no_hp']); ?>
                                        </a>
                                    </td>
                                    <td class="p-3">
                                        <span class="bg-amber-100 text-amber-800 text-[10px] px-2 py-0.5 rounded font-bold uppercase"><?php echo htmlspecialchars($row['kategori']); ?></span>
                                        <div class="font-bold text-gray-900 mt-1"><?php echo htmlspecialchars($row['judul']); ?></div>
                                    </td>
                                    <td class="p-3 text-gray-600 max-w-xs">
                                        <?php echo nl2br(htmlspecialchars($row['isi_laporan'])); ?>
                                    </td>
                                    <td class="p-3">
                                        <?php if (!empty($row['foto'])): ?>
                                            <a href="../assets/uploads/<?php echo $row['foto']; ?>" target="_blank" class="text-blue-600 hover:underline flex items-center gap-1">
                                                <i class="fas fa-image"></i> Lihat Foto
                                            </a>
                                        <?php else: ?>
                                            <span class="text-gray-400">Tidak ada</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-3">
                                        <?php 
                                        $badge = [
                                            'Baru' => 'bg-red-100 text-red-800',
                                            'Proses' => 'bg-blue-100 text-blue-800',
                                            'Selesai' => 'bg-emerald-100 text-emerald-800'
                                        ];
                                        $cls = isset($badge[$row['status']]) ? $badge[$row['status']] : 'bg-gray-100';
                                        ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold <?php echo $cls; ?>">
                                            <?php echo $row['status']; ?>
                                        </span>
                                    </td>
                                    <td class="p-3 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <!-- Form Ubah Status -->
                                            <form action="pengaduan.php" method="POST" class="flex items-center gap-1">
                                                <input type="hidden" name="id_aduan" value="<?php echo $row['id']; ?>">
                                                <select name="status" class="border rounded text-xs px-2 py-1 outline-none">
                                                    <option value="Baru" <?php if($row['status']=='Baru') echo 'selected'; ?>>Baru</option>
                                                    <option value="Proses" <?php if($row['status']=='Proses') echo 'selected'; ?>>Proses</option>
                                                    <option value="Selesai" <?php if($row['status']=='Selesai') echo 'selected'; ?>>Selesai</option>
                                                </select>
                                                <button type="submit" name="update_status" class="bg-[#0b3323] text-white px-2 py-1 rounded text-xs hover:bg-[#144733]">
                                                    Simpan
                                                </button>
                                            </form>

                                            <!-- Tombol Hapus dengan Konfirmasi -->
                                            <form action="pengaduan.php" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengaduan dari <?php echo addslashes($row['nama']); ?> ini?');">
                                                <input type="hidden" name="id_aduan" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="hapus_aduan" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs transition flex items-center gap-1" title="Hapus Pengaduan">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="p-6 text-center text-gray-400">Belum ada pengaduan masyarakat yang masuk.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

</body>
</html>