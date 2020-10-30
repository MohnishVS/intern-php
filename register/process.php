<?php 
  include('config.php');
  
  if (isset($_POST['username_check'])) {
  	$username = $_POST['username'];
  	$sql = "SELECT * FROM user WHERE username='$username'";
  	$stmt = $db->prepare($sql);
	$stmt->execute();
  	if ($stmt->rowcount() > 0) {
  	  echo "taken";	
  	}else{
  	  echo 'not_taken';
  	}
  	exit();
  }
  
  if (isset($_POST['email_check'])) {
  	$email = $_POST['email'];
  	$sql = "SELECT * FROM user WHERE email='$email'";
  	$stmt = $db->prepare($sql);
	$stmt->execute();
  	if ($stmt->rowcount() > 0) {
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
	  
	$sql = "SELECT * FROM user WHERE username='$username'";
	$stmt = $db->prepare($sql);
	$stmt->execute();

  	if ($stmt->rowcount() > 0) {
  	  echo "exists";	
  	  exit();
    }
    else{
		try {
			$sql = "INSERT INTO user (username, email, password) VALUES (:username, :email, :password)";
			$stmt = $db->prepare($sql);
			$stmt->bindParam(":username", $param_username);
			$stmt->bindParam(":email", $param_email);
			$stmt->bindParam(":password", $param_password);
					
			$param_username = $username;
			$param_email = $email;
			$param_password = $password;
			$stmt->execute();
		} 
		catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
  	}
  }

?>