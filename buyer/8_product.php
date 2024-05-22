<?php
include("../database/connection.php");


$query = "SELECT * FROM product_details ORDER BY RAND() LIMIT 8"; 
$result = mysqli_query($conn, $query);

// Check if user is logged in
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

$buyer_id_query = "SELECT buyer_id FROM buyer_details WHERE email = '$username'";
    $buyer_id_result = mysqli_query($conn, $buyer_id_query);
    $buyer_id_row = mysqli_fetch_assoc($buyer_id_result);
    $buyer_id = $buyer_id_row['buyer_id'];
    // echo $buyer_id;

// Check if add to cart button is clicked
if(isset($_POST['add_to_cart_short_cut'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $quantity = 1; 

    // Check if the product already exists in the cart
    $check_query = "SELECT * FROM cart_details WHERE product_id = '$product_id' AND buyer_id = '$buyer_id'";
    $check_result = mysqli_query($conn, $check_query);
    
    if(mysqli_num_rows($check_result) > 0) {
        // If the product already exists, update the quantity
        $update_query = "UPDATE cart_details SET quantity = quantity + $quantity WHERE product_id = '$product_id' AND buyer_username = '$username'";
        $update_result = mysqli_query($conn, $update_query);

        if($update_result) {
            // Quantity updated successfully
            echo "<script>alert('Quantity updated successfully.')</script>";
        } else {
            // Error updating quantity
            echo "<script>alert('Failed to update quantity. Please try again.')</script>";
        }
    } else {
        // If the product does not exist, insert a new entry
        $insert_query = "INSERT INTO cart_details (product_id, buyer_id, quantity) VALUES ('$product_id', '$buyer_id', '$quantity')";
        $insert_result = mysqli_query($conn, $insert_query);

        if($insert_result) {
            // Product successfully added to cart
            echo "<script>alert('Product added to cart successfully.')</script>";
        } else {
            // Error occurred while adding product to cart
            echo "<script>alert('Failed to add product to cart. Please try again.')</script>";
        }
    }

    // Redirect to the same page to prevent form resubmission
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agricart</title>
    <link rel="stylesheet" href="home.css">
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>

<body>
    <section id="product1" class="section-p1">
        <h2>Similar Products</h2>
        <p>Specially for Organic Farming</p>
        <div class="pro-container">
        <?php
            // Loop through each product fetched from the database
            while ($row = mysqli_fetch_assoc($result)) {
                $image = empty($row['photo']) ? '../images/xyz.png' : '../images/' . $row['photo'];
                $product_id = $row['product_id']; // Assuming 'product_id' is the primary key column in your 'product_details' table
                $name = $row['name'];
                $price = $row['price'];
            ?>
                <div class="pro">
                <a href="product_detail.php?product_id=<?php echo $product_id; ?>">
                    <img src="<?php echo $image; ?>" alt="">
                </a>
                <div class="des">
                    <span><h5><?php echo $name; ?></h5></span>
                    <!-- <h5>700</h5> -->
                    
                    <?php 
                        if ($row['quantity'] > 0) {
                            ?>
                            <h4>₹<?php echo $price; ?></h4>
                        <?php } else {
                            // echo "Out of stock";?>
                            <h2 class="out-of-stock" style="color: red;">Out of Stock</h2>
                            <?php
                        } 
                    ?>
                </div>

                <form method="post" class="cart_form" action="">
                    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                    <?php if ($row['quantity'] > 0): ?>
                        <button class="cart" type="submit" name="add_to_cart_short_cut">
                            <a><ion-icon name="cart-outline"></ion-icon></a>
                        </button>
                    <?php endif; ?>
                </form>

            </div>
            <?php
            }
        ?>
        </div>
    </section>
</body>
</html>