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
    <title>Settings</title>
    <link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <style>
            .table-container input{
                width: 25%;

            }
        </style>
</head>

<body>
    <?php include("navigation.php"); ?>

    <div id="main">
        <div class="head">
            <div class="col-div-6">
                <span style="font-size:30px;cursor:pointer; color: #000e04;" class="nav"><i
                        class="fa-solid fa-bars"></i> Setting</span>
                <span style="font-size:30px;cursor:pointer; color: rgb(0, 0, 0); display: none;" class="nav2"><i
                        class="fa-solid fa-bars"></i> Setting</span>
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
                        <h1>Change Password</h1>
                        
                    </p>
                    <br />
                    <div class="table-container">
                    
                    <table>
                            <form action="change_password.php" method="POST">
                                <tr>Current Password</tr><br>
                                <input type="text" name="current_password"><br>
                                <tr>New Password</tr><br>
                                <input type="text" name="new_password"><br>
                                <tr>Confirm Password</tr><br>
                                <input type="text" name="confirm_password"><br>
                                <button name="save_password">Submit</button>
                            </form>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    window.onload = function() {
        <?php
        if(isset($_GET['alert'])) {
            $alert_message = '';
            switch($_GET['alert']) {
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
