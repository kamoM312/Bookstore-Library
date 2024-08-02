<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
	header('location:login.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> Administration Console</title>

	<!-- custom css -->
	<link rel="stylesheet" href="css/admin_style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

<!-- including admin_header.php file -->
<?php include 'admin_header.php'; ?>

<!-- Admin dashboard section -->

<section class="dashboard">
	
	<h1 class="title">Dashboard</h1>

	<div class="box-container">
		<!-- Getting number of pending orders from Orders table -->
		<div class="box">
			
			<?php 

				$total_pendings = 0;
				$select_pending = mysqli_query($conn, "SELECT Total_Price FROM Orders WHERE Payment_Status = 'pending'") or die('Query Unsuccessful!');
				if(mysqli_num_rows($select_pending) > 0) {
					while ($fetch_dependings = mysqli_fetch_assoc($select_pending)) {
						$total_price = $fetch_dependings['Total_Price'];
						$total_pendings += $total_price;
					};
				};

			 ?>
			 <h2><?php echo $total_pendings; ?></h2>
			 <p>Total Pending Payments</p>

		</div>

		<!-- Getting number of orders that have where the payment has been completed from Orders table -->
		<div class="box">
			
			<?php 

				$total_completed = 0;
				$select_completed= mysqli_query($conn, "SELECT Total_Price FROM Orders WHERE Payment_Status = 'completed'") or die('Query Unsuccessful!');
				if(mysqli_num_rows($select_completed) > 0) {
					while ($fetch_completed = mysqli_fetch_assoc($select_completed)) {
						$total_price = $fetch_completed['Total_Price'];
						$total_completed += $total_price;
					};
				};

			 ?>
			 <h2><?php echo $total_completed; ?></h2>
			 <p>Total Completed Payments</p>

		</div>

		<!-- Getting total number of orders from Orders table -->
		<div class="box">
			
			<?php 

				$select_orders = mysqli_query($conn, "SELECT * FROM Orders") or die('Query Unsuccessful!');
				$number_of_orders = mysqli_num_rows($select_orders);

			 ?>
			 <h2><?php echo $number_of_orders; ?></h2>
			 <p>Orders Placed</p>

		</div>

		<div class="box">
			
			<?php 

				$select_users = mysqli_query($conn, "SELECT * FROM Users WHERE UserType = 'user'") or die('Query Unsuccessful!');
				$number_of_users = mysqli_num_rows($select_users);

			 ?>
			 <h2><?php echo $number_of_users; ?></h2>
			 <p>Customers</p>

		</div>

		<div class="box">
			
			<?php 

				$select_admins = mysqli_query($conn, "SELECT * FROM Users WHERE UserType = 'admin'") or die('Query Unsuccessful!');
				$number_of_admins = mysqli_num_rows($select_admins);

			 ?>
			 <h2><?php echo $number_of_admins; ?></h2>
			 <p>Administrators</p>

		</div>

		<div class="box">
			
			<?php 

				$select_account = mysqli_query($conn, "SELECT * FROM Users") or die('Query Unsuccessful!');
				$number_of_account = mysqli_num_rows($select_account);

			 ?>
			 <h2><?php echo $number_of_account; ?></h2>
			 <p>Total Users</p>

		</div>

		<div class="box">
			
			<?php 

				$select_messages = mysqli_query($conn, "SELECT * FROM Message") or die('Query Unsuccessful!');
				$number_of_messages = mysqli_num_rows($select_messages);

			 ?>
			 <h2><?php echo $number_of_messages; ?></h2>
			 <p>Messages</p>

		</div>

	</div>

</section>


<!-- Admin dashboard section end -->

 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<!-- including js file -->
<script src="js/admin_script.js"></script>

</body>
</html>