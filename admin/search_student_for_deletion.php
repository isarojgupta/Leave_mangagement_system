<?php 
session_start();
if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "admin")
{

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Delete student</title>
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
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("select").change(function(){
            $( "select option:selected").each(function(){
                if($(this).attr("value")=="student_id"){
                    $(".name").hide();
                    $(".student_id").show();
                }
                if($(this).attr("value")=="name"){
                    $(".student_id").hide();
                    $(".name").show();
                }
                if($(this).attr("value")=="select"){
                    $(".student_id").hide();
                    $(".name").hide();
                }
            });
        }).change();
    });
</script>
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
    <div id="heading">TG<hr size="2" color="#FFFFFF" ice:repeating=""/>
</div>
    <form>
    <!--
     <p>
        <label for="student_id" ><span>student ID <span class="required">*</span></span>
          <input type="text" name="student_id" id="student_id" placeholder="student ID" required="required"/>
        </label>
      </p>
        <label for="full_name" ><span>Name <span class="required">*</span></span>
          <input type="text" name="first_name" id="first_name" placeholder="First" required="required"/>
          <input type="text" name="middle_name" id="middle_name" placeholder="Middle"/>
          <input type="text" name="last_name" id="last_name" placeholder="Last" required="required"/>
        </label>
         <label for="email_id" ><span>Email ID <span class="required">*</span></span>
          <input type="email" name="email_id" id="email_id" placeholder="Email" required="required" style="width:560px" />
        </label>
        <label for="password" ><span>Create Password <span class="required">*</span></span>
          <input type="password" name="password" id="password" placeholder="Create Password" required="required" />
        </label>
        <label for="confirm_password" ><span>Confirm Password <span class="required">*</span></span>
          <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" required="required" />
        </label>
      <label>
          <input type="submit" value="Add" />
        </label>-->
         <label for="search_by"><span>Search By <span class="required">*</span></span>
         	<select name="search_by" id="search_by">
                <option value="student_id">student ID</option>
                <option value="name">Name</option>
          	</select>
      	</label>
        </form>
        <div class="student_id">
        <form action="student_details_for_deletion.php" method="post">
        <label for="student_id"><span>student ID <span class="required">*</span></span>
          <input type="text" name="student_id" id="student_id" placeholder="student ID" required="required"/>
          <input type="submit" value="Search" style="margin-left:5px; height:30px;"/>
          </label>
      	</form>
    	</div>
     	<div class="name">
     	<form action="delete_student.php" method="post">
   			<label for="name"><span>Name <span class="required">*</span></span>
         	<input type="text" name="name" id="name" placeholder="Name" required="required"/>
           	<input type="submit" value="Search" style="margin-left:5px; height:30px;"/>
          	</label>
      	</form>
     	</div>
    </form>
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
?>
