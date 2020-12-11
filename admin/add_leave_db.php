<?PHP	
	$leave_type = $_POST['type_of_leave'];
	$number_of_days = $_POST['number_of_leaves'];
	
	$connection = @mysqli_connect("localhost", "root", "") or die;
	
	//for primary key varification
	$sql1 = "SELECT leave_type FROM minordb.leave_types WHERE leave_type = '".$leave_type."'";
	
	// firing query
	$result1 = mysqli_query($connection,$sql1);
	
	if(mysqli_num_rows($result1))
	{
		echo	"<script>
				alert(\"'".$leave_type."' already exist !\");
				window.location=\"add_leave.php\";</script>";
	}
	else
	{
		$sql2 = "INSERT INTO minordb.leave_types VALUES ('".$leave_type."', '".$number_of_days."')";
		$sql3 = "SELECT student_id FROM minordb.student";
		$result2 = mysqli_query($connection,$sql3);
		while($row = mysqli_fetch_array($result2))
		{
			$student_id = $row['student_id'];
			$sql4 = "INSERT INTO minordb.leave_statistics (student_id, leave_type, maximum_leaves) VALUES( '".$student_id."', '".$leave_type."', '".$number_of_days."')";
			mysqli_query($connection,$sql4) or die;
		}
		
		mysqli_query($connection,$sql2) or die;
		echo	"<script>
				alert(\"New Leave Added and Leave Type is '".$leave_type."'\");
				window.location=\"add_leave.php\";</script>";
	}
	mysqli_close($connection);
	
?>