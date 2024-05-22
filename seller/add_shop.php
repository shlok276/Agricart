<?php
include("../session/session_start.php");
include("../session/session_check.php");
include("../database/connection.php");

$seller_username = $_SESSION['username'];
$seller_id_query = "SELECT seller_id FROM seller_details WHERE email = '$seller_username'";
$seller_id_result = mysqli_query($conn, $seller_id_query);
$seller_id_row = mysqli_fetch_assoc($seller_id_result);
$seller_id = $seller_id_row['seller_id'];

$sql = "SELECT photo FROM seller_details WHERE seller_id = '$seller_id'";
$result_img = mysqli_query($conn, $sql);

if (mysqli_num_rows($result_img) > 0) {
    // Fetch photo path
    $row = mysqli_fetch_assoc($result_img);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add shop</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
</head>
<body>
    <?php include("navigation.php"); ?>

    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: #000e04;" class="nav"><i
                        class="fa-solid fa-bars"></i> Add Shop</span>
                <span style="font-size:30px;cursor:pointer; color: rgb(0, 0, 0);" class="nav2"><i
                        class="fa-solid fa-bars"></i> Add Shop</span> <!-- Corrected typo -->
            </div>
            <div class="col-div-6">
            <div class="profile">
                <?php
                    $image = empty($row['photo']) ? '../images/profile.jpg' : '../images/' . $row['photo'];
                    echo "<td><img src='$image' class='pro-img'></td>";
                ?>
                    <!-- <img src="images/user.png" class="pro-img" /> -->
                    <p><?php echo $seller_username; ?></p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

        <div class="clearfix"></div>
        <br />
        <div class="clearfix"></div>
        <br /><br />
        <div class="col-div-8">
            <div class="box-8">
                <div class="content">
                    <h1>Shop Details</h1>
                    <br />
                    <form action="add_shop_process.php" method="POST" enctype="multipart/form-data">
                        <div class="product-details">
                        <label for="shop_name">Shop Name:</label><br>
                        <input type="text" id="shop_name" name="shop_name" required><br>
                        
                        <label for="description">Shop address:</label><br>
                        <textarea id="description" name="description" required></textarea><br>
                        
                        <label for="shop_city">Shop city:</label><br>
                        <input type="text" id="shop_city" name="shop_city" required><br>
                        
                        <label for="shop_email">Shop E-mail:</label><br>
                        <input type="email" id="shop_email" name="shop_email" required><br>
                        
                        <label for="contact_number">Contact Number:</label><br>
                        <input type="number" id="contact_number" name="contact_number" required><br>
                        
                        <label for="shop_timing">Shop Timing:</label><br>
                        <input type="text" id="shop_timing" name="shop_timing" required><br>
                        (eg: Monday-Friday 8:30AM To 7:00PM)
                        <br>
                        <br>
                        
                        <label for="contact_person">Contact Person:</label><br>
                        <input type="text" id="contact_person" name="contact_person" required><br>
                        
                        <label for="location_link">Shop Location link:</label><br>
                        <input type="text" id="location_link" name="location_link" required><br>
                        
                        <label for="image1">Upload Shop Image:</label><br>
                        <input type="file" id="image1" name="image1" required><br>

                            <div class="submit">
                                <input type="submit" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
    window.onload = function() {
        <?php
        if(isset($_GET['alert'])) {
            $alert_message = '';
            switch($_GET['alert']) {
                case 'Shop Details INserted Successfully':
                    $alert_message = 'Shop Details Inserted Successfully!';
                    break;
                case 'error':
                    $alert_message = 'Error while inserting data!';
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
    <script>
        $(".nav").click(function () {
            $("#mySidenav").css('width', '70px');
            $("#main").css('margin-left', '70px');
            $(".logo").css('visibility', 'visible');
            $(".logo span").css('visibility', 'visible');
            $(".logo span").css('margin-left', '-10px');
            $(".icon-a").css('visibility', 'visible');
            $(".icons").css('visibility', 'visible');
            $(".icons").css('margin-left', '-8px');
            $(".nav").css('display', 'none');
            $(".nav2").css('display', 'block');
            $(".img").css('width', '60px');
            $(".img").css('height', '45px');
            $(".white").css('color', 'white');
        });

        $(".nav2").click(function () {
            $("#mySidenav").css('width', '300px');
            $("#main").css('margin-left', '300px');
            $(".logo").css('visibility', 'visible');
            $(".icon-a").css('visibility', 'visible');
            $(".icons").css('visibility', 'visible');
            $(".nav").css('display', 'block');
            $(".nav2").css('display', 'none');
            $(".img").css('width', '160px');
            $(".img").css('height', '110px');
            $(".white").css('color', '#818181');
        });
    </script>
</body>
</html>
