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

$user_id = $_SESSION['user_id'];

$sql = "SELECT u.name AS nama_guru, u.email, u.profile_photo, us.name AS nama_sekolah, u.password
        FROM user u
        JOIN guru g ON u.userID = g.userID
        JOIN sekolah s ON g.schoolID = s.schoolID
        JOIN user us ON s.userID = us.userID
        WHERE u.userID = ?";

$stmt = $conn->prepare($sql);

// Bind parameter dan eksekusi query
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();; 

$nama_guru = '';
$email = '';
$profile_photo = '';
$nama_sekolah = '';
$password = '';

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $nama_guru = $user['nama_guru'];
    $email = $user['email'];
    $profile_photo = $user['profile_photo'];
    $nama_sekolah = $user['nama_sekolah'];
    $password = $user['password'];
}

$dataProfil = [
    'nama' => $nama_guru,
    'email' => $email,
    'profile_photo' => $profile_photo,
    'nama_sekolah' => $nama_sekolah,
    'password' => $password
];

$conn->close();
?>