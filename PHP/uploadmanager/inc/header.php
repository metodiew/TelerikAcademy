<?php
session_start();

error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once 'inc/functions.php';
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $pageTitle; ?></title>
</head>
<body>
	<?php require_once 'inc/menu.php'; ?>