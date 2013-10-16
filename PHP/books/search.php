<?php
$pageTitle = "Search";

include 'inc/header.php';
?>

<form method="GET">
	<label for="bookname">Book title:</label>
	<input type="text" value="<?php if ( isset( $_POST ['submit'] ) && $_POST['book'] != '' ) echo $_POST['book'];?>" name='book' /> 
	<input type="submit" value="Search" />
</form>

<?php
if ( isset ( $_GET['book'] ) ) {
	$book = sanitizeQuery( $_GET['book'] );
	$book = mysqli_real_escape_string ( $dbConnection, $book );

	$query = "
		SELECT * FROM books_authors
		LEFT JOIN authors ON authors.author_id = books_authors.author_id
		LEFT JOIN books ON books_authors.book_id = books.book_id
		WHERE books.book_title LIKE '%$book%'
	";
	
	$result = mysqli_query ( $dbConnection, $query );
	if ( $result ) {
		if ( mysqli_num_rows ( $result ) > 0 ) {
			$foundBooks = array();
				
			while ( $row = mysqli_fetch_assoc ( $result ) ) {
				$foundBooks[$row['book_id']]['book'] = $row ['book_title'];
				$foundBooks[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
			}
			?>
			
			<table>
				<tr>
					<th>Book</th>
					<th>Authors</th>
				</tr>
				<?php
				foreach ( $foundBooks as $value ) {
					echo '<tr><td>';
					echo $value['book'];
					echo '</td>';
					echo '<td>';
					
					$authors = array();
					
					foreach ( $value['authors'] as $key => $authorValue ) {
						$authors[] = '<a href="books.php?authorid=' . $key. '">' . $authorValue . '</a>';
					}
					echo implode( ',&nbsp;&nbsp;', $authors );  
					echo '</td></tr>';
					}
					?>
			</table>
		<?php
		} else {
			echo "<p>No results.</p>";
		}
	}
}

include 'inc/footer.php';