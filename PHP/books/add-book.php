<?php
$pageTitle = "Add New Book";

include 'inc/header.php';

$query = "SELECT * FROM authors ";
$result = mysqli_query( $dbConnection, $query );
?>

<form method="POST">
	<label for="title">Book Title:</label>
	<input type="text" id="title" name="title" value="<?php if ( isset ( $_POST['submit'] ) && $_POST['title'] != '' ) echo $_POST['title'];?>" />
		<label for="authors">Authors: </label>
		<select id="authors" name="authors[]" multiple="multiple">
			<?php
			while ( $row = mysqli_fetch_assoc ( $result ) ) {
				$authorid = $row['author_id'];
				echo '<option value=' . $authorid . '>';
					echo $row['author_name'];
				echo '</option>';
			}
			?>
		</select>
		<input type="submit" name="submit" value="Save" />
</form>

<?php

if (isset ( $_POST['submit'] )) {
	$error = false;

	// Sanitize the Query
	$title = sanitizeQuery( $_POST['title'] );
	$title = mysqli_real_escape_string ( $dbConnection, $title );
	
	// Check length of the book title
	$length = mb_strlen( $title );
	if ( $length < 3 ) {
		echo "<p>The book title should be at least three characters</p>";
		$error = true;
	}
	
	// Check if is selected author
	if ( ! isset ( $_POST['authors'] ) ) {
		echo "<p>Book should have at least one author</p>";
		$error = true;
	} else {
		$authors = $_POST['authors'];
	}
	
	
	if ( ! $error ) {		
		
		$query = '
			SELECT * 
			FROM books 
			WHERE book_title = "' . $title . '"
		';
		
		// Check if there is a author with the same name
		$result = mysqli_query( $dbConnection, $query );
		
		if ( $result ) {
			if ( mysqli_num_rows( $result ) > 0 ) {
				echo "<p>The Books is already existing.</p>";
				$error = true;
				exit;
			 } else {
				 $query = "
				 	INSERT INTO books (book_title) 
				 	VALUES ('$title')
				 ";
				
				 $result = mysqli_query( $dbConnection, $query );
				
				if ( ! $result ) {
					echo "<p>Books not saved.</p>";
					exit ();
				}
			 	
				$lastInsertedId = mysqli_insert_id ( $dbConnection );
				
				foreach ( $authors as $value ) {
					$values[] = "($lastInsertedId, $value)";
				}
				
				$query = "
					INSERT INTO books_authors 
					VALUES " . implode( ', ', $values )
				;
				
				$result = mysqli_query( $dbConnection, $query );
				
				if ( $result ) {
					echo "<p>Book was saved.</p>";
				} else {
					echo "<p>Something went wrong.</p>";
					$error = true;
				}	 	
			 }
		}
	}
}