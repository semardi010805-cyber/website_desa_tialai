<?php 
require_once 'config.php';
include 'components/header.php'; 

// Fetch data profil desa dari database
$query_profil = mysqli_query($conn, "SELECT * FROM profil_desa WHERE id = 1 LIMIT 1");
$profil = mysqli_fetch_assoc($query_profil);
?>

<!-- HERO SECTION PROFIL -->
<header class="hero-bg h-[300px] flex flex-col justify-center items-center text-center text-white px-4">
    <h1 class="text-3xl md:text-4xl font-bold mb-2">Profil Desa</h1>
    <p class="text-sm max-w-xl text-gray-200">Mengenal lebih dekat sejarah, visi misi, dan geografi Desa Tialai.</p>
</header>

<main class="max-w-5xl mx-auto px-4 py-12 space-y-16">

    <!-- SEJARAH DESA -->
    <section class="grid md:grid-cols-2 gap-8 items-center">
        <img src="assets/images/fotodesa.jpg" class="rounded-xl shadow-md object-cover h-64 w-full" alt="Sejarah Desa" onerror="this.src='https://via.placeholder.com/600x400'">
        <div>
            <h2 class="text-2xl font-bold mb-4 text-gray-900">Sejarah Desa</h2>
            <p class="text-xs text-gray-600 leading-relaxed whitespace-pre-line">
                <?php echo !empty($profil['sejarah']) ? htmlspecialchars($profil['sejarah']) : 'Data sejarah desa belum diisi oleh admin.'; ?>
            </p>
        </div>
    </section>

    <!-- VISI & MISI -->
    <section class="text-center">
        <h2 class="text-2xl font-bold mb-6 text-gray-900">Visi & Misi</h2>
        
        <!-- Visi -->
        <div class="bg-[#0b3323] text-white p-6 rounded-xl font-bold text-base md:text-lg mb-8 shadow-md">
            "<?php echo !empty($profil['visi']) ? htmlspecialchars($profil['visi']) : 'Visi desa belum diisi.'; ?>"
        </div>

        <!-- Misi -->
        <div class="bg-white p-6 rounded-xl border border-gray-100 shadow-sm text-left">
            <h3 class="font-bold text-sm text-gray-800 mb-3 flex items-center gap-2">
                <i class="fas fa-bullseye text-emerald-800"></i> Misi Desa
            </h3>
            <div class="text-xs text-gray-600 leading-relaxed whitespace-pre-line">
                <?php echo !empty($profil['misi']) ? htmlspecialchars($profil['misi']) : 'Misi desa belum diisi.'; ?>
            </div>
        </div>
    </section>

    <!-- GEOGRAFI & DEMOGRAFI -->
    <section>
        <h2 class="text-2xl font-bold text-center mb-8 text-gray-900">Geografi & Demografi</h2>
        <div class="grid md:grid-cols-2 gap-8 items-center">
            
            <!-- PETA INTERAKTIF GOOGLE MAPS -->
            <div class="bg-white p-2 rounded-xl border border-gray-100 shadow-sm overflow-hidden">
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31515.31885822295!2d124.9000000!3d-9.1000000!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2caf82bfab5d7fbd%3A0x5030bf7602711c0!2sTialai%2C%20Kec.%20Tasifeto%20Tim.%2C%20Kabupaten%20Belu%2C%20Nusa%20Tenggara%20Tim.!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                    class="w-full h-80 rounded-lg border-0" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

            <!-- STATISTIK DEMOGRAFI -->
            <div class="space-y-4">
                <div class="bg-[#0b3323] text-white p-6 rounded-xl text-center shadow-md">
                    <i class="fas fa-users text-2xl mb-1"></i>
                    <div class="text-3xl font-bold">
                        <?php echo number_format($profil['total_penduduk'] ?? 0, 0, ',', '.'); ?>
                    </div>
                    <div class="text-xs tracking-wider uppercase text-gray-300">Total Penduduk</div>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white p-4 rounded-xl border border-gray-100 text-center shadow-sm">
                        <div class="text-xl font-bold text-gray-800">
                            <?php echo number_format($profil['penduduk_pria'] ?? 0, 0, ',', '.'); ?>
                        </div>
                        <div class="text-xs text-gray-500">Laki-laki</div>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 text-center shadow-sm">
                        <div class="text-xl font-bold text-gray-800">
                            <?php echo number_format($profil['penduduk_wanita'] ?? 0, 0, ',', '.'); ?>
                        </div>
                        <div class="text-xs text-gray-500">Perempuan</div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</main>

<?php include 'components/footer.php'; ?>