<?php

if(isset($_GET['seller_id']))
{
    deactivate();
}

function deactivate()
    {
        $id = $_GET['seller_id'];
        $con = mysqli_connect('localhost','root','');
        if(!$con)
        {
            die("Connection was not successful");
        }
        else{
            mysqli_select_db($con,'agricart');
            $query = "UPDATE seller_details SET status = 1  WHERE seller_id = $id";
            //echo $query;
            $result = mysqli_query($con,$query);
            header("location:seller.php");
        }
    }

    
?>