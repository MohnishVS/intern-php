<?php
    session_start();
	//DB connection
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', 'register_db');
	
	/* Attempt to connect to MySQL database */
	try{
		$pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
		// Set the PDO error mode to exception
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} 
	catch(PDOException $e){
		die("ERROR: Could not connect. " . $e->getMessage());
	}
    	$isValid=true;
        $username =  'monishvs1';
		$email =  'monishcena@gmail.com';
		$password =  '1234';
		$conf_password = '1234';
	  
		if($username == '' || $email == '' || $password == '' || $conf_password == ''){
            $isValid = false;
            $error_message = "Please fill all fields.";
          }
		
		if ($password != $conf_password) {
            $isValid=false;
		    $error_message="The two passwords do not match";
		}
	  
		//$user_check_query = "SELECT * FROM 'user' WHERE 'username'='$username' OR email='$email'";
		//$result = $conn->query($user_check_query);
		//$user = mysqli_fetch_assoc($result);
		
		/*if ($user) {
		  if ($user['username'] == $username) {
              $isValid=false;
			  $error_message= "username already exists";
			
		  }
	  
		  if ($user['email'] == $email) {
            $isValid=false;
			$error_message= "email already exists";
			
		  }
		}*/

		if ($isValid) {
				// Prepare an insert statement
				$sql = "INSERT INTO user (username, email, password) VALUES (:username, :email, :password)";
		 
				if($stmt = $pdo->prepare($sql)){
					// Bind variables to the prepared statement as parameters
					$stmt->bindParam(":username", $param_username);
					$stmt->bindParam(":email", $param_email);
					$stmt->bindParam(":password", $param_password);
					
					// Set parameters
					$param_username = $username;
					$param_email = $email;
					$param_password = $password;
					
					// Attempt to execute the prepared statement
					if($stmt->execute()){
						// Records created successfully. Redirect to landing page
						header("location: index.php");
						exit();
					} else{
						echo "Something went wrong. Please try again later.";
					}
				}
			}
      ?>