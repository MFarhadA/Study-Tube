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
            u.name AS rating_nama_murid,
            u.profile_photo AS rating_foto_profil_murid,
            r.rating_score AS skor_rating
        FROM
            user u
        JOIN 
            siswa s ON u.userID = s.userID
        JOIN 
            rating r ON s.studentID = r.studentID
        WHERE
            r.teacherID = ?
        ";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $teacherID);
$stmt->execute();
$resultRating = $stmt->get_result();

// Tutup koneksi
$stmt->close();
$conn->close();
?>