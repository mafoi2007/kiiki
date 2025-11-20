<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['classe'])){
		$classe = (int) $_POST['classe'];
		if($classe==0){
			$msg = "<h3 class='alert'>Choisir une classe.</h3>";
			echo $msg;
		}else{
			$listeDepartement = $config->trimestresTraites($classe);
			if(empty($listeDepartement)){
				$msg = "<h3 class='alert'>Pas de trimestre pour cette classe</h3>";
				echo $msg;
			}else{ ?>
			Trimestre : 
			<select name='trimestre'>
				<?php for($j=0;$j<count($listeDepartement);$j++){
					$idTrim = $listeDepartement[$j]['trim'];
					echo "<option value='".$idTrim."'>Trimestre ".$idTrim."</option>";
				}?>
			</select>
			<?php $section = $config->verifSectionClasse($classe);?>
			<input type='hidden' name='section' value='<?php echo $section; ?>' />
			<input type='hidden' name='to_print' value='RapportTrimestriel' />
			<input type='submit' name='print' value='Générer' />
	<?php }
		}
	}
?>