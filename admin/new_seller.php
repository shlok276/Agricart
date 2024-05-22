<?php 
include ("../database/connection.php");
include ("../session/session_start.php");
include("../session/session_check.php");

$query = "SELECT * FROM seller_details WHERE verify = 0";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Sellers</title>
    <link rel="icon" href="../images/titlelogo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="admin.css">
    <style>
        .image-container.enlarged {
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .image-container.enlarged img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 0;
        }

        .image-container.enlarged .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            color: white;
            cursor: pointer;
            font-size: 24px;
            z-index: 10000;
        }
        
    </style>
</head>

<body>

    <?php include ("navbar.php"); ?>

    <div class="main-content">
        <header>
            <div class="header-title-wrapper">

                <div class="header-title">
                    <h1>
                        New Seller
                    </h1>
                    <p>
                        Display Information About New Sellers<span class="las la-chart-lin"></span>
                    </p>
                </div>
            </div>

        </header>

        <main>
            <div class="table-data">
                <div class="order">
                <div class="head">
            <h3>Total Seller</h3>
        </div>
                    <section>

                        <div class="table-data">
                            <div class="order">
                                <table id="table">
                                    <thead>
                                        <tr>
                                            <th>Sr.no</th>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Created on</th>
                                            <th>Tools</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $counter = 1;
                                        if (mysqli_num_rows($result) > 0) {
                                            while($row = mysqli_fetch_assoc($result)){
                                        ?>
                                                <tr>
                                                <td><?php echo $counter++;?></td>
                                                    <!-- <td><?php echo $row['photo']; ?></td> -->
                                                    <td>
                                                        <?php
                                                        $image = empty($row['photo']) ? '../images/profile.jpg' : '../images/' . $row['photo'];
                                                        echo "<div class='image-container' id='imageContainer_" . $row['seller_id'] . "'><img src='$image' alt='Seller Photo' onclick='enlargeImage(this)' style='width: 50px; height: 50px; border-radius: 50%;'></div>";
                                                        ?>
                                                    </td>
                                                    <td><?php echo $row['first_name']; ?></td>
                                                    <td><?php echo $row['created_on']; ?></td>
                                                    <td>
                                                        <button onclick="openPopup(<?php echo $row['seller_id']; ?>)"><i class="fa-solid fa-magnifying-glass"></i> Views</button>
                                                        <div class="overlay" id="overlay_<?php echo $row['seller_id']; ?>">
                                                            <div class="popup">
                                                                <span class="close-btn" onclick="closePopup(<?php echo $row['seller_id']; ?>)">×</span>
                                                                <h2>Seller Details</h2>
                                                                <form method="post" action="verify_seller.php">
                                                                    <div style="max-height: 400px; overflow-y: auto;">
                                                                        
                                                                        <table>
                                                                            
                                                                            <tr>
                                                                                <td>Photo</td>
                                                                                <td>
                                                                                    <div id="sellerPhotoDisplay">
                                                                                        <?php
                                                                                            $image = empty($row['photo']) ? '../images/profile.jpg' : '../images/' . $row['photo'];
                                                                                            echo "<div class='image-container' id='imageContainer_" . $row['seller_id'] . "'><img src='$image' alt='Seller Photo' onclick='enlargeImage(this)' style='width: 150px; height: 150px; border-radius: 50%;'></div>";
                                                                                        ?>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>First Name</td>
                                                                                <td>
                                                                                    <div id="sellerNameDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['first_name']; ?></div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Last Name</td>
                                                                                <td>
                                                                                    <div id="sellerPhotoDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['last_name']; ?></div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Email</td>
                                                                                <td>
                                                                                    <div id="sellerEmailDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['email']; ?></div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Government Id</td>
                                                                                <td>
                                                                                    <div id="sellerPhotoDisplay">
                                                                                        <?php
                                                                                            $image = empty($row['government_id']) ? '../images/profile.jpg' : '../images/' . $row['government_id'];
                                                                                            echo "<div class='image-container' id='imageContainer_" . $row['seller_id'] . "'><img src='$image' alt='Seller Photo' onclick='enlargeImage(this)' style='width: 350px; height: 200px; border-radius: 1px;'></div>";
                                                                                        ?>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>GST Number</td>
                                                                                <td>
                                                                                    <div id="sellerPhotoDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;">
                                                                                        <?php if($row['gst_no'] == 0){ echo '-';}else{ echo $row['gst_no'];} ?></div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td>Created On</td>
                                                                                <td>
                                                                                    <div id="sellerPhotoDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['created_on']; ?></div>
                                                                                </td>
                                                                            </tr>
                                                                            <td>
                                                                                <input type="hidden" name="seller_id" value="<?php echo $row['seller_id']; ?>">
                                                                                <button type="submit" name="verifySeller">Verify </button>
                                                                            </td>
                                                                        </table>
                                                                    </div>
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
                                                    <p class='no-data-found'>No new seller data found.</p>
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
        function openPopup(sellerId) {
            document.getElementById("overlay_" + sellerId).style.display = "flex";
        }

        function closePopup(sellerId) {
            document.getElementById("overlay_" + sellerId).style.display = "none";
        }

        function downloadCSV() {
            // Open a new window or iframe to trigger the download
            var downloadWindow = window.open('fetch_details/fetch_seller_details.php', '_blank');
            downloadWindow.focus();
        }

        function enlargeImage(img) {
            var container = img.parentElement;
            container.classList.add("enlarged");
            var windowWidth = window.innerWidth;
            var windowHeight = window.innerHeight;
            var imageWidth = Math.min(windowWidth * 0.9, windowHeight * 0.9);
            var imageHeight = imageWidth;
            img.style.width = imageWidth + "px";
            img.style.height = imageHeight + "px";
            container.innerHTML += "<span class='close-btn' onclick='shrinkImage(this.parentElement)'>×</span>";
        }

        function shrinkImage(container) {
            var img = container.querySelector("img");
            img.style.width = "50px"; // Original width
            img.style.height = "50px"; // Original height
            container.classList.remove("enlarged");
            container.removeChild(container.lastChild); // Remove the close button
        }
    </script>
    <script>
    window.onload = function() {
        <?php
        if(isset($_GET['alert'])) {
            $alert_message = '';
            switch($_GET['alert']) {
                case 'user change':
                    $alert_message = 'user verified successfully';
                    break;
                case 'error':
                    $alert_message = 'Error while verifying';
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

</body>

</html>
