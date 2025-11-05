<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
	// print_r($_POST['classe']);
	if(isset($_POST['classe'])){
		$classe = (int) $_POST['classe'];
		$listeDepartement = $config->verifNoteSaisieSequenceReel($classe);
		// print_r($listeDepartement);
		if($classe==0){
			$msg = "<h3 class='alert'>Vous devez choisir une classe.</h3>";
			echo $msg;
		}else{ ?>
			Séquence : 
			<select name='sequence'>
				<?php 
				for($j=0;$j<count($listeDepartement);$j++){
					$idSequence = $listeDepartement[$j]['id_periode'];
					echo "<option value='".$idSequence."'> Séquence ".$idSequence."</option>";
				}
				?>
			</select>
			<input 
				type='hidden' 
				name='to_print' 
				value='VisualiserNoteSequentielle' />
			<input 
				type='submit' 
				name='print' 
				value='Valider' />
<?php 			
		}
	}
?>
	
			