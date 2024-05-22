<?php 
include ("../session/session_start.php");
include("../session/session_check.php");
include("../database/connection.php");
// query for tatal order
$orderQuery = "SELECT COUNT(*) AS totalOrders FROM order_details";
$orderResult = mysqli_query($conn, $orderQuery);
$orderData = mysqli_fetch_assoc($orderResult);
$totalOrders = $orderData['totalOrders'];

// query for total buyers
$userQuery = "SELECT COUNT(*) AS totalBuyers FROM buyer_details";
$userResult = mysqli_query($conn, $userQuery);
$userData = mysqli_fetch_assoc($userResult);
$totalBuyers = $userData['totalBuyers'];

// query for total sellers
$userQuery = "SELECT COUNT(*) AS totalSeller FROM seller_details";
$userResult = mysqli_query($conn, $userQuery);
$userData = mysqli_fetch_assoc($userResult);
$totalSeller = $userData['totalSeller'];

// query for total products
$userQuery = "SELECT COUNT(*) AS totalProduct FROM product_details";
$userResult = mysqli_query($conn, $userQuery);
$userData = mysqli_fetch_assoc($userResult);
$totalProduct = $userData['totalProduct'];

// Calculate total income
$incomeQuery = "SELECT SUM(price) AS totalIncome FROM order_details";
$incomeResult = mysqli_query($conn, $incomeQuery);
$incomeData = mysqli_fetch_assoc($incomeResult);
$totalIncome = $incomeData['totalIncome'];

// Calculate total income for each month
$incomeQuery = "SELECT DATE_FORMAT(od.order_date, '%b %Y') AS month_year, SUM(od.price * od.quantity) AS monthlyIncome
                FROM order_details od
                GROUP BY DATE_FORMAT(od.order_date, '%Y-%m')
                ORDER BY od.order_date";$incomeResult = mysqli_query($conn, $incomeQuery);

// Initialize arrays to store month labels and corresponding income values
$months = [];
$incomeData = [];

// Fetch data and populate arrays
while ($row = mysqli_fetch_assoc($incomeResult)) {
    $months[] = $row['month_year'];
    $incomeData[] = $row['monthlyIncome'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dasboard</title>
    <link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>
   
<?php include ("navbar.php");
    ?>
    <div class="main-content">
        <header>
            <div class="header-title-wrapper">
                
                <div class="header-title">
                    <h1>
                        Dashboard
                    </h1>
                    <p>
                        Display Analytics About Website <span class="las la-chart-lin"></span>
                    </p>
                </div>
                
            </div>

        </header>

        <main>

            <section>
                <h3 class="section-head">Overview</h3>
                <div class="analytics">
                    <div class="analytic">
                    <i class="fa-solid fa-cart-shopping"></i>
                        <div class="analytic-info">
                            <h4>Sales</h4>
                            <h1><?php echo $totalOrders; ?></h1>
                        </div>
                    </div>
                    <div class="analytic">
                    <i class="fa-solid fa-users"></i>
                        <div class="analytic-info">
                            <h4>Buyer</h4>
                            <h1><?php echo $totalBuyers; ?></h1>
                        </div>
                    </div>
                    <div class="analytic">
                    <i class="fa-solid fa-users"></i>
                        <div class="analytic-info">
                            <h4>Seller</h4>
                            <h1><?php echo $totalSeller; ?></h1>
                        </div>
                    </div>
                    <div class="analytic">
                    <i class="fa-solid fa-barcode"></i>
                        <div class="analytic-info">
                            <h4>Products</h4>
                            <h1><?php echo $totalProduct; ?></h1>
                        </div>
                    </div>
                    
                    
                </div>
    
            </section>

            
            <section>

                <div class="block-grid">
                    <div class="revenue-card">
                        <h3 class="section-head">Total Revenue</h3>
                       <div class="rev-content">
                        <img src="../images/adminrevenue.jpeg"  alt="">
                        <div class="rev-info">
                            <h3>
                                Admin
                            </h3>
                            <h1><?php echo $totalBuyers; ?> <small> Buyers</small></h1>
                        </div>
                        <div class="rev-sum">
                            <h4>Total Income</h4>
                            <h2>₹<?php echo number_format($totalIncome, 2); ?></h2>
                        </div>
                       </div>
                    </div>

                    <div class="graph-card">
                        <h3 class="section-head">Graph</h3>
                        
                        <div class="graph-content">
                            
                            <div class="graph-board" id="d">
                                <button onclick="downloadGraph()"><i class="fa-solid fa-file-export"></i></button>
                                <canvas id="revenueChart" weight="100%" height="50px"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </section>

        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        let ctx = document.querySelector("#revenueChart");
        ctx.height = 150;

        let revChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [
                    {
                        label: "Monthly Income",
                        borderColor: "green",
                        borderWidth: "3",
                        backgroundColor: "rgba(235, 247, 245, 0.7)",
                        data: <?php echo json_encode($incomeData); ?>
                    },
                ]
            },
            options: {
                responsive: true,
                tooltips: {
                    intersect: false,
                    node: "index",
                }
            }
        });
       
    function downloadGraph() {
        // Convert the canvas to a data URL
        var dataURL = revChart.toBase64Image();

        // Create a temporary link element
        var link = document.createElement("a");

        // Set the link's href attribute to the data URL
        link.href = dataURL;

        // Set the download attribute with the desired file name
        link.download = "revenue_chart.png";

        // Append the link to the document
        document.body.appendChild(link);

        // Trigger a click event on the link to start the download
        link.click();

        // Remove the link from the document
        document.body.removeChild(link);
    }
</script>

    </script>
</body>
</html>