<?php
include("../database/connection.php");
include("../session/session_start.php");
include("../session/session_check.php");

if(isset($_GET['logout'])) {
    // Unset all of the session variables.
    $_SESSION = array();

    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Finally, destroy the session.
    session_destroy();

    // Redirect to the logout page with a delay
    echo '<script>
            setTimeout(function() {
                window.location.href = "../login/logout.php";
            }, 1000); // 1000 milliseconds = 1 second
          </script>';
    exit();
}

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $buyer_id_query = "SELECT buyer_id FROM buyer_details WHERE email = '$username'";
    $buyer_id_result = mysqli_query($conn, $buyer_id_query);
    $buyer_id_row = mysqli_fetch_assoc($buyer_id_result);
    $buyer_id = $buyer_id_row['buyer_id'];
    // echo $buyer_id;

    $query = "SELECT * FROM buyer_details where buyer_id = '$buyer_id' "; // Ordering randomly and limiting to 6 products
    $result = mysqli_query($conn, $query);
    $buyer_details = mysqli_fetch_assoc($result);

    $cartcount= "SELECT COUNT(*) AS product_count FROM cart_details WHERE buyer_id = $buyer_id";
    $result_count = $conn->query($cartcount);

// Check if the query executed successfully
    if ($result_count) {
    // Fetch the result
    $row = $result_count->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Details</title>
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

<section id="profile">
    <div class="profile-1">
        <center>
                <?php 
                $image = empty($row['photo']) ? '../images/adminfarmerlogo.png' : '../images/' . $row['photo'];
                ?>
                <img src="<?php echo $image; ?>" alt=""><br><br>
                 <h2> <?php echo $buyer_details['full_name']; ?> </h2>
                 <span><?php echo $buyer_details['email']; ?> </span><br>
        </center>
    </div>
    
    <div class="profile-2">
        <form action="update_profile.php" method="post">
            <!-- Display Profile Data Here -->
            <center><h3>Profile Settings</h3></center>
            <div class="name">
                Full Name<br>
                <input type="text" name="first_name" value="<?php echo $buyer_details['full_name']; ?>">
            </div>
            <div class="name">
                Phone Number<br>
                <input type="text" name="contact_no" value="<?php echo $buyer_details['contact_no']; ?>">
            </div>
            <div class="name">
                Email<br>
                <input type="text" name="email" value="<?php echo $buyer_details['email']; ?>" readonly>
            </div>
            <div class="name">
                Address<br>
                <textarea name="address"><?php echo $buyer_details['address']; ?></textarea>
            </div>
            <div class="name">
                Pin code<br>
                <input type="number" name="pin_code" value="<?php echo $buyer_details['pin_code']; ?>" >
            </div>
            <div class="name">
                State/Region<br>
                <select id="stateRegionSelect" name="state">
                    <option value="">Select State/Region</option>
                    <?php
                        // Array of Indian states
                        $indianStates = array("Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jharkhand", "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal");

                        // Loop through the array to populate options
                        foreach ($indianStates as $state) {
                            $selected = ($state == $buyer_details['state']) ? 'selected' : '';
                            echo "<option value='$state' $selected>$state</option>";
                        }
                    ?>
                </select>
            </div>
            <center><button class="profile-button" type="submit" name="save_profile">Save Changes</button></center>
        </form>
    </div>
    
    <div class="profile-3">
        <form action="update_password.php" method="post">
            <!-- Password Change Form -->
            <center><h3>Change Password</h3></center>
            <div class="name">
                Current Password<br>
                <input type="password" name="current_password">
            </div>
            <div class="name">
                New Password<br>
                <input type="password" name="new_password">
            </div>
            <div class="name">
                Confirm Password<br>
                <input type="password" name="confirm_password">
            </div>
            <center><button class="profile-button" type="submit" name="save_password">Save Changes</button></center>
        </form>
    </div>
                    
</section>


<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script>
    window.onload = function() {
        <?php
        if(isset($_GET['alert'])) {
            $alert_message = '';
            switch($_GET['alert']) {
                case 'profile_update':
                    $alert_message = 'Profile updated succeddfully!';
                    break;
                case 'password_changed_successfully':
                    $alert_message = 'Password changed successfully!';
                    break;
                case 'update_error':
                    $alert_message = 'Error occurred while updating password!';
                    break;
                case 'password_mismatch':
                    $alert_message = 'New password and confirm password do not match!';
                    break;
                case 'incorrect_current_password':
                    $alert_message = 'Current password is incorrect!';
                    break;
                default:
                    $alert_message = '';
                    break;
            }
            if($alert_message) {
                echo 'alert("' . $alert_message . '");';
            }
        }
        ?>
    };
</script>
<?php
include ("footer.php");
?>
</body>
</html>
