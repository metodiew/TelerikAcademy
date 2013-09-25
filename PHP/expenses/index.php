<?php
$pageTitle = 'Expenses Tracking System';

require_once 'includes/header.php';
require_once 'includes/constants.php';
?>

<div>
<a href="add_expense.php">Add new Expense</a>
</div>

<?php 
if ( file_exists( 'expenses.txt' ) ) {
	$result = file( 'expenses.txt' );
	
	if ( count( $result ) == 0 ) {
            echo 'Currently there are no any expenses entered!';
	} else {
	?>
		
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
			echo '<p>Order by: ' . $selectedFilter . '</p>';
			
			$sum = 0;
			
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
				
				$sum += $columns[3];
				
			}
			
			echo '<tr>';
			echo '<td></td>';
			echo '<td></td>';
			echo '<td></td>';
			echo '<td>' . $sum . '</td>';
			echo '</tr>';
			echo '</table>';
		}
	} else { // end of if file exists
		echo 'File doesn\'t exists!';
	}
	?>

<?php 
require_once 'includes/footer.php';
?>