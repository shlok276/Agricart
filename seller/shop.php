<?php
include("../session/session_start.php");
include("../session/session_check.php");
include("../database/connection.php");

// Fetch shop details for the specific user from the database
$seller_username = $_SESSION['username'];
$seller_id_query = "SELECT seller_id FROM seller_details WHERE email = '$seller_username'";
$seller_id_result = mysqli_query($conn, $seller_id_query);
$seller_id_row = mysqli_fetch_assoc($seller_id_result);
$seller_id = $seller_id_row['seller_id'];

$sql_shop = "SELECT * FROM shop_details WHERE seller_id = $seller_id";
$result_shop = mysqli_query($conn, $sql_shop);

$sql = "SELECT photo FROM seller_details WHERE seller_id = '$seller_id'";
$result_img = mysqli_query($conn, $sql);

if (mysqli_num_rows($result_img) > 0) {
    // Fetch photo path
    $row = mysqli_fetch_assoc($result_img);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Shop List</title>
    <link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script>
        function openPopup(shopid) {
            document.getElementById("overlay_" + shopid).style.display = "flex";
        }

        function closePopup(shopid) {
            document.getElementById("overlay_" + shopid).style.display = "none";
        }
        $(document).ready(function () {
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
        });
    </script>
</head>

<body>
    <?php include("navigation.php"); ?>

    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: #000e04;" class="nav"><i
                        class="fa-solid fa-bars"></i> Shop</span>
                <span style="font-size:30px;cursor:pointer; color: rgb(0, 0, 0); display: none;" class="nav2"><i
                        class="fa-solid fa-bars"></i> Shop</span>
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
                        <h1>Shop list</h1>
                        <a href="add_shop.php"><button>+ Add Shop</button></a>
                    </p>
                    <br />
                    <div class="table-container">
                        <table>
                            <tr>
                                <th>SR No.</th>
                                <th>Photo</th>
                                <th>Shop Name</th>
                                <th>Shop City</th>
                                <th>Tools</th>
                            </tr>
                            <?php
                            // Check if any rows were returned
                            if ($result_shop && mysqli_num_rows($result_shop) > 0) {
                                $sr_no = 1; // Initialize SR No.
                                while ($row = mysqli_fetch_assoc($result_shop)) {?>
                                    <tr>
                                        <td><?php echo $sr_no++; ?></td>
                                        <?php
                                        $image = empty($row['photo']) ? '../images/profile.jpg' : '../images/' . $row['photo'];
                                        echo "<td><img src='$image' alt='Seller Photo' style='width: 50px; height: 50px; border-radius: 50%;'></td>";
                                        ?>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['city']; ?></td>
                                        <td>
                                            <div class="view-button">
                                                <button onclick="openPopup(<?php echo $row['shop_id']; ?>)">
                                                    <i class='fa-solid fa-magnifying-glass'></i> Edit
                                                </button>
                                                <form method="POST" action="delete_shop.php">
                                                    <input type="hidden" name="shop_id" value="<?php echo $row['shop_id']; ?>">
                                                    <button type="submit">
                                                    <ion-icon name="trash-outline"></ion-icon> Delete
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="overlay" id="overlay_<?php echo $row['shop_id']; ?>">
                                        <div class="popup">
                                            <span class="close-btn" onclick="closePopup('<?php echo $row['shop_id']; ?>')">×</span>
                                            <h2>Edit Product Details</h2>
                                            <form method="POST" action="update_shop.php" enctype="multipart/form-data">
                                                <input type="hidden" name="shop_id" value="<?php echo $row['shop_id']; ?>">
                                                <div style="max-height: 400px; overflow-y: auto;">
                                                    <table>
                                                        <tr>
                                                            <td>Shop Name</td>
                                                            <td>
                                                                <input type="text" name="name" value="<?php echo $row['name']; ?>">
                                                            </td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>
                                                                <input type="text" name="address" value="<?php echo $row['address']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>City</td>
                                                            <td>
                                                                <input type="text" name="city" value="<?php echo $row['city']; ?>">
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>E-mail</td>
                                                            <td>
                                                            <input type="text" name="email" value="<?php echo $row['city']; ?>">
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
                                                            <td>Conatct Number</td>
                                                            <td><input type="number" name="contact_no" value="<?php echo $row['contact_no']; ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>location</td>
                                                            <td><input type="text" name="location" value="<?php echo $row['location']; ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Timming</td>
                                                            <td><input type="text" name="timming" value="<?php echo $row['time']; ?>"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Contact Person</td>
                                                            <td><input type="text" name="contact_person" value="<?php echo $row['contact_person']; ?>"></td>
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
                            } else {
                                // No shops found for the user
                                echo "<tr><td colspan='5'>No shops found.</td></tr>";
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>

</body>

</html>
