<?php
$pageTitle = "Authors";
include 'inc/header.php';
?>

<?php

/*
 * Authors Order
 */
$order = 'ASC';
if ( isset( $_GET['order'] ) ) {
	$order = sanitizeQuery( $_GET['order'] );
	$order = mysqli_real_escape_string( $order );
}

$query = "
	SELECT * 
	FROM authors 
	ORDER BY author_name $order
"; 

$result = mysqli_query( $dbConnection, $query );

// If Submit button is pressed
if ( isset( $_POST['submit'] ) ) {
	$error = false;

	// Sanitize the Query
	$author = sanitizeQuery( $_POST['author'] );
	$author = mysqli_real_escape_string( $dbConnection, $author );

	// Check length of the author's name
	$length = mb_strlen( $author );
	if ( $length < 3 ) {
		echo "<p>The author's name should be at least with 3 symbols</p>";
		$error = true;
	}

	if ( ! $error ) {
		
		$query = '
			SELECT * 
			FROM authors 
			WHERE author_name = "' . $author . '"
		';
		
		// Check if there is a author with the same name
		$result = mysqli_query( $dbConnection, $query );
		
		if ( $result ) {
			if ( mysqli_num_rows( $result ) > 0 ) {
				echo "<p>The author is already existing.</p>";
				$error = true;
				exit;
			 } else {
		
				$query = "
					INSERT INTO authors (author_name) 
					VALUES ('$author')
				";
				
				$result = mysqli_query( $dbConnection, $query );
				
				if ( $result ) {
					echo "<p>Author saved</p>";
				} else {
					echo "<p>Something went wrong.</p>";
					$error = true;
				}
			}
		}
	}
}
?>

<form method="POST">
	<label for="author">Author name:</label>
	<input type="text" id="author" value="<?php if ( isset ( $_POST['submit'] ) && $_POST['author'] != '' ) echo $_POST['author'];?>" name="author" > 
	<input type="submit" name="submit" value="Add Author" />
</form>

<table>
	<tr>
		<th>Authors</th>
	</tr>
		<?php 
		$authors = array();
		while ( $row = mysqli_fetch_assoc( $result ) ) {
			$authors [] = $row;
		}
		
		foreach ( $authors as $value ) {
			echo '<tr><td>';
			$authorid = $value['author_id'];
			echo "<a href='books.php?authorid=$authorid'>" . $value["author_name"] . "</a>";
			echo '</td></tr>';
		}
	?>
</table>