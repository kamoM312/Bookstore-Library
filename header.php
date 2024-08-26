<?php

if(isset($message)) {
	foreach ($message as $message) {
		echo ' 
		<div class="message">
			<span>'.$message.'</span>
			<i class="fas fa-times" onclick="this.parentElement.remove();"></i>
		</div>';
	}
}

?>

<header class="header">

<link rel="icon" type="image/x-icon" href=images/icons8-bookstore-66.png>

<a target="_blank" href="https://icons8.com/icon/R1rn7WbAKt5O/bookstore">Bookstore</a> icon by <a target="_blank" href="https://icons8.com">Icons8</a>

	<div class="header-1">
		<div class="flex">
			<div class="logo-nav">
				<a href="home_page.php" class="logo">Book<span>Worms.</span></a>	
			</div>
			<p><a href="register.php">Sign up</a> | <a href="login.php">Sign in</a></p>
		</div>
	</div>
	<div class="header-2">
		<div class="flex">
			<nav class="navbar">
				<a href="home_page.php">home</a>
				<a href="about.php">about</a>
				<div class="dropdown">
					<button class="dropbtn">shop
						<i class="fa fa-caret-down"></i>
					</button>
					<div class="dropdown-content">
						<a href="shop.php">all books</a>
						<a href="shopNew.php">new arrivals</a>
						<a href="shopSale.php">sale</a>
						<a href="shopFantasySciFi.php">fantasy & sci-fi</a>
						<a href="shopCrimeThriller.php">crime & thriller</a>
						<a href="shopHistorical.php">historical</a>
						<a href="shopHorror.php">horror</a>
					</div>
				</div> 
				<a href="contact.php">contact</a>
				<a href="orders.php">orders</a>
			</nav>

			<div class="icons">
				<div id="menu-btn" class="fas fa-bars"> Menu |</div>
				<a href="search_page.php" class="fas fa-search"> Search |</a>
				<div id="user-btn" class="fas fa-user"> Account |</div>

				<?php 
					$select_cart_number = mysqli_query($conn, "SELECT * FROM Cart WHERE USER_ID = '$user_id'") or die('Query Unsuccessful!');
					$cart_rows_number = mysqli_num_rows($select_cart_number);
				?>

				<a href="cart.php"><i class="fas fa-shopping-cart"> Cart </i><span>(<?php echo $cart_rows_number; ?>)</span></a>
			</div>

			<div class="user-box">
				
				<p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
				<p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
				<a href="logout.php" class="delete-btn">LOGOUT</a>

			</div>
		</div>
	</div>

</header>