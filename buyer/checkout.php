<?php
include("../session/session_start.php");
$order_no = $_SESSION['order_no'];

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color:  #cce7d0; /* Set the background color of the entire page to red */
        }
        
        .inner{
            background: #cce7d0;
            border-radius: 10px;
            width: 40%;
            padding-top: 30px;
            padding-bottom: 30px;
        }
        .inner button{
            background: #088178;
            width: 75px;
            height: 10px;
            border-radius: 10px;
            padding-bottom: 50px;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="outer">
        <center>
        <div class="inner">
            <img src="../images/404-tick.png" alt="">
            <h2>Thank You!</h2>
            <p>Your Order Has Been Successfully Placed Thanks! <br>
            your order number is <?php echo $order_no?> </p> 
            
            <a href="index.php"><button type="button"><h3>Home</h3></button></a>
        </div>
        </center>
    </div>
</body>
</html>