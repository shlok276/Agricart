<?php
include ("../session/session_start.php");
include("../session/session_check.php");
include("../database/connection.php");

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $buyer_id_query = "SELECT buyer_id FROM buyer_details WHERE email = '$username'";
    $buyer_id_result = mysqli_query($conn, $buyer_id_query);
    $buyer_id_row = mysqli_fetch_assoc($buyer_id_result);
    $buyer_id = $buyer_id_row['buyer_id'];

    // Fetch order details for the specific buyer
    $order_query = "SELECT o.*, p.name AS name, p.photo AS photo, s.first_name AS first_name, 
                s.last_name AS last_name, by.address AS address, by.state AS state, by.pin_code AS pin_code
                FROM order_details o
                INNER JOIN buyer_details `by` ON o.buyer_id = `by`.buyer_id
                INNER JOIN product_details p ON o.product_id = p.product_id
                INNER JOIN seller_details s ON o.seller_id = s.seller_id
                WHERE o.buyer_id = '$buyer_id'";

    $order_result = mysqli_query($conn, $order_query);
    $cartcount= "SELECT COUNT(*) AS product_count FROM cart_details WHERE buyer_id = $buyer_id";
    $result_count = $conn->query($cartcount);

// Check if the query executed successfully
    if ($result_count) {
    // Fetch the result
    $row = $result_count->fetch_assoc();
    }
}

function generateAndDownloadInvoice($order_id) {
    
    header("Content-Type: application/pdf");
    header("Content-Disposition: attachment; filename='invoice.pdf'");

    
    echo "Sample PDF content for order ID: $order_id";
    exit; 
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
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
                    <li  class="module"><a href="index.php">Home</a></li>
                    <li class="module"><a href="product.php">Products</a></li>
                    <li class="module"><a href="shop.php">Shop</a></li>
                    <li  class="module"><a href="about.php">About</a></li>
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
    <section id="page-hadder" class="contct-hadder">
        <h2>Order's Page</h2>
        <p>View your order details</p>
    </section>
        
    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Images</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Tools</td>
                    <td>Invoice</td>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($order_row = mysqli_fetch_assoc($order_result)) {
                ?>
                <tr>
                    <td><?php echo $order_row['name']; ?></td>
                    <td><?php $image = empty($order_row['photo']) ? '../images/profile.jpg' : '../images/' . $order_row['photo'];
                            echo "<img src='$image'>";
                        ?>
                    </td>
                    <td>₹<?php echo $order_row['price']; ?></td>
                    <td><?php echo $order_row['quantity']; ?></td>
                    <td>
                        <button onclick="openPopup(<?php echo $order_row['order_id']; ?>)"><i class="fa-solid fa-magnifying-glass"></i> Views</button>
                        <div class="overlay" id="overlay_<?php echo $order_row['order_id']; ?>">
                            <div class="popup">
                            <span class="close-btn" onclick="closePopup(<?php echo $order_row['order_id']; ?>)">×</span>

                                <h2>Order Details</h2><br>
                                <form class="scrollable-form">
                                    <div class="details"><b>Name : </b><?php echo $order_row['name']; ?></div><br>
                                    <div class="details"><?php $image = empty($order_row['photo']) ? '../images/profile.jpg' : '../images/' . $order_row['photo'];
                                                            echo "<img src='$image'>";
                                                        ?>
                                    </div><br>
                                    <div class="details"><b>Price : </b> ₹<?php echo $order_row['price']; ?></div>
                                    <div class="details"><b>Quantity : </b><?php echo $order_row['quantity']; ?></div>
                                    <div class="details"><b>Order Date : </b><?php echo $order_row['order_date']; ?></div>
                                    <div class="details"><b>Delivery Address : </b><?php echo $order_row['address']; ?></div>
                                    <div class="details"><b>State : </b><?php echo $order_row['state']; ?></div>
                                    <div class="details"><b>Pin code : </b><?php echo $order_row['pin_code']; ?></div>
                                    <div class="details"><b>Payment Type : </b><?php if($order_row['payment'] == 0){echo "cash";}else{echo "online";} ?></div>
                                    <div class="details"><b>Shipping Charges : </b><?php if($order_row['price'] < 150){echo "20";}else{echo"Free";} ?></div>
                                    <?php
                                        $totalPrice = $order_row['price'] * $order_row['quantity'];
                                        if ($totalPrice < 150) {
                                            $totalPrice += 20; // Add shipping charge if applicable
                                        }
                                    ?>
                                    <div class="details"><b>Total Amount : </b> ₹<?php echo $totalPrice; ?></div>
                                    <div class="details"><b>Status : </b><?php if($order_row['status'] == 0){echo "Pending";}else{ echo "Shipped";} ?></div>
                                    <div class="details"><b>Tracking Id : </b><?php echo $order_row['tracking_no']; ?></div>
                                    <div class="details"><b>Seller Name : </b><?php echo $order_row['first_name'] . ' ' . $order_row['last_name']; ?></div><br>
                                    <div class="details_button"><button class="hello">Invoice</button></div>
                                </form>
                            </div>
                        </div>
                        
                    </td>
                    <td><button class="hello" onclick="downloadInvoice(<?php echo $order_row['order_id']; ?>)">Download</button></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </section>

    <script>
    function openPopup(orderId) {
        document.getElementById("overlay_" + orderId).style.display = "flex";
    }

    function closePopup(orderId) {
        document.getElementById("overlay_" + orderId).style.display = "none";
    }
    </script>
    <script>
        function downloadInvoice(orderId) {
            // Invoke PHP script to generate and download PDF invoice
            window.location.href = "../pdf_makker/generatePDF.php?order_id=" + orderId;
        }
    </script>


    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
<?php
include ("footer.php");
?>
</html>
