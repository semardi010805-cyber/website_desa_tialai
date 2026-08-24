<?php include 'components/header.php'; ?>

<!-- HEADER HALAMAN -->
<div class="bg-gray-100 py-12 text-center border-b border-gray-200 px-4">
    <h1 class="text-3xl font-bold text-gray-900 mb-2">Potensi Desa Tialai</h1>
    <p class="text-xs text-gray-500 max-w-lg mx-auto">Sektor komoditas unggulan dan kekayaan budaya yang menggerakkan perekonomian desa.</p>
</div>

<main class="max-w-6xl mx-auto px-4 py-12">
    <div class="grid md:grid-cols-2 gap-8">
        
        <!-- Potensi 1: Perkebunan Sayur -->
        <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm flex flex-col">
            <div class="relative">
                <img src="assets/images/kebun.jpeg" class="h-56 w-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1592417817098-8f3d6eb1b7a5?q=80&w=600'">
                <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-xs px-3 py-1 rounded-full font-medium text-emerald-900">
                    <i class="fas fa-tractor mr-1"></i> Pertanian
                </span>
            </div>
            <div class="p-6 flex flex-col justify-between flex-grow">
                <div>
                    <h3 class="text-lg font-bold mb-2 text-gray-900">Perkebunan Sayur</h3>
                    <p class="text-xs text-gray-500 leading-relaxed mb-6">Sektor pertanian menjadi penghasil utama di Desa Tialai, dengan sayuran dan tanaman pangan lainnya yang dikelola secara optimal oleh masyarakat setempat.</p>
                </div>
                <button type="button" onclick="openModal('modalSayur')" class="text-xs font-semibold text-emerald-800 hover:underline text-left w-fit cursor-pointer flex items-center gap-1">
                    Pelajari Selengkapnya &rarr;
                </button>
            </div>
        </div>

        <!-- Potensi 2: Peternakan Sapi -->
        <div class="bg-white rounded-2xl overflow-hidden border border-gray-200 shadow-sm flex flex-col">
            <div class="relative">
                <img src="assets/images/sapi.jpg" class="h-56 w-full object-cover">
                <span class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm text-xs px-3 py-1 rounded-full font-medium text-emerald-900">
                    <i class="fas fa-paw mr-1"></i> Peternakan
                </span>
            </div>
            <div class="p-6 flex flex-col justify-between flex-grow">
                <div>
                    <h3 class="text-lg font-bold mb-2 text-gray-900">Peternakan Sapi</h3>
                    <p class="text-xs text-gray-500 leading-relaxed mb-6">Masyarakat desa memanfaatkan lahan padang rumput yang luas untuk budidaya peternakan sapi, menghasilkan sapi berkualitas tinggi.</p>
                </div>
                <button type="button" onclick="openModal('modalSapi')" class="text-xs font-semibold text-emerald-800 hover:underline text-left w-fit cursor-pointer flex items-center gap-1">
                    Pelajari Selengkapnya &rarr;
                </button>
            </div>
        </div>

    </div>
</main>

<!-- MODAL DETAIL 1: PERKEBUNAN SAYUR -->
<div id="modalSayur" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[9999] hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl relative text-gray-800">
        <button type="button" onclick="closeModal('modalSayur')" class="absolute top-3 right-3 bg-white/80 hover:bg-white text-gray-700 rounded-full w-8 h-8 flex items-center justify-center shadow z-10">
            <i class="fas fa-times"></i>
        </button>
        <img src="assets/images/kebun.jpeg" class="h-48 w-full object-cover" onerror="this.src='https://images.unsplash.com/photo-1592417817098-8f3d6eb1b7a5?q=80&w=600'">
        <div class="p-6 space-y-3">
            <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2.5 py-1 rounded-full">
                <i class="fas fa-tractor mr-1"></i> Pertanian & Perkebunan
            </span>
            <h3 class="font-bold text-lg text-gray-900">Detail Perkebunan Sayur Desa Tialai</h3>
            <p class="text-xs text-gray-600 leading-relaxed">
                Komoditas utama hasil perkebunan Desa Tialai meliputi sawi, tomat, cabai, dan terung. Komoditas ini tidak hanya memenuhi kebutuhan pangan konsumsi lokal warga, tetapi juga dipasarkan ke pasar-pasar tradisional di kawasan Kabupaten Belu.
            </p>
            <p class="text-xs text-gray-600 leading-relaxed">
                Pengelolaan lahan perkebunan dibina melalui kelompok tani lokal yang menerapkan sistem pengairan berkelanjutan.
            </p>
        </div>
    </div>
</div>

<!-- MODAL DETAIL 2: PETERNAKAN SAPI -->
<div id="modalSapi" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-[9999] hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl max-w-lg w-full overflow-hidden shadow-2xl relative text-gray-800">
        <button type="button" onclick="closeModal('modalSapi')" class="absolute top-3 right-3 bg-white/80 hover:bg-white text-gray-700 rounded-full w-8 h-8 flex items-center justify-center shadow z-10">
            <i class="fas fa-times"></i>
        </button>
        <img src="assets/images/sapi.jpg" class="h-48 w-full object-cover">
        <div class="p-6 space-y-3">
            <span class="bg-emerald-100 text-emerald-800 text-[10px] font-bold px-2.5 py-1 rounded-full">
                <i class="fas fa-paw mr-1"></i> Peternakan
            </span>
            <h3 class="font-bold text-lg text-gray-900">Detail Peternakan Sapi Desa Tialai</h3>
            <p class="text-xs text-gray-600 leading-relaxed">
                Peternakan Sapi Timor merupakan salah satu tulang punggung perekonomian warga Desa Tialai. Dukungan padang penggembalaan yang alami membuat kualitas hewan ternak tumbuh secara optimal.
            </p>
            <p class="text-xs text-gray-600 leading-relaxed">
                Sapi hasil peternakan warga secara rutin dipasok untuk kebutuhan hewan ternak dan perdagangan antarwilayah di NTT.
            </p>
        </div>
    </div>
</div>

<!-- SCRIPT PENGATUR MODAL -->
<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>

<?php include 'components/footer.php'; ?>