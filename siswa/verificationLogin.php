<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// role guru
if (isset($_SESSION['user_id']) && $_SESSION['role'] == 2) {
    header("Location: index.php");
    exit();
}
?>