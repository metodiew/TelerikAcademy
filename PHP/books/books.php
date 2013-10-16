<?php
$pageTitle = "Books by Author";
include 'inc/header.php';

?>

<?php
if ( isset ( $_GET['authorid'] ) ) { 
	$authorID = sanitizeQuery( $_GET['authorid'] );
} else {	
	header ( 'Location:  index.php' );
	exit;
}

$query = "
	SELECT * FROM books_authors AS b1, books_authors AS b2
	LEFT JOIN authors ON authors.author_id = b2.author_id
	LEFT JOIN books ON b2.book_id = books.book_id
	WHERE b1.author_id = $authorID 
		AND b2.book_id = b1.book_id
";

$result = mysqli_query( $dbConnection, $query );

if ( $result ) {
	if ( mysqli_num_rows( $result ) > 0 ) {
		$bookResults = array();
		
		while ( $row = mysqli_fetch_assoc( $result ) ) {
			$bookResults[$row['book_id']]['book'] = $row['book_title'];
			$bookResults[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
		}
		?>
				
		<table>
			<tr>
				<th>Books</th>
				<th>Authors</th>
			</tr>
			<?php
			foreach ( $bookResults as $value ) {
				echo '<tr><td>';
				echo $value['book'];
				echo '</td><td>';
				$authors = array();
				foreach ( $value['authors'] as $key => $book ) {
					$authors[] = '<a href="books.php?authorid=' . $key . '">' . $book . '</a>';
				}
				
				echo implode( ',&nbsp;&nbsp;', $authors );  
				echo '</td></tr>';
				}
				?>
		</table>
	<?php
	} else {
		echo "<p>No such author.</p>";
	}
} else {
	echo "<p>No results.</p>";
}

include 'inc/footer.php';