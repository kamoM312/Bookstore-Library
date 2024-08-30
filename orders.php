 <?php

 include 'config.php';

 session_start();

 $user_id = $_SESSION['user_id'];

 if(!isset($user_id)) {
 	header('location:login.php');
 }

 if(isset($_GET['delete'])){
 	$delete_id = $_GET['delete'];
 	mysqli_query($conn, "DELETE FROM Orders WHERE ID = '$delete_id'") or die('Query Unsuccessful!');
  	$message[] = 'Order was canceled!';
 }

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Orders - BookWorms</title>

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

 		<h3>orders</h3>
 		<p><a href="home_page.php">home</a> / orders </p>

 	</div>

 	<section class="placed-orders">
 		
 		<h1 class="title">Orders</h1>

 		<div class="box-container">
 			
 			<?php  
 			$order_query = mysqli_query($conn, "SELECT * FROM Orders WHERE User_ID = '$user_id'") or die('Query Unsuccessful!');
 			if(mysqli_num_rows($order_query) > 0){
 				while($fetch_orders = mysqli_fetch_assoc($order_query)){
 					?>

 					<div class="box">
 						
 						<p>placed on : <span><?php echo $fetch_orders['Placed_On'] ?></p>
 							<p>name : <span><?php echo $fetch_orders['Name'] ?></p>
 								<p>number : <span><?php echo $fetch_orders['Number'] ?></span></p>
 								<p>email : <span><?php echo $fetch_orders['Email'] ?></span></p>
 								<p>address : <span><?php echo $fetch_orders['Address'] ?></span></p>
 								<p>payment method : <span><?php echo $fetch_orders['Method'] ?></span></p>
 								<p>your orders : <span><?php echo $fetch_orders['Total_Products'] ?></span></p>
 								<p>total price : <span>R <?php echo $fetch_orders['Total_Price'] ?></span></p>
 								<p>payment status : <span style="color:<?php if ($fetch_orders['Payment_Status'] == 'pending') { echo 'red'; } else { echo 'green'; } ?>;"><?php echo $fetch_orders['Payment_Status']; ?></span></p>

 								<div class="flex">
 									<a href="orders.php?delete=<?php echo $fetch_orders['ID']; ?>" onclick="return confirm('Cancel this order?');" class="delete-btn <?php echo ($fetch_orders['Payment_Status'] == 'pending')?'':'disabled'; ?>">cancel</a>
 								</div>
 								}
 				
 								
 							</div>

 							<?php
 						}
 					}else {
 						echo '<p class="empty">no orders placed yet!</p>';
 					}
 					?>

 				</div>


 			</section>






 			




 			<?php include 'footer.php'; ?>

 			<script src="js/script.js"></script>

 		</body>
 		</html>