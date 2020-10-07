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
    $error_message = "";
    $success_message = "";
	$username = "";
    $email= "";
    $isValid=true; 

	if (isset($_POST['register_btn'])) {
		$username =  $_POST['inp_username'];
		$email =  $_POST['inp_email'];
		$password = $_POST['inp_password'];
		$conf_password = $_POST['inp_confirm_password'];
	  
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
                }
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
						
						header("location: index.php");
						exit();
					} 
					else{
						echo "Something went wrong. Please try again later.";
					}
				}
			}
        }
?>