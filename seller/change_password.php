<?php
include("../database/connection.php");
include("../session/session_start.php");
include("../session/session_check.php");

if(isset($_POST['save_password'])) {
    $username = $_SESSION['username'];

    $current_password = mysqli_real_escape_string($conn, $_POST['current_password']);
    $new_password = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Fetch the hashed password from the database
    $check_password_query = "SELECT password FROM seller_details WHERE email = '$username'";
    $check_password_result = mysqli_query($conn, $check_password_query);
    $row = mysqli_fetch_assoc($check_password_result);
    $stored_hashed_password = $row['password'];

    // Verify the current password
    if(password_verify($current_password, $stored_hashed_password)) {
        // Current password is correct
        if($new_password === $confirm_password) {
            // New password and confirm password match
            // Hash the new password
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            // Update the password in the database
            $update_query = "UPDATE seller_details SET password='$hashed_password' WHERE email = '$username'";
            if(mysqli_query($conn, $update_query)) {
                // Password updated successfully
                header("Location: setting.php?alert=password_changed_successfully");
                exit();
            } else {
                // Error occurred
                header("Location: setting.php?alert=update_error");
                exit();
            }
        } else {
            // New password and confirm password do not match
            header("Location: setting.php?alert=password_mismatch");
            exit();
        }
    } else {
        // Current password is incorrect
        header("Location: setting.php?alert=incorrect_current_password");
        exit();
    }
}
?>
