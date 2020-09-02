<?php
session_start();
include_once 'conn.php';
if(isset($_POST['submit']))
{
    $user_id = $_POST['user_id'];
    $result = mysqli_query($con,"SELECT * FROM tblusers where FullName='" . $_POST['user_id'] . "'");
    $row = mysqli_fetch_assoc($result);
	$fetch_user_id=$row['FullName'];
	$email_id=$row['EmailId'];
    $password=$row['Password'];
    $phone_num=$row['ContactNo'];
	if($user_id==$fetch_user_id) {
    $rndno=rand(100000, 999999);//OTP generate
    $message = urlencode("otp number.".$rndno);
    $to=$email_id;
    $subject = "OTP";
    $txt = "OTP: ".$rndno."";
    $headers = "From: jahnavisananse@gmail.com" . "\r\n" .
    "CC: jahnavisananse@gmail.com";
    mail($to,$subject,$txt,$headers);
    
    $_SESSION['name']=$user_id;
    $_SESSION['email']=$email_id;
    $_SESSION['password']=$password;
    $_SESSION['phone']=$phone_num;
    $_SESSION['otp']=$rndno;
    header( "Location: otp.php" ); 
    	
  }
				else{
					echo 'invalid userid';
				}
}
?>