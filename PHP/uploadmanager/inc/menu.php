<nav>
	<a href="index.php">Index</a>
	<?php 
	// Check if user is logged
	if ( isLoggedUser() ) : 
	?>
		<a href="files.php">Files</a>
		<a href="upload.php">Upload file</a>
		<?php 
		echo 'Hello, ' . getUsername();
		?>	
		<a href="logout.php">Logout</a>
	<?php else: ?>
		<a href="login.php">Login</a>
	<?php endif; ?>
</nav>