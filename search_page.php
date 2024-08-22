 <?php

 include 'config.php';

 session_start();

 $user_id = $_SESSION['user_id'];

 if(!isset($user_id)) {
 	header('location:login.php');
 }

  if(isset($_POST['add_to_cart'])){

 	$product_name = $_POST['product_name'];
 	$product_price = $_POST['product_price'];
 	$product_image = $_POST['product_image'];
 	$product_quantity = $_POST['product_quantity'];

 	$check_cart_numbers = mysqli_query($conn, "SELECT * FROM Cart WHERE Name = '$product_name' AND User_ID = '$user_id'") or die('Query Unsuccessful!');

 	if(mysqli_num_rows($check_cart_numbers) > 0) {
 		$message[] = 'already added to cart';
 	} else {
 		mysqli_query($conn, "INSERT INTO Cart (User_ID, Name, Price, Quantity, Image) VALUES('$user_id', '$product_name', '$product_price','$product_quantity', '$product_image')") or die('Query Unsuccessful!');
 		$message[] = 'Product added to cart.';
 	}

 }

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>search page</title>

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

 		<h3>search page</h3>
 		<p><a href="home_page.php">home</a> / search </p>

 	</div>

 	<section class="search-form">
 		
 		<form method="post">
 			<input class="box" type="text" name="search" placeholder="search products...">
 			<input class="btn" type="submit" name="submit" value="search">
 		</form>

 	</section>

 	<section class="products">
 		
 		<div class="box-container">
 			
 			<?php  

 			if(isset($_POST['submit'])){
 				$search_item = $_POST['search'];
 				$select_products = mysqli_query($conn, "SELECT * FROM Products WHERE Name LIKE '%{$search_item}%'") or die('Query Unsuccessful!');
 				if(mysqli_num_rows($select_products) > 0){
 					while($fetch_products = mysqli_fetch_assoc($select_products)){
 			?>

 			<form method="post" class="box">

 						<img class="image" src="img_uploaded/<?php echo $fetch_products['Image']; ?>" alt="">
 						<div class="name"><?php echo $fetch_products['Name']; ?></div>	
 						<div class="price">R <?php echo $fetch_products['Price']; ?></div>
 						<input class="qty" type="number" min="1" name="product_quantity" value="1">

 						<input type="hidden" name="product_name" value="<?php echo $fetch_products['Name']; ?>">

 						<input type="hidden" name="product_price" value="<?php echo $fetch_products['Price']; ?>">

 						<input type="hidden" name="product_image" value="<?php echo $fetch_products['Image']; ?>">

 						<input type="submit" name="add_to_cart" value="add to cart" class="btn">					

 					</form>

 			<?php
 					}
 				} else{
 					echo '<p class="empty">No result(s) found!</p>';
 				}
 			} else {
 				echo '<p class="empty">Begin search!</p>';
 			}

 			?>


 		</div>


 	</section>










 




	<?php include 'footer.php'; ?>

	<script src="js/script.js"></script>

</body>
</html>