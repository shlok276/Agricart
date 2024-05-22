<?php
include("../session/session_start.php");
include("../session/session_check.php");
include("../database/connection.php"); 

$seller_username = $_SESSION['username'];
$seller_id_query = "SELECT seller_id FROM seller_details WHERE email = '$seller_username'";
$seller_id_result = mysqli_query($conn, $seller_id_query);
$seller_id_row = mysqli_fetch_assoc($seller_id_result);
$seller_id = $seller_id_row['seller_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $product_name = $_POST['product_name'];
    $mrp = $_POST['mrp'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    // Handle file uploads for images
    $image1 = $_FILES['image1']['name'];
    $image2 = $_FILES['image2']['name'];
    $image3 = $_FILES['image3']['name'];

    // Temporary file paths for uploaded images
    $image1_tmp = $_FILES['image1']['tmp_name'];
    $image2_tmp = $_FILES['image2']['tmp_name'];
    $image3_tmp = $_FILES['image3']['tmp_name'];

    // Move uploaded images to desired directory
    move_uploaded_file($image1_tmp, "../images/" . $image1);
    move_uploaded_file($image2_tmp, "../images/" . $image2);
    move_uploaded_file($image3_tmp, "../images/" . $image3);

    // Insert data into database
    $sql = "INSERT INTO product_details (seller_id, name, mrp, price, quantity, description, photo, photo2, photo3) 
            VALUES ('$seller_id', '$product_name', '$mrp', '$price', '$quantity', '$description', '$image1', '$image2', '$image3')";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: add_product.php?alert=Shop Details INserted Successfully");
    } else {
        header("Location: add_product.php?alert=error");
    }
    

    // Close the database connection
    $conn->close();
}
?>
