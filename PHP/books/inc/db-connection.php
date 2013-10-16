<?php

// Localhost Database Connection
define( 'SQL_HOST', 'localhost' );
define( 'SQL_USER', 'root' );
define( 'SQL_PASS', '' );
define( 'SQL_DB', 'books' );

$dbConnection = mysqli_connect( SQL_HOST, SQL_USER, SQL_PASS, SQL_DB );

if ( ! $dbConnection ) {
    echo 'No database connection!';
    exit;
}

mysqli_set_charset( $dbConnection, 'utf8' );