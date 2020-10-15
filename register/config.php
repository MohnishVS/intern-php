<?php
	$db = mysqli_connect('localhost', 'root', '', 'register_db');
	if (mysqli_connect_errno()) {
	  printf("Connect failed: %s\n", mysqli_connect_error());
	  exit();
	}
?>