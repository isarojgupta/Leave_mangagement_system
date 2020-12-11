<?PHP
	// Retrieving values from textboxes
	
	$student_id = $_POST['student_id'];
	
	/*$first_name = $_POST['first_name'];
	$middle_name = $_POST['middle_name'];
	$last_name = $_POST['last_name'];
	$email_id = $_POST['email_id'];
	$password = $_POST['password'];
	$user_type = "student";*/
	
	// Initializing the values, following DRY (Don't Repeat Yourself) Approach
	// $dsn_name = "minordb";
	// $db_user = "root";
	// $db_pass = "";
	
	// // Obtaining connection using DSN and ODBC
	// $connection = odbc_connect($dsn_name, $db_user, $db_pass);
	

	$connection = @mysqli_connect("localhost","root","");
	// Sql query
	$sql1 = "SELECT * FROM minordb.student WHERE student_id = '$student_id'";
	$sql2 = "SELECT password FROM minordb.login WHERE user_id = '$student_id'"; 
	
	
	// Firing query
	$result1 = mysqli_query($connection, $sql1);
	$result2 = mysqli_query($connection, $sql2);
	/*$affected_rows = odbc_affected_rows($result);	// Obtaining the number of rows affected
	echo $affected_rows;	*/						// Printing nuber of rows affected
	if(mysqli_num_rows($result1))
	{
		while($row1 = mysqli_fetch_array($result1))
		{
			$first_name = $row1['first_name'];
			$middle_name = $row1['middle_name'];
			$last_name = $row1['last_name'];
		}
		while($row2 = mysqli_fetch_array($result2))
		{
			$password =  $row2['password'];
		}
	}
	else
	{
		echo 	"<script>
				alert(\"student ID ".$student_id." does not exist !\");
				window.location=\"search_student_for_deletion.php\";</script>";
	}
	
	// Closing Connection

	
?>
<?php
	session_start();
	if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin")
	{
		?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Update student</title>
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
<!-- <script type="text/javascript">
	function(student_id)
	{
		alert(student_id);
	}
</script> -->
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
    <div id="heading">Delete Student<hr size="2" color="#FFFFFF" ice:repeating=""/></div>
    <form action="delete_student_db_by_id.php" method="get">
     <p>
        <label for="student_id" ><span>student ID </span><span class="db_data"> <?php echo $student_id; $_SESSION['student_id'] = $student_id;?></span></label>
      </p>
        <label for="full_name" ><span>Name </span> 
          <span class="db_data"><?php echo $first_name ." ". $middle_name ." ". $last_name ?></span>
        </label>
        <label for="password" ><span>Password </span>
         <span class="db_data"> <?php echo $password ?></span>
        </label>
      <label>
          <input type="Submit" value="Delete student"/>
        </label>
    </form>
  </div>
  <div id="side_bar">
  	<ul>
    	<li class="menu_head">Controls</li>
    	<li><a href="#">Home</a></li>
        <li><a href="add_student.php">Add student</a></li>
        <li><a href="search_student_for_deletion.php">Delete student</a></li>
    	<li><a href="add_leave.php">Add Leave</a></li>
        <li><a href="delete_leave_type.php">Delete Leave</a></li>
        <li><a href="searching_tg.php">TG</a></li>
    </ul>
  </div>
  <div id="footer">
  	<p><br />Leave Management System</p>
  </div>
</div>
</body>
</html>
<?php
	
	mysqli_close($connection);
}
	else
	{
		header("Location: ../index.html");
	}
?>
