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
        <title>About Us</title>
        <link rel="stylesheet" href="home.css">
        <link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1 , shrink-to-fit=no">
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
                    <li class="module"><a href="product.php">Products</a></li>
                    <li class="module"><a href="shop.php">Shop</a></li>
                    <li  class="module"><a class="active" href="about.php">About</a></li>
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
            <h2>About Us</h2>
            <p>Learn Few Things About Us</p>
        </section>
        
        <section id="contact-details" class="section-p1">
            <div class="detalis">
                <h2>About Our Website</h2>
                <p>Welcome to Agricart,<br> 
                    where we celebrate the dedication and hard work<br>
                    of our farming community. As stewards of the land,<br>
                    farmers play a crucial role in feeding the world,<br>
                    and we are honored to support them through our online platform.
                </p>   
            </div>
            <div class="map">
                <img src="../images/xyz3.avif">
            </div>
        </section>

        <section id="contact-details" class="section-p1">
            <div class="map">
                <img src="../images/useless.jpg">
            </div>
            <div class="detalis">
                <p>At Agricart,<br>
                we understandthe unique challenges that farmers<br>
                    face, from unpredictable weather conditions to<br>
                    market fluctuations. Our mission is to empower farmers<br>
                    by providing them with a convenient and efficient way<br>
                    to access the tools, supplies, and resources they need to thrive.
                </p>   
            </div>
        </section>

        <br><center><h1 class="why">Why choose AgriCart ?</h1></center><br><br><br>

       <section id="why">
        <div class="text">
            <h2>Agricultural Expertise:</h2><br>
            <p>Our team consists of individuals with a deep<br>
                understandingof agriculture. We are committed<br>
                to curating a selection ofproducts that meet the<br>
                specific needs of farmers, whetherthey are seasoned<br>
                professionals or just starting theirjourney in<br>
                agriculture.
           </p>
        </div>

        <div class="img">
            <img src="../images/useless4.jpg">
        </div>

        <div class="img">
            <img src="../images/useless2.avif">
        </div>

        <div class="text">
            <h2>Wide Range of Products:</h2><br>
            <p>Explore our comprehensive range of products,<br>
                from high-quality seeds and fertilizers to<br>
                cutting-edge agricultural machinery. We partner<br>
                with trusted suppliers to ensure that farmers have<br>
                access to the latest innovations and time-tested <br>
                essentials.
           </p>
        </div>

        <div class="text">
            <h2>Convenient Online Shopping:</h2><br>
            <p>We understand that farmers have demanding schedules.<br>
                Our user-friendly website allows you to browse and<br>
                shop at your convenience, eliminating the need for<br>
                ime-consuming trips to physical stores. Order from the<br>
                comfort of your home or field, and have your supplies<br>
                delivered right to your doorstep.
           </p>
        </div>

        <div class="img">
            <img src="../images/useless3.jpg">
        </div>

        <div class="img">
            <img src="../images/useless5.jpg">
        </div>

        <div class="text">
            <h2>Customer Care:
            </h2><br>
            <p>Our dedicated customer support team is here to assist you<br>
                at every step. Whether you have questions about a<br>
                product, need help with an order, or simply want advice<br>
                on improving your farming practices, we are just a<br>
                message or call away.
            </p>
        </div>
        
       </section>


       


        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    </body>
    <?php
        // include("newsletter.php");
        include ("footer.php");
    ?>
</html>