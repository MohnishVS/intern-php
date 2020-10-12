<?php
    include("config.php");
	$isValid=true;
	$error_message=""; 

	if (isset($_POST['register_btn'])) {
		$username =  $_POST['username'];
		$email =  $_POST['email'];
		$password = $_POST['password'];
		$conf_password = $_POST['confirm_password'];
	  
		if($username == '' || $email == '' || $password == '' || $conf_password == ''){
            $isValid = false;
			$error_message = "Please fill all fields.";
		}	
		if ($password != $conf_password) {
				$isValid=false;
				$error_message="The two passwords do not match";
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
					
					if ($username1 == $username) {
						$isValid=false;
						$error_message= "Username already exists";
						
					}
				
					if ($email1 == $email) {
						$isValid=false;
						$error_message= "email already exists";
						
					}
				}
				}
			}
		
		if ($isValid) {
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
					} 
					else{
						$error_message = "Something went wrong. Please try again later.";
					}
				}
			}
			else{
                $error_message="it is invalid";
			}
        }
?>
