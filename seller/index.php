<?php
include("../session/session_start.php");
include("../session/session_check.php");
include("../database/connection.php");

// Fetch seller's username from session
$seller_username = $_SESSION['username'];

// Query to fetch seller ID using the username
$seller_id_query = "SELECT seller_id FROM seller_details WHERE email = '$seller_username'";
$seller_id_result = mysqli_query($conn, $seller_id_query);
$seller_id_row = mysqli_fetch_assoc($seller_id_result);
$seller_id = $seller_id_row['seller_id'];

// Query to fetch total sales
$total_sales_query = "SELECT SUM(price * quantity) AS total_sales FROM order_details WHERE seller_id = '$seller_id'";
$total_sales_result = mysqli_query($conn, $total_sales_query);
$total_sales_row = mysqli_fetch_assoc($total_sales_result);
$total_sales = $total_sales_row['total_sales'];

// Query to fetch total orders
$total_orders_query = "SELECT COUNT(*) AS total_orders FROM order_details WHERE seller_id = '$seller_id'";
$total_orders_result = mysqli_query($conn, $total_orders_query);
$total_orders_row = mysqli_fetch_assoc($total_orders_result);
$total_orders = $total_orders_row['total_orders'];

// Query to fetch total products
$total_products_query = "SELECT COUNT(*) AS total_products FROM product_details WHERE seller_id = '$seller_id'";
$total_products_result = mysqli_query($conn, $total_products_query);
$total_products_row = mysqli_fetch_assoc($total_products_result);
$total_products = $total_products_row['total_products'];

// Query to fetch top 5 selling products
$sql = "SELECT pd.name, 
               SUM(od.quantity) AS total_sold, 
               SUM(od.quantity * od.price) AS total_revenue
        FROM order_details od
        INNER JOIN product_details pd ON od.product_id = pd.product_id
        WHERE pd.seller_id = '$seller_id'
        GROUP BY od.product_id
        ORDER BY total_sold DESC
        LIMIT 5";

$result = $conn->query($sql);

$sql = "SELECT photo FROM seller_details WHERE seller_id = '$seller_id'";
$result_img = mysqli_query($conn, $sql);

if (mysqli_num_rows($result_img) > 0) {
    // Fetch photo path
    $row = mysqli_fetch_assoc($result_img);
}

?>

<!DOCTYPE HTML>
<html>

<head>
    <title>Dashboard</title>
    <link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <?php
    include("navigation.php");
    ?>


    </div>
    <div id="main">

        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: #000e04;" class="nav"><i
                        class="fa-solid fa-bars"></i> Dashboard</span>
                <span style="font-size:30px;cursor:pointer; color: rgb(0, 0, 0);" class="nav2"><i
                        class="fa-solid fa-bars"></i> Dashboard</span>
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
                <p><?php echo $total_orders; ?><br /><span>Order</span></p>
                <i class="fa fa-list box-icon"></i>
            </div>
        </div>
        <div class="col-div-3">
            <div class="box">
                <p><?php echo $total_products; ?><br /><span>Product</span></p>
                <i class="fa fa-tasks box-icon"></i>
            </div>
        </div>
        <div class="clearfix"></div>
        <br /><br />
        <div class="col-div-8-dash">
            <div class="box-8">
                <div class="content">
                    <p>Top selling products of the month</p>
                    <br />
                    <table>
        <tr>
            <th>Product Name</th>
            <th>Total Quantity Sold</th>
            <th>Total Revenue</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row using a while loop
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["total_sold"] . "</td>
                        <td>" . $row["total_revenue"] . "</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No results found</td></tr>";
        }
        ?>
    </table>
                </div>
            </div>
        </div>

        <!-- <div class="col-div-4">
            <div class="box-4">
                <div class="content">
                    <p>Total Sale</p>
                    <div class="circle-wrap">
                        <div class="circle">
                            <div class="mask full">
                                <div class="fill"></div>
                            </div>
                            <div class="mask half">
                                <div class="fill"></div>
                            </div>
                            <div class="inside-circle"> 10% </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

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
