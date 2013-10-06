<?php
$pageTitle = 'Messages';
require_once 'inc/header.php';
?>

<?php 
// Check if user is logged
if ( isLoggedUser() ) {
	
	echo '<h1>Messages</h1>';

	// Get connected with DB
	$dbConnection = dbConnection();

	$error = false;
	
	// Message order
	$messageOrder = 'DESC';
	
	if ( isset( $_POST['orderSubmit'] ) && isset( $_POST['msgOrder'] ) ) {
		$messageOrder = $_POST['msgOrder'];
	}
	?>
	
	<div>
		Order:
		<form method="POST">
			<select name="msgOrder">
				<option value="DESC">DESC</option>
				<option value="ASC">ASC</option>
			</select>
			
			<input type="submit" name="orderSubmit" value="Order" />
		</form>
	</div>
	
	<?php 
	$sql = 'SELECT u.id, u.username, m.id, m.title, m.message, m.created, m.user_id
			FROM users as u, messages as m
			WHERE m.user_id = u.id
			ORDER BY m.created '. $messageOrder .'
	';
	
	$result = mysqli_query( $dbConnection, $sql );
		
	if ( $result->num_rows > 0 ) {

		echo '<ul id="messages-feed">';
		while ( $row = $result->fetch_assoc() ) {
			?>

		<li>
			<div class="message-content">
				<div>
					<p>
						<?php echo $row['username']; ?> posted an update: 
						<span><?php echo $row['created']; ?></span>
					</p>
				</div>
				<div>
					<p>
						<?php echo $row['title']; ?>
					</p>					
					<p>
						<?php echo $row['message']; ?>
					</p>
				</div>
			</div>
			<?php 
			// Check if current user is admin
			if ( isAdmin() ) {
				echo '<a href="?msgDel=' . $row['id'] . '">Delete?</a>';
				
				if ( isset( $_GET['msgDel'] ) ) {
				    $messageID = ( int ) $_GET['msgDel'];
				    $sql = 'DELETE FROM messages 
				    		WHERE id = ' . $messageID
				    ;
				    if ( mysqli_query( $dbConnection, $sql ) ) {
				        header('Location: index.php?success=msgDel');
				        exit;
				    }
				}
			}
			?>
		</li>
			<?php
		} // end While
		echo '</ul>';
	}
	
	
} else { // IF isLoggedUser()
	echo "You don't have sufficient access to this page";
	echo '<p><a href="login.php">Login</a> OR <a href="register.php">Register</a></p>';
}
?>

<?php 
require_once 'inc/footer.php';