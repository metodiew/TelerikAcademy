<nav>
	<a href="index.php">Index</a>
	<a href="files.php">Files</a>
	<a href="upload.php">Upload file</a>
	<?php 
	// Check if user is logged
	if ( isLoggeduser() ) : 
		echo 'Hello, ' . getUsername();
		?>	
		<a href="logout.php">Logout</a>
	<?php endif; ?>
</nav>
