<?php
session_start();
require_once '../config.php';

// Cek Session Login Admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login.php");
    exit();
}

// Proses Update Profil Desa
if (isset($_POST['simpan_profil'])) {
    $pria    = (int)$_POST['penduduk_pria'];
    $wanita  = (int)$_POST['penduduk_wanita'];
    $total   = $pria + $wanita; // Hitung otomatis total
    $sejarah = mysqli_real_escape_string($conn, $_POST['sejarah']);
    $visi    = mysqli_real_escape_string($conn, $_POST['visi']);
    $misi    = mysqli_real_escape_string($conn, $_POST['misi']);

    // Cek apakah data id = 1 sudah ada di database
    $check = mysqli_query($conn, "SELECT id FROM profil_desa WHERE id = 1");
    
    if (mysqli_num_rows($check) > 0) {
        $query = "UPDATE profil_desa SET 
                    total_penduduk = '$total', 
                    penduduk_pria = '$pria', 
                    penduduk_wanita = '$wanita', 
                    sejarah = '$sejarah', 
                    visi = '$visi', 
                    misi = '$misi' 
                  WHERE id = 1";
    } else {
        $query = "INSERT INTO profil_desa (id, total_penduduk, penduduk_pria, penduduk_wanita, sejarah, visi, misi) 
                  VALUES (1, '$total', '$pria', '$wanita', '$sejarah', '$visi', '$misi')";
    }

    // Eksekusi Query dengan penanganan Error
    if (mysqli_query($conn, $query)) {
        header("Location: profil_desa.php?status=success");
        exit();
    } else {
        die("Gagal menyimpan data: " . mysqli_error($conn));
    }
}

// Fetch Data Profil Desa
$query_profil = mysqli_query($conn, "SELECT * FROM profil_desa WHERE id = 1 LIMIT 1");
$profil = mysqli_fetch_assoc($query_profil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Profil Desa - Admin Desa Tialai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex min-h-screen overflow-x-hidden">

    <!-- Include Sidebar Admin Langsung -->
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <main class="flex-1 p-8 overflow-y-auto">
        <div class="max-w-4xl mx-auto">
            
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Kelola Profil Desa</h1>
                <p class="text-xs text-gray-500">Ubah data statistik penduduk, sejarah, serta visi & misi Desa Tialai.</p>
            </div>

            <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
                <div class="mb-6 p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 rounded-xl text-xs flex items-center gap-2 shadow-sm">
                    <i class="fas fa-check-circle text-emerald-600 text-base"></i> Data profil desa berhasil diperbarui!
                </div>
            <?php endif; ?>

            <form method="POST" class="space-y-6">
                
                <!-- Data Demografi Penduduk -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm space-y-4">
                    <h2 class="font-bold text-sm text-gray-700 border-b pb-2 flex items-center gap-2">
                        <i class="fas fa-users text-emerald-700"></i> Demografi Penduduk
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="text-xs font-semibold text-gray-600 block mb-1">Jumlah Laki-laki</label>
                            <input type="number" name="penduduk_pria" value="<?php echo $profil['penduduk_pria'] ?? 0; ?>" class="w-full text-xs p-2.5 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
                        </div>
                        <div>
                            <label class="text-xs font-semibold text-gray-600 block mb-1">Jumlah Perempuan</label>
                            <input type="number" name="penduduk_wanita" value="<?php echo $profil['penduduk_wanita'] ?? 0; ?>" class="w-full text-xs p-2.5 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none" required>
                        </div>
                    </div>
                </div>

                <!-- Sejarah Desa -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm space-y-2">
                    <h2 class="font-bold text-sm text-gray-700 border-b pb-2 flex items-center gap-2">
                        <i class="fas fa-history text-emerald-700"></i> Sejarah Desa
                    </h2>
                    <textarea name="sejarah" rows="6" class="w-full text-xs p-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none" required><?php echo htmlspecialchars($profil['sejarah'] ?? ''); ?></textarea>
                </div>

                <!-- Visi & Misi -->
                <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm space-y-4">
                    <h2 class="font-bold text-sm text-gray-700 border-b pb-2 flex items-center gap-2">
                        <i class="fas fa-bullseye text-emerald-700"></i> Visi & Misi Desa
                    </h2>
                    <div>
                        <label class="text-xs font-semibold text-gray-600 block mb-1">Visi Desa</label>
                        <textarea name="visi" rows="2" class="w-full text-xs p-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none" required><?php echo htmlspecialchars($profil['visi'] ?? ''); ?></textarea>
                    </div>
                    <div>
                        <label class="text-xs font-semibold text-gray-600 block mb-1">Misi Desa</label>
                        <textarea name="misi" rows="5" class="w-full text-xs p-3 border rounded-lg focus:ring-2 focus:ring-emerald-500 focus:outline-none" required><?php echo htmlspecialchars($profil['misi'] ?? ''); ?></textarea>
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" name="simpan_profil" class="bg-emerald-800 text-white text-xs font-semibold px-6 py-3 rounded-lg hover:bg-emerald-900 transition flex items-center gap-2 shadow cursor-pointer">
                        <i class="fas fa-save"></i> Simpan Perubahan Profil
                    </button>
                </div>

            </form>

        </div>
    </main>

</body>
</html>