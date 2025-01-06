<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "study_tube";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Query untuk mengambil data
$sql = "
        SELECT
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
    ";

// Eksekusi query
$result = $conn->query($sql);

$videoData = [];

if ($result->num_rows > 0) {
    // Ambil data ke dalam array
    while ($row = $result->fetch_assoc()) {
        $videoData[] = [
            "video_id" => $row["video_id"],
            "title" => $row["title"],
            "thumbnail" => $row["thumbnail"], // Thumbnail di-encode ke base64
            "video" => $row["video"], // Video di-encode ke base64
            "views" => $row["views"],
            "teacher_name" => $row["teacher_name"],
            "teacher_profile_photo" => $row["teacher_profile_photo"]
        ];
    }
}

// Mengirim data sebagai JSON
echo json_encode($videoData);

// Tutup koneksi
$conn->close();
?>