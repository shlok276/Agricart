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

    $shop_name = $_POST['shop_name'];
    $shop_address = $_POST['description'];
    $shop_city = $_POST['shop_city'];
    $shop_email = $_POST['shop_email'];
    $contact_number = $_POST['contact_number'];
    $shop_timing = $_POST['shop_timing'];
    $contact_person = $_POST['contact_person'];
    $location_link = $_POST['location_link'];

    // File upload handling for shop image
    $shop_image = $_FILES['image1']['name'];
    $target_dir = "images/";
    $target_file = $target_dir . basename($shop_image);
    move_uploaded_file($_FILES["image1"]["tmp_name"], $target_file);

    // SQL query to insert data into the database
    $sql = "INSERT INTO shop_details (seller_id, name, address, city, email, contact_no, time, contact_person, location, photo)
            VALUES ('$seller_id', '$shop_name', '$shop_address', '$shop_city', '$shop_email', '$contact_number', '$shop_timing', '$contact_person', '$location_link', '$shop_image')";

    if ($conn->query($sql) === TRUE) {
        header("Location: add_shop.php?alert=Shop Details Inserted Successfully");
    } else {
        header("Location: add_shop.php?alert=error");
    }

    // Close database connection
    $conn->close();
}
?>
