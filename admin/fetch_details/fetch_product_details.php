<?php
include ("..\..\database\connection.php");

$query = "SELECT product_details.*, seller_details.first_name AS seller_name FROM product_details
          LEFT JOIN seller_details ON product_details.seller_id = seller_details.seller_id";
$result = mysqli_query($conn, $query);

$csvContent = "Product Name,Photo,Photo2,Photo3,Seller Name,Price,Quantity,Description\n";

while ($row = mysqli_fetch_assoc($result)) {
    $photoFilename = $row['photo'];
    $photoUri = "../../images/" . $photoFilename;
    $photoFilename = $row['photo2']; 
    $photoUri2 = "../../images/" . $photoFilename;
    $photoFilename = $row['photo3'];
    $photoUri3 = "../../images/" . $photoFilename;
    $description = str_replace("\n", " ", $row['description']); 
    $description = str_replace('"', '""', $description); 
    $csvContent .= "{$row['name']},{$photoUri},{$photoUri2},{$photoUri3},{$row['seller_name']},{$row['price']},{$row['quantity']},\"{$description}\"\n"; 
}


header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="product_details.csv"');

echo $csvContent;

mysqli_close($conn);
?>
