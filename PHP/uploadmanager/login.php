<?php 
$pageTitle = 'Login';
require_once 'inc/header.php';
?>

<?php 
// @TODO: create file with different users and passwords
// Default username and password
$defaultUser = 'user';
$defaultPass = 'qwerty';


// Login form logic
if ( isset( $_POST['login'] ) ) {
	$username = trim( $_POST['username'] );
	$pass = trim( $_POST['pass'] );
	
	// Check if login details are correct
	if ( $username == $defaultUser && $pass == $defaultPass ) {
		$_SESSION['username'] = $username;
		$_SESSION['isLogged'] = true;
		header( 'Location: index.php' );
		exit;
	} else {
		echo 'Incorrect username or password';
	}
}

?>

<form method="POST">
	<div>
		<label for="username">Username:</label>
		<input type="text" id="username" name="username" />
	</div>
	<div>
		<label for="password">Password:</label>
		<input type="password" id="pass" name="pass" />
	</div>
	<input type="submit" id="login" name="login" value="Login" />
</form>