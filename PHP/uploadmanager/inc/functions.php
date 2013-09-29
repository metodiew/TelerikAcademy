<?php
// Define few constants
if ( ! defined( 'UPLOADS_FOLDER' ) ) {
	define( 'UPLOADS_FOLDER', dirname( dirname(__FILE__) ) . '/user-uploads' );	
}




/**
 * Check if current user is logged
 * 
 * @return boolean
 */
function isLoggeduser() {
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
	if ( isLoggeduser() && isset( $_SESSION['username'] ) ) {
		$username = $_SESSION['username'];
	}
	
	return $username;
}

/**
 * List of allowed file mime types
 * 
 * @return array $mimeTypes
 */
function allowedMimeTypes() {
	$mimeTypes = array (
	    'txt' 	=> 'text/plain',
	    'jpeg'	=> 'image/jpeg',
	    'jpg' 	=> 'image/jpeg',
	    'png' 	=> 'image/png',
	    'gif' 	=> 'image/gif',
	    'bmp' 	=> 'image/bmp',
	    'doc' 	=> 'application/msword',
	    'pdf' 	=> 'application/pdf',
	    'rtf' 	=> 'application/rtf',
	    'xls' 	=> 'application/vnd.ms-excel',
	    'ppt' 	=> 'application/vnd.ms-powerpoint',
	);
	
	return $mimeTypes;
}