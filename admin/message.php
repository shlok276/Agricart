<?php 
include ("../database/connection.php");
include ("../session/session_start.php");
include("../session/session_check.php");
// $query = "SELECT contact_details.*, buyer_details.first_name AS buyer_name FROM contact_details
//           LEFT JOIN buyer_details ON contact_details.buyer_id = buyer_details.buyer_id";
$query = "select* from contact_details";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message List</title>
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
                    <h1>Messages</h1>
                    <p>Display Messages From Sellers and Buyers<span class="las la-chart-lin"></span></p>
                </div>
            </div>
        </header>

        <main>
            <div class="table-data">
                <div class="order">
                <div class="head">
            <h3>Total Message</h3>
            <form id="download">
                
                <button onclick="downloadCSV()"><i class="fa-solid fa-file-export"></i></button>
            </form>
        </div>
                    <section>
                        <div class="table-data">
                            <div class="order">
                                <table id="table">
                                    <thead>
                                        <tr>
                                            <th>Sr.no</th>
                                            <th>Buyer Name</th>
                                            <th>Status</th>
                                            <th>Created On</th>
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
                                                <td><?php echo $row['buyer_name'];?></td>
                                                <td class="status" >
                                                    <div class="status_inner_div"  style="background-color: <?php echo ($row['status'] == 0) ? 'red' : 'green'; ?>;">
                                                        <span><?php echo ($row['status'] == 0) ? 'New' : 'Viewed'; ?></span>
                                                    </div>
                                                </td>
                                                <td><?php echo $row['created_on'];?></td>
                                                <td>
                                                    <button onclick="openPopup('<?php echo $row['contact_id']; ?>')"><i class="fa-solid fa-magnifying-glass"></i> Views</button>
                                                    <div class="overlay" id="overlay_<?php echo $row['contact_id']; ?>">
                                                        <div class="popup">
                                                            <span class="close-btn" onclick="closePopup('<?php echo $row['contact_id']; ?>')">×</span>
                                                            <h2>Message Details</h2>
                                                            <form>
                                                            <div style="max-height: 400px; overflow-y: auto;">
                                                                <table id="a">
                                                                    
                                                                    <tr>
                                                                        <td>Buyer Name</td>
                                                                        <td>
                                                                            <div id="buyerIdDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['buyer_name']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Buyer email</td>
                                                                        <td>
                                                                            <div id="buyeremailDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['email']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Description</td>
                                                                        <td>
                                                                            <div class="details-display" id="descriptionDisplay">
                                                                                <?php echo $row['message']; ?>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    
                                                                    <tr>
                                                                        <td>Status</td>
                                                                        <td class="status" >
                                                                            <div class="status_inner_div"  style="background-color: <?php echo ($row['status'] == 0) ? 'red' : 'green'; ?>;">
                                                                                <span><?php echo ($row['status'] == 0) ? 'New' : 'Viewed'; ?></span>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Created On</td>
                                                                        <td>
                                                                            <div id="createdonDisplay" style="border: 1px solid #ccc; padding: 5px; width: 700px; height: 50px;"><?php echo $row['created_on']; ?></div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                        </td>
                                                                        <td id="mark">
                                                                        <?php
                                                                            if ($row['status'] == 0) {
                                                                                // Display Deactivate button
                                                                                echo '<a href="mark_read_message.php?contact_id=' . $row['contact_id'] . '" class="mark-as-read"> Mark as read</a>';
                                                                            }
                                                                        ?> 
                                                                        
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
                                                    <p class='no-data-found'>No message data found.</p>
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
        function openPopup(contactId) {
            document.getElementById("overlay_" + contactId).style.display = "flex";
        }

        function closePopup(contactId) {
            document.getElementById("overlay_" + contactId).style.display = "none";
        }
        function downloadCSV() {
    // Open a new window or iframe to trigger the download
    var downloadWindow = window.open('fetch_details/fetch_message_details.php', '_blank');
    downloadWindow.focus();
}



    </script>
</body>

</html>
