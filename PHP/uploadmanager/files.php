<?php
$pageTitle = 'User Files';
require_once 'inc/header.php';
?>

<h2>User Files</h2>

<?php 
// Check if user is logged
if ( isLoggedUser() ) {
 
	$userUploadsFolder = UPLOADS_FOLDER . DIRECTORY_SEPARATOR . getUsername();
	$userFiles = scandir( $userUploadsFolder );
	
	if ( $userFiles ) {
		$count = 0;
		echo '<ul>';
		foreach ( $userFiles as $key => $file ) {
			// Skip previous folders
			if ( $file == '.' || $file == '..' ) {
				continue;
			}
			
			// Get some info for the file
			$filePath = $userUploadsFolder . DIRECTORY_SEPARATOR . $file;
			$fileSize = filesize( $filePath );
			$fileSize = formatSizeUnits( $fileSize );			
	        $fileType = filetype( $filePath );
	        $fileType = pathinfo( $filePath, PATHINFO_EXTENSION );
			
			$count++;
			
			echo '<li>';
			echo $count . ' ' . '<a href="download.php?file=' . $file . '">' . $file . '</a>' . ' ' . $fileSize . ' ' . $fileType;
			echo '</li>';
		}
		echo '</ul>';
	} else { // IF $userFiles
		echo '<p>You don\'t have any uploaded Files.</p>';
	}
} else { // IF isLoggedUser()
	echo "You don't have sufficient access to this page";
	echo '<p><a href="login.php">Login</a></p>';
}
?>

<?php 
require_once 'inc/footer.php';