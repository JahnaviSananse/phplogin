<?php
include 'conn.php';

if (isset($_POST['submit'])) {
$name = $_POST['uname'];
$email = $_POST['email'];
$password = password_hash($_POST['pswd'], PASSWORD_DEFAULT);
$number = $_POST['number'];
$picture = $_FILES['picture'];

$file_name = $_FILES["picture"]["name"];
$file_tem_loc = $_FILES["picture"]["tmp_name"];
$file_Store = "upload/".$file_name;


if(move_uploaded_file($file_tem_loc, $file_Store))

{
//echo "Files are uploaded";
}
// if (file_exists($file_Store))
// {
// //echo "Sorry , file already exist ...!";
// }

$insertquery = "INSERT INTO tblusers(FullName,EmailId,Password,ContactNo,ProfilePicture) VALUES ('$name','$email','$password','$number','$file_Store')";
$resultstore = mysqli_query($con,$insertquery);
if ($resultstore) {
?>
<script> alert("Data Inserted Successfully..... Thank You.....");</script>

<?php
//include 'pagination.php';
}
else{
?>
<script> alert("Data Not Inserted");</script>
<?php
}
}
?>
<html>
<body>
    <h4> Your Data has been inserted successfully. Now, you can LOG IN.</h4><br>
    <a href="loginForm.php">LOG IN</a>
</body>
</html>