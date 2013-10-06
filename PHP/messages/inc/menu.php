<nav id="menu">
	<a href="index.php">Index</a>
	<?php 
	// Check if user is logged
	if ( isLoggedUser() ) : 
	?>
		<a href="messages.php">Messages</a>
		<a href="add_message.php">Add Message</a>	
		<?php 
		echo 'Hello, ' . getUsername();
		?>	
		<a href="logout.php">Logout</a>
	<?php else: ?>
		<a href="login.php">Login</a>
		<a href="register.php">Register</a>
	<?php endif; ?>
</nav>