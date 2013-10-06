<?php
$pageTitle = 'Messages Feed';
require_once 'inc/header.php';
?>

<h1>Index</h1>

<?php
if ( isLoggedUser() ) {
	
	// Check for successful action
	if ( isset( $_GET['success'] ) ) {
		
		// Successful added message
		if ( isset( $_GET['success'] ) && $_GET['success'] == 'addMessage' ) {
			echo '<p class="success">Message added</p>';
		}
		
		// Successful message delete
		if ( isset( $_GET['success'] ) && $_GET['success'] == 'msgDel' ) {
			echo '<p class="success">Message deleted</p>';
		}
	}
	
	require_once 'messages.php';
} else {
	require_once 'login.php';
}