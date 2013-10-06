<?php 
$pageTitle = 'Register';
require_once 'inc/header.php';
?>

<?php 
// Check if user is logged
if ( isLoggedUser() ) {
	
	echo "You are registered and logged user. Do you want to create a new registration?";
	echo '<p><a href="index.php">Go to Index</a> OR <a href="logout.php">Logout</a></p>';

} else {
	// Register logic
	if ( isset( $_POST['register'] ) ) {
		
		// Get connected with DB
		$dbConnection = dbConnection();
		
		$error = false;
		
		if ( empty( $_POST['username'] ) || empty( $_POST['pass'] ) ) {
			echo '<p class="error">Username and/or password can not be empty!</p>';
			$error = true;
		} else {
			
			// Escape details posted from the user
			$username = mysqli_real_escape_string( $dbConnection, trim( $_POST['username'] ) );
			$password = mysqli_real_escape_string( $dbConnection, trim( $_POST['pass'] ) );
			
			// Check inputs lenght
			if ( mb_strlen( $username, 'UTF-8' ) < 5 ) {
				echo '<span class="error">Username must be at least 5 symbols!</span>';
				$error = true;
			}
			
			if ( mb_strlen( $password, 'UTF-8' ) < 5 ) {
				echo '<span class="error">Password must be at least 5 symbols!</span>';
				$error = true;
			}
			
			// Check if username is available
			$sql = 'SELECT username 
					FROM users 
                	WHERE username = "' . $username . '"
			';
			
			$result = mysqli_query( $dbConnection, $sql );
			
			if ( $result->num_rows > 0 ) {
				echo '<span class="error">The username is already taken!</span>';
				$error = true;				
			}
			
			// If everythings is fine, register the user and insert details in DB
			if ( $error == false ) {
				$sql = 'INSERT INTO users ( id, username, password )
                		VALUES ( NULL, "' . $username . '", "' . $password . '" );
                ';
				
				if ( mysqli_query( $dbConnection, $sql ) ) {
					$_SESSION['isLogged'] = true;
					$_SESSION['username'] = $username;
					$_SESSION['userID'] = mysqli_insert_id( $dbConnection );
					header( 'Location: index.php' ); 
					exit;
				} else {
					echo '<span class="error">Something with registration went wrong</span>';
					$error = true;
				}
			}
			
		}
	}
	?>
	
	<h1>Register</h1>
	
	<form method="POST">
		<div>
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" />
		</div>
		<div>
			<label for="pass">Password:</label>
			<input type="password" id="pass" name="pass" />
		</div>
		<input type="submit" id="register" name="register" value="Register" />
	</form>
<?php
}
?>