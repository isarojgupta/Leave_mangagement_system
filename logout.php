<?php
	session_start();
	session_destroy();
	setcookie(session_name(), session_id(), time() - 1);
	header("Location: index.html");
?>