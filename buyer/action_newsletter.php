<?php
// Retrieve the email from the form submission
if(isset($_POST['email'])) {
    $email = $_POST['email'];

    include ("..\database\connection.php");

    // Prepare SQL statement
    $sql = "INSERT INTO newsletter (email) VALUES ('$email')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        header("location:index.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>