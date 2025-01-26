<?php
session_start();

// Koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "study_tube";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data dari form
$nama = $_POST['nama'];
$nama_sekolah = $_POST['nama_sekolah'];
$email = $_POST['email'];
$password = $_POST['password'];
$user_id = $_SESSION['user_id'];

// Validasi password (opsional)
if ($_POST['password'] !== $_POST['password_confirmation']) {
    header("Location: /Study-Tube/guru/edit_profil/index.php?error=1");
    exit;
}

// Update tabel user
$sql_user_update = "UPDATE user 
                    SET name = ?, email = ?, school = ?, password = ?
                    WHERE userID = ?";

$stmt_user = $conn->prepare($sql_user_update);

if ($stmt_user) {
    $stmt_user->bind_param("ssssi", $nama, $email, $nama_sekolah, $password, $user_id);
    $stmt_user->execute();
    $stmt_user->close();
} else {
    die("Query update user gagal: " . $conn->error);
}

header("Location: /Study-Tube/guru/edit_profil/index.php");
exit;

$conn->close();
?>