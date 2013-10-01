<?php
$pageTitle = 'Download';
require_once 'inc/header.php';
?>

<?php
// Check if user is logged
if ( isLoggedUser() ) {

	if ( isset( $_GET['file'] ) ) {
		$file = $_GET['file'];
		$userUploadsFolder = UPLOADS_FOLDER . DIRECTORY_SEPARATOR . getUsername();
		$file = $userUploadsFolder . DIRECTORY_SEPARATOR . $file;
		
		// If file exists and is readable, allow the user to download it
		if ( file_exists( $file ) && is_readable( $file ) ) {
			header( 'Content-Description: File Transfer' );
			header( 'Content-Disposition: attachment; filename=' . basename( $file ) );
			header( 'Content-Type: application/octet-stream' );
			header( 'Content-Transfer-Encoding: binary' );

			ob_clean();
	    	flush();
			readfile( $file );
			exit;
		}
	} else { // IF isset
		header( 'HTTP/1.0 404 Not Found' );
		echo '<h1>Error 404: File Not Found</h1>';
	}

} else { // IF isLoggedUser()
	echo "You don't have sufficient access to this page";
	echo '<p><a href="login.php">Login</a></p>';
}
?>

<?php 
require_once 'inc/footer.php';