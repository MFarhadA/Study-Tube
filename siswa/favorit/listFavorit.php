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

// Query untuk mendapatkan semua videoID favorit
$sqlvideoID = "SELECT videoID FROM favorit WHERE studentID = ?";
$stmt = $conn->prepare($sqlvideoID);
$stmt->bind_param("i", $studentID);
$stmt->execute();
$resultvideoID = $stmt->get_result();

$videoIDs = [];
while ($row = $resultvideoID->fetch_assoc()) {
    $videoIDs[] = $row['videoID']; // Simpan videoID dalam array
}
$stmt->close();

$resultFavorit = [];

if (count($videoIDs) > 0) {

    // Query untuk mendapatkan detail video berdasarkan videoID
    $placeholders = implode(',', array_fill(0, count($videoIDs), '?')); // Placeholder untuk IN clause
    $sql = "SELECT
                v.videoID AS video_id,
                v.title AS video_title, 
                v.thumbnail AS video_thumbnail, 
                v.video AS video_path, 
                v.views as video_views, 
                u.name AS guru_name, 
                u.profile_photo AS guru_photo
            FROM 
                video v
            JOIN 
                guru g ON v.teacherID = g.teacherID
            JOIN
                user u ON g.userID = u.userID
            WHERE
                v.videoID IN ($placeholders)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param(str_repeat('i', count($videoIDs)), ...$videoIDs);
    $stmt->execute();
    $resultFavorit = $stmt->get_result();

    $stmt->close();
} else {
    $output['error'] = "Tidak ada video favorit untuk studentID ini.";
}

$conn->close();
?>