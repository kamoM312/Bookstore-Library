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


	<div class="flex">
		
		<a href="admin_home.php" class="logo">Admin<span>Panel</span></a>

		<nav class="navbar">
			
			<a href="admin_home.php">HOME</a>
			<a href="admin_orders.php">ORDERS</a>
			<a href="admin_products.php">PRODUCTS</a>
			<a href="admin_users.php">USERS</a>
			<a href="admin_messages.php">MESSAGES</a>

		</nav>

		<!-- Add menu button and user button styling -->


		<div class="icons">
			<div id="menu-btn" class="fas fa-bars"></div>
			<div id="user-btn" class="fas fa-user"></div>
		</div>

		<div class="account-box">
			
			<p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
			<p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
			<a href="logout.php" class="logout-btn">LOGOUT</a>

		</div>

	</div>

</header>