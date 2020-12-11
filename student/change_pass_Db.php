<?php
session_start();
$student_id = $_SESSION['student_id'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];


$connection = @mysqli_connect("localhost","root","");

$sql1 = "UPDATE minordb.login SET password = '$new_password' WHERE user_id = '$student_id' ";

if($new_password != $confirm_password)
{
    echo "<script> alert(\"password doesnot match\");
    window.location =\"Change_Pass.php\"; </script>";

}
else{
    mysqli_query($connection,$sql1);
    header("Location: index.php");
    mysqli_close($connection);
                }