<?php
$pageTitle = 'userFiles';
require_once 'inc/header.php';
?>

<?php 
// Check if user is logged
if ( isLoggeduser() ) {
 
	$userUploadsFolder = UPLOADS_FOLDER . DIRECTORY_SEPARATOR . getUsername();
	$userFiles = scandir( $userUploadsFolder );
	
	//var_dump( $userFiles );
	
	if ( $userFiles ) {
		$count = 0;
		echo '<ul>';
		foreach ( $userFiles as $file ) {
			$count++;
			echo '<li>';
			echo $count . ' ' . $file;
			echo '</li>';
		}
		echo '</ul>';
	} else {
		echo '<p>You don\'t have any uploaded Files.</p>';
	}

} else {
	echo "You don't have sufficient access to this page";
	echo '<p><a href="login.php">Login</a></p>';
}
?>


<?php 
require_once 'inc/footer.php';