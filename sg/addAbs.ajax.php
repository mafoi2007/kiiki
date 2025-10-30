<?php
	session_start();
	require_once('../inc/connect.inc.php');
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['classe'])){
		$classe = (int) $_POST['classe'];
		if($classe==0){
			echo "<h3 class='alert'>Vous devez selectionner une classe.</h3>";
		}else{ 
		?>
		Date du Jour : 
			<input type='date' name='dateAbsence' />
		<input type='submit' name='info' value='Valider' />
<?php 
		}
	}
?>