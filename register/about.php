<?php
session_start();
?>
<html>
<head>
<title>User Login</title>
</head>
<body>
<?php
if($_SESSION["name"]) {
?>
Welcome <?php echo $_SESSION["name"]; ?> Logged in using session. Click here to <a href="logout.php" tite="Logout">Logout.
<?php
}else echo "<h1>Please login first .</h1><a href='login.php'>Login";
?>
</body>
</html>