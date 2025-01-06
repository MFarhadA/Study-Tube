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

$user_id = $_SESSION['user_id'];

// Query untuk mengambil data
$sql = "
    SELECT 
        u.userID,
        u.name AS teacher_name,
        u.profile_photo AS teacher_profile_photo,
        g.teacherID
    FROM 
        siswa s
    JOIN 
        ikuti i ON s.studentID = i.studentID
    JOIN 
        guru g ON i.teacherID = g.teacherID
    JOIN 
        user u ON g.userID = u.userID
    WHERE 
        s.userID = ?
";

// Siapkan statement
$stmt = $conn->prepare($sql);

// Bind parameter dan eksekusi query
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$dataMengikuti = [];

if ($result->num_rows > 0) {
    // Ambil data ke dalam array
    while ($row = $result->fetch_assoc()) {
        $dataMengikuti[] = [
            "userID" => $row["userID"],
            "name" => $row["teacher_name"],
            "img" => $row["teacher_profile_photo"],
            "teacherID" => $row["teacherID"]
        ];
    }
}

// Mengirim data sebagai JSON
echo json_encode($dataMengikuti);

// Tutup koneksi
$conn->close();
?>