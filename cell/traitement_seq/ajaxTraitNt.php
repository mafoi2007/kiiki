<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['classe'])){
		$classe = (int) $_POST['classe'];
		if($classe==0){
			$msg = "<h3 class='alert'>Choisir une classe.</h3>";
			echo $msg;
		}else{
			$sequence = $config->verifNoteSaisieSequenceReel($classe); ?>
			Séquence : 
			<select name='sekence'>

		<?php 
			for($i=0;$i<count($sequence);$i++){
				echo "<option value='".$sequence[$i]['id_periode']."'>Séquence ".$sequence[$i]['id_periode']."</option>";
			} ?>
			</select>
			<input 
				type='submit' 
				name='TraiterNoteSequentielle' 
				value='Traiter' />
		<?php 
		}
	}
?>