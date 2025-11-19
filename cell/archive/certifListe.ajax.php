<?php
	session_start();
	require_once('../../inc/connect.inc.php');
	$config = new Config($db);
	// print_r($_POST);
	if(isset($_POST['oldYear'])){
		$annee = $_POST['oldYear'];
		if($annee=='null'){
			echo "<h3 class='alert'>Vous devez selectionner une année scolaire.</h3>";
		}else{
			$listeEleve = $config->listeEleveOldYear($annee);
			// echo '<pre>'; print_r($listeEleve); echo '</pre>';
		?>
			Nom de l'élève : 
			<select 
				name = 'eleve' 
				id = 'eleve' 
				OnChange='findEleve()'>
				<option value='null' selected>-Choisir Eleve-</option>
				<?php 
				for($i=0;$i<count($listeEleve);$i++){
					$idEleve = $listeEleve[$i]['id'];
					$nomEleve = $listeEleve[$i]['nom_complet'];
					echo "<option value='".$idEleve."'>".$nomEleve."</option>";
				}
				?>
			</select>
			<div id='resultat' style = 'display:inline'>
			</div>
<?php 
		}
	}
?>