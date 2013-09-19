<?php
mb_internal_encoding( 'UTF-8' );

$pageTitle = 'Add New Expense';

require_once 'includes/header.php';
require_once 'includes/constants.php';
?>

<?php 
if ( isset( $_POST['submit'] ) ) {
	$name 			= htmlspecialchars( $_POST['name'] );
	$name			= stripslashes( $name );
	$name 			= str_replace( '>', '', $name );
	$price 			= trim( $_POST['price'] );
	$price 			= str_replace( '>', '', $price );
	$selectedType	= $_POST['type'];
	$created 		= date( 'Y-m-d H:i:s' );
	$error 			= false;
	
	if ( empty( $name ) || mb_strlen( $name ) < 3 ) {
		echo '<p>Too short name</p>';
		$error = true;
	}
	
	if ( ! is_numeric( $price ) || $price < 0 ) {
		echo '<p>Invalid price</p>';
		$error = true;
	}
	
	if ( ! array_key_exists( $selectedType , $expenses_types ) ) {
		echo '<p>Invalid Type!</p>';
		$error = true;
	}
	
	if ( ! $error ) {
		$result = "\n" . $created . ' > ' . $name . ' > ' . $selectedType . ' > ' . $price;
		// Write Data in file. Advice not use this, this is just for example :-) 
		file_put_contents( 'expenses.txt', $result, FILE_APPEND );
	}
}

?>
<div>
<a href="index.php">Index</a>
</div>
<br />

<form method="POST" action="">
	<div>Name: <input type="text" name="name" /></div>
	<div>Price: <input type="text" name="price" /></div>
	<div> 
		<select name="type">
			<?php 
			foreach ( $expenses_types as $key => $type ) {
				echo '<option value="' . $key . '">' . $type . '</option>';
			}
			?>
		</select>
	</div>
	<div><input type="submit" name="submit" value="Submit" /></div>
</form>

<?php 
require_once 'includes/footer.php';
?>