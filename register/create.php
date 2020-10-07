<?php
	include('server.php')
?>

<html>
<head>
	<title>Register Page</title>
</head>
<body>
	<div class="content">
		<h2>Register</h2>
		<?php 
            // Display Error message
            if(!empty($error_message)){
		?>
            <div class="alert alert-danger">
              <strong>Error!</strong> <?= $error_message ?>
            </div>

            <?php
            }
            ?>

            <?php 
            // Display Success message
            if(!empty($success_message)){
            ?>
            <div class="alert alert-success">
              <strong>Success!</strong> <?= $success_message ?>
            </div>

            <?php
            }
            ?>
		<form action="#" method="POST" class="registerform">
            <input type="text" name="inp_username" placeholder="username"><br/>
			<input type="text" name="inp_email" placeholder="Email"><br/>
			<input type="text" name="inp_password" placeholder="********"><br/>
            <input type="text" name="inp_confirm_password" placeholder="********"><br/>
			<input type="submit" name="register_btn" value="register"><br/>
		</form>
	</div>
</body>	
</html>