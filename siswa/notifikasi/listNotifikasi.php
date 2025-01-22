<?php
include 'datastudentID.php';

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
$sqlikuti = "SELECT teacherID FROM ikuti WHERE studentID = ?";
$stmt = $conn->prepare($sqlikuti);
$stmt->bind_param("i", $studentID);
$stmt->execute();
$resultikuti = $stmt->get_result();

$teacherIDs = [];
while ($row = $resultikuti->fetch_assoc()) {
    $teacherIDs[] = $row['teacherID']; // Simpan teacherID dalam array
}
$stmt->close();

if (!empty($teacherIDs)) {
    // Buat string untuk klausa IN dalam query SQL
    $placeholders = implode(',', array_fill(0, count($teacherIDs), '?'));

    // Ambil notifikasi berdasarkan teacherID
    $sqlnotifikasi = "SELECT
                    u.profile_photo,
                    n.message,
                    n.upload_date
                      FROM notifikasi_guru n
                      JOIN guru g ON g.teacherID = n.teacherID
                      JOIN user u ON u.userID = g.userID
                      WHERE n.teacherID IN ($placeholders)
                      ORDER BY upload_date DESC";
    
    $stmt = $conn->prepare($sqlnotifikasi);
    // Bind parameter secara dinamis
    $stmt->bind_param(str_repeat('i', count($teacherIDs)), ...$teacherIDs);
    $stmt->execute();
    $resultnotifikasi = $stmt->get_result();

    $stmt->close();
} else {
    echo "Tidak ada notifikasi yang tersedia.";
}

$conn->close();
?>