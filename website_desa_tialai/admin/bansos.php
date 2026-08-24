<?php
session_start();
require_once '../config.php';

if (!isset($_SESSION['admin_logged_in'])) { header("Location: ../login.php"); exit(); }

// Tambah Data Bansos
if (isset($_POST['tambah_bansos'])) {
    $nik = input($_POST['nik']);
    $nama = input($_POST['nama_penerima']);
    $dusun = input($_POST['dusun']);
    $jenis = input($_POST['jenis_bansos']);
    $status = input($_POST['status_penyaluran']);

    $query = "INSERT INTO bansos (nik, nama_penerima, dusun, jenis_bansos, status_penyaluran) 
              VALUES ('$nik', '$nama', '$dusun', '$jenis', '$status')";
    mysqli_query($conn, $query);
    header("Location: bansos.php");
    exit();
}

$data_bansos = mysqli_query($conn, "SELECT * FROM bansos ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Data Bansos - Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 text-xs">
    <div class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-xl font-bold text-gray-800">Kelola Data Penerima Bansos</h1>
            <a href="index.php" class="bg-gray-600 text-white px-3 py-1.5 rounded hover:bg-gray-700">← Kembali ke Dashboard</a>
        </div>

        <!-- FORM TAMBAH BANSOS -->
        <div class="bg-white p-5 rounded-xl border mb-6 shadow-sm">
            <h2 class="font-bold text-gray-700 mb-3">Tambah Penerima Bansos Baru</h2>
            <form action="bansos.php" method="POST" class="grid grid-cols-5 gap-3">
                <input type="text" name="nik" placeholder="16 Digit NIK" maxlength="16" required class="p-2 border rounded outline-none">
                <input type="text" name="nama_penerima" placeholder="Nama Lengkap" required class="p-2 border rounded outline-none">
                <input type="text" name="dusun" placeholder="Dusun / RT" required class="p-2 border rounded outline-none">
                <select name="jenis_bansos" class="p-2 border rounded outline-none">
                    <option value="BLT-DD">BLT-DD</option>
                    <option value="PKH">PKH</option>
                    <option value="BPNT">BPNT</option>
                </select>
                <select name="status_penyaluran" class="p-2 border rounded outline-none">
                    <option value="Terdaftar">Terdaftar</option>
                    <option value="Tersalurkan">Tersalurkan</option>
                </select>
                <button type="submit" name="tambah_bansos" class="col-span-5 bg-[#0b3323] text-white py-2 rounded font-semibold hover:bg-[#144733]">
                    Simpan Data Bansos
                </button>
            </form>
        </div>

        <!-- TABEL DATA BANSOS -->
        <div class="bg-white rounded-xl border shadow-sm overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-100 font-semibold border-b">
                    <tr>
                        <th class="p-3">NIK</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Dusun</th>
                        <th class="p-3">Jenis Bansos</th>
                        <th class="p-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    <?php while($row = mysqli_fetch_assoc($data_bansos)): ?>
                    <tr class="hover:bg-gray-50">
                        <td class="p-3 font-mono"><?php echo $row['nik']; ?></td>
                        <td class="p-3 font-bold"><?php echo $row['nama_penerima']; ?></td>
                        <td class="p-3"><?php echo $row['dusun']; ?></td>
                        <td class="p-3"><span class="bg-emerald-100 text-emerald-800 px-2 py-0.5 rounded font-semibold"><?php echo $row['jenis_bansos']; ?></span></td>
                        <td class="p-3"><?php echo $row['status_penyaluran']; ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>