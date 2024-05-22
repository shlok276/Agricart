<?php
include("../database/connection.php");
include("../session/session_start.php");
include("../session/session_check.php");

if(isset($_POST['save_profile'])) {
    $username = $_SESSION['username'];

    $full_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $contact_no = mysqli_real_escape_string($conn, $_POST['contact_no']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pin_code']);

    $query = "UPDATE buyer_details SET full_name='$full_name', contact_no='$contact_no', email='$email', address='$address', pin_code='$pincode' , state='$state' WHERE email = '$username'";
    if(mysqli_query($conn, $query)) {
        header("Location: profile.php?alert=profile_update");
    } else {
        // Error occurred
        // Redirect to profile page or show an error message
    }
}
?>
