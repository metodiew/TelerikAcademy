<?php
$pageTitle = 'Messages';
require_once 'inc/header.php';
?>

<h2>Messages</h2>

<?php 
// Check if user is logged
if ( isLoggedUser() ) {

	// Get connected with DB
	$dbConnection = dbConnection();

	$error = false;
	
	$sql = 'SELECT u.id, u.username, m.id, m.title, m.message, m.created, m.user_id
			FROM users as u, messages as m
			WHERE m.user_id = u.id
			ORDER BY m.created DESC
	';
	
	$result = mysqli_query( $dbConnection, $sql );
		
	if ( $result->num_rows > 0 ) {

		while ( $row = $result->fetch_assoc() ) {
			echo '<table border=1>';
			echo '<tr><td>';
			echo $row['title'];
			echo '</td></tr>';
			echo '<tr><td>';
			echo $row['message'];
			echo '</td></tr>';
			echo '<tr><td>';
			echo 'Author: ' . $row['username'];
			echo '</td></tr>';
			echo '<tr><td>';
			echo 'Posted on: ' . $row['created'];
			echo '</td></tr>';
			echo '</table>';
		}
		
	}
	
	
} else { // IF isLoggedUser()
	echo "You don't have sufficient access to this page";
	echo '<p><a href="login.php">Login</a> OR <a href="register.php">Register</a></p>';
}
?>

<?php 
require_once 'inc/footer.php';