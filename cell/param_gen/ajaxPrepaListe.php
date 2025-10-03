<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
	if(isset($_POST['anneeDepart'])){
		$annee = $_POST['anneeDepart'];
		if($annee=='null'){
			echo "<h3 class='alert'>Vous devez selectionner une année scolaire.</h3>";
		}else{ 
			$listeClasseOld = $config->listeAncienneClasse($annee);
			$listeClasse = $config->viewClasseAll('actif');
			// print_r($listeClasse);
		?>
		Classe de Départ : 
			<select name='classeDepart'>
				<?php 
				for($x=0;$x<count($listeClasseOld);$x++){
					$id = $listeClasseOld[$x]['classe'];
					$nomClasse = $listeClasseOld[$x]['nom_classe'];
					echo "<option value='".$id."'>".$nomClasse."</option>";
				}
				?>
			</select>
		Classe But : 
			<select name='classeBut'>
				<?php 
				for($a=0;$a<count($listeClasse);$a++){
					$idClasse = $listeClasse[$a]['id'];
					$valueClasse = $listeClasse[$a]['nom_classe'];
					echo "<option value='".$idClasse."'>".$valueClasse."</option>";
				}
				?>
			</select>
		<input type='submit' name='info' value='Valider' />
<?php 
		}
	}
?>