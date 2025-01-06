<?php
session_start();

// Koneksi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "study_tube";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    die("Anda harus login terlebih dahulu.");
}

$user_id = $_SESSION['user_id'];

// Cek apakah file diunggah
if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['profile_photo']['tmp_name'];
    $fileName = $_FILES['profile_photo']['name'];
    $fileSize = $_FILES['profile_photo']['size'];
    $fileType = $_FILES['profile_photo']['type'];
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);

    // Validasi ukuran file (maksimal 4MB) dan tipe file (hanya gambar)
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
        header("Location: /Study-Tube/guru/edit_profil/index.php?error=2");
        exit;
    }

    if ($fileSize > 4 * 1024 * 1024) {
        header("Location: /Study-Tube/guru/edit_profil/index.php?error=3");
        exit;
    }

    // Lokasi folder penyimpanan
    $uploadFolder = '../../db/profile_photo/';
    if (!is_dir($uploadFolder)) {
        mkdir($uploadFolder, 0777, true);
    }

    // Nama file unik untuk menghindari konflik
    $newFileName = uniqid() . '.' . $fileExtension;
    $destination = $uploadFolder . $newFileName;

    // Hapus file lama dari database (jika ada)
    $query = "SELECT profile_photo FROM user WHERE userID = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $stmt->bind_result($oldFilePath);
        $stmt->fetch();
        $stmt->close();

        if ($oldFilePath && file_exists($_SERVER['DOCUMENT_ROOT'] . $oldFilePath)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $oldFilePath);
        }
    }

    // Pindahkan file baru
    if (move_uploaded_file($fileTmpPath, $destination)) {
        // Simpan path file ke database
        $profilePhotoPath = '/Study-Tube/db/profile_photo/' . $newFileName;

        $sql = "UPDATE user SET profile_photo = ? WHERE userID = ?";
        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("si", $profilePhotoPath, $user_id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header("Location: /Study-Tube/guru/edit_profil/index.php");
                exit;
            } else {
                echo "Gagal memperbarui foto profil.";
            }

            $stmt->close();
        } else {
            die("Query gagal: " . $conn->error);
        }
    } else {
        die("Terjadi kesalahan saat mengunggah file.");
    }
} else {
    die("Tidak ada file yang diunggah.");
}

$conn->close();
?>
