<!DOCTYPE html>
<html>
<head>
<title> Form </title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>

<style>
.error{
color: red;
border-color: #28BAA2;
border-radius: 15px;
}

</style>
</head>
<body>

<div class="container">
<h2>Fill The below Form</h2>

<form class="cmxform" action="" novalidate name="forms" id="forms" method="POST" enctype="multipart/form-data">

<?php
include 'conn.php';
$Namess = $_GET['NAME'];
$showquery= "select * from tblusers where FullName='$Namess'";
$showdata = mysqli_query($con,$showquery);
$arrdata = mysqli_fetch_array($showdata);

if (isset($_POST['submit'])) {
$name = $_POST['uname'];
$email = $_POST['email'];
$password = md5($_POST['pswd']);
$number = $_POST['number'];
$picture = $_FILES["picture"]["name"];

$file_name = $_FILES["picture"]["name"];
$file_type = $_FILES["picture"]["type"];
$file_size = $_FILES["picture"]["size"];
$file_tem_loc = $_FILES["picture"]["tmp_name"];
$file_Store = "upload/".$file_name;


// if(move_uploaded_file($file_tem_loc, $file_Store))

// {
// //echo "Files are uploaded";
// }
// if (file_exists($file_Store))
// {
// //echo "Sorry , file already exist ...!";
// }

$updatequery = "UPDATE tblusers SET FullName='$name',EmailId='$email',Password='$password',ContactNo='$number',ProfilePicture='$file_Store' WHERE FullName='$Namess'";

$resultstore = mysqli_query($con,$updatequery);
if ($resultstore) {
move_uploaded_file($file_tem_loc, $file_Store);
$_SESSION['success'] = "Profile updated";

?>
<script> alert("Data updated Successfully ");</script>
<?php
header('location:display.php');
}
else{
?>
<script> alert("Data Not updated");</script>
<?php
}
}
?>
<div class="form-group">
<label for="uname">Name:</label>
<input type="text" class="form-control" id="uname" placeholder="Enter Your name" name="uname" value="<?php echo $arrdata['FullName']; ?>" minlength="2" required>
</div>

<div class="form-group">
<label for="email">Email Address:<span>(required,won't be published)</span></label>
<input type="email" class="form-control" id="error_email" placeholder="Enter Your Email" name="email" value="<?php echo $arrdata['EmailId']; ?>" size="32" required>
<span id="availibility"></span>
</div>

<div class="form-group">
<label for="pwd">Password:</label>
<input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd" value="<?php echo $arrdata['Password']; ?>" minlength="8" required>
</div>

<div class="form-group">
<label for="number">Phone Number:</label>
<input type="tel" class="form-control" id="number" placeholder="Enter Your Phone Number" name="number" value="<?php echo $arrdata['ContactNo']; ?>" minlength="10" maxlength="10" required>
</div>

<div class="form-group">
<label for="picture">Profile Picture:</label>
<input type="file" class="form-control" id="picture" placeholder=" Upload Your Profile Picture" name="picture" value="<?php echo $arrdata['ProfilePicture']; ?>" required>
</div>

<div class="form-group form-check">
<label class="form-check-label">
<input class="form-check-input" type="checkbox" id="remember" name="remember" required \> I agree.
</label>
</div>
<button href="display.php" class="btn btn-primary" name="submit">Cancel</button>
<button type="submit" class="btn btn-primary" id="submit" name="submit">Update</button>
<br><br>
</form>
</div>
<script type="text/javascript">
$(function()
{
    $("form[name='forms']").validate({
    rules:
    {
        uname: 
        {
            required: true,
            minlength: 3
        },
        pwd:
        {
            required: true,
            minlength:8
        },
        number:
        {
            required: true,
            number:true
        }
    },
    messages:
    {
        uname: 
        {
            required: "Please enter your Name",
            minlength : "must contain 3 characters"
        },
        pswd:
        {
            required: "Please provide a password",
            minlength:"Password must be in 8 characters"
        },
        number: 
        {
            required:"Enter vadid phone number",
            number:"Enter valid Phone Number"
    }
},
submitHandler: function(form)
{
    form.submit();
}
});
});
</script>

<script>
    $(document).ready(function()
    {
        $('#error_email').blur(function()
        {
            var Email = $(this).val();
            $.ajax({
            url:"check.php",
            method:"POST",
            data:{email:Email},
            datatype:"email",
            success:function(html)
            {
                $('#availibility').html(html);
            }
            });
        });
    });
</script>
</body>
</html>