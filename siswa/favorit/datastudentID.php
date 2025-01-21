<?php

session_start();

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "study_tube";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$userID = $_SESSION['user_id'];
$sqlstudentID = "SELECT studentID FROM siswa JOIN user ON siswa.userID = user.userID WHERE user.userID = ?";
$stmtstudentID = $conn->prepare($sqlstudentID);
$stmtstudentID->bind_param("i", $userID);
$stmtstudentID->execute();
$resultstudentID = $stmtstudentID->get_result();

// Pastikan hasil query ada
if ($row = $resultstudentID->fetch_assoc()) {
    $studentID = $row['studentID'];  // Menyimpan studentID ke dalam variabel
} else {
    echo "Student ID tidak ditemukan.";
}

// Tutup
$stmtstudentID->close();
$conn->close();

session_write_close();

?>