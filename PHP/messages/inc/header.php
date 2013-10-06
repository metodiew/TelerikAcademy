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
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>
	<div id="wrapper">
		<?php require_once 'inc/menu.php'; ?>
		<div id="content">
	<div id="wrapper">