<?php

 include 'config.php';

 session_start();

 $user_id = $_SESSION['user_id'];

 if(!isset($user_id)) {
 	header('location:login.php');
 }

 // if(isset($_POST['add_to_cart'])){

 // 	$product_name = $_POST['product_name'];
 // 	$product_price = $_POST['product_price'];
 // 	$product_image = $_POST['product_image'];
 // 	$product_quantity = $_POST['product_quantity'];
 // 	$product_author = $_POST['product_author'];

 // 	$check_cart_numbers = mysqli_query($conn, "SELECT * FROM Cart WHERE Name = '$product_name' AND User_ID = '$user_id'") or die('Query Unsuccessful!');

 // 	if(mysqli_num_rows($check_cart_numbers) > 0) {
 // 		$message[] = 'already added to cart';
 // 	} else {
 // 		mysqli_query($conn, "INSERT INTO Cart (User_ID, Name, Price, Quantity, Image, Author) VALUES('$user_id', '$product_name', '$product_price','$product_quantity', '$product_image', '$product_author')") or die('Query Unsuccessful!');
 // 		$message[] = 'Product added to cart.';
 // 	}

 // }

  function test_input($data) {
 	$data = trim($data);
 	$data = stripslashes($data);
 	$data = htmlspecialchars($data);
 	return $data;
 }

// $product_name = $product_author = $product_image = $product_price = $product_quantity = "";

 $valid = "true";

 if($_SERVER["REQUEST_METHOD"] == "POST"){

 	if (empty($_POST['product_name'])) {
 		$valid = "false";
 	} else {
 		$product_name = test_input($_POST['product_name']);
 	}

 	if (empty($_POST['product_price'])) {
 		$valid = "false";
 	} else {
 		$product_price = test_input($_POST['product_price']);
 	}

 	if (empty($_POST['product_image'])) {
 		$valid = "false";
 	} else {
 		$product_image = test_input($_POST['product_image']);
 	}

 	if (empty($_POST['product_quantity'])) {
        $valid = "false";
    } else {
        $product_quantity = test_input($_POST['product_quantity']);
        if (!preg_match("/\d/", $product_quantity) || ($product_quantity < 1)) {
            $message[] = "Product quantity should be a number equal to or greater than 1";
            $valid = "false";
        }
    }

 	if (empty($_POST['product_author'])) {
 		$valid = "false";
 	} else {
 		$product_author = test_input($_POST['product_author']);
 	}

 	if ($valid == "true"){
 		$product_name = mysqli_real_escape_string($conn, $product_name);
 		$product_price = mysqli_real_escape_string($conn, $product_price);
 		$product_image = mysqli_real_escape_string($conn, $product_image);
 		$product_quantity = mysqli_real_escape_string($conn, $product_quantity);
 		$product_author = mysqli_real_escape_string($conn, $product_author);

 		$check_cart_numbers = mysqli_query($conn, "SELECT * FROM Cart WHERE Name = '$product_name' AND User_ID = '$user_id'") or die('Query Unsuccessful!');

 		if(mysqli_num_rows($check_cart_numbers) > 0) {
 			$message[] = 'already added to cart';
 		} else {
 			mysqli_query($conn, "INSERT INTO Cart (User_ID, Name, Price, Quantity, Image, Author) VALUES('$user_id', '$product_name', '$product_price','$product_quantity', '$product_image', '$product_author')") or die('Query Unsuccessful!');
 			$message[] = 'Product added to cart.';
 		}

 	} else {
 		$message[] = 'Product values invalid!';
 	}


 }

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Shop: New Arrivals - BookWorms</title>

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

 		<h3>new arrivals</h3>
 		<p><a href="home_page.php">home</a> / <a href="shop.php">shop</a> / new </p>

 	</div>

 	<section class="products">

 		<h1 class="title">explore our books</h1>

 		<div class="box-container">

 			<!-- <h2>New arrivals</h2> -->

 			<?php 

 			$select_products = mysqli_query($conn, "SELECT * FROM Products WHERE New_Arrival = 'yes'") or die("Query Unsuccessful!");

 			if(mysqli_num_rows($select_products) > 0){
 				while($fetch_products = mysqli_fetch_assoc($select_products)){
 					?>

 					<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" class="box">

 						<img class="image" src="img_uploaded/<?php echo $fetch_products['Image']; ?>" alt="">
 						<div class="name"><?php echo $fetch_products['Name']; ?></div>	
 						<div class="name">By: <?php echo $fetch_products['Author']; ?></div>
 						<div class="price">R <?php echo $fetch_products['Price']; ?></div>
 						<input class="qty" type="number" min="1" name="product_quantity" value="1">

 						<input type="hidden" name="product_name" value="<?php echo $fetch_products['Name']; ?>">

 						<input type="hidden" name="product_author" value="<?php echo $fetch_products['Author']; ?>">


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

 </section>


 	<?php include 'footer.php'; ?>

 	<script src="js/script.js"></script>

 </body>
 </html>