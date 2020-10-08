<?php include("config.php");?>
<html>
<head>
	<title>Register Page</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container-sm-4 pt-3 my-3 border bg-dark text-white">
	<div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-left form pt-4 my-8">
		<h2>Register</h2>			
		    <div class="form-group">
			<form action="create.php" method="POST" class="registerform">
                  
                  <div class="form-group">
                        <label for="Username">Username:</label><br/>
                        <input type="text" name="username" class="form-control" required minlength=4 maxlength=8 placeholder="username"><br/>
                  </div>
                  <div class="form-group">
                        <label for="email">Email:</label><br/>
                        <input type="text" name="email" class="form-control" required placeholder="Email"><br/>
                  </div>
                  <div class="form-group">
                        <label for="Password">Password:</label><br/>
                        <input type="text" name="password" class="form-control" required minlength=4 maxlength=8 placeholder="********"><br/>
                  </div>
                  <div class="form-group">
                        <label for="Confirm Password">Confirm Password:</label><br/>
                        <input type="text" name="confirm_password" class="form-control" required minlength=4 maxlength=8 placeholder="********"><br/>
                  </div>
                  <div class="form-group">
			      <input type="submit" name="register_btn" class="btn btn-primary" value="register"><br/>
                  </div>
			</div>
		</form>
<?php
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
						?>
						<div class="alert alert-success">
							<strong>Account Created Successfully </strong><?=$username; ?>
						</div>
						<?php
					} 
					else{
						$error_message = "Something went wrong. Please try again later.";
					}
				}
			}
			else{
				?>
				<div class="alert alert-danger">
              <strong>Error!</strong> <?=$error_message; ?>
            	</div>
				<?php
			}
        }
?>
            </div>
	</div>
      </div>
</body>	
</html>