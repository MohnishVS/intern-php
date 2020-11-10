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
			$sql = "INSERT INTO user (username, email, password) VALUES ('$username', '$email', '$password')";
			$stmt = $db->prepare($sql);
			$stmt->execute();
			echo "success";
	
		} 
		catch(PDOException $e) {
			echo $sql . "<br>" . $e->getMessage();
		}
  	}
  }

  if(isset($_POST['resup'])){
  try{
	include_once("config.php");
	$name = $_POST['filename'];
	$username=$_POST['username'];
	$name=htmlspecialchars($name, ENT_QUOTES);
	$query="UPDATE user SET resumefile ='$name' WHERE username = '$username'";
	$stmt=$db->prepare($query);
	$stmt->execute();
	echo $username;
   }
   catch(PDOException $e) {
	  echo $e->getMessage();
  }
}

?>
