<?php
// Aktifkan laporan error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'datateacherID.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['upload'])) {
    // Debug POST dan FILES
    echo "<pre>";
    print_r($_POST);
    print_r($_FILES);
    echo "</pre>";

    // Koneksi ke Database
    $conn = new mysqli('localhost', 'root', '', 'study_tube');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Ambil data dari form
    $judul = $conn->real_escape_string($_POST['judul']);
    $uploadDate = date('Y-m-d H:i:s');
    $views = 0;

    // Direktori Upload (Relatif)
    $videoDir = '/Study-Tube/db/video/';
    $thumbnailDir = '/Study-Tube/db/thumbnail/';
    $moduleDir = '/Study-Tube/db/module/';

    // Buat folder jika belum ada
    if (!is_dir($_SERVER['DOCUMENT_ROOT'] . $videoDir)) mkdir($_SERVER['DOCUMENT_ROOT'] . $videoDir, 0777, true);
    if (!is_dir($_SERVER['DOCUMENT_ROOT'] . $thumbnailDir)) mkdir($_SERVER['DOCUMENT_ROOT'] . $thumbnailDir, 0777, true);
    if (!is_dir($_SERVER['DOCUMENT_ROOT'] . $moduleDir)) mkdir($_SERVER['DOCUMENT_ROOT'] . $moduleDir, 0777, true);

    $videoPath = '';
    $thumbnailPath = '';
    $modulePath = '';

    // Upload Video
    if (isset($_FILES['video_file']) && $_FILES['video_file']['error'] === UPLOAD_ERR_OK) {
        $allowedVideoTypes = ['video/mp4', 'video/avi', 'video/mov', 'video/mkv'];
        if (in_array($_FILES['video_file']['type'], $allowedVideoTypes) && $_FILES['video_file']['size'] <= 209715200) { // Max 200MB
            $videoName = basename($_FILES['video_file']['name']);
            $videoPath = $videoDir . 'video_' . time() . '_' . $videoName;
            move_uploaded_file($_FILES['video_file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $videoPath);
        } else {
            die("Video tidak valid. Pastikan formatnya MP4, AVI, MOV, atau MKV dengan ukuran maksimal 200MB.");
        }
    }

    // Upload Thumbnail
    if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
        $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['profile_photo']['type'], $allowedImageTypes) && $_FILES['profile_photo']['size'] <= 4194304 ) { // Max 4MB
            $thumbnailName = basename($_FILES['profile_photo']['name']);
            $thumbnailPath = $thumbnailDir . 'thumbnail_' . time() . '_' . $thumbnailName;
            move_uploaded_file($_FILES['profile_photo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $thumbnailPath);
        } else {
            die("Thumbnail tidak valid. Pastikan formatnya JPEG, PNG, atau GIF dengan ukuran maksimal 4MB.");
        }
    }

    // Insert ke Tabel Video
    $sqlVideo = "INSERT INTO video (teacherID, video, thumbnail, title, views, upload_date, favorite)
                 VALUES ('$teacherID', '$videoPath', '$thumbnailPath', '$judul', '$views', '$uploadDate', 0)";
    if ($conn->query($sqlVideo) === TRUE) {
        $videoID = $conn->insert_id;

        // Upload Modul (opsional)
        if (isset($_FILES['module_file']) && $_FILES['module_file']['error'] === UPLOAD_ERR_OK) {
            $allowedModuleTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'];
            if (in_array($_FILES['module_file']['type'], $allowedModuleTypes) && $_FILES['module_file']['size'] <= 4194304 ) { // Max 4MB
                $moduleName = basename($_FILES['module_file']['name']);
                $modulePath = $moduleDir . 'module_' . time() . '_' . $moduleName;
                $moduleTitle = pathinfo($moduleName, PATHINFO_FILENAME);
                move_uploaded_file($_FILES['module_file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $modulePath);

                // Insert ke Tabel Modul
                $sqlModul = "INSERT INTO modul (teacherID, videoID, title, download, modul)
                             VALUES ('$teacherID', '$videoID', '$moduleTitle', 0, '$modulePath')";
                $conn->query($sqlModul);
            } else {
                die("Thumbnail tidak valid. Pastikan formatnya JPEG, PNG, atau GIF dengan ukuran maksimal 4MB.");
            }
        }

        // Redirect setelah berhasil
        header("Location: /Study-Tube/guru/konten/index.php");
        exit;
    } else {
        die("Error: " . $sqlVideo . "<br>" . $conn->error);
    }

    $conn->close();
} else {
    die("Request tidak valid.");
}
?>