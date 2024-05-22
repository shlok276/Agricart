
<?php
    include ("../session/session_start.php");
    $loginError = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
    unset($_SESSION['login_error']); // Clear the session variable
    $registerError = isset($_SESSION['register_error']) ? $_SESSION['register_error'] : '';
    unset($_SESSION['register_error']); // Clear the session variable
    
?>
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- ===== Iconscout CSS ===== -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- ===== CSS ===== -->
    <link rel="stylesheet" href="index.css">
         
    <title>Login & Registration Form</title> 
</head>
<body>
    <video autoplay muted id="myVideo">
        <source src="tactor1080_stop.mp4" type="video/mp4">
        Your browser does not support HTML5 video.
      </video>
    
    <div class="container">
        <div class="forms">
            <div class="form login">
                <center><span class="title">Login</span></center>
                <!-- Display error message if it exists -->
                <?php if ($loginError): ?>
                    <div class="error-message" style="text-align: center; font-size: 18px;">
                        <p><?php echo $loginError; ?></p>
                    </div>
                <?php elseif ($registerError): ?>
                    <div class="error-message" style="text-align: center; font-size: 18px;">
                        <p><?php echo $registerError; ?></p>
                    </div>
                <?php endif; ?>

                <form action="validation.php" method="POST" autocomplete="off">
                <input type="hidden" name="action" value="login">
                    <div class="input-field">
                        <input type="text" placeholder="Enter your email" name="e-mail" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="password" class="password" placeholder="Enter your password" name="password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>

                    <div class="checkbox-text">
                        <a href="comingsoon.php" class="text">Forgot password?</a>
                    </div>

                    <div class="input-field button">
                        <center><button>Login</button></center>
                    </div>
                </form>

                <div class="login-signup">
                    <span class="text">Not a member?
                        <a href="#" class="text signup-link">Signup Now</a><br>
                    </span>
                     <span class="text">
                        <a href="s_login.php" class="text signup-link">Seller Account</a><br>
                    </span>
                </div>
            </div>

            <!-- Registration Form -->
            <div class="form signup">
                <center><span class="title">Registration</span></center>

                <form action="validation.php" method="POST" autocomplete="off">
                    <input type="hidden" name="action" value="registration">
                    <div class="input-field">
                        <input type="email" placeholder="Enter your email"  name="e-mail" required>
                        <i class="uil uil-envelope icon"></i>
                    </div>
                    <div class="input-field">
                        <input type="text" placeholder="Enter your Contact No" name="number" pattern="[0-9]{10}" title="Please enter a 10-digit contact number" required>
                        <i class="uil uil-phone-alt"></i>
                    </div>
                    
                    <div class="input-field">
                        <input type="password" class="password" placeholder="Enter your password" name="password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    <div class="checkbox-text">
                        <div class="checkbox-content">
                            <input type="checkbox" id="termCon" required>
                            <label for="termCon" class="text">I accepted all <a href="../t&c/T&C_buyer.php">terms and conditions</a></label>
                        </div>
                    </div>

                    <div class="input-field button">
                        <button>Signup</button>
                    </div>
                    
                </form>

                <div class="login-signup">
                    <span class="text">Already a member?
                        <a href="#" class="text login-link">Login Now</a>
                    </span>
                </div>
            </div>
        </div>
    </div>

     <script src="login.js"></script> 
</body>
</html>