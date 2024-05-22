<?php 
include ("../database/connection.php");
include ("../session/session_start.php");
include("../session/session_check.php");
$query = "SELECT product_details.*, seller_details.first_name AS seller_name FROM product_details
          LEFT JOIN seller_details ON product_details.seller_id = seller_details.seller_id";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
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
                    <h1>Products</h1>
                    <p>Display Information About Products<span class="las la-chart-lin"></span></p>
                </div>
            </div>
        </header>

        <main>
            <div class="table-data">
                <div class="order">
                <div class="head">
            <h3>Total Products</h3>
            
            <form id="download">
                <!-- Move the download button inside the table head -->
                <button onclick="downloadCSV()"><i class="fa-solid fa-file-export"></i></button>
            </form>
        </div>
                    <section>
                        <div class="table-data">
                            <div class="order">
                                <table id="table">
                                    <thead>
                                        <tr>
                                            <th>Sr.no</th> <!-- Changed header to # -->
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Tools</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $counter = 1; // Initialize counter
                                        if (mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                            <tr>
                                                <td><?php echo $counter++;?></td> <!-- Increment counter -->
                                                <!-- <td><?php echo $row['photo'];?></td> -->
                                                <td>
                                                        <?php
                                                        $image = empty($row['photo']) ? '../images/xyz.png' : '../images/' . $row['photo'];
                                                        echo "<img src='$image' alt='Seller Photo' style='width: 50px; height: 50px; border-radius: 50%;'>";
                                                        ?>
                                                    </td>
                                                <td><?php echo $row['name'];?></td>
                                                <td><?php echo $row['price'];?></td>
                                                <td><?php echo $row['quantity'];?></td>
                                                <td>
                                                    <button onclick="openPopup('<?php echo $row['product_id']; ?>')"><i class="fa-solid fa-magnifying-glass"></i> Views</button>
                                                    <div class="overlay" id="overlay_<?php echo $row['product_id']; ?>">
                                                        <div class="popup">
                                                            <span class="close-btn" onclick="closePopup('<?php echo $row['product_id']; ?>')">×</span>
                                                            <h2>Products Details</h2>
                                                            <form>
                                                            <div style="max-height: 400px; overflow-y: auto;">
                                                                <table>
                                                                    
                                                                    <tr>
                                                                        <td>Photo</td>
                                                                        <td>
                                                                        <div id="photoDisplay" >
                                                                        <?php
                                                                            $image = empty($row['photo']) ? '../images/profile.jpg' : '../images/' . $row['photo'];
                                                                            echo "<img src='$image' alt='Seller Photo' style='width: 50px; height: 50px; border-radius: 50%;'>";
                                                                            ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Photo2</td>
                                                                        <td>
                                                                        <div id="photoDisplay" >
                                                                        <?php
                                                                            $image = empty($row['photo']) ? '../images/profile.jpg' : '../images/' . $row['photo'];
                                                                            echo "<img src='$image' alt='Seller Photo' style='width: 50px; height: 50px; border-radius: 50%;'>";
                                                                            ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Photo3</td>
                                                                        <td>
                                                                        <div id="photoDisplay" >
                                                                            <?php
                                                                                $image = empty($row['photo']) ? '../images/profile.jpg' : '../images/' . $row['photo'];
                                                                                echo "<img src='$image' alt='Seller Photo' style='width: 50px; height: 50px; border-radius: 50%;'>";
                                                                                ?>
                                                                               </div> 
                                                                            </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Name</td>
                                                                        <td>
                                                                            <div id="productNameDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['name']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Seller Name</td>
                                                                        <td>
                                                                            <div id="sellerNameDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['seller_name']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>MRP</td>
                                                                        <td>
                                                                            <div id="priceDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['mrp']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Price</td>
                                                                        <td>
                                                                            <div id="priceDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['price']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Quantity</td>
                                                                        <td>
                                                                            <div id="quantityDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['quantity']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Description</td>
                                                                        <td>
                                                                            <div id="descriptionDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px; overflow: auto;">
                                                                                <?php echo $row['description']; ?>
                                                                            </div>
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
                                                    <p class='no-data-found'>No product data found.</p>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                       ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </main>
    </div>

    <script>
        function openPopup(productId) {
            document.getElementById("overlay_" + productId).style.display = "flex";
        }

        function closePopup(productId) {
            document.getElementById("overlay_" + productId).style.display = "none";
        }

        function downloadCSV() {
    // Open a new window or iframe to trigger the download
    var downloadWindow = window.open('fetch_details/fetch_product_details.php', '_blank');
    downloadWindow.focus();
}
function filterSellers() {
            var input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById("productSearch");
            filter = input.value.toUpperCase();
            table = document.getElementById("table");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                // Reset display style for each row
                tr[i].style.display = "";

                // Loop through all columns in the current row
                for (j = 0; j < tr[i].cells.length; j++) {
                    td = tr[i].cells[j];
                    if (td) {
                        txtValue = td.textContent || td.innerText;
                        // If the column contains the search query, break out of the loop
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            break;
                        }
                    }
                }

                // If none of the columns contain the search query, hide the row
                if (j === tr[i].cells.length) {
                    tr[i].style.display = "none";
                }
            }
        }
    </script>
</body>

</html>
