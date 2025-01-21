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
            thumbnail,
            title,
            video,
            views,
            favorite
        FROM
            video
        WHERE
            teacherID = ?
        ";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $teacherID);
$stmt->execute();
$resultVideo = $stmt->get_result();

// Tutup koneksi
$stmt->close();
$conn->close();
?>