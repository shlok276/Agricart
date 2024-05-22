<?php
include("../session/session_start.php");
include("../session/session_check.php");
include("../database/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve product_id from the POST request
    $product_id = $_POST['product_id'];

    // Delete the product from the database
    $delete_query = "DELETE FROM product_details WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $delete_query);

    if ($result) {
        // Product successfully deleted
        header("Location: products.php");
        exit;
    } else {
        // Error occurred while deleting the product
        echo "Error deleting the product. Please try again.";
    }
} else {
    // If the request method is not POST, redirect back to the products page
    header("Location: products.php");
    exit;
}
?>
