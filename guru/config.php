<?php
session_start();
if (isset($_SESSION['email_2'])) {
    $email_2 = $_SESSION['email_2'];  // Ambil email dari session
} else {
    $email_2 = 'Email tidak ditemukan';
}
?>