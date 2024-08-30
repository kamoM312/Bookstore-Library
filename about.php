 <?php

 include 'config.php';

 session_start();

 $user_id = $_SESSION['user_id'];

 if(!isset($user_id)) {
 	header('location:login.php');
 }

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>About us - BookWorms</title>

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

 		<h3>about us</h3>
 		<p><a href="home_page.php">home</a> / about </p>

 	</div>

 	<section class="about">

 		<div class="flex">

 			<div class="image">

 				<img src="images/ai-generated-8716779_1280.jpg" alt="about us image">

 			</div>

 			<div class="content">

 				<h3>about us</h3>
 				<p>Quisque non tellus orci ac auctor. Sodales ut eu sem integer vitae. Lorem donec massa sapien faucibus. Id faucibus nisl tincidunt eget nullam non nisi est. Luctus accumsan tortor posuere ac ut consequat. Fusce id velit ut tortor pretium viverra suspendisse. Lorem ipsum dolor sit amet consectetur adipiscing elit pellentesque.</p>
 				<p>Sapien faucibus et molestie ac feugiat sed lectus. Leo duis ut diam quam nulla porttitor massa id neque. Enim praesent elementum facilisis leo vel fringilla est ullamcorper. Sit amet justo donec enim. Tincidunt tortor aliquam nulla facilisi. Commodo nulla facilisi nullam vehicula ipsum a arcu. Sed risus pretium quam vulputate dignissim suspendisse in est ante. Orci eu lobortis elementum nibh. Dui faucibus in ornare quam viverra orci sagittis eu. In cursus turpis massa tincidunt dui ut ornare.</p>
 				<a href="contact.php" class="btn">contact us</a>

 			</div>

 		</div>

 	</section>


 	<?php include 'footer.php'; ?>

 	<script src="js/script.js"></script>

 </body>
 </html>