<html>
<head>
<style>
table, th, td {
border: 2px solid black;
border-collapse: collapse;
background-color: #ffff;
box-shadow: 0 10px 20px 0 rgba(0,0,0,.03);
border-radius: 10px;
margin: auto;
}
</style>
</head>
</html>
<?php
include 'conn.php';
if(isset($_POST["search"]))
{
    $search_value = $_POST["search"];
    if($con->connect_error)
    {
        echo 'Connection Faild: '.$con->connect_error;
    }
    else
    {
        $sql="select * from tblusers where FullName like '%$search_value%'";
        $res=$con->query($sql);
        echo "<table border='1'>";
            echo "<tr>";
            echo "<th>Name</th>";
            echo "<th>Email Address</th>";
            echo "<th>Phone Number</th>";
            echo "<th>Profile Picture</th>";
            echo "</tr>";
        while($row=$res->fetch_assoc())
        {
            echo "<tr>";
            echo "<td>".$row["FullName"]."</td>";
            echo "<td>".$row["EmailId"]."</td>";
            echo "<td>".$row["ContactNo"]."</td>";
            echo "<td>".$row["ProfilePicture"]."</td>";
            echo "</tr>";   
        }   
        echo "</table>";
    }    
}
?>