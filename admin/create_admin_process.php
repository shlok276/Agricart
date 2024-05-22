<?php 
include("../database/connection.php");

if(isset($_POST['create_admin'])) {
    // Sanitize and validate input
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);

    // Check if the username already exists
    $check_username_query = "SELECT * FROM admin WHERE email = '$email'";
    $check_username_result = mysqli_query($conn, $check_username_query);

    if(mysqli_num_rows($check_username_result) > 0) {
        // Username already exists, show alert
        header("Location: create_admin.php?alert=useralreadyexist");  
        exit();
    } else {
        // Username doesn't exist, proceed with creating the admin account

        // Encrypt the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert the new admin data into the database
        $insert_query = "INSERT INTO admin (email, password, contact_no) VALUES ('$email', '$hashed_password', '$contact_no')";
        if(mysqli_query($conn, $insert_query)) {
            // Admin account created successfully, show alert
            header("Location: create_admin.php?alert=admincreated");
            exit();
        } else {
            header("Location: create_admin.php?alert=error");
        }
    }
}
?>
