<?PHP
	session_start();
	if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "tg")
	{	
		$tg_id = $_SESSION['tg_id'];
		$student_id = $_GET['student_id'];
		$start_date = $_GET['start_date'];
		
		$connection = @mysqli_connect("localhost", "root", "") or die;
		
		$sql1 = "SELECT * FROM minordb.leave_requests WHERE student_id = '".$student_id."' AND start_date = '".$start_date."'";
		$sql2 = "SELECT * FROM minordb.student WHERE student_id = '".$student_id."'";
		
		$result1 = mysqli_query($connection,$sql1);
		$result2 = mysqli_query($connection,$sql2);
		
		$no_of_rows = mysqli_num_rows($result1);
		
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
    <div id="heading">Leave Requests Details<hr size="2" color="#FFFFFF" ice:repeating=""/></div>
    <?PHP
		while($row = mysqli_fetch_array($result1))
		{
			$student_id = $row['student_id'];
			$leave_type = $row['leave_type'];
			$start_date = $row['start_date'];
			$end_date = $row['end_date'];
			$no_of_days = $row['days_requested'];
			$date_applied = $row['date_applied'];
			$status = $row['leave_status'];
		}
		while($row1 = mysqli_fetch_array($result2))
		{
			$first_name = $row1['first_name'];
			$middle_name = $row1['middle_name'];
			$last_name = $row1['last_name'];
        }
	?>
    <div id="form">
    <form method="post" action="approve_reject_db.php">
    <fieldset>
    <legend>General Information</legend>
    <label for="student_id"><span>student ID </span>
    	<input type="text" name="student_id" id="student_id" readonly="true" value="<?php echo $student_id ?>" style="background-color:#F6F6F6; color:#069" />
    </label>
    <label for="student_name"><span>student Name </span>
    	<input type="text" readonly="true" value="<?php echo $first_name." ".$middle_name." ".$last_name  ?>" style="background-color:#F6F6F6; color:#069" />
    </label>
    </fieldset>
    <br />
    <fieldset>
    <legend>Leave Information</legend>
    <label for="leave_type"><span>Leave Type </span>
    	<input type="text" name="leave_type" id="leave_type" readonly="true" value="<?php echo $leave_type ?>" style="background-color:#F6F6F6; color:#069" />
    </label>
    <label for="date_applied"><span>Leave Applied on </span>
    	<input type="text" name="date_applied_on" id="date_applied_on" readonly="true" value="<?php echo $date_applied ?>" style="background-color:#F6F6F6; color:#069" />
    </label>
    <label for="leave_date"><span>Leave Date </span>
    	<input type="text" name="start_date" id="start_date" readonly="true" value="<?php echo $start_date ?>" style="background-color:#F6F6F6; color:#069" /> &ndash; <input type="text" name="end_date" id="end_date" readonly="true" value="<?php echo $end_date ?>" style="background-color:#F6F6F6; color:#069" /><input type="text" name="no_of_days" id="no_of_days" readonly="true" value="<?PHP echo $no_of_days ?> Day(s)" style="background-color:#F6F6F6; color:#069; width:80px; margin-left:10px;" />
        
    </label>
    </fieldset>
    
    <br />
    
    <fieldset>
    <legend>Approve/Reject Leave</legend>
    <label for="current_leave_status"><span>Current Status </span>
    	<input type="text" readonly="true" value="<?php echo $status ?>" style="background-color:#F6F6F6; color:#069"/>
    </label>
    <label for="approve_reject"><span>Approve / Reject </span>
    	<select name="approve_reject" id="approve_reject">
            <option value="Approved">Approve</option>
            <option value="Rejected">Reject</option>
        </select>
    </label>
    <label>
    	<input type="submit" value="Submit" />
  	 </label>
    </fieldset>
    </form>
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
  	<p><br />minordb</p>
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
