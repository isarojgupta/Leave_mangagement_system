<?php
$student_id = $_POST['student_id'];
$status = $_POST['approve_reject'];
$no_of_days = $_POST['no_of_days'];
$leave_type = $_POST['leave_type'];
$leave_applied = $_POST['date_applied_on'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];

$connection = @mysqli_connect("localhost","root","") or die;

$sql1 = "UPDATE minordb.leave_requests SET leave_status ='".$status."' ";
if($status == "Approved")
{
    $sql2 = "SELECT * FROM minordb.leave_statistics WHERE student_id ='".$student_id."'  AND leave_type ='".$leave_type."' limit 1";

    $result1 = mysqli_query($connection,$sql2);
    if($result1 == FALSE)
    {
         die;  // TODO: better error handling;
    }

$row = mysqli_fetch_array($result1);
$initial_number = $row['leaves_taken'];

$no_of_days = ((int)$no_of_days + (int)$initial_number);

$sql3 = "UPDATE minordb.leave_statistics SET leaves_taken='".$no_of_days."' WHERE student_id='".$student_id."' AND leaves_type='".$leave_type."' ";

}
mysqli_query($connection,$sql1);
	mysqli_query($connection,$sql3);
		echo 	"<script>
				alert(\"Leave ".$status.".\");
				window.location=\"view_leave_requests.php\";</script>";
?>