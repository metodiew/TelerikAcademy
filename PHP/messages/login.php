<?php 
$pageTitle = 'Login';
require_once 'inc/header.php';
?>

<?php 
// Check if user is logged
if ( isLoggedUser() ) {
	
	echo "You are registered and logged user.";
	echo '<p><a href="index.php">Go to Index</a> OR <a href="logout.php">Logout</a></p>';

} else {
	
	// Login form
	if ( isset( $_POST['login'] ) ) {
		// Get connected with DB
		$dbConnection = dbConnection();
		
		$error = false;
		
		// Escape details posted from the user
		$username = mysqli_real_escape_string( $dbConnection, trim( $_POST['username'] ) );
		$password = mysqli_real_escape_string( $dbConnection, trim( $_POST['pass'] ) );
		
		// Check if login details are correct
		$sql = 'SELECT id, username, password 
				FROM users 
	         	WHERE username = "' . $username . '" AND password = "' . $password . '"
		';
		
		$result = mysqli_query( $dbConnection, $sql );
		
		if ( $result->num_rows > 0 ) {
			$row = $result->fetch_assoc();
			
			$_SESSION['username'] = $username;
	      	$_SESSION['userID'] = $row['id'];
			$_SESSION['isLogged'] = true;
			
			header( 'Location: index.php' );
			exit;
		} else {
			echo '<span class="error">Incorrect username or password</span>';
			$error = true;
		}
	}
	?>
	
	<form method="POST">
		<div>
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" />
		</div>
		<div>
			<label for="pass">Password:</label>
			<input type="password" id="pass" name="pass" />
		</div>
		<input type="submit" id="login" name="login" value="Login" />
	</form>
	
	<div>
		<a href="register.php">Registration</a>
	</div>

<?php
}
?>