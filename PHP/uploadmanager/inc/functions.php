<?php
/*
 * Define few constants
 */

// Folder where will be uploaded files
if ( ! defined( 'UPLOADS_FOLDER' ) ) {
	define( 'UPLOADS_FOLDER', dirname( dirname(__FILE__) ) . '/user-uploads' );	
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

/**
 * File filesize conversion
 * Function from http://stackoverflow.com/questions/5501427/php-filesize-mb-kb-conversion
 * 
 * @return string $bytes
 */
function formatSizeUnits( $bytes ) {
	if ( $bytes >= 1073741824 ) {
		$bytes = number_format( $bytes / 1073741824, 2 ) . ' GB';
	} else if ( $bytes >= 1048576 ) {
		$bytes = number_format( $bytes / 1048576, 2 ) . ' MB';
	} else if ($bytes >= 1024) {
		$bytes = number_format( $bytes / 1024, 2 ) . ' KB';
	} else if ( $bytes > 1 ) {
		$bytes = $bytes . ' bytes';
	} else if ( $bytes == 1 ) {
		$bytes = $bytes . ' byte';
	} else {
		$bytes = '0 bytes';
	}

	return $bytes;
}