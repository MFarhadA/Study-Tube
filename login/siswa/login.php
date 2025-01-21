<?php

session_start();
// Memasukkan koneksi database
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

// Query untuk mengambil data
$sql = "SELECT name, profile_photo FROM user WHERE role = 1";
$result = $conn->query($sql);

// Menangani kesalahan error login
$error_message = "";
// Mengecek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Query untuk mengambil data pengguna berdasarkan email
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // Bind email ke query
    $stmt->execute();
    $result = $stmt->get_result();

    // Mengecek apakah user ditemukan dan memverifikasi password
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['role'] != 1) {
            header("Location: index.html?error=2");
            exit;
        }
        if ($password != $row['password']) {
            header("Location: index.html?error=3");
            exit;
        }
        
        $_SESSION['user_id'] = $row['userID'];
        $_SESSION['role'] = $row['role'];
        header("Location: ../../siswa/index.php");
        exit;

    } else {
        header("Location: index.html?error=1");
        exit;
    }
}

$conn->close();
?>