<?php
session_start();
require_once '../config.php';

// Proses Update Kepala Dusun
if (isset($_POST['update_dusun'])) {
    $id = (int)$_POST['id'];
    $nama_kadus = input($_POST['nama_kadus']);
    
    mysqli_query($conn, "UPDATE dusun SET nama_kadus='$nama_kadus' WHERE id='$id'");
    header("Location: dusun.php?msg=updated");
    exit();
}

// Proses Update Ketua RW
if (isset($_POST['update_rw'])) {
    $id = (int)$_POST['id'];
    $nama_ketua = input($_POST['nama_ketua']);
    
    mysqli_query($conn, "UPDATE rw SET nama_ketua='$nama_ketua' WHERE id='$id'");
    header("Location: dusun.php?msg=updated");
    exit();
}

$query_dusun = mysqli_query($conn, "SELECT * FROM dusun ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Wilayah Dusun & RW - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">
        <h1 class="text-xl font-bold mb-6 text-gray-800"><i class="fas fa-edit text-emerald-700"></i> Kelola Kadus & Ketua RW</h1>

        <div class="space-y-6">
            <?php while ($d = mysqli_fetch_assoc($query_dusun)): ?>
                <div class="border border-gray-200 rounded-lg p-4 bg-gray-50">
                    <!-- Form Edit Kadus -->
                    <form method="POST" class="flex items-center justify-between gap-4 pb-3 border-b mb-3">
                        <input type="hidden" name="id" value="<?php echo $d['id']; ?>">
                        <div class="w-1/3">
                            <span class="text-xs font-bold text-gray-500 uppercase">Dusun</span>
                            <p class="font-bold text-emerald-800"><?php echo htmlspecialchars($d['nama_dusun']); ?></p>
                        </div>
                        <div class="flex-1">
                            <label class="text-xs font-semibold text-gray-600">Kepala Dusun (Kadus)</label>
                            <input type="text" name="nama_kadus" value="<?php echo htmlspecialchars($d['nama_kadus']); ?>" class="w-full text-sm p-2 border rounded" required>
                        </div>
                        <button type="submit" name="update_dusun" class="mt-4 bg-emerald-700 text-white text-xs px-3 py-2 rounded hover:bg-emerald-800">Simpan Kadus</button>
                    </form>

                    <!-- Form Edit RW -->
                    <div class="pl-4 space-y-2">
                        <span class="text-xs font-semibold text-gray-500">Ketua RW:</span>
                        <?php
                        $d_id = $d['id'];
                        $q_rw = mysqli_query($conn, "SELECT * FROM rw WHERE dusun_id='$d_id'");
                        while ($rw = mysqli_fetch_assoc($q_rw)):
                        ?>
                            <form method="POST" class="flex items-center gap-3">
                                <input type="hidden" name="id" value="<?php echo $rw['id']; ?>">
                                <span class="text-xs font-bold text-gray-700 w-16"><?php echo $rw['nama_rw']; ?>:</span>
                                <input type="text" name="nama_ketua" value="<?php echo htmlspecialchars($rw['nama_ketua']); ?>" class="flex-1 text-xs p-1.5 border rounded" required>
                                <button type="submit" name="update_rw" class="bg-gray-800 text-white text-xs px-2.5 py-1.5 rounded hover:bg-black">Simpan RW</button>
                            </form>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

</body>
</html>