<?php
    session_start();
    if($_SESSION['sid'] == session_id() && $_SESSION['user'] =="admin")
    {
        
       

        $connection = @mysqli_connect("localhost","root","") or die;
        $sql = "SELECT * FROM minordb.tg";

        $result = mysqli_query($connection,$sql) or die;
       

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
    <div id="heading">Search Results<hr size="2" color="#FFFFFF" ice:repeating=""/></div>
    <label>
    <div id="table">
    	<span><table border="1" bgcolor="#006699" >
				<tr>
                
					<th width="200px">Name</th>
					
				</tr>
			</table></span>
     <?PHP
		while($row = mysqli_fetch_array($result))
		{
			$tg_id = $row['tg_id'];
			$first_name = $row['first_name'];
			$middle_name = $row['middle_name'];
			$last_name = $row['last_name'];
			
			echo "<table border=\"1\">
					<tr>
					
						<td width=\"200px\">".$first_name." ".$middle_name." ".$last_name."</td>
						
					</tr>
				</table>";
		}
	?>
    </label>
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
