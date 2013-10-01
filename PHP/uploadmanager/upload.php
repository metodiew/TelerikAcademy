<?php
$pageTitle = 'Upload';
require_once 'inc/header.php';
?>

<?php 
// Check if user is logged
if ( isLoggedUser() ) {
?>
	<form method="POST" enctype="multipart/form-data">
		<input type="file" id="file" name="file" />
		<input type="submit" id="upload-submit" name="upload-submit" value="Upload" />
	</form>
	<?php 
	
	// Show allowed files mime types
	$allowedMimeTypes = allowedMimeTypes();
	echo '<p>Allowed files: ';
	if ( ! empty( $allowedMimeTypes ) ) {
		foreach ($allowedMimeTypes as  $key => $type ) {
			echo $key . ', ';
		}
	}
	echo '</p>';
	
	// File upload logic
	// @TODO: to be moved to other file or function in functions.php
	if ( isset( $_POST['upload-submit'] ) && isset( $_FILES['file'] ) ) {
		if ( in_array( $_FILES['file']['type'], $allowedMimeTypes ) ) {
			
			// Check if Uploads Folder is there. If not - create.
			if ( ! is_dir( UPLOADS_FOLDER ) ) {
				mkdir( UPLOADS_FOLDER );
			}
			
			// Check if user has own uploads Folder, If not - create.
			$userUploadsFolder = UPLOADS_FOLDER . DIRECTORY_SEPARATOR . getUsername();
			if ( ! is_dir( $userUploadsFolder ) ) {
				mkdir( $userUploadsFolder );
			}
			
			// Move uploaded file to user uploads folder
			if ( move_uploaded_file( $_FILES['file']['tmp_name'], $userUploadsFolder . DIRECTORY_SEPARATOR . $_FILES['file']['name'] ) ) {
				echo '<p>File uploaded successfully</p>';
			} else {
				echo '<p>Problem with moving file.</p>';
			}
		} else {
			echo '<p>Problem with file mime type</p>';
		}
	} // END if isset

} else { // IF isLoggedUser()
	echo "You don't have sufficient access to this page";
	echo '<p><a href="login.php">Login</a></p>';
}
?>

<?php 
require_once 'inc/footer.php';