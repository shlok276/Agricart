<?php
include("../session/session_start.php");
include("../session/session_check.php");
include("../database/connection.php");

// Fetch seller ID for the specific user from the database
$seller_username = $_SESSION['username'];
$seller_id_query = "SELECT seller_id FROM seller_details WHERE email = '$seller_username'";
$seller_id_result = mysqli_query($conn, $seller_id_query);
$seller_id_row = mysqli_fetch_assoc($seller_id_result);
$seller_id = $seller_id_row['seller_id'];

// Fetch products for the specific seller from the database
$product_query = "SELECT * FROM product_details WHERE seller_id = '$seller_id'";
$product_result = mysqli_query($conn, $product_query);

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
    <title>Products List</title>
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
                        class="fa-solid fa-bars"></i> Products</span>
                <span style="font-size:30px;cursor:pointer; color: rgb(0, 0, 0);" class="nav2"><i
                        class="fa-solid fa-bars"></i> Products</span>
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
                <p>
    <h1>Total Products</h1>
    <a href="add_product.php"><button>+ Add Products</button></a>
</p>

                    <br />
                    <table>
                        <tr>
                            <th>SR No.</th>
                            <th>Photo</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Tools</th>
                        </tr>
                        <?php
                        $sr_no = 1;
                        while ($row = mysqli_fetch_assoc($product_result)) {?>
                            <tr>
                                <td><?php echo $sr_no++; ?></td>
                                <?php
                                $image = empty($row['photo']) ? '../images/profile.jpg' : '../images/' . $row['photo'];
                                echo "<td><img src='$image' class='pro-img'></td>";
                                ?>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['price']; ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <!-- <td>Edit/Delete</td> -->
                                <td>
                                    <div class="view-button">
                                        <button onclick="openPopup(<?php echo $row['product_id']; ?>)">
                                            <i class='fa-solid fa-magnifying-glass'></i> Edit
                                        </button>
                                        <form method="POST" action="delete_product.php">
                                            <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                            <button type="submit">
                                            <ion-icon name="trash-outline"></ion-icon>  Delete
                                            </button>
                                        </form>


                                    </div>
                                    <div class="overlay" id="overlay_<?php echo $row['product_id']; ?>">
                                        <div class="popup">
                                            <span class="close-btn" onclick="closePopup('<?php echo $row['product_id']; ?>')">×</span>
                                            <h2>Edit Product Details</h2>
                                            <form method="POST" action="update_product.php" enctype="multipart/form-data">
                                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                                <div style="max-height: 400px; overflow-y: auto;">
                                                    <table>
                                                        <tr>
                                                            <td>Product Name</td>
                                                            <td>
                                                                <input type="text" name="name" value="<?php echo $row['name']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Description</td>
                                                            <td>
                                                                <input type="text" name="description" value="<?php echo $row['description']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>MRP</td>
                                                            <td>
                                                                <input type="number" name="price" value="<?php echo $row['mrp']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Price</td>
                                                            <td>
                                                                <input type="number" name="price" value="<?php echo $row['price']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Quantity</td>
                                                            <td>
                                                                <input type="number" name="quantity" value="<?php echo $row['quantity']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Image</td>
                                                            <td>
                                                                <img src="../images/<?php echo $row['photo']; ?>" style="max-width: 100px; max-height: 100px;">
                                                                <input type="file" name="image">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Image2</td>
                                                            <td>
                                                                <img src="../images/<?php echo $row['photo2']; ?>" style="max-width: 100px; max-height: 100px;">
                                                                <input type="file" name="image2">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Image3</td>
                                                            <td>
                                                                <img src="../images/<?php echo $row['photo3']; ?>" style="max-width: 100px; max-height: 100px;">
                                                                <input type="file" name="image3">
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <button type="submit">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
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
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        function openPopup(productId) {
            document.getElementById("overlay_" + productId).style.display = "flex";
        }

        function closePopup(productId) {
            document.getElementById("overlay_" + productId).style.display = "none";
        }
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
