<?php
// require_once "conn.php";
if(isset($_POST['submit_email']) && $_POST['email'])
{
  $conn=mysqli_connect('localhost','root','');
  mysqli_select_db($conn,'demo_pro');
  $select=mysqli_query($conn,"select EmailId,Password from tblusers where EmailId='pinky@gmail.com'");
  if(mysqli_num_rows($select)==1)
  {
    while($row=mysqli_fetch_array($select))
    {
      $email=($row['EmailId']);
      $pass=($row['Password']);
    }
    $link="<a href='www.samplewebsite.com/reset.php?&key=".$email."&reset=".$pass."'>Click To Reset password</a>";
    require_once('phpmail/PHPMailerAutoload.php');
    $mail = new PHPMailer(); 
    $mail->CharSet =  "utf-8";
    $mail->IsSMTP();
    // enable SMTP authentication
    $mail->SMTPAuth = true;                  
    // GMAIL username
    $mail->Username = "jahnavisananse@gmail.com";
    // GMAIL password
    $mail->Password = "jeanie+janu=jahnavi/25";
    $mail->SMTPSecure = "ssl";  
    // sets GMAIL as the SMTP server
    $mail->Host = "smtp.gmail.com";
    // set the SMTP port for the GMAIL server
    $mail->Port = "465";
    $mail->From='jahnavisananse@gmail.com';
    $mail->FromName='your_name';
    $mail->AddAddress($email, 'reciever_name');
    $mail->Subject  =  'Reset Password';
    $mail->IsHTML(true);
    $mail->Body    = 'Click On This Link to Reset Password '.$pass.'';
    if($mail->Send())
    {
      echo "Check Your Email and Click on the link sent to your email";
    }
    else
    {
      echo "Mail Error - >".$mail->ErrorInfo;
    }
  }	
}
?>