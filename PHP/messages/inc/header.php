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
	<style type="text/css">
		#wrapper {
			margin-top: 50px;
		}
		
		.error {
			color: red;
		}
	</style>
</head>
<body>
	<?php require_once 'inc/menu.php'; ?>
	<div id="wrapper">