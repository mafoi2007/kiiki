<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
?>




	<select name='sequence'>
		<?php 
		if(isset($_POST['sequence'])){
			$sequence = $_POST['sequence'];
			echo "<option value=''>Thanks !!!</option>";
		}
		?>
	</select>