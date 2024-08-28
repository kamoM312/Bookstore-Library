<!-- Php code: config.php connects to database. if(isset() triggers when form is submitted. if else statements to prevent a user from entering a user and password combination that already exits and ensures that password is correctly confirmed -->

<!-- Added PHP redirect to login.php -->

<?php

ini_set('display_errors', 1);

include 'config.php';

// 	if(isset($_POST['submit'])){

// 	$name = mysqli_real_escape_string($conn, $_POST['name']);
// 	$email = mysqli_real_escape_string($conn, $_POST['email']);
// 	$pass = mysqli_real_escape_string($conn, $_POST['password']);
// 	$cpass = mysqli_real_escape_string($conn, $_POST['cpassword']);
// 	$user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

// 	$select_users = mysqli_query($conn, "SELECT * FROM Users WHERE Email = '$email' AND Password = '$pass'") or die('query failed');

// 	if(mysqli_num_rows($select_users) > 0) {
// 		$message[] = 'User already exists!';
// 	} else {
// 		if($pass != $cpass) {
// 			$message[] = 'Password and Confirm Password fields must match!';
// 		} else {
// 			$sql="INSERT INTO Users (Name, Email, Password, UserType) VALUES ('$name', '$email','$pass', '$user_type')";
// 			$conn->query($sql);
			
// 			$message[] = 'registered successfully';
// 			header('location:login.php');
// 		}
// 	}
// }


function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

$name = $email = $pass = $cpass = $user_type = "";
$valid = "true";


if($_SERVER["REQUEST_METHOD"] == "POST"){

	if (empty($_POST['name'])) {
		$nameErr = "Name is required.";
		$message[] = 'Name is required';
		$valid = "false";
		
	} else {
		$name = test_input($_POST['name']);

		if(!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
			$message[] = 'Name field only allows letters and white space.';
			$valid = "false";
		}
	}

	if (empty($_POST['email'])) {
		$message[] = 'Email is required';
		$valid = "false";
	} else {
		$email = test_input($_POST['email']);

		if (!filter_var($email, FILTER_VALIDATE_EMAIL))  {
			$message[] = 'Invalid email format.';
			$valid = "false";
		}
	}

	if (empty($_POST['password'])) {
		$message[] = 'Password is required';
		$valid = "false";
	} else {
		$pass = test_input($_POST['password']);
	}

	if (empty($_POST['cpassword'])) {
		$message[] = 'Confirm password is required';
		$valid = "false";
	} else {
		$cpass = test_input($_POST['cpassword']);
	}

	if (empty($_POST['user_type'])) {
		$message[] = 'User type is required';
		$valid = "false";
	} else {
		$user_type = test_input($_POST['user_type']);
		if(($user_type != 'user') and ($user_type != 'admin')) {
			$message[] = 'Invalid user type.';
			$valid = "false";
		}
	}

	if ($valid == "true"){
		$name = mysqli_real_escape_string($conn, $name);
		$email = mysqli_real_escape_string($conn, $email);
		$pass = mysqli_real_escape_string($conn, $pass);
		$cpass = mysqli_real_escape_string($conn, $cpass);
		$user_type = mysqli_real_escape_string($conn, $user_type);

		$select_users = mysqli_query($conn, "SELECT * FROM Users WHERE Email = '$email' AND Password = '$pass'") or die('query failed');

		if(mysqli_num_rows($select_users) > 0) {
			$message[] = 'User already exists!';
		} else {
			if($pass != $cpass) {
				$message[] = 'Password and Confirm Password fields must match!';
			} else {
				$sql="INSERT INTO Users (Name, Email, Password, UserType) VALUES ('$name', '$email','$pass', '$user_type')";
				$conn->query($sql);

				$message[] = 'Registered successfully';
				header('location:login.php');
			}
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
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				<h4>Register</h4>
				<input type="text" name="name" placeholder="Name" class="box">
				<input type="email" name="email" placeholder="Email" class="box">
				<input type="password" name="password" placeholder="password" class="box">
				<input type="password" name="cpassword" placeholder="confirm password" class="box">
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