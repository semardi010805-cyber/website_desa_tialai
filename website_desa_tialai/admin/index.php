<?php
session_start();
require_once '../config.php';

// Proteksi Halaman Admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login.php");
    exit();
}

// Proses Hapus Pengajuan Surat
if (isset($_GET['hapus'])) {
    $id_hapus = input($_GET['hapus']);
    
    // Ambil data berkas terlebih dahulu untuk dihapus dari folder storage
    $get_file = mysqli_query($conn, "SELECT berkas FROM pengajuan_surat WHERE id = '$id_hapus'");
    if ($dt = mysqli_fetch_assoc($get_file)) {
        if (!empty($dt['berkas']) && file_exists("../assets/uploads/" . $dt['berkas'])) {
            unlink("../assets/uploads/" . $dt['berkas']);
        }
    }

    // Hapus baris dari database
    mysqli_query($conn, "DELETE FROM pengajuan_surat WHERE id = '$id_hapus'");
    header("Location: index.php");
    exit();
}

// Proses Update Status Surat
if (isset($_POST['update_status'])) {
    $id_surat = input($_POST['id_surat']);
    $status_baru = input($_POST['status']);
    
    mysqli_query($conn, "UPDATE pengajuan_surat SET status = '$status_baru' WHERE id = '$id_surat'");
    header("Location: index.php");
    exit();
}

// Ambil Semua Pengajuan Surat
$query = mysqli_query($conn, "SELECT * FROM pengajuan_surat ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Desa Tialai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 text-gray-800 flex min-h-screen">

    <!-- INTEGRASI SIDEBAR MENU -->
    <?php include 'sidebar.php'; ?>

    <!-- AREA CONTENT UTAMA -->
    <main class="flex-1 p-8">
        
        <!-- HEADER HALAMAN -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-1">Daftar Permohonan Surat Masuk</h2>
            <p class="text-xs text-gray-500">Kelola dan update status permohonan surat dari warga.</p>
        </div>

        <!-- TABEL DATA SURAT -->
        <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead class="bg-gray-100 text-gray-700 font-semibold border-b">
                        <tr>
                            <th class="p-3">Tanggal</th>
                            <th class="p-3">NIK & Nama Warga</th>
                            <th class="p-3">No. WhatsApp</th>
                            <th class="p-3">Jenis Surat</th>
                            <th class="p-3">Berkas</th>
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
                                        <div class="text-[11px] text-gray-400">NIK: <?php echo htmlspecialchars($row['nik']); ?></div>
                                    </td>
                                    <td class="p-3">
                                        <a href="https://wa.me/<?php echo preg_replace('/[^0-9]/', '', $row['no_hp']); ?>" target="_blank" class="text-emerald-700 font-semibold hover:underline flex items-center gap-1">
                                            <i class="fab fa-whatsapp"></i> <?php echo htmlspecialchars($row['no_hp']); ?>
                                        </a>
                                    </td>
                                    <td class="p-3 font-semibold text-gray-800">
                                        <?php echo htmlspecialchars($row['jenis_surat']); ?>
                                    </td>
                                    <td class="p-3">
                                        <?php if ($row['berkas']): ?>
                                            <a href="../assets/uploads/<?php echo $row['berkas']; ?>" target="_blank" class="text-blue-600 hover:underline">
                                                <i class="fas fa-file-alt"></i> Lihat Berkas
                                            </a>
                                        <?php else: ?>
                                            <span class="text-gray-400">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="p-3">
                                        <?php 
                                        $badge = [
                                            'Pending' => 'bg-yellow-100 text-yellow-800',
                                            'Diproses' => 'bg-blue-100 text-blue-800',
                                            'Selesai' => 'bg-emerald-100 text-emerald-800',
                                            'Ditolak' => 'bg-red-100 text-red-800'
                                        ];
                                        $cls = isset($badge[$row['status']]) ? $badge[$row['status']] : 'bg-gray-100';
                                        ?>
                                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold <?php echo $cls; ?>">
                                            <?php echo $row['status']; ?>
                                        </span>
                                    </td>
                                    <td class="p-3 text-center">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <!-- Form Simpan Status -->
                                            <form action="index.php" method="POST" class="flex items-center gap-1">
                                                <input type="hidden" name="id_surat" value="<?php echo $row['id']; ?>">
                                                <select name="status" class="border rounded text-xs px-2 py-1 outline-none bg-white">
                                                    <option value="Pending" <?php if($row['status']=='Pending') echo 'selected'; ?>>Pending</option>
                                                    <option value="Diproses" <?php if($row['status']=='Diproses') echo 'selected'; ?>>Diproses</option>
                                                    <option value="Selesai" <?php if($row['status']=='Selesai') echo 'selected'; ?>>Selesai</option>
                                                    <option value="Ditolak" <?php if($row['status']=='Ditolak') echo 'selected'; ?>>Ditolak</option>
                                                </select>
                                                <button type="submit" name="update_status" class="bg-[#0b3323] text-white px-2.5 py-1 rounded text-xs hover:bg-[#144733] font-medium transition">
                                                    Simpan
                                                </button>
                                            </form>

                                            <!-- Tombol Hapus -->
                                            <a href="index.php?hapus=<?php echo $row['id']; ?>" 
                                               onclick="return confirm('Yakin ingin menghapus permohonan surat ini?')" 
                                               class="bg-red-100 text-red-600 hover:bg-red-200 p-1.5 rounded transition"
                                               title="Hapus Permohonan">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="p-6 text-center text-gray-400">Belum ada pengajuan surat masuk.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </main>

</body>
</html>