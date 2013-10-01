<?php
$pageTitle = 'Upload Manager';
require_once 'inc/header.php';
?>

<?php 
if ( isLoggedUser() ) {
	require_once 'files.php';
} else {
	echo '<h2>Upload Manager</h2>';
	require_once 'login.php';
}