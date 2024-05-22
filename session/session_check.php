<?php
// session_start();

// Redirect to login page if not logged in
if (!isset($_SESSION['username'])) {
    header("location: ../login/login.php"); // Replace login.php with the actual login page URL
    exit();
}
?>