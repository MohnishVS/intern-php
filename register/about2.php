<html>
<head>
<title>User Login</title>
</head>
<body>

<?php
$jwt="";
$username=$_COOKIE['username'];
$jwt=$_COOKIE['jwt'];
if(!empty($jwt) && !empty($username)) {
?>
<h1>Welcome <?php echo $username; ?> Logged in using Token. Click here to <a href="logout2.php" tite="Logout">Logout.</h1>
<?php
}else echo "<h1>Please login first .</h1><a href='login2.php'>Login";
?>
</body>
</html>