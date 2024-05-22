<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dasboard</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>


<input type="checkbox" name="" id="menu-toggle">
    <div class="sidebar">
        <div class="sidebar-container">
            <div class="brand">
                <h2>
                    <span class="las la-tools"></span>
                    Agricart
                </h2>
            </div>

            <div class="sidebar-avartar">
                <div class="avartar-info">
                    <div class="avartar-text">
                        <h3>
                            Admin
                            <!-- <?php echo $email;?> -->
                        </h3>
                    </div>
                    
                </div>
            </div>

            <div class="sidebar-menu">
                <ul>
                    <li>
                        <a href="index.php">
                            <span class="las la-adjust"></span>
                            <span>Dasboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="order.php">
                            <span class="las la-chart-bar"></span>
                            <span> Orders</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="products.php">
                            <span class="fa-solid fa-barcode"></span>
                            <!-- <i class="fa-solid fa-barcode"></i> -->
                            <span>Products</span>
                        </a>
                    </li>
                    <li>
                        <a href="message.php">
                            <span class="fa-regular fa-message"></span>
                            <span>Message</span>
                        </a>
                    </li>
                    <li>
                        <a href="buyer.php">
                            <span class="las la-user"></span>
                            <span>Buyer</span>
                        </a>
                    </li>
                    <li>
                        <a href="seller.php">
                            <span class="las la-user"></span>
                            <span>Seller</span>
                        </a>
                    </li>
                    <li>
                        <a href="new_seller.php">
                            <span class="las la-user"></span>
                            <span>New Seller</span>
                        </a>
                    </li>
                    <li>
                        <a href="create_admin.php">
                            <span class="las la-user"></span>
                            <span>Create Admin</span>
                        </a>
                    </li>
                    <!-- <li id="settingsDropdown">
                       <a href="#" onclick="toggleDropdown()">
                         <span class="las la-cog"></span>
                         <span>Settings</span>
                         <span class="las la-caret-down"></span>
                       </a>
                       <ul class="submenu">
                         <li>Profile</li>
                         <li>Manage</li>
                       </ul>
                    </li> -->
                    <li>
                        <a href="../login/logout.php">
                            <span class="fa-solid fa-right-from-bracket"></span>
                            <span>Sign-out</span>
                        </a>
                    </li>

                </ul>
            </div>

            
        </div>
    </div>    

    <script>
            function toggleDropdown() {
               var submenu = document.querySelector('.submenu');
               submenu.style.display = (submenu.style.display === 'block' ? 'none' : 'block');
            }
    </script>
</body>
</html>