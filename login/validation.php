<?php
include ("..\database\connection.php");
include ("..\session\session_start.php");
// include ("..\session\session_check.php");


$action = isset($_POST['action']) ? $_POST['action'] : '';

switch ($action) {
    case 'login':
        $email = $_POST['e-mail'];
        $password = $_POST['password'];
        
        $select_user_buyer = "SELECT * FROM buyer_details WHERE email='$email'";
        $run_query_buyer = mysqli_query($conn, $select_user_buyer);
        $select_user_admin = "SELECT * FROM admin WHERE email='$email'";
        $run_query_admin = mysqli_query($conn, $select_user_admin);
    
        if ($run_query_buyer && mysqli_num_rows($run_query_buyer) > 0) {
            $row = mysqli_fetch_assoc($run_query_buyer);
            $storedPasswordHash = $row['password'];
            
            if (password_verify($password, $storedPasswordHash)) {
                $_SESSION['username'] = $email;
                header("location:../buyer/index.php");
                exit();
            } else {
                $_SESSION['login_error'] = "Invalid email or password.";
                header("location:login.php");
                exit();
            }
        } elseif ($run_query_admin && mysqli_num_rows($run_query_admin) > 0){
            $row = mysqli_fetch_assoc($run_query_admin);
            $storedPasswordHash = $row['password'];
            
            if (password_verify($password, $storedPasswordHash)) {
                $_SESSION['username'] = $email;
                header("location:../admin/index.php");
                exit();
            } else {
                $_SESSION['login_error'] = "Invalid email or password.";
                header("location:login.php");
                exit();
            }
        }
        else {
            $_SESSION['login_error'] = "User not found.";
            header("location:login.php");
            exit();
        }
        break;
            case 'registration':
                $email = $_POST['e-mail'];
                $number = $_POST['number'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $created_no = date('Y-m-d H:i:s');
            
                // Check if the email is already registered
                $check_sql = "SELECT * FROM buyer_details WHERE email = '$email'";
                $check_query = mysqli_query($conn, $check_sql);
            
                if (mysqli_num_rows($check_query) > 0) {
                    // Email already registered
                    $_SESSION['register_error'] = "E-mail already registered. You can login directly";
                    header("location:login.php"); // Redirect to login page
                    exit();
                } else {
                    // Email not registered, proceed with registration
                    $sql = "INSERT INTO buyer_details(email, contact_no, password, created_on) VALUES('$email','$number','$password', '$created_no')";
                    $run_query = mysqli_query($conn, $sql);
                
                    if ($run_query) {
                        $_SESSION['username'] = $email;
                        header("location:../buyer/index.php");
                        exit();
                    } else {
                        echo "Registration failed.";
                    }
                }
                
                header("location:login.php");
                exit();
            break;
    }
?>