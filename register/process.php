<?php 
  include('config.php');
  if (isset($_POST['username_check'])) {
  	$username = $_POST['username'];
  	$sql = "SELECT * FROM user WHERE username='$username'";
  	$results = mysqli_query($db, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "taken";	
  	}else{
  	  echo 'not_taken';
  	}
  	exit();
  }
  if (isset($_POST['email_check'])) {
  	$email = $_POST['email'];
  	$sql = "SELECT * FROM user WHERE email='$email'";
  	$results = mysqli_query($db, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "taken";	
  	}else{
  	  echo 'not_taken';
  	}
  	exit();
  }
  if (isset($_POST['save'])) {
  	$username = $_POST['username'];
  	$email = $_POST['email'];
  	$password = $_POST['password'];
  	$sql = "SELECT * FROM users WHERE username='$username'";
  	$results = mysqli_query($db, $sql);
  	if (mysqli_num_rows($results) > 0) {
  	  echo "exists";	
  	  exit();
      }
      else{
  	  $query = "INSERT INTO user (username, email, password) 
  	       	VALUES ('$username', '$email', '$password')";
  	  $results = mysqli_query($db, $query);
  	  if ( false===$result ) {
        printf("error: %s\n", mysqli_error($con));
      }
      else {
        echo 'saved.';
        exit();
      }
  	}
  }

?>