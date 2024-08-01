<header class="header">

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


		<!-- toggle menu -->
		<button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">Menu</button>

		<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
			<div class="offcanvas-header">
				<h5 class="offcanvas-title" id="offcanvasRightLabel">Menu</h5>
				<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
			</div>
			<div class="offcanvas-body">
				<a href="admin_home.php">HOME</a>
				<a href="admin_orders.php">ORDERS</a>
				<a href="admin_products.php">PRODUCTS</a>
				<a href="admin_users.php">USERS</a>
				<a href="admin_messages.php">MESSAGES</a>

				<div class="account-box2">
					
					<p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
					<p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
					<a href="logout.php" class="logout-btn">LOGOUT</a>

				</div>

			</div>



		</div>



		<div class="account-box">
			
			<p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
			<p>email : <span><?php echo $_SESSION['admin_email']; ?></span></p>
			<a href="logout.php" class="logout-btn">LOGOUT</a>

		</div>

	</div>

</header>