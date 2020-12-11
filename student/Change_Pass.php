<?php

session_start();
if($_SESSION['sid'] == session_id() && $_SESSION['user'] == "student"){


?>
<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
   
    <link rel="stylesheet" href="../style_Pass.css">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  </head>
  <body>
    <div class="ChangePassword-form">
      <div class="text">Change Password</div>
<form action="change_pass_Db.php" method= "post">
        <div class="field">
          <div class="fas fa-lock">
</div>
<input type="text" placeholder="CurrentPassword" name = "current_password">
        </div>
<div class="field">
          <div class="fas fa-lock">
</div>



<input type="password" placeholder="New Password" name = "new_password">
        </div>
        <div class="field">
            <div class="fas fa-lock">
  </div>
  <input type="password" placeholder="Confirm Password" name = "confirm_password">
          </div>
<button>UPDATE</button>
<?php } ?>
</form>
</div>
</body>
</html>
