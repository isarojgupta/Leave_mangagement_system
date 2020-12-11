<?php
error_reporting(0);
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$email_id = $_POST['email_id'];
$password = $_POST['password'];
$user_type = "Student";

$connection = mysqli_connect("localhost","root","") or die;

$sql1 = "SELECT student_id FROM minordb.student WHERE student_id = '".$email_id."' ";

$sql2 = "INSERT INTO minordb.student (student_id, first_name, middle_name, last_name) VALUES ('$email_id','$first_name', '$middle_name', '$last_name')";

$sql3 = "INSERT INTO minordb.login(user_id,password,user_type) VALUES('$email_id','$password','$user_type')";

$sql4 = "SELECT * FROM minordb.leaves_types";

$result4 = mysqli_query($connection,$sql5);
$result1 = mysqli_query($connection,$sql1);
$row = mysqli_fetch_array($result1);
if($row == 0)
{

        $result2 = mysqli_query($connection,$sql2) or die;
        $result3 = mysqli_query($connection,$sql3) or die;

            while($row4 = mysqli_fetch_array($result4))
            {
                $leave_type = $row4['leave_type'];
                $no_of_days = $row4['no_of_days'];
                $sql4 = "INSERT INTO minordb.leave_statistics  (student_id,leave_type,maximum_leaves) VALUES ('$email_id','$leave_type','$no_of_days') ";
                mysqli_query($connection,$sql4) or die;
            }
            
          $message = $_POST['first_name'];
          echo "<script type='text/javascript'> alert(\"New student ".$message." added \"); </script>";
           
        echo "<script> window.location=\"add_student.php\"; </script>";
    }
    else {
            echo "<script>
                alert(\"Student Id already exist, Please use different Email ID. \");
                    </script>";
            echo "<script>window.location=\"add_student.php\";</script>";
    }
    mysqli_close($connection);
    ?>