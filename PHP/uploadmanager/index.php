<?php
$pageTitle = 'Upload Manager Index';
require_once 'inc/header.php';
?>

<h2>Upload Manager</h2>

<?php 
if ( ! isset( $_SESSION['isLogged'] ) ) {
	require_once 'login.php';
} else {
	require_once 'files.php';
}

