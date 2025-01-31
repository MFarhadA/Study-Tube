<?php

// Memasukkan koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "study_tube";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Menangani kesalahan error login
$error_message = "";

// Mengecek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $name = $_POST['name'];
    $school = $_POST['school'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password-confirmation'];

    // Query untuk mengambil data pengguna berdasarkan email
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email); // Bind email ke query
    $stmt->execute();
    $result = $stmt->get_result();

    // Mengecek apakah user ditemukan
    if ($result->num_rows > 0) {
        header("Location: index.html?error=1");
        exit;
    }

    // Mengecek konfirmasi password
    if ($password != $password_confirmation) {
        header("Location: index.html?error=2");
        exit;
    }

    $sql = "INSERT INTO user (name, email, password, school, profile_photo, role)
            VALUES ('$name', '$email', '$password', '$school', '/Study-Tube/assets/foto_profil.png', '2')";

    

    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $sql2 = "INSERT INTO guru (userID, followers)
            VALUES ((SELECT userID FROM user WHERE email = '$email'), 0)";

    if ($conn->query($sql2) === FALSE) {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }

    header("Location: ../index.html");
    exit;
}
?>