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

if (count($videoIDs) > 0) {
    // Query untuk mendapatkan detail video berdasarkan videoID
    $placeholders = implode(',', array_fill(0, count($videoIDs), '?')); // Placeholder untuk IN clause
    $sql = "SELECT
                v.videoID AS video_id,
                v.title, 
                v.thumbnail, 
                v.video, 
                v.views, 
                u.name AS teacher_name, 
                u.profile_photo AS teacher_profile_photo
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

    // Siapkan data dalam format array asosiatif
    while ($row = $resultFavorit->fetch_assoc()) {
        $output[] = [
            "video_id" => $row['video_id'],
            "title" => $row['title'],
            "thumbnail" => $row['thumbnail'],
            "video" => $row['video'],
            "views" => $row['views'],
            "teacher_name" => $row['teacher_name'],
            "teacher_profile_photo" => $row['teacher_profile_photo']
        ];
    }
    $stmt->close();
} else {
    $output['error'] = "Tidak ada video favorit untuk studentID ini.";
}

$conn->close();

// Tampilkan data dalam format JSON
header('Content-Type: application/json');
echo json_encode($output, JSON_PRETTY_PRINT);
?>
