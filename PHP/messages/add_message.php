<?php 
$pageTitle = 'Add Message';
require_once 'inc/header.php';
?>

<?php
// Check if user is logged
if ( isLoggedUser() ) {
?>

	<h1>Add New Message</h1>
	
	<form method="POST">
		<table>
			<tr>
				<td>
					<label for="title">Title:</label>
				</td>
				<td>
					<input type="text" id="title" name="title" />
				</td>
			</tr>
			<tr>
				<td>
					<label for="message">Message:</label>
				</td>
				<td>
					<textarea id="message" name="message"></textarea>
				</td>
			</tr>
			<tr>
				<td></td>
				<td>
					<input type="submit" id="submit" name="submit" value="Submit" />
				</td>
			</tr>
		</table>
	</form>
	
	<?php 
	// Add New Message logic
	if ( isset( $_POST['submit'] ) ) {
		
		// Get connected with DB
		$dbConnection = dbConnection();
		
		$error = false;
		
		if ( empty( $_POST['title'] ) || empty( $_POST['message'] ) ) {
			echo '<p class="error">Title and/or Message cannot\'t be empty!</p>';
			$error = true;
		} else {
			
			// Escape details posted from the user
			$title = mysqli_real_escape_string( $dbConnection, trim( $_POST['title'] ) );
			$message = mysqli_real_escape_string( $dbConnection, trim( $_POST['message'] ) );
			
			// Check inputs lenght
			if ( mb_strlen( $title, 'UTF-8' ) > 50 ) {
				echo '<span class="error">The Title should be a maximum length of 50 characters!</span>';
				$error = true;
			}
			
			if ( mb_strlen( $message, 'UTF-8' ) > 250 ) {
				echo '<span class="error">The Message should be a maximum length of 250 characters!</span>';
				$error = true;
			}
			
			// If everythings is fine, register the user and insert details in DB
			$userID = getUserID();
			$date = date( 'Y-m-d H:i:s' );
			
			if ( $error == false ) {
				$sql = 'INSERT INTO messages ( id, title, message, created, user_id )
                		VALUES ( NULL, "' . $title . '", "' . $message . '", "' . $date . '", "' . $userID . '" );
                ';
				
				if ( mysqli_query( $dbConnection, $sql ) ) {
					header( 'Location: index.php?success=addMessage' ); 
					exit;
				} else {
					echo '<span class="error">Something went wrong, please try again!</span>';
					$error = true;
				}
			}
			
		}
	}
	?>

<?php
} else { // IF isLoggedUser()
	echo "You don't have sufficient access to this page";
	echo '<p><a href="login.php">Login</a> OR <a href="register.php">Register</a></p>';
}