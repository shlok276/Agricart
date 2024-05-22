<?php
    // Include necessary files
    include("../session/session_start.php");
    include("../session/session_check.php");
    include("../database/connection.php");

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve order ID and tracking ID from the form
        $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
        $tracking_no = mysqli_real_escape_string($conn, $_POST['tracking_no']);

        // Update the database with the tracking ID
        $update_query = "UPDATE order_details SET status= '1', tracking_no = '$tracking_no' WHERE order_id = '$order_id'";
        $update_result = mysqli_query($conn, $update_query);

        // Check if the update was successful
        if($update_result) {
            $message = 'Tracking ID updated successfully';
            header("Location: order.php");
        } else {
            $message = 'Failed to update Tracking ID';
            header("Location: order.php");
        }
        // Provide feedback to the user
        echo "<script>alert('$message');</script>";
        header("Location: order.php");
    }
?>
