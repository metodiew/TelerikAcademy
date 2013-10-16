<?php
error_reporting( E_ALL );
ini_set( 'display_errors', 1 );

require_once 'inc/db-connection.php';
require_once 'inc/functions.php';
?>
<!DOCTYPE html>
<head>
	<title><?php echo $pageTitle;?></title>
	<meta charset="UTF-8">
	<link type="text/css" href="styles/style.css" rel="stylesheet">
</head>
<body>
<div id="wrapper">
	<?php include_once 'inc/menu.php'; ?>
	<div id="content">