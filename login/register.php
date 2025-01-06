<?php

session_start();
// Memasukkan koneksi database
include('/koneksi.php');

// Menangani kesalahan error login
$error_message = "";

// Mengecek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Mengambil data dari form
    $name = $_POST['name-2'];
    $school = $_POST['school-2'];
    $email_2 = $_POST['email-2'];
    $password = $_POST['password-2'];
    $password_confirmation = $_POST['password-confirmation-2'];

    // Query untuk mengambil data pengguna berdasarkan email
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email_2); // Bind email ke query
    $stmt->execute();
    $result = $stmt->get_result();

    // Mengecek apakah user ditemukan
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($email_2 == $row['email']) {
            header("Location: guru/register/index.html?error=1");
            exit;
        }
    }

    // Mengecek konfirmasi password
    if ($password != $password_confirmation) {
        header("Location: guru/register/index.html?error=2");
        exit;
    }

    $sql = "INSERT INTO user (name, email, password, role) 
            VALUES ('$name', '$email_2', '$password', '2')";

    if ($conn->query($sql) === TRUE) {
        echo "Pendaftaran berhasil!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
}
?>