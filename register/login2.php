<?php
include('config.php');
$message = "";
if (count($_POST) > 0){
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$sql = "SELECT * FROM user WHERE username = '$username' and password = '$password'";
	$stmt = $db->prepare($sql);
	$stmt->execute();
	$jwt="";
	if ($stmt->rowcount() > 0) {
	  $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
	  $payload = json_encode(['user_id' => $username]);
	  $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
      $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
	  $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);
	  $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
	  $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
	
	  setcookie('jwt', $jwt);
	  setcookie('username', $username);
	  header("Location:about2.php");
	}
	else{
		$message="Incorrect username or password";
		}
}
else if(!empty($_COOKIE['jwt'])){
	header("Location:about2.php");
}

?>
<html>

<head>
	<title>Login token Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.1.min.js"></script>
	<script src="script.js"></script>
</head>

<body>
	<div class="card-body rounded pt-4 my-4 border bg-primary text-white">
		<div class="card col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-left form pt-4 my-4 bg-dark text-white">
			<h2 class="display-4">Login</h2>
			<div class="form-group">
				<form action="" method="post">
					<div class="form-group">
						<label for="Username">Username:</label><br />
						<input type="text" name="username" id="username" autocomplete="username" class="form-control" required minlength=4 maxlength=8 placeholder="username"><br />
						<div id="message1"></div>
					</div>
					<div class="form-group">
						<label for="Password">Password:</label><br />
						<input type="password" name="password" class="form-control" id="password" required minlength=4 maxlength=8 placeholder="********"><br />
					</div>
					<div class="form-group">
						<button type="submit" id="loginbtn" class="btn btn-info" >Login</button>
					</div>
					<div class="form-group">
						<h6 class="">Not a User?</h2>
							<button onclick="location.href = '/intern-php/register/create.php';" id="createbtn" class="btn btn-info">Register</button>
							<div class="message"><?php if ($message != "") {
														echo $message;
													} ?></div>
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>