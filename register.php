<!-- Php code: config.php connects to database. if(isset() triggers when form is submitted. if else statements to prevent a user from entering a user and password combination that already exits and ensures that password is correctly confirmed -->

<?php

include 'config.php';

	if(isset($_POST['submit'])){

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['password']);
	$cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
	$user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

	$select_users = mysqli_query($conn, "SELECT * FROM Users WHERE Email = '$email' AND Password = '$pass'") or die('query failed');

	if(mysqli_num_rows($select_users) > 0) {
		$message[] = 'User already exists!';
	} else {
		if($pass != $cpass) {
			$message[] = 'Password and Confirm Password fields must match!';
		} else {
			$sql="INSERT INTO Users (Name, Email, Password, UserType) VALUES ('$name', '$email','$pass', '$user_type')";
			$conn->query($sql);
			
			$message[] = 'registered successfully';
		}
	}
}


?>


<!DOCTYPE html>
<html lang="en">
	
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<title>Register</title>

		<!-- css from website -->

		<!-- custom css -->
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		
		<!-- registration form -->
		<div class="form">
			<!-- Adding required class attribute so form can only be submitted once required values are entered -->
			<form action="" method="post">
				<h4>Register</h4>
				<input type="text" name="name" placeholder="Name" required class="box">
				<input type="email" name="email" placeholder="Email" required class="box">
				<input type="password" name="password" placeholder="password" required class="box">
				<input type="password" name="cpassword" placeholder="confirm password" required class="box">
				<select name="user_type" class="box">
					<option value="user">user</option>
					<option value="admin">admin</option>
				</select>
				<input type="submit" name="submit" value="register" class="btn">
				<p>Already have an account? <a href="login.php">Log in</a><p>
			</form>
		</div>
	</body>
</html>