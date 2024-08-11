 <?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)) {
	header('location:login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>

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









 




	<?php include 'footer.php'; ?>

	<script src="js/script.js"></script>

</body>
</html>