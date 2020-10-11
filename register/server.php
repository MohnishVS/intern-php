<?php
    include("config.php");
    $isValid=true; 

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
                $error_message=$error_message+"it is invalid";
			}
        }
?>
<html>
	<head>Next page</head>
	<meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<body>
		<div class="container-sm-4 pt-3 my-3 border bg-dark text-white">
			<div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-left form pt-4 my-8">
				<div class="alert alert-danger">
					  <strong>Error!</strong> <?=$error_message; ?>
					  <input type="submit" name="go back" class="btn btn-primary">
				</div>
				<div class="alert alert-success">
              		<strong>Error!</strong> <?=$success_message; ?>
            	</div>
			</div>
		</div>
	</body>
</html>