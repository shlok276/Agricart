<?php
include ("..\..\database\connection.php");


$query = "select* from contact_details";
$result = mysqli_query($conn, $query);


$csvContent = "Buyer Name,E-mail,Description,Status,Created On\n";

while ($row = mysqli_fetch_assoc($result)) {
    $status = ($row['status'] == 0) ? "New" : "Viewed";
    $description = str_replace("\n", " ", $row['message']); 
    $description = str_replace('"', '""', $description); 
    $createdOn = new DateTime($row['created_on']);
    $formattedCreatedOn = $createdOn->format('Y-m-d H:i:s');
    $csvContent .= "{$row['buyer_name']},{$row['email']}," . '"' . "{$description}" . '"' . ",{$status},{$formattedCreatedOn}\n";
}


header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="message_details.csv"');

echo $csvContent;


mysqli_close($conn);
?>
