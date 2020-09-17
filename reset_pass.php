<?php
    session_start();
    include 'conn.php';
    if (isset($_POST['submit'])) {
    $password = $_POST['NPassword'];
    $email = $_SESSION['email'];
    $password = password_hash($_POST['NPassword'], PASSWORD_DEFAULT);
    $sql = "UPDATE tblusers SET Password='$password' WHERE EmailId='$email'";

if (mysqli_query($con, $sql)) {
  echo "Record updated successfully";
} else {
  echo "Error updating record: " . mysqli_error($con);
}

mysqli_close($con);
}
?>