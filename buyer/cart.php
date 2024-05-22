<?php
include("../session/session_start.php");
include("../database/connection.php");

// Check if 'username' session variable is set
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $buyer_id_query = "SELECT buyer_id FROM buyer_details WHERE email = '$username'";
    $buyer_id_result = mysqli_query($conn, $buyer_id_query);
    $buyer_id_row = mysqli_fetch_assoc($buyer_id_result);
    $buyer_id = $buyer_id_row['buyer_id'];
    

    $query = "SELECT cart_details.*, product_details.name, product_details.price, product_details.photo FROM cart_details 
              INNER JOIN product_details ON cart_details.product_id = product_details.product_id
              WHERE cart_details.buyer_id = '$buyer_id'";
    $result = mysqli_query($conn, $query);

    $totalPrice = 0;

    while ($row = mysqli_fetch_assoc($result)) {
        $product_price = $row['price'];
        $quantity = $row['quantity'];
        $subtotal = $product_price * $quantity;
        $totalPrice += $subtotal;
    }

    if(isset($_GET['remove_product'])) {
        $product_id = $_GET['remove_product'];

        // Check if product exists
        $check_query = "SELECT * FROM cart_details WHERE buyer_id = '$buyer_id' AND product_id = $product_id";
        $check_result = mysqli_query($conn, $check_query);

        if(mysqli_num_rows($check_result) > 0) {
            // Product exists, proceed with removal
            $remove_query = "DELETE FROM cart_details WHERE buyer_id = '$buyer_id' AND product_id = $product_id LIMIT 1";
            $remove_result = mysqli_query($conn, $remove_query);

            if($remove_result) {
                header("Location: cart.php"); 
                exit();
            } else {
                echo "Error removing product from cart";
            }
        } else {
            echo "<script>alert('Product not found in cart.');</script>";
        }
    }
}


$shippingCharges = 0;
if(isset($result)) {
    mysqli_data_seek($result, 0);
    while ($row = mysqli_fetch_assoc($result)) {
        $product_price = $subtotal;
        if ($product_price < 150) {
            $shippingCharges += 20;
        }
    }
}

$totalWithShipping = $totalPrice + $shippingCharges;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="home.css">
    <link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <script>
        function reloadPage() {
            location.reload();
        }
        
        function prepareCheckout() {
            // Create an array to store product details
            var products = [];

            // Loop through each product row in the table
            var rows = document.querySelectorAll("#cart tbody tr");
            rows.forEach(function(row) {
                var product = {
                    product_id: row.querySelector(".product_id").value,
                    price: row.querySelector(".price").textContent.replace("₹", ""),
                    quantity: row.querySelector(".quantity").textContent,
                };
                // Push product details to the array
                products.push(product);
            });

            // Convert the array to JSON and set it as the value of the hidden input field
            document.getElementById("product_details").value = JSON.stringify(products);
        }
    </script>
</head>
<body>
    <section id="header">
        <a onclick="reloadPage()"><img src="../images/homelogo.png" class="logo"></a>
        <div>
            <ul id="navbar">
                <li class="module"><a href="index.php">Home</a></li>
                <li class="module"><a href="product.php">Products</a></li>
                <li class="module"><a href="shop.php">Shop</a></li>
                <li class="module"><a href="about.php">About</a></li>
                <li class="module"><a href="contact.php">Contact</a></li>
                <li class="icon"><a href="cart.php"><ion-icon name="cart-outline"></ion-icon></a></li>
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

    <section id="page-hadder" class="contct-hadder">
        <h2>Cart</h2>
        <p>Purchase products at best price</p>
    </section>

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Images</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                <?php
                if(isset($result)) {
                    // Reset the data seek pointer to start fetching from the beginning
                    mysqli_data_seek($result, 0);
                    
                    while ($row = mysqli_fetch_assoc($result)) {
                        $product_name = $row['name'];
                        $product_price = $row['price'];
                        $quantity = $row['quantity'];
                        $subtotal = $product_price * $quantity;
                ?>
                        <tr>
                            <td><a href="javascript:void(0)" onclick="removeProduct(<?php echo $row['product_id']; ?>)"><ion-icon name="close-circle-outline"></ion-icon></a></td>
                            <td><img src="../images/<?php echo empty($row['photo']) ? 'abc2.jpeg' : $row['photo']; ?>" alt="Product Image"></td>
                            <td><?php echo $product_name; ?></td>
                            <td class="price">₹<?php echo $product_price; ?></td>
                            <td class="quantity"><?php echo $quantity; ?></td>
                            <td>₹<?php echo $subtotal; ?></td>
                            <input type="hidden" class="product_id" value="<?php echo $row['product_id']; ?>">
                        </tr>
                <?php 
                    }
                } else {
                    echo "<tr><td colspan='6'>No items in the cart</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
    <?php if($totalWithShipping >1){
                ?>
    <section id="cart-parts" class="section-p1"> 
        <div id="subtotal">
            <h3>Cart Total</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>₹<?php echo number_format($totalPrice, 2); ?></td>
                </tr>
                <tr>
                    <td>Shipping Charges</td>
                    <td><?php echo ($shippingCharges == 0) ? 'Free' : "₹" . $shippingCharges; ?></td>
                </tr>
            
                <tr>
                    <td><strong>Total</strong></td>
                    <td>₹<?php echo number_format($totalWithShipping, 2);?></td>
                </tr>
            </table>
            <button type="submit" name="proceed_to_checkout" class="normal" onclick="openPopup()">Proceed To Checkout</button>
                
                </form>
                    <div class="overlay" id="overlay">
                        <div class="popup">
                            <span class="close-btn" onclick="closePopup()">×</span>
                            <div class="pay_main">
                                <div class="pay_1">
                                    <center>
                                        <h3>Online Payment</h3>
                                        <img src="../images/payment-badge.png" class="logo-pay"><br>
                                        <a href="online.php"><button type="submit" class="normal" >Pay Online</button></a>
                                        <!-- <h3>comming soon</h3> -->
                                    </center>
                                </div>
                                <div class="pay_2">
                                    <center>
                                        <h3>Cash on Delivery</h3>
                                        <img src="../images/cod.jpg" class="logo-cod"><br>
                                        <form method="post" action="checkout_process.php" id="checkout_form">
                                            <input type="hidden" name="product_details" id="product_details">
                                            <input type="hidden" name="shipping_charges" value="<?php echo $shippingCharges; ?>">
                                            <button type="submit" name="proceed_to_checkout" class="normal" onclick="prepareCheckout()">Pay With Cash</button>
                                        </form>
                                    </center>
                                </div>
                        </div>     
                    </div>
                </div>
        </div>
    </section>
    <?php
            }
            ?>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        function openPopup() {
            document.getElementById("overlay").style.display = "flex";
        }

        function closePopup() {
            document.getElementById("overlay").style.display = "none";
        }

        function removeProduct(productId) {
            var confirmation = confirm('Are you sure you want to remove the product?');
            if (confirmation) {
                window.location.href = 'cart.php?remove_product=' + productId;
            }
        }
    </script>
</body>
<?php
    include ("footer.php");
?>
</html>
