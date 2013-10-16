<?php
$pageTitle = "Index";

include 'inc/header.php';
include_once 'inc/menu.php';
?>

<?php 
$order = 'ASC';
if ( isset( $_GET['order'] ) ) {
	$order = sanitizeQuery( $_GET['order'] );
}
?>
<div class="order">
	<label for="order">Order</label>
	<form method="GET">
		<select id="order" name="order">
			<option value="asc">ASC</option>
			<option value="desc">DESC</option>
		</select> 
		<input type="submit" value="Order" />
	</form>
</div>

<?php
$query = "
	SELECT * FROM `books_authors`
	LEFT JOIN authors ON authors.author_id = books_authors.author_id
	LEFT JOIN books ON books_authors.book_id = books.book_id 
	ORDER BY books.book_title $order
";

$result = mysqli_query( $dbConnection, $query );

$bookResults = array();

while ( $row = mysqli_fetch_assoc( $result ) ) {
	$bookResults[$row['book_id']]['book'] = $row['book_title'];
	$bookResults[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
} 
?>

<table>
	<tr>
		<th>Book</th>
		<th>Authors</th>
	</tr>
	<?php 
	foreach ( $bookResults as $value ) {
		echo '<tr><td>';
		echo $value['book'];
		echo '</td>';
		echo '<td>';
		
		$authors = array();
		
		foreach ( $value['authors'] as $key => $author ) {
			$authors[]= '<a href="books.php?authorid=' . $key . '">' . $author . '</a>';
		}
		echo implode( ',&nbsp;&nbsp;', $authors );    
		echo "</td></tr>";
	}
	?>
</table>

<?php
include 'inc/footer.php';