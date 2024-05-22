<?php
session_start();

if (isset($_SESSION['username'])) {
    $email = $_SESSION['username'];
    // echo $email;

} 
?>
