<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$note = new Note($db);
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['classe'])){
		$classe = (int) $_POST['classe'];
		if($classe==NULL){
			$msg="<h3 class='alert'>Choisir une classe.</h3>";
			echo $msg;
		}else{
			$listeDepartement = $config->sequencesTraitees($classe);
			if(empty($listeDepartement)){
				$msg = "<h3 class='alert'>Aucune séquence traitée pour la classe.</h3>";
				echo $msg;
			}else{ ?>
				Séquence : <select name='sekence'>
					<?php for($j=0;$j<count($listeDepartement);$j++){
						echo "<option value='";
						echo $listeDepartement[$j]['sequence'];
						echo "'>Séquence ".strtoupper($listeDepartement[$j]['sequence'])."</option>";
					}
					?>
				</select>
<?php 
				$section = $config->verifSectionClasse($classe); ?>
				<input type='hidden' name='section' value='<?php echo $section; ?>' />
				<input type='hidden' name='to_print' value='RapportSequentiel' />
				<input type='submit' name='print' value='Générer' />
<?php 
			} 
		}
	}
?>
