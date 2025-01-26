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

// Ambil semua teacherID yang diikuti oleh studentID
$sqlvideoID = "SELECT videoID FROM video WHERE teacherID = ?";
$stmt = $conn->prepare($sqlvideoID);
$stmt->bind_param("i", $teacherID);
$stmt->execute();
$resultvideoID = $stmt->get_result();

$videoIDs = [];
while ($row = $resultvideoID->fetch_assoc()) {
    $videoIDs[] = $row['videoID']; // Simpan videoID dalam array
}
$stmt->close();

$resultnotifikasi = null;

if (!empty($videoIDs)) {
    // Buat string untuk klausa IN dalam query SQL
    $placeholders = implode(',', array_fill(0, count($videoIDs), '?'));

    // Ambil notifikasi berdasarkan teacherID
    $sqlnotifikasi = "SELECT
                    u.profile_photo,
                    n.message,
                    n.upload_date
                      FROM notifikasi_siswa n
                      JOIN siswa s ON s.studentID = n.studentID
                      JOIN user u ON u.userID = s.userID
                      WHERE n.studentID IN ($placeholders)
                      ORDER BY upload_date DESC";
    
    $stmt = $conn->prepare($sqlnotifikasi);
    // Bind parameter secara dinamis
    $stmt->bind_param(str_repeat('i', count($videoIDs)), ...$videoIDs);
    $stmt->execute();
    $resultnotifikasi = $stmt->get_result();

    $stmt->close();
}

$conn->close();
?>