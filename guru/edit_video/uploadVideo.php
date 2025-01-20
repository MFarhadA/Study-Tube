<?php
// Aktifkan laporan error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['videoID'])) {
    $videoID = $_POST['videoID'];
    // Gunakan $videoID untuk update atau hapus
} else {
    echo "Video ID tidak ditemukan.";
}

if (isset($_POST['moduleID'])) {
    $moduleID = $_POST['moduleID'];
    // Gunakan $videoID untuk update atau hapus
} else {
    echo "Module ID tidak ditemukan.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

    // Cek apakah tombol "edit" yang diklik
    if (isset($_POST['edit'])) {
        // Ambil data dari form
        $judul = $conn->real_escape_string($_POST['judul']);
        $videoID = $_POST['videoID'];  // videoID yang akan diupdate
        $uploadDate = date('Y-m-d H:i:s');

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

        // Cek dan hapus video lama, jika ada
        $oldVideoQuery = "SELECT video FROM video WHERE videoID = '$videoID'";
        $result = $conn->query($oldVideoQuery);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $oldVideoPath = $_SERVER['DOCUMENT_ROOT'] . $row['video'];
            if (file_exists($oldVideoPath)) {
                unlink($oldVideoPath); // Menghapus file video lama
            }
        }

        // Upload Video (jika ada perubahan)
        if (isset($_FILES['video_file']) && $_FILES['video_file']['error'] === UPLOAD_ERR_OK) {
            $allowedVideoTypes = ['video/mp4', 'video/avi', 'video/mov', 'video/mkv'];
            if (in_array($_FILES['video_file']['type'], $allowedVideoTypes) && $_FILES['video_file']['size'] <= 209715200) { // Max 200MB
                $videoName = basename($_FILES['video_file']['name']);
                $videoPath = $videoDir . 'video_' . time() . '_' . $videoName;
                move_uploaded_file($_FILES['video_file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $videoPath);
            } else {
                die("Video tidak valid. Pastikan formatnya MP4, AVI, MOV, atau MKV dengan ukuran maksimal 10MB.");
            }
        }

        // Cek dan hapus thumbnail lama, jika ada
        $oldThumbnailQuery = "SELECT thumbnail FROM video WHERE videoID = '$videoID'";
        $result = $conn->query($oldThumbnailQuery);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $oldThumbnailPath = $_SERVER['DOCUMENT_ROOT'] . $row['thumbnail'];
            if (file_exists($oldThumbnailPath)) {
                unlink($oldThumbnailPath); // Menghapus file thumbnail lama
            }
        }

        // Upload Thumbnail (jika ada perubahan)
        if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
            $allowedImageTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($_FILES['profile_photo']['type'], $allowedImageTypes) && $_FILES['profile_photo']['size'] <= 4194304) { // Max 4MB
                $thumbnailName = basename($_FILES['profile_photo']['name']);
                $thumbnailPath = $thumbnailDir . 'thumbnail_' . time() . '_' . $thumbnailName;
                move_uploaded_file($_FILES['profile_photo']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $thumbnailPath);
            } else {
                die("Thumbnail tidak valid. Pastikan formatnya JPEG, PNG, atau GIF dengan ukuran maksimal 2MB.");
            }
        }

        // Update Tabel Video
        $updateQuery = "UPDATE video SET title = '$judul', upload_date = '$uploadDate'";

        // Hanya update videoPath dan thumbnailPath jika ada perubahan
        if (!empty($videoPath)) {
            $updateQuery .= ", video = '$videoPath'";
        }
        if (!empty($thumbnailPath)) {
            $updateQuery .= ", thumbnail = '$thumbnailPath'";
        }

        $updateQuery .= " WHERE videoID = '$videoID'";

        if ($conn->query($updateQuery) === TRUE) {
            // Update Modul (jika ada perubahan file modul)
            if (isset($_FILES['module_file']) && $_FILES['module_file']['error'] === UPLOAD_ERR_OK) {
                $allowedModuleTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.presentationml.presentation'];
                if (in_array($_FILES['module_file']['type'], $allowedModuleTypes) && $_FILES['module_file']['size'] <= 4194304) { // Max 4MB
                    $moduleName = basename($_FILES['module_file']['name']);
                    $modulePath = $moduleDir . 'module_' . time() . '_' . $moduleName;
                    $moduleTitle = pathinfo($moduleName, PATHINFO_FILENAME);
                    move_uploaded_file($_FILES['module_file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $modulePath);

                    // Update atau Insert ke Tabel Modul (update jika modul sudah ada)
                    $sqlModul = "UPDATE modul SET title = '$moduleTitle', modul = '$modulePath' WHERE videoID = '$videoID'";
                    $conn->query($sqlModul);
                }
            }

            // Redirect setelah berhasil
            header("Location: /Study-Tube/guru/konten/index.php");
            exit;
        } else {
            die("Error: " . $updateQuery . "<br>" . $conn->error);
        }
    }

    // Hapus Video dan Modul
    if (isset($_POST['deleteVideo'])) {

        // Hapus modul terkait berdasarkan videoID
        $deleteModulQuery = "SELECT * FROM modul WHERE videoID = $videoID";
        $resultModul = $conn->query($deleteModulQuery);

        if ($resultModul->num_rows > 0) {
            // Jika ada modul, hapus file modul terlebih dahulu
            while ($row = $resultModul->fetch_assoc()) {
                $modulePath = $_SERVER['DOCUMENT_ROOT'] . $row['modul']; // Path file modul
                if (file_exists($modulePath)) {
                    unlink($modulePath); // Menghapus file modul
                }
            }
            // Hapus data modul dari database
            $deleteModulQuery = "DELETE FROM modul WHERE videoID = $videoID";
            $conn->query($deleteModulQuery);
        }

        // Hapus video terkait berdasarkan videoID
        $deleteVideoQuery = "SELECT * FROM video WHERE videoID = $videoID";
        $resultVideo = $conn->query($deleteVideoQuery);

        if ($resultVideo->num_rows > 0) {
            // Jika ada video, hapus file video terlebih dahulu
            while ($row = $resultVideo->fetch_assoc()) {
                $videoPath = $_SERVER['DOCUMENT_ROOT'] . $row['video']; // Path file video
                if (file_exists($videoPath)) {
                    unlink($videoPath); // Menghapus file video
                }

                // Hapus thumbnail video
                $thumbnailPath = $_SERVER['DOCUMENT_ROOT'] . $row['thumbnail']; // Path file thumbnail
                if (file_exists($thumbnailPath)) {
                    unlink($thumbnailPath); // Menghapus file thumbnail
                }
            }
            // Hapus data video dari database
            $deleteVideoQuery = "DELETE FROM video WHERE videoID = $videoID";
            $conn->query($deleteVideoQuery);
        }

        echo "Video dan Modul berhasil dihapus.";
        // Redirect setelah berhasil
        header("Location: /Study-Tube/guru/konten/index.php");
        exit;
    } 


    // Hapus hanya Modul
    if (isset($_POST['deleteModul'])) {

        // Hapus modul terkait berdasarkan videoID
        $deleteModulQuery = "SELECT * FROM modul WHERE videoID = $videoID";
        $resultModul = $conn->query($deleteModulQuery);

        if ($resultModul->num_rows > 0) {
            // Jika ada modul, hapus file modul terlebih dahulu
            while ($row = $resultModul->fetch_assoc()) {
                $modulePath = $_SERVER['DOCUMENT_ROOT'] . $row['modul']; // Path file modul
                if (file_exists($modulePath)) {
                    unlink($modulePath); // Menghapus file modul
                }
            }
            // Hapus data modul dari database
            $deleteModulQuery = "DELETE FROM modul WHERE videoID = $videoID";
            $conn->query($deleteModulQuery);
        }

        echo "Modul berhasil dihapus.";
        // Redirect setelah berhasil
        header("Location: /Study-Tube/guru/konten/index.php");
        exit;
    }

    $conn->close();
} else {
    die("Request tidak valid.");
}
?>
