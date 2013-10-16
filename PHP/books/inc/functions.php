<?php

/**
 * 
 * Simple Sanitize Query function
 * @param unknown_type $query
 * @return string $query
 */

function sanitizeQuery( $query ) {
	$query = trim( $query );
	$query = stripslashes( $query );
	$query = htmlspecialchars( $query );
	return $query;
}