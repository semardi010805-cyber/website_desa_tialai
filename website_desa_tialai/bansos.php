<?php 
require_once 'config.php';
include 'components/header.php'; 

$hasil = null;
$searched = false;

if (isset($_GET['nik'])) {
    $searched = true;
    $nik = input($_GET['nik']);
    $query = mysqli_query($conn, "SELECT * FROM bansos WHERE nik = '$nik'");
    if (mysqli_num_rows($query) > 0) {
        $hasil = mysqli_fetch_assoc($query);
    }
}
?>

<div class="max-w-2xl mx-auto px-4 py-12">
    <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm text-center">
        <div class="w-12 h-12 bg-emerald-50 rounded-full flex items-center justify-center mx-auto mb-4 text-[#0b3323]">
            <i class="fas fa-[#0b3323] fa-hand-holding-heart text-xl"></i>
        </div>
        <h1 class="text-2xl font-bold text-gray-900 mb-1">Cek Status Bantuan Sosial</h1>
        <p class="text-xs text-gray-500 mb-6">Masukkan NIK Anda untuk memeriksa daftar penerima bansos Desa Tialai.</p>

        <!-- Form Pencarian NIK -->
        <form action="bansos.php" method="GET" class="flex gap-2 max-w-md mx-auto mb-6">
            <input type="text" name="nik" placeholder="Masukkan 16 digit NIK..." maxlength="16" required
                   value="<?php echo isset($_GET['nik']) ? htmlspecialchars($_GET['nik']) : ''; ?>"
                   class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#0b3323] outline-none">
            <button type="submit" class="bg-[#0b3323] text-white px-5 py-2 rounded-lg text-xs font-semibold hover:bg-[#144733] transition flex items-center gap-2 shrink-0">
                <i class="fas fa-search"></i> Cek
            </button>
        </form>

        <!-- Hasil Pencarian -->
        <?php if ($searched): ?>
            <?php if ($hasil): ?>
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-5 text-left space-y-3">
                    <div class="flex items-center justify-between border-b border-emerald-100 pb-2">
                        <span class="text-xs text-gray-500">Nama Penerima</span>
                        <span class="font-bold text-sm text-gray-900"><?php echo htmlspecialchars($hasil['nama_penerima']); ?></span>
                    </div>
                    <div class="flex items-center justify-between border-b border-emerald-100 pb-2">
                        <span class="text-xs text-gray-500">Dusun</span>
                        <span class="font-semibold text-xs text-gray-800"><?php echo htmlspecialchars($hasil['dusun']); ?></span>
                    </div>
                    <div class="flex items-center justify-between border-b border-emerald-100 pb-2">
                        <span class="text-xs text-gray-500">Jenis Bantuan</span>
                        <span class="font-bold text-xs text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-full"><?php echo htmlspecialchars($hasil['jenis_bansos']); ?></span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">Status Penyaluran</span>
                        <span class="font-semibold text-xs text-gray-900"><?php echo htmlspecialchars($hasil['status_penyaluran']); ?></span>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-xs">
                    <i class="fas fa-exclamation-circle mr-1"></i> NIK tidak ditemukan dalam data penerima bantuan sosial.
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>

<?php include 'components/footer.php'; ?>