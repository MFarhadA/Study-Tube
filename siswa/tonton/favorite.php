<?php

// Koneksi database
$conn = new mysqli("localhost", "root", "", "study_tube");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Validasi input POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['videoID']) && isset($_POST['studentID']) && isset($_POST['action'])) {
    $videoID = intval($_POST['videoID']);
    $studentID = intval($_POST['studentID']);
    $action = $_POST['action'];

    if ($action === 'favorite') {
        // Logika untuk FOLLOW
        $sqlCheck = "SELECT 1 FROM favorit WHERE studentID = ? AND videoID = ?";
        $stmt = $conn->prepare($sqlCheck);
        $stmt->bind_param("ii", $studentID, $videoID);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            // Tambahkan ke tabel ikuti
            $sqlFollow = "INSERT INTO favorit (studentID, videoID) VALUES (?, ?)";
            $stmtFollow = $conn->prepare($sqlFollow);
            $stmtFollow->bind_param("ii", $studentID, $videoID);

            if ($stmtFollow->execute()) {
                $_SESSION['message'] = "Berhasil favorit.";
            } else {
                $_SESSION['message'] = "Gagal menyimpan data.";
            }
        } else {
            $_SESSION['message'] = "Sudah favorit.";
        }
    } elseif ($action === 'unfavorite') {
        // Logika untuk UNFOLLOW
        $sqlUnfollow = "DELETE FROM favorit WHERE studentID = ? AND videoID = ?";
        $stmtUnfollow = $conn->prepare($sqlUnfollow);
        $stmtUnfollow->bind_param("ii", $studentID, $videoID);

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
