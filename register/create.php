<?php include('process.php'); 
?>
<html>

<head>
	<title>Register Page</title>
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
			<h2 class="display-4">Register</h2>
			<div class="form-group">
				<form>

					<div class="form-group">
						<label for="Username">Username:</label><br />
						<input type="text" name="username" id="username" autocomplete="username" class="form-control"
							onkeyup='usercheck();' required minlength=4 maxlength=8 placeholder="username"><br />
						<div id="message1"></div>
					</div>
					<div class="form-group">
						<label for="email">Email:</label><br />
						<input type="email" name="email" id="email" class="form-control" pattern=".+@+." onkeyup='emailcheck();'  required
							placeholder="Email"><br />
						<div id="message2"></div>
					</div>
					<div class="form-group">
						<label for="Password">Password:</label><br />
						<input type="password" name="password" class="form-control" id="password" required minlength=4
							maxlength=8 placeholder="********"><br />
					</div>
					<div class="form-group">
						<label for="Confirm Password">Confirm Password:</label><br />
						<input type="password" name="confirm_password" class="form-control" id="confirm_password"
							onkeyup='check();' onchange="save();" required minlength=4 maxlength=8 placeholder="********"><br />
						<div id="message"></div>
						<div id="messageuser"></div>
					</div>
				</form>
						<div class="">
							<input type="hidden" name="user" id="user" value="">
							<input type="file"  name="file" id="file" onchange="resup();" ><br><br>	
						</div>
						<div id="messageres"></div><br>
						<button onclick="location.href = '/intern-php/register/login.php';" id="createbtn" class="btn btn-info" >Login Page</button>
			</div>
		</div>
	</div>

</body>

</html>