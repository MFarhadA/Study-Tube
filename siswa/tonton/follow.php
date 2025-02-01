<?php
session_start();

// Atur timezone ke GMT+7
date_default_timezone_set('Asia/Jakarta');

// Koneksi database
$conn = new mysqli("localhost", "root", "", "study_tube");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Validasi input POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['teacherID']) && isset($_POST['studentID']) && isset($_POST['action'])) {
    $teacherID = intval($_POST['teacherID']);
    $studentID = intval($_POST['studentID']);
    $action = $_POST['action'];

    $uploadDate = date('Y-m-d H:i:s');

    if ($action === 'follow') {
        // Logika untuk FOLLOW
        $sqlCheck = "SELECT 1 FROM ikuti WHERE studentID = ? AND teacherID = ?";
        $stmt = $conn->prepare($sqlCheck);
        $stmt->bind_param("ii", $studentID, $teacherID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Tambahkan ke tabel ikuti
            $sqlFollow = "INSERT INTO ikuti (studentID, teacherID) VALUES (?, ?)";
            $stmtFollow = $conn->prepare($sqlFollow);
            $stmtFollow->bind_param("ii", $studentID, $teacherID);

            $sqlNotification = "INSERT INTO notifikasi_siswa (studentID, teacherID, message, upload_date)
                    VALUES (?, ?, ?, ?)";

            // Ambil nama siswa dari database
            $sqlGetName = "SELECT u.name 
                        FROM user u 
                        JOIN siswa s ON u.userID = s.userID 
                        WHERE s.studentID = ?";
            $stmtGetName = $conn->prepare($sqlGetName);
            $stmtGetName->bind_param("i", $studentID);
            $stmtGetName->execute();
            $resultGetName = $stmtGetName->get_result();
            $rowGetName = $resultGetName->fetch_assoc();
            $studentName = $rowGetName['name'];

            // Buat pesan notifikasi
            $message = "$studentName telah mengikuti anda";

            // Eksekusi query notifikasi
            $stmtNotification = $conn->prepare($sqlNotification);
            $stmtNotification->bind_param("iiss", $studentID, $teacherID, $message, $uploadDate);

            if ($stmtFollow->execute()) {
                if ($stmtNotification->execute()) {
                    $_SESSION['message'] = "Berhasil favorit.";
                } else {
                    $_SESSION['message'] = "Gagal menyimpan notifikasi.";
                }
            } else {
                $_SESSION['message'] = "Gagal menyimpan data favorit.";
            }
        } else {
            $_SESSION['message'] = "Sudah mengikuti.";
        }
    } elseif ($action === 'unfollow') {
        // Logika untuk UNFOLLOW
        $sqlUnfollow = "DELETE FROM ikuti WHERE studentID = ? AND teacherID = ?";
        $stmtUnfollow = $conn->prepare($sqlUnfollow);
        $stmtUnfollow->bind_param("ii", $studentID, $teacherID);

        if ($stmtUnfollow->execute()) {
            $_SESSION['message'] = "Berhasil berhenti mengikuti.";
        } else {
            $_SESSION['message'] = "Gagal menghapus data.";
        }
    } else {
        $_SESSION['message'] = "Aksi tidak valid.";
    }
} else {
    $_SESSION['message'] = "Data tidak valid.";
}

// Redirect kembali ke halaman sebelumnya
header("Location: " . $_SERVER['HTTP_REFERER']);
exit;
?>
