<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
	header('location:login.php');
};

if(isset($_POST['add_product'])){
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$price = $_POST['price'];
	$image = $_FILES['image']['name'];
	$image_size = $_FILES['image']['size'];
	$image_tmp_name = $_FILES['image']['tmp_name'];
	$image_folder = 'img_uploaded/'.$image;

	$select_product_name = mysqli_query($conn, "SELECT Name FROM Products WHERE Name ='$name'") or die('Query Unsuccessful!');


	if(mysqli_num_rows($select_product_name) > 0){
		$message[] = 'Product with that name already exists!';
	} else {
		$add_product_query = mysqli_query($conn, "INSERT INTO Products (Name, Price, Image) VALUES ('$name', '$price', '$image')") or die('Query Unsuccessful!');

		if($add_product_query) {
			if($image_size > 2000000){
				$message[] = 'Image size is too large! Please select a smaller image.';
			} else {
				// Uploads file to img_uploaded folder
				move_uploaded_file($image_tmp_name, $image_folder);
				$message[] = 'Product added successfully!';
			} 
		}else {
			$message[] = 'Product could not be added!';
		}
	}
}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Products</title>

	<!-- custom css -->
	<link rel="stylesheet" href="css/admin_style.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

	<?php include 'admin_header.php'; ?>

	<!-- Product CRUD functionality - core feature -->

	<section class="add-products">

		<h1 class="title">Store Products</h1>

		<!-- enctype="multipart/form-data" is necessary if the user will upload a file through the form -->
		<!-- Required values forces user to enter input into a field -->
		<form method="post" enctype="multipart/form-data">

			<h3>Add Products</h3>
			<input type="text" name="name" placeholder="Enter product name..." class="box" required>
			<input type="number" min="0" name="price" class="box" placeholder="Enter product price..." required>
			<input type="file" name ="image" accept="image/png, image/jpg, image/jpeg" class="box" required>
			<input type="submit" name="add_product" value="Add Product" class="btn">


		</form>

	</section>

	<!-- Product CRUD section ends -->

	<!-- Products display section -->

	<section class="show-products">
		
		<div class="box-container">
			
			<?php 

				

			?>


		</div>


	</section>























	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

	<script src="js/admin_script.js"></script>

</body>
</html>