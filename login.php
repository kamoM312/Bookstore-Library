<!-- Php code: config.php connects to database. if(isset() triggers when form is submitted. if else statements to prevent a user from entering a user and password combination that already exits and ensures that password is correctly confirmed -->


<?php

include 'config.php';

session_start();

	if(isset($_POST['submit'])){

	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['password']);
	
	$select_users = mysqli_query($conn, "SELECT * FROM Users WHERE Email = '$email' AND Password = '$pass'") or die('query failed');

	if(mysqli_num_rows($select_users) > 0) {
		$row = mysqli_fetch_assoc($select_users);

		if($row['UserType'] == 'admin'){

			$_SESSION['admin_name'] = $row['Name'];
			$_SESSION['admin_email'] = $row['Email'];
			$_SESSION['admin_id'] = $row['ID'];

			header('location:admin_home.php');
		} elseif($row['UserType'] == 'user') {

			$_SESSION['user_name'] = $row['Name'];
			$_SESSION['user_email'] = $row['Email'];
			$_SESSION['user_id'] = $row['ID'];
			
			header('location:home_page.php');
		}
	} else {
		$message[] = 'Email or password combination is incorrect!';
	}
}



?>

<!DOCTYPE html>
<html lang="en">
	
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<title>Login</title>

	<!-- css from website -->

	<!-- custom css -->
	<link rel="stylesheet" href="css/style.css">
</head>
<body>


<?php

if(isset($message)) {
	foreach ($message as $message) {
		echo ' 
		<div class="message">
			<span>'.$message.'</span>
			<i onclick="this.parentElement.remove();"></i>
		</div>';
	}
}

?>
		
		<!-- registration form -->
		<div class="form">
			<!-- Adding required class attribute so form can only be submitted once required values are entered -->
			<form action="" method="post">
				<h4>Login</h4>
				<input type="email" name="email" placeholder="Email" required class="box">
				<input type="password" name="password" placeholder="password" required class="box">
				<input type="submit" name="submit" value="login" class="btn">
				<p>Don't have an account? <a href="register.php">Register here</a><p>
			</form>
		</div>
	</body>
</html>