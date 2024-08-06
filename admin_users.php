<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
	header('location:login.php');
}

// delete users
if(isset($_GET['delete'])){
	$delete_id = $_GET['delete'];
	mysqli_query($conn, "DELETE FROM Users WHERE ID = '$delete_id'") or die('Query Unsuccessful!');
	// php redirect
	header('location:admin_users.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Administrators</title>

	<!-- custom css -->
	<link rel="stylesheet" href="css/admin_style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<?php include 'admin_header.php'; ?>

<section class="users">
	<h1 class="title">User Accounts</h1>
	
	<div class="box-container">
		
		<?php 

		$select_users = mysqli_query($conn, "SELECT * FROM Users") or die('Query Unsuccessful!');
		while($fetch_users = mysqli_fetch_assoc($select_users)){

			?>
			<div class="box">
				
				<p>Username : <span><?php echo $fetch_users['Name']; ?></span></p>
				<p>Email : <span><?php echo $fetch_users['Email']; ?></span></p>
				<!-- add code to have admin be a different color -->
				<p>User type : <span><?php echo $fetch_users['UserType']; ?></span></p>
				<a href="admin_users.php?delete=<?php echo $fetch_users['ID']; ?>" onclick="return confirm('Delete this user?');" class="delete-btn">Delete</a>

			</div>
			<?php
				};

		?>

	</div>

</section>

























	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 

	<script src="js/admin_script.js"></script>

</body>
</html>