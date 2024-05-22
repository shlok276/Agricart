<?php
include("../database/connection.php");
include("../session/session_start.php");

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
$buyer_id_query = "SELECT buyer_id FROM buyer_details WHERE email = '$username'";
$buyer_id_result = mysqli_query($conn, $buyer_id_query);
$buyer_id_row = mysqli_fetch_assoc($buyer_id_result);
$buyer_id = $buyer_id_row['buyer_id'];
// echo $buyer_id;

if(isset($_GET['product_id'])) {
    $product_id = mysqli_real_escape_string($conn, $_GET['product_id']);
    $query = "SELECT * FROM product_details WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
        $mrp = $row['mrp'];
        $price = $row['price'];
        $quantity = $row['quantity'];
        $description = $row['description'];
        $image1 = empty($row['photo']) ? '../images/xyz.png' : $row['photo'];
        $image2 = empty($row['photo']) ? '../images/xyz.png' : $row['photo2'];
        $image3 = empty($row['photo']) ? '../images/xyz.png' : $row['photo3'];
    }
}

if(isset($_POST['add_to_cart'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $requested_quantity = (int)$_POST['quantity'];

    if($requested_quantity > $quantity) {
        echo "<script>alert('Not enough quantity available.')</script>";
    } else {
        $check_query = "SELECT * FROM cart_details WHERE product_id = '$product_id' AND buyer_id = '$buyer_id'";
        $check_result = mysqli_query($conn, $check_query);
        
        if(mysqli_num_rows($check_result) > 0) {
            $row = mysqli_fetch_assoc($check_result);
            $existing_quantity = (int)$row['quantity'];
            $new_quantity = $existing_quantity + $requested_quantity;

            if($new_quantity > $quantity) {
                echo "<script>alert('Not enough quantity available.')</script>";
            } else {
                $update_query = "UPDATE cart_details SET quantity = $new_quantity WHERE product_id = '$product_id' AND buyer_id = '$buyer_id'";
                $update_result = mysqli_query($conn, $update_query);

                if($update_result) {
                    echo "<script>alert('Quantity updated successfully.')</script>";
                } else {
                    echo "<script>alert('Failed to update quantity. Please try again.')</script>";
                }
            }
        } else {
            $insert_query = "INSERT INTO cart_details (product_id, buyer_id, quantity) VALUES ('$product_id', '$buyer_id', '$requested_quantity')";
            $insert_result = mysqli_query($conn, $insert_query);

            if($insert_result) {
                echo "<script>alert('Product added to cart successfully.')</script>";
            } else {
                echo "<script>alert('Failed to add product to cart. Please try again.')</script>";
            }
        }
    }
    header("Location: ".$_SERVER['PHP_SELF']."?product_id=$product_id");
    exit();
}


$cartcount= "SELECT COUNT(*) AS product_count FROM cart_details WHERE buyer_id = $buyer_id";
$cartcount_result = mysqli_query($conn, $cartcount);
    
if ($cartcount_result) {
    $row = mysqli_fetch_assoc($cartcount_result);
} 
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Details</title>
    <link rel="stylesheet" href="home.css">
    <link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <style>
        .out-of-stock {
            color: red;
        }
    </style>
    <script>
        function reloadPage() {
            location.reload();
        }
    </script>
</head>
<body>

<section id="header">
    <a onclick="reloadPage()"><img src="../images/homelogo.png" class="logo"></a>
    <div>
        <ul id="navbar">
            <li class="module"><a href="index.php">Home</a></li>
            <li class="module"><a class="active" href="product.php">Products</a></li>
            <li class="module"><a href="shop.php">Shop</a></li>
            <li class="module"><a href="about.php">About</a></li>
            <li class="module"><a href="contact.php">Contact</a></li>
            <li class="icon">
                <div class="cart">
                    <a href="cart.php"><ion-icon name="cart-outline"></ion-icon></a>
                    <?php if ($row['product_count'] > 0): ?>
                        <sup><?php echo $row['product_count']; ?></sup>
                    <?php endif; ?>

                    </div>
            <li class="dropdown"><a href="#" class="dropbtn"><ion-icon name="person-outline"></ion-icon></a>
                        <div class="dropdown-content">
                              <a href="profile.php"><ion-icon name="person-circle-outline"></ion-icon> Profile</a>
                              <a href="#"><ion-icon name="cube-outline"></ion-icon> Orders</a>
                              <a href="#"><ion-icon name="log-out-outline"></ion-icon> Log Out</a>
                        </div>
                    </li>
        </ul>
    </div>
</section>

<section id="productdetails" class="section-p1">
    <?php if(isset($name)): ?>
    <div class="single-product-image">
        <img src="../images/<?php echo $image1; ?>" width="100%" id="MainImg" alt="Main Image">

        <div class="small-img-group">
            <div class="small-img-col">
                <img src="../images/<?php echo $image1; ?>" width="100%" class="small-img" alt="Small Image 1">
            </div>

            <div class="small-img-col">
                <img src="../images/<?php echo $image2; ?>" width="100%" class="small-img" alt="Small Image 2">
            </div>
            <div class="small-img-col">
                <img src="../images/<?php echo $image3; ?>" width="100%" class="small-img" alt="Small Image 3">
            </div>
        </div>
    </div>

    <div class="single-product-details">
        <h1><?php echo $name; ?></h1>
        <br>
        <?php if($quantity > 0): ?>
            <div class="mrp">
                <b><strike>₹<?php echo $mrp; ?></strike></b>
                <h2>₹<?php echo $price; ?></h2>

            </div>
            <form method="post" action="">
                <br>
                <input type="number" name="quantity" value="1" min="1" max="<?php echo $quantity; ?>">
                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                <button type="submit" name="add_to_cart" class="normal">Add To Cart</button>
            </form>
        <?php else: ?>
            <h2 class="out-of-stock">Out of Stock</h2>
        <?php endif; ?>
        <h4>Product Details</h4>
        <span><?php echo $description; ?></span>
    </div>
    <?php else: ?>
    <p>No product found.</p>
    <?php endif; ?>
</section>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script>
   var MainImg = document.getElementById("MainImg");
   var smallimg =document.getElementsByClassName("small-img");

   smallimg[0].onclick =function(){
     MainImg.src = smallimg[0].src;
   }
   smallimg[1].onclick =function(){
     MainImg.src = smallimg[1].src;
   }
   smallimg[2].onclick =function(){
     MainImg.src = smallimg[2].src;
   }
   smallimg[3].onclick =function(){
     MainImg.src = smallimg[3].src;
   }
</script>

</body>
<?php
include ("8_product.php");
include ("footer.php");
?>
</html>

