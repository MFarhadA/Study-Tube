<?php

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
            views
        FROM
            video
        WHERE
            videoID = ?
        ";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $videoID);
$stmt->execute();
$dataVideo = $stmt->get_result();

// Tutup koneksi
$stmt->close();
$conn->close();
?>