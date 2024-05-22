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
        <title>Contact Us</title>
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
            <li class="module"><a href="index.php">Home</a></li>
                    <li class="module"><a href="product.php">Products</a></li>
                    <li class="module"><a href="shop.php">Shop</a></li>
                    <li  class="module"><a href="about.php">About</a></li>
                    <li class="module"><a class="active" href="contact.php">Contact</a></li>
                    <li class="icon">
                        <div class="cart">
                            <a href="cart.php"><ion-icon name="cart-outline"></ion-icon></a>
                            <?php if($row['product_count'] > 0): ?>
                        <sup><?php echo $row['product_count'];?></sup>
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
            <h2>Let's_talk</h2>
            <p>Leave A Message, We Will Love To Hear From You</p>
        </section>

        <section id="contact-details" class="section-p1">
            <div class="detalis">
                <span>GET IN TOUCH</span>
                <h2>Visit our agency location or contact us today</h2>
                <h3>Head Office</h3>
                <div>
                    <li>
                        <ion-icon name="map-outline"></ion-icon>
                        <p>50, Sachin Park Society, <br>
                           Jodhpur Gam Road Satellite Ahmedabad, Gujarat 380015</p>
                    </li>
                    <li>
                        <ion-icon name="mail-open-outline"></ion-icon>
                        <p>agricart007@gmail.com</p>
                    </li>
                    <li>
                        <ion-icon name="call-outline"></ion-icon>
                        <p>+91 89800 72388</p>
                    </li>
                    <li>
                        <ion-icon name="time-outline"></ion-icon>
                        <p>Monday to Saturday: 9:00am to 7:00pm</p>
                    </li>
                </div>
            </div>
            <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3672.126994400442!2d72.52402557479734!3d23.019108916458432!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e84d1630e9e71%3A0x37c4234cd826b1aa!2sSachin%20Park%20Society!5e0!3m2!1sen!2sin!4v1709014182028!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </section>

        <section id="form-detail">
            <form action="action_contact.php" method="POST">
                <span>LEAVE A MESSAGE</span>
                <h2>We love to hear from you</h2>
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="text" name="email" placeholder="E-mail" required>
                <!-- <input type="text" placeholder="Subject" required> -->
                <textarea name="message" id="" cols="30" rows="10" placeholder="Your Message" required></textarea>
                <button class="normal">Submit</button><br><br>
                
            </form>    
        </section>

        <center><h2 class="our_team">Meat Our Developers</h2></center><br><br>
        <section id="meat_our_member">
        <div class="people">
                <div>
                    <img src="../images/image.jpg">
                    <p><span>Shlok Patel</span>Project Leader<br> Back-end Developer <br>Phone: +91 89800 72388<br>Email: agricart007@gmail.com</p>
                </div>
                <div>
                    <img src="../images/punya.jpg">
                    <p><span>Punya Patel</span>Back-end Developer<br>Phone: +91 93276 62196<br>Email: agricart007@gmail.com</p>
                </div>
                <div>
                    <img src="../images/shreyansh.jpg">
                    <p><span>Shreyansh Patel</span>Back-end Developer<br>Phone: +91 94295 24035<br>Email: agricart007@gmail.com</p>
                </div><br><br>
            </div>
            <div class="people">
                <div>
                    <img src="../images/vraj.png">
                    <p><span>Vraj Patel</span>Web Designer <br>Phone: +91 98988 66307<br>Email: agricart007@gmail.com</p>
                </div>
                <div>
                    <img src="../images/manthan.jpg">
                    <p><span>Manthan Patel</span>Web Designer<br>Phone: +91 70416 23443<br>Email: agricart007@gmail.com</p>
                </div>
                <div>
                    <img src="../images/nand.png">
                    <p><span>Nand Patel</span>Web Designer<br>Phone: +91 99985 58383<br>Email: agricart007@gmail.com</p>
                </div><br><br>
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