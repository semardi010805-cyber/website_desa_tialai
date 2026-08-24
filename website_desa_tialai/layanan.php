<?php include 'components/header.php'; ?>

<div class="max-w-3xl mx-auto px-4 py-12">
    <div class="bg-white p-8 rounded-2xl border border-gray-200 shadow-sm">
        <h1 class="text-2xl font-bold text-gray-900 mb-2">Form Permohonan Surat Online</h1>
        <p class="text-xs text-gray-500 mb-6">Isi data diri dengan benar untuk memproses dokumen administrasi Anda.</p>

        <form action="proses-layanan.php" method="POST" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Nama Lengkap</label>
                <input type="text" name="nama" required class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#0b3323] outline-none">
            </div>
            
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">NIK</label>
                    <input type="text" name="nik" maxlength="16" required class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#0b3323] outline-none">
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-700 mb-1">No. WhatsApp</label>
                    <input type="text" name="no_hp" required class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#0b3323] outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Jenis Surat</label>
                <select name="jenis_surat" class="w-full px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-[#0b3323] outline-none">
                    <option value="Surat Keterangan Domisili">Surat Keterangan Domisili</option>
                    <option value="Surat Keterangan Usaha">Surat Keterangan Usaha</option>
                    <option value="Surat Keterangan Tidak Mampu">Surat Keterangan Tidak Mampu (SKTM)</option>
                    <option value="Pengantar KTP/KK">Pengantar KTP / KK</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-700 mb-1">Upload Foto KTP/KK (PDF/JPG)</label>
                <input type="file" name="berkas" required class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200">
            </div>

            <button type="submit" class="w-full bg-[#0b3323] text-white py-2.5 rounded-lg text-xs font-semibold hover:bg-[#144733] transition">Kirim Permohonan</button>
        </form>
    </div>
</div>

<?php include 'components/footer.php'; ?>