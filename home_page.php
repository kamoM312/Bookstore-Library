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
 	<title>Home - BookWorms</title>

 	<!-- Add icon library -->
 	<link rel="stylesheet" 
 	href=
 	"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

 	<!-- custom css -->
 	<link rel="stylesheet" href="css/style.css">
 </head>

 <body>

 	<?php include 'header.php'; ?>

 	<section class="home">

 		<div class="content">

 			<h3>We have a book for everyone!</h3>
 			<a href="about.php" class="white-btn">Learn more</a>

 		</div>

 	</section>

 	<!-- create slide show of best sellers -->

 	<!-- display products -->

 	<section class="products">

 		<h1 class="title">New arrivals</h1>

 		<div class="see-more">
 			<a href="shopNew.php">View More</a>
 		</div>

 		<div class="box-container">

 			<!-- <h2>New arrivals</h2> -->

 			<?php 

 			$select_products = mysqli_query($conn, "SELECT * FROM Products WHERE New_Arrival = 'yes' LIMIT 3") or die("Query Unsuccessful!");

 			if(mysqli_num_rows($select_products) > 0){
 				while($fetch_products = mysqli_fetch_assoc($select_products)){
 					?>

 					<form method="post" class="box">

 						<img class="image" src="img_uploaded/<?php echo $fetch_products['Image']; ?>" alt="">
 						<div class="name"><?php echo $fetch_products['Name']; ?></div>
 						<div class="name">By: <?php echo $fetch_products['Author']; ?></div>
 						<div class="price">R <?php echo $fetch_products['Price']; ?></div>
 						<input class="qty" type="number" min="1" name="product_quantity" value="1">

 						<input type="hidden" name="product_name" value="<?php echo $fetch_products['Name']; ?>">

 						<input type="hidden" name="product_price" value="<?php echo $fetch_products['Price']; ?>">

 						<input type="hidden" name="product_image" value="<?php echo $fetch_products['Image']; ?>">

 						<input type="submit" name="add_to_cart" value="add to cart" class="btn">					

 					</form>

 					<?php 
 				}
 			} else {
 				echo '<p class="empty">no products added yet!</p>';
 			} 
 			?>
 		</div>


 		<!-- sale -->
 		<h1 class="title">On Sale</h1>

 		<div class="see-more">
 			<a href="shopSale.php">View More</a>
 		</div>

 		<div class="box-container">



 			<?php 

 			$select_products = mysqli_query($conn, "SELECT * FROM Products WHERE Sale = 'yes' LIMIT 3") or die("Query Unsuccessful!");

 			if(mysqli_num_rows($select_products) > 0){
 				while($fetch_products = mysqli_fetch_assoc($select_products)){
 					?>

 					<form method="post" class="box">

 						<img class="image" src="img_uploaded/<?php echo $fetch_products['Image']; ?>" alt="">
 						<div class="name"><?php echo $fetch_products['Name']; ?></div>	
 						<div class="name">By: <?php echo $fetch_products['Author']; ?></div>
 						<div class="price">R <?php echo $fetch_products['Price']; ?></div>
 						<input class="qty" type="number" min="1" name="product_quantity" value="1">

 						<input type="hidden" name="product_name" value="<?php echo $fetch_products['Name']; ?>">

 						<input type="hidden" name="product_price" value="<?php echo $fetch_products['Price']; ?>">

 						<input type="hidden" name="product_image" value="<?php echo $fetch_products['Image']; ?>">

 						<input type="submit" name="add_to_cart" value="add to cart" class="btn">					

 					</form>

 					<?php 
 				}
 			} else {
 				echo '<p class="empty">no products added yet!</p>';
 			} 
 			?>
 		</div>


 		<!-- catogories -->
 		<!-- fantasy and sci fi -->
 		<h1 class="title">Fantasy & Sci-Fi</h1>

 		<div class="see-more">
 			<a href="shopFantasySciFi.php">View More</a>
 		</div>

 		<div class="box-container">

 			<?php 

 			$select_products = mysqli_query($conn, "SELECT * FROM Products WHERE Category = 'Fantasy & Sci-Fi' LIMIT 3") or die("Query Unsuccessful!");

 			if(mysqli_num_rows($select_products) > 0){
 				while($fetch_products = mysqli_fetch_assoc($select_products)){
 					?>

 					<form method="post" class="box">

 						<img class="image" src="img_uploaded/<?php echo $fetch_products['Image']; ?>" alt="">
 						<div class="name"><?php echo $fetch_products['Name']; ?></div>	
 						<div class="name">By: <?php echo $fetch_products['Author']; ?></div>
 						<div class="price">R <?php echo $fetch_products['Price']; ?></div>
 						<input class="qty" type="number" min="1" name="product_quantity" value="1">

 						<input type="hidden" name="product_name" value="<?php echo $fetch_products['Name']; ?>">

 						<input type="hidden" name="product_price" value="<?php echo $fetch_products['Price']; ?>">

 						<input type="hidden" name="product_image" value="<?php echo $fetch_products['Image']; ?>">

 						<input type="submit" name="add_to_cart" value="add to cart" class="btn">					

 					</form>

 					<?php 
 				}
 			} else {
 				echo '<p class="empty">no products added yet!</p>';
 			} 
 			?>
 		</div>

 		<!-- fantasy and sci fi -->
 		<h1 class="title">Crime & Thriller</h1>

 		<div class="see-more">
 			<a href="shopCrimeThriller.php">View More</a>
 		</div>

 		<div class="box-container">

 			<?php 

 			$select_products = mysqli_query($conn, "SELECT * FROM Products WHERE Category = 'Crime & Thriller' LIMIT 3") or die("Query Unsuccessful!");

 			if(mysqli_num_rows($select_products) > 0){
 				while($fetch_products = mysqli_fetch_assoc($select_products)){
 					?>

 					<form method="post" class="box">

 						<img class="image" src="img_uploaded/<?php echo $fetch_products['Image']; ?>" alt="">
 						<div class="name"><?php echo $fetch_products['Name']; ?></div>
 						<div class="name">By: <?php echo $fetch_products['Author']; ?></div>	
 						<div class="price">R <?php echo $fetch_products['Price']; ?></div>
 						<input class="qty" type="number" min="1" name="product_quantity" value="1">

 						<input type="hidden" name="product_name" value="<?php echo $fetch_products['Name']; ?>">

 						<input type="hidden" name="product_price" value="<?php echo $fetch_products['Price']; ?>">

 						<input type="hidden" name="product_image" value="<?php echo $fetch_products['Image']; ?>">

 						<input type="submit" name="add_to_cart" value="add to cart" class="btn">					

 					</form>

 					<?php 
 				}
 			} else {
 				echo '<p class="empty">no products added yet!</p>';
 			} 
 			?>
 		</div>

 		<!-- fantasy and sci fi -->
 		<h1 class="title">Historical</h1>

 		<div class="see-more">
 			<a href="shopHistorical.php">View More</a>
 		</div>

 		<div class="box-container">

 			<?php 

 			$select_products = mysqli_query($conn, "SELECT * FROM Products WHERE Category = 'Historical' LIMIT 3") or die("Query Unsuccessful!");

 			if(mysqli_num_rows($select_products) > 0){
 				while($fetch_products = mysqli_fetch_assoc($select_products)){
 					?>

 					<form method="post" class="box">

 						<img class="image" src="img_uploaded/<?php echo $fetch_products['Image']; ?>" alt="">
 						<div class="name"><?php echo $fetch_products['Name']; ?></div>	
 						<div class="name">By: <?php echo $fetch_products['Author']; ?></div>
 						<div class="price">R <?php echo $fetch_products['Price']; ?></div>
 						<input class="qty" type="number" min="1" name="product_quantity" value="1">

 						<input type="hidden" name="product_name" value="<?php echo $fetch_products['Name']; ?>">

 						<input type="hidden" name="product_price" value="<?php echo $fetch_products['Price']; ?>">

 						<input type="hidden" name="product_image" value="<?php echo $fetch_products['Image']; ?>">

 						<input type="submit" name="add_to_cart" value="add to cart" class="btn">					

 					</form>

 					<?php 
 				}
 			} else {
 				echo '<p class="empty">no products added yet!</p>';
 			} 
 			?>
 		</div>

 		<!-- fantasy and sci fi -->
 		<h1 class="title">Horror</h1>

 		<div class="see-more">
 			<a href="shopHorror.php">View More</a>
 		</div>

 		<div class="box-container">

 			<?php 

 			$select_products = mysqli_query($conn, "SELECT * FROM Products WHERE Category = 'Horror' LIMIT 3") or die("Query Unsuccessful!");

 			if(mysqli_num_rows($select_products) > 0){
 				while($fetch_products = mysqli_fetch_assoc($select_products)){
 					?>

 					<form method="post" class="box">

 						<img class="image" src="img_uploaded/<?php echo $fetch_products['Image']; ?>" alt="">
 						<div class="name"><?php echo $fetch_products['Name']; ?></div>	
 						<div class="name">By: <?php echo $fetch_products['Author']; ?></div>
 						<div class="price">R <?php echo $fetch_products['Price']; ?></div>
 						<input class="qty" type="number" min="1" name="product_quantity" value="1">

 						<input type="hidden" name="product_name" value="<?php echo $fetch_products['Name']; ?>">

 						<input type="hidden" name="product_price" value="<?php echo $fetch_products['Price']; ?>">

 						<input type="hidden" name="product_image" value="<?php echo $fetch_products['Image']; ?>">

 						<input type="submit" name="add_to_cart" value="add to cart" class="btn">					

 					</form>

 					<?php 
 				}
 			} else {
 				echo '<p class="empty">no products added yet!</p>';
 			} 
 			?>
 		</div>

 		<div class="load-more">
 			<a href="shop.php" class="white-btn">View All</a>
 		</div>

 	</section>

 	<!-- about section -->

 	<section class="about">

 		<div class="flex">

 			<div class="image">

 				<img src="images/ai-generated-8716779_1280.jpg" alt="about us image">

 			</div>

 			<div class="content">

 				<h3>about us</h3>
 				<p>Quisque non tellus orci ac auctor. Sodales ut eu sem integer vitae. Lorem donec massa sapien faucibus. Id faucibus nisl tincidunt eget nullam non nisi est. Luctus accumsan tortor posuere ac ut consequat. Fusce id velit ut tortor pretium viverra suspendisse. Lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque.</p>
 				<a href="about.php" class="btn">read more</a>

 			</div>

 		</div>

 	</section>

 	<!-- contact us section -->

 	<section class="home-contact">

 		<div class="content">
 			<h3>reach out to us!</h3>
 			<p>Venenatis cras sed felis eget. Vitae turpis massa sed elementum tempus egestas sed. Facilisi etiam dignissim diam quis enim. Sed tempus urna et pharetra pharetra massa massa ultricies. Interdum consectetur libero id faucibus nisl.</p>
 			<a href="contact.php" class="white-btn">contact us</a>
 		</div>

 	</section>












 	<?php include 'footer.php'; ?>

 	<script src="js/script.js"></script>

 </body>
 </html>