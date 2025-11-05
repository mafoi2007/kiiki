<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['classe'])){
		$classe = $_POST['classe'];
		if($classe=='null'){
			$msg = "<h3 class='alert'>Choisissez une classe.</h3>";
			echo $msg;
		}else{ ?>
				Séquence : 
				<select name='sequence'>
					<?php 
					$listeSequence = $config->sequencesTraitees($classe);
					for($i=0;$i<count($listeSequence);$i++){
						$reponse = $listeSequence[$i]['sequence'];
						echo "<option value='".$reponse."'>Séquence ".$reponse."</option>";
					} ?>
				</select>
				<input type='hidden' name='to_print' value='RapportSequentiel' />
				<input type='submit' name='print' value='Visualiser' />
<?php 
		}
	}
?>