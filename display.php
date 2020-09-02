<!DOCTYPE html>
<html>
<head>
<title>Form</title>
</script>

</head>
<body>
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
<th>Change Data</th>
</tr>
</thead>
<tbody>
<?php
include 'conn.php';
$selectQuery = " select * from tblusers";
$query = mysqli_query($con,$selectQuery);
$nums = mysqli_num_rows($query);
//echo $nums;
//$res = mysqli_fetch_array($query);
//echo $res[1];

while ($res = mysqli_fetch_array($query)) {

//echo $res['Name']."<br>";
?>
<tr>
<td><?php echo $res['FullName']; ?> </td>
<td><span class="email-style"><?php echo $res['EmailId']; ?></span></td>
<td><?php echo $res['ContactNo']; ?></td>
<td>
<img src="<?php echo $res['ProfilePicture'];?>"width="60" height="30"></td>

<td><a href="update.php?NAME=<?php echo $res['FullName']; ?>"><input type="submit" name="update" value="Update"></a></td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</form>
</div>

</body>
</html>