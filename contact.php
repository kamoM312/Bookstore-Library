 <?php

 ini_set('display_errors', 1);

 include 'config.php';

 session_start();

 $user_id = $_SESSION['user_id'];

 if(!isset($user_id)) {
 	header('location:login.php');
 }

// if(isset($_POST['send'])){

// 	$name = mysqli_real_escape_string($conn, $_POST['name']);
// 	$email = mysqli_real_escape_string($conn, $_POST['email']);
// 	$number = $_POST['number'];
// 	$msg = mysqli_real_escape_string($conn, $_POST['message']);

// 	$select_message = mysqli_query($conn, "SELECT * FROM Message WHERE Name = '$name' AND Email = '$email' AND Number = '$number' AND Message = '$msg'") or die('Query Unsuccessful');

// 	if(mysqli_num_rows($select_message) > 0){
// 		$message[] = 'message has already been sent';
// 	} else {
// 		mysqli_query($conn, "INSERT INTO Message (User_ID, Name, Email, Number, Message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('Query Unsuccessful!');
// 		$message[] = 'message was successfully sent!';
// 	}

// }

 function test_input($data) {
 	$data = trim($data);
 	$data = stripslashes($data);
 	$data = htmlspecialchars($data);
 	return $data;
 }

 $valid = "true";

 if($_SERVER["REQUEST_METHOD"] == "POST"){

 	if (empty($_POST['name'])) {
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

 	if (empty($_POST['message'])) {
 		$valid = "false";
 	} else {
 		$msg = test_input($_POST['message']);
 	}

 	if (empty($_POST['number'])) {
 		$valid = "false";
 	} else {
 		$number = test_input($_POST['number']);
 	}

 	if ($valid == "true"){
 		$name = mysqli_real_escape_string($conn, $name);
 		$email = mysqli_real_escape_string($conn, $email);
 		$number = mysqli_real_escape_string($conn, $number);
 		$msg = mysqli_real_escape_string($conn, $msg);

 		$select_message = mysqli_query($conn, "SELECT * FROM Message WHERE Name = '$name' AND Email = '$email' AND Number = '$number' AND Message = '$msg'") or die('Query Unsuccessful!');

 		if(mysqli_num_rows($select_message) > 0){
 			$message[] = 'message has already been sent';
 		} else {
 			mysqli_query($conn, "INSERT INTO Message (User_ID, Name, Email, Number, Message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('Query Unsuccessful!');
 			$message[] = 'message was successfully sent!';
 		}
 	}
 }


 	?>

 	<!DOCTYPE html>
 	<html>
 	<head>
 		<meta charset="utf-8">
 		<meta name="viewport" content="width=device-width, initial-scale=1">
 		<title>contact us</title>

 		<!-- Add icon library -->
 		<link rel="stylesheet" 
 		href=
 		"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

 		<!-- custom css -->
 		<link rel="stylesheet" href="css/style.css">
 	</head>
 	<body>

 	</head>
 	<body>

 		<?php include 'header.php'; ?>

 		<div class="heading">

 			<h3>contact us</h3>
 			<p><a href="home_page.php">home</a> / contact </p>

 		</div>

 		<!-- contact form -->

 		<section class="contact">

 			<div class="contact-textarea">
 				<h3>Contact us</h3>
 				<p>We would like to hear from you. Please send us a message by filling out the form below and we will get back with you shortly.</p>
 			</div>

 			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

 				<input class="box" type="text" name="name" placeholder="Enter your name..." required>
 				<input class="box" type="email" name="email" placeholder="Enter your email..." required>
 				<input class="box" type="number" name="number" placeholder="Enter your contact number..." required>
 				<textarea class="box" name="message" placeholder="Enter your message here..." cols="30" rows="10" required></textarea>
 				<div class="flex">
 					<input type="submit" name="send" value="send message" class="btn">
 				</div>


 			</form>

 		</section>

 		<?php include 'footer.php'; ?>

 		<script src="js/script.js"></script>

 	</body>
 	</html>