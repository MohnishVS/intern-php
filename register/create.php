<html>

<head>
	<title>Register Page</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="container-fluid pt-3 my-3 border bg-dark text-white">
		<div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-left form pt-4 my-8">
			<h2 class="display-4">Register</h2>
			<div class="form-group">
				<form action="server.php" method="POST" class="registerform">
					
					<div class="form-group">
						<label for="Username">Username:</label><br />
						<input type="text" name="username" class="form-control" required minlength=4 maxlength=8
							placeholder="username"><br />
					</div>
					<div class="form-group">
						<label for="email">Email:</label><br />
						<input type="text" name="email" class="form-control" required placeholder="Email"><br />
					</div>
					<div class="form-group">
						<label for="Password">Password:</label><br />
						<input type="password" name="password" class="form-control" required minlength=4 maxlength=8
							placeholder="********"><br />
					</div>
					<div class="form-group">
						<label for="Confirm Password">Confirm Password:</label><br />
						<input type="password" name="confirm_password" class="form-control" required minlength=4 maxlength=8
							placeholder="********"><br />
					</div>
					<div class="form-group">
						<input type="submit" name="register_btn" class="btn btn-primary" onsubmit="server.php" value="register"><br />
					</div>
				</form>
				
			</div>
		</div>
	</div>
</body>
</html>