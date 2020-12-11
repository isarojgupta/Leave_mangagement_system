<?php

session_start();

    if($_SESSION['sid'] == session_id() && $_SESSION['user']=="student")
    {
    $student_id = $_SESSION['student_id'];

    $connection = @mysqli_connect("localhost","root","");
    $sql1 = "SELECT * FROM minordb.student WHERE student_id='$student_id' ";
    $sql2 = "SELECT * FROM minordb.leave_statistics WHERE student_id = '$student_id'";

    $result1 = mysqli_query($connection,$sql1);
    $result2 = mysqli_query($connection,$sql2);

    

    while($row1 = mysqli_fetch_array($result1))
		{
			$first_name = $row1['first_name'];
			$middle_name = $row1['middle_name'];
			$last_name = $row1['last_name'];
		}
?>




<!DOCTYPE html >
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Student Profile</title>
<style type="text/css">
html,body {
  height: 100%;
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
        <li><a class="greeting" href="#">Hi <?PHP echo $_SESSION['user']; ?></a></li>
         <li>|</li>
        
      <li><a class="home" href="index.php">Home</a></li>
         <li>|</li>
       
        <li><a class="logout" href="../logout.php">Logout</a></li>
         <li>|</li>

        <li><a class="change_password" href="Change_Pass.php">Change Password</a></li>
        
       
      </ul>
    </div>
  </div>
  <div id="content_panel">
    <div id="heading">Home<hr size="2" color="#FFFFFF" ice:repeating=""/></div>
    <div id="form">
    <form method="post" action="approve_reject_db.php">
    <fieldset>
    <legend>My profile</legend>
    <label for="student_id"><span>Student ID </span>
    	<input type="text" name="student_id" id="student_id" readonly="true" value="<?php echo $student_id ?>" style="background-color:#F6F6F6; color:#0f3097" />
    </label>
    <label for="student_name"><span>Student Name </span>
    	<input type="text" readonly="true" value="<?php echo $first_name." ".$middle_name." ".$last_name ?>" style="background-color:#F6F6F6; color:#0f3097" />
    </label>
    </fieldset>
    <br />
  
            </form>
            </div>
          </div>
          <div id="side_bar">
              <ul>
                <li class="menu_head">Controls</li>
                <li><a href="apply_leave.php">Apply Leave</a></li>
                <li><a href="holidays.pdf">Hodlidays</a></li>
                <li><a href="view_leave_history.php">View Leave History</a></li>
                <li><a href="view_leave_status.php">View Leave Status</a></li>
                 <li><a href="view_profile.php">View Profile</a></li>
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
        















