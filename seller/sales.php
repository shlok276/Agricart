<?php
include("../session/session_start.php");
include("../session/session_check.php");
include("../database/connection.php");

// Fetch seller ID for the specific user from the database
$seller_username = $_SESSION['username'];
$seller_id_query = "SELECT seller_id FROM seller_details WHERE email = '$seller_username'";
$seller_id_result = mysqli_query($conn, $seller_id_query);
if (!$seller_id_result) {
    die("Error: " . mysqli_error($conn)); // Add error handling
}
$seller_id_row = mysqli_fetch_assoc($seller_id_result);
$seller_id = $seller_id_row['seller_id'];

$total_sales_query = "SELECT SUM(price * quantity) AS total_sales FROM order_details WHERE seller_id = '$seller_id'";
$total_sales_result = mysqli_query($conn, $total_sales_query);
$total_sales_row = mysqli_fetch_assoc($total_sales_result);
$total_sales = $total_sales_row['total_sales'];

// Query to fetch total orders
$total_orders_query = "SELECT COUNT(*) AS total_orders FROM order_details WHERE seller_id = '$seller_id'";
$total_orders_result = mysqli_query($conn, $total_orders_query);
if (!$total_orders_result) {
    die("Error: " . mysqli_error($conn)); // Add error handling
}
$total_orders_row = mysqli_fetch_assoc($total_orders_result);
$total_orders = $total_orders_row['total_orders'];

$order_query = "SELECT od.quantity, od.price, od.quantity * od.price AS total, pd.name AS product_name, bd.full_name AS buyer_name
                FROM order_details od
                INNER JOIN product_details pd ON od.product_id = pd.product_id
                INNER JOIN buyer_details bd ON od.buyer_id = bd.buyer_id
                WHERE od.seller_id = '$seller_id'";
$order_result = mysqli_query($conn, $order_query);
if (!$order_result) {
    die("Error: " . mysqli_error($conn)); // Add error handling
}
// echo $order_query;

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
    <title>Sales</title>
    <link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
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
                        class="fa-solid fa-bars"></i> Sales</span>
                <span style="font-size:30px;cursor:pointer; color: rgb(0, 0, 0);" class="nav2"><i
                        class="fa-solid fa-bars"></i> Sales</span> <!-- Corrected typo -->
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
        <div class="col-div-3">
            <div class="box">
                <p><?php echo ($total_sales !== null) ? $total_sales : '0'; ?><br /><span>Total Sales</span></p>
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
        </div>

        <div class="col-div-3">
            <div class="box">
                <p><?php echo $total_orders; ?><br /><span>Orders</span></p> <!-- Corrected label -->
                <i class="fa fa-list box-icon"></i>
            </div>
        </div>

        <div class="clearfix"></div>
        <br /><br />
        <div class="col-div-8">
            <div class="box-8">
                <div class="content">
                    <h1>Total Sales</h1> <!-- Moved h1 tag outside of the p tag -->
                    <br />
                    <table>
                        <tr>
                            <th>SR. no</th>
                            <th>Product Name</th>
                            <th>Buyer Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                        </tr>
                        <?php
                        $sr_no = 1;
                        while ($row = mysqli_fetch_assoc($order_result)) {?>
                            <tr>
                            <td><?php echo $sr_no++; ?></td>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['buyer_name']; ?></td>
                            <td><?php echo $row['quantity']; ?></td>
                            <td><?php echo $row['price']; ?></td>
                            <td><?php echo $row['total']; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
