<?php
include("../session/session_start.php");
include("../session/session_check.php");
include("../database/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $shop_id = $_POST['shop_id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $location = $_POST['location'];
    $time = $_POST['timming'];
    $contact_person = $_POST['contact_person'];

    // Check if a new image file is uploaded
    if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // File upload handling
        $target_dir = "../images/";
        $target_file = $target_dir . uniqid() . '_' . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if file is an actual image
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["image"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow only certain file formats
        $allowed_extensions = array("jpg", "jpeg", "png", "gif");
        if (!in_array($imageFileType, $allowed_extensions)) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file and update database
        } else {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                echo "The file " . basename($_FILES["image"]["name"]) . " has been uploaded.";
                // Update the database with the new image filename
                $update_query = "UPDATE shop_details SET photo = '".basename($target_file)."' WHERE shop_id = '$shop_id'";
                mysqli_query($conn, $update_query);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Update the database with other shop details
    $update_query = "UPDATE shop_details SET name = '$name', address = '$address', city = '$city', email = '$email', 
    contact_no= '$contact_no', time = '$time', contact_person = '$contact_person', location = '$location' WHERE shop_id = '$shop_id'";
    mysqli_query($conn, $update_query);

    // Redirect back to the shop page after updating
    header("Location: shop.php");
    exit;
}
?>
