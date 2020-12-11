<?PHP

	$user_id = $_POST['txt_username'];
	$password = $_POST['pswd_password'];
	
	$connection = @mysqli_connect("localhost", "root", "");
	$sql = "SELECT * FROM minordb.login WHERE user_id = '$user_id' AND password = '$password'";
	

	$result = mysqli_query($connection,$sql);
	if(mysqli_num_rows($result))
	{
		while($row = mysqli_fetch_array($result))
		{
			$user_type = $row['user_type'];
			$db_password = $row['password'];
			
			if((!(strcmp($db_password, $password))) && $user_type == "admin")
			{
				session_start();
				$_SESSION['sid'] = session_id();
				$_SESSION['user'] = $user_type;
				//Opens add_staff page if username and password matches
				header("Location: admin/index.php");
			}
			else if((!(strcmp($db_password, $password))) && $user_type == "student")
			{
				session_start();
				$_SESSION['sid'] = session_id();
				$_SESSION['user'] = $user_type;
				$_SESSION['student_id'] = $user_id;
				echo
				//Opens add_staff page if username and password matches
				header("Location: student/index.php");
				//echo "staff";
			}
			else if((!(strcmp($db_password, $password))) && $user_type == "tg")
			{
				session_start();
				$_SESSION['sid'] = session_id();
				$_SESSION['user'] = $user_type;
				$_SESSION['tg_id'] = $user_id;
				header("Location: tg/index.php");
				//Opens add_staff page if username and password matches
				//header("Location: admin/add_staff.php");
			}
		}
	}
	// else
	// {
	// 	echo	"<script>
	// 		alert(\"Incorrect Username and Password Match.\");
	// 		window.location=\"index.html\";</script>";
	// }
?>