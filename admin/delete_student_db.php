<?php
    $student_id = $_GET['student_id'];
    $connection = @mysqli_connect("localhost","root","");
    $sql1 = "DELETE FROM minordb.student WHERE student_id = '".$student_id."' ";
    $sql2 = "DELETE FROM minordb.login WHERE user_id = '".$student_id."' ";
    $sql3 = "DELETE FROM minordb.leave_requests WHERE student_id = '".$student_id."' ";
    $sql4 = "DELETE FROM minordb.leave_statistics WHERE student_id ='".$student_id."' ";

    echo "<script>
                alert(\"Do you really want to delete Student ID = ".$student_id."\");</script>";

mysqli_query($connection,$sql1);
mysqli_query($connection,$sql2);
mysqli_query($connection,$sql3);
mysqli_query($connection,$sql4);

echo "<script> 
        alert(\"Student Deleted.\");
        </script>";

  echo "<script>window.location = \"search_student_for_deletion.php\";</script>";

  mysqli_close($connection);
  ?>