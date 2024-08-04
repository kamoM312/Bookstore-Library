<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
	header('location:login.php');
};

// CRUD - create

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

// CRUD - delete

if(isset($_GET['delete'])){
	$delete_id = $_GET['delete'];
	mysqli_query($conn, "DELETE FROM Products WHERE ID = '$delete_id'") or die('Query Unsuccessful!');
	header('location:admin_products.php');
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

				$select_products = mysqli_query($conn, "SELECT * FROM Products") or die('Query Unsuccessful!');
				if(mysqli_num_rows($select_products) > 0){ 
					while ($fetch_products = mysqli_fetch_assoc($select_products)) {
					
			?>

				<div class="box">
					
					<img src="img_uploaded/<?php echo $fetch_products['Image']; ?>" alt="">

					<div class="name"><?php echo $fetch_products['Name']; ?></div>
					<div class="price"><?php echo $fetch_products['Price']; ?></div>

					<a href="admin_products.php?update=<?php echo $fetch_products['ID']; ?>" class="option-btn">update</a>

					<a href="admin_products.php?delete=<?php echo $fetch_products['ID']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">delete</a>


				</div>
				<?php 

					}
				 }else {
					echo '<p class="empty">No product has been added yet!</p>';
				}

				?>

		


		</div>


	</section>

	<section class="edit-product-form">
		
		<?php 

			if(isset($_GET['update'])) {

				$update_id = $_GET['update'];
				$update_query = mysqli_query($conn, "SELECT * FROM Products WHERE ID = '$update_id'") or die("Query Unsuccessful!");
				if(mysqli_num_rows($update_query) > 0){
					while($fetch_update = mysqli_fetch_assoc($update_query)){

		?>
		<form action="" method="post" enctype="multipart/form-data">

			<input type="hidden" name="update_p_id" value="<?php echo $fetch_update['ID']; ?>">
			<input type="hidden" name="update_old_image" value="<?php echo $fetch_update['Image']; ?>">
			<img src="img_uploaded/<?php echo $fetch_update['Image']; ?>" alt="">
			<input class="box" type="text" name="update_name" value="<?php echo $fetch_update['Name']; ?>" placeholder="Enter product name" required>
			<input class="box" type="number" name="update_price" value="<?php echo $fetch_update['Price']; ?>" placeholder="Enter product price" min="0" required>
			<input type="file" name="update_image" class="box" accept="image/png, image/jpg, image/jpeg">
			<input type="submit" name="update_product" value="update" class="btn">
			<input type="reset" class="option-btn" id="close-update" value="cancel">
		</form>

		<?php
					}
				}

			} else{

			}

		?>

	</section>





















	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

	<script src="js/admin_script.js"></script>

</body>
</html>