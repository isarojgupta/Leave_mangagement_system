<?php
$leave_type = $_GET['leave_type'];
$connection = @mysqli_connect("localhost","root","");

$sql1 = "DELETE FROM minordb.leave_types WHERE leave_type = '".$leave_type."' ";
$sql2 = "DELETE FROM minordb.leave_requests WHERE leave_type = '".$leave_type."'  ";
$sql3 = "DELETE FROM minordb.leave_statistics WHERE leave_types = '".$leave_type."' ";


echo "<script>
            alert(\"Do you really want to delete Leave Type = ".$leave_type." \");
            </script>
            ";
mysqli_query($connection,$sql1);
mysqli_query($connection,$sql2);
mysqli_query($connection,$sql3);

echo "<script> window.location = \"delete_leave_type.php\";</script>";

mysqli_close($connection);
?>
