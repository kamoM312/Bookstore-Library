 <?php

include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)) {
	header('location:login.php');
}

if(isset($_POST['order_btn'])){

	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$number = $_POST['number'];
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$method = mysqli_real_escape_string($conn, $_POST['method']);
	$address = mysqli_real_escape_string($conn, $_POST['street'].', '.$_POST['apartment'].', '. $_POST['city'].', '. $_POST['province'].', '. $_POST['country'].' - '. $_POST['postal']);
	$placed_on = date('d-M-Y');

	$cart_total = 0;
	$cart_products[] = '';

	$cart_query = mysqli_query($conn, "SELECT * FROM Cart WHERE USER_ID = '$user_id'") or die('Query Unsuccessful!');
	if(mysqli_num_rows($cart_query) > 0){
		while($cart_item = mysqli_fetch_assoc($cart_query)){
			$cart_products[] = $cart_item['Name'].' ('.$cart_item['Quantity'].')';
			$sub_total = ($cart_item['Price'] * $cart_item['Quantity']);
			$cart_total += $sub_total;
		}
	}

	// The implode() function returns a string from the elements of an array
	$total_products = implode(', ', $cart_products);

	$order_query = mysqli_query($conn, "SELECT * FROM Orders WHERE Name = '$name' AND Number = '$number' AND Email = '$email' AND Method = '$method' AND Address = '$address' AND Total_Products = '$total_products' AND Total_Price = '$cart_total'") or die('Query Unsuccessful');

	if($cart_total == 0) {
		$message[] = 'Your cart is empty!';
	} else {
		if(mysqli_num_rows($order_query) > 0){
				$message[] = 'Order already placed';
		} else {
			mysqli_query($conn, "INSERT INTO Orders (User_ID, Name, Number, Email, Method, Address, Total_Products, Total_Price, Placed_On) VALUES ('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('Query Unsuccessful!');
			
			$message[] = 'Order placed successfully!';

			mysqli_query($conn, "DELETE FROM Cart WHERE User_ID = '$user_id'") or die('Query Unsuccessful!');
		}
	}

}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Checkout - BookWorms</title>

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

 		<h3>checkout</h3>
 		<p><a href="home_page.php">home</a> / checkout </p>

 	</div>

 	<!-- display order section -->

 	<section class="display-order">
 		
 		<?php  
 			$cart_total = 0;
 			$select_cart = mysqli_query($conn, "SELECT * FROM Cart WHERE USER_ID = '$user_id'") or die('Query Unsuccessful!');
 			if(mysqli_num_rows($select_cart) > 0) {
 				while($fetch_cart = mysqli_fetch_assoc($select_cart)) {
 					$total_price = ($fetch_cart['Price'] * $fetch_cart['Quantity']);
 					$cart_total += $total_price;
 		?>

 		<p><?php echo $fetch_cart['Name']; ?><span> (<?php echo 'R '. $fetch_cart['Price'] .' x '. $fetch_cart['Quantity']; ?>)</span></p>

 		<?php
 				}
 			} else {
 					echo '<p class="empty">your cart is empty</p>';
 			}
 		?>
 		<div class="grand-total">grand total : <span>R <?php echo $cart_total ?></span></div>

 	</section>


<section class="checkout">
	
	<form method="post">
		<h3>place your order</h3>
		<div class="flex">
			<div class="input-box">
				<span>your name :</span>
				<input type="text" name="name" placeholder="enter your name..." required>
			</div>
			<div class="input-box">
				<span>your number :</span>
				<input type="number" name="number" placeholder="enter your number..." required>
			</div>
			<div class="input-box">
				<span>your email :</span>
				<input type="email" name="email" placeholder="enter your email..." required>
			</div>
			<div class="input-box">
				<span>payment mehod :</span>
				<select name="method">
					<option value="cash on delivery">cash on delivery</option>
					<option value="debit card">debit card</option>
					<option value="credit card">credit card</option>
					<option value="EFT">EFT</option>
				</select>
			</div>
			<div class="input-box">
				<span>address line 01 :</span>
				<input type="text" name="street" placeholder="Street address, P.O. box, company name, c/o" required>
			</div>
			<div class="input-box">
				<span>address line 02 :</span>
				<input type="text" name="apartment" placeholder="Apartment, suite, unit, building, floor, etc" required>
			</div>
			<div class="input-box">
				<span>city :</span>
				<input type="text" name="city" placeholder="Enter your city" required>
			</div>
			<div class="input-box">
				<span>State/Province/Region :</span>
				<input type="text" name="province" placeholder="Enter your state/province/region" required>
			</div>
			<div class="input-box">
				<span>postal code :</span>
				<input type="number" min="0" name="postal" placeholder="Enter your postal code" required>
			</div>
			<div class="input-box">
				<span>country :</span>
				<input type="text" name="country" placeholder="Enter your country " required>
			</div>
		</div>
		<div class="btn-flex">
			<input type="submit" class="btn" name="order_btn" value="order now">
		</div>
		
		
	</form>

</section>



 




	<?php include 'footer.php'; ?>

	<script src="js/script.js"></script>

</body>
</html>