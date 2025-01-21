<?php
// Ambil path modul dari database untuk video tertentu
$sqlModulCheck = "
    SELECT modul FROM modul WHERE videoID = ? LIMIT 1
";
$stmtModulCheck = $conn->prepare($sqlModulCheck);
$stmtModulCheck->bind_param("i", $videoID);
$stmtModulCheck->execute();
$resultModulCheck = $stmtModulCheck->get_result();

$modulPath = '';
if ($resultModulCheck->num_rows > 0) {
    // Jika ada modul, ambil path file modul
    $rowModul = $resultModulCheck->fetch_assoc();
    $modulPath = $rowModul['modul'];
}
?>