<?php
include("../session/session_start.php");
include("../session/session_check.php");
include("../database/connection.php");


$query = "SELECT * FROM product_details ORDER BY RAND() LIMIT 8"; // Ordering randomly and limiting to 8 products
$result = mysqli_query($conn, $query);
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $buyer_id_query = "SELECT buyer_id FROM buyer_details WHERE email = '$username'";
    $buyer_id_result = mysqli_query($conn, $buyer_id_query);
    $buyer_id_row = mysqli_fetch_assoc($buyer_id_result);
    $buyer_id = $buyer_id_row['buyer_id'];
    // echo $buyer_id;
$cartcount= "SELECT COUNT(*) AS product_count FROM cart_details WHERE buyer_id = $buyer_id";
$result = $conn->query($cartcount);

// Check if the query executed successfully
if ($result) {
    // Fetch the result
    $row = $result->fetch_assoc();
}




}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AgriCart</title>
    <link rel="stylesheet" href="home.css">
    <link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
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
            <li class="module"><a class="active" href="index.php">Home</a></li>
            <li class="module"><a href="product.php">Products</a></li>
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
            </li>
            <li class="dropdown"><a href="#" class="dropbtn"><ion-icon name="person-outline"></ion-icon></a>
            <div class="dropdown-content">
                <a href="profile.php"><ion-icon name="person-circle-outline"></ion-icon> Profile</a>
                <a href="order.php"><ion-icon name="cube-outline"></ion-icon> Orders</a>
                <a href="../login/logout.php"><ion-icon name="log-out-outline"></ion-icon> Log Out</a>
            </div>
            </li>
        </ul>
    </div>
</section>

<section id="hero">
    <b class="h4">Trade-in-offer</b>
    <b class="h2">Super value deals</b>
    <b class="h1">On all products</b>
    <p>Get up to 20% off!</p>
    <a href="product.php"><button>Shop Now</button></a>
</section><br><br>

<?php include("8_product.php");?>

<section id="banner" class="section-m1">
    <h4>Repair Services</h4>
    <h2>Get up to <span>20% OFF</span> At Farming Goods</h2>
    <a href="product.php"><button class="normal">Explore More</button></a>
</section>


<section id="sm-banner" class="section-p1">
    <div class="banner-box">
        <h4>Crazy deals</h4>
        <h2>Buy 2 Get 1 Free</h2>
        <span>The best products are on the Sale</span>
        <button class="white">Large More</button>
    </div>
    <div class="banner-box2">
        <h4>Spring/Summer</h4>
        <h2>Upcoming Season</h2>
        <span>The best products are coming soon</span>
        <button class="white">Large More</button>
    </div>
</section>

<section id="banner3">
    <div class="banner-box">
        <h2>SEASONAL SALE</h2>
        <h4>For winter Cultivation</h4>
    </div>
    <div class="banner-box2">
        <h2>SEASONAL SALE</h2>
        <h4>For winter Cultivation</h4>
    </div>
    <div class="banner-box3">
        <h2>SEASONAL SALE</h2>
        <h4>For winter Cultivation</h4>
    </div>
    
</section>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
<?php
// include("../1.php"); 
include("newsletter.php");
include ("footer.php");
?>
</html>