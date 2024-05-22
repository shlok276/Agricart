<?php
if(isset($_GET['contact_id']))
{
    mark_read();
}
function mark_read()
    {
        $id = $_GET['contact_id'];
        $con = mysqli_connect('localhost','root','');
        if(!$con)
        {
            die("Connection was not successful");
        }
        else{
            mysqli_select_db($con,'agricart');
            $query = "UPDATE contact_details SET status = 1  WHERE contact_id = $id";
            //echo $query;
            $result = mysqli_query($con,$query);
            header("location:message.php");
        }
    }
    ?>