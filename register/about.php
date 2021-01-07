<?php
session_start();
require_once __DIR__ . '\..\vendor\autoload.php';;
use StringyInflector\StringyInflector as S;
$stringy = S::create( $_SESSION['name']); 
$res = $stringy->capitalizePersonalName();
?>
<html>
<head>
<title>User Login</title>
</head>
<body>
<?php
if($_SESSION["name"]) {
?>
Welcome <?php echo $res; ?> Logged in using session. Click here to <a href="logout.php" tite="Logout">Logout.
<?php
}else echo "<h1>Please login first .</h1><a href='login.php'>Login";
?>
</body>

</html>