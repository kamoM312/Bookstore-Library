<?php

ini_set('display_errors', 1);


include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
	header('location:login.php');
};

// CRUD - create

if(isset($_POST['add_product'])){
	$name = mysqli_real_escape_string($conn, $_POST['name']);
	$author = mysqli_real_escape_string($conn, $_POST['author']);
	// adding catogory
	$category = mysqli_real_escape_string($conn, $_POST['category']);
	$sale = mysqli_real_escape_string($conn, $_POST['sale']);
	$new_arrival = mysqli_real_escape_string($conn, $_POST['arrival']);
	$price = $_POST['price'];
	$image = $_FILES['image']['name'];
	$image_size = $_FILES['image']['size'];
	$image_tmp_name = $_FILES['image']['tmp_name'];
	$image_folder = 'img_uploaded/'.$image;

	$select_product_name = mysqli_query($conn, "SELECT Name FROM Products WHERE Name ='$name'") or die('Query Unsuccessful!');


	if(mysqli_num_rows($select_product_name) > 0){
		$message[] = 'Product with that name already exists!';
	} else {
		$add_product_query = mysqli_query($conn, "INSERT INTO Products (Name, Author, Price, Image, Category, Sale, New_Arrival) VALUES ('$name', '$author','$price', '$image', '$category', '$sale', '$new_arrival')") or die('Query Unsuccessful!');

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
	$delete_image_query = mysqli_query($conn, "SELECT Image FROM Products WHERE ID = '$delete_id'") or die('Query Unsuccessful!');
	$fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
	unlink('img_uploaded/'.$fetch_delete_image['Image']);
	mysqli_query($conn, "DELETE FROM Products WHERE ID = '$delete_id'") or die('Query Unsuccessful!');
	header('location:admin_products.php');
}

// CRUD - update

if(isset($_POST['update_product'])){
	$update_p_id = $_POST['update_p_id'];
	$update_name = $_POST['update_name'];
	$update_author = $_POST['update_author'];
	$update_price = $_POST['update_price'];

	$update_category = $_POST['update_category'];
	$update_sale = $_POST['update_sale'];
	$update_arrival =$_POST['update_arrival'];

	mysqli_query($conn, "UPDATE Products SET Name = '$update_name', Author = '$update_author', Price = '$update_price', Category = '$update_category', Sale = '$update_sale', New_Arrival = '$update_arrival' WHERE ID = '$update_p_id'") or die('Query Unsuccessful!');

	$update_image = $_FILES['update_image']['name'];
	$update_image_tmp_name = $_FILES['update_image']['tmp_name'];
	$update_image_size = $_FILES['update_image']['size'];
	$update_foler = 'img_uploaded/'.$update_image;
	$update_old_image = $_POST['update_old_image'];

	if(!empty($update_image)){
		if($update_image_size > 2000000){
			$message[] = 'Image ize is too large! Please select a smaller image.';
		} else {
			mysqli_query($conn, "UPDATE Products SET Image = '$update_image' WHERE ID = '$update_p_id'") or die('Query Unsuccessful!');
			move_uploaded_file($update_image_tmp_name, $update_foler);
			unlink('img_uploaded/'.$update_old_image);
		}
	}

	// Return to admin_products.php after crud operation
	header('location:admin_products.php');

}



?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin: Products - BookWorms</title>

	<!-- custom css -->
	<link rel="stylesheet" href="css/admin_style.css">

	<!-- Add icon library -->
 	<link rel="stylesheet" 
 	href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
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
			<input type="text" name="author" placeholder="Enter author(s) name..." class="box" required>
			<input type="number" min="0" name="price" class="box" placeholder="Enter product price..." required>
			<!-- adding category drop-down list -->
			<select name="category" size="1" class="box" required>
				<option value="pick">Select a category:</option>
				<option value="Crime & Thriller">Crime & Thriller</option>
				<option value="Fantasy & Sci-Fi">Fantasy & Sci-Fi</option>
				<option value="Historical">Historical</option>
				<option value="Horror">Horror</option>			</select>

				<!-- sale status -->
				<select name="sale" size="1" class="box" required>
					<option value="select">On Sale?</option>
					<option value="no">No</option>
					<option value="yes">Yes</option>
				</select>

				<!-- new arrival -->
				<select name="arrival" size="1" class="box" required>
					<option value="select">New Arrival?</option>
					<option value="no">No</option>
					<option value="yes">Yes</option>
				</select>


				<input type="file" name ="image" accept="image/png, image/jpg, image/jpeg" class="box" required id="add-products-label">
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

							<div class="author"><?php echo $fetch_products['Author']; ?></div>

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
							<input class="box" type="text" name="update_author" value="<?php echo $fetch_update['Author']; ?>" placeholder="Enter product name" required>
							<input class="box" type="number" name="update_price" value="<?php echo $fetch_update['Price']; ?>" placeholder="Enter product price" min="0" required>
							<input type="file" name="update_image" class="box" accept="image/png, image/jpg, image/jpeg">

							<!-- adding category drop-down list -->
							<select class="box" id="update_category" name="update_category" size="1">
								<option value="<?php echo $fetch_update['Category']; ?>">Category: <?php echo $fetch_update['Category']; ?></option>

								<option value="Crime & Thriller">Crime & Thriller</option>
								<option value="Fantasy & Sci-Fi">Fantasy & Sci-Fi</option>
								<option value="Historical">Hisorical</option>
								<option value="Horror">Horror</option>
							</select>

							<!-- sale status -->
							<select name="update_sale" size="1" class="box" required>
								<option value="<?php echo $fetch_update['Sale']; ?>">On Sale? <?php echo $fetch_update['Sale']; ?></option>

								<option value="no">No</option>
								<option value="yes">Yes</option>
							</select>

							<!-- new arrival -->
							<select name="update_arrival" size="1" class="box" required>
								<option value="<?php echo $fetch_update['New_Arrival']; ?>">New Arrival? <?php echo $fetch_update['New_Arrival']; ?></option>
								<option value="no">No</option>
								<option value="yes">Yes</option>
							</select>
							<div class="flex">
								<input type="submit" name="update_product" value="update" class="option-btn">
							<input type="reset" class="delete-btn" id="close-update" value="cancel">
							</div>
						</form>

						<?php
					}
				}

			} else{
				echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
			}

			?>

		</section>

		<script src="js/admin_script.js"></script>

	</body>
	</html>