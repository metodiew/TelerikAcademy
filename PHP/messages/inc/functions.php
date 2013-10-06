<?php
/*
 * Define few constants
 */

/**
 * DB Connection
 * 
 * It might be move to separated file
 * 
 * @return string
 */
function dbConnection() {
	// Localhost DB details. Your might be different
	$connection = mysqli_connect( 'localhost', 'root', '', 'telerik_messages' ) or die( 'Database error' );
	
	mysqli_query( $connection, 'SET NAMES utf8' );
	
	return $connection;
}

/**
 * Check if current user is logged in
 * 
 * @return boolean
 */
function isLoggedUser() {
    if ( isset( $_SESSION['isLogged'] ) && $_SESSION['isLogged'] == true) {
        return true;
    } else {
        return false;
    }
}

/**
 * Get current logged username
 * 
 * @return string $username
 */
function getUsername() {
	$username = '';
	if ( isLoggedUser() && isset( $_SESSION['username'] ) ) {
		$username = $_SESSION['username'];
	}
	
	return $username;
}

/**
 * Get current logged username
 * 
 * @return string $id
 */
function getUserID() {
	$id = '';
	if ( isLoggedUser() && isset( $_SESSION['userID'] ) ) {
		$id = $_SESSION['userID'];
	}
	
	return $id;
}