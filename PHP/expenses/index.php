<?php
$pageTitle = 'Expenses Tracking System';

require_once 'includes/header.php';
require_once 'includes/constants.php';
?>

<div>
<a href="add_expense.php">Add new Expense</a>
</div>
<br />

<form method="POST">
	<select name="filter">
		<?php 
		foreach ( $expenses_types as $key => $type ) {
			echo '<option value="' . $key . '">' . $type . '</option>';
		}
		?>
	</select>
	
	<input type="submit" name="submit" value="Filter" />
</form>

<?php
$selectedFilter = 'all';
if ( isset( $_POST['filter'] ) ) { 	
	$selectedFilter = $_POST['filter'];
}
?>

<table border="1">
	<tr>
		<td>Date</td>
		<td>Name</td>
		<td>Type</td>
		<td>Price</td>
	</tr>
	
	<?php 
	if ( file_exists( 'expenses.txt' ) ) {
		$result = file( 'expenses.txt' );
		
		$sum = 0;
		
		echo 'Order by: ' . $selectedFilter;
		
		foreach ( $result as $value ) {
			$columns = explode( ' > ' , $value );
			
			if ( $selectedFilter != 'all' && $columns[2] != $selectedFilter ) {
				continue;
			}
						
			echo '<tr>';
			
			foreach ( $columns as $key => $column ) {
				echo '<td>' . $columns[$key] . '</td>' ;	
			}
			echo '</tr>';
			
			$sum += (float) $columns[3];
		}
		
		echo '<tr>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td></td>';
		echo '<td>' . $sum . '</td>';
		echo '</tr>';
	}
	?>
</table>

<?php 
require_once 'includes/footer.php';
?>