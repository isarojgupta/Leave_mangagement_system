<?php

$name = $_POST['name'];

$connection = @mysqli_connect("localhost", "root","");

$sql = "SELECT * FROM minordb.student WHERE  first_name LIKE '%$name%' OR middle_name LIKE '%$name%' OR last_name LIKE '%$name%'";

// Firing query

$result = mysqli_query($connection,$sql);

if(mysqli_num_rows($result)==0)
{
    echo "<script>
            alert(\"Search result not found !\");
            window.location=\"search_student_for_deletion.php\";</script>";
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
    <div id="heading">Search Result
      <hr size="2" color="#FFFFFF" ice:repeating=""/>
    </div>
    <div id="table">
    	 <?PHP
			echo "<span><table border=\"1\" bgcolor=\"#006699\" >
				<tr>
					<th width=\"200px\">student ID</th>
					<th width=\"100px\">First Name</th>
					<th width=\"110px\">Middle Name</th>
					<th width=\"100px\">Last Name</th>
					<th width=\"100px\">Password</th>
					<th width=\"100px\">Delete</th>
				</tr>
			</table></span>";
    while($row1 = mysqli_fetch_array($result))
    {
     $student_id = $row1['student_id'];
     $first_name = $row1['first_name'];
     $middle_name = $row1['middle_name'];
     $last_name = $row1['last_name'];

     $sql3 = "SELECT password FROM minordb.login WHERE user_id = '".$student_id."' ";
     $result2 = mysqli_query($connection,$sql3);

     if($row2 = mysqli_fetch_array($result2))
     {
         $password = $row2['password'];
     }

     echo "<table border=\"1\">
     <tr>
         <td width=\"200px\">".$student_id."</td>
         <td width=\"100px\">".$first_name."</td>
         <td width=\"110px\">".$middle_name."</td>
         <td width=\"100px\">".$last_name."</td>
         <td width=\"100px\">".$password."</td>
         <td width=\"100px\"><a href='delete_student_db.php?student_id=".$student_id."'\><img src=\"../images/trash.gif\" />Delete</a></td>
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
