<?php 
require_once 'config.php';
include 'components/header.php'; 

// Fetch data pimpinan utama secara terpisah
$query_kades  = mysqli_query($conn, "SELECT * FROM perangkat_desa WHERE kategori='utama' AND jabatan LIKE '%Kepala Desa%' LIMIT 1");
$query_sekdes = mysqli_query($conn, "SELECT * FROM perangkat_desa WHERE kategori='utama' AND jabatan LIKE '%Sekretaris%' LIMIT 1");
$query_bpd    = mysqli_query($conn, "SELECT * FROM perangkat_desa WHERE kategori='utama' AND (jabatan LIKE '%BPD%' OR jabatan LIKE '%Permusyawaratan%') LIMIT 1");

$kades  = mysqli_fetch_assoc($query_kades);
$sekdes = mysqli_fetch_assoc($query_sekdes);
$bpd    = mysqli_fetch_assoc($query_bpd);
?>

<!-- HEADER HALAMAN -->
<div class="bg-gray-100 py-12 text-center border-b border-gray-200 px-4">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Pemerintahan Desa</h1>
    <p class="text-xs text-gray-500 max-w-lg mx-auto">Struktur organisasi dan profil aparatur yang bertugas melayani dan memajukan Desa Tialai.</p>
</div>

<main class="max-w-6xl mx-auto px-4 py-12 space-y-16">

    <!-- STRUKTUR ORGANISASI UTAMA -->
    <section>
        <h2 class="text-xl font-bold mb-8 flex items-center justify-center gap-2">
            <i class="fas fa-sitemap text-emerald-800"></i> Struktur Organisasi Utama
        </h2>
        
        <!-- Hirarki Kades -->
        <div class="flex justify-center mb-6">
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm text-center w-72">
                <img src="assets/uploads/<?php echo $kades ? htmlspecialchars($kades['foto']) : 'default.jpg'; ?>" class="w-24 h-24 rounded-full mx-auto mb-4 object-cover border-2 border-emerald-600 shadow" onerror="this.src='https://via.placeholder.com/150'">
                <h3 class="font-bold text-base text-gray-900"><?php echo $kades ? htmlspecialchars($kades['nama']) : 'Bpk. Yoseph Luan'; ?></h3>
                <p class="text-xs text-emerald-800 font-semibold mt-1"><?php echo $kades ? htmlspecialchars($kades['jabatan']) : 'Kepala Desa Tialai'; ?></p>
            </div>
        </div>

        <!-- Hirarki Sekdes & BPD -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-2xl mx-auto">
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm text-center">
                <img src="assets/uploads/<?php echo $sekdes ? htmlspecialchars($sekdes['foto']) : 'default.jpg'; ?>" class="w-20 h-20 rounded-full mx-auto mb-3 object-cover border-2 border-emerald-600 shadow" onerror="this.src='https://via.placeholder.com/150'">
                <h3 class="font-bold text-sm text-gray-900"><?php echo $sekdes ? htmlspecialchars($sekdes['jabatan']) : 'Sekretaris Desa'; ?></h3>
                <p class="text-xs text-emerald-800 font-medium mt-1"><?php echo $sekdes ? htmlspecialchars($sekdes['nama']) : 'Teodorus Y. Mau, S.E.'; ?></p>
            </div>
            <div class="bg-white p-6 rounded-2xl border border-gray-200 shadow-sm text-center">
                <img src="assets/uploads/<?php echo $bpd ? htmlspecialchars($bpd['foto']) : 'default.jpg'; ?>" class="w-20 h-20 rounded-full mx-auto mb-3 object-cover border-2 border-emerald-600 shadow" onerror="this.src='https://via.placeholder.com/150'">
                <h3 class="font-bold text-sm text-gray-900"><?php echo $bpd ? htmlspecialchars($bpd['jabatan']) : 'BPD (Badan Permusyawaratan Desa)'; ?></h3>
                <p class="text-xs text-emerald-800 font-medium mt-1"><?php echo $bpd ? htmlspecialchars($bpd['nama']) : 'Fransiskus X. Seran'; ?></p>
            </div>
        </div>
    </section>

    <!-- PROFIL PERANGKAT DESA -->
    <section>
        <h2 class="text-xl font-bold mb-6 flex items-center gap-2">
            <i class="fas fa-users-cog text-emerald-800"></i> Profil Perangkat Desa
        </h2>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <?php
            $query_perangkat = mysqli_query($conn, "SELECT * FROM perangkat_desa WHERE kategori='perangkat' ORDER BY id ASC");
            if (mysqli_num_rows($query_perangkat) > 0):
                while ($p = mysqli_fetch_assoc($query_perangkat)):
            ?>
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden flex flex-col">
                    <img src="assets/uploads/<?php echo htmlspecialchars($p['foto']); ?>" class="w-full h-52 object-cover object-center bg-gray-100" onerror="this.src='https://via.placeholder.com/300'">
                    <div class="p-4">
                        <h3 class="font-bold text-sm text-gray-900 mb-1"><?php echo htmlspecialchars($p['jabatan']); ?></h3>
                        <p class="text-xs text-gray-400"><?php echo htmlspecialchars($p['nama']); ?></p>
                    </div>
                </div>
            <?php 
                endwhile;
            else:
            ?>
                <div class="col-span-full text-left py-2 text-xs text-gray-400">
                    Belum ada data perangkat desa yang ditambahkan.
                </div>
            <?php endif; ?>
        </div>
    </section>

   <!-- WILAYAH DUSUN & RW (DINAMIS DARI DATABASE) -->
    <section>
        <h2 class="text-xl font-bold mb-8 flex items-center justify-center gap-2 text-gray-900">
            <i class="fas fa-building text-emerald-800"></i> Wilayah Dusun & RW
        </h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php
            $query_dusun = mysqli_query($conn, "SELECT * FROM dusun ORDER BY id ASC");
            if (mysqli_num_rows($query_dusun) > 0):
                while ($dusun = mysqli_fetch_assoc($query_dusun)):
            ?>
                <div class="bg-white p-5 rounded-2xl border border-gray-200 shadow-sm flex flex-col justify-between">
                    <div>
                        <!-- Header Kadus -->
                        <div class="flex items-center gap-3 pb-3 border-b border-gray-100">
                            <div class="w-12 h-12 rounded-full bg-emerald-100 text-emerald-800 flex items-center justify-center font-bold text-sm flex-shrink-0">
                                <i class="fas fa-user-tie text-lg"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-sm text-gray-900"><?php echo htmlspecialchars($dusun['nama_kadus']); ?></h3>
                                <p class="text-xs text-emerald-800 font-semibold">Kadus <?php echo htmlspecialchars($dusun['nama_dusun']); ?></p>
                            </div>
                        </div>

                        <!-- Daftar RW -->
                        <div class="mt-3 space-y-2 text-xs text-gray-600">
                            <?php
                            $dusun_id = $dusun['id'];
                            $query_rw = mysqli_query($conn, "SELECT * FROM rw WHERE dusun_id = '$dusun_id' ORDER BY nama_rw ASC");
                            if (mysqli_num_rows($query_rw) > 0):
                                while ($rw = mysqli_fetch_assoc($query_rw)):
                            ?>
                                    <div class="bg-gray-50 p-2.5 rounded-lg border border-gray-100">
                                        <strong><?php echo htmlspecialchars($rw['nama_rw']); ?>:</strong> <?php echo htmlspecialchars($rw['nama_ketua']); ?>
                                    </div>
                            <?php 
                                endwhile;
                            else:
                            ?>
                                <div class="text-xs text-gray-400 italic">Belu ada data RW.</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php 
                endwhile;
            else:
            ?>
                <div class="col-span-full text-center text-xs text-gray-400">
                    Belum ada data wilayah dusun yang diinputkan.
                </div>
            <?php endif; ?>
        </div>
    </section>

</main>

<?php include 'components/footer.php'; ?>