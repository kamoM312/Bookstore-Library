<header class="header">

	<div class="flex">
		
		<a href="admin_home.php">Admin Panel</a>

		<nav>
			
			<a href="admin_home.php">HOME</a>
			<a href="admin_orders.php">ORDERS</a>
			<a href="admin_products.php">PRODUCTS</a>
			<a href="admin_users.php">USERS</a>
			<a href="admin_messages.php">MESSAGES</a>

		</nav>

		<!-- Add icons  -->
		<div class="icons">
			
			<div id="menu-btn" class="fas fa-bars"></div>
			<div id="user-btn" class="fas fa-user"></div>

		</div>

		<div class="account-box">
			
			<p>username : <span><?php echo $_SESSION['admin_name']; ?></span></p>
			<p>email : <span><?php echo $_SESSION['admin_email']; ?></span>

		</div>

	</div>

</header>