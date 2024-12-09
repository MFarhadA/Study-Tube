<?php

session_start();
// Memasukkan koneksi database
include('../koneksi.php');

echo '<pre>';
print_r($_SESSION);  // Ini akan menampilkan semua data dalam session
echo '</pre>';

// Menangani kesalahan error login
$error_message = "";
// Mengecek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $email_2 = $_POST['email-2'];
    $email_3 = $_POST['email-3'];
    $password = $_POST['password-2'];

    // Query untuk mengambil data pengguna berdasarkan email
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_2); // Bind email ke query
    $stmt->execute();
    $result = $stmt->get_result();

    $_SESSION['email_2'] = $email_2;

    // Mengecek apakah user ditemukan dan memverifikasi password
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verifikasi password (gunakan password_verify jika password di-hash)
        if ($row['role'] == 2 && $email_2 == $row['email']) {
            if ($password == $row['password']) {
                header("Location: ../guru/index.html");
                exit;
            } else {
                header("Location: guru/index.html?error=1");
                exit;
            }
        } else {
            header("Location: guru/index.html?error=2");
            exit;
        }

        if ($row['role'] == 3 && $email_3 == $row['email']) {
            if ($password == $row['password']) {
                header("Location: ../sekolah/index.html");
                exit;
            } else {
                header("Location: sekolah/index.html?error=1");
                exit;
            }
        } else {
            header("Location: sekolah/index.html?error=2");
            exit;
        }
        
    }
}
?>