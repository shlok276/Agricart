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

?>

<!DOCTYPE html>
<html>

<head>
    <title>Account Details</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .box-8{
                background: c4ecd0;
                width: 69%;
                height: 80%;
            }
        </style>

    
</head>

<body>
    <!-- <?php include("navigation.php"); ?> -->

    <div id="main">
        

        <div class="clearfix"></div>
        <br />

        <div class="clearfix"></div>
        <br /><br />
        <div class="col-div-8">
            <div class="box-8">
                <div class="content">
                    
                    <br />
                    <div class="table-container">
                    <form method="post" action="verify_account_process.php" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <label for="shop_name">First Name:</label><br>
                                <input type="text" id="shop_name" name="first_name" required><br>
                                <label for="shop_name">last Name:</label><br>
                                <input type="text" id="shop_name" name="last_name" required><br>
                                <label for="image1">Upload your Image:</label><br>
                                <input type="file" id="image1" name="image" accept="image/*" required><br>
                                <label for="shop_name">Government ID:</label><br>
                                <input type="file" id="shop_name" name="gov_id" accept="image/*" required>
                                (eg: aadhar card, pan card, driving licence)
                                <br>
                                <br>
                                <br> 

                                <label for="shop_name">GST Number(optional):</label><br>
                                <input type="text" id="shop_name" name="gst_no"><br>

                                <div class="submit">
                                <input type="submit" value="Submit">
                            </div>
                            </tr>
                            
                            
                            
                        </table>
        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
</html>
