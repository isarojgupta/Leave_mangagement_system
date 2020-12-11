<?php

    // obtaining connection
    $connection = @mysqli_connect("localhost","root","");

    // sql query
    $sql = "SELECT * FROM minordb.leave_types";

    // Firing query
    $result = mysqli_query($connection,$sql) or die;

    if(mysqli_num_rows($result) == 0)
    {
        echo "<script>
                alert(\"Search results not found! \");
                window.location = \"#\"; </script>";

    }
    ?>

    <?php 
    session_start();
    if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin")
    {

    ?>

<!DOCTYPE html>
<html >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete Leave Type</title>
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
  <div id="side_bar">
  	<ul>
    	<li class="menu_head">Controls</li>
        <li><a href="add_student.php">Add Student</a></li>
        <li><a href="search_student_for_deletion.php">Delete Student</a></li>
    	<li><a href="add_leave.php">Add Leave</a></li>
        <li><a href="delete_leave_type.php">Delete Leave</a></li>
        <li><a href="searching_tg.php">TG</a></li>
    </ul>
  </div>
  <div id="content_panel">
    <div id="heading">Types of Leave
      <hr size="2" color="#FFFFFF" ice:repeating=""/>
    </div>
    <div id="table">
    	 <?PHP
			echo "<span><table border=\"1\" bgcolor=\"#006699\" >
				<tr>
					<th width=\"150px\">Type of Leave</th>
					<th width=\"150px\">Number of Leaves</th>
					<th width=\"100px\">Delete</th>
				</tr>
			</table></span>";
			while($row = mysqli_fetch_array($result))
			{
				$leave_type = $row['leave_type'];
				$no_of_leaves = $row['no_of_days'];
				echo "<table border=\"1\">
						<tr>
							<td width=\"150px\">".$leave_type."</td>
							<td width=\"150px\">".$no_of_leaves."</td>
							<td width=\"100px\"><a href='delete_leave_type_db.php?leave_type=".$leave_type."'\><img src=\"../images/trash.gif\" />Delete</a></td>
						</tr>
					</table>";
			}
			
		mysqli_close($connection);
	?>
    </div>
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
?>
