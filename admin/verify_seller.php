<?php
include ("../database/connection.php");
include ("../session/session_start.php");
include("../session/session_check.php");

if(isset($_POST['verifySeller']) && isset($_POST['seller_id'])) {
    $seller_id = $_POST['seller_id'];
    
    // Update the 'verify' column to 1 for the selected seller ID
    $query = "UPDATE seller_details SET verify = 1 WHERE seller_id = $seller_id";
    $result = mysqli_query($conn, $query);
    
    if($result) {
        header("Location: new_seller.php?alert=user change");
    } else {
        header("Location: new_seller.php?alert=error");
    }
}
?>
