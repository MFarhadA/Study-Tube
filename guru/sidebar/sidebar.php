<?php

session_start();

// Pastikan koneksi database sudah dibuka sebelumnya
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "study_tube";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data pengguna berdasarkan `user_id` dari sesi
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT name, profile_photo FROM user WHERE userID = ?";
    $stmt = $conn->prepare($sql);
    
    // Pastikan statement berhasil disiapkan
    if ($stmt === false) {
        die('Query preparation failed: ' . $conn->error);
    }

    // Bind parameter dan eksekusi query
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    // Periksa hasil query
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $name = htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8');
        $profile_photo = htmlspecialchars($user['profile_photo'], ENT_QUOTES, 'UTF-8');
    } else {
        $name = "Guest"; // Jika data tidak ditemukan
        $profile_photo = "../assets/default_profile.jpg"; // Foto default jika tidak ditemukan
    }

    // Tutup koneksi
    $conn->close();
    } else {
        header("Location: /Study-Tube/login/login.html");
        exit();
    }

// Kirim data sebagai JSON
echo json_encode([
    'name' => $name,
    'profile_photo' => $profile_photo
]);

?>