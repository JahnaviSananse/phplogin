<!DOCTYPE html>
<html>
<head>
<title>Form</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<style>
.main-div
{
    position: absolute;
    top: 15%;
    left: 65%;
    transform: translate(-80%,-20%);
    width: 600px;
    background: #ffff;
    padding: 45px;
    box-sizing: border-box;
    border: 1px solid rgba(0,0,0,.1);
    box-shadow: 0 5px 10px rgba(0,0,0,.1);
}
table, th, td 
{
    border: 2px solid black;
    border-collapse: collapse;
    background-color: #ffff;
    box-shadow: 0 10px 20px 0 rgba(0,0,0,.03);
    border-radius: 10px;
    margin: auto;
}
.search-div
{
    position: absolute;
    top: 10%;
    left: 5%;
    background: #ffff;
    padding: 45px;
    box-sizing: border-box;
    border: 1px solid rgba(0,0,0,.1);
    box-shadow: 0 5px 10px rgba(0,0,0,.1);
}
</style>
</head>
<body>

<form class="search-div" action="search.php" method="POST">
<input type="text" name="search">
<input type="submit" name="submit" value="Search">
</form>

<div class="main-div">
<h2 align="center">
List of Candidates for Register
</h2>
<br><br>

<div class="center-div">
<div class="table-responsive">
<table width="50%" border="1" cellpadding="5" cellspacing="5">
<thead>
<tr>
<th>Name</th>
<th>Email Address</th>
<th>Phone Number</th>
<th>Profile Picture</th>

</tr>
</thead>
<tbody>
<?php
include 'conn.php';
if(isset($_GET['page']))
{
    $page = $_GET['page'];
}
else
{
    $page = 1;
}
$num_per_page = 10;
$start_from = ($page-1)*10;

$selectQuery = " select * from tblusers limit $start_from,$num_per_page";

$query = mysqli_query($con,$selectQuery);
$nums = mysqli_num_rows($query);

while ($res = mysqli_fetch_array($query)) 
{

?>
<tr>
<td><?php echo $res['FullName']; ?> </td>
<td><span class="email-style"><?php echo $res['EmailId']; ?></span></td>
<td><?php echo $res['ContactNo']; ?></td>
<td>
<img src="<?php echo $res['ProfilePicture'];?>"width="60" height="40"></td>
</tr>
<?php } ?>
</tbody>

</table><br><br><br><br><br><br><br>

<?php
$selectQuery = " select * from tblusers";
$query = mysqli_query($con,$selectQuery);
$nums = mysqli_num_rows($query);

$total_page = ceil($nums/$num_per_page);

if($page>1)
{
    echo "<a href='pagination.php?page=".($page-1)." ' class='btn btn-danger'>previous</a>";
}
for($i=1;$i<$total_page;$i++)
{
    echo "<a href='pagination.php?page=".$i."' class='btn btn-dark'>$i</a>";
}
if($i>$page)
{
    echo "<a href='pagination.php?page=".($page+1)." ' class='btn btn-danger '>Next</a>";
}
?>
</div>
</div>
</form>
</div>
</body>
</html>