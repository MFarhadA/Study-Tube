<?php
// Pastikan koneksi ke database sudah tersedia (misalnya $conn)

if (isset($_GET['videoID'])) {
    $videoID = (int)$_GET['videoID']; // Ambil videoID dari URL dan pastikan valid integer

    // Query untuk mengambil path modul berdasarkan videoID
    $sqlModulCheck = "
        SELECT modul, download FROM modul WHERE videoID = ? LIMIT 1
    ";
    $stmtModulCheck = $conn->prepare($sqlModulCheck);
    $stmtModulCheck->bind_param("i", $videoID);
    $stmtModulCheck->execute();
    $resultModulCheck = $stmtModulCheck->get_result();

    $modulPath = null;
    if ($resultModulCheck->num_rows > 0) {
        // Ambil data modul dan path file
        $rowModul = $resultModulCheck->fetch_assoc();
        $modulPath = $rowModul['modul'];
        $downloadCount = $rowModul['download'];

        // Update jumlah unduhan
        $newDownloadCount = $downloadCount + 1;
        $sqlUpdateDownload = "
            UPDATE modul SET download = ? WHERE videoID = ?
        ";
        $stmtUpdateDownload = $conn->prepare($sqlUpdateDownload);
        $stmtUpdateDownload->bind_param("ii", $newDownloadCount, $videoID);
        $stmtUpdateDownload->execute();

        // Periksa apakah file modul ada
        if (file_exists($modulPath)) {
            // Setel header agar browser tahu ini adalah file untuk diunduh
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($modulPath) . '"');
            header('Content-Length: ' . filesize($modulPath));

            // Baca dan kirim file ke output (unduh)
            readfile($modulPath);
            exit; // Jangan lanjutkan eksekusi setelah file dikirim
        }
    }
}
?>
