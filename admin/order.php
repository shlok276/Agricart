<?php 
include ("../database/connection.php");
include ("../session/session_start.php");
include("../session/session_check.php");

// query to take data from database in popup menu and table
// Modify your SQL query to fetch details of all orders without any specific conditions
$query = "SELECT o.order_id, o.order_no, p.name AS product_name, bd.full_name AS buyer_name, 
          sd.first_name AS seller_name, o.payment, o.price, o.quantity, o.status, o.order_date, o.tracking_no
          FROM order_details o 
          JOIN product_details p ON o.product_id = p.product_id 
          JOIN buyer_details bd ON o.buyer_id = bd.buyer_id 
          JOIN seller_details sd ON o.seller_id = sd.seller_id";
$result = mysqli_query($conn, $query);


// query for tatal order
$orderQuery = "SELECT COUNT(*) AS totalOrders FROM order_details";
$orderResult = mysqli_query($conn, $orderQuery);
$orderData = mysqli_fetch_assoc($orderResult);
$totalOrders = $orderData['totalOrders'];

// Calculate total income
$incomeQuery = "SELECT SUM(price) AS totalIncome FROM order_details";
$incomeResult = mysqli_query($conn, $incomeQuery);
$incomeData = mysqli_fetch_assoc($incomeResult);
$totalIncome = $incomeData['totalIncome'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="admin.css">
</head>

<body>
    <?php include ("navbar.php"); ?>

    <div class="main-content">
        <header>
            <div class="header-title-wrapper">
                <div class="header-title">
                    <h1>Orders</h1>
                    <p>Display Information About Website Orders<span class="las la-chart-lin"></span></p>
                </div>
            </div>
        </header>

        <main>
            <section>
                <h3 class="section-head">Overview</h3>
                <div class="analytics">
                    <div class="analytic">
                        <div class="analytic-icon">
                            <span class="las la-eye"></span>
                        </div>
                        <div class="analytic-info">
                            <h4>Today Sales</h4>
                            <h1>₹<?php echo number_format($totalIncome, 2); ?></h1>
                        </div>
                    </div>
                    <div class="analytic">
                        <div class="analytic-icon">
                            <span class="las la-store"></span>
                        </div>
                        <div class="analytic-info">
                            <h4>Orders</h4>
                            <h1><?php echo $totalOrders; ?></h1>
                        </div>
                    </div>
                </div>
            </section>

            <div class="table-data">
                <div class="order">
                <div class="head">
                <h3>Total Order</h3>
                <form id="download">
                    <button class="d" onclick="downloadCSV()"><i class="fa-solid fa-file-export"></i></button>
                 </form>
            </div>
                    <div class="table-data">
                        <div class="order">
                            <table id="table">
                                <thead>
                                    <tr>
                                        <th>Order_no</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Payment</th>
                                        <th>Order Status</th>
                                        <th>Tools</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)){
                                    ?>
                                            <tr>
                                                <td><?php echo $row['order_no'];?></td>
                                                <td><?php echo $row['product_name'];?></td>
                                                <td><?php echo $row['price'];?></td>
                                                <?php if($row['payment'] == 0){?>
                                                    <td>Cash</td><?php
                                                }else{
                                                    ?><td>Online</td><?php
                                                }?>
                                                <?php if($row['status'] == 0){?>
                                                    <td>Pending</td><?php
                                                }else{
                                                    ?><td>shipped</td><?php
                                                }?>
                                                <td>
                                                    <button class="a" onclick="openPopup(<?php echo $row['order_id']; ?>)"><i class="fa-solid fa-magnifying-glass"></i> Views</button>
                                                    <div class="overlay" id="overlay_<?php echo $row['order_id']; ?>">
                                                        <div class="popup">
                                                            <span class="close-btn" onclick="closePopup(<?php echo $row['order_id']; ?>)">×</span>
                                                            <h2>Order Details</h2>
                                                            <form>
                                                            <div style="max-height: 400px; overflow-y: auto;">
                                                                <table>
                                                                    <tr>
                                                                        <td>Order Number</td>
                                                                        <td>
                                                                            <div id="orderIdDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['order_id']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Tracking Number</td>
                                                                        <td>
                                                                            <div id="orderIdDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['tracking_no']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Product Name</td>
                                                                        <td>
                                                                            <div id="productNameDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['product_name']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Buyer Name</td>
                                                                        <td>
                                                                            <div id="buyerNameDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['buyer_name']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Seller Name</td>
                                                                        <td>
                                                                            <div id="sellerNameDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['seller_name']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Price</td>
                                                                        <td>
                                                                            <div id="priceDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['price']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Payment</td>
                                                                        <td>
                                                                            <div id="paymnetDisplay" >
                                                                                <?php if($row['payment'] == 0): ?>
                                                                                    <input type="text" value="Cash" readonly>
                                                                                <?php else: ?>
                                                                                    <input type="text" value="Online" readonly>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Order Status</td>
                                                                        <td>
                                                                            <div id="orderstatusDisplay">
                                                                                <?php if($row['status'] == 0): ?>
                                                                                    <input type="text" value="Pending" readonly>
                                                                                <?php else: ?>
                                                                                    <input type="text" value="Shipped" readonly>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td>Order Date</td>
                                                                        <td>
                                                                            <div id="orderDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['order_date']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    
                                                                </table>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                        } else {?>
                                            <tr>
                                                <td colspan="6">
                                                    <p class='no-data-found'>No order data found.</p>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                       ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function openPopup(orderId) {
            document.getElementById("overlay_" + orderId).style.display = "flex";
        }

        function closePopup(orderId) {
            document.getElementById("overlay_" + orderId).style.display = "none";
        }
        function downloadCSV() {
    // Open a new window or iframe to trigger the download
    var downloadWindow = window.open('fetch_details/fetch_order_details.php', '_blank');
    downloadWindow.focus();
}



    </script>
    
</body>

</html>