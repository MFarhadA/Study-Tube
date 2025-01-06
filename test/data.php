<?php

header("Access-Control-Allow-Origin: *");  // Mengizinkan akses dari semua sumber

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
$sql = "SELECT email, profile_photo, password FROM user";
$result = $conn->query($sql);

$data = [];

if ($result->num_rows > 0) {
    // Ambil data ke dalam array
    while ($row = $result->fetch_assoc()) {
        $data[] = [
            "name" => $row["email"],
            "img" => $row["profile_photo"],
            "link" => $row["password"]
        ];
    }
}

// Mengirim data sebagai JSON
header('Content-Type: application/json');
echo json_encode($data);

// Tutup koneksi
$conn->close();
?>
