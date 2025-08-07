<?php
session_start();
session_destroy();

// Remove the login cookie
setcookie("email", "", time() - 3600, "/");
setcookie("user_id", "", time() - 3600, "/");
setcookie("fullname", "", time() - 3600, "/");
setcookie("username", "", time() - 3600, "/");

header("Location: http://localhost/callsense/login.php"); // Redirect to login page
exit();
?>
