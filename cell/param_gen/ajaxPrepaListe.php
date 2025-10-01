<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
?>
	
	<select name='classeDepart'>
		<?php 
		if(isset($_POST['anneeDepart'])){
			$as = str_replace(' ','',$_POST['anneeDepart']);
			$listeClasseOld = $config->listeAncienneClasse($as);
			for($j=0;$j<count($listeClasseOld);$j++){
				echo "<option value='";
				echo $listeClasseOld[$j]['classe'];
				echo "'>".ucwords($listeClasseOld[$j]['nom_classe'])."</option>";
			}
		}
		
		?>
	</select>
	Classe But : <select name='classeBut'>
		<?php 
		$listeClasse = $config->viewClasse('actif');
		for($k=0;$k<count($listeClasse);$k++){
			echo "<option value='";
			echo $listeClasse[$k]['code_classe'];
			echo "'>".strtoupper($listeClasse[$k]['nom_classe'])."</option>";
		}
		?>
	</select>
	
	<input type='submit' name='info' value='Valider' />