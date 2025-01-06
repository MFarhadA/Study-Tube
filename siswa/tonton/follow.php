<?php
session_start();

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

            if ($stmtFollow->execute()) {
                $_SESSION['message'] = "Berhasil mengikuti.";
            } else {
                $_SESSION['message'] = "Gagal menyimpan data.";
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
