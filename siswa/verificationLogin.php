<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: /Study-Tube/login/index.html");
    exit();
}

// role guru
if (isset($_SESSION['user_id']) && $_SESSION['role'] == 2) {
    header("Location: /Study-Tube/guru/index.php");
    exit();
}

session_write_close();
?>