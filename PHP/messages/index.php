<?php
$pageTitle = 'Messages Feed';
require_once 'inc/header.php';
?>

<?php 
if ( isLoggedUser() ) {
	require_once 'messages.php';
} else {
	echo '<h2>User Messages</h2>';
	require_once 'login.php';
}