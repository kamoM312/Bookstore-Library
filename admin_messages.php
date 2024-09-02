<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)) {
	header('location:login.php');
};

if(isset($_GET['delete'])){
	$delete_id = $_GET['delete'];
	mysqli_query($conn, "DELETE FROM Message WHERE ID = '$delete_id'") or die('Query Unsuccessful!');
	// php redirect
	header('location:admin_messages.php');
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Admin: Messages - BookWorms</title>

	<!-- custom css -->
	<link rel="stylesheet" href="css/admin_style.css">
	
	<!-- Add icon library -->
 	<link rel="stylesheet" 
 	href=
 	"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>

	<?php include 'admin_header.php'; ?>

	<section class="messages">
		
		<h1 class="title">Messages</h1>

		<div class="box-container">
			
			<?php 

		$select_messages = mysqli_query($conn, "SELECT * FROM Message") or die('Query Unsuccessful!');
		if(mysqli_num_rows($select_messages) > 0){
			while($fetch_message = mysqli_fetch_assoc($select_messages)){
		
		


			?>
			<div class="box">

				<p>Name : <span><?php echo $fetch_message['Name']; ?></span></p>
				<p>Number : <span><?php echo $fetch_message['Number']; ?></span></p>
				<p>Email : <span><?php echo $fetch_message['Email']; ?></span></p>
				<p>Message : <span><?php echo $fetch_message['Message']; ?></span></p>
				<a href="admin_messages.php?delete=<?php echo $fetch_message['ID']; ?>" onclick="return confirm('Delete this message?');" class="delete-btn">Delete Message</a>

			</div>


		

		<?php
				};
			} else {
			echo '<p class="empty">No messages received!</p>';
		}
		?>
		</div>

	</section>

	<script src="js/admin_script.js"></script>

</body>
</html>