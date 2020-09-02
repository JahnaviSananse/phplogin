<?php
include 'conn.php';
if (isset($_POST['email'])) 
{
    $sql = "select * from tblusers where EmailId = '".$_POST['email']."'";
    $result = mysqli_query($con,$sql);
    if (mysqli_num_rows($result) > 0) 
    {
        //echo '<span class="text-danger">Email is Already Exist</span>';
        echo "<span style='color:red'> Email already exists .</span>";
        echo "<script>$('#submit').prop('disabled',true);</script>";
    }
    else
    {
        echo "<script>$('#submit').prop('disabled',false);</script>";
    }
}
?>