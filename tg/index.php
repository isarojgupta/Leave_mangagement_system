<?PHP
	session_start();
	if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "tg")
	{	
		$tg_id = $_SESSION['tg_id'];
		
		$connection = @mysqli_connect("localhost", "root", "") or die;
		
		$sql = "SELECT * FROM minordb.leave_requests WHERE leave_status = 'Pending'";
		$sql2 = "SELECT * FROM minordb.tg WHERE tg_id = '".$_SESSION['tg_id']."'";
		
		$result = mysqli_query($connection,$sql);
		
		$no_of_rows = mysqli_num_rows($result);
		
		$result1 = mysqli_query($connection,$sql2);
		while($row1 = mysqli_fetch_array($result1))
		{
			$first_name = $row1['first_name'];
			$middle_name = $row1['middle_name'];
			$last_name = $row1['last_name'];
		}
		if($no_of_rows == 0)
		{
			echo 	"<script>
					alert(\"No Leave Requests to Show!\");
					window.location=\"index.php\";</script>";
		}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Leave History</title>
<style type="text/css">
body {
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
	background-image: url(../images/bg.gif);
}
</style>
<link href="../style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="container">
  <div id="header">
    <div id="title">Leave Management System</div>
    <div id="quick_links">
      <ul>
        <li><a class="home" href="index.php">Home</a></li>
        <li>|</li>
       
        <li><a class="logout" href="../logout.php">Logout</a></li>
        <li>|</li>
        <li><a class="greeting" href="#">Hi <?php echo $_SESSION['user']; ?></a></li>
      </ul>
    </div>
  </div>
  <div id="content_panel">
   <div id="heading">Leave Requests Received<hr size="2" color="#FFFFFF" ice:repeating=""/></div>
     <div id="form">
    <form>
  <fieldset>
    <legend align="left">Personal Information</legend>
   
    <label for="student_id"><span>student ID </span>
    	<input type="text" name="student_id" id="student_id" readonly="true" value="<?php echo $_SESSION['tg_id'] ?>" style="background-color:#F6F6F6; color:#069" />
    </label>
    <label for="student_name"><span>student Name </span>
    	<input type="text" readonly="true" value="<?php echo $first_name." ".$middle_name." ".$last_name ?>" style="background-color:#F6F6F6; color:#069" />
    </label>
    </fieldset>
   <fieldset>
    <legend align="left">Leave Requests</legend>
     <label for="total_leave_requests"><span style="width:300px; margin-left:10px;">Total Requests Received : <?PHP echo $no_of_rows; ?></span>
   	</label>
     
    <label>
    <div id="table">
    	<span><table border="1" bgcolor="#006699" >
				<tr>
                	<th width="230px">student ID</th>
					<th width="100px">Leave Type</th>
					<th width="80px">Start Date</th>
					<th width="90px">No. of Days</th>
					<th width="100px">Date Applied</th>
                    <th width="110px">Approve/Reject</th>
				</tr>
			</table></span>
     <?PHP
		while($row = mysqli_fetch_array($result))
		{
			$student_id = $row['student_id'];
			$leave_type = $row['leave_type'];
			$start_date = $row['start_date'];
			$end_date = $row['end_date'];
			$no_of_days = $row['days_requested'];
			$date_applied = $row['date_applied'];
			$status = $row['leave_status'];
			
			echo "<table border=\"1\">
					<tr>
						<td width=\"230px\"><a href='student_profile.php?student_id=".$student_id."'\>".$student_id."</a></td>
						<td width=\"100px\">".$leave_type."</td>
						<td width=\"80px\">".$start_date."</td>
						<td width=\"90px\">".$no_of_days."</td>
						<td width=\"100px\">".$date_applied."</td>
						<td width=\"110px\"><a href='approve_reject_leave.php?student_id=".$student_id."&start_date=".$start_date."'\><img src=\"../images/edit_find_replace.png\" />Details</a></td>
					</tr>
				</table>";
		}
	?>
    </label>
     </form>
    </div>
  </div>
  </div>
  <div id="side_bar">
  	<ul>
    	<li class="menu_head">Controls</li>
        <li><a href="view_leave_requests.php">View Leave Request</a></li>
        <li><a href="search_student_to_view_history.php">View Leave History</a></li>
    </ul>
  </div>
  <div id="footer">
  	<p><br />Leave Management System</p>
  </div>
</div>
</body>
</html>
<?php
	}
	else
	{
		header("Location: ../index.html");
	}
	mysqli_close($connection);
?>
