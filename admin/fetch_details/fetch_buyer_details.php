<?php
include ("..\..\database\connection.php");


$query = "SELECT * FROM buyer_details";
$result = mysqli_query($conn, $query);

$csvContent = "Name,Photo,Email,Contact,Address,State,Pin code,Created On\n";

while ($row = mysqli_fetch_assoc($result)) {
    $photoFilename = $row['photo'];
    $photoUri = "../../images/" . $photoFilename;
    $address = str_replace("\n", "\\n", $row['address']);
    $state = str_replace("\n", "\\n", $row['state']);

    
    $csvContent .= "{$row['full_name']},{$photoUri},{$row['email']},{$row['contact_no']},\"{$address}\",\"{$state}\",{$row['pin_code']},{$row['created_on']}\n";
}


header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="buyer_details.csv"');


echo $csvContent;


mysqli_close($conn);
?>
