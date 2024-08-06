<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
	header('location:login.php');
};

// Update Orders table
if(isset($_POST['update_order'])){

	$order_update_id = $_POST['order_id'];
	$update_payment = $_POST['update_payment'];
	mysqli_query($conn, "UPDATE Orders SET Payment_Status = '$update_payment' WHERE ID = '$order_update_id'") or die('Query Unsuccessful');
	$message[] = 'Payment status update successful!';
}

// delete from Orders table
if(isset($_GET['delete'])){
	$delete_id = $_GET['delete'];
	mysqli_query($conn, "DELETE FROM Orders WHERE ID = '$delete_id'") or die('Query Unsuccessful!');
	// php redirect back to admin_orders.php from admin_orders.php?delete
	header('location:admin_orders.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Orders</title>

	<!-- custom css -->
	<link rel="stylesheet" href="css/admin_style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

	<?php include 'admin_header.php'; ?>

	<section class="orders">
		
		<h1 class="title">Placed Orders</h1>

		<div class="box-container">
			
			<?php 

			$select_orders = mysqli_query($conn, "SELECT * FROM Orders") or die('Query Unsuccessful!');
 		// fetch rows as an associative array
			if(mysqli_num_rows($select_orders) > 0){
				while($fetch_orders = mysqli_fetch_assoc($select_orders)){

					?>

					<div class="box">
						
						<p>user id : <span><?php echo $fetch_orders['User_ID']; ?></span></p>
						<p>placed on : <span><?php echo $fetch_orders['Placed_On']; ?></span></p>
						<p>name : <span><?php echo $fetch_orders['Name']; ?></span></p>
						<p>number : <span><?php echo $fetch_orders['Number']; ?></span></p>
						<p>email : <span><?php echo $fetch_orders['Email']; ?></span></p>
						<p>address : <span><?php echo $fetch_orders['Address']; ?></span></p>
						<p>total products : <span><?php echo $fetch_orders['Total_Products']; ?></span></p>
						<p>total price : <span>R <?php echo $fetch_orders['Total_Price']; ?></span></p>
						<p>payment method : <span><?php echo $fetch_orders['Method']; ?></span></p>

						<form action="" method="post">
							<!-- the hidden field stores the database record that needs to be updated when the form is submitted -->
							
							<input type="hidden" name="order_id" value="<?php echo $fetch_orders['ID']; ?>">
							<select name="update_payment">

								<!-- select disabled hides the value from the $fetch_orders variable until the user clicks on the drop-down -->

								<option value="" selected disabled><?php echo $fetch_orders['Payment_Status']; ?> 
							</option>
							<option value="pending">pending</option>
							<option value="completed">completed</option>
						</select>

						<input type="submit" name="update_order" value="update" class="option-btn">
						<a href="admin_orders.php?delete=<?php echo $fetch_orders['ID']; ?>" onclick="return confirm('Delete this order?');" class="delete-btn">Delete</a>

					</form>

				</div>

				<?php 

			}
		} else {
			echo '<p class="empty">No orders have been placed yet!</p>';
		}

		?>

	</div>

</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> 

<script src="js/admin_script.js"></script>

</body>
</html>