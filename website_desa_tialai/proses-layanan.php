<?php
require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama        = input($_POST['nama']);
    $nik         = input($_POST['nik']);
    $no_hp       = input($_POST['no_hp']);
    $jenis_surat = input($_POST['jenis_surat']);

    // Handling File Upload
    $berkas_nama = NULL;
    if (isset($_FILES['berkas']) && $_FILES['berkas']['error'] == 0) {
        $allowed = array('jpg', 'jpeg', 'png', 'pdf');
        $filename = $_FILES['berkas']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($ext, $allowed)) {
            // Rename file agar unik: nik_timestamp.ext
            $berkas_nama = $nik . '_' . time() . '.' . $ext;
            $target_dir = "assets/uploads/";

            // Buat folder uploads jika belum ada
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            move_uploaded_file($_FILES['berkas']['tmp_name'], $target_dir . $berkas_nama);
        }
    }

    // Insert ke Database
    $query = "INSERT INTO pengajuan_surat (nik, nama, no_hp, jenis_surat, berkas, status) 
              VALUES ('$nik', '$nama', '$no_hp', '$jenis_surat', '$berkas_nama', 'Pending')";

    if (mysqli_query($conn, $query)) {
        echo "<script>
                alert('Permohonan surat berhasil dikirim! Petugas desa akan menghubungi Anda melalui WhatsApp.');
                window.location.href='index.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal mengirim permohonan. Silakan coba lagi.');
                window.location.href='layanan.php';
              </script>";
    }
} else {
    header("Location: layanan.php");
    exit();
}
?>