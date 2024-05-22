<?php
include("../session/session_start.php");
include("../session/session_check.php");
include("../database/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve shop_id from the POST request
    $shop_id = $_POST['shop_id'];

    // Delete the shop from the database
    $delete_query = "DELETE FROM shop_details WHERE shop_id = '$shop_id'";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        // Shop successfully deleted
        header("Location: shop.php");
        exit;
    } else {
        // Error occurred while deleting the shop
        echo "Error deleting the shop. Please try again.";
    }
} else {
    // If the request method is not POST, redirect back to the shop page
    header("Location: shop.php");
    exit;
}
?>
