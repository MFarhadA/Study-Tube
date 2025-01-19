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
$sqlteacherID = "SELECT teacherID FROM guru JOIN user ON guru.userID = user.userID WHERE user.userID = ?";
$stmtteacherID = $conn->prepare($sqlteacherID);
$stmtteacherID->bind_param("i", $userID);
$stmtteacherID->execute();
$resultteacherID = $stmtteacherID->get_result();

// Pastikan hasil query ada
if ($row = $resultteacherID->fetch_assoc()) {
    $teacherID = $row['teacherID'];  // Menyimpan studentID ke dalam variabel
} else {
    echo "Student ID tidak ditemukan.";
}

// Tutup
$stmtteacherID->close();
$conn->close();

session_write_close();

?>