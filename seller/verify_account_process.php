<?php
include("../session/session_start.php");
include("../session/session_check.php");
include("../database/connection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $image = $_FILES['image']['name'];
    $gov_id = $_FILES['gov_id']['name'];
    $gst_no = $_POST['gst_no'];

    // Move uploaded files to the destination directory
    $target_directory = "../images/";
    $image_target = $target_directory . basename($image);
    $gov_id_target = $target_directory . basename($gov_id);

    if (
        move_uploaded_file($_FILES["image"]["tmp_name"], $image_target) &&
        move_uploaded_file($_FILES["gov_id"]["tmp_name"], $gov_id_target)
    ) {
        // Fetch seller's ID based on the email stored in the session
        $seller_username = $_SESSION['username'];
        $seller_id_query = "SELECT seller_id FROM seller_details WHERE email = '$seller_username'";
        $seller_id_result = mysqli_query($conn, $seller_id_query);
        $seller_id_row = mysqli_fetch_assoc($seller_id_result);
        $seller_id = $seller_id_row['seller_id'];

        // Insert data into database
        $insert_query = "UPDATE seller_details SET first_name = '$first_name', last_name = '$last_name', photo = '$image', government_id = '$gov_id', gst_no ='$gst_no' WHERE seller_id = '$seller_id'";

        if (mysqli_query($conn, $insert_query)) {
            header("Location: ../login/s_login.php?alert=inserted ");
        } else {
            header("Location: ../login/s_login.php?alert=Shop Details INserted Successfully");
        }
    } else {
        header("Location: ../login/s_login.php?alert=Shop Details INserted Successfully");
    }
}
?>
