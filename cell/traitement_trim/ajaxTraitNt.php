<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	// print_r($_POST);
	if(isset($_POST['classe'])){
		$classe = (int) $_POST['classe'];
		if($classe==0){
			$msg = "<h3 class='alert'>Choisir une classe.</h3>";
			echo $msg;
		}else{ ?>
			Trimestre : 
			<select name='trimestre'>
				<option value='null' selected>-choisir-</option>
				<option value='1'>Trimestre 1</option>
				<option value='2'>Trimestre 2</option>
				<option value='3'>Trimestre 3</option>
			</select>
			<input type='submit' name='TraiterNoteTrimestrielle' value='Traiter' />
<?php 
		}
	}
?>