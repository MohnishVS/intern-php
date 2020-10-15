<?php
	include("config.php");

	if (isset($_POST['register_btn'])) {
		$username =  $_POST['username'];
		$email =  $_POST['email'];
		$password = $_POST['password'];
		$conf_password = $_POST['confirm_password'];
	  
		if($username == '' || $email == '' || $password == '' || $conf_password == ''){
			echo "Please fill all fields.";
		}	
		if ($password != $conf_password) {
				echo "The two passwords do not match";
		}
		
			$user_check_query = "SELECT * FROM user WHERE username='$username' OR email='$email' limit 1";
			if($stmt = $pdo->prepare($user_check_query)){
				
				$stmt->bindParam(":username", $param_username);
			   
				$param_username = $username;
	
				if($stmt->execute()){
					if($stmt->rowCount() == 1){
					   
						$row = $stmt->fetch(PDO::FETCH_ASSOC);
					
						$username1 = $row["username"];
						$email1 = $row["email"];

						if (isset($_POST['email_check'])){
							$username =  $_POST['username'];
							if ($username1 == $username) {
								echo("taken");
							}
							else{
								echo("not_taken");
							}
						}
						if (isset($_POST['email_check'])){
							$email =  $_POST['email'];
							if ($email1 == $email) {
								echo("taken");	
							}
							else{
								echo("not_taken");
							}
						}
						}
				}
			}
	}
		
	if (isset($_POST['save'])) {
			$username =  $_POST['username'];
			$email =  $_POST['email'];
			$password = $_POST['password'];
			$sql = "INSERT INTO user (username, email, password) VALUES (:username, :email, :password)";
		 
				if($stmt = $pdo->prepare($sql)){

					$stmt->bindParam(":username", $param_username);
					$stmt->bindParam(":email", $param_email);
					$stmt->bindParam(":password", $param_password);
					
					$param_username = $username;
					$param_email = $email;
					$param_password = $password;
					
					if($stmt->execute()){
						$success_message="Account Created Successfully";
						echo($success_message);
					} 
					else{
						echo "Something went wrong. Please try again later.";
					}
				}
			}

?>