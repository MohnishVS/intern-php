<?php
setcookie('username', "", time() - 3600);
setcookie('jwt', "", time() - 3600);
header("Location:login2.php");
?>