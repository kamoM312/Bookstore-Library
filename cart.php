 <?php

 include 'config.php';

 session_start();

 $user_id = $_SESSION['user_id'];

 if(!isset($user_id)) {
 	header('location:login.php');
 }

// update cart
 if(isset($_POST['update_cart'])) {
 	$cart_id = $_POST['cart_id'];
 	$cart_quantity = $_POST['cart_quantity'];
 	mysqli_query($conn, "UPDATE Cart SET Quantity = '$cart_quantity' WHERE ID = '$cart_id'") or die('Query Unsuccessful!');
 	$message[] = 'cart quantity has been updated';
 }

// delete cart item
 if (isset($_GET['delete'])) {
 	$delete_id = $_GET['delete'];
 	mysqli_query($conn, "DELETE FROM Cart WHERE ID = '$delete_id'") or die('Query Unsuccessful!');
 	header('location:cart.php');
 }

// delete all cart items
 if (isset($_GET['delete_all'])) {
 	mysqli_query($conn, "DELETE FROM Cart WHERE User_ID = '$user_id'") or die('Query Unsuccessful!');
 	header('location:cart.php');
 }


 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>cart</title>

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
 		<p><a href="home_page.php">home</a> / cart </p>

 	</div>

 	<section class="shopping-cart">
 		
 		<h1 class="title">your cart</h1>

 		<div class="box-container">
 			
 			<?php 

 			$select_cart = mysqli_query($conn, "SELECT * FROM Cart WHERE User_ID = '$user_id'") or die('Query Unsuccessful!');
 			if (mysqli_num_rows($select_cart) > 0) {
 				while($fetch_cart = mysqli_fetch_assoc($select_cart)) {

 					?>
 					<!-- update cart -->
 					<div class="box">
 						<a href="cart.php?delete=<?php echo $fetch_cart['ID'] ?>" class="fas fa-times" onclick="return confirm('This cart item will be removed. Proceed?')"></a>
 						<img src="img_uploaded/<?php echo $fetch_cart['Image']; ?>">
 						<div class="name"><?php echo $fetch_cart['Name']; ?></div>
 						<div class="price">R <?php echo $fetch_cart['Price']; ?></div>
 						<form method="post">
 							<input type="hidden" name="cart_id" value="<?php echo $fetch_cart['ID']; ?>">
 							<input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['Quantity']; ?>">
 							<input type="submit" name="update_cart" value="update" class="btn">
 						</form>
 						<div class="sub-total">sub total :<span> R <?php echo $sub_total = ($fetch_cart['Quantity'] * $fetch_cart['Price']); ?></span></div>
 					</div>

 					<?php
 					$cart_total += $sub_total;
 				}
 			} else {
 				echo '<p class="empty">your cart is empty</p>';
 			}
 			?>
 		</div>

 		<div class="cart-delete">
 			<a href="cart.php?delete_all" class="delete-btn <?php echo ($cart_total > 1)?'':'disabled'; ?>" onclick="return confirm('All cart items will be removed. Proceed?')">clear cart</a>
 		</div>

 		<div class="cart-total">
 			<p>cart total : <span>R <?php echo $cart_total; ?></span></p>
 			<div class="flex">
 				<a href="shop.php" class="option-btn">continue shopping</a>
 				<a href="checkout.php" class="btn <?php echo ($cart_total > 1)?'':'disabled'; ?>">proceed to checkout</a>
 			</div>
 		</div>


 	</section>







 	




 	<?php include 'footer.php'; ?>

 	<script src="js/script.js"></script>

 </body>
 </html>