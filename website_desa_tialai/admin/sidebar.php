<?php
// Mendapatkan nama file saat ini untuk penanda menu aktif
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="relative z-50 w-64 bg-[#0b3323] text-white min-h-screen flex flex-col justify-between shadow-lg shrink-0">
    <div>
        <!-- BRAND LOGO -->
        <div class="p-6 border-b border-emerald-900/50 flex items-center gap-3">
            <i class="fas fa-chart-line text-2xl text-emerald-400"></i>
            <div>
                <h1 class="font-bold text-sm leading-tight">Admin Desa Tialai</h1>
                <p class="text-[10px] text-emerald-300">Panel Kontrol Sistem</p>
            </div>
        </div>

        <!-- NAVIGASI SIDEBAR -->
        <nav class="p-4 space-y-1 text-xs">
            <a href="index.php" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition <?php echo ($current_page == 'index.php') ? 'bg-emerald-800 text-white font-semibold' : 'text-emerald-100 hover:bg-emerald-800/50'; ?>">
                <i class="fas fa-envelope w-5 text-center"></i>
                <span>Permohonan Surat</span>
            </a>

            <a href="bansos.php" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition <?php echo ($current_page == 'bansos.php') ? 'bg-emerald-800 text-white font-semibold' : 'text-emerald-100 hover:bg-emerald-800/50'; ?>">
                <i class="fas fa-hand-holding-heart w-5 text-center"></i>
                <span>Kelola Bansos</span>
            </a>

            <a href="pengaduan.php" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition <?php echo ($current_page == 'pengaduan.php') ? 'bg-emerald-800 text-white font-semibold' : 'text-emerald-100 hover:bg-emerald-800/50'; ?>">
                <i class="fas fa-bullhorn w-5 text-center"></i>
                <span>Kelola Pengaduan</span>
            </a>

            <a href="berita.php" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition <?php echo ($current_page == 'berita.php') ? 'bg-emerald-800 text-white font-semibold' : 'text-emerald-100 hover:bg-emerald-800/50'; ?>">
                <i class="fas fa-newspaper w-5 text-center"></i>
                <span>Kelola Berita</span>
            </a>

            <a href="potensi.php" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition <?php echo ($current_page == 'potensi.php') ? 'bg-emerald-800 text-white font-semibold' : 'text-emerald-100 hover:bg-emerald-800/50'; ?>">
                <i class="fas fa-seedling w-5 text-center"></i>
                <span>Kelola Potensi Desa</span>
            </a>

            <a href="perangkat.php" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition <?php echo ($current_page == 'perangkat.php') ? 'bg-emerald-800 text-white font-semibold' : 'text-emerald-100 hover:bg-emerald-800/50'; ?>">
                <i class="fas fa-users-cog w-5 text-center"></i>
                <span>Kelola Perangkat</span>
            </a>

            <!-- Menu Kelola Profil Desa -->
            <a href="profil_desa.php" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition <?php echo ($current_page == 'profil_desa.php') ? 'bg-emerald-800 text-white font-semibold' : 'text-emerald-100 hover:bg-emerald-800/50'; ?>">
                <i class="fas fa-id-card w-5 text-center"></i>
                <span>Kelola Profil Desa</span>
            </a>

            <!-- Menu Kelola Wilayah Dusun & RW -->
            <a href="dusun.php" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium transition <?php echo ($current_page == 'dusun.php') ? 'bg-emerald-800 text-white font-semibold' : 'text-emerald-100 hover:bg-emerald-800/50'; ?>">
                <i class="fas fa-building w-5 text-center"></i>
                <span>Wilayah Dusun & RW</span>
            </a>
        </nav>
    </div>

    <!-- USER INFO & LOGOUT -->
    <div class="p-4 border-t border-emerald-900/50">
        <div class="mb-3 px-2 flex items-center gap-2">
            <div class="w-8 h-8 rounded-full bg-emerald-700 flex items-center justify-center font-bold text-xs">A</div>
            <div>
                <p class="text-xs font-semibold"><?php echo htmlspecialchars($_SESSION['admin_nama'] ?? 'Administrator'); ?></p>
                <p class="text-[10px] text-emerald-300">Online</p>
            </div>
        </div>
        <a href="logout.php" class="flex items-center justify-center gap-2 w-full py-2 bg-red-600 hover:bg-red-700 text-white text-xs rounded-lg font-semibold transition">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
</aside>