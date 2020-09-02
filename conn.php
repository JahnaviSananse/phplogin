<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = 'demo_Pro';
$con = mysqli_connect($servername,$username,$password,$db);
if ($con) 
{
    //echo "Connection Successful...!";
?>
<!-- <script>
alert("Connection Successful");
</script> i am comment this script because issue in validation -->

<?php
}
else
{
    echo "No Connection";
    die("No Connection" . mysql_connect_error());
}
?>



