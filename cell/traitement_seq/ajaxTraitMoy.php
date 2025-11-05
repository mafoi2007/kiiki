<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
	// print_r($_POST['classe']);
	if(isset($_POST['classe'])){
		$classe = $_POST['classe'];
		if($classe=='null'){
			echo "<h3 class='alert'>Choisisez une classe.</h3>";
		}else{
			$sequence = $config->sequencesTraitees($classe); ?>
			Sequence : 
			<select name='sekence'>
				<?php 
				for($j=0;$j<count($sequence);$j++){
					$idSeq = $sequence[$j]['sequence'];
					$libSeq = strtoupper($sequence[$j]['sequence']);
					echo "<option value='".$idSeq."'>Séquence ".$libSeq."</option>";
				}
				?>
			</select>
			<input type='submit' name='TraiterMoyenneSequentielle' value='Traiter' />
<?php 
		}
	}
?>