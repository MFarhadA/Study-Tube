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

$sql = "SELECT 
            u.name AS pengikut_nama_murid,
            u.profile_photo AS pengikut_foto_profil_murid
        FROM
            user u
        JOIN 
            siswa s ON u.userID = s.userID
        JOIN 
            ikuti i ON s.studentID = i.studentID
        WHERE 
            i.teacherID = ?
        ";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $teacherID);
$stmt->execute();
$resultPengikut = $stmt->get_result();

// Tutup koneksi
$stmt->close();
$conn->close();
?>