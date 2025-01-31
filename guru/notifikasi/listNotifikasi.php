<?php
include 'datateacherID.php';

// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "study_tube";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$resultnotifikasi = null;

// Ambil notifikasi berdasarkan teacherID
$sqlnotifikasi = "SELECT
                        u.profile_photo,
                        n.message,
                        n.upload_date
                    FROM notifikasi_siswa n
                    JOIN siswa s ON s.studentID = n.studentID
                    JOIN user u ON u.userID = s.userID
                    WHERE n.teacherID = ?
                    ORDER BY n.upload_date DESC;";

$stmt = $conn->prepare($sqlnotifikasi);
$stmt->bind_param("i", $teacherID);
$stmt->execute();
$resultnotifikasi = $stmt->get_result();

$stmt->close();

$conn->close();
?>