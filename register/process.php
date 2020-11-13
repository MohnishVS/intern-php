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

		if (isset($_FILES['file']['name'])) {
			$username = $_POST['user'];
			$name = $_FILES['file']['name'];
			$tmp_name = $_FILES['file']['tmp_name'];
			$file_type = $_FILES['file']['type'];
			$file_size = $_FILES['file']['size'];
			if ((!empty($name) && ($file_type=="application/pdf") && $file_size<=5000000)) {
				$location = 'uploads/';
				if (move_uploaded_file($tmp_name, $location.$username.$name)){
				  $name=htmlspecialchars($name, ENT_QUOTES);
				  $query="UPDATE user SET resumefile = '$name'  WHERE username = '$username'";
				  $stmt=$db->prepare($query);
				  $stmt->execute();
				  echo 'Uploaded';
				}
				else {
				  echo 'failed';
				}
		
			} else {
				echo $tmp_name;
				echo 'select file .pdf and size below 5MB';
			}
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
?>
